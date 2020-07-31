<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResepNote extends Model
{
    public $timestamps    = false;
    protected $table      = 'kkp_resep_note';
    protected $primaryKey = 'resnot_id';
    protected $fillable   = [
        'resnote_psnrekdis_id',
        'resnote_keterangan'
    ];
}
