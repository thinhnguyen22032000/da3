<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab', function (Blueprint $table) {
            $table->increments('id_lab');
            $table->integer('id_lesson');
            $table->integer('id'); // id of student
            $table->dateTime('date_open');
            $table->dateTime('data_close');
            $table->dateTime('time_submit');
            $table->string('lab_file');
            $table->integer('submited');
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
        Schema::dropIfExists('lab');
    }
}
