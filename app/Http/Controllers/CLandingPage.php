<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;

class CLandingPage extends Controller
{
    public function index()
    {
        $laporan = Laporan::latest()->take(5)->get();
        return view('welcome', compact('laporan'));
    }
}
