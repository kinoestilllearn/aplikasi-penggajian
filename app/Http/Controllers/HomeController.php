<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\Pegawai;
use App\Models\Penggajian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // KPI Stat Cards
        $totalPegawai = Pegawai::count();
        $totalPenggajian = Penggajian::count();
        $pendingApproval = Penggajian::where('status', 'draf')->count();
        $disetujuiCount = Penggajian::where('status', 'disetujui')->count();
        $dibatalkanCount = Penggajian::where('status', 'dibatalkan')->count();
        $totalNominalGaji = Penggajian::sum('total_gaji');
        $totalGajiDisetujui = Penggajian::where('status', 'disetujui')->sum('total_gaji');

        // Average salary per employee (based on gaji_pokok in pegawai table)
        $avgGajiPokok = Pegawai::avg('gaji_pokok') ?? 0;

        // Payroll Distribution by Department (for donut chart)
        $deptDistribution = Pegawai::select('departemen.nama as dept_name', DB::raw('SUM(pegawai.gaji_pokok) as total_gaji'), DB::raw('COUNT(pegawai.id) as jumlah'))
            ->join('departemen', 'pegawai.departemen_id', '=', 'departemen.id')
            ->groupBy('departemen.nama')
            ->orderByDesc('total_gaji')
            ->get();

        $deptLabels = $deptDistribution->pluck('dept_name')->toArray();
        $deptValues = $deptDistribution->pluck('total_gaji')->map(fn($v) => (float) $v)->toArray();
        $deptCounts = $deptDistribution->pluck('jumlah')->toArray();

        // Monthly Payroll Cost History (bar chart) - from penggajian table grouped by periode
        $monthlyHistory = Penggajian::select('periode', DB::raw('SUM(total_gaji) as total'), DB::raw('COUNT(id) as jumlah_transaksi'))
            ->groupBy('periode')
            ->orderBy('periode')
            ->get();

        $monthLabels = $monthlyHistory->pluck('periode')->toArray();
        $monthValues = $monthlyHistory->pluck('total')->map(fn($v) => (float) $v)->toArray();

        // Average salary by department (for KPI insight)
        $avgByDept = Pegawai::select('departemen.nama as dept_name', DB::raw('AVG(pegawai.gaji_pokok) as avg_gaji'))
            ->join('departemen', 'pegawai.departemen_id', '=', 'departemen.id')
            ->groupBy('departemen.nama')
            ->orderByDesc('avg_gaji')
            ->get();

        // Recent Penggajian Transactions (last 8)
        $recentPenggajian = Penggajian::with(['pegawai.departemen', 'pegawai.posisi', 'dibuatOleh'])
            ->latest()
            ->take(8)
            ->get();

        return view('home', compact(
            'totalPegawai',
            'totalPenggajian',
            'pendingApproval',
            'disetujuiCount',
            'dibatalkanCount',
            'totalNominalGaji',
            'totalGajiDisetujui',
            'avgGajiPokok',
            'deptLabels',
            'deptValues',
            'deptCounts',
            'monthLabels',
            'monthValues',
            'avgByDept',
            'recentPenggajian'
        ));
    }
}
