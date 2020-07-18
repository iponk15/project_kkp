<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKkpPasienRekamedis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kkp_pasien_rekamedis', function (Blueprint $table) {
            $table->increments('psnrekdis_id');
            $table->integer('psnrekdis_psntrans_id')->unsigned();
            $table->text('psnrekdis_sbj_kelutm');
            $table->text('psnrekdis_sbj_keltam');
            $table->text('psnrekdis_sbj_riwpktskr')->nullable(); // subject riwayat penyakit sekarang
            $table->text('psnrekdis_sbj_riwpktdhl')->nullable(); // subject riwayat penyakit dahulu
            $table->text('psnrekdis_sbj_riwpktklg')->nullable(); // subject riwayat penyakit keluarga
            $table->text('psnrekdis_sbj_riwpktkalg')->nullable(); // subject riwayat penyakit alergi
            $table->text('psnrekdis_asm_digkrt')->nullable(); // assesment diagnosa keperawatan
            $table->text('psnrekdis_pln_rak')->nullable(); // planning rencana asuhan keperawatan
            $table->string('psnrekdis_obj_vstd', 15)->nullable(); // objektif vital sign tekanan darah
            $table->string('psnrekdis_obj_vshr', 10)->nullable(); 
            $table->string('psnrekdis_obj_vsrr', 10)->nullable(); 
            $table->string('psnrekdis_obj_vst', 10)->nullable(); 
            $table->string('psnrekdis_obj_sgbb', 5)->nullable(); // objektif vital sign berat badan
            $table->string('psnrekdis_obj_sgtb', 5)->nullable(); // objektif vital sign tinggi badan
            $table->string('psnrekdis_obj_sgimt', 5)->nullable();
            $table->string('psnrekdis_obj_pfkpl', 50)->nullable(); // objektif pemeriksaan fisik kepala
            $table->string('psnrekdis_obj_pflhr', 50)->nullable(); // objektif pemeriksaan fisik leher
            $table->string('psnrekdis_obj_pftcor', 50)->nullable(); // objektif pemeriksaan fisik thorax cor
            $table->string('psnrekdis_obj_pftpul', 50)->nullable(); // objektif pemeriksaan fisik thorax pulmo
            $table->string('psnrekdis_obj_pfabd', 50)->nullable(); // objektif pemeriksaan fisik abdomen
            $table->string('psnrekdis_obj_pfeksats', 50)->nullable(); // objektif pemeriksaan fisik ekstremitas atas
            $table->string('psnrekdis_obj_pfeksbwh', 50)->nullable(); // objektif pemeriksaan fisik ekstremitas bawah
            $table->bigInteger('psnrekdis_created_by')->unsigned();
            $table->dateTime('psnrekdis_created_date');
            $table->string('psnrekdis_ip', 15);

            $table->foreign('psnrekdis_psntrans_id')
                ->references('psntrans_id')
                ->on('kkp_pasien_trans')
                ->onUpdate('cascade')
                ->onDelete('cascade');  

            $table->foreign('psnrekdis_created_by')
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
        Schema::dropIfExists('kkp_pasien_rekamedis');
    }
}
