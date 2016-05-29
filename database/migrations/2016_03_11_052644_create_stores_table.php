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
            $table->text('overview')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->integer('zip_code');
            $table->decimal('latitude',10,8);
            $table->decimal('longitude',10,8);
            $table->string('email')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('phone_number')->nullable();
            $table->integer('business_id')->unsigned();
            $table->boolean('active')->default(false);
            $table->string('status')->default('Pending');
            $table->text('note')->nullable();
            $table->foreign('business_id')->references('id')->on('businesses')->onUpdate('cascade')->onDelete('cascade');
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
