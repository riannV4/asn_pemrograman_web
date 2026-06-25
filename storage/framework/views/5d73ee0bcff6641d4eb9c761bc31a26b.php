<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['currentPage' => 'dashboard']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['currentPage' => 'dashboard']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php
    $pageTitles = [
        'dashboard' => 'Dashboard',
        'transactions' => 'Transaksi',
        'create' => 'Transaksi',
        'reports' => 'Laporan',
        'profile' => 'Profil',
        'categories' => 'Kategori'
    ];
    $pageTitle = isset($pageTitles[$currentPage]) ? $pageTitles[$currentPage] : 'Dashboard';
?>
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e($pageTitle); ?> | <?php echo e(config('app.name', 'Kostly Tracker')); ?></title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="<?php echo e(asset('favicon.ico')); ?>" type="image/x-icon">
        <link rel="icon" href="<?php echo e(asset('favicon.ico')); ?>" type="image/x-icon">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('favicon-16x16.png')); ?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('favicon-32x32.png')); ?>">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('apple-touch-icon.png')); ?>">

        <!-- Metadata Website -->
        <meta name="application-name" content="Kostly Tracker">
        <meta name="apple-mobile-web-app-title" content="Kostly Tracker">
        <meta name="description" content="Aplikasi manajemen keuangan khusus anak kost untuk mencatat pemasukan, pengeluaran, dan memantau kondisi keuangan secara real-time.">

        <!-- SEO dan Social Preview -->
        <meta property="og:title" content="Kostly Tracker">
        <meta property="og:description" content="Aplikasi Manajemen Keuangan Anak Kost">
        <meta property="og:type" content="website">
        <meta property="og:url" content="<?php echo e(url()->current()); ?>">
        <meta name="twitter:card" content="summary_large_image">

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
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    </head>
    <body class="font-sans antialiased bg-background text-on-surface">
        <div class="min-h-screen lg:flex" x-data="appState()">
            <!-- Desktop Sidebar -->
            <aside class="hidden lg:flex lg:w-64 lg:shrink-0 lg:flex-col lg:sticky lg:top-0 lg:h-screen bg-primary border-r border-primary-dark shadow-card-hover text-white">
                <div class="p-6 border-b border-white/20">
                    <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-2xl bg-white text-primary flex items-center justify-center shadow-card">
                            <span class="material-symbols-rounded filled">account_balance_wallet</span>
                        </div>
                        <div class="min-w-0">
                            <h1 class="text-headline-md font-bold text-white truncate">Kostly Tracker</h1>
                            <p class="text-xs text-white/80 truncate">Anak Kost Management</p>
                        </div>
                    </a>
                </div>

                <?php
                    $desktopNavItems = [
                        ['page' => 'dashboard', 'route' => route('dashboard'), 'icon' => 'dashboard', 'label' => 'Dashboard', 'active' => in_array($currentPage ?? 'dashboard', ['dashboard'])],
                        ['page' => 'transactions', 'route' => route('transactions.index'), 'icon' => 'receipt_long', 'label' => 'Transaksi', 'active' => ($currentPage ?? 'dashboard') === 'transactions'],
                        ['page' => 'create', 'route' => route('transactions.create'), 'icon' => 'add_circle', 'label' => 'Catat', 'active' => ($currentPage ?? 'dashboard') === 'create'],
                        ['page' => 'reports', 'route' => route('reports'), 'icon' => 'bar_chart', 'label' => 'Laporan', 'active' => ($currentPage ?? 'dashboard') === 'reports'],
                        ['page' => 'profile', 'route' => route('profile.edit'), 'icon' => 'settings', 'label' => 'Pengaturan', 'active' => ($currentPage ?? 'dashboard') === 'profile'],
                    ];
                ?>

                <nav class="flex-1 px-3 py-5 space-y-1 overflow-y-auto">
                    <?php $__currentLoopData = $desktopNavItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($item['route']); ?>"
                           class="flex items-center gap-3 rounded-2xl px-4 py-3 transition-all duration-200 <?php echo e($item['active'] ? 'bg-white text-primary shadow-card font-bold' : 'text-white/85 hover:bg-white/20 hover:text-white'); ?>">
                            <span class="material-symbols-rounded <?php echo e($item['active'] ? 'filled' : ''); ?>"><?php echo e($item['icon']); ?></span>
                            <span class="text-body-md <?php echo e($item['active'] ? 'font-bold' : 'font-semibold'); ?>"><?php echo e($item['label']); ?></span>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </nav>

                <?php if(auth()->guard()->check()): ?>
                    <div class="p-4 border-t border-white/20">
                        <div class="flex items-center gap-3 rounded-2xl bg-white p-3 ring-1 ring-outline-variant shadow-card">
                            <div class="w-10 h-10 rounded-full bg-primary-container text-primary flex items-center justify-center font-bold shrink-0">
                                <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

                            </div>
                            <div class="min-w-0">
                                <p class="text-body-md font-bold text-on-surface truncate"><?php echo e(Auth::user()->name); ?></p>
                                <p class="text-xs text-on-surface-variant truncate"><?php echo e(Auth::user()->email); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </aside>

            <div class="min-w-0 flex-1 pb-16 lg:pb-0">
                <!-- Page Content -->
                <main class="w-full max-w-md mx-auto lg:max-w-none">
                    <?php echo e($slot); ?>

                </main>

                <!-- Bottom Navigation -->
                <?php echo $__env->make('components.layouts.bottom-nav', ['current' => $currentPage ?? 'dashboard'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
        </div>

        <script>
            function appState() {
                return {
                    currentPage: '<?php echo e($currentPage ?? 'dashboard'); ?>',
                    
                    navigateTo(page) {
                        this.currentPage = page;
                        
                        const routes = {
                            'dashboard': '<?php echo e(route('dashboard')); ?>',
                            'reports': '<?php echo e(route('reports')); ?>',
                            'profile': '<?php echo e(route('profile.edit')); ?>'
                        };
                        
                        if (routes[page]) {
                            window.location.href = routes[page];
                        }
                    }
                }
            }
        </script>
        <?php echo $__env->yieldPushContent('scripts'); ?>
    </body>
</html>
<?php /**PATH C:\Users\alfat\Favorites\asn_pemrograman_web\resources\views/components/layouts/mobile-app.blade.php ENDPATH**/ ?>