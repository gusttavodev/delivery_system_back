<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEstablishmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('establishments', function (Blueprint $table) {
            $table->id();

            $table->string('public_link_name')->unique();
            $table->string('name');
            $table->string('description');
            $table->string('phone');
            $table->string('picture');
            $table->string('background_picture');

            $table->string('delivery_time')->nullable();
            $table->decimal('min_value', 8, 2)->nullable();

            $table->foreignId('address_id')->nullable()->references('id')->on('addresses');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('establishments');
    }
}
