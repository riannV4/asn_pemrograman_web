<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reports') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Filter Form -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Filter Periode</h3>
                    <form method="GET" action="{{ route('reports') }}" class="space-y-4">
                        <!-- Filter Type -->
                        <div>
                            <label for="filter" class="block text-sm font-medium text-gray-700 mb-2">
                                Pilih Periode
                            </label>
                            <select id="filter"
                                    name="filter"
                                    class="block w-full md:w-64 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    onchange="toggleCustomDate(this.value)">
                                <option value="weekly" {{ $filterType === 'weekly' ? 'selected' : '' }}>Weekly</option>
                                <option value="monthly" {{ $filterType === 'monthly' ? 'selected' : '' }}>Monthly</option>
                                <option value="custom" {{ $filterType === 'custom' ? 'selected' : '' }}>Custom Date Range</option>
                            </select>
                        </div>

                        <!-- Custom Date Range -->
                        <div id="custom-date-range" class="{{ $filterType === 'custom' ? '' : 'hidden' }} space-y-4 md:space-y-0 md:flex md:gap-4">
                            <div class="flex-1">
                                <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tanggal Mulai
                                </label>
                                <input type="date"
                                       id="start_date"
                                       name="start_date"
                                       value="{{ $filterType === 'custom' && $startDate ? $startDate->format('Y-m-d') : '' }}"
                                       class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            </div>
                            <div class="flex-1">
                                <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tanggal Akhir
                                </label>
                                <input type="date"
                                       id="end_date"
                                       name="end_date"
                                       value="{{ $filterType === 'custom' && $endDate ? $endDate->format('Y-m-d') : '' }}"
                                       class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Tampilkan Report
                            </button>
                        </div>
                    </form>

                    <!-- Current Period Display -->
                    <div class="mt-4 text-sm text-gray-600">
                        Periode: <span class="font-semibold">{{ $startDate->format('d M Y') }}</span> s/d <span class="font-semibold">{{ $endDate->format('d M Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Balance -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 uppercase">
                            Balance
                        </div>
                        <div class="mt-2 text-3xl font-bold {{ $balance >= 0 ? 'text-green-600' : 'text-red-600' }}">
                            Rp {{ number_format($balance, 0, ',', '.') }}
                        </div>
                    </div>
                </div>

                <!-- Total Income -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 uppercase">
                            Total Income
                        </div>
                        <div class="mt-2 text-3xl font-bold text-green-600">
                            Rp {{ number_format($totalIncome, 0, ',', '.') }}
                        </div>
                    </div>
                </div>

                <!-- Total Expense -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500 uppercase">
                            Total Expense
                        </div>
                        <div class="mt-2 text-3xl font-bold text-red-600">
                            Rp {{ number_format($totalExpense, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Pie Chart - Expense by Category -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            Pengeluaran per Kategori
                        </h3>
                        @if(empty($pieChartData['labels']))
                            <p class="text-gray-500">Tidak ada data pengeluaran</p>
                        @else
                            <div style="position: relative; height: 300px;">
                                <canvas id="pieChart"></canvas>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Daily Expense Trend - Line Chart -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            Tren Pengeluaran Harian
                        </h3>
                        @if(empty($dailyExpenseTrend['labels']))
                            <p class="text-gray-500">Tidak ada data pengeluaran harian</p>
                        @else
                            <div style="position: relative; height: 300px;">
                                <canvas id="trendChart"></canvas>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            <!-- Bar Chart - Income vs Expense per Month -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        Income vs Expense per Bulan (Tahun {{ date('Y') }})
                    </h3>
                    <div style="position: relative; height: 350px;">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Transaction List -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        Daftar Transaksi
                    </h3>
                    @if($transactions->isEmpty())
                        <p class="text-gray-500">Belum ada transaksi</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tanggal
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Kategori
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tipe
                                        </th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nominal
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Catatan
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($transactions as $transaction)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $transaction->transaction_date->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $transaction->category ? $transaction->category->name : '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    {{ $transaction->type === 'income' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $transaction->type === 'income' ? 'Pemasukan' : 'Pengeluaran' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right font-medium">
                                                Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">
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

        </div>
    </div>

    <!-- Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
    <script>
        function toggleCustomDate(value) {
            const customDateRange = document.getElementById('custom-date-range');
            if (value === 'custom') {
                customDateRange.classList.remove('hidden');
            } else {
                customDateRange.classList.add('hidden');
            }
        }

        // Pie Chart - Expense by Category
        @if(!empty($pieChartData['labels']))
            const pieCtx = document.getElementById('pieChart').getContext('2d');
            new Chart(pieCtx, {
                type: 'doughnut',
                data: {
                    labels: @json($pieChartData['labels']),
                    datasets: [{
                        data: @json($pieChartData['data']),
                        backgroundColor: @json($pieChartData['colors']),
                        borderColor: '#fff',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 15,
                                font: {
                                    size: 12
                                }
                            }
                        }
                    }
                }
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
                        label: 'Pengeluaran Harian (Rp)',
                        data: @json($dailyExpenseTrend['data']),
                        borderColor: 'rgba(239, 68, 68, 1)',
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 5,
                        pointBackgroundColor: 'rgba(239, 68, 68, 1)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointHoverRadius: 7
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp' + value.toLocaleString('id-ID');
                                }
                            }
                        }
                    }
                }
            });
        @endif

        // Bar Chart - Income vs Expense
        const barCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: @json($barChartData['labels']),
                datasets: [
                    {
                        label: 'Pemasukan (Rp)',
                        data: @json($barChartData['income']),
                        backgroundColor: 'rgba(34, 197, 94, 0.8)',
                        borderColor: 'rgba(22, 163, 74, 1)',
                        borderWidth: 1.5,
                        borderRadius: 5
                    },
                    {
                        label: 'Pengeluaran (Rp)',
                        data: @json($barChartData['expense']),
                        backgroundColor: 'rgba(239, 68, 68, 0.8)',
                        borderColor: 'rgba(220, 38, 38, 1)',
                        borderWidth: 1.5,
                        borderRadius: 5
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
