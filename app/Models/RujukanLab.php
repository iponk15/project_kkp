<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RujukanLab extends Model
{
    public $timestamps    = false;
    protected $table      = 'kkp_rujukan_lab';
    protected $primaryKey = 'rjklab_id';
    protected $fillable   = [
        'rjklab_psnrekdis_id',
        'rjklab_diagnosa',
        'rjklab_htg_rutin',
        'rjklab_htg_hb',
        'rjklab_htg_hematokrit',
        'rjklab_htg_eritrosit',
        'rjklab_htg_lekosit',
        'rjklab_htg_trombosit',
        'rjklab_htg_led',
        'rjklab_htg_mmm',
        'rjklab_htg_dc',
        'rjklab_htg_gd',
        'rjklab_htg_rhesus',
        'rjklab_kk_ld_kt',
        'rjklab_kk_ld_kh',
        'rjklab_kk_ld_kl',
        'rjklab_kk_ld_trig',
        'rjklab_kk_fh_ast',
        'rjklab_kk_fh_alt',
        'rjklab_kk_fg_ureum',
        'rjklab_kk_fg_kreatinin',
        'rjklab_kk_fg_au',
        'rjklab_kk_gd_gds',
        'rjklab_kk_gd_gdp',
        'rjklab_kk_gd_gdj',
        'rjklab_kk_gd_hba',
        'rjklab_is_widal',
        'rjklab_is_hbs',
        'rjklab_is_ah',
        'rjklab_urine_hcg',
        'rjklab_urine_narkoba',
        'rjklab_urine_ul',
        'rjklab_created_by',
        'rjklab_created_date',
        'rjklab_updated_by',
        'rjklab_lastupdate',
        'rjklab_ip'
    ];
}
