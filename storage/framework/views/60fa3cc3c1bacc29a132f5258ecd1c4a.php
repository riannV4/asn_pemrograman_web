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
            
            <!-- Header -->
            <div class="mb-6 flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <a href="<?php echo e(route('profile.edit')); ?>" class="w-10 h-10 rounded-full hover:bg-surface-container flex items-center justify-center transition-colors shrink-0">
                        <span class="material-symbols-rounded">arrow_back</span>
                    </a>
                    <div>
                        <h2 class="text-headline-lg font-bold text-on-surface mb-1">Kelola Kategori</h2>
                        <p class="text-body-md text-on-surface-variant">Atur kategori transaksi kamu</p>
                    </div>
                </div>
                <button onclick="openAddModal()" class="w-12 h-12 bg-gradient-to-br from-primary to-primary-dark text-white rounded-full flex items-center justify-center shadow-card hover:scale-110 transition-all shrink-0">
                    <span class="material-symbols-rounded text-2xl">add</span>
                </button>
            </div>

            <?php if(session('success')): ?>
                <div class="mb-6 bg-success-container border border-success text-success px-4 py-3 rounded-button shadow-card" role="alert">
                    <span class="block text-body-md font-semibold"><?php echo e(session('success')); ?></span>
                </div>
            <?php endif; ?>

            <!-- Categories List -->
            <div id="categoriesList" class="space-y-3 mb-6">
                <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="bg-surface rounded-card p-4 flex items-center gap-4 shadow-card hover:shadow-card-hover transition-all" data-category-id="<?php echo e($category->id); ?>">
                        <!-- Icon with Color -->
                        <div class="w-14 h-14 rounded-full flex items-center justify-center shrink-0" style="background-color: <?php echo e($category->color ?? '#7c3aed'); ?>20;">
                            <span class="material-symbols-rounded text-2xl" style="color: <?php echo e($category->color ?? '#7c3aed'); ?>;">
                                <?php echo e($category->icon ?? 'label'); ?>

                            </span>
                        </div>

                        <!-- Category Info -->
                        <div class="flex-1 min-w-0">
                            <h3 class="text-body-lg font-semibold text-on-surface truncate"><?php echo e($category->name); ?></h3>
                            <p class="text-xs text-on-surface-variant mt-1">
                                <span class="px-2 py-0.5 rounded-full text-xs font-semibold <?php echo e($category->type === 'income' ? 'bg-success-container text-success' : 'bg-primary-container text-primary'); ?>">
                                    <?php echo e($category->type === 'income' ? 'Pemasukan' : 'Pengeluaran'); ?>

                                </span>
                                <span class="ml-2"><?php echo e($category->transactions_count); ?> transaksi</span>
                            </p>
                        </div>

                        <!-- Delete Button -->
                        <button type="button" @click="$dispatch('open-modal', { id: 'delete-category-<?php echo e($category->id); ?>-modal' })" class="w-10 h-10 rounded-full hover:bg-error-container flex items-center justify-center text-error transition-colors shrink-0">
                            <span class="material-symbols-rounded">delete</span>
                        </button>
                        <form id="delete-category-<?php echo e($category->id); ?>-modal-form" action="<?php echo e(route('categories.destroy', $category)); ?>" method="POST" class="hidden">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                        </form>
                        <?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['id' => 'delete-category-'.e($category->id).'-modal','title' => 'Hapus Kategori?','confirmText' => 'Ya, Hapus','cancelText' => 'Batal','type' => 'delete','categoryName' => $category->name,'categoryColor' => $category->color,'categoryIcon' => $category->icon]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'delete-category-'.e($category->id).'-modal','title' => 'Hapus Kategori?','confirmText' => 'Ya, Hapus','cancelText' => 'Batal','type' => 'delete','categoryName' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($category->name),'categoryColor' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($category->color),'categoryIcon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($category->icon)]); ?>
                            Kategori ini akan dihapus permanen. Transaksi yang terkait tidak akan terhapus.
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
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="bg-surface rounded-card p-12 text-center shadow-card">
                        <span class="material-symbols-rounded text-6xl text-on-surface-variant opacity-30">category</span>
                        <p class="mt-4 text-on-surface-variant">Belum ada kategori. Tambahkan kategori pertama kamu!</p>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>

    <!-- Add Category Modal -->
    <div id="addCategoryModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-end sm:items-center justify-center p-4">
        <div class="bg-white rounded-t-[32px] sm:rounded-[32px] w-full max-w-lg max-h-[90vh] overflow-y-auto shadow-2xl">
            <div class="p-6">
                <!-- Modal Header -->
                <div class="flex justify-between items-center mb-6 pb-4 border-b border-outline-variant">
                    <h3 class="text-headline-md font-bold text-on-surface">Tambah Kategori</h3>
                    <button onclick="closeAddModal()" class="w-10 h-10 rounded-full hover:bg-surface-container flex items-center justify-center transition-colors">
                        <span class="material-symbols-rounded">close</span>
                    </button>
                </div>

                <form id="addCategoryForm" onsubmit="submitCategory(event)">
                    <?php echo csrf_field(); ?>

                    <!-- Category Type -->
                    <div class="mb-6">
                        <label class="font-semibold text-sm text-on-surface-variant mb-3 block">Tipe Kategori</label>
                        <div class="flex bg-primary-container/30 rounded-2xl p-1.5 gap-1">
                            <button type="button" class="type-btn flex-1 px-4 py-3 rounded-xl font-semibold text-sm transition-all" data-type="expense" onclick="selectType('expense')">Pengeluaran</button>
                            <button type="button" class="type-btn flex-1 px-4 py-3 rounded-xl font-semibold text-sm transition-all" data-type="income" onclick="selectType('income')">Pemasukan</button>
                        </div>
                        <input type="hidden" name="type" id="categoryType" value="expense" required>
                    </div>

                    <!-- Category Name -->
                    <div class="mb-6">
                        <label for="categoryName" class="font-semibold text-sm text-on-surface-variant mb-2 block">Nama Kategori</label>
                        <input type="text" id="categoryName" name="name" placeholder="Contoh: Transportasi" required class="w-full bg-surface-container border border-outline-variant rounded-2xl px-4 py-3.5 font-body-md text-on-surface focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                    </div>

                    <!-- Icon Selector -->
                    <div class="mb-6">
                        <label class="font-semibold text-sm text-on-surface-variant mb-3 block">Pilih Icon</label>
                        <div class="bg-surface-container rounded-2xl p-3">
                            <!-- Icon Categories Tabs -->
                            <div class="flex gap-2 mb-3 overflow-x-auto pb-2">
                                <button type="button" class="icon-category-btn px-3 py-1.5 rounded-lg text-xs font-semibold whitespace-nowrap transition-all bg-primary text-white" data-category="populer" onclick="filterIcons('populer')">
                                    Populer
                                </button>
                                <button type="button" class="icon-category-btn px-3 py-1.5 rounded-lg text-xs font-semibold whitespace-nowrap transition-all text-on-surface-variant hover:bg-primary-container" data-category="makanan" onclick="filterIcons('makanan')">
                                    Makanan
                                </button>
                                <button type="button" class="icon-category-btn px-3 py-1.5 rounded-lg text-xs font-semibold whitespace-nowrap transition-all text-on-surface-variant hover:bg-primary-container" data-category="transportasi" onclick="filterIcons('transportasi')">
                                    Transportasi
                                </button>
                                <button type="button" class="icon-category-btn px-3 py-1.5 rounded-lg text-xs font-semibold whitespace-nowrap transition-all text-on-surface-variant hover:bg-primary-container" data-category="lainnya" onclick="filterIcons('lainnya')">
                                    Lainnya
                                </button>
                            </div>
                            
                            <!-- Icons Grid -->
                            <div class="h-48 overflow-y-auto pr-2 custom-scrollbar">
                                <div class="grid grid-cols-6 gap-2" id="iconsGrid">
                                    <?php
                                        $iconCategories = [
                                            'populer' => ['shopping_cart', 'restaurant', 'directions_car', 'home', 'work', 'school', 'local_cafe', 'attach_money', 'credit_card', 'savings', 'medical_services', 'fitness_center'],
                                            'makanan' => ['restaurant', 'local_cafe', 'fastfood', 'local_pizza', 'shopping_bag', 'local_grocery_store', 'local_bar', 'liquor', 'cake'],
                                            'transportasi' => ['directions_car', 'local_taxi', 'train', 'flight', 'hotel'],
                                            'lainnya' => ['home', 'school', 'work', 'fitness_center', 'medical_services', 'local_hospital', 'local_pharmacy', 'pets', 'child_care', 'sports_esports', 'movie', 'theater_comedy', 'music_note', 'brush', 'account_balance', 'receipt', 'spa', 'self_improvement', 'hiking']
                                        ];
                                    ?>
                                    <?php $__currentLoopData = $iconCategories['populer']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <button type="button" class="icon-btn w-12 h-12 rounded-xl flex items-center justify-center hover:bg-primary-container transition-all border-2 border-transparent" data-icon="<?php echo e($icon); ?>" data-category="populer" onclick="selectIcon('<?php echo e($icon); ?>')">
                                            <span class="material-symbols-rounded text-xl"><?php echo e($icon); ?></span>
                                        </button>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="icon" id="categoryIcon" value="shopping_cart" required>
                    </div>

                    <!-- Color Picker -->
                    <div class="mb-6">
                        <label class="font-semibold text-sm text-on-surface-variant mb-3 block">Pilih Warna</label>
                        <div class="bg-surface-container rounded-2xl p-3">
                            <div class="grid grid-cols-8 gap-3">
                                <?php
                                    $colors = ['#7c3aed', '#8b5cf6', '#a78bfa', '#ec4899', '#f43f5e', '#ef4444', '#f97316', '#f59e0b', '#eab308', '#84cc16', '#22c55e', '#10b981', '#14b8a6', '#06b6d4', '#0ea5e9', '#3b82f6'];
                                ?>
                                <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <button type="button" class="color-btn w-11 h-11 rounded-full border-3 border-transparent hover:scale-110 transition-all shadow-sm" style="background-color: <?php echo e($color); ?>;" data-color="<?php echo e($color); ?>" onclick="selectColor('<?php echo e($color); ?>')"></button>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <input type="hidden" name="color" id="categoryColor" value="#7c3aed" required>
                    </div>

                    <!-- Live Preview -->
                    <div class="mb-6">
                        <label class="font-semibold text-sm text-on-surface-variant mb-3 block">Preview</label>
                        <div class="bg-gradient-to-br from-primary/5 to-secondary/5 rounded-2xl p-4 border-2 border-primary/20">
                            <div class="bg-white rounded-xl p-4 flex items-center gap-4 shadow-sm">
                                <div id="previewIconContainer" class="w-14 h-14 rounded-full flex items-center justify-center transition-all" style="background-color: #7c3aed20;">
                                    <span id="previewIcon" class="material-symbols-rounded text-2xl transition-all" style="color: #7c3aed;">shopping_cart</span>
                                </div>
                                <div class="flex-1">
                                    <h3 id="previewName" class="font-semibold text-on-surface">Nama Kategori</h3>
                                    <p class="text-xs text-on-surface-variant mt-1">
                                        <span id="previewType" class="px-2.5 py-1 rounded-full text-xs font-semibold bg-error-container text-error">Pengeluaran</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" id="submitBtn" class="w-full bg-gradient-to-r from-primary to-primary-dark text-white font-bold py-4 rounded-2xl hover:scale-[1.02] hover:shadow-lg transition-all shadow-md flex items-center justify-center gap-2">
                        <span class="material-symbols-rounded">check_circle</span>
                        Simpan Kategori
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirm Modal (for dynamically added categories) -->
    <div id="deleteConfirmModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4">
        <div class="bg-white rounded-[32px] shadow-2xl max-w-sm w-full p-6 text-center">
            <div class="w-20 h-20 bg-red-50 border border-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-rounded text-red-500 text-3xl">delete</span>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Hapus Kategori?</h3>
            <p class="text-sm text-gray-500 px-2 leading-relaxed mb-6">Kategori ini akan dihapus permanen. Transaksi yang terkait tidak akan terhapus.</p>
            <hr class="border-t border-gray-100 w-full mb-6">
            <div class="flex gap-3">
                <button type="button" onclick="closeDeleteModal()" class="flex-1 border border-gray-200 bg-white hover:bg-gray-50 text-gray-700 font-semibold py-3 px-4 rounded-xl flex items-center justify-center gap-2 transition-colors">
                    <span class="material-symbols-rounded text-lg">close</span>
                    <span>Batal</span>
                </button>
                <button type="button" onclick="confirmDelete()" class="flex-1 bg-[#d32f2f] hover:bg-red-700 text-white font-semibold py-3 px-4 rounded-xl flex items-center justify-center gap-2 transition-colors">
                    <span class="material-symbols-rounded text-lg">delete</span>
                    <span>Ya, Hapus</span>
                </button>
            </div>
        </div>
    </div>

    <script>
        let selectedIcon = 'shopping_cart';
        let selectedColor = '#7c3aed';

        // Icon categories data
        const iconCategories = {
            populer: ['shopping_cart', 'restaurant', 'directions_car', 'home', 'work', 'school', 'local_cafe', 'attach_money', 'credit_card', 'savings', 'medical_services', 'fitness_center'],
            makanan: ['restaurant', 'local_cafe', 'fastfood', 'local_pizza', 'shopping_bag', 'local_grocery_store', 'local_bar', 'liquor', 'cake'],
            transportasi: ['directions_car', 'local_taxi', 'train', 'flight', 'hotel'],
            lainnya: ['home', 'school', 'work', 'fitness_center', 'medical_services', 'local_hospital', 'local_pharmacy', 'pets', 'child_care', 'sports_esports', 'movie', 'theater_comedy', 'music_note', 'brush', 'account_balance', 'receipt', 'spa', 'self_improvement', 'hiking']
        };

        function openAddModal() {
            document.getElementById('addCategoryModal').classList.remove('hidden');
            selectType('expense');
            filterIcons('populer');
            selectIcon('shopping_cart');
            selectColor('#7c3aed');
        }

        function closeAddModal() {
            document.getElementById('addCategoryModal').classList.add('hidden');
            document.getElementById('addCategoryForm').reset();
        }

        function filterIcons(category) {
            const iconsGrid = document.getElementById('iconsGrid');
            const icons = iconCategories[category] || iconCategories.populer;
            
            // Update category buttons
            document.querySelectorAll('.icon-category-btn').forEach(btn => {
                if (btn.dataset.category === category) {
                    btn.classList.add('bg-primary', 'text-white');
                    btn.classList.remove('text-on-surface-variant', 'hover:bg-primary-container');
                } else {
                    btn.classList.remove('bg-primary', 'text-white');
                    btn.classList.add('text-on-surface-variant', 'hover:bg-primary-container');
                }
            });
            
            // Render icons
            iconsGrid.innerHTML = '';
            icons.forEach(icon => {
                const button = document.createElement('button');
                button.type = 'button';
                button.className = 'icon-btn w-12 h-12 rounded-xl flex items-center justify-center hover:bg-primary-container transition-all border-2 border-transparent';
                button.setAttribute('data-icon', icon);
                button.setAttribute('data-category', category);
                button.onclick = () => selectIcon(icon);
                
                const span = document.createElement('span');
                span.className = 'material-symbols-rounded text-xl';
                span.textContent = icon;
                
                button.appendChild(span);
                iconsGrid.appendChild(button);
            });
            
            // Re-apply selection if current icon is in this category
            if (icons.includes(selectedIcon)) {
                const selectedBtn = document.querySelector(`[data-icon="${selectedIcon}"]`);
                if (selectedBtn) {
                    selectedBtn.classList.add('bg-primary', 'text-white', 'border-primary');
                    selectedBtn.classList.remove('border-transparent');
                }
            }
        }

        function selectType(type) {
            selectedType = type;
            document.getElementById('categoryType').value = type;
            
            document.querySelectorAll('.type-btn').forEach(btn => {
                if (btn.dataset.type === type) {
                    btn.classList.add('bg-white', 'shadow-md', type === 'expense' ? 'text-error' : 'text-success');
                    btn.classList.remove('text-on-surface-variant');
                } else {
                    btn.classList.remove('bg-white', 'shadow-md', 'text-error', 'text-success');
                    btn.classList.add('text-on-surface-variant');
                }
            });

            updatePreview();
        }

        function selectIcon(icon) {
            selectedIcon = icon;
            document.getElementById('categoryIcon').value = icon;
            
            document.querySelectorAll('.icon-btn').forEach(btn => {
                btn.classList.remove('bg-primary', 'text-white', 'border-primary');
                btn.classList.add('border-transparent');
            });
            
            const selectedBtn = document.querySelector(`[data-icon="${icon}"]`);
            if (selectedBtn) {
                selectedBtn.classList.add('bg-primary', 'text-white', 'border-primary');
                selectedBtn.classList.remove('border-transparent');
            }

            updatePreview();
        }

        function selectColor(color) {
            selectedColor = color;
            document.getElementById('categoryColor').value = color;
            
            document.querySelectorAll('.color-btn').forEach(btn => {
                btn.classList.remove('border-primary', 'scale-110', 'ring-4', 'ring-primary/30');
                btn.style.borderWidth = '3px';
            });
            
            const selectedBtn = document.querySelector(`[data-color="${color}"]`);
            if (selectedBtn) {
                selectedBtn.classList.add('border-primary', 'scale-110', 'ring-4', 'ring-primary/30');
            }

            updatePreview();
        }

        function updatePreview() {
            const name = document.getElementById('categoryName').value || 'Nama Kategori';
            document.getElementById('previewName').textContent = name;
            document.getElementById('previewIcon').textContent = selectedIcon;
            document.getElementById('previewIcon').style.color = selectedColor;
            document.getElementById('previewIconContainer').style.backgroundColor = selectedColor + '20';
            
            const typeLabel = document.getElementById('previewType');
            if (selectedType === 'income') {
                typeLabel.textContent = 'Pemasukan';
                typeLabel.className = 'px-2 py-0.5 rounded-full bg-success-container text-success';
            } else {
                typeLabel.textContent = 'Pengeluaran';
                typeLabel.className = 'px-2 py-0.5 rounded-full bg-error-container text-error';
            }
        }

        document.getElementById('categoryName').addEventListener('input', updatePreview);

        async function submitCategory(event) {
            event.preventDefault();
            
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="material-symbols-rounded animate-spin">progress_activity</span> Menyimpan...';

            const formData = new FormData(event.target);
            
            try {
                const response = await fetch('<?php echo e(route('categories.store')); ?>', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    // Add new category to the list
                    addCategoryToList(data.category);
                    
                    // Close modal
                    closeAddModal();
                    
                    // Show success message
                    showSuccessMessage('Kategori berhasil ditambahkan!');
                } else {
                    alert('Gagal menambahkan kategori. Silakan coba lagi.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Silakan coba lagi.');
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<span class="material-symbols-rounded">check_circle</span> Simpan Kategori';
            }
        }

        function addCategoryToList(category) {
            const list = document.getElementById('categoriesList');
            
            // Remove empty state if exists
            const emptyState = list.querySelector('.text-center');
            if (emptyState) {
                emptyState.parentElement.remove();
            }

            const categoryHtml = `
                <div class="card-shadow bg-white rounded-[24px] p-4 flex items-center gap-4 hover:scale-[1.02] transition-all" data-category-id="${category.id}">
                    <div class="w-14 h-14 rounded-full flex items-center justify-center shrink-0" style="background-color: ${category.color}20;">
                        <span class="material-symbols-rounded text-2xl" style="color: ${category.color};">
                            ${category.icon}
                        </span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-on-surface truncate">${category.name}</h3>
                        <p class="text-xs text-on-surface-variant">
                            <span class="px-2 py-0.5 rounded-full ${category.type === 'income' ? 'bg-success-container text-success' : 'bg-error-container text-error'}">
                                ${category.type === 'income' ? 'Pemasukan' : 'Pengeluaran'}
                            </span>
                            <span class="ml-2">0 transaksi</span>
                        </p>
                    </div>
                    <button type="button" onclick="openDeleteModal(${category.id})" class="w-10 h-10 rounded-full hover:bg-error-container flex items-center justify-center text-error transition-colors shrink-0">
                        <span class="material-symbols-rounded">delete</span>
                    </button>
                    <form id="delete-category-${category.id}-modal-form" action="/categories/${category.id}" method="POST" class="hidden">
                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
                        <input type="hidden" name="_method" value="DELETE">
                    </form>
                </div>
            `;
            
            list.insertAdjacentHTML('afterbegin', categoryHtml);
        }

        function showSuccessMessage(message) {
            const alert = document.createElement('div');
            alert.className = 'fixed top-4 right-4 bg-success-container border border-success text-success px-6 py-4 rounded-2xl card-shadow-lg z-50';
            alert.innerHTML = `<span class="font-semibold">${message}</span>`;
            document.body.appendChild(alert);
            
            setTimeout(() => {
                alert.remove();
            }, 3000);
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            selectType('expense');
            filterIcons('populer');
            selectIcon('shopping_cart');
            selectColor('#7c3aed');
        });

        function openDeleteModal(categoryId) {
            document.getElementById('deleteConfirmModal').classList.remove('hidden');
            document.getElementById('deleteConfirmModal').dataset.targetId = categoryId;
        }

        function closeDeleteModal() {
            document.getElementById('deleteConfirmModal').classList.add('hidden');
        }

        function confirmDelete() {
            const categoryId = document.getElementById('deleteConfirmModal').dataset.targetId;
            const form = document.getElementById('delete-category-' + categoryId + '-modal-form');
            if (form) {
                form.submit();
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
<?php /**PATH C:\Users\alfat\Favorites\asn_pemrograman_web\resources\views/categories/index.blade.php ENDPATH**/ ?>