## Workflow System
Login / Register
       │
       ▼
Dashboard
       │
       ├── Ringkasan Keuangan
       ├── Grafik Tren
       ├── Transaksi Terakhir
       │
       ▼
Transaksi
       │
       ├── Input Manual
       ├── Input Voice
       └── Scan Struk
       │
       ▼
Simpan Transaksi
       │
       ▼
Update Saldo & Statistik
       │
       ▼
Laporan & Statistik
       │
       ├── Filter Data
       ├── Pie Chart Kategori
       ├── Bar Chart Income vs Expense
       └── Line Chart Tren Pengeluaran
       │
       ▼
Pengaturan
       │
       ├── Profil
       └── Kelola Kategori


## Workflow Dashboard
User membuka Dashboard
         │
         ▼
Ambil transaksi bulan berjalan
         │
         ▼
    Hitung:
    - Saldo
    - Total Pemasukan
    - Total Pengeluaran
         │
         ▼
Ambil 5 transaksi terbaru
         │
         ▼
Generate grafik tren
         │
         ▼
Tampilkan Dashboard


## Workflow Catat Transaksi
Masuk Menu Transaksi
        │
        ▼
Pilih Metode Input
        │
        ├── Manual
        ├── Voice
        └── Scan Struk
        │
        ▼
Form Terisi
        │
        ▼
Validasi
        │
        ▼
Simpan
        │
        ▼
Update Saldo
        │
        ▼
Refresh Dashboard & Laporan

Input:
- Nominal
- Tanggal
- Jenis
- Kategori
- Catatan

Klik Simpan

## Workflow Voice Input
Rekam Suara
      │
      ▼
Speech To Text
      │
      ▼
AI Parsing
      │
      ▼
Isi Form Otomatis
      │
      ▼
User Konfirmasi
      │
      ▼
Simpan

#Scan Struck
Upload Foto
      │
      ▼
OCR
      │
      ▼
Ambil:
- Total
- Tanggal
- Merchant
      │
      ▼
Isi Form Otomatis
      │
      ▼
User Konfirmasi
      │
      ▼
Simpan

#Riwayat Transaksi
Tampilkan Semua Transaksi
        │
        ├── Search
        ├── Filter Kategori
        ├── Filter Tanggal
        ├── Edit
        └── Hapus

- Edit
Klik Edit
      │
      ▼
Ubah Data
      │
      ▼
Simpan
      │
      ▼
Hitung Ulang Statistik

- Delete
Klik Hapus
      │
      ▼
Konfirmasi
      │
      ▼
Delete
      │
      ▼
Refresh Statistik


## Workflow Laporan & Statistik
Buka Halaman Laporan
         │
         ▼
Pilih Filter
         │
         ├── Mingguan
         ├── Bulanan
         ├── Tahunan
         └── Custom
         │
         ▼
Kirim Filter
         │
         ▼
Ambil Data Transaksi
         │
         ▼
Generate Statistik
         │
         ▼
Tampilkan Grafik

- Pie Chart
Komposisi Pengeluaran per Kategori
Transaksi
      │
      ▼
Filter Pengeluaran
      │
      ▼
Group By Kategori
      │
      ▼
Hitung Persentase
      │
      ▼
Pie Chart

- Bar Chart
Perbandingan Income dan Expense
Transaksi
      │
      ▼
Filter Periode
      │
      ▼
Kelompokkan Data
      │
      ▼
Hitung:
- Income
- Expense
      │
      ▼
Bar Chart

- Line Chart
Tren Pengeluaran
Transaksi
      │
      ▼
Urutkan Berdasarkan Waktu
      │
      ▼
Hitung Total Per Periode
      │
      ▼
Line Chart


## Workflow Pengaturan
Masuk Pengaturan
       │
       ├── Profil
       └── Kategori

- Profil
Ubah Nama
Ubah Email
Ubah Password
      │
      ▼
Simpan

- Kelola Kategori
Lihat Kategori
       │
       ├── Tambah
       ├── Edit
       └── Hapus
       │
       ▼
Update Database