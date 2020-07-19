<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePositionPastransDokterId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kkp_pasien_trans', function (Blueprint $table) {
            $table->bigInteger('pastrans_dokter_id')->unsigned()->after('pastrans_pasien_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kkp_pasien_trans', function (Blueprint $table) {
            //
        });
    }
}
