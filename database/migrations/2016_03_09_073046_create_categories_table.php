<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->decimal('commission',5,2);
            $table->integer('order')->unsigned();
            $table->string('image1')->nullable();
            $table->boolean('cover_image1')->default(false);
            $table->string('image2')->nullable();
            $table->boolean('cover_image2')->default(false);
            $table->string('image3')->nullable();
            $table->boolean('cover_image3')->default(false);
            $table->boolean('active')->default(false);
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
        Schema::drop('categories');
    }
}
