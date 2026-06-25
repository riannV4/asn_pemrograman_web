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
                    <span class="material-symbols-rounded">arrow_back</span>
                </a>
                <div>
                    <h2 class="font-headline-lg text-headline-lg text-primary">Edit Transaksi</h2>
                    <p class="font-body-md text-body-md text-on-surface-variant text-sm">Ubah detail transaksi kamu</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card-shadow-lg bg-white rounded-[32px] p-6 mb-6">
                <form method="POST" action="<?php echo e(route('transactions.update', $transaction)); ?>" id="editForm" x-data="transactionEditForm()" @submit="validateForm($event)">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <input type="hidden" name="input_method" x-model="inputMethod">
 
                    <!-- Type Tabs -->
                    <div class="flex bg-primary-container/30 rounded-2xl p-1 mb-6">
                        <button type="button" 
                                @click="type = 'expense'"
                                :class="type === 'expense' ? 'bg-white shadow-md text-error' : 'text-on-surface-variant'"
                                class="flex-1 px-4 py-3 rounded-xl font-semibold text-sm transition-all">
                            Pengeluaran
                        </button>
                        <button type="button" 
                                @click="type = 'income'"
                                :class="type === 'income' ? 'bg-white shadow-md text-success' : 'text-on-surface-variant'"
                                class="flex-1 px-4 py-3 rounded-xl font-semibold text-sm transition-all">
                            Pemasukan
                        </button>
                    </div>
                    <input type="hidden" name="type" x-model="type">
 
                    <!-- Amount -->
                    <div class="mb-6">
                        <label class="font-semibold text-sm text-on-surface-variant mb-2 block">Nominal</label>
                        <div class="flex items-center border-b-2 border-primary/30 pb-3 focus-within:border-primary transition-colors">
                            <span class="text-4xl font-bold text-primary mr-2">Rp</span>
                            <input type="text" x-model="amountDisplay" @input="formatAmount()" class="w-full bg-transparent border-none p-0 focus:ring-0 text-4xl font-bold text-on-surface placeholder-outline-variant" placeholder="0" autofocus>
                            <input type="hidden" name="amount" x-model="amount">
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
                                <select name="category_id" id="category_id" x-model="categoryId" class="w-full appearance-none bg-surface-container border border-outline-variant rounded-2xl px-4 py-3 font-body-md text-on-surface focus:border-primary focus:ring-2 focus:ring-primary/20">
                                    <option value="">Pilih</option>
                                    <template x-for="cat in filteredCategories()" :key="cat.id">
                                        <option :value="cat.id" x-text="cat.name" :selected="categoryId == cat.id"></option>
                                    </template>
                                </select>
                                <span class="material-symbols-rounded absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant">expand_more</span>
                            </div>
                            <?php $__errorArgs = ['category_id'];
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
                        <div>
                            <label class="font-semibold text-sm text-on-surface-variant mb-2 block">Tanggal</label>
                            <input type="date" name="transaction_date" x-model="transactionDate" class="w-full bg-surface-container border border-outline-variant rounded-2xl px-4 py-3 font-body-md text-on-surface focus:border-primary focus:ring-2 focus:ring-primary/20" required>
                        </div>
                    </div>
 
                    <!-- Notes -->
                    <div class="mb-6">
                        <label class="font-semibold text-sm text-on-surface-variant mb-2 block">Catatan (Opsional)</label>
                        <input type="text" name="notes" x-model="notes" placeholder="Tulis detail transaksi..." class="w-full bg-surface-container border border-outline-variant rounded-2xl px-4 py-3 font-body-md text-on-surface focus:border-primary focus:ring-2 focus:ring-primary/20">
                    </div>
 
 
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
                <form action="<?php echo e(route('transactions.destroy', $transaction)); ?>" method="POST" id="delete-transaction-modal-form">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="button" @click="$dispatch('open-modal', { id: 'delete-transaction-modal' })" class="w-full bg-gradient-to-r from-error to-red-600 text-white font-bold py-3 rounded-2xl hover:scale-[1.02] transition-all card-shadow flex items-center justify-center gap-2">
                        <span class="material-symbols-rounded">delete</span>
                        Hapus Transaksi
                    </button>
                </form>
<?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['id' => 'delete-transaction-modal','title' => 'Hapus Transaksi?','confirmText' => 'Ya, Hapus','cancelText' => 'Batal','type' => 'delete']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'delete-transaction-modal','title' => 'Hapus Transaksi?','confirmText' => 'Ya, Hapus','cancelText' => 'Batal','type' => 'delete']); ?>
    Apakah Anda yakin ingin menghapus transaksi ini? Tindakan ini tidak dapat dibatalkan.
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $attributes = $__attributesOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__attributesOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $component = $__componentOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__componentOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>
            </div>

    </div>

    <script>
        function transactionEditForm() {
            return {
                type: <?php echo json_encode(old('type', $transaction->type), 512) ?>,
                amountDisplay: '',
                amount: <?php echo json_encode(old('amount', $transaction->amount), 512) ?>,
                categoryId: <?php echo json_encode(old('category_id', $transaction->category_id), 512) ?>,
                transactionDate: <?php echo json_encode(old('transaction_date', $transaction->transaction_date->format('Y-m-d')), 512) ?>,
                notes: <?php echo json_encode(old('notes', $transaction->notes), 512) ?>,
                inputMethod: <?php echo json_encode($transaction->input_method, 15, 512) ?>,
                categories: <?php echo json_encode($categories, 15, 512) ?>,

                init() {
                    this.amountDisplay = this.formatNumber(this.amount);
                    this.$watch('type', (value) => {
                        this.categoryId = '';
                    });
                },

                filteredCategories() {
                    return this.categories.filter(c => c.type === this.type);
                },

                formatAmount() {
                    const value = this.amountDisplay.replace(/\D/g, '');
                    this.amount = value;
                    this.amountDisplay = this.formatNumber(value);
                },

                formatNumber(num) {
                    if (!num) return '';
                    return parseInt(num).toLocaleString('id-ID');
                },

                validateForm(event) {
                    if (!this.amount || this.amount === '0' || this.amount === '') {
                        event.preventDefault();
                        alert('Mohon masukkan nominal transaksi!');
                        return false;
                    }
                    return true;
                }
            }
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
<?php /**PATH C:\Users\alfat\Favorites\asn_pemrograman_web\resources\views/transactions/edit.blade.php ENDPATH**/ ?>