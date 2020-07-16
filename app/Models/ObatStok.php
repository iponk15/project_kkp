<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ObatStok extends Model
{
    public $timestamps    = false;
    protected $table      = 'kkp_obat_stok';
    protected $primaryKey = 'stkbat_id';
    protected $fillable   = [
        'stkbat_obat_id',
        'stkbat_stok',
        'stkbat_keterangan',
        'stkbat_created_by',
        'stkbat_created_date',
        'stkbat_updated_by',
        'stkbat_lastupdate',
        'stkbat_ip'
    ];
}
