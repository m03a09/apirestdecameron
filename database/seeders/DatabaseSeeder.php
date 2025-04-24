<?php

namespace Database\Seeders;

use App\Models\Habitacion;
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
        $this->call([
            CiudadSeeder::class,
            TipoHabitacionSeeder::class,
            AcomodacionSeeder::class,
            HotelSeeder::class,
            HabitacionSeeder::class
        ]);
    }
}
