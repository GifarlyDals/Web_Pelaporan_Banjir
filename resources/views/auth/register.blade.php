<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LaporBanjir</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --blue-deep: #0a2540;
            --blue-light: #3b9eff;
        }

        body {
            min-height: 100vh;
            overflow-x: hidden;

            background: linear-gradient(135deg,
                    #0a2540 0%,
                    #124d96 100%);

            display: flex;
            flex-direction: column;
        }

        /* ───────── AUTH SECTION ───────── */
        .auth-wrapper {
            flex: 1;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 40px 15px;
        }

        .auth-card {
            width: 100%;
            max-width: 450px;

            padding: 35px;

            border-radius: 24px;

            background: rgba(255, 255, 255, 0.08);

            border: 1px solid rgba(255, 255, 255, 0.15);

            backdrop-filter: blur(12px);

            color: white;

            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
        }

        .brand {
            font-size: 2rem;
            font-weight: 800;
        }

        .brand span {
            color: var(--blue-light);
        }

        .form-control {
            height: 52px;

            border-radius: 12px;

            background: rgba(255, 255, 255, 0.08);

            border: 1px solid rgba(255, 255, 255, 0.15);

            color: white;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.12);

            border-color: var(--blue-light);

            box-shadow: none;

            color: white;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .btn-auth {
            height: 52px;

            border: none;

            border-radius: 12px;

            background: var(--blue-light);

            font-weight: 700;

            color: white;

            transition: 0.3s;
        }

        .btn-auth:hover {
            background: #5aadff;
            color: white;
        }

        .auth-link {
            color: var(--blue-light);

            text-decoration: none;

            font-weight: 600;
        }

        .auth-link:hover {
            color: #5aadff;
        }

        .alert {
            border-radius: 12px;
            border: none;
        }

        /* ── FOOTER ── */
        footer {
            background: var(--blue-deep);
            color: rgba(255, 255, 255, 0.65);
            padding: 60px 0 30px;
        }

        footer .footer-brand {
            font-size: 1.3rem;
            font-weight: 800;
            color: #fff;
        }

        footer .footer-desc {
            font-size: 0.87rem;
            line-height: 1.7;
            margin-top: 0.75rem;
            max-width: 280px;
        }

        footer h6 {
            color: #fff;
            font-weight: 700;
            margin-bottom: 1rem;
            font-size: 0.92rem;
        }

        footer ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        footer ul li {
            margin-bottom: 0.5rem;
        }

        footer ul li a {
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            font-size: 0.87rem;
            transition: color 0.2s;
        }

        footer ul li a:hover {
            color: #fff;
        }

        .footer-divider {
            border-color: rgba(255, 255, 255, 0.1);
            margin: 2rem 0 1.25rem;
        }

        .footer-bottom {
            font-size: 0.82rem;
            color: rgba(255, 255, 255, 0.4);
        }

        @media (max-width: 576px) {

            .auth-card {
                padding: 25px;
            }

            .brand {
                font-size: 1.7rem;
            }
        }

        .navbar {
            background: rgba(10, 37, 64, 0.97);
            backdrop-filter: blur(12px);
            padding: 1rem 0;
        }

        /* RIGHT SIDE */
        .auth-side {

            position: relative;

            background:
                linear-gradient(rgba(10, 37, 64, 0.78),
                    rgba(18, 77, 150, 0.82)),
                url('https://images.unsplash.com/photo-1527489377706-5bf97e608852?q=80&w=1400&auto=format&fit=crop');

            background-size: cover;

            background-position: center;

            overflow: hidden;
        }

        /* GLASS CARD */
        .auth-card {

            position: relative;

            z-index: 5;

            width: 100%;
            max-width: 430px;

            padding: 40px;

            border-radius: 24px;

            background: rgba(255, 255, 255, 0.08);

            border: 1px solid rgba(255, 255, 255, 0.12);

            backdrop-filter: blur(16px);

            box-shadow:
                0 20px 50px rgba(0, 0, 0, 0.35);
        }

        /* EFFECT */
        .floating-circle {

            position: absolute;

            border-radius: 50%;

            filter: blur(10px);
        }

        .circle-1 {

            width: 280px;
            height: 280px;

            background: rgba(59, 158, 255, 0.3);

            top: -80px;
            right: -80px;
        }

        .circle-2 {

            width: 220px;
            height: 220px;

            background: rgba(255, 255, 255, 0.08);

            bottom: -70px;
            left: -70px;
        }

        /* BUTTON BACK */
        .btn-back {

            position: absolute;

            top: 25px;
            left: 25px;

            z-index: 10;

            padding: 10px 18px;

            border-radius: 14px;

            background: rgba(255, 255, 255, 0.08);

            border: 1px solid rgba(255, 255, 255, 0.15);

            color: white;

            text-decoration: none;

            backdrop-filter: blur(12px);

            transition: 0.3s;
        }

        .btn-back:hover {

            background: rgba(255, 255, 255, 0.16);

            color: white;

            transform: translateY(-2px);
        }
    </style>
</head>

<body>

    <div class="container-fluid min-vh-100">

        <div class="row min-vh-100">

            <!-- LEFT SIDE -->
            <div class="col-lg-6 d-none d-lg-flex flex-column justify-content-center px-5"
                style="background: linear-gradient(135deg,#0a2540,#124d96);">
                <!-- BUTTON BACK -->
                <a href="{{ url('/') }}" class="btn-back">

                    <i class="bi bi-arrow-left"></i>

                    Kembali

                </a>
                <div class="text-white">

                    <h1 class="display-4 fw-bold mb-3">

                        <i class="bi bi-water"></i>

                        LaporBanjir

                    </h1>

                    <p class="lead opacity-75">

                        Bergabung dan bantu masyarakat
                        melaporkan kondisi banjir secara
                        real-time dan akurat.

                    </p>

                    <div class="mt-5">

                        <div class="d-flex align-items-center mb-3">

                            <i class="bi bi-shield-check fs-4 me-3"></i>

                            <div>
                                Data laporan tersimpan aman
                            </div>

                        </div>

                        <div class="d-flex align-items-center mb-3">

                            <i class="bi bi-map-fill fs-4 me-3"></i>

                            <div>
                                Pantau titik banjir secara langsung
                            </div>

                        </div>


                    </div>

                </div>

            </div>

            <!-- RIGHT SIDE -->
            <div class="col-lg-6 auth-side d-flex align-items-center justify-content-center position-relative">



                <!-- EFFECT -->
                <div class="floating-circle circle-1"></div>
                <div class="floating-circle circle-2"></div>

                <!-- CARD -->
                <div class="auth-card position-relative">

                    <div class="text-center mb-4">

                        <div class="brand mb-2">

                            <i class="bi bi-water"></i>

                            Lapor<span>Banjir</span>

                        </div>

                        <p class="text-light opacity-75">

                            Buat akun untuk mulai melaporkan banjir

                        </p>

                    </div>

                    @if(session('success'))

                    <div class="alert alert-success">

                        {{ session('success') }}

                    </div>

                    @endif

                    @if($errors->any())

                    <div class="alert alert-danger">

                        <ul class="mb-0 ps-3">

                            @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                    @endif

                    <form action="{{ route('register.process') }}" method="POST">

                        @csrf

                        <div class="mb-3">

                            <label class="form-label">
                                Nama Lengkap
                            </label>

                            <input type="text" name="name" class="form-control" placeholder="Masukkan nama"
                                value="{{ old('name') }}">

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Email
                            </label>

                            <input type="email" name="email" class="form-control" placeholder="Masukkan email"
                                value="{{ old('email') }}">

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Password
                            </label>

                            <input type="password" name="password" class="form-control" placeholder="Masukkan password">

                        </div>

                        <div class="mb-4">

                            <label class="form-label">
                                Konfirmasi Password
                            </label>

                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Ulangi password">

                        </div>

                        <button class="btn btn-auth w-100">

                            Register

                        </button>

                    </form>

                    <div class="text-center mt-4">

                        Sudah punya akun?

                        <a href="{{ route('login') }}" class="auth-link">

                            Login

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>