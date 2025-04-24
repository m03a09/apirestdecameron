<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcomodacionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('acomodaciones')->insert([
            ['nombre' => 'Sencilla', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Doble', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Triple', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Cuádruple', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
