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
        //\App\Models\Admin::factory(1)->create();
        // \App\Models\Professeur::factory(5)->create();
        // \App\Models\UserParent::factory(5)->create();
        // \App\Models\Eleve::factory(5)->create();
        // \App\Models\Classe::factory(5)->create();
        // \App\Models\Matiere::factory(5)->create();
        // \App\Models\MatiereProf::factory(1)->create();
        \App\Models\Evenement::factory(5)->create();
    }
}
