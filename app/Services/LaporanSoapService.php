<?php

namespace App\Services;

use App\Models\Laporan;

class LaporanSoapService
{
    public function getJumlahLaporan($params): array
    {
        $stats = Laporan::selectRaw('status, COUNT(*) as jumlah')
            ->groupBy('status')
            ->pluck('jumlah', 'status')
            ->toArray();

        return ['return' => [
            'menunggu_laporan'     => $stats['menunggu_laporan']     ?? 0,
            'laporan_diverifikasi' => $stats['laporan_diverifikasi'] ?? 0,
            'laporan_selesai'      => $stats['laporan_selesai']      ?? 0,
            'total'                => array_sum($stats),
        ]];
    }

    public function getSemuaLaporan($params): array
    {
        $data = Laporan::with('user:id,name,email')
            ->orderByDesc('created_at')
            ->get()
            ->map(fn($l) => $this->formatLaporan($l))
            ->toArray();

        return ['return' => ['item' => $data]];
    }

    public function getLaporanById($params): array
    {
        $id      = $params->id ?? 0;
        $laporan = Laporan::with('user:id,name,email')->find($id);

        if (!$laporan) {
            return ['return' => [
                'id' => 0, 'user_id' => 0, 'user_name' => '-',
                'user_email' => '-', 'judul' => 'Tidak ditemukan',
                'deskripsi' => '', 'tinggi_air' => 0, 'lokasi' => '',
                'latitude' => '', 'longitude' => '', 'gambar' => '',
                'status' => '', 'created_at' => '', 'updated_at' => '',
            ]];
        }

        return ['return' => $this->formatLaporan($laporan)];
    }

    public function getLaporanTerverifikasi($params): array
    {
        $data = Laporan::with('user:id,name,email')
            ->where('status', 'laporan_diverifikasi')
            ->orderByDesc('created_at')
            ->get()
            ->map(fn($l) => $this->formatLaporan($l))
            ->toArray();

        return ['return' => ['item' => $data]];
    }

    private function formatLaporan($laporan): array
    {
        return [
            'id'          => $laporan->id,
            'user_id'     => $laporan->user_id,
            'user_name'   => $laporan->user->name  ?? '-',
            'user_email'  => $laporan->user->email ?? '-',
            'judul'       => $laporan->judul,
            'deskripsi'   => $laporan->deskripsi,
            'tinggi_air'  => $laporan->tinggi_air,
            'lokasi'      => $laporan->lokasi,
            'latitude'    => (string) ($laporan->latitude  ?? ''),
            'longitude'   => (string) ($laporan->longitude ?? ''),
            'gambar'      => $laporan->gambar ?? '',
            'status'      => $laporan->status,
            'created_at'  => $laporan->created_at->toDateTimeString(),
            'updated_at'  => $laporan->updated_at->toDateTimeString(),
        ];
    }
}