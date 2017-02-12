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
            $table->string('MiddleName');
            $table->string('LastName');
            $table->string('Course');
            $table->string('College');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('Role',['Admin','User', 'Encoder'])->default('User');
            $table->enum('Status',['Active','Inactive'])->default('Active');
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
