<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestcallbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requestcallback', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('customer_id');
            $table->string('name');
            $table->string('email_add');
            $table->string('mobile');
            
            $table->integer('product_id');
            $table->string('prod_name');
            
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
        Schema::dropIfExists('requestcallback');
    }
}
