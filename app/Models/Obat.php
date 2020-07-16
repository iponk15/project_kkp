<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    public $timestamps    = false;
    protected $table      = 'kkp_obat';
    protected $primaryKey = 'obat_id';
    protected $fillable   = [
        'obat_jenobat_id',
        'obat_katobat_id',
        'obat_nama',
        'obat_deskripsi',
        'obat_status',
        'obat_created_by',
        'obat_created_date',
        'obat_updated_by',
        'obat_lastupdate',
        'obat_ip'
    ];
}
