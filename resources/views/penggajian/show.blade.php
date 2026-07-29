@extends('layouts.app')

@section('title', $pageTitle)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white dark:bg-[#151D2A] p-6 rounded-2xl border border-slate-200/60 dark:border-slate-800/80 shadow-[0_4px_20px_rgba(0,0,0,0.03)] transition-colors duration-300">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="text-xs font-bold text-slate-600 dark:text-[#94A3B8] uppercase tracking-wider">Ref #{{ $data['penggajian']->no_ref }}</span>
                @if($data['penggajian']->status == 'disetujui')
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 dark:bg-emerald-900/40 text-emerald-800 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800/40">
                    Disetujui
                </span>
                @elseif($data['penggajian']->status == 'dibatalkan')
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-rose-100 dark:bg-rose-900/40 text-rose-800 dark:text-rose-300 border border-rose-200 dark:border-rose-800/40">
                    Dibatalkan
                </span>
                @else
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-100 dark:bg-amber-900/40 text-amber-800 dark:text-amber-300 border border-amber-200 dark:border-amber-800/40">
                    Draf
                </span>
                @endif
            </div>
            <h1 class="text-2xl font-extrabold text-[#0F172A] dark:text-[#F5F5F7] tracking-tight">Rincian Slip Gaji Roster</h1>
        </div>

        <div class="flex items-center gap-2">
            @unlessrole ('supervisor-payroll')
            <a href="{{ route('generate-pdf', $data['penggajian']->id ) }}" target="_blank" rel="noopener noreferrer"
               class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-xl text-xs font-semibold shadow-md transition-colors flex items-center gap-1.5">
                <i data-lucide="file-text" class="w-4 h-4"></i> Preview PDF
            </a>
            <a href="{{ route('cetak-pdf', $data['penggajian']->id) }}" target="_blank" rel="noopener noreferrer"
               class="px-4 py-2 bg-[#0052CC] hover:bg-[#0066FF] text-white rounded-xl text-xs font-semibold shadow-md transition-colors flex items-center gap-1.5">
                <i data-lucide="download" class="w-4 h-4"></i> Export PDF
            </a>
            @endunlessrole

            <a href="{{ route('penggajian.index') }}" class="px-4 py-2 bg-white dark:bg-[#1C2536] hover:bg-slate-100 dark:hover:bg-slate-700 text-[#0F172A] dark:text-[#F5F5F7] rounded-xl text-xs font-semibold transition-colors flex items-center gap-1.5 border border-slate-200 dark:border-slate-700">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Supervisor Approval Box -->
    @role ('supervisor-payroll')
    <div class="p-5 rounded-2xl bg-[#051329] text-white shadow-xl border border-slate-800 space-y-4">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-cyan-500/20 text-cyan-400 flex items-center justify-center">
                <i data-lucide="shield-check" class="w-5 h-5"></i>
            </div>
            <div>
                <h3 class="font-bold text-sm">Panel Approval Supervisor EVOS</h3>
                <p class="text-xs text-slate-300">Periksa rincian data lalu perbarui status penggajian.</p>
            </div>
        </div>

        {{ html()->form('PATCH', route('penggajian.update', $data['penggajian']->id))->class('flex flex-col sm:flex-row items-center gap-3 pt-2 border-t border-slate-800')->open() }}
        {{ html()->hidden('approver', auth()->user()->id) }}

        <div class="w-full sm:w-64">
            <select id="status" name="status" required
                class="w-full px-3.5 py-2 bg-[#030b18] border border-slate-700 rounded-xl text-xs font-bold text-white outline-none focus:ring-2 focus:ring-cyan-500">
                <option value="draf" {{ $data['penggajian']->status == 'draf' ? 'selected' : '' }}>Draf (Pending)</option>
                <option value="disetujui" {{ $data['penggajian']->status == 'disetujui' ? 'selected' : '' }}>Disetujui (Approved)</option>
                <option value="dibatalkan" {{ $data['penggajian']->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan (Cancelled)</option>
            </select>
        </div>

        <button type="submit" class="w-full sm:w-auto px-5 py-2 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-xl text-xs shadow-lg shadow-emerald-600/30 transition-all flex items-center justify-center gap-1.5">
            <i data-lucide="check" class="w-4 h-4"></i> Update Status
        </button>
        {{ html()->form()->close() }}
    </div>
    @endrole

    <!-- Main Payslip Card -->
    <div class="bg-white dark:bg-[#151D2A] rounded-2xl border border-slate-200/60 dark:border-slate-800/80 shadow-[0_4px_20px_rgba(0,0,0,0.03)] overflow-hidden p-6 md:p-8 space-y-8 transition-colors duration-300">
        <!-- Company & Employee Summary Header -->
        <div class="flex flex-col sm:flex-row justify-between gap-6 border-b border-slate-200 dark:border-slate-800 pb-6">
            <div class="space-y-1">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('images/evos-logo.png') }}" class="w-8 h-8 object-contain drop-shadow-sm" alt="EVOS Logo">
                    <span class="font-extrabold text-[#0F172A] dark:text-white text-base tracking-tight">EVOS ESPORTS HQ</span>
                </div>
                <p class="text-xs text-slate-600 dark:text-[#94A3B8]">Roster Operations & Financial Department</p>
                <p class="text-xs text-slate-600 dark:text-[#94A3B8]">Periode: <strong class="text-[#0F172A] dark:text-white">{{ date('d M Y', strtotime($data['penggajian']->tanggal_mulai)) }} &ndash; {{ date('d M Y', strtotime($data['penggajian']->tanggal_hingga)) }}</strong></p>
            </div>

            <!-- Employee Info Box -->
            <div class="bg-slate-100 dark:bg-[#1C2536] p-4 rounded-xl border border-slate-200 dark:border-slate-700 text-xs space-y-1 sm:w-72">
                <span class="text-[10px] uppercase font-bold text-[#0052CC] dark:text-[#00D2FF] tracking-wider block">Data Penerima Roster</span>
                <div class="font-extrabold text-sm text-[#0F172A] dark:text-white">{{ $data['pegawai']->nama }}</div>
                <div class="text-slate-700 dark:text-slate-300 font-medium">NIP: {{ $data['pegawai']->no_pegawai }}</div>
                <div class="text-slate-600 dark:text-[#94A3B8]">{{ $data['pegawai']->departemen->nama }} &bull; {{ $data['pegawai']->posisi->nama }}</div>
            </div>
        </div>

        <!-- Financial Breakdown Side-by-Side -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Penambah Gaji -->
            <div class="bg-slate-100 dark:bg-[#1C2536] p-5 rounded-2xl border border-slate-200 dark:border-slate-700 space-y-3">
                <div class="flex items-center justify-between border-b border-slate-200 dark:border-slate-700 pb-2">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-700 dark:text-emerald-400 flex items-center gap-1.5">
                        <i data-lucide="plus-circle" class="w-4 h-4 text-emerald-600 dark:text-emerald-400"></i> Penambah Gaji
                    </h3>
                    <span class="text-[10px] font-bold text-emerald-800 dark:text-emerald-300 bg-emerald-100 dark:bg-emerald-950/40 px-2 py-0.5 rounded">Pendapatan</span>
                </div>

                <div class="space-y-2 text-xs text-slate-800 dark:text-slate-300 font-medium">
                    <div class="flex justify-between py-1 border-b border-slate-200/50 dark:border-slate-700/50">
                        <span>Gaji Pokok:</span>
                        <strong class="text-[#0F172A] dark:text-white">Rp {{ number_format((float)$data['pegawai']->gaji_pokok, (float)$data['pegawai']->gaji_pokok == floor((float)$data['pegawai']->gaji_pokok) ? 0 : 2, ',', '.') }}</strong>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-200/50 dark:border-slate-700/50">
                        <span>Tunjangan Tetap:</span>
                        <strong class="text-[#0F172A] dark:text-white">Rp {{ number_format((float)$data['pegawai']->tunjangan_tetap, (float)$data['pegawai']->tunjangan_tetap == floor((float)$data['pegawai']->tunjangan_tetap) ? 0 : 2, ',', '.') }}</strong>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-200/50 dark:border-slate-700/50">
                        <span>Insentif Tambahan:</span>
                        <strong class="text-[#0F172A] dark:text-white">Rp {{ number_format((float)$data['penggajian']->jumlah_insentif, (float)$data['penggajian']->jumlah_insentif == floor((float)$data['penggajian']->jumlah_insentif) ? 0 : 2, ',', '.') }}</strong>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-200/50 dark:border-slate-700/50">
                        <span>Upah Lembur ({{ number_format((float)$data['penggajian']->lama_lembur, (float)$data['penggajian']->lama_lembur == floor((float)$data['penggajian']->lama_lembur) ? 0 : 2, ',', '.') }} Jam):</span>
                        <strong class="text-[#0F172A] dark:text-white">Rp {{ number_format((float)$data['penggajian']->jumlah_lembur, (float)$data['penggajian']->jumlah_lembur == floor((float)$data['penggajian']->jumlah_lembur) ? 0 : 2, ',', '.') }}</strong>
                    </div>
                </div>

                <div class="flex justify-between pt-2 text-xs font-extrabold text-emerald-700 dark:text-emerald-400">
                    <span>Total Penambah:</span>
                    <span>Rp {{ number_format((float)$data['penggajian']->jumlah_penambah_gaji, (float)$data['penggajian']->jumlah_penambah_gaji == floor((float)$data['penggajian']->jumlah_penambah_gaji) ? 0 : 2, ',', '.') }}</span>
                </div>
            </div>

            <!-- Potongan Gaji -->
            <div class="bg-slate-100 dark:bg-[#1C2536] p-5 rounded-2xl border border-slate-200 dark:border-slate-700 space-y-3">
                <div class="flex items-center justify-between border-b border-slate-200 dark:border-slate-700 pb-2">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-rose-700 dark:text-rose-400 flex items-center gap-1.5">
                        <i data-lucide="minus-circle" class="w-4 h-4 text-rose-600 dark:text-rose-400"></i> Potongan Gaji
                    </h3>
                    <span class="text-[10px] font-bold text-rose-800 dark:text-rose-300 bg-rose-100 dark:bg-rose-950/40 px-2 py-0.5 rounded">Pengurang</span>
                </div>

                <div class="space-y-2 text-xs text-slate-800 dark:text-slate-300 font-medium">
                    <div class="flex justify-between py-1 border-b border-slate-200/50 dark:border-slate-700/50">
                        <span>Potongan NWNP:</span>
                        <strong class="text-[#0F172A] dark:text-white">Rp {{ number_format((float)$data['penggajian']->jumlah_potongan_nwnp, (float)$data['penggajian']->jumlah_potongan_nwnp == floor((float)$data['penggajian']->jumlah_potongan_nwnp) ? 0 : 2, ',', '.') }}</strong>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-200/50 dark:border-slate-700/50">
                        <span>Potongan BPJS (3%):</span>
                        <strong class="text-[#0F172A] dark:text-white">Rp {{ number_format((float)$data['penggajian']->jumlah_potongan_bpjs, (float)$data['penggajian']->jumlah_potongan_bpjs == floor((float)$data['penggajian']->jumlah_potongan_bpjs) ? 0 : 2, ',', '.') }}</strong>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-200/50 dark:border-slate-700/50">
                        <span>Absensi (Hadir/Alpha/Izin/Cuti):</span>
                        <span class="font-bold">
                            <span class="text-emerald-700 dark:text-emerald-400">{{ $data['penggajian']->kehadiran }}</span> /
                            <span class="text-rose-700 dark:text-rose-400">{{ $data['penggajian']->alpha }}</span> /
                            <span class="text-amber-700 dark:text-amber-400">{{ $data['penggajian']->absen }}</span> /
                            <span class="text-[#0052CC] dark:text-[#00D2FF]">{{ $data['penggajian']->cuti }}</span>
                        </span>
                    </div>
                </div>

                <div class="flex justify-between pt-2 text-xs font-extrabold text-rose-700 dark:text-rose-400">
                    <span>Total Potongan:</span>
                    <span>Rp {{ number_format((float)$data['penggajian']->jumlah_potongan_gaji, (float)$data['penggajian']->jumlah_potongan_gaji == floor((float)$data['penggajian']->jumlah_potongan_gaji) ? 0 : 2, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Net Salary Highlight -->
        <div class="bg-gradient-to-r from-[#051329] to-[#0A0E17] p-6 rounded-2xl text-white flex flex-col sm:flex-row items-center justify-between gap-4 shadow-xl border border-slate-800">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Take Home Pay (Gaji Bersih)</span>
                <p class="text-xs text-slate-300">Telah dikalkulasi dengan komponen penambah dan pengurang resmi EVOS.</p>
            </div>
            <div class="text-3xl font-black text-cyan-400">
                Rp {{ number_format((float)$data['penggajian']->total_gaji, (float)$data['penggajian']->total_gaji == floor((float)$data['penggajian']->total_gaji) ? 0 : 2, ',', '.') }}
            </div>
        </div>

        <!-- Audit Trail Footer -->
        <div class="pt-6 border-t border-slate-200 dark:border-slate-800 text-xs text-slate-600 dark:text-[#94A3B8] grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            <div>
                <span class="text-slate-600 dark:text-[#94A3B8] block font-bold">Dibuat Oleh</span>
                <strong class="text-[#0F172A] dark:text-white">{{ $data['penggajian']->dibuatOleh->name }}</strong>
            </div>
            <div>
                <span class="text-slate-600 dark:text-[#94A3B8] block font-bold">Disetujui Oleh</span>
                <strong class="text-[#0F172A] dark:text-white">{{ $data['penggajian']->disetujuiOleh->name ?? '-' }}</strong>
            </div>
            <div>
                <span class="text-slate-600 dark:text-[#94A3B8] block font-bold">Dibatalkan Oleh</span>
                <strong class="text-[#0F172A] dark:text-white">{{ $data['penggajian']->dibatalkanOleh->name ?? '-' }}</strong>
            </div>
            <div>
                <span class="text-slate-600 dark:text-[#94A3B8] block font-bold">Tanggal Dibuat</span>
                <strong class="text-[#0F172A] dark:text-white">{{ date('d M Y, H:i', strtotime($data['penggajian']->created_at)) }}</strong>
            </div>
        </div>
    </div>
</div>
@endsection