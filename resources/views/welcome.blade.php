<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('admin/img/icon.svg') }}">

    <title>LaporBanjir - Sistem Pelaporan Banjir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />


    <style>
        :root {
            --bs-body-font-family: 'Plus Jakarta Sans', sans-serif;
            --blue-deep: #0a2540;
            --blue-mid: #1a4f8a;
            --blue-brand: #1d6fc4;
            --blue-light: #3b9eff;
            --blue-pale: #e8f4ff;
            --accent: #f5a623;
            --danger-red: #e53935;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1a1a2e;
            overflow-x: hidden;
        }

        /* ── NAVBAR ── */
        .navbar {
            background: rgba(10, 37, 64, 0.97);
            backdrop-filter: blur(12px);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.3rem;
            color: #fff !important;
            letter-spacing: -0.3px;
        }

        .navbar-brand .brand-dot {
            color: var(--blue-light);
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.75) !important;
            font-weight: 500;
            font-size: 0.92rem;
            transition: color 0.2s;
        }

        .nav-link:hover {
            color: #fff !important;
        }

        .btn-nav-cta {
            background: var(--blue-brand);
            color: #fff !important;
            border-radius: 8px;
            padding: 0.45rem 1.2rem;
            font-weight: 600;
            font-size: 0.9rem;
            transition: background 0.2s, transform 0.15s;
        }

        .btn-nav-cta:hover {
            background: var(--blue-light);
            transform: translateY(-1px);
        }

        /* ── HERO ── */
        .hero-section {
            min-height: 100vh;
            background: linear-gradient(160deg, var(--blue-deep) 0%, #0d3566 55%, #124d96 100%);
            position: relative;
            display: flex;
            align-items: center;
            overflow: hidden;
            z-index: 1;

        }

        .hero-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%233b9eff' fill-opacity='0.04'%3E%3Cpath d='M50 50c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10c0 5.523-4.477 10-10 10s-10-4.477-10-10 4.477-10 10-10zM10 10c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10c0 5.523-4.477 10-10 10S0 25.523 0 20s4.477-10 10-10z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            z-index: 0;
            pointer-events: none;
        }

        .hero-section>.container-lg {
            position: relative;
            z-index: 2;
        }

        /* wave SVG bottom */
        .hero-wave {
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            line-height: 0;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(59, 158, 255, 0.18);
            border: 1px solid rgba(59, 158, 255, 0.35);
            color: var(--blue-light);
            font-size: 0.8rem;
            font-weight: 600;
            padding: 0.35rem 0.85rem;
            border-radius: 50px;
            margin-bottom: 1.5rem;
            letter-spacing: 0.4px;
        }

        .hero-title {
            font-size: clamp(2.2rem, 5vw, 3.6rem);
            font-weight: 800;
            color: #fff;
            line-height: 1.15;
            letter-spacing: -1px;
            margin-bottom: 1.25rem;
        }

        .hero-title .highlight {
            color: var(--blue-light);
        }

        .hero-desc {
            font-size: 1.05rem;
            color: rgba(255, 255, 255, 0.72);
            line-height: 1.75;
            max-width: 520px;
            margin-bottom: 2.2rem;
        }

        .btn-hero-primary {
            background: var(--blue-light);
            color: #fff;
            font-weight: 700;
            font-size: 1rem;
            padding: 0.8rem 2rem;
            border-radius: 10px;
            border: none;
            transition: all 0.2s;
            box-shadow: 0 6px 24px rgba(59, 158, 255, 0.4);
        }

        .btn-hero-primary:hover {
            background: #5aadff;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(59, 158, 255, 0.5);
        }

        .btn-hero-outline {
            border: 1.5px solid rgba(255, 255, 255, 0.4);
            color: #fff;
            font-weight: 600;
            font-size: 1rem;
            padding: 0.8rem 2rem;
            border-radius: 10px;
            background: transparent;
            transition: all 0.2s;
        }

        .btn-hero-outline:hover {
            border-color: #fff;
            background: rgba(255, 255, 255, 0.08);
            color: #fff;
        }

        /* Floating stats pill */
        .hero-stats {
            display: flex;
            gap: 1.5rem;
            margin-top: 2.5rem;
            flex-wrap: wrap;
        }

        .stat-item .stat-number {
            font-size: 1.6rem;
            font-weight: 800;
            color: #fff;
        }

        .stat-item .stat-label {
            font-size: 0.78rem;
            color: rgba(255, 255, 255, 0.55);
            font-weight: 500;
        }

        .stat-divider {
            width: 1px;
            background: rgba(255, 255, 255, 0.2);
        }

        /* Hero visual card */
        .hero-card {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 20px;
            padding: 1.75rem;
            backdrop-filter: blur(10px);
        }

        .hero-map-placeholder {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 14px;
            height: 200px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.85rem;
            margin-bottom: 1rem;
            position: relative;
            overflow: hidden;
        }

        .pulse-dot {
            width: 10px;
            height: 10px;
            background: #f44336;
            border-radius: 50%;
            box-shadow: 0 0 0 0 rgba(244, 67, 54, 0.6);
            animation: pulse 1.8s infinite;
            position: absolute;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(244, 67, 54, 0.6);
            }

            70% {
                box-shadow: 0 0 0 14px rgba(244, 67, 54, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(244, 67, 54, 0);
            }
        }

        .pulse-dot:nth-child(1) {
            top: 45%;
            left: 38%;
        }

        .pulse-dot:nth-child(2) {
            top: 30%;
            left: 60%;
            background: #ff9800;
            box-shadow: 0 0 0 0 rgba(255, 152, 0, 0.6);
            animation-delay: 0.6s;
        }

        .pulse-dot:nth-child(3) {
            top: 60%;
            left: 72%;
            background: #f44336;
            animation-delay: 1.2s;
        }

        .report-row {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.6rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.07);
        }

        .report-row:last-child {
            border-bottom: none;
        }

        .level-badge {
            font-size: 0.7rem;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 6px;
        }

        .level-tinggi {
            background: rgba(229, 57, 53, 0.25);
            color: #ff6b6b;
        }

        .level-sedang {
            background: rgba(255, 152, 0, 0.25);
            color: #ffa726;
        }

        .level-waspada {
            background: rgba(255, 235, 59, 0.2);
            color: #fff176;
        }

        /* ── ALERT BANNER ── */
        .alert-banner {
            background: #fff3e0;
            border-left: 4px solid var(--accent);
            border-radius: 10px;
            padding: 0.9rem 1.25rem;
        }

        /* ── SECTION GENERIC ── */
        section {
            padding: 90px 0;
        }

        .section-label {
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--blue-brand);
            margin-bottom: 0.6rem;
        }

        .section-title {
            font-size: clamp(1.8rem, 3vw, 2.5rem);
            font-weight: 800;
            color: var(--blue-deep);
            letter-spacing: -0.5px;
            line-height: 1.2;
        }

        .section-subtitle {
            font-size: 1rem;
            color: #5c6b82;
            line-height: 1.8;
            max-width: 560px;
        }

        /* ── FITUR CARDS ── */
        .feature-card {
            background: #fff;
            border: 1px solid #e8edf5;
            border-radius: 16px;
            padding: 2rem 1.75rem;
            height: 100%;
            transition: box-shadow 0.25s, transform 0.25s;
            position: relative;
            overflow: hidden;
        }

        .feature-card:hover {
            box-shadow: 0 16px 48px rgba(29, 111, 196, 0.12);
            transform: translateY(-4px);
        }

        .feature-icon-wrap {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1.2rem;
        }

        .icon-blue {
            background: #dbeafe;
            color: var(--blue-brand);
        }

        .icon-red {
            background: #fee2e2;
            color: #dc2626;
        }

        .icon-green {
            background: #dcfce7;
            color: #16a34a;
        }

        .icon-amber {
            background: #fef9c3;
            color: #ca8a04;
        }

        .icon-purple {
            background: #ede9fe;
            color: #7c3aed;
        }

        .icon-cyan {
            background: #cffafe;
            color: #0891b2;
        }

        .feature-card h5 {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--blue-deep);
            margin-bottom: 0.6rem;
        }

        .feature-card p {
            font-size: 0.9rem;
            color: #64748b;
            line-height: 1.7;
            margin: 0;
        }

        /* ── CARA KERJA ── */
        .steps-section {
            background: var(--blue-pale);
        }

        .step-card {
            background: #fff;
            border-radius: 16px;
            padding: 2rem 1.5rem;
            text-align: center;
            height: 100%;
            position: relative;
        }

        .step-number {
            width: 48px;
            height: 48px;
            background: var(--blue-brand);
            color: #fff;
            font-weight: 800;
            font-size: 1.1rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.2rem;
        }

        .step-card h5 {
            font-weight: 700;
            font-size: 1rem;
            color: var(--blue-deep);
            margin-bottom: 0.5rem;
        }

        .step-card p {
            font-size: 0.87rem;
            color: #64748b;
            margin: 0;
        }

        /* connector line */
        .step-connector {
            position: absolute;
            top: 48px;
            right: -15%;
            width: 30%;
            border-top: 2px dashed #b8d4f0;
        }

        /* ── LEVEL BANJIR ── */
        .level-section {
            background: #fff;
        }

        .level-card {
            border-radius: 14px;
            padding: 1.5rem;
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }

        .level-card.level-hijau {
            background: #f0fdf4;
            border: 1.5px solid #86efac;
        }

        .level-card.level-kuning {
            background: #fefce8;
            border: 1.5px solid #fde047;
        }

        .level-card.level-merah {
            background: #fff1f2;
            border: 1.5px solid #fca5a5;
        }

        .level-card.level-hitam {
            background: #0f172a;
            border: 1.5px solid #475569;
        }

        .level-icon {
            font-size: 2rem;
            flex-shrink: 0;
        }

        .level-card h6 {
            font-weight: 700;
            margin-bottom: 4px;
            font-size: 0.95rem;
        }

        .level-card p {
            font-size: 0.83rem;
            margin: 0;
            line-height: 1.6;
        }

        .level-hijau h6 {
            color: #15803d;
        }

        .level-kuning h6 {
            color: #a16207;
        }

        .level-merah h6 {
            color: #b91c1c;
        }

        .level-hitam h6 {
            color: #e2e8f0;
        }

        .level-hitam p {
            color: #94a3b8;
        }

        /* ── STATISTIK ── */
        .stats-section {
            background: linear-gradient(135deg, var(--blue-deep) 0%, var(--blue-mid) 100%);
        }

        .stat-card-dark {
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 16px;
            padding: 2rem 1.5rem;
            text-align: center;
        }

        .stat-card-dark .big-number {
            font-size: 2.6rem;
            font-weight: 800;
            color: #fff;
            line-height: 1;
        }

        .stat-card-dark .big-label {
            font-size: 0.88rem;
            color: rgba(255, 255, 255, 0.6);
            margin-top: 6px;
        }

        .stat-card-dark .bi {
            font-size: 2rem;
            color: var(--blue-light);
            margin-bottom: 1rem;
        }

        /* ── TESTIMONI ── */
        .testi-card {
            background: #fff;
            border: 1px solid #e8edf5;
            border-radius: 16px;
            padding: 1.75rem;
            height: 100%;
        }

        .testi-stars {
            color: #f59e0b;
            font-size: 0.9rem;
            margin-bottom: 0.75rem;
        }

        .testi-text {
            font-size: 0.9rem;
            color: #475569;
            line-height: 1.7;
            margin-bottom: 1.2rem;
        }

        .testi-author {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .testi-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.85rem;
            color: #fff;
            flex-shrink: 0;
        }

        .testi-name {
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--blue-deep);
        }

        .testi-role {
            font-size: 0.78rem;
            color: #94a3b8;
        }

        /* ── DOWNLOAD CTA ── */
        .cta-section {
            background: linear-gradient(135deg, #0a2540 0%, #1d6fc4 100%);
            text-align: center;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(59, 158, 255, 0.12) 0%, transparent 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
        }

        .cta-title {
            font-size: clamp(1.9rem, 4vw, 3rem);
            font-weight: 800;
            color: #fff;
            letter-spacing: -0.5px;
            margin-bottom: 1rem;
        }

        .cta-sub {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1rem;
            margin-bottom: 2.5rem;
            max-width: 480px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-store {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #fff;
            color: var(--blue-deep) !important;
            font-weight: 700;
            padding: 0.85rem 1.75rem;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.2s;
            font-size: 0.95rem;
        }

        .btn-store:hover {
            background: #e8f4ff;
            transform: translateY(-2px);
        }

        .btn-store .bi {
            font-size: 1.4rem;
        }

        .btn-store-outline {
            background: transparent;
            border: 1.5px solid rgba(255, 255, 255, 0.45);
            color: #fff !important;
        }

        .btn-store-outline:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: #fff;
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


        @media (max-width: 768px) {
            section {
                padding: 60px 0;
            }

            .step-connector {
                display: none;
            }

            .hero-stats {
                gap: 1rem;
            }
        }
    </style>
</head>

<body>

    <!-- ──────────────── NAVBAR ──────────────── -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-lg">
            <a class="navbar-brand" href="#">
                <i class="bi bi-water me-2"></i>Lapor<span class="brand-dot">Banjir</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <i class="bi bi-list text-white fs-4"></i>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav mx-auto gap-1">
                    <li class="nav-item"><a class="nav-link" href="#fitur">Fitur</a></li>
                    <li class="nav-item"><a class="nav-link" href="#cara-kerja">Cara Kerja</a></li>
                    <li class="nav-item"><a class="nav-link" href="#level-banjir">Level Banjir</a></li>
                </ul>
                <div class="d-flex gap-2 mt-3 mt-lg-0">
                    <a href="{{ route('login') }}" class="nav-link">Masuk</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- ──────────────── HERO ──────────────── -->
    <section class="hero-section" id="hero">
        <div class="container-lg pt-5">
            <div class="row align-items-center px-0">
                <div class="col-lg-6">
                    <h1 class="hero-title">
                        Laporkan Banjir,<br>
                        <span class="highlight">Selamatkan Nyawa</span><br>
                        Bersama
                    </h1>
                    <p class="hero-desc">
                        Platform pelaporan banjir real-time yang menghubungkan masyarakat, relawan, dan pemerintah
                        untuk respons bencana yang lebih cepat dan efektif.
                    </p>
                    <div class="d-flex gap-3 mt-4 mb-4 mb-lg-0">

                        <a href="/login" class="btn btn-primary px-4 py-2 fw-semibold">
                            <i class="bi bi-box-arrow-in-right me-1"></i>
                            Masuk
                        </a>

                        <a href="/register" class="btn btn-outline-light px-4 py-2 fw-semibold">
                            <i class="bi bi-person-plus me-1"></i>
                            Daftar
                        </a>

                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="hero-card">

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="text-white fw-semibold" style="font-size:0.9rem;">
                                <i class="bi bi-geo-alt-fill text-danger me-1"></i>Peta Pemantauan Live
                            </span>

                            <span class="badge" style="background:rgba(244,67,54,0.25);color:#ff6b6b;font-size:0.7rem;">
                                <i class="bi bi-circle-fill me-1" style="font-size:0.5rem;"></i>
                                LIVE
                            </span>
                        </div>

                        <!-- MAP -->
                        <div id="heroMap" class="hero-map-placeholder" style="height:220px; border-radius:14px;">
                        </div>

                        <!-- HEADER LOG -->
                        <div class="d-flex align-items-center justify-content-between mb-2 mt-3">
                            <span style="font-size:0.82rem;color:rgba(255,255,255,0.6);">
                                Laporan Terbaru
                            </span>
                        </div>

                        <!-- LOG -->
                        @forelse($laporan->take(3) as $item)

                        @php
                        $badge = 'level-waspada';

                        if($item->tinggi_air >= 150) $badge = 'level-tinggi';
                        elseif($item->tinggi_air >= 100) $badge = 'level-sedang';
                        elseif($item->tinggi_air >= 50) $badge = 'level-waspada';
                        @endphp

                        <div class="report-row">

                            <span class="level-badge {{ $badge }}">
                                {{ $item->tinggi_air >= 150 ? 'SIAGA 1' :
                                ($item->tinggi_air >= 100 ? 'SIAGA 2' :
                                ($item->tinggi_air >= 50 ? 'SIAGA 3' : 'SIAGA 4')) }}
                            </span>

                            <div style="flex:1">
                                <div style="font-size:0.85rem;color:#fff;font-weight:600;">
                                    {{ $item->lokasi }}
                                </div>

                                <div style="font-size:0.75rem;color:rgba(255,255,255,0.45);">
                                    {{ $item->created_at->diffForHumans() }}
                                    • ±{{ $item->tinggi_air }} cm
                                </div>
                            </div>

                            <a href="/laporan/{{ $item->id }}">
                                <i class="bi bi-chevron-right"
                                    style="color:rgba(255,255,255,0.3);font-size:0.8rem;"></i>
                            </a>

                        </div>

                        @empty
                        <div class="text-white-50 small">
                            Belum ada laporan masuk
                        </div>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
        <div class="hero-wave">
            <svg viewBox="0 0 1440 80" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <path d="M0,40 C360,80 1080,0 1440,40 L1440,80 L0,80 Z" fill="#f8fafc" />
            </svg>
        </div>
    </section>


    <!-- ──────────────── FITUR ──────────────── -->
    <section id="fitur" style="background:#f8fafc;">
        <div class="container-lg">
            <div class="text-center mb-5">
                <div class="section-label">Fitur Unggulan</div>
                <h2 class="section-title">Semua yang Anda Butuhkan,<br>dalam Satu Aplikasi</h2>
            </div>
            <div class="row g-4 justify-content-center align-items-center">
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon-wrap icon-red">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <h5>Laporan Lokasi Real-Time</h5>
                        <p>Kirim laporan banjir lengkap dengan foto, koordinat GPS, dan tinggi air hanya dalam hitungan
                            detik.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon-wrap icon-blue">
                            <i class="bi bi-map-fill"></i>
                        </div>
                        <h5>Peta Interaktif</h5>
                        <p>Visualisasi sebaran banjir secara real-time dengan lapisan peta yang dapat dikustomisasi
                            sesuai kebutuhan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ──────────────── CARA KERJA ──────────────── -->
    <section id="cara-kerja" class="steps-section">
        <div class="container-lg">
            <div class="text-center mb-5">
                <div class="section-label">Cara Kerja</div>
                <h2 class="section-title">Mudah Digunakan, Cepat Direspons</h2>
                <p class="section-subtitle mx-auto mt-3">Proses pelaporan banjir yang simpel dan terstruktur
                    agar bantuan bisa datang secepat mungkin.</p>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-sm-6 col-lg-3">
                    <div class="step-card">
                        <div class="step-number">1</div>
                        <i class="bi bi-phone-fill fs-2 text-primary mb-3 d-block"></i>
                        <h5>Daftar atau Login Ke Website</h5>
                        <p>Isi data daftar dan login sesuai dengan data diri anda</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="step-card">
                        <div class="step-number">2</div>
                        <i class="bi bi-camera-fill fs-2 text-danger mb-3 d-block"></i>
                        <h5>Foto & Laporkan</h5>
                        <p>Ambil foto, tentukan lokasi, pilih level banjir, dan kirim laporan.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="step-card">
                        <div class="step-number">3</div>
                        <i class="bi bi-broadcast fs-2 text-success mb-3 d-block"></i>
                        <h5>Verifikasi & Sebar</h5>
                        <p>Tim kami memverifikasi dan menyebarkan informasi ke semua pihak terkait.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="step-card">
                        <div class="step-number">4</div>
                        <i class="bi bi-shield-check-fill fs-2 text-warning mb-3 d-block"></i>
                        <h5>Respons & Evakuasi</h5>
                        <p>BPBD dan relawan bergerak berdasarkan data untuk evakuasi warga.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ──────────────── LEVEL BANJIR ──────────────── -->
    <section id="level-banjir" class="level-section">
        <div class="container-lg">
            <div class="row align-items-center g-5">
                <div class="col-lg-5">
                    <div class="section-label">Sistem Level</div>
                    <h2 class="section-title">Klasifikasi Tingkat Bahaya Banjir</h2>
                    <p class="section-subtitle mt-3">
                        Setiap laporan dikategorikan berdasarkan tingkat keparahan untuk
                        membantu prioritas respons yang lebih tepat sasaran.
                    </p>
                </div>
                <div class="col-lg-7">
                    <div class="d-flex flex-column gap-3">
                        <div class="level-card level-hijau">
                            <div class="level-icon">🟢</div>
                            <div>
                                <h6>Siaga 4 — Normal</h6>
                                <p class="text-success-emphasis">Tinggi air &lt;50 cm. Kondisi normal, tidak ada bahaya.
                                    Tetap pantau perkembangan cuaca.</p>
                            </div>
                        </div>
                        <div class="level-card level-kuning">
                            <div class="level-icon">🟡</div>
                            <div>
                                <h6>Siaga 3 — Waspada</h6>
                                <p class="text-warning-emphasis">Tinggi air 50–100 cm. Mulai bersiap dan waspadai
                                    kondisi sekitar rumah Anda.</p>
                            </div>
                        </div>
                        <div class="level-card level-merah">
                            <div class="level-icon">🔴</div>
                            <div>
                                <h6>Siaga 2 — Darurat</h6>
                                <p class="text-danger-emphasis">Tinggi air 100–150 cm. Evakuasi barang berharga dan
                                    bersiap pindah ke tempat aman.</p>
                            </div>
                        </div>
                        <div class="level-card level-hitam">
                            <div class="level-icon">⚫</div>
                            <div>
                                <h6>Siaga 1 — Bahaya</h6>
                                <p>Tinggi air &gt;150 cm. Segera evakuasi! Hubungi BPBD atau posko darurat terdekat.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <!-- ──────────────── FOOTER ──────────────── -->
    <footer>
        <div class="container-lg">

            <div class="row g-4 justify-content-between align-items-start text-center text-lg-start">

                <!-- Brand -->
                <div class="col-12 col-lg-5">
                    <div class="footer-brand">
                        <i class="bi bi-water me-2"></i>LaporBanjir
                    </div>

                    <p class="footer-desc mx-auto mx-lg-0">
                        Platform pelaporan banjir real-time untuk Indonesia
                        yang lebih siap dan tangguh menghadapi bencana.
                    </p>
                </div>

                <!-- Kontak Darurat -->
                <div class="col-12 col-lg-3">
                    <h6>Darurat</h6>

                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="#">
                                <i class="bi bi-telephone-fill me-1"></i>
                                112 (BNPB)
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="bi bi-telephone-fill me-1"></i>
                                119 ext 8 (SAR)
                            </a>
                        </li>
                    </ul>
                </div>

            </div>

            <hr class="footer-divider" />

            <div class="text-center">
                <p class="footer-bottom mb-0">
                    © 2025 LaporBanjir. Seluruh hak dilindungi undang-undang.
                </p>
            </div>

        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        const map = L.map('heroMap')
        .setView([-3.9985, 122.5120], 12);

    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            attribution: '&copy; OpenStreetMap'
        }
    ).addTo(map);

    const laporan = @json($laporan);

    laporan.forEach(function(item) {

        // Hilangkan marker jika laporan selesai / ditolak
        if (
            item.status == 'ditolak' ||
            item.status == 'selesai'
        ) {
            return;
        }

        let warna;
        let statusSiaga;

        const tinggi = parseInt(item.tinggi_air);

        // KATEGORI SIAGA
        if (tinggi >= 150) {

            warna = 'darkred';
            statusSiaga = 'Siaga 1 - Bahaya Mengancam Nyawa';

        } else if (tinggi >= 100) {

            warna = 'red';
            statusSiaga = 'Siaga 2 - Darurat';

        } else if (tinggi >= 50) {

            warna = 'orange';
            statusSiaga = 'Siaga 3 - Waspada';

        } else {

            warna = 'yellow';
            statusSiaga = 'Siaga 4 - Banjir Biasa';

        }

        const marker = L.circleMarker(
            [item.latitude, item.longitude],
            {
                radius: 10,
                color: warna,
                fillColor: warna,
                fillOpacity: 0.8
            }
        ).addTo(map);

        marker.bindPopup(`
            <div style="width:220px;">

                <h6>${item.judul}</h6>

                <p>
                    ${item.lokasi}
                </p>

                <p>
                    Tinggi Air:
                    ${item.tinggi_air} cm
                </p>

                <p>
                    <strong>${statusSiaga}</strong>
                </p>

                <p>
                    Status:
                    ${item.status}
                </p>

                <a href="/laporan/${item.id}"
                   class="btn btn-sm btn-primary">

                    Detail

                </a>

            </div>
        `);

    });

    </script>
    <script>
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-link');
        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(s => {
                if (window.scrollY >= s.offsetTop - 80) current = s.getAttribute('id');
            });
            navLinks.forEach(l => {
                l.classList.remove('active');
                if (l.getAttribute('href') === '#' + current) l.classList.add('active');
            });
        });
    </script>
</body>

</html>