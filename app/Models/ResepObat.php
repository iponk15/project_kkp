<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResepObat extends Model
{
    public $timestamps    = false;
    protected $table      = 'kkp_resep_obat';
    protected $primaryKey = 'resep_id';
    protected $fillable   = [
        'resep_psnrekdis_id',
        'resep_obat_id',
        'resep_jumlah',
        'resep_keterangan',
        'resep_created_by',
        'resep_created_date',
        'resep_updated_by',
        'resep_lastupdate',
        'resep_ip'
    ];
}
