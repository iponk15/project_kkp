<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasienTrans extends Model
{
    public $timestamps    = false;
    protected $table      = 'kkp_pasien_trans';
    protected $primaryKey = 'psntrans_id';
    protected $fillable   = [
        'pastrans_pasien_id',
        'pastrans_dokter_id',
        'pastrans_status',
        'pastrans_created_by',
        'pastrans_created_date',
        'pastrans_updated_by',
        'pastrans_lastupdate',
    ];
}
