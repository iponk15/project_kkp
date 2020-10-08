<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Odontogram extends Model
{
    public $timestamps    = false;
    protected $table      = 'kkp_odontogram';
    protected $primaryKey = 'odon_id';
    protected $fillable   = [
        'odon_psnrekdis_id',
        'odon_jenisp_id',
        'odon_kode',
        'odon_keterangan',
        'odon_status',
        'odon_createdby',
        'odon_createddate',
        'odon_lastupdate',
        'odon_updatedby',
        'odon_ip',
    ];
}
