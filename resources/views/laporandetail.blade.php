@extends('layouts.user')

@section('content')

<div class="container-fluid">

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <div class="row">

        <!-- DETAIL -->
        <div class="col-lg-8">

            <div class="card shadow mb-4">

                <div class="card-header">

                    <h4 class="mb-0">

                        {{ $laporan->judul }}

                    </h4>

                </div>

                <div class="card-body">

                    <p>
                        <strong>Status:</strong>

                                @if($laporan->status == 'menunggu')

                                    <span class="badge badge-warning">
                                        Tertunda
                                    </span>

                                @elseif($laporan->status == 'diverifikasi')

                                    <span class="badge badge-primary">
                                        Diverifikasi
                                    </span>

                                @elseif($laporan->status == 'selesai')

                                    <span class="badge badge-success">
                                        Diverifikasi
                                    </span>

                                @else

                                    <span class="badge badge-danger">
                                        Ditolak
                                    </span>

                                        <div class="alert alert-danger mt-3">

                                            Laporan Anda ditolak. 
                                            Silakan periksa kembali data laporan dan kirim ulang dengan informasi yang lebih lengkap dan valid.

                                        </div>


                                @endif
                    </p>

                    @if($laporan->gambar)

                        <div class="mb-4">

                            <img src="{{ asset('storage/' . $laporan->gambar) }}"
                                class="img-fluid rounded shadow-sm"
                                style="max-height: 400px;
                                        width: 100%;
                                        object-fit: cover;">

                        </div>

                    @endif

                    <p>
                        <strong>Deskripsi:</strong>
                        <br>
                        {{ $laporan->deskripsi }}
                    </p>

                    <p>
                        <strong>Tinggi Air:</strong>
                        {{ $laporan->tinggi_air }} cm
                    </p>

                    <p>
                        <strong>Lokasi:</strong>
                        <br>
                        {{ $laporan->lokasi }}
                    </p>

                    <p>
                        <strong>Koordinat:</strong>
                        {{ $laporan->latitude }},
                        {{ $laporan->longitude }}
                    </p>

                    <div id="map"
                        style="height: 400px;
                               border-radius: 10px;">
                    </div>

                </div>

            </div>

        </div>

        <!-- KOMENTAR -->
        <div class="col-lg-4">

            <div class="card shadow">

                <div class="card-header">

                    <h5 class="mb-0">
                        Komentar
                    </h5>

                </div>

                <div class="card-body">

                    <form action="{{ route('laporan.komentar', $laporan->id) }}"
                          method="POST">

                        @csrf

                        <div class="mb-3">

                            <textarea
                                name="pesan"
                                rows="3"
                                class="form-control"
                                placeholder="Tulis komentar..."></textarea>

                        </div>

                        <button class="btn btn-primary btn-sm">

                            Kirim

                        </button>

                    </form>

                    <hr>

                    @forelse($laporan->komentar as $item)

                        <div class="mb-3">

                            <div class="font-weight-bold">

                                {{ $item->user->name }}

                            </div>

                            <div class="text-muted small mb-1">

                                {{ $item->created_at->diffForHumans() }}

                            </div>

                            <div>

                                {{ $item->pesan }}

                            </div>

                        </div>

                        <hr>

                    @empty

                        <p class="text-muted">

                            Belum ada komentar

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

    const lat = {{ $laporan->latitude }};
    const lng = {{ $laporan->longitude }};

    const map = L.map('map')
        .setView([lat, lng], 15);

    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            attribution: '&copy; OpenStreetMap'
        }
    ).addTo(map);

    L.marker([lat, lng])
        .addTo(map)
        .bindPopup("Lokasi Banjir")
        .openPopup();

</script>

@endsection