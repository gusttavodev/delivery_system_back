<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Roadmap;
use App\Models\StepOption;
use App\Models\RoadmapStep;
use Illuminate\Database\Seeder;

class RoadmapSeeder extends Seeder
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
            $user->roadmaps()->saveMany(
                Roadmap::factory(1)->make(['user_id' => $user->id])
            )->each(function($roadmap) {
                $roadmap->steps()->saveMany(
                    RoadmapStep::factory(1)->make(['roadmap_id' => $roadmap->id])
                )->each(function($step) {
                    $product = Product::first();
                    $step->options()->saveMany(
                        StepOption::factory(1)->make(['roadmap_step_id' => $step->id, 'product_id' => $product->id])
                    );
                });
            });
        });
    }
}
