<?php

namespace Database\Factories;

use App\Models\Theme;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ThemeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Theme::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => Str::random(10),

            'primary_color' => '#1ca4e6',
            'secondary_color' => '#162FA1',
            'text_color' => '#111827',
            'title_text_color' => '#111827',
            'title_text_hover_color' => '#F9FAFB',
            'background_color' => '#F3F4F6',

            'button_background_color' => '#6600cc',
            'button_hover_color' => '#9f74c9',
            'button_text_color' => '#F3F4F6',
            'button_count_color' => '#50ed17',

            'card_background_color' => '#F9FAFB',
            'card_text_color' => '#111827',
            'card_price_color' => '#111827',
        ];
    }
}
