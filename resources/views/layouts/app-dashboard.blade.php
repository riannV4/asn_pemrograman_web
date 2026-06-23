<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Dashboard</title>

    <!-- Google Fonts & Icons -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>

    <style>
        /* Level 1 Elevation as per style guide */
        .elevation-1 {
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.05);
        }
        /* Icon tint background helper */
        .bg-tint-primary {
            background-color: color-mix(in srgb, #005a71 10%, transparent);
        }
        .bg-tint-error {
            background-color: color-mix(in srgb, #ba1a1a 10%, transparent);
        }
        .bg-tint-secondary {
            background-color: color-mix(in srgb, #565e74 10%, transparent);
        }
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-background text-on-background font-body-md antialiased overflow-hidden">
    <div class="flex h-screen w-full">
        <!-- SideNavBar -->
        <nav class="bg-surface-container-lowest h-screen w-64 border-r border-outline-variant flex flex-col sticky left-0 top-0 overflow-y-auto">
            <div class="p-lg flex items-center gap-md border-b border-outline-variant/50">
                <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-on-primary">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">account_balance_wallet</span>
                </div>
                <div>
                    <h1 class="font-headline-md text-headline-md text-primary">{{ config('app.name', 'Kostly') }}</h1>
                    <p class="font-body-md text-body-md text-on-surface-variant text-sm">Tracker</p>
                </div>
            </div>

            <div class="flex-1 py-md">
                <!-- Dashboard -->
                <a class="{{ request()->routeIs('dashboard') ? 'bg-secondary-container text-on-secondary-container' : 'text-on-surface-variant hover:bg-surface-container-high' }} rounded-xl px-4 py-3 mx-2 my-1 flex items-center gap-3 transition-colors duration-200 active:scale-95" href="{{ route('dashboard') }}">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">dashboard</span>
                    <span class="font-label-bold text-label-bold">Dashboard</span>
                </a>

                <!-- Transactions -->
                <a class="{{ request()->routeIs('transactions.*') ? 'bg-secondary-container text-on-secondary-container' : 'text-on-surface-variant hover:bg-surface-container-high' }} rounded-xl px-4 py-3 mx-2 my-1 flex items-center gap-3 transition-colors duration-200 active:scale-95" href="{{ route('transactions.index') }}">
                    <span class="material-symbols-outlined">receipt_long</span>
                    <span class="font-label-bold text-label-bold">Transactions</span>
                </a>

                <!-- Reports -->
                <a class="{{ request()->routeIs('reports') ? 'bg-secondary-container text-on-secondary-container' : 'text-on-surface-variant hover:bg-surface-container-high' }} rounded-xl px-4 py-3 mx-2 my-1 flex items-center gap-3 transition-colors duration-200 active:scale-95" href="{{ route('reports') }}">
                    <span class="material-symbols-outlined">bar_chart</span>
                    <span class="font-label-bold text-label-bold">Reports</span>
                </a>

                <!-- Settings -->
                <a class="{{ request()->routeIs('categories.*') ? 'bg-secondary-container text-on-secondary-container' : 'text-on-surface-variant hover:bg-surface-container-high' }} rounded-xl px-4 py-3 mx-2 my-1 flex items-center gap-3 transition-colors duration-200 active:scale-95" href="{{ route('categories.index') }}">
                    <span class="material-symbols-outlined">settings</span>
                    <span class="font-label-bold text-label-bold">Settings</span>
                </a>
            </div>

            <div class="p-md mt-auto border-t border-outline-variant/50">
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-md p-sm rounded-xl hover:bg-surface-container-high cursor-pointer transition-colors duration-200">
                    <div class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-on-surface-variant">account_circle</span>
                    </div>
                    <div class="flex-1 overflow-hidden min-w-0">
                        <p class="font-label-bold text-label-bold truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-on-surface-variant truncate">{{ Auth::user()->email }}</p>
                    </div>
                </a>
            </div>
        </nav>

        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col h-full overflow-hidden bg-background">
            <!-- TopAppBar -->
            <header class="bg-surface/80 backdrop-blur-md w-full h-16 border-b border-outline-variant flex justify-between items-center px-lg sticky top-0 z-40">
                <div class="flex items-center">
                    <!-- Page title could go here -->
                </div>
                <div class="flex items-center gap-sm">
                    <button class="text-on-surface-variant hover:bg-surface-container-high rounded-full p-2 cursor-pointer transition-all duration-200 flex items-center justify-center">
                        <span class="material-symbols-outlined">notifications</span>
                    </button>
                    <button class="text-on-surface-variant hover:bg-surface-container-high rounded-full p-2 cursor-pointer transition-all duration-200 flex items-center justify-center">
                        <span class="material-symbols-outlined">help_outline</span>
                    </button>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-on-surface-variant hover:bg-surface-container-high rounded-full p-2 cursor-pointer transition-all duration-200 flex items-center justify-center" title="Logout">
                            <span class="material-symbols-outlined">logout</span>
                        </button>
                    </form>
                </div>
            </header>

            <!-- Dashboard Canvas -->
            <div class="flex-1 overflow-y-auto p-xl">
                {{ $slot }}
                
                <!-- Bottom padding for breathing room -->
                <div class="h-xl"></div>
            </div>
        </main>
    </div>
</body>
</html>
