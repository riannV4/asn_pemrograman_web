<x-layouts.mobile-app :currentPage="'transactions'">
    <div class="min-h-screen bg-gradient-to-br from-primary/5 via-background to-secondary/5 px-4 py-6">
            
            <!-- Header with Back Button -->
            <div class="mb-6 flex items-center gap-4">
                <a href="{{ route('transactions.index') }}" class="w-10 h-10 rounded-full hover:bg-surface-container flex items-center justify-center transition-colors">
                    <span class="material-symbols-rounded">arrow_back</span>
                </a>
                <div>
                    <h2 class="font-headline-lg text-headline-lg text-primary">Edit Transaksi</h2>
                    <p class="font-body-md text-body-md text-on-surface-variant text-sm">Ubah detail transaksi kamu</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card-shadow-lg bg-white rounded-[32px] p-6 mb-6">
                <form method="POST" action="{{ route('transactions.update', $transaction) }}" id="editForm" x-data="transactionEditForm()" @submit="validateForm($event)">
                    @csrf
                    @method('PUT')
 
                    <!-- Type Tabs -->
                    <div class="flex bg-primary-container/30 rounded-2xl p-1 mb-6">
                        <button type="button" 
                                @click="type = 'expense'"
                                :class="type === 'expense' ? 'bg-white shadow-md text-error' : 'text-on-surface-variant'"
                                class="flex-1 px-4 py-3 rounded-xl font-semibold text-sm transition-all">
                            Pengeluaran
                        </button>
                        <button type="button" 
                                @click="type = 'income'"
                                :class="type === 'income' ? 'bg-white shadow-md text-success' : 'text-on-surface-variant'"
                                class="flex-1 px-4 py-3 rounded-xl font-semibold text-sm transition-all">
                            Pemasukan
                        </button>
                    </div>
                    <input type="hidden" name="type" x-model="type">
 
                    <!-- Amount -->
                    <div class="mb-6">
                        <label class="font-semibold text-sm text-on-surface-variant mb-2 block">Nominal</label>
                        <div class="flex items-center border-b-2 border-primary/30 pb-3 focus-within:border-primary transition-colors">
                            <span class="text-4xl font-bold text-primary mr-2">Rp</span>
                            <input type="text" x-model="amountDisplay" @input="formatAmount()" class="w-full bg-transparent border-none p-0 focus:ring-0 text-4xl font-bold text-on-surface placeholder-outline-variant" placeholder="0" autofocus>
                            <input type="hidden" name="amount" x-model="amount">
                        </div>
                        @error('amount')
                            <p class="text-sm text-error mt-2">{{ $message }}</p>
                        @enderror
                    </div>
 
                    <!-- Category & Date -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="font-semibold text-sm text-on-surface-variant mb-2 block">Kategori</label>
                            <div class="relative">
                                <select name="category_id" id="category_id" x-model="categoryId" class="w-full appearance-none bg-surface-container border border-outline-variant rounded-2xl px-4 py-3 font-body-md text-on-surface focus:border-primary focus:ring-2 focus:ring-primary/20">
                                    <option value="">Pilih</option>
                                    <template x-for="cat in filteredCategories()" :key="cat.id">
                                        <option :value="cat.id" x-text="cat.name" :selected="categoryId == cat.id"></option>
                                    </template>
                                </select>
                                <span class="material-symbols-rounded absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant">expand_more</span>
                            </div>
                            @error('category_id')
                                <p class="text-sm text-error mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="font-semibold text-sm text-on-surface-variant mb-2 block">Tanggal</label>
                            <input type="date" name="transaction_date" x-model="transactionDate" class="w-full bg-surface-container border border-outline-variant rounded-2xl px-4 py-3 font-body-md text-on-surface focus:border-primary focus:ring-2 focus:ring-primary/20" required>
                        </div>
                    </div>
 
                    <!-- Notes -->
                    <div class="mb-6">
                        <label class="font-semibold text-sm text-on-surface-variant mb-2 block">Catatan (Opsional)</label>
                        <input type="text" name="notes" x-model="notes" placeholder="Tulis detail transaksi..." class="w-full bg-surface-container border border-outline-variant rounded-2xl px-4 py-3 font-body-md text-on-surface focus:border-primary focus:ring-2 focus:ring-primary/20">
                    </div>
 
 
                    <!-- Submit Buttons -->
                    <div class="flex gap-3">
                        <a href="{{ route('transactions.index') }}" class="flex-1 bg-surface-container border border-outline-variant text-on-surface font-semibold py-3 rounded-2xl hover:bg-surface-container-high transition-colors text-center">
                            Batal
                        </a>
                        <button type="submit" class="flex-1 bg-gradient-to-r from-primary to-primary-dark text-white font-bold py-3 rounded-2xl hover:scale-[1.02] transition-all card-shadow">
                            Update
                        </button>
                    </div>
                </form>
            </div>

            <!-- Delete Card -->
            <div class="card-shadow bg-white rounded-[28px] p-6">
                <h3 class="font-semibold text-error mb-2">Hapus Transaksi</h3>
                <p class="text-sm text-on-surface-variant mb-4">Tindakan ini tidak dapat dibatalkan</p>
                <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-gradient-to-r from-error to-red-600 text-white font-bold py-3 rounded-2xl hover:scale-[1.02] transition-all card-shadow flex items-center justify-center gap-2">
                        <span class="material-symbols-rounded">delete</span>
                        Hapus Transaksi
                    </button>
                </form>
            </div>

        </div>
    </div>

    <script>
        function transactionEditForm() {
            return {
                type: @json(old('type', $transaction->type)),
                amountDisplay: '',
                amount: @json(old('amount', $transaction->amount)),
                categoryId: @json(old('category_id', $transaction->category_id)),
                transactionDate: @json(old('transaction_date', $transaction->transaction_date->format('Y-m-d'))),
                notes: @json(old('notes', $transaction->notes)),
                inputMethod: @json($transaction->input_method),
                categories: @json($categories),

                init() {
                    this.amountDisplay = this.formatNumber(this.amount);
                    this.$watch('type', (value) => {
                        this.categoryId = '';
                    });
                },

                filteredCategories() {
                    return this.categories.filter(c => c.type === this.type);
                },

                formatAmount() {
                    const value = this.amountDisplay.replace(/\D/g, '');
                    this.amount = value;
                    this.amountDisplay = this.formatNumber(value);
                },

                formatNumber(num) {
                    if (!num) return '';
                    return parseInt(num).toLocaleString('id-ID');
                },

                validateForm(event) {
                    if (!this.amount || this.amount === '0' || this.amount === '') {
                        event.preventDefault();
                        alert('Mohon masukkan nominal transaksi!');
                        return false;
                    }
                    return true;
                }
            }
        }
    </script>
</x-layouts.mobile-app>
