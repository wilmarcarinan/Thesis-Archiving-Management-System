<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookmarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookmarks', function (Blueprint $table) {
            // $table->increments('id');
            // $table->tinyInteger('to-read');
            // $table->integer('user_id')->unsigned();
            // $table->foreign('user_id')
            //       ->references('id')->on('users')
            //       ->onDelete('cascade');
            // $table->integer('file_id')->unsigned();
            // $table->foreign('file_id')
            //       ->references('id')->on('files')
            //       ->onDelete('cascade');
            // $table->timestamps();

            $table->primary(['user_id','file_id']);
            $table->integer('user_id')->index();
            $table->integer('file_id')->index();
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
        Schema::dropIfExists('bookmarks');
    }
}
