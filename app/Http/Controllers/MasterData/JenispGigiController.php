<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\JenispGigi;
use Validator;
use Hashids;
use Auth;
use DB;

class JenispGigiController extends Controller
{
    private $route = 'jenispgigi';
    private $path  = 'MasterData.JenispGigi';

    function __construct(){
        // put your magic
    }

    public function index(){
        $data = [
            'pagetitle'    => 'Jenis Penyakit Gigi',
            'cardTitle'    => 'List Data',
            'cardSubTitle' => 'Poli Gigi',
            'cardIcon'     => 'flaticon2-list-3',
            'breadcrumb'   => ['Index' => route($this->route . '.index')],
            'route'        => $this->route
        ];

        return view ($this->path.'.index', $data);
    }

    function ktable(Request $request){
        $post    = $request->input();
        $getData = JenispGigi::selectRaw('jenisp_id, jenisp_warna, jenisp_nama, jenisp_deskripsi, jenisp_status, jenisp_lastupdate, jenisp_createddate');
        $jmlData = JenispGigi::selectRaw('count(*) AS jumlah');
        $paging  = $post['pagination'];
        $search  = (!empty($post['query']) ? $post['query'] : null);

        if( isset($post['sort']) ){
            $getData->orderBy($post['sort']['field'], $post['sort']['sort']);
        }else{
            $getData->orderBy('jenisp_createddate', 'DESC');
        }

        if(!empty($search)){
            foreach ($search as $value => $param) {
                if($value === 'generalSearch'){
                    $getData->whereRaw("(jenisp_warna LIKE '%".$param."%' OR jenisp_nama LIKE '%".$param."%' OR jenisp_deskripsi LIKE '%".$param."%')");
                    $jmlData->whereRaw("(jenisp_warna LIKE '%".$param."%' OR jenisp_nama LIKE '%".$param."%' OR jenisp_deskripsi LIKE '%".$param."%')");
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
            $rowIds[]          = $value->jenisp_id;
            $data['records'][] = [
                'RecordID'            => $value->jenisp_id,
                'no'                  => (string)$i,
                'jenisp_nama'         => $value->jenisp_nama,
                'jenisp_warna'        => $value->jenisp_warna,
                'jenisp_deskripsi'    => $value->jenisp_deskripsi,
                'status'              => intval($value->jenisp_status),
                'jenisp_createddate' => date('D, d F Y H:i', strtotime($value->jenisp_createddate)),
                'action'              => '<div class="dropdown dropdown-inline">
                                            <button type="button" class="btn btn-clean btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-theme="dark" title="Ubah Status">
                                                <i class="flaticon-cogwheel-1 text-dark"></i>
                                            </button>
                                            <div class="dropdown-menu" style="">
                                                '.( $value->jenisp_status == 0 || $value->jenisp_status == 99 ? '<a onClick="return f_action(this, event, 1)" class="dropdown-item" href="'. route($this->route . '.changeStatus', ['id' => Hashids::encode($value->jenisp_id), 'status' => 1]) .'">Active</a>' : '' ).'
                                                '.( $value->jenisp_status == 1 || $value->jenisp_status == 99 ? '<a onClick="return f_action(this, event, 0)" class="dropdown-item" href="'. route($this->route . '.changeStatus', ['id' => Hashids::encode($value->jenisp_id), 'status' => 0]) .'">Inactive</a>' : '').'
                                                '.( $value->jenisp_status == 0 || $value->jenisp_status == 1 ? '<a onClick="return f_action(this, event, 99)" class="dropdown-item" href="'. route($this->route . '.changeStatus', ['id' => Hashids::encode($value->jenisp_id), 'status' => 99]) .'">Soft Delete</a>' : '' ).'
                                            </div>
                                            <a href="'. route($this->route . '.edit', ['id' => Hashids::encode($value->jenisp_id)]) .'" class="btn btn-icon btn-clean btn-sm mr-2 ajaxify" data-toggle="tooltip" data-theme="dark" title="Edit"><i class="flaticon-edit text-warning"></i></a>'.
                                            ( $value->jenisp_status == 99 
                                                ? '<a href="'. route($this->route . '.delete', ['id' => Hashids::encode($value->jenisp_id)]) .'" onClick="return f_action(this, event)" class="btn btn-icon btn-clean btn-sm mr-2" data-toggle="tooltip" data-theme="dark" title="Delete"><i class="flaticon-delete text-danger"></i></a>'
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
            'pagetitle'    => 'Page jenis penyakit gigi',
            'cardTitle'    => 'Card jenis penyakit gigi',
            'cardSubTitle' => 'Form tambah jenis penyakit gigi',
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
                'jenisp_warna' => 'required',
                'jenisp_nama'  => 'required',
            ],
            [
                'jenisp_warna.required' => 'Kode tidak boleh kosong',
                'jenisp_nama.required'  => 'Nama tidak boleh kosong',
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
            $post['jenisp_created_by']   = Auth::user()->id;
            $post['jenisp_createddate'] = date('Y-m-d H:i:s');
            $post['jenisp_ip']           = \Request::ip();

            JenispGigi::create($post);

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
            'cardSubTitle' => 'Form edit',
            'cardIcon'     => 'flaticon-file-1',
            'breadcrumb'   => ['Index' => route($this->route . '.index'), 'Edit' => route($this->route . '.edit', ['id' => $id]) ],
            'route'        => $this->route,
            'id'           => $id,
            'records'      => JenispGigi::selectRaw('jenisp_warna,jenisp_nama,jenisp_deskripsi')->where('jenisp_id', Hashids::decode($id)[0])->first()
        ];

        return view($this->path . '.edit', $data);
    }

    function update(Request $request, $id){
        $post      = $request->input();
        $validator = Validator::make(
            $post,
            [
                'jenisp_warna' => 'required',
                'jenisp_nama'  => 'required'
            ],
            [
                'jenisp_warna.required' => 'Kode tidak boleh kosong',
                'jenisp_nama.required'  => 'Nama tidak boleh kosong'
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

            $post['jenisp_updated_by'] = Auth::user()->id;
            $post['jenisp_ip']         = \Request::ip();

            JenispGigi::where('jenisp_id', Hashids::decode($id)[0])->update($post);

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
                JenispGigi::where('jenisp_id', Hashids::decode($id)[0])->update(['jenisp_status' => $status]);
            }else{
                JenispGigi::whereIn('jenisp_id', $post['ids'])->update(['jenisp_status' => $post['status']]);
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
                JenispGigi::where('jenisp_id', Hashids::decode($id)[0])->delete();
            }else{
                JenispGigi::whereIn('jenisp_id', $post['ids'])->delete();
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
