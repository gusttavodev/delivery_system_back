<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Additional;
use Illuminate\Database\Seeder;

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
            )->each(function($category) {
                $category->products()->saveMany(
                    Product::factory(1)->make(['user_id' => $category->user_id])
                )->each(function($product) {
                    $product->additionals()->saveMany(
                        Additional::factory(1)->make(['user_id' => $product->user_id])
                    );
                });
            });
        });
    }
}
