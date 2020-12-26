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
            $table->string('phone');
            $table->boolean('is_auth')->default(0);
            $table->string('status');
            $table->string('state');

            $table->string('wa_browser_id')->nullable();
            $table->string('wa_secret_bundle')->nullable();
            $table->string('wa_token_1')->nullable();
            $table->string('wa_token_2')->nullable();

            $table->string('qr_code')->nullable();

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
