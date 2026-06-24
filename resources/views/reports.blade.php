<x-layouts.mobile-app :currentPage="'reports'">
    <div class="min-h-screen bg-gradient-to-br from-primary/5 via-background to-secondary/5 px-4 py-6">
        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-headline-lg font-bold text-on-surface mb-1">Laporan Keuangan</h2>
            <p class="text-body-md text-on-surface-variant">Analisis pengeluaran dan pemasukan kamu</p>
        </div>

        <!-- Filter Card -->
        <div class="bg-surface rounded-card p-6 mb-6 shadow-card">
            <h3 class="text-headline-md font-semibold text-on-surface mb-4">Filter Periode</h3>
            <form method="GET" action="{{ route('reports') }}" class="space-y-4">
                <div>
                    <label class="text-xs font-bold uppercase tracking-wider text-on-surface-variant mb-2 block">Pilih Periode</label>
                    <select id="filter" name="filter" class="w-full bg-surface-container border-2 border-outline rounded-button px-4 py-3 text-body-lg text-on-surface focus:border-primary focus:ring-0" onchange="toggleCustomDate(this.value)">
                        <option value="weekly" {{ $filterType === 'weekly' ? 'selected' : '' }}>Mingguan</option>
                        <option value="monthly" {{ $filterType === 'monthly' ? 'selected' : '' }}>Bulanan</option>
                        <option value="custom" {{ $filterType === 'custom' ? 'selected' : '' }}>Custom</option>
                    </select>
                </div>

                <div id="custom-date-range" class="{{ $filterType === 'custom' ? '' : 'hidden' }} space-y-3">
                    <div>
                        <label class="text-xs font-bold uppercase tracking-wider text-on-surface-variant mb-2 block">Tanggal Mulai</label>
                        <input type="date" id="start_date" name="start_date" value="{{ $filterType === 'custom' && $startDate ? $startDate->format('Y-m-d') : '' }}" class="w-full bg-surface-container border-2 border-outline rounded-button px-4 py-3 text-body-lg text-on-surface focus:border-primary focus:ring-0">
                    </div>
                    <div>
                        <label class="text-xs font-bold uppercase tracking-wider text-on-surface-variant mb-2 block">Tanggal Akhir</label>
                        <input type="date" id="end_date" name="end_date" value="{{ $filterType === 'custom' && $endDate ? $endDate->format('Y-m-d') : '' }}" class="w-full bg-surface-container border-2 border-outline rounded-button px-4 py-3 text-body-lg text-on-surface focus:border-primary focus:ring-0">
                    </div>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-primary to-primary-dark text-white font-bold py-3 rounded-button hover:shadow-card-hover transition-all shadow-card">
                    Terapkan Filter
                </button>
            </form>
            
            <div class="mt-4 text-xs text-on-surface-variant text-center">
                Periode: <span class="font-semibold">{{ $startDate->format('d M Y') }}</span> - <span class="font-semibold">{{ $endDate->format('d M Y') }}</span>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-3 gap-3 mb-6">
            <div class="bg-gradient-to-br from-primary to-primary-dark rounded-card p-4 text-white shadow-card">
                <div class="flex items-center gap-2 mb-2 opacity-90">
                    <span class="material-symbols-rounded text-lg">account_balance_wallet</span>
                    <span class="text-xs font-semibold">Saldo</span>
                </div>
                <div class="text-xl font-bold">Rp {{ number_format($balance, 0, ',', '.') }}</div>
            </div>

            <div class="bg-gradient-to-br from-success to-green-600 rounded-card p-4 text-white shadow-card">
                <div class="flex items-center gap-2 mb-2 opacity-90">
                    <span class="material-symbols-rounded text-lg">arrow_downward</span>
                    <span class="text-xs font-semibold">Masuk</span>
                </div>
                <div class="text-xl font-bold">Rp {{ number_format($totalIncome, 0, ',', '.') }}</div>
            </div>

            <div class="bg-gradient-to-br from-error to-red-600 rounded-card p-4 text-white shadow-card">
                <div class="flex items-center gap-2 mb-2 opacity-90">
                    <span class="material-symbols-rounded text-lg">arrow_upward</span>
                    <span class="text-xs font-semibold">Keluar</span>
                </div>
                <div class="text-xl font-bold">Rp {{ number_format($totalExpense, 0, ',', '.') }}</div>
            </div>
        </div>

        <!-- Donut Chart with Percentage in Center -->
        <div class="bg-surface rounded-card p-6 mb-6 shadow-card">
            <h3 class="text-headline-md font-semibold text-on-surface mb-4">Pengeluaran per Kategori</h3>
            @if(empty($pieChartData['labels']))
                <div class="text-center py-12">
                    <span class="material-symbols-rounded text-6xl text-on-surface-variant opacity-30">pie_chart</span>
                    <p class="mt-4 text-on-surface-variant">Tidak ada data pengeluaran</p>
                </div>
            @else
                <div style="position: relative; height: 280px;" class="mb-4">
                    <canvas id="donutChart"></canvas>
                </div>
                
                <!-- Color-coded Category List -->
                <div class="space-y-3">
                    @php
                        $categoryColors = ['#7c3aed', '#ec4899', '#f97316', '#10b981', '#3b82f6', '#eab308', '#8b5cf6', '#14b8a6'];
                    @endphp
                    @foreach($pieChartData['labels'] as $index => $label)
                        <div class="flex items-center justify-between p-3 bg-surface-container rounded-button">
                            <div class="flex items-center gap-3">
                                <div class="w-4 h-4 rounded-full" style="background-color: {{ $categoryColors[$index % 8] }}"></div>
                                <span class="text-body-lg font-semibold text-on-surface">{{ $label }}</span>
                            </div>
                            <div class="text-right">
                                <p class="text-body-lg font-bold text-on-surface">Rp {{ number_format($pieChartData['data'][$index], 0, ',', '.') }}</p>
                                <p class="text-xs text-on-surface-variant">
                                    {{ round(($pieChartData['data'][$index] / array_sum($pieChartData['data'])) * 100, 1) }}%
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Daily Trend Chart -->
        <div class="bg-surface rounded-card p-6 mb-6 shadow-card">
            <h3 class="text-headline-md font-semibold text-on-surface mb-4">Tren Pengeluaran Harian</h3>
            @if(empty($dailyExpenseTrend['labels']))
                <div class="text-center py-12">
                    <span class="material-symbols-rounded text-6xl text-on-surface-variant opacity-30">show_chart</span>
                    <p class="mt-4 text-on-surface-variant">Tidak ada data tren</p>
                </div>
            @else
                <div style="position: relative; height: 250px;">
                    <canvas id="trendChart"></canvas>
                </div>
            @endif
        </div>

        <!-- Transaction List -->
        <div class="bg-surface rounded-card p-6 shadow-card">
            <h3 class="text-headline-md font-semibold text-on-surface mb-4">Daftar Transaksi</h3>
            @if($transactions->isEmpty())
                <div class="text-center py-12">
                    <span class="material-symbols-rounded text-6xl text-on-surface-variant opacity-30">receipt_long</span>
                    <p class="mt-4 text-on-surface-variant">Belum ada transaksi</p>
                </div>
            @else
                <div class="space-y-2">
                    @foreach($transactions as $transaction)
                        <div class="flex items-center gap-3 p-3 hover:bg-surface-container rounded-button transition-colors">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $transaction->type === 'income' ? 'bg-success-container text-success' : 'bg-error-container text-error' }}">
                                <span class="material-symbols-rounded text-sm">{{ $transaction->type === 'income' ? 'arrow_downward' : 'arrow_upward' }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-body-lg font-semibold text-on-surface truncate">
                                    {{ $transaction->category ? $transaction->category->name : 'Transaksi' }}
                                </p>
                                <p class="text-xs text-on-surface-variant">
                                    {{ $transaction->transaction_date->format('d M Y') }}
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-body-lg font-bold {{ $transaction->type === 'income' ? 'text-success' : 'text-error' }}">
                                    {{ $transaction->type === 'income' ? '+' : '-' }} Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <script>
        function toggleCustomDate(value) {
            const customDateRange = document.getElementById('custom-date-range');
            if (value === 'custom') {
                customDateRange.classList.remove('hidden');
            } else {
                customDateRange.classList.add('hidden');
            }
        }

        // Donut Chart with Center Text Plugin
        const centerTextPlugin = {
            id: 'centerText',
            afterDatasetsDraw(chart) {
                const { ctx, chartArea: { width, height } } = chart;
                ctx.save();
                
                const total = chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                const centerX = width / 2;
                const centerY = height / 2;
                
                // Draw total text
                ctx.font = 'bold 20px Plus Jakarta Sans';
                ctx.fillStyle = '#6b7280';
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.fillText('Total', centerX, centerY - 15);
                
                ctx.font = 'bold 18px Plus Jakarta Sans';
                ctx.fillStyle = '#7c3aed';
                ctx.fillText('Rp ' + (total / 1000).toFixed(0) + 'k', centerX, centerY + 15);
                
                ctx.restore();
            }
        };

        // Donut Chart - Expense by Category
        @if(!empty($pieChartData['labels']))
            const donutCtx = document.getElementById('donutChart').getContext('2d');
            new Chart(donutCtx, {
                type: 'doughnut',
                data: {
                    labels: @json($pieChartData['labels']),
                    datasets: [{
                        data: @json($pieChartData['data']),
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
                            displayColors: true,
                            callbacks: {
                                label: function(context) {
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((context.parsed / total) * 100).toFixed(1);
                                    return context.label + ': Rp ' + context.parsed.toLocaleString('id-ID') + ' (' + percentage + '%)';
                                }
                            }
                        }
                    }
                },
                plugins: [centerTextPlugin]
            });
        @endif

        // Line Chart - Daily Expense Trend
        @if(!empty($dailyExpenseTrend['labels']))
            const trendCtx = document.getElementById('trendChart').getContext('2d');
            new Chart(trendCtx, {
                type: 'line',
                data: {
                    labels: @json($dailyExpenseTrend['labels']),
                    datasets: [{
                        label: 'Pengeluaran',
                        data: @json($dailyExpenseTrend['data']),
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
                                    return 'Rp ' + (value / 1000) + 'k';
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
        @endif
    </script>
</x-layouts.mobile-app>
