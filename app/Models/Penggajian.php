<?php

namespace App\Models;

use App\Http\Requests\StorePenggajianRequest;
use App\Http\Requests\UpdatePenggajianRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Penggajian extends Model
{
    use HasFactory;

    protected $table = 'penggajian';

    protected $guarded = [];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    /**
     * Fungsi untuk pembuatan kolom 'pembuat' pada Yajra/DataTables
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dibuatOleh()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    public function disetujuiOleh()
    {
        return $this->belongsTo(User::class, 'disetujui_oleh');
    }

    public function dibatalkanOleh()
    {
        return $this->belongsTo(User::class, 'dibatalkan_oleh');
    }

    public function inputGajiPokok()
    {
        return Pegawai::find($this->pegawai_id)->gaji_pokok;
    }

    public function inputTunjanganTetap()
    {
        return Pegawai::find($this->pegawai_id)->tunjangan_tetap;
    }

    /**
     * Fungsi untuk menghitung insentif pegawai berdasarkan ketentuan yang telah diberikan
     * @param string $pegawaiId
     * @return float|string
     */
    public function hitungInsentif(string $pegawaiId)
    {
        $pegawai = Pegawai::find($pegawaiId);

        if ($pegawai->status_pegawai == 'tetap') {
            if ($pegawai->masa_kerja_tahun < 1) {
                return "1000000.00";
            } else {
                $insentif = 1000000.00;

                for ($i = 1; $i <= $pegawai->masa_kerja_tahun; $i++) {
                    $insentif += 100000.00;
                }
                return number_format($insentif, 2, '.', '');
            }
        } else {
            return 0.00;
        }
    }

    /**
     * Fungsi untuk menghitung jumlah kehadiran pegawai berdasarkan ketentuan yang telah diberikan
     * @param string $pegawaiId
     * @param string $periode
     * @return array|string
     */
    public function hitungKehadiran(string $pegawaiId, string $periode)
    {
        return (new Presensi)->presensiPegawai($pegawaiId, $periode);
    }

    /**
     * Menghitung NWNP berdasarkan jumlah kehadiran pegawai
     * @param string $pegawaiId
     * @param string $periode
     * @return string
     */
    public function hitungNwnp(string $pegawaiId, string $periode)
    {
        $kehadiran = $this->hitungKehadiran($pegawaiId, $periode);

        if ($kehadiran['jumlah_izin'] !== 0 || $kehadiran['jumlah_alpha'] !== 0) {
            $pegawai          = Pegawai::find($pegawaiId);
            $jumlahTidakHadir = $kehadiran['jumlah_izin'] + $kehadiran['jumlah_alpha'];
            $gajiPokok        = $pegawai->gaji_pokok;
            $jumlahNwnp       = ($jumlahTidakHadir * $gajiPokok / 30);
            return number_format($jumlahNwnp, 2, '.', '');
        } else {
            return number_format(0.00, 2, '.', '');

        }
    }

    /**
     * Menghitung potongan BPJS pegawai yang sebesar 3% dari gaji pokok dan tunjangan tetap
     * @param string $pegawaiId
     * @return string
     */
    public function hitungBpjs(string $pegawaiId)
    {
        $pegawai = Pegawai::find($pegawaiId);
        $bpjs    = ($pegawai->gaji_pokok + $pegawai->tunjangan_tetap) * 0.03;

        return number_format($bpjs, 2, '.', '');
    }

    /**
     * Fungsi perhitungan lembur dengan ketentuan yang telah diberikan
     * @param string $pegawaiId
     * @param string $periode
     * @return array|string
     */
    public function hitungLembur(string $pegawaiId, string $periode)
    {
        $pegawai = Pegawai::find($pegawaiId);

        // return null jika pegawai tidak ditemukan
        if ($pegawai === null) {
            return "null";
        } else {
            $sql = "select TIME_TO_SEC(SUM(TIMEDIFF(DATE_FORMAT(waktu_keluar, '%H:%i:%s'), '18:00:00'))) AS jumlah_lembur from `presensi` " .
                "where pegawai_id = " . $pegawaiId . " AND waktu_keluar LIKE '" . $periode . "-%' AND DATE_FORMAT(waktu_keluar, '%H:%i:%s') >= '18:00:00'";
            $lembur = DB::select("$sql");

            // jika pegawai berstatus tetap atau kontrak
            if ($pegawai->status_pegawai == 'tetap' || $pegawai->status_pegawai == 'kontrak') {
                return $this->detailLembur($lembur[0]->jumlah_lembur, $pegawai);

                // jika pegawai berstatus Harian Lepas
            } else {
                return $this->detailLembur($lembur[0]->jumlah_lembur, $pegawai);
            }
        }
    }

    /**
     * Menghitung detail lembur dari tiap status pegawai yang diberikan
     * @param float $lembur
     * @param \App\Models\Pegawai $pegawai
     * @return array
     */
    private function detailLembur(float $lembur, Pegawai $pegawai)
    {
        $jamLembur = $lembur / 3600;

        // jika jam lembur kurang dari 4 jam
        if (floor($jamLembur) < 4) {
            $jumlahLembur = floor($jamLembur) * (($pegawai->gaji_pokok + $pegawai->tunjangan_tetap) / 173);

            $data = [
                'jam_lembur'    => $jamLembur,
                'jumlah_lembur' => number_format($jumlahLembur, 2, '.', ''),
            ];

            return $data;

            // jika jam lembur lebih dari 4 jam
        } else {
            $jamLemburPenjabaran = $jamLembur - 4;
            $jumlahLembur        = 2 * floor($jamLemburPenjabaran) * (($pegawai->gaji_pokok + $pegawai->tunjangan_tetap) / 173);

            $data = [
                'jam_lembur'    => $jamLembur,
                'jumlah_lembur' => number_format($jumlahLembur, 2, '.', ''),
            ];

            return $data;
        }

    }

    /**
     * Fungsi untuk menyimpan data penggajian ke database.
     * @param \App\Http\Requests\StorePenggajianRequest $request
     * @return array
     */
    public function storeDataPenggajian(StorePenggajianRequest $request)
    {
        return [
            'no_ref'                 => fake()->numerify('#########'),
            'tanggal_mulai'          => date("Y-m-d", strtotime($request->tahun_periode . '-' . $request->bulan_periode . '-01')),
            'tanggal_hingga'         => date("Y-m-t", strtotime($request->tahun_periode . '-' . $request->bulan_periode . '-20')),
            'periode'                => $request->tahun_periode . '-' . $request->bulan_periode,
            'pegawai_id'             => $request->pegawai_id,
            'kehadiran'              => $request->kehadiran,
            'absen'                  => (string) ($request->sakit + $request->izin),
            'cuti'                   => $request->cuti,
            'alpha'                  => $request->alpha,
            'lama_lembur'            => number_format($request->lama_lembur, 4, '.', ''),
            'gaji_pokok'             => $request->gaji_pokok,
            'jumlah_tunjangan_tetap' => $request->jumlah_tunjangan_tetap,
            'jumlah_insentif'        => $request->jumlah_insentif,
            'jumlah_lembur'          => $request->jumlah_lembur,
            'jumlah_potongan_nwnp'   => $request->jumlah_nwnp,
            'jumlah_potongan_bpjs'   => $request->bpjs,
            'jumlah_penambah_gaji'   => $request->jumlah_penambah_gaji,
            'jumlah_potongan_gaji'   => $request->jumlah_potongan_gaji,
            'total_gaji'             => $request->total_gaji,
            'dibuat_oleh'            => 1,
        ];
    }

    /**
     * Fungsi untuk meng-update atau 'approval oleh supervisor-payroll' data penggajian ke database.
     * @param \App\Http\Requests\UpdatePenggajianRequest $request
     * @param string $id
     * @return array
     */
    public function updateDataPenggajian(UpdatePenggajianRequest $request, string $id)
    {
        $penggajian = Penggajian::find($id);
        $noRef      = $penggajian->no_ref;

        $validated = $request->validated();
        $approver  = User::find($validated['approver']);

        if ($validated['status'] == 'disetujui') {
            $data = [
                'status'          => $validated['status'],
                'disetujui_oleh'  => $validated['approver'],
                'dibatalkan_oleh' => null,
            ];
        } elseif ($validated['status'] == 'dibatalkan') {
            $data = [
                'status'          => $validated['status'],
                'disetujui_oleh'  => null,
                'dibatalkan_oleh' => $validated['approver'],
            ];
        } else {
            $data = [
                'status'          => $validated['status'],
                'disetujui_oleh'  => null,
                'dibatalkan_oleh' => null,
            ];
        }

        $penggajian->update($data);

        return [
            'no_ref'   => $noRef,
            'status'   => $validated['status'],
            'approver' => $approver->name,
            'data'     => $data,
        ];
    }

    /**
     * Fungsi untuk meadatkan data-data terkait penggajian pegawai.
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function compactDataPenggajian(Request $request)
    {
        $gajiPokok      = Pegawai::find($request->id)->gaji_pokok;
        $tunjanganTetap = Pegawai::find($request->id)->tunjangan_tetap;
        $insentif       = (new Penggajian)->hitungInsentif($request->id);
        $lembur         = (new Penggajian)->hitungLembur($request->id, $request->periode);
        $kehadiran      = (new Penggajian)->hitungKehadiran($request->id, $request->periode);
        $nwnp           = (new Penggajian)->hitungNwnp($request->id, $request->periode);
        $bpjs           = (new Penggajian)->hitungBpjs($request->id);
        $penambahGaji   = $gajiPokok + $tunjanganTetap + $insentif + $lembur['jumlah_lembur'];
        $pengurangGaji  = $nwnp + $bpjs;
        $totalGaji      = $penambahGaji - $pengurangGaji;

        return [
            'insentif'       => $insentif,
            'lembur'         => $lembur,
            'kehadiran'      => $kehadiran,
            'nwnp'           => $nwnp,
            'bpjs'           => $bpjs,
            'penambah_gaji'  => number_format($penambahGaji, 2, '.', ''),
            'pengurang_gaji' => number_format($pengurangGaji, 2, '.', ''),
            'total_gaji'     => number_format($totalGaji, 2, '.', ''),
        ];
    }

    /**
     * Memanfaatkan package DomPDF untuk membuat file PDF.
     * @param string $id
     * @return \Barryvdh\DomPDF\PDF
     */
    public function pdfUtility(String $id)
    {
        $penggajian = Penggajian::find($id);

        $data = [
            'pegawai'    => Pegawai::find($penggajian->pegawai_id),
            'penggajian' => Penggajian::find($id),
            'page_title' => 'Detail Penggajian',
        ];

        $pdf = Pdf::loadView('pdf.penggajian', $data);

        $pdf->setPaper('L');
        $pdf->output();
        $canvas = $pdf->getDomPDF()->getCanvas();

        $height = $canvas->get_height();
        $width  = $canvas->get_width();

        $canvas->set_opacity(.2, "Multiply");

        if ($penggajian->status == 'disetujui') {
            $canvas->page_text($width / 2, $height / 2, 'DISETUJUI', null,
                55, array(0, 0, 0), 2, 2, -45);
        } else if ($penggajian->status == 'dibatalkan') {
            $canvas->page_text($width / 3, $height / 1.7, 'DIBATALKAN', 'null',
                55, array(0, 0, 0), 2, 2, -45);
        } else {
            $canvas->page_text($width / 3, $height / 1.7, 'DRAF DRAF', null,
                55, array(0, 0, 0), 2, 2, -45);
        }

        return $pdf;
    }
}
