<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('transactions.update', $transaction) }}">
                        @csrf
                        @method('PUT')

                        <!-- Category -->
                        <div class="mb-4">
                            <label for="category_id" class="block font-medium text-sm text-gray-700">
                                Kategori
                            </label>
                            <select id="category_id" 
                                    name="category_id" 
                                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">Pilih Kategori (Opsional)</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $transaction->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }} ({{ $category->type === 'income' ? 'Pemasukan' : 'Pengeluaran' }})
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Amount -->
                        <div class="mb-4">
                            <label for="amount" class="block font-medium text-sm text-gray-700">
                                Jumlah
                            </label>
                            <input id="amount" 
                                   class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                   type="number" 
                                   name="amount" 
                                   value="{{ old('amount', $transaction->amount) }}" 
                                   step="0.01"
                                   min="0"
                                   required />
                            @error('amount')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Type -->
                        <div class="mb-4">
                            <label for="type" class="block font-medium text-sm text-gray-700">
                                Tipe
                            </label>
                            <select id="type" 
                                    name="type" 
                                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required>
                                <option value="">Pilih Tipe</option>
                                <option value="income" {{ old('type', $transaction->type) === 'income' ? 'selected' : '' }}>Pemasukan</option>
                                <option value="expense" {{ old('type', $transaction->type) === 'expense' ? 'selected' : '' }}>Pengeluaran</option>
                            </select>
                            @error('type')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Transaction Date -->
                        <div class="mb-4">
                            <label for="transaction_date" class="block font-medium text-sm text-gray-700">
                                Tanggal Transaksi
                            </label>
                            <input id="transaction_date" 
                                   class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                   type="date" 
                                   name="transaction_date" 
                                   value="{{ old('transaction_date', $transaction->transaction_date->format('Y-m-d')) }}" 
                                   required />
                            @error('transaction_date')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Notes -->
                        <div class="mb-4">
                            <label for="notes" class="block font-medium text-sm text-gray-700">
                                Catatan
                            </label>
                            <textarea id="notes" 
                                      name="notes" 
                                      rows="3"
                                      class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('notes', $transaction->notes) }}</textarea>
                            @error('notes')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Input Method -->
                        <div class="mb-4">
                            <label for="input_method" class="block font-medium text-sm text-gray-700">
                                Metode Input
                            </label>
                            <select id="input_method" 
                                    name="input_method" 
                                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required>
                                <option value="manual" {{ old('input_method', $transaction->input_method) === 'manual' ? 'selected' : '' }}>Manual</option>
                                <option value="voice" {{ old('input_method', $transaction->input_method) === 'voice' ? 'selected' : '' }}>Voice</option>
                                <option value="scan" {{ old('input_method', $transaction->input_method) === 'scan' ? 'selected' : '' }}>Scan</option>
                            </select>
                            @error('input_method')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4 gap-4">
                            <a href="{{ route('transactions.index') }}" class="text-gray-600 hover:text-gray-900">
                                Batal
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
