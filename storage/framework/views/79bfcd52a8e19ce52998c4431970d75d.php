<section>
    <header class="mb-4">
        <h3 class="font-headline-md text-headline-md text-on-surface">Ubah Password</h3>
        <p class="mt-1 text-sm text-on-surface-variant">Pastikan akun kamu menggunakan password yang aman</p>
    </header>

    <form method="post" action="<?php echo e(route('password.update')); ?>" class="space-y-4">
        <?php echo csrf_field(); ?>
        <?php echo method_field('put'); ?>

        <div>
            <label for="update_password_current_password" class="font-semibold text-sm text-on-surface-variant mb-2 block">Password Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password" class="w-full bg-surface-container border border-outline-variant rounded-2xl px-4 py-3 font-body-md text-on-surface focus:border-primary focus:ring-2 focus:ring-primary/20" />
            <?php $__errorArgs = ['current_password', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="mt-2 text-sm text-error"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div>
            <label for="update_password_password" class="font-semibold text-sm text-on-surface-variant mb-2 block">Password Baru</label>
            <input id="update_password_password" name="password" type="password" autocomplete="new-password" class="w-full bg-surface-container border border-outline-variant rounded-2xl px-4 py-3 font-body-md text-on-surface focus:border-primary focus:ring-2 focus:ring-primary/20" />
            <?php $__errorArgs = ['password', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="mt-2 text-sm text-error"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div>
            <label for="update_password_password_confirmation" class="font-semibold text-sm text-on-surface-variant mb-2 block">Konfirmasi Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" class="w-full bg-surface-container border border-outline-variant rounded-2xl px-4 py-3 font-body-md text-on-surface focus:border-primary focus:ring-2 focus:ring-primary/20" />
            <?php $__errorArgs = ['password_confirmation', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="mt-2 text-sm text-error"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="flex-1 bg-gradient-to-r from-primary to-primary-dark text-white font-bold py-3 rounded-2xl hover:scale-[1.02] transition-all shadow-card">
                Simpan
            </button>

            <?php if(session('status') === 'password-updated'): ?>
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-success font-semibold">
                    Tersimpan!
                </p>
            <?php endif; ?>
        </div>
    </form>
</section>
<?php /**PATH D:\projekpemro\asn_pemrograman_web\resources\views/profile/partials/update-password-form.blade.php ENDPATH**/ ?>