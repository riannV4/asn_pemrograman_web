# Kostly Tracker — Manajemen Keuangan Anak Kost

[![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=flat-square)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat-square)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind%20CSS-3-38B2AC?style=flat-square)](https://tailwindcss.com)
[![Vite](https://img.shields.io/badge/Vite-7-646CFF?style=flat-square)](https://vitejs.dev)
[![License](https://img.shields.io/badge/Lisensi-Akademik-blue?style=flat-square)](#-lisensi)

## 📋 Deskripsi Proyek

**Kostly Tracker** adalah aplikasi web manajemen keuangan yang dirancang untuk mahasiswa anak kost. Aplikasi ini membantu pengguna mencatat pemasukan dan pengeluaran, menganalisis pola keuangan melalui grafik interaktif, serta mengelola kategori transaksi secara personal — semuanya dalam antarmuka yang modern dan responsif.

### Masalah yang Dipecahkan

- Sulit melacak pengeluaran harian secara terstruktur
- Tidak ada insight visual tentang pola pengeluaran
- Kesulitan membuat dan memantau anggaran bulanan
- Kurangnya laporan keuangan yang mudah dipahami

---

## 🛠️ Teknologi yang Digunakan

### Backend

| Teknologi | Versi | Keterangan |
|---|---|---|
| [Laravel](https://laravel.com) | ^12.0 | PHP web framework |
| PHP | ^8.2 | Server-side language |
| SQLite | *(default)* | Database ringan bawaan (bisa diganti PostgreSQL/MySQL) |
| Laravel Breeze | ^2.4 | Starter kit autentikasi |
| Laravel Tinker | ^2.10 | REPL interaktif |

### Frontend

| Teknologi | Versi | Keterangan |
|---|---|---|
| [Tailwind CSS](https://tailwindcss.com) | ^3.1 | Utility-first CSS framework |
| [Alpine.js](https://alpinejs.dev) | ^3.4 | Lightweight JS framework |
| [Vite](https://vitejs.dev) | ^7.0 | Build tool & dev server |
| Chart.js | — | Visualisasi grafik (via CDN di Blade views) |
| Material Symbols | — | Icon set dari Google |
| Blade Templating | — | Templating engine bawaan Laravel |

### Development & Testing

| Teknologi | Keterangan |
|---|---|
| Vitest | Unit testing JavaScript |
| PHPUnit ^11 | Unit testing PHP |
| Laravel Pint | Code style fixer (PSR-12) |
| Laravel Pail | Log viewer real-time |
| Laravel Sail | Docker environment untuk development |
| Concurrently | Menjalankan banyak proses paralel (dev mode) |

---

## ✨ Fitur Utama

### 1. 🏠 Dashboard

- **Ringkasan Keuangan**: Saldo total, pemasukan & pengeluaran bulan ini
- **Grafik Tren Harian**: Visualisasi pengeluaran 7 hari terakhir (Line Chart)
- **Grafik Tren Mingguan**: Pengeluaran per minggu dalam bulan berjalan (Bar Chart)
- **Grafik Kategori**: Breakdown pengeluaran per kategori bulan ini (Doughnut Chart)
- **Transaksi Terakhir**: Daftar 5 transaksi terbaru dengan kategori dan icon
- **Top Kategori**: Peringkat 5 kategori pengeluaran terbesar

### 2. 💸 Manajemen Transaksi

- Pencatatan transaksi manual (Pemasukan / Pengeluaran)
- **Scan Struk**: Upload foto struk belanja untuk input otomatis via OCR (`POST /transactions/scan-struk`)
- Filter & pencarian transaksi
- Edit dan hapus transaksi
- Input: Nominal, Tanggal, Jenis, Kategori, Catatan, Metode Input

### 3. 📊 Laporan & Statistik

- Breakdown pengeluaran per kategori
- Tren pengeluaran harian (7 hari terakhir) dan mingguan (bulan berjalan)
- Top kategori pengeluaran
- Filter data berdasarkan periode

### 4. 🗂️ Manajemen Kategori

- CRUD kategori kustom per pengguna
- Tipe kategori: **Income** dan **Expense**
- Kustomisasi **icon** (Material Symbols) dan **warna** (`#RRGGBB`)
- Kategori default otomatis dibuat saat pengguna registrasi

### 5. 👤 Profil Pengguna

- Edit nama & email
- Ganti password
- Hapus akun

---

## 📊 Struktur Database

### Tabel `users`

```sql
id                  BIGINT PRIMARY KEY
name                VARCHAR
email               VARCHAR UNIQUE
password            VARCHAR (bcrypt)
email_verified_at   TIMESTAMP NULL
remember_token      VARCHAR NULL
created_at, updated_at
```

### Tabel `categories`

```sql
id          BIGINT PRIMARY KEY
user_id     BIGINT FK → users (CASCADE DELETE)
name        VARCHAR(50)
type        ENUM('income', 'expense')
icon        VARCHAR(50) NULL
color       VARCHAR(7) NULL   -- format: #RRGGBB
created_at, updated_at
```

> **Index**: `(user_id, type)` untuk performa query filter per tipe.

### Tabel `transactions`

```sql
id                BIGINT PRIMARY KEY
user_id           BIGINT FK → users (CASCADE DELETE)
category_id       BIGINT FK → categories (SET NULL on delete), nullable
amount            DECIMAL(12, 2)
type              ENUM('income', 'expense')
transaction_date  DATE
notes             TEXT NULL
input_method      ENUM('manual', 'voice', 'scan') DEFAULT 'manual'
created_at, updated_at
```

> **Index**: `(user_id, transaction_date)`, `(user_id, type)` untuk performa agregasi dashboard.

---

## 🚀 Instalasi & Setup

### Prerequisites

- PHP 8.2+
- Node.js 18+ & NPM
- Composer
- Git

### Langkah Instalasi

**1. Clone Repository**

```bash
git clone <repository-url>
cd asn_pemrograman_web
```

**2. Setup Otomatis (Direkomendasikan)**

```bash
composer run setup
```

Perintah ini akan secara otomatis:
- Menjalankan `composer install`
- Menyalin `.env.example` → `.env` (jika belum ada)
- Menghasilkan `APP_KEY`
- Menjalankan migrasi database
- Menjalankan `npm install` & `npm run build`

**3. Setup Manual (Opsional)**

```bash
# Install PHP dependencies
composer install

# Salin dan konfigurasi environment
cp .env.example .env
php artisan key:generate

# Jalankan migrasi database
php artisan migrate

# Install JS dependencies & build assets
npm install
npm run build
```

**4. Konfigurasi `.env`**

Sesuaikan `.env` sesuai kebutuhan (default menggunakan SQLite):

```env
APP_NAME="Kostly Tracker"
APP_URL=http://localhost

# Untuk PostgreSQL (opsional):
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=kostly_tracker
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Untuk fitur Scan Struk (opsional):
OCR_SPACE_API_KEY=your_ocr_api_key
```

**5. Jalankan Server Development**

```bash
composer run dev
```

Perintah ini menjalankan secara paralel:
- `php artisan serve` — Laravel server
- `php artisan queue:listen` — Queue worker
- `php artisan pail` — Log viewer
- `npm run dev` — Vite dev server

Akses aplikasi di: **http://localhost:8000**

---

## 📁 Struktur Proyek

```
asn_pemrograman_web/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── DashboardController.php   # Logika dashboard & chart data
│   │       ├── TransactionController.php  # CRUD transaksi + scan struk (OCR)
│   │       ├── CategoryController.php    # CRUD kategori
│   │       ├── ReportController.php      # Laporan & statistik
│   │       ├── ProfileController.php     # Manajemen profil
│   │       └── Auth/                     # Autentikasi (Breeze)
│   ├── Models/
│   │   ├── User.php
│   │   ├── Transaction.php
│   │   └── Category.php
│   ├── Traits/
│   │   └── HasChartColors.php            # Generator warna dinamis untuk chart
│   └── Listeners/
│       └── CreateDefaultCategories.php   # Auto-create kategori default saat register
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── factories/
├── resources/
│   ├── views/
│   │   ├── welcome.blade.php             # Landing page
│   │   ├── dashboard.blade.php           # Halaman dashboard
│   │   ├── reports.blade.php             # Halaman laporan
│   │   ├── layouts/                      # Layout utama (app, dashboard)
│   │   ├── components/                   # Komponen Blade reusable
│   │   ├── transactions/                 # Views CRUD transaksi
│   │   ├── categories/                   # Views CRUD kategori
│   │   ├── profile/                      # Views profil
│   │   └── auth/                         # Views autentikasi
│   ├── css/
│   │   └── app.css
│   └── js/
│       ├── app.js
│       └── bootstrap.js
├── routes/
│   ├── web.php                           # Route utama aplikasi
│   ├── auth.php                          # Route autentikasi (Breeze)
│   └── console.php
├── .env.example
├── Dockerfile
├── tailwind.config.js
├── vite.config.js
└── package.json
```

---

## 🔗 Daftar Route

### Publik

| Method | URI | Keterangan |
|---|---|---|
| `GET` | `/` | Landing page |
| `POST` | `/register` | Register akun baru |
| `POST` | `/login` | Login |
| `POST` | `/logout` | Logout |

### Terproteksi (Auth Required)

| Method | URI | Keterangan |
|---|---|---|
| `GET` | `/dashboard` | Halaman dashboard |
| `GET` | `/transactions` | Daftar transaksi |
| `POST` | `/transactions` | Buat transaksi baru |
| `GET` | `/transactions/{id}/edit` | Form edit transaksi |
| `PUT` | `/transactions/{id}` | Update transaksi |
| `DELETE` | `/transactions/{id}` | Hapus transaksi |
| `POST` | `/transactions/scan-struk` | Scan struk via OCR |
| `GET` | `/categories` | Daftar kategori |
| `POST` | `/categories` | Buat kategori baru |
| `PUT` | `/categories/{id}` | Update kategori |
| `DELETE` | `/categories/{id}` | Hapus kategori |
| `GET` | `/reports` | Laporan & statistik |
| `GET` | `/profile` | Form edit profil |
| `PATCH` | `/profile` | Update profil |
| `DELETE` | `/profile` | Hapus akun |

---

## 🔄 Alur Aplikasi

### Authentication Flow

```
Landing Page → Register / Login → Verifikasi Email → Dashboard
```

### Dashboard Flow

```
Buka Dashboard
    ↓
Hitung Saldo, Pemasukan, Pengeluaran (bulan ini & all-time)
    ↓
Ambil 5 Transaksi Terakhir
    ↓
Agregasi Pengeluaran per Kategori (bulan ini)
    ↓
Hitung Tren Harian (7 hari terakhir)
    ↓
Hitung Tren Mingguan (bulan berjalan, Minggu 1–5)
    ↓
Kirim data chart ke view (JSON) → Render Chart.js
```

### Transaction Entry Flow

```
Pilih Metode Input:
├── Manual  → Isi form → Validasi → Simpan
└── Scan    → Upload foto struk → OCR API → Auto-fill form → Validasi → Simpan
                                                                    ↓
                                                       Update Saldo & Statistik
                                                                    ↓
                                                   Redirect ke Daftar Transaksi
```

---

## 🎨 Design System (Material Design 3)

### Color Palette

| Token | Hex | Keterangan |
|---|---|---|
| Primary | `#005a71` | Teal (aksen utama) |
| Secondary | `#565e74` | Dark Blue-Gray |
| Tertiary | `#794602` | Orange |
| Error | `#ba1a1a` | Red |
| Surface | `#f7fafc` | Light Gray (background) |

### Tipografi

- **Font**: Plus Jakarta Sans, Figtree
- **Headline Large**: 24px Bold
- **Headline Medium**: 20px Semibold
- **Body Large**: 16px Regular
- **Body Medium**: 14px Regular
- **Label Bold**: 12px Bold

### Komponen

- **Icons**: Material Symbols Outlined
- **Shadow**: `0 4px 12px rgba(15, 23, 42, 0.05)`
- **Border Radius**: `0.25rem` (sm), `0.5rem` (lg), `0.75rem` (xl)

---

## 🐳 Docker

Proyek ini dilengkapi `Dockerfile` untuk deployment:

```bash
# Build image
docker build -t kostly-tracker .

# Jalankan container
docker run -p 8000:8000 --env-file .env kostly-tracker
```

Dockerfile menggunakan `php:8.2-cli`, menginstall semua dependency, build assets Vite, lalu menjalankan migrasi dan server secara otomatis.

---

## 🧪 Testing

```bash
# PHP tests (PHPUnit)
composer run test

# JavaScript tests (Vitest)
npm run test

# Watch mode JS tests
npm run test:watch
```

---

## 🔐 Keamanan

- Password di-hash dengan **bcrypt** (12 rounds)
- **CSRF Protection** bawaan Laravel pada setiap form
- **SQL Injection** dicegah dengan Eloquent ORM & parameter binding
- **Email verification** untuk akun baru
- **Rate limiting** untuk percobaan login
- **Cascade delete** — data transaksi & kategori terhapus otomatis jika akun dihapus
- Siap dijalankan dengan **HTTPS**

---

## 📈 Rencana Pengembangan

- [ ] Voice Input untuk transaksi (Speech-to-Text)
- [ ] Budget Planning & Notifikasi Alert
- [ ] Export Laporan ke PDF / Excel
- [ ] AI Insights & Rekomendasi Pengeluaran
- [ ] Dark Mode
- [ ] Multi-language Support (ID / EN)
- [ ] Mobile App (React Native / Flutter)

---

## 👥 Tim Pengembang

**Kelompok: SAYA AKAN LAWAN!!**
**Mata Kuliah**: Pemrograman Web
**Institusi**: Universitas Mercu Buana Yogyakarta

| No | Nama | NPM | Role |
|---|---|---|---|
| 1 | Khilmi Wahyu Saputra | 241110061 | Full Stack Developer |
| 2 | Muh Duta Arkazora | 241110079 | Frontend Developer |
| 3 | Trian Rossi Karurukan | 241110111 | Frontend Developer |
| 4 | Muh Adzin Fakhir Rahman | 241110076 | UI/UX Designer |
| 5 | Muh Yasir Al Fatah | 241110085 | UI/UX Designer |

---

## 📄 Lisensi

Proyek ini dibuat untuk keperluan akademik **Universitas Mercu Buana Yogyakarta**. Tidak untuk digunakan secara komersial.

---

## 📞 Support & Contact

Untuk pertanyaan atau feedback, silakan hubungi tim pengembang atau buka issue di repository ini.

---

> *Kostly Tracker — Catat, Analisis, Hemat. SAYA AKAN LAWAN!!* 🚀

