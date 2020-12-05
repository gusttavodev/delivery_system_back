<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWppSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpp_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('status');
            $table->boolean('is_auth');
            $table->string('phone');

            $table->string('wa_browser_id');
            $table->string('wa_secret_bundle');
            $table->string('wa_token_1');
            $table->string('wa_token_2');

            $table->string('key')->nullable();
            $table->string('encKey')->nullable();
            $table->string('macKey')->nullable();

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
        Schema::dropIfExists('wpp_sessions');
    }
}
