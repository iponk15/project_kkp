<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Jenobat;
use Validator;
use Hashids;
use Auth;
use DB;

class JenobatController extends Controller
{
    private $route = 'jenobat';
    private $path  = 'masterdata.jenobat';

    function __construct(){
        // put your magic
    }

    public function index(){
        $data = [
            'pagetitle'    => 'Jenis Obat',
            'cardTitle'    => 'List Data',
            'cardSubTitle' => 'Jenis Obat',
            'cardIcon'     => 'flaticon2-list-3',
            'breadcrumb'   => ['Index' => route($this->route . '.index')],
            'route'        => $this->route
        ];

        return view ($this->path.'.index', $data);
    }

    function ktable(Request $request){
        $post    = $request->input();
        $getData = Jenobat::selectRaw('jenobat_id, jenobat_nama, jenobat_deskripsi, jenobat_status, jenobat_lastupdate, jenobat_created_date');
        $jmlData = Jenobat::selectRaw('count(*) AS jumlah');
        $paging  = $post['pagination'];
        $search  = (!empty($post['query']) ? $post['query'] : null);

        if( isset($post['sort']) ){
            $getData->orderBy($post['sort']['field'], $post['sort']['sort']);
        }else{
            $getData->orderBy('jenobat_created_date', 'DESC');
        }

        if(!empty($search)){
            foreach ($search as $value => $param) {
                if($value === 'generalSearch'){
                    $getData->whereRaw("(jenobat_nama LIKE '%".$param."%' OR jenobat_deskripsi LIKE '%".$param."%')");
                    $jmlData->whereRaw("(jenobat_nama LIKE '%".$param."%' OR jenobat_deskripsi LIKE '%".$param."%')");
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
            $rowIds[]          = $value->jenobat_id;
            $data['records'][] = [
                'RecordID'             => $value->jenobat_id,
                'no'                   => (string)$i,
                'jenobat_nama'         => $value->jenobat_nama,
                'jenobat_deskripsi'    => $value->jenobat_deskripsi,
                'status'               => intval($value->jenobat_status),
                'jenobat_created_date' => date('D, d F Y H:i', strtotime($value->jenobat_created_date)),
                'action'               => '<div class="dropdown dropdown-inline">
                                                <button type="button" class="btn btn-clean btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-theme="dark" title="Ubah Status">
                                                    <i class="flaticon-cogwheel-1 text-dark"></i>
                                                </button>
                                                <div class="dropdown-menu" style="">
                                                    '.( $value->jenobat_status == 0 || $value->jenobat_status == 99 ? '<a onClick="return f_action(this, event, 1)" class="dropdown-item" href="'. route($this->route . '.changeStatus', ['id' => Hashids::encode($value->jenobat_id), 'status' => 1]) .'">Active</a>' : '' ).'
                                                    '.( $value->jenobat_status == 1 || $value->jenobat_status == 99 ? '<a onClick="return f_action(this, event, 0)" class="dropdown-item" href="'. route($this->route . '.changeStatus', ['id' => Hashids::encode($value->jenobat_id), 'status' => 0]) .'">Inactive</a>' : '').'
                                                    '.( $value->jenobat_status == 0 || $value->jenobat_status == 1 ? '<a onClick="return f_action(this, event, 99)" class="dropdown-item" href="'. route($this->route . '.changeStatus', ['id' => Hashids::encode($value->jenobat_id), 'status' => 99]) .'">Soft Delete</a>' : '' ).'
                                                </div>
                                                <a href="'. route($this->route . '.edit', ['id' => Hashids::encode($value->jenobat_id)]) .'" class="btn btn-icon btn-clean btn-sm mr-2 ajaxify" data-toggle="tooltip" data-theme="dark" title="Edit"><i class="flaticon-edit text-warning"></i></a>'.
                                                ( $value->jenobat_status == 99 
                                                    ? '<a href="'. route($this->route . '.delete', ['id' => Hashids::encode($value->jenobat_id)]) .'" onClick="return f_action(this, event)" class="btn btn-icon btn-clean btn-sm mr-2" data-toggle="tooltip" data-theme="dark" title="Delete"><i class="flaticon-delete text-danger"></i></a>'
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
            'pagetitle'    => 'Page Jenis Obat',
            'cardTitle'    => 'Card Jenis Obat',
            'cardSubTitle' => 'Form tambah Jenis Obat',
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
                'jenobat_nama'      => 'required',
                'jenobat_deskripsi' => 'required',
            ],
            [
                'jenobat_nama.required'      => 'Nama tidak boleh kosong',
                'jenobat_deskripsi.required' => 'Deskripsi tidak boleh kosong',
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
            $post['jenobat_created_by']   = Auth::user()->id;
            $post['jenobat_created_date'] = date('Y-m-d H:i:s');
            $post['jenobat_ip']           = \Request::ip();

            Jenobat::create($post);

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
            'records'      => Jenobat::selectRaw('jenobat_nama,jenobat_deskripsi')->where('jenobat_id', Hashids::decode($id)[0])->first()
        ];

        return view($this->path . '.edit', $data);
    }

    function update(Request $request, $id){
        $post      = $request->input();
        $validator = Validator::make(
            $post,
            [
                'jenobat_nama'      => 'required',
                'jenobat_deskripsi' => 'required',
            ],
            [
                'jenobat_nama.required'      => 'Nama tidak boleh kosong',
                'jenobat_deskripsi.required' => 'Deskripsi tidak boleh kosong',
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

            $post['jenobat_updated_by'] = Auth::user()->id;
            $post['jenobat_ip']         = \Request::ip();

            Jenobat::where('jenobat_id', Hashids::decode($id)[0])->update($post);

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
                Jenobat::where('jenobat_id', Hashids::decode($id)[0])->update(['jenobat_status' => $status]);
            }else{
                Jenobat::whereIn('jenobat_id', $post['ids'])->update(['jenobat_status' => $post['status']]);
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
                Jenobat::where('jenobat_id', Hashids::decode($id)[0])->delete();
            }else{
                Jenobat::whereIn('jenobat_id', $post['ids'])->delete();
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
