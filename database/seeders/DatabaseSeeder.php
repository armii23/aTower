<?php

namespace Database\Seeders;

use App\Models\Sensor;
use App\Models\Temperature;
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
        Sensor::factory(30)->create();
        Temperature::factory(30)->create();
    }
}
