# Kostly Tracker - Manajemen Keuangan Anak Kost

[![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=flat-square)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=flat-square)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind%20CSS-3-38B2AC?style=flat-square)](https://tailwindcss.com)

## 📋 Deskripsi Proyek

**Kostly Tracker** adalah aplikasi web modern untuk manajemen keuangan anak kost (mahasiswa yang tinggal di kos). Aplikasi ini membantu pengguna mencatat, menganalisis, dan mengoptimalkan pengeluaran sehari-hari dengan antarmuka yang intuitif dan fitur-fitur canggih.

### Masalah yang Dipecahkan

- Sulit melacak pengeluaran harian
- Tidak ada insight tentang pola pengeluaran
- Kesulitan membuat anggaran bulanan
- Kurangnya laporan keuangan yang terstruktur

---

## 🛠️ Teknologi yang Digunakan

### Backend

- **Framework**: [Laravel 11](https://laravel.com) - PHP web framework yang powerful dan elegant
- **PHP**: 8.2+ - Server-side programming language
- **Database**: PostgreSQL - database relasional
- **Composer**: Dependency manager untuk PHP

### Frontend

- **Tailwind CSS 3**: Utility-first CSS framework untuk styling responsif
- **Material Design 3**: Design system modern dengan Google Material Symbols
- **Chart.js 4.4**: Library untuk visualisasi data grafis
- **Blade Templating**: Laravel's expressive templating engine
- **Alpine.js**: Lightweight JavaScript framework (dari Laravel Starter Kit)

### Development Tools

- **Vite**: Modern build tool untuk development server yang cepat
- **NPM**: JavaScript package manager
- **Git**: Version control system
- **PHPUnit**: Testing framework untuk PHP

---

## ✨ Fitur Utama

### 1. Dashboard

- **Ringkasan Keuangan**: Total saldo, pemasukan, dan pengeluaran bulan ini
- **Tren Pengeluaran**: Visualisasi grafik pengeluaran dengan Chart.js
- **Transaksi Terakhir**: Daftar 5 transaksi terbaru dengan kategori dan icon
- **Status Indikator**: Trend positif/negatif dengan indicator visual

### 2. Manajemen Transaksi

- Pencatatan transaksi manual dengan kategori
- Klasifikasi otomatis berdasarkan kategori pengguna
- Input: Nominal, Tanggal, Jenis (Income/Expense), Kategori, Catatan
- Validasi data transaksi
- Update saldo real-time

### 3. Laporan & Statistik

- Breakdown pengeluaran per kategori (Pie Chart)
- Tren pengeluaran harian (7 hari terakhir)
- Tren pengeluaran mingguan
- Top kategori pengeluaran
- Filter data berdasarkan periode

### 4. Manajemen Kategori

- CRUD kategori kustom
- Tipe kategori: Income dan Expense
- Kategori default tersedia

### 5. Profil Pengguna

- Edit profil & password
- Manajemen akun
- Logout

---

## 📊 Struktur Database

### Tabel Utama

#### Users

```postgresql
- id (Primary Key)
- name (nama pengguna)
- email (email unik)
- password (hashed)
- email_verified_at
- remember_token
```

#### Categories

```postgresql
- id (Primary Key)
- user_id (Foreign Key ke Users)
- name (nama kategori)
- type (income / expense)
- created_at, updated_at
```

#### Transactions

```postgresql
- id (Primary Key)
- user_id (Foreign Key ke Users)
- category_id (Foreign Key ke Categories)
- amount (nominal transaksi)
- type (income / expense)
- transaction_date (tanggal transaksi)
- notes (catatan opsional)
- input_method (manual / voice / scan)
- created_at, updated_at
```

---

## 🚀 Instalasi & Setup

### Prerequisites

- PHP 8.2+
- Node.js 18+ & NPM
- Composer
- Git
- PostgreSQL

### Langkah Instalasi

1. **Clone Repository**

```bash
git clone <repository-url>
cd asn_pemrograman_web
```

2. **Install Dependencies**

```bash
# PHP dependencies
composer install

# JavaScript dependencies
npm install

# Tailwindcss
npm install tailwindcss-animate
```

3. **Setup Environment**

```bash
cp .env.example .env
php artisan key:generate
```

4. **Database Migration**

```bash
php artisan migrate
php artisan db:seed
```

5. **Build Assets**

```bash
npm run build
```

6. **Run Development Server**

```bash
php artisan serve
```

Akses aplikasi di: `http://localhost:8000`

---

## 📁 Struktur Proyek

```
asn_pemrograman_web/
├── app/
│   ├── Http/Controllers/
│   │   ├── DashboardController.php
│   │   ├── TransactionController.php
│   │   ├── CategoryController.php
│   │   ├── ReportController.php
│   │   └── ProfileController.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Transaction.php
│   │   └── Category.php
│   └── Listeners/
│       └── CreateDefaultCategories.php
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── factories/
├── resources/
│   ├── views/
│   │   ├── dashboard.blade.php
│   │   ├── layouts/
│   │   │   ├── app.blade.php
│   │   │   └── app-dashboard.blade.php
│   │   ├── components/
│   │   ├── transactions/
│   │   ├── categories/
│   │   ├── reports/
│   │   └── auth/
│   ├── css/
│   │   └── app.css
│   └── js/
│       ├── app.js
│       └── bootstrap.js
├── routes/
│   ├── web.php
│   ├── auth.php
│   └── console.php
├── tailwind.config.js
├── vite.config.js
└── package.json
```

---

## 🔄 Workflow Aplikasi

### 1. Authentication Flow

```
Login / Register → Verifikasi Email → Dashboard
```

### 2. Dashboard Flow

```
User membuka Dashboard
    ↓
Ambil transaksi bulan berjalan
    ↓
Hitung: Saldo, Pemasukan, Pengeluaran
    ↓
Ambil 5 transaksi terbaru
    ↓
Generate grafik tren
    ↓
Tampilkan Dashboard
```

### 3. Transaction Entry Flow

```
Masuk Menu Transaksi
    ↓
Pilih Metode Input (Manual/Voice/Scan)
    ↓
Form Terisi (Nominal, Tanggal, Jenis, Kategori, Catatan)
    ↓
Validasi Data
    ↓
Simpan Transaksi
    ↓
Update Saldo & Statistik
    ↓
Refresh Dashboard & Laporan
```

---

## 🎨 Design System (Material Design 3)

### Color Palette

- **Primary**: `#005a71` (Teal)
- **Secondary**: `#565e74` (Dark Blue-Gray)
- **Tertiary**: `#794602` (Orange)
- **Error**: `#ba1a1a` (Red)
- **Surface**: `#f7fafc` (Light Gray)

### Typography

- **Font**: Plus Jakarta Sans, Figtree
- **Headline Lg**: 24px Bold
- **Headline Md**: 20px Semibold
- **Body Lg**: 16px Regular
- **Body Md**: 14px Regular
- **Label Bold**: 12px Bold

### Components

- Material Symbols Outlined Icons
- Custom Elevation Shadow (0 4px 12px rgba(15, 23, 42, 0.05))
- Rounded Corners: 0.25rem (default), 0.5rem (lg), 0.75rem (xl)

---

## 📈 Fitur Lanjutan yang Direncanakan

- [ ] Voice Input untuk transaksi (Speech-to-Text)
- [ ] Receipt Scanning (OCR)
- [ ] Budget Planning & Alerts
- [ ] Export Laporan (PDF/Excel)
- [ ] Mobile App (React Native)
- [ ] AI Insights & Recommendations
- [ ] Multi-language Support
- [ ] Dark Mode

---

## 🔐 Security

- Password hashing dengan bcrypt
- CSRF Protection dengan Laravel
- SQL Injection prevention dengan Eloquent ORM
- Email verification untuk akun baru
- Rate limiting untuk login attempts
- HTTPS ready

---

## 📝 API Endpoints

### Authentication

- `POST /register` - Register user baru
- `POST /login` - Login
- `POST /logout` - Logout

### Dashboard

- `GET /dashboard` - Tampilkan dashboard

### Transactions

- `GET /transactions` - Daftar transaksi
- `GET /transactions/{id}` - Detail transaksi
- `POST /transactions` - Buat transaksi
- `PUT /transactions/{id}` - Update transaksi
- `DELETE /transactions/{id}` - Hapus transaksi

### Categories

- `GET /categories` - Daftar kategori
- `POST /categories` - Buat kategori
- `PUT /categories/{id}` - Update kategori
- `DELETE /categories/{id}` - Hapus kategori

### Reports

- `GET /reports` - Tampilkan laporan & statistik

---

## 👥 Tim Pengembang

**Kelompok: SAYA AKAN LAWAN!!**

| No  | Nama                    | NPM       | Role                 |
| --- | ----------------------- | --------- | -------------------- |
| 1   | Khilmi Wahyu Saputra    | 241110061 | Full Stack Developer |
| 2   | Muh Duta Arkazora       | 241110079 | Frontend Developer   |
| 3   | Trian Rossi Karurukan   | 241110111 | Frontend Developer   |
| 4   | Muh Adzin Fakhir Rahman | 241110076 | UI/UX Designer       |
| 5   | Muh Yasir Al Fatah      | 241110085 | UI/UX Designer       |

---

## 📄 Lisensi

Proyek ini dibuat untuk keperluan akademik Universitas Mercu Buana Yogyakarta.

---

## 📞 Support & Contact

Untuk pertanyaan atau feedback, silakan hubungi tim pengembang atau buka issue di repository ini.

---

Tetapi hari ini di Jogja saya sampaikan, SAYA AKAN LAWAN!!!!
