<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\PasienRekdis;
use Illuminate\Http\Request;
use App\Models\PasienTrans;
use Validator;
use Hashids;
use Auth;
use DB;
use PDF;

class PasienInfoController extends Controller
{
    private $route = 'pasieninfo';
    private $path  = 'Pasien.PasienInfo';

    function __construct(){
        // put your magic
    }

    public function index($psntrans_id){
        $data = [
            'pagetitle'    => 'Pasien Berobat',
            'cardTitle'    => 'Form',
            'cardSubTitle' => 'Pasien Berobat',
            'cardIcon'     => 'flaticon2-list-3',
            'breadcrumb'   => ['Index' => route('pasienin.index'), 'Info Pasien' => route( $this->route . '.index', ['psntrans_id' => $psntrans_id] )],
            'route'        => $this->route,
            'psntrans_id'  => $psntrans_id,
            'records'      => PasienTrans::selectRaw('pasien_norekdis,pasien_id,pasien_nama,pasien_tgllahir,pasien_umur,pasien_email,pasien_jk,pasien_telp,pasien_alamat,u.name AS nama_dokter,kpol.poli_nama,kpol.poli_kode')
                ->leftJoin('kkp_pasien', 'pastrans_pasien_id', 'pasien_id')
                ->leftJoin('users AS u', 'pastrans_dokter_id', 'u.id')
                ->leftJoin('kkp_poli AS kpol', 'u.poli_id', 'kpol.poli_id')
                ->where('psntrans_id', Hashids::decode($psntrans_id)[0])
                ->first(),
        ];

        return view ($this->path.'.index', $data);
    }

