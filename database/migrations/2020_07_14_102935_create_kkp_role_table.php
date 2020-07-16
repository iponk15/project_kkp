<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKkpRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kkp_role', function (Blueprint $table) {
            $table->increments('role_id');
            $table->string('role_nama', 100);
            $table->text('role_deskripsi');
            $table->enum('role_status', ['0','1','99'])->default('1');
            $table->bigInteger('role_created_by')->unsigned();
            $table->dateTime('role_created_date');
            $table->bigInteger('role_updated_by')->unsigned()->nullable();
            $table->timestamp('role_lastupdate')->useCurrent();
            $table->string('role_ip', 15)->nullable();

            $table->foreign('role_created_by')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');  

            $table->foreign('role_updated_by')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('kkp_role');
    }
}
