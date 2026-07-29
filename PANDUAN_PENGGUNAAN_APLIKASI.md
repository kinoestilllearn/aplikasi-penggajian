# Panduan Operasional Penggunaan Aplikasi Penggajian (Payroll System)
**PT Mau Maju — Asesmen Sertifikasi Kompetensi Analis Program**

Dokumen ini disusun sebagai panduan langkah demi langkah (*User Guide*) dalam mengoperasikan **Sistem Informasi Penggajian berbasis Laravel (MVC)** untuk kebutuhan demonstrasi dan verifikasi kompetensi pada Asesmen Sertifikasi Kompetensi Analis Program.

---

## 1. Prasyarat & Persiapan Sistem

Sebelum memperagakan aplikasi, pastikan seluruh dependensi dan lingkungan server lokal telah siap.

### A. Persyaratan Perangkat Lunak
- **PHP**: Versi 8.2 atau lebih baru (dengan ekstensi `pdo_mysql`, `mbstring`, `gd`).
- **Database**: MySQL / MariaDB (via XAMPP/Laragon/Native).
- **Composer**: Dependency Manager PHP.
- **Node.js & NPM**: Untuk kompilasi asset Vite/Tailwind.

### B. Langkah Menjalankan Aplikasi
1. **Buka Terminal / Command Prompt** di direktori utama proyek:
   ```bash
   cd "d:\PROJECT\Aplikasi Penggajian"
   ```
