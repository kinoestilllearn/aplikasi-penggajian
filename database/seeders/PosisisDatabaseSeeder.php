<?php

namespace Database\Seeders;

use App\Models\Departemen;
use App\Models\Posisi;
use Illuminate\Database\Seeder;

class PosisisDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Pro Player (Main Roster)',
            'Coach',
            'Analyst',
            'Team Manager',
            'Content Creator',
        ];

        $departemens = Departemen::all();

        foreach ($departemens as $dept) {
            foreach ($roles as $role) {
                Posisi::updateOrCreate(
                    [
                        'departemen_id' => $dept->id,
                        'nama'          => $role,
                    ],
                    [
                        'departemen_id' => $dept->id,
                        'nama'          => $role,
                    ]
                );
            }
        }
    }
}
