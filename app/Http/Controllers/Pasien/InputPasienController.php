<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\PasienTrans;
use App\Models\LogTrans;
use App\Models\Pasien;
use Validator;
use Hashids;
use Auth;
use DB;

class InputPasienController extends Controller
{
    private $route = 'inputpasien';
    private $path  = 'Pasien.InputPasien';

    function __construct(){
        // put your magic
    }

    public function index(){
        $data = [
            'pagetitle'    => 'Input Pasien',
            'cardTitle'    => 'Form',
            'cardSubTitle' => 'Input Pasien',
            'cardIcon'     => 'flaticon2-list-3',
            'breadcrumb'   => ['Index' => route($this->route . '.index')],
            'route'        => $this->route
        ];

        return view ($this->path.'.index', $data);
    }

    function pasienbaru(){
        $data = [
            'route'    => $this->route,
            'norekdis' => Pasien::where('pasien_status', '1')->count() + 1
        ];

        return view ($this->path.'.formPasienBaru', $data);
    }

    function pasienterdaftar(){
        $data = [
            'route' => $this->route
        ];

        return view ($this->path.'.formPasienTerdaftar', $data);
    }

    function storePasienBaru(Request $request){
        $post      = $request->input();
        $validator = Validator::make(
            $post,
            [
                'pasien_nama'        => 'required',
                'pasien_tgllahir'    => 'required',
                'pasien_umur'        => 'required',
                'pasien_jk'          => 'required',
                'pasien_email'       => 'required',
                'pasien_alamat'      => 'required',
                'pastrans_dokter_id' => 'required',
                'pasien_uker_id'     => 'required'
                
            ],
            [
                'pasien_nama.required'        => 'Nama tidak boleh kosong',
                'pasien_tgllahir.required'    => 'Tanggal lahir tidak boleh kosong',
                'pasien_umur.required'        => 'Umur tidak boleh kosong',
                'pasien_jk.required'          => 'Jenis kelamin tidak boleh kosong',
                'pasien_email.required'       => 'Email tidak boleh kosong',
                'pasien_alamat.required'      => 'Alamat tidak boleh kosong',
                'pastrans_dokter_id.required' => 'Dokter tidak boleh kosong',
                'pasien_uker_id.required'     => 'Unit kerja tidak boleh kosong'
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
            // start create pasein baru
            $post['pasien_tgllahir']     = date('Y-m-d', strtotime($post['pasien_tgllahir']));
            $post['pasien_created_by']   = Auth::user()->id;
            $post['pasien_created_date'] = date('Y-m-d H:i:s');
            $post['pasien_ip']           = \Request::ip();

            Pasien::create($post);
            $lastId = DB::getPdo()->lastInsertId();
            // end create pasein baru

            // start create transaksi pasien
            $psntrans = [
                'pastrans_pasien_id'    => $lastId,
                'pastrans_dokter_id'    => $post['pastrans_dokter_id'],
                'pastrans_status'       => '1',
                'pastrans_created_by'   => Auth::user()->id,
                'pastrans_created_date' => date('Y-m-d H:i:s')
            ];

            PasienTrans::create($psntrans);
            $lastId = DB::getPdo()->lastInsertId();
            // end create transaksi pasien

            // start input log transaksi
            $logTrans = [
                'log_psntrans_id'  => $lastId,
                'log_subjek'       => 'Pendaftaran',
                'log_keterangan'   => 'Pasien melakukan pendaftaran',
                'log_created_by'   => Auth::user()->id,
                'log_created_date' => date('Y-m-d H:i:s'),
                'log_ip'           => \Request::ip()
            ];

            LogTrans::create($logTrans);
            // end input log transaksi

            DB::commit();

            $response['status']  = 1;
            $response['message'] = 'Data berhasil di simpan';
        } catch (\Exception $ex) {

            DB::rollback();

            $response['status']  = 0;
            $response['message'] = $ex->getMessage();
        }

        echo json_encode($response);
    }

    function updatePasienTerdaftar(Request $request){
        $post      = $request->input();
        $validator = Validator::make(
            $post,
            [
                'pasien_nama'        => 'required',
                'pasien_tgllahir'    => 'required',
                'pasien_umur'        => 'required',
                'pasien_jk'          => 'required',
                'pasien_email'       => 'required',
                'pasien_alamat'      => 'required',
                'pastrans_dokter_id' => 'required',
                'pasien_uker_id'     => 'required'
            ],
            [
                'pasien_nama.required'        => 'Nama tidak boleh kosong',
                'pasien_tgllahir.required'    => 'Tanggal lahir tidak boleh kosong',
                'pasien_umur.required'        => 'Umur tidak boleh kosong',
                'pasien_jk.required'          => 'Jenis kelamin tidak boleh kosong',
                'pasien_email.required'       => 'Email tidak boleh kosong',
                'pasien_alamat.required'      => 'Alamat tidak boleh kosong',
                'pastrans_dokter_id.required' => 'Dokter tidak boleh kosong',
                'pasien_uker_id.required'     => 'Unit kerja tidak boleh kosong'
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

            // start create pasein baru
            $pasien['pasien_uker_id']      = $post['pasien_uker_id'];
            $pasien['pasien_nama']         = $post['pasien_nama'];
            $pasien['pasien_umur']         = $post['pasien_umur'];
            $pasien['pasien_pangkat']      = $post['pasien_pangkat'];
            $pasien['pasien_jk']           = $post['pasien_jk'];
            $pasien['pasien_telp']         = $post['pasien_telp'];
            $pasien['pasien_email']        = $post['pasien_email'];
            $pasien['pasien_alergi_obat']  = $post['pasien_alergi_obat'];
            $pasien['pasien_alamat']       = $post['pasien_alamat'];
            $pasien['pasien_tgllahir']     = date('Y-m-d', strtotime($post['pasien_tgllahir']));
            $pasien['pasien_updated_by']   = Auth::user()->id ;
            $pasien['pasien_ip']           = \Request::ip();

            Pasien::where('pasien_id', Hashids::decode($post['pasien_id'])[0])->update($pasien);
            // end create pasein baru

            // start create transaksi pasien
            $psntrans = [
                'pastrans_pasien_id'    => Hashids::decode($post['pasien_id'])[0],
                'pastrans_dokter_id'    => $post['pastrans_dokter_id'],
                'pastrans_status'       => '1',
                'pastrans_created_by'   => Auth::user()->id,
                'pastrans_created_date' => date('Y-m-d H:i:s')
            ];

            PasienTrans::create($psntrans);
            $lastId = DB::getPdo()->lastInsertId();
            // end create transaksi pasien

            // start input log transaksi
            $logTrans = [
                'log_psntrans_id'  => $lastId,
                'log_subjek'       => 'Pendaftaran',
                'log_keterangan'   => 'Pasien melakukan pendaftaran',
                'log_created_by'   => Auth::user()->id,
                'log_created_date' => date('Y-m-d H:i:s'),
                'log_ip'           => \Request::ip()
            ];

            LogTrans::create($logTrans);
            // end input log transaksi

            DB::commit();

            $response['status']  = 1;
            $response['message'] = 'Data berhasil di simpan';
        } catch (\Exception $ex) {

            DB::rollback();

            $response['status']  = 0;
            $response['message'] = $ex->getMessage();
        }

        echo json_encode($response);
    }

    function getDataPsien(Request $request){
        $post     = $request->input();
        $decPsnId = Hashids::decode($post['pasien_id'])[0];
        $pasien   = Pasien::selectRaw('pasien_nama, pasien_email, pasien_jk, pasien_telp, pasien_alamat, pasien_tgllahir, pasien_umur, pasien_pangkat, pasien_alergi_obat, uker_id, uker_nama')
            ->leftJoin('kkp_unit_kerja','pasien_uker_id','uker_id')
            ->where('pasien_id', $decPsnId)
            ->first();

        $return = [ 'pasien' => $pasien ];

        echo json_encode($return);
    }
}
