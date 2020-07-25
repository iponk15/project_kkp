<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnResepStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kkp_pasien_rekamedis', function (Blueprint $table) {
            $table->enum('psnrekdis_resep_status', ['0', '1'])->default('0')->nullable()->after('psnrekdis_is_lab');
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
