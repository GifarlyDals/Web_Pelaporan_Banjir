@extends('layouts.app')

@section('content')

<div class="row justify-content-center">

    <div class="col-md-5">

        <div class="card shadow">

            <div class="card-header bg-success text-white">
                Register
            </div>

            <div class="card-body">

                <form method="POST" action="/register">

                    @csrf

                    <div class="mb-3">
                        <label>Nama</label>

                        <input type="text"
                               name="name"
                               class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Email</label>

                        <input type="email"
                               name="email"
                               class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Password</label>

                        <input type="password"
                               name="password"
                               class="form-control">
                    </div>

                    <button class="btn btn-success w-100">
                        Register
                    </button>

                </form>

                <!-- Link Login -->
                <div class="text-center mt-3">

                    <small>
                        Sudah punya akun?
                    </small>

                    <a href="{{ route('login') }}">
                        Login
                    </a>

                </div>

            </div>
        </div>
    </div>
</div>

@endsection