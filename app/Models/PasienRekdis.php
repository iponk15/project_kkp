<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasienRekdis extends Model
{
    public $timestamps    = false;
    protected $table      = 'kkp_pasien_rekamedis';
    protected $primaryKey = 'psnrekdis_id';
    protected $fillable   = [
        'psnrekdis_psntrans_id',
        'psnrekdis_sbj_kelutm',
        'psnrekdis_sbj_keltam',
        'psnrekdis_sbj_riwpktskr',
        'psnrekdis_sbj_riwpktdhl',
        'psnrekdis_sbj_riwpktklg',
        'psnrekdis_sbj_riwpktkalg',
        'psnrekdis_asm_digkrt',
        'psnrekdis_pln_rak',
        'psnrekdis_obj_vstd',
        'psnrekdis_obj_vshr',
        'psnrekdis_obj_vsrr',
        'psnrekdis_obj_vst',
        'psnrekdis_obj_sgbb',
        'psnrekdis_obj_sgtb',
        'psnrekdis_obj_sgimt',
        'psnrekdis_obj_pfkpl',
        'psnrekdis_obj_pflhr',
        'psnrekdis_obj_pftcor',
        'psnrekdis_obj_pftpul',
        'psnrekdis_obj_pfabd',
        'psnrekdis_obj_pfeksats',
        'psnrekdis_obj_pfeksbwh',
        'psnrekdis_created_by',
        'psnrekdis_created_date',
        'psnrekdis_ip'
    ];
}
