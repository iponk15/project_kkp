<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Pasien;
use Validator;
use Hashids;
use Auth;
use DB;

class PasienController extends Controller
{
    private $route = 'pasien';
    private $path  = 'Pasien.Pasien';

    function __construct(){
        // put your magic
    }

    public function index(){
        $data = [
            'pagetitle'    => 'Pasien',
            'cardTitle'    => 'List Data',
            'cardSubTitle' => 'Pasien',
            'cardIcon'     => 'flaticon2-list-3',
            'breadcrumb'   => ['Index' => route($this->route . '.index')],
            'route'        => $this->route
        ];

        return view ($this->path.'.index', $data);
    }

    function ktable(Request $request){
        $post    = $request->input();
        $getData = Pasien::selectRaw('pasien_id, pasien_norekdis, pasien_nama, pasien_jk, pasien_tgllahir, pasien_umur, pasien_status, pasien_created_date');
        $jmlData = Pasien::selectRaw('count(*) AS jumlah');
        $paging  = $post['pagination'];
        $search  = (!empty($post['query']) ? $post['query'] : null);

        if( isset($post['sort']) ){
            $getData->orderBy($post['sort']['field'], $post['sort']['sort']);
        }else{
            $getData->orderBy('pasien_created_date', 'DESC');
        }

        if(!empty($search)){
            foreach ($search as $value => $param) {
                if($value === 'generalSearch'){
                    $getData->whereRaw("(pasien_nama LIKE '%".$param."%' OR pasien_norekdis LIKE '%".$param."%')");
                    $jmlData->whereRaw("(pasien_nama LIKE '%".$param."%' OR pasien_norekdis LIKE '%".$param."%')");
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
            $rowIds[]          = $value->pasien_id;
            $data['records'][] = [
                'RecordID'            => $value->pasien_id,
                'no'                  => (string)$i,
                'pasien_norekdis'     => $value->pasien_norekdis,
                'pasien_nama'         => $value->pasien_nama,
                'pasien_jk'           => $gender[$value->pasien_jk],
                'pasien_tgllahir'     => date('d F Y', strtotime($value->pasien_tgllahir)),
                'pasien_umur'         => $value->pasien_umur,
                'pasien_status'       => intval($value->pasien_status),
                'pasien_created_date' => date('D, d F Y H:i', strtotime($value->pasien_created_date)),
                'action'              => '<div class="dropdown dropdown-inline">
                                            <a href="'. route($this->route . '.edit', ['id' => Hashids::encode($value->pasien_id)]) .'" class="btn btn-icon btn-clean btn-sm mr-2 ajaxify" data-toggle="tooltip" data-theme="dark" title="Detail"><i class="flaticon-information text-info icon-xl"></i></a>
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
}

