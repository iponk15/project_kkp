<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogTrans extends Model
{
    public $timestamps    = false;
    protected $table      = 'kkp_log';
    protected $primaryKey = 'log_id';
    protected $fillable   = [
        'log_psntrans_id',
        'log_subjek',
        'log_keterangan',
        'log_created_by',
        'log_created_date',
        'log_ip'
    ];
}
