<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKkpLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kkp_log', function (Blueprint $table) {
            $table->increments('log_id');
            $table->integer('log_psntrans_id')->unsigned();
            $table->string('log_subjek')->nullable();
            $table->text('log_keterangan')->nullable();
            $table->bigInteger('log_created_by')->unsigned();
            $table->dateTime('log_created_date');
            $table->string('log_ip', 15);

            $table->foreign('log_psntrans_id')
                ->references('psntrans_id')
                ->on('kkp_pasien_trans')
                ->onUpdate('cascade')
                ->onDelete('cascade');  

            $table->foreign('log_created_by')
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
        Schema::dropIfExists('kkp_log');
    }
}
