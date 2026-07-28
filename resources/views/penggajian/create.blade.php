@extends('layouts.app')

@section('title', $pageTitle)

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm">
        <div>
            <h1 class="text-xl font-bold text-slate-900 tracking-tight flex items-center gap-2">
                <i data-lucide="calculator" class="w-6 h-6 text-emerald-600"></i>
                {{ $pageTitle }}
            </h1>
            <p class="text-xs text-slate-500 mt-1">Pilih pegawai dan periode untuk menghitung otomatis gaji pokok, tunjangan, lembur, dan potongan.</p>
        </div>

        <a href="{{ route('penggajian.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-semibold transition-colors flex items-center gap-1.5">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
        </a>
    </div>

    <!-- Guidance Banner -->
    <div class="p-4 rounded-xl bg-indigo-50/80 border border-indigo-200/80 text-indigo-900 text-xs flex items-start gap-3">
        <div class="w-7 h-7 rounded-lg bg-indigo-600 text-white flex items-center justify-center shrink-0 mt-0.5 shadow-sm">
            <i data-lucide="help-circle" class="w-4 h-4"></i>
        </div>
        <div class="space-y-1">
            <h4 class="font-bold text-sm text-indigo-950">Panduan Pembuatan Slip Gaji</h4>
            <ol class="list-decimal pl-4 space-y-0.5 text-indigo-800 font-medium">
                <li>Pilih <strong>Periode Penggajian</strong> (contoh: Januari 2021).</li>
                <li>Pilih <strong>Pegawai</strong> pada menu dropdown untuk mengisi data dasar secara otomatis.</li>
                <li>Klik tombol <span class="px-1.5 py-0.5 rounded bg-emerald-600 text-white font-bold">Hitung Gaji</span> untuk memproses kalkulasi sistem.</li>
                <li>Periksa rincian gaji, kemudian klik <span class="px-1.5 py-0.5 rounded bg-indigo-600 text-white font-bold">Buat Slip Gaji</span> untuk menyimpan.</li>
            </ol>
        </div>
    </div>

    @if (count($errors) > 0)
    <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm">
        <div class="font-bold flex items-center gap-2 mb-1">
            <i data-lucide="alert-circle" class="w-5 h-5 text-rose-600"></i>
            <span>Validasi Gagal:</span>
        </div>
        <ul class="list-disc pl-7 text-xs space-y-0.5">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{ html()->form('POST', route('penggajian.store'))->class('space-y-6')->open() }}
    {{ html()->hidden('no_ref', fake()->numerify('#########')) }}

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Form Columns (2 Cols) -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Panel 1: Periode & Pegawai -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-5">
                <div class="border-b border-slate-100 pb-3 flex items-center gap-2">
                    <i data-lucide="calendar" class="w-5 h-5 text-indigo-600"></i>
                    <h2 class="text-sm font-bold uppercase tracking-wider text-slate-800">1. Periode & Pegawai</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="bulan_periode" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">Bulan Periode</label>
                        <select id="bulan_periode" name="bulan_periode" required
                            class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm font-medium text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600 outline-none">
                            <option value="">Pilih Bulan...</option>
                            <option value="01" selected>Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>

                    <div>
                        <label for="tahun_periode" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">Tahun Periode</label>
                        <select id="tahun_periode" name="tahun_periode" required
                            class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm font-medium text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600 outline-none">
                            <option value="">Pilih Tahun...</option>
                            <option value="2021" selected>2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                        </select>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="pegawai" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">Pilih Karyawan</label>
                        <select id="pegawai" name="pegawai_id" onchange="getPegawaiId()" required
                            class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm font-semibold text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600 outline-none">
                            <option value="">Pilih Pegawai...</option>
                            @foreach ($data['pegawai'] as $peg)
                            <option value="{{ $peg->id }}">
                                {{ $peg->no_pegawai }} &ndash; {{ $peg->nama }} ({{ $peg->departemen->nama }} - {{ $peg->posisi->nama }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Auto Autofilled Pegawai Details -->
                <div class="p-4 bg-slate-50 border border-slate-200 rounded-xl grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs">
                    <div>
                        <span class="text-slate-400 block font-medium">No. Pegawai</span>
                        <input type="text" id="no_pegawai" readonly class="w-full bg-transparent font-bold text-slate-900 outline-none border-none p-0" placeholder="-">
                    </div>
                    <div>
                        <span class="text-slate-400 block font-medium">Nama</span>
                        <input type="text" id="nama_pegawai" readonly class="w-full bg-transparent font-bold text-slate-900 outline-none border-none p-0 truncate" placeholder="-">
                    </div>
                    <div>
                        <span class="text-slate-400 block font-medium">Departemen</span>
                        <input type="text" id="departemen" readonly class="w-full bg-transparent font-bold text-slate-900 outline-none border-none p-0 truncate" placeholder="-">
                    </div>
                    <div>
                        <span class="text-slate-400 block font-medium">Posisi</span>
                        <input type="text" id="posisi" readonly class="w-full bg-transparent font-bold text-slate-900 outline-none border-none p-0 truncate" placeholder="-">
                    </div>
                </div>
            </div>

            <!-- Panel 2: Rincian Penambah Gaji -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-5">
                <div class="border-b border-slate-100 pb-3 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <i data-lucide="trending-up" class="w-5 h-5 text-emerald-600"></i>
                        <h2 class="text-sm font-bold uppercase tracking-wider text-slate-800">2. Penambah Gaji (Pendapatan)</h2>
                    </div>
                    <span class="text-xs font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">+ Income</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">Gaji Pokok</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-xs font-bold text-slate-400">Rp</span>
                            <input type="number" name="gaji_pokok" readonly class="gaji_pokok w-full pl-9 pr-3 py-2 bg-slate-100 border border-slate-200 rounded-xl text-sm font-bold text-slate-800 outline-none" placeholder="0">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">Tunjangan Tetap</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-xs font-bold text-slate-400">Rp</span>
                            <input type="number" name="jumlah_tunjangan_tetap" readonly class="jumlah_tunjangan_tetap w-full pl-9 pr-3 py-2 bg-slate-100 border border-slate-200 rounded-xl text-sm font-bold text-slate-800 outline-none" placeholder="0">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">Jumlah Insentif</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-xs font-bold text-slate-400">Rp</span>
                            <input type="text" name="jumlah_insentif" id="jumlah_insentif" readonly class="w-full pl-9 pr-3 py-2 bg-slate-100 border border-slate-200 rounded-xl text-sm font-bold text-slate-800 outline-none" placeholder="0">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">Upah Lembur</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-xs font-bold text-slate-400">Rp</span>
                            <input type="number" name="jumlah_lembur" id="jumlah_lembur" readonly class="w-full pl-9 pr-3 py-2 bg-slate-100 border border-slate-200 rounded-xl text-sm font-bold text-slate-800 outline-none" placeholder="0">
                        </div>
                    </div>

                    <div class="sm:col-span-2 grid grid-cols-3 gap-3 pt-2 text-xs">
                        <div>
                            <span class="text-slate-400 block font-medium">Status Pegawai</span>
                            <input type="text" id="status_pegawai" readonly class="w-full bg-transparent font-bold text-slate-800 outline-none border-none p-0" placeholder="-">
                        </div>
                        <div>
                            <span class="text-slate-400 block font-medium">Masa Kerja</span>
                            <input type="text" id="masa_kerja" readonly class="w-full bg-transparent font-bold text-slate-800 outline-none border-none p-0" placeholder="-">
                        </div>
                        <div>
                            <span class="text-slate-400 block font-medium">Lama Lembur (Jam)</span>
                            <input type="text" name="lama_lembur" id="lama_lembur" readonly class="w-full bg-transparent font-bold text-slate-800 outline-none border-none p-0" placeholder="-">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel 3: Potongan Gaji -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-5">
                <div class="border-b border-slate-100 pb-3 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <i data-lucide="trending-down" class="w-5 h-5 text-rose-600"></i>
                        <h2 class="text-sm font-bold uppercase tracking-wider text-slate-800">3. Potongan Gaji</h2>
                    </div>
                    <span class="text-xs font-semibold text-rose-700 bg-rose-50 px-2 py-0.5 rounded border border-rose-200">- Deductions</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">Potongan NWNP</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-xs font-bold text-slate-400">Rp</span>
                            <input type="number" name="jumlah_nwnp" id="jumlah_nwnp" readonly class="w-full pl-9 pr-3 py-2 bg-slate-100 border border-slate-200 rounded-xl text-sm font-bold text-slate-800 outline-none" placeholder="0">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1">Potongan BPJS (3%)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-xs font-bold text-slate-400">Rp</span>
                            <input type="number" name="bpjs" id="bpjs" readonly class="w-full pl-9 pr-3 py-2 bg-slate-100 border border-slate-200 rounded-xl text-sm font-bold text-slate-800 outline-none" placeholder="0">
                        </div>
                    </div>

                    <!-- Presence Badges -->
                    <div class="sm:col-span-2 grid grid-cols-4 gap-2 pt-2 text-center text-xs">
                        <div class="p-2 rounded-lg bg-slate-50 border border-slate-200">
                            <span class="text-slate-400 block text-[10px] uppercase font-bold">Hadir</span>
                            <input type="number" name="kehadiran" id="kehadiran" readonly class="w-full text-center bg-transparent font-extrabold text-emerald-600 outline-none p-0" value="0">
                        </div>
                        <div class="p-2 rounded-lg bg-slate-50 border border-slate-200">
                            <span class="text-slate-400 block text-[10px] uppercase font-bold">Alpha</span>
                            <input type="number" name="alpha" id="alpha" readonly class="w-full text-center bg-transparent font-extrabold text-rose-600 outline-none p-0" value="0">
                        </div>
                        <div class="p-2 rounded-lg bg-slate-50 border border-slate-200">
                            <span class="text-slate-400 block text-[10px] uppercase font-bold">Izin</span>
                            <input type="number" name="izin" id="izin" readonly class="w-full text-center bg-transparent font-extrabold text-amber-600 outline-none p-0" value="0">
                        </div>
                        <div class="p-2 rounded-lg bg-slate-50 border border-slate-200">
                            <span class="text-slate-400 block text-[10px] uppercase font-bold">Cuti</span>
                            <input type="number" name="cuti" id="cuti" readonly class="w-full text-center bg-transparent font-extrabold text-indigo-600 outline-none p-0" value="0">
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Sidebar Summary Card (1 Col Sticky) -->
        <div class="space-y-6">
            <div class="bg-slate-900 text-white p-6 rounded-2xl border border-slate-800 shadow-xl sticky top-24 space-y-6">
                <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Ringkasan Gaji</span>
                    <span class="px-2 py-0.5 rounded bg-emerald-500/20 text-emerald-400 text-[10px] font-bold uppercase">Ready</span>
                </div>

                <!-- Hitung Action Button -->
                <button type="button" onclick="hitungPenggajian()" class="w-full py-3 px-4 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-xl shadow-lg shadow-emerald-600/30 transition-all flex items-center justify-center gap-2 group text-sm">
                    <i data-lucide="calculator" class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
                    <span>Hitung Gaji Sekarang</span>
                </button>

                <div class="space-y-3 pt-2 text-xs border-t border-slate-800">
                    <div class="flex justify-between items-center text-slate-300">
                        <span>Total Penambah Gaji:</span>
                        <div class="font-bold text-emerald-400 flex items-center">
                            <span>Rp</span>
                            <input type="number" name="jumlah_penambah_gaji" id="komponen_penambah_gaji" readonly class="w-24 text-right bg-transparent border-none text-emerald-400 font-bold p-0 outline-none" value="0">
                        </div>
                    </div>

                    <div class="flex justify-between items-center text-slate-300">
                        <span>Total Potongan Gaji:</span>
                        <div class="font-bold text-rose-400 flex items-center">
                            <span>Rp</span>
                            <input type="number" name="jumlah_potongan_gaji" id="komponen_pengurang_gaji" readonly class="w-24 text-right bg-transparent border-none text-rose-400 font-bold p-0 outline-none" value="0">
                        </div>
                    </div>
                </div>

                <!-- Highlight Total Net Pay -->
                <div class="p-4 rounded-xl bg-slate-950 border border-slate-800 text-center space-y-1">
                    <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Total Take Home Pay</span>
                    <div class="text-2xl font-extrabold text-emerald-400 flex items-center justify-center gap-1">
                        <span class="text-sm font-semibold">Rp</span>
                        <input type="number" name="total_gaji" id="total_gaji" readonly class="w-full text-center bg-transparent border-none text-emerald-400 font-extrabold text-2xl p-0 outline-none" value="0">
                    </div>
                </div>

                <div class="text-[11px] text-slate-400 text-center pt-1">
                    Dibuat oleh: <span class="text-white font-semibold">{{ auth()->user()->name }}</span>
                </div>

                <div class="space-y-2 pt-2 border-t border-slate-800">
                    <button type="submit" class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl shadow-lg shadow-indigo-600/30 transition-all text-sm flex items-center justify-center gap-2">
                        <i data-lucide="check-circle" class="w-4 h-4"></i>
                        <span>Buat Slip Gaji</span>
                    </button>
                    <input type="reset" value="Reset Form" class="w-full py-2 px-4 bg-slate-800 hover:bg-slate-700 text-slate-300 font-semibold rounded-xl text-xs cursor-pointer transition-colors text-center">
                </div>
            </div>
        </div>
    </div>
    {{ html()->form()->close() }}
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    function getPegawaiId() {
        let id = $('#pegawai option:selected').val();
        if(!id) return;

        $.ajax({
            type: 'GET',
            url: "{{ route('data-pegawai') }}",
            data: { id: id },
            success: function (data) {
                $('#no_pegawai').val(data.no_pegawai);
                $('#nama_pegawai').val(data.nama);
                $('#departemen').val(data.departemen.nama);
                $('#posisi').val(data.posisi.nama);
                $('.gaji_pokok').val(data.gaji_pokok);
                $('.jumlah_tunjangan_tetap').val(data.tunjangan_tetap);
                $('#status_pegawai').val(data.status_pegawai);
                $('#masa_kerja').val(data.masa_kerja_tahun + ' Tahun');
            },
            error: function (data) {
                console.log("err", data);
            }
        });
    }

    function hitungPenggajian() {
        let id = $('#pegawai option:selected').val();
        let periode = $('#tahun_periode option:selected').val() + '-' + $('#bulan_periode option:selected').val();

        if(!id) {
            alert('Silakan pilih pegawai terlebih dahulu.');
            return;
        }

        $.ajax({
            type: 'GET',
            url: "{{ route('data-penggajian') }}",
            data: { id: id, periode: periode },
            success: function (data) {
                $('#jumlah_insentif').val(data.insentif);
                $('#lama_lembur').val(data.lembur.jam_lembur);
                $('#jumlah_lembur').val(data.lembur.jumlah_lembur);
                $('#kehadiran').val(data.kehadiran.jumlah_hadir);
                $('#alpha').val(data.kehadiran.jumlah_alpha);
                $('#izin').val(data.kehadiran.jumlah_izin);
                $('#cuti').val(data.kehadiran.jumlah_cuti);
                $('#jumlah_nwnp').val(data.nwnp);
                $('#bpjs').val(data.bpjs);
                $('#komponen_penambah_gaji').val(data.penambah_gaji);
                $('#komponen_pengurang_gaji').val(data.pengurang_gaji);
                $('#total_gaji').val(data.total_gaji);
            },
            error: function (data) {
                console.log("err", data);
            }
        });
    }
</script>
@endpush