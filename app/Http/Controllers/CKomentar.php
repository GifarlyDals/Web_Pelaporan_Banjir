<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CKomentar extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'pesan' => 'required'
        ], [
            'pesan.required' =>
            'Pesan wajib diisi'
        ]);

        Komentar::create([

            'laporan_id' => $id,

            'user_id' => Auth::id(),

            'pesan' => $request->pesan

        ]);

        return back()->with(
            'success',
            'Komentar berhasil dikirim'
        );
    }
}