<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <?php echo e(__('Transaksi')); ?>

            </h2>
            <a href="<?php echo e(route('transactions.create')); ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Tambah Transaksi
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <?php if(session('success')): ?>
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline"><?php echo e(session('success')); ?></span>
                </div>
            <?php endif; ?>

            <!-- Filter Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Filter & Pencarian</h3>
                    <form method="GET" action="<?php echo e(route('transactions.index')); ?>" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <!-- Search -->
                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari</label>
                                <input type="text"
                                       name="search"
                                       id="search"
                                       value="<?php echo e(request('search')); ?>"
                                       placeholder="Cari catatan atau kategori..."
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <!-- Category Filter -->
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                                <select name="category_id"
                                        id="category_id"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Semua Kategori</option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>" <?php echo e(request('category_id') == $category->id ? 'selected' : ''); ?>>
                                            <?php echo e($category->name); ?> (<?php echo e($category->type === 'income' ? 'Pemasukan' : 'Pengeluaran'); ?>)
                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <!-- Type Filter -->
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Tipe</label>
                                <select name="type"
                                        id="type"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Semua Tipe</option>
                                    <option value="income" <?php echo e(request('type') === 'income' ? 'selected' : ''); ?>>Pemasukan</option>
                                    <option value="expense" <?php echo e(request('type') === 'expense' ? 'selected' : ''); ?>>Pengeluaran</option>
                                </select>
                            </div>

                            <!-- Start Date -->
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                                <input type="date"
                                       name="start_date"
                                       id="start_date"
                                       value="<?php echo e(request('start_date')); ?>"
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <!-- End Date -->
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Akhir</label>
                                <input type="date"
                                       name="end_date"
                                       id="end_date"
                                       value="<?php echo e(request('end_date')); ?>"
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <!-- Buttons -->
                            <div class="flex items-end gap-2">
                                <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Filter
                                </button>
                                <a href="<?php echo e(route('transactions.index')); ?>"
                                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                    Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <?php if($transactions->isEmpty()): ?>
                        <p class="text-gray-500">
                            <?php if(request()->hasAny(['search', 'category_id', 'type', 'start_date', 'end_date'])): ?>
                                Tidak ada transaksi yang sesuai dengan filter. <a href="<?php echo e(route('transactions.index')); ?>" class="text-blue-500 hover:underline">Reset filter</a>
                            <?php else: ?>
                                Belum ada transaksi. Silakan tambahkan transaksi baru.
                            <?php endif; ?>
                        </p>
                    <?php else: ?>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tanggal
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Kategori
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tipe
                                        </th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Jumlah
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Catatan
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Metode Input
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <?php echo e($transaction->transaction_date->format('d M Y')); ?>

                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <?php echo e($transaction->category ? $transaction->category->name : '-'); ?>

                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    <?php echo e($transaction->type === 'income' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                                                    <?php echo e($transaction->type === 'income' ? 'Pemasukan' : 'Pengeluaran'); ?>

                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right font-medium">
                                                Rp <?php echo e(number_format($transaction->amount, 0, ',', '.')); ?>

                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">
                                                <?php echo e($transaction->notes ?? '-'); ?>

                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">
                                                <?php echo e($transaction->input_method); ?>

                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex gap-2">
                                                    <a href="<?php echo e(route('transactions.edit', $transaction)); ?>" class="text-blue-600 hover:text-blue-900">
                                                        Edit
                                                    </a>
                                                    <form action="<?php echo e(route('transactions.destroy', $transaction)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?');">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH D:\projekpemro\asn_pemrograman_web\resources\views/transactions/index.blade.php ENDPATH**/ ?>