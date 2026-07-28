-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Nov 2024 pada 01.04
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penggajian_mau_maju`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `departemen`
--

CREATE TABLE `departemen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `departemen`
--

INSERT INTO `departemen` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Sales & Marketing', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(2, 'Finance', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(3, 'Human Resource', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(4, 'IT', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(5, 'Production', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(6, 'Logistic', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(7, 'Purchasing', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(8, 'Quality Control', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(9, 'Research & Development', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(10, 'General Affairs', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(11, 'Legal', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(12, 'Security', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(13, 'Maintenance', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(14, 'Others', '2024-11-26 17:02:52', '2024-11-26 17:02:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_09_16_152107_create_permission_tables', 1),
(7, '2023_09_16_152224_create_departemens_table', 1),
(8, '2023_09_16_152233_create_posisis_table', 1),
(9, '2023_09_16_152401_create_pegawais_table', 1),
(10, '2023_09_16_152420_create_presensis_table', 1),
(11, '2023_09_16_152452_create_penggajians_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_pegawai` char(16) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `departemen_id` bigint(20) UNSIGNED NOT NULL,
  `posisi_id` bigint(20) UNSIGNED NOT NULL,
  `status_pegawai` enum('tetap','kontrak','HL') NOT NULL DEFAULT 'tetap',
  `masa_kerja_tahun` tinyint(3) UNSIGNED NOT NULL,
  `gaji_pokok` decimal(10,2) NOT NULL,
  `tunjangan_tetap` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id`, `no_pegawai`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `departemen_id`, `posisi_id`, `status_pegawai`, `masa_kerja_tahun`, `gaji_pokok`, `tunjangan_tetap`, `created_at`, `updated_at`) VALUES
(1, '2313231368564387', 'Bagya Budiman M.TI.', 'Serang', '1992-04-23', 'P', 11, 6, 'tetap', 1, 32209518.18, 4848964.60, '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(2, '3600324323718583', 'Mulyono Tri Budiyanto', 'Metro', '2002-12-23', 'L', 10, 4, 'tetap', 9, 42881530.28, 4491282.97, '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(3, '9484866744589070', 'Gara Gunarto S.Sos', 'Gunungsitoli', '1994-06-22', 'L', 7, 5, 'kontrak', 1, 52875118.30, 1638878.94, '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(4, '5989378153619230', 'Rafid Cemplunk Prasetyo', 'Bandung', '1987-01-12', 'L', 10, 6, 'tetap', 1, 61371792.71, 4764836.43, '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(5, '0851441841109308', 'Muhammad Pandu Ramadan S.E.I', 'Banda Aceh', '1992-10-10', 'L', 3, 4, 'kontrak', 4, 11456104.06, 2577267.63, '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(6, '1943109274806096', 'Halim Salahudin', 'Samarinda', '1981-11-03', 'P', 1, 6, 'kontrak', 5, 32383874.89, 3725937.75, '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(7, '9899238225006077', 'Dewi Rahayu', 'Padangsidempuan', '1985-06-15', 'P', 4, 4, 'tetap', 0, 21291647.95, 2926829.76, '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(8, '5119945394005260', 'Latika Ghaliyati Wulandari S.H.', 'Bitung', '1977-07-12', 'P', 4, 3, 'HL', 0, 59702750.50, 4232339.62, '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(9, '5689833276936644', 'Shania Fujiati', 'Bukittinggi', '1997-04-03', 'L', 10, 5, 'HL', 9, 78040460.93, 3773910.29, '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(10, '2672919399048726', 'Emin Kala Prayoga S.Sos', 'Bekasi', '1978-03-11', 'P', 14, 2, 'HL', 0, 34802304.30, 1223604.94, '2024-11-26 17:02:52', '2024-11-26 17:02:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penggajian`
--

CREATE TABLE `penggajian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_ref` char(20) NOT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_hingga` date DEFAULT NULL,
  `periode` char(20) DEFAULT NULL,
  `status` enum('draf','disetujui','dibatalkan') NOT NULL DEFAULT 'draf',
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `kehadiran` tinyint(3) UNSIGNED DEFAULT NULL,
  `absen` tinyint(3) UNSIGNED DEFAULT NULL,
  `alpha` tinyint(3) UNSIGNED DEFAULT NULL,
  `cuti` tinyint(3) UNSIGNED DEFAULT NULL,
  `lama_lembur` char(10) DEFAULT NULL,
  `gaji_pokok` decimal(10,2) DEFAULT NULL,
  `jumlah_tunjangan_tetap` decimal(10,2) DEFAULT NULL,
  `jumlah_insentif` decimal(10,2) DEFAULT NULL,
  `jumlah_lembur` decimal(10,2) DEFAULT NULL,
  `jumlah_potongan_nwnp` decimal(10,2) DEFAULT NULL,
  `jumlah_potongan_bpjs` decimal(10,2) DEFAULT NULL,
  `jumlah_penambah_gaji` decimal(10,2) DEFAULT NULL,
  `jumlah_potongan_gaji` decimal(10,2) DEFAULT NULL,
  `total_gaji` decimal(10,2) DEFAULT NULL,
  `dibuat_oleh` bigint(20) UNSIGNED DEFAULT NULL,
  `disetujui_oleh` bigint(20) UNSIGNED DEFAULT NULL,
  `dibatalkan_oleh` bigint(20) UNSIGNED DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penggajian`
--

INSERT INTO `penggajian` (`id`, `no_ref`, `tanggal_mulai`, `tanggal_hingga`, `periode`, `status`, `pegawai_id`, `kehadiran`, `absen`, `alpha`, `cuti`, `lama_lembur`, `gaji_pokok`, `jumlah_tunjangan_tetap`, `jumlah_insentif`, `jumlah_lembur`, `jumlah_potongan_nwnp`, `jumlah_potongan_bpjs`, `jumlah_penambah_gaji`, `jumlah_potongan_gaji`, `total_gaji`, `dibuat_oleh`, `disetujui_oleh`, `dibatalkan_oleh`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, '058-470-049', '2021-01-01', '2021-01-31', '2021 Januari', 'draf', 1, NULL, NULL, NULL, NULL, NULL, 32209518.18, 4848964.60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(2, '855-926-990', '2021-01-01', '2021-01-31', '2021 Januari', 'draf', 2, NULL, NULL, NULL, NULL, NULL, 42881530.28, 4491282.97, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2024-11-26 17:02:52', '2024-11-26 17:02:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'permission-create', 'web', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(2, 'permission-delete', 'web', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(3, 'permission-edit', 'web', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(4, 'permission-index', 'web', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(5, 'role-create', 'web', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(6, 'role-delete', 'web', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(7, 'role-edit', 'web', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(8, 'role-index', 'web', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(9, 'user-create', 'web', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(10, 'user-delete', 'web', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(11, 'user-edit', 'web', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(12, 'user-index', 'web', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(13, 'penggajian-create', 'web', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(14, 'penggajian-delete', 'web', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(15, 'penggajian-edit', 'web', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(16, 'penggajian-index', 'web', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(17, 'pegawai-create', 'web', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(18, 'pegawai-delete', 'web', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(19, 'pegawai-edit', 'web', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(20, 'pegawai-index', 'web', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(21, 'presensi-create', 'web', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(22, 'presensi-delete', 'web', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(23, 'presensi-edit', 'web', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(24, 'presensi-index', 'web', '2024-11-26 17:02:52', '2024-11-26 17:02:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `posisi`
--

CREATE TABLE `posisi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `departemen_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `posisi`
--

INSERT INTO `posisi` (`id`, `departemen_id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 6, 'Staff', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(2, 4, 'Jajaran Direksi', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(3, 13, 'Manager', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(4, 9, 'Direktur', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(5, 11, 'Jajaran Direksi', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(6, 13, 'Direktur', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(7, 14, 'Staff', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(8, 3, 'Jajaran Direksi', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(9, 6, 'Supervisor', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(10, 8, 'Staff', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(11, 12, 'Manager', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(12, 11, 'Manager', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(13, 3, 'Direktur', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(14, 11, 'Jajaran Direksi', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(15, 3, 'Direktur Utama', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(16, 4, 'Jajaran Direksi', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(17, 1, 'Supervisor', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(18, 9, 'Direktur', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(19, 14, 'Direktur', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(20, 13, 'Staff', '2024-11-26 17:02:52', '2024-11-26 17:02:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `presensi`
--

CREATE TABLE `presensi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('hadir','izin','sakit','cuti','alpha') NOT NULL DEFAULT 'hadir',
  `waktu_masuk` timestamp NULL DEFAULT NULL,
  `waktu_keluar` timestamp NULL DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `presensi`
--

INSERT INTO `presensi` (`id`, `pegawai_id`, `status`, `waktu_masuk`, `waktu_keluar`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 'hadir', '2020-12-31 18:18:00', '2021-01-01 09:30:31', 'libero', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(2, 1, 'hadir', '2021-01-01 05:42:41', '2021-01-01 05:10:46', 'dolorem', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(3, 1, 'hadir', '2021-01-01 05:01:56', '2021-01-01 10:55:01', 'enim', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(4, 1, 'hadir', '2021-01-01 02:17:31', '2021-01-01 04:11:59', 'ad', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(5, 1, 'hadir', '2021-01-01 02:04:26', '2021-01-01 06:18:02', 'ipsum', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(6, 1, 'hadir', '2021-01-01 13:20:26', '2020-12-31 23:47:07', 'vel', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(7, 1, 'hadir', '2021-01-01 10:47:32', '2021-01-01 06:04:10', 'iure', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(8, 1, 'hadir', '2020-12-31 21:04:19', '2021-01-01 13:58:47', 'molestiae', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(9, 1, 'hadir', '2021-01-01 11:22:06', '2021-01-01 04:55:32', 'reprehenderit', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(10, 1, 'hadir', '2020-12-31 22:50:12', '2021-01-01 03:29:18', 'ipsum', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(11, 1, 'hadir', '2020-12-31 18:04:50', '2020-12-31 17:17:06', 'ab', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(12, 1, 'hadir', '2021-01-01 10:10:08', '2021-01-01 13:26:49', 'iusto', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(13, 1, 'hadir', '2021-01-01 04:42:25', '2020-12-31 21:18:06', 'fugiat', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(14, 1, 'hadir', '2021-01-01 11:42:48', '2020-12-31 19:30:41', 'asperiores', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(15, 1, 'hadir', '2020-12-31 23:23:54', '2021-01-01 03:17:58', 'aut', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(16, 1, 'hadir', '2021-01-01 05:42:53', '2021-01-01 04:22:29', 'sunt', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(17, 1, 'hadir', '2021-01-01 08:46:41', '2021-01-01 05:05:50', 'exercitationem', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(18, 1, 'hadir', '2020-12-31 22:41:53', '2021-01-01 15:48:34', 'fugiat', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(19, 1, 'hadir', '2021-01-01 12:55:37', '2021-01-01 01:04:53', 'harum', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(20, 1, 'hadir', '2021-01-01 01:01:19', '2021-01-01 02:16:33', 'non', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(21, 1, 'hadir', '2021-01-01 08:36:42', '2021-01-01 04:06:50', 'est', '2024-11-26 17:02:52', '2024-11-26 17:02:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'staff-payroll', 'web', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(2, 'supervisor-payroll', 'web', '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(3, 'user', 'web', '2024-11-26 17:02:52', '2024-11-26 17:02:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(15, 2),
(16, 1),
(16, 2),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Staff Payroll', 'staff@maumaju.com', NULL, '$2y$10$ob2ACh2puNS5gweOFQot7.2pStSuLtSK5qqLG6pLfbdQAVb6iKsWS', NULL, '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(2, 'SPV Payroll', 'spv@maumaju.com', NULL, '$2y$10$Mjp29SzbAQ54/S0Kr5SwTO9jMtkAKB5TSMSfyMUZHGWeD3dWdzcAG', NULL, '2024-11-26 17:02:52', '2024-11-26 17:02:52'),
(3, 'Example User', 'user@maumaju.com', NULL, '$2y$10$w371jqLsAhKoAE2tE/yl2.mOAM69bjx6EOg6rt7mq43K/KOOEc59y', NULL, '2024-11-26 17:02:52', '2024-11-26 17:02:52');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pegawai_no_pegawai_unique` (`no_pegawai`),
  ADD KEY `pegawai_departemen_id_foreign` (`departemen_id`),
  ADD KEY `pegawai_posisi_id_foreign` (`posisi_id`);

--
-- Indeks untuk tabel `penggajian`
--
ALTER TABLE `penggajian`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `penggajian_no_ref_unique` (`no_ref`),
  ADD KEY `penggajian_pegawai_id_foreign` (`pegawai_id`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `posisi`
--
ALTER TABLE `posisi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posisi_departemen_id_foreign` (`departemen_id`);

--
-- Indeks untuk tabel `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `presensi_pegawai_id_foreign` (`pegawai_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `penggajian`
--
ALTER TABLE `penggajian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `posisi`
--
ALTER TABLE `posisi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_departemen_id_foreign` FOREIGN KEY (`departemen_id`) REFERENCES `departemen` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pegawai_posisi_id_foreign` FOREIGN KEY (`posisi_id`) REFERENCES `posisi` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penggajian`
--
ALTER TABLE `penggajian`
  ADD CONSTRAINT `penggajian_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `posisi`
--
ALTER TABLE `posisi`
  ADD CONSTRAINT `posisi_departemen_id_foreign` FOREIGN KEY (`departemen_id`) REFERENCES `departemen` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `presensi`
--
ALTER TABLE `presensi`
  ADD CONSTRAINT `presensi_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
