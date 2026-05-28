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
    </style>
</head>

<body>

    <!-- ───────── LOGIN ───────── -->
    <div class="auth-wrapper">

        <div class="auth-card">

            <div class="text-center mb-4">

                <div class="brand mb-2">
                    <i class="bi bi-water"></i>
                    Lapor<span>Banjir</span>
                </div>

                <p class="text-light opacity-75 mb-0">
                    Login ke akun Anda
                </p>

            </div>

            {{-- ERROR LOGIN --}}
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            {{-- VALIDATION --}}
            @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('login.process') }}" method="POST">

                @csrf

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Email
                    </label>

                    <input type="email"
                        name="email"
                        class="form-control"
                        placeholder="Masukkan email"
                        value="{{ old('email') }}">

                </div>

                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Password
                    </label>

                    <input type="password"
                        name="password"
                        class="form-control"
                        placeholder="Masukkan password">

                </div>

                <button type="submit" class="btn btn-auth w-100">
                    Login
                </button>

            </form>

            <div class="text-center mt-4">

                Belum punya akun?

                <a href="{{ route('register') }}" class="auth-link">
                    Register
                </a>

            </div>

        </div>

    </div>

    <!-- ───────── FOOTER ───────── -->
    <footer class="footer-custom py-4">

        <div class="container text-center">


            <p class="footer-bottom mb-0">
                © 2025 LaporBanjir.
                Seluruh hak dilindungi undang-undang.
            </p>

        </div>

    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>