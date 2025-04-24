<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CiudadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ciudades')->insert([
            ['nombre' => 'Cartagena', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'San Andrés', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Santa Marta', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Ibagué', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
