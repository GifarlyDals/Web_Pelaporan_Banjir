@extends('layouts.user')

@section('content')

<div class="container-fluid">

    <div class="row">

        <!-- MAP -->
        <div class="col-lg-8">

            <div class="card shadow">

                <div class="card-header">

                    <h4 class="mb-0">
                        Peta Interaktif Banjir
                    </h4>

                </div>

                <div class="card-body p-0">

                    <div id="map"
                         style="height: 700px;">
                    </div>

                </div>

            </div>

        </div>

        <!-- LOG -->
        <div class="col-lg-4">

            <div class="card shadow">

                <div class="card-header">

                    <h5 class="mb-0">
                        Aktivitas Laporan
                    </h5>

                </div>

                <div class="card-body"
                     style="height:700px;
                            overflow-y:auto;">

                    @forelse($laporan as $item)

                        <div class="mb-4 p-2 border rounded">

                            <div class="font-weight-bold">

                                {{ $item->judul }}

                            </div>

                            <div class="small text-muted">

                                {{ $item->created_at->diffForHumans() }}

                            </div>

                            <div class="mt-2">

                                {{ $item->lokasi }}

                            </div>

                            <div class="mt-2">

                                Tinggi Air:
                                {{ $item->tinggi_air }} cm

                            </div>

                            <div class="mt-2">

                                @if($item->status == 'menunggu')

                                    <span class="badge badge-warning">
                                        Menunggu
                                    </span>

                                @elseif($item->status == 'verifikasi')

                                    <span class="badge badge-primary">
                                        Diverifikasi
                                    </span>

                                @elseif($item->status == 'selesai')

                                    <span class="badge badge-success">
                                        Banjir Telah Surut
                                    </span>

                                @else

                                    <span class="badge badge-danger">
                                        Ditolak
                                    </span>

                                @endif

                            </div>

                            <a href="/laporan/{{ $item->id }}"
                               class="btn btn-sm btn-primary mt-3">

                                Detail

                            </a>

                        </div>

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

    const laporan = @json($laporan);

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

                <h6>${item.judul}</h6>

                <p>
                    ${item.lokasi}
                </p>

                <p>
                    Tinggi Air:
                    ${item.tinggi_air} cm
                </p>

                <p>
                    <strong>${statusSiaga}</strong>
                </p>

                <p>
                    Status:
                    ${item.status}
                </p>

                <a href="/laporan/${item.id}"
                   class="btn btn-sm btn-primary">

                    Detail

                </a>

            </div>
        `);

    });

</script>

@endsection