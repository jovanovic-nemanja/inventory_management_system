<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHowtosellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('howtosells', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('title', '1024');
            $table->string('content', '2048');
            $table->string('image');
            $table->datetime('sign_date');
            
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
        Schema::dropIfExists('howtosells');
    }
}
