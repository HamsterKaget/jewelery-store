-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 28, 2024 at 10:08 PM
-- Server version: 8.0.36-0ubuntu0.22.04.1
-- PHP Version: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_jewelery_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `emas`
--

CREATE TABLE `emas` (
  `id` int NOT NULL,
  `toko_id` int NOT NULL,
  `user_id` int NOT NULL,
  `kode` bigint NOT NULL,
  `nama_produk` varchar(255) DEFAULT NULL,
  `tanggal_dibuat` date DEFAULT NULL,
  `tanggal_terjual` date DEFAULT NULL,
  `berat` double DEFAULT NULL,
  `tukeran` double DEFAULT NULL,
  `kadar` double DEFAULT NULL,
  `persentase` double DEFAULT NULL,
  `harga_beli` bigint DEFAULT NULL,
  `harga_jual` bigint DEFAULT NULL,
  `sales` varchar(255) DEFAULT NULL,
  `keterangan` text,
  `status_stok` enum('y','n') NOT NULL,
  `EL_HAU` enum('y','n') NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `jenis_emas_id` int NOT NULL,
  `jenis_barang_id` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `stok` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `emas`
--

INSERT INTO `emas` (`id`, `toko_id`, `user_id`, `kode`, `nama_produk`, `tanggal_dibuat`, `tanggal_terjual`, `berat`, `tukeran`, `kadar`, `persentase`, `harga_beli`, `harga_jual`, `sales`, `keterangan`, `status_stok`, `EL_HAU`, `thumbnail`, `jenis_emas_id`, `jenis_barang_id`, `created_at`, `updated_at`, `deleted_at`, `stok`) VALUES
(1, 1, 1, 202403130657001, 'NPJ ANTING EMAS PUTIH - 2gr', '2024-12-03', NULL, 2, 0, 0, 0, 0, 1500000, NULL, NULL, 'y', 'y', 'emas/.jpg', 1, 1, '2024-03-13 06:57:00', '2024-03-14 07:57:39', NULL, 1),
(2, 2, 1, 202403130745212, 'WGC Gelang Emas Putih - 10 Gr Variasi', '2025-01-03', NULL, 10, 0, 0, 85, 9500000, 12500000, NULL, NULL, 'n', 'y', 'emas/202403130745212.jpeg', 1, 3, '2024-03-13 07:45:21', '2024-03-13 08:34:58', NULL, 0),
(3, 1, 1, 202403140827153, 'NPJ ANTING EMAS PUTIH - 5gr', '2025-02-03', NULL, 5, 0, 0, 0, 4500000, 5000000, NULL, NULL, 'y', 'y', 'emas/202403140827153.jpg', 1, 1, '2024-03-14 08:27:15', '2024-03-14 08:27:26', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `id` int NOT NULL,
  `nama` char(255) NOT NULL,
  `created_by` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`id`, `nama`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Anting', 1, '2024-03-06 07:13:45', '2024-03-13 07:20:06'),
(2, 'Kalung', 1, '2024-03-13 07:20:19', '2024-03-13 07:20:19'),
(3, 'Gelang', 1, '2024-03-13 07:20:27', '2024-03-13 07:20:27'),
(4, 'Cincin', 1, '2024-03-13 07:20:33', '2024-03-13 07:20:33');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_berlian`
--

CREATE TABLE `jenis_berlian` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_by` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jenis_berlian`
--

INSERT INTO `jenis_berlian` (`id`, `nama`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Berlian 1', 1, '2024-03-06 07:01:45', '2024-03-06 07:01:45');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_emas`
--

CREATE TABLE `jenis_emas` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jenis_emas`
--

INSERT INTO `jenis_emas` (`id`, `nama`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Emas Putih', 1, '2024-03-06 06:53:50', '2024-03-06 06:53:50');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int NOT NULL,
  `nik` varchar(15) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `no_hp` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alamat` text,
  `nama_lengkap` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nik`, `email`, `no_hp`, `alamat`, `nama_lengkap`, `created_at`, `updated_at`) VALUES
(8, '327000109090006', 'dummy@gmail.com', '085157190021', 'ada', 'Dummy', '2024-03-13 08:57:23', '2024-03-13 08:57:23');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan_toko`
--

CREATE TABLE `karyawan_toko` (
  `id` int NOT NULL,
  `toko_id` int DEFAULT NULL,
  `karyawan_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `karyawan_toko`
--

INSERT INTO `karyawan_toko` (`id`, `toko_id`, `karyawan_id`, `created_at`, `updated_at`) VALUES
(7, 1, 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_02_11_133711_create_permission_tables', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 7),
(1, 'App\\Models\\User', 8),
(3, 'App\\Models\\User', 9),
(3, 'App\\Models\\User', 10),
(3, 'App\\Models\\User', 11),
(3, 'App\\Models\\User', 12),
(3, 'App\\Models\\User', 14);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `nama`, `created_at`, `deleted_at`) VALUES
(1, 'Bank - BCA', '2024-03-28 16:27:03', '2024-03-28 16:27:03'),
(2, 'Bank - BRI', '2024-03-28 16:27:03', '2024-03-28 16:27:03');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(16) NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `email`, `no_hp`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Radja Aulia', 'radjaauliaalramdani@gmail.com', '123123123', 1, '2024-03-21 00:04:24', '2024-03-21 00:12:32');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(2, 'toko', 'web', '2024-02-26 07:34:44', '2024-02-26 07:34:44'),
(3, 'karyawan', 'web', '2024-02-26 07:35:26', '2024-02-26 07:35:26'),
(4, 'role', 'web', '2024-02-26 07:35:33', '2024-02-26 07:35:33'),
(5, 'permission', 'web', '2024-02-26 07:35:42', '2024-02-26 07:35:42'),
(11, 'jenis-emas', 'web', '2024-03-05 23:44:47', '2024-03-05 23:44:47'),
(12, 'jenis-berlian', 'web', '2024-03-05 23:59:12', '2024-03-05 23:59:12'),
(13, 'jenis-barang', 'web', '2024-03-06 00:10:24', '2024-03-06 00:10:24'),
(14, 'pelanggan', 'web', '2024-03-13 02:07:00', '2024-03-13 02:07:00'),
(15, 'payment', 'web', '2024-03-28 02:33:15', '2024-03-28 02:33:15');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'owner', 'web', '2024-02-11 06:51:45', '2024-02-11 06:51:45'),
(3, 'karyawan', 'web', '2024-02-29 17:56:11', '2024-02-29 17:56:11');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(14, 3);

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id` int NOT NULL,
  `nama_toko` varchar(255) NOT NULL,
  `alamat` text,
  `npwp` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id`, `nama_toko`, `alamat`, `npwp`, `created_at`, `updated_at`) VALUES
(1, 'New Paris Jewelery', 'Kota Bogor Indonesia', '0064127892', '2024-02-20 09:20:16', '2024-03-06 04:09:26'),
(2, 'World Gems Center', 'ada', '123', '2024-02-20 09:24:06', '2024-03-06 04:09:32');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int NOT NULL,
  `no_transaksi` varchar(255) NOT NULL,
  `toko_id` int NOT NULL,
  `karyawan_id` int NOT NULL,
  `waktu_pembelian` datetime NOT NULL,
  `total_harga` double NOT NULL,
  `penyesuaian_harga` double NOT NULL,
  `payment_id` int NOT NULL,
  `status` enum('pending','sukses','gagal') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_emas`
--

CREATE TABLE `transaksi_emas` (
  `id` int NOT NULL,
  `id_transaksi` int NOT NULL,
  `emas_id` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_pelanggan`
--

CREATE TABLE `transaksi_pelanggan` (
  `id` int NOT NULL,
  `id_transaksi` int NOT NULL,
  `pelanggan_id` int DEFAULT NULL,
  `nama_pelanggan` varchar(255) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `alamat` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Radja Aulia Al Ramdani', 'radjaauliaalramdani@gmail.com', NULL, '$2y$12$IEzC6Agc1BPk1sNlkboN0.MTRd7mA1HmXXdT2gbJtvYVa8BNFHDaC', 'jsN3cPCyk10OETIUu4Vx2p1eDmIMEryb9ApAHENpeTPHHPq6FsEIk3HspPMo', '2024-02-11 06:30:44', '2024-02-11 06:30:44'),
(2, 'Guest', 'guest@wgc.com', NULL, '$2y$12$rFGZD71Ilx4sRXgqRQGwOu8kpBYa0qiBs9KLm7jkAVd3nNc4p772u', NULL, '2024-02-11 06:57:53', '2024-02-11 06:57:53'),
(3, 'Ursawhite', 'dev@ursawhite.com', NULL, '$2y$12$4jMmeAUdYgFooflel0Q0h.n9XlRzi.//fntX7BsjBBXN5IjBEvaTq', 'KtOHjS8H950v1VXwjjGFYrjl2vc0PQEmcj44jffANkJ5Zj7hMpzbzKiVf4wr', '2024-02-11 10:03:23', '2024-02-11 10:03:23'),
(14, 'Dummy', 'dummy@gmail.com', NULL, '$2y$12$Hrd7TJHSu5J7Vx1pHZrVo.7Lf3AI6NmxJMlabcNXsdANx7CbLxvt6', 'wd4Si6cbzWP5oh2NbcIdNwWRPUgaRd7F7gJQ91IwDJJyzPnUsRPWdtYOaqsZ', '2024-03-13 01:57:23', '2024-03-13 01:57:23');

-- --------------------------------------------------------

--
-- Table structure for table `users_karyawan`
--

CREATE TABLE `users_karyawan` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `karyawan_id` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users_karyawan`
--

INSERT INTO `users_karyawan` (`id`, `user_id`, `karyawan_id`, `created_at`, `updated_at`) VALUES
(6, 14, 8, '2024-03-13 08:57:23', '2024-03-13 08:57:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emas`
--
ALTER TABLE `emas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_berlian`
--
ALTER TABLE `jenis_berlian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_emas`
--
ALTER TABLE `jenis_emas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawan_toko`
--
ALTER TABLE `karyawan_toko`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_emas`
--
ALTER TABLE `transaksi_emas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_pelanggan`
--
ALTER TABLE `transaksi_pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_karyawan`
--
ALTER TABLE `users_karyawan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emas`
--
ALTER TABLE `emas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jenis_berlian`
--
ALTER TABLE `jenis_berlian`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jenis_emas`
--
ALTER TABLE `jenis_emas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `karyawan_toko`
--
ALTER TABLE `karyawan_toko`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi_emas`
--
ALTER TABLE `transaksi_emas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi_pelanggan`
--
ALTER TABLE `transaksi_pelanggan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users_karyawan`
--
ALTER TABLE `users_karyawan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
