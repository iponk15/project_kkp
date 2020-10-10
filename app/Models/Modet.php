<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modet extends Model
{
    public $timestamps    = false;
    protected $table      = 'kkp_modon_detail';
    protected $primaryKey = 'modet_id';
    protected $fillable   = [
        'modet_modon_id',
        'modet_kode',
        'modet_points',
        'modet_order',
        'modet_status',
        'modet_createdby',
        'modet_createddate',
        'modet_lastupdate',
        'modet_updatedby',
        'modet_ip',
    ];
}
