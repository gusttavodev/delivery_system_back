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
        return [
            'public_link_name' => $this->faker->name,
            'name' => $this->faker->name,
            'description' =>  Str::random(10),
            'phone' =>  "31987110017",

            'picture' => "images/TPtdcnzl5eFhlEvB6cBAw5bQtMlIVMeBsLGwo2hm.jpeg",
            'background_picture' => "images/TPtdcnzl5eFhlEvB6cBAw5bQtMlIVMeBsLGwo2hm.jpeg",

            'delivery_time' => "1H - 40M",
            'min_value' => 10.12,
        ];
    }
}
