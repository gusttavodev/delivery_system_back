<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\RoadmapSeeder;
use Database\Seeders\EstablishmentSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(RoadmapSeeder::class);
        $this->call(EstablishmentSeeder::class);
    }
}
