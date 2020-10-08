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
                ->where('pastrans_flag', '1')
                ->get()
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
}
