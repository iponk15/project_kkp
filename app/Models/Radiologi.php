<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Radiologi extends Model
{
    public $timestamps    = false;
    protected $table      = 'kkp_radiologi';
    protected $primaryKey = 'radio_id';
    protected $fillable   = [
        'radio_psnrekdis_id',
        'radio_tanggal',
        'radio_rs',
        'radio_pekerjaan',
        'radio_jenis',
        'radio_ragio',
        'radio_keterangan',
        'radio_createdby',
        'radio_createddate',
        'radio_lastupdate',
        'radio_updatedby',
        'radio_ip',

    ];
}
