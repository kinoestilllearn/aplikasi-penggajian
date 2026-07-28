@extends('layouts.app')

@section('title', 'Executive Payroll Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Welcome Header Banner -->
    <div class="relative overflow-hidden bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 rounded-2xl p-6 md:p-8 text-white shadow-xl border border-slate-800">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute right-1/3 -top-10 w-64 h-64 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="px-2.5 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 text-xs font-semibold border border-emerald-500/30 flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        Payroll Active
                    </span>
                    <span class="text-xs text-slate-400 font-medium">&bull; {{ date('l, d F Y') }}</span>
                </div>
                <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight text-white">
                    Selamat Datang, {{ Auth::user()->name }}! 👋
                </h1>
                <p class="text-slate-300 text-sm mt-1 max-w-2xl">
                    Executive Payroll Dashboard &mdash; pantau semua metrik penggajian, distribusi biaya per departemen, dan aktivitas transaksi terbaru.
                </p>
            </div>

            <!-- Quick Actions -->
            <div class="flex items-center gap-2 shrink-0 flex-wrap">
                @can('penggajian-create')
                <a href="{{ route('penggajian.create') }}" class="inline-flex items-center gap-2 px-5 py-3 bg-emerald-600 hover:bg-emerald-500 text-white font-semibold rounded-xl shadow-lg shadow-emerald-600/30 hover:shadow-emerald-600/50 transition-all text-xs group">
                    <i data-lucide="play-circle" class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
                    <span>Run Payroll</span>
                </a>
                @endcan
                <a href="{{ route('penggajian.index') }}" class="inline-flex items-center gap-2 px-4 py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-xl shadow-lg shadow-indigo-600/30 transition-all text-xs group">
                    <i data-lucide="file-down" class="w-4 h-4"></i>
                    <span>Export Slips</span>
                </a>
                @can('pegawai-index')
                <a href="{{ route('pegawai.index') }}" class="inline-flex items-center gap-2 px-4 py-3 bg-slate-800/80 hover:bg-slate-700 text-white font-semibold rounded-xl border border-slate-700 transition-all text-xs">
                    <i data-lucide="user-plus" class="w-4 h-4"></i>
                    <span>Manage Staff</span>
                </a>
                @endcan
            </div>
        </div>
    </div>

    <!-- KPI Stat Cards Row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- KPI 1: Total Monthly Payroll -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md transition-shadow group">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Total Payroll</span>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                    <i data-lucide="wallet" class="w-5 h-5"></i>
                </div>
            </div>
            <div class="text-xl font-extrabold text-slate-900 mb-1 leading-tight">
                Rp {{ number_format($totalNominalGaji, 0, ',', '.') }}
            </div>
            <div class="flex items-center gap-1.5 text-xs">
                <span class="inline-flex items-center gap-0.5 px-1.5 py-0.5 rounded-md bg-emerald-50 text-emerald-700 font-bold text-[11px]">
                    <i data-lucide="trending-up" class="w-3 h-3"></i>
                    {{ $totalPenggajian }}
                </span>
                <span class="text-slate-400 font-medium">slip tercatat</span>
            </div>
        </div>

        <!-- KPI 2: Pending Approval -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md transition-shadow group">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Pending Approval</span>
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                    <i data-lucide="clock" class="w-5 h-5"></i>
                </div>
            </div>
            <div class="text-3xl font-extrabold text-amber-600 mb-1">{{ number_format($pendingApproval) }}</div>
            <div class="flex items-center gap-1.5 text-xs">
                @if($pendingApproval > 0)
                <span class="inline-flex items-center gap-0.5 px-1.5 py-0.5 rounded-md bg-amber-50 text-amber-700 font-bold text-[11px] animate-pulse">
                    <i data-lucide="alert-circle" class="w-3 h-3"></i> Perlu Ditinjau
                </span>
                @else
                <span class="inline-flex items-center gap-0.5 px-1.5 py-0.5 rounded-md bg-emerald-50 text-emerald-700 font-bold text-[11px]">
                    <i data-lucide="check-circle-2" class="w-3 h-3"></i> Semua Selesai
                </span>
                @endif
            </div>
        </div>

        <!-- KPI 3: Total Active Employees -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md transition-shadow group">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Active Employees</span>
                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                    <i data-lucide="users" class="w-5 h-5"></i>
                </div>
            </div>
            <div class="text-3xl font-extrabold text-slate-900 mb-1">{{ number_format($totalPegawai) }}</div>
            <div class="flex items-center gap-1.5 text-xs">
                <span class="inline-flex items-center gap-0.5 px-1.5 py-0.5 rounded-md bg-indigo-50 text-indigo-700 font-bold text-[11px]">
                    <i data-lucide="building-2" class="w-3 h-3"></i>
                    {{ count($deptLabels) }} Dept
                </span>
                <span class="text-slate-400 font-medium">terdaftar</span>
            </div>
        </div>

        <!-- KPI 4: Average Salary -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md transition-shadow group">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Rata-Rata Gaji Pokok</span>
                <div class="w-10 h-10 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                    <i data-lucide="bar-chart-3" class="w-5 h-5"></i>
                </div>
            </div>
            <div class="text-xl font-extrabold text-slate-900 mb-1 leading-tight">
                Rp {{ number_format($avgGajiPokok, 0, ',', '.') }}
            </div>
            <div class="flex items-center gap-1.5 text-xs">
                <span class="inline-flex items-center gap-0.5 px-1.5 py-0.5 rounded-md bg-violet-50 text-violet-700 font-bold text-[11px]">
                    <i data-lucide="calculator" class="w-3 h-3"></i> Per Pegawai
                </span>
            </div>
        </div>
    </div>

    <!-- Status Distribution Mini Cards -->
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-emerald-50 border border-emerald-200/60 rounded-xl p-4 flex items-center justify-between">
            <div>
                <span class="text-[10px] uppercase font-bold tracking-wider text-emerald-600 block">Disetujui</span>
                <span class="text-2xl font-extrabold text-emerald-700">{{ $disetujuiCount }}</span>
            </div>
            <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center">
                <i data-lucide="check-circle" class="w-5 h-5"></i>
            </div>
        </div>
        <div class="bg-amber-50 border border-amber-200/60 rounded-xl p-4 flex items-center justify-between">
            <div>
                <span class="text-[10px] uppercase font-bold tracking-wider text-amber-600 block">Draf / Pending</span>
                <span class="text-2xl font-extrabold text-amber-700">{{ $pendingApproval }}</span>
            </div>
            <div class="w-10 h-10 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center">
                <i data-lucide="file-edit" class="w-5 h-5"></i>
            </div>
        </div>
        <div class="bg-rose-50 border border-rose-200/60 rounded-xl p-4 flex items-center justify-between">
            <div>
                <span class="text-[10px] uppercase font-bold tracking-wider text-rose-600 block">Dibatalkan</span>
                <span class="text-2xl font-extrabold text-rose-700">{{ $dibatalkanCount }}</span>
            </div>
            <div class="w-10 h-10 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center">
                <i data-lucide="x-circle" class="w-5 h-5"></i>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Chart 1: Payroll Distribution by Department (Donut) -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="text-sm font-bold text-slate-900 tracking-tight flex items-center gap-2">
                        <i data-lucide="pie-chart" class="w-4 h-4 text-indigo-600"></i>
                        Distribusi Gaji per Departemen
                    </h3>
                    <p class="text-xs text-slate-400 mt-0.5">Berdasarkan total gaji pokok seluruh pegawai</p>
                </div>
            </div>
            <div id="chartDeptDonut" class="w-full" style="min-height: 300px;"></div>
        </div>

        <!-- Chart 2: Monthly Payroll Cost History (Bar) -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="text-sm font-bold text-slate-900 tracking-tight flex items-center gap-2">
                        <i data-lucide="bar-chart-2" class="w-4 h-4 text-emerald-600"></i>
                        Riwayat Biaya Penggajian Bulanan
                    </h3>
                    <p class="text-xs text-slate-400 mt-0.5">Pengeluaran total per periode penggajian</p>
                </div>
            </div>
            <div id="chartMonthlyBar" class="w-full" style="min-height: 300px;"></div>
        </div>
    </div>

    <!-- Average Salary by Department Table + Recent Transactions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Avg Salary by Department Card -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 space-y-4">
            <h3 class="text-sm font-bold text-slate-900 tracking-tight flex items-center gap-2">
                <i data-lucide="building-2" class="w-4 h-4 text-violet-600"></i>
                Rata-Rata Gaji per Departemen
            </h3>

            <div class="space-y-3">
                @foreach($avgByDept as $idx => $dept)
                <div class="flex items-center justify-between py-2 {{ !$loop->last ? 'border-b border-slate-100' : '' }}">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center text-white font-bold text-xs shadow-sm
                            {{ $idx === 0 ? 'bg-indigo-600' : ($idx === 1 ? 'bg-emerald-600' : ($idx === 2 ? 'bg-amber-500' : 'bg-slate-500')) }}">
                            {{ strtoupper(substr($dept->dept_name, 0, 2)) }}
                        </div>
                        <span class="text-xs font-semibold text-slate-800">{{ $dept->dept_name }}</span>
                    </div>
                    <span class="text-xs font-extrabold text-slate-900">Rp {{ number_format($dept->avg_gaji, 0, ',', '.') }}</span>
                </div>
                @endforeach
            </div>

            <!-- Quick Role Access Card -->
            <div class="mt-4 bg-slate-900 rounded-xl p-4 text-white space-y-2">
                <div class="flex items-center gap-2 text-xs font-bold">
                    <i data-lucide="shield-check" class="w-4 h-4 text-emerald-400"></i>
                    <span>Hak Akses: </span>
                    @role('supervisor-payroll')
                    <span class="px-2 py-0.5 rounded bg-emerald-500/20 text-emerald-300 text-[10px] font-bold">Supervisor Payroll</span>
                    @elserole('staff-payroll')
                    <span class="px-2 py-0.5 rounded bg-indigo-500/20 text-indigo-300 text-[10px] font-bold">Staff Payroll</span>
                    @else
                    <span class="px-2 py-0.5 rounded bg-slate-700 text-slate-300 text-[10px] font-bold">User Standard</span>
                    @endrole
                </div>
                <p class="text-[11px] text-slate-400 leading-relaxed">
                    @role('supervisor-payroll')
                    Anda dapat menyetujui atau membatalkan seluruh draf slip penggajian karyawan.
                    @elserole('staff-payroll')
                    Anda dapat membuat, mengkalkulasi, dan mengelola data penggajian karyawan.
                    @else
                    Anda dapat melihat dan mengunduh laporan penggajian.
                    @endrole
                </p>
            </div>
        </div>

        <!-- Recent Transactions / Activity Log (2 Cols) -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 flex flex-col">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="text-sm font-bold text-slate-900 tracking-tight flex items-center gap-2">
                        <i data-lucide="activity" class="w-4 h-4 text-indigo-600"></i>
                        Transaksi & Activity Log Terbaru
                    </h3>
                    <p class="text-xs text-slate-400 mt-0.5">8 slip penggajian terakhir yang diproses sistem</p>
                </div>
                <a href="{{ route('penggajian.index') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-700 flex items-center gap-1 hover:underline">
                    Lihat Semua <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>

            <div class="overflow-x-auto flex-1">
                <table class="w-full text-left text-xs border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200 text-slate-400 uppercase font-semibold text-[10px]">
                            <th class="p-3">Ref & Pegawai</th>
                            <th class="p-3">Departemen</th>
                            <th class="p-3">Periode</th>
                            <th class="p-3 text-right">Total Gaji</th>
                            <th class="p-3 text-center">Status</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse($recentPenggajian as $p)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="p-3">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center font-bold text-[11px] shrink-0">
                                        {{ strtoupper(substr($p->pegawai->nama ?? 'N', 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-slate-900 text-xs">{{ $p->pegawai->nama ?? 'N/A' }}</div>
                                        <div class="text-[10px] text-slate-400 font-mono">#{{ $p->no_ref }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-3">
                                <span class="text-xs font-medium text-slate-600">{{ $p->pegawai->departemen->nama ?? '-' }}</span>
                            </td>
                            <td class="p-3 font-medium text-slate-700">{{ $p->periode }}</td>
                            <td class="p-3 text-right font-extrabold text-slate-900">
                                Rp {{ number_format($p->total_gaji, 0, ',', '.') }}
                            </td>
                            <td class="p-3 text-center">
                                @if($p->status == 'disetujui')
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Paid
                                </span>
                                @elseif($p->status == 'dibatalkan')
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-700 border border-rose-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Failed
                                </span>
                                @else
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-700 border border-amber-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Pending
                                </span>
                                @endif
                            </td>
                            <td class="p-3 text-center">
                                <a href="{{ route('penggajian.show', $p->id) }}" class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-slate-100 hover:bg-indigo-600 hover:text-white text-slate-500 transition-all" title="View Detail">
                                    <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-10 text-center text-slate-400">
                                <div class="flex flex-col items-center gap-2">
                                    <i data-lucide="inbox" class="w-8 h-8 text-slate-300"></i>
                                    <span class="text-sm font-medium">Belum ada transaksi penggajian</span>
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
    // Donut Chart: Department Distribution
    const deptLabels = @json($deptLabels);
    const deptValues = @json($deptValues);

    const donutColors = ['#4f46e5', '#059669', '#f59e0b', '#ef4444', '#8b5cf6', '#06b6d4', '#ec4899', '#84cc16'];

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
                            color: '#94a3b8',
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
            labels: { colors: '#475569' },
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
            name: 'Total Gaji',
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
        colors: ['#4f46e5'],
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                type: 'vertical',
                shadeIntensity: 0.3,
                gradientToColors: ['#059669'],
                inverseColors: false,
                opacityFrom: 1,
                opacityTo: 0.85,
                stops: [0, 100]
            }
        },
        dataLabels: {
            enabled: true,
            offsetY: -20,
            style: { fontSize: '10px', fontWeight: 800, colors: ['#334155'] },
            formatter: function (val) {
                if (val >= 1000000) return 'Rp ' + (val / 1000000).toFixed(1) + 'Jt';
                if (val >= 1000) return 'Rp ' + (val / 1000).toFixed(0) + 'K';
                return 'Rp ' + val;
            }
        },
        xaxis: {
            categories: monthLabels,
            labels: {
                style: { fontSize: '11px', fontWeight: 600, colors: '#64748b' }
            },
            axisBorder: { show: false },
            axisTicks: { show: false }
        },
        yaxis: {
            labels: {
                style: { fontSize: '11px', colors: '#94a3b8' },
                formatter: function (val) {
                    if (val >= 1000000) return (val / 1000000).toFixed(1) + 'Jt';
                    if (val >= 1000) return (val / 1000).toFixed(0) + 'K';
                    return val;
                }
            }
        },
        grid: {
            borderColor: '#f1f5f9',
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
