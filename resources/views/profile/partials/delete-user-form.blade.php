<section>
    <header class="mb-4">
        <h3 class="font-headline-md text-headline-md text-error">Hapus Akun</h3>
        <p class="mt-1 text-sm text-on-surface-variant">
            Setelah akun dihapus, semua data akan hilang permanen. Pastikan untuk mengunduh data penting sebelum menghapus akun.
        </p>
    </header>

    <button 
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="w-full bg-gradient-to-r from-error to-red-600 text-white font-bold py-3 rounded-2xl hover:scale-[1.02] transition-all card-shadow flex items-center justify-center gap-2">
        <span class="material-symbols-outlined">delete_forever</span>
        Hapus Akun
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-error-container rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="material-symbols-outlined text-4xl text-error">warning</span>
                </div>
                <h2 class="font-headline-md text-headline-md text-on-surface mb-2">
                    Yakin ingin menghapus akun?
                </h2>
                <p class="text-sm text-on-surface-variant">
                    Semua data akan hilang permanen. Masukkan password untuk konfirmasi.
                </p>
            </div>

            <div class="mb-6">
                <label for="password" class="font-semibold text-sm text-on-surface-variant mb-2 block">Password</label>
                <input 
                    id="password"
                    name="password"
                    type="password"
                    placeholder="Masukkan password"
                    class="w-full bg-surface-container border border-outline-variant rounded-2xl px-4 py-3 font-body-md text-on-surface focus:border-error focus:ring-2 focus:ring-error/20" />
                @error('password', 'userDeletion')
                    <p class="mt-2 text-sm text-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="flex-1 bg-surface-container border border-outline-variant text-on-surface font-semibold py-3 rounded-2xl hover:bg-surface-container-high transition-colors">
                    Batal
                </button>
                <button type="submit" class="flex-1 bg-gradient-to-r from-error to-red-600 text-white font-bold py-3 rounded-2xl hover:scale-[1.02] transition-all card-shadow">
                    Hapus Akun
                </button>
            </div>
        </form>
    </x-modal>
</section>
