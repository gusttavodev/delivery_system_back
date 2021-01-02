<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoadmapStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roadmap_steps', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->mediumInteger('order');
            $table->boolean('has_options')->default(0);

            $table->string('message_after_options');
            $table->string('message_before_options')->nullable();
            $table->string('message_invalid_response');

            $table->mediumInteger('step_before_invalid_response')->nullable();

            $table->foreignId('roadmap_id')->references('id')->on('roadmaps')->onDelete('cascade');

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
        Schema::dropIfExists('roadmap_steps');
    }
}
