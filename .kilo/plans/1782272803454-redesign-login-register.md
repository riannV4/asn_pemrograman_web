# Rencana: Redesign Halaman Login & Register dengan Tema Purple Gradient

## Ringkasan

Mendesain ulang halaman login dan register agar konsisten dengan tema purple gradient yang sudah digunakan di dashboard aplikasi Tracker Kostly.

## Lokasi File

- **Login:** `resources/views/auth/login.blade.php`
- **Register:** `resources/views/auth/register.blade.php`

## Status Git

Berdasarkan analisis repository:
- Branch saat ini: `profile`
- Working directory: **CLEAN** (tidak ada perubahan uncommitted)
- Branch remote baru dari teman: `dashboard`, `reports`, `transaction`

**Kesimpulan tentang Pull:**
- **TIDAK akan terjadi conflict** karena working directory Anda sudah clean
- Anda bisa pull/merge dengan aman
- Branch teman berbeda dengan branch Anda, jadi kemungkinan conflict minimal

**Cara pull yang aman:**
```bash
# Jika ingin merge branch teman ke profile
git merge origin/dashboard
git merge origin/reports
git merge origin/transaction

# Atau pull main dulu
git checkout main
git pull origin main
git checkout profile
git merge main
```

## Perubahan Desain

### 1. Login Page (login.blade.php)

