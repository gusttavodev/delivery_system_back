<?php

namespace Database\Factories;

use App\Models\OpeningHour;
use Illuminate\Database\Eloquent\Factories\Factory;

class OpeningHourFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OpeningHour::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start_time' => "17",
            'end_time' => "22",
            'start_day' =>  "monday",
            'end_day' =>  "friday"
        ];
    }
}
