@extends('layouts.admin')

@section('content')
<style>
    /* HEADER TABLE */
    .table th {
        background: #f8f9fc;
        font-weight: 700;
        color: #4e73df;
        vertical-align: middle;
    }

    /* SEARCH BOX */
    .dataTables_filter {
        margin-bottom: 15px;
    }

    .dataTables_filter label {
        font-weight: 600;
        color: #4e73df;
    }

    .dataTables_filter input {
        border-radius: 10px !important;
        border: 1px solid #d1d3e2 !important;
        padding: 8px 12px !important;
        margin-left: 10px !important;
        box-shadow: none !important;
    }

    .dataTables_filter input:focus {
        border-color: #4e73df !important;
        box-shadow: 0 0 0 0.15rem rgba(78, 115, 223, .25) !important;
    }

    /* SHOW DATA SELECT */
    .dataTables_length {
        margin-bottom: 15px;
    }

    .dataTables_length label {
        font-weight: 600;
        color: #4e73df;
    }

    .dataTables_length select {
        border-radius: 10px !important;
        border: 1px solid #d1d3e2 !important;
        padding: 6px 30px 6px 10px !important;
        margin: 0 8px !important;
    }

    /* INFO TEXT */
    .dataTables_info {
        font-weight: 500;
        color: #858796;
        margin-top: 10px;
    }

    /* PAGINATION */
    .dataTables_paginate {
        margin-top: 10px !important;
    }

    .dataTables_paginate .paginate_button {
        padding: 0 !important;
        border: none !important;
        background: transparent !important;
    }

    .dataTables_paginate .page-link {
        border-radius: 8px !important;
        margin: 0 3px;
        color: #4e73df !important;
        border: 1px solid #d1d3e2;
    }

    .dataTables_paginate .active .page-link {
        background-color: #4e73df !important;
        border-color: #4e73df !important;
        color: white !important;
    }



    /* CARD */
    .card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
    }

    .card-body {
        padding: 25px;
    }
</style>
<div class="container-fluid">

    <div class="card shadow">

        <div class="card-header">

            <h4 class="mb-0">
                Semua Laporan User
            </h4>

        </div>

        <div class="card-body">

            <div class="table-responsive">
                <div class="row mb-3">

                    <div class="col-md-3">
                        <select id="statusFilter" class="form-control">
                            <option value="">Semua Status</option>
                            <option value="Tertunda">Tertunda</option>
                            <option value="Diverifikasi">Diverifikasi</option>
                            <option value="Selesai">Selesai</option>
                            <option value="Ditolak">Ditolak</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select id="airFilter" class="form-control">
                            <option value="">Semua Tinggi Air</option>
                            <option value="Rendah">Siaga 4</option>
                            <option value="Sedang">Siaga 3</option>
                            <option value="Tinggi">Siaga 2</option>
                            <option value="Bahaya">Siaga 1</option>
                        </select>
                    </div>

                </div>

                <table class="table table-bordered" id="laporanTable">

                    <thead>

                        <tr>
                            <th>No</th>
                            <th>User</th>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Tinggi Air</th>
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
                                <span class="badge badge-warning status-text">Tertunda</span>

                                @elseif($item->status == 'diverifikasi')
                                <span class="badge badge-primary status-text">Diverifikasi</span>

                                @elseif($item->status == 'selesai')
                                <span class="badge badge-success status-text">Selesai</span>

                                @else
                                <span class="badge badge-danger status-text">Ditolak</span>
                                @endif
                            </td>
                            <td>
                                @php
                                $tinggi = $item->tinggi_air;

                                if ($tinggi < 50) { $kategori='Siaga 4 : Rendah' ; $badge='success' ; } elseif ($tinggi
                                    < 150) { $kategori='Siaga 3 : Sedang' ; $badge='info' ; } elseif ($tinggi < 300) {
                                    $kategori='Siaga 2 : Tinggi' ; $badge='warning' ; } else {
                                    $kategori='Siaga 1 : Bahaya !!!' ; $badge='danger' ; } @endphp <span
                                    class="badge badge-{{ $badge }} water-level">
                                    {{ $kategori }}
                                    </span>
                                    {{ $item->tinggi_air }} CM
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