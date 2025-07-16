<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = [
            ['name' => 'Les Rouleurs', 'description' => 'Équipe vélo'],
            ['name' => 'Les Marcheurs', 'description' => 'Équipe marche'],
            ['name' => 'Les Sprinteurs', 'description' => 'Course à pied'],
            ['name' => 'Les Randowarriors', 'description' => 'Rando et fun'],
            ['name' => 'Les Mobilos', 'description' => 'Mixte'],
        ];

        foreach ($teams as $team) {
            Team::create($team);
        }
    }
}
