<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPsnrekdisIsLab extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kkp_pasien_rekamedis', function (Blueprint $table) {
            $table->enum('psnrekdis_is_lab', ['0', '1'])->default('0')->nullable()->after('psnrekdis_obj_pfeksbwh');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kkp_pasien_rekamedis', function (Blueprint $table) {
            //
        });
    }
}
