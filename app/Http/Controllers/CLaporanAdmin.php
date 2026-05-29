<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;


class CLaporanAdmin extends Controller
{
    // Semua laporan
    public function index()
    {
        $laporan = Laporan::with('user')
            ->latest()
            ->get();

        return view(
            'admin.daftarlaporan',
            compact('laporan')
        );
    }

    // Detail laporan
    public function lihat($id)
    {
        $laporan = Laporan::with([
            'user',
            'komentar' => function ($query) {
                $query->latest();
            },
            'komentar.user'
        ])->findOrFail($id);

        return view(
            'admin.lihatlaporan',
            compact('laporan')
        );
    }

    // Update status laporan
    public function updateStatus(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);

        $laporan->status = $request->status;

        $laporan->save();

        return back()->with(
            'success',
            'Status laporan berhasil diperbarui'
        );
    }
}
