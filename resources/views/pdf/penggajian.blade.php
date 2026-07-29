<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SLIP GAJI ROSTER - EVOS ESPORTS</title>

    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #1e293b;
            margin: 0;
            padding: 20px;
            font-size: 12px;
        }
        .banner-header {
            background: linear-gradient(135deg, #051329 0%, #0B2F64 50%, #0052CC 100%);
            color: #ffffff;
            padding: 20px 24px;
            border-radius: 12px;
            margin-bottom: 20px;
        }
        .banner-title {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 1px;
            margin: 0;
            color: #00D2FF;
        }
        .banner-subtitle {
            font-size: 11px;
            color: #94a3b8;
            margin-top: 4px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            background: #ffffff;
        }
        .section-title {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #0052CC;
            border-bottom: 2px solid #0052CC;
            padding-bottom: 4px;
            margin-top: 16px;
            margin-bottom: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        td, th {
            padding: 6px 8px;
            vertical-align: top;
        }
        .bg-slate {
            background-color: #f8fafc;
            border-radius: 6px;
        }
        .badge-status {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-weight: bold;
            font-size: 10px;
            text-transform: uppercase;
        }
        .status-disetujui { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
        .status-draf { background: #fef3c7; color: #b45309; border: 1px solid #fde68a; }
        .status-dibatalkan { background: #ffe4e6; color: #be123c; border: 1px solid #fecdd3; }
        .total-box {
            background: #051329;
            color: #ffffff;
            padding: 14px 18px;
            border-radius: 8px;
            margin-top: 15px;
        }
        .total-amount {
            font-size: 18px;
            font-weight: 800;
            color: #00D2FF;
        }
    </style>
</head>

<body>
    <!-- EVOS Header Banner -->
    <div class="banner-header">
        <table style="width:100%; border:none; margin:0;">
            <tr>
                <td style="padding:0; width:60px; vertical-align:middle;">
                    @if(file_exists(public_path('images/evos-logo.png')))
                    <img src="{{ public_path('images/evos-logo.png') }}" style="width:48px; height:48px; object-fit:contain;" alt="EVOS Logo">
                    @elseif(file_exists(public_path('images/evos-logo.jpg')))
                    <img src="{{ public_path('images/evos-logo.jpg') }}" style="width:48px; height:48px; object-fit:contain;" alt="EVOS Logo">
                    @endif
                </td>
                <td style="padding:0; vertical-align:middle;">
                    <div class="banner-title">EVOS ESPORTS &bull; SLIP GAJI ROSTER</div>
                    <div class="banner-subtitle">Official Payroll Slip &mdash; PT Mau Maju EVOS Enterprise</div>
                </td>
                <td style="padding:0; text-align:right; vertical-align:middle;">
                    <span class="badge-status status-{{ $penggajian->status }}">
                        STATUS: {{ strtoupper($penggajian->status) }}
                    </span>
                </td>
            </tr>
        </table>
    </div>

    <div class="card">
        <!-- Metadata Ringkasan -->
        <table class="bg-slate">
            <tr>
                <td><strong>No. Referensi:</strong> #{{ $penggajian->no_ref }}</td>
                <td><strong>Periode:</strong> {{ $penggajian->periode }}</td>
                <td style="text-align:right;"><strong>Tanggal:</strong> {{ $penggajian->tanggal_mulai }} s/d {{ $penggajian->tanggal_hingga }}</td>
            </tr>
        </table>

        <!-- Detail Roster Player / Staff -->
        <div class="section-title">1. Data Roster Player & Staff</div>
        <table>
            <tr>
                <td style="width:20%;"><strong>ID Roster (NIP):</strong></td>
                <td style="width:30%;">{{ $pegawai->no_pegawai }}</td>
                <td style="width:20%;"><strong>Divisi Game:</strong></td>
                <td style="width:30%;"><strong>{{ $pegawai->departemen->nama ?? '-' }}</strong></td>
            </tr>
            <tr>
                <td><strong>Nama Lengkap:</strong></td>
                <td><strong>{{ strtoupper($pegawai->nama) }}</strong></td>
                <td><strong>Role / Position:</strong></td>
                <td>{{ $pegawai->posisi->nama ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Status Roster:</strong></td>
                <td>{{ ucfirst($pegawai->status_pegawai) }}</td>
                <td><strong>Masa Kerja:</strong></td>
                <td>{{ $pegawai->masa_kerja_tahun }} Tahun</td>
            </tr>
            <tr>
                <td><strong>Log Kehadiran:</strong></td>
                <td colspan="3">
                    Hadir: <strong>{{ $penggajian->kehadiran }}</strong> hari |
                    Izin/Absen: <strong>{{ $penggajian->absen }}</strong> hari |
                    Alpha: <strong>{{ $penggajian->alpha }}</strong> hari |
                    Cuti: <strong>{{ $penggajian->cuti }}</strong> hari
                </td>
            </tr>
        </table>

        <!-- Komponen Penambah Gaji -->
        <div class="section-title">2. Komponen Penambah Gaji</div>
        <table>
            <tr>
                <td>Gaji Pokok</td>
                <td style="text-align:right;">Rp {{ number_format((float)$penggajian->gaji_pokok, (float)$penggajian->gaji_pokok == floor((float)$penggajian->gaji_pokok) ? 0 : 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Tunjangan Tetap</td>
                <td style="text-align:right;">Rp {{ number_format((float)$penggajian->jumlah_tunjangan_tetap, (float)$penggajian->jumlah_tunjangan_tetap == floor((float)$penggajian->jumlah_tunjangan_tetap) ? 0 : 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Insentif Masa Kerja</td>
                <td style="text-align:right;">Rp {{ number_format((float)$penggajian->jumlah_insentif, (float)$penggajian->jumlah_insentif == floor((float)$penggajian->jumlah_insentif) ? 0 : 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Upah Lembur ({{ number_format((float)$penggajian->lama_lembur, (float)$penggajian->lama_lembur == floor((float)$penggajian->lama_lembur) ? 0 : 2, ',', '.') }} Jam)</td>
                <td style="text-align:right;">Rp {{ number_format((float)$penggajian->jumlah_lembur, (float)$penggajian->jumlah_lembur == floor((float)$penggajian->jumlah_lembur) ? 0 : 2, ',', '.') }}</td>
            </tr>
            <tr style="border-top:1px solid #cbd5e1; font-weight:bold;">
                <td>Total Penambah Gaji</td>
                <td style="text-align:right;">Rp {{ number_format((float)$penggajian->jumlah_penambah_gaji, (float)$penggajian->jumlah_penambah_gaji == floor((float)$penggajian->jumlah_penambah_gaji) ? 0 : 2, ',', '.') }}</td>
            </tr>
        </table>

        <!-- Komponen Potongan Gaji -->
        <div class="section-title">3. Komponen Potongan Gaji</div>
        <table>
            <tr>
                <td>Potongan Absensi (NWNP)</td>
                <td style="text-align:right; color:#dc2626;">- Rp {{ number_format((float)$penggajian->jumlah_potongan_nwnp, (float)$penggajian->jumlah_potongan_nwnp == floor((float)$penggajian->jumlah_potongan_nwnp) ? 0 : 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Potongan BPJS (3%)</td>
                <td style="text-align:right; color:#dc2626;">- Rp {{ number_format((float)$penggajian->jumlah_potongan_bpjs, (float)$penggajian->jumlah_potongan_bpjs == floor((float)$penggajian->jumlah_potongan_bpjs) ? 0 : 2, ',', '.') }}</td>
            </tr>
            <tr style="border-top:1px solid #cbd5e1; font-weight:bold;">
                <td>Total Potongan Gaji</td>
                <td style="text-align:right; color:#dc2626;">- Rp {{ number_format((float)$penggajian->jumlah_potongan_gaji, (float)$penggajian->jumlah_potongan_gaji == floor((float)$penggajian->jumlah_potongan_gaji) ? 0 : 2, ',', '.') }}</td>
            </tr>
        </table>

        <!-- Total Gaji Bersih -->
        <div class="total-box">
            <table style="width:100%; border:none; margin:0;">
                <tr>
                    <td style="padding:0; vertical-align:middle;">
                        <div style="font-size:11px; text-transform:uppercase; letter-spacing:1px; color:#94a3b8;">TOTAL GAJI BERSIH (TAKE HOME PAY)</div>
                    </td>
                    <td style="padding:0; text-align:right; vertical-align:middle;">
                        <div class="total-amount">Rp {{ number_format((float)$penggajian->total_gaji, (float)$penggajian->total_gaji == floor((float)$penggajian->total_gaji) ? 0 : 2, ',', '.') }}</div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Catatan & Audit Trail -->
        <div class="section-title" style="margin-top:20px;">4. Audit Trail & Persetujuan</div>
        <table style="font-size:11px; color:#475569;">
            <tr>
                <td><strong>Dibuat Oleh:</strong> {{ $penggajian->dibuatOleh->name ?? 'Staff Payroll' }}</td>
                <td><strong>Disetujui Oleh:</strong> {{ $penggajian->disetujuiOleh->name ?? '-' }}</td>
                <td><strong>Status Approval:</strong> {{ strtoupper($penggajian->status) }}</td>
            </tr>
            <tr>
                <td><strong>Waktu Dibuat:</strong> {{ date('d-m-Y H:i:s', strtotime($penggajian->created_at)) }}</td>
                <td colspan="2"><strong>Waktu Diperbarui:</strong> {{ date('d-m-Y H:i:s', strtotime($penggajian->updated_at)) }}</td>
            </tr>
        </table>
    </div>
</body>

</html>