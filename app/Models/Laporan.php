<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporan';

    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'tinggi_air',
        'gambar',
        'lokasi',
        'latitude',
        'longitude',
        'status'
    ];
}
