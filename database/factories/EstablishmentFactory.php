<?php

namespace Database\Factories;

use App\Models\Establishment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EstablishmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Establishment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name;
        return [
            'public_link_name' => strtolower(str_replace(' ', '_', $name)),
            'name' => $name,
            'description' =>  Str::random(10),
            'phone' =>  "31987110017",

            'picture' => "images/establishment/NspozmnY1uUkrV9n7nfPekDgQyi7HSTqDSHnCW52.png",
            'background_picture' => "images/establishment/NZ6ZBeZ2OkLUfffhqKU8lPdG5jIrmEWZ9PqtkHnS.jpg",

            'delivery_time' => "1H - 40M",
            'min_value' => 10.12,
        ];
    }
}
