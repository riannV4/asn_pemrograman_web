<?php if (isset($component)) { $__componentOriginal8b1a96032cb10664afbc3f43162d0ab6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8b1a96032cb10664afbc3f43162d0ab6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.mobile-app','data' => ['currentPage' => 'profile']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.mobile-app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['currentPage' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('profile')]); ?>
    <div class="min-h-screen bg-gradient-to-br from-primary/5 via-background to-secondary/5 px-4 py-6">
        <div class="bg-gradient-to-br from-primary to-primary-dark rounded-card p-6 mb-6 relative overflow-hidden shadow-card">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full -ml-12 -mb-12"></div>

            <div class="relative z-10 text-center">
                <div class="w-20 h-20 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white text-3xl font-bold mx-auto mb-3 border-4 border-white/30">
                    <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                </div>
                <h3 class="text-headline-md font-bold text-white mb-1"><?php echo e($user->name); ?></h3>
                <p class="text-white/80 text-body-md"><?php echo e($user->email); ?></p>
            </div>
        </div>

        <?php if(session('success') || session('status')): ?>
            <div class="bg-success-container border border-success/20 text-success px-4 py-3 rounded-card mb-4 shadow-card" role="alert">
                <span class="block text-sm font-semibold"><?php echo e(session('success') ?: session('status')); ?></span>
            </div>
        <?php endif; ?>

        <div class="bg-surface rounded-card p-2 mb-4 shadow-card">
            <a href="<?php echo e(route('categories.index')); ?>" class="flex items-center justify-between p-4 hover:bg-surface-container rounded-button transition-colors">
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

            <button onclick="toggleSection('profileSection')" class="w-full flex items-center justify-between p-4 hover:bg-surface-container rounded-button transition-colors">
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

            <button onclick="toggleSection('passwordSection')" class="w-full flex items-center justify-between p-4 hover:bg-surface-container rounded-button transition-colors">
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

            <button onclick="toggleSection('deleteSection')" class="w-full flex items-center justify-between p-4 hover:bg-surface-container rounded-button transition-colors">
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

        <div id="profileSection" class="hidden bg-surface rounded-card p-6 mb-4 shadow-card">
            <?php echo $__env->make('profile.partials.update-profile-information-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

        <div id="passwordSection" class="hidden bg-surface rounded-card p-6 mb-4 shadow-card">
            <?php echo $__env->make('profile.partials.update-password-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

        <div id="deleteSection" class="hidden bg-surface rounded-card p-6 mb-4 shadow-card">
            <?php echo $__env->make('profile.partials.delete-user-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

        <div class="bg-surface rounded-card p-4 mb-6 shadow-card">
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="w-full bg-gradient-to-r from-error to-red-600 text-white font-bold py-4 rounded-button hover:shadow-card-hover transition-all shadow-card flex items-center justify-center gap-2">
                    <span class="material-symbols-rounded">logout</span>
                    Logout
                </button>
            </form>
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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8b1a96032cb10664afbc3f43162d0ab6)): ?>
<?php $attributes = $__attributesOriginal8b1a96032cb10664afbc3f43162d0ab6; ?>
<?php unset($__attributesOriginal8b1a96032cb10664afbc3f43162d0ab6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8b1a96032cb10664afbc3f43162d0ab6)): ?>
<?php $component = $__componentOriginal8b1a96032cb10664afbc3f43162d0ab6; ?>
<?php unset($__componentOriginal8b1a96032cb10664afbc3f43162d0ab6); ?>
<?php endif; ?>
<?php /**PATH E:\asn_pemrograman_web\asn_pemrograman_web\resources\views/profile/edit.blade.php ENDPATH**/ ?>