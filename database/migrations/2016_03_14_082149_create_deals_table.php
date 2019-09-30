<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('details');
            $table->text('overview');
            $table->decimal('original_price',12,2)->nullable();
            $table->decimal('percentage_off',12,2)->nullable();
            $table->decimal('amount_off',12,2)->nullable();
            $table->decimal('new_price',12,2)->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('mon');
            $table->boolean('tue');
            $table->boolean('wed');
            $table->boolean('thu');
            $table->boolean('fri');
            $table->boolean('sat');
            $table->boolean('sun');
            $table->string('redeem_code');
            $table->boolean('used_once')->default(false);
            $table->string('cover_image1');
            $table->string('cover_image2')->nullable();
            $table->string('cover_image3')->nullable();
            $table->integer('category_id')->unsigned();
            $table->integer('store_id')->unsigned();
            $table->boolean('active')->default(false);
            $table->string('approved')->default('Pending');
            $table->text('note')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::drop('deals');
    }
}
