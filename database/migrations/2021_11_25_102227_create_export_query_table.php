<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExportQueryTable extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::create('export_query', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('elapsed')->default(null);
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('export_query');
    }
}
