<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableKkpRujukanSpesialis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kkp_rujukan_spesialis', function (Blueprint $table) {
            $table->increments('rjksps_id');
            $table->integer('rjksps_psnrekdis_id')->unsigned();
            $table->bigInteger('rjksps_dokter_id')->unsigned();
            $table->text('rjksps_rs');
            $table->text('rjksps_keluhan');
            $table->text('rjksps_ssb');
            $table->text('rjksps_keterangan');
            $table->bigInteger('rjksps_created_by')->unsigned();
            $table->dateTime('rjksps_created_date');
            $table->bigInteger('rjksps_updated_by')->unsigned()->nullable();
            $table->timestamp('rjksps_lastupdate')->useCurrent();
            $table->string('rjksps_ip', 15)->nullable();

            $table->foreign('rjksps_psnrekdis_id')
                ->references('psnrekdis_id')
                ->on('kkp_pasien_rekamedis')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('rjksps_dokter_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('rjksps_created_by')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('rjksps_updated_by')
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
        Schema::dropIfExists('kkp_rujukan_spesialis');
    }
}
