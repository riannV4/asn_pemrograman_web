<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laporan Keuangan - Tracker Kost</title>
    
    <!-- CSS & JS Libraries from Design -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <!-- Tailwind Configuration matching UI Design -->
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "on-tertiary-fixed-variant": "#693c00",
                        "on-tertiary-container": "#ffe8d6",
                        "on-tertiary": "#ffffff",
                        "inverse-on-surface": "#eef1f3",
                        "error": "#ba1a1a",
                        "surface-bright": "#f7fafc",
                        "on-primary": "#ffffff",
                        "surface-variant": "#e0e3e5",
                        "secondary-container": "#dae2fd",
                        "inverse-primary": "#81d1f0",
                        "primary-fixed": "#b9eaff",
                        "on-primary-container": "#d3f1ff",
                        "tertiary-fixed-dim": "#ffb86f",
                        "error-container": "#ffdad6",
                        "on-background": "#181c1e",
                        "tertiary-fixed": "#ffdcbd",
                        "tertiary": "#794602",
                        "on-surface": "#181c1e",
                        "on-primary-fixed": "#001f29",
                        "outline-variant": "#bec8cd",
                        "surface-container-highest": "#e0e3e5",
                        "surface": "#f7fafc",
                        "secondary": "#565e74",
                        "primary": "#005a71",
                        "background": "#f7fafc",
                        "primary-container": "#0e7490",
                        "on-surface-variant": "#3f484c",
                        "on-primary-fixed-variant": "#004d62",
                        "surface-container-low": "#f1f4f6",
                        "on-tertiary-fixed": "#2c1600",
                        "on-error-container": "#93000a",
                        "primary-fixed-dim": "#81d1f0",
                        "on-secondary-fixed-variant": "#3f465c",
                        "surface-container-high": "#e6e8eb",
                        "on-secondary-fixed": "#131b2e",
                        "surface-container-lowest": "#ffffff",
                        "outline": "#6f787d",
                        "on-secondary-container": "#5c647a",
                        "secondary-fixed": "#dae2fd",
                        "on-secondary": "#ffffff",
                        "secondary-fixed-dim": "#bec6e0",
                        "surface-tint": "#006781",
                        "tertiary-container": "#965e1c",
                        "surface-dim": "#d7dadd",
                        "surface-container": "#ebeef0"
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    spacing: {
                        "container-margin": "16px",
                        "xl": "32px",
                        "gutter": "12px",
                        "base": "16px",
                        "sm": "8px",
                        "md": "16px",
                        "xs": "4px"
                    },
                    fontFamily: {
                        sans: ["Plus Jakarta Sans", "sans-serif"]
                    },
                    fontSize: {
                        "display-currency-mobile": ["28px", { "lineHeight": "36px", "fontWeight": "700" }],
                        "display-currency": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "headline-md": ["20px", { "lineHeight": "28px", "fontWeight": "600" }],
                        "label-bold": ["12px", { "lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "700" }],
                        "body-md": ["14px", { "lineHeight": "20px", "fontWeight": "400" }],
                        "headline-lg": ["24px", { "lineHeight": "32px", "fontWeight": "700" }],
                        "body-lg": ["16px", { "lineHeight": "24px", "fontWeight": "400" }]
                    }
                }
            }
        };
    </script>
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .material-symbols-outlined.fill { font-variation-settings: 'FILL' 1; }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        
        /* Ambient Shadow for Level 1 Cards */
        .card-shadow { box-shadow: 0px 4px 12px rgba(15, 23, 42, 0.05); }
    </style>
