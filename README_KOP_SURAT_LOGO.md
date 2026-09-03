# 📄 Panduan Menaruh Logo Kop Surat — PermitID

## Lokasi File Logo

Logo kop surat harus ditaruh di folder **`public/`** dalam proyek Laravel:

```
C:\laragon\www\PermitID\public\
```

---

## 📌 File yang Dibutuhkan

| File | Posisi di Kop Surat | Keterangan |
|------|---------------------|------------|
| `kop_logo_left.png` | **Kiri** | Logo sekolah SMK Antartika 2 (logo bulat biru) |
| `kop_logo_right.png` | **Kanan** | Logo instansi / yayasan / kementerian (lambang garuda/kemendikbud, dsb.) |

---

## 🛠️ Cara Memasang

### 1. Siapkan file logo
- Format: **PNG** (disarankan background transparan)
- Resolusi: minimal **200x200 px** agar tidak pecah saat dicetak
- Nama file **harus persis** seperti tabel di atas (huruf kecil semua)

### 2. Salin ke folder `public/`

**Langkah manual (File Explorer):**
1. Buka folder `C:\laragon\www\PermitID\public\`
2. Copy-paste file logo kamu ke dalam folder tersebut
3. Rename file menjadi:
   - Logo sekolah (kiri) → `kop_logo_left.png`
   - Logo instansi (kanan) → `kop_logo_right.png`

**Atau lewat Command Prompt / PowerShell:**
```powershell
# Contoh: salin dari folder Downloads
copy "C:\Users\USER\Downloads\logo_smk.png" "C:\laragon\www\PermitID\public\kop_logo_left.png"
copy "C:\Users\USER\Downloads\logo_yayasan.png" "C:\laragon\www\PermitID\public\kop_logo_right.png"
```

### 3. Selesai!
Refresh halaman cetak surat di browser. Logo akan langsung tampil di kop surat.

---

## 🔍 Pengecekan

Jika file logo **belum ada**, kop surat akan menampilkan kotak placeholder bertuliskan "LOGO KIRI" atau "LOGO KANAN" dengan garis putus-putus. Ini artinya file belum ditaruh atau nama file salah.

**Checklist jika logo tidak muncul:**
- [ ] Nama file sudah benar? (`kop_logo_left.png` dan `kop_logo_right.png`)
- [ ] File ada di folder `C:\laragon\www\PermitID\public\`?
- [ ] Format file PNG? (bukan `.jpg`, `.jpeg`, atau `.webp`)
- [ ] Sudah refresh browser? (Ctrl + Shift + R untuk hard refresh)

---

## 📐 Ukuran Tampilan

| Logo | Lebar Tampil | Catatan |
|------|-------------|---------|
| Kiri | ~80px | Logo utama sekolah |
| Kanan | ~75px | Logo yayasan/instansi |

Ukuran tampilan sudah diatur otomatis oleh CSS. Kamu cukup menyediakan file gambar dengan resolusi yang baik.

---

## 📁 Struktur Folder Akhir

```
C:\laragon\www\PermitID\public\
├── kop_logo_left.png     ← Logo kiri (SMK Antartika 2)
├── kop_logo_right.png    ← Logo kanan (Yayasan/Instansi)
├── logo.png              ← Logo web/navbar (sudah ada)
├── index.php
└── ...
```
