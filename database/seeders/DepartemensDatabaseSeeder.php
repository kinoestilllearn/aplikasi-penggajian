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
        $departemen = [
            'Sales & Marketing',
            'Finance',
            'Human Resource',
            'IT',
            'Production',
            'Logistic',
            'Purchasing',
            'Quality Control',
            'Research & Development',
            'General Affairs',
            'Legal',
            'Security',
            'Maintenance',
            'Others',
        ];

        foreach ($departemen as $item) {
            Departemen::create([
                'nama' => $item,
            ]);
        }

    }
}
