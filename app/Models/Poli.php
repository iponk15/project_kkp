<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    public $timestamps    = false;
    protected $table      = 'kkp_poli';
    protected $primaryKey = 'poli_id';
    protected $fillable   = [
        'poli_nama',
        'poli_deskripsi',
        'poli_status',
        'poli_created_by',
        'poli_created_date',
        'poli_updated_by',
        'poli_lastupdate',
        'poli_ip'
    ];
}
