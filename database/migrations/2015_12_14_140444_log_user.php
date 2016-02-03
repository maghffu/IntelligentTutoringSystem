<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LogUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('log_user', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->String('kd_belajar',1);
        //     $table->integer('skor');
        //     $table->timestamps();
        //     $table->string('username',11);
        //     $table->integer('kd_materi');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::drop('log_user');
    }
}
