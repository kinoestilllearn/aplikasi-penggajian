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
            ->addColumn('pegawai', function (Penggajian $penggajian) {
                return $penggajian->pegawai->nama;
            })
            ->addColumn('posisi', function (Penggajian $penggajian) {
                return $penggajian->pegawai->posisi->nama;
            })
            ->addColumn('departemen', function (Penggajian $penggajian) {
                return $penggajian->pegawai->departemen->nama;
            })
            ->addColumn('dibuat_oleh', function (Penggajian $penggajian) {
                return $penggajian->dibuatOleh->name;
            })
            ->addColumn('disetujui_oleh', function (Penggajian $penggajian) {
                if ($penggajian->disetujui_oleh === null) {
                    $response = '-';
                } else {
                    $response = $penggajian->disetujuiOleh->name;
                }
                return $response;
            })
            ->addColumn('dibatalkan_oleh', function (Penggajian $penggajian) {
                if ($penggajian->dibatalkan_oleh === null) {
                    $response = '-';
                } else {
                    $response = $penggajian->dibatalkanOleh->name;
                }
                return $response;
            })
            ->addColumn('gaji_pokok', function (Penggajian $penggajian) {
                if ($penggajian->pegawai->gaji_pokok) {
                    $gajiPokok = $penggajian->pegawai->gaji_pokok;
                } else {
                    $gajiPokok = 0;
                }

                return 'Rp' . number_format($gajiPokok, 2, ',', '.');
            })
            ->addColumn('created_at', function (Penggajian $penggajian) {
                return $penggajian->created_at->format('d-m-Y H:i:s T');
            })
            ->addColumn('updated_at', function (Penggajian $penggajian) {
                return $penggajian->updated_at->format('d-m-Y H:i:s T');
            })
            ->addColumn('action', function (Penggajian $penggajian) {
                return view('penggajian.action', compact('penggajian'));
            });
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
        //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->responsive()
            ->columnDefs([
                ['responsivePriority' => 1, 'targets' => 0],
                ['responsivePriority' => 2, 'targets' => 6],
                ['responsivePriority' => 3, 'targets' => 16],
            ])
            ->fixedHeader()
            ->rowCallback("function(row, data, index) {
                if (data['status'] == 'disetujui') {
                    $('td', row).addClass('bg-success text-white');
                } else if (data['status'] == 'dibatalkan') {
                    $('td', row).addClass('bg-danger text-white fst-italic');
                }
            }")
            ->buttons([
                Button::make('add'),
                Button::make('excel'),
                Button::make('csv'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
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
            Column::make('no_ref'),
            Column::make('tanggal_mulai'),
            Column::make('tanggal_hingga'),
            Column::make('periode'),
            Column::make('status'),
            Column::make('pegawai'),
            Column::make('posisi'),
            Column::make('departemen'),
            Column::make('gaji_pokok'),
            Column::make('jumlah_tunjangan_tetap'),
            Column::make('dibuat_oleh'),
            Column::make('disetujui_oleh'),
            Column::make('dibatalkan_oleh'),
            Column::make('created_at'),
            Column::make('updated_at'),
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
