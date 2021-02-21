<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Team;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =  \DB::transaction(function (){
            return tap(User::create([
                'name' => "Gustavo Silva",
                'email' => "gusttavo212@gmail.com",
                'password' => Hash::make('12345678'),
            ]), function (User $user) {
                $user->ownedTeams()->save(Team::forceCreate([
                    'user_id' => $user->id,
                    'name' => explode(' ', $user->name, 2)[0]."'s Team",
                    'personal_team' => true,
                ]));
            });
        });
        Role::create(['name' => 'admin']);
        $user->assignRole('Admin');

        User::factory(1)->create();
    }
}
