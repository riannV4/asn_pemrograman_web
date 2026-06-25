<section>
    <header class="mb-4">
        <h3 class="font-headline-md text-headline-md text-error">Hapus Akun</h3>
        <p class="mt-1 text-sm text-on-surface-variant">
            Setelah akun dihapus, semua data akan hilang permanen. Pastikan untuk mengunduh data penting sebelum menghapus akun.
        </p>
    </header>

    <button
        type="button"
        onclick="document.getElementById('confirmUserDeletionModal').classList.remove('hidden')"
        class="w-full bg-gradient-to-r from-error to-red-600 text-white font-bold py-3 rounded-2xl hover:scale-[1.02] transition-all shadow-card flex items-center justify-center gap-2">
        <span class="material-symbols-rounded">delete_forever</span>
        Hapus Akun
    </button>
</section>

<!-- Delete Account Modal — auto-open when there are validation errors -->
<div id="confirmUserDeletionModal" class="{{ $errors->userDeletion->isNotEmpty() ? '' : 'hidden' }} fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4">
    <div class="bg-white rounded-[32px] shadow-2xl max-w-sm w-full p-6">
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-red-50 border border-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-rounded text-4xl text-error">warning</span>
            </div>
            <h2 class="text-xl font-bold text-gray-900 mb-2">
                Yakin ingin menghapus akun?
            </h2>
            <p class="text-sm text-gray-500">
                Semua data akan hilang permanen. Masukkan password untuk konfirmasi.
            </p>
        </div>

        <form method="POST" action="{{ route('profile.destroy') }}" id="deleteAccountForm">
            @csrf
            @method('delete')

            <div class="mb-6">
                <label for="delete_password" class="font-semibold text-sm text-on-surface-variant mb-2 block">Password</label>
                <input
                    id="delete_password"
                    name="password"
                    type="password"
                    placeholder="Masukkan password"
                    class="w-full bg-surface-container border border-outline-variant rounded-2xl px-4 py-3 text-on-surface focus:border-error focus:ring-2 focus:ring-error/20"
                    required />
                @error('password', 'userDeletion')
                    <p class="mt-2 text-sm text-error">{{ $message }}</p>
                @enderror
            </div>

            <hr class="border-t border-gray-100 mb-6">

            <div class="flex gap-3">
                <button
                    type="button"
                    onclick="document.getElementById('confirmUserDeletionModal').classList.add('hidden')"
                    class="flex-1 border border-gray-200 bg-white hover:bg-gray-50 text-gray-700 font-semibold py-3 px-4 rounded-xl flex items-center justify-center gap-2 transition-colors">
                    <span class="material-symbols-rounded text-lg">close</span>
                    Batal
                </button>
                <button
                    type="submit"
                    class="flex-1 bg-[#d32f2f] hover:bg-red-700 text-white font-semibold py-3 px-4 rounded-xl flex items-center justify-center gap-2 transition-colors">
                    <span class="material-symbols-rounded text-lg">delete_forever</span>
                    Hapus Akun
                </button>
            </div>
        </form>
    </div>
</div>
