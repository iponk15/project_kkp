<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableKkpSuratSakit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kkp_surat_sakit', function (Blueprint $table) {
            $table->increments('sskt_id');
            $table->integer('sskt_psnrekdis_id')->unsigned();
            $table->dateTime('sskt_tgl_mulai');
            $table->dateTime('sskt_tgl_akhir');
            $table->bigInteger('sskt_created_by')->unsigned();
            $table->dateTime('sskt_created_date');
            $table->timestamp('sskt_lastupdate')->useCurrent();
            $table->string('sskt_ip', 15)->nullable();

            $table->foreign('sskt_psnrekdis_id')
                ->references('psnrekdis_id')
                ->on('kkp_pasien_rekamedis')
                ->onUpdate('cascade')
                ->onDelete('cascade');  

            $table->foreign('sskt_created_by')
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
        Schema::dropIfExists('kkp_surat_sakit');
    }
}
