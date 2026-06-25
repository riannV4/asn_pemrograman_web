/**
 * Transaction Voice & Scan Features
 * Client-side implementation using Web Speech API and Tesseract.js
 */

// Voice Recognition using Web Speech API - IMPROVED
class VoiceTransactionInput {
    constructor() {
        this.recognition = null;
        this.isListening = false;
        this.initSpeechRecognition();
    }

    initSpeechRecognition() {
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        
        if (!SpeechRecognition) {
            console.error('Speech Recognition tidak didukung');
            return;
        }

        this.recognition = new SpeechRecognition();
        this.recognition.lang = 'id-ID';
        this.recognition.continuous = false;
        this.recognition.interimResults = false;
        this.recognition.maxAlternatives = 1;
    }

    start(onResult, onError) {
        if (!this.recognition) {
            onError('Voice Recognition tidak didukung di browser Anda. Gunakan Chrome/Edge.');
            return;
        }

        if (this.isListening) {
            this.stop();
            return;
        }

        this.isListening = true;

        this.recognition.onstart = () => {
            console.log('Voice recognition started');
        };

        this.recognition.onresult = (event) => {
            const transcript = event.results[0][0].transcript;
            console.log('Transcript:', transcript);
            onResult(transcript);
            this.isListening = false;
        };

        this.recognition.onerror = (event) => {
            console.error('Voice error:', event.error);
            let errorMsg = 'Error: ' + event.error;
            if (event.error === 'not-allowed') {
                errorMsg = 'Akses microphone ditolak. Berikan izin di browser settings.';
            } else if (event.error === 'no-speech') {
                errorMsg = 'Tidak ada suara terdeteksi. Coba lagi.';
            } else if (event.error === 'network') {
                errorMsg = 'Error jaringan. Periksa koneksi internet.';
            }
            onError(errorMsg);
            this.isListening = false;
        };

        this.recognition.onend = () => {
            console.log('Voice recognition ended');
            this.isListening = false;
        };

        try {
            this.recognition.start();
            console.log('Starting voice recognition...');
        } catch (error) {
            console.error('Start error:', error);
            onError('Tidak dapat memulai voice recognition: ' + error.message);
            this.isListening = false;
        }
    }

    stop() {
        if (this.recognition && this.isListening) {
            this.recognition.stop();
            this.isListening = false;
        }
    }
}

// Parse Indonesian number words to digits - delegates to the shared Vite parser
window.parseIndonesianNumber = function(text) {
    if (typeof window.parseIndonesianAmount === 'function') {
        return window.parseIndonesianAmount(text);
    }

    return null;
};

