<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableKkpResepNote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kkp_resep_note', function (Blueprint $table) {
            $table->increments('resnot_id');
            $table->integer('resnote_psnrekdis_id')->unsigned();
            $table->text('resnote_keterangan');

            $table->foreign('resnote_psnrekdis_id')
                ->references('psnrekdis_id')
                ->on('kkp_pasien_rekamedis')
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
        Schema::dropIfExists('kkp_resep_note');
    }
}
