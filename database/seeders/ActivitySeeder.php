<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Support\Collection;

class ActivitySeeder extends Seeder
{
    // public function run(): void
    // {
    //     $users = User::all();

    //     foreach ($users as $user) {
    //         $dates = collect();

    //         // Générer 5 à 10 activités par utilisateur
    //         foreach (range(1, rand(5, 10)) as $_) {
    //             // Éviter doublons par date
    //             $date = now()->subDays(rand(0, 30))->format('Y-m-d');
    //             if ($dates->contains($date)) continue;
    //             $dates->push($date);

    //             Activity::factory()->create([
    //                 'user_id' => $user->id,
    //                 'date' => $date,
    //             ]);
    //         }
    //     }
    // }
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();
        $types = ['bike', 'walk'];
        $dates = [];

        // Générer 40 activités réparties sur plusieurs jours/utilisateurs
        for ($i = 0; $i < 40; $i++) {
            // Sélectionner un user aléatoire
            $userId = $userIds[array_rand($userIds)];
            // Date entre aujourd'hui et il y a 30 jours
            $date = now()->subDays(rand(0, 30))->format('Y-m-d');
            // Pour limiter les doublons par user/date, tu peux garder une clé
            $key = "$userId-$date";
            if (isset($dates[$key])) continue;
            $dates[$key] = true;

            $type = $types[array_rand($types)];
            $steps = $type === 'walk' ? rand(3000, 15000) : null;
            $distance = $type === 'bike'
                ? round(rand(100, 2500) / 100, 2) // entre 1 et 25km
                : round($steps / 1500, 2);

            Activity::create([
                'user_id' => $userId,
                'date' => $date,
                'type' => $type,
                'steps' => $steps,
                'distance_km' => $distance,
            ]);
        }
    }
}

