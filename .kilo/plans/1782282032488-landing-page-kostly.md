# Landing Page Tracker Kostly - REVISI

**Tanggal:** 2026-06-24  
**Status:** Revision Ready
**Revisi:** v2 - Simplified Navigation & Voice Feature

## Tujuan

Membuat landing page marketing untuk aplikasi Tracker Kostly yang menampilkan value proposition, fitur utama, dan navigasi ke halaman login/register.

## Keputusan Desain

### 1. Struktur Halaman (REVISI)
- **Header:** Logo "Tracker Kostly" saja (navbar kanan kosong - tombol "Masuk" dihapus)
- **Hero Section:** Tagline "Kelola Uang Kost dengan Mudah" + subtitle + 1 tombol CTA dengan elevated card effect
- **Features Section:** Grid 4 fitur dengan icon dan deskripsi (fitur ke-4 diganti)
- **Footer:** Copyright sederhana dengan logo mini

### 2. Visual Design
- **Tema:** Purple gradient (menggunakan tema yang sudah ada di aplikasi)
- **Background:** `bg-gradient-to-br from-primary/5 via-background to-secondary/5`
- **Logo:** Icon wallet dalam circle gradient purple (`from-primary to-primary-dark`)
- **Font:** Plus Jakarta Sans (sudah tersedia)
- **Icons:** Material Symbols Rounded (sudah tersedia)
- **Colors:** Purple theme dari Tailwind config
  - Primary: #7c3aed
  - Primary Dark: #6d28d9
  - Primary Light: #a78bfa

### 3. Konten

#### Hero Section (REVISI)
- **Tagline:** "Kelola Uang Kost dengan Mudah"
- **Subtitle:** "Tracker Kostly membantu anak kost mencatat dan memantau keuangan harian dengan simpel dan praktis"
- **CTA Button (Single):**
  - "Mulai Sekarang" → link ke `/login` (bukan `/register`)
  - **Elevated Card Effect:**
    - Shadow XL: `shadow-2xl` (0 25px 50px rgba)
    - Hover: `hover:shadow-[0_30px_60px_rgba(124,58,237,0.3)]` + `hover:-translate-y-1` + `hover:scale-105`
    - Padding: `px-10 py-5` (lebih generous)
    - Border radius: `rounded-2xl`
    - Gradient: `bg-gradient-to-r from-primary via-primary-dark to-primary`
    - Text: `text-xl font-bold`
    - Transition: `transition-all duration-300 ease-out`
    - Glow effect: Box shadow dengan purple tint di hover

#### Features Section (4 fitur - REVISI)
1. **Catat Transaksi**
   - Icon: `receipt_long`
   - Deskripsi: "Catat pemasukan dan pengeluaran harian dengan cepat dan mudah"

2. **Lihat Grafik & Statistik**
   - Icon: `trending_up`
   - Deskripsi: "Pantau tren keuangan dengan visualisasi grafik yang jelas"

3. **Kategori Otomatis**
   - Icon: `category`
   - Deskripsi: "Kelompokkan transaksi berdasarkan kategori untuk analisis lebih baik"

4. **Catat dengan Suara** (BARU - menggantikan Laporan Keuangan)
   - Icon: `mic`
   - Deskripsi: "Catat transaksi dengan perintah suara untuk pengalaman yang lebih cepat"

### 4. Responsiveness
- **Mobile-first approach**
- **Mobile (<640px):** Features dalam grid 1 kolom, stack vertical
- **Tablet (640px-1024px):** Features dalam grid 2x2
- **Desktop (>1024px):** Features dalam grid 4 kolom horizontal

## Implementasi

### File yang Diubah
- `resources/views/welcome.blade.php` - Replace sepenuhnya

### File yang TIDAK Diubah
- Semua file aplikasi lainnya (dashboard, auth, controllers, routes, config, dll)
- `routes/web.php` - Route `/` tetap mengarah ke `welcome` view
- Tailwind config - Tidak ada perubahan color/theme

