# Langkah Testing - Verifikasi Fix Duplikasi Kategori

## Persiapan Testing

### 1. Bersihkan Cache
```bash
php artisan event:clear
php artisan config:clear
php artisan cache:clear
```

### 2. Verifikasi Event Listener Terdaftar Sekali
```bash
php artisan event:list | Select-String -Pattern "Registered"
```

**Hasil yang Diharapkan:**
```
Illuminate\Auth\Events\Registered
  ⇂ App\Listeners\CreateDefaultCategories@handle  (HANYA 1 BARIS)
  ⇂ Illuminate\Auth\Listeners\SendEmailVerificationNotification
```

## Testing Skenario 1: Register User Baru

### Langkah:
1. Akses halaman register: `http://localhost:8000/register`
2. Isi form registrasi dengan data user baru
3. Submit form
4. Setelah berhasil register, cek database

### Query untuk Verifikasi:
```sql
-- Cek jumlah kategori untuk user terakhir
SELECT u.id, u.email, COUNT(c.id) as total_categories
FROM users u
LEFT JOIN categories c ON c.user_id = u.id
WHERE u.id = (SELECT MAX(id) FROM users)
GROUP BY u.id, u.email;

-- Lihat detail kategori user terakhir
SELECT c.name, c.type
FROM categories c
WHERE c.user_id = (SELECT MAX(id) FROM users)
ORDER BY c.type, c.name;
```

### Hasil yang Diharapkan:
- Total kategori: **10** (bukan 20)
- Income: 4 kategori (Beasiswa, Bonus, Gaji, Kiriman Orang Tua)
- Expense: 6 kategori (Hiburan, Kesehatan, Kos, Makanan, Tagihan, Transportasi)

## Testing Skenario 2: Test dengan Tinker

```bash
php artisan tinker
```

```php
// Buat user baru
$user = \App\Models\User::create([
    'name' => 'Test User',
    'email' => 'test@example.com',
    'password' => bcrypt('password123')
]);

// Trigger event Registered secara manual
event(new \Illuminate\Auth\Events\Registered($user));

// Cek jumlah kategori
$user->categories()->count(); // Harus return 10

// Lihat detail kategori
$user->categories()->select('name', 'type')->orderBy('type')->orderBy('name')->get();
```

### Hasil yang Diharapkan:
```
=> 10  // jumlah kategori

// Detail kategori:
[
  { "name": "Beasiswa", "type": "income" },
  { "name": "Bonus", "type": "income" },
  { "name": "Gaji", "type": "income" },
  { "name": "Kiriman Orang Tua", "type": "income" },
  { "name": "Hiburan", "type": "expense" },
  { "name": "Kesehatan", "type": "expense" },
  { "name": "Kos", "type": "expense" },
  { "name": "Makanan", "type": "expense" },
  { "name": "Tagihan", "type": "expense" },
  { "name": "Transportasi", "type": "expense" }
]
```

## Testing Skenario 3: Test Proteksi Duplikasi

```bash
php artisan tinker
```

```php
// Ambil user yang sudah punya kategori
$user = \App\Models\User::latest()->first();

// Cek jumlah kategori sekarang
$before = $user->categories()->count();

// Coba trigger event lagi (simulasi double trigger)
event(new \Illuminate\Auth\Events\Registered($user));

// Cek jumlah kategori setelah trigger kedua
$after = $user->categories()->count();

// Hasilnya harus sama (tidak bertambah)
echo "Before: $before, After: $after";
```

### Hasil yang Diharapkan:
```
Before: 10, After: 10  // Tidak bertambah karena ada proteksi
```

## Testing Skenario 4: Hapus Kategori User Existing

Untuk user existing yang sudah punya kategori duplikat, gunakan seeder:

```bash
php artisan db:seed --class=DefaultCategoriesSeeder
```

Seeder ini akan:
- Hanya menambah kategori ke user yang **belum punya kategori**
- Tidak akan membuat duplikasi

## Checklist Hasil Testing

- [ ] Event listener hanya terdaftar 1 kali di `event:list`
- [ ] User baru mendapat tepat 10 kategori
- [ ] Tidak ada kategori duplikat
- [ ] Income: 4 kategori
- [ ] Expense: 6 kategori
- [ ] Event yang dipanggil berulang tidak membuat duplikasi
- [ ] Seeder tidak membuat duplikasi untuk user existing

## Clean Up After Testing

```bash
# Hapus user test
php artisan tinker
```

```php
\App\Models\User::where('email', 'test@example.com')->delete();
exit
```
