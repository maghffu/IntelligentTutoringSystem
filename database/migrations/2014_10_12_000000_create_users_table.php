<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      /*  Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nim',11);
            $table->string('nama_lengkap',50);
            $table->string('alamat',150);
            $table->string('username')->unique();
            $table->string('password', 60);
            $table->integer('status');
            $table->rememberToken();
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
        // Schema::drop('users');
    }
}
