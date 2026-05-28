<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CLaporan extends Controller
{
    public function index()
    {
        $laporan = Laporan::where(
            'user_id',
            Auth::id()
        )->latest()->get();

        return view(
            'userlaporan',
            compact('laporan')
        );
    }
    public function buat()
    {
        return view('buatlaporan');
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tinggi' => 'required',
            'lokasi' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'gambar' => 'nullable|image|max:2048'
        ]);

        $foto = null;

        if ($request->hasFile('gambar')) {

            $foto = $request->file('gambar')
                ->store('laporan', 'public');
        }

        Laporan::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tinggi_air' => $request->tinggi,
            'gambar' => $foto,
            'lokasi' => $request->lokasi,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'status' => 'menunggu'
        ]);

        return redirect('/buat-laporan')
            ->with('success', 'Laporan berhasil dikirim');
    }
    public function lihat($id)
    {
        $laporan = Laporan::with('komentar.user')->findOrFail($id);

        return view('laporandetail', compact('laporan'));
    }

}
