<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnIsLabResepStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kkp_pasien_rekamedis', function (Blueprint $table) {
            $table->dropColumn(['psnrekdis_is_lab', 'psnrekdis_resep_status']);
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
