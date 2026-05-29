<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = Auth::id();

        $total = Laporan::where('user_id', $userId)->count();

        $menunggu = Laporan::where('user_id', $userId)
            ->where('status', 'menunggu')
            ->count();

        $diverifikasi = Laporan::where('user_id', $userId)
            ->where('status', 'diverifikasi')
            ->count();

        $selesai = Laporan::where('user_id', $userId)
            ->where('status', 'selesai')
            ->count();

        $laporanTerbaru = Laporan::where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        $mapLaporan = Laporan::latest()->get();

        return view('home', compact(
            'total',
            'menunggu',
            'diverifikasi',
            'selesai',
            'laporanTerbaru',
            'mapLaporan'
        ));
    }
}
