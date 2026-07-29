@extends('layouts.app')

@section('title', 'EVOS Roster & Payroll Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Apple Clean Header Banner -->
    <div class="relative overflow-hidden bg-white rounded-2xl p-6 md:p-8 text-[#1D1D1F] border border-slate-200/60 shadow-[0_4px_20px_rgba(0,0,0,0.03)]">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-blue-500/5 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute right-1/3 -top-10 w-64 h-64 bg-cyan-500/5 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="px-3 py-0.5 rounded-full bg-blue-50 text-[#0052CC] text-xs font-bold border border-blue-100 flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#0052CC] animate-pulse"></span>
                        EVOS Payroll Active
                    </span>
                    <span class="text-xs text-[#86868B] font-medium">&bull; {{ date('l, d F Y') }}</span>
                </div>
                <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight text-[#1D1D1F] flex items-center gap-2">
                    Selamat Datang, {{ Auth::user()->name }}! ⚡
                </h1>
                <p class="text-[#86868B] text-sm mt-1 max-w-2xl">
                    EVOS Esports Roster Operations &mdash; pantau metrik gaji player & staff, distribusi anggaran per Divisi Game, dan transaksi payroll terbaru.
                </p>
            </div>

            <!-- Quick Actions -->
            <div class="flex items-center gap-2 shrink-0 flex-wrap">
                @can('penggajian-create')
                <a href="{{ route('penggajian.create') }}" class="inline-flex items-center gap-2 px-5 py-3 bg-[#0052CC] hover:bg-[#0066FF] text-white font-bold rounded-xl shadow-md shadow-blue-600/20 transition-all text-xs group">
                    <i data-lucide="play-circle" class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
                    <span>Run Payroll Roster</span>
                </a>
                @endcan
                <a href="{{ route('penggajian.index') }}" class="inline-flex items-center gap-2 px-4 py-3 bg-[#F2F2F7] hover:bg-slate-200 text-[#1D1D1F] font-semibold rounded-xl transition-all text-xs group">
                    <i data-lucide="file-down" class="w-4 h-4"></i>
                    <span>Export Slip Gaji</span>
                </a>
                @can('pegawai-index')
                <a href="{{ route('pegawai.index') }}" class="inline-flex items-center gap-2 px-4 py-3 bg-[#F2F2F7] hover:bg-slate-200 text-[#1D1D1F] font-semibold rounded-xl transition-all text-xs">
                    <i data-lucide="user-plus" class="w-4 h-4"></i>
                    <span>Kelola Roster</span>
                </a>
                @endcan
            </div>
        </div>
    </div>

    <!-- Apple KPI Floating White Cards Row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- KPI 1: Total Monthly Payroll -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_8px_30px_rgba(0,0,0,0.06)] transition-all group">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[11px] font-bold uppercase tracking-wider text-[#86868B]">Total Gaji Roster</span>
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-[#0052CC] flex items-center justify-center group-hover:scale-105 transition-transform">
                    <i data-lucide="wallet" class="w-5 h-5"></i>
                </div>
            </div>
            <div class="text-xl font-extrabold text-[#1D1D1F] mb-1 leading-tight">
                Rp {{ number_format($totalNominalGaji, 0, ',', '.') }}
            </div>
            <div class="flex items-center gap-1.5 text-xs">
                <span class="inline-flex items-center gap-0.5 px-1.5 py-0.5 rounded-md bg-blue-50 text-[#0052CC] font-bold text-[11px]">
                    <i data-lucide="trending-up" class="w-3 h-3"></i>
                    {{ $totalPenggajian }}
                </span>
                <span class="text-[#86868B] font-medium">slip terproses</span>
            </div>
        </div>

        <!-- KPI 2: Pending Approval -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_8px_30px_rgba(0,0,0,0.06)] transition-all group">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[11px] font-bold uppercase tracking-wider text-[#86868B]">Pending Approval</span>
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                    <i data-lucide="clock" class="w-5 h-5"></i>
                </div>
            </div>
            <div class="text-3xl font-extrabold text-amber-600 mb-1">{{ number_format($pendingApproval) }}</div>
            <div class="flex items-center gap-1.5 text-xs">
                @if($pendingApproval > 0)
                <span class="inline-flex items-center gap-0.5 px-1.5 py-0.5 rounded-md bg-amber-50 text-amber-700 font-bold text-[11px] animate-pulse">
                    <i data-lucide="alert-circle" class="w-3 h-3"></i> Perlu Review SPV
                </span>
                @else
                <span class="inline-flex items-center gap-0.5 px-1.5 py-0.5 rounded-md bg-emerald-50 text-emerald-700 font-bold text-[11px]">
                    <i data-lucide="check-circle-2" class="w-3 h-3"></i> Semua Disetujui
                </span>
                @endif
            </div>
        </div>

        <!-- KPI 3: Total Active Roster -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_8px_30px_rgba(0,0,0,0.06)] transition-all group">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[11px] font-bold uppercase tracking-wider text-[#86868B]">Active Roster</span>
                <div class="w-10 h-10 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                    <i data-lucide="gamepad-2" class="w-5 h-5"></i>
                </div>
            </div>
            <div class="text-3xl font-extrabold text-[#1D1D1F] mb-1">{{ number_format($totalPegawai) }}</div>
            <div class="flex items-center gap-1.5 text-xs">
                <span class="inline-flex items-center gap-0.5 px-1.5 py-0.5 rounded-md bg-cyan-50 text-cyan-700 font-bold text-[11px]">
                    <i data-lucide="shield" class="w-3 h-3"></i>
                    {{ count($deptLabels) }} Divisi
                </span>
                <span class="text-[#86868B] font-medium">player & staff</span>
            </div>
        </div>

        <!-- KPI 4: Average Salary -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_8px_30px_rgba(0,0,0,0.06)] transition-all group">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[11px] font-bold uppercase tracking-wider text-[#86868B]">Rata-Rata Gaji Pokok</span>
                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                    <i data-lucide="bar-chart-3" class="w-5 h-5"></i>
                </div>
            </div>
            <div class="text-xl font-extrabold text-[#1D1D1F] mb-1 leading-tight">
                Rp {{ number_format($avgGajiPokok, 0, ',', '.') }}
            </div>
            <div class="flex items-center gap-1.5 text-xs">
                <span class="inline-flex items-center gap-0.5 px-1.5 py-0.5 rounded-md bg-indigo-50 text-indigo-700 font-bold text-[11px]">
                    <i data-lucide="calculator" class="w-3 h-3"></i> Per Member Roster
                </span>
            </div>
        </div>
    </div>

    <!-- Status Distribution Cards -->
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-emerald-50/80 border border-emerald-200/50 rounded-2xl p-4 flex items-center justify-between">
            <div>
                <span class="text-[10px] uppercase font-bold tracking-wider text-emerald-700 block">Disetujui (Paid)</span>
                <span class="text-2xl font-extrabold text-emerald-800">{{ $disetujuiCount }}</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-emerald-100/80 text-emerald-700 flex items-center justify-center">
                <i data-lucide="check-circle" class="w-5 h-5"></i>
            </div>
        </div>
        <div class="bg-amber-50/80 border border-amber-200/50 rounded-2xl p-4 flex items-center justify-between">
            <div>
                <span class="text-[10px] uppercase font-bold tracking-wider text-amber-700 block">Draf / Pending</span>
                <span class="text-2xl font-extrabold text-amber-800">{{ $pendingApproval }}</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-amber-100/80 text-amber-700 flex items-center justify-center">
                <i data-lucide="file-edit" class="w-5 h-5"></i>
            </div>
        </div>
        <div class="bg-rose-50/80 border border-rose-200/50 rounded-2xl p-4 flex items-center justify-between">
            <div>
                <span class="text-[10px] uppercase font-bold tracking-wider text-rose-700 block">Dibatalkan</span>
                <span class="text-2xl font-extrabold text-rose-800">{{ $dibatalkanCount }}</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-rose-100/80 text-rose-700 flex items-center justify-center">
                <i data-lucide="x-circle" class="w-5 h-5"></i>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Chart 1: Payroll Distribution by Divisi Game -->
        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="text-sm font-bold text-[#1D1D1F] tracking-tight flex items-center gap-2">
                        <i data-lucide="pie-chart" class="w-4 h-4 text-[#0052CC]"></i>
                        Distribusi Gaji per Divisi Game
                    </h3>
                    <p class="text-xs text-[#86868B] mt-0.5">Berdasarkan akumulasi gaji pokok per divisi game</p>
                </div>
            </div>
            <div id="chartDeptDonut" class="w-full" style="min-height: 300px;"></div>
        </div>

        <!-- Chart 2: Monthly Payroll Cost History (Bar) -->
        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="text-sm font-bold text-[#1D1D1F] tracking-tight flex items-center gap-2">
                        <i data-lucide="bar-chart-2" class="w-4 h-4 text-[#0052CC]"></i>
                        Riwayat Biaya Penggajian Bulanan
                    </h3>
                    <p class="text-xs text-[#86868B] mt-0.5">Pengeluaran total per periode penggajian EVOS</p>
                </div>
            </div>
            <div id="chartMonthlyBar" class="w-full" style="min-height: 300px;"></div>
        </div>
    </div>

    <!-- Average Salary by Divisi + Recent Transactions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Avg Salary by Divisi Game -->
        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6 space-y-4">
            <h3 class="text-sm font-bold text-[#1D1D1F] tracking-tight flex items-center gap-2">
                <i data-lucide="shield" class="w-4 h-4 text-[#0052CC]"></i>
                Rata-Rata Gaji per Divisi Game
            </h3>

            <div class="space-y-3">
                @foreach($avgByDept as $idx => $dept)
                <div class="flex items-center justify-between py-2 {{ !$loop->last ? 'border-b border-slate-100' : '' }}">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center text-white font-bold text-xs shadow-sm
                            {{ $idx === 0 ? 'bg-[#0052CC]' : ($idx === 1 ? 'bg-cyan-600' : ($idx === 2 ? 'bg-sky-500' : 'bg-slate-600')) }}">
                            {{ strtoupper(substr($dept->dept_name, 0, 2)) }}
                        </div>
                        <span class="text-xs font-semibold text-[#1D1D1F]">{{ $dept->dept_name }}</span>
                    </div>
                    <span class="text-xs font-extrabold text-[#1D1D1F]">Rp {{ number_format($dept->avg_gaji, 0, ',', '.') }}</span>
                </div>
                @endforeach
            </div>

            <!-- Role Access Card -->
            <div class="mt-4 bg-[#F2F2F7] rounded-xl p-4 text-[#1D1D1F] space-y-2 border border-slate-200/60">
                <div class="flex items-center gap-2 text-xs font-bold">
                    <i data-lucide="shield-check" class="w-4 h-4 text-[#0052CC]"></i>
                    <span>Akses Role EVOS: </span>
                    @role('supervisor-payroll')
                    <span class="px-2 py-0.5 rounded bg-blue-100 text-[#0052CC] text-[10px] font-bold">Supervisor Payroll</span>
                    @elserole('staff-payroll')
                    <span class="px-2 py-0.5 rounded bg-blue-100 text-[#0052CC] text-[10px] font-bold">Staff Payroll</span>
                    @else
                    <span class="px-2 py-0.5 rounded bg-slate-200 text-slate-700 text-[10px] font-bold">User Standard</span>
                    @endrole
                </div>
                <p class="text-[11px] text-[#86868B] leading-relaxed">
                    @role('supervisor-payroll')
                    Anda berhak menyetujui atau membatalkan seluruh draf slip penggajian roster.
                    @elserole('staff-payroll')
                    Anda berhak menginput, mengkalkulasi, dan memproses gaji roster player & staff.
                    @else
                    Anda berhak mengunduh dan merekap slip penggajian.
                    @endrole
                </p>
            </div>
        </div>

        <!-- Recent Transactions / Activity Log (2 Cols) -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200/60 shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6 flex flex-col">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="text-sm font-bold text-[#1D1D1F] tracking-tight flex items-center gap-2">
                        <i data-lucide="activity" class="w-4 h-4 text-[#0052CC]"></i>
                        Aktivitas Penggajian Roster Terbaru
                    </h3>
                    <p class="text-xs text-[#86868B] mt-0.5">8 slip penggajian player & staff terakhir yang diproses</p>
                </div>
                <a href="{{ route('penggajian.index') }}" class="text-xs font-bold text-[#0052CC] hover:text-blue-700 flex items-center gap-1 hover:underline">
                    Lihat Semua <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>

            <div class="overflow-x-auto flex-1">
                <table class="w-full text-left text-xs border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200 text-[#86868B] uppercase font-semibold text-[10px]">
                            <th class="p-3">Ref & Member</th>
                            <th class="p-3">Divisi Game</th>
                            <th class="p-3">Periode</th>
                            <th class="p-3 text-right">Total Gaji</th>
                            <th class="p-3 text-center">Status</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-[#1D1D1F]">
                        @forelse($recentPenggajian as $p)
                        <tr class="hover:bg-[#FAFAFC] transition-colors">
                            <td class="p-3">
                                <div class="flex items-center gap-2.5">
                                    <img src="https://ui-avatars.com/api/?background=0052CC&color=ffffff&bold=true&name={{ urlencode($p->pegawai->nama ?? 'EVOS') }}" class="w-8 h-8 rounded-lg shadow-sm border border-slate-200 shrink-0" alt="Avatar">
                                    <div>
                                        <div class="font-bold text-[#1D1D1F] text-xs">{{ $p->pegawai->nama ?? 'N/A' }}</div>
                                        <div class="text-[10px] text-[#86868B] font-mono">#{{ $p->no_ref }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-3">
                                <span class="px-2 py-0.5 rounded-lg bg-blue-50 text-[#0052CC] text-xs font-semibold">
                                    {{ $p->pegawai->departemen?->nama ?? '-' }}
                                </span>
                            </td>
                            <td class="p-3 font-medium text-[#1D1D1F]">{{ $p->periode }}</td>
                            <td class="p-3 text-right font-extrabold text-[#1D1D1F]">
                                Rp {{ number_format($p->total_gaji, 0, ',', '.') }}
                            </td>
                            <td class="p-3 text-center">
                                @if($p->status == 'disetujui')
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Paid
                                </span>
                                @elseif($p->status == 'dibatalkan')
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-700 border border-rose-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Cancelled
                                </span>
                                @else
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-700 border border-amber-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Pending
                                </span>
                                @endif
                            </td>
                            <td class="p-3 text-center">
                                <a href="{{ route('penggajian.show', $p->id) }}" class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-[#F2F2F7] hover:bg-[#0052CC] hover:text-white text-[#1D1D1F] transition-all" title="View Detail">
                                    <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-10 text-center text-[#86868B]">
                                <div class="flex flex-col items-center gap-2">
                                    <i data-lucide="inbox" class="w-8 h-8 text-slate-300"></i>
                                    <span class="text-sm font-medium">Belum ada transaksi penggajian roster</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- ApexCharts CDN -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Donut Chart: Divisi Game Distribution
    const deptLabels = @json($deptLabels);
    const deptValues = @json($deptValues);

    const donutColors = ['#0052CC', '#00D2FF', '#0284c7', '#3b82f6', '#06b6d4', '#6366f1', '#0f172a'];

    new ApexCharts(document.querySelector("#chartDeptDonut"), {
        series: deptValues,
        chart: {
            type: 'donut',
            height: 300,
            fontFamily: 'Plus Jakarta Sans, sans-serif',
        },
        labels: deptLabels,
        colors: donutColors.slice(0, deptLabels.length),
        plotOptions: {
            pie: {
                donut: {
                    size: '60%',
                    labels: {
                        show: true,
                        name: { show: true, fontSize: '13px', fontWeight: 700 },
                        value: {
                            show: true,
                            fontSize: '14px',
                            fontWeight: 800,
                            formatter: function (val) {
                                return 'Rp ' + Number(val).toLocaleString('id-ID');
                            }
                        },
                        total: {
                            show: true,
                            label: 'Total Gaji Pokok',
                            fontSize: '11px',
                            fontWeight: 600,
                            color: '#86868B',
                            formatter: function (w) {
                                const total = w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                return 'Rp ' + total.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        },
        dataLabels: { enabled: false },
        legend: {
            position: 'bottom',
            fontSize: '12px',
            fontWeight: 600,
            labels: { colors: '#1D1D1F' },
            markers: { size: 8, shape: 'circle', offsetX: -3 },
            itemMargin: { horizontal: 12, vertical: 4 },
        },
        stroke: { width: 2, colors: ['#fff'] },
        tooltip: {
            y: {
                formatter: function (val) {
                    return 'Rp ' + Number(val).toLocaleString('id-ID');
                }
            }
        },
        responsive: [{
            breakpoint: 480,
            options: { chart: { height: 260 }, legend: { position: 'bottom' } }
        }]
    }).render();

    // Bar Chart: Monthly Cost History
    const monthLabels = @json($monthLabels);
    const monthValues = @json($monthValues);

    new ApexCharts(document.querySelector("#chartMonthlyBar"), {
        series: [{
            name: 'Total Gaji Roster',
            data: monthValues
        }],
        chart: {
            type: 'bar',
            height: 300,
            fontFamily: 'Plus Jakarta Sans, sans-serif',
            toolbar: { show: false },
        },
        plotOptions: {
            bar: {
                borderRadius: 8,
                columnWidth: '55%',
                distributed: false,
                dataLabels: { position: 'top' }
            }
        },
        colors: ['#0052CC'],
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                type: 'vertical',
                shadeIntensity: 0.3,
                gradientToColors: ['#00D2FF'],
                inverseColors: false,
                opacityFrom: 1,
                opacityTo: 0.85,
                stops: [0, 100]
            }
        },
        dataLabels: {
            enabled: true,
            offsetY: -20,
            style: { fontSize: '10px', fontWeight: 800, colors: ['#1D1D1F'] },
            formatter: function (val) {
                if (val >= 1000000) return 'Rp ' + (val / 1000000).toFixed(1) + 'Jt';
                if (val >= 1000) return 'Rp ' + (val / 1000).toFixed(0) + 'K';
                return 'Rp ' + val;
            }
        },
        xaxis: {
            categories: monthLabels,
            labels: {
                style: { fontSize: '11px', fontWeight: 600, colors: '#86868B' }
            },
            axisBorder: { show: false },
            axisTicks: { show: false }
        },
        yaxis: {
            labels: {
                style: { fontSize: '11px', colors: '#86868B' },
                formatter: function (val) {
                    if (val >= 1000000) return (val / 1000000).toFixed(1) + 'Jt';
                    if (val >= 1000) return (val / 1000).toFixed(0) + 'K';
                    return val;
                }
            }
        },
        grid: {
            borderColor: '#F2F2F7',
            strokeDashArray: 4,
            padding: { top: -10 }
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return 'Rp ' + Number(val).toLocaleString('id-ID');
                }
            }
        }
    }).render();
});
</script>
@endpush
