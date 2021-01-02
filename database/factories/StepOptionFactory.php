<?php

namespace Database\Factories;

use App\Models\StepOption;
use Illuminate\Database\Eloquent\Factories\Factory;

class StepOptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StepOption::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'text' => $this->faker->name,
            'order' => $this->faker->numberBetween(1, 10),
            'is_product' => $this->faker->boolean(50)
        ];
    }
}
