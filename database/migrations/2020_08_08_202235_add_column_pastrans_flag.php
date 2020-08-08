<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPastransFlag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kkp_pasien_trans', function (Blueprint $table) {
            $table->enum('pastrans_flag', ['1','2','3','4','5','6','7','8','9'])->default(NULL)->after('pastrans_status');
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
