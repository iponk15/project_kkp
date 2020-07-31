<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDatatypeColumPasienGolonganId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kkp_pasien', function (Blueprint $table) {
            $table->integer('pasien_golongan_id')->unsigned()->change();

            $table->foreign('pasien_golongan_id')
                ->references('golongan_id')
                ->on('kkp_golongan')
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
        Schema::table('kkp_pasien', function (Blueprint $table) {
            //
        });
    }
}
