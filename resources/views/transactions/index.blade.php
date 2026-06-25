<x-layouts.mobile-app :currentPage="'transactions'">
    <div class="min-h-screen bg-gradient-to-br from-primary/5 via-background to-secondary/5 px-4 py-6 lg:px-8 lg:py-8">
        @if (session('success'))
            <div class="mb-6 bg-success-container border border-success text-success px-4 py-3 rounded-button shadow-card" role="alert">
                <span class="block text-body-md font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-headline-lg font-bold text-on-surface mb-1">Daftar Transaksi</h2>
            <p class="text-body-md text-on-surface-variant">Riwayat transaksi kamu</p>
        </div>

        <!-- Filter Section -->
        <div class="bg-surface rounded-card p-4 mb-6 shadow-card">
            <form method="GET" action="{{ route('transactions.index') }}" class="space-y-4 lg:grid lg:grid-cols-[1fr_auto_auto_auto] lg:items-end lg:gap-3 lg:space-y-0">
                <!-- Search -->
                <div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari transaksi..." 
                           class="w-full bg-surface-container border-2 border-outline rounded-button px-4 py-3 text-body-lg text-on-surface focus:border-primary focus:ring-0">
                </div>
                
                <!-- Filter Row -->
                <div class="grid grid-cols-2 gap-3 lg:contents">
                    <select name="category_id" class="w-full bg-surface-container border-2 border-outline rounded-button px-4 py-3 text-body-md text-on-surface focus:border-primary focus:ring-0">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    
                    <select name="type" class="w-full bg-surface-container border-2 border-outline rounded-button px-4 py-3 text-body-md text-on-surface focus:border-primary focus:ring-0">
                        <option value="">Semua Tipe</option>
                        <option value="income" {{ request('type') == 'income' ? 'selected' : '' }}>Pemasukan</option>
                        <option value="expense" {{ request('type') == 'expense' ? 'selected' : '' }}>Pengeluaran</option>
                    </select>
                </div>
                
                <button type="submit" class="w-full lg:w-auto lg:px-8 bg-primary text-white font-bold py-3 rounded-button hover:bg-primary-dark transition-colors">
                    Filter
                </button>
            </form>
        </div>

        <!-- Transactions List -->
        <div>
            @if($transactions->isEmpty())
                <div class="bg-surface rounded-card p-12 text-center shadow-card">
                    <span class="material-symbols-rounded text-6xl text-on-surface-variant opacity-30">receipt_long</span>
                    <p class="mt-4 text-on-surface-variant text-body-md">
                        @if(request()->hasAny(['search', 'category_id', 'type']))
                            Tidak ada transaksi yang sesuai dengan filter. 
                            <a href="{{ route('transactions.index') }}" class="text-primary hover:underline font-semibold">Reset filter</a>
                        @else
                            Belum ada transaksi. Mulai catat transaksi kamu!
                        @endif
                    </p>
                    <a href="{{ route('transactions.create') }}" class="mt-6 inline-flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-button font-semibold hover:bg-primary-dark transition-colors">
                        <span class="material-symbols-rounded">add</span>
                        Tambah Transaksi
                    </a>
                </div>
            @else
                @php
                    $groupedTransactions = $transactions->groupBy(function($transaction) {
                        return $transaction->transaction_date->format('Y-m-d');
                    });
                @endphp

                @foreach($groupedTransactions as $date => $dateTransactions)
                    <div class="mb-6">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-on-surface-variant mb-3 px-2">
                            {{ \Carbon\Carbon::parse($date)->isoFormat('dddd, D MMMM YYYY') }}
                        </h4>
                        
                        <div class="bg-surface rounded-card p-2 shadow-card space-y-1">
                            @foreach($dateTransactions as $transaction)
                                <div class="flex items-center gap-3 p-3 hover:bg-surface-container rounded-button transition-colors">
                                    <!-- Icon -->
                                    <div class="w-12 h-12 rounded-full flex items-center justify-center shrink-0 {{ $transaction->type === 'income' ? 'bg-success-container text-success' : 'bg-primary-container text-primary' }}">
                                        @php
                                            $categoryIcons = [
                                                'makanan' => 'restaurant', 'food' => 'restaurant', 'makan' => 'restaurant',
                                                'transportasi' => 'directions_bike', 'transport' => 'directions_bike',
                                                'laundry' => 'local_laundry_service', 'kopi' => 'coffee', 'coffee' => 'coffee',
                                                'entertainment' => 'sports_esports', 'hiburan' => 'sports_esports',
                                                'belanja' => 'shopping_cart', 'shopping' => 'shopping_cart',
                                                'gaji' => 'account_balance_wallet', 'salary' => 'account_balance_wallet',
                                                'cashback' => 'account_balance_wallet',
                                            ];
                                            $icon = $transaction->type === 'income' ? 'arrow_downward' : 'arrow_upward';
                                            if ($transaction->category) {
                                                $categoryLower = strtolower($transaction->category->name);
                                                foreach($categoryIcons as $key => $value) {
                                                    if(str_contains($categoryLower, $key)) {
                                                        $icon = $value;
                                                        break;
                                                    }
                                                }
                                            }
                                        @endphp
                                        <span class="material-symbols-rounded">{{ $icon }}</span>
                                    </div>

                                    <!-- Info -->
                                    <div class="flex-1 min-w-0">
                                        <p class="text-body-lg font-semibold text-on-surface truncate">
                                            {{ Str::limit($transaction->notes ?: ($transaction->category ? $transaction->category->name : 'Transaksi'), 40) }}
                                        </p>
                                        <p class="text-xs text-on-surface-variant flex items-center gap-1">
                                            @if($transaction->category)
                                                <span class="truncate">{{ $transaction->category->name }}</span>
                                            @else
                                                <span class="truncate">Tanpa Kategori</span>
                                            @endif
                                            <span>•</span>
                                            <span class="capitalize">{{ $transaction->input_method }}</span>
                                        </p>
                                    </div>

                                    <!-- Amount -->
                                    <div class="text-right shrink-0">
                                        <p class="text-body-lg font-bold {{ $transaction->type === 'income' ? 'text-success' : 'text-error' }} whitespace-nowrap">
                                            {{ $transaction->type === 'income' ? '+' : '-' }} Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                        </p>
                                    </div>

                                    <!-- Edit Button -->
                                    <a href="{{ route('transactions.edit', $transaction) }}" class="w-9 h-9 rounded-full hover:bg-primary-container flex items-center justify-center text-primary transition-colors shrink-0">
                                        <span class="material-symbols-rounded text-xl">edit</span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <!-- Pagination Links -->
                <div class="mt-6 flex justify-center">
                    {{ $transactions->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layouts.mobile-app>
