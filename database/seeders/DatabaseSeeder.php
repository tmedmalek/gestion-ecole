<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\Professeur::factory(0)->create();
         \App\Models\UserParent::factory(0)->create();
         \App\Models\Eleve::factory(0)->create();
         \App\Models\Admin::factory(0)->create();
         \App\Models\Classe::factory(0)->create();
         \App\Models\Matiere::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