</head>
<body class="bg-surface text-on-surface flex h-screen overflow-hidden antialiased">

    <!-- 1. SideNavBar (Desktop Only) -->
    <aside class="flex flex-col h-full sticky left-0 top-0 overflow-y-auto bg-surface-container-lowest dark:bg-surface-container-low h-screen w-64 border-r border-outline-variant hidden md:flex z-50">
        <div class="p-6">
            <!-- Brand Logo -->
            <div class="flex items-center gap-3 mb-8">
                <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-on-primary font-bold text-xl">K</div>
                <div>
                    <h1 class="font-headline-md text-headline-md text-primary font-bold">Kostly Tracker</h1>
                    <p class="font-body-md text-body-md text-on-surface-variant text-xs">Anak Kost Management</p>
                </div>
            </div>
            
            <!-- Desktop Routes Links -->
            <nav class="space-y-1">
                <a class="text-on-surface-variant dark:text-outline-variant hover:bg-surface-container-high dark:hover:bg-surface-container rounded-xl px-4 py-3 mx-2 my-1 flex items-center gap-3 transition-colors duration-200" href="{{ route('dashboard') }}">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="font-body-md text-body-md font-semibold">Dashboard</span>
                </a>
                <a class="text-on-surface-variant dark:text-outline-variant hover:bg-surface-container-high dark:hover:bg-surface-container rounded-xl px-4 py-3 mx-2 my-1 flex items-center gap-3 transition-colors duration-200" href="{{ route('transactions.index') }}">
                    <span class="material-symbols-outlined">receipt_long</span>
                    <span class="font-body-md text-body-md font-semibold">Transactions</span>
                </a>
                <a class="bg-secondary-container dark:bg-on-secondary-fixed-variant text-on-secondary-container dark:text-secondary-fixed rounded-xl px-4 py-3 mx-2 my-1 flex items-center gap-3 transition-transform active:scale-95 font-bold" href="{{ route('reports') }}">
                    <span class="material-symbols-outlined fill">bar_chart</span>
                    <span class="font-body-md text-body-md">Reports</span>
                </a>
                <a class="text-on-surface-variant dark:text-outline-variant hover:bg-surface-container-high dark:hover:bg-surface-container rounded-xl px-4 py-3 mx-2 my-1 flex items-center gap-3 transition-colors duration-200" href="{{ route('profile.edit') }}">
                    <span class="material-symbols-outlined">settings</span>
                    <span class="font-body-md text-body-md font-semibold">Settings</span>
                </a>
            </nav>
        </div>
        
        <!-- Desktop User Profile and Logout -->
        <div class="mt-auto p-6 border-t border-outline-variant">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center text-on-primary-container font-bold text-lg uppercase shadow-sm">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="font-label-bold text-label-bold text-on-surface max-w-[110px] truncate" title="{{ Auth::user()->name }}">{{ Auth::user()->name }}</p>
                        <p class="font-body-md text-[10px] text-on-surface-variant truncate max-w-[110px]">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-on-surface-variant hover:text-error transition-colors p-2 rounded-full hover:bg-surface-container-high flex items-center justify-center" title="Keluar">
                        <span class="material-symbols-outlined text-[20px]">logout</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- 2. Main Content Area -->
    <div class="flex-1 flex flex-col h-full overflow-hidden">
        
        <!-- TopAppBar (Mobile only) -->
        <header class="flex justify-between items-center px-container-margin w-full sticky top-0 z-40 bg-surface/80 backdrop-blur-md h-16 border-b border-outline-variant md:hidden">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-primary-container flex items-center justify-center text-on-primary-container font-bold text-sm uppercase">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <h1 class="font-headline-lg text-lg font-bold text-primary">Kostly</h1>
            </div>
            <div class="flex items-center gap-2">
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-on-surface-variant hover:text-error p-2 rounded-full hover:bg-surface-container-low transition-all">
                        <span class="material-symbols-outlined text-[20px]">logout</span>
                    </button>
                </form>
            </div>
        </header>
        
        <!-- Canvas Container -->
        <main class="flex-1 overflow-y-auto p-4 md:p-lg lg:p-xl bg-surface-bright pb-[90px] md:pb-lg">
            <div class="max-w-7xl mx-auto space-y-lg">
                
                <!-- Page Header & Filters -->
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2">
                            <h2 class="font-headline-lg text-headline-lg text-on-surface">Financial Reports</h2>
                            <div class="flex items-center gap-1 bg-surface-container-low px-2 py-0.5 rounded-lg border border-outline-variant/30 text-xs">
                                <span class="material-symbols-outlined text-primary text-[14px]">calendar_today</span>
                                <span class="font-semibold text-on-surface text-[11px]">{{ $monthDisplay }}</span>
                            </div>
                        </div>
                        <p class="font-body-md text-body-md text-on-surface-variant mt-1">Analyze your cash flow and expense trends.</p>
                    </div>
                    
                    <!-- Filters Tabs Panel -->
                    <div class="flex bg-surface-container-low rounded-xl p-1 border border-outline-variant/30">
                        <form method="GET" action="{{ route('reports') }}" class="inline">
                            <input type="hidden" name="filter" value="weekly">
                            <button type="submit" class="px-4 py-2 rounded-lg font-body-md text-body-md transition-all duration-200 {{ $filterType === 'weekly' ? 'bg-white card-shadow font-bold text-primary' : 'font-semibold text-on-surface-variant hover:text-primary' }}">
                                Mingguan
                            </button>
                        </form>
                        <form method="GET" action="{{ route('reports') }}" class="inline">
                            <input type="hidden" name="filter" value="monthly">
                            <button type="submit" class="px-4 py-2 rounded-lg font-body-md text-body-md transition-all duration-200 {{ $filterType === 'monthly' ? 'bg-white card-shadow font-bold text-primary' : 'font-semibold text-on-surface-variant hover:text-primary' }}">
                                Bulanan
                            </button>
                        </form>
                        <button type="button" onclick="toggleCustomDate()" class="px-4 py-2 rounded-lg font-body-md text-body-md transition-all duration-200 {{ $filterType === 'custom' ? 'bg-white card-shadow font-bold text-primary' : 'font-semibold text-on-surface-variant hover:text-primary' }}">
                            Kustom
                        </button>
                    </div>
                </div>
                
                <!-- Custom Date Range Form (collapsible) -->
                <div id="custom-date-range" class="{{ $filterType === 'custom' ? '' : 'hidden' }} p-4 bg-white rounded-xl card-shadow border border-outline-variant/10">
                    <form method="GET" action="{{ route('reports') }}" class="space-y-4">
                        <input type="hidden" name="filter" value="custom">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="start_date" class="block text-xs font-bold uppercase tracking-wider text-on-surface-variant mb-1">Tanggal Mulai</label>
                                <input type="date"
                                       id="start_date"
                                       name="start_date"
                                       value="{{ $startDate ? $startDate->format('Y-m-d') : '' }}"
                                       class="w-full px-4 py-2.5 rounded-xl border border-outline-variant bg-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none font-body-md text-on-surface">
                            </div>
                            <div>
                                <label for="end_date" class="block text-xs font-bold uppercase tracking-wider text-on-surface-variant mb-1">Tanggal Akhir</label>
                                <input type="date"
                                       id="end_date"
                                       name="end_date"
                                       value="{{ $endDate ? $endDate->format('Y-m-d') : '' }}"
                                       class="w-full px-4 py-2.5 rounded-xl border border-outline-variant bg-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none font-body-md text-on-surface">
                            </div>
                            <div class="flex items-end">
                                <button type="submit" class="w-full min-h-[46px] bg-primary text-on-primary font-bold rounded-xl shadow-sm hover:bg-primary/95 transition-colors duration-200">
                                    Tampilkan Laporan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                
                <!-- Summary Cards Row -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 lg:gap-6">
                    <!-- Income Card -->
                    <div class="bg-white rounded-xl p-4 lg:p-6 card-shadow border border-outline-variant/10 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-[#005a71]/10 flex items-center justify-center text-primary-container">
                            <span class="material-symbols-outlined text-primary text-2xl font-bold">arrow_downward</span>
                        </div>
                        <div>
                            <p class="font-body-md text-body-md text-on-surface-variant">Pemasukan ({{ $monthDisplay }})</p>
                            <p class="font-display-currency text-display-currency text-on-surface">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    
                    <!-- Expense Card -->
                    <div class="bg-white rounded-xl p-4 lg:p-6 card-shadow border border-outline-variant/10 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-error-container/50 flex items-center justify-center text-error">
                            <span class="material-symbols-outlined text-error text-2xl font-bold">arrow_upward</span>
                        </div>
                        <div>
                            <p class="font-body-md text-body-md text-on-surface-variant">Pengeluaran ({{ $monthDisplay }})</p>
                            <p class="font-display-currency text-display-currency text-error">- Rp {{ number_format($totalExpense, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    
                    <!-- Net Balance Card -->
                    <div class="bg-primary rounded-xl p-4 lg:p-6 card-shadow flex items-center gap-4 text-on-primary relative overflow-hidden">
                        <div class="absolute -right-6 -top-6 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
                        <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center text-white backdrop-blur-sm z-10">
                            <span class="material-symbols-outlined text-white text-2xl font-bold">account_balance_wallet</span>
                        </div>
                        <div class="z-10">
                            <p class="font-body-md text-body-md text-on-primary/80">Sisa Saldo</p>
                            <p class="font-display-currency text-display-currency text-white">
                                {{ $balance >= 0 ? 'Rp ' . number_format($balance, 0, ',', '.') : '- Rp ' . number_format(abs($balance), 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Bento Grid Layout for Charts -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 lg:gap-6">
                    
                    <!-- Line Chart: Tren Pengeluaran Harian -->
                    <div class="lg:col-span-2 bg-white rounded-xl p-4 lg:p-6 card-shadow border border-outline-variant/10 flex flex-col min-h-[380px]">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-headline-md text-base sm:text-headline-md text-on-surface">Tren Pengeluaran Harian</h3>
                            <button class="text-on-surface-variant hover:text-primary transition-colors">
                                <span class="material-symbols-outlined">more_vert</span>
                            </button>
                        </div>
                        <div class="relative w-full h-[280px] sm:h-[320px]">
                            @if(empty($dailyExpenseTrend['labels']))
                                <div class="absolute inset-0 flex items-center justify-center text-on-surface-variant font-body-md bg-surface-container-lowest/50 rounded-xl">
                                    Tidak ada data pengeluaran
                                </div>
                            @else
                                <canvas id="lineChart"></canvas>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Donut Chart: Distribusi Kategori -->
                    <div class="bg-white rounded-xl p-4 lg:p-6 card-shadow border border-outline-variant/10 flex flex-col min-h-[380px]">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-headline-md text-base sm:text-headline-md text-on-surface">Distribusi Pengeluaran</h3>
                        </div>
                        <div class="relative w-full h-[180px] sm:h-[200px] flex items-center justify-center mb-4">
                            @if(empty($pieChartData['labels']))
                                <div class="absolute inset-0 flex items-center justify-center text-on-surface-variant font-body-md bg-surface-container-lowest/50 rounded-xl">
                                    Tidak ada data pengeluaran
                                </div>
                            @else
                                <canvas id="donutChart"></canvas>
                                <!-- Center text inside Donut cutout -->
                                <div class="absolute flex flex-col items-center justify-center text-center pointer-events-none">
                                    <span class="text-xl sm:text-2xl font-bold text-on-surface">100%</span>
                                    <span class="text-[10px] text-on-surface-variant uppercase tracking-wider font-semibold">Total</span>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Custom Legend Items -->
                        <div class="mt-auto space-y-1.5 overflow-y-auto max-h-[140px] pr-1">
                            @php
                                $totalPie = empty($pieChartData['data']) ? 0 : array_sum($pieChartData['data']);
                            @endphp
                            @if($totalPie > 0)
                                @foreach($pieChartData['labels'] as $index => $label)
                                    @php
                                        $percentage = round(($pieChartData['data'][$index] / $totalPie) * 100);
                                        $color = $pieChartData['colors'][$index] ?? '#bec8cd';
                                    @endphp
                                    <div class="flex items-center justify-between font-body-md text-body-md">
                                        <div class="flex items-center gap-2">
                                            <div class="w-3 h-3 rounded-full" style="background-color: {{ $color }}"></div>
                                            <span class="text-on-surface-variant max-w-[130px] truncate" title="{{ $label }}">{{ $label }}</span>
                                        </div>
                                        <span class="font-semibold text-on-surface">{{ $percentage }}%</span>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center font-body-md text-xs text-on-surface-variant py-4">
                                    Belum ada transaksi pengeluaran
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Bar Chart: Pemasukan vs Pengeluaran (Last 4 Weeks) -->
                    <div class="lg:col-span-3 bg-white rounded-xl p-4 lg:p-6 card-shadow border border-outline-variant/10 flex flex-col min-h-[350px]">
                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-4">
                            <h3 class="font-headline-md text-base sm:text-headline-md text-on-surface">Pemasukan vs Pengeluaran (4 Minggu Terakhir)</h3>
                            <div class="flex items-center gap-4 font-body-md text-sm">
                                <div class="flex items-center gap-2">
                                    <div class="w-3.5 h-3.5 rounded-full bg-primary"></div>
                                    <span class="text-on-surface-variant font-semibold">Pemasukan</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-3.5 h-3.5 rounded-full bg-error"></div>
                                    <span class="text-on-surface-variant font-semibold">Pengeluaran</span>
                                </div>
                            </div>
                        </div>
                        <div class="relative w-full h-[240px] sm:h-[280px]">
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>
                </div>
                
                <!-- Transaction List -->
                <div class="bg-white rounded-xl p-4 lg:p-6 card-shadow border border-outline-variant/10">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-headline-md text-headline-md text-on-surface font-bold">Daftar Transaksi</h3>
                        <a href="{{ route('transactions.index') }}" class="text-primary hover:underline text-sm font-semibold flex items-center gap-1">
                            Lihat Semua <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                        </a>
                    </div>
                    
                    @if($transactions->isEmpty())
                        <div class="flex flex-col items-center justify-center py-12 text-on-surface-variant font-body-md">
                            <span class="material-symbols-outlined text-4xl mb-2 text-outline-variant">receipt_long</span>
                            <p>Belum ada transaksi dalam periode ini</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-outline-variant/30">
                                <thead>
                                    <tr class="text-left font-label-bold text-label-bold text-on-surface-variant uppercase tracking-wider text-xs">
                                        <th class="pb-3 pr-4 font-bold">Tanggal</th>
                                        <th class="pb-3 px-4 font-bold">Kategori</th>
                                        <th class="pb-3 px-4 font-bold">Tipe</th>
                                        <th class="pb-3 px-4 text-right font-bold">Nominal</th>
                                        <th class="pb-3 pl-4 font-bold">Catatan</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-outline-variant/10 font-body-md text-body-md text-on-surface">
                                    @foreach($transactions as $transaction)
                                        <tr class="hover:bg-surface-container-low/30 transition-colors duration-150">
                                            <td class="py-4 pr-4 font-semibold whitespace-nowrap">
                                                {{ $transaction->transaction_date->format('d M Y') }}
                                            </td>
                                            <td class="py-4 px-4 whitespace-nowrap text-on-surface-variant">
                                                {{ $transaction->category ? $transaction->category->name : 'Tanpa Kategori' }}
                                            </td>
                                            <td class="py-4 px-4 whitespace-nowrap">
                                                @if($transaction->type === 'income')
                                                    <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-[#16a34a]/10 text-[#16a34a]">
                                                        Pemasukan
                                                    </span>
                                                @else
                                                    <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-[#ba1a1a]/10 text-[#ba1a1a]">
                                                        Pengeluaran
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="py-4 px-4 whitespace-nowrap text-right font-semibold {{ $transaction->type === 'income' ? 'text-primary' : 'text-error' }}">
                                                {{ $transaction->type === 'income' ? '+' : '-' }} Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                            </td>
                                            <td class="py-4 pl-4 max-w-xs truncate text-on-surface-variant" title="{{ $transaction->notes }}">
                                                {{ $transaction->notes ?? '-' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                
            </div>
        </main>
    </div>

    <!-- 3. Bottom Navigation Bar (Mobile Only) -->
    <nav class="fixed bottom-0 w-full z-50 items-center px-4 py-2 bg-surface dark:bg-surface-container-low border-t border-outline-variant shadow-[0_-4px_12px_rgba(15,23,42,0.05)] md:hidden rounded-t-xl grid grid-cols-4">
        <a class="flex flex-col items-center justify-center text-on-surface-variant hover:bg-surface-container-high transition-colors h-14 rounded-lg w-full" href="{{ route('dashboard') }}">
            <span class="material-symbols-outlined">home</span>
            <span class="font-label-bold text-[10px] mt-1">Beranda</span>
        </a>
        <a class="flex flex-col items-center justify-center text-on-surface-variant hover:bg-surface-container-high transition-colors h-14 rounded-lg w-full" href="{{ route('transactions.index') }}">
            <span class="material-symbols-outlined">account_balance_wallet</span>
            <span class="font-label-bold text-[10px] mt-1">Transaksi</span>
        </a>
        <a class="flex flex-col items-center justify-center text-primary bg-secondary-container rounded-lg w-full h-14 hover:bg-surface-container-high transition-colors active:scale-95 font-bold" href="{{ route('reports') }}">
            <span class="material-symbols-outlined fill">analytics</span>
            <span class="font-label-bold text-[10px] mt-1">Laporan</span>
        </a>
        <a class="flex flex-col items-center justify-center text-on-surface-variant hover:bg-surface-container-high transition-colors h-14 rounded-lg w-full" href="{{ route('profile.edit') }}">
            <span class="material-symbols-outlined">settings</span>
            <span class="font-label-bold text-[10px] mt-1">Pengaturan</span>
        </a>
    </nav>

    <!-- Chart Setup Scripts -->
    <script>
        // Chart.js Default styling
        Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
        Chart.defaults.color = '#3f484c'; // on-surface-variant
        Chart.defaults.scale.grid.color = '#ebeef0'; // surface-container
        Chart.defaults.scale.grid.borderColor = 'transparent';

        // 1. Line Chart: Tren Pengeluaran Harian
        @if(!empty($dailyExpenseTrend['labels']))
            const lineCtx = document.getElementById('lineChart').getContext('2d');
            const lineGradient = lineCtx.createLinearGradient(0, 0, 0, 360);
            lineGradient.addColorStop(0, 'rgba(0, 90, 113, 0.2)'); // primary with opacity
            lineGradient.addColorStop(1, 'rgba(0, 90, 113, 0)');

            new Chart(lineCtx, {
                type: 'line',
                data: {
                    labels: @json($dailyExpenseTrend['labels']),
                    datasets: [{
                        label: 'Pengeluaran',
                        data: @json($dailyExpenseTrend['data']),
                        borderColor: '#005a71', // primary
                        backgroundColor: lineGradient,
                        borderWidth: 3,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#005a71',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#181c1e',
                            padding: 12,
                            titleFont: { size: 14, weight: 'bold' },
                            bodyFont: { size: 14 },
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
                                color: '#ebeef0'
                            },
                            ticks: {
                                callback: function(value) {
                                    if (value >= 1000000) {
                                        return 'Rp' + (value / 1000000).toFixed(1) + 'M';
                                    } else if (value >= 1000) {
                                        return 'Rp' + (value / 1000).toFixed(0) + 'K';
                                    }
                                    return 'Rp' + value;
                                }
                            }
                        },
                        x: {
                            grid: { display: false }
                        }
                    }
                }
            });
        @endif

        // 2. Donut Chart: Distribusi
        @if(!empty($pieChartData['labels']))
            const donutCtx = document.getElementById('donutChart').getContext('2d');
            new Chart(donutCtx, {
                type: 'doughnut',
                data: {
                    labels: @json($pieChartData['labels']),
                    datasets: [{
                        data: @json($pieChartData['data']),
                        backgroundColor: @json($pieChartData['colors']),
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#181c1e',
                            callbacks: {
                                label: function(context) {
                                    return ' ' + context.label + ': Rp ' + context.parsed.toLocaleString('id-ID');
                                }
                            }
                        }
                    }
                }
            });
        @endif

        // 3. Bar Chart: Pemasukan vs Pengeluaran (Last 4 Weeks)
        const barCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: @json($barChartData['labels']),
                datasets: [
                    {
                        label: 'Pemasukan',
                        data: @json($barChartData['income']),
                        backgroundColor: '#005a71', // primary
                        borderRadius: 4,
                        barPercentage: 0.6,
                        categoryPercentage: 0.8
                    },
                    {
                        label: 'Pengeluaran',
                        data: @json($barChartData['expense']),
                        backgroundColor: '#ba1a1a', // error
                        borderRadius: 4,
                        barPercentage: 0.6,
                        categoryPercentage: 0.8
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#181c1e',
                        padding: 12,
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': Rp ' + context.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#ebeef0'
                        },
                        ticks: {
                            callback: function(value) {
                                if (value >= 1000000) {
                                    return 'Rp' + (value / 1000000).toFixed(1) + 'M';
                                } else if (value >= 1000) {
                                    return 'Rp' + (value / 1000).toFixed(0) + 'K';
                                }
                                return 'Rp' + value;
                            }
                        }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });

        // Toggle custom date range collapsible section
        function toggleCustomDate() {
            const container = document.getElementById('custom-date-range');
            if (container) {
                container.classList.toggle('hidden');
            }
        }
    </script>
</body>
</html>
