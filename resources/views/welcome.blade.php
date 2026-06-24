<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tracker Kostly - Kelola Uang Kost dengan Mudah</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    
    <!-- Material Symbols -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Custom Button Styles */
        .btn {
            @apply px-6 py-3 rounded-xl font-semibold transition-all duration-200 inline-block text-center;
        }

        /* Custom Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Infinite Marquee Animation */
        @keyframes marquee {
            0% { transform: translateX(0%); }
            100% { transform: translateX(-50%); }
        }
        .animate-marquee {
            animation: marquee 25s linear infinite;
        }
        .mask-marquee {
            mask-image: linear-gradient(to right, transparent, black 15%, black 85%, transparent);
            -webkit-mask-image: linear-gradient(to right, transparent, black 15%, black 85%, transparent);
        }

        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Material Icons Fill */
        .material-symbols-rounded {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="font-sans antialiased bg-background text-on-background">
    <!-- Header Navigation -->
    <header class="sticky top-0 w-full bg-surface/80 border-b border-outline-variant shadow-sm z-50 transition-all duration-300" style="backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
            <!-- Logo & Brand -->
            <a href="#" class="flex items-center gap-2 group">
                <div class="w-9 h-9 bg-primary rounded-lg flex items-center justify-center shadow-md group-hover:scale-105 transition-transform">
                    <span class="material-symbols-rounded text-white text-xl">account_balance_wallet</span>
                </div>
                <span class="text-lg font-bold text-primary font-sans">Kostly</span>
            </a>
            
            <!-- Mid Nav Links -->
            <div class="hidden sm:flex items-center gap-8">
                <a href="#tentang" class="text-on-surface/80 hover:text-primary font-semibold transition-colors duration-200">Tentang</a>
                <a href="#features" class="text-on-surface/80 hover:text-primary font-semibold transition-colors duration-200">Fitur</a>
            </div>
            
            <!-- Right CTA Actions -->
            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-primary text-white rounded-lg font-semibold hover:bg-primary-dark transition shadow-sm hover:shadow">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-on-surface hover:text-primary font-semibold transition">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 bg-primary text-white rounded-lg font-semibold hover:bg-primary-dark transition shadow-sm hover:shadow">Daftar</a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>
        <!-- Mobile Navigation (visible only on small screens) -->
        <div class="flex sm:hidden justify-center gap-6 py-2.5 border-t border-outline-variant/30 bg-surface/50">
            <a href="#tentang" class="text-sm text-on-surface-variant hover:text-primary font-semibold transition">Tentang</a>
            <a href="#features" class="text-sm text-on-surface-variant hover:text-primary font-semibold transition">Fitur</a>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="min-h-screen bg-gradient-to-br from-background via-surface to-primary/5 pt-32 px-4 flex items-center">
        <div class="max-w-4xl mx-auto text-center py-12 sm:py-20">
            <!-- Hero Icon -->
            <div class="w-24 h-24 sm:w-32 sm:h-32 bg-gradient-to-br from-primary/10 to-primary/5 rounded-2xl flex items-center justify-center mx-auto mb-6 sm:mb-8 shadow-lg">
                <span class="material-symbols-rounded text-primary text-6xl sm:text-7xl">account_balance_wallet</span>
            </div>
            
            <!-- Hero Text -->
            <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-on-background mb-4 sm:mb-6 leading-tight tracking-tight">
                Kelola Keuangan<br><span class="text-primary">Dengan Mudah</span>
            </h1>
            <p class="text-lg sm:text-xl text-on-surface-variant mb-8 sm:mb-12 max-w-2xl mx-auto px-4 leading-relaxed">
                Catat, pantau, dan optimalkan pengeluaran Anda dengan dashboard modern dan intuitive. Percayakan kebutuhan finansial Anda pada Kostly.
            </p>
            
            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row justify-center gap-4 px-4">
                <a href="{{ route('register') }}" class="px-8 py-3 sm:py-4 bg-primary text-white rounded-xl font-semibold hover:bg-primary-dark transition-all duration-200 shadow-lg hover:shadow-xl">
                    Mulai Gratis
                </a>
                <a href="#features" class="px-8 py-3 sm:py-4 bg-surface border-2 border-primary text-primary rounded-xl font-semibold hover:bg-primary/5 transition-all duration-200">
                    Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
    </section>

    <!-- Tentang Section -->
    <section id="tentang" class="bg-background py-16 sm:py-24 px-4 border-b border-outline-variant/30">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Left Side: Content -->
            <div class="space-y-6 animate-fade-in-up">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/10 text-primary text-sm font-semibold">
                    <span class="material-symbols-rounded text-base">info</span>
                    Tentang Kostly
                </div>
                <h2 class="text-3xl sm:text-4xl font-bold text-on-background tracking-tight">
                    Solusi Cerdas Pengelolaan Finansial Anak Kost
                </h2>
                <p class="text-on-surface-variant leading-relaxed text-lg">
                    Kostly dirancang khusus untuk membantu mahasiswa dan pekerja rantau mengelola anggaran bulanan mereka. Kami memahami tantangan mengatur keuangan di tanah rantau, mulai dari bayar kost, makan harian, hingga tabungan darurat.
                </p>
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-full bg-success/15 flex items-center justify-center shrink-0 mt-1">
                            <span class="material-symbols-rounded text-success text-sm font-bold">check</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-on-surface">Pencatatan Otomatis & Cepat</h4>
                            <p class="text-sm text-on-surface-variant">Catat pengeluaran harian hanya dalam beberapa ketukan.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-full bg-success/15 flex items-center justify-center shrink-0 mt-1">
                            <span class="material-symbols-rounded text-success text-sm font-bold">check</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-on-surface">Alokasi Anggaran Teratur</h4>
                            <p class="text-sm text-on-surface-variant">Bagi uang saku bulanan ke pos-pos pengeluaran penting.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-full bg-success/15 flex items-center justify-center shrink-0 mt-1">
                            <span class="material-symbols-rounded text-success text-sm font-bold">check</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-on-surface">Visualisasi Real-Time</h4>
                            <p class="text-sm text-on-surface-variant">Analisis grafis interaktif untuk memantau kemana perginya uang Anda.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Side: Graphic Mockup -->
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-tr from-primary/10 to-transparent rounded-3xl blur-2xl -z-10"></div>
                <div class="bg-surface border border-outline-variant p-6 sm:p-8 rounded-card shadow-card hover:shadow-card-hover transition-all duration-300">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <span class="text-xs text-on-surface-variant block font-bold uppercase tracking-wider">Ringkasan Bulan Ini</span>
                            <h3 class="text-2xl font-bold text-on-surface">Sisa Saldo</h3>
                        </div>
                        <div class="px-3 py-1 bg-success/10 text-success rounded-full text-xs font-semibold">
                            Aman
                        </div>
                    </div>
                    
                    <div class="text-3xl font-extrabold text-primary mb-6">
                        Rp 1.450.000
                    </div>
                    
                    <div class="space-y-4">
                        <!-- Progress Bar -->
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-on-surface-variant">Batas Anggaran Makan</span>
                                <span class="font-bold text-on-surface">Rp 600.000 / Rp 1.000.000</span>
                            </div>
                            <div class="w-full bg-surface-container rounded-full h-2">
                                <div class="bg-primary h-2 rounded-full" style="width: 60%"></div>
                            </div>
                        </div>
                        
                        <!-- Mini transaction items -->
                        <div class="pt-2 border-t border-outline-variant/50 space-y-3">
                            <div class="flex justify-between items-center text-sm">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-error"></span>
                                    <span class="text-on-surface">Laundry Kiloan</span>
                                </div>
                                <span class="font-semibold text-error">-Rp 25.000</span>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-success"></span>
                                    <span class="text-on-surface">Kiriman Bulanan</span>
                                </div>
                                <span class="font-semibold text-success">+Rp 2.000.000</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="bg-surface py-16 sm:py-24 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-4xl sm:text-5xl font-bold text-on-background mb-4">Fitur Unggulan</h2>
                <p class="text-lg text-on-surface-variant max-w-2xl mx-auto">Semua yang Anda butuhkan untuk mengelola keuangan dengan lebih baik</p>
            </div>
            
            <!-- Features Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
                <!-- Feature 1 -->
                <div class="bg-surface-container rounded-2xl p-6 hover:shadow-lg transition-all duration-300 group">
                    <div class="w-14 h-14 bg-primary/10 group-hover:bg-primary/20 rounded-xl flex items-center justify-center mb-4 transition-colors">
                        <span class="material-symbols-rounded text-primary text-3xl">receipt_long</span>
                    </div>
                    <h3 class="text-xl font-bold text-on-surface mb-2">Catat Transaksi</h3>
                    <p class="text-on-surface-variant">Catat pemasukan dan pengeluaran dengan cepat dan mudah</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-surface-container rounded-2xl p-6 hover:shadow-lg transition-all duration-300 group">
                    <div class="w-14 h-14 bg-primary/10 group-hover:bg-primary/20 rounded-xl flex items-center justify-center mb-4 transition-colors">
                        <span class="material-symbols-rounded text-primary text-3xl">trending_up</span>
                    </div>
                    <h3 class="text-xl font-bold text-on-surface mb-2">Analisis Mendalam</h3>
                    <p class="text-on-surface-variant">Visualisasi grafik dan statistik untuk pemahaman lebih baik</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="bg-surface-container rounded-2xl p-6 hover:shadow-lg transition-all duration-300 group">
                    <div class="w-14 h-14 bg-primary/10 group-hover:bg-primary/20 rounded-xl flex items-center justify-center mb-4 transition-colors">
                        <span class="material-symbols-rounded text-primary text-3xl">category</span>
                    </div>
                    <h3 class="text-xl font-bold text-on-surface mb-2">Kategori Fleksibel</h3>
                    <p class="text-on-surface-variant">Buat kategori sesuai kebutuhan Anda untuk organisasi sempurna</p>
                </div>
                
                <!-- Feature 4 -->
                <div class="bg-surface-container rounded-2xl p-6 hover:shadow-lg transition-all duration-300 group">
                    <div class="w-14 h-14 bg-primary/10 group-hover:bg-primary/20 rounded-xl flex items-center justify-center mb-4 transition-colors">
                        <span class="material-symbols-rounded text-primary text-3xl">dashboard</span>
                    </div>
                    <h3 class="text-xl font-bold text-on-surface mb-2">Dashboard Modern</h3>
                    <p class="text-on-surface-variant">Pantau keuangan Anda dengan dashboard intuitif dan responsif</p>
                </div>
            </div>
            
            <!-- Infinite Marquee Section -->
            <div class="mt-20 border-t border-outline-variant/30 pt-16">
                <p class="text-center text-xs font-bold uppercase tracking-widest text-on-surface-variant/80 mb-8">
                    DITENAGAI OLEH TEKNOLOGI MODERN
                </p>
                <div class="relative w-full overflow-hidden mask-marquee py-4">
                    <div class="flex gap-8 whitespace-nowrap animate-marquee">
                        <!-- Group 1 -->
                        <div class="flex items-center gap-8 shrink-0">
                            <!-- Laravel Badge -->
                            <div class="inline-flex items-center gap-3 bg-surface border border-outline-variant/60 px-5 py-3.5 rounded-xl shadow-sm hover:border-primary/40 hover:shadow transition duration-300">
                                <svg class="w-6 h-6 text-[#FF2D20] shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.085 10.2L12 5.518l-8.085 4.682v9.364L12 24.246l8.085-4.682V10.2zM12 7.79l5.962 3.456L12 14.704l-5.962-3.457L12 7.79zM5.962 12.872L11 15.79v5.836l-5.038-2.918v-5.836zm12.076 5.836L13 21.626v-5.837l5.038-2.917v5.836z" />
                                </svg>
                                <span class="font-bold text-on-surface text-sm font-sans tracking-tight">Laravel 11</span>
                            </div>
                            <!-- Tailwind CSS -->
                            <div class="inline-flex items-center gap-3 bg-surface border border-outline-variant/60 px-5 py-3.5 rounded-xl shadow-sm hover:border-primary/40 hover:shadow transition duration-300">
                                <svg class="w-6 h-6 text-[#38BDF8] shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.001 4.8c-3.2 0-5.2 1.6-6 4.8 1.2-1.6 2.6-2.2 4.2-1.8.913.228 1.565.89 2.288 1.624C13.666 10.618 15.027 12 18.001 12c3.2 0 5.2-1.6 6-4.8-1.2 1.6-2.6 2.2-4.2 1.8-.913-.228-1.565-.89-2.288-1.624C16.337 6.182 14.976 4.8 12.001 4.8zm-6 7.2c-3.2 0-5.2 1.6-6 4.8 1.2-1.6 2.6-2.2 4.2-1.8.913.228 1.565.89 2.288 1.624 1.177 1.194 2.538 2.576 5.512 2.576 3.2 0 5.2-1.6 6-4.8-1.2 1.6-2.6 2.2-4.2 1.8-.913-.228-1.565-.89-2.288-1.624C10.337 13.382 8.976 12 6.001 12z" />
                                </svg>
                                <span class="font-bold text-on-surface text-sm font-sans tracking-tight">Tailwind CSS</span>
                            </div>
                            <!-- Alpine.js -->
                            <div class="inline-flex items-center gap-3 bg-surface border border-outline-variant/60 px-5 py-3.5 rounded-xl shadow-sm hover:border-primary/40 hover:shadow transition duration-300">
                                <svg class="w-6 h-6 text-[#77C1D2] shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5L2 11L8 17L14 11L8 5Z M16 5L10 11L16 17L22 11L16 5Z" />
                                </svg>
                                <span class="font-bold text-on-surface text-sm font-sans tracking-tight">Alpine.js</span>
                            </div>
                            <!-- Vite JS -->
                            <div class="inline-flex items-center gap-3 bg-surface border border-outline-variant/60 px-5 py-3.5 rounded-xl shadow-sm hover:border-primary/40 hover:shadow transition duration-300">
                                <svg class="w-6 h-6 text-[#646CFF] shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19.853 1.055a.5.5 0 00-.73-.539l-18 10a.5.5 0 00.198.924h6.398l-1.895 10.424a.5.5 0 00.865.414l13.5-16.5a.5.5 0 00-.336-.723H12.5l7.353-4.076z" />
                                </svg>
                                <span class="font-bold text-on-surface text-sm font-sans tracking-tight">Vite JS</span>
                            </div>
                            <!-- MySQL -->
                            <div class="inline-flex items-center gap-3 bg-surface border border-outline-variant/60 px-5 py-3.5 rounded-xl shadow-sm hover:border-primary/40 hover:shadow transition duration-300">
                                <svg class="w-6 h-6 text-[#4479A1] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                                </svg>
                                <span class="font-bold text-on-surface text-sm font-sans tracking-tight">MySQL</span>
                            </div>
                            <!-- PHP 8.2 -->
                            <div class="inline-flex items-center gap-3 bg-surface border border-outline-variant/60 px-5 py-3.5 rounded-xl shadow-sm hover:border-primary/40 hover:shadow transition duration-300">
                                <svg class="w-6 h-6 text-[#777BB4] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="font-bold text-on-surface text-sm font-sans tracking-tight">PHP 8.2</span>
                            </div>
                        </div>
                        
                        <!-- Group 2 (Duplicate for infinite seamless scroll) -->
                        <div class="flex items-center gap-8 shrink-0">
                            <!-- Laravel Badge -->
                            <div class="inline-flex items-center gap-3 bg-surface border border-outline-variant/60 px-5 py-3.5 rounded-xl shadow-sm hover:border-primary/40 hover:shadow transition duration-300">
                                <svg class="w-6 h-6 text-[#FF2D20] shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.085 10.2L12 5.518l-8.085 4.682v9.364L12 24.246l8.085-4.682V10.2zM12 7.79l5.962 3.456L12 14.704l-5.962-3.457L12 7.79zM5.962 12.872L11 15.79v5.836l-5.038-2.918v-5.836zm12.076 5.836L13 21.626v-5.837l5.038-2.917v5.836z" />
                                </svg>
                                <span class="font-bold text-on-surface text-sm font-sans tracking-tight">Laravel 11</span>
                            </div>
                            <!-- Tailwind CSS -->
                            <div class="inline-flex items-center gap-3 bg-surface border border-outline-variant/60 px-5 py-3.5 rounded-xl shadow-sm hover:border-primary/40 hover:shadow transition duration-300">
                                <svg class="w-6 h-6 text-[#38BDF8] shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.001 4.8c-3.2 0-5.2 1.6-6 4.8 1.2-1.6 2.6-2.2 4.2-1.8.913.228 1.565.89 2.288 1.624C13.666 10.618 15.027 12 18.001 12c3.2 0 5.2-1.6 6-4.8-1.2 1.6-2.6 2.2-4.2 1.8-.913-.228-1.565-.89-2.288-1.624C16.337 6.182 14.976 4.8 12.001 4.8zm-6 7.2c-3.2 0-5.2 1.6-6 4.8 1.2-1.6 2.6-2.2 4.2-1.8.913.228 1.565.89 2.288 1.624 1.177 1.194 2.538 2.576 5.512 2.576 3.2 0 5.2-1.6 6-4.8-1.2 1.6-2.6 2.2-4.2 1.8-.913-.228-1.565-.89-2.288-1.624C10.337 13.382 8.976 12 6.001 12z" />
                                </svg>
                                <span class="font-bold text-on-surface text-sm font-sans tracking-tight">Tailwind CSS</span>
                            </div>
                            <!-- Alpine.js -->
                            <div class="inline-flex items-center gap-3 bg-surface border border-outline-variant/60 px-5 py-3.5 rounded-xl shadow-sm hover:border-primary/40 hover:shadow transition duration-300">
                                <svg class="w-6 h-6 text-[#77C1D2] shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5L2 11L8 17L14 11L8 5Z M16 5L10 11L16 17L22 11L16 5Z" />
                                </svg>
                                <span class="font-bold text-on-surface text-sm font-sans tracking-tight">Alpine.js</span>
                            </div>
                            <!-- Vite JS -->
                            <div class="inline-flex items-center gap-3 bg-surface border border-outline-variant/60 px-5 py-3.5 rounded-xl shadow-sm hover:border-primary/40 hover:shadow transition duration-300">
                                <svg class="w-6 h-6 text-[#646CFF] shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19.853 1.055a.5.5 0 00-.73-.539l-18 10a.5.5 0 00.198.924h6.398l-1.895 10.424a.5.5 0 00.865.414l13.5-16.5a.5.5 0 00-.336-.723H12.5l7.353-4.076z" />
                                </svg>
                                <span class="font-bold text-on-surface text-sm font-sans tracking-tight">Vite JS</span>
                            </div>
                            <!-- PostgreSQL -->
                            <div class="inline-flex items-center gap-3 bg-surface border border-outline-variant/60 px-5 py-3.5 rounded-xl shadow-sm hover:border-primary/40 hover:shadow transition duration-300">
                                <svg class="w-6 h-6 text-[#4479A1] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                                </svg>
                                <span class="font-bold text-on-surface text-sm font-sans tracking-tight">PostgreSQL</span>
                            </div>
                            <!-- PHP 8.2 -->
                            <div class="inline-flex items-center gap-3 bg-surface border border-outline-variant/60 px-5 py-3.5 rounded-xl shadow-sm hover:border-primary/40 hover:shadow transition duration-300">
                                <svg class="w-6 h-6 text-[#777BB4] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="font-bold text-on-surface text-sm font-sans tracking-tight">PHP 8.2</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-gradient-to-r from-primary to-primary-dark py-16 sm:py-20 px-4">
        <div class="max-w-3xl mx-auto text-center text-white">
            <h2 class="text-3xl sm:text-4xl font-bold mb-4">Siap Mengelola Keuangan Anda?</h2>
            <p class="text-lg mb-8 opacity-90">Bergabunglah dengan ribuan pengguna yang telah merasakan perubahan positif dalam pengelolaan keuangan mereka</p>
            <a href="{{ route('register') }}" class="px-8 py-3 bg-white text-primary rounded-xl font-bold hover:bg-surface transition-colors inline-block">
                Daftar Sekarang →
            </a>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="bg-on-background/5 py-8 px-4 border-t border-outline-variant">
        <div class="max-w-7xl mx-auto text-center">
            <div class="flex items-center justify-center gap-2 mb-3">
                <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center">
                    <span class="material-symbols-rounded text-white text-lg">account_balance_wallet</span>
                </div>
                <span class="font-bold text-primary">Kostly</span>
            </div>
            <p class="text-on-surface-variant text-sm">
                © {{ date('Y') }} Kostly. Kelola uang kost dengan mudah dan percaya diri.
            </p>
        </div>
    </footer>
</body>
</html>
