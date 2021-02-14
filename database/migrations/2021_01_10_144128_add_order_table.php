<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->boolean('need_change')->default(0);
            $table->decimal('change_price', 8, 2);
            $table->decimal('total_price', 8, 2);

            $table->string('tracking_link')->nullable();

            $table->enum('user_type', array('system_user','wpp_user'))->default('system_user');

            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('wpp_user_id')->nullable()->references('id')->on('wpp_users')->onDelete('cascade');

            $table->foreignId('payment_mode_id')->references('id')->on('payment_modes');
            $table->foreignId('status_id')->references('id')->on('status_orders');

            $table->foreignId('address_id')->nullable()->references('id')->on('addresses');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
