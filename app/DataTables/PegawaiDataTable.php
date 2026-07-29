<?php

namespace App\DataTables;

use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PegawaiDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('nama', function (Pegawai $pegawai) {
                $avatarUrl = 'https://ui-avatars.com/api/?background=0052CC&color=ffffff&bold=true&name=' . urlencode($pegawai->nama);
                return '<div class="flex items-center gap-3">
                    <img src="' . $avatarUrl . '" class="w-9 h-9 rounded-xl shadow-sm border border-blue-100 shrink-0" alt="Player Avatar">
                    <div>
                        <div class="font-bold text-[#1D1D1F] leading-snug">' . e($pegawai->nama) . '</div>
                        <div class="text-[11px] text-[#0052CC] font-mono font-semibold">ID: ' . e($pegawai->no_pegawai) . '</div>
                    </div>
                </div>';
            })
            ->editColumn('jenis_kelamin', function (Pegawai $pegawai) {
                return $pegawai->jenis_kelamin == 'L'
                    ? '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-blue-50 text-[#0052CC]">Laki-Laki</span>'
                    : '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-pink-50 text-pink-700">Perempuan</span>';
            })
            ->editColumn('status_pegawai', function (Pegawai $pegawai) {
                $status = strtolower($pegawai->status_pegawai);
                if ($status === 'tetap') {
                    return '<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-blue-50 text-[#0052CC]"><span class="w-1.5 h-1.5 rounded-full bg-[#0052CC] animate-pulse"></span>Tetap</span>';
                } elseif ($status === 'kontrak') {
                    return '<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-cyan-50 text-cyan-800"><span class="w-1.5 h-1.5 rounded-full bg-cyan-500"></span>Kontrak</span>';
                } else {
                    return '<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-800"><span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>Harian Lepas</span>';
                }
            })
            ->editColumn('gaji_pokok', function (Pegawai $pegawai) {
                return '<span class="font-extrabold text-[#1D1D1F]">Rp ' . number_format($pegawai->gaji_pokok ?? 0, 0, ',', '.') . '</span>';
            })
            ->editColumn('tunjangan_tetap', function (Pegawai $pegawai) {
                return '<span class="font-bold text-slate-700">Rp ' . number_format($pegawai->tunjangan_tetap ?? 0, 0, ',', '.') . '</span>';
            })
            ->addColumn('departemen', function (Pegawai $pegawai) {
                return '<span class="px-2.5 py-1 rounded-lg bg-[#F2F2F7] text-[#0052CC] text-xs font-bold">' . e($pegawai->departemen?->nama ?? '-') . '</span>';
            })
            ->addColumn('posisi', function (Pegawai $pegawai) {
                return '<span class="font-bold text-[#1D1D1F]">' . e($pegawai->posisi?->nama ?? '-') . '</span>';
            })
            ->addColumn('action', function (Pegawai $pegawai) {
                return view('pegawai.action', compact('pegawai'));
            })
            ->rawColumns(['nama', 'jenis_kelamin', 'status_pegawai', 'gaji_pokok', 'tunjangan_tetap', 'departemen', 'posisi', 'action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Pegawai $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('pegawai-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(2, 'asc')
            ->selectStyleSingle()
            ->responsive()
            ->columnDefs([
                ['responsivePriority' => 1, 'targets' => 0],
                ['responsivePriority' => 2, 'targets' => 2],
                ['responsivePriority' => 2, 'targets' => 11],
            ])
            ->fixedHeader()
            ->buttons([
                Button::make('excel')->text('<svg class="w-3.5 h-3.5 text-emerald-600 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>Excel'),
                Button::make('csv')->text('<svg class="w-3.5 h-3.5 text-blue-600 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>CSV'),
                Button::make('pdf')->text('<svg class="w-3.5 h-3.5 text-rose-600 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>PDF'),
                Button::make('print')->text('<svg class="w-3.5 h-3.5 text-slate-600 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 002-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>Cetak'),
                Button::make('reset')->text('<svg class="w-3.5 h-3.5 text-indigo-600 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>Reset'),
                Button::make('reload')->text('<svg class="w-3.5 h-3.5 text-sky-600 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>Refresh'),
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')
                ->title('No')
                ->searchable(false)
                ->orderable(false),
            Column::make('no_pegawai')
                ->title('ID Roster'),
            Column::make('nama')
                ->title('Roster Player / Staff'),
            Column::make('jenis_kelamin')
                ->title('L/P')
                ->searchable(false),
            Column::make('tempat_lahir'),
            Column::make('tanggal_lahir'),
            Column::make('departemen')
                ->title('Divisi Game'),
            Column::make('posisi')
                ->title('Role / Position'),
            Column::make('status_pegawai')
                ->title('Status Roster'),
            Column::make('gaji_pokok')
                ->title('Gaji Pokok')
                ->searchable(false),
            Column::make('tunjangan_tetap')
                ->title('Tunjangan Tetap')
                ->searchable(false),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'EVOS_Roster_' . date('YmdHis');
    }
}
