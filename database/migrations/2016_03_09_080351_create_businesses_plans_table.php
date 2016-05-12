<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessesPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('business_id')->unsigned();
            $table->integer('membership_plan_id')->unsigned();
            $table->foreign('business_id')->references('id')->on('businesses')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('membership_plan_id')->references('id')->on('membership_plans')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::drop('businesses_plans');
    }
}
