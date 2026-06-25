<x-layouts.mobile-app :currentPage="'profile'">
    <div class="min-h-screen bg-gradient-to-br from-primary/5 via-background to-secondary/5 px-4 py-6 lg:px-8 lg:py-8">
        <div class="mx-auto w-full max-w-7xl lg:grid lg:grid-cols-[380px_1fr] lg:gap-6 lg:items-start">
        <aside class="mb-6 lg:sticky lg:top-8 lg:mb-0 lg:min-h-[calc(100vh-4rem)] rounded-card bg-primary p-[1px] shadow-card-hover">
            <div class="h-full rounded-[23px] bg-white/90 backdrop-blur-sm p-5 lg:p-6 flex flex-col">
            <div class="relative overflow-hidden rounded-card bg-primary p-6 text-white shadow-card">
                <div class="absolute top-0 right-0 w-36 h-36 bg-white/15 rounded-full -mr-16 -mt-16"></div>
                <div class="absolute bottom-0 left-0 w-28 h-28 bg-white/10 rounded-full -ml-12 -mb-12"></div>

                <div class="relative z-10 text-center">
                    <div class="w-24 h-24 rounded-full bg-white/25 backdrop-blur-sm flex items-center justify-center text-white text-4xl font-bold mx-auto mb-4 border-4 border-white/40 shadow-card">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <h3 class="text-headline-md font-bold text-white mb-1">{{ $user->name }}</h3>
                    <p class="text-white/85 text-body-md break-all">{{ $user->email }}</p>
                </div>
            </div>

            <div class="mt-5 grid grid-cols-2 gap-3">
                <div class="rounded-2xl bg-primary-container/70 p-4">
                    <span class="material-symbols-rounded text-primary mb-2">verified_user</span>
                    <p class="text-xs font-bold uppercase tracking-wider text-on-surface-variant">Status</p>
                    <p class="text-body-md font-bold text-on-surface">Aktif</p>
                </div>
                <div class="rounded-2xl bg-surface-container p-4">
                    <span class="material-symbols-rounded text-secondary mb-2">tune</span>
                    <p class="text-xs font-bold uppercase tracking-wider text-on-surface-variant">Akun</p>
                    <p class="text-body-md font-bold text-on-surface">Personal</p>
                </div>
            </div>

            <div class="mt-5 rounded-card bg-surface-container-low p-4">
                <p class="text-xs font-bold uppercase tracking-wider text-on-surface-variant mb-3">Pengaturan Cepat</p>
                <div class="space-y-2 text-body-md text-on-surface-variant">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-rounded text-primary text-xl">person</span>
                        <span>Kelola data profil, password, dan kategori.</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-rounded text-primary text-xl">lock</span>
                        <span>Perubahan keamanan tetap memakai form bawaan.</span>
                    </div>
                </div>
            </div>

            <div class="mt-auto pt-5">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full bg-gradient-to-r from-error to-red-600 text-white font-bold py-4 rounded-button hover:shadow-card-hover transition-all shadow-card flex items-center justify-center gap-2">
                        <span class="material-symbols-rounded">logout</span>
                        Logout
                    </button>
                </form>
            </div>
            </div>
        </aside>

        <div class="min-w-0">
        @if (session('success') || session('status'))
            <div class="bg-success-container border border-success/20 text-success px-4 py-3 rounded-card mb-4 shadow-card" role="alert">
                <span class="block text-sm font-semibold">{{ session('success') ?: session('status') }}</span>
            </div>
        @endif

        <div class="bg-surface rounded-card p-2 mb-4 shadow-card lg:p-3">
            <a href="{{ route('categories.index') }}" class="flex items-center justify-between p-4 hover:bg-primary-container/60 rounded-button transition-colors">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-tertiary-container flex items-center justify-center">
                        <span class="material-symbols-rounded text-tertiary">category</span>
                    </div>
                    <div class="text-left">
                        <p class="text-body-lg font-semibold text-on-surface">Kelola Kategori</p>
                        <p class="text-xs text-on-surface-variant">Atur kategori transaksi</p>
                    </div>
                </div>
                <span class="material-symbols-rounded text-on-surface-variant">chevron_right</span>
            </a>

            <button onclick="toggleSection('profileSection')" class="w-full flex items-center justify-between p-4 hover:bg-primary-container/60 rounded-button transition-colors">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center">
                        <span class="material-symbols-rounded text-primary">person</span>
                    </div>
                    <div class="text-left">
                        <p class="text-body-lg font-semibold text-on-surface">Edit Profil</p>
                        <p class="text-xs text-on-surface-variant">Ubah nama dan email</p>
                    </div>
                </div>
                <span class="material-symbols-rounded text-on-surface-variant">chevron_right</span>
            </button>

            <button onclick="toggleSection('passwordSection')" class="w-full flex items-center justify-between p-4 hover:bg-primary-container/60 rounded-button transition-colors">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center">
                        <span class="material-symbols-rounded text-secondary">lock</span>
                    </div>
                    <div class="text-left">
                        <p class="text-body-lg font-semibold text-on-surface">Ubah Password</p>
                        <p class="text-xs text-on-surface-variant">Update password akun</p>
                    </div>
                </div>
                <span class="material-symbols-rounded text-on-surface-variant">chevron_right</span>
            </button>

            <button onclick="toggleSection('deleteSection')" class="w-full flex items-center justify-between p-4 hover:bg-primary-container/60 rounded-button transition-colors">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-error-container flex items-center justify-center">
                        <span class="material-symbols-rounded text-error">delete_forever</span>
                    </div>
                    <div class="text-left">
                        <p class="text-body-lg font-semibold text-error">Hapus Akun</p>
                        <p class="text-xs text-on-surface-variant">Hapus akun permanen</p>
                    </div>
                </div>
                <span class="material-symbols-rounded text-on-surface-variant">chevron_right</span>
            </button>
        </div>

        <div id="profileSection" class="hidden bg-surface rounded-card p-6 mb-4 shadow-card lg:p-8">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div id="passwordSection" class="hidden bg-surface rounded-card p-6 mb-4 shadow-card lg:p-8">
            @include('profile.partials.update-password-form')
        </div>

        <div id="deleteSection" class="hidden bg-surface rounded-card p-6 mb-4 shadow-card lg:p-8">
            @include('profile.partials.delete-user-form')
        </div>

        <div class="bg-surface rounded-card p-4 mb-6 shadow-card lg:hidden">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full bg-gradient-to-r from-error to-red-600 text-white font-bold py-4 rounded-button hover:shadow-card-hover transition-all shadow-card flex items-center justify-center gap-2">
                    <span class="material-symbols-rounded">logout</span>
                    Logout
                </button>
            </form>
        </div>
        </div>
        </div>
    </div>

    <script>
        function toggleSection(sectionId) {
            const section = document.getElementById(sectionId);
            const allSections = ['profileSection', 'passwordSection', 'deleteSection'];

            if (!section) {
                return;
            }

            allSections.forEach(id => {
                if (id !== sectionId) {
                    document.getElementById(id)?.classList.add('hidden');
                }
            });

            section.classList.toggle('hidden');
        }
    </script>
</x-layouts.mobile-app>
