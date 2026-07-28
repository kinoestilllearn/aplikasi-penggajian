<?php

namespace Database\Seeders;

use App\Models\Presensi;
use Illuminate\Database\Seeder;

class PresensiDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Presensi::factory(21)->create();
    }
}
