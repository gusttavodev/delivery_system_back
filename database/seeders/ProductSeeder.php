<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;

class ProductSeeder extends Seeder
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
                Category::factory(2)->make()
            )->each(function($todo) {
                $todo->products()->saveMany(
                    Product::factory(1)->make(['user_id' => $todo->user_id])
                );
            });
        });
    }
}
