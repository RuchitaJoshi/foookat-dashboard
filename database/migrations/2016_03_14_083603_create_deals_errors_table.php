<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealsErrorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals_errors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('deal_id')->unsigned();
            $table->text('errors')->nullable();
            $table->text('details')->nullable();
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
        Schema::drop('deals_errors');
    }
}
