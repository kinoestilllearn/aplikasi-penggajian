<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="OP9VIG1oymU1T62A8NkM9uokMVcmciXQv7PcSCJQ">

        <title>{{ $page_title}} - PT. Mau Maju</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>

    <body>
        <div class="card">
            <div class="card-header">{{ $page_title}} - PT. Mau Maju</div>

            <div class="card-body">
                <!-- Periode penggajian- -->
                <div><strong>Periode penggajian</strong></div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <td>Tanggal Mulai: {{ $penggajian->tanggal_mulai
                                }}</td>
                            <td>Tanggal Hingga: {{ $penggajian->tanggal_hingga
                                }}</td>
                            <td class="form-label text-danger fw-bold fst-italic">Status
                                penggajian:
                                @if ($penggajian->status == 'draf')
                                draf
                                @elseif ($penggajian->status == 'disetujui')
                                disetujui
                                @else
                                dibatalkan
                                @endif</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">#</th>
                            <td colspan="2">Periode: {{ $penggajian->periode }}</td>
                            <td>No. Ref: {{ $penggajian->no_ref }}</td>
                        </tr>
                    </tbody>
                </table>
                <hr class="mb-0">

                <!-- Detail Pegawai -->
                <div><strong>Data Pegawai</strong></div>
                <p class="mb-0">No. Pegawai : {{ $pegawai->no_pegawai }}
                </p class="mb-0">
                <p class="mb-0">Nama Pegawai : {{ strtoupper($pegawai->nama) }}
                </p class="mb-0">
                <p class="mb-0">Departemen : {{ $pegawai->departemen->nama }}
                </p class="mb-0">
                <p class="mb-0">Posisi : {{ $pegawai->posisi->nama }}
                </p class="mb-0">
                <p class="mb-0">Status Pegawai : {{ $pegawai->status_pegawai }}
                </p class="mb-0">
                <p class="mb-0">Masa Kerja : {{ $pegawai->masa_kerja_tahun }} (tahun)
                </p class="mb-0">
                <p class="mb-0"><em>Kehadiran :</em> {{ $penggajian->kehadiran }} (hari)
                </p class="mb-0">
                <p class="mb-0"><em>Absen :</em> {{ $penggajian->absen }} (hari)
                </p class="mb-0">
                <p class="mb-0"><em>Alpha :</em> {{ $penggajian->alpha }} (hari)
                </p class="mb-0">
                <p class="mb-0"><em>Cuti :</em> {{ $penggajian->cuti }} (hari)
                </p class="mb-0">
                <hr class="mb-0">

                <!-- Penambah Gaji -->
                <div><strong>Penambah Gaji</strong></div>
                <p class="mb-0">Gaji Pokok: Rp {{ number_format($penggajian->gaji_pokok,2,',','.') }}
                </p class="mb-0">
                <p class="mb-0">Tunjangan Tetap: Rp {{ number_format($penggajian->jumlah_tunjangan_tetap,2,',','.') }}
                </p class="mb-0">
                <p class="mb-0">Insentif: Rp {{ number_format($penggajian->jumlah_insentif,2,',','.') }}
                </p class="mb-0">
                <p class="mb-0">Lembur: Rp {{ number_format($penggajian->jumlah_lembur,2,',','.') }}
                </p class="mb-0">
                <hr class="mb-0">

                <!-- Ptongan Gaji -->
                <div><strong>Potongan Gaji</strong></div>
                <p class="mb-0">Potongan NWNP: Rp -{{ number_format($penggajian->jumlah_potongan_nwnp,2,',','.') }}
                </p class="mb-0">
                <p class="mb-0">Potongan BPJS: Rp -{{ number_format($penggajian->jumlah_potongan_gaji,2,',','.') }}
                </p class="mb-0">
                <hr class="mb-0">

                <!-- Total Gaji -->
                <div><strong>Total Gaji</strong></div>
                <p class="mb-0">Jumlah Penambah Gaji: Rp {{ number_format($penggajian->jumlah_penambah_gaji,2,',','.')
                    }}
                </p class="mb-0">
                <p class="mb-0">Jumlah Potongan Gaji: Rp -{{ number_format($penggajian->jumlah_potongan_gaji,2,',','.')
                    }}
                </p class="mb-0">
                <p class="mb-0">TOTAL GAJI: Rp {{ number_format($penggajian->total_gaji,2,',','.') }}
                </p class="mb-0">
                <hr class="mb-0">

                <!-- Persetujuan -->
                <div><strong>Persetujuan penggajian</strong></div>
                <div class="col-md-12">
                    <ul class="pl-1 m-0">
                        <li><strong>Dibuat oleh: </strong> {{ $penggajian->dibuatOleh->name }}</li>
                        <li><strong>Disetujui oleh: </strong>{{ $penggajian->disetujuiOleh->name ?? '-' }}
                        </li>
                        <li><strong>Dibatalkan oleh: </strong> {{ $penggajian->dibatalkanOleh->name ?? '-' }}
                        </li>
                        <li><strong>Dibuat pada: </strong>
                            {{ date('Y-m-d H:i:s T',strtotime($penggajian->created_at)) ?? '-' }}
                        </li>
                        <li><strong>Diperbarui pada: </strong>
                            {{ date('Y-m-d H:i:s T',strtotime($penggajian->updated_at)) ?? '-' }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </body>

</html>