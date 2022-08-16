<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTable extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->string('login');
            $table->string('email');
            $table->string('address');
            $table->string('name');
            $table->string('occupation');
            $table->string('skill');
            $table->string('school');
            $table->string('degree');
            $table->string('food');
            $table->string('color');
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data');
    }
}
