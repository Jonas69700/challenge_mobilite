<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Support\Collection;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            $dates = collect();

            // Générer 5 à 10 activités par utilisateur
            foreach (range(1, rand(5, 10)) as $_) {
                // Éviter doublons par date
                $date = now()->subDays(rand(0, 30))->format('Y-m-d');
                if ($dates->contains($date)) continue;
                $dates->push($date);

                Activity::factory()->create([
                    'user_id' => $user->id,
                    'date' => $date,
                ]);
            }
        }
    }
}

