<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Kostly') }} - {{ $title ?? 'Dashboard' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-on-surface h-screen overflow-hidden flex antialiased">
    
    <!-- Sidebar Navigation -->
    <nav class="bg-surface-container-lowest border-r border-outline-variant h-screen w-64 flex flex-col sticky left-0 top-0 overflow-y-auto hidden md:flex shrink-0">
        <!-- Logo/Brand -->
        <div class="p-lg flex items-center gap-md">
            <div class="w-10 h-10 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center font-headline-md text-headline-md">
                K
            </div>
            <div>
                <h1 class="font-headline-md text-headline-md text-primary">Kostly Tracker</h1>
                <p class="font-body-md text-body-md text-on-surface-variant text-xs">Anak Kost Management</p>
            </div>
        </div>

        <!-- Navigation Links -->
        <div class="mt-md flex-1 px-sm space-y-sm">
            <a href="{{ route('dashboard') }}" 
               class="{{ request()->routeIs('dashboard') ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:bg-surface-container-high' }} rounded-xl px-4 py-3 mx-2 my-1 flex items-center gap-3 transition-colors duration-200 active:scale-95 transition-transform">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="font-body-md text-body-md">Dashboard</span>
            </a>
            
            <a href="{{ route('transactions.index') }}" 
               class="{{ request()->routeIs('transactions.*') ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:bg-surface-container-high' }} rounded-xl px-4 py-3 mx-2 my-1 flex items-center gap-3 transition-colors duration-200 active:scale-95 transition-transform">
                <span class="material-symbols-outlined">receipt_long</span>
                <span class="font-body-md text-body-md">Transactions</span>
            </a>
            
            <a href="{{ route('reports') }}" 
               class="{{ request()->routeIs('reports*') ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:bg-surface-container-high' }} rounded-xl px-4 py-3 mx-2 my-1 flex items-center gap-3 transition-colors duration-200 active:scale-95 transition-transform">
                <span class="material-symbols-outlined">bar_chart</span>
                <span class="font-body-md text-body-md">Reports</span>
            </a>
            
            <a href="{{ route('categories.index') }}" 
               class="{{ request()->routeIs('categories.*') ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:bg-surface-container-high' }} rounded-xl px-4 py-3 mx-2 my-1 flex items-center gap-3 transition-colors duration-200 active:scale-95 transition-transform">
                <span class="material-symbols-outlined">category</span>
                <span class="font-body-md text-body-md">Categories</span>
            </a>

            <a href="{{ route('profile.edit') }}" 
               class="{{ request()->routeIs('profile.*') ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:bg-surface-container-high' }} rounded-xl px-4 py-3 mx-2 my-1 flex items-center gap-3 transition-colors duration-200 active:scale-95 transition-transform">
                <span class="material-symbols-outlined">settings</span>
                <span class="font-body-md text-body-md">Settings</span>
            </a>
        </div>

        <!-- User Profile Section -->
        <div class="p-4 mt-auto border-t border-outline-variant">
            <div class="flex items-center gap-3 p-2 hover:bg-surface-container-high rounded-xl cursor-pointer transition-colors">
                <div class="w-8 h-8 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center font-semibold text-sm">
                    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-body-md text-body-md font-bold truncate">{{ Auth::user()->name ?? 'User' }}</p>
                    <p class="font-body-md text-body-md text-xs text-on-surface-variant truncate">{{ Auth::user()->email ?? '' }}</p>
                </div>
            </div>
            
            <!-- Logout Form -->
            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit" class="w-full text-left px-2 py-2 text-on-surface-variant hover:bg-surface-container-high rounded-xl transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">logout</span>
                    <span class="font-body-md text-body-md text-sm">Logout</span>
                </button>
            </form>
        </div>
    </nav>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden relative">
        
        <!-- Top App Bar -->
        <header class="bg-surface/80 backdrop-blur-md w-full h-16 border-b border-outline-variant flex justify-between items-center px-lg sticky top-0 z-40 shrink-0">
            <!-- Mobile: Kostly Logo -->
            <div class="font-headline-lg text-headline-lg text-primary md:hidden">Kostly</div>
            
            <!-- Desktop: Search Bar -->
            <div class="hidden md:block flex-1 max-w-md">
                <div class="relative group">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                    <input 
                        type="text" 
                        class="w-full bg-surface-container-low border border-transparent focus:border-primary focus:ring-1 focus:ring-primary rounded-full py-2 pl-10 pr-4 font-body-md text-body-md transition-all" 
                        placeholder="Search transactions..."
                    />
                </div>
            </div>

            <!-- Right: Action Buttons -->
            <div class="flex items-center gap-sm">
                <button class="text-on-surface-variant hover:bg-surface-container-high rounded-full p-2 cursor-pointer transition-all duration-200">
                    <span class="material-symbols-outlined">notifications</span>
                </button>
                <button class="text-on-surface-variant hover:bg-surface-container-high rounded-full p-2 cursor-pointer transition-all duration-200">
                    <span class="material-symbols-outlined">help_outline</span>
                </button>

                <!-- Mobile Menu Toggle -->
                <button 
                    onclick="toggleMobileMenu()" 
                    class="md:hidden text-on-surface-variant hover:bg-surface-container-high rounded-full p-2 cursor-pointer transition-all duration-200">
                    <span class="material-symbols-outlined">menu</span>
                </button>
            </div>
        </header>

        <!-- Mobile Navigation Overlay -->
        <div id="mobileMenu" class="hidden md:hidden fixed inset-0 bg-black/50 z-50" onclick="toggleMobileMenu()">
            <nav class="bg-surface-container-lowest w-64 h-full shadow-lg" onclick="event.stopPropagation()">
                <!-- Logo -->
                <div class="p-lg flex items-center gap-md border-b border-outline-variant">
                    <div class="w-10 h-10 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center font-headline-md text-headline-md">
                        K
                    </div>
                    <div>
                        <h1 class="font-headline-md text-headline-md text-primary">Kostly Tracker</h1>
                        <p class="font-body-md text-body-md text-on-surface-variant text-xs">Anak Kost Management</p>
                    </div>
                </div>

                <!-- Nav Links -->
                <div class="mt-md px-sm space-y-sm">
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant' }} rounded-xl px-4 py-3 mx-2 flex items-center gap-3">
                        <span class="material-symbols-outlined">dashboard</span>
                        <span class="font-body-md text-body-md">Dashboard</span>
                    </a>
                    <a href="{{ route('transactions.index') }}" class="{{ request()->routeIs('transactions.*') ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant' }} rounded-xl px-4 py-3 mx-2 flex items-center gap-3">
                        <span class="material-symbols-outlined">receipt_long</span>
                        <span class="font-body-md text-body-md">Transactions</span>
                    </a>
                    <a href="{{ route('reports') }}" class="{{ request()->routeIs('reports*') ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant' }} rounded-xl px-4 py-3 mx-2 flex items-center gap-3">
                        <span class="material-symbols-outlined">bar_chart</span>
                        <span class="font-body-md text-body-md">Reports</span>
                    </a>
                    <a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant' }} rounded-xl px-4 py-3 mx-2 flex items-center gap-3">
                        <span class="material-symbols-outlined">category</span>
                        <span class="font-body-md text-body-md">Categories</span>
                    </a>
                    <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.*') ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant' }} rounded-xl px-4 py-3 mx-2 flex items-center gap-3">
                        <span class="material-symbols-outlined">settings</span>
                        <span class="font-body-md text-body-md">Settings</span>
                    </a>
                </div>

                <!-- User Profile -->
                <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-outline-variant bg-surface-container-lowest">
                    <div class="flex items-center gap-3 p-2 rounded-xl">
                        <div class="w-8 h-8 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center font-semibold text-sm">
                            {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-body-md text-body-md font-bold truncate">{{ Auth::user()->name ?? 'User' }}</p>
                            <p class="font-body-md text-body-md text-xs text-on-surface-variant truncate">{{ Auth::user()->email ?? '' }}</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button type="submit" class="w-full text-left px-2 py-2 text-on-surface-variant hover:bg-surface-container-high rounded-xl transition-colors flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">logout</span>
                            <span class="font-body-md text-body-md text-sm">Logout</span>
                        </button>
                    </form>
                </div>
            </nav>
        </div>

        <!-- Scrollable Main Content -->
        <main class="flex-1 overflow-y-auto p-lg bg-surface">
            {{ $slot }}
        </main>
    </div>

    <!-- Mobile Menu Toggle Script -->
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }
    </script>

    <!-- Additional Scripts Stack -->
    @stack('scripts')
</body>
</html>
