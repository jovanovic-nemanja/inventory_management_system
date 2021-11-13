<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBatchProductPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_product_prices', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('batch_prod_id');
            $table->integer('container_id');
            $table->text('price');
            $table->integer('vat');
            $table->date_time('sign_date');

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
        Schema::dropIfExists('batch_product_prices');
    }
}
