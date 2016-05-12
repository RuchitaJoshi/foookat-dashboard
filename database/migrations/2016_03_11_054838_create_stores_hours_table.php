<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores_hours', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id')->unsigned();
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
            $table->foreign('store_id')->references('id')->on('stores')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::drop('stores_hours');
    }
}
