# Product Requirement Document (PRD) - Sistem Informasi Penggajian (Payroll System)

## 1. Ringkasan Proyek (Project Overview)
Aplikasi ini adalah Sistem Informasi Penggajian berbasis Laravel yang dirancang untuk mengelola data karyawan, kalkulasi komponen penggajian bulanan, pencetakan slip gaji, dan pelaporan keuangan penggajian.

## 2. Arsitektur & Spesifikasi Teknis
- **Framework:** Laravel (PHP 8.2+)
- **Arsitektur:** Model-View-Controller (MVC) / Service Layer
- **Database:** MySQL / PostgreSQL (Menggunakan Eloquent ORM)
- **Tipe Data Keuangan:** Seluruh nilai moneter wajib menggunakan tipe data `DECIMAL` / presisi desimal 2 angka (`number_format`).
- **Keamanan:** Kredensial di `.env`, input query wajib menggunakan Prepared Statement / Eloquent ORM untuk mencegah SQL Injection.

## 3. Aturan Bisnis & Formulasi Algoritma Gaji (Business Rules)
### A. Komponen Penambah (Gross Earnings)
1. **Gaji Pokok:** Nominal dasar sesuai standar posisi/karyawan.
2. **Tunjangan Fixed:** Tunjangan Jabatan / Tunjangan Tetap.
3. **Insentif Masa Kerja:** Dihitung berdasarkan lama bekerja karyawan.
4. **Lembur Progresif:** Dihitung berdasarkan total jam lembur x tarif lembur per jam.

### B. Komponen Pengurang (Deductions)
1. **Potongan Absensi NWNP (No Work No Pay):** Potongan harian jika karyawan tidak hadir tanpa keterangan resmi.
2. **Potongan BPJS:** Potongan wajib sebesar 3% dari akumulasi gaji dasar.

### C. Formula Utama
- `Gaji Bruto = Gaji Pokok + Tunjangan + Insentif Masa Kerja + Lembur Progresif`
- `Total Potongan = Potongan NWNP + BPJS (3%) + Potongan Lainnya`
- `Gaji Netto (Take Home Pay) = Gaji Bruto - Total Potongan`

## 4. Mekanisme & Standardisasi Kode
- **Penanganan Null & Error:** Mencegah `TypeError` atau `Undefined array key` dengan *Null-Coalescing Operator* (`?? 0`).
- **Logika Bisnis:** Harus terisolasi di `Model` atau `Service` (bukan *hardcoded* di Blade View).
- **Pengujian:** Seluruh logika perhitungan gaji wajib lolos pengujian otomatis pada `tests/Unit/PenggajianTest.php`.
- **Dokumentasi Kode:** Menggunakan format anotasi PHPDoc pada tiap *method*.

## 5. Instruksi Khusus untuk AI Agent (AntiGravity Rules)
1. **Konteks Jawaban:** Selalu berikan penjelasan dan solusi kode dalam konteks proyek penggajian ini.
2. **Jangan Mengubah Logika Tanpa Konfirmasi:** Jika diminta melakukan *refactoring*, pastikan tidak merubah rumus dasar matematika penggajian di atas.
3. **Bahasa:** Jelaskan konsep teknis menggunakan Bahasa Indonesia yang mudah dipahami namun tetap formal/profesional untuk kebutuhan Asesmen Sertifikasi Kompetensi (Serkom).