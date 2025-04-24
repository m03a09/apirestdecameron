<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoHabitacionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tipos_habitacion')->insert([
            ['nombre' => 'Estándar', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Junior', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Suite', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
