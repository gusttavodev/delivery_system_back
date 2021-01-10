<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderProductAddictionalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_product_additionals', function (Blueprint $table) {
            $table->id();

            $table->mediumInteger('quantity');

            $table->foreignId('order_product_id')->references('id')->on('order_products')->onDelete('cascade');
            $table->foreignId('addictional_id')->references('id')->on('additionals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_product_additionals');
    }
}
