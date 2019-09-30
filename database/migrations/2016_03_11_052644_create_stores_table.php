<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('overview');
            $table->string('address');
            $table->string('city');
            $table->integer('zip_code');
            $table->decimal('latitude',10,8);
            $table->decimal('longitude',10,8);
            $table->string('logo')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('phone_number')->nullable();
            $table->time('mon_open');
            $table->time('mon_close');
            $table->time('tue_open');
            $table->time('tue_close');
            $table->time('wed_open');
            $table->time('wed_close');
            $table->time('thu_open');
            $table->time('thu_close');
            $table->time('fri_open');
            $table->time('fri_close');
            $table->time('sat_open');
            $table->time('sat_close');
            $table->time('sun_open');
            $table->time('sun_close');
            $table->string('cover_image1');
            $table->string('cover_image2')->nullable();
            $table->string('cover_image3')->nullable();
            $table->integer('league_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->integer('business_id')->unsigned();
            $table->boolean('active')->default(false);
            $table->string('approved')->default('Pending');
            $table->text('note')->nullable();
            $table->foreign('league_id')->references('id')->on('leagues')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('business_id')->references('id')->on('businesses')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::drop('stores');
    }
}