// Parse full transaction sentence - NEW FEATURE
window.parseTransactionSentence = function(text) {
    console.log('🔥 INCOME DETECTION ACTIVE - VERSION 2.0 🔥');
    
    const result = {
        notes: '',
        amount: null,
        category: null,
        type: 'expense' // default to expense
    };
    
    const lowerText = text.toLowerCase();
    
    // Detect transaction type (income vs expense) - COMPREHENSIVE INCOME DETECTION
    const incomeKeywords = [
        // Core income words
        'pemasukan', 'pendapatan', 'income', 'earning', 'revenue',
        
        // Receiving money
        'dapat', 'dapet', 'dapetin', 'mendapat', 'mendapatkan', 'dapat uang',
        'terima', 'nerima', 'menerima', 'terima uang', 'terima gaji',
        'dibayar', 'dibayarin', 'bayaran', 'pembayaran',
        
        // Salary & wages
        'gaji', 'gajian', 'dapat gaji', 'terima gaji', 'digaji',
        'upah', 'honor', 'honorarium', 
        
        // Other income
        'bonus', 'komisi', 'insentif', 'thr', 'hadiah', 'reward',
        'hasil', 'penghasilan', 'untung', 'profit', 'laba',
        'transfer masuk', 'uang masuk', 'masuk', 'diterima',
        
        // Selling/business
        'jual', 'jualan', 'penjualan', 'omzet', 'omset',
        
        // English alternatives
        'salary', 'paid', 'payment', 'receive', 'received', 'get paid'
    ];
    
    // Expense keywords for explicit detection
    const expenseKeywords = [
        'bayar', 'beli', 'belanja', 'buat', 'untuk', 'pengeluaran',
        'expense', 'buy', 'purchase', 'spend', 'shopping',
        'keluar', 'keluarin', 'habis', 'expense'
    ];
    
    // Check for income keywords first (priority)
    let isIncome = false;
    let isExpense = false;
    
    for (const keyword of incomeKeywords) {
        if (lowerText.includes(keyword)) {
            isIncome = true;
            break;
        }
    }
    
    // Check for expense keywords
    if (!isIncome) {
        for (const keyword of expenseKeywords) {
            if (lowerText.includes(keyword)) {
                isExpense = true;
                break;
            }
        }
    }
    
    // Set transaction type
    if (isIncome) {
        result.type = 'income';
        console.log('✅ DETECTED AS INCOME');
    } else if (isExpense) {
        result.type = 'expense';
        console.log('✅ DETECTED AS EXPENSE');
    } else {
        // Default to expense if no keywords detected
        result.type = 'expense';
        console.log('⚠️ NO KEYWORD DETECTED - DEFAULTING TO EXPENSE');
    }
    
    // Extract amount
    result.amount = window.parseIndonesianNumber(text);
    
    // Extract potential notes (remove number words)
    let notes = lowerText;
    const numberWords = ['nol','satu','dua','tiga','empat','lima','enam','tujuh','delapan','sembilan',
                         'sepuluh','sebelas','puluh','belas','ratus','ribu','seratus','seribu','juta'];
    numberWords.forEach(word => {
        notes = notes.replace(new RegExp('\\b' + word + '\\b', 'g'), '');
    });
    notes = notes.replace(/\d+/g, '').trim().replace(/\s+/g, ' ');
    result.notes = notes || null;
    
    // Detect category from keywords
    const categoryKeywords = {
        'makanan': ['makan', 'sarapan', 'lunch', 'dinner', 'snack', 'jajan', 'nasi', 'ayam', 'soto', 'bakso'],
        'transportasi': ['transport', 'bensin', 'gojek', 'grab', 'ojek', 'taksi', 'bus', 'kereta'],
        'kopi': ['kopi', 'coffee', 'cafe', 'minuman'],
        'laundry': ['laundry', 'cuci', 'setrika'],
        'belanja': ['belanja', 'shopping', 'beli', 'grocery'],
        'tagihan': ['listrik', 'air', 'pulsa', 'internet', 'wifi', 'tagihan'],
        'kesehatan': ['obat', 'dokter', 'rumah sakit', 'apotek', 'medical'],
        'hiburan': ['nonton', 'bioskop', 'game', 'spotify', 'netflix'],
        'gaji': ['gaji', 'salary', 'honor', 'upah'],
        'bonus': ['bonus', 'komisi', 'insentif']
    };
    
    for (const [category, keywords] of Object.entries(categoryKeywords)) {
        for (const keyword of keywords) {
            if (notes.includes(keyword)) {
                result.category = category;
                break;
            }
        }
        if (result.category) break;
    }
    
    return result;
};

// OCR Scan using Tesseract.js - IMPROVED
class ReceiptScanner {
    constructor() {
        this.isScanning = false;
    }

