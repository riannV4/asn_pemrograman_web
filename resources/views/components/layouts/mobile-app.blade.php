@props(['currentPage' => 'dashboard'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Expense Tracker') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet" />
        
        <!-- Material Symbols -->
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet" />
        
        <style>
            .material-symbols-rounded {
                font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            }
            .material-symbols-rounded.filled {
                font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-background">
        <div class="min-h-screen pb-16" x-data="appState()">
            <!-- Page Content -->
            <main class="max-w-md mx-auto">
                {{ $slot }}
            </main>

            <!-- Bottom Navigation -->
            @include('components.layouts.bottom-nav', ['current' => $currentPage ?? 'dashboard'])
        </div>

        <script>
            function appState() {
                return {
                    currentPage: '{{ $currentPage ?? 'dashboard' }}',
                    
                    navigateTo(page) {
                        this.currentPage = page;
                        
                        const routes = {
                            'dashboard': '{{ route('dashboard') }}',
                            'reports': '{{ route('reports') }}',
                            'profile': '{{ route('profile.edit') }}'
                        };
                        
                        if (routes[page]) {
                            window.location.href = routes[page];
                        }
                    }
                }
            }
        </script>
        @stack('scripts')
    </body>
</html>
