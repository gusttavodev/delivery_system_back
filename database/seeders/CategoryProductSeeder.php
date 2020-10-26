<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{CategoryProduct, Product, Category};

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()->hasAttached(Category::factory()->count(3))->create();
        Category::factory()->hasAttached(Product::factory()->count(3))->create();
    }
}
