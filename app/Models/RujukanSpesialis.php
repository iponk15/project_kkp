<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RujukanSpesialis extends Model
{
    public $timestamps    = false;
    protected $table      = 'kkp_rujukan_spesialis';
    protected $primaryKey = 'rjksps_id';
    protected $fillable   = [
        'rjksps_psnrekdis_id',
        'rjksps_dokter_id',
        'rjksps_rs',
        'rjksps_keluhan',
        'rjksps_ssb',
        'rjksps_keterangan',
        'rjksps_created_by',
        'rjksps_created_date',
        'rjksps_updated_by',
        'rjksps_lastupdate',
        'rjksps_ip'
    ];
}
