<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableKkpRujukanLab extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kkp_rujukan_lab', function (Blueprint $table) {
            $table->increments('rjklab_id');
            $table->integer('rjklab_psnrekdis_id')->unsigned();
            $table->enum('rjklab_htg_rutin', ['0', '1'])->default(null)->nullable();
            $table->enum('rjklab_htg_hb', ['0', '1'])->default(null)->nullable();
            $table->enum('rjklab_htg_hematokrit', ['0', '1'])->default(null)->nullable();
            $table->enum('rjklab_htg_eritrosit', ['0', '1'])->default(null)->nullable();
            $table->enum('rjklab_htg_lekosit', ['0', '1'])->default(null)->nullable();
            $table->enum('rjklab_htg_trombosit', ['0', '1'])->default(null)->nullable();
            $table->enum('rjklab_htg_led', ['0', '1'])->default(null)->nullable();
            $table->enum('rjklab_htg_mmm', ['0', '1'])->default(null)->nullable();
            $table->enum('rjklab_htg_dc', ['0', '1'])->default(null)->nullable();
            $table->enum('rjklab_htg_gd', ['0', '1'])->default(null)->nullable();
            $table->enum('rjklab_htg_rhesus', ['0', '1'])->default(null)->nullable();
            $table->enum('rjklab_kk_ld_kt', ['0', '1'])->default(null)->nullable();
            $table->enum('rjklab_kk_ld_kh', ['0', '1'])->default(null)->nullable();
            $table->enum('rjklab_kk_ld_kl', ['0', '1'])->default(null)->nullable();
            $table->enum('rjklab_kk_ld_trig', ['0', '1'])->default(null)->nullable();
            $table->enum('rjklab_kk_fh_ast', ['0', '1'])->default(null)->nullable();
            $table->enum('rjklab_kk_fh_alt', ['0', '1'])->default(null)->nullable();
            $table->enum('rjklab_kk_fg_ureum', ['0', '1'])->default(null)->nullable();
            $table->enum('rjklab_kk_fg_kreatinin', ['0', '1'])->default(null)->nullable();
            $table->enum('rjklab_kk_fg_au', ['0', '1'])->default(null)->nullable();
            $table->enum('rjklab_kk_gd_gds', ['0', '1'])->default(null)->nullable();
            $table->enum('rjklab_kk_gd_gdp', ['0', '1'])->default(null)->nullable();
            $table->enum('rjklab_kk_gd_gdj', ['0', '1'])->default(null)->nullable();
            $table->enum('rjklab_kk_gd_hba', ['0', '1'])->default(null)->nullable();
            $table->enum('rjklab_is_widal', ['0', '1'])->default(null)->nullable();
            $table->enum('rjklab_is_hbs', ['0', '1'])->default(null)->nullable();
            $table->enum('rjklab_is_ah', ['0', '1'])->default(null)->nullable();
            $table->enum('rjklab_urine_hcg', ['0', '1'])->default(null)->nullable();
            $table->enum('rjklab_urine_narkoba', ['0', '1'])->default(null)->nullable();
            $table->enum('rjklab_urine_ul', ['0', '1'])->default(null)->nullable();
            $table->bigInteger('rjklab_created_by')->unsigned();
            $table->dateTime('rjklab_created_date');
            $table->bigInteger('rjklab_updated_by')->unsigned()->nullable();
            $table->timestamp('rjklab_lastupdate')->useCurrent();
            $table->string('rjklab_ip', 15)->nullable();

            $table->foreign('rjklab_psnrekdis_id')
                ->references('psnrekdis_id')
                ->on('kkp_pasien_rekamedis')
                ->onUpdate('cascade')
                ->onDelete('cascade');  
            
            $table->foreign('rjklab_created_by')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');  

            $table->foreign('rjklab_updated_by')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kkp_rujukan_lab');
    }
}
