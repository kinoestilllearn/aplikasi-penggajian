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
            ->addColumn('departemen', function (Pegawai $pegawai) {
                return $pegawai->departemen->nama;
            })
            ->addColumn('posisi', function (Pegawai $pegawai) {
                return $pegawai->posisi->nama;
            })
            ->addColumn('action', function (Pegawai $pegawai) {
                return view('pegawai.action', compact('pegawai'));
            });
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
        //->dom('Bfrtip')
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
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
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
            Column::make('no_pegawai'),
            Column::make('nama'),
            Column::make('jenis_kelamin')
                ->title('L/P')
                ->searchable(false),
            Column::make('tempat_lahir'),
            Column::make('tanggal_lahir'),
            Column::make('departemen'),
            Column::make('posisi'),
            Column::make('status_pegawai'),
            Column::make('gaji_pokok')
                ->searchable(false),
            Column::make('tunjangan_tetap')
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
        return 'Pegawai_' . date('YmdHis');
    }
}
