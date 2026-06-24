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
        <?php if(session('success')): ?>
            <div class="mb-6 bg-success-container border border-success text-success px-4 py-3 rounded-button shadow-card" role="alert">
                <span class="block text-body-md font-semibold"><?php echo e(session('success')); ?></span>
            </div>
        <?php endif; ?>

        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-headline-lg font-bold text-on-surface mb-1">Daftar Transaksi</h2>
            <p class="text-body-md text-on-surface-variant">Riwayat transaksi kamu</p>
        </div>

        <!-- Filter Section -->
        <div class="bg-surface rounded-card p-4 mb-6 shadow-card">
            <form method="GET" action="<?php echo e(route('transactions.index')); ?>" class="space-y-4">
                <!-- Search -->
                <div>
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari transaksi..." 
                           class="w-full bg-surface-container border-2 border-outline rounded-button px-4 py-3 text-body-lg text-on-surface focus:border-primary focus:ring-0">
                </div>
                
                <!-- Filter Row -->
                <div class="grid grid-cols-2 gap-3">
                    <select name="category_id" class="w-full bg-surface-container border-2 border-outline rounded-button px-4 py-3 text-body-md text-on-surface focus:border-primary focus:ring-0">
                        <option value="">Semua Kategori</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>" <?php echo e(request('category_id') == $category->id ? 'selected' : ''); ?>>
                                <?php echo e($category->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    
                    <select name="type" class="w-full bg-surface-container border-2 border-outline rounded-button px-4 py-3 text-body-md text-on-surface focus:border-primary focus:ring-0">
                        <option value="">Semua Tipe</option>
                        <option value="income" <?php echo e(request('type') == 'income' ? 'selected' : ''); ?>>Pemasukan</option>
                        <option value="expense" <?php echo e(request('type') == 'expense' ? 'selected' : ''); ?>>Pengeluaran</option>
                    </select>
                </div>
                
                <button type="submit" class="w-full bg-primary text-white font-bold py-3 rounded-button hover:bg-primary-dark transition-colors">
                    Filter
                </button>
            </form>
        </div>

        <!-- Transactions List -->
        <div>
            <?php if($transactions->isEmpty()): ?>
                <div class="bg-surface rounded-card p-12 text-center shadow-card">
                    <span class="material-symbols-rounded text-6xl text-on-surface-variant opacity-30">receipt_long</span>
                    <p class="mt-4 text-on-surface-variant text-body-md">
                        <?php if(request()->hasAny(['search', 'category_id', 'type'])): ?>
                            Tidak ada transaksi yang sesuai dengan filter. 
                            <a href="<?php echo e(route('transactions.index')); ?>" class="text-primary hover:underline font-semibold">Reset filter</a>
                        <?php else: ?>
                            Belum ada transaksi. Mulai catat transaksi kamu!
                        <?php endif; ?>
                    </p>
                    <a href="<?php echo e(route('transactions.create')); ?>" class="mt-6 inline-flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-button font-semibold hover:bg-primary-dark transition-colors">
                        <span class="material-symbols-rounded">add</span>
                        Tambah Transaksi
                    </a>
                </div>
            <?php else: ?>
                <?php
                    $groupedTransactions = $transactions->groupBy(function($transaction) {
                        return $transaction->transaction_date->format('Y-m-d');
                    });
                ?>

                <?php $__currentLoopData = $groupedTransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date => $dateTransactions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="mb-6">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-on-surface-variant mb-3 px-2">
                            <?php echo e(\Carbon\Carbon::parse($date)->isoFormat('dddd, D MMMM YYYY')); ?>

                        </h4>
                        
                        <div class="bg-surface rounded-card p-2 shadow-card space-y-1">
                            <?php $__currentLoopData = $dateTransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex items-center gap-3 p-3 hover:bg-surface-container rounded-button transition-colors">
                                    <!-- Icon -->
                                    <div class="w-12 h-12 rounded-full flex items-center justify-center shrink-0 <?php echo e($transaction->type === 'income' ? 'bg-success-container text-success' : 'bg-primary-container text-primary'); ?>">
                                        <?php
                                            $categoryIcons = [
                                                'makanan' => 'restaurant', 'food' => 'restaurant', 'makan' => 'restaurant',
                                                'transportasi' => 'directions_bike', 'transport' => 'directions_bike',
                                                'laundry' => 'local_laundry_service', 'kopi' => 'coffee', 'coffee' => 'coffee',
                                                'entertainment' => 'sports_esports', 'hiburan' => 'sports_esports',
                                                'belanja' => 'shopping_cart', 'shopping' => 'shopping_cart',
                                                'gaji' => 'account_balance_wallet', 'salary' => 'account_balance_wallet',
                                                'cashback' => 'account_balance_wallet',
                                            ];
                                            $icon = $transaction->type === 'income' ? 'arrow_downward' : 'arrow_upward';
                                            if ($transaction->category) {
                                                $categoryLower = strtolower($transaction->category->name);
                                                foreach($categoryIcons as $key => $value) {
                                                    if(str_contains($categoryLower, $key)) {
                                                        $icon = $value;
                                                        break;
                                                    }
                                                }
                                            }
                                        ?>
                                        <span class="material-symbols-rounded"><?php echo e($icon); ?></span>
                                    </div>

                                    <!-- Info -->
                                    <div class="flex-1 min-w-0">
                                        <p class="text-body-lg font-semibold text-on-surface truncate">
                                            <?php echo e(Str::limit($transaction->notes ?: ($transaction->category ? $transaction->category->name : 'Transaksi'), 40)); ?>

                                        </p>
                                        <p class="text-xs text-on-surface-variant flex items-center gap-1">
                                            <?php if($transaction->category): ?>
                                                <span class="truncate"><?php echo e($transaction->category->name); ?></span>
                                            <?php else: ?>
                                                <span class="truncate">Tanpa Kategori</span>
                                            <?php endif; ?>
                                            <span>•</span>
                                            <span class="capitalize"><?php echo e($transaction->input_method); ?></span>
                                        </p>
                                    </div>

                                    <!-- Amount -->
                                    <div class="text-right shrink-0">
                                        <p class="text-body-lg font-bold <?php echo e($transaction->type === 'income' ? 'text-success' : 'text-error'); ?> whitespace-nowrap">
                                            <?php echo e($transaction->type === 'income' ? '+' : '-'); ?> Rp <?php echo e(number_format($transaction->amount, 0, ',', '.')); ?>

                                        </p>
                                    </div>

                                    <!-- Edit Button -->
                                    <a href="<?php echo e(route('transactions.edit', $transaction)); ?>" class="w-9 h-9 rounded-full hover:bg-primary-container flex items-center justify-center text-primary transition-colors shrink-0">
                                        <span class="material-symbols-rounded text-xl">edit</span>
                                    </a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <!-- Pagination Links -->
                <div class="mt-6 flex justify-center">
                    <?php echo e($transactions->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
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
<?php /**PATH D:\projekpemro\asn_pemrograman_web\resources\views/transactions/index.blade.php ENDPATH**/ ?>