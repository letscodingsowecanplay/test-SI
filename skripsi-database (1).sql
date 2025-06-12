-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Jun 2025 pada 14.21
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi-database`
--

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
-- Struktur dari tabel `kkm`
--

CREATE TABLE `kkm` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kuis_id` varchar(255) NOT NULL,
  `kkm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kkm`
--

INSERT INTO `kkm` (`id`, `kuis_id`, `kkm`) VALUES
(7, 'ayo-mencoba-1', 75),
(8, 'ayo-berlatih-1', 75),
(9, 'ayo-mencoba-2', 75),
(10, 'ayo-berlatih-2', 60),
(11, 'ayo-mencoba-3', 75),
(12, 'ayo-berlatih-3', 60),
(13, 'evaluasi-1', 70);

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
(6, '2023_06_20_033844_create_permission_tables', 1),
(7, '2025_04_29_023055_create_nilai_table', 1),
(8, '2025_05_05_051257_create_soals_table', 1),
(9, '2025_05_06_024553_create_questions_table', 1),
(10, '2025_05_07_053827_create_evaluation_scores_table', 2),
(11, '2025_05_13_074642_create_soals_table', 3),
(12, '2025_05_13_074723_create_jawaban_soals_table', 3),
(13, '2025_05_13_075221_create_soals_table', 4),
(14, '2025_05_18_173344_add_jawaban_to_nilai_table', 5),
(15, '2025_05_18_174138_add_status_to_nilai_table', 6),
(16, '2025_05_19_102144_add_nip_nisn_to_users_table', 7),
(17, '2025_05_19_132854_create_kkm_table', 8);

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
(2, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 6),
(2, 'App\\Models\\User', 7),
(2, 'App\\Models\\User', 8),
(2, 'App\\Models\\User', 9),
(2, 'App\\Models\\User', 10),
(2, 'App\\Models\\User', 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `kuis_id` varchar(255) NOT NULL,
  `skor` int(11) NOT NULL DEFAULT 0,
  `total_soal` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) DEFAULT NULL,
  `jawaban` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`jawaban`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`id`, `user_id`, `kuis_id`, `skor`, `total_soal`, `status`, `jawaban`, `created_at`, `updated_at`) VALUES
