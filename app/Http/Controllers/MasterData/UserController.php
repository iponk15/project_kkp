<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Validator;
use App\User;
use Hashids;
use Auth;
use DB;

class UserController extends Controller
{
    private $route = 'user';
    private $path  = 'masterdata.user';

    public function index(){
        $data = [
            'pagetitle'    => 'Page User',
            'cardTitle'    => 'Card User',
            'cardSubTitle' => 'List Data User',
            'cardIcon'     => 'flaticon2-list-3',
            'breadcrumb'   => ['Index' => route($this->route . '.index')],
            'route'        => $this->route
        ];

        return view ($this->path.'.index', $data);
    }

    function ktable(Request $request){
        $post    = $request->input();
        $getData = User::selectRaw('id, name, email, role_nama, status, created_at');
        $getData->leftJoin('kkp_role AS kr', 'users.role_kode', 'kr.role_kode');

        $jmlData = User::selectRaw('count(*) AS jumlah');
        $paging  = $post['pagination'];
        $search  = (!empty($post['query']) ? $post['query'] : null);

        if( isset($post['sort']) ){
            $getData->orderBy($post['sort']['field'], $post['sort']['sort']);
        }else{
            $getData->orderBy('created_at', 'DESC');
        }

        if(!empty($search)){
            foreach ($search as $value => $param) {
                if($value === 'generalSearch'){
                    $getData->whereRaw("(name LIKE '%".$param."%' OR email LIKE '%".$param."%')");
                    $jmlData->whereRaw("(name LIKE '%".$param."%' OR email LIKE '%".$param."%')");
                }else{
                    if($value !== 0 ){
                        $getData->where($value, $param);
                        $jmlData->where($value, $param);
                    }
                }
            }
            $awal = null;
        }

        $start = intval($paging['page']);
        $limit = intval($paging['perpage']);
        $awal  = ($start == 1 ? '0' : ($start * $limit) - $limit);

        $getData->offset($awal);
        $getData->limit($limit);
        $result = $getData->get();

        $jumlah          = $jmlData->first()->jumlah;
        $data['records'] = array();
        $rowIds          = [];
        $i               = 1 + $awal;

        foreach($result as $key => $value){
            $rowIds[]          = $value->id;
            $data['records'][] = [
                'RecordID'   => $value->id,
                'no'         => (string)$i,
                'name'       => $value->name,
                'email'      => $value->email,
                'role_nama'  => $value->role_nama,
                'status'     => intval($value->status),
                'created_at' => date('D, d F Y H:i', strtotime($value->created_at)),
                'action'     => '<div class="dropdown dropdown-inline">
                                    <button type="button" class="btn btn-clean btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-theme="dark" title="Ubah Status">
                                        <i class="flaticon-cogwheel-1 text-dark"></i>
                                    </button>
                                    <div class="dropdown-menu" style="">
                                        '.( $value->status == 0 || $value->status == 99 ? '<a onClick="return f_action(this, event, 1)" class="dropdown-item" href="'. route($this->route . '.changeStatus', ['id' => Hashids::encode($value->id), 'status' => 1]) .'">Active</a>' : '' ).'
                                        '.( $value->status == 1 || $value->status == 99 ? '<a onClick="return f_action(this, event, 0)" class="dropdown-item" href="'. route($this->route . '.changeStatus', ['id' => Hashids::encode($value->id), 'status' => 0]) .'">Inactive</a>' : '').'
                                        '.( $value->status == 0 || $value->status == 1 ? '<a onClick="return f_action(this, event, 99)" class="dropdown-item" href="'. route($this->route . '.changeStatus', ['id' => Hashids::encode($value->id), 'status' => 99]) .'">Soft Delete</a>' : '' ).'
                                    </div>
                                    <a href="'. route($this->route . '.edit', ['id' => Hashids::encode($value->id)]) .'" class="btn btn-icon btn-clean btn-sm mr-2 ajaxify" data-toggle="tooltip" data-theme="dark" title="Edit"><i class="flaticon-edit text-warning"></i></a>'.
                                    ( $value->status == 99 
                                        ? '<a href="'. route($this->route . '.delete', ['id' => Hashids::encode($value->id)]) .'" onClick="return f_action(this, event)" class="btn btn-icon btn-clean btn-sm mr-2" data-toggle="tooltip" data-theme="dark" title="Delete"><i class="flaticon-delete text-danger"></i></a>'
                                        : ''
                                    ).
                                '</div>'
                                
            ];

            $i++;
        }

        $encode = (object)[
            'meta' => ['page' => $start, 'pages' => $limit, 'perpage' => $limit, 'total' => $jumlah, 'sort' => 'asc', 'field' => 'RecordID', 'rowIds' => $rowIds],
            'data' =>  $data['records']
        ];

        echo json_encode($encode);
    }

