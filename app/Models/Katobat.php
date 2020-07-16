<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Katobat extends Model
{
    public $timestamps    = false;
    protected $table      = 'kkp_kategori_obat';
    protected $primaryKey = 'katobat_id';
    protected $fillable   = [
        'katobat_nama',
        'katobat_deskripsi',
        'katobat_status',
        'katobat_created_by',
        'katobat_created_date',
        'katobat_updated_by',
        'katobat_lastupdate',
        'katobat_ip'
    ];
}