(54, 5, 'ayo-berlatih-1', 4, 4, 'tidak_lulus', '{\"soal1\":\"pendek\",\"soal2\":\"panjang\",\"soal3\":\"tinggi\",\"soal4\":\"rendah\"}', '2025-05-21 07:37:22', '2025-06-11 06:58:58'),
(57, 5, 'ayo-mencoba-2', 4, 4, 'tidak_lulus', '{\"soal1\":\"b\",\"soal2\":\"a\",\"soal3\":\"a\",\"soal4\":\"a\"}', '2025-05-21 07:53:27', '2025-06-11 07:28:41'),
(61, 5, 'ayo-mencoba-3', 4, 4, 'tidak_lulus', '{\"soal1\":\"salah\",\"soal2\":\"benar\",\"soal3\":\"salah\",\"soal4\":\"benar\"}', '2025-05-21 08:25:32', '2025-06-11 07:53:08'),
(65, 5, 'evaluasi-1', 10, 10, 'tidak_lulus', '{\"1\":\"A\",\"2\":\"C\",\"3\":\"C\",\"4\":\"B\",\"5\":\"B\",\"6\":\"B\",\"7\":\"C\",\"8\":\"B\",\"9\":\"A\",\"10\":\"C\"}', '2025-05-21 08:59:51', '2025-06-11 07:54:13'),
(66, 5, 'ayo-mencoba-1', 4, 4, 'tidak_lulus', '{\"soal1\":\"b\",\"soal2\":\"a\",\"soal3\":\"b\",\"soal4\":\"a\"}', '2025-05-21 09:35:50', '2025-06-11 07:05:23'),
(112, 9, 'evaluasi-1', 20, 10, 'tidak_lulus', '{\"1\":\"A\",\"2\":\"A\",\"3\":\"A\",\"4\":\"A\",\"5\":\"A\",\"6\":\"A\",\"7\":\"A\",\"8\":\"A\",\"9\":\"A\",\"10\":\"A\"}', '2025-06-03 05:41:18', '2025-06-11 08:10:43'),
(118, 9, 'ayo-berlatih-1', 100, 4, 'lulus', '{\"soal1\":\"pendek\",\"soal2\":\"panjang\",\"soal3\":\"tinggi\",\"soal4\":\"rendah\"}', '2025-06-11 07:14:07', '2025-06-11 07:14:07'),
(120, 9, 'ayo-mencoba-2', 100, 4, 'lulus', '{\"soal1\":\"b\",\"soal2\":\"a\",\"soal3\":\"a\",\"soal4\":\"a\"}', '2025-06-11 07:34:57', '2025-06-11 07:34:57'),
(121, 9, 'ayo-berlatih-2', 100, 5, 'lulus', '[\"a\",\"b\",\"b\",\"b\",\"c\"]', '2025-06-11 07:35:24', '2025-06-11 07:35:24'),
(123, 9, 'ayo-mencoba-3', 100, 4, 'lulus', '{\"soal1\":\"salah\",\"soal2\":\"benar\",\"soal3\":\"salah\",\"soal4\":\"benar\"}', '2025-06-11 07:50:36', '2025-06-11 07:50:36'),
(126, 9, 'ayo-berlatih-3', 100, 5, 'lulus', '{\"soal1\":\"5\",\"soal2\":\"5\",\"soal3\":\"4\",\"soal4\":\"7\",\"soal5\":\"7\"}', '2025-06-11 07:57:50', '2025-06-11 07:57:50'),
(127, 9, 'ayo-mencoba-1', 100, 4, 'lulus', '{\"soal1\":\"b\",\"soal2\":\"a\",\"soal3\":\"b\",\"soal4\":\"a\"}', '2025-06-11 08:32:34', '2025-06-11 08:32:34'),
(128, 6, 'ayo-mencoba-1', 100, 4, 'lulus', '{\"soal1\":\"b\",\"soal2\":\"a\",\"soal3\":\"b\",\"soal4\":\"a\"}', '2025-06-11 08:43:05', '2025-06-11 08:43:05'),
(129, 6, 'ayo-berlatih-1', 100, 4, 'lulus', '{\"soal1\":\"pendek\",\"soal2\":\"panjang\",\"soal3\":\"tinggi\",\"soal4\":\"rendah\"}', '2025-06-11 08:43:27', '2025-06-11 08:43:27'),
(130, 6, 'ayo-mencoba-2', 75, 4, 'lulus', '{\"soal1\":\"b\",\"soal2\":\"a\",\"soal3\":\"a\",\"soal4\":\"b\"}', '2025-06-11 08:43:50', '2025-06-11 08:43:50'),
(131, 6, 'ayo-berlatih-2', 100, 5, 'lulus', '[\"a\",\"b\",\"b\",\"b\",\"c\"]', '2025-06-11 08:44:11', '2025-06-11 08:44:11'),
(132, 6, 'ayo-mencoba-3', 75, 4, 'lulus', '{\"soal1\":\"benar\",\"soal2\":\"benar\",\"soal3\":\"salah\",\"soal4\":\"benar\"}', '2025-06-11 08:44:44', '2025-06-11 08:44:44'),
(133, 6, 'ayo-berlatih-3', 100, 5, 'lulus', '{\"soal1\":\"5\",\"soal2\":\"5\",\"soal3\":\"4\",\"soal4\":\"7\",\"soal5\":\"7\"}', '2025-06-11 08:45:55', '2025-06-11 08:45:55'),
(134, 6, 'evaluasi-1', 90, 10, 'lulus', '{\"1\":\"A\",\"2\":\"C\",\"3\":\"C\",\"4\":\"B\",\"5\":\"A\",\"6\":\"B\",\"7\":\"C\",\"8\":\"B\",\"9\":\"A\",\"10\":\"C\"}', '2025-06-11 08:47:05', '2025-06-11 08:47:05'),
(135, 7, 'ayo-mencoba-1', 100, 4, 'lulus', '{\"soal1\":\"b\",\"soal2\":\"a\",\"soal3\":\"b\",\"soal4\":\"a\"}', '2025-06-11 08:48:38', '2025-06-11 08:48:38');

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
(1, 'user_access', 'web', '2025-05-05 18:54:59', '2025-05-05 18:54:59'),
(2, 'user_create', 'web', '2025-05-05 18:54:59', '2025-05-05 18:54:59'),
(3, 'user_edit', 'web', '2025-05-05 18:54:59', '2025-05-05 18:54:59'),
(4, 'user_delete', 'web', '2025-05-05 18:54:59', '2025-05-05 18:54:59'),
(5, 'role_access', 'web', '2025-05-05 18:54:59', '2025-05-05 18:54:59'),
(6, 'role_create', 'web', '2025-05-05 18:54:59', '2025-05-05 18:54:59'),
(7, 'role_edit', 'web', '2025-05-05 18:54:59', '2025-05-05 18:54:59'),
(8, 'role_delete', 'web', '2025-05-05 18:54:59', '2025-05-05 18:54:59'),
(9, 'permission_access', 'web', '2025-05-05 18:54:59', '2025-05-05 18:54:59'),
(10, 'permission_create', 'web', '2025-05-05 18:54:59', '2025-05-05 18:54:59'),
(11, 'permission_edit', 'web', '2025-05-05 18:54:59', '2025-05-05 18:54:59'),
(12, 'permission_delete', 'web', '2025-05-05 18:54:59', '2025-05-05 18:54:59'),
(13, 'materi_access', 'web', '2025-05-05 19:30:07', '2025-05-05 19:30:07'),
(14, 'evaluasi_access', 'web', '2025-05-05 19:30:21', '2025-05-05 19:30:21'),
(15, 'datasiswa_access', 'web', '2025-05-18 23:08:48', '2025-05-18 23:08:48'),
(16, 'datalatihansiswa_access', 'web', '2025-05-19 01:24:07', '2025-05-19 01:51:11'),
(17, 'datahasilbelajarsiswa_access', 'web', '2025-05-19 04:20:28', '2025-05-19 04:21:41'),
(18, 'editkkm_access', 'web', '2025-05-19 04:42:45', '2025-05-19 04:42:45');

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
(1, 'Admin', 'web', '2025-05-05 18:55:00', '2025-05-05 18:55:00'),
(2, 'Siswa', 'web', '2025-05-05 18:55:00', '2025-05-18 23:13:16');

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
(13, 2),
(14, 2),
(15, 1),
(16, 1),
(17, 1),
(18, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `nisn` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `nip`, `nisn`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ana', 'admin@demo.com', '2110131320009', NULL, NULL, '$2y$10$OmYcBl/Gt.dhcRePqGGQyOpyRfd927J7UBDPT3RuumeFLws0op4tu', 1, NULL, '2025-05-05 18:55:00', '2025-05-05 18:55:00'),
(5, 'Santi', 'santi@gmail.com', NULL, '131313', NULL, '$2y$10$DskifuJDkbQx66exrAAEgebZY8tTdYQLhx.AW569UdN.8MBLYMdcS', 1, NULL, '2025-05-21 07:15:28', '2025-05-21 07:15:28'),
(6, 'ayu', 'ayu@gmail.com', NULL, '141414', NULL, '$2y$10$Jtg/.DSpIS6FCrKnfTMMa.FyQuLjkPq.fEtzbpE59PE3nLOVrhnDC', 1, NULL, '2025-05-22 21:39:56', '2025-05-22 21:39:56'),
(7, 'uya', 'uya@gmail.com', NULL, '151515', NULL, '$2y$10$2knCjGWFT6KuXDupKU2iQOSqCjlDmGE6VNUVoWyZ6jDhtMlWTDpOy', 1, NULL, '2025-05-28 08:20:11', '2025-05-28 08:20:11'),
(8, 'nopa', 'nopa@gmail.com', NULL, '161616', NULL, '$2y$10$fRjFfh9mwMUhYzHLsRqTRO0Gh8Wo4FYLByUvoa9coHy6MvbMXlifu', 1, NULL, '2025-05-28 23:07:04', '2025-05-28 23:07:04'),
(9, 'Sli', 'sri@gmail.com', NULL, '181818', NULL, '$2y$10$JxfXNdulGOeH4LmxJLw6kOXILLRmACCMpk3o3WFI8i90Cr/zjqW/G', 1, NULL, '2025-05-28 23:30:25', '2025-06-11 02:07:49'),
(10, 'Nia Karina', 'nia@gmail.com', NULL, '171717', NULL, '$2y$10$EK/dp4cnU4MDt40g5O.neun4WDtGU4AFCullut0/.H4zyX3DnCJxC', 1, NULL, '2025-06-03 07:27:41', '2025-06-03 07:27:41'),
(11, 'Rani Cantika', 'rani@gmail.com', NULL, '191919', NULL, '$2y$10$NxnBPjuKPjVYOlndgwl0i.DmlhEji92jmnLLskncPllXS4iouTbx.', 1, NULL, '2025-06-03 07:37:35', '2025-06-03 07:37:35');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `kkm`
--
ALTER TABLE `kkm`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kkm_kuis_id_unique` (`kuis_id`);

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
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nilai_user_id_kuis_id_unique` (`user_id`,`kuis_id`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_nip_unique` (`nip`),
  ADD UNIQUE KEY `users_nisn_unique` (`nisn`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kkm`
--
ALTER TABLE `kkm`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
-- Ketidakleluasaan untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
