<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PasienRekdis;
use Illuminate\Support\Arr;
use App\Models\PasienTrans;
use App\Models\LogTrans;
use App\Models\Pasien;
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
        $getData = PasienTrans::selectRaw('pasien_id, pasien_norekdis, pasien_nama, pasien_tgllahir, pasien_umur, pasien_jk, psntrans_id, pastrans_status, pastrans_created_date')->leftJoin('kkp_pasien', 'pastrans_pasien_id', 'pasien_id');
        $jmlData = PasienTrans::selectRaw('count(*) AS jumlah')->leftJoin('kkp_pasien', 'pastrans_pasien_id', 'pasien_id');
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
                'pasien_nama'           => $value->pasien_nama,
                'pasien_tgllahir'       => date('d F Y', strtotime($value->pasien_tgllahir)),
                'pasien_umur'           => $value->pasien_umur,
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
            'records'      => PasienTrans::selectRaw('pasien_norekdis, pasien_nama, pasien_tgllahir, pasien_umur, pasien_email, pasien_jk, pasien_telp, pasien_alamat, u.name AS nama_dokter, kpol.poli_nama')
                ->leftJoin('kkp_pasien', 'pastrans_pasien_id', 'pasien_id')
                ->leftJoin('users AS u', 'pastrans_dokter_id', 'u.id')
                ->leftJoin('kkp_poli AS kpol', 'u.poli_id', 'kpol.poli_id')
                ->where('psntrans_id', Hashids::decode($psntrans_id)[0])
                ->first()
        ];

        $data['cardSubTitle'] = 'Pasien berobat dengan dokter : <b>' . $data['records']->nama_dokter . ' - ' . $data['records']->poli_nama . '</b>';

        return view ($this->path.'.formPeriksa', $data);        
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
                    pasien_norekdis,pasien_nama,pasien_tgllahir,pasien_umur,pasien_email,pasien_jk,pasien_telp,pasien_alamat,
                    psnrekdis_sbj_kelutm,psnrekdis_sbj_keltam,psnrekdis_sbj_riwpktskr,psnrekdis_sbj_riwpktdhl,psnrekdis_sbj_riwpktklg,psnrekdis_sbj_riwpktkalg,psnrekdis_asm_digkrt,psnrekdis_pln_rak,
                    psnrekdis_obj_vstd,psnrekdis_obj_vshr,psnrekdis_obj_vsrr,psnrekdis_obj_vst,psnrekdis_obj_sgbb,psnrekdis_obj_sgtb,psnrekdis_obj_sgimt,psnrekdis_obj_pfkpl,psnrekdis_obj_pflhr,psnrekdis_obj_pftcor,
                    psnrekdis_obj_pftpul,psnrekdis_obj_pfabd,psnrekdis_obj_pfeksats,psnrekdis_obj_pfeksbwh
                ')
                ->leftJoin('kkp_pasien', 'pastrans_pasien_id', 'pasien_id')
                ->leftJoin('kkp_pasien_rekamedis', 'psntrans_id', 'psnrekdis_psntrans_id')
                ->where('psntrans_id', Hashids::decode($psntrans_id)[0])
                ->first(),
            'subHeadBtn' => '
                <a href="#" class="btn btn-outline-success btn-sm mr-3"><i class="flaticon-background"></i> Form Resep Obat</a>
                <a href="#" class="btn btn-outline-warning btn-sm mr-3"><i class="flaticon2-map"></i> Form Rujukan</a>
                <a href="#" class="btn btn-outline-danger btn-sm mr-3"><i class="flaticon2-analytics"></i> Form Lab</a>
            '
        ];

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
}
