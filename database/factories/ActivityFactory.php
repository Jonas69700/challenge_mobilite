<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    protected $model = Activity::class;

    public function definition(): array
    {
        $type = $this->faker->randomElement(['bike', 'walk']);
        $steps = $type === 'walk' ? $this->faker->numberBetween(3000, 15000) : null;
        $distance = $type === 'bike'
            ? $this->faker->randomFloat(2, 1, 25)
            : round($steps / 1500, 2);

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'date' => $this->faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d'),
            'type' => $type,
            'steps' => $steps,
            'distance_km' => $distance,
        ];
    }
}

