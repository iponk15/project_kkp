<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToKkpObatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kkp_obat', function (Blueprint $table) {
            $table->integer('obat_katobat_id')->unsigned()->after('obat_jenobat_id');

            $table->foreign('obat_katobat_id')
                ->references('katobat_id')
                ->on('kkp_kategori_obat')
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
        Schema::table('kkp_obat', function (Blueprint $table) {
            //
        });
    }
}
