<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SoalTemp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('soal_temp', function (Blueprint $table) {
            $table->increments('kd_soal');
            $table->longtext('pertanyaan');
            $table->longtext('jawab_a');
            $table->longtext('jawab_b');
            $table->longtext('jawab_c');
            $table->longtext('jawab_d');
            $table->string('jawaban',1);
            $table->integer('kd_materi');
            $table->string('username');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('soal');
    }
}
