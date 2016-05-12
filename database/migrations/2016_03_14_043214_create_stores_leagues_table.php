<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresLeaguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores_leagues', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id')->unsigned();
            $table->integer('league_id')->unsigned();
            $table->foreign('store_id')->references('id')->on('stores')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('league_id')->references('id')->on('leagues')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::drop('stores_leagues');
    }
}
