<?php

namespace Database\Factories;

use App\Models\RoadmapStep;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoadmapStepFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RoadmapStep::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->paragraph,
            'order' => $this->faker->numberBetween(1, 10),
            'has_options' => true,

            'message_after_options' => Str::random(10),
            'message_before_options' => Str::random(10),
            'message_invalid_response' => Str::random(10),

            'step_before_invalid_response' => 1
        ];
    }
}
