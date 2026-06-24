<section>
<<<<<<< HEAD
    <header class="mb-4">
        <h3 class="font-headline-md text-headline-md text-on-surface">Informasi Profil</h3>
        <p class="mt-1 text-sm text-on-surface-variant">Update nama dan email akun kamu</p>
=======
    <header class="mb-6">
        <h2 class="text-lg font-bold text-on-surface">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-on-surface-variant">
            {{ __("Update your account's profile information and email address.") }}
        </p>
>>>>>>> main
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
        @csrf
        @method('patch')

        <div>
<<<<<<< HEAD
            <label for="name" class="font-semibold text-sm text-on-surface-variant mb-2 block">Nama</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" class="w-full bg-surface-container border border-outline-variant rounded-2xl px-4 py-3 font-body-md text-on-surface focus:border-primary focus:ring-2 focus:ring-primary/20" />
            @error('name')
                <p class="mt-2 text-sm text-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="font-semibold text-sm text-on-surface-variant mb-2 block">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username" class="w-full bg-surface-container border border-outline-variant rounded-2xl px-4 py-3 font-body-md text-on-surface focus:border-primary focus:ring-2 focus:ring-primary/20" />
            @error('email')
                <p class="mt-2 text-sm text-error">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-on-surface-variant">
                        Email belum diverifikasi.
                        <button form="send-verification" class="underline text-primary hover:text-primary-dark">
                            Kirim ulang email verifikasi
=======
            <label for="name" class="block text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1">{{ __('Name') }}</label>
            <input id="name" name="name" type="text" class="w-full border-outline-variant focus:border-primary focus:ring-primary rounded-xl shadow-sm text-sm" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <label for="email" class="block text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" class="w-full border-outline-variant focus:border-primary focus:ring-primary rounded-xl shadow-sm text-sm" value="{{ old('email', $user->email) }}" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 p-3 bg-error-container/20 rounded-xl border border-error/10">
                    <p class="text-sm text-on-surface">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-primary hover:text-primary-container rounded-md focus:outline-none">
                            {{ __('Click here to re-send the verification email.') }}
>>>>>>> main
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-success">
                            Link verifikasi baru telah dikirim ke email kamu.
                        </p>
                    @endif
                </div>
            @endif
        </div>

<<<<<<< HEAD
        <div class="flex items-center gap-3">
            <button type="submit" class="flex-1 bg-gradient-to-r from-primary to-primary-dark text-white font-bold py-3 rounded-2xl hover:scale-[1.02] transition-all card-shadow">
                Simpan
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-success font-semibold">
                    Tersimpan!
                </p>
=======
        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="bg-primary text-on-primary hover:bg-primary-container font-bold py-2.5 px-6 rounded-xl transition-all active:scale-95 text-sm">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-on-surface-variant font-medium"
                >{{ __('Saved.') }}</p>
>>>>>>> main
            @endif
        </div>
    </form>
</section>
