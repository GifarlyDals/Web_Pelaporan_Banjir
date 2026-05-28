@extends('layouts.user')

@section('content')

<div class="container-fluid">
    <div class="card shadow">

        <div class="card-header">
            <h4>Buat Laporan Banjir</h4>
        </div>

        <div class="card-body">
            @if($errors->any()) <div class="alert alert-danger">
                <ul class="mb-0"> @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul>
            </div> @endif
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">

                {{ session('success') }}

                <button type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>
            @endif

            <form action="{{ route('simpanlaporan') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <div class="mb-3">
                    <label>Judul</label>

                    <input type="text"
                        name="judul"
                        class="form-control">
                </div>

                <div class="mb-3">
                    <label>Deskripsi</label>

                    <textarea name="deskripsi"
                        rows="4"
                        class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label>Ketinggian Air</label>

                    <input type="number"
                        name="tinggi"
                        class="form-control">
                </div>



                <div class="mb-3">
                    <label>Foto</label>

                    <input type="file"
                        name="gambar"
                        class="form-control">
                </div>


                <div class="mb-3">
                    <label>Pilih Lokasi Banjir</label>

                    <div id="map"
                        style="height: 400px;
                                border-radius: 10px;"></div>
                </div>

                <div class="mb-3">

                    <label>Lokasi Lengkap</label>

                    <input type="text"
                        id="lokasi"
                        name="lokasi"
                        class="form-control"
                        readonly>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <label>Latitude</label>

                        <input type="text"
                            id="latitude"
                            name="latitude"
                            class="form-control"
                            readonly>

                    </div>

                    <div class="col-md-6">

                        <label>Longitude</label>

                        <input type="text"
                            id="longitude"
                            name="longitude"
                            class="form-control"
                            readonly>

                    </div>

                </div>

                <button class="btn btn-primary mt-4">
                    Kirim Laporan
                </button>

            </form>

        </div>

    </div>
</div>

<!-- Leaflet -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>

<script>
    const map = L.map('map').setView([-2.5489, 118.0149], 5);

    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap'
        }
    ).addTo(map);

    let marker;

    async function getAddress(lat, lng) {

        try {

            const response = await fetch(
                `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`
            );

            const data = await response.json();

            if (data.display_name) {

                document.getElementById('lokasi').value =
                    data.display_name;

            }

        } catch (error) {

            console.log("Gagal mengambil alamat");

        }
    }

    if (navigator.geolocation) {

        navigator.geolocation.getCurrentPosition(

            async function(position) {

                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;

                    map.setView([lat, lng], 15);

                    document.getElementById('latitude').value = lat;
                    document.getElementById('longitude').value = lng;

                    marker = L.marker([lat, lng])
                        .addTo(map)
                        .bindPopup("Lokasi Anda")
                        .openPopup();

                    // Ambil alamat otomatis
                    await getAddress(lat, lng);

                },

                function(error) {

                    console.log("Lokasi gagal diambil");

                }

        );

    }

    map.on('click', async function(e) {

        const lat = e.latlng.lat;
        const lng = e.latlng.lng;

        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;

        if (marker) {
            map.removeLayer(marker);
        }

        marker = L.marker([lat, lng])
            .addTo(map)
            .bindPopup("Lokasi Banjir")
            .openPopup();

        // Ambil alamat dari koordinat
        await getAddress(lat, lng);

    });
</script>
@endsection