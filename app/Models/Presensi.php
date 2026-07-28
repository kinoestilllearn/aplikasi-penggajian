<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Presensi extends Model
{
    use HasFactory;

    protected $table = 'presensi';

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function periode(string $pegawaiId, string $periode)
    {
        return Presensi::where('pegawai_id', $pegawaiId)
            ->where('waktu_masuk', 'LIKE', $periode . '-%')
            ->get();
    }

    /**
     * Menghitung jumlah kehadiran pegawai berdasarkan status
     * @param string $pegawaiId
     * @param string $periode
     * @return array|string
     */
    public function presensiPegawai(string $pegawaiId, string $periode)
    {
        $pegawai = Pegawai::find($pegawaiId);

        // return null jika pegawai tidak ditemukan
        if ($pegawai === null) {
            return "null";
        } else {
            $query = "select pegawai_id, " .
                "(SELECT COUNT(`status`) FROM presensi WHERE pegawai_id = 1 AND STATUS = 'hadir' GROUP BY `status`) AS `jumlah_hadir`," .
                "(SELECT COUNT(`status`) FROM presensi WHERE pegawai_id = 1 AND STATUS = 'izin' GROUP BY `status`) AS `jumlah_izin`," .
                "(SELECT COUNT(`status`) FROM presensi WHERE pegawai_id = 1 AND STATUS = 'sakit' GROUP BY `status`) AS `jumlah_sakit`," .
                "(SELECT COUNT(`status`) FROM presensi WHERE pegawai_id = 1 AND STATUS = 'cuti' GROUP BY `status`) AS `jumlah_cuti`," .
                "(SELECT COUNT(`status`) FROM presensi WHERE pegawai_id = 1 AND STATUS = 'alpha' GROUP BY `status`) AS `jumlah_alpha` " .
                "from presensi WHERE pegawai_id = " . $pegawaiId . " and waktu_keluar LIKE '" . $periode . "-%' " . " GROUP BY `pegawai_id`";
            $kehadiran = DB::select($query);

            if (count($kehadiran) == 0) {
                return [];
            } else {
                $izin  = $kehadiran[0]->jumlah_izin ? $kehadiran[0]->jumlah_izin : 0;
                $sakit = $kehadiran[0]->jumlah_sakit ? $kehadiran[0]->jumlah_sakit : 0;
                $absen = $izin + $sakit;
                return [
                    'pegawai_id'   => $pegawaiId,
                    'jumlah_hadir' => $kehadiran[0]->jumlah_hadir ? $kehadiran[0]->jumlah_hadir : 0,
                    'jumlah_izin'  => $absen > 0 ? $izin : 0,
                    'jumlah_cuti'  => $kehadiran[0]->jumlah_cuti ? $kehadiran[0]->jumlah_cuti : 0,
                    'jumlah_alpha' => $kehadiran[0]->jumlah_alpha ? $kehadiran[0]->jumlah_alpha : 0,
                ];}
        }

    }
}
