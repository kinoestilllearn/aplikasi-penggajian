<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use App\Models\Presensi;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PresensiDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pegawais = Pegawai::all();

        // Generate attendance entries for active period (July 2026)
        $startDate = Carbon::create(2026, 7, 1);
        $endDate = Carbon::create(2026, 7, 25);

        foreach ($pegawais as $pegawai) {
            $current = $startDate->copy();

            while ($current->lte($endDate)) {
                // Skip Sundays
                if (!$current->isSunday()) {
                    $waktuMasuk = $current->copy()->setHour(9)->setMinute(rand(0, 15))->setSecond(0);
                    $waktuKeluar = $current->copy()->setHour(rand(18, 22))->setMinute(rand(0, 45))->setSecond(0);

                    // 90% Hadir, 5% Izin, 5% Cuti
                    $chance = rand(1, 100);
                    $status = 'hadir';
                    if ($chance > 95) {
                        $status = 'cuti';
                    } elseif ($chance > 90) {
                        $status = 'izin';
                    }

                    Presensi::create([
                        'pegawai_id'   => $pegawai->id,
                        'status'       => $status,
                        'waktu_masuk'  => $waktuMasuk,
                        'waktu_keluar' => $waktuKeluar,
                        'keterangan'   => $status === 'hadir' ? 'Hadir EVOS HQ' : ucfirst($status),
                    ]);
                }
                $current->addDay();
            }
        }
    }
}
