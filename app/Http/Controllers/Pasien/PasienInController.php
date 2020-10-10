<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\RujukanSpesialis;
use Illuminate\Http\Request;
use App\Models\PasienRekdis;
use Illuminate\Support\Arr;
use App\Models\PasienTrans;
use App\Models\SuratSakit;
use App\Models\SuratSehat;
use App\Models\RujukanLab;
use App\Models\Odontogram;
use App\Models\Radiologi;
use App\Models\ResepNote;
use App\Models\ResepObat;
use App\Models\LogTrans;
use App\Models\Pasien;
use App\Models\Modon;
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
                $button = ' <div class="dropdown dropdown-inline">    
                                <a href="'. route( 'pasieninfo.index', [ 'psntrans_id' => Hashids::encode($value->psntrans_id) ] ) .'" class="btn btn-icon btn-clean btn-sm mr-2 ajaxify" data-toggle="tooltip" data-theme="dark" title="Detail Pasien"><i class="flaticon-information text-primary icon-xl"></i></a>
                            </div>';
            }else if( Auth::user()->role_kode == 'KKPSTR' ){
                $button = '<div class="dropdown dropdown-inline">' .
                                ( $value->pastrans_status == '1'
                                    ? '<a href="'. route( $this->route . '.formPeriksa', ['psntrans_id' => Hashids::encode($value->psntrans_id)] ) .'" class="btn btn-icon btn-clean btn-sm mr-2 ajaxify" data-toggle="tooltip" data-theme="dark" title="Pemeriksaan Pasien"><i class="flaticon-statistics text-warning icon-xl"></i></a>'
                                    : '<a href="'. route( 'pasieninfo.index', [ 'psntrans_id' => Hashids::encode($value->psntrans_id) ] ) .'" class="btn btn-icon btn-clean btn-sm mr-2 ajaxify" data-toggle="tooltip" data-theme="dark" title="Detail Pasien"><i class="flaticon-information text-primary icon-xl"></i></a>' 
                                ) .
                           '</div>';
            }else if( Auth::user()->role_kode == 'KKPDKT' ) {
                $button = '<div class="dropdown dropdown-inline">' .
                                ( $value->pastrans_status != '99'
                                    ? '<a href="'. route( $this->route . '.formPeriksaDokter', ['psntrans_id' => Hashids::encode($value->psntrans_id)] ) .'" class="btn btn-icon btn-clean btn-sm mr-2 ajaxify" data-toggle="tooltip" data-theme="dark" title="Pemeriksaan Pasien"><i class="flaticon-statistics text-danger icon-xl"></i></a>'
                                    : '<a href="'. route( 'pasieninfo.index', [ 'psntrans_id' => Hashids::encode($value->psntrans_id) ] ) .'" class="btn btn-icon btn-clean btn-sm mr-2 ajaxify" data-toggle="tooltip" data-theme="dark" title="Detail Pasien"><i class="flaticon-information text-primary icon-xl"></i></a>'
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
                ->first()
        ];

        $data['cardSubTitle'] = $data['records']->poli_nama;
        $data['kodePoli']     = $data['records']->poli_kode;

        // if($data['records']->poli_kode == 'KKPPOLMUM'){
        return view ($this->path.'.formPeriksa', $data);
        // }else{
        //     dd('Coming Soon');
        // }
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
            if($post['kodepoli'] == 'KKPPOLGG'){
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
                    'psnrekdis_created_by'     => Auth::user()->id,
                    'psnrekdis_created_date'   => date('Y-m-d H:i:s'),
                    'psnrekdis_ip'             => \Request::ip()
                ];
            }else{
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
                    'psnrekdis_created_date'   => date('Y-m-d H:i:s'),
                    'psnrekdis_ip'             => \Request::ip()
                ];
            }

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
                    pasien_id,pasien_norekdis,pasien_nama,pasien_tgllahir,pasien_umur,pasien_email,pasien_jk,pasien_telp,pasien_alamat,psnrekdis_id,psntrans_id,
                    psnrekdis_sbj_kelutm,psnrekdis_sbj_keltam,psnrekdis_sbj_riwpktskr,psnrekdis_sbj_riwpktdhl,psnrekdis_sbj_riwpktklg,psnrekdis_sbj_riwpktkalg,psnrekdis_asm_digkrt,psnrekdis_pln_rak,
                    psnrekdis_obj_vstd,psnrekdis_obj_vshr,psnrekdis_obj_vsrr,psnrekdis_obj_vst,psnrekdis_obj_sgbb,psnrekdis_obj_sgtb,psnrekdis_obj_sgimt,psnrekdis_obj_pfkpl,psnrekdis_obj_pflhr,psnrekdis_obj_pftcor,
                    psnrekdis_obj_pftpul,psnrekdis_obj_pfabd,psnrekdis_obj_pfeksats,psnrekdis_obj_pfeksbwh,rjksps_id,users.name AS nama_dokter,kpol.poli_nama,pastrans_flag,kpol.poli_kode,rjklab_id,radio_id,
                    sskt_id,ssht_id
                ')
                ->leftJoin('kkp_pasien', 'pastrans_pasien_id', 'pasien_id')
                ->leftJoin('kkp_pasien_rekamedis', 'psntrans_id', 'psnrekdis_psntrans_id')
                ->leftJoin('kkp_rujukan_spesialis', 'psnrekdis_id', 'rjksps_psnrekdis_id')
                ->leftJoin('users','pastrans_dokter_id','users.id')
                ->leftJoin('kkp_poli AS kpol','users.poli_id','kpol.poli_id')
                ->leftJoin('kkp_rujukan_lab','rjklab_psnrekdis_id','psnrekdis_id')
                ->leftJoin('kkp_radiologi','radio_psnrekdis_id','psnrekdis_id')
                ->leftJoin('kkp_surat_sakit','sskt_psnrekdis_id','psnrekdis_id')
                ->leftJoin('kkp_surat_sehat','ssht_psnrekdis_id','psnrekdis_id')
                ->where('psntrans_id', Hashids::decode($psntrans_id)[0])
                ->first()
        ];

        $data['cekResep']   = PasienRekdis::leftJoin('kkp_resep_obat', 'psnrekdis_id', 'resep_psnrekdis_id')->where('psnrekdis_psntrans_id', Hashids::decode($psntrans_id)[0])->where('resep_id', '<>', NULL)->count();
        $data['cekRjkSps']  = PasienRekdis::leftJoin('kkp_rujukan_spesialis', 'psnrekdis_id', 'rjksps_psnrekdis_id')->where('psnrekdis_psntrans_id', Hashids::decode($psntrans_id)[0])->where('rjksps_id', '<>', NULL)->count();
        $data['subHeadBtn'] = ' <button data-route="'. route( $this->route . ( $data['cekResep'] > 0 ? '.editFormResepDok' : '.showFormResepDok' ) ) .'" data-psnrekdisid="'.Hashids::encode($data['records']->psnrekdis_id).'" type="button" class="btn btn-outline-primary btn-sm mr-3" data-toggle="modal" data-target="#formResepDoketer" onClick="return f_resepObat(this, event)"><i class="'. ( $data['cekResep'] > 0 ? 'flaticon-edit-1' : 'flaticon-background' ) .'"></i> '. ( $data['cekResep'] > 0 ? 'Edit Resep' : 'Form Resep Obat' ) .' </button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-'. ( $data['records']->pastrans_flag == 3 || $data['records']->pastrans_flag == 2 ? "warning" : "primary" ) .' btn-sm mr-3 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="flaticon2-map"></i> Pemeriksaan Penunjang
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="'. route( $this->route . '.formRadiologi', [ 'radioid' => Hashids::encode($data['records']->radio_id) ] ) .'" class="dropdown-item asideInfoPasien" data-transid="'.Hashids::encode($data['records']->psnrekdis_id).'">'.( !empty($data['records']->radio_id) ? "Edit Form Radiologi" : "Form Radiologi" ).'</a>
                                        <a href="'. route( $this->route . '.formLabInternal', [ 'labid' => Hashids::encode($data['records']->rjklab_id) ] ) .'" class="dropdown-item asideInfoPasien" data-transid="'.Hashids::encode($data['records']->psnrekdis_id).'"> '.  ( !empty($data['records']->rjklab_id) ? "Edit Form Lab Internal" : "Form Lab Internal" ) .'</a>
                                        <button class="dropdown-item" data-route="" data-psnrekdisid="'.Hashids::encode($data['records']->psnrekdis_id).'">Form Lab External</button>
                                    </div>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-primary btn-sm mr-3 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="flaticon-map"></i> Konsultasi Internal
                                    </button>
                                    <div class="dropdown-menu">
                                        <button class="dropdown-item" data-route="" data-psnrekdisid="'.Hashids::encode($data['records']->psnrekdis_id).'">Poli Gigi</button>
                                        <button class="dropdown-item" data-route="" data-psnrekdisid="'.Hashids::encode($data['records']->psnrekdis_id).'">Poli Umum</button>
                                        <button class="dropdown-item" data-route="" data-psnrekdisid="'.Hashids::encode($data['records']->psnrekdis_id).'">Spesialis</button>
                                    </div>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-'. ( empty($data['records']->rjksps_id) ? 'primary' : 'warning' ) .' btn-sm mr-3 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="flaticon2-start-up"></i> Pengantar
                                    </button>
                                    <div class="dropdown-menu">
                                        <button data-route="'. ( $data['cekRjkSps'] > 0 ? route( $this->route . '.editFormRujukanSpesialis', [ 'rjksps_id' => Hashids::encode($data['records']->rjksps_id) ]) : route( $this->route . '.showFormRujukanSpesialis') ) .'" data-psnrekdisid="'.Hashids::encode($data['records']->psnrekdis_id).'" data-toggle="modal" data-target="#formResepDoketer" onClick="return f_resepObat(this, event)" class="dropdown-item">'. ( $data['cekRjkSps'] > 0 ? 'Edit Spesialis' : 'Spesialis' ) .'</button>
                                        <button class="dropdown-item" data-route="" data-psnrekdisid="'.Hashids::encode($data['records']->psnrekdis_id).'">Rumah Sakit</button>
                                    </div>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-'. ( !empty($data['records']->sskt_id) || !empty($data['records']->ssht_id)  ? 'warning' : 'primary' ) .' btn-sm mr-3 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="flaticon-mail-1"></i> Surat Keterangan
                                    </button>
                                    <div class="dropdown-menu">
                                        <button data-route="'. route($this->route . '.showFormSuratSakit') .'" data-psnrekdisid="'.Hashids::encode($data['records']->psnrekdis_id).'" data-toggle="modal" data-target="#formResepDoketer" onClick="return f_resepObat(this, event)" class="dropdown-item"> '. ( !empty($data['records']->sskt_id) ? 'Edit Surat Sakit' : 'Surat Sakit' ) . ' </button>
                                        <button data-route="'. route($this->route . '.showFormSuratSehat') .'" data-psnrekdisid="'.Hashids::encode($data['records']->psnrekdis_id).'" data-toggle="modal" data-target="#formResepDoketer" onClick="return f_resepObat(this, event)" class="dropdown-item"> '. ( !empty($data['records']->ssht_id) ? 'Edit Surat Sehat' : 'Surat Sehat' ) . ' </button>
                                    </div>
                                </div>' . 
                                ( $data['records']->pastrans_flag != ''
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
            if($post['poli_kode'] == 'KKPPOLGG'){
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
                    'psnrekdis_obj_vst'        => $post['psnrekdis_obj_vst']
                ];
            }else{
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
            }

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

            $dataNote = [
                'resnote_psnrekdis_id' => $decode,
                'resnote_keterangan'   => $post['resnote_keterangan']
            ];

            ResepNote::create($dataNote);

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

            // start update status obat
            PasienRekdis::where('psnrekdis_id', $decode)->update(['psnrekdis_resep_status' => '1']);
            // end update status obat

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
                ->get(),
            'rspNote'      => ResepNote::select('resnote_keterangan')->where('resnote_psnrekdis_id', Hashids::decode($post['psnrekdisid'])[0])->first()
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

            ResepNote::where('resnote_psnrekdis_id', $decode)
                ->update(['resnote_keterangan' => $post['resnote_keterangan']]);

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

    function showFormSuratSakit(Request $request){
        $post = $request->input();
        $decd = Hashids::decode($post['psnrekdisid'])[0];
        $data = [
            'modalTitle'   => 'Form Surat Keterangan Sakit',
            'route'        => $this->route,
            'psnrekdis_id' => $post['psnrekdisid'],
            'records'      => SuratSakit::selectRaw('sskt_psnrekdis_id,sskt_tgl_mulai,sskt_tgl_akhir,sskt_jmlhari')
                ->where('sskt_psnrekdis_id', $decd)
                ->first()
        ];

        return view($this->path . '.SuratKeterangan.showFormSuratSakit', $data);
    }

    function storeFormSuratSakit(Request $request, $psnrekdis_id){
        $post     = $request->input();
        $decd     = Hashids::decode($psnrekdis_id)[0];
        $getTrans = PasienRekdis::select('psnrekdis_psntrans_id')->where('psnrekdis_id', $decd)->first();

        $validator = Validator::make(
            $post,
            [
                'sskt_tgl_mulai' => 'required',
                'sskt_tgl_akhir' => 'required',
                'sskt_jmlhari'   => 'required'
            ],
            [
                'sskt_tgl_mulai.required' => 'Tanggal mulai tidak boleh kosong',
                'sskt_tgl_akhir.required' => 'Tanggal akhir tidak boleh kosong',
                'sskt_jmlhari.required'   => 'Jumlah hari tidak boleh kosong'
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
            $data = [
                'sskt_psnrekdis_id' => $decd,
                'sskt_tgl_mulai'    => date('Y-m-d', strtotime($post['sskt_tgl_mulai'])),
                'sskt_tgl_akhir'    => date('Y-m-d', strtotime($post['sskt_tgl_akhir'])),
                'sskt_jmlhari'      => $post['sskt_jmlhari'],
                'sskt_created_by'   => Auth::user()->id,
                'sskt_created_date' => date('Y-m-d H:i:s'),
                'sskt_ip'           => \Request::ip()
            ];

            if($post['sskt_psnrekdis_id'] == ''){
                SuratSakit::create($data);
            }else{
                SuratSakit::where('sskt_psnrekdis_id', $decd)->update($data);
            }

            PasienTrans::where('psntrans_id', $getTrans->psnrekdis_psntrans_id)->update(['pastrans_flag' => '10']);

            // start input log transaksi
            $logTrans = [
                'log_psntrans_id'  => $getTrans->psnrekdis_psntrans_id,
                'log_subjek'       => 'Surat Keterangan Sakit',
                'log_keterangan'   => 'Dokter telah membuat surat keterangan Sakit',
                'log_created_by'   => Auth::user()->id,
                'log_created_date' => date('Y-m-d H:i:s'),
                'log_ip'           => \Request::ip()
            ];

            LogTrans::create($logTrans);
            // end input log transaksi

            DB::commit();

            $response['status']  = 1;
            $response['message'] = ( $post['sskt_psnrekdis_id'] == '' ? 'Surat keterangan sakit berhasil dibuat' : 'Surat keterangan sakit berhasil diedit' );

        } catch (\Exception $ex) {
            DB::rollback();

            $response['status']  = 0;
            $response['message'] = $ex->getMessage();
        }

        echo json_encode($response);  
    }

    function showFormSuratSehat(Request $request){
        $post = $request->input();
        $decd = Hashids::decode($post['psnrekdisid'])[0];
        $data = [
            'modalTitle'   => 'Form Surat Keterangan Sehat',
            'route'        => $this->route,
            'psnrekdis_id' => $post['psnrekdisid'],
            'records'      => SuratSehat::selectRaw('ssht_psnrekdis_id,ssht_keperluan,ssht_keterangan')
                ->where('ssht_psnrekdis_id', $decd)
                ->first()
        ];

        return view($this->path . '.SuratKeterangan.showFormSuratSehat', $data);
    }

    function storeFormSuratSehat(Request $request, $psnrekdis_id){
        $post     = $request->input();
        $decd     = Hashids::decode($psnrekdis_id)[0];
        $getTrans = PasienRekdis::select('psnrekdis_psntrans_id')->where('psnrekdis_id', $decd)->first();

        $validator = Validator::make(
            $post,
            [ 'ssht_keperluan' => 'required' ],
            [ 'ssht_keperluan.required' => 'Tanggal mulai tidak boleh kosong' ]
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
            $data = [
                'ssht_psnrekdis_id' => $decd,
                'ssht_keperluan'    => $post['ssht_keperluan'],
                'ssht_keterangan'   => ( $post['ssht_keperluan'] == '4' ? $post['ssht_keterangan'] : NULL ),
                'ssht_created_by'   => Auth::user()->id,
                'ssht_created_date' => date('Y-m-d H:i:s'),
                'ssht_ip'           => \Request::ip()
            ];

            if($post['ssht_psnrekdis_id'] == ''){
                SuratSehat::create($data);
            }else{
                SuratSehat::where('ssht_psnrekdis_id', $decd)->update($data);
            }

            PasienTrans::where('psntrans_id', $getTrans->psnrekdis_psntrans_id)->update(['pastrans_flag' => '11']);

            // start input log transaksi
            $logTrans = [
                'log_psntrans_id'  => $getTrans->psnrekdis_psntrans_id,
                'log_subjek'       => 'Surat Keterangan Sehat',
                'log_keterangan'   => 'Dokter telah membuat surat keterangan Sehat',
                'log_created_by'   => Auth::user()->id,
                'log_created_date' => date('Y-m-d H:i:s'),
                'log_ip'           => \Request::ip()
            ];

            LogTrans::create($logTrans);
            // end input log transaksi

            DB::commit();

            $response['status']  = 1;
            $response['message'] = ( $post['ssht_psnrekdis_id'] == '' ? 'Surat keterangan sehat berhasil dibuat' : 'Surat keterangan sehat berhasil diedit' );

        } catch (\Exception $ex) {
            DB::rollback();

            $response['status']  = 0;
            $response['message'] = $ex->getMessage();
        }

        echo json_encode($response);  
    }

    function formLabInternal(Request $request, $labid = null){
        $post = $request->input();
        $data = [
            'cardTitle'    => 'Form Lab Internal',
            'cardSubTitle' => '&nbsp;',
            'cardIcon'     => 'flaticon2-medical-records',
            'route'        => $this->route,
            'labid'        => $labid,
            'records'      => PasienRekdis::selectRaw('pasien_nama,pasien_umur,pasien_norekdis,uker_nama,pasien_jk,pasien_alamat,dok.name AS dokter_nama,golongan_nama,pasien_telp,psnrekdis_id')
                ->where('psnrekdis_id', Hashids::decode($post['transid'])[0])
                ->leftJoin('kkp_pasien_trans','psnrekdis_psntrans_id','psntrans_id')
                ->leftJoin('kkp_pasien','pastrans_pasien_id','pasien_id')
                ->leftJoin('kkp_unit_kerja','pasien_uker_id','uker_id')
                ->leftJoin('users AS dok','pastrans_dokter_id','dok.id')
                ->leftJoin('kkp_golongan','pasien_golongan_id','golongan_id')
                ->first()
        ];

        if(!empty($labid)){
            $data['labs'] = RujukanLab::selectRaw('*')
                ->where('rjklab_id', Hashids::decode($labid)[0])
                ->first();
        }else{
            $data['labs'] = [];
        }

        return view($this->path . '.PemeriksaanPenunjang.formLabInternal', $data);
    }

    function storeFormLabInternal(Request $request, $psnrekdis_id){
        $post      = $request->input();
        $decode    = Hashids::decode($psnrekdis_id)[0];
        $validator = Validator::make($post,[],[]);
        $getTrans  = PasienRekdis::select('psnrekdis_psntrans_id')->where('psnrekdis_id', $decode)->first()->psnrekdis_psntrans_id;

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
            $rjkLab['rjklab_psnrekdis_id']    = $decode;
            $rjkLab['rjklab_diagnosa']        = $post['rjklab_diagnosa'];
            $rjkLab['rjklab_htg_rutin']       = ($request->has('rjklab_htg_rutin') == true ? '1' : '0');
            $rjkLab['rjklab_htg_lekosit']     = ($request->has('rjklab_htg_lekosit') == true ? '1' : '0');
            $rjkLab['rjklab_htg_dc']          = ($request->has('rjklab_htg_dc') == true ? '1' : '0');
            $rjkLab['rjklab_htg_hb']          = ($request->has('rjklab_htg_hb') == true ? '1' : '0');
            $rjkLab['rjklab_htg_trombosit']   = ($request->has('rjklab_htg_trombosit') == true ? '1' : '0');
            $rjkLab['rjklab_htg_gd']          = ($request->has('rjklab_htg_gd') == true ? '1' : '0');
            $rjkLab['rjklab_htg_hematokrit']  = ($request->has('rjklab_htg_hematokrit') == true ? '1' : '0');
            $rjkLab['rjklab_htg_led']         = ($request->has('rjklab_htg_led') == true ? '1' : '0');
            $rjkLab['rjklab_htg_rhesus']      = ($request->has('rjklab_htg_dc') == true ? '1' : '0');
            $rjkLab['rjklab_htg_eritrosit']   = ($request->has('rjklab_htg_eritrosit') == true ? '1' : '0');
            $rjkLab['rjklab_htg_mmm']         = ($request->has('rjklab_htg_mmm') == true ? '1' : '0');
            $rjkLab['rjklab_kk_ld_kt']        = ($request->has('rjklab_kk_ld_kt') == true ? '1' : '0');
            $rjkLab['rjklab_kk_fh_ast']       = ($request->has('rjklab_kk_fh_ast') == true ? '1' : '0');
            $rjkLab['rjklab_kk_fg_ureum']     = ($request->has('rjklab_kk_fg_ureum') == true ? '1' : '0');
            $rjkLab['rjklab_kk_gd_gds']       = ($request->has('rjklab_kk_gd_gds') == true ? '1' : '0');
            $rjkLab['rjklab_kk_ld_kh']        = ($request->has('rjklab_kk_ld_kh') == true ? '1' : '0');
            $rjkLab['rjklab_kk_fh_alt']       = ($request->has('rjklab_kk_fh_alt') == true ? '1' : '0');
            $rjkLab['rjklab_kk_fg_kreatinin'] = ($request->has('rjklab_kk_fg_kreatinin') == true ? '1' : '0');
            $rjkLab['rjklab_kk_gd_gdp']       = ($request->has('rjklab_kk_gd_gdp') == true ? '1' : '0');
            $rjkLab['rjklab_kk_ld_kl']        = ($request->has('rjklab_kk_ld_kl') == true ? '1' : '0');
            $rjkLab['rjklab_kk_fg_au']        = ($request->has('rjklab_kk_fg_au') == true ? '1' : '0');
            $rjkLab['rjklab_kk_gd_gdj']       = ($request->has('rjklab_kk_gd_gdj') == true ? '1' : '0');
            $rjkLab['rjklab_kk_ld_trig']      = ($request->has('rjklab_kk_ld_trig') == true ? '1' : '0');
            $rjkLab['rjklab_kk_gd_hba']       = ($request->has('rjklab_kk_gd_hba') == true ? '1' : '0');
            $rjkLab['rjklab_is_widal']        = ($request->has('rjklab_is_widal') == true ? '1' : '0');
            $rjkLab['rjklab_is_hbs']          = ($request->has('rjklab_is_hbs') == true ? '1' : '0');
            $rjkLab['rjklab_is_ah']           = ($request->has('rjklab_is_ah') == true ? '1' : '0');
            $rjkLab['rjklab_urine_hcg']       = ($request->has('rjklab_urine_hcg') == true ? '1' : '0');
            $rjkLab['rjklab_urine_narkoba']   = ($request->has('rjklab_urine_narkoba') == true ? '1' : '0');
            $rjkLab['rjklab_urine_ul']        = ($request->has('rjklab_urine_ul') == true ? '1' : '0');
            $rjkLab['rjklab_created_by']      = Auth::user()->id;
            $rjkLab['rjklab_created_date']    = date('Y-m-d H:i:s');
            $rjkLab['rjklab_ip']              = \Request::ip();

            if(empty($post['rjklab_id'])){
                RujukanLab::create($rjkLab);
            }else{
                RujukanLab::where( 'rjklab_id', Hashids::decode($post['rjklab_id']) )->update($rjkLab);
            }

            PasienTrans::where('psntrans_id', $getTrans)->update([
                'pastrans_flag'   => '3', 
                'pastrans_status' => '4'
            ]);

            // start input log transaksi
            $logTrans = [
                'log_psntrans_id'  => $getTrans,
                'log_subjek'       => 'Cek Lab',
                'log_keterangan'   => 'Hasil telah keluar, tinggal diambil oleh pasien',
                'log_created_by'   => Auth::user()->id,
                'log_created_date' => date('Y-m-d H:i:s'),
                'log_ip'           => \Request::ip()
            ];

            LogTrans::create($logTrans);
            // end input log transaksi

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

    function formRadiologi(Request $request, $radioid = null){
        $post = $request->input();
        $data = [
            'cardTitle'    => 'Form Radiologi',
            'cardSubTitle' => '&nbsp;',
            'cardIcon'     => 'flaticon2-medical-records',
            'route'        => $this->route,
            'radioid'      => $radioid,
            'psnrekdis_id' => $post['transid']
        ];

        if(empty($radioid)){
            $data['radiologi'] = NULL;
        }else{
            $data['radiologi'] = Radiologi::selectRaw('*')
                ->where('radio_id', Hashids::decode($radioid)[0])
                ->first();
        }

        return view($this->path . '.PemeriksaanPenunjang.formRadiologi', $data);
    }

    function storeFormRadiologi(Request $request, $psnrekdis_id){
        $post      = $request->input();
        $decd      = Hashids::decode($psnrekdis_id)[0];
        $getTrans  = PasienRekdis::select('psnrekdis_psntrans_id')->where('psnrekdis_id', $decd)->first();
        $validator = Validator::make(
            $post,
            [
                'radio_rs'        => 'required',
                'radio_jenis'     => 'required',
                'radio_pekerjaan' => 'required'
            ],
            [
                'radio_rs.required'        => 'Rumah sakit tidak boleh kosong',
                'radio_jenis.required'     => 'Jenis Radiologi tidak boleh kosong',
                'radio_pekerjaan.required' => 'Pekerjaan tidak boleh kosong'
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
            $data = [
                'radio_psnrekdis_id' => $decd,
                'radio_rs'           => $post['radio_rs'],
                'radio_pekerjaan'    => $post['radio_pekerjaan'],
                'radio_tanggal'      => date('Y-m-d', strtotime($post['radio_tanggal'])),
                'radio_jenis'        => $post['radio_jenis'],
                'radio_ragio'        => $post['radio_ragio'],
                'radio_keterangan'   => $post['radio_keterangan'],
                'radio_created_by'   => Auth::user()->id,
                'radio_created_date' => date('Y-m-d H:i:s'),
                'radio_ip'           => \Request::ip()
            ];

            if(empty($post['radio_psnrekdis_id'])){
                Radiologi::create($data);
                PasienTrans::where('psntrans_id', $getTrans->psnrekdis_psntrans_id)->update(['pastrans_flag' => '2']);
            }else{
                Radiologi::where('radio_id', $decd)->update($data);
            }

            // start input log transaksi
            $logTrans = [
                'log_psntrans_id'  => $getTrans->psnrekdis_psntrans_id,
                'log_subjek'       => 'Pemeriksaan Penunjang - Radiologi',
                'log_keterangan'   => 'Dokter telah '. ( empty($psnrekdis_id) ? 'mengisi' : 'mengubah' ) .' form radiologi',
                'log_created_by'   => Auth::user()->id,
                'log_created_date' => date('Y-m-d H:i:s'),
                'log_ip'           => \Request::ip()
            ];

            LogTrans::create($logTrans);
            // end input log transaksi

            DB::commit();

            $response['status']  = 1;
            $response['message'] = 'Data radiologi berhasil ' . ( empty($psnrekdis_id) ? 'disimpan' : 'diubah' );

        } catch (\Exception $ex) {
            DB::rollback();

            $response['status']  = 0;
            $response['message'] = $ex->getMessage();
        }

        echo json_encode($response);  
    }

    function odontogram(Request $request){
        $post = $request->input();
        $data = [
            'cardTitle'    => 'Odontogram',
            'cardSubTitle' => '&nbsp;',
            'cardIcon'     => 'flaticon-file-1',
            'route'        => $this->route,
            'psnrekdis_id' => $post['transid'],
            'modon'        => Modon::getModon(),
            'odontogram'   => Odontogram::selectRaw('odon_kode,jenisp_warna')
                ->leftJoin('kkp_jenisp_gigi','jenisp_id','odon_jenisp_id')
                ->where('odon_psnrekdis_id', Hashids::decode($post['transid'])[0])
                ->get()
            
        ];

        return view($this->path . '.odontogram', $data);
    }

    function storeOdontogram(Request $request, $psnrekdis_id){
        $post      = $request->input();
        $decd      = Hashids::decode($psnrekdis_id)[0];
        $getTrans  = PasienRekdis::select('psnrekdis_psntrans_id')->where('psnrekdis_id', $decd)->first();
        $validator = Validator::make(
            $post,
            [
                'odon_kode'       => 'required',
                'odon_jenisp_id'  => 'required',
                'odon_keterangan' => 'required'
            ],
            [
                'odon_kode.required'       => 'Kode sakit tidak boleh kosong',
                'odon_jenisp_id.required'  => 'Jenis Penyakit tidak boleh kosong',
                'odon_keterangan.required' => 'Keterangan tidak boleh kosong'
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
            $data = [
                'odon_psnrekdis_id' => $decd,
                'odon_jenisp_id'    => $post['odon_jenisp_id'],
                'odon_kode'         => $post['odon_kode'],
                'odon_keterangan'   => $post['odon_keterangan'],
                'odon_createdby'    => Auth::user()->id,
                'odon_createddate'  => date('Y-m-d H:i:s'),
                'odon_ip'           => \Request::ip()
            ];

            // if(empty($post['radio_psnrekdis_id'])){
                Odontogram::create($data);
                // PasienTrans::where('psntrans_id', $getTrans->psnrekdis_psntrans_id)->update(['pastrans_flag' => '2']);
            // }else{
            //     Radiologi::where('radio_id', $decd)->update($data);
            // }

            // start input log transaksi
            $logTrans = [
                'log_psntrans_id'  => $getTrans->psnrekdis_psntrans_id,
                'log_subjek'       => 'Odontogram',
                'log_keterangan'   => 'Dokter telah '. ( empty($psnrekdis_id) ? 'mengisi' : 'mengubah' ) .' data odontogram',
                'log_created_by'   => Auth::user()->id,
                'log_created_date' => date('Y-m-d H:i:s'),
                'log_ip'           => \Request::ip()
            ];

            LogTrans::create($logTrans);
            // end input log transaksi

            DB::commit();

            $response['status']  = 1;
            $response['message'] = 'Data odontogram berhasil ' . ( empty($psnrekdis_id) ? 'disimpan' : 'diubah' );

        } catch (\Exception $ex) {
            DB::rollback();

            $response['status']  = 0;
            $response['message'] = $ex->getMessage();
        }

        echo json_encode($response);  
    }

    function ktableOdon(Request $request, $psnrekdis_id){
        $post    = $request->input();
        $getData = Odontogram::selectRaw('odon_id,odon_kode,jenisp_nama,odon_keterangan,odon_status,odon_createddate')->leftJoin('kkp_jenisp_gigi', 'jenisp_id', 'odon_jenisp_id');
        $jmlData = Odontogram::selectRaw('count(*) AS jumlah')->leftJoin('kkp_jenisp_gigi', 'jenisp_id', 'odon_jenisp_id');
        $paging  = $post['pagination'];
        $search  = (!empty($post['query']) ? $post['query'] : null);
        $getData = $getData->where('odon_psnrekdis_id', Hashids::decode($psnrekdis_id)[0]);

        if( isset($post['sort']) ){
            $getData->orderBy($post['sort']['field'], $post['sort']['sort']);
        }else{
            $getData->orderBy('odon_createddate', 'DESC');
        }

        if(!empty($search)){
            foreach ($search as $value => $param) {
                if($value === 'generalSearch'){
                    $getData->whereRaw("(odon_kode LIKE '%".$param."%' OR jenisp_nama LIKE '%".$param."%')");
                    $jmlData->whereRaw("(odon_kode LIKE '%".$param."%' OR jenisp_nama LIKE '%".$param."%')");
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
                'no'               => (string)$i,
                'odon_kode'        => $value->odon_kode,
                'jenisp_nama'      => $value->jenisp_nama,
                'odon_keterangan'  => $value->odon_keterangan,
                'odon_createddate' => date('D, d F Y H:i', strtotime($value->odon_createddate)),             
            ];

            $i++;
        }

        $encode = (object)[
            'meta' => ['page' => $start, 'pages' => $limit, 'perpage' => $limit, 'total' => $jumlah, 'sort' => 'asc', 'field' => 'RecordID'],
            'data' =>  $data['records']
        ];

        echo json_encode($encode);
    }

    function debugOdontogram(Request $request){
        $post = $request->input();
        $data = [
            'cardTitle'    => 'Odontogram',
            'cardSubTitle' => '&nbsp;',
            'cardIcon'     => 'flaticon-file-1',
            'route'        => $this->route,
            'psnrekdis_id' => $post['transid'],
            'modon'        => Modon::getModon(),
            'odontogram'   => Odontogram::selectRaw('odon_kode,jenisp_warna')
                ->leftJoin('kkp_jenisp_gigi','jenisp_id','odon_jenisp_id')
                ->where('odon_psnrekdis_id', Hashids::decode($post['transid'])[0])
                ->get()
            
        ];

        return view($this->path . '.debugOdontogram', $data);
    }
}
