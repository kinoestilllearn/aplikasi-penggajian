<?php

namespace Database\Seeders;

use App\Models\Departemen;
use Illuminate\Database\Seeder;

class DepartemensDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departemens = [
            'Mobile Legends (MLBB)',
            'PUBG Mobile',
            'Valorant',
            'Free Fire',
            'Content Creator / Brand Ambassador',
        ];

        foreach ($departemens as $item) {
            Departemen::updateOrCreate(
                ['nama' => $item],
                ['nama' => $item]
            );
        }
    }
}
