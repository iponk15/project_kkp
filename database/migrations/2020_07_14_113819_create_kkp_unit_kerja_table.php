<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKkpUnitKerjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kkp_unit_kerja', function (Blueprint $table) {
            $table->increments('uker_id');
            $table->string('uker_nama', 100);
            $table->text('uker_deskripsi');
            $table->enum('uker_status', ['0','1','99'])->default('1');
            $table->bigInteger('uker_created_by')->unsigned();
            $table->dateTime('uker_created_date');
            $table->bigInteger('uker_updated_by')->unsigned()->nullable();
            $table->timestamp('uker_lastupdate')->useCurrent();
            $table->string('uker_ip', 15)->nullable();
            
            $table->foreign('uker_created_by')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');  

            $table->foreign('uker_updated_by')
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
        Schema::dropIfExists('kkp_unit_kerja');
    }
}
