@props(['title' => null])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ? $title . ' | ' . config('app.name', 'Kostly Tracker') : config('app.name', 'Kostly Tracker') }}</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
        <link rel="manifest" href="{{ asset('site.webmanifest') }}">
        <meta name="theme-color" content="#005a71">

        <!-- Metadata Website -->
        <meta name="application-name" content="Kostly Tracker">
        <meta name="apple-mobile-web-app-title" content="Kostly Tracker">
        <meta name="description" content="Aplikasi manajemen keuangan khusus anak kost untuk mencatat pemasukan, pengeluaran, dan memantau kondisi keuangan secara real-time.">

        <!-- SEO dan Social Preview -->
        <meta property="og:title" content="Kostly Tracker">
        <meta property="og:description" content="Aplikasi Manajemen Keuangan Anak Kost">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta name="twitter:card" content="summary_large_image">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
        
        <!-- Material Symbols -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-primary/5 via-background to-secondary/5 py-12 px-4 sm:px-6 lg:px-8">
            <div class="w-full max-w-md space-y-8">
                <!-- Card -->
                <div class="bg-surface shadow-card rounded-card overflow-hidden border border-outline-variant">
                    <div class="px-8 py-10 sm:px-10">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
