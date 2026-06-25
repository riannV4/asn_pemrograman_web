<?php if (isset($component)) { $__componentOriginal8b1a96032cb10664afbc3f43162d0ab6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8b1a96032cb10664afbc3f43162d0ab6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.mobile-app','data' => ['currentPage' => 'dashboard']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.mobile-app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['currentPage' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('dashboard')]); ?>
    <div class="min-h-screen bg-gradient-to-br from-primary/5 via-background to-secondary/5 px-4 py-6 lg:px-8 lg:py-8">
        <!-- App Header with Logo -->
        <div class="mb-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <!-- Logo -->
                <div class="w-12 h-12 bg-gradient-to-br from-primary to-primary-dark rounded-full flex items-center justify-center shadow-card">
                    <span class="material-symbols-rounded text-white text-2xl" style="font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;">account_balance_wallet</span>
                </div>

                <!-- App Name -->
                <div>
                    <h1 class="text-headline-md font-bold text-primary">Kostly Tracker</h1>
                    <p class="text-xs text-on-surface-variant"><?php echo e(\Carbon\Carbon::now()->isoFormat('dddd, D MMMM YYYY')); ?></p>
                </div>
            </div>

            <!-- User Avatar -->
            <div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center text-primary font-bold">
                <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

            </div>
        </div>

        <!-- Main Balance Card with Large Rounded Corners -->
        <div class="bg-gradient-to-br from-primary to-primary-dark rounded-card p-6 lg:p-8 mb-6 relative overflow-hidden shadow-card">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-8 -mt-8"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full -ml-6 -mb-6"></div>

            <div class="relative z-10">
                <div class="flex items-center gap-2 text-white/80 mb-3">
                    <span class="material-symbols-rounded text-xl">account_balance_wallet</span>
                    <span class="text-xs font-bold uppercase tracking-wider">Total Saldo</span>
                </div>
                <h3 class="text-display-currency text-white mb-6">Rp <?php echo e(number_format($balance, 0, ',', '.')); ?></h3>

                <!-- Income & Expense Summary -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white/10 backdrop-blur-sm rounded-button p-4">
                        <div class="flex items-center gap-2 text-white/70 mb-2">
                            <span class="material-symbols-rounded text-sm">arrow_downward</span>
                            <span class="text-xs font-semibold">Pemasukan</span>
                        </div>
                        <p class="text-white font-bold text-lg">Rp <?php echo e(number_format($totalIncome, 0, ',', '.')); ?></p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-button p-4">
                        <div class="flex items-center gap-2 text-white/70 mb-2">
                            <span class="material-symbols-rounded text-sm">arrow_upward</span>
                            <span class="text-xs font-semibold">Pengeluaran</span>
                        </div>
                        <p class="text-white font-bold text-lg">Rp <?php echo e(number_format($totalExpense, 0, ',', '.')); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tren Pengeluaran Chart -->
        <div class="bg-surface rounded-card p-6 lg:p-8 mb-6 shadow-card">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-headline-md font-semibold text-on-surface">Tren Pengeluaran</h3>
            </div>
            <div style="position: relative; height: 220px;">
                <canvas id="dailyTrendChart"></canvas>
            </div>
        </div>

        <!-- Top Categories with Color-Coded -->
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
        <?php if($topCategories->isNotEmpty()): ?>
            <div class="bg-surface rounded-card p-6 shadow-card">
                <h3 class="text-headline-md font-semibold text-on-surface mb-4">Top Kategori Pengeluaran</h3>
                <div class="space-y-3">
                    <?php
                        $colors = ['#7c3aed', '#8b5cf6', '#a78bfa', '#c4b5fd', '#ddd6fe'];
                    ?>
                    <?php $__currentLoopData = $topCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center gap-3 p-3 hover:bg-surface-container rounded-button transition-colors">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-white" style="background: <?php echo e($colors[$index % 5]); ?>;">
                                <?php echo e($index + 1); ?>

                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-body-lg font-semibold text-on-surface truncate"><?php echo e($category['category_name']); ?></p>
                                <p class="text-xs text-on-surface-variant"><?php echo e($category['count']); ?> transaksi</p>
                            </div>
                            <div class="text-right">
                                <p class="text-body-lg font-bold text-on-surface whitespace-nowrap">Rp <?php echo e(number_format($category['total'], 0, ',', '.')); ?></p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Recent Transactions -->
        <div class="bg-surface rounded-card p-6 shadow-card">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-headline-md font-semibold text-on-surface">Transaksi Terakhir</h3>
                <a href="<?php echo e(route('transactions.index')); ?>" class="text-primary text-sm font-semibold">Lihat Semua</a>
            </div>
            <?php if($recentTransactions->isEmpty()): ?>
                <div class="text-center py-12">
                    <span class="material-symbols-rounded text-6xl text-on-surface-variant opacity-30">receipt_long</span>
                    <p class="mt-4 text-on-surface-variant text-body-md">Belum ada transaksi</p>
                    <a href="<?php echo e(route('transactions.create')); ?>" class="mt-3 inline-flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-full font-semibold text-sm hover:bg-primary-dark transition-colors">
                        <span class="material-symbols-rounded text-lg">add</span>
                        Tambah Transaksi
                    </a>
                </div>
            <?php else: ?>
                <div class="space-y-3">
                    <?php $__currentLoopData = $recentTransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center gap-3 p-3 hover:bg-surface-container rounded-button transition-colors">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center <?php echo e($transaction->type === 'income' ? 'bg-success-container text-success' : 'bg-primary-container text-primary'); ?>">
                                <span class="material-symbols-rounded"><?php echo e($transaction->type === 'income' ? 'arrow_downward' : 'arrow_upward'); ?></span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-body-lg font-semibold text-on-surface truncate">
                                    <?php echo e($transaction->notes ?: ($transaction->category ? $transaction->category->name : 'Transaksi')); ?>

                                </p>
                                <p class="text-xs text-on-surface-variant">
                                    <?php echo e($transaction->transaction_date->format('d M Y')); ?> - <?php echo e($transaction->category ? $transaction->category->name : '-'); ?>

                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-body-lg font-bold <?php echo e($transaction->type === 'income' ? 'text-success' : 'text-error'); ?> whitespace-nowrap">
                                    <?php echo e($transaction->type === 'income' ? '+' : '-'); ?> Rp <?php echo e(number_format($transaction->amount, 0, ',', '.')); ?>

                                </p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
    <script>
        const trendCanvas = document.getElementById('dailyTrendChart');

        if (trendCanvas) {
            new Chart(trendCanvas.getContext('2d'), {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($trendChartData['labels'], 15, 512) ?>,
                    datasets: [{
                        label: 'Pengeluaran',
                        data: <?php echo json_encode($trendChartData['data'], 15, 512) ?>,
                        backgroundColor: 'rgba(124, 58, 237, 0.12)',
                        borderColor: 'rgba(109, 40, 217, 1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: 'rgba(109, 40, 217, 1)',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            enabled: true,
                            backgroundColor: 'rgba(124, 58, 237, 0.95)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            padding: 12,
                            borderRadius: 12,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }
    </script>
    <?php $__env->stopPush(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8b1a96032cb10664afbc3f43162d0ab6)): ?>
<?php $attributes = $__attributesOriginal8b1a96032cb10664afbc3f43162d0ab6; ?>
<?php unset($__attributesOriginal8b1a96032cb10664afbc3f43162d0ab6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8b1a96032cb10664afbc3f43162d0ab6)): ?>
<?php $component = $__componentOriginal8b1a96032cb10664afbc3f43162d0ab6; ?>
<?php unset($__componentOriginal8b1a96032cb10664afbc3f43162d0ab6); ?>
<?php endif; ?>
<?php /**PATH C:\Users\alfat\Favorites\asn_pemrograman_web\resources\views/dashboard.blade.php ENDPATH**/ ?>