### Struktur HTML

```html
<!DOCTYPE html>
<html lang="id">
<head>
    - Meta tags (charset, viewport, csrf)
    - Title: Tracker Kostly
    - Google Fonts: Plus Jakarta Sans (via Bunny Fonts)
    - Material Symbols Rounded
    - Vite assets (CSS & JS)
</head>
<body class="font-sans antialiased">
    <!-- Header Navigation (REVISI - No Login Button) -->
    <header class="fixed top-0 w-full bg-white/80 backdrop-blur-md z-50 border-b border-outline-variant">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center">
                <!-- Logo & Brand Only -->
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-primary to-primary-dark rounded-full flex items-center justify-center">
                        <span class="material-symbols-rounded text-white">account_balance_wallet</span>
                    </div>
                    <span class="text-xl font-bold text-primary">Tracker Kostly</span>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="min-h-screen bg-gradient-to-br from-primary/5 via-background to-secondary/5 pt-24 px-4">
        <div class="max-w-4xl mx-auto text-center py-20">
            <!-- Hero Icon -->
            <div class="w-24 h-24 bg-gradient-to-br from-primary to-primary-dark rounded-full flex items-center justify-center mx-auto mb-8 shadow-lg">
                <span class="material-symbols-rounded text-white text-5xl">account_balance_wallet</span>
            </div>
            
            <!-- Hero Text -->
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-primary mb-6">
                Kelola Uang Kost dengan Mudah
            </h1>
            <p class="text-lg md:text-xl text-on-surface-variant mb-10 max-w-2xl mx-auto">
                Tracker Kostly membantu anak kost mencatat dan memantau keuangan harian dengan simpel dan praktis
            </p>
            
            <!-- CTA Button (Single - Elevated Card) -->
            <div class="flex justify-center">
                <a href="/login" class="btn-elevated">Mulai Sekarang</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-surface py-20 px-4">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-on-surface mb-16">
                Fitur Unggulan
            </h2>
            
            <!-- Features Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white rounded-card p-6 shadow-card text-center">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="material-symbols-rounded text-primary text-3xl">receipt_long</span>
                    </div>
                    <h3 class="text-xl font-bold text-on-surface mb-3">Catat Transaksi</h3>
                    <p class="text-on-surface-variant">Catat pemasukan dan pengeluaran harian dengan cepat dan mudah</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-white rounded-card p-6 shadow-card text-center">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="material-symbols-rounded text-primary text-3xl">trending_up</span>
                    </div>
                    <h3 class="text-xl font-bold text-on-surface mb-3">Grafik & Statistik</h3>
                    <p class="text-on-surface-variant">Pantau tren keuangan dengan visualisasi grafik yang jelas</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="bg-white rounded-card p-6 shadow-card text-center">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="material-symbols-rounded text-primary text-3xl">category</span>
                    </div>
                    <h3 class="text-xl font-bold text-on-surface mb-3">Kategori Otomatis</h3>
                    <p class="text-on-surface-variant">Kelompokkan transaksi berdasarkan kategori untuk analisis lebih baik</p>
                </div>
                
                <!-- Feature 4 (REVISI - Voice Feature) -->
                <div class="bg-white rounded-card p-6 shadow-card text-center">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="material-symbols-rounded text-primary text-3xl">mic</span>
                    </div>
                    <h3 class="text-xl font-bold text-on-surface mb-3">Catat dengan Suara</h3>
                    <p class="text-on-surface-variant">Catat transaksi dengan perintah suara untuk pengalaman yang lebih cepat</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-surface-container py-8 px-4 border-t border-outline-variant">
        <div class="max-w-7xl mx-auto text-center">
            <p class="text-on-surface-variant text-sm">
                © 2026 Tracker Kostly. Semua hak dilindungi.
            </p>
        </div>
    </footer>
</body>
</html>
```

### Tailwind Classes yang Digunakan

