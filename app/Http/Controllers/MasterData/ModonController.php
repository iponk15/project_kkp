<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Modon;
use App\Models\Modet;
use Validator;
use Hashids;
use Auth;
use DB;

class ModonController extends Controller
{
    private $route = 'modon';
    private $path  = 'MasterData.Modon';

    function __construct(){
        // put your magic
    }

    public function index(){
        $data = [
            'pagetitle'    => 'Odontogram',
            'cardTitle'    => 'List Data',
            'cardSubTitle' => '&nbsp;',
            'cardIcon'     => 'flaticon2-list-3',
            'breadcrumb'   => ['Index' => route($this->route . '.index')],
            'route'        => $this->route
        ];

        return view ($this->path.'.index', $data);
    }

    function ktable(Request $request){
        $post    = $request->input();
        $getData = Modon::selectRaw('modon_id,modon_kode,modon_no,modon_status,modon_createddate,modon_tipe,modon_transform,modon_order,modon_transform');
        $jmlData = Modon::selectRaw('count(*) AS jumlah');
        $paging  = $post['pagination'];
        $search  = (!empty($post['query']) ? $post['query'] : null);

        if( isset($post['sort']) ){
            $getData->orderBy($post['sort']['field'], $post['sort']['sort']);
        }else{
            $getData->orderBy('modon_createddate', 'DESC');
        }

        if(!empty($search)){
            foreach ($search as $value => $param) {
                if($value === 'generalSearch'){
                    $getData->whereRaw("(modon_no LIKE '%".$param."%' OR modon_deskripsi LIKE '%".$param."%')");
                    $jmlData->whereRaw("(modon_no LIKE '%".$param."%' OR modon_deskripsi LIKE '%".$param."%')");
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
            $rowIds[]          = $value->modon_id;
            $data['records'][] = [
                'RecordID'          => $value->modon_id,
                'no'                => (string)$i,
                'modon_kode'        => $value->modon_kode,
                'modon_tipe'        => $value->modon_tipe,
                'modon_order'       => $value->modon_order,
                'modon_transform'   => $value->modon_transform,
                'modon_status'      => intval($value->modon_status),
                'modon_createddate' => date('D, d F Y H:i', strtotime($value->modon_createddate)),
                'action'            => '<div class="dropdown dropdown-inline">
                                            <a href="'. route($this->route . '.showModet', ['id' => Hashids::encode($value->modon_id)]) .'" class="btn btn-icon btn-clean btn-sm mr-2 ajaxify" data-toggle="tooltip" data-theme="dark" title="Detail">
                                                <i class="flaticon-file-2 text-info"></i>
                                            </a>
                                            <button type="button" class="btn btn-clean btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-theme="dark" title="Ubah Status">
                                                <i class="flaticon-cogwheel-1 text-dark"></i>
                                            </button>
                                            <div class="dropdown-menu" style="">
                                                '.( $value->modon_status == 0 || $value->modon_status == 99 ? '<a onClick="return f_action(this, event, 1)" class="dropdown-item" href="'. route($this->route . '.changeStatus', ['id' => Hashids::encode($value->modon_id), 'status' => 1]) .'">Active</a>' : '' ).'
                                                '.( $value->modon_status == 1 || $value->modon_status == 99 ? '<a onClick="return f_action(this, event, 0)" class="dropdown-item" href="'. route($this->route . '.changeStatus', ['id' => Hashids::encode($value->modon_id), 'status' => 0]) .'">Inactive</a>' : '').'
                                                '.( $value->modon_status == 0 || $value->modon_status == 1 ? '<a onClick="return f_action(this, event, 99)" class="dropdown-item" href="'. route($this->route . '.changeStatus', ['id' => Hashids::encode($value->modon_id), 'status' => 99]) .'">Soft Delete</a>' : '' ).'
                                            </div>
                                            <a href="'. route($this->route . '.edit', ['id' => Hashids::encode($value->modon_id)]) .'" class="btn btn-icon btn-clean btn-sm mr-2 ajaxify" data-toggle="tooltip" data-theme="dark" title="Edit"><i class="flaticon-edit text-warning"></i></a>'.
                                            ( $value->modon_status == 99 
                                                ? '<a href="'. route($this->route . '.delete', ['id' => Hashids::encode($value->modon_id)]) .'" onClick="return f_action(this, event)" class="btn btn-icon btn-clean btn-sm mr-2" data-toggle="tooltip" data-theme="dark" title="Delete"><i class="flaticon-delete text-danger"></i></a>'
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
            'pagetitle'    => 'Page Odontogram',
            'cardTitle'    => 'Card Odontogram',
            'cardSubTitle' => 'Form tambah Odontogram',
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
                'modon_kode'  => 'required',
                'modon_no'    => 'required',
                'modon_tipe'  => 'required',
                'modon_order' => 'required|unique:kkp_modon',
            ],
            [
                'modon_kode.required'  => 'Kode tidak boleh kosong',
                'modon_no.required'    => 'No tidak boleh kosong',
                'modon_tipe.required'  => 'Tipe tidak boleh kosong',
                'modon_order.required' => 'Order tidak boleh kosong',
                'modon_order.unique'   => 'Value order sudah kepakai',
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
            $post['modon_created_by']  = Auth::user()->id;
            $post['modon_createddate'] = date('Y-m-d H:i:s');
            $post['modon_ip']          = \Request::ip();

            Modon::create($post);
            $lastId = DB::getPdo()->lastInsertId();

            DB::commit();

            $response['status']  = 1;
            $response['message'] = 'Data berhasil di simpan';
            $response['custUrl'] = route( $this->route . '.showModet', ['id' => Hashids::encode($lastId)] );
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
            'records'      => Modon::selectRaw('modon_kode,modon_no,modon_tipe,modon_order,modon_transform')->where('modon_id', Hashids::decode($id)[0])->first()
        ];

        return view($this->path . '.edit', $data);
    }

    function update(Request $request, $id){
        $post      = $request->input();
        $validator = Validator::make(
            $post,
            [
                'modon_kode'  => 'required',
                'modon_no'    => 'required',
                'modon_tipe'  => 'required'
            ],
            [
                'modon_kode.required'  => 'Kode tidak boleh kosong',
                'modon_no.required'    => 'No tidak boleh kosong',
                'modon_tipe.required'  => 'Tipe tidak boleh kosong'
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

            $post['modon_updatedby'] = Auth::user()->id;
            $post['modon_ip']         = \Request::ip();

            Modon::where('modon_id', Hashids::decode($id)[0])->update($post);

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
                Modon::where('modon_id', Hashids::decode($id)[0])->update(['modon_status' => $status]);
            }else{
                Modon::whereIn('modon_id', $post['ids'])->update(['modon_status' => $post['status']]);
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
                Modon::where('modon_id', Hashids::decode($id)[0])->delete();
            }else{
                Modon::whereIn('modon_id', $post['ids'])->delete();
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

    function preview(){
        $data['records'] = Modon::getModon();
        return view($this->path . '.preview', $data);
    }

    function showModet($id, $modetid = null){
        $data = [
            'pagetitle'    => 'Odontogram',
            'cardSubTitle' => '&nbsp;',
            'cardIcon'     => 'flaticon-file-1',
            'breadcrumb'   => ['Index' => route($this->route . '.index'), 'Show Detail' => route($this->route . '.showModet', ['id' => $id, 'modetid' => $modetid])],
            'route'        => $this->route,
            'id'           => $id,
            'modetid'      => $modetid,
            'modon'        => Modon::selectRaw('modon_kode,modon_order')->where('modon_id', Hashids::decode($id)[0])->first(),
            'modet'        => Modet::selectRaw('modet_id,modet_kode,modet_points,modet_order,modet_status,modet_createddate')
                ->where('modet_modon_id', Hashids::decode($id)[0])
                ->orderBy('modet_order', 'ASC')
                ->get()
        ];

        $data['cardTitle'] = 'Odontogram - ' . $data['modon']->modon_kode .'/'. $data['modon']->modon_order;

        if(!empty($modetid)){
            $data['records'] = collect($data['modet'])->where('modet_id', Hashids::decode($modetid)[0])->first();
        }else{
            $data['records'] = [];
        }

        // dd($data);

        return view($this->path . '.showModet', $data);
    }

    function storeModet(Request $request, $id, $modetid = null){
        $post      = $request->input();
        $validator = Validator::make(
            $post,
            [
                'modet_kode'   => 'required',
                'modet_points' => 'required',
                'modet_order'  => 'required'
            ],
            [
                'modet_kode.required'   => 'Kode tidak boleh kosong',
                'modet_points.required' => 'No tidak boleh kosong',
                'modet_order.required'  => 'Tipe tidak boleh kosong'
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
            $post['modet_modon_id']    = Hashids::decode($id)[0];
            $post['modet_createddate'] = date('Y-m-d H:i:s');
            $post['modet_createdby']   = Auth::user()->id;
            $post['modet_ip']          = \Request::ip();

            if(empty($modetid)){
                Modet::create($post);
            }else{
                Arr::forget($post, '_token');
                Modet::where('modet_id', Hashids::decode($modetid)[0])->update($post);
            }

            DB::commit();

            $response['status']  = 1;
            $response['message'] = 'Data berhasil ' . (empty($modetid) ? 'disimpan' : 'diubah');
        } catch (\Exception $ex) {

            DB::rollback();

            $response['status']  = 0;
            $response['message'] = $ex->getMessage();
        }

        echo json_encode($response);
    }

    function deleteModet(Request $request, $id){
        $post = $request->input();
        DB::beginTransaction();

        try {
            Modet::where('modet_id', Hashids::decode($id)[0])->delete();
            
            DB::commit();

            $response['status']  = 1;
            $response['message'] = 'Data berhasil dihapus';
        } catch (\Exception $ex) {
            DB::rollback();

            $response['status']  = 0;
            $response['message'] = $ex->getMessage();
        }

        echo json_encode($response);
    }
}
