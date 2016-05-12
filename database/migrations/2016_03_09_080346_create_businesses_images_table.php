<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessesImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('business_id')->unsigned();
            $table->string('image');
            $table->boolean('is_cover');
            $table->foreign('business_id')->references('id')->on('businesses')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('businesses_images');
    }
}
