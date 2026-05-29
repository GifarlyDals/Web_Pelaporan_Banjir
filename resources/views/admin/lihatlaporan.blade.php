@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    @if(session('success'))

    <div class="alert alert-success">

        {{ session('success') }}

    </div>

    @endif

    <div class="row">

        <!-- DETAIL LAPORAN -->
        <div class="col-lg-8">

            <div class="card shadow mb-4">

                <div class="card-header">

                    <h4 class="mb-0">

                        Detail Laporan

                    </h4>

                </div>

                <div class="card-body">

                    <h4 class="mb-3">

                        {{ $laporan->judul }}

                    </h4>

                    <p>
                        <strong>Status:</strong>

                        @if($laporan->status == 'menunggu')

                        <span class="badge badge-warning">
                            Menunggu
                        </span>

                        @elseif($laporan->status == 'diverifikasi')

                        <span class="badge badge-primary">
                            Diverifikasi
                        </span>

                        @elseif($laporan->status == 'selesai')

                        <span class="badge badge-success">
                            Selesai
                        </span>

                        @else

                        <span class="badge badge-danger">
                            Ditolak
                        </span>

                        @endif
                    </p>

                    @if($laporan->gambar)

                    <div class="mb-4">

                        <img src="{{ asset('storage/' . $laporan->gambar) }}" class="img-fluid rounded shadow-sm" style="max-height: 400px;
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
                        <strong>User:</strong>
                        {{ $laporan->user->name }}
                    </p>

                    <p>
                        <strong>Lokasi:</strong>
                        <br>
                        {{ $laporan->lokasi }}
                    </p>

                    <p>
                        <strong>Tinggi Air:</strong>
                        {{ $laporan->tinggi_air }} cm
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

                                <option value="menunggu" {{ $laporan->status == 'menunggu' ? 'selected' : '' }}>
                                    Menunggu
                                </option>

                                <option value="diverifikasi" {{ $laporan->status == 'diverifikasi' ? 'selected' : '' }}>
                                    Diverifikasi
                                </option>

                                <option value="ditolak" {{ $laporan->status == 'ditolak' ? 'selected' : '' }}>
                                    Ditolak
                                </option>

                                <option value="selesai" {{ $laporan->status == 'selesai' ? 'selected' : '' }}>
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

        <!-- KOMENTAR -->
        <div class="col-lg-4">

            <div class="card shadow">

                <div class="card-header">

                    <h5 class="mb-0">

                        Komentar

                    </h5>

                </div>

                <div class="card-body">

                    {{-- FORM KOMENTAR --}}
                    <form method="POST" action="{{ route('laporan.komentar', $laporan->id) }}">

                        @csrf

                        <div class="mb-3">

                            <textarea name="pesan" rows="3" class="form-control" placeholder="Tulis komentar..."
                                required></textarea>

                        </div>

                        <button class="btn btn-primary btn-sm">

                            Kirim

                        </button>

                    </form>

                    <hr>

                    {{-- LIST KOMENTAR --}}
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

@endsection