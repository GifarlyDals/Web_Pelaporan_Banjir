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

    <div class="d-flex
                justify-content-between
                align-items-center
                mb-4">

        <h1 class="h3 text-gray-800">
            Data User
        </h1>

        <button class="btn btn-primary" data-toggle="modal" data-target="#createModal">

            <i class="fas fa-plus"></i>

            Tambah User

        </button>

    </div>

    @if(session('success'))

    <div class="alert alert-success">

        {{ session('success') }}

    </div>

    @endif

    <div class="card shadow">

        <div class="card-body">

            <div class="table-responsive">
                <div class="row align-items-center mb-4 g-3">

                    <div class="col-md-3">


                        <select id="roleFilter" class="form-control">

                            <option value="">
                                Semua Role
                            </option>

                            <option value="admin">
                                Admin
                            </option>

                            <option value="user">
                                User
                            </option>

                        </select>

                    </div>

                </div>

                <table class="table table-bordered table-hover align-middle" id="userTable">

                    <thead>

                        <tr>

                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($users as $item)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $item->name }}
                            </td>

                            <td>
                                {{ $item->email }}
                            </td>



                            <td>
                                @if($item->role == 'admin')
                                <span class="badge badge-danger role-text">Admin</span>
                                @else
                                <span class="badge badge-primary role-text">User</span>
                                @endif
                            </td>


                            <td>

                                <button class="btn btn-warning btn-sm" data-toggle="modal"
                                    data-target="#editModal{{ $item->id }}">

                                    Edit

                                </button>

                                <form action="{{ route('admin.user.hapus', $item->id) }}" method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus user?')">

                                        Hapus

                                    </button>

                                </form>

                            </td>

                        </tr>
                        <!-- Modal Update -->
                        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-hidden="true">

                            <div class="modal-dialog modal-lg">

                                <div class="modal-content">

                                    <form action="{{ route('admin.user.update', $item->id) }}" method="POST">

                                        @csrf
                                        @method('PUT')

                                        <div class="modal-header">

                                            <h5 class="modal-title">

                                                Edit User

                                            </h5>

                                            <button type="button" class="btn-close" data-dismiss="modal">
                                                <span>&times;</span>
                                            </button>

                                        </div>

                                        <div class="modal-body">

                                            <div class="row">

                                                <!-- Nama -->
                                                <div class="col-md-6 mb-3">

                                                    <label class="form-label">
                                                        Nama
                                                    </label>

                                                    <input type="text" name="name" class="form-control"
                                                        value="{{ $item->name }}" required>

                                                </div>

                                                <!-- Email -->
                                                <div class="col-md-6 mb-3">

                                                    <label class="form-label">
                                                        Email
                                                    </label>

                                                    <input type="email" name="email" class="form-control"
                                                        value="{{ $item->email }}" required>

                                                </div>

                                                <!-- Password -->
                                                <div class="col-md-6 mb-3">

                                                    <label class="form-label">
                                                        Password Baru
                                                    </label>

                                                    <input type="password" name="password" class="form-control"
                                                        placeholder="Kosongkan jika tidak diubah">

                                                </div>

                                                <!-- Role -->
                                                <div class="col-md-6 mb-3">

                                                    <label class="form-label">
                                                        Role
                                                    </label>

                                                    <select name="role" class="form-control">

                                                        <option value="admin" {{ $item->role == 'admin' ? 'selected' :
                                                            '' }}>

                                                            Admin

                                                        </option>

                                                        <option value="user" {{ $item->role == 'user' ? 'selected' : ''
                                                            }}>

                                                            User

                                                        </option>

                                                    </select>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">

                                                Batal

                                            </button>

                                            <button type="submit" class="btn btn-primary">

                                                Update

                                            </button>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>


                        @endforeach

                    </tbody>

                </table>
                <!-- Modal Buat -->
                <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">

                    <div class="modal-dialog modal-lg">

                        <div class="modal-content">

                            <form action="{{ route('admin.user.simpan') }}" method="POST">

                                @csrf

                                <div class="modal-header">

                                    <h5 class="modal-title">

                                        Tambah User

                                    </h5>

                                    <button type="button" class="btn-close" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>

                                </div>

                                <div class="modal-body">

                                    <div class="row">

                                        <!-- Nama -->
                                        <div class="col-md-6 mb-3">

                                            <label class="form-label">
                                                Nama
                                            </label>

                                            <input type="text" name="name" class="form-control" required>

                                        </div>

                                        <!-- Email -->
                                        <div class="col-md-6 mb-3">

                                            <label class="form-label">
                                                Email
                                            </label>

                                            <input type="email" name="email" class="form-control" required>

                                        </div>

                                        <!-- Password -->
                                        <div class="col-md-6 mb-3">

                                            <label class="form-label">
                                                Password
                                            </label>

                                            <input type="password" name="password" class="form-control" required>

                                        </div>

                                        <!-- Role -->
                                        <div class="col-md-6 mb-3">

                                            <label class="form-label">
                                                Role
                                            </label>

                                            <select name="role" class="form-control" required>

                                                <option value="admin">

                                                    Admin

                                                </option>

                                                <option value="user">

                                                    User

                                                </option>

                                            </select>

                                        </div>

                                    </div>

                                </div>

                                <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                                        Batal

                                    </button>

                                    <button type="submit" class="btn btn-primary">

                                        Simpan

                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>






@endsection