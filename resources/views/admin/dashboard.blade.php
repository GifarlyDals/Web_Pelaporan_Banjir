@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">
        Dashboard Admin
    </h1>

    <!-- STATISTIK -->
    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card border-left-warning shadow h-100 py-2">

                <div class="card-body">

                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Laporan Tertunda
                    </div>

                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        {{ $tertunda }}
                    </div>

                </div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card border-left-primary shadow h-100 py-2">

                <div class="card-body">

                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Dalam Proses
                    </div>

                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        {{ $proses }}
                    </div>

                </div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card border-left-success shadow h-100 py-2">

                <div class="card-body">

                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Selesai
                    </div>

                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        {{ $selesai }}
                    </div>

                </div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card border-left-dark shadow h-100 py-2">

                <div class="card-body">

                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                        Total Laporan
                    </div>

                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        {{ $total }}
                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <!-- PETA -->
        <div class="col-lg-8">

            <div class="card shadow mb-4">

                <div class="card-header">

                    <h6 class="m-0 font-weight-bold text-primary">
                        Peta Lokasi Banjir
                    </h6>

                </div>

                <div class="card-body">

                    <div id="map" style="height: 500px;
                               border-radius: 10px;">
                    </div>

                </div>

            </div>

        </div>

        <!-- LAPORAN TERBARU -->
        <div class="col-lg-4">

            <div class="card shadow mb-4">

                <div class="card-header">

                    <h6 class="m-0 font-weight-bold text-primary">
                        Laporan Terbaru
                    </h6>

                </div>

                <div class="card-body">

                    @forelse($laporanTerbaru as $item)

                    <div class="mb-3">

                        <strong>
                            {{ $item->judul }}
                        </strong>

                        <br>

                        <small class="text-muted">

                            {{ $item->lokasi }}

                        </small>

                        <br>

                        @if($item->status == 'menunggu')

                        <span class="badge badge-warning">
                            Menunggu
                        </span>

                        @elseif($item->status == 'diverifikasi')

                        <span class="badge badge-primary">
                            Diverifikasi
                        </span>

                        @elseif($item->status == 'selesai')

                        <span class="badge badge-success">
                            Selesai
                        </span>

                        @else

                        <span class="badge badge-danger">
                            Ditolak
                        </span>

                        @endif

                    </div>

                    <hr>

                    @empty

                    <p>
                        Belum ada laporan
                    </p>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

</div>

<!-- LEAFLET -->

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    const map = L.map('map')
        .setView([-3.9985, 122.5120], 12);

    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            attribution: '&copy; OpenStreetMap'
        }
    ).addTo(map);

    const laporan = @json($mapLaporan);

    // Untuk auto zoom marker
    const bounds = [];

    laporan.forEach(function(item) {

        // Hilangkan marker jika laporan selesai / ditolak
        if (
            item.status == 'ditolak' ||
            item.status == 'selesai'
        ) {
            return;
        }

        let warna;
        let statusSiaga;

        const tinggi = parseInt(item.tinggi_air);

        // KATEGORI SIAGA
        if (tinggi >= 150) {

            warna = 'darkred';
            statusSiaga = 'Siaga 1 - Bahaya Mengancam Nyawa';

        } else if (tinggi >= 100) {

            warna = 'red';
            statusSiaga = 'Siaga 2 - Darurat';

        } else if (tinggi >= 50) {

            warna = 'orange';
            statusSiaga = 'Siaga 3 - Waspada';

        } else {

            warna = 'yellow';
            statusSiaga = 'Siaga 4 - Banjir Biasa';

        }

        // Simpan koordinat marker
        bounds.push([
            item.latitude,
            item.longitude
        ]);

        const marker = L.circleMarker(
            [item.latitude, item.longitude],
            {
                radius: 10,
                color: warna,
                fillColor: warna,
                fillOpacity: 0.8
            }
        ).addTo(map);

        marker.bindPopup(`
            <div style="width:220px;">

                <h6 class="mb-2">
                    ${item.judul}
                </h6>

                <p class="mb-1">
                    📍 ${item.lokasi}
                </p>

                <p class="mb-1">
                    🌊 Tinggi Air:
                    ${item.tinggi_air} cm
                </p>

                <p class="mb-2">
                    <strong>${statusSiaga}</strong>
                </p>

                <p class="mb-2">
                    Status:
                    ${item.status}
                </p>

                <a href="{{ route('admin.laporan.lihat', $item->id) }}"
                   class="btn btn-sm btn-primary">

                    Detail

                </a>

            </div>
        `);

    });

    // Auto zoom ke semua marker
    if (bounds.length > 0) {

        map.fitBounds(bounds);

    }

</script>

@endsection