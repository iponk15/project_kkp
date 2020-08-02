<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnRjklabDiagnosa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kkp_rujukan_lab', function (Blueprint $table) {
            $table->text('rjklab_diagnosa')->after('rjklab_psnrekdis_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kkp_rujukan_lab', function (Blueprint $table) {
            //
        });
    }
}
