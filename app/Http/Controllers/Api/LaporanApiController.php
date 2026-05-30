<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanApiController extends Controller
{
    public function index()
    {
        return response()->json(
            Laporan::latest()->get()
        );
    }

    public function show($id)
    {
        $laporan = Laporan::findOrFail($id);

        return response()->json($laporan);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tinggi_air' => 'required',
            'lokasi' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $laporan = Laporan::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tinggi_air' => $request->tinggi_air,
            'lokasi' => $request->lokasi,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'status' => 'menunggu'
        ]);

        return response()->json([
            'message' => 'Laporan berhasil dibuat',
            'data' => $laporan
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);

        $laporan->update($request->all());

        return response()->json([
            'message' => 'Laporan berhasil diperbarui',
            'data' => $laporan
        ]);
    }

    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);

        $laporan->delete();

        return response()->json([
            'message' => 'Laporan berhasil dihapus'
        ]);
    }
}