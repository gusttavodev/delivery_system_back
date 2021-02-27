<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'photo' => "images/product/D8V1fNTDpYSGJFdSErp0JagjQwHtEwxb0xas62VO.jpg",
            'available' => true,
            'enable' => true,
            'priority' => 1,
            'description' => Str::random(10),
            'price' => 10.12,
        ];
    }
}
