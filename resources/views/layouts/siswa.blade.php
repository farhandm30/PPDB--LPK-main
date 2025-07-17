<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $pengaturan = \App\Models\Pengaturan::first();
    @endphp

    <title>{{ $pengaturan->nama_aplikasi ?? config('app.name', 'PPDB Online') }} - @yield('title', 'Dashboard Siswa')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #1abc9c;
            --accent-color: #3498db;
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --danger-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
            --gray-color: #95a5a6;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: #333;
        }

        .navbar {
            background-color: var(--primary-color) !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 0 1rem;
            z-index: 1101 !important;
            position: sticky;
            top: 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.4rem;
            color: white !important;
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            height: 80px;
            width: auto;
            margin-right: 10px;
            object-fit: cover;
        }

        .sidebar {
            min-height: calc(100vh - 62px);
            background-color: white;
            padding-top: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            z-index: 100;
        }

        .sidebar .nav-link {
            color: #555;
            padding: 0.8rem 1.2rem;
            font-weight: 500;
            border-radius: 5px;
            margin: 0.2rem 0.8rem;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover {
            color: var(--secondary-color);
            background-color: rgba(26, 188, 156, 0.1);
        }

        .sidebar .nav-link.active {
            color: var(--secondary-color);
            background-color: rgba(26, 188, 156, 0.15);
            border-left: 4px solid var(--secondary-color);
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .main-content {
            padding: 25px;
            background-color: #f5f7fa;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            overflow: hidden;
        }

        .card-header {
            background-color: white;
            color: var(--dark-color);
            font-weight: 600;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 15px 20px;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--dark-color);
        }

        .widget-stat.card {
            border-radius: 10px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .widget-stat.card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .widget-stat.card.bg-primary {
            background-color: var(--secondary-color) !important;
        }

        .widget-stat.card.bg-info {
            background-color: var(--accent-color) !important;
        }

        .widget-stat.card.bg-success {
            background-color: var(--success-color) !important;
        }

        .widget-stat.card.bg-danger {
            background-color: var(--danger-color) !important;
        }

        .widget-stat.card.bg-warning {
            background-color: var(--warning-color) !important;
        }

        .btn {
            border-radius: 5px;
            padding: 0.5rem 1.2rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .btn-primary:hover {
            background-color: #16a085;
            border-color: #16a085;
        }

        .btn-info {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
        }

        .btn-info:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }

        .alert {
            border-radius: 10px;
            border: none;
        }

        .form-control,
        .form-select {
            border-radius: 5px;
            padding: 0.5rem 1rem;
            border: 1px solid #ddd;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.25rem rgba(26, 188, 156, 0.25);
        }

        .table {
            border-collapse: separate;
            border-spacing: 0;
        }

        .table th {
            font-weight: 600;
            color: var(--dark-color);
            background-color: rgba(236, 240, 241, 0.5);
        }

        .badge {
            padding: 0.5em 0.8em;
            font-weight: 500;
        }

        .list-group-item {
            border: none;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 15px 20px;
        }

        .list-group-item:last-child {
            border-bottom: none;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .dropdown-item {
            padding: 0.5rem 1.2rem;
        }

        .dropdown-item:hover {
            background-color: rgba(26, 188, 156, 0.1);
            color: var(--secondary-color);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed !important;
                top: 12%;
                left: -100%;
                width: 80vw;
                height: 100vh;
                z-index: 1000;
                transition: left 0.3s;
                box-shadow: 2px 0 8px rgba(0, 0, 0, 0.08);
            }

            .sidebar.show {
                left: 0;
            }

            .main-content {
                padding: 15px;
                margin-left: 0 !important;
            }
        }

        @media (min-width: 769px) {
            .sidebar {
                position: relative !important;
                left: 0 !important;
                width: 300px;
                min-height: calc(100vh - 62px);
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            }

            .main-content {
                margin-left: 0px;
                padding: 25px;
            }

            .sidebar.collapsed {
                margin-left: -275px;
            }

            .main-content.sidebar-collapsed {
                margin-left: 0 !important;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('siswa.dashboard') }}">
                @if ($pengaturan && $pengaturan->logo_persegi)
                    <img src="{{ asset('storage/' . $pengaturan->logo_persegi) }}" alt="Logo LPK Orieda">
                @endif
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-none d-lg-block" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item d-none d-lg-block">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <form method="POST" action="{{ route('auth.logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="sidebar d-lg-block collapse position-fixed position-lg-relative" id="sidebarMenu">
                <!-- Tombol toggle sidebar (desktop only) -->
                <button id="sidebarToggleDesktop"
                    class="btn btn-light d-none d-lg-flex align-items-center justify-content-center"
                    style="position: absolute; top: 20px; right: -18px; z-index: 1201; width: 36px; height: 36px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border-radius: 50%;">
                    <i id="sidebarToggleIcon" class="fas fa-angle-left"></i>
                </button>
                <div class="position-sticky">
                    <div class="d-lg-none mb-3 px-3">
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle text-dark" href="#" id="sidebarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="sidebarDropdown">
                                <li>
                                    <form method="POST" action="{{ route('auth.logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}"
                                href="{{ route('siswa.dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('siswa.data-diri') ? 'active' : '' }}"
                                href="{{ route('siswa.data-diri') }}">
                                <i class="fas fa-user"></i> Data Diri
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('siswa.data-orangtua') ? 'active' : '' }}"
                                href="{{ route('siswa.data-orangtua') }}">
                                <i class="fas fa-users"></i> Data Orangtua/Wali
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('siswa.berkas') ? 'active' : '' }}"
                                href="{{ route('siswa.berkas') }}">
                                <i class="fas fa-file-upload"></i> Upload Berkas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('siswa.hasil') ? 'active' : '' }}"
                                href="{{ route('siswa.hasil') }}">
                                <i class="fas fa-clipboard-check"></i> Hasil Pendaftaran
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <main class="main-content col px-0 px-md-4">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Toggle sidebar on mobile
        document.addEventListener('DOMContentLoaded', function() {
            const navbarToggler = document.querySelector('.navbar-toggler');
            const sidebar = document.querySelector('.sidebar');

            if (navbarToggler && sidebar) {
                navbarToggler.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });

                // Close sidebar when clicking outside on mobile
                document.addEventListener('click', function(event) {
                    if (window.innerWidth <= 768 &&
                        !sidebar.contains(event.target) &&
                        !navbarToggler.contains(event.target) &&
                        sidebar.classList.contains('show')) {
                        sidebar.classList.remove('show');
                    }
                });
            }

            // Toggle sidebar on desktop
            const sidebarToggleDesktop = document.getElementById('sidebarToggleDesktop');
            const sidebarToggleIcon = document.getElementById('sidebarToggleIcon');
            if (sidebarToggleDesktop && sidebar) {
                sidebarToggleDesktop.addEventListener('click', function() {
                    if (window.innerWidth > 768) {
                        sidebar.classList.toggle('collapsed');
                        document.querySelector('.main-content').classList.toggle('sidebar-collapsed');
                        // Ganti icon
                        if (sidebar.classList.contains('collapsed')) {
                            sidebarToggleIcon.classList.remove('fa-angle-left');
                            sidebarToggleIcon.classList.add('fa-angle-right');
                        } else {
                            sidebarToggleIcon.classList.remove('fa-angle-right');
                            sidebarToggleIcon.classList.add('fa-angle-left');
                        }
                    }
                });
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
