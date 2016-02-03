<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Materi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      /*  Schema::create('materi', function (Blueprint $table) {
            $table->increments('kd_materi');
            $table->string('judul_materi',100);
            $table->longtext('isi_materi');
            $table->string('thumbnail')->nullable();
            $table->string('video')->nullable();
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
       // Schema::drop('materi');
    }
}
