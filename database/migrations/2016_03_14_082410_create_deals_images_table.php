<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealsImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals_images', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('deal_id')->unsigned();
            $table->string('image1')->nullable();
            $table->boolean('cover_image1')->default(false);;
            $table->string('image2')->nullable();
            $table->boolean('cover_image2')->default(false);;
            $table->string('image3')->nullable();
            $table->boolean('cover_image3')->default(false);;
            $table->foreign('deal_id')->references('id')->on('deals')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('deals_images');
    }
}
