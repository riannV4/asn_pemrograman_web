<x-layouts.mobile-app :currentPage="'transactions'">
    <div class="min-h-screen bg-gradient-to-br from-primary/5 via-background to-secondary/5 px-4 py-6">
            
            <!-- Header with Back Button -->
            <div class="mb-6 flex items-center gap-4">
                <a href="{{ route('transactions.index') }}" class="w-10 h-10 rounded-full hover:bg-surface-container flex items-center justify-center transition-colors">
                    <span class="material-symbols-outlined">arrow_back</span>
                </a>
                <div>
                    <h2 class="font-headline-lg text-headline-lg text-primary">Edit Transaksi</h2>
                    <p class="font-body-md text-body-md text-on-surface-variant text-sm">Ubah detail transaksi kamu</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card-shadow-lg bg-white rounded-[32px] p-6 mb-6">
                <form method="POST" action="{{ route('transactions.update', $transaction) }}" id="editForm">
                    @csrf
                    @method('PUT')

                    <!-- Type Tabs -->
                    <div class="flex bg-primary-container/30 rounded-2xl p-1 mb-6">
                        <button type="button" class="type-tab flex-1 px-4 py-3 rounded-xl font-semibold text-sm" data-type="expense" onclick="setType('expense')">Pengeluaran</button>
                        <button type="button" class="type-tab flex-1 px-4 py-3 rounded-xl font-semibold text-sm" data-type="income" onclick="setType('income')">Pemasukan</button>
                    </div>
                    <input type="hidden" name="type" id="type" value="{{ old('type', $transaction->type) }}" required>

                    <!-- Amount -->
                    <div class="mb-6">
                        <label class="font-semibold text-sm text-on-surface-variant mb-2 block">Nominal</label>
                        <div class="flex items-center border-b-2 border-primary/30 pb-3 focus-within:border-primary transition-colors">
                            <span class="text-4xl font-bold text-primary mr-2">Rp</span>
                            <input type="text" id="amount_display" class="w-full bg-transparent border-none p-0 focus:ring-0 text-4xl font-bold text-on-surface placeholder-outline-variant" placeholder="0" oninput="formatAmount(this)" autofocus>
                            <input type="hidden" name="amount" id="amount" value="{{ old('amount', $transaction->amount) }}" required>
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
                                <select name="category_id" id="category_id" class="w-full appearance-none bg-surface-container border border-outline-variant rounded-2xl px-4 py-3 font-body-md text-on-surface focus:border-primary focus:ring-2 focus:ring-primary/20">
                                    <option value="">Pilih</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" data-type="{{ $cat->type }}" {{ old('category_id', $transaction->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant">expand_more</span>
                            </div>
                        </div>
                        <div>
                            <label class="font-semibold text-sm text-on-surface-variant mb-2 block">Tanggal</label>
                            <input type="date" name="transaction_date" id="transaction_date" value="{{ old('transaction_date', $transaction->transaction_date->format('Y-m-d')) }}" class="w-full bg-surface-container border border-outline-variant rounded-2xl px-4 py-3 font-body-md text-on-surface focus:border-primary focus:ring-2 focus:ring-primary/20" required>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="mb-6">
                        <label class="font-semibold text-sm text-on-surface-variant mb-2 block">Catatan (Opsional)</label>
                        <input type="text" name="notes" id="notes" value="{{ old('notes', $transaction->notes) }}" placeholder="Tulis detail transaksi..." class="w-full bg-surface-container border border-outline-variant rounded-2xl px-4 py-3 font-body-md text-on-surface focus:border-primary focus:ring-2 focus:ring-primary/20">
                    </div>

                    <input type="hidden" name="input_method" id="input_method" value="{{ $transaction->input_method }}">

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
                        <span class="material-symbols-outlined">delete</span>
                        Hapus Transaksi
                    </button>
                </form>
            </div>

        </div>
    </div>

    <script>
        function setType(type) {
            document.getElementById('type').value = type;
            document.querySelectorAll('.type-tab').forEach(tab => {
                if (tab.dataset.type === type) {
                    tab.classList.add('bg-white', 'shadow-md', type === 'expense' ? 'text-error' : 'text-success');
                    tab.classList.remove('text-on-surface-variant');
                } else {
                    tab.classList.remove('bg-white', 'shadow-md', 'text-error', 'text-success');
                    tab.classList.add('text-on-surface-variant');
                }
            });
            
            const categorySelect = document.getElementById('category_id');
            const options = categorySelect.querySelectorAll('option');
            options.forEach(option => {
                if (option.value === '') {
                    option.style.display = '';
                } else {
                    const optionType = option.getAttribute('data-type');
                    if (optionType === type) {
                        option.style.display = '';
                    } else {
                        option.style.display = 'none';
                    }
                }
            });
            const selectedOption = categorySelect.options[categorySelect.selectedIndex];
            if (selectedOption && selectedOption.value !== '' && selectedOption.getAttribute('data-type') !== type) {
                categorySelect.value = '';
            }
        }
        
        function formatAmount(input) {
            let value = input.value.replace(/\D/g, '');
            document.getElementById('amount').value = value;
            input.value = value ? value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") : '';
        }

        document.addEventListener('DOMContentLoaded', function() {
            const initialType = "{{ old('type', $transaction->type) }}";
            const initialAmount = "{{ old('amount', $transaction->amount) }}";
            
            setType(initialType);
            if (initialAmount) {
                document.getElementById('amount').value = initialAmount;
                document.getElementById('amount_display').value = initialAmount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        });
    </script>
</x-layouts.mobile-app>
