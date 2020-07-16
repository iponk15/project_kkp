<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKkpJenisObatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kkp_jenis_obat', function (Blueprint $table) {
            $table->increments('jenobat_id');
            $table->string('jenobat_nama', 100);
            $table->text('jenobat_deskripsi');
            $table->enum('jenobat_status', ['0','1','99'])->default('1');
            $table->bigInteger('jenobat_created_by')->unsigned();
            $table->dateTime('jenobat_created_date');
            $table->bigInteger('jenobat_updated_by')->unsigned()->nullable();
            $table->timestamp('jenobat_lastupdate')->useCurrent();
            $table->string('jenobat_ip', 15)->nullable();

            $table->foreign('jenobat_created_by')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');  

            $table->foreign('jenobat_updated_by')
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
        Schema::dropIfExists('kkp_jenis_obat');
    }
}
