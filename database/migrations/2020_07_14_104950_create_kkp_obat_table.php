<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKkpObatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kkp_obat', function (Blueprint $table) {
            $table->increments('obat_id');
            $table->integer('obat_jenobat_id')->unsigned();
            $table->string('obat_nama', 100);
            $table->text('obat_deskripsi');
            $table->enum('obat_status', ['0','1','99'])->default('1');
            $table->bigInteger('obat_created_by')->unsigned();
            $table->dateTime('obat_created_date');
            $table->bigInteger('obat_updated_by')->unsigned()->nullable();
            $table->timestamp('obat_lastupdate')->useCurrent();
            $table->string('obat_ip', 15)->nullable();
            
            $table->foreign('obat_created_by')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');  

            $table->foreign('obat_updated_by')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('obat_jenobat_id')
                ->references('jenobat_id')
                ->on('kkp_jenis_obat')
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
        Schema::dropIfExists('kkp_obat');
    }
}