    function show(){
        $data = [
            'pagetitle'    => 'Page User',
            'cardTitle'    => 'Card User',
            'cardSubTitle' => 'Form tambah user',
            'cardIcon'     => 'flaticon-file-1',
            'breadcrumb'   => ['Index' => route($this->route . '.index'), 'Show' => route($this->route . '.show')],
            'route'        => $this->route
        ];

        return view($this->path . '.show', $data);
    }

    function store(Request $request){
        $post      = $request->input();
        $validator = Validator::make(
            $post,
            [
                'name'     => 'required',
                'email'    => 'required|unique:users',
                'password' => 'required',
                'role_kode'  => 'required'
            ],
            [
                'name.required'     => 'Nama tidak boleh kosong',
                'email.required'    => 'Email tidak boleh kosong',
                'email.unique'      => 'Email sudah digunakan',
                'password.required' => 'Password tidak boleh kosong',
                'role_kode.required'  => 'Role tidak boleh kosong',
            ]
        );

        if ($validator->fails()) {
            $error     = '';
            $validator = $validator->errors()->messages();
            foreach ($validator as $key => $value) {
                $error .= ' - ' . $value[0] . '<br>';
            }

            $response['status']  = 2;
            $response['message'] = $error;

            echo json_encode($response);
            return;
        }

        DB::beginTransaction();

        try {
            $post['password'] = bcrypt($post['password']);
            User::create($post);

            DB::commit();

            $response['status']  = 1;
            $response['message'] = 'Data berhasil di simpan';
        } catch (\Exception $ex) {

            DB::rollback();

            $response['status']  = 0;
            $response['message'] = $ex->getMessage();
        }

        echo json_encode($response);
    }

    function edit($id){
        $data = [
            'pagetitle'    => 'Page User',
            'cardTitle'    => 'Card User',
            'cardSubTitle' => 'Form edit user',
            'cardIcon'     => 'flaticon-file-1',
            'breadcrumb'   => ['Index' => route($this->route . '.index'), 'Edit' => route($this->route . '.edit', ['id' => $id]) ],
            'route'        => $this->route,
            'id'           => $id,
            'records'      => User::selectRaw('users.name,users.email,kr.role_kode,kr.role_nama')
                ->leftJoin('kkp_role as kr', 'users.role_kode', 'kr.role_kode')
                ->where('id', Hashids::decode($id)[0])
                ->first()
        ];

        return view($this->path . '.edit', $data);
    }

    function update(Request $request, $id){
        $post      = $request->input();
        $validator = Validator::make(
            $post,
            [
                'name'    => 'required',
                'email'   => 'required',
                'role_kode' => 'required'
            ],
            [
                'name.required'    => 'Nama tidak boleh kosong',
                'email.required'   => 'Email tidak boleh kosong',
                'role_kode.required' => 'Email tidak boleh kosong',
            ]
        );

        if ($validator->fails()) {
            $error     = '';
            $validator = $validator->errors()->messages();
            foreach ($validator as $key => $value) {
                $error .= ' - ' . $value[0] . '<br>';
            }

            $response['status']  = 2;
            $response['message'] = $error;

            echo json_encode($response);
            return;
        }

        DB::beginTransaction();

        try {
            Arr::forget($post, '_token');
            Arr::forget($post, 'cnfmPass');
            
            if(!empty($post['password'])){
                $post['password'] = bcrypt($post['password']);
            }else{
                Arr::forget($post, 'password');
            }

            User::where('id', Hashids::decode($id)[0])->update($post);

            DB::commit();

            $response['status']  = 1;
            $response['message'] = 'Data berhasil diupdate';
        } catch (\Exception $ex) {

            DB::rollback();

            $response['status']  = 0;
            $response['message'] = $ex->getMessage();
        }

        echo json_encode($response);
    }

    function changeStatus(Request $request, $id, $status){
        $post = $request->input();

        DB::beginTransaction();

        try {
            if(empty($post)){
                User::where('id', Hashids::decode($id)[0])->update(['status' => $status]);
            }else{
                User::whereIn('id', $post['ids'])->update(['status' => $post['status']]);
            }

            DB::commit();

            $response['status']  = 1;
            $response['message'] = ( empty($post) ? ( $status == 1 ? 'Data berhasil di aktifkan kembali' : (  $status == 0 ? 'Data berhasil di non aktifkan' : 'Data berhasil di hapus sementara' ) ) : 'Data berhasil di update' );
        } catch (\Exception $ex) {
            DB::rollback();

            $response['status']  = 0;
            $response['message'] = $ex->getMessage();
        }

        echo json_encode($response);
    }

    function delete(Request $request, $id){
        $post = $request->input();
        DB::beginTransaction();

        try {
            if(empty($post)){
                User::where('id', Hashids::decode($id)[0])->delete();
            }else{
                User::whereIn('id', $post['ids'])->delete();
            }
            
            DB::commit();

            $response['status']  = 1;
            $response['message'] = 'Data berhasil di hapus';
        } catch (\Exception $ex) {
            DB::rollback();

            $response['status']  = 0;
            $response['message'] = $ex->getMessage();
        }

        echo json_encode($response);
    }
}
