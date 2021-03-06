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
            $table->string('SubjectArea');
            $table->string('Category');
            $table->string('Authors');
            $table->string('Course');
            $table->string('Adviser');
            $table->string('FilePath');
            $table->enum('Status',['Active','Inactive'])->default('Active');
            $table->date('thesis_date')->nullable();
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
