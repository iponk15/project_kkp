<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKkpObatStokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kkp_obat_stok', function (Blueprint $table) {
            $table->increments('stkbat_id');
            $table->integer('stkbat_obat_id')->unsigned();
            $table->bigInteger('stkbat_stok');
            $table->text('stkbat_keterangan');
            $table->bigInteger('stkbat_created_by')->unsigned();
            $table->dateTime('stkbat_created_date');
            $table->bigInteger('stkbat_updated_by')->unsigned()->nullable();
            $table->timestamp('stkbat_lastupdate')->useCurrent();
            $table->string('stkbat_ip', 15)->nullable();

            $table->foreign('stkbat_created_by')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');  

            $table->foreign('stkbat_updated_by')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('stkbat_obat_id')
                ->references('obat_id')
                ->on('kkp_obat')
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
        Schema::dropIfExists('kkp_obat_stok');
    }
}
