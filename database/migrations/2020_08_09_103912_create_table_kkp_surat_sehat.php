<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableKkpSuratSehat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kkp_surat_sehat', function (Blueprint $table) {
            $table->increments('ssht_id');
            $table->integer('ssht_psnrekdis_id')->unsigned();
            $table->enum('ssht_keperluan', ['1','2','3','4'])->default(NULL)->nullable();
            $table->text('ssht_keterangan')->nullable();
            $table->bigInteger('ssht_created_by')->unsigned();
            $table->dateTime('ssht_created_date');
            $table->timestamp('ssht_lastupdate')->useCurrent();
            $table->string('ssht_ip', 15)->nullable();

            $table->foreign('ssht_psnrekdis_id')
                ->references('psnrekdis_id')
                ->on('kkp_pasien_rekamedis')
                ->onUpdate('cascade')
                ->onDelete('cascade');  

            $table->foreign('ssht_created_by')
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
        Schema::dropIfExists('kkp_surat_sehat');
    }
}
