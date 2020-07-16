<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKkpPasienUkerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kkp_pasien_uker', function (Blueprint $table) {
            $table->increments('pasker_id');
            $table->integer('pasker_pasien_id')->unsigned();
            $table->integer('pasker_uker_id')->unsigned();

            $table->foreign('pasker_pasien_id')
                ->references('pasien_id')
                ->on('kkp_pasien')
                ->onUpdate('cascade')
                ->onDelete('cascade');  

            $table->foreign('pasker_uker_id')
                ->references('uker_id')
                ->on('kkp_unit_kerja')
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
        Schema::dropIfExists('kkp_pasien_uker');
    }
}
