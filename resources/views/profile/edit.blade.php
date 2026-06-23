@php
    $categories = $user->categories()->orderBy('name')->get();
    
    function getCategoryStyle($name, $type) {
        $nameLower = strtolower($name);
        
        // Default styles
        if ($type === 'income') {
            $icon = 'payments';
            $bgClass = 'bg-green-50 text-green-600 border-green-200';
        } else {
            $icon = 'label';
            $bgClass = 'bg-slate-50 text-slate-600 border-slate-200';
        }

        if (str_contains($nameLower, 'makan') || str_contains($nameLower, 'minum') || str_contains($nameLower, 'kuliner')) {
            $icon = 'restaurant';
            $bgClass = 'bg-red-50 text-error border-error-container/30';
        } elseif (str_contains($nameLower, 'sewa') || str_contains($nameLower, 'kos') || str_contains($nameLower, 'kost') || str_contains($nameLower, 'kontrak')) {
            $icon = 'home';
            $bgClass = 'bg-primary-container/10 text-primary border-primary-container/20';
        } elseif (str_contains($nameLower, 'trans') || str_contains($nameLower, 'motor') || str_contains($nameLower, 'bensin') || str_contains($nameLower, 'mobil') || str_contains($nameLower, 'bus')) {
            $icon = 'directions_bus';
            $bgClass = 'bg-tertiary-container/10 text-tertiary border-tertiary-container/20';
        } elseif (str_contains($nameLower, 'inter') || str_contains($nameLower, 'wifi') || str_contains($nameLower, 'pulsa') || str_contains($nameLower, 'kuota')) {
            $icon = 'wifi';
            $bgClass = 'bg-secondary-container/50 text-secondary border-secondary-container/30';
        } elseif (str_contains($nameLower, 'laundry') || str_contains($nameLower, 'cuci')) {
            $icon = 'local_laundry_service';
            $bgClass = 'bg-blue-50 text-blue-600 border-blue-200';
        } elseif (str_contains($nameLower, 'listrik') || str_contains($nameLower, 'air') || str_contains($nameLower, 'pln') || str_contains($nameLower, 'pdam')) {
            $icon = 'electric_bolt';
            $bgClass = 'bg-amber-50 text-amber-600 border-amber-200';
        } elseif (str_contains($nameLower, 'belanja') || str_contains($nameLower, 'pasar') || str_contains($nameLower, 'mall')) {
            $icon = 'shopping_bag';
            $bgClass = 'bg-emerald-50 text-emerald-600 border-emerald-200';
        } elseif (str_contains($nameLower, 'gaji')) {
            $icon = 'payments';
            $bgClass = 'bg-green-50 text-green-600 border-green-200';
        } elseif (str_contains($nameLower, 'hibur') || str_contains($nameLower, 'main') || str_contains($nameLower, 'game') || str_contains($nameLower, 'nonton')) {
            $icon = 'sports_esports';
            $bgClass = 'bg-indigo-50 text-indigo-600 border-indigo-200';
        } elseif (str_contains($nameLower, 'sehat') || str_contains($nameLower, 'obat') || str_contains($nameLower, 'sakit') || str_contains($nameLower, 'dokter')) {
            $icon = 'medical_services';
            $bgClass = 'bg-teal-50 text-teal-600 border-teal-200';
        } elseif (str_contains($nameLower, 'tagih') || str_contains($nameLower, 'iuran')) {
            $icon = 'receipt';
            $bgClass = 'bg-purple-50 text-purple-600 border-purple-200';
        } elseif (str_contains($nameLower, 'bonus')) {
            $icon = 'card_giftcard';
            $bgClass = 'bg-green-50 text-green-600 border-green-200';
        } elseif (str_contains($nameLower, 'beasiswa')) {
            $icon = 'school';
            $bgClass = 'bg-sky-50 text-sky-600 border-sky-200';
        } elseif (str_contains($nameLower, 'kirim') || str_contains($nameLower, 'ortu')) {
            $icon = 'volunteer_activism';
            $bgClass = 'bg-rose-50 text-rose-600 border-rose-200';
        }
        
        return ['icon' => $icon, 'class' => $bgClass];
    }
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Kostly') }} - Settings</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.05);
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>
<body class="bg-background text-on-surface font-body-md min-h-screen flex flex-col md:flex-row antialiased"
      x-data="{
          mobileScreen: 'settings',
          openProfileModal: false,
          activeTab: 'profile',
          openAddCategory: false,
          openEditCategory: false,
          editCatId: null,
          editCatName: '',
          editCatType: 'expense',
          categoryFilter: 'expense'
      }">

    <!-- Top App Bar (Mobile & Tablet) -->
    <header class="sticky top-0 w-full z-40 flex justify-between items-center px-container-margin py-base bg-surface border-b border-outline-variant md:hidden shadow-sm">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-primary to-primary-container flex items-center justify-center text-white font-bold border border-outline-variant uppercase">
                {{ strtoupper(substr($user->name, 0, 1)) }}{{ strtoupper(substr(strrchr($user->name, ' ') ?: $user->name, 1, 1)) }}
            </div>
            <h1 class="font-bold text-lg text-primary">Kostly Tracker</h1>
        </div>
        <button class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-surface-container-low text-on-surface-variant transition-colors">
            <span class="material-symbols-outlined">notifications</span>
        </button>
    </header>

    <!-- SideNavBar (Desktop Only) -->
    <nav class="hidden md:flex flex-col h-screen w-64 border-r border-outline-variant bg-surface-container-lowest sticky left-0 top-0 overflow-y-auto">
        <div class="p-lg flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center text-white">
                <span class="material-symbols-outlined font-headline-md">account_balance_wallet</span>
            </div>
            <div>
                <h1 class="font-bold text-lg text-primary">Kostly Tracker</h1>
                <p class="text-xs text-on-surface-variant font-semibold">Anak Kost Management</p>
            </div>
        </div>
        
        <div class="flex-1 mt-md">
            <ul class="space-y-sm">
                <li>
                    <a class="text-on-surface-variant hover:bg-surface-container-high rounded-xl px-4 py-3 mx-2 my-1 flex items-center gap-3 transition-colors duration-200" href="{{ route('dashboard') }}">
                        <span class="material-symbols-outlined">dashboard</span>
                        <span class="font-bold text-sm">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a class="text-on-surface-variant hover:bg-surface-container-high rounded-xl px-4 py-3 mx-2 my-1 flex items-center gap-3 transition-colors duration-200" href="{{ route('transactions.index') }}">
                        <span class="material-symbols-outlined">receipt_long</span>
                        <span class="font-bold text-sm">Transactions</span>
                    </a>
                </li>
                <li>
                    <a class="text-on-surface-variant hover:bg-surface-container-high rounded-xl px-4 py-3 mx-2 my-1 flex items-center gap-3 transition-colors duration-200" href="{{ route('reports') }}">
                        <span class="material-symbols-outlined">bar_chart</span>
                        <span class="font-bold text-sm">Reports</span>
                    </a>
                </li>
                <li>
                    <a class="bg-secondary-container text-primary rounded-xl px-4 py-3 mx-2 my-1 flex items-center gap-3 active:scale-95 transition-transform" href="{{ route('profile.edit') }}">
                        <span class="material-symbols-outlined">settings</span>
                        <span class="font-bold text-sm">Settings</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="p-4 border-t border-outline-variant/30 mt-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-xl text-error hover:bg-error-container/20 transition-colors font-bold text-sm border border-error/20">
                    <span class="material-symbols-outlined">logout</span>
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- Main Content Canvas -->
    <main class="flex-1 flex flex-col min-h-screen overflow-x-hidden relative">
        <div class="p-container-margin md:p-xl flex-1 max-w-5xl mx-auto w-full space-y-lg relative z-10">
            
            <!-- Success Status Flash Notification -->
            @if (session('success') || session('status'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl relative shadow-sm" role="alert" x-data="{ show: true }" x-show="show">
                    <span class="block sm:inline text-sm font-semibold">{{ session('success') ?: session('status') }}</span>
                    <button class="absolute top-0 bottom-0 right-0 px-4 py-3" @click="show = false">
                        <span class="material-symbols-outlined text-sm">close</span>
                    </button>
                </div>
            @endif

            <!-- DESKTOP SCREEN: SETTINGS GRID -->
            <div class="hidden md:block space-y-lg">
                <div class="flex items-center justify-between mb-lg">
                    <div>
                        <h2 class="text-2xl font-bold text-on-surface">Settings</h2>
                        <p class="text-sm text-on-surface-variant">Manage your account and preferences.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-lg">
                    <!-- Left Column: Profile & Account -->
                    <div class="lg:col-span-1 space-y-lg">
                        <!-- Profile Card -->
                        <div class="glass-card rounded-xl p-md flex flex-col items-center text-center">
                            <div class="relative mb-4">
                                <div class="w-24 h-24 rounded-full bg-gradient-to-tr from-primary to-primary-container flex items-center justify-center text-white font-bold text-3xl shadow-md border-4 border-surface select-none">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}{{ strtoupper(substr(strrchr($user->name, ' ') ?: $user->name, 1, 1)) }}
                                </div>
                                <button @click="openProfileModal = true; activeTab = 'profile'" class="absolute bottom-0 right-0 bg-primary text-on-primary rounded-full p-1.5 shadow-md hover:bg-primary-container transition-colors">
                                    <span class="material-symbols-outlined text-sm" style="font-size: 18px;">edit</span>
                                </button>
                            </div>
                            <h3 class="text-lg font-bold text-on-surface">{{ $user->name }}</h3>
                            <p class="text-sm text-on-surface-variant mb-4">{{ $user->email }}</p>
                            <button @click="openProfileModal = true; activeTab = 'profile'" class="w-full bg-transparent border border-outline text-primary font-bold text-sm py-3 rounded-lg hover:bg-surface-container transition-colors">
                                Edit Profil
                            </button>
                        </div>
                        
                        <!-- Application Settings -->
                        <div class="glass-card rounded-xl p-md">
                            <h4 class="text-xs font-bold text-on-surface-variant mb-4 uppercase tracking-wider">Application</h4>
                            <ul class="space-y-4">
                                <li class="flex items-center justify-between">
                                    <div class="flex items-center gap-3 text-on-surface">
                                        <span class="material-symbols-outlined text-on-surface-variant">notifications_active</span>
                                        <span class="text-sm">Notifications</span>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input checked class="sr-only peer" type="checkbox" value=""/>
                                        <div class="w-11 h-6 bg-surface-variant peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                                    </label>
                                </li>
                                <li class="flex items-center justify-between">
                                    <div class="flex items-center gap-3 text-on-surface">
                                        <span class="material-symbols-outlined text-on-surface-variant">language</span>
                                        <span class="text-sm">Language</span>
                                    </div>
                                    <div class="flex items-center text-primary font-bold text-sm cursor-pointer">
                                        Bahasa <span class="material-symbols-outlined ml-1 text-sm">chevron_right</span>
                                    </div>
                                </li>
                                <li class="flex items-center justify-between">
                                    <div class="flex items-center gap-3 text-on-surface">
                                        <span class="material-symbols-outlined text-on-surface-variant">info</span>
                                        <span class="text-sm">About Kostly</span>
                                    </div>
                                    <div class="text-on-surface-variant text-sm">
                                        v1.0.4
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Right Column: Categories Management -->
                    <div class="lg:col-span-2 space-y-lg">
                        <div class="glass-card rounded-xl p-md">
                            <div class="flex items-center justify-between mb-lg">
                                <div>
                                    <h3 class="text-lg font-bold text-on-surface">Kelola Kategori</h3>
                                    <p class="text-sm text-on-surface-variant">Manage expense categories for better tracking.</p>
                                </div>
                                <button @click="openAddCategory = true" class="bg-primary text-on-primary font-bold text-sm py-2 px-4 rounded-lg hover:bg-primary-container transition-colors flex items-center gap-2">
                                    <span class="material-symbols-outlined text-sm">add</span>
                                    Tambah Kategori
                                </button>
                            </div>
                            
                            <!-- Categories Grid -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @forelse($categories as $category)
                                    @php $style = getCategoryStyle($category->name, $category->type); @endphp
                                    <div class="bg-surface-container-lowest rounded-xl p-4 border border-surface-variant flex items-center justify-between hover:border-primary/50 transition-all group">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full flex items-center justify-center border-2 {{ $style['class'] }}">
                                                <span class="material-symbols-outlined">{{ $style['icon'] }}</span>
                                            </div>
                                            <span class="text-sm text-on-surface font-semibold">{{ $category->name }}</span>
                                        </div>
                                        <div class="flex gap-2 invisible group-hover:visible transition-all">
                                            <button @click="openEditCategory = true; editCatId = {{ $category->id }}; editCatName = '{{ $category->name }}'; editCatType = '{{ $category->type }}'" class="text-outline hover:text-primary transition-colors p-1">
                                                <span class="material-symbols-outlined text-sm">edit</span>
                                            </button>
                                            <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Menghapus kategori ini juga akan memengaruhi transaksi terkait. Yakin ingin menghapus?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-outline hover:text-error transition-colors p-1">
                                                    <span class="material-symbols-outlined text-sm">delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-sm text-on-surface-variant col-span-2 py-4">Belum ada kategori yang dibuat.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MOBILE SCREEN: SETTINGS (DYNAMIC VIEW SWITCHER) -->
            <div class="block md:hidden">
                <!-- Mobile Settings Subscreen -->
                <div x-show="mobileScreen === 'settings'" class="space-y-base">
                    <div>
                        <h2 class="text-xl font-bold text-on-background">Pengaturan</h2>
                    </div>
                    
                    <!-- Mobile Profile Card -->
                    <div class="bg-surface-container-lowest rounded-xl p-md shadow-sm border border-outline-variant/30 flex items-center justify-between">
                        <div class="flex items-center gap-md">
                            <div class="w-14 h-14 rounded-full bg-gradient-to-tr from-primary to-primary-container flex items-center justify-center text-white font-bold border-2 border-primary-fixed select-none">
                                {{ strtoupper(substr($user->name, 0, 1)) }}{{ strtoupper(substr(strrchr($user->name, ' ') ?: $user->name, 1, 1)) }}
                            </div>
                            <div>
                                <h3 class="font-bold text-base text-on-surface">{{ $user->name }}</h3>
                                <p class="text-xs text-on-surface-variant">{{ $user->email }}</p>
                            </div>
                        </div>
                        <button @click="openProfileModal = true; activeTab = 'profile'" class="h-9 px-3 rounded-lg border border-outline-variant text-primary font-bold text-xs hover:bg-surface-container-low transition-colors">
                            Edit Profil
                        </button>
                    </div>

                    <!-- settings groups -->
                    <div class="flex flex-col gap-lg">
                        <!-- Akun Group -->
                        <div class="flex flex-col gap-sm">
                            <h4 class="text-xs font-bold text-on-surface-variant px-2 uppercase tracking-wider">Akun</h4>
                            <div class="bg-surface-container-lowest rounded-xl overflow-hidden border border-outline-variant/30">
                                <button @click="openProfileModal = true; activeTab = 'profile'" class="w-full flex items-center justify-between p-md hover:bg-surface-container-low transition-colors text-left border-b border-outline-variant/30 last:border-0">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-secondary-container/50 flex items-center justify-center text-primary">
                                            <span class="material-symbols-outlined text-[20px]">person</span>
                                        </div>
                                        <span class="text-sm font-semibold text-on-surface">Edit Profil & Email</span>
                                    </div>
                                    <span class="material-symbols-outlined text-outline text-[20px]">chevron_right</span>
                                </button>
                                <button @click="openProfileModal = true; activeTab = 'password'" class="w-full flex items-center justify-between p-md hover:bg-surface-container-low transition-colors text-left border-b border-outline-variant/30 last:border-0">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-secondary-container/50 flex items-center justify-center text-primary">
                                            <span class="material-symbols-outlined text-[20px]">lock</span>
                                        </div>
                                        <span class="text-sm font-semibold text-on-surface">Ganti Password</span>
                                    </div>
                                    <span class="material-symbols-outlined text-outline text-[20px]">chevron_right</span>
                                </button>
                                <button @click="openProfileModal = true; activeTab = 'delete'" class="w-full flex items-center justify-between p-md hover:bg-surface-container-low transition-colors text-left border-b border-outline-variant/30 last:border-0">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-error-container/20 flex items-center justify-center text-error">
                                            <span class="material-symbols-outlined text-[20px]">delete</span>
                                        </div>
                                        <span class="text-sm font-semibold text-error">Hapus Akun</span>
                                    </div>
                                    <span class="material-symbols-outlined text-outline text-[20px]">chevron_right</span>
                                </button>
                            </div>
                        </div>

                        <!-- Kategori Group -->
                        <div class="flex flex-col gap-sm">
                            <h4 class="text-xs font-bold text-on-surface-variant px-2 uppercase tracking-wider">Kategori</h4>
                            <div class="bg-surface-container-lowest rounded-xl overflow-hidden border border-outline-variant/30">
                                <button @click="mobileScreen = 'categories'" class="w-full flex items-center justify-between p-md hover:bg-surface-container-low transition-colors text-left">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-tertiary-container/20 flex items-center justify-center text-tertiary">
                                            <span class="material-symbols-outlined text-[20px]">category</span>
                                        </div>
                                        <span class="text-sm font-semibold text-on-surface">Kelola Kategori</span>
                                    </div>
                                    <span class="material-symbols-outlined text-outline text-[20px]">chevron_right</span>
                                </button>
                            </div>
                        </div>

                        <!-- Aplikasi Group -->
                        <div class="flex flex-col gap-sm">
                            <h4 class="text-xs font-bold text-on-surface-variant px-2 uppercase tracking-wider">Aplikasi</h4>
                            <div class="bg-surface-container-lowest rounded-xl overflow-hidden border border-outline-variant/30">
                                <div class="flex items-center justify-between p-md border-b border-outline-variant/30 last:border-0">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-secondary-container/50 flex items-center justify-center text-primary">
                                            <span class="material-symbols-outlined text-[20px]">notifications</span>
                                        </div>
                                        <span class="text-sm font-semibold text-on-surface">Notifikasi</span>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input checked class="sr-only peer" type="checkbox" value=""/>
                                        <div class="w-11 h-6 bg-surface-variant peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                                    </label>
                                </div>
                                <div class="flex items-center justify-between p-md border-b border-outline-variant/30 last:border-0">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-secondary-container/50 flex items-center justify-center text-primary">
                                            <span class="material-symbols-outlined text-[20px]">language</span>
                                        </div>
                                        <span class="text-sm font-semibold text-on-surface">Bahasa</span>
                                    </div>
                                    <div class="flex items-center gap-1 text-on-surface-variant">
                                        <span class="text-xs">Indonesia</span>
                                        <span class="material-symbols-outlined text-outline text-[18px]">chevron_right</span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between p-md border-b border-outline-variant/30 last:border-0">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-secondary-container/50 flex items-center justify-center text-primary">
                                            <span class="material-symbols-outlined text-[20px]">info</span>
                                        </div>
                                        <span class="text-sm font-semibold text-on-surface">Tentang</span>
                                    </div>
                                    <span class="text-xs text-on-surface-variant">v1.0.4</span>
                                </div>
                            </div>
                        </div>

                        <!-- Keluar Button -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full h-[56px] flex items-center justify-center gap-2 rounded-xl bg-error-container/20 text-error font-bold text-sm hover:bg-error-container/40 transition-colors border border-error-container">
                                <span class="material-symbols-outlined text-[20px]">logout</span>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Mobile Categories Subscreen -->
                <div x-show="mobileScreen === 'categories'" style="display: none;">
                    <div class="flex items-center justify-between mb-md">
                        <div class="flex items-center gap-3">
                            <button class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-surface-container-high transition-colors text-on-surface" @click="mobileScreen = 'settings'">
                                <span class="material-symbols-outlined">arrow_back</span>
                            </button>
                            <h2 class="text-xl font-bold text-on-background">Kelola Kategori</h2>
                        </div>
                        <button class="w-10 h-10 bg-primary text-on-primary rounded-full flex items-center justify-center shadow-md hover:bg-primary-container transition-colors" @click="openAddCategory = true">
                            <span class="material-symbols-outlined">add</span>
                        </button>
                    </div>

                    <!-- Tab Switcher for Categories -->
                    <div class="flex bg-surface-container-low rounded-lg p-1 mb-md">
                        <button class="flex-1 py-2 text-center font-bold text-sm rounded-md transition-colors"
                                :class="categoryFilter === 'expense' ? 'bg-surface-container-lowest text-primary shadow-sm' : 'text-on-surface-variant hover:bg-surface-variant/50'"
                                @click="categoryFilter = 'expense'">
                            Pengeluaran
                        </button>
                        <button class="flex-1 py-2 text-center font-bold text-sm rounded-md transition-colors"
                                :class="categoryFilter === 'income' ? 'bg-surface-container-lowest text-primary shadow-sm' : 'text-on-surface-variant hover:bg-surface-variant/50'"
                                @click="categoryFilter = 'income'">
                            Pemasukan
                        </button>
                    </div>

                    <!-- Mobile Categories List -->
                    <div class="flex flex-col gap-3">
                        @foreach($categories as $category)
                            @php $style = getCategoryStyle($category->name, $category->type); @endphp
                            <div x-show="categoryFilter === '{{ $category->type }}'" class="bg-surface-container-lowest rounded-xl p-4 border border-outline-variant/30 flex items-center justify-between group shadow-sm">
                                <div class="flex items-center gap-4">
                                    <div class="w-11 h-11 rounded-full flex items-center justify-center border {{ $style['class'] }}">
                                        <span class="material-symbols-outlined text-[20px]">{{ $style['icon'] }}</span>
                                    </div>
                                    <span class="text-sm text-on-surface font-semibold">{{ $category->name }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button @click="openEditCategory = true; editCatId = {{ $category->id }}; editCatName = '{{ $category->name }}'; editCatType = '{{ $category->type }}'" class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-surface-container-high text-on-surface-variant">
                                        <span class="material-symbols-outlined text-[18px]">edit</span>
                                    </button>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Menghapus kategori ini juga akan memengaruhi transaksi terkait. Yakin ingin menghapus?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-error-container/20 text-error">
                                            <span class="material-symbols-outlined text-[18px]">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

        <!-- Bottom Navigation Bar (Mobile Only) -->
        <nav class="fixed bottom-0 left-0 right-0 w-full z-35 flex justify-between items-center px-4 py-2 bg-surface border-t border-outline-variant shadow-lg md:hidden rounded-t-xl">
            <a class="flex flex-col items-center justify-center text-on-surface-variant hover:bg-surface-container-high transition-colors w-16 h-14 rounded-lg" href="{{ route('dashboard') }}">
                <span class="material-symbols-outlined">home</span>
                <span class="text-[10px] font-bold mt-1">Beranda</span>
            </a>
            <a class="flex flex-col items-center justify-center text-on-surface-variant hover:bg-surface-container-high transition-colors w-16 h-14 rounded-lg" href="{{ route('transactions.index') }}">
                <span class="material-symbols-outlined">account_balance_wallet</span>
                <span class="text-[10px] font-bold mt-1">Transaksi</span>
            </a>
            <a class="flex flex-col items-center justify-center text-on-surface-variant hover:bg-surface-container-high transition-colors w-16 h-14 rounded-lg" href="{{ route('reports') }}">
                <span class="material-symbols-outlined">analytics</span>
                <span class="text-[10px] font-bold mt-1">Laporan</span>
            </a>
            <a class="flex flex-col items-center justify-center text-primary bg-secondary-container rounded-full px-4 py-1 hover:bg-surface-container-high transition-colors active:scale-95" href="{{ route('profile.edit') }}">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">settings</span>
                <span class="text-[10px] font-bold mt-1">Pengaturan</span>
            </a>
        </nav>
    </main>

    <!-- ============================================== -->
    <!-- MODALS AND POPUPS                              -->
    <!-- ============================================== -->

    <!-- Profile Edit Modal (Informasi Profil, Ganti Password, Hapus Akun) -->
    <div x-show="openProfileModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm" x-cloak x-transition>
        <div @click.away="openProfileModal = false" class="bg-white rounded-2xl w-full max-w-2xl overflow-hidden shadow-2xl flex flex-col md:flex-row min-h-[420px]" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
            <!-- Modal Sidebar Tabs -->
            <div class="w-full md:w-1/3 bg-surface-container-low border-r border-outline-variant p-4 flex flex-col gap-2">
                <h3 class="text-sm font-bold text-primary uppercase tracking-wider mb-4 px-2">Pengaturan Akun</h3>
                
                <button @click="activeTab = 'profile'" :class="activeTab === 'profile' ? 'bg-primary text-white shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-high'" class="text-left w-full px-4 py-2.5 rounded-xl transition-all font-bold text-xs flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">person</span>
                    Edit Profil
                </button>
                <button @click="activeTab = 'password'" :class="activeTab === 'password' ? 'bg-primary text-white shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-high'" class="text-left w-full px-4 py-2.5 rounded-xl transition-all font-bold text-xs flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">lock</span>
                    Ganti Password
                </button>
                <button @click="activeTab = 'delete'" :class="activeTab === 'delete' ? 'bg-error text-white shadow-sm' : 'text-error hover:bg-error-container/20'" class="text-left w-full px-4 py-2.5 rounded-xl transition-all font-bold text-xs flex items-center gap-2 border border-error/10">
                    <span class="material-symbols-outlined text-[18px]">delete</span>
                    Hapus Akun
                </button>
                
                <button @click="openProfileModal = false" class="mt-auto text-left w-full px-4 py-2.5 rounded-xl hover:bg-surface-container-high text-on-surface-variant font-bold text-xs flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                    Tutup
                </button>
            </div>
            
            <!-- Modal Content Pane -->
            <div class="w-full md:w-2/3 p-6 overflow-y-auto max-h-[500px]">
                <!-- Edit Profile Form -->
                <div x-show="activeTab === 'profile'" x-transition>
                    @include('profile.partials.update-profile-information-form')
                </div>
                
                <!-- Update Password Form -->
                <div x-show="activeTab === 'password'" x-transition>
                    @include('profile.partials.update-password-form')
                </div>
                
                <!-- Delete Account Form -->
                <div x-show="activeTab === 'delete'" x-transition>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div x-show="openAddCategory" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm" x-cloak x-transition>
        <div @click.away="openAddCategory = false" class="bg-white rounded-2xl w-full max-w-md overflow-hidden shadow-2xl p-6" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
            <h3 class="text-lg font-bold text-primary mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined">category</span> Tambah Kategori Baru
            </h3>
            <form method="POST" action="{{ route('categories.store') }}">
                @csrf
                <div class="mb-4">
                    <label for="cat_name" class="block text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1">Nama Kategori</label>
                    <input type="text" id="cat_name" name="name" required max="50" class="w-full border-outline-variant focus:border-primary focus:ring-primary rounded-xl shadow-sm text-sm" placeholder="Contoh: Makan & Minum">
                </div>
                <div class="mb-6">
                    <label for="cat_type" class="block text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1">Tipe Kategori</label>
                    <select id="cat_type" name="type" required class="w-full border-outline-variant focus:border-primary focus:ring-primary rounded-xl shadow-sm text-sm">
                        <option value="expense">Pengeluaran (Expense)</option>
                        <option value="income">Pemasukan (Income)</option>
                    </select>
                </div>
                <div class="flex items-center justify-end gap-2">
                    <button type="button" @click="openAddCategory = false" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-2 px-4 rounded-lg transition text-sm">Batal</button>
                    <button type="submit" class="bg-primary text-white hover:bg-primary-container font-bold py-2 px-4 rounded-lg transition text-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div x-show="openEditCategory" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm" x-cloak x-transition>
        <div @click.away="openEditCategory = false" class="bg-white rounded-2xl w-full max-w-md overflow-hidden shadow-2xl p-6" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
            <h3 class="text-lg font-bold text-primary mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined">edit</span> Edit Kategori
            </h3>
            <form method="POST" :action="`/categories/${editCatId}`">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="edit_cat_name" class="block text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1">Nama Kategori</label>
                    <input type="text" id="edit_cat_name" name="name" x-model="editCatName" required max="50" class="w-full border-outline-variant focus:border-primary focus:ring-primary rounded-xl shadow-sm text-sm">
                </div>
                <div class="mb-6">
                    <label for="edit_cat_type" class="block text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1">Tipe Kategori</label>
                    <select id="edit_cat_type" name="type" x-model="editCatType" required class="w-full border-outline-variant focus:border-primary focus:ring-primary rounded-xl shadow-sm text-sm">
                        <option value="expense">Pengeluaran (Expense)</option>
                        <option value="income">Pemasukan (Income)</option>
                    </select>
                </div>
                <div class="flex items-center justify-end gap-2">
                    <button type="button" @click="openEditCategory = false" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-2 px-4 rounded-lg transition text-sm">Batal</button>
                    <button type="submit" class="bg-primary text-white hover:bg-primary-container font-bold py-2 px-4 rounded-lg transition text-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