**Existing classes dari aplikasi:**
- Colors: `primary`, `primary-dark`, `primary-light`, `on-surface`, `on-surface-variant`, `background`, `surface`, `outline-variant`
- Shadows: `shadow-card`, `shadow-lg`
- Rounded: `rounded-card`, `rounded-full`, `rounded-button`
- Typography: font-bold, text sizes (text-xl, text-3xl, etc)
- Spacing: padding, margin, gap utilities

**Button styles (REVISI - Elevated Card Effect):**
```css
/* Regular button styles */
.btn {
  @apply px-6 py-3 rounded-xl font-semibold transition-all duration-200 inline-block text-center;
}

.btn-primary {
  @apply bg-gradient-to-r from-primary to-primary-dark text-white shadow-lg hover:shadow-xl hover:scale-105;
}

.btn-secondary {
  @apply bg-transparent border-2 border-primary text-primary hover:bg-primary hover:text-white;
}

/* Elevated Card Button (Hero CTA) */
.btn-elevated {
  @apply px-10 py-5 rounded-2xl text-xl font-bold text-white 
         bg-gradient-to-r from-primary via-primary-dark to-primary
         shadow-2xl hover:shadow-[0_30px_60px_rgba(124,58,237,0.3)]
         hover:-translate-y-1 hover:scale-105
         transition-all duration-300 ease-out
         inline-block text-center;
}
```

## Checklist Implementasi (REVISI)

- [x] Backup file `resources/views/welcome.blade.php` yang lama (sudah ada di v1)
- [ ] Update Header - hapus tombol "Masuk", navbar kanan kosong
- [ ] Update Hero Section - hapus tombol "Masuk", sisakan "Mulai Sekarang" dengan elevated card effect
- [ ] Update link tombol "Mulai Sekarang" dari `/register` ke `/login`
- [ ] Update Feature 4 - ganti "Laporan Keuangan" (assessment) menjadi "Catat dengan Suara" (mic)
- [ ] Update button styles - tambahkan `.btn-elevated` class dengan shadow dan hover effect
- [ ] Test navigasi tombol "Mulai Sekarang" ke `/login`
- [ ] Test responsiveness di mobile, tablet, desktop
- [ ] Verifikasi visual consistency dengan theme aplikasi

## Testing

### Manual Testing (REVISI)
1. **Navigation**
   - ✅ Tombol "Mulai Sekarang" di hero mengarah ke `/login`
   - ✅ Tidak ada tombol "Masuk" di navbar
   - ✅ Tidak ada tombol secondary di hero section
   - ✅ User dapat akses register melalui link di halaman login

2. **Button Design**
   - ✅ Tombol "Mulai Sekarang" memiliki elevated card effect
   - ✅ Shadow 2XL visible dan terlihat floating
   - ✅ Hover effect: shadow bertambah + lift animation + scale
   - ✅ Padding generous (px-10 py-5)
   - ✅ Text size xl dengan font bold

3. **Responsive Design**
   - ✅ Mobile (<640px): Features stack vertical, 1 kolom
   - ✅ Tablet (640px-1024px): Features grid 2x2
   - ✅ Desktop (>1024px): Features grid 4 kolom horizontal
   - ✅ Header tetap di top saat scroll
   - ✅ Tombol "Mulai Sekarang" responsive di semua device

4. **Visual Consistency**
   - ✅ Warna sesuai dengan theme purple aplikasi
   - ✅ Font Plus Jakarta Sans loaded dengan benar
   - ✅ Material Icons loaded dengan benar (termasuk icon `mic`)
   - ✅ Shadow dan rounded corners konsisten dengan aplikasi

5. **Features Section**
   - ✅ Feature 1-3 tetap sama (receipt_long, trending_up, category)
   - ✅ Feature 4 berubah menjadi "Catat dengan Suara" dengan icon `mic`

## Risiko dan Mitigasi (REVISI)

