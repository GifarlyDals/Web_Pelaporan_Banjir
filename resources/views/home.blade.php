@extends('layouts.user')

@section('content')

<div class="container-fluid">

    <!-- HEADING -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h1 class="h3 mb-0 text-gray-800">
            Dashboard
        </h1>

        <a href="{{ route('buatlaporan') }}"
           class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">

            <i class="fas fa-plus fa-sm text-white-50"></i>

            Buat Laporan

        </a>

    </div>

    <!-- STATISTIK -->
    <div class="row">

        <!-- Total -->
        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card border-left-primary shadow h-100 py-2">

                <div class="card-body">

                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Total Laporan Saya
                    </div>

                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        {{ $total }}
                    </div>

                </div>

            </div>

        </div>

        <!-- Menunggu -->
        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card border-left-warning shadow h-100 py-2">

                <div class="card-body">

                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Menunggu
                    </div>

                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        {{ $menunggu }}
                    </div>

                </div>

            </div>

        </div>

        <!-- Diverifikasi -->
        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card border-left-info shadow h-100 py-2">

                <div class="card-body">

                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        Diverifikasi
                    </div>

                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        {{ $diverifikasi }}
                    </div>

                </div>

            </div>

        </div>

        <!-- Selesai -->
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

    </div>

    <!-- ROW PETA + LAPORAN -->
    <div class="row">

        <!-- PETA -->
        <div class="col-xl-8 col-lg-7">

            <div class="card shadow mb-4">

                <div class="card-header py-3">

                    <h6 class="m-0 font-weight-bold text-primary">
                        Peta Sebaran Banjir Saat Ini
                    </h6>

                </div>

                <div class="card-body">

                    <div id="map"
                         style="height: 500px;
                                border-radius: 10px;">
                    </div>

                </div>

            </div>

        </div>

        <!-- LAPORAN TERBARU -->
        <div class="col-xl-4 col-lg-5">

            <div class="card shadow mb-4">

                <div class="card-header py-3">

                    <h6 class="m-0 font-weight-bold text-primary">
                        Laporan Terbaru Saya
                    </h6>

                </div>

                <div class="card-body">

                    @forelse($laporanTerbaru as $item)

                        <div class="mb-3">

                            <div class="font-weight-bold">

                                {{ $item->judul }}

                            </div>

                            <div class="small text-muted">

                                {{ $item->lokasi }}

                            </div>

                            <div class="mt-2">

                                @if($item->status == 'menunggu')

                                    <span class="badge badge-warning">
                                        Menunggu
                                    </span>

                                @elseif($item->status == 'diverifikasi')

                                    <span class="badge badge-info">
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

                            <a href="{{ route('laporan.detail', $item->id) }}"
                               class="btn btn-sm btn-primary mt-2">

                                Detail

                            </a>

                        </div>

                        <hr>

                    @empty

                        <p class="text-muted">
                            Belum ada laporan
                        </p>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

</div>

<!-- LEAFLET -->
<link rel="stylesheet"
href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

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

    const bounds = [];

    laporan.forEach(function(item) {

        if (
            item.status == 'ditolak' ||
            item.status == 'selesai'
        ) {
            return;
        }

        bounds.push([
            item.latitude,
            item.longitude
        ]);

        let warna;

        const tinggi = parseInt(item.tinggi_air);

        if (tinggi >= 150) {

            warna = 'darkred';

        } else if (tinggi >= 100) {

            warna = 'red';

        } else if (tinggi >= 50) {

            warna = 'orange';

        } else {

            warna = 'yellow';

        }

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
            <strong>${item.judul}</strong>
            <br>
            ${item.lokasi}
            <br>
            Tinggi Air:
            ${item.tinggi_air} cm
        `);

    });

    if (bounds.length > 0) {

        map.fitBounds(bounds);

    }

</script>

@endsection
