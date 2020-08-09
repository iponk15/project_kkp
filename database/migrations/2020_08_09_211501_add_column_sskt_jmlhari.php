<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSsktJmlhari extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kkp_surat_sakit', function (Blueprint $table) {
            $table->integer('sskt_jmlhari')->unsigned()->after('sskt_tgl_akhir');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kkp_surat_sakit', function (Blueprint $table) {
            //
        });
    }
}
