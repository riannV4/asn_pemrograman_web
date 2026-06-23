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
    <script>
        // Expense Trend Chart (Bar Chart)
        const trendCtx = document.getElementById('expenseTrendChart').getContext('2d');
        new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: @json($trendChartData['labels']),
                datasets: [{
                    label: 'Pengeluaran (Rp)',
                    data: @json($trendChartData['data']),
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
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        },
                        grid: {
                            color: 'rgba(190, 200, 205, 0.2)'
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
    </script>
</x-app-dashboard>
