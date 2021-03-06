<?php

namespace App\Http\Controllers\Resep;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PasienRekdis;
use App\Models\PasienTrans;
use Illuminate\Support\Arr;
use Validator;
use Hashids;
use Auth;
use DB;

class ListResepController extends Controller
{
    private $route = 'listresep';
    private $path  = 'Resep.ListResep';

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
        $getData = PasienTrans::selectRaw('psntrans_id,pasien_norekdis,pasien_nama,pasien_jk,pasien_umur,users.name AS dokter_nama,pastrans_created_date')
            ->leftJoin('kkp_pasien', 'pastrans_pasien_id', 'pasien_id')
            ->leftJoin('kkp_pasien_rekamedis', 'psntrans_id', 'psnrekdis_psntrans_id')
            ->leftJoin('users', 'pastrans_dokter_id', 'users.id')
            ->where('psnrekdis_resep_status', '1')
            ->where('pastrans_status', '<>', '99');

        $jmlData = PasienTrans::selectRaw('count(*) AS jumlah')
            ->leftJoin('kkp_pasien', 'pastrans_pasien_id', 'pasien_id')
            ->leftJoin('kkp_pasien_rekamedis', 'psntrans_id', 'psnrekdis_psntrans_id')
            ->leftJoin('users', 'pastrans_dokter_id', 'users.id')
            ->where('psnrekdis_resep_status', '1')
            ->where('pastrans_status', '<>', '99');

        $paging  = $post['pagination'];
        $search  = (!empty($post['query']) ? $post['query'] : null);

        if( isset($post['sort']) ){
            $getData->orderBy($post['sort']['field'], $post['sort']['sort']);
        }else{
            $getData->orderBy('pasien_nama', 'DESC');
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
                'pastrans_created_date' => date('d F Y - H:i:s',strtotime($value->pastrans_created_date)),
                'action'                => '<div class="dropdown dropdown-inline">
                                                <a href="'. route( $this->route . '.showResepObat', [ 'psntrans_id' => Hashids::encode($value->psntrans_id) ] ) .'" class="btn btn-icon btn-clean btn-sm mr-2 ajaxify" data-toggle="tooltip" data-theme="dark" title="Resep Obat"><i class="flaticon-folder-1 text-info"></i></a>
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

    function showResepObat($psntrans_id){
        $decode = Hashids::decode($psntrans_id)[0];
        $data   = [
            'pagetitle'    => 'Resep Obat',
            'cardTitle'    => 'Informasi Resep Obat Pasien',
            'cardSubTitle' => '&nbsp;',
            'cardIcon'     => 'flaticon2-list-3',
            'breadcrumb'   => ['Index' => route( $this->route . '.index' ), 'Detail Resep' => route( $this->route . '.showResepObat', [ 'psntrans_id' => $psntrans_id ] )],
            'route'        => $this->route,
            'psntrans_id'  => $psntrans_id,
            'dataTrans'    => PasienTrans::selectRaw('pasien_nama,pasien_norekdis,users.name AS dokter_nama,pasien_jk,pasien_tgllahir,pasien_umur,pasien_email,pasien_telp,pasien_alamat,kpol.poli_nama,resnote_keterangan,pastrans_status')
                ->leftJoin('kkp_pasien', 'pastrans_pasien_id', 'pasien_id')
                ->leftJoin('users', 'pastrans_dokter_id', 'users.id')
                ->leftJoin('kkp_poli AS kpol', 'users.poli_id', 'kpol.poli_id')
                ->leftJoin('kkp_pasien_rekamedis', 'psntrans_id', 'psnrekdis_psntrans_id')
                ->leftJoin('kkp_resep_note', 'psnrekdis_id', 'resnote_psnrekdis_id')
                ->where('psntrans_id', $decode)
                ->first(),
            'dataResep'    => PasienRekdis::selectRaw('katobat_nama,obat_nama,jenobat_nama,resep_jumlah,resep_keterangan')
                ->leftJoin('kkp_resep_obat', 'psnrekdis_id', 'resep_psnrekdis_id')
                ->leftJoin('kkp_obat', 'resep_obat_id', 'obat_id')
                ->leftJoin('kkp_kategori_obat', 'obat_katobat_id', 'katobat_id')
                ->leftJoin('kkp_jenis_obat', 'obat_jenobat_id', 'jenobat_id')
                ->where('psnrekdis_psntrans_id', $decode)
                ->get()
        ];

        return view ($this->path.'.showResepObat', $data);
    }

    function approveResep(Request $request){
        $post = $request->input();
        $decd = Hashids::decode($post['psntrans_id']);

        DB::beginTransaction();

        try {
            PasienTrans::where('psntrans_id', $decd)->update(['pastrans_status' => '99']);
            PasienRekdis::where('psnrekdis_psntrans_id', $decd)->update(['psnrekdis_resep_status' => '2']);

            DB::commit();

            $response['status']  = 1;
            $response['message'] = 'Resep berhasil disetujui';
        } catch (\Exception $ex) {

            DB::rollback();

            $response['status']  = 0;
            $response['message'] = $ex->getMessage();
        }

        echo json_encode($response);
    }
}
