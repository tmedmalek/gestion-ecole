<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EvenementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    { return [
        'name' => Str::random(10),
        'type' => Str::random(10),
        'adresse' => Str::random(10),
        'date' => fake()->date(),
        'nb_places' =>fake()-> randomNumber(1),
        'heure_debut' => fake()->date(),
        'heure_fin' => fake()->date(),
    ];
    }
}
