<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStepOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('step_options', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->mediumInteger('order');
            $table->boolean('is_product')->default(0);

            $table->foreignId('product_id')->references('id')->on('products')->onDelete('cascade')->nullable();
            $table->foreignId('roadmap_step_id')->references('id')->on('roadmap_steps')->onDelete('cascade');

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
        Schema::dropIfExists('step_options');
    }
}
