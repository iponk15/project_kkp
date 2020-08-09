<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratSakit extends Model
{
    public $timestamps    = false;
    protected $table      = 'kkp_surat_sakit';
    protected $primaryKey = 'sskt_id';
    protected $fillable   = [
        'sskt_psnrekdis_id',
        'sskt_tgl_mulai',
        'sskt_tgl_akhir',
        'sskt_jmlhari',
        'sskt_created_by',
        'sskt_created_date',
        'sskt_updated_by',
        'sskt_lastupdate',
        'sskt_ip'
    ];
}
