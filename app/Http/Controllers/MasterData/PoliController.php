<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Poli;
use Validator;
use Hashids;
use Auth;
use DB;

class PoliController extends Controller
{
    private $route = 'poli';
    private $path  = 'MasterData.Poli';

    function __construct(){
        // put your magic
    }

    public function index(){
        $data = [
            'pagetitle'    => 'Poli',
            'cardTitle'    => 'List Data',
            'cardSubTitle' => 'Poli',
            'cardIcon'     => 'flaticon2-list-3',
            'breadcrumb'   => ['Index' => route($this->route . '.index')],
            'route'        => $this->route
        ];

        return view ($this->path.'.index', $data);
    }

    function ktable(Request $request){
        $post    = $request->input();
        $getData = Poli::selectRaw('poli_id, poli_nama, poli_deskripsi, poli_status, poli_lastupdate, poli_created_date');
        $jmlData = Poli::selectRaw('count(*) AS jumlah');
        $paging  = $post['pagination'];
        $search  = (!empty($post['query']) ? $post['query'] : null);

        if( isset($post['sort']) ){
            $getData->orderBy($post['sort']['field'], $post['sort']['sort']);
        }else{
            $getData->orderBy('poli_created_date', 'DESC');
        }

        if(!empty($search)){
            foreach ($search as $value => $param) {
                if($value === 'generalSearch'){
                    $getData->whereRaw("(poli_nama LIKE '%".$param."%' OR poli_deskripsi LIKE '%".$param."%')");
                    $jmlData->whereRaw("(poli_nama LIKE '%".$param."%' OR poli_deskripsi LIKE '%".$param."%')");
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
            $rowIds[]          = $value->poli_id;
            $data['records'][] = [
                'RecordID'             => $value->poli_id,
                'no'                   => (string)$i,
                'poli_nama'         => $value->poli_nama,
                'poli_deskripsi'    => $value->poli_deskripsi,
                'status'               => intval($value->poli_status),
                'poli_created_date' => date('D, d F Y H:i', strtotime($value->poli_created_date)),
                'action'               => '<div class="dropdown dropdown-inline">
                                                <button type="button" class="btn btn-clean btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-theme="dark" title="Ubah Status">
                                                    <i class="flaticon-cogwheel-1 text-dark"></i>
                                                </button>
                                                <div class="dropdown-menu" style="">
                                                    '.( $value->poli_status == 0 || $value->poli_status == 99 ? '<a onClick="return f_action(this, event, 1)" class="dropdown-item" href="'. route($this->route . '.changeStatus', ['id' => Hashids::encode($value->poli_id), 'status' => 1]) .'">Active</a>' : '' ).'
                                                    '.( $value->poli_status == 1 || $value->poli_status == 99 ? '<a onClick="return f_action(this, event, 0)" class="dropdown-item" href="'. route($this->route . '.changeStatus', ['id' => Hashids::encode($value->poli_id), 'status' => 0]) .'">Inactive</a>' : '').'
                                                    '.( $value->poli_status == 0 || $value->poli_status == 1 ? '<a onClick="return f_action(this, event, 99)" class="dropdown-item" href="'. route($this->route . '.changeStatus', ['id' => Hashids::encode($value->poli_id), 'status' => 99]) .'">Soft Delete</a>' : '' ).'
                                                </div>
                                                <a href="'. route($this->route . '.edit', ['id' => Hashids::encode($value->poli_id)]) .'" class="btn btn-icon btn-clean btn-sm mr-2 ajaxify" data-toggle="tooltip" data-theme="dark" title="Edit"><i class="flaticon-edit text-warning"></i></a>'.
                                                ( $value->poli_status == 99 
                                                    ? '<a href="'. route($this->route . '.delete', ['id' => Hashids::encode($value->poli_id)]) .'" onClick="return f_action(this, event)" class="btn btn-icon btn-clean btn-sm mr-2" data-toggle="tooltip" data-theme="dark" title="Delete"><i class="flaticon-delete text-danger"></i></a>'
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
            'pagetitle'    => 'Page Poli',
            'cardTitle'    => 'Card Poli',
            'cardSubTitle' => 'Form tambah Poli',
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
                'poli_nama'      => 'required',
                'poli_deskripsi' => 'required',
            ],
            [
                'poli_nama.required'      => 'Nama tidak boleh kosong',
                'poli_deskripsi.required' => 'Deskripsi tidak boleh kosong',
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
            $post['poli_created_by']   = Auth::user()->id;
            $post['poli_created_date'] = date('Y-m-d H:i:s');
            $post['poli_ip']           = \Request::ip();

            Poli::create($post);

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
            'pagetitle'    => 'Page Edit',
            'cardTitle'    => 'Card Edit',
            'cardSubTitle' => 'Form edit edit',
            'cardIcon'     => 'flaticon-file-1',
            'breadcrumb'   => ['Index' => route($this->route . '.index'), 'Edit' => route($this->route . '.edit', ['id' => $id]) ],
            'route'        => $this->route,
            'id'           => $id,
            'records'      => Poli::selectRaw('poli_nama,poli_deskripsi')->where('poli_id', Hashids::decode($id)[0])->first()
        ];

        return view($this->path . '.edit', $data);
    }

    function update(Request $request, $id){
        $post      = $request->input();
        $validator = Validator::make(
            $post,
            [
                'poli_nama'      => 'required',
                'poli_deskripsi' => 'required',
            ],
            [
                'poli_nama.required'      => 'Nama tidak boleh kosong',
                'poli_deskripsi.required' => 'Deskripsi tidak boleh kosong',
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

            $post['poli_updated_by'] = Auth::user()->id;
            $post['poli_ip']         = \Request::ip();

            Poli::where('poli_id', Hashids::decode($id)[0])->update($post);

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
                Poli::where('poli_id', Hashids::decode($id)[0])->update(['poli_status' => $status]);
            }else{
                Poli::whereIn('poli_id', $post['ids'])->update(['poli_status' => $post['status']]);
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
                Poli::where('poli_id', Hashids::decode($id)[0])->delete();
            }else{
                Poli::whereIn('poli_id', $post['ids'])->delete();
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
