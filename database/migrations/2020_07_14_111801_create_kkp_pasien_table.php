<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKkpPasienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kkp_pasien', function (Blueprint $table) {
            $table->increments('pasien_id');
            $table->bigInteger('pasien_norekdis');
            $table->string('pasien_nama', 100);
            $table->date('pasien_tgllahir');
            $table->enum('pasien_jk', ['L', 'P'])->default(NULL);
            $table->integer('pasien_umur')->nullable();
            $table->string('pasien_pangkat', 100)->nullable();
            $table->text('pasien_alamat');
            $table->text('pasien_alergi_obat');
            $table->string('pasien_telp', 50)->nullable();
            $table->string('pasien_email', 100);
            $table->enum('pasien_status', ['0','1','99'])->default('1');
            $table->bigInteger('pasien_created_by')->unsigned();
            $table->dateTime('pasien_created_date');
            $table->bigInteger('pasien_updated_by')->unsigned()->nullable();
            $table->timestamp('pasien_lastupdate')->useCurrent();
            $table->string('pasien_ip', 15)->nullable();

            $table->foreign('pasien_created_by')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');  

            $table->foreign('pasien_updated_by')
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
        Schema::dropIfExists('kkp_pasien');
    }
}
