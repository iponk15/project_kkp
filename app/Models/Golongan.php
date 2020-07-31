<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    public $timestamps    = false;
    protected $table      = 'kkp_golongan';
    protected $primaryKey = 'golongan_id';
    protected $fillable   = [
        'golongan_kode',
        'golongan_nama',
        'golongan_deskripsi',
        'golongan_status',
        'golongan_created_by',
        'golongan_created_date',
        'golongan_updated_by',
        'golongan_lastupdate',
        'golongan_ip'
    ];
}
