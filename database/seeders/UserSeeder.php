<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Team;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    // public function run(): void
    // {
    //     $teams = Team::all();

    //     User::factory()->create([
    //         'name' => 'Admin',
    //         'email' => 'admin@challenge.test',
    //         'password' => Hash::make('admin123'),
    //         'team_id' => $teams->random()->id,
    //     ]);

    //     User::factory(14)->create([
    //         'team_id' => fn () => $teams->random()->id,
    //     ]);
    // }

    public function run(): void
    {
        // Supposons que tu as 5 équipes (avec IDs 1 à 5)
        $teams = [1, 2, 3, 4, 5];
        $usersData = [
            [
                'name' => 'Admin',
                'email' => 'admin@challenge.test',
                'password' => Hash::make('admin123'),
                'team_id' => 1,
            ],
        ];

        // 14 utilisateurs supplémentaires répartis sur les équipes
        for ($i = 1; $i <= 14; $i++) {
            $usersData[] = [
                'name' => "User $i",
                'email' => "user$i@challenge.test",
                'password' => Hash::make("password$i"),
                'team_id' => $teams[($i - 1) % count($teams)],
            ];
        }

        foreach ($usersData as $user) {
            User::create($user);
        }
    }
}
