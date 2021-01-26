<?php

namespace App\Http\Controllers;

use App\Models\RujukanSpesialis;
use Illuminate\Http\Request;
use App\Models\PasienTrans;
use App\User;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // put your magic
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'pagetitle'    => 'Dashboard',
            'cardTitle'    => NULL,
            'cardSubTitle' => NULL,
            'cardIcon'     => NULL,
            'breadcrumb'   => ['Index' => route('home')],
        ];

        $user = User::selectRaw('id,role_kode')
            ->where('id', Auth::user()->id)
            ->first();
        
        if($user->role_kode == 'KKPDKT'){
            $data['pasien'] = PasienTrans::selectRaw('psntrans_id,pasien_nama,pasien_norekdis,pasien_tgllahir,pasien_umur,uker_nama,golongan_nama,pasien_telp,pasien_email')
                ->leftJoin('kkp_pasien','pasien_id','pastrans_pasien_id')
                ->leftJoin('kkp_unit_kerja','pasien_uker_id','uker_id')
                ->leftJoin('kkp_golongan','pasien_golongan_id','golongan_id')
                ->where('pastrans_status', '2')
                ->where('pastrans_dokter_id', $user->id)
                ->orderBy('pastrans_created_date', 'DESC')
                ->get();

            $data['rujukan'] = RujukanSpesialis::selectRaw('pasien_nama, pasien_norekdis')
                ->leftJoin('kkp_pasien_rekamedis','psnrekdis_id','rjksps_psnrekdis_id')
                ->leftJoin('kkp_pasien_trans','psntrans_id','psnrekdis_psntrans_id')
                ->leftJoin('kkp_pasien','pasien_id','pastrans_pasien_id')
                ->where('rjksps_dokter_id', $user->id)
                ->orderBy('rjksps_created_date', 'DESC')
                ->get();

            return view('Home.dokter', $data);
        }else if($user->role_kode == 'KKPADM'){
            $data['summary'] = DB::table('v_dashadmin_summary')->get();
            return view('Home.admin', $data);
        }else{
            return view('Home.home', $data);
        }
    }
}
