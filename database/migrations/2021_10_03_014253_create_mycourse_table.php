<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMycourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mycourse', function (Blueprint $table) {
            $table->increments('id_mycourse');
            $table->integer('id');
            $table->integer('id_course');
            $table->string('code_confirm')->default(0);
            $table->integer('completed')->default(0); // chua hoan thanh
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
        Schema::dropIfExists('mycourse');
    }
}
