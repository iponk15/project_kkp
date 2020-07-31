<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableKkpGolongan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kkp_golongan', function (Blueprint $table) {
            $table->increments('golongan_id');
            $table->string('golongan_kode', 10);
            $table->string('golongan_nama', 100);
            $table->text('golongan_deskripsi');
            $table->enum('golongan_status', ['0','1','99'])->default('1');
            $table->bigInteger('golongan_created_by')->unsigned();
            $table->dateTime('golongan_created_date');
            $table->bigInteger('golongan_updated_by')->unsigned()->nullable();
            $table->timestamp('golongan_lastupdate')->useCurrent();
            $table->string('golongan_ip', 15)->nullable();

            $table->foreign('golongan_created_by')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');  

            $table->foreign('golongan_updated_by')
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
        Schema::dropIfExists('kkp_golongan');
    }
}
