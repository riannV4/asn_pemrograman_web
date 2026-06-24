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
    <header class="fixed top-0 w-full bg-surface/95 backdrop-blur-md z-50 border-b border-outline-variant shadow-sm">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
            <!-- Logo & Brand -->
            <div class="flex items-center gap-2">
                <div class="w-9 h-9 bg-primary rounded-lg flex items-center justify-center shadow-md">
                    <span class="material-symbols-rounded text-white text-xl">account_balance_wallet</span>
                </div>
                <span class="text-lg font-bold text-primary">Kostly</span>
            </div>
            
            <!-- Nav Links -->
            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-on-surface hover:text-primary font-medium transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-on-surface hover:text-primary font-medium transition">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 bg-primary text-white rounded-lg font-medium hover:bg-primary-dark transition">Daftar</a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>
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
