<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenispGigi extends Model
{
    public $timestamps    = false;
    protected $table      = 'kkp_jenisp_gigi';
    protected $primaryKey = 'jenisp_id';
    protected $fillable   = [
        'jenisp_id',
        'jenisp_nama',
        'jenisp_warna',
        'jenisp_deskripsi',
        'jenisp_status',
        'jenisp_createddate',
        'jenisp_createdby',
        'jenisp_lastupdate',
        'jenisp_updatedby',
        'jenisp_ip'
    ];
}
