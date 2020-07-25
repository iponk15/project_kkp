<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPasienUkerIdToKkpOasien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kkp_pasien', function (Blueprint $table) {
            $table->integer('pasien_uker_id')->unsigned()->after('pasien_id');

            $table->foreign('pasien_uker_id')
                ->references('uker_id')
                ->on('kkp_unit_kerja')
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
