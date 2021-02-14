<?php

namespace Database\Factories;

use App\Models\WppUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class WppUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WppUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'phone' => $this->faker->phoneNumber,
        ];
    }
}
