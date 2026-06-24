@props(['current' => 'dashboard'])

<nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-outline-variant shadow-lg z-50">
    <div class="max-w-md mx-auto px-4">
        <div class="flex items-center justify-around h-16">
            <!-- Beranda -->
            <a href="{{ route('dashboard') }}" 
               class="flex flex-col items-center justify-center flex-1 py-2 transition-colors duration-200 {{ ($current === 'dashboard' || $current === 'transactions') ? 'text-primary' : 'text-on-surface-variant' }}">
                <span class="material-symbols-rounded text-2xl" style="{{ ($current === 'dashboard' || $current === 'transactions') ? 'font-variation-settings: \'FILL\' 1, \'wght\' 400, \'GRAD\' 0, \'opsz\' 24;' : '' }}">
                    grid_view
                </span>
                <span class="text-xs mt-1 font-medium">Beranda</span>
            </a>

            <!-- Catat -->
            <a href="{{ route('transactions.create') }}" 
               class="flex flex-col items-center justify-center flex-1 py-2 transition-colors duration-200 {{ $current === 'create' ? 'text-primary' : 'text-on-surface-variant' }}">
                <span class="material-symbols-rounded text-2xl" style="{{ $current === 'create' ? 'font-variation-settings: \'FILL\' 1, \'wght\' 400, \'GRAD\' 0, \'opsz\' 24;' : '' }}">
                    add_circle
                </span>
                <span class="text-xs mt-1 font-medium">Catat</span>
            </a>

            <!-- Laporan -->
            <a href="{{ route('reports') }}" 
               class="flex flex-col items-center justify-center flex-1 py-2 transition-colors duration-200 {{ $current === 'reports' ? 'text-primary' : 'text-on-surface-variant' }}">
                <span class="material-symbols-rounded text-2xl" style="{{ $current === 'reports' ? 'font-variation-settings: \'FILL\' 1, \'wght\' 400, \'GRAD\' 0, \'opsz\' 24;' : '' }}">
                    bar_chart
                </span>
                <span class="text-xs mt-1 font-medium">Laporan</span>
            </a>

            <!-- Pengaturan -->
            <a href="{{ route('profile.edit') }}" 
               class="flex flex-col items-center justify-center flex-1 py-2 transition-colors duration-200 {{ $current === 'profile' ? 'text-primary' : 'text-on-surface-variant' }}">
                <span class="material-symbols-rounded text-2xl" style="{{ $current === 'profile' ? 'font-variation-settings: \'FILL\' 1, \'wght\' 400, \'GRAD\' 0, \'opsz\' 24;' : '' }}">
                    settings
                </span>
                <span class="text-xs mt-1 font-medium">Pengaturan</span>
            </a>
        </div>
    </div>
</nav>
