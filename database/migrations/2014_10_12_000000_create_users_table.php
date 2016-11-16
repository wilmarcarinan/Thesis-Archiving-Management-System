<?php

use Illuminate\Support\Facades\Schema;
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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('StudentID')->unique();
            $table->string('FirstName');
            $table->string('LastName');
            $table->string('MiddleName');
            $table->string('Course');
            $table->string('College');
            $table->string('Email')->unique();
            $table->string('Password');
            $table->string('Role')->default('User');
            $table->string('Status')->default('Enabled');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
