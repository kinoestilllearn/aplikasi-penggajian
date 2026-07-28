<?php

namespace Database\Seeders;

use App\Models\Posisi;
use Illuminate\Database\Seeder;

class PosisisDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $namaPosisi = [
            'Jajaran Direksi',
            'Direktur Utama',
            'Direktur',
            'Manager',
            'Supervisor',
            'Staff',
        ];

        for ($i = 0; $i < 20; $i++) {
            Posisi::create([
                'departemen_id' => rand(1, 14),
                'nama'          => $namaPosisi[rand(0, 5)],
            ]);
        }
    }
}
