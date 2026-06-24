<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Tracker Kostly - Kelola Uang Kost dengan Mudah</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Material Symbols -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <style>
        /* Custom Button Styles */
        .btn {
            @apply px-6 py-3 rounded-xl font-semibold transition-all duration-200 inline-block text-center;
        }

        .btn-primary {
            @apply bg-gradient-to-r from-primary to-primary-dark text-white shadow-lg hover:shadow-xl hover:scale-105;
        }

        .btn-secondary {
            @apply bg-transparent border-2 border-primary text-primary hover:bg-primary hover:text-white;
        }

        .btn-large {
            @apply px-8 py-4 text-lg;
        }

        /* Elevated Card Button (Hero CTA) */
        .btn-elevated {
            display: inline-block;
            padding: 1.25rem 2.5rem;
            font-size: 1.25rem;
            font-weight: 700;
            text-align: center;
            color: white;
            background: linear-gradient(to right, #7c3aed, #6d28d9, #7c3aed);
            border-radius: 1rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-elevated:hover {
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 30px 60px -12px rgba(124, 58, 237, 0.4);
        }

        /* Responsive elevated button */
        @media (max-width: 640px) {
            .btn-elevated {
                padding: 1rem 2rem;
                font-size: 1.125rem;
            }
        }

        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Material Icons Fill */
        .material-symbols-rounded {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <!-- Header Navigation -->
    <header class="fixed top-0 w-full bg-white/80 backdrop-blur-md z-50 border-b border-outline-variant">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center">
                <!-- Logo & Brand Only -->
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-primary to-primary-dark rounded-full flex items-center justify-center shadow-md">
                        <span class="material-symbols-rounded text-white text-2xl">account_balance_wallet</span>
                    </div>
                    <span class="text-xl font-bold text-primary">Tracker Kostly</span>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="min-h-screen bg-gradient-to-br from-primary/5 via-background to-secondary/5 pt-24 px-4 flex items-center">
        <div class="max-w-4xl mx-auto text-center py-12 sm:py-20">
            <!-- Hero Icon -->
            <div class="w-20 h-20 sm:w-24 sm:h-24 bg-gradient-to-br from-primary to-primary-dark rounded-full flex items-center justify-center mx-auto mb-6 sm:mb-8 shadow-xl animate-pulse">
                <span class="material-symbols-rounded text-white text-4xl sm:text-5xl">account_balance_wallet</span>
            </div>
            
            <!-- Hero Text -->
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-primary mb-4 sm:mb-6 leading-tight">
                Kelola Uang Kost dengan Mudah
            </h1>
            <p class="text-base sm:text-lg md:text-xl text-on-surface-variant mb-8 sm:mb-10 max-w-2xl mx-auto px-4">
                Tracker Kostly membantu anak kost mencatat dan memantau keuangan harian dengan simpel dan praktis
            </p>
            
            <!-- CTA Button (Single - Elevated Card) -->
            <div class="flex justify-center px-4">
                <a href="<?php echo e(route('login')); ?>" class="btn-elevated">
                    Mulai Sekarang
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-surface py-16 sm:py-20 px-4">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-center text-on-surface mb-12 sm:mb-16">
                Fitur Unggulan
            </h2>
            
            <!-- Features Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
                <!-- Feature 1: Catat Transaksi -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300 text-center">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="material-symbols-rounded text-primary text-3xl">receipt_long</span>
                    </div>
                    <h3 class="text-xl font-bold text-on-surface mb-3">Catat Transaksi</h3>
                    <p class="text-on-surface-variant">Catat pemasukan dan pengeluaran harian dengan cepat dan mudah</p>
                </div>
                
                <!-- Feature 2: Grafik & Statistik -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300 text-center">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="material-symbols-rounded text-primary text-3xl">trending_up</span>
                    </div>
                    <h3 class="text-xl font-bold text-on-surface mb-3">Grafik & Statistik</h3>
                    <p class="text-on-surface-variant">Pantau tren keuangan dengan visualisasi grafik yang jelas</p>
                </div>
                
                <!-- Feature 3: Kategori Otomatis -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300 text-center">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="material-symbols-rounded text-primary text-3xl">category</span>
                    </div>
                    <h3 class="text-xl font-bold text-on-surface mb-3">Kategori Otomatis</h3>
                    <p class="text-on-surface-variant">Kelompokkan transaksi berdasarkan kategori untuk analisis lebih baik</p>
                </div>
                
                <!-- Feature 4: Catat dengan Suara -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300 text-center">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="material-symbols-rounded text-primary text-3xl">mic</span>
                    </div>
                    <h3 class="text-xl font-bold text-on-surface mb-3">Catat dengan Suara</h3>
                    <p class="text-on-surface-variant">Catat transaksi dengan perintah suara untuk pengalaman yang lebih cepat</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-surface-container py-8 px-4 border-t border-outline-variant">
        <div class="max-w-7xl mx-auto text-center">
            <div class="flex items-center justify-center gap-2 mb-3">
                <div class="w-8 h-8 bg-gradient-to-br from-primary to-primary-dark rounded-full flex items-center justify-center">
                    <span class="material-symbols-rounded text-white text-lg">account_balance_wallet</span>
                </div>
                <span class="font-bold text-primary">Tracker Kostly</span>
            </div>
            <p class="text-on-surface-variant text-sm">
                © <?php echo e(date('Y')); ?> Tracker Kostly. Semua hak dilindungi.
            </p>
        </div>
    </footer>
</body>
</html>
<?php /**PATH E:\asn_pemrograman_web\asn_pemrograman_web\resources\views/welcome.blade.php ENDPATH**/ ?>