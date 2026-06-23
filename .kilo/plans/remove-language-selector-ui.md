# Plan: Menghapus Elemen UI "Bahasa/Language" dari Halaman Profile

## Tujuan
Menghapus elemen UI pemilihan bahasa yang tidak berfungsi dari halaman profile/settings karena fitur multi-bahasa tidak jadi diimplementasikan.

## Scope
- ✅ Menghapus HTML elemen "Language/Bahasa" di desktop view
- ✅ Menghapus HTML elemen "Bahasa" di mobile view
- ❌ Tidak mengubah database
- ❌ Tidak mengubah controller
- ❌ Tidak mengubah route
- ❌ Tidak mengubah logic apapun

## File yang Dimodifikasi
- `resources/views/profile/edit.blade.php` (1 file saja)

## Task List

### 1. Hapus Menu "Language" di Desktop View
**Lokasi:** `resources/views/profile/edit.blade.php` lines 242-250

**Hapus block ini:**
```blade
<li class="flex items-center justify-between">
    <div class="flex items-center gap-3 text-on-surface">
        <span class="material-symbols-outlined text-on-surface-variant">language</span>
        <span class="text-sm">Language</span>
    </div>
    <div class="flex items-center text-primary font-bold text-sm cursor-pointer">
        Bahasa <span class="material-symbols-outlined ml-1 text-sm">chevron_right</span>
    </div>
</li>
```

**Konteks:** Elemen ini berada di section "Application Settings" (Desktop View), antara toggle "Notifications" dan item "About Kostly".

---

### 2. Hapus Menu "Bahasa" di Mobile View
**Lokasi:** `resources/views/profile/edit.blade.php` lines 403-414

**Hapus block ini:**
```blade
<div class="flex items-center justify-between p-md border-b border-outline-variant/30 last:border-0">
    <div class="flex items-center gap-3">
        <div class="w-8 h-8 rounded-full bg-secondary-container/50 flex items-center justify-center text-primary">
            <span class="material-symbols-outlined text-[20px]">language</span>
        </div>
        <span class="text-sm font-semibold text-on-surface">Bahasa</span>
    </div>
    <div class="flex items-center gap-1 text-on-surface-variant">
        <span class="text-xs">Indonesia</span>
        <span class="material-symbols-outlined text-outline text-[18px]">chevron_right</span>
    </div>
</div>
```

**Konteks:** Elemen ini berada di group "Aplikasi" (Mobile View), antara toggle "Notifikasi" dan item "Tentang".

---

## Validasi
Setelah penghapusan, pastikan:
- [ ] Desktop view: Menu "Language" tidak muncul lagi di Application Settings
- [ ] Mobile view: Menu "Bahasa" tidak muncul lagi di group Aplikasi
- [ ] Tidak ada error di browser console
- [ ] Layout masih rapi (tidak ada spacing aneh)
- [ ] Menu "Notifications" dan "About Kostly" / "Tentang" masih terlihat normal

## Risiko
- **Sangat rendah** - Ini hanya penghapusan HTML statis, tidak ada logic atau data yang terpengaruh
- Tidak ada breaking changes
- Tidak mempengaruhi fitur lain

## Rollback
Jika perlu dikembalikan, cukup `git revert` commit ini atau copy-paste kembali kedua block HTML yang dihapus.
