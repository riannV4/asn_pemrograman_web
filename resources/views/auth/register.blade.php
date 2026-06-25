<x-guest-layout title="Register">
    <div class="space-y-8">
        <!-- Header with Logo -->
        <div class="text-center">
            <div class="w-20 h-20 bg-gradient-to-br from-primary to-primary-dark rounded-full flex items-center justify-center shadow-fab mx-auto mb-6">
                <span class="material-symbols-rounded text-white text-4xl" style="font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;">account_balance_wallet</span>
            </div>
            <h2 class="text-headline-lg font-bold text-primary">Buat Akun Baru</h2>
            <p class="mt-2 text-body-md text-on-surface-variant">Daftar untuk memulai mengelola keuangan Anda</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" class="text-on-surface font-semibold mb-2" />
                <div class="relative">
                    <span class="material-symbols-rounded absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">person</span>
                    <x-text-input id="name" 
                        class="block w-full pl-12 pr-4 py-4 bg-surface-container border-2 border-outline-variant rounded-button focus:ring-2 focus:ring-primary focus:border-primary transition duration-200 text-body-lg" 
                        type="text" 
                        name="name" 
                        :value="old('name')" 
                        required 
                        autofocus 
                        autocomplete="name"
                        placeholder="Nama lengkap Anda" />
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-on-surface font-semibold mb-2" />
                <div class="relative">
                    <span class="material-symbols-rounded absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">mail</span>
                    <x-text-input id="email" 
                        class="block w-full pl-12 pr-4 py-4 bg-surface-container border-2 border-outline-variant rounded-button focus:ring-2 focus:ring-primary focus:border-primary transition duration-200 text-body-lg" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        required 
                        autocomplete="username"
                        placeholder="Masukkan email anda" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" class="text-on-surface font-semibold mb-2" />
                <div class="relative">
                    <span class="material-symbols-rounded absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">lock</span>
                    <x-text-input id="password" 
                        class="block w-full pl-12 pr-4 py-4 bg-surface-container border-2 border-outline-variant rounded-button focus:ring-2 focus:ring-primary focus:border-primary transition duration-200 text-body-lg"
                        type="password"
                        name="password"
                        required 
                        autocomplete="new-password"
                        placeholder="Minimal 8 karakter" />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-on-surface font-semibold mb-2" />
                <div class="relative">
                    <span class="material-symbols-rounded absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">lock_reset</span>
                    <x-text-input id="password_confirmation" 
                        class="block w-full pl-12 pr-4 py-4 bg-surface-container border-2 border-outline-variant rounded-button focus:ring-2 focus:ring-primary focus:border-primary transition duration-200 text-body-lg"
                        type="password"
                        name="password_confirmation" 
                        required 
                        autocomplete="new-password"
                        placeholder="Ulangi password Anda" />
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button type="submit" class="w-full flex items-center justify-center gap-2 py-4 px-6 border border-transparent rounded-button shadow-card text-body-lg font-bold text-white bg-gradient-to-r from-primary to-primary-dark hover:shadow-card-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-200 transform hover:scale-[1.02]">
                    <span class="material-symbols-rounded">person_add</span>
                    Daftar Sekarang
                </button>
            </div>

            <!-- Login Link -->
            <div class="text-center pt-6 border-t-2 border-outline-variant">
                <p class="text-body-md text-on-surface-variant">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="font-bold text-primary hover:text-primary-dark transition duration-200">
                        Masuk di sini
                    </a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
