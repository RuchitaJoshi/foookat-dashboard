<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealsRecurrencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals_recurrences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('deal_id')->unsigned();
            $table->boolean('mon');
            $table->boolean('tue');
            $table->boolean('wed');
            $table->boolean('thu');
            $table->boolean('fri');
            $table->boolean('sat');
            $table->boolean('sun');
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
        Schema::drop('deals_recurrences');
    }
}
