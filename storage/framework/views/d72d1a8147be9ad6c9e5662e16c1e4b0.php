<?php if (isset($component)) { $__componentOriginal8b1a96032cb10664afbc3f43162d0ab6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8b1a96032cb10664afbc3f43162d0ab6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.mobile-app','data' => ['currentPage' => 'create']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.mobile-app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['currentPage' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('create')]); ?>
    <div class="min-h-screen bg-gradient-to-br from-primary/5 via-background to-secondary/5 px-4 py-6">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-headline-lg font-bold text-on-surface">Catat Transaksi</h1>
                <p class="text-body-md text-on-surface-variant">Pilih metode input</p>
            </div>
            <a href="<?php echo e(route('dashboard')); ?>" class="w-10 h-10 rounded-full bg-surface flex items-center justify-center shadow-card">
                <span class="material-symbols-rounded">close</span>
            </a>
        </div>

        <form method="POST" action="<?php echo e(route('transactions.store')); ?>" id="transactionForm" x-data="transactionForm()" @submit="validateForm($event)">
            <?php echo csrf_field(); ?>

            <!-- Input Method Tabs -->
            <div class="bg-surface rounded-card p-2 mb-6 shadow-card">
                <div class="grid grid-cols-3 gap-2">
                    <button type="button" @click="setInputMethod('manual')" 
                            :class="inputMethod === 'manual' ? 'bg-primary text-white' : 'text-on-surface-variant'"
                            class="flex flex-col items-center gap-1 py-3 rounded-button transition-all">
                        <span class="material-symbols-rounded text-2xl">edit</span>
                        <span class="text-xs font-semibold">Manual</span>
                    </button>
                    <button type="button" @click="setInputMethod('voice')" 
                            :class="inputMethod === 'voice' ? 'bg-primary text-white' : 'text-on-surface-variant'"
                            class="flex flex-col items-center gap-1 py-3 rounded-button transition-all">
                        <span class="material-symbols-rounded text-2xl">mic</span>
                        <span class="text-xs font-semibold">Voice</span>
                    </button>
                    <button type="button" @click="setInputMethod('scan')" 
                            :class="inputMethod === 'scan' ? 'bg-primary text-white' : 'text-on-surface-variant'"
                            class="flex flex-col items-center gap-1 py-3 rounded-button transition-all">
                        <span class="material-symbols-rounded text-2xl">document_scanner</span>
                        <span class="text-xs font-semibold">Scan</span>
                    </button>
                </div>
            </div>

            <input type="hidden" name="input_method" x-model="inputMethod">

            <!-- Voice Input Section -->
            <div x-show="inputMethod === 'voice'" x-transition class="bg-surface rounded-card p-6 mb-6 shadow-card">
                <div class="text-center">
                    <button type="button" @click="toggleVoiceRecording()" 
                            :class="isRecording ? 'bg-error animate-pulse' : 'bg-primary'"
                            class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 shadow-fab transition-all transform hover:scale-110">
                        <span class="material-symbols-rounded text-white text-4xl" x-text="isRecording ? 'stop' : 'mic'"></span>
                    </button>
                    <p class="text-body-lg font-semibold text-on-surface mb-2" x-text="isRecording ? 'Mendengarkan...' : 'Tekan untuk merekam'"></p>
                    <p class="text-body-md text-on-surface-variant mb-3" x-show="voiceTranscript">
                        <span class="font-semibold" x-text="voiceTranscript"></span>
                    </p>
                    <div x-show="!isRecording && !voiceTranscript" class="mt-4 p-4 bg-primary-container/30 rounded-button">
                        <p class="text-xs text-on-surface-variant">Contoh:</p>
                        <p class="text-sm text-on-surface font-semibold mt-1">"Bayar makan siang dua puluh lima ribu"</p>
                        <p class="text-sm text-on-surface font-semibold">"Terima gaji lima juta"</p>
                    </div>
                </div>
            </div>

            <!-- Scan Input Section -->
            <div x-show="inputMethod === 'scan'" x-transition class="bg-surface rounded-card p-6 mb-6 shadow-card">
                <div class="text-center">
                    <label for="scanInput" class="cursor-pointer">
                        <div class="w-full h-48 border-2 border-dashed border-outline rounded-button flex flex-col items-center justify-center mb-4">
                            <span class="material-symbols-rounded text-6xl text-on-surface-variant">document_scanner</span>
                            <p class="mt-3 text-body-lg font-semibold text-on-surface">Tap untuk scan struk</p>
                            <p class="text-body-md text-on-surface-variant">Foto atau upload struk belanja</p>
                        </div>
                    </label>
                    <input type="file" id="scanInput" accept="image/*" capture="environment" class="hidden" @change="handleScanUpload($event)">
                    <div x-show="scanResult" class="mt-4 p-4 bg-primary-container rounded-button">
                        <p class="text-body-md text-on-primary-container" x-text="scanResult"></p>
                    </div>
                </div>
            </div>

            <!-- Type Selection -->
            <div class="bg-surface rounded-card p-2 mb-6 shadow-card">
                <div class="grid grid-cols-2 gap-2">
                    <button type="button" @click="type = 'expense'" 
                            :class="type === 'expense' ? 'bg-error text-white' : 'text-on-surface-variant'"
                            class="py-3 rounded-button font-semibold transition-all">
                        Pengeluaran
                    </button>
                    <button type="button" @click="type = 'income'" 
                            :class="type === 'income' ? 'bg-success text-white' : 'text-on-surface-variant'"
                            class="py-3 rounded-button font-semibold transition-all">
                        Pemasukan
                    </button>
                </div>
            </div>
            <input type="hidden" name="type" x-model="type">

            <!-- Amount -->
            <div class="bg-surface rounded-card p-6 mb-6 shadow-card">
                <label class="block text-xs font-bold uppercase tracking-wider text-on-surface-variant mb-3">Nominal</label>
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-on-surface-variant mr-2">Rp</span>
                    <input type="text" x-model="amountDisplay" @input="formatAmount()" 
                           class="w-full bg-transparent border-none p-0 focus:ring-0 text-display-currency text-on-surface placeholder-on-surface-variant"
                           placeholder="0">
                </div>
                <input type="hidden" name="amount" x-model="amount">
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

            <!-- Category -->
            <div class="bg-surface rounded-card p-6 mb-6 shadow-card">
                <label class="block text-xs font-bold uppercase tracking-wider text-on-surface-variant mb-3">Kategori</label>
                <div class="relative">
                    <select name="category_id" x-model="categoryId" 
                            class="w-full appearance-none bg-surface-container border-2 border-outline rounded-button px-4 py-3 text-body-lg text-on-surface focus:border-primary focus:ring-0">
                        <option value="">Pilih Kategori</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

            <!-- Date -->
            <div class="bg-surface rounded-card p-6 mb-6 shadow-card">
                <label class="block text-xs font-bold uppercase tracking-wider text-on-surface-variant mb-3">Tanggal</label>
                <input type="date" name="transaction_date" x-model="transactionDate" 
                       class="w-full bg-surface-container border-2 border-outline rounded-button px-4 py-3 text-body-lg text-on-surface focus:border-primary focus:ring-0">
                <?php $__errorArgs = ['transaction_date'];
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

            <!-- Notes -->
            <div class="bg-surface rounded-card p-6 mb-6 shadow-card">
                <label class="block text-xs font-bold uppercase tracking-wider text-on-surface-variant mb-3">Catatan (Opsional)</label>
                <textarea name="notes" x-model="notes" rows="3" 
                          placeholder="Tulis detail transaksi..."
                          class="w-full bg-surface-container border-2 border-outline rounded-button px-4 py-3 text-body-lg text-on-surface focus:border-primary focus:ring-0"></textarea>
                <?php $__errorArgs = ['notes'];
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

            <!-- Submit Button -->
            <button type="submit" 
                    @click="console.log('Form data:', {type: type, amount: amount, categoryId: categoryId, transactionDate: transactionDate, inputMethod: inputMethod})"
                    class="w-full bg-gradient-to-r from-primary to-primary-dark text-white font-bold py-4 rounded-button shadow-card flex items-center justify-center gap-2 hover:shadow-card-hover transition-all">
                <span class="material-symbols-rounded">check</span>
                <span x-text="amount ? 'Simpan Transaksi' : 'Masukkan Nominal Terlebih Dahulu'"></span>
            </button>
            
            <!-- Debug Info (remove in production) -->
            <div class="mt-4 p-4 bg-surface rounded-button text-xs text-on-surface-variant" x-show="false">
                <p><strong>Debug:</strong></p>
                <p>Amount: <span x-text="amount"></span></p>
                <p>Amount Display: <span x-text="amountDisplay"></span></p>
                <p>Type: <span x-text="type"></span></p>
                <p>Category: <span x-text="categoryId"></span></p>
                <p>Date: <span x-text="transactionDate"></span></p>
                <p>Input Method: <span x-text="inputMethod"></span></p>
            </div>
        </form>
    </div>

    <script>
        function transactionForm() {
            return {
                inputMethod: 'manual',
                type: 'expense',
                amountDisplay: '',
                amount: '',
                categoryId: '',
                transactionDate: '<?php echo e(date('Y-m-d')); ?>',
                notes: '',
                isRecording: false,
                voiceTranscript: '',
                scanResult: '',
                recognition: null,

                init() {
                    // Initialize Web Speech API
                    if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
                        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
                        this.recognition = new SpeechRecognition();
                        this.recognition.lang = 'id-ID';
                        this.recognition.continuous = false;
                        this.recognition.interimResults = false;

                        this.recognition.onresult = (event) => {
                            const transcript = event.results[0][0].transcript;
                            this.voiceTranscript = transcript;
                            this.parseVoiceInput(transcript);
                        };

                        this.recognition.onerror = (event) => {
                            console.error('Speech recognition error:', event.error);
                            this.isRecording = false;
                        };

                        this.recognition.onend = () => {
                            this.isRecording = false;
                        };
                    }
                },

                setInputMethod(method) {
                    this.inputMethod = method;
                },

                toggleVoiceRecording() {
                    if (!this.recognition) {
                        alert('Browser Anda tidak mendukung Web Speech API');
                        return;
                    }

                    if (this.isRecording) {
                        this.recognition.stop();
                        this.isRecording = false;
                    } else {
                        this.recognition.start();
                        this.isRecording = true;
                        this.voiceTranscript = '';
                    }
                },

                parseVoiceInput(text) {
                    const lowerText = text.toLowerCase();
                    
                    // 1. Detect transaction type (income vs expense)
                    const incomeKeywords = ['terima', 'dapat', 'gaji', 'bonus', 'hadiah', 'untung', 'profit', 'penghasilan', 'masuk', 'dibayar'];
                    const expenseKeywords = ['beli', 'bayar', 'keluar', 'belanja', 'buat', 'untuk', 'ke', 'di', 'makan', 'minum', 'transport', 'bensin', 'pulsa'];
                    
                    let detectedType = 'expense'; // default
                    for (let keyword of incomeKeywords) {
                        if (lowerText.includes(keyword)) {
                            detectedType = 'income';
                            break;
                        }
                    }
                    this.type = detectedType;
                    
                    // 2. Parse amount - support both digits and Indonesian number words
                    let amount = 0;
                    
                    // First try to find digits
                    const numberMatch = text.match(/\d+[\d.]*\d*/);
                    if (numberMatch) {
                        amount = parseInt(numberMatch[0].replace(/\./g, ''));
                    } else {
                        // Parse Indonesian number words
                        const numberWords = {
                            'nol': 0, 'satu': 1, 'dua': 2, 'tiga': 3, 'empat': 4,
                            'lima': 5, 'enam': 6, 'tujuh': 7, 'delapan': 8, 'sembilan': 9,
                            'sepuluh': 10, 'sebelas': 11, 'belas': 10, 'puluh': 10,
                            'seratus': 100, 'ratus': 100, 'seribu': 1000, 'ribu': 1000,
                            'juta': 1000000
                        };
                        
                        // Try to parse common patterns like "dua puluh lima ribu"
                        if (lowerText.includes('ribu')) {
                            const beforeRibu = lowerText.split('ribu')[0];
                            if (beforeRibu.includes('puluh')) {
                                const parts = beforeRibu.split('puluh');
                                const tens = this.wordToNumber(parts[0].trim(), numberWords);
                                const ones = parts[1] ? this.wordToNumber(parts[1].trim(), numberWords) : 0;
                                amount = (tens * 10 + ones) * 1000;
                            } else {
                                const num = this.wordToNumber(beforeRibu.trim(), numberWords);
                                amount = num * 1000;
                            }
                        } else if (lowerText.includes('ratus')) {
                            const beforeRatus = lowerText.split('ratus')[0];
                            const num = this.wordToNumber(beforeRatus.trim(), numberWords);
                            amount = num * 100;
                        }
                    }
                    
                    if (amount > 0) {
                        this.amount = amount.toString();
                        this.amountDisplay = this.formatNumber(amount.toString());
                    }
                    
                    // 3. Try to detect category from keywords
                    const categoryMap = {
                        'makan': ['makan', 'nasi', 'lapar', 'minum', 'kopi', 'restoran', 'warteg'],
                        'transport': ['transport', 'ojek', 'grab', 'gojek', 'bensin', 'parkir', 'tol'],
                        'belanja': ['belanja', 'beli', 'shopping', 'pasar', 'supermarket'],
                        'hiburan': ['hiburan', 'nonton', 'film', 'main', 'game', 'konser'],
                        'kesehatan': ['dokter', 'obat', 'rumah sakit', 'klinik', 'apotek'],
                        'pendidikan': ['buku', 'kursus', 'sekolah', 'kuliah', 'les'],
                        'tagihan': ['listrik', 'air', 'internet', 'pulsa', 'wifi', 'token']
                    };
                    
                    for (let [category, keywords] of Object.entries(categoryMap)) {
                        for (let keyword of keywords) {
                            if (lowerText.includes(keyword)) {
                                // Find matching category in select options
                                const select = document.querySelector('select[name="category_id"]');
                                if (select) {
                                    for (let option of select.options) {
                                        if (option.text.toLowerCase().includes(category)) {
                                            this.categoryId = option.value;
                                            break;
                                        }
                                    }
                                }
                                break;
                            }
                        }
                    }
                    
                    // 4. Set notes with cleaned text
                    this.notes = text;
                },
                
                wordToNumber(word, numberWords) {
                    if (!word) return 0;
                    word = word.trim();
                    if (word.startsWith('se')) {
                        word = word.substring(2);
                        return 1 * (numberWords[word] || 1);
                    }
                    return numberWords[word] || 0;
                },

                handleScanUpload(event) {
                    const file = event.target.files[0];
                    if (!file) return;

                    // Here you would send the image to your OCR API
                    // For now, we'll just show a placeholder message
                    this.scanResult = 'Memproses gambar... (Integrasi OCR akan ditambahkan)';
                    
                    // TODO: Implement actual OCR API call
                    // Example:
                    // const formData = new FormData();
                    // formData.append('image', file);
                    // fetch('/api/ocr', { method: 'POST', body: formData })
                    //     .then(res => res.json())
                    //     .then(data => {
                    //         this.amount = data.amount;
                    //         this.notes = data.notes;
                    //     });
                },

                formatAmount() {
                    // Remove non-digit characters
                    const value = this.amountDisplay.replace(/\D/g, '');
                    this.amount = value;
                    this.amountDisplay = this.formatNumber(value);
                },

                formatNumber(num) {
                    if (!num) return '';
                    return parseInt(num).toLocaleString('id-ID');
                },

                validateForm(event) {
                    // Client-side validation
                    if (!this.amount || this.amount === '0' || this.amount === '') {
                        event.preventDefault();
                        alert('Mohon masukkan nominal transaksi!');
                        return false;
                    }

                    if (!this.transactionDate) {
                        event.preventDefault();
                        alert('Mohon pilih tanggal transaksi!');
                        return false;
                    }

                    // Log for debugging
                    console.log('Submitting form with data:', {
                        type: this.type,
                        amount: this.amount,
                        categoryId: this.categoryId,
                        transactionDate: this.transactionDate,
                        inputMethod: this.inputMethod,
                        notes: this.notes
                    });

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
<?php /**PATH C:\Users\alfat\Favorites\asn_pemrograman_web\resources\views/transactions/create.blade.php ENDPATH**/ ?>