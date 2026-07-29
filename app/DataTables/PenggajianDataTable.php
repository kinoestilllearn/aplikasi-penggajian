<?php

namespace App\DataTables;

use App\Models\Penggajian;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PenggajianDataTable extends DataTable
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
            ->editColumn('status', function (Penggajian $penggajian) {
                $status = strtolower($penggajian->status);
                if ($status === 'disetujui') {
                    return '<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100/90 text-emerald-900 border border-emerald-300 dark:bg-emerald-900/40 dark:text-emerald-300 dark:border-emerald-800"><span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>Disetujui</span>';
                } elseif ($status === 'dibatalkan') {
                    return '<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-rose-100/90 text-rose-900 border border-rose-300 dark:bg-rose-900/40 dark:text-rose-300 dark:border-rose-800"><span class="w-1.5 h-1.5 rounded-full bg-rose-600"></span>Dibatalkan</span>';
                } else {
                    return '<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100/90 text-amber-900 border border-amber-300 dark:bg-amber-900/40 dark:text-amber-300 dark:border-amber-800"><span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span>Draf</span>';
                }
            })
            ->addColumn('pegawai', function (Penggajian $penggajian) {
                return '<span class="font-extrabold text-[#0F172A] dark:text-[#F5F5F7]">' . e($penggajian->pegawai?->nama ?? '-') . '</span>';
            })
            ->addColumn('posisi', function (Penggajian $penggajian) {
                return '<span class="font-semibold text-slate-800 dark:text-slate-300">' . e($penggajian->pegawai?->posisi?->nama ?? '-') . '</span>';
            })
            ->addColumn('departemen', function (Penggajian $penggajian) {
                return '<span class="px-2.5 py-1 rounded-lg bg-blue-50 dark:bg-[#1C2536] text-[#0052CC] dark:text-[#00D2FF] text-xs font-bold border border-blue-100 dark:border-blue-900/40">' . e($penggajian->pegawai?->departemen?->nama ?? '-') . '</span>';
            })
            ->addColumn('dibuat_oleh', function (Penggajian $penggajian) {
                return '<span class="font-medium text-slate-800 dark:text-slate-300">' . e($penggajian->dibuatOleh?->name ?? '-') . '</span>';
            })
            ->addColumn('disetujui_oleh', function (Penggajian $penggajian) {
                return '<span class="font-medium text-slate-800 dark:text-slate-300">' . e($penggajian->disetujuiOleh?->name ?? '-') . '</span>';
            })
            ->addColumn('dibatalkan_oleh', function (Penggajian $penggajian) {
                return '<span class="font-medium text-slate-800 dark:text-slate-300">' . e($penggajian->dibatalkanOleh?->name ?? '-') . '</span>';
            })
            ->addColumn('gaji_pokok', function (Penggajian $penggajian) {
                $gajiPokok = $penggajian->pegawai?->gaji_pokok ?? 0;
                return '<span class="font-extrabold text-[#0F172A] dark:text-[#F5F5F7]">Rp ' . number_format($gajiPokok, 0, ',', '.') . '</span>';
            })
            ->addColumn('created_at', function (Penggajian $penggajian) {
                return $penggajian->created_at ? $penggajian->created_at->format('d-m-Y H:i') : '-';
            })
            ->addColumn('updated_at', function (Penggajian $penggajian) {
                return $penggajian->updated_at ? $penggajian->updated_at->format('d-m-Y H:i') : '-';
            })
            ->addColumn('action', function (Penggajian $penggajian) {
                return view('penggajian.action', compact('penggajian'));
            })
            ->rawColumns(['status', 'pegawai', 'posisi', 'departemen', 'dibuat_oleh', 'disetujui_oleh', 'dibatalkan_oleh', 'gaji_pokok', 'action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Penggajian $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('penggajian-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1, 'desc')
            ->selectStyleSingle()
            ->responsive()
            ->columnDefs([
                ['responsivePriority' => 1, 'targets' => 0],
                ['responsivePriority' => 2, 'targets' => 1],
                ['responsivePriority' => 2, 'targets' => 5],
                ['responsivePriority' => 1, 'targets' => 16],
            ])
            ->fixedHeader()
            ->buttons([
                Button::make('excel')->text('<svg class="w-3.5 h-3.5 text-emerald-600 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>Excel'),
                Button::make('csv')->text('<svg class="w-3.5 h-3.5 text-blue-600 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>CSV'),
                Button::make('print')->text('<svg class="w-3.5 h-3.5 text-slate-700 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 002-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>Cetak'),
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
            Column::make('no_ref')
                ->title('No Ref'),
            Column::make('tanggal_mulai')
                ->title('Tgl Mulai'),
            Column::make('tanggal_hingga')
                ->title('Tgl Sampai'),
            Column::make('periode')
                ->title('Periode'),
            Column::make('status')
                ->title('Status'),
            Column::make('pegawai')
                ->title('Roster Player / Staff'),
            Column::make('posisi')
                ->title('Role / Position'),
            Column::make('departemen')
                ->title('Divisi Game'),
            Column::make('gaji_pokok')
                ->title('Gaji Pokok'),
            Column::make('jumlah_tunjangan_tetap')
                ->title('Tunjangan Tetap'),
            Column::make('dibuat_oleh')
                ->title('Dibuat Oleh'),
            Column::make('disetujui_oleh')
                ->title('Disetujui Oleh'),
            Column::make('dibatalkan_oleh')
                ->title('Dibatalkan Oleh'),
            Column::make('created_at')
                ->title('Tgl Dibuat'),
            Column::make('updated_at')
                ->title('Tgl Diubah'),
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
        return 'Penggajian_' . date('YmdHis');
    }
}
