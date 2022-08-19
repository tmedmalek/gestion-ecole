<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Professeur>
 */
class ProfesseurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'mobile' => fake()->numerify(),
            'cin' => fake()->randomNumber(),
            'annee_afectation' => fake()->date(),
            'diplome' => fake()->jobTitle(),
            'grade' => fake()->jobTitle(),
            'salaire' => fake()->numerify(),
            'specialite' => fake()->jobTitle(),
            'remember_token' => Str::random(10),
            'date_naissance' => fake()->date(),
        ];
    }
}
