<?php

namespace App\Http\Controllers;

use App\DataTables\PenggajianDataTable;
use App\Http\Requests\StorePenggajianRequest;
use App\Http\Requests\UpdatePenggajianRequest;
use App\Models\Pegawai;
use App\Models\Penggajian;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenggajianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PenggajianDataTable $dataTable)
    {
        return $dataTable->render('penggajian.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Tambah Data Penggajian';

        $data = [
            // 'pegawai' => Pegawai::orderBy('nama', 'asc')->get(),
            'pegawai'     => Pegawai::orderBy('id', 'asc')->get(),
            'dibuat_oleh' => User::find(1),
        ];

        return view('penggajian.create', compact('pageTitle', 'data'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePenggajianRequest $request)
    {
        $data = (new Penggajian)->storeDataPenggajian($request);

        Penggajian::create($data);

        return redirect()->route('penggajian.index')
            ->with('status', 'Data penggajian berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Auth::user()->hasRole('supervisor-payroll')) {
            $pageTitle = 'Approval Penggajian';
        } else {
            $pageTitle = 'Detail Penggajian';
        }

        $penggajian = Penggajian::find($id);

        $data = [
            'pegawai'    => Pegawai::find($penggajian->pegawai_id),
            'penggajian' => Penggajian::find($id),
        ];

        // dd($data['penggajian']->dibatalkanOleh->name ?? '-');

        return view('penggajian.show', compact('pageTitle', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit()
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePenggajianRequest $request, String $id)
    {
        $data = (new Penggajian)->updateDataPenggajian($request, $id);

        // dd($data);

        return redirect()->route('penggajian.index')
            ->with('status', 'Status penggajian dengan \'no_ref: '
                . $data['no_ref'] . '\' berhasil diubah menjadi: \'' . $data['data']['status'] .
                '\' oleh \'' . $data['approver'] . '\'.');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Penggajian $penggajian)
    // {
    //     //
    // }

    public function dataPenggajian(Request $request)
    {
        $dataPenggajian = (new Penggajian)->compactDataPenggajian($request);

        return response()->json($dataPenggajian);
    }

    /**
     * Fungsi untuk stream file PDF.
     * @return mixed
     */
    public function generatePDF(string $id)
    {
        $pdf = (new Penggajian)->pdfUtility($id);

        return $pdf->stream();
    }

    public function cetakPDF(string $id)
    {
        $pdf = (new Penggajian)->pdfUtility($id);

        return $pdf->download('penggajian-pegawai-' . $id . '.pdf');
    }
}
