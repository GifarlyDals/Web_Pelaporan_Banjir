<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;

class CAdminDashboard extends Controller
{
    public function index()
    {
        $tertunda = Laporan::where('status', 'menunggu')->count();

        $proses = Laporan::where('status', 'diverifikasi')->count();

        $selesai = Laporan::where('status', 'selesai')->count();

        $total = Laporan::count();

        $laporanTerbaru = Laporan::latest()
            ->take(5)
            ->get();

        $mapLaporan = Laporan::whereNotIn('status', [
            'ditolak',
            'selesai'
        ])
            ->get();

        return view('admin.dashboard', compact(
            'tertunda',
            'proses',
            'selesai',
            'total',
            'laporanTerbaru',
            'mapLaporan'
        ));
    }
}
