<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Team;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $teams = Team::all();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@challenge.test',
            'password' => Hash::make('admin123'),
            'team_id' => $teams->random()->id,
        ]);

        User::factory(14)->create([
            'team_id' => fn () => $teams->random()->id,
        ]);
    }
}
