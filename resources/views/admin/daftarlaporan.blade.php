@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="card shadow">

        <div class="card-header">

            <h4 class="mb-0">
                Semua Laporan User
            </h4>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered">

                    <thead>

                        <tr>
                            <th>No</th>
                            <th>User</th>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach($laporan as $item)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $item->user->name }}
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
                                {{ $item->created_at->format('d M Y') }}
                            </td>

                            <td>

                                <a href="{{ route('admin.laporan.lihat', $item->id) }}" class="btn btn-primary btn-sm">

                                    Lihat

                                </a>

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection