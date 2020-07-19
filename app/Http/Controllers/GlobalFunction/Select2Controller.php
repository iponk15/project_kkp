<?php

namespace App\Http\Controllers\GlobalFunction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hashids;
use DB;

class Select2Controller extends Controller
{
    function __construct(){
        // put your magic
    }

    function getData($table, $prefix){
        $id     = $prefix . '_id';
        $nama   = $prefix . '_nama';
        $status = $prefix . '_status';
        $result = DB::table($table)
            ->select($id, $nama)
            ->where($nama, 'like', '%'.@$_GET['q'].'%')
            ->where($status, '1')
            ->orderBy($nama, 'ASC')
            ->limit(5)
            ->get();

        if($result->isNotEmpty()){
            for ($i=0; $i < count( $result ); $i++) {
                $data[$i] = [
                    'id'   => $result[$i]->$id, 
                    'text' => $result[$i]->$nama
                ];
            }
        }else{
            $data = [];
        }

        echo json_encode( ['items' => $data] );
    }

    function getrole(){
        $result = DB::table('kkp_role')
            ->select('role_kode', 'role_nama')
            ->where('role_nama', 'like', '%'.@$_GET['q'].'%')
            ->where('role_status', '1')
            ->orderBy('role_nama', 'ASC')
            ->limit(5)
            ->get();

        if($result->isNotEmpty()){
            for ($i=0; $i < count( $result ); $i++) {
                $data[$i] = [
                    'id'   => $result[$i]->role_kode, 
                    'text' => $result[$i]->role_nama
                ];
            }
        }else{
            $data = [];
        }

        echo json_encode( ['items' => $data] );
    }

    function getNoRekamedis(){
        $result = DB::table('kkp_pasien AS kp')
            ->selectRaw('
                pasien_id, 
                pasien_nama, 
                pasien_norekdis,
                tempsen.pastrans_pasien_id,
                tempsen.jmldata,
                tempsen.jmlclose,
                ( CASE WHEN tempsen.jmldata = tempsen.jmlclose THEN 1 ELSE 0 END ) as selsai
            ')
            ->leftJoin(DB::raw('(
                SELECT
                    pasien_id AS psnid,
                    count(pasien_id) as jmldata,
                    SUM( CASE WHEN pastrans_status = "99" THEN 1 ELSE 0 END ) AS jmlclose,
                    pastrans_pasien_id
                FROM kkp_pasien 
                LEFT JOIN kkp_pasien_trans ON pasien_id = pastrans_pasien_id
                GROUP BY pasien_id, pastrans_pasien_id
            ) AS tempsen'), 'kp.pasien_id', 'tempsen.psnid')
            ->whereRaw('( (CASE WHEN tempsen.jmldata = tempsen.jmlclose THEN 1 ELSE 0 END) = 1 OR tempsen.pastrans_pasien_id IS NULL ) AND ( pasien_norekdis like "%'.@$_GET['q'].'%" OR pasien_nama like "%'.@$_GET['q'].'%" ) ')
            ->orderBy('pasien_nama', 'ASC')
            ->limit(5)
            ->get();
        
        if($result->isNotEmpty()){
            for ($i=0; $i < count( $result ); $i++) {
                $data[$i] = [
                    'id'   => Hashids::encode($result[$i]->pasien_id),
                    'text' => $result[$i]->pasien_norekdis . ' - ' . $result[$i]->pasien_nama
                ];
            }
        }else{
            $data = [];
        }

        echo json_encode( ['items' => $data] );
    }

    function getDokter(){
        $result = DB::table('users')
            ->select('users.id', 'users.name', 'kpol.poli_nama')
            ->leftJoin('kkp_poli AS kpol', 'users.poli_id', 'kpol.poli_id')
            ->whereRaw('( users.name like "%'.@$_GET['q'].'%" OR kpol.poli_nama like "%'.@$_GET['q'].'%" )')
            ->where('users.role_kode', 'KKPDKT')
            ->where('users.status', '1')
            ->orderBy('users.name', 'ASC')
            ->limit(5)
            ->get();

        if($result->isNotEmpty()){
            for ($i=0; $i < count( $result ); $i++) {
                $data[$i] = [
                    'id'   => $result[$i]->id, 
                    'text' => $result[$i]->name . ' - ' . $result[$i]->poli_nama
                ];
            }
        }else{
            $data = [];
        }

        echo json_encode( ['items' => $data] );
    }
}
