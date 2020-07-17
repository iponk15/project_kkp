<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\PasienTrans;
use App\Models\Pasien;
use Validator;
use Hashids;
use Auth;
use DB;

class PasienInController extends Controller
{
    private $route = 'pasienin';
    private $path  = 'pasien.pasienin';

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
        $getData = PasienTrans::selectRaw('pasien_id, pasien_norekdis, pasien_nama, pasien_tgllahir, pasien_umur, pasien_jk, pastrans_status, pastrans_created_date')->leftJoin('kkp_pasien', 'pastrans_pasien_id', 'pasien_id');
        $jmlData = PasienTrans::selectRaw('count(*) AS jumlah')->leftJoin('kkp_pasien', 'pastrans_pasien_id', 'pasien_id');
        $paging  = $post['pagination'];
        $search  = (!empty($post['query']) ? $post['query'] : null);

        if(Auth::user()->role_kode == 'KKPSTR'){
            $getData->where('pastrans_status', '1');
            $jmlData->where('pastrans_status', '1');
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
                $button = '<div class="dropdown dropdown-inline">
                                <a href="'. route( $this->route . '.formPeriksa', ['pasien_id' => Hashids::encode($value->pasien_id)] ) .'" class="btn btn-icon btn-clean btn-sm mr-2 ajaxify" data-toggle="tooltip" data-theme="dark" title="Pemeriksaan Pasien"><i class="flaticon-statistics text-warning icon-xl"></i></a>
                           </div>';
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

    function formPeriksa($pasien_id){
        $data = [
            'pagetitle'    => 'Form Pemeriksaan',
            'cardTitle'    => 'Form Pemeriksaan',
            'cardSubTitle' => 'Pasien Sedang Berobat',
            'cardIcon'     => 'flaticon2-list-3',
            'breadcrumb'   => [ 'index' => route( $this->route . '.index' ), 'Form Pemeriksaan' => route($this->route . '.formPeriksa', ['pasien_id' => $pasien_id])],
            'route'        => $this->route,
            'records'      => Pasien::selectRaw('pasien_norekdis, pasien_nama, pasien_tgllahir, pasien_umur, pasien_email, pasien_jk, pasien_telp, pasien_alamat')
                ->where('pasien_id', Hashids::decode($pasien_id)[0])
                ->first()
        ];

        return view ($this->path.'.formPeriksa', $data);        
    }
}
