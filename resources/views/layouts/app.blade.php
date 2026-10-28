<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') | Sistem Kontraktor</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
          rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 250px;
            --primary-color: #1e3a5f;
            --page-bg: #f4f7fb;
        }

        body {
            margin: 0;
            background: var(--page-bg);
            color: #263445;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            position: fixed;
            inset: 0 auto 0 0;
            background: var(--primary-color);
            color: #fff;
            padding: 24px 16px;
            overflow-y: auto;
            z-index: 1000;
        }

        .brand {
            font-size: 19px;
            font-weight: 700;
            padding: 0 10px 26px;
            border-bottom: 1px solid rgba(255,255,255,.15);
            margin-bottom: 22px;
        }

        .brand small {
            display: block;
            margin-top: 6px;
            font-size: 11px;
            font-weight: 400;
            color: #cbd5e1;
        }

        .menu-label {
            font-size: 10px;
            letter-spacing: 1.3px;
            color: #aabbd0;
            margin: 20px 10px 8px;
        }

        .sidebar .nav-link {
            color: #dce6f1;
            padding: 11px 12px;
            border-radius: 8px;
            margin-bottom: 4px;
            font-size: 13px;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            font-size: 16px;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background: #31567f;
            color: #fff;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        .topbar {
            background: #fff;
            border-bottom: 1px solid #e7ecf2;
            padding: 16px 28px;
        }

        .content-area {
            padding: 28px;
        }

        .page-title {
            font-weight: 700;
            font-size: 25px;
        }

        .stat-card, .panel {
            background: #fff;
            border: 1px solid #e8edf3;
            border-radius: 13px;
            padding: 20px;
            height: 100%;
        }

        .stat-icon {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            font-size: 21px;
            background: #edf3fb;
            color: #244c7a;
        }

        .stat-number {
            font-size: 28px;
            font-weight: 700;
            margin-top: 18px;
        }

        .stat-label {
            font-size: 13px;
            color: #778397;
        }

        .panel-title {
            font-size: 16px;
            font-weight: 700;
        }

        .table > :not(caption) > * > * {
            padding: 12px 10px;
            vertical-align: middle;
        }

        .table thead th {
            font-size: 12px;
            color: #778397;
            font-weight: 600;
            background: #f8fafc;
            white-space: nowrap;
        }

        .table tbody td {
            font-size: 13px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
                padding: 20px 8px;
            }

            .brand {
                font-size: 0;
                padding: 0 8px 20px;
            }

            .brand i {
                font-size: 23px;
            }

            .brand small,
            .menu-label,
            .sidebar .nav-link span {
                display: none;
            }

            .sidebar .nav-link {
                text-align: center;
                padding: 12px 5px;
            }

            .sidebar .nav-link i {
                margin: 0;
            }

            .main-content {
                margin-left: 70px;
            }

            .content-area {
                padding: 16px;
            }

            .topbar {
                padding: 15px;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

    <aside class="sidebar">
        <div class="brand">
            <i class="bi bi-buildings"></i>
            <span>Sistem Kontraktor</span>
            <small>Inventory & Project Monitoring</small>
        </div>

        <div class="menu-label">MENU UTAMA</div>

        <nav class="nav flex-column">
            <a href="{{ route('dashboard') }}"
               class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2"></i>
                <span>Dashboard</span>
            </a>
        </nav>

        <div class="menu-label">MASTER DATA</div>

        <nav class="nav flex-column">
            <a href="{{ route('materials.index') }}"
            class="nav-link {{ request()->routeIs('materials.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i>
                <span>Data Material</span>
            </a>
            
            <a href="{{ route('categories.index') }}"
            class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i>
                <span>Kategori Material</span>
            </a>

            <a href="{{ route('units.index') }}"
            class="nav-link {{ request()->routeIs('units.*') ? 'active' : '' }}">
                <i class="bi bi-rulers"></i>
                <span>Satuan Material</span>
            </a>

            <a href="{{ route('warehouses.index') }}"
            class="nav-link {{ request()->routeIs('warehouses.*') ? 'active' : '' }}">
                <i class="bi bi-building"></i>
                <span>Data Gudang</span>
            </a>

            <a href="{{ route('projects.index') }}"
            class="nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}">
                <i class="bi bi-building-check"></i>
                <span>Data Proyek</span>
            </a>
        </nav>

        <div class="menu-label">TRANSAKSI & LAPORAN</div>

        <nav class="nav flex-column">
            <a href="#" class="nav-link">
                <i class="bi bi-box-arrow-in-down"></i>
                <span>Stok Masuk</span>
            </a>

            <a href="#" class="nav-link">
                <i class="bi bi-box-arrow-up"></i>
                <span>Stok Keluar</span>
            </a>

            <a href="#" class="nav-link">
                <i class="bi bi-wallet2"></i>
                <span>Biaya Proyek</span>
            </a>

            <a href="#" class="nav-link">
                <i class="bi bi-file-earmark-bar-graph"></i>
                <span>Laporan</span>
            </a>
        </nav>
    </aside>

    <div class="main-content">
        <header class="topbar d-flex justify-content-between align-items-center">
            <div>
                <span class="text-secondary small">Aplikasi Manajemen</span>
                <div class="fw-semibold">Persediaan & Proyek Konstruksi</div>
            </div>

            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-person-circle fs-4 text-secondary"></i>
                <div>
                    <div class="small fw-semibold">Administrator</div>
                    <div class="text-secondary" style="font-size: 11px;">
                        Panel Pengelolaan
                    </div>
                </div>
            </div>
        </header>

        <main class="content-area">
            @yield('content')
        </main>

        <footer class="text-center text-secondary small pb-4 px-3">
            &copy; {{ date('Y') }} Sistem Informasi Persediaan Material
            dan Monitoring Biaya Proyek Konstruksi.
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
