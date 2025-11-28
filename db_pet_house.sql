-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Nov 2025 pada 16.57
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
-- Database: `db_pet_house`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba', 'i:1;', 1764165963),
('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba:timer', 'i:1764165963;', 1764165963);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hewans`
--

CREATE TABLE `hewans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_hewan_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Jantan','Betina') NOT NULL,
  `umur_bulan` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `hewans`
--

INSERT INTO `hewans` (`id`, `jenis_hewan_id`, `nama`, `jenis_kelamin`, `umur_bulan`, `foto`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mochi', 'Betina', 12, 'hewan-photos/7YKT7BznCju4afnLMyoCYMqiEwf83XmVCSrpRn09.jpg', 'Bulu putih bersih, mata biru.', '2025-11-26 07:00:05', '2025-11-26 07:01:03'),
(2, 1, 'Oyen', 'Jantan', 36, NULL, 'Kucing oren barbar, tapi manja.', '2025-11-26 07:00:05', '2025-11-26 07:00:05'),
(3, 2, 'Bobby', 'Jantan', 24, NULL, 'Suka main bola, vaksin lengkap.', '2025-11-26 07:00:05', '2025-11-26 07:00:05'),
(4, 6, 'Nemo ', 'Jantan', 5, NULL, ' Clownfish, sehat lincah.', '2025-11-26 07:00:05', '2025-11-26 07:00:05'),
(5, 7, 'Iggy', 'Jantan', 18, NULL, 'Iguana hijau, makan lahap sayur.', '2025-11-26 07:00:05', '2025-11-26 07:00:05'),
(6, 3, 'Chika', 'Betina', 8, NULL, 'Hamster roborovski aktif, suka lari di roda.', '2025-11-26 07:00:05', '2025-11-26 07:00:05'),
(7, 4, 'Rio', 'Jantan', 10, NULL, 'Lovebird hijau, bisa menirukan suara.', '2025-11-26 07:00:05', '2025-11-26 07:00:05'),
(8, 5, 'Thumper', 'Jantan', 14, NULL, 'Kelinci Holland Lop telinga turun, suka wortel.', '2025-11-26 07:00:05', '2025-11-26 07:00:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_hewans`
--

CREATE TABLE `jenis_hewans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_jenis` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jenis_hewans`
--

INSERT INTO `jenis_hewans` (`id`, `nama_jenis`, `created_at`, `updated_at`) VALUES
(1, 'Kucing', NULL, NULL),
(2, 'Anjing', NULL, NULL),
(3, 'Hamster', NULL, NULL),
(4, 'Burung', NULL, NULL),
(5, 'Kelinci', NULL, NULL),
(6, 'Ikan', NULL, NULL),
(7, 'Reptil', NULL, NULL);

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
(1, '2025_11_26_121401_create_jenis_hewans_table', 1),
(2, '2025_11_26_121417_create_hewans_table', 1),
(3, '2025_11_26_122451_create_sessions_table', 1),
(4, '2025_11_26_135926_create_cache_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1aDXeAZnwLeAVtnvYkJLA9pbt2CxUGNWIxRirF2G', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWGVCTmNQWlVIUmtPZDF4NWQ4eVJHeTJ5V2VERVVnSUpkTXJTUWV1eiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1764168130);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `hewans`
--
ALTER TABLE `hewans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hewans_jenis_hewan_id_foreign` (`jenis_hewan_id`);

--
-- Indeks untuk tabel `jenis_hewans`
--
ALTER TABLE `jenis_hewans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `hewans`
--
ALTER TABLE `hewans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `jenis_hewans`
--
ALTER TABLE `jenis_hewans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `hewans`
--
ALTER TABLE `hewans`
  ADD CONSTRAINT `hewans_jenis_hewan_id_foreign` FOREIGN KEY (`jenis_hewan_id`) REFERENCES `jenis_hewans` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
