<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyint('favorite');
            $table->int('user_id')->unsigned();
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            $table->int('file_id')->unsigned();
            $table->foreign('file_id')
                  ->references('id')->on('files')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('favorites');
    }
}
