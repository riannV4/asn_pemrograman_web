<?php if (isset($component)) { $__componentOriginal8b1a96032cb10664afbc3f43162d0ab6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8b1a96032cb10664afbc3f43162d0ab6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.mobile-app','data' => ['currentPage' => 'transactions']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.mobile-app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['currentPage' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('transactions')]); ?>
    <div class="min-h-screen bg-gradient-to-br from-primary/5 via-background to-secondary/5 px-4 py-6">
            
            <!-- Header with Back Button -->
            <div class="mb-6 flex items-center gap-4">
                <a href="<?php echo e(route('transactions.index')); ?>" class="w-10 h-10 rounded-full hover:bg-surface-container flex items-center justify-center transition-colors">
                    <span class="material-symbols-outlined">arrow_back</span>
                </a>
                <div>
                    <h2 class="font-headline-lg text-headline-lg text-primary">Edit Transaksi</h2>
                    <p class="font-body-md text-body-md text-on-surface-variant text-sm">Ubah detail transaksi kamu</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card-shadow-lg bg-white rounded-[32px] p-6 mb-6">
                <form method="POST" action="<?php echo e(route('transactions.update', $transaction)); ?>" id="editForm">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <!-- Type Tabs -->
                    <div class="flex bg-primary-container/30 rounded-2xl p-1 mb-6">
                        <button type="button" class="type-tab flex-1 px-4 py-3 rounded-xl font-semibold text-sm" data-type="expense" onclick="setType('expense')">Pengeluaran</button>
                        <button type="button" class="type-tab flex-1 px-4 py-3 rounded-xl font-semibold text-sm" data-type="income" onclick="setType('income')">Pemasukan</button>
                    </div>
                    <input type="hidden" name="type" id="type" value="<?php echo e(old('type', $transaction->type)); ?>" required>

                    <!-- Amount -->
                    <div class="mb-6">
                        <label class="font-semibold text-sm text-on-surface-variant mb-2 block">Nominal</label>
                        <div class="flex items-center border-b-2 border-primary/30 pb-3 focus-within:border-primary transition-colors">
                            <span class="text-4xl font-bold text-primary mr-2">Rp</span>
                            <input type="text" id="amount_display" class="w-full bg-transparent border-none p-0 focus:ring-0 text-4xl font-bold text-on-surface placeholder-outline-variant" placeholder="0" oninput="formatAmount(this)" autofocus>
                            <input type="hidden" name="amount" id="amount" value="<?php echo e(old('amount', $transaction->amount)); ?>" required>
                        </div>
                        <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-sm text-error mt-2"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Category & Date -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="font-semibold text-sm text-on-surface-variant mb-2 block">Kategori</label>
                            <div class="relative">
                                <select name="category_id" id="category_id" class="w-full appearance-none bg-surface-container border border-outline-variant rounded-2xl px-4 py-3 font-body-md text-on-surface focus:border-primary focus:ring-2 focus:ring-primary/20">
                                    <option value="">Pilih</option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($cat->id); ?>" data-type="<?php echo e($cat->type); ?>" <?php echo e(old('category_id', $transaction->category_id) == $cat->id ? 'selected' : ''); ?>><?php echo e($cat->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant">expand_more</span>
                            </div>
                        </div>
                        <div>
                            <label class="font-semibold text-sm text-on-surface-variant mb-2 block">Tanggal</label>
                            <input type="date" name="transaction_date" id="transaction_date" value="<?php echo e(old('transaction_date', $transaction->transaction_date->format('Y-m-d'))); ?>" class="w-full bg-surface-container border border-outline-variant rounded-2xl px-4 py-3 font-body-md text-on-surface focus:border-primary focus:ring-2 focus:ring-primary/20" required>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="mb-6">
                        <label class="font-semibold text-sm text-on-surface-variant mb-2 block">Catatan (Opsional)</label>
                        <input type="text" name="notes" id="notes" value="<?php echo e(old('notes', $transaction->notes)); ?>" placeholder="Tulis detail transaksi..." class="w-full bg-surface-container border border-outline-variant rounded-2xl px-4 py-3 font-body-md text-on-surface focus:border-primary focus:ring-2 focus:ring-primary/20">
                    </div>

                    <input type="hidden" name="input_method" id="input_method" value="<?php echo e($transaction->input_method); ?>">

                    <!-- Submit Buttons -->
                    <div class="flex gap-3">
                        <a href="<?php echo e(route('transactions.index')); ?>" class="flex-1 bg-surface-container border border-outline-variant text-on-surface font-semibold py-3 rounded-2xl hover:bg-surface-container-high transition-colors text-center">
                            Batal
                        </a>
                        <button type="submit" class="flex-1 bg-gradient-to-r from-primary to-primary-dark text-white font-bold py-3 rounded-2xl hover:scale-[1.02] transition-all card-shadow">
                            Update
                        </button>
                    </div>
                </form>
            </div>

            <!-- Delete Card -->
            <div class="card-shadow bg-white rounded-[28px] p-6">
                <h3 class="font-semibold text-error mb-2">Hapus Transaksi</h3>
                <p class="text-sm text-on-surface-variant mb-4">Tindakan ini tidak dapat dibatalkan</p>
                <form action="<?php echo e(route('transactions.destroy', $transaction)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?');">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="w-full bg-gradient-to-r from-error to-red-600 text-white font-bold py-3 rounded-2xl hover:scale-[1.02] transition-all card-shadow flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">delete</span>
                        Hapus Transaksi
                    </button>
                </form>
            </div>

        </div>
    </div>

    <script>
        function setType(type) {
            document.getElementById('type').value = type;
            document.querySelectorAll('.type-tab').forEach(tab => {
                if (tab.dataset.type === type) {
                    tab.classList.add('bg-white', 'shadow-md', type === 'expense' ? 'text-error' : 'text-success');
                    tab.classList.remove('text-on-surface-variant');
                } else {
                    tab.classList.remove('bg-white', 'shadow-md', 'text-error', 'text-success');
                    tab.classList.add('text-on-surface-variant');
                }
            });
            
            const categorySelect = document.getElementById('category_id');
            const options = categorySelect.querySelectorAll('option');
            options.forEach(option => {
                if (option.value === '') {
                    option.style.display = '';
                } else {
                    const optionType = option.getAttribute('data-type');
                    if (optionType === type) {
                        option.style.display = '';
                    } else {
                        option.style.display = 'none';
                    }
                }
            });
            const selectedOption = categorySelect.options[categorySelect.selectedIndex];
            if (selectedOption && selectedOption.value !== '' && selectedOption.getAttribute('data-type') !== type) {
                categorySelect.value = '';
            }
        }
        
        function formatAmount(input) {
            let value = input.value.replace(/\D/g, '');
            document.getElementById('amount').value = value;
            input.value = value ? value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") : '';
        }

        document.addEventListener('DOMContentLoaded', function() {
            const initialType = "<?php echo e(old('type', $transaction->type)); ?>";
            const initialAmount = "<?php echo e(old('amount', $transaction->amount)); ?>";
            
            setType(initialType);
            if (initialAmount) {
                document.getElementById('amount').value = initialAmount;
                document.getElementById('amount_display').value = initialAmount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        });
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
<?php /**PATH C:\Users\alfat\Favorites\asn_pemrograman_web\resources\views/transactions/edit.blade.php ENDPATH**/ ?>