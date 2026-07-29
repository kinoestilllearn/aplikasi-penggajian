<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\Posisi;
use Illuminate\Http\Request;

class PosisiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Master Data Jabatan / Posisi';
        $posisis = Posisi::with('departemen')->withCount('pegawai')->orderBy('nama', 'asc')->get();
        $departemens = Departemen::orderBy('nama', 'asc')->get();

        return view('posisi.index', compact('pageTitle', 'posisis', 'departemens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'          => ['required', 'string', 'max:255'],
            'departemen_id' => ['required', 'integer', 'exists:departemen,id'],
        ]);

        $posisi = Posisi::create($validated);

        return redirect()->route('posisi.index')
            ->with('status', 'Jabatan / Posisi \'' . $posisi->nama . '\' berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $posisi = Posisi::findOrFail($id);

        $validated = $request->validate([
            'nama'          => ['required', 'string', 'max:255'],
            'departemen_id' => ['required', 'integer', 'exists:departemen,id'],
        ]);

        $posisi->update($validated);

        return redirect()->route('posisi.index')
            ->with('status', 'Jabatan / Posisi \'' . $posisi->nama . '\' berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $posisi = Posisi::withCount('pegawai')->findOrFail($id);

        if (($posisi->pegawai_count ?? 0) > 0) {
            return redirect()->route('posisi.index')
                ->withErrors(['error' => 'Jabatan / Posisi \'' . $posisi->nama . '\' tidak dapat dihapus karena masih digunakan oleh ' . $posisi->pegawai_count . ' pegawai.']);
        }

        $nama = $posisi->nama;
        $posisi->delete();

        return redirect()->route('posisi.index')
            ->with('status', 'Jabatan / Posisi \'' . $nama . '\' berhasil dihapus.');
    }
}
