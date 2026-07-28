<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use App\Models\Penggajian;
use Illuminate\Database\Seeder;

class PenggajianDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penggajian = Penggajian::create([
            'no_ref'                 => fake()->unique()->numerify('###-###-###'),
            'tanggal_mulai'          => '2021-01-01',
            'tanggal_hingga'         => '2021-01-31',
            'periode'                => '2021 Januari',
            'dibuat_oleh'            => 1,
            'pegawai_id'             => 1,
            'gaji_pokok'             => Pegawai::find(1)->gaji_pokok,
            'jumlah_tunjangan_tetap' => Pegawai::find(1)->tunjangan_tetap,
        ]);

        $penggajian = Penggajian::create([
            'no_ref'                 => fake()->unique()->numerify('###-###-###'),
            'tanggal_mulai'          => '2021-01-01',
            'tanggal_hingga'         => '2021-01-31',
            'periode'                => '2021 Januari',
            'dibuat_oleh'            => 1,
            'pegawai_id'             => 2,
            'gaji_pokok'             => Pegawai::find(2)->gaji_pokok,
            'jumlah_tunjangan_tetap' => Pegawai::find(2)->tunjangan_tetap,
        ]);
    }
}
