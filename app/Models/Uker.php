<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uker extends Model
{
    public $timestamps    = false;
    protected $table      = 'kkp_unit_kerja';
    protected $primaryKey = 'uker_id';
    protected $fillable   = [
        'uker_nama',
        'uker_deskripsi',
        'uker_status',
        'uker_created_by',
        'uker_created_date',
        'uker_updated_by',
        'uker_lastupdate',
        'uker_ip'
    ];
}
