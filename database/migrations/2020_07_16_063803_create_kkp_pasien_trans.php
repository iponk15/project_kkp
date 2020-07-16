<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKkpPasienTrans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kkp_pasien_trans', function (Blueprint $table) {
            $table->increments('psntrans_id');
            $table->integer('pastrans_pasien_id');
            $table->enum('pastrans_status', ['1','2','3','4','5','6'])->default(NULL);
            $table->bigInteger('pastrans_created_by')->unsigned();
            $table->dateTime('pastrans_created_date');
            $table->bigInteger('pastrans_updated_by')->unsigned()->nullable();
            $table->timestamp('pastrans_lastupdate')->useCurrent();

            $table->foreign('pastrans_created_by')
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
        Schema::dropIfExists('kkp_pasien_trans');
    }
}
