<<<<<<< HEAD
<x-layouts.mobile-app :currentPage="'dashboard'">
    <div class="min-h-screen bg-gradient-to-br from-primary/5 via-background to-secondary/5 px-4 py-6">
        <!-- App Header with Logo -->
        <div class="mb-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <!-- Logo -->
                <div class="w-12 h-12 bg-gradient-to-br from-primary to-primary-dark rounded-full flex items-center justify-center shadow-card">
                    <span class="material-symbols-rounded text-white text-2xl" style="font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;">account_balance_wallet</span>
                </div>
                
                <!-- App Name -->
                <div>
                    <h1 class="text-headline-md font-bold text-primary">Tracker Kostly</h1>
                    <p class="text-xs text-on-surface-variant">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM YYYY') }}</p>
                </div>
            </div>
            
            <!-- User Avatar -->
            <div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center text-primary font-bold">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
        </div>
        
        <!-- Main Balance Card with Large Rounded Corners -->
        <div class="bg-gradient-to-br from-primary to-primary-dark rounded-card p-6 mb-6 relative overflow-hidden shadow-card">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-8 -mt-8"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full -ml-6 -mb-6"></div>
            
            <div class="relative z-10">
                <div class="flex items-center gap-2 text-white/80 mb-3">
                    <span class="material-symbols-rounded text-xl">account_balance_wallet</span>
                    <span class="text-xs font-bold uppercase tracking-wider">Total Saldo</span>
                </div>
                <h3 class="text-display-currency text-white mb-6">Rp {{ number_format($balance, 0, ',', '.') }}</h3>
                
                <!-- Income & Expense Summary -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white/10 backdrop-blur-sm rounded-button p-4">
                        <div class="flex items-center gap-2 text-white/70 mb-2">
                            <span class="material-symbols-rounded text-sm">arrow_downward</span>
                            <span class="text-xs font-semibold">Pemasukan</span>
                        </div>
                        <p class="text-white font-bold text-lg">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-button p-4">
                        <div class="flex items-center gap-2 text-white/70 mb-2">
                            <span class="material-symbols-rounded text-sm">arrow_upward</span>
                            <span class="text-xs font-semibold">Pengeluaran</span>
                        </div>
                        <p class="text-white font-bold text-lg">Rp {{ number_format($totalExpense, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tren Pengeluaran Chart -->
        <div class="bg-surface rounded-card p-6 mb-6 shadow-card">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-headline-md font-semibold text-on-surface">Tren Pengeluaran</h3>
            </div>
            <div style="position: relative; height: 220px;">
                <canvas id="dailyTrendChart"></canvas>
            </div>
        </div>

        <!-- Top Categories with Color-Coded -->
        @if($topCategories->isNotEmpty())
        <div class="bg-surface rounded-card p-6 mb-6 shadow-card">
            <h3 class="text-headline-md font-semibold text-on-surface mb-4">Top Kategori Pengeluaran</h3>
            <div class="space-y-3">
                @php
                    $colors = ['#7c3aed', '#8b5cf6', '#a78bfa', '#c4b5fd', '#ddd6fe'];
                @endphp
                @foreach($topCategories as $index => $category)
                <div class="flex items-center gap-3 p-3 hover:bg-surface-container rounded-button transition-colors">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-white" style="background: {{ $colors[$index % 5] }};">
                        {{ $index + 1 }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-body-lg font-semibold text-on-surface truncate">{{ $category['category_name'] }}</p>
                        <p class="text-xs text-on-surface-variant">{{ $category['count'] }} transaksi</p>
                    </div>
                    <div class="text-right">
                        <p class="text-body-lg font-bold text-on-surface whitespace-nowrap">Rp {{ number_format($category['total'], 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Recent Transactions -->
        <div class="bg-surface rounded-card p-6 shadow-card">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-headline-md font-semibold text-on-surface">Transaksi Terakhir</h3>
                <a href="{{ route('transactions.index') }}" class="text-primary text-sm font-semibold">Lihat Semua</a>
            </div>
            @if($recentTransactions->isEmpty())
                <div class="text-center py-12">
                    <span class="material-symbols-rounded text-6xl text-on-surface-variant opacity-30">receipt_long</span>
                    <p class="mt-4 text-on-surface-variant text-body-md">Belum ada transaksi</p>
                    <a href="{{ route('transactions.create') }}" class="mt-3 inline-flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-full font-semibold text-sm hover:bg-primary-dark transition-colors">
                        <span class="material-symbols-rounded text-lg">add</span>
                        Tambah Transaksi
                    </a>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($recentTransactions as $transaction)
                        <div class="flex items-center gap-3 p-3 hover:bg-surface-container rounded-button transition-colors">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center {{ $transaction->type === 'income' ? 'bg-success-container text-success' : 'bg-primary-container text-primary' }}">
                                <span class="material-symbols-rounded">{{ $transaction->type === 'income' ? 'arrow_downward' : 'arrow_upward' }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-body-lg font-semibold text-on-surface truncate">
                                    {{ $transaction->notes ?: ($transaction->category ? $transaction->category->name : 'Transaksi') }}
                                </p>
                                <p class="text-xs text-on-surface-variant">
                                    {{ $transaction->transaction_date->format('d M Y') }} • {{ $transaction->category ? $transaction->category->name : '-' }}
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

=======
<x-app-dashboard>
    <!-- Header & Filters -->
    <div class="flex justify-between items-end mb-xl">
        <div>
            <h2 class="font-headline-lg text-headline-lg text-on-surface">Halo, {{ Auth::user()->name }}! 👋</h2>
            <p class="font-body-md text-body-md text-on-surface-variant mt-xs">Berikut ringkasan keuangan kost kamu bulan ini.</p>
        </div>
        <button class="flex items-center gap-sm px-4 py-2 bg-surface border border-outline-variant rounded-lg hover:border-primary transition-colors text-on-surface">
            <span class="material-symbols-outlined text-outline">calendar_today</span>
            <span class="font-label-bold text-label-bold">{{ now()->format('F Y') }}</span>
            <span class="material-symbols-outlined text-outline">expand_more</span>
        </button>
    </div>

    <!-- Bento Grid for Core Metrics -->
    <div class="grid grid-cols-4 gap-lg mb-lg">
        <!-- Main Balance Card -->
        <div class="col-span-2 bg-surface-container-lowest rounded-xl p-lg elevation-1 flex flex-col justify-between border border-outline-variant/30">
            <div class="flex items-center gap-sm text-on-surface-variant mb-md">
                <span class="material-symbols-outlined">account_balance</span>
                <span class="font-label-bold text-label-bold uppercase">Total Saldo</span>
            </div>
            <div>
                <h3 class="font-display-currency text-display-currency text-on-surface">Rp {{ number_format($balance, 0, ',', '.') }}</h3>
                <p class="font-body-md text-body-md {{ $balance >= 0 ? 'text-primary' : 'text-error' }} mt-sm flex items-center gap-xs">
                    <span class="material-symbols-outlined text-[16px]">{{ $balance >= 0 ? 'trending_up' : 'trending_down' }}</span>
                    {{ abs($balance) > 0 ? '(Saldo ' . ($balance >= 0 ? 'Positif' : 'Negatif') . ')' : 'Saldo Nol' }}
                </p>
            </div>
        </div>

        <!-- Income Card -->
        <div class="col-span-1 bg-surface-container-lowest rounded-xl p-lg elevation-1 flex flex-col justify-between border border-outline-variant/30 relative overflow-hidden">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-tint-primary rounded-full opacity-50 pointer-events-none"></div>
            <div class="flex items-center gap-sm text-on-surface-variant mb-md relative z-10">
                <div class="w-8 h-8 rounded-full bg-tint-primary text-primary flex items-center justify-center">
                    <span class="material-symbols-outlined text-[18px]">arrow_downward</span>
                </div>
                <span class="font-label-bold text-label-bold uppercase">Pemasukan</span>
            </div>
            <div class="relative z-10">
                <h4 class="font-headline-md text-headline-md text-on-surface">Rp {{ number_format($totalIncome, 0, ',', '.') }}</h4>
            </div>
        </div>

        <!-- Expense Card -->
        <div class="col-span-1 bg-surface-container-lowest rounded-xl p-lg elevation-1 flex flex-col justify-between border border-outline-variant/30 relative overflow-hidden">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-tint-error rounded-full opacity-50 pointer-events-none"></div>
            <div class="flex items-center gap-sm text-on-surface-variant mb-md relative z-10">
                <div class="w-8 h-8 rounded-full bg-tint-error text-error flex items-center justify-center">
                    <span class="material-symbols-outlined text-[18px]">arrow_upward</span>
                </div>
                <span class="font-label-bold text-label-bold uppercase">Pengeluaran</span>
            </div>
            <div class="relative z-10">
                <h4 class="font-headline-md text-headline-md text-on-surface">Rp {{ number_format($totalExpense, 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>

    <!-- Middle Section: Chart -->
    <div class="bg-surface-container-lowest rounded-xl p-lg elevation-1 border border-outline-variant/30 mb-lg">
        <div class="flex justify-between items-center mb-lg">
            <h3 class="font-headline-md text-headline-md text-on-surface">Tren Pengeluaran Bulan Ini</h3>
            <a href="{{ route('reports') }}" class="text-primary hover:bg-surface-container-high px-3 py-1 rounded-full transition-colors font-label-bold text-label-bold">Detail</a>
        </div>
        <!-- Chart Container -->
        <div class="w-full h-64 rounded-lg relative overflow-hidden">
            <canvas id="expenseTrendChart"></canvas>
        </div>
    </div>

    <!-- Bottom Section: Transactions List -->
    <div class="bg-surface-container-lowest rounded-xl p-lg elevation-1 border border-outline-variant/30">
        <div class="flex justify-between items-center mb-md">
            <h3 class="font-headline-md text-headline-md text-on-surface">Transaksi Terakhir</h3>
            <a class="text-primary hover:underline font-label-bold text-label-bold" href="{{ route('transactions.index') }}">Lihat Semua</a>
        </div>
        
        @if($recentTransactions->isEmpty())
            <div class="text-center py-8">
                <p class="text-on-surface-variant text-body-md">Belum ada transaksi</p>
                <a href="{{ route('transactions.create') }}" class="mt-4 inline-flex items-center gap-sm px-4 py-2 bg-primary text-on-primary rounded-lg hover:opacity-90 transition-opacity font-label-bold text-label-bold">
                    <span class="material-symbols-outlined">add</span>
                    Tambah Transaksi
                </a>
            </div>
        @else
            <div class="flex flex-col gap-2">
                @foreach($recentTransactions as $transaction)
                    <div class="flex items-center justify-between p-md hover:bg-surface-container-low rounded-lg transition-colors cursor-pointer group">
                        <div class="flex items-center gap-md">
                            <div class="w-12 h-12 rounded-full {{ $transaction->type === 'income' ? 'bg-tint-secondary' : 'bg-tint-error' }} flex items-center justify-center border-2 border-surface-container-lowest group-hover:border-surface-container-low transition-colors">
                                <span class="material-symbols-outlined {{ $transaction->type === 'income' ? 'text-secondary' : 'text-error' }}">
                                    @if($transaction->type === 'income')
                                        account_balance
                                    @elseif($transaction->category && $transaction->category->name === 'Makanan')
                                        fastfood
                                    @elseif($transaction->category && $transaction->category->name === 'Listrik' || $transaction->category && $transaction->category->name === 'Utilitas')
                                        bolt
                                    @elseif($transaction->category && $transaction->category->name === 'Laundry')
                                        local_laundry_service
                                    @elseif($transaction->category && $transaction->category->name === 'WiFi' || $transaction->category && $transaction->category->name === 'Tagihan')
                                        wifi
                                    @else
                                        receipt
                                    @endif
                                </span>
                            </div>
                            <div>
                                <p class="font-body-lg text-body-lg text-on-surface font-semibold">{{ $transaction->category?->name ?? 'Transaksi' }}</p>
                                <p class="font-body-md text-body-md text-on-surface-variant text-sm mt-xs">{{ $transaction->transaction_date->format('d M Y') }} • {{ $transaction->notes ?? 'Tidak ada catatan' }}</p>
                            </div>
                        </div>
                        <span class="font-body-lg text-body-lg {{ $transaction->type === 'income' ? 'text-primary' : 'text-error' }} font-bold">
                            {{ $transaction->type === 'income' ? '+' : '-' }} Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                        </span>
                    </div>
                    @if(!$loop->last)
                        <div class="h-px w-full bg-outline-variant/30 mx-auto w-[calc(100%-32px)]"></div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>

    <!-- Chart.js Scripts -->
>>>>>>> main
    <script>
        // Expense Trend Chart (Bar Chart)
        const trendCtx = document.getElementById('expenseTrendChart').getContext('2d');
        new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: @json($trendChartData['labels']),
                datasets: [{
                    label: 'Pengeluaran',
                    data: @json($trendChartData['data']),
<<<<<<< HEAD
                    backgroundColor: 'rgba(124, 58, 237, 0.8)',
                    borderColor: 'rgba(109, 40, 217, 1)',
                    borderWidth: 2,
                    borderRadius: 12,
=======
                    backgroundColor: 'rgba(186, 26, 26, 0.1)',
                    borderColor: 'rgba(186, 26, 26, 1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: 'rgba(186, 26, 26, 1)',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
>>>>>>> main
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
<<<<<<< HEAD
                        display: false,
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
=======
                        display: false
>>>>>>> main
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                        },
                        ticks: {
                            callback: function(value) {
<<<<<<< HEAD
                                return 'Rp ' + (value / 1000) + 'k';
=======
                                return 'Rp ' + value.toLocaleString('id-ID');
>>>>>>> main
                            }
                        },
                        grid: {
                            color: 'rgba(190, 200, 205, 0.2)'
                        }
                    },
                    x: {
                        grid: {
<<<<<<< HEAD
                            display: false,
=======
                            display: false
>>>>>>> main
                        }
                    }
                }
            }
        });
    </script>
<<<<<<< HEAD

</x-layouts.mobile-app>
=======
</x-app-dashboard>
>>>>>>> main