| Risiko | Dampak | Mitigasi |
|--------|--------|----------|
| Material Icons tidak load (icon `mic`) | Icons tidak muncul | Pastikan CDN link benar, fallback ke emoji 🎤 jika perlu |
| Tailwind classes tidak tersedia | Styling broken | Gunakan inline styles atau tambahkan custom CSS |
| Elevated button shadow tidak terlihat | CTA kurang prominent | Tambahkan explicit box-shadow dengan rgba values |
| Responsive tidak optimal pada elevated button | Button terlalu besar di mobile | Gunakan responsive padding (sm:px-10 px-8) |
| User bingung tidak ada tombol register | Konversi rendah | Pastikan di halaman login ada link jelas ke register |

## Ringkasan Revisi

### Perubahan dari V1 ke V2:

**1. Navigation Simplification**
- ❌ Hapus tombol "Masuk" dari navbar (header kanan sekarang kosong)
- ❌ Hapus tombol "Masuk" dari hero section
- ✅ Sisakan hanya 1 tombol: "Mulai Sekarang"

**2. CTA Button Enhancement**
- 🔄 Ubah link tombol "Mulai Sekarang" dari `/register` → `/login`
- ✨ Tambahkan elevated card design dengan:
  - Shadow 2XL yang dramatis
  - Hover effect: purple glow shadow + lift + scale
  - Padding lebih generous (px-10 py-5)
  - Border radius 2xl
  - Text xl dengan font bold
  - Smooth transition 300ms

**3. Features Update**
- ❌ Hapus fitur "Laporan Keuangan" (icon: assessment)
- ✅ Tambahkan fitur "Catat dengan Suara" (icon: mic)
  - Deskripsi: "Catat transaksi dengan perintah suara untuk pengalaman yang lebih cepat"

**4. User Flow**
Landing Page → Klik "Mulai Sekarang" → Login Page (yang sudah punya link ke Register)

### Rationale:

1. **Single CTA lebih fokus:** User tidak bingung memilih antara "Masuk" dan "Mulai Sekarang"
2. **Login sebagai entry point:** Halaman login existing sudah memiliki link register, jadi tidak perlu duplikasi di landing page
3. **Elevated card effect:** Membuat CTA lebih prominent dan eye-catching
4. **Voice feature:** Lebih modern dan sesuai dengan trend voice-enabled apps untuk kemudahan anak kost yang mobile-first



## Catatan Tambahan

- **Tidak ada perubahan backend/routing** - Route `/` tetap seperti semula
- **Tidak ada perubahan config** - Tailwind config, app config tidak diubah
- **Standalone page** - Tidak extend layout app.blade.php atau guest.blade.php
- **Target audience:** Anak kost di Indonesia (gunakan Bahasa Indonesia)
- **Tone:** Friendly, approachable, helpful
- **Single CTA Strategy:** Satu tombol "Mulai Sekarang" mengarah ke `/login`, di mana user dapat memilih login atau register
- **Voice Feature:** Menonjolkan fitur modern voice input sebagai diferensiator
- **Elevated Card Design:** Tombol CTA menggunakan shadow dan hover effect yang dramatis untuk menarik perhatian

## Out of Scope

- ❌ Animasi kompleks (parallax, scroll animations)
- ❌ Ilustrasi/gambar custom (fokus ke typography dan icons)
- ❌ Form newsletter/contact
- ❌ Testimonial section
- ❌ FAQ section
- ❌ Multi-language support
- ❌ Dark mode toggle (ikuti system preference via Tailwind)
- ❌ Analytics tracking
- ❌ SEO optimization (meta description, OG tags)

## Next Steps After Implementation

1. Test di berbagai browser (Chrome, Firefox, Safari, Edge)
2. Test di real mobile devices
3. Minta feedback dari target user (anak kost)
4. Optional: Tambahkan Google Analytics tracking
5. Optional: Tambahkan meta tags untuk SEO
6. Optional: Tambahkan smooth scroll animations
