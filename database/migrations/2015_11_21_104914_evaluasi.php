<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Evaluasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('evaluasi', function (Blueprint $table) {
        //     $table->increments('kd_evaluasi');
        //     $table->string('username',11);
        //     $table->double('nilai',14.2);
        //     $table->string('keterangan',200);
        //     $table->integer('kd_materi');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::drop('evaluasi');
    }
}
