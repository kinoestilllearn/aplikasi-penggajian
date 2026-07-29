<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use Illuminate\Http\Request;

class DepartemenController extends Controller
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
        $pageTitle = 'Master Data Departemen';
        $departemens = Departemen::withCount(['posisi', 'pegawai'])->orderBy('nama', 'asc')->get();

        return view('departemen.index', compact('pageTitle', 'departemens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255', 'unique:departemen,nama'],
        ]);

        $departemen = Departemen::create($validated);

        return redirect()->route('departemen.index')
            ->with('status', 'Departemen \'' . $departemen->nama . '\' berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $departemen = Departemen::findOrFail($id);

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255', 'unique:departemen,nama,' . $id],
        ]);

        $departemen->update($validated);

        return redirect()->route('departemen.index')
            ->with('status', 'Departemen \'' . $departemen->nama . '\' berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $departemen = Departemen::withCount('pegawai')->findOrFail($id);

        if (($departemen->pegawai_count ?? 0) > 0) {
            return redirect()->route('departemen.index')
                ->withErrors(['error' => 'Departemen \'' . $departemen->nama . '\' tidak dapat dihapus karena masih digunakan oleh ' . $departemen->pegawai_count . ' pegawai.']);
        }

        $nama = $departemen->nama;
        $departemen->delete();

        return redirect()->route('departemen.index')
            ->with('status', 'Departemen \'' . $nama . '\' berhasil dihapus.');
    }
}
