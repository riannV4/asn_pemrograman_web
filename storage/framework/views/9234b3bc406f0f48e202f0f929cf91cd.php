<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'id' => null,
    'title' => 'Confirm',
    'confirmText' => 'Confirm',
    'cancelText' => 'Cancel',
    'type' => 'confirm', // 'confirm' or 'delete'
    'categoryName' => null,
    'categoryColor' => '#7c3aed',
    'categoryIcon' => 'sell'
]));

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

foreach (array_filter(([
    'id' => null,
    'title' => 'Confirm',
    'confirmText' => 'Confirm',
    'cancelText' => 'Cancel',
    'type' => 'confirm', // 'confirm' or 'delete'
    'categoryName' => null,
    'categoryColor' => '#7c3aed',
    'categoryIcon' => 'sell'
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<div x-data="{ show: false }" x-show="show" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4" style="display:none;" @open-modal.window="if($event.detail.id === '<?php echo e($id); ?>') show = true" @close-modal.window="if($event.detail.id === '<?php echo e($id); ?>') show = false">
    <?php if($type === 'delete'): ?>
        <div class="bg-white rounded-[32px] shadow-2xl max-w-sm w-full p-6 text-center" @click.away="show = false">
            <!-- Icon Header -->
            <div class="w-20 h-20 bg-red-50 border border-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-rounded text-red-500 text-3xl">delete</span>
            </div>

            <!-- Title -->
            <h3 class="text-xl font-bold text-gray-900 mb-2"><?php echo e($title); ?></h3>

            <!-- Category Badge (if available) -->
            <?php if($categoryName): ?>
                <div class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-sm font-semibold mb-4" style="background-color: <?php echo e($categoryColor); ?>15; color: <?php echo e($categoryColor); ?>;">
                    <span class="material-symbols-rounded text-base"><?php echo e($categoryIcon ?: 'sell'); ?></span>
                    <span><?php echo e($categoryName); ?></span>
                </div>
            <?php endif; ?>

            <!-- Description/Slot -->
            <div class="text-sm text-gray-500 px-2 leading-relaxed mb-6">
                <?php echo e($slot); ?>

            </div>

            <!-- Divider -->
            <hr class="border-t border-gray-100 w-full mb-6">

            <!-- Action Buttons -->
            <div class="flex gap-3">
                <button type="button" @click="show = false" class="flex-1 border border-gray-200 bg-white hover:bg-gray-50 text-gray-700 font-semibold py-3 px-4 rounded-xl flex items-center justify-center gap-2 transition-colors">
                    <span class="material-symbols-rounded text-lg">close</span>
                    <span><?php echo e($cancelText); ?></span>
                </button>
                <button type="button" @click="document.getElementById('<?php echo e($id); ?>-form').submit()" class="flex-1 bg-[#d32f2f] hover:bg-red-700 text-white font-semibold py-3 px-4 rounded-xl flex items-center justify-center gap-2 transition-colors">
                    <span class="material-symbols-rounded text-lg">delete</span>
                    <span><?php echo e($confirmText); ?></span>
                </button>
            </div>
        </div>
    <?php else: ?>
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6" @click.away="show = false">
            <h2 class="text-xl font-semibold mb-4" id="<?php echo e($id); ?>-title"><?php echo e($title); ?></h2>
            <div class="mb-6" id="<?php echo e($id); ?>-body">
                <?php echo e($slot); ?>

            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" @click="show = false" class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300"><?php echo e($cancelText); ?></button>
                <button type="button" @click="document.getElementById('<?php echo e($id); ?>-form').submit()" class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700"><?php echo e($confirmText); ?></button>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php /**PATH D:\projekpemro\asn_pemrograman_web\resources\views/components/modal.blade.php ENDPATH**/ ?>