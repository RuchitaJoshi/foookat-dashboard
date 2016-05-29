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
            $table->text('details')->nullable();
            $table->text('overview')->nullable();
            $table->decimal('original_price',12,2)->nullable();
            $table->decimal('new_price',12,2)->nullable();
            $table->decimal('discount',12,2)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->boolean('recurring');
            $table->boolean('limited_time');
            $table->string('redeem_code');
            $table->boolean('active')->default(false);
            $table->string('status')->default('Pending');
            $table->integer('store_id')->unsigned();
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
