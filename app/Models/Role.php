<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps    = false;
    protected $table      = 'kkp_role';
    protected $primaryKey = 'role_id';
    protected $fillable   = [
        'role_nama',
        'role_kode',
        'role_deskripsi',
        'role_status',
        'role_created_by',
        'role_created_date',
        'role_updated_by',
        'role_lastupdate',
        'role_ip'
    ];
}