2. **Jalankan Migrasi & Seeder Database** (apabila menggunakan database baru):
   ```bash
   php artisan migrate:fresh --seed
   ```
   *Atau impor secara manual berkas dump database [penggajian_mau_maju.sql](file:///d:/PROJECT/Aplikasi%20Penggajian/penggajian_mau_maju.sql) ke dalam MySQL.*

3. **Jalankan Development Server**:
   ```bash
   php artisan serve
   ```
   Aplikasi akan berjalan di URL: `http://127.0.0.1:8000`.

4. **Jalankan Build Frontend (Vite/Tailwind)**:
   ```bash
   npm run dev
   ```

### C. Kredensial Akses Pengguna Default

Aplikasi ini mengimplementasikan *Role-Based Access Control* (RBAC) menggunakan Spatie Permission:

| Peran (Role) | Email | Password | Hak Akses Utama |
| :--- | :--- | :--- | :--- |
| **Staff Payroll** | `staff@maumaju.com` | `Password` | Input data pegawai, presensi, dan membuat draf penggajian baru. |
| **Supervisor Payroll** | `spv@maumaju.com` | `Password` | Meninjau, menyetujui (*approve*), atau membatalkan (*cancel*) draf penggajian. |
| **User Biasa** | `user@maumaju.com` | `Password` | Akses baca terbatas / melihat slip gaji individual. |

---

## 2. Siklus & Alur Kerja Utama (Step-by-Step)

Siklus penggajian bulanan di PT Mau Maju mengikuti alur 4 tahap utama:

```
[Langkah 1: Data Master & Presensi] ➔ 
[Langkah 2: Hitung & Buat Draf Gaji] ➔ 
[Langkah 3: Approval Supervisor] ➔ 
[Langkah 4: Cetak Slip Gaji PDF]
```

### Langkah 1: Input & Kelola Data Master Pegawai & Presensi
1. **Login** menggunakan akun `staff@maumaju.com`.
2. Akses menu **Data Pegawai** melalui sidebar navigasi.
3. Pastikan data pegawai telah memiliki atribut finansial yang valid:
   - **Gaji Pokok** (contoh: Rp 5.000.000,00)
   - **Tunjangan Tetap** (contoh: Rp 1.000.000,00)
   - **Status Pegawai** (`tetap`, `kontrak`, atau `harian lepas`)
   - **Masa Kerja** (digunakan untuk menghitung insentif otomatis).
4. Pastikan data **Presensi** pegawai pada bulan periode penggajian sudah tercatat pada tabel `presensi` (terisi otomatis dari seeder `php artisan db:seed` atau berkas `penggajian_mau_maju.sql`).
   > **Catatan Pendataan Presensi:**
   > Pendataan presensi tersimpan di tabel database `presensi` yang mencatat log harian pegawai (`status`: *hadir, izin, sakit, cuti, alpha* serta *waktu_masuk* & *waktu_keluar*). Saat pembuatan slip gaji, sistem secara otomatis meng-query dan mengagregasi total jam kerja, jam lembur, dan absensi tersebut via panggilan AJAX tanpa perlu input manual per hari.

### Langkah 2: Membuat Draf Penggajian Baru
1. Masuk ke menu **Penggajian Pegawai** ➔ Klik tombol **Buat Penggajian Baru** (atau via URL `/penggajian/create`).
2. **Pilih Periode Penggajian**:
   - Pilih **Bulan Periode** (contoh: *Januari*) dan **Tahun Periode** (contoh: *2021*).
3. **Pilih Karyawan**:
   - Pilih nama pegawai pada dropdown **Pilih Karyawan**.
   - Sistem akan memanggil fungsi AJAX `data-pegawai` secara otomatis untuk mengisi NIP, Departemen, Posisi, Gaji Pokok, dan Tunjangan Tetap.
4. **Kalkulasi Otomatis Sistem**:
   - Klik tombol **Hitung Gaji Sekarang** (`hitungPenggajian()`).
   - Sistem akan mengeksekusi kalkulasi backend via AJAX `data-penggajian` untuk menghitung:
     * **Insentif Masa Kerja** (berdasarkan lama bekerja pegawai).
     * **Upah Lembur Progresif** (berdasarkan jam lembur dari presensi).
     * **Potongan NWNP** (*No Work No Pay* jika ada alpha/izin).
     * **Potongan BPJS** (3% dari Gaji Pokok + Tunjangan Tetap).
     * **Total Take Home Pay** (`Gaji Bruto - Total Potongan`).
5. Klik **Buat Slip Gaji** untuk menyimpan transaksi penggajian ke database dengan status awal **`Draf`**.

### Langkah 3: Peninjauan & Persetujuan (Approval Supervisor)
1. **Logout** dari akun Staff, lalu **Login** menggunakan akun `spv@maumaju.com`.
2. Masuk ke menu **Approval Penggajian**.
3. Cari transaksi penggajian dengan status **Draf** pada DataTables ➔ Klik tombol **Lihat Detail / Approval** (ikon mata `eye`).
4. Pada **Panel Approval Supervisor** di bagian atas:
   - Pilih status **Disetujui (Approved)** untuk menyetujui transaksi penggajian.
   - Atau pilih status **Dibatalkan (Cancelled)** jika terdapat kekeliruan data.
5. Klik **Update Status**. Status penggajian akan diperbarui dan mencatat ID Supervisor sebagai approver resmi.

### Langkah 4: Pencetakan Slip Gaji PDF & Rekapitulasi Data
1. Pada halaman detail penggajian penggajian yang telah disetujui:
   - Klik **Preview PDF** untuk membuka dokumen slip gaji interaktif pada tab browser baru.
   - Klik **Export PDF** untuk mengunduh berkas `.pdf` slip gaji pegawai secara otomatis.
2. Dokumen PDF berisi rincian lengkap identitas perusahaan (PT Mau Maju), data pegawai, rincian komponen pendapatan, potongan, dan tanda stempel watermark status approval (`DISETUJUI`).

---

## 3. Penjelasan Rincian Fitur di Antarmuka

### A. Tabel Utama DataTables (`index.blade.php`)
Tabel penggajian menggunakan library **Yajra DataTables** yang menyediakan fitur pencarian (*search*), pengurutan (*sorting*), paginasi (*pagination*), serta tombol ekspor (*Excel, CSV, Print*).

Warna latar belakang baris tabel memberikan indikasi status secara visual:
- **Warna Hijau (`bg-success`)**: Transaksi penggajian telah **Disetujui**.
- **Warna Merah Miring (`bg-danger fst-italic`)**: Transaksi penggajian **Dibatalkan**.
- **Warna Standar**: Transaksi penggajian dalam status **Draf (Pending)**.

### B. Tombol-Tombol Aksi (`action.blade.php`)

Pada kolom **Action** di setiap baris tabel, terdapat 3 tombol aksi interaktif:

| Ikon Tombol | Nama & Tooltip | Fungsi Utama |
| :---: | :--- | :--- |
| `eye` | **Lihat Detail / Approval** | Membuka rincian lengkap slip gaji pegawai dan antarmuka *Approval* bagi Supervisor Payroll. |
| `file-text` | **Preview PDF** | Membuka dan menampilkan *stream* file PDF slip gaji di tab browser baru menggunakan DomPDF. |
| `trash-2` | **Hapus Transaksi** | Menampilkan konfirmasi popup Javascript dan menghapus data penggajian dari database via HTTP `DELETE` method. |

---

## 4. Troubleshooting & Penanganan Kendala

| Gejala Kendala | Kemungkinan Penyebab | Solusi Penanganan |
| :--- | :--- | :--- |
| **Nilai Gaji / Lembur 0 saat klik Hitung Gaji** | Data presensi pegawai pada bulan/periode tersebut belum terinput di database. | Pastikan data presensi pegawai di periode (tahun-bulan) tersebut sudah ada di tabel `presensi`. |
| **Error `TypeError` / `Undefined Property`** | Nilai komponen bernilai `null`. | Model [Penggajian.php](file:///d:/PROJECT/Aplikasi%20Penggajian/app/Models/Penggajian.php) telah menggunakan operator `?? 0` untuk mencegah error ini. Re-run `php artisan test`. |
| **Akses Ditolak (403 Forbidden)** | Akun login tidak memiliki role Spatie yang sesuai (misal: Staff mencoba halaman Approval). | Pastikan Anda login sesuai perannya (`spv@maumaju.com` untuk approval). |
| **Halaman DataTables Tidak Loading** | Dependency Javascript / AJAX terganggu. | Pastikan `npm run dev` atau CDN internet aktif untuk memuat jQuery & DataTables script. |

---

*Dokumen ini dibuat secara otomatis sebagai standar acuan verifikasi uji kompetensi sistem penggajian PT Mau Maju.*