    async scanFromCamera(onResult, onError, onProgress) {
        if (this.isScanning) {
            onError('Scan sedang berlangsung...');
            return;
        }

        // Check Tesseract availability
        if (typeof Tesseract === 'undefined') {
            onError('Tesseract.js belum dimuat. Refresh halaman.');
            return;
        }

        try {
            // Request camera
            const stream = await navigator.mediaDevices.getUserMedia({ 
                video: { 
                    facingMode: 'environment',
                    width: { ideal: 1280 },
                    height: { ideal: 720 }
                } 
            });

            // Create modal
            const modal = this.createCameraModal(stream);
            document.body.appendChild(modal);

            const video = modal.querySelector('video');
            video.srcObject = stream;
            await video.play();

            // Capture handler
            modal.querySelector('#captureBtn').onclick = async () => {
                this.isScanning = true;
                const captureBtn = modal.querySelector('#captureBtn');
                const cancelBtn = modal.querySelector('#cancelBtn');
                captureBtn.disabled = true;
                cancelBtn.disabled = true;
                captureBtn.textContent = 'Processing...';

                try {
                    // Capture frame
                    const canvas = document.createElement('canvas');
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;
                    canvas.getContext('2d').drawImage(video, 0, 0);

                    // Stop camera
                    stream.getTracks().forEach(track => track.stop());

                    // Perform OCR
                    const result = await this.performOCR(canvas, onProgress);
                    modal.remove();
                    onResult(result);
                } catch (error) {
                    console.error('OCR error:', error);
                    modal.remove();
                    onError('OCR gagal: ' + error.message);
                }

                this.isScanning = false;
            };

            // Cancel handler
            modal.querySelector('#cancelBtn').onclick = () => {
                stream.getTracks().forEach(track => track.stop());
                modal.remove();
            };

        } catch (error) {
            console.error('Camera error:', error);
            if (error.name === 'NotAllowedError') {
                onError('Akses kamera ditolak. Berikan izin di browser settings.');
            } else if (error.name === 'NotFoundError') {
                onError('Kamera tidak ditemukan.');
            } else {
                onError('Tidak dapat mengakses kamera: ' + error.message);
            }
            this.isScanning = false;
        }
    }

    createCameraModal(stream) {
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center z-50 p-4';
        modal.innerHTML = `
            <div class="bg-white rounded-2xl p-6 max-w-2xl w-full">
                <h3 class="text-xl font-bold mb-4 text-gray-900">Scan Struk</h3>
                <div class="relative bg-black rounded-xl overflow-hidden mb-4" style="aspect-ratio: 4/3;">
                    <video autoplay playsinline class="w-full h-full object-cover"></video>
                </div>
                <div class="flex gap-3">
                    <button id="captureBtn" class="flex-1 bg-cyan-600 hover:bg-cyan-700 text-white py-3 px-6 rounded-xl font-bold transition-colors">
                        📸 Capture & Scan
                    </button>
                    <button id="cancelBtn" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white py-3 px-6 rounded-xl font-bold transition-colors">
                        Batal
                    </button>
                </div>
                <p class="text-sm text-gray-500 mt-3 text-center">Arahkan kamera ke struk dengan pencahayaan yang baik</p>
            </div>
        `;
        return modal;
    }

    async performOCR(canvas, onProgress) {
        const { data: { text } } = await Tesseract.recognize(
            canvas,
            'ind',
            {
                logger: info => {
                    if (onProgress && info.progress) {
                        onProgress(info.progress);
                    }
                }
            }
        );

        console.log('OCR Text:', text);
        const amount = this.extractAmount(text);
        return { text, amount };
    }

    extractAmount(text) {
        // Multiple patterns to find amount
        const patterns = [
            /(?:total|jumlah|bayar)[\s:]*(?:rp\.?)?[\s]*(\d{1,3}(?:[.,]\d{3})*)/i,
            /(?:rp|idr)[\s.]*(\d{1,3}(?:[.,]\d{3})*)/i,
            /(\d{1,3}(?:[.,]\d{3}){2,})/,
            /(\d{5,})/
        ];

        for (const pattern of patterns) {
            const match = text.match(pattern);
            if (match) {
                const numStr = match[1].replace(/[.,]/g, '');
                const amount = parseInt(numStr);
                if (amount >= 100 && amount < 100000000) {
                    return amount;
                }
            }
        }

        return null;
    }
}

// Global instances
window.voiceInput = new VoiceTransactionInput();
window.receiptScanner = new ReceiptScanner();