    function infoPeriksaSuster(Request $request){
        $post = $request->input();
        $decd = Hashids::decode($post['transid'])[0];
        $data = [
            'cardTitle'    => 'Info Pemeriksaan',
            'cardSubTitle' => '&nbsp;',
            'cardIcon'     => 'flaticon-file-1',
            'route'        => $this->route,
            'transid'      => $post['transid'],
            'records'      => PasienTrans::selectRaw('
                    psnrekdis_sbj_kelutm,psnrekdis_sbj_keltam,psnrekdis_sbj_riwpktskr,psnrekdis_sbj_riwpktdhl,psnrekdis_sbj_riwpktklg,psnrekdis_sbj_riwpktkalg,psnrekdis_asm_digkrt,psnrekdis_pln_rak,psnrekdis_obj_vstd,psnrekdis_obj_vshr,psnrekdis_obj_vsrr,psnrekdis_obj_vst,
                    psnrekdis_obj_sgbb,psnrekdis_obj_sgtb,psnrekdis_obj_sgimt,psnrekdis_id,psnrekdis_obj_pfkpl,psnrekdis_obj_pflhr,psnrekdis_obj_pftcor,psnrekdis_obj_pftpul,psnrekdis_obj_pfabd,psnrekdis_obj_pfeksats,psnrekdis_obj_pfeksbwh,poli_kode               
                ')
                ->leftJoin('kkp_pasien_rekamedis', 'psntrans_id', 'psnrekdis_psntrans_id')
                ->leftJoin('users','pastrans_dokter_id','users.id')
                ->leftJoin('kkp_poli','users.poli_id','kkp_poli.poli_id')
                ->where('psntrans_id', $decd)
                ->first()
        ];

        return view( $this->path . '.showPeriksaSuster', $data );
    }

    function infoResepObat(Request $request){
        $post = $request->input();
        $decd = Hashids::decode($post['transid'])[0];
        $data = [
            'cardTitle'    => 'Info Resep Obat',
            'cardSubTitle' => '&nbsp;',
            'cardIcon'     => 'flaticon-file-1',
            'route'        => $this->route,
            'transid'      => $post['transid'],
            'records'      => PasienRekdis::selectRaw('katobat_nama,obat_nama,jenobat_nama,resep_jumlah,resep_keterangan')
                ->leftJoin('kkp_pasien_trans', 'psnrekdis_psntrans_id', 'psntrans_id')
                ->leftJoin('kkp_resep_obat', 'psnrekdis_id', 'resep_psnrekdis_id')
                ->leftJoin('kkp_obat', 'resep_obat_id', 'obat_id')
                ->leftJoin('kkp_kategori_obat', 'obat_katobat_id', 'katobat_id')
                ->leftJoin('kkp_jenis_obat', 'obat_jenobat_id', 'jenobat_id')
                ->where('psnrekdis_psntrans_id', $decd)
                ->get(),
            'getTras'      => PasienTrans::selectRaw('name,pastrans_created_date')
                ->leftJoin('users', function($join){
                    $join->on('users.id','pastrans_dokter_id')
                        ->where('users.status','1');
                })
                ->leftJoin('kkp_pasien', function($join){
                    $join->on('pasien_id','pastrans_pasien_id')
                        ->where('pasien_status', '1');
                })
                ->first()
        ];

        return view( $this->path . '.showResep', $data );
    }

    function infoRekamedis(Request $request){
        $post = $request->input();
        $decd = Hashids::decode($post['transid'])[0];
        $data = [
            'cardTitle'    => 'Riwayat Rekamedis Pasien',
            'cardSubTitle' => '&nbsp;',
            'cardIcon'     => 'flaticon-file-1',
            'route'        => $this->route,
            'transid'      => $post['transid']
        ];

        return view( $this->path . '.showRekamedis', $data );
    }

    function ktableRekamedis(Request $request, $psntrans_id){
        $post    = $request->input();
        $decd    = Hashids::decode($psntrans_id)[0];
        $getData = PasienTrans::selectRaw('psntrans_id,users.name AS dokter_nama,poli_nama,pastrans_created_date')
            ->leftJoin('users','pastrans_dokter_id','users.id')
            ->leftJoin('kkp_poli AS kpol','users.poli_id','kpol.poli_id')
            ->where('pastrans_status', '99')
            ->where('pastrans_pasien_id', $decd);
            
        $jmlData = PasienTrans::selectRaw('count(*) AS jumlah')
            ->leftJoin('users','pastrans_dokter_id','users.id')
            ->leftJoin('kkp_poli AS kpol','users.poli_id','kpol.poli_id')
            ->where('pastrans_status', '99')
            ->where('pastrans_pasien_id', $decd);

        $paging  = $post['pagination'];
        $search  = (!empty($post['query']) ? $post['query'] : null);

        if( isset($post['sort']) ){
            $getData->orderBy($post['sort']['field'], $post['sort']['sort']);
        }else{
            $getData->orderBy('pastrans_created_date', 'DESC');
        }

        if(!empty($search)){
            foreach ($search as $value => $param) {
                if($value === 'generalSearch'){
                    $getData->whereRaw("(dokter_nama LIKE '%".$param."%')");
                    $jmlData->whereRaw("(dokter_nama LIKE '%".$param."%')");
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
            $data['records'][] = [
                'RecordID'              => Hashids::encode($value->psntrans_id),
                'no'                    => (string)$i,
                'dokter_nama'           => $value->dokter_nama,
                'poli_nama'             => $value->poli_nama,
                'pastrans_created_date' => date('d F Y - H:i:s')
            ];

            $i++;
        }

        $encode = (object)[
            'meta' => ['page' => $start, 'pages' => $limit, 'perpage' => $limit, 'total' => $jumlah, 'sort' => 'asc', 'field' => 'RecordID', 'rowIds' => $rowIds],
            'data' =>  $data['records']
        ];

        echo json_encode($encode);
    }

    function showInfoRekamedis(Request $request){
        $post = $request->input();
        $decd = Hashids::decode($post['id'])[0];
        $data = [
            'records' => PasienTrans::selectRaw('
                    psnrekdis_sbj_kelutm,psnrekdis_sbj_keltam,psnrekdis_sbj_riwpktskr,psnrekdis_sbj_riwpktdhl,psnrekdis_sbj_riwpktklg,psnrekdis_sbj_riwpktkalg,psnrekdis_asm_digkrt,psnrekdis_pln_rak,psnrekdis_obj_vstd,psnrekdis_obj_vshr,psnrekdis_obj_vsrr,psnrekdis_obj_vst,
                    psnrekdis_obj_sgbb,psnrekdis_obj_sgtb,psnrekdis_obj_sgimt,psnrekdis_id,psnrekdis_obj_pfkpl,psnrekdis_obj_pflhr,psnrekdis_obj_pftcor,psnrekdis_obj_pftpul,psnrekdis_obj_pfabd,psnrekdis_obj_pfeksats,psnrekdis_obj_pfeksbwh                    
                ')
                ->leftJoin('kkp_pasien_rekamedis', 'psntrans_id', 'psnrekdis_psntrans_id')
                ->where('psntrans_id', $decd)
                ->first(),
            'resep'   => PasienRekdis::selectRaw('katobat_nama,obat_nama,jenobat_nama,resep_jumlah,resep_keterangan')
                ->leftJoin('kkp_resep_obat', 'psnrekdis_id', 'resep_psnrekdis_id')
                ->leftJoin('kkp_obat', 'resep_obat_id', 'obat_id')
                ->leftJoin('kkp_kategori_obat', 'obat_katobat_id', 'katobat_id')
                ->leftJoin('kkp_jenis_obat', 'obat_jenobat_id', 'jenobat_id')
                ->where('psnrekdis_resep_status', '1')
                ->where('psnrekdis_psntrans_id', $decd)
                ->get()
        ];

        return view( $this->path . '.showInfoRekamedis', $data );
    }

    function pdfResepObat($psntrans_id){
        $decd = Hashids::decode($psntrans_id);
        $data = [
            'pasien'      => PasienTrans::selectRaw('pasien_norekdis,pasien_id,pasien_nama,pasien_tgllahir,pasien_umur,pasien_email,pasien_jk,pasien_telp,pasien_alamat,u.name AS nama_dokter,kpol.poli_nama,kpol.poli_kode, kprekmedis.psnrekdis_obj_sgbb as pasien_berat_badan, kprekmedis.psnrekdis_sbj_riwpktkalg as pasien_riwayat_alergi')
                ->leftJoin('kkp_pasien', 'pastrans_pasien_id', 'pasien_id')
                ->leftJoin('users AS u', 'pastrans_dokter_id', 'u.id')
                ->leftJoin('kkp_poli AS kpol', 'u.poli_id', 'kpol.poli_id')
                ->leftJoin('kkp_pasien_rekamedis AS kprekmedis', 'psntrans_id', 'kprekmedis.psnrekdis_psntrans_id')
                ->where('psntrans_id', Hashids::decode($psntrans_id)[0])
                ->first(),
            'records'      => PasienRekdis::selectRaw('katobat_nama,obat_nama,jenobat_nama,resep_jumlah,resep_keterangan')
                ->leftJoin('kkp_pasien_trans', 'psnrekdis_psntrans_id', 'psntrans_id')
                ->leftJoin('kkp_resep_obat', 'psnrekdis_id', 'resep_psnrekdis_id')
                ->leftJoin('kkp_obat', 'resep_obat_id', 'obat_id')
                ->leftJoin('kkp_kategori_obat', 'obat_katobat_id', 'katobat_id')
                ->leftJoin('kkp_jenis_obat', 'obat_jenobat_id', 'jenobat_id')
                ->where('psnrekdis_psntrans_id', $decd)
                ->get(),
            'getTras'      => PasienTrans::selectRaw('name,pastrans_created_date')
                ->leftJoin('users', function($join){
                    $join->on('users.id','pastrans_dokter_id')
                        ->where('users.status','1');
                })
                ->leftJoin('kkp_pasien', function($join){
                    $join->on('pasien_id','pastrans_pasien_id')
                        ->where('pasien_status', '1');
                })
                ->first(),
        ];
        // dd($data);
        $pdf = PDF::loadView($this->path.'.pdfResepObat', $data);
        // $pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream('resep_obat_'.str_replace(' ', '_', $data['pasien']->{'pasien_nama'}).'_'.date('YmdHis', strtotime($data['getTras']->{'pastrans_created_date'})).'.pdf');
    }

    function demoSuratSehat($psntrans_id){
        $decd = Hashids::decode($psntrans_id);
        $data = [
            'pasien'      => PasienTrans::selectRaw('pasien_norekdis,pasien_id,pasien_nama,pasien_tgllahir,pasien_umur,pasien_email,pasien_jk,pasien_telp,pasien_alamat,u.name AS nama_dokter,kpol.poli_nama,kpol.poli_kode, kprekmedis.psnrekdis_obj_sgbb as pasien_berat_badan,kprekmedis.psnrekdis_obj_sgtb as pasien_tinggi_badan,kprekmedis.psnrekdis_obj_vstd as pasien_tensi_darah, kprekmedis.psnrekdis_sbj_riwpktkalg as pasien_riwayat_alergi, ksurat_sehat.ssht_keperluan, ksurat_sehat.ssht_keterangan')
                ->leftJoin('kkp_pasien', 'pastrans_pasien_id', 'pasien_id')
                ->leftJoin('users AS u', 'pastrans_dokter_id', 'u.id')
                ->leftJoin('kkp_poli AS kpol', 'u.poli_id', 'kpol.poli_id')
                ->leftJoin('kkp_pasien_rekamedis AS kprekmedis', 'psntrans_id', 'kprekmedis.psnrekdis_psntrans_id')
                ->leftJoin('kkp_surat_sehat AS ksurat_sehat', 'kprekmedis.psnrekdis_id', 'ksurat_sehat.ssht_psnrekdis_id')
                ->where('psntrans_id', Hashids::decode($psntrans_id)[0])
                ->first(),
            'records'      => PasienRekdis::selectRaw('katobat_nama,obat_nama,jenobat_nama,resep_jumlah,resep_keterangan')
                ->leftJoin('kkp_pasien_trans', 'psnrekdis_psntrans_id', 'psntrans_id')
                ->leftJoin('kkp_resep_obat', 'psnrekdis_id', 'resep_psnrekdis_id')
                ->leftJoin('kkp_obat', 'resep_obat_id', 'obat_id')
                ->leftJoin('kkp_kategori_obat', 'obat_katobat_id', 'katobat_id')
                ->leftJoin('kkp_jenis_obat', 'obat_jenobat_id', 'jenobat_id')
                ->where('psnrekdis_psntrans_id', $decd)
                ->get(),
            'getTras'      => PasienTrans::selectRaw('name,pastrans_created_date')
                ->leftJoin('users', function($join){
                    $join->on('users.id','pastrans_dokter_id')
                        ->where('users.status','1');
                })
                ->leftJoin('kkp_pasien', function($join){
                    $join->on('pasien_id','pastrans_pasien_id')
                        ->where('pasien_status', '1');
                })
                ->first(),
        ];
        $pdf = PDF::loadView($this->path.'.demoSuratSehat', $data);
        // $pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream('demoSuratSehat.pdf');
    }

    function demoSuratSakit($psntrans_id){
        $decd = Hashids::decode($psntrans_id);
        $data = [
            'pasien'      => PasienTrans::selectRaw('pasien_norekdis,pasien_id,pasien_nama,pasien_tgllahir,pasien_umur,pasien_email,pasien_jk,pasien_telp,pasien_alamat,u.name AS nama_dokter,kpol.poli_nama,kpol.poli_kode, kprekmedis.psnrekdis_obj_sgbb as pasien_berat_badan, kprekmedis.psnrekdis_sbj_riwpktkalg as pasien_riwayat_alergi, ksurat_sakit.sskt_tgl_mulai, ksurat_sakit.sskt_tgl_akhir, ksurat_sakit.sskt_jmlhari')
                ->leftJoin('kkp_pasien', 'pastrans_pasien_id', 'pasien_id')
                ->leftJoin('users AS u', 'pastrans_dokter_id', 'u.id')
                ->leftJoin('kkp_poli AS kpol', 'u.poli_id', 'kpol.poli_id')
                ->leftJoin('kkp_pasien_rekamedis AS kprekmedis', 'psntrans_id', 'kprekmedis.psnrekdis_psntrans_id')
                ->leftJoin('kkp_surat_sakit AS ksurat_sakit', 'kprekmedis.psnrekdis_id', 'ksurat_sakit.sskt_psnrekdis_id')
                ->where('psntrans_id', Hashids::decode($psntrans_id)[0])
                ->first(),
            'records'      => PasienRekdis::selectRaw('katobat_nama,obat_nama,jenobat_nama,resep_jumlah,resep_keterangan')
                ->leftJoin('kkp_pasien_trans', 'psnrekdis_psntrans_id', 'psntrans_id')
                ->leftJoin('kkp_resep_obat', 'psnrekdis_id', 'resep_psnrekdis_id')
                ->leftJoin('kkp_obat', 'resep_obat_id', 'obat_id')
                ->leftJoin('kkp_kategori_obat', 'obat_katobat_id', 'katobat_id')
                ->leftJoin('kkp_jenis_obat', 'obat_jenobat_id', 'jenobat_id')
                ->where('psnrekdis_psntrans_id', $decd)
                ->get(),
            'getTras'      => PasienTrans::selectRaw('name,pastrans_created_date')
                ->leftJoin('users', function($join){
                    $join->on('users.id','pastrans_dokter_id')
                        ->where('users.status','1');
                })
                ->leftJoin('kkp_pasien', function($join){
                    $join->on('pasien_id','pastrans_pasien_id')
                        ->where('pasien_status', '1');
                })
                ->first(),
        ];
        $pdf = PDF::loadView($this->path.'.demoSuratSakit', $data);
        // $pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream('surat_sakit_'.str_replace(' ', '_', $data['pasien']->{'pasien_nama'}).'_'.date('YmdHis', strtotime($data['getTras']->{'pastrans_created_date'})).'.pdf');
    }

    function demoSuratRadiologi($psntrans_id){
        $decd = Hashids::decode($psntrans_id);
        $data = [
            'cardTitle'    => 'Info Pemeriksaan',
            'cardSubTitle' => '&nbsp;',
            'cardIcon'     => 'flaticon-file-1',
            'route'        => $this->route,
            'transid'      => $psntrans_id,
            'records'      => PasienTrans::selectRaw('
                    psnrekdis_sbj_kelutm,psnrekdis_sbj_keltam,psnrekdis_sbj_riwpktskr,psnrekdis_sbj_riwpktdhl,psnrekdis_sbj_riwpktklg,psnrekdis_sbj_riwpktkalg,psnrekdis_asm_digkrt,psnrekdis_pln_rak,psnrekdis_obj_vstd,psnrekdis_obj_vshr,psnrekdis_obj_vsrr,psnrekdis_obj_vst,
                    psnrekdis_obj_sgbb,psnrekdis_obj_sgtb,psnrekdis_obj_sgimt,psnrekdis_id,psnrekdis_obj_pfkpl,psnrekdis_obj_pflhr,psnrekdis_obj_pftcor,psnrekdis_obj_pftpul,psnrekdis_obj_pfabd,psnrekdis_obj_pfeksats,psnrekdis_obj_pfeksbwh,poli_kode               
                ')
                ->leftJoin('kkp_pasien_rekamedis', 'psntrans_id', 'psnrekdis_psntrans_id')
                ->leftJoin('users','pastrans_dokter_id','users.id')
                ->leftJoin('kkp_poli','users.poli_id','kkp_poli.poli_id')
                ->where('psntrans_id', $decd)
                ->first()
        ];

        $pdf = PDF::loadView($this->path.'.demoSuratRadiologi', $data);
        // $pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream('demoSuratRadiologi.pdf');
    }
}
