@extends('layouts.user')

@section('content')

<div class="container-fluid">

    <div class="card shadow">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h4 class="mb-0">
                Laporan Saya
            </h4>

            <a href="{{ route('buatlaporan') }}"
                class="btn btn-primary">

                Buat Laporan

            </a>

        </div>

        <div class="card-body">

            @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

            @endif

            <div class="table-responsive">

                <table class="table table-bordered">

                    <thead class="thead-light">

                        <tr>

                            <th>No</th>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Lokasi</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($laporan as $item)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $item->judul }}
                            </td>

                            <td>

                                @if($item->status == 'menunggu')

                                <span class="badge badge-warning">
                                    Tertunda
                                </span>

                                @elseif($item->status == 'diverifikasi')

                                <span class="badge badge-primary]">
                                    Diverifikasi
                                </span>

                                @elseif($item->status == 'selesai')

                                <span class="badge badge-success">
                                    Diverifikasi
                                </span>

                                @else

                                <span class="badge badge-danger">
                                    Ditolak
                                </span>

                                @endif

                            </td>

                            <td>
                                {{ $item->lokasi }}
                            </td>

                            <td>
                                {{ $item->created_at->format('d M Y H:i') }}
                            </td>

                            <td>

                                <a href="{{ route('laporan.detail', $item->id) }}"
                                    class="btn btn-info btn-sm">

                                    Detail

                                </a>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="6"
                                class="text-center">

                                Belum ada laporan

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection