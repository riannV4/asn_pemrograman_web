<section>
    <header class="mb-4">
        <h3 class="font-headline-md text-headline-md text-on-surface">Informasi Profil</h3>
        <p class="mt-1 text-sm text-on-surface-variant">Update nama dan email akun kamu</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
        @csrf
        @method('patch')

        <div>
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

        <div class="flex items-center gap-3">
            <button type="submit" class="flex-1 bg-gradient-to-r from-primary to-primary-dark text-white font-bold py-3 rounded-2xl hover:scale-[1.02] transition-all card-shadow">
                Simpan
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-success font-semibold">
                    Tersimpan!
                </p>
            @endif
        </div>
    </form>
</section>
