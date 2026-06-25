@props(['currentPage' => 'dashboard'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <body class="font-sans antialiased bg-background text-on-surface">
        <div class="min-h-screen lg:flex" x-data="appState()">
            <!-- Desktop Sidebar -->
            <aside class="hidden lg:flex lg:w-64 lg:shrink-0 lg:flex-col lg:sticky lg:top-0 lg:h-screen bg-primary border-r border-primary-dark shadow-card-hover text-white">
                <div class="p-6 border-b border-white/20">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-2xl bg-white text-primary flex items-center justify-center shadow-card">
                            <span class="material-symbols-rounded filled">account_balance_wallet</span>
                        </div>
                        <div class="min-w-0">
                            <h1 class="text-headline-md font-bold text-white truncate">Tracker Kostly</h1>
                            <p class="text-xs text-white/80 truncate">Anak Kost Management</p>
                        </div>
                    </a>
                </div>

                @php
                    $desktopNavItems = [
                        ['page' => 'dashboard', 'route' => route('dashboard'), 'icon' => 'dashboard', 'label' => 'Dashboard', 'active' => in_array($currentPage ?? 'dashboard', ['dashboard'])],
                        ['page' => 'transactions', 'route' => route('transactions.index'), 'icon' => 'receipt_long', 'label' => 'Transaksi', 'active' => ($currentPage ?? 'dashboard') === 'transactions'],
                        ['page' => 'create', 'route' => route('transactions.create'), 'icon' => 'add_circle', 'label' => 'Catat', 'active' => ($currentPage ?? 'dashboard') === 'create'],
                        ['page' => 'reports', 'route' => route('reports'), 'icon' => 'bar_chart', 'label' => 'Laporan', 'active' => ($currentPage ?? 'dashboard') === 'reports'],
                        ['page' => 'profile', 'route' => route('profile.edit'), 'icon' => 'settings', 'label' => 'Pengaturan', 'active' => ($currentPage ?? 'dashboard') === 'profile'],
                    ];
                @endphp

                <nav class="flex-1 px-3 py-5 space-y-1 overflow-y-auto">
                    @foreach($desktopNavItems as $item)
                        <a href="{{ $item['route'] }}"
                           class="flex items-center gap-3 rounded-2xl px-4 py-3 transition-all duration-200 {{ $item['active'] ? 'bg-white text-primary shadow-card font-bold' : 'text-white/85 hover:bg-white/20 hover:text-white' }}">
                            <span class="material-symbols-rounded {{ $item['active'] ? 'filled' : '' }}">{{ $item['icon'] }}</span>
                            <span class="text-body-md {{ $item['active'] ? 'font-bold' : 'font-semibold' }}">{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </nav>

                @auth
                    <div class="p-4 border-t border-white/20">
                        <div class="flex items-center gap-3 rounded-2xl bg-white p-3 ring-1 ring-outline-variant shadow-card">
                            <div class="w-10 h-10 rounded-full bg-primary-container text-primary flex items-center justify-center font-bold shrink-0">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div class="min-w-0">
                                <p class="text-body-md font-bold text-on-surface truncate">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-on-surface-variant truncate">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>
                @endauth
            </aside>

            <div class="min-w-0 flex-1 pb-16 lg:pb-0">
                <!-- Page Content -->
                <main class="w-full max-w-md mx-auto lg:max-w-none">
                    {{ $slot }}
                </main>

                <!-- Bottom Navigation -->
                @include('components.layouts.bottom-nav', ['current' => $currentPage ?? 'dashboard'])
            </div>
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
