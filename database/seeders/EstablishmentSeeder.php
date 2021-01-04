<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Address;
use App\Models\OpeningHour;
use App\Models\Establishment;
use Illuminate\Database\Seeder;

class EstablishmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            // Register Address
        Address::factory(1)->create();


        // Registra de forma encadeada
        User::all()->each(function($user) {
            $address = Address::first();
            $user->establishments()->saveMany(
                Establishment::factory(1)->make([
                    'user_id' => $user->id, 'address_id' => $address->id
                ])
            )->each(function($establishment) {
                $establishment->openingHours()->saveMany(
                    OpeningHour::factory(1)->make([
                        'establishment_id' => $establishment->id
                    ])
                );
            });
        });
    }
}
