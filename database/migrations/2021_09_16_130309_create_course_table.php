<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course', function (Blueprint $table) {
            $table->increments('id_course');
            $table->string('id_cat')->default(0);
            $table->integer('id');
            $table->string('name');
            $table->string('price');
            $table->string('code');
            $table->string('img');
            $table->dateTime('date_start');
            $table->dateTime('date_end');
            $table->integer('step');
            $table->string('desc');
            $table->string('status')->default(0);
            $table->integer('member')->default(0);
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
        Schema::dropIfExists('course');
    }
}
