<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    public $timestamps    = false;
    protected $table      = 'kkp_pasien';
    protected $primaryKey = 'pasien_id';
    protected $fillable   = [
        'pasien_uker_id',
        'pasien_norekdis',
        'pasien_nama',
        'pasien_tgllahir',
        'pasien_jk',
        'pasien_umur',
        'pasien_golongan_id',
        'pasien_alamat',
        'pasien_alergi_obat',
        'pasien_telp',
        'pasien_email',
        'pasien_status',
        'pasien_created_by',
        'pasien_created_date',
        'pasien_updated_by',
        'pasien_lastupdate',
        'pasien_ip'
    ];
}
