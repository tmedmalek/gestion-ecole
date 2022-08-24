<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'email'=>fake()->email(),
            'password'=>bcrypt('malek123'),
            'first_name' => fake()->name(),
            'last_name' => fake()->name(),
            'remember_token' => Str::random(10),
        ];
    }
}
