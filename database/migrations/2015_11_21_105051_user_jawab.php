<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserJawab extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        /*Schema::create('userjawab', function (Blueprint $table) {
            $table->increments('kd_jawab');
            $table->integer('kd_evaluasi');
            $table->integer('kd_soal');
            $table->string('jawaban',1);
            $table->timestamps();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::drop('userjawab');
    }
}
