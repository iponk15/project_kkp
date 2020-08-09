<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratSehat extends Model
{
    public $timestamps    = false;
    protected $table      = 'kkp_surat_sehat';
    protected $primaryKey = 'ssht_id';
    protected $fillable   = [
        'ssht_psnrekdis_id',
        'ssht_keperluan',
        'ssht_keterangan',
        'ssht_created_by',
        'ssht_created_date',
        'ssht_updated_by',
        'ssht_lastupdate',
        'ssht_ip'
    ];
}
