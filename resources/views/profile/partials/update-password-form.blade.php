<section>
    <header class="mb-6">
        <h2 class="text-lg font-bold text-on-surface">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-on-surface-variant">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-4">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1">{{ __('Current Password') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" class="w-full border-outline-variant focus:border-primary focus:ring-primary rounded-xl shadow-sm text-sm" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password" class="block text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1">{{ __('New Password') }}</label>
            <input id="update_password_password" name="password" type="password" class="w-full border-outline-variant focus:border-primary focus:ring-primary rounded-xl shadow-sm text-sm" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-1">{{ __('Confirm Password') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="w-full border-outline-variant focus:border-primary focus:ring-primary rounded-xl shadow-sm text-sm" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="bg-primary text-on-primary hover:bg-primary-container font-bold py-2.5 px-6 rounded-xl transition-all active:scale-95 text-sm">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-on-surface-variant font-medium"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
