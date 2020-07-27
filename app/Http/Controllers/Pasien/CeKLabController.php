<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PasienRekdis;
use App\Models\PasienTrans;
use App\Models\RujukanLab;
use App\Models\LogTrans;
use Validator;
use Hashids;
use Auth;
use DB;

class CeKLabController extends Controller
{
    private $route = 'ceklab';
    private $path  = 'Pasien.CekLab';

    function __construct(){
        // put your magic
    }

    public function index(){
        $data = [
            'pagetitle'    => 'Pasien Cek Lab',
            'cardTitle'    => 'Data',
            'cardSubTitle' => 'Pasien Cek Lab',
            'cardIcon'     => 'flaticon2-list-3',
            'breadcrumb'   => [ 'Index' => route( $this->route . '.index' ) ],
            'route'        => $this->route,
        ];

        return view ($this->path.'.index', $data);
    }

    function ktable(Request $request){
        $post    = $request->input();
        $getData = PasienTrans::selectRaw('psntrans_id,pasien_norekdis,pasien_nama,pastrans_status,pastrans_created_date,users.name AS dokter_nama,kpol.poli_nama,pasien_jk,pasien_umur')
            ->leftJoin('kkp_pasien', 'pastrans_pasien_id', 'pasien_id')
            ->leftJoin('kkp_pasien_rekamedis', 'psntrans_id', 'psnrekdis_psntrans_id')
            ->leftJoin('users', 'pastrans_dokter_id', 'users.id')
            ->leftJoin('kkp_poli AS kpol', 'users.poli_id', 'kpol.poli_id')
            ->where('psnrekdis_is_lab', '1')
            ->where('pastrans_status', '<>', '99');

        $jmlData = PasienTrans::selectRaw('count(*) AS jumlah')
            ->leftJoin('kkp_pasien', 'pastrans_pasien_id', 'pasien_id')
            ->leftJoin('kkp_pasien_rekamedis', 'psntrans_id', 'psnrekdis_psntrans_id')
            ->leftJoin('users', 'pastrans_dokter_id', 'users.id')
            ->leftJoin('kkp_poli AS kpol', 'users.poli_id', 'kpol.poli_id')
            ->where('psnrekdis_is_lab', '1')
            ->where('pastrans_status', '<>', '99');

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
                    $getData->whereRaw("(pasien_nama LIKE '%".$param."%')");
                    $jmlData->whereRaw("(pasien_nama LIKE '%".$param."%')");
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
            $data['records'][] = [
                'no'                    => (string)$i,
                'pasien_norekdis'       => $value->pasien_norekdis,
                'pasien_nama'           => $value->pasien_nama,
                'pasien_jk'             => $gender[$value->pasien_jk],
                'pasien_umur'           => $value->pasien_umur,
                'dokter_nama'           => $value->dokter_nama,
                'poli_nama'             => $value->poli_nama,
                'pastrans_created_date' => date('d F Y H:i:s', strtotime($value->pastrans_created_date)),
                'action'                => '<div class="dropdown dropdown-inline">
                                                <a href="'. route( $this->route . '.showCekLab', [ 'psntrans_id' => Hashids::encode($value->psntrans_id) ] ) .'" class="btn btn-icon btn-clean btn-sm mr-2 ajaxify" data-toggle="tooltip" data-theme="dark" title="Cek Lab"><i class="flaticon2-medical-records text-warning"></i></a>
                                            </div>'
            ];

            $i++;
        }

        $encode = (object)[
            'meta' => ['page' => $start, 'pages' => $limit, 'perpage' => $limit, 'total' => $jumlah, 'sort' => 'asc', 'field' => 'RecordID', 'rowIds' => $rowIds],
            'data' =>  $data['records']
        ];

        echo json_encode($encode);
    }

    function showCekLab($psntrans_id){
        $data = [
            'pagetitle'    => 'Form Cek Lab',
            'cardTitle'    => 'Form Cek Lab',
            'cardSubTitle' => '&nbsp;',
            'cardIcon'     => 'flaticon-file-1',
            'breadcrumb'   => ['Index' => route($this->route . '.index'), 'Form Cek Lab' => route($this->route . '.showCekLab', ['psntrans_id' => $psntrans_id])],
            'route'        => $this->route,
            'psntrans_id'  => $psntrans_id,
            'records'      => PasienTrans::selectRaw('pasien_norekdis,pasien_id,pasien_nama,pasien_tgllahir,pasien_umur,pasien_email,pasien_jk,pasien_telp,pasien_alamat,u.name AS nama_dokter,kpol.poli_nama,kpol.poli_kode,psnrekdis_id')
                ->leftJoin('kkp_pasien', 'pastrans_pasien_id', 'pasien_id')
                ->leftJoin('users AS u', 'pastrans_dokter_id', 'u.id')
                ->leftJoin('kkp_poli AS kpol', 'u.poli_id', 'kpol.poli_id')
                ->leftJoin('kkp_pasien_rekamedis', 'psntrans_id', 'psnrekdis_psntrans_id')
                ->where('psntrans_id', Hashids::decode($psntrans_id)[0])
                ->first()
        ];

        return view($this->path . '.showCekLab', $data);
    }

    function showFormLab(Request $request){
        $post = $request->input();
        $decd = Hashids::decode($post['transid'])[0];

        $data = [
            'pagetitle'    => 'Form Cek Lab',
            'cardTitle'    => 'Form Cek Lab',
            'cardSubTitle' => '&nbsp;',
            'cardIcon'     => 'flaticon-file-1',
            'route'        => $this->route,
            'psnrekdis_id' => $post['transid']
        ];

        return view($this->path . '.showFormLab', $data);
    }

    function storeCekLab(Request $request, $psnrekdis_id){
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

            RujukanLab::create($rjkLab);

            PasienTrans::where('psntrans_id', $getTrans)->update(['pastrans_status' => '4']);

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
}
