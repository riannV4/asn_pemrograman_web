<?php if (isset($component)) { $__componentOriginal8b1a96032cb10664afbc3f43162d0ab6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8b1a96032cb10664afbc3f43162d0ab6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.mobile-app','data' => ['currentPage' => 'reports']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.mobile-app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['currentPage' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('reports')]); ?>
    <div class="min-h-screen bg-gradient-to-br from-primary/5 via-background to-secondary/5 px-4 py-6">
        <div class="mb-6">
            <h2 class="text-headline-lg font-bold text-on-surface mb-1">Laporan Keuangan</h2>
            <p class="text-body-md text-on-surface-variant">Analisis pengeluaran dan pemasukan kamu</p>
        </div>

        <div class="bg-surface rounded-card p-6 mb-6 shadow-card">
            <h3 class="text-headline-md font-semibold text-on-surface mb-4">Filter Periode</h3>
            <form method="GET" action="<?php echo e(route('reports')); ?>" class="space-y-4">
                <div>
                    <label class="text-xs font-bold uppercase tracking-wider text-on-surface-variant mb-2 block">Pilih Periode</label>
                    <select id="filter" name="filter" class="w-full bg-surface-container border-2 border-outline rounded-button px-4 py-3 text-body-lg text-on-surface focus:border-primary focus:ring-0" onchange="toggleCustomDate(this.value)">
                        <option value="weekly" <?php echo e($filterType === 'weekly' ? 'selected' : ''); ?>>Mingguan</option>
                        <option value="monthly" <?php echo e($filterType === 'monthly' ? 'selected' : ''); ?>>Bulanan</option>
                        <option value="custom" <?php echo e($filterType === 'custom' ? 'selected' : ''); ?>>Custom</option>
                    </select>
                </div>

                <div id="custom-date-range" class="<?php echo e($filterType === 'custom' ? '' : 'hidden'); ?> space-y-3">
                    <div>
                        <label class="text-xs font-bold uppercase tracking-wider text-on-surface-variant mb-2 block">Tanggal Mulai</label>
                        <input type="date" id="start_date" name="start_date" value="<?php echo e($filterType === 'custom' && $startDate ? $startDate->format('Y-m-d') : ''); ?>" class="w-full bg-surface-container border-2 border-outline rounded-button px-4 py-3 text-body-lg text-on-surface focus:border-primary focus:ring-0">
                    </div>
                    <div>
                        <label class="text-xs font-bold uppercase tracking-wider text-on-surface-variant mb-2 block">Tanggal Akhir</label>
                        <input type="date" id="end_date" name="end_date" value="<?php echo e($filterType === 'custom' && $endDate ? $endDate->format('Y-m-d') : ''); ?>" class="w-full bg-surface-container border-2 border-outline rounded-button px-4 py-3 text-body-lg text-on-surface focus:border-primary focus:ring-0">
                    </div>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-primary to-primary-dark text-white font-bold py-3 rounded-button hover:shadow-card-hover transition-all shadow-card">
                    Terapkan Filter
                </button>
            </form>

            <div class="mt-4 text-xs text-on-surface-variant text-center">
                Periode: <span class="font-semibold"><?php echo e($startDate->format('d M Y')); ?></span> - <span class="font-semibold"><?php echo e($endDate->format('d M Y')); ?></span>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-3 mb-6">
            <div class="bg-gradient-to-br from-primary to-primary-dark rounded-card p-4 text-white shadow-card">
                <div class="flex items-center gap-2 mb-2 opacity-90">
                    <span class="material-symbols-rounded text-lg">account_balance_wallet</span>
                    <span class="text-xs font-semibold">Saldo</span>
                </div>
                <div class="text-xl font-bold">Rp <?php echo e(number_format($balance, 0, ',', '.')); ?></div>
            </div>

            <div class="bg-gradient-to-br from-success to-green-600 rounded-card p-4 text-white shadow-card">
                <div class="flex items-center gap-2 mb-2 opacity-90">
                    <span class="material-symbols-rounded text-lg">arrow_downward</span>
                    <span class="text-xs font-semibold">Masuk</span>
                </div>
                <div class="text-xl font-bold">Rp <?php echo e(number_format($totalIncome, 0, ',', '.')); ?></div>
            </div>

            <div class="bg-gradient-to-br from-error to-red-600 rounded-card p-4 text-white shadow-card">
                <div class="flex items-center gap-2 mb-2 opacity-90">
                    <span class="material-symbols-rounded text-lg">arrow_upward</span>
                    <span class="text-xs font-semibold">Keluar</span>
                </div>
                <div class="text-xl font-bold">Rp <?php echo e(number_format($totalExpense, 0, ',', '.')); ?></div>
            </div>
        </div>

        <div class="bg-surface rounded-card p-6 mb-6 shadow-card">
            <h3 class="text-headline-md font-semibold text-on-surface mb-4">Pengeluaran per Kategori</h3>
            <?php if(empty($pieChartData['labels'])): ?>
                <div class="text-center py-12">
                    <span class="material-symbols-rounded text-6xl text-on-surface-variant opacity-30">pie_chart</span>
                    <p class="mt-4 text-on-surface-variant">Tidak ada data pengeluaran</p>
                </div>
            <?php else: ?>
                <div style="position: relative; height: 280px;" class="mb-4">
                    <canvas id="donutChart"></canvas>
                </div>

                <div class="space-y-3">
                    <?php
                        $categoryColors = ['#7c3aed', '#ec4899', '#f97316', '#10b981', '#3b82f6', '#eab308', '#8b5cf6', '#14b8a6'];
                        $totalPie = array_sum($pieChartData['data']);
                    ?>
                    <?php $__currentLoopData = $pieChartData['labels']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center justify-between p-3 bg-surface-container rounded-button">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-4 h-4 rounded-full flex-shrink-0" style="background-color: <?php echo e($categoryColors[$index % 8]); ?>"></div>
                                <span class="text-body-lg font-semibold text-on-surface truncate"><?php echo e($label); ?></span>
                            </div>
                            <div class="text-right flex-shrink-0 ml-3">
                                <p class="text-body-lg font-bold text-on-surface">Rp <?php echo e(number_format($pieChartData['data'][$index], 0, ',', '.')); ?></p>
                                <p class="text-xs text-on-surface-variant"><?php echo e($totalPie > 0 ? round(($pieChartData['data'][$index] / $totalPie) * 100, 1) : 0); ?>%</p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="bg-surface rounded-card p-6 mb-6 shadow-card">
            <h3 class="text-headline-md font-semibold text-on-surface mb-4">Tren Pengeluaran Harian</h3>
            <?php if(empty($dailyExpenseTrend['labels'])): ?>
                <div class="text-center py-12">
                    <span class="material-symbols-rounded text-6xl text-on-surface-variant opacity-30">show_chart</span>
                    <p class="mt-4 text-on-surface-variant">Tidak ada data tren</p>
                </div>
            <?php else: ?>
                <div style="position: relative; height: 250px;">
                    <canvas id="trendChart"></canvas>
                </div>
            <?php endif; ?>
        </div>

        <div class="bg-surface rounded-card p-6 shadow-card">
            <h3 class="text-headline-md font-semibold text-on-surface mb-4">Daftar Transaksi</h3>
            <?php if($transactions->isEmpty()): ?>
                <div class="text-center py-12">
                    <span class="material-symbols-rounded text-6xl text-on-surface-variant opacity-30">receipt_long</span>
                    <p class="mt-4 text-on-surface-variant">Belum ada transaksi</p>
                </div>
            <?php else: ?>
                <div class="space-y-2">
                    <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center gap-3 p-3 hover:bg-surface-container rounded-button transition-colors">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center <?php echo e($transaction->type === 'income' ? 'bg-success-container text-success' : 'bg-error-container text-error'); ?>">
                                <span class="material-symbols-rounded text-sm"><?php echo e($transaction->type === 'income' ? 'arrow_downward' : 'arrow_upward'); ?></span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-body-lg font-semibold text-on-surface truncate"><?php echo e($transaction->category ? $transaction->category->name : 'Transaksi'); ?></p>
                                <p class="text-xs text-on-surface-variant"><?php echo e($transaction->transaction_date->format('d M Y')); ?></p>
                            </div>
                            <div class="text-right flex-shrink-0">
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

    <script>
        function toggleCustomDate(value) {
            const customDateRange = document.getElementById('custom-date-range');

            if (!customDateRange) {
                return;
            }

            if (value === 'custom') {
                customDateRange.classList.remove('hidden');
            } else {
                customDateRange.classList.add('hidden');
            }
        }

        <?php if(!empty($pieChartData['labels'])): ?>
            const donutCtx = document.getElementById('donutChart');

            if (donutCtx) {
                new Chart(donutCtx.getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        labels: <?php echo json_encode($pieChartData['labels'], 15, 512) ?>,
                        datasets: [{
                            data: <?php echo json_encode($pieChartData['data'], 15, 512) ?>,
                            backgroundColor: ['#7c3aed', '#ec4899', '#f97316', '#10b981', '#3b82f6', '#eab308', '#8b5cf6', '#14b8a6'],
                            borderColor: '#fff',
                            borderWidth: 3,
                            hoverOffset: 10
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '70%',
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: 'rgba(124, 58, 237, 0.95)',
                                titleColor: '#fff',
                                bodyColor: '#fff',
                                padding: 12,
                                borderRadius: 12,
                                callbacks: {
                                    label: function(context) {
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = total > 0 ? ((context.parsed / total) * 100).toFixed(1) : 0;
                                        return context.label + ': Rp ' + context.parsed.toLocaleString('id-ID') + ' (' + percentage + '%)';
                                    }
                                }
                            }
                        }
                    }
                });
            }
        <?php endif; ?>

        <?php if(!empty($dailyExpenseTrend['labels'])): ?>
            const trendCtx = document.getElementById('trendChart');

            if (trendCtx) {
                new Chart(trendCtx.getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: <?php echo json_encode($dailyExpenseTrend['labels'], 15, 512) ?>,
                        datasets: [{
                            label: 'Pengeluaran',
                            data: <?php echo json_encode($dailyExpenseTrend['data'], 15, 512) ?>,
                            borderColor: '#7c3aed',
                            backgroundColor: 'rgba(124, 58, 237, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4,
                            pointRadius: 6,
                            pointBackgroundColor: '#7c3aed',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointHoverRadius: 8
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
        <?php endif; ?>
    </script>
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
<?php /**PATH E:\asn_pemrograman_web\asn_pemrograman_web\resources\views/reports.blade.php ENDPATH**/ ?>