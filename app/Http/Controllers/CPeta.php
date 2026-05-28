<?php

namespace App\Http\Controllers;

use App\Models\Laporan;

class CPeta extends Controller
{
    public function index()
    {
        $laporan = Laporan::latest()->get();

        return view(
            'peta',
            compact('laporan')
        );
    }
}