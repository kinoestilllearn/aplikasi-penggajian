<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePresensiRequest;
use App\Http\Requests\UpdatePresensiRequest;
use App\Models\Presensi;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presensi = Presensi::paginate(10);

        $data = [
            'success' => true,
            'message' => 'Daftar data presensi',
            'data'    => $presensi,
        ];

        return response()->json($data, 200);
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
    public function store(StorePresensiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {
        $pegawaiId = $id;
        $periode   = $request->periode;

        $presensi = (new Presensi)->periode($pegawaiId, $periode);

        if ($presensi->isEmpty()) {
            $data = [
                'success' => false,
                'message' => 'Data presensi tidak ditemukan',
                'data'    => $presensi,
            ];

            return response()->json($data, 404);
        }

        $data = [
            'success' => true,
            'message' => 'Daftar data presensi pegawai',
            'periode' => $periode,
            'data'    => $presensi,
        ];

        return response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Presensi $presensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePresensiRequest $request, Presensi $presensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Presensi $presensi)
    {
        //
    }

    public function getPresensiPegawai(string $id, Request $request)
    {
        $pegawaiId = $id;
        $periode   = $request->periode;

        $presensi = (new Presensi)->presensiPegawai($id, $periode);

        if (count($presensi) == 0) {
            $data = [
                'success' => false,
                'message' => 'Data presensi tidak ditemukan',
                'data'    => $presensi,
            ];

            return response()->json($data, 404);
        }

        $data = [
            'success' => true,
            'message' => 'Daftar data presensi pegawai',
            'periode' => $periode,
            'data'    => $presensi,
        ];

        return response()->json($data, 200);
    }
}
