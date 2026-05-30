<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Komentar;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarApiController extends Controller
{
    public function index($laporanId)
    {
        $komentar = Komentar::with('user')
            ->where('laporan_id', $laporanId)
            ->latest()
            ->get();

        return response()->json($komentar);
    }

    public function store(Request $request, $laporanId)
    {
        $request->validate([
            'isi' => 'required'
        ]);

        $laporan = Laporan::findOrFail($laporanId);

        $komentar = Komentar::create([
            'laporan_id' => $laporan->id,
            'user_id' => Auth::id(),
            'isi' => $request->isi
        ]);

        return response()->json([
            'message' => 'Komentar berhasil ditambahkan',
            'data' => $komentar
        ], 201);
    }
}