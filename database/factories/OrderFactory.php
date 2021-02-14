<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'need_change' => true,
            'change_price' => $this->faker->numberBetween($min = 10, $max = 15),
            'total_price' => $this->faker->numberBetween($min = 20, $max = 100),

            'tracking_link' => $this->faker->text,
            'user_type' => 'system_user'
        ];
    }
}
