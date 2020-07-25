<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\RujukanSpesialis;
use Illuminate\Http\Request;
use App\Models\PasienRekdis;
use Illuminate\Support\Arr;
use App\Models\PasienTrans;
use App\Models\RujukanLab;
use App\Models\ResepObat;
use App\Models\LogTrans;
use App\Models\Pasien;
use App\Models\Obat;
use Validator;
use Hashids;
use Auth;
use DB;

class PasienInController extends Controller
{
    private $route = 'pasienin';
    private $path  = 'Pasien.PasienIn';

    function __construct(){
        // put your magic
    }

    public function index(){
        $data = [
            'pagetitle'    => 'Pasien Berobat',
            'cardTitle'    => 'Form',
            'cardSubTitle' => 'Pasien Berobat',
            'cardIcon'     => 'flaticon2-list-3',
            'breadcrumb'   => ['Index' => route($this->route . '.index')],
            'route'        => $this->route
        ];

        return view ($this->path.'.index', $data);
    }

    function ktable(Request $request){
        $post    = $request->input();
        $getData = PasienTrans::selectRaw('pasien_id, pasien_norekdis, pasien_nama, pasien_tgllahir, pasien_umur, pasien_jk, psntrans_id, pastrans_status, pastrans_created_date, u.name AS dokter_nama')
            ->leftJoin('kkp_pasien', 'pastrans_pasien_id', 'pasien_id')
            ->leftJoin('users AS u', 'pastrans_dokter_id', 'u.id');
            
        $jmlData = PasienTrans::selectRaw('count(*) AS jumlah')
            ->leftJoin('kkp_pasien', 'pastrans_pasien_id', 'pasien_id')
            ->leftJoin('users AS u', 'pastrans_dokter_id', 'u.id');

        $paging  = $post['pagination'];
        $search  = (!empty($post['query']) ? $post['query'] : null);

        if(Auth::user()->role_kode == 'KKPSTR' || Auth::user()->role_kode == 'KKPPTG' || Auth::user()->role_kode == 'KKPDKT'){
            $getData->where('pastrans_status', '<>', '99');
            $jmlData->where('pastrans_status', '<>', '99');

            if( Auth::user()->role_kode == 'KKPDKT' ){
                $getData->where('pastrans_dokter_id', Auth::user()->id);
                $jmlData->where('pastrans_dokter_id', Auth::user()->id);
            }
        }

        if( isset($post['sort']) ){
            $getData->orderBy($post['sort']['field'], $post['sort']['sort']);
        }else{
            $getData->orderBy('pastrans_created_date', 'DESC');
        }

        if(!empty($search)){
            foreach ($search as $value => $param) {
                if($value === 'generalSearch'){
                    $getData->whereRaw("(pasien_norekdis LIKE '%".$param."%' OR pasien_nama LIKE '%".$param."%')");
                    $jmlData->whereRaw("(pasien_norekdis LIKE '%".$param."%' OR pasien_nama LIKE '%".$param."%')");
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
        $gender          = ['L' => 'Laki-laki', 'P' => 'Perempuan'];

        foreach($result as $key => $value){

            if( Auth::user()->role_kode == 'KKPPTG' ){
                $button = '<div class="dropdown dropdown-inline">    
                            <a href="" class="btn btn-icon btn-clean btn-sm mr-2 ajaxify" data-toggle="tooltip" data-theme="dark" title="Detail Pasien"><i class="flaticon-information text-primary icon-xl"></i></a>
                        </div>';
            }else if( Auth::user()->role_kode == 'KKPSTR' ){
                $button = '<div class="dropdown dropdown-inline">' .
                                ( $value->pastrans_status == '1'
                                    ? '<a href="'. route( $this->route . '.formPeriksa', ['psntrans_id' => Hashids::encode($value->psntrans_id)] ) .'" class="btn btn-icon btn-clean btn-sm mr-2 ajaxify" data-toggle="tooltip" data-theme="dark" title="Pemeriksaan Pasien"><i class="flaticon-statistics text-warning icon-xl"></i></a>'
                                    : '<a href="'. route( $this->route . '.formPeriksa', ['psntrans_id' => Hashids::encode($value->psntrans_id)] ) .'" class="btn btn-icon btn-clean btn-sm mr-2 ajaxify" data-toggle="tooltip" data-theme="dark" title="Informasi Pasien"><i class="flaticon-notes text-info icon-xl"></i></a>' 
                                ) .
                           '</div>';
            }else if( Auth::user()->role_kode == 'KKPDKT' ) {
                $button = '<div class="dropdown dropdown-inline">' .
                                ( $value->pastrans_status == '2'
                                    ? '<a href="'. route( $this->route . '.formPeriksaDokter', ['psntrans_id' => Hashids::encode($value->psntrans_id)] ) .'" class="btn btn-icon btn-clean btn-sm mr-2 ajaxify" data-toggle="tooltip" data-theme="dark" title="Pemeriksaan Pasien"><i class="flaticon-statistics text-danger icon-xl"></i></a>'
                                    : ''
                                ) .
                            '</div>';
            }else{
                $button = '';
            }

            $rowIds[]          = $value->jenobat_id;
            $data['records'][] = [
                'no'                    => (string)$i,
                'pasien_norekdis'       => $value->pasien_norekdis,
                'dokter_nama'           => $value->dokter_nama,
                'pasien_nama'           => $value->pasien_nama,
                'pasien_tgllahir'       => date('d F Y', strtotime($value->pasien_tgllahir)),
                // 'pasien_umur'           => $value->pasien_umur,
                'pasien_jk'             => $gender[$value->pasien_jk],
                'pastrans_status'       => $value->pastrans_status,
                'pastrans_created_date' => date('D, d F Y H:i', strtotime($value->pastrans_created_date)),
                'action'                => $button
                                
            ];

            $i++;
        }

        $encode = (object)[
            'meta' => ['page' => $start, 'pages' => $limit, 'perpage' => $limit, 'total' => $jumlah, 'sort' => 'asc', 'field' => 'RecordID'],
            'data' =>  $data['records']
        ];

        echo json_encode($encode);
    }

    function formPeriksa($psntrans_id){
        $data = [
            'pagetitle'    => 'Form Pemeriksaan',
            'cardTitle'    => 'Form Pemeriksaan',
            'cardIcon'     => 'flaticon2-list-3',
            'breadcrumb'   => [ 'index' => route( $this->route . '.index' ), 'Form Pemeriksaan' => route($this->route . '.formPeriksa', ['psntrans_id' => $psntrans_id])],
            'route'        => $this->route,
            'psntrans_id'  => $psntrans_id,
            'records'      => PasienTrans::selectRaw('pasien_norekdis, pasien_id, pasien_nama, pasien_tgllahir, pasien_umur, pasien_email, pasien_jk, pasien_telp, pasien_alamat, u.name AS nama_dokter, kpol.poli_nama, kpol.poli_kode')
                ->leftJoin('kkp_pasien', 'pastrans_pasien_id', 'pasien_id')
                ->leftJoin('users AS u', 'pastrans_dokter_id', 'u.id')
                ->leftJoin('kkp_poli AS kpol', 'u.poli_id', 'kpol.poli_id')
                ->where('psntrans_id', Hashids::decode($psntrans_id)[0])
                ->first(),
            'subHeadBtn' => '<b>Dr. Tirta</b> &nbsp; ( Poli Umum )'
        ];

        $data['cardSubTitle'] = $data['records']->poli_nama;

        if($data['records']->poli_kode == 'KKPPOLMUM'){
            return view ($this->path.'.formPeriksa', $data);        
        }else{
            dd('Coming Soon');
        }
    }

    function storeFormPeriksa(Request $request, $psntrans_id){
        $post      = $request->input();
        $validator = Validator::make(
            $post,
            [
                'psnrekdis_sbj_kelutm' => 'required',
                'psnrekdis_sbj_keltam' => 'required'
            ],
            [
                'psnrekdis_sbj_kelutm.required' => 'Keluhan utama tidak boleh kosong',
                'psnrekdis_sbj_keltam.required' => 'Keluhan tambahan tidak boleh kosong'
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

            // start create data pasien rekamedis
            $frmPrk = [
                'psnrekdis_psntrans_id'    => Hashids::decode($psntrans_id)[0],
                'psnrekdis_sbj_kelutm'     => $post['psnrekdis_sbj_kelutm'],
                'psnrekdis_sbj_keltam'     => $post['psnrekdis_sbj_keltam'],
                'psnrekdis_sbj_riwpktskr'  => $post['psnrekdis_sbj_riwpktskr'],
                'psnrekdis_sbj_riwpktdhl'  => $post['psnrekdis_sbj_riwpktdhl'],
                'psnrekdis_sbj_riwpktklg'  => $post['psnrekdis_sbj_riwpktklg'],
                'psnrekdis_sbj_riwpktkalg' => $post['psnrekdis_sbj_riwpktkalg'],
                'psnrekdis_obj_vstd'       => $post['psnrekdis_obj_vstd'],
                'psnrekdis_obj_vshr'       => $post['psnrekdis_obj_vshr'],
                'psnrekdis_obj_vsrr'       => $post['psnrekdis_obj_vsrr'],
                'psnrekdis_obj_vst'        => $post['psnrekdis_obj_vst'],
                'psnrekdis_obj_sgbb'       => $post['psnrekdis_obj_sgbb'],
                'psnrekdis_obj_sgtb'       => $post['psnrekdis_obj_sgtb'],
                'psnrekdis_obj_sgimt'      => $post['psnrekdis_obj_sgimt'],
                'psnrekdis_asm_digkrt'     => $post['psnrekdis_asm_digkrt'],
                'psnrekdis_pln_rak'        => $post['psnrekdis_pln_rak'],
                'psnrekdis_created_by'     => Auth::user()->id,
                'psnrekdis_created_date'  => date('Y-m-d H:i:s'),
                'psnrekdis_ip'            => \Request::ip()
            ];

            PasienRekdis::create($frmPrk);
            // end create data pasien rekamedis

            // start update data pasien trans
            $psnTrans = [ 'pastrans_status' => '2' ];
            PasienTrans::where('psntrans_id', Hashids::decode($psntrans_id)[0])->update($psnTrans);
            // start update data pasien trans

            // start create log
            $psnLog = [
                'log_psntrans_id'  => Hashids::decode($psntrans_id)[0],
                'log_subjek'       => 'Pengecakan suster',
                'log_keterangan'   => 'Pasien telah dicek oleh suster',
                'log_created_by'   => Auth::user()->id,
                'log_created_date' => date('Y-m-d H:i:s'),
                'log_ip'           => \Request::ip()
            ];

            LogTrans::create($psnLog);
            // end create log

            DB::commit();

            $response['status']  = 1;
            $response['message'] = 'Data berhasil disimpan';
        } catch (\Exception $ex) {

            DB::rollback();

            $response['status']  = 0;
            $response['message'] = $ex->getMessage();
        }

        echo json_encode($response);
    }

    function formPeriksaDokter($psntrans_id){
        $data = [
            'pagetitle'    => 'Form Pemeriksaan',
            'cardTitle'    => 'Form Pemeriksaan',
            'cardSubTitle' => '&nbsp;',
            'cardIcon'     => 'flaticon2-list-3',
            'breadcrumb'   => [ 'index' => route( $this->route . '.index' ), 'Form Pemeriksaan' => route($this->route . '.formPeriksaDokter', ['psntrans_id' => $psntrans_id])],
            'route'        => $this->route,
            'psntrans_id'  => $psntrans_id,
            'records'      => PasienTrans::selectRaw('
                    pasien_norekdis,pasien_nama,pasien_tgllahir,pasien_umur,pasien_email,pasien_jk,pasien_telp,pasien_alamat,psnrekdis_id,psntrans_id,
                    psnrekdis_sbj_kelutm,psnrekdis_sbj_keltam,psnrekdis_sbj_riwpktskr,psnrekdis_sbj_riwpktdhl,psnrekdis_sbj_riwpktklg,psnrekdis_sbj_riwpktkalg,psnrekdis_asm_digkrt,psnrekdis_pln_rak,
                    psnrekdis_obj_vstd,psnrekdis_obj_vshr,psnrekdis_obj_vsrr,psnrekdis_obj_vst,psnrekdis_obj_sgbb,psnrekdis_obj_sgtb,psnrekdis_obj_sgimt,psnrekdis_obj_pfkpl,psnrekdis_obj_pflhr,psnrekdis_obj_pftcor,
                    psnrekdis_obj_pftpul,psnrekdis_obj_pfabd,psnrekdis_obj_pfeksats,psnrekdis_obj_pfeksbwh,rjksps_id,psnrekdis_is_lab
                ')
                ->leftJoin('kkp_pasien', 'pastrans_pasien_id', 'pasien_id')
                ->leftJoin('kkp_pasien_rekamedis', 'psntrans_id', 'psnrekdis_psntrans_id')
                ->leftJoin('kkp_rujukan_spesialis', 'psnrekdis_id', 'rjksps_psnrekdis_id')
                ->where('psntrans_id', Hashids::decode($psntrans_id)[0])
                ->first()
        ];

        $data['cekResep']   = PasienRekdis::leftJoin('kkp_resep_obat', 'psnrekdis_id', 'resep_psnrekdis_id')->where('psnrekdis_psntrans_id', Hashids::decode($psntrans_id)[0])->where('resep_id', '<>', NULL)->count();
        $data['cekRjkSps']  = PasienRekdis::leftJoin('kkp_rujukan_spesialis', 'psnrekdis_id', 'rjksps_psnrekdis_id')->where('psnrekdis_psntrans_id', Hashids::decode($psntrans_id)[0])->where('rjksps_id', '<>', NULL)->count();
        $data['cekRjkLab']  = $data['records']->psnrekdis_is_lab;
        $data['subHeadBtn'] = ' <button data-route="'. route( $this->route . ( $data['cekResep'] > 0 ? '.editFormResepDok' : '.showFormResepDok' ) ) .'" data-psnrekdisid="'.Hashids::encode($data['records']->psnrekdis_id).'" type="button" class="btn btn-outline-info btn-sm mr-3" data-toggle="modal" data-target="#formResepDoketer" onClick="return f_resepObat(this, event)"><i class="'. ( $data['cekResep'] > 0 ? 'flaticon-edit-1' : 'flaticon-background' ) .'"></i> '. ( $data['cekResep'] > 0 ? 'Edit Resep' : 'Form Resep Obat' ) .' </button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-warning btn-sm mr-3 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="flaticon2-map"></i> Rujukan
                                    </button>
                                    <div class="dropdown-menu">
                                        <button data-route="'. ( $data['cekRjkSps'] > 0 ? route( $this->route . '.editFormRujukanSpesialis', [ 'rjksps_id' => Hashids::encode($data['records']->rjksps_id) ]) : route( $this->route . '.showFormRujukanSpesialis') ) .'" data-psnrekdisid="'.Hashids::encode($data['records']->psnrekdis_id).'" data-toggle="modal" data-target="#formResepDoketer" onClick="return f_resepObat(this, event)" class="dropdown-item">'. ( $data['cekRjkSps'] > 0 ? 'Edit Rujukan Spesialis' : 'Rujukan Spesialis' ) .'</button>
                                        <button class="dropdown-item" onClick="return f_rujukLab(this, event)" data-route="'. route( $this->route . '.rukuanLab' ) .'" data-psnrekdisid="'.Hashids::encode($data['records']->psnrekdis_id).'">Rujukan Lab</button>
                                    </div>
                                </div>' . 
                                ( $data['cekResep'] > 0 || $data['cekRjkSps'] == 1 || $data['cekRjkLab'] == 1 
                                    ? '<button data-route="'. route( $this->route . '.selesaiDokter' ) .'" data-psntransid="'.Hashids::encode($data['records']->psntrans_id).'" onClick="return f_selesai(this, event)" type="button" class="btn btn-outline-success btn-sm mr-3"><i class="flaticon-tea-cup"></i> Selesai </button>' 
                                    : '' 
                                );

        return view ($this->path.'.formPeriksaDokter', $data);        
    }

    function updateFormDokter(Request $result, $psntrans_id){
        $post      = $result->input();
        $validator = Validator::make(
            $post,
            [
                'psnrekdis_sbj_kelutm' => 'required',
                'psnrekdis_sbj_keltam' => 'required'
            ],
            [
                'psnrekdis_sbj_kelutm.required' => 'Keluhan utama tidak boleh kosong',
                'psnrekdis_sbj_keltam.required' => 'Keluhan tambahan tidak boleh kosong'
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

            // start create data pasien rekamedis
            $frmPrk = [
                'psnrekdis_sbj_kelutm'     => $post['psnrekdis_sbj_kelutm'],
                'psnrekdis_sbj_keltam'     => $post['psnrekdis_sbj_keltam'],
                'psnrekdis_sbj_riwpktskr'  => $post['psnrekdis_sbj_riwpktskr'],
                'psnrekdis_sbj_riwpktdhl'  => $post['psnrekdis_sbj_riwpktdhl'],
                'psnrekdis_sbj_riwpktklg'  => $post['psnrekdis_sbj_riwpktklg'],
                'psnrekdis_sbj_riwpktkalg' => $post['psnrekdis_sbj_riwpktkalg'],
                'psnrekdis_obj_vstd'       => $post['psnrekdis_obj_vstd'],
                'psnrekdis_obj_vshr'       => $post['psnrekdis_obj_vshr'],
                'psnrekdis_obj_vsrr'       => $post['psnrekdis_obj_vsrr'],
                'psnrekdis_obj_vst'        => $post['psnrekdis_obj_vst'],
                'psnrekdis_obj_sgbb'       => $post['psnrekdis_obj_sgbb'],
                'psnrekdis_obj_sgtb'       => $post['psnrekdis_obj_sgtb'],
                'psnrekdis_obj_sgimt'      => $post['psnrekdis_obj_sgimt'],
                'psnrekdis_asm_digkrt'     => $post['psnrekdis_asm_digkrt'],
                'psnrekdis_pln_rak'        => $post['psnrekdis_pln_rak'],
                'psnrekdis_obj_pfkpl'      => $post['psnrekdis_obj_pfkpl'],
                'psnrekdis_obj_pflhr'      => $post['psnrekdis_obj_pflhr'],
                'psnrekdis_obj_pftcor'     => $post['psnrekdis_obj_pftcor'],
                'psnrekdis_obj_pftpul'     => $post['psnrekdis_obj_pftpul'],
                'psnrekdis_obj_pfabd'      => $post['psnrekdis_obj_pfabd'],
                'psnrekdis_obj_pfeksats'   => $post['psnrekdis_obj_pfeksats'],
                'psnrekdis_obj_pfeksbwh'   => $post['psnrekdis_obj_pfeksbwh']
            ];

            PasienRekdis::where('psnrekdis_psntrans_id', Hashids::decode($psntrans_id)[0])->update($frmPrk);
            // end create data pasien rekamedis

            // start create log
            $psnLog = [
                'log_psntrans_id'  => Hashids::decode($psntrans_id)[0],
                'log_subjek'       => 'Pengecakan Dokter',
                'log_keterangan'   => 'Pasien telah dicek oleh Dokter',
                'log_created_by'   => Auth::user()->id,
                'log_created_date' => date('Y-m-d H:i:s'),
                'log_ip'           => \Request::ip()
            ];

            LogTrans::create($psnLog);
            // end create log

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

    function showFormResepDok(Request $request){
        $post = $request->input();
        $data = [
            'modalTitle'   => 'Form Resep Obat',
            'route'        => $this->route,
            'psnrekdis_id' => $post['psnrekdisid']
        ];

        return view($this->path . '.formResepDokter', $data);
    }

    function cekStokObat(Request $request){
        $post    = $request->input();
        $getObat = Obat::selectRaw('obat_stok')->where('obat_id', $post['obat_id'])->first();
        $param   = [
            'message' => ( $getObat->obat_stok == 0 ? '*Stok habis' : '*Stok obat ' . $getObat->obat_stok ),
            'stok'    => $getObat->obat_stok
        ];

        echo json_encode($param);
    }

    function storeResepObat(Request $request, $psnrekdis_id){
        $post      = $request->input();
        $decode    = Hashids::decode($psnrekdis_id)[0];
        $validator = Validator::make( $post,[],[] );
        $getRekdis = PasienRekdis::select('psnrekdis_psntrans_id')->where('psnrekdis_id', $decode)->first();

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
            foreach ($post['resep_obat_id'] as $key => $value) {
                $resep = [
                    'resep_psnrekdis_id' => $decode,
                    'resep_obat_id'      => $post['resep_obat_id'][$key],
                    'resep_jumlah'       => $post['resep_jumlah'][$key],
                    'resep_keterangan'   => $post['resep_keterangan'][$key],
                    'resep_created_by'   => Auth::user()->id,
                    'resep_created_date' => date('Y-m-d H:i:s'),
                    'resep_ip'           => \Request::ip()
                ];
                
                $tempResp[] = $resep;

                // start update stok obat
                $getStok = Obat::selectRaw('obat_stok')->where('obat_id', $resep['resep_obat_id'])->first()->obat_stok;
                $kurang  = $getStok - $resep['resep_jumlah'];
                
                Obat::where('obat_id', $resep['resep_obat_id'])->update(['obat_stok' => $kurang]);
                // end update stok obat
            }

            ResepObat::insert($tempResp);

            // start create log
            $psnLog = [
                'log_psntrans_id'  => $getRekdis->psnrekdis_psntrans_id,
                'log_subjek'       => 'Resep Obat',
                'log_keterangan'   => 'Dokter telah membuat resep obat untuk pasien',
                'log_created_by'   => Auth::user()->id,
                'log_created_date' => date('Y-m-d H:i:s'),
                'log_ip'           => \Request::ip()
            ];

            LogTrans::create($psnLog);
            // end create log

            DB::commit();

            $response['status']  = 1;
            $response['message'] = 'Resep obat berhasil disimpan';
        } catch (\Exception $ex) {
            DB::rollback();

            $response['status']  = 0;
            $response['message'] = $ex->getMessage();
        }

        echo json_encode($response);       
    }

    function editFormResepDok(Request $request){
        $post = $request->input();
        $data = [
            'modalTitle'   => 'Edit Resep Obat',
            'route'        => $this->route,
            'psnrekdis_id' => $post['psnrekdisid'],
            'records'      => PasienRekdis::selectRaw('obat_id,obat_nama,obat_stok,resep_id,resep_jumlah,resep_keterangan')
                ->leftJoin('kkp_resep_obat', 'psnrekdis_id', 'resep_psnrekdis_id')
                ->leftJoin('kkp_obat', 'resep_obat_id', 'obat_id')
                ->where('psnrekdis_id', Hashids::decode($post['psnrekdisid'])[0])
                ->get()
        ];

        return view($this->path . '.editFormResep', $data);
    }

    function updateResepObat(Request $request, $psnrekdis_id){
        $post      = $request->input();
        $decode    = Hashids::decode($psnrekdis_id)[0];
        $validator = Validator::make( $post,[],[] );
        $getRekdis = PasienRekdis::select('psnrekdis_psntrans_id')->where('psnrekdis_id', $decode)->first();

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
            
            foreach ($post['resep_obat_id'] as $key => $value) {
                $rspId      = $post['resep_id'][$key];
                $tmpRspId[] = $post['resep_id'][$key];
                
                if(!empty($rspId)){
                    $dbResep = ResepObat::selectRaw('resep_obat_id,resep_jumlah')->where('resep_id', $rspId)->first();

                    if($dbResep->resep_obat_id != $post['resep_obat_id'][$key]){
                        // start delete dan update obat
                        $getStok = Obat::selectRaw('obat_stok')->where('obat_id', $dbResep->resep_obat_id)->first()->obat_stok;
                        $tambah  = $getStok + $dbResep->resep_jumlah;
                        
                        Obat::where('obat_id', $dbResep->resep_obat_id)->update(['obat_stok' => $tambah]);
                        ResepObat::where('resep_id', $rspId)->delete();
                        // end delete dan update obat

                        // start update obat yang baru diinput
                        $resep = [
                            'resep_psnrekdis_id' => $decode,
                            'resep_obat_id'      => $post['resep_obat_id'][$key],
                            'resep_jumlah'       => $post['resep_jumlah'][$key],
                            'resep_keterangan'   => $post['resep_keterangan'][$key],
                            'resep_created_by'   => Auth::user()->id,
                            'resep_created_date' => date('Y-m-d H:i:s'),
                            'resep_ip'           => \Request::ip()
                        ];
                        
                        $tempResp[] = $resep;
    
                        $getStok2 = Obat::selectRaw('obat_stok')->where('obat_id', $resep['resep_obat_id'])->first()->obat_stok;
                        $kurang   = $getStok2 - $resep['resep_jumlah'];
                        
                        Obat::where('obat_id', $resep['resep_obat_id'])->update(['obat_stok' => $kurang]);
                        // end update obat yang baru diinput
                    }else{
                        $getStok = Obat::selectRaw('obat_stok')->where('obat_id', $post['resep_obat_id'][$key])->first()->obat_stok;
                        $iptStok = $post['resep_jumlah'][$key];
                        $finStok = ( ( $dbResep->resep_jumlah + $getStok ) - $iptStok);
                        $uptRsp  = [
                            'resep_obat_id'    => $post['resep_obat_id'][$key],
                            'resep_jumlah'     => $post['resep_jumlah'][$key],
                            'resep_keterangan' => $post['resep_keterangan'][$key],
                            'resep_updated_by' => Auth::user()->id
                        ];

                        ResepObat::where('resep_id', $rspId)->update($uptRsp);
                        Obat::where('obat_id', $post['resep_obat_id'][$key])->update(['obat_stok' => $finStok]);
                    }
                }else{
                    $resep = [
                        'resep_psnrekdis_id' => $decode,
                        'resep_obat_id'      => $post['resep_obat_id'][$key],
                        'resep_jumlah'       => $post['resep_jumlah'][$key],
                        'resep_keterangan'   => $post['resep_keterangan'][$key],
                        'resep_created_by'   => Auth::user()->id,
                        'resep_created_date' => date('Y-m-d H:i:s'),
                        'resep_ip'           => \Request::ip()
                    ];
                    
                    $tempResp[] = $resep;

                    // start update stok obat
                    $getStok = Obat::selectRaw('obat_stok')->where('obat_id', $resep['resep_obat_id'])->first()->obat_stok;
                    $kurang  = $getStok - $resep['resep_jumlah'];
                    
                    Obat::where('obat_id', $resep['resep_obat_id'])->update(['obat_stok' => $kurang]);
                    // end update stok obat
                }
            }

            if(!empty($tempResp)){
                ResepObat::insert($tempResp);
            }else{
                $getData = ResepObat::selectRaw('resep_id,resep_jumlah,resep_obat_id')->whereNotIn('resep_id', $tmpRspId)->get();

                if($getData->isNotEmpty()){
                    foreach ($getData as $delResep) {
                        $tempDlt[] = $delResep->resep_id;

                        // start update stok obat
                        $getStok = Obat::selectRaw('obat_stok')->where('obat_id', $delResep->resep_obat_id)->first()->obat_stok;
                        $tambah  = $getStok + $delResep->resep_jumlah;
                        
                        Obat::where('obat_id', $delResep->resep_obat_id)->update(['obat_stok' => $tambah]);
                        // end update stok obat
                    }

                    ResepObat::whereIn('resep_id', $tempDlt)->delete();
                }
            }

            DB::commit();

            $response['status']  = 1;
            $response['message'] = 'Resep obat berhasil disimpan';
        } catch (\Exception $ex) {
            DB::rollback();

            $response['status']  = 0;
            $response['message'] = $ex->getMessage();
        }

        echo json_encode($response);       
    }

    function showFormRujukanSpesialis(Request $request){
        $post = $request->input();
        $data = [
            'modalTitle'   => 'Form Rujukan Spesialis',
            'route'        => $this->route,
            'psnrekdis_id' => $post['psnrekdisid']
        ];

        return view($this->path . '.Rujukan.showFormRujSps', $data);
    }

    function storeFormRjkSps(Request $request, $psnrekdis_id){
        $post      = $request->input();
        $decode    = Hashids::decode($psnrekdis_id)[0];
        $validator = Validator::make(
            $post,
            [
                'rjksps_dokter_id'  => 'required',
                'rjksps_rs'         => 'required',
                'rjksps_keluhan'    => 'required',
                'rjksps_ssb'        => 'required',
                'rjksps_keterangan' => 'required'
            ],
            [
                'rjksps_dokter_id.required'  => 'Dokter tidak boleh kosong',
                'rjksps_rs.required'         => 'Rumah sakit / Jalan tidak boleh kosong',
                'rjksps_keluhan.required'    => 'Keluhan tidak boleh kosong',
                'rjksps_ssb.required'        => 'Sudah saya berikan tidak boleh kosong',
                'rjksps_keterangan.required' => 'Keterangan tambahan tidak boleh kosong'
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
            $post['rjksps_psnrekdis_id'] = $decode;
            $post['rjksps_created_by']   = Auth::user()->id;
            $post['rjksps_created_date'] = date('Y-m-d H:i:s');
            $post['rjksps_ip']           = \Request::ip();

            RujukanSpesialis::create($post);

            DB::commit();

            $response['status']  = 1;
            $response['message'] = 'Data rujukan spesialis berhasil disimpan';
        } catch (\Exception $ex) {
            DB::rollback();

            $response['status']  = 0;
            $response['message'] = $ex->getMessage();
        }

        echo json_encode($response);    
    }

    function editFormRujukanSpesialis(Request $request, $rjksps_id){
        $post = $request->input();
        $decd = Hashids::decode($rjksps_id)[0];
        $data = [
            'modalTitle'   => 'Edit Form Rujukan Spesialis',
            'route'        => $this->route,
            'rjksps_id'    => $rjksps_id,
            'records'      => RujukanSpesialis::selectRaw('users.id,users.name,rjksps_rs,rjksps_keluhan,rjksps_ssb,rjksps_keterangan')
                ->leftJoin('users', 'rjksps_dokter_id', 'users.id')
                ->where('rjksps_id', $decd)
                ->first()
        ];

        return view($this->path . '.Rujukan.editFormRujSps', $data);
    }

    function updateFormRjkSps(Request $request, $rjksps_id){
        $post      = $request->input();
        $decode    = Hashids::decode($rjksps_id)[0];
        $validator = Validator::make(
            $post,
            [
                'rjksps_dokter_id'  => 'required',
                'rjksps_rs'         => 'required',
                'rjksps_keluhan'    => 'required',
                'rjksps_ssb'        => 'required',
                'rjksps_keterangan' => 'required'
            ],
            [
                'rjksps_dokter_id.required'  => 'Dokter tidak boleh kosong',
                'rjksps_rs.required'         => 'Rumah sakit / Jalan tidak boleh kosong',
                'rjksps_keluhan.required'    => 'Keluhan tidak boleh kosong',
                'rjksps_ssb.required'        => 'Sudah saya berikan tidak boleh kosong',
                'rjksps_keterangan.required' => 'Keterangan tambahan tidak boleh kosong'
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
            $post['rjksps_updated_by'] = Auth::user()->id;

            RujukanSpesialis::where('rjksps_id', $decode)->update($post);

            DB::commit();

            $response['status']  = 1;
            $response['message'] = 'Data rujukan spesialis berhasil diupdate';
        } catch (\Exception $ex) {
            DB::rollback();

            $response['status']  = 0;
            $response['message'] = $ex->getMessage();
        }

        echo json_encode($response);    
    }

    function showFormRujukanLab(Request $request){
        $post = $request->input();
        $data = [
            'modalTitle'   => 'Form Rujukan Lab',
            'route'        => $this->route,
            'psnrekdis_id' => $post['psnrekdisid']
        ];

        return view($this->path . '.Rujukan.showFormRujLab', $data);
    }

    function storeFormRjkLab(Request $request, $psnrekdis_id){
        $post      = $request->input();
        $decode    = Hashids::decode($psnrekdis_id)[0];
        $validator = Validator::make($post,[],[]);

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
            $rjkLab['rjklab_psnrekdis_id'] = $decode;
            $rjkLab['rjklab_htg_rutin']    = ($request->has('rjklab_htg_rutin') == true ? '1' : '0');
            $rjkLab['rjklab_htg_lekosit']  = ($request->has('rjklab_htg_lekosit') == true ? '1' : '0');
            $rjkLab['rjklab_htg_dc']       = ($request->has('rjklab_htg_dc') == true ? '1' : '0');

            $rjkLab['rjklab_created_by']   = Auth::user()->id;
            $rjkLab['rjklab_created_date'] = date('Y-m-d H:i:s');
            $rjkLab['rjklab_ip']           = \Request::ip();

            RujukanLab::create($rjkLab);

            DB::commit();

            $response['status']  = 1;
            $response['message'] = 'Form Rujukan Lab berhasil disimpan';
        } catch (\Exception $ex) {
            DB::rollback();

            $response['status']  = 0;
            $response['message'] = $ex->getMessage();
        }

        echo json_encode($response);    
    }

    function rukuanLab(Request $request){
        $post = $request->input();
        $decd = Hashids::decode($post['psnrekdis_id'])[0];

        DB::beginTransaction();

        try {
            PasienRekdis::where('psnrekdis_id', $decd)->update(['psnrekdis_is_lab' => '1']);

            // start create log
            $psnLog = [
                'log_psntrans_id'  => PasienRekdis::selectRaw('psnrekdis_psntrans_id')->where('psnrekdis_id', $decd)->first()->psnrekdis_psntrans_id,
                'log_subjek'       => 'Rujukan Laboratorium',
                'log_keterangan'   => 'Dokter telah merujuk pasien ke bagian laboratorium',
                'log_created_by'   => Auth::user()->id,
                'log_created_date' => date('Y-m-d H:i:s'),
                'log_ip'           => \Request::ip()
            ];

            LogTrans::create($psnLog);
            // end create log

            DB::commit();

            $response['status']  = 1;
            $response['message'] = 'Pasien berhasil dirujuk ke bagian Laboratorium';
        } catch (\Exception $ex) {
            DB::rollback();

            $response['status']  = 0;
            $response['message'] = $ex->getMessage();
        }

        echo json_encode($response);    
    }

    function selesaiDokter(Request $request){
        $post = $request->input();
        $decd = Hashids::decode($post['psntrans_id'])[0];

        DB::beginTransaction();

        try {
            PasienTrans::where('psntrans_id', $decd)->update(['pastrans_status' => '3']);

            // start create log
            $psnLog = [
                'log_psntrans_id'  => $decd,
                'log_subjek'       => 'Rujukan Laboratorium',
                'log_keterangan'   => 'Dokter telah merujuk pasien ke bagian laboratorium',
                'log_created_by'   => Auth::user()->id,
                'log_created_date' => date('Y-m-d H:i:s'),
                'log_ip'           => \Request::ip()
            ];

            LogTrans::create($psnLog);
            // end create log

            DB::commit();

            $response['status']  = 1;
            $response['message'] = 'Data berhasil diupdate';
            $response['cus_url'] = route( $this->route . '.index' );
        } catch (\Exception $ex) {
            DB::rollback();

            $response['status']  = 0;
            $response['message'] = $ex->getMessage();
        }

        echo json_encode($response);    
    }

}
