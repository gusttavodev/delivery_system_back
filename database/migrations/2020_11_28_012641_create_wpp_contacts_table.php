<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWppContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpp_contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('server')->default("c.us");
            $table->string('user_phone');
            $table->string('_serialized')->nullable();

            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('wpp_session_id')->references('id')->on('wpp_sessions')->onDelete('cascade');

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
        Schema::dropIfExists('wpp_contacts');
    }
}
