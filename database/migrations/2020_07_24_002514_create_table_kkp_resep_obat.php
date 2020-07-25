<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableKkpResepObat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kkp_resep_obat', function (Blueprint $table) {
            $table->increments('resep_id');
            $table->integer('resep_psnrekdis_id')->unsigned();
            $table->integer('resep_obat_id')->unsigned();
            $table->integer('resep_jumlah')->unsigned();
            $table->text('resep_keterangan');
            $table->bigInteger('resep_created_by')->unsigned();
            $table->dateTime('resep_created_date');
            $table->bigInteger('resep_updated_by')->unsigned()->nullable();
            $table->timestamp('resep_lastupdate')->useCurrent();
            $table->string('resep_ip', 15)->nullable();

            $table->foreign('resep_psnrekdis_id')
                ->references('psnrekdis_id')
                ->on('kkp_pasien_rekamedis')
                ->onUpdate('cascade')
                ->onDelete('cascade');  

            $table->foreign('resep_obat_id')
                ->references('obat_id')
                ->on('kkp_obat')
                ->onUpdate('cascade')
                ->onDelete('cascade');  
            
            $table->foreign('resep_created_by')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');  

            $table->foreign('resep_updated_by')
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
        Schema::dropIfExists('kkp_resep_obat');
    }
}
