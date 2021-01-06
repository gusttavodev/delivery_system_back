<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOpeningHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('establishment_opening_hours', function (Blueprint $table) {
            $table->id();

            $table->time('start_time');
            $table->time('end_time');

            $table->enum('day', array('monday','tuesday','wednesday',
            'thursday','friday','saturday','sunday'));

            $table->boolean('not_open')->default(0);

            $table->foreignId('establishment_id')->references('id')->on('establishments')->onDelete('cascade');

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
        Schema::dropIfExists('establishment_opening_hours');
    }
}
