<?php

namespace Database\Seeders;

use App\Models\Departemen;
use App\Models\Pegawai;
use App\Models\Posisi;
use Illuminate\Database\Seeder;

class PegawaisDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mlbb = Departemen::where('nama', 'LIKE', '%Mobile Legends%')->first();
        $pubg = Departemen::where('nama', 'LIKE', '%PUBG%')->first();
        $valo = Departemen::where('nama', 'LIKE', '%Valorant%')->first();
        $ff = Departemen::where('nama', 'LIKE', '%Free Fire%')->first();
        $ba = Departemen::where('nama', 'LIKE', '%Content Creator%')->first();

        $playerPos = Posisi::where('nama', 'Pro Player (Main Roster)')->first();
        $coachPos = Posisi::where('nama', 'Coach')->first();
        $analystPos = Posisi::where('nama', 'Analyst')->first();
        $managerPos = Posisi::where('nama', 'Team Manager')->first();
        $creatorPos = Posisi::where('nama', 'Content Creator')->first();

        $rosters = [
            [
                'no_pegawai'      => '1001',
                'nama'            => 'Muhammad Ridwan (Wannn)',
                'tempat_lahir'    => 'Pontianak',
                'tanggal_lahir'   => '2000-07-07',
                'jenis_kelamin'   => 'L',
                'departemen_id'   => $mlbb?->id ?? 1,
                'posisi_id'       => $playerPos?->id ?? 1,
                'status_pegawai'  => 'tetap',
                'masa_kerja_tahun'=> 4,
                'gaji_pokok'      => 22500000,
                'tunjangan_tetap' => 6500000,
            ],
            [
                'no_pegawai'      => '1002',
                'nama'            => 'Gustian Hwin (REKT)',
                'tempat_lahir'    => 'Jakarta',
                'tanggal_lahir'   => '1996-08-13',
                'jenis_kelamin'   => 'L',
                'departemen_id'   => $mlbb?->id ?? 1,
                'posisi_id'       => $playerPos?->id ?? 1,
                'status_pegawai'  => 'tetap',
                'masa_kerja_tahun'=> 5,
                'gaji_pokok'      => 25000000,
                'tunjangan_tetap' => 7500000,
            ],
            [
                'no_pegawai'      => '1003',
                'nama'            => 'Eko Julianto (Oura)',
                'tempat_lahir'    => 'Batam',
                'tanggal_lahir'   => '1998-03-16',
                'jenis_kelamin'   => 'L',
                'departemen_id'   => $ba?->id ?? 1,
                'posisi_id'       => $creatorPos?->id ?? 1,
                'status_pegawai'  => 'tetap',
                'masa_kerja_tahun'=> 5,
                'gaji_pokok'      => 24000000,
                'tunjangan_tetap' => 7000000,
            ],
            [
                'no_pegawai'      => '1004',
                'nama'            => 'Jabran Bagus Wiloko (Branz)',
                'tempat_lahir'    => 'Surakarta',
                'tanggal_lahir'   => '2000-08-28',
                'jenis_kelamin'   => 'L',
                'departemen_id'   => $mlbb?->id ?? 1,
                'posisi_id'       => $playerPos?->id ?? 1,
                'status_pegawai'  => 'tetap',
                'masa_kerja_tahun'=> 2,
                'gaji_pokok'      => 18000000,
                'tunjangan_tetap' => 5000000,
            ],
            [
                'no_pegawai'      => '1005',
                'nama'            => 'Nizar Lugatio Pratama (Microboy)',
                'tempat_lahir'    => 'Semarang',
                'tanggal_lahir'   => '2000-06-09',
                'jenis_kelamin'   => 'L',
                'departemen_id'   => $pubg?->id ?? 1,
                'posisi_id'       => $playerPos?->id ?? 1,
                'status_pegawai'  => 'tetap',
                'masa_kerja_tahun'=> 3,
                'gaji_pokok'      => 19500000,
                'tunjangan_tetap' => 5500000,
            ],
            [
                'no_pegawai'      => '1006',
                'nama'            => 'Steven Valerian (Ageee)',
                'tempat_lahir'    => 'Surabaya',
                'tanggal_lahir'   => '1997-11-12',
                'jenis_kelamin'   => 'L',
                'departemen_id'   => $mlbb?->id ?? 1,
                'posisi_id'       => $coachPos?->id ?? 1,
                'status_pegawai'  => 'tetap',
                'masa_kerja_tahun'=> 3,
                'gaji_pokok'      => 17000000,
                'tunjangan_tetap' => 4500000,
            ],
            [
                'no_pegawai'      => '1007',
                'nama'            => 'Rachmad Wahyudi (Dreams)',
                'tempat_lahir'    => 'Bandung',
                'tanggal_lahir'   => '2001-01-25',
                'jenis_kelamin'   => 'L',
                'departemen_id'   => $mlbb?->id ?? 1,
                'posisi_id'       => $playerPos?->id ?? 1,
                'status_pegawai'  => 'kontrak',
                'masa_kerja_tahun'=> 1,
                'gaji_pokok'      => 15000000,
                'tunjangan_tetap' => 4000000,
            ],
            [
                'no_pegawai'      => '1008',
                'nama'            => 'Darrel Jovanco (Tazz)',
                'tempat_lahir'    => 'Jakarta',
                'tanggal_lahir'   => '2004-04-18',
                'jenis_kelamin'   => 'L',
                'departemen_id'   => $mlbb?->id ?? 1,
                'posisi_id'       => $playerPos?->id ?? 1,
                'status_pegawai'  => 'kontrak',
                'masa_kerja_tahun'=> 1,
                'gaji_pokok'      => 14500000,
                'tunjangan_tetap' => 3500000,
            ],
            [
                'no_pegawai'      => '1009',
                'nama'            => 'Arthur Sunarko (Sutsujin)',
                'tempat_lahir'    => 'Medan',
                'tanggal_lahir'   => '2004-09-02',
                'jenis_kelamin'   => 'L',
                'departemen_id'   => $mlbb?->id ?? 1,
                'posisi_id'       => $playerPos?->id ?? 1,
                'status_pegawai'  => 'kontrak',
                'masa_kerja_tahun'=> 0,
                'gaji_pokok'      => 12000000,
                'tunjangan_tetap' => 3000000,
            ],
            [
                'no_pegawai'      => '1010',
                'nama'            => 'Nidia R (Notnot)',
                'tempat_lahir'    => 'Bandung',
                'tanggal_lahir'   => '2000-10-08',
                'jenis_kelamin'   => 'P',
                'departemen_id'   => $ba?->id ?? 1,
                'posisi_id'       => $creatorPos?->id ?? 1,
                'status_pegawai'  => 'tetap',
                'masa_kerja_tahun'=> 3,
                'gaji_pokok'      => 16000000,
                'tunjangan_tetap' => 4500000,
            ],
            [
                'no_pegawai'      => '1011',
                'nama'            => 'Angelica (EVOS Angel)',
                'tempat_lahir'    => 'Jakarta',
                'tanggal_lahir'   => '1999-05-16',
                'jenis_kelamin'   => 'P',
                'departemen_id'   => $ba?->id ?? 1,
                'posisi_id'       => $managerPos?->id ?? 1,
                'status_pegawai'  => 'tetap',
                'masa_kerja_tahun'=> 4,
                'gaji_pokok'      => 15500000,
                'tunjangan_tetap' => 4000000,
            ],
            [
                'no_pegawai'      => '1012',
                'nama'            => 'Flamtastic (Valorant Coach)',
                'tempat_lahir'    => 'Surabaya',
                'tanggal_lahir'   => '1998-12-05',
                'jenis_kelamin'   => 'L',
                'departemen_id'   => $valo?->id ?? 1,
                'posisi_id'       => $coachPos?->id ?? 1,
                'status_pegawai'  => 'kontrak',
                'masa_kerja_tahun'=> 2,
                'gaji_pokok'      => 16500000,
                'tunjangan_tetap' => 4200000,
            ],
        ];

        foreach ($rosters as $data) {
            Pegawai::updateOrCreate(
                ['no_pegawai' => $data['no_pegawai']],
                $data
            );
        }
    }
}
