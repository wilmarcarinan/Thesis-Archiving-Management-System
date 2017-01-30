<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('FileTitle')->unique();
            $table->text('Abstract');
            $table->string('Category');
            $table->string('Authors');
            $table->string('Adviser');
            $table->string('FilePath');
            $table->enum('Status',['Active','Inactive'])->default('Active');
            $table->integer('no_of_views')->unsigned();
            $table->date('thesis_date');
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
        Schema::dropIfExists('files');
    }
}
