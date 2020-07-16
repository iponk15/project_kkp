<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jenobat extends Model
{
    public $timestamps    = false;
    protected $table      = 'kkp_jenis_obat';
    protected $primaryKey = 'jenobat_id';
    protected $fillable   = [
        'jenobat_nama',
        'jenobat_deskripsi',
        'jenobat_status',
        'jenobat_created_by',
        'jenobat_created_date',
        'jenobat_updated_by',
        'jenobat_lastupdate',
        'jenobat_ip'
    ];
}
