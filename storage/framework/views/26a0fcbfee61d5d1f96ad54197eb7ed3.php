<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Expense Tracker')); ?></title>

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
        
        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
    </head>
    <body class="font-sans antialiased bg-background">
        <div class="min-h-screen pb-16" x-data="appState()">
            <!-- Page Content -->
            <main class="max-w-md mx-auto">
                <?php echo e($slot); ?>

            </main>

            <!-- Bottom Navigation -->
            <?php echo $__env->make('components.layouts.bottom-nav', ['current' => $currentPage ?? 'dashboard'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
    </body>
</html>
<?php /**PATH D:\clone_git\asn_pemrograman_web\resources\views/components/layouts/mobile-app.blade.php ENDPATH**/ ?>