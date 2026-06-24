<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['current' => 'dashboard']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['current' => 'dashboard']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-outline-variant shadow-lg z-50">
    <div class="max-w-md mx-auto px-4">
        <div class="flex items-center justify-around h-16">
            <!-- Beranda -->
            <a href="<?php echo e(route('dashboard')); ?>" 
               class="flex flex-col items-center justify-center flex-1 py-2 transition-colors duration-200 <?php echo e($current === 'dashboard' ? 'text-primary' : 'text-on-surface-variant'); ?>">
                <span class="material-symbols-rounded text-2xl" style="<?php echo e($current === 'dashboard' ? 'font-variation-settings: \'FILL\' 1, \'wght\' 400, \'GRAD\' 0, \'opsz\' 24;' : ''); ?>">
                    grid_view
                </span>
                <span class="text-xs mt-1 font-medium">Beranda</span>
            </a>

            <!-- Catat -->
            <a href="<?php echo e(route('transactions.create')); ?>" 
               class="flex flex-col items-center justify-center flex-1 py-2 transition-colors duration-200 <?php echo e($current === 'create' ? 'text-primary' : 'text-on-surface-variant'); ?>">
                <span class="material-symbols-rounded text-2xl" style="<?php echo e($current === 'create' ? 'font-variation-settings: \'FILL\' 1, \'wght\' 400, \'GRAD\' 0, \'opsz\' 24;' : ''); ?>">
                    add_circle
                </span>
                <span class="text-xs mt-1 font-medium">Catat</span>
            </a>

            <!-- Laporan -->
            <a href="<?php echo e(route('reports')); ?>" 
               class="flex flex-col items-center justify-center flex-1 py-2 transition-colors duration-200 <?php echo e($current === 'reports' ? 'text-primary' : 'text-on-surface-variant'); ?>">
                <span class="material-symbols-rounded text-2xl" style="<?php echo e($current === 'reports' ? 'font-variation-settings: \'FILL\' 1, \'wght\' 400, \'GRAD\' 0, \'opsz\' 24;' : ''); ?>">
                    bar_chart
                </span>
                <span class="text-xs mt-1 font-medium">Laporan</span>
            </a>

            <!-- Pengaturan -->
            <a href="<?php echo e(route('profile.edit')); ?>" 
               class="flex flex-col items-center justify-center flex-1 py-2 transition-colors duration-200 <?php echo e($current === 'profile' ? 'text-primary' : 'text-on-surface-variant'); ?>">
                <span class="material-symbols-rounded text-2xl" style="<?php echo e($current === 'profile' ? 'font-variation-settings: \'FILL\' 1, \'wght\' 400, \'GRAD\' 0, \'opsz\' 24;' : ''); ?>">
                    settings
                </span>
                <span class="text-xs mt-1 font-medium">Pengaturan</span>
            </a>
        </div>
    </div>
</nav>
<?php /**PATH E:\asn_pemrograman_web\asn_pemrograman_web\resources\views/components/layouts/bottom-nav.blade.php ENDPATH**/ ?>