<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('salles')->insert([
            'numero' => 1,
        ]);
        DB::table('salles')->insert([
            'numero' => 2,
        ]);
        DB::table('salles')->insert([
            'numero' => 3,
        ]);
        DB::table('salles')->insert([
            'numero' => 4,
        ]);
        DB::table('salles')->insert([
            'numero' => 5,
        ]);
        DB::table('salles')->insert([
            'numero' => 6,
        ]);
        DB::table('salles')->insert([
            'numero' => 7,
        ]);
        DB::table('salles')->insert([
            'numero' => 8,
        ]);
        DB::table('salles')->insert([
            'numero' => 9,
        ]);
        DB::table('salles')->insert([
            'numero' => 10,
        ]);
    }
}
