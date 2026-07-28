<?php

namespace App\Http\Controllers;

use App\DataTables\PegawaiDataTable;
use App\Http\Requests\StorePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;
use App\Models\Departemen;
use App\Models\Pegawai;
use App\Models\Posisi;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:pegawai-list|pegawai-create|pegawai-edit|pegawai-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:pegawai-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:pegawai-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:pegawai-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(PegawaiDataTable $dataTable)
    {
        return $dataTable->render('pegawai.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePegawaiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $pageTitle = 'Ubah Pegawai';

        $pegawai = Pegawai::find($id);

        $data = [
            'pegawai'    => $pegawai,
            'departemen' => Departemen::all(),
            'posisi'     => Posisi::all(),
        ];

        return view('pegawai.edit', compact('pageTitle', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePegawaiRequest $request, String $id)
    {
        $pegawai     = Pegawai::find($id);
        $namaPegawai = $pegawai->nama;

        $validated = $request->validated();

        $pegawai->update($validated);

        return redirect()->route('pegawai.index')
            ->with('status', 'Data pegawai \'' . $namaPegawai . '\' berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        //
    }

    public function dataPegawai(Request $request)
    {
        $dataPegawai = (new Pegawai)->getAllPegawaiLengkap($request->id);

        return response()->json($dataPegawai);
    }
}
