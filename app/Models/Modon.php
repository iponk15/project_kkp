<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modon extends Model
{
    public $timestamps    = false;
    protected $table      = 'kkp_modon';
    protected $primaryKey = 'modon_id';
    protected $fillable   = [
        'modon_kode',
        'modon_no',
        'modon_tipe',
        'modon_transform',
        'modon_order',
        'modon_status',
        'modon_createdby',
        'modon_createddate',
        'modon_lastupdate',
        'modon_updatedby',
        'modon_ip',
    ];

    public static function getModon()
    {
        $modon = Modon::selectRaw('modon_id,modon_kode,modon_no,modon_transform')
            ->where('modon_status', '1')
            ->orderBy('modon_order', 'ASC')
            ->get();

        $modet = Modet::selectRaw('modet_modon_id,modet_kode,modet_points,modet_order')
            ->where('modet_status', '1')
            ->orderBy('modet_order', 'ASC')
            ->get();
        
        foreach ($modon as $key => $value) {
            $temp[] = [
                'modon_id'        => $value->modon_id,
                'modon_kode'      => $value->modon_kode,
                'modon_no'        => $value->modon_no,
                'modon_tipe'      => $value->modon_tipe,
                'modon_transform' => $value->modon_transform,
                'modon_order'     => $value->modon_order,
                'modon_detail'    => collect($modet)->where('modet_modon_id', $value->modon_id)->toArray()
            ];
        }

        return $temp;
    }
}
