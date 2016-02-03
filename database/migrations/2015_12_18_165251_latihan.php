<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Latihan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       /* Schema::create('latihan', function (Blueprint $table) {
            $table->increments('kd_latihan');
            $table->longtext('panduan');
            $table->longtext('hasil');
            $table->integer('kd_materi');
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
        // Schema::drop('latihan');
    }
}
