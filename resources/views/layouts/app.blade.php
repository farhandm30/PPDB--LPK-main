<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $pengaturan = \App\Models\Pengaturan::first();
    @endphp

    <title>{{ $pengaturan->nama_aplikasi ?? config('app.name', 'PPDB Online') }} - @yield('title', 'Penerimaan Peserta Didik Baru')</title>

    @if ($pengaturan)
        <meta name="description" content="{{ $pengaturan->meta_deskripsi }}">
        <meta name="keywords" content="{{ $pengaturan->meta_keyword }}">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Styles -->
    <style>
        :root {
            --color-primary: #1E8449;
            --color-secondary: #27AE60;
            --color-accent: #145A32;
            --color-background: #FFFFFF;
            --color-text: #333333;
            --color-text-secondary: #666666;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    @stack('styles')
</head>

<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        @include('components.header')

        <!-- Page Content -->
        <main class="flex-grow">
            @yield('content')
        </main>

        <!-- Footer -->
        @include('components.footer')
    </div>

    @stack('scripts')
</body>

</html>
