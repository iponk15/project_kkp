<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PasienTrans;
use Validator;
use Hashids;
use Auth;
use DB;

class PasienOutController extends Controller
{
    private $route = 'pasienout';
    private $path  = 'Pasien.PasienOut';

    function __construct(){
        // put your magic
    }

    public function index(){
        $data = [
            'pagetitle'    => 'Pasien',
            'cardTitle'    => 'Daftar Pasien Berkunjung',
            'cardSubTitle' => '&nbsp;',
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
            $getData->where('pastrans_status', '99');
            $jmlData->where('pastrans_status', '99');

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
                                ( $value->pastrans_status == '2'
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
}
