<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKkpPoliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kkp_poli', function (Blueprint $table) {
            $table->increments('poli_id');
            $table->string('poli_nama', 100);
            $table->text('poli_deskripsi');
            $table->enum('poli_status', ['0','1','99'])->default('1');
            $table->bigInteger('poli_created_by')->unsigned();
            $table->dateTime('poli_created_date');
            $table->bigInteger('poli_updated_by')->unsigned()->nullable();
            $table->timestamp('poli_lastupdate')->useCurrent();
            $table->string('poli_ip', 15)->nullable();
            
            $table->foreign('poli_created_by')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');  

            $table->foreign('poli_updated_by')
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
        Schema::dropIfExists('kkp_poli');
    }
}
