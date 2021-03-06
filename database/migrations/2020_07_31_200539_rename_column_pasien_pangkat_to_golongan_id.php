<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnPasienPangkatToGolonganId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kkp_pasien', function (Blueprint $table) {
            $table->renameColumn('pasien_pangkat', 'pasien_golongan_id');
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
