<x-layouts.mobile-app :currentPage="'profile'">
    <div class="min-h-screen bg-gradient-to-br from-primary/5 via-background to-secondary/5 px-4 py-6">
        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-headline-lg font-bold text-on-surface">Tambah Kategori</h2>
        </div>
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('categories.store') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="block font-medium text-sm text-gray-700">
                                Nama Kategori
                            </label>
                            <input id="name" 
                                   class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                   type="text" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   required 
                                   maxlength="50"
                                   autofocus />
                            @error('name')
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
                                <option value="income" {{ old('type') === 'income' ? 'selected' : '' }}>Pemasukan</option>
                                <option value="expense" {{ old('type') === 'expense' ? 'selected' : '' }}>Pengeluaran</option>
                            </select>
                            @error('type')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4 gap-4">
                            <a href="{{ route('categories.index') }}" class="text-gray-600 hover:text-gray-900">
                                Batal
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.mobile-app>
