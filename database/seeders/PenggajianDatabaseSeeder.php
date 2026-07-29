<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use App\Models\Penggajian;
use Illuminate\Http\Request;
use Illuminate\Database\Seeder;

class PenggajianDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pegawais = Pegawai::take(6)->get();
        $modelPenggajian = new Penggajian();

        foreach ($pegawais as $index => $pegawai) {
            $req = new Request([
                'id'      => $pegawai->id,
                'periode' => '2026-07',
            ]);

            $dataCalc = $modelPenggajian->compactDataPenggajian($req);

            $gajiPokok = $pegawai->gaji_pokok ?? 0;
            $tunjanganTetap = $pegawai->tunjangan_tetap ?? 0;
            $insentif = $dataCalc['insentif'] ?? 0;
            $jumlahLembur = is_array($dataCalc['lembur']) ? ($dataCalc['lembur']['jumlah_lembur'] ?? 0) : 0;
            $nwnp = $dataCalc['nwnp'] ?? 0;
            $bpjs = $dataCalc['bpjs'] ?? 0;
            $penambah = $dataCalc['penambahGaji'] ?? ($gajiPokok + $tunjanganTetap + $insentif + $jumlahLembur);
            $pengurang = $dataCalc['pengurangGaji'] ?? ($nwnp + $bpjs);
            $totalGaji = $dataCalc['totalGaji'] ?? ($penambah - $pengurang);

            $kehadiranCount = is_array($dataCalc['kehadiran']) ? ($dataCalc['kehadiran']['hadir'] ?? 20) : 20;
            $absenCount = is_array($dataCalc['kehadiran']) ? ($dataCalc['kehadiran']['izin'] ?? 0) : 0;
            $alphaCount = is_array($dataCalc['kehadiran']) ? ($dataCalc['kehadiran']['alpha'] ?? 0) : 0;
            $cutiCount = is_array($dataCalc['kehadiran']) ? ($dataCalc['kehadiran']['cuti'] ?? 0) : 0;

            Penggajian::create([
                'no_ref'                 => 'EVOS-PAY-' . date('Ym') . '-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'tanggal_mulai'          => '2026-07-01',
                'tanggal_hingga'         => '2026-07-31',
                'periode'                => '2026-07',
                'dibuat_oleh'            => 1,
                'disetujui_oleh'         => $index < 4 ? 2 : null,
                'pegawai_id'             => $pegawai->id,
                'gaji_pokok'             => $gajiPokok,
                'jumlah_tunjangan_tetap' => $tunjanganTetap,
                'jumlah_insentif'        => $insentif,
                'jumlah_lembur'          => $jumlahLembur,
                'jumlah_potongan_nwnp'   => $nwnp,
                'jumlah_potongan_gaji'   => $bpjs,
                'jumlah_penambah_gaji'   => $penambah,
                'total_gaji'             => $totalGaji,
                'kehadiran'              => $kehadiranCount,
                'absen'                  => $absenCount,
                'alpha'                  => $alphaCount,
                'cuti'                   => $cutiCount,
                'status'                 => $index < 4 ? 'disetujui' : 'draf',
            ]);
        }
    }
}