**Elemen Desain Baru:**
- Logo aplikasi dengan icon `account_balance_wallet` dalam lingkaran gradient purple
- Header dengan warna primary purple (#7c3aed)
- Input field dengan icon Material Symbols di sebelah kiri
- Border radius menggunakan `rounded-button` (16px)
- Warna background `surface-container`
- Focus state dengan ring primary purple
- Button gradient dari `primary` ke `primary-dark`
- Shadow menggunakan `shadow-card`
- Hover effect dengan `scale-[1.02]`

**Struktur:**
```
- Logo lingkaran dengan gradient purple + icon wallet
- Judul "Selamat Datang Kembali" (warna primary)
- Subtitle abu-abu
- Form:
  - Email field dengan icon mail
  - Password field dengan icon lock
  - Remember me checkbox + Lupa password link
  - Button "Masuk" dengan icon login
  - Link ke register
```

### 2. Register Page (register.blade.php)

**Elemen Desain Baru:**
- Logo aplikasi sama seperti login
- Header "Buat Akun Baru" dengan warna primary
- 4 input fields dengan icon:
  - Name (icon: person)
  - Email (icon: mail)
  - Password (icon: lock)
  - Confirm Password (icon: lock_reset)
- Button "Daftar Sekarang" dengan icon person_add
- Link ke login

**Konsistensi Desain:**
- Semua menggunakan palet warna purple gradient
- Border radius konsisten (rounded-button = 16px)
- Typography menggunakan text-headline-lg, text-body-md, dll
- Shadow menggunakan shadow-card dan shadow-fab
- Spacing konsisten (space-y-6, space-y-8)

## Warna yang Digunakan

Dari `tailwind.config.js`:
- `primary`: #7c3aed
- `primary-dark`: #6d28d9
- `primary-light`: #a78bfa
- `primary-container`: #ede9fe
- `surface-container`: #f5f5f5
- `on-surface`: #1f2937
- `on-surface-variant`: #6b7280
- `outline-variant`: #d1d5db

## Icon Material Symbols

**PENTING:** Guest layout (`resources/views/layouts/guest.blade.php`) **BELUM** include Material Symbols font!

Perlu ditambahkan:
```html
<!-- Material Symbols -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
```

Icons yang digunakan:
- `account_balance_wallet` - Logo
- `mail` - Email field
- `lock` - Password field
- `lock_reset` - Confirm password
- `person` - Name field
- `login` - Button login
- `person_add` - Button register

## Task Implementasi

1. **Edit guest.blade.php:**
   - Tambah link Material Symbols font di `<head>`
   - Update background gradient dari blue ke purple theme
   - Update card styling dengan rounded-card
   - Update shadow sesuai theme

2. **Edit login.blade.php:**
   - Tambah logo dengan gradient purple di atas
   - Update typography ke theme colors (primary, on-surface, dll)
   - Tambah icon Material Symbols di input fields (mail, lock)
   - Update button dengan gradient primary ke primary-dark
   - Update border radius ke rounded-button
   - Update spacing dan shadows

3. **Edit register.blade.php:**
   - Struktur sama seperti login
   - Tambah logo dan header dengan theme baru
   - 4 input fields dengan icon masing-masing (person, mail, lock, lock_reset)
   - Update button styling dengan icon person_add
   - Update link styling

4. **Verifikasi:**
   - Test login page di browser
   - Test register page di browser
   - Pastikan responsive di mobile
   - Pastikan form validation masih bekerja
   - Pastikan icons muncul dengan benar

## Validasi

- [ ] Guest layout sudah include Material Symbols font
- [ ] Background gradient guest layout berubah ke purple theme
- [ ] Halaman login tampil dengan tema purple gradient
- [ ] Halaman register tampil dengan tema purple gradient
- [ ] Icons Material Symbols muncul di semua input field
- [ ] Button hover effect bekerja (scale-[1.02] dan shadow)
- [ ] Form validation masih berfungsi normal
- [ ] Link antar halaman (login ↔ register) bekerja
- [ ] Responsive di mobile dan desktop
- [ ] Konsisten dengan desain dashboard

## Catatan

- **Guest layout belum include Material Symbols font** - harus ditambahkan di `guest.blade.php`
- Semua warna sudah didefinisikan di `tailwind.config.js`
- Border radius custom (rounded-button=16px, rounded-card=24px) sudah ada di config
- Font Plus Jakarta Sans sudah didefinisikan di tailwind config

## Detail Perubahan Guest Layout

**File:** `resources/views/layouts/guest.blade.php`

**Perubahan yang diperlukan:**

1. **Tambah Material Symbols di `<head>`** setelah fonts:
```html
<!-- Material Symbols -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
```

2. **Update background gradient** di body:
   - Dari: `bg-gradient-to-br from-blue-50 via-white to-purple-50`
   - Ke: `bg-gradient-to-br from-primary/5 via-background to-secondary/5`

3. **Update card styling**:
   - Dari: `bg-white shadow-2xl rounded-2xl`
   - Ke: `bg-surface shadow-card rounded-card`

4. **Hapus/sembunyikan logo default** karena sudah ada di login/register page

## Detail Perubahan Login Page

**File:** `resources/views/auth/login.blade.php`

**Struktur HTML baru:**
```html
<x-guest-layout>
    <div class="space-y-8">
        <!-- Logo + Header -->
        <div class="text-center">
            <!-- Logo Circle dengan Gradient -->
            <div class="w-20 h-20 bg-gradient-to-br from-primary to-primary-dark rounded-full ... shadow-fab">
                <span class="material-symbols-rounded text-white text-4xl">account_balance_wallet</span>
            </div>
            <!-- Title -->
            <h2 class="text-headline-lg font-bold text-primary">Selamat Datang Kembali</h2>
            <p class="text-body-md text-on-surface-variant">...</p>
        </div>

        <!-- Form -->
        <form ...>
            <!-- Email dengan icon -->
            <div class="relative">
                <span class="material-symbols-rounded absolute left-4 ...">mail</span>
                <input class="pl-12 pr-4 py-4 bg-surface-container border-2 border-outline-variant rounded-button focus:ring-primary ...">
            </div>

            <!-- Password dengan icon -->
            <div class="relative">
                <span class="material-symbols-rounded absolute left-4 ...">lock</span>
                <input class="pl-12 pr-4 py-4 ...">
            </div>

            <!-- Button dengan icon -->
            <button class="bg-gradient-to-r from-primary to-primary-dark rounded-button shadow-card ...">
                <span class="material-symbols-rounded">login</span>
                Masuk
            </button>
        </form>
    </div>
</x-guest-layout>
```

**Key Classes:**
- Input: `pl-12 pr-4 py-4 bg-surface-container border-2 border-outline-variant rounded-button focus:ring-2 focus:ring-primary`
- Button: `bg-gradient-to-r from-primary to-primary-dark rounded-button shadow-card hover:shadow-card-hover`
- Icon position: `absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant`

## Detail Perubahan Register Page

**File:** `resources/views/auth/register.blade.php`

**Struktur sama seperti login**, dengan tambahan:

1. **Icon untuk Name field:**
```html
<span class="material-symbols-rounded absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">person</span>
```

2. **Icon untuk Confirm Password:**
```html
<span class="material-symbols-rounded absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">lock_reset</span>
```

3. **Button icon:**
```html
<span class="material-symbols-rounded">person_add</span>
```

4. **Header text:**
   - Title: "Buat Akun Baru"
   - Subtitle: "Daftar untuk memulai mengelola keuangan Anda"
