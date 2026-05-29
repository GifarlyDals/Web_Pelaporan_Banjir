@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    @if(session('success'))

    <div class="alert alert-success">

        {{ session('success') }}

    </div>

    @endif

    <div class="row">
        <div class="col lg-8">
            <div class="card shadow">

                <div class="card-header">

                    <h4>
                        Detail Laporan
                    </h4>

                </div>

                <div class="card-body">

                    <h5>
                        {{ $laporan->judul }}
                    </h5>

                    <p>
                        {{ $laporan->deskripsi }}
                    </p>

                    @if($laporan->gambar)

                    <div class="mb-4">

                        <img src="{{ asset('storage/' . $laporan->gambar) }}" class="img-fluid rounded shadow-sm" style="max-height: 400px;
                                                width: 100%;
                                                object-fit: cover;">

                    </div>

                    @endif


                    <hr>

                    <p>
                        <strong>User:</strong>
                        {{ $laporan->user->name }}
                    </p>

                    <p>
                        <strong>Lokasi:</strong>
                        {{ $laporan->lokasi }}
                    </p>

                    <p>
                        <strong>Tinggi Air:</strong>
                        {{ $laporan->tinggi_air }} cm
                    </p>

                    <p>
                        <strong>Status:</strong>
                        {{ $laporan->status }}
                    </p>

                    <hr>

                    <form method="POST" action="{{ route('admin.laporan.status', $laporan->id) }}">

                        @csrf
                        @method('PUT')

                        <div class="form-group">

                            <label>
                                Update Status
                            </label>

                            <select name="status" class="form-control">

                                <option value="menunggu">
                                    Menunggu
                                </option>

                                <option value="diverifikasi">
                                    Diverifikasi
                                </option>

                                <option value="ditolak">
                                    Ditolak
                                </option>

                                <option value="selesai">
                                    Selesai
                                </option>

                            </select>

                        </div>

                        <button class="btn btn-success">

                            Simpan Status

                        </button>

                    </form>

                </div>

            </div>
        </div>
    </div>
    <div class="col lg-4">
        <hr>

        <h5 class="mb-3">
            Komentar
        </h5>

        {{-- Form komentar admin --}}
        <form method="POST" action="{{ route('laporan.komentar', $laporan->id) }}" class="mb-4">

            @csrf

            <div class="form-group">

                <textarea name="pesan" class="form-control" rows="3" placeholder="Tulis komentar..."
                    required></textarea>

            </div>

            <button class="btn btn-primary">

                Kirim Komentar

            </button>

        </form>

        {{-- List komentar --}}
        @forelse($laporan->komentar as $item)

        <div class="card mb-3 border-left-primary">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <strong>

                        {{ $item->user->name }}

                    </strong>

                    <small class="text-muted">

                        {{ $item->created_at->diffForHumans() }}

                    </small>

                </div>

                <hr>

                <p class="mb-0">

                    {{ $item->pesan }}

                </p>

            </div>

        </div>

        @empty

        <div class="alert alert-light">

            Belum ada komentar

        </div>

        @endforelse
    </div>

</div>

@endsection