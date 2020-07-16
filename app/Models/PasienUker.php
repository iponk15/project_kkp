<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasienUker extends Model
{
    public $timestamps    = false;
    protected $table      = 'kkp_pasien_uker';
    protected $primaryKey = 'pasker_id';
    protected $fillable   = [
        'pasker_pasien_id',
        'pasker_uker_id'
    ];
}
