<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_charges', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('country_id');
            $table->float('shipping_charges0_500g')->nullable();
            $table->float('shipping_charges501_1000g')->nullable();
            $table->float('shipping_charges1001_2000g')->nullable();
            $table->float('shipping_charges2001_5000g')->nullable();
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('countries');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipping_charges');
    }
}
