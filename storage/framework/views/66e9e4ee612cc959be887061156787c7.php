<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Kostly')); ?> - <?php echo e($title ?? 'Dashboard'); ?></title>

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
        ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #9ca3af; }
        
        /* Smooth transitions */
        * {
            transition: background-color 0.2s ease, color 0.2s ease, transform 0.2s ease;
        }
        
        /* Card shadow for native feel */
        .card-shadow {
            box-shadow: 0 4px 16px rgba(124, 58, 237, 0.08), 0 2px 8px rgba(124, 58, 237, 0.04);
        }
        
        .card-shadow-lg {
            box-shadow: 0 8px 24px rgba(124, 58, 237, 0.12), 0 4px 12px rgba(124, 58, 237, 0.06);
        }
        
        /* FAB animation */
        .fab {
            box-shadow: 0 8px 24px rgba(124, 58, 237, 0.3);
            animation: fab-pulse 2s ease-in-out infinite;
        }
        
        @keyframes fab-pulse {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-4px) scale(1.02); }
        }
        
        .fab:active {
            transform: scale(0.95) !important;
        }
        
        /* Page transition */
        .page-transition {
            animation: fadeIn 0.3s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Bottom nav gradient effect */
        .bottom-nav-gradient {
            background: linear-gradient(to top, rgba(255,255,255,0.98), rgba(255,255,255,0.95));
            backdrop-filter: blur(10px);
        }
    </style>

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-background text-on-surface antialiased overflow-x-hidden">
    
    <!-- Desktop Sidebar (hidden on mobile) -->
    <aside class="hidden lg:block fixed left-0 top-0 h-screen w-64 bg-white border-r border-outline-variant z-40">
        <div class="flex flex-col h-full">
            <!-- Logo -->
            <div class="p-6 border-b border-outline-variant">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-primary to-primary-dark flex items-center justify-center">
                        <span class="text-white font-bold text-xl">K</span>
                    </div>
                    <div>
                        <h1 class="font-headline-md text-headline-md text-primary">Kostly</h1>
                        <p class="text-xs text-on-surface-variant">Expense Tracker</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-2">
                <a href="<?php echo e(route('dashboard')); ?>" 
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-surface-container transition-colors <?php echo e(request()->routeIs('dashboard') ? 'bg-primary-container text-primary' : 'text-on-surface-variant'); ?>">
                    <span class="material-symbols-outlined">grid_view</span>
                    <span class="font-semibold">Beranda</span>
                </a>

                <a href="<?php echo e(route('transactions.index')); ?>" 
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-surface-container transition-colors <?php echo e(request()->routeIs('transactions.*') ? 'bg-primary-container text-primary' : 'text-on-surface-variant'); ?>">
                    <span class="material-symbols-outlined">add_circle</span>
                    <span class="font-semibold">Catat Transaksi</span>
                </a>

                <a href="<?php echo e(route('reports')); ?>" 
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-surface-container transition-colors <?php echo e(request()->routeIs('reports') ? 'bg-primary-container text-primary' : 'text-on-surface-variant'); ?>">
                    <span class="material-symbols-outlined">bar_chart</span>
                    <span class="font-semibold">Laporan</span>
                </a>

                <a href="<?php echo e(route('profile.edit')); ?>" 
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-surface-container transition-colors <?php echo e(request()->routeIs('profile.*') ? 'bg-primary-container text-primary' : 'text-on-surface-variant'); ?>">
                    <span class="material-symbols-outlined">settings</span>
                    <span class="font-semibold">Pengaturan</span>
                </a>
            </nav>

            <!-- User Profile -->
            <div class="p-4 border-t border-outline-variant">
                <div class="flex items-center gap-3 p-3 hover:bg-surface-container rounded-2xl cursor-pointer transition-colors">
                    <div class="w-10 h-10 rounded-full bg-primary-container text-primary flex items-center justify-center font-bold">
                        <?php echo e(strtoupper(substr(Auth::user()->name ?? 'U', 0, 1))); ?>

                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-on-surface text-sm truncate"><?php echo e(Auth::user()->name ?? 'User'); ?></p>
                        <p class="text-xs text-on-surface-variant truncate"><?php echo e(Auth::user()->email ?? ''); ?></p>
                    </div>
                </div>
                <form method="POST" action="<?php echo e(route('logout')); ?>" class="mt-2">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="w-full text-left px-3 py-2 text-on-surface-variant hover:bg-surface-container rounded-2xl transition-colors flex items-center gap-2 text-sm">
                        <span class="material-symbols-outlined text-lg">logout</span>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="pb-20 lg:pb-8 lg:ml-64 min-h-screen page-transition">
        <!-- Desktop Top Bar -->
        <div class="hidden lg:block bg-white border-b border-outline-variant sticky top-0 z-30">
            <div class="px-8 py-4">
                <div class="flex items-center justify-between">
                    <h2 class="font-headline-lg text-headline-lg text-primary"><?php echo e($title ?? 'Dashboard'); ?></h2>
                    <div class="flex items-center gap-3">
                        <button class="w-10 h-10 rounded-full hover:bg-surface-container flex items-center justify-center transition-colors">
                            <span class="material-symbols-outlined text-on-surface-variant">notifications</span>
                        </button>
                        <button class="w-10 h-10 rounded-full hover:bg-surface-container flex items-center justify-center transition-colors">
                            <span class="material-symbols-outlined text-on-surface-variant">help</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="lg:px-8 lg:py-6">
            <?php echo e($slot); ?>

        </div>
    </main>

    <!-- Mobile Bottom Navigation (hidden on desktop) -->
    <nav class="lg:hidden fixed bottom-0 left-0 right-0 bottom-nav-gradient border-t border-outline-variant z-50 safe-area-bottom">
        <div class="max-w-lg mx-auto px-2 py-2">
            <div class="grid grid-cols-4 gap-1 items-center relative">
                
                <!-- Beranda (Home) -->
                <a href="<?php echo e(route('dashboard')); ?>" 
                   class="flex flex-col items-center justify-center gap-1 py-2 px-2 rounded-2xl transition-all duration-200 <?php echo e(request()->routeIs('dashboard') ? 'bg-primary-container' : ''); ?>"
                   onclick="handleNavClick(event)">
                    <span class="material-symbols-outlined text-2xl <?php echo e(request()->routeIs('dashboard') ? 'text-primary' : 'text-on-surface-variant'); ?>">grid_view</span>
                    <span class="text-[10px] font-semibold <?php echo e(request()->routeIs('dashboard') ? 'text-primary' : 'text-on-surface-variant'); ?>">Beranda</span>
                </a>

                <!-- Catat (Transactions) -->
                <a href="<?php echo e(route('transactions.index')); ?>" 
                   class="flex flex-col items-center justify-center gap-1 py-2 px-2 rounded-2xl transition-all duration-200 <?php echo e(request()->routeIs('transactions.*') ? 'bg-primary-container' : ''); ?>"
                   onclick="handleNavClick(event)">
                    <span class="material-symbols-outlined text-2xl <?php echo e(request()->routeIs('transactions.*') ? 'text-primary' : 'text-on-surface-variant'); ?>">add_circle</span>
                    <span class="text-[10px] font-semibold <?php echo e(request()->routeIs('transactions.*') ? 'text-primary' : 'text-on-surface-variant'); ?>">Catat</span>
                </a>

                <!-- Laporan (Reports) -->
                <a href="<?php echo e(route('reports')); ?>" 
                   class="flex flex-col items-center justify-center gap-1 py-2 px-2 rounded-2xl transition-all duration-200 <?php echo e(request()->routeIs('reports') ? 'bg-primary-container' : ''); ?>"
                   onclick="handleNavClick(event)">
                    <span class="material-symbols-outlined text-2xl <?php echo e(request()->routeIs('reports') ? 'text-primary' : 'text-on-surface-variant'); ?>">bar_chart</span>
                    <span class="text-[10px] font-semibold <?php echo e(request()->routeIs('reports') ? 'text-primary' : 'text-on-surface-variant'); ?>">Laporan</span>
                </a>

                <!-- Pengaturan (Settings) -->
                <a href="<?php echo e(route('profile.edit')); ?>" 
                   class="flex flex-col items-center justify-center gap-1 py-2 px-2 rounded-2xl transition-all duration-200 <?php echo e(request()->routeIs('profile.*') ? 'bg-primary-container' : ''); ?>"
                   onclick="handleNavClick(event)">
                    <span class="material-symbols-outlined text-2xl <?php echo e(request()->routeIs('profile.*') ? 'text-primary' : 'text-on-surface-variant'); ?>">settings</span>
                    <span class="text-[10px] font-semibold <?php echo e(request()->routeIs('profile.*') ? 'text-primary' : 'text-on-surface-variant'); ?>">Pengaturan</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Navigation Click Handler Script -->
    <script>
        function handleNavClick(event) {
            // Only apply transition on mobile
            if (window.innerWidth < 1024) {
                event.preventDefault();
                const href = event.currentTarget.href;
                
                document.querySelector('main').style.opacity = '0';
                document.querySelector('main').style.transform = 'translateY(10px)';
                
                setTimeout(() => {
                    window.location.href = href;
                }, 200);
            }
        }
    </script>

    <!-- Additional Scripts Stack -->
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\alfat\OneDrive\Documents\semester 4\prakpemrograman\asn_pemrograman_web\resources\views/components/mobile-layout.blade.php ENDPATH**/ ?>