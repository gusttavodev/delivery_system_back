<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Theme;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Registra de forma encadeadas
        User::all()->each(function($user) {
            $user->categories()->saveMany(
                Theme::factory(1)->make(['user_id' => $user->user_id])
            );
        });
    }
}
