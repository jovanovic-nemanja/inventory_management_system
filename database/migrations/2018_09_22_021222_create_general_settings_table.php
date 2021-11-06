<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('site_name');
            $table->string('site_title')->nullable();

            $table->text('meta_title');
            $table->text('meta_keywords');
            $table->text('meta_description');
            
            $table->string('site_subtitle')->nullable();
            $table->text('site_desc')->nullable();
            $table->string('site_footer')->nullable();
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
        Schema::dropIfExists('general_settings');
    }
}
