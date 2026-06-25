<x-guest-layout>
    <div class="space-y-8">
        <!-- Header with Logo -->
        <div class="text-center">
            <div class="w-20 h-20 bg-primary rounded-full flex items-center justify-center shadow-fab mx-auto mb-6">
                <span class="material-symbols-rounded text-white text-4xl" style="font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;">lock_reset</span>
            </div>
            <h2 class="text-headline-lg font-bold text-primary">Lupa Password?</h2>
            <p class="mt-3 text-body-md text-on-surface-variant max-w-md mx-auto">
                Tidak masalah. Masukkan email Anda dan kami akan mengirimkan tautan untuk mereset password.
            </p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf

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
                        autofocus 
                        autocomplete="username"
                        placeholder="Masukkan email anda" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button type="submit" class="w-full flex items-center justify-center gap-2 py-4 px-6 border border-transparent rounded-button shadow-card text-body-lg font-bold text-white bg-primary hover:bg-primary-dark hover:shadow-card-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-200 transform hover:scale-[1.02]">
                    <span class="material-symbols-rounded">send</span>
                    Kirim Link Reset Password
                </button>
            </div>

            <!-- Back to Login Link -->
            <div class="text-center pt-6 border-t-2 border-outline-variant">
                <p class="text-body-md text-on-surface-variant">
                    Ingat password Anda? 
                    <a href="{{ route('login') }}" class="font-bold text-primary hover:text-primary-dark transition duration-200 inline-flex items-center gap-1">
                        <span class="material-symbols-rounded text-lg">arrow_back</span>
                        Kembali ke Login
                    </a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
