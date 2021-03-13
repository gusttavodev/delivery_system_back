<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->string('primary_color');
            $table->string('secondary_color');
            $table->string('text_color');
            $table->string('title_text_color');
            $table->string('title_text_hover_color');
            $table->string('background_color');
            $table->string('button_background_color');
            $table->string('button_hover_color');
            $table->string('button_text_color');
            $table->string('button_count_color');
            $table->string('card_background_color');
            $table->string('card_text_color');
            $table->string('card_price_color');

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
        Schema::dropIfExists('themes');
    }
}
