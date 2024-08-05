<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
        /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Crop::factory(1)->create(['id' => 1, 'embrapa_id' => 101, 'name' => 'Abacaxi Irrigado']);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}