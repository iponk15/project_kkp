<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKkpKategoriObatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kkp_kategori_obat', function (Blueprint $table) {
            $table->increments('katobat_id');
            $table->string('katobat_nama', 100);
            $table->text('katobat_deskripsi');
            $table->enum('katobat_status', ['0','1','99'])->default('1');
            $table->bigInteger('katobat_created_by')->unsigned();
            $table->dateTime('katobat_created_date');
            $table->bigInteger('katobat_updated_by')->unsigned()->nullable();
            $table->timestamp('katobat_lastupdate')->useCurrent();
            $table->string('katobat_ip', 15)->nullable();
            
            $table->foreign('katobat_created_by')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');  

            $table->foreign('katobat_updated_by')
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
        Schema::dropIfExists('kkp_kategori_obat');
    }
}
