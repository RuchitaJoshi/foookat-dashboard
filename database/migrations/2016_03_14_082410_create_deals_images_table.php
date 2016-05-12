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
            $table->string('image');
            $table->boolean('is_cover');
            $table->foreign('deal_id')->references('id')->on('deals')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::drop('deals_images');
    }
}
