<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Obat;
use App\Models\ObatStok;
use Validator;
use Hashids;
use Auth;
use DB;

class ObatController extends Controller
{
    private $route = 'obat';
    private $path  = 'masterdata.obat';

    function __construct(){
        // put your magic
    }

    public function index(){
        $data = [
            'pagetitle'    => 'Obat',
            'cardTitle'    => 'List Data',
            'cardSubTitle' => 'Obat',
            'cardIcon'     => 'flaticon2-list-3',
            'breadcrumb'   => ['Index' => route($this->route . '.index')],
            'route'        => $this->route
        ];

        return view ($this->path.'.index', $data);
    }

    function ktable(Request $request){
        $post    = $request->input();
        $getData = Obat::selectRaw('obat_id, obat_nama, obat_deskripsi, obat_stok, obat_status, obat_lastupdate, obat_created_date, katobat_nama, jenobat_nama');
        $getData->leftJoin('kkp_kategori_obat','obat_katobat_id','katobat_id')->leftJoin('kkp_jenis_obat','obat_jenobat_id','jenobat_id');

        $jmlData = Obat::selectRaw('count(*) AS jumlah');
        $jmlData->leftJoin('kkp_kategori_obat','obat_katobat_id','katobat_id')->leftJoin('kkp_jenis_obat','obat_jenobat_id','jenobat_id');

        $paging  = $post['pagination'];
        $search  = (!empty($post['query']) ? $post['query'] : null);

        if( isset($post['sort']) ){
            $getData->orderBy($post['sort']['field'], $post['sort']['sort']);
        }else{
            $getData->orderBy('obat_created_date', 'DESC');
        }

        if(!empty($search)){
            foreach ($search as $value => $param) {
                if($value === 'generalSearch'){
                    $getData->whereRaw("(obat_nama LIKE '%".$param."%' OR obat_deskripsi LIKE '%".$param."%')");
                    $jmlData->whereRaw("(obat_nama LIKE '%".$param."%' OR obat_deskripsi LIKE '%".$param."%')");
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
            $rowIds[]          = $value->obat_id;
            $data['records'][] = [
                'RecordID'           => $value->obat_id,
                'no'                 => (string)$i,
                'obat_nama'          => $value->obat_nama,
                'katobat_nama'       => $value->katobat_nama,
                'jenobat_nama'       => $value->jenobat_nama,
                'obat_deskripsi'     => $value->obat_deskripsi,
                'obat_stok'          => $value->obat_stok,
                'status'             => intval($value->obat_status),
                'action'             => '<div class="dropdown dropdown-inline">' .
                                            ( $value->obat_status == 1 
                                                ? '<button type="button" class="btn btn-clean btn-icon btn-sm" onClick="return f_stokObat(this, event)" data-toggle="modal" data-target="#formInputStok" data-id="'. Hashids::encode($value->obat_id) .'" data-route="'. route( $this->route . '.inputStok' ) .'"><i class="flaticon-cart text-info"></i></button>'
                                                : ''
                                            ) . '
                                            <button type="button" class="btn btn-clean btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-theme="dark" title="Ubah Status">
                                                <i class="flaticon-cogwheel-1 text-dark"></i>
                                            </button>
                                            <div class="dropdown-menu" style="">
                                                '.( $value->obat_status == 0 || $value->obat_status == 99 ? '<a onClick="return f_action(this, event, 1)" class="dropdown-item" href="'. route($this->route . '.changeStatus', ['id' => Hashids::encode($value->obat_id), 'status' => 1]) .'">Active</a>' : '' ).'
                                                '.( $value->obat_status == 1 || $value->obat_status == 99 ? '<a onClick="return f_action(this, event, 0)" class="dropdown-item" href="'. route($this->route . '.changeStatus', ['id' => Hashids::encode($value->obat_id), 'status' => 0]) .'">Inactive</a>' : '').'
                                                '.( $value->obat_status == 0 || $value->obat_status == 1 ? '<a onClick="return f_action(this, event, 99)" class="dropdown-item" href="'. route($this->route . '.changeStatus', ['id' => Hashids::encode($value->obat_id), 'status' => 99]) .'">Soft Delete</a>' : '' ).'
                                            </div>
                                            <a href="'. route($this->route . '.edit', ['id' => Hashids::encode($value->obat_id)]) .'" class="btn btn-icon btn-clean btn-sm mr-2 ajaxify" data-toggle="tooltip" data-theme="dark" title="Edit"><i class="flaticon-edit text-warning"></i></a>'.
                                            ( $value->obat_status == 99 
                                                ? '<a href="'. route($this->route . '.delete', ['id' => Hashids::encode($value->obat_id)]) .'" onClick="return f_action(this, event)" class="btn btn-icon btn-clean btn-sm mr-2" data-toggle="tooltip" data-theme="dark" title="Delete"><i class="flaticon-delete text-danger"></i></a>'
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
            'pagetitle'    => 'Page Obat',
            'cardTitle'    => 'Card Obat',
            'cardSubTitle' => 'Form tambah Obat',
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
                'obat_nama'      => 'required',
                'obat_deskripsi' => 'required',
            ],
            [
                'obat_nama.required'      => 'Nama tidak boleh kosong',
                'obat_deskripsi.required' => 'Deskripsi tidak boleh kosong',
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
            $post['obat_created_by']   = Auth::user()->id;
            $post['obat_created_date'] = date('Y-m-d H:i:s');
            $post['obat_ip']           = \Request::ip();

            Obat::create($post);

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
            'records'      => Obat::selectRaw('obat_nama,obat_deskripsi,katobat_id,katobat_nama,jenobat_id,jenobat_nama')
                ->leftJoin('kkp_kategori_obat', 'obat_katobat_id', 'katobat_id')
                ->leftJoin('kkp_jenis_obat', 'obat_jenobat_id', 'jenobat_id')
                ->where('obat_id', Hashids::decode($id)[0])
                ->first()
        ];

        return view($this->path . '.edit', $data);
    }

    function update(Request $request, $id){
        $post      = $request->input();
        $validator = Validator::make(
            $post,
            [
                'obat_nama'      => 'required',
                'obat_deskripsi' => 'required',
            ],
            [
                'obat_nama.required'      => 'Nama tidak boleh kosong',
                'obat_deskripsi.required' => 'Deskripsi tidak boleh kosong',
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

            $post['obat_updated_by'] = Auth::user()->id;
            $post['obat_ip']         = \Request::ip();

            Obat::where('obat_id', Hashids::decode($id)[0])->update($post);

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
                Obat::where('obat_id', Hashids::decode($id)[0])->update(['obat_status' => $status]);
            }else{
                Obat::whereIn('obat_id', $post['ids'])->update(['obat_status' => $post['status']]);
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
                Obat::where('obat_id', Hashids::decode($id)[0])->delete();
            }else{
                Obat::whereIn('obat_id', $post['ids'])->delete();
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

    function inputStok(Request $request){
        $post = $request->input();
        $data = [
            'obat_id' => $post['obat_id'],
            'route'   => $this->route,
            'records' => Obat::selectRaw('obat_nama')
                ->where('obat_id', Hashids::decode($post['obat_id'])[0])->first()
        ];

        return view($this->path . '.inputStok', $data);
    }

    function storeStokObat(Request $request){
        $post      = $request->input();
        $dcdObatId = Hashids::decode($post['stkbat_obat_id'])[0];
        $validator = Validator::make(
            $post,
            [ 'stkbat_stok' => 'required' ],
            [ 'stkbat_stok.required' => 'Stok obat tidak boleh kosong' ]
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

        $stokObat = Obat::select('obat_stok')->where('obat_id', $dcdObatId)->first()->obat_stok;
        $jmlStok  = $post['stkbat_stok'] + $stokObat;

        DB::beginTransaction();

        try {
            $post['stkbat_obat_id']      = $dcdObatId;
            $post['stkbat_created_by']   = Auth::user()->id;
            $post['stkbat_created_date'] = date('Y-m-d H:i:s');
            $post['stkbat_ip']           = \Request::ip();

            ObatStok::create($post);

            Obat::where('obat_id', $dcdObatId)->update(['obat_stok' => $jmlStok]);

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

    function ktableStokObat(Request $request, $obat_id){
        $post    = $request->input();
        $getData = ObatStok::selectRaw('stkbat_keterangan,stkbat_stok,stkbat_created_date')->where('stkbat_obat_id', Hashids::decode($obat_id)[0]);
        $jmlData = ObatStok::selectRaw('count(*) AS jumlah')->where('stkbat_obat_id', Hashids::decode($obat_id)[0]);
        $paging  = $post['pagination'];
        $search  = (!empty($post['query']) ? $post['query'] : null);

        if( isset($post['sort']) ){
            $getData->orderBy($post['sort']['field'], $post['sort']['sort']);
        }else{
            $getData->orderBy('stkbat_created_date', 'DESC');
        }

        if(!empty($search)){
            foreach ($search as $value => $param) {
                if($value === 'generalSearch'){
                    $getData->whereRaw("(stkbat_keterangan LIKE '%".$param."%')");
                    $jmlData->whereRaw("(stkbat_keterangan LIKE '%".$param."%')");
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
            $rowIds[]          = $value->obat_id;
            $data['records'][] = [
                'no'                  => (string)$i,
                'stkbat_keterangan'   => $value->stkbat_keterangan,
                'stkbat_stok'         => $value->stkbat_stok,
                'stkbat_created_date' => date('D, d F Y H:i', strtotime($value->stkbat_created_date))
            ];

            $i++;
        }

        $encode = (object)[
            'meta' => ['page' => $start, 'pages' => $limit, 'perpage' => $limit, 'total' => $jumlah, 'sort' => 'asc', 'field' => 'RecordID', 'rowIds' => $rowIds],
            'data' =>  $data['records']
        ];

        echo json_encode($encode);
    }
}
