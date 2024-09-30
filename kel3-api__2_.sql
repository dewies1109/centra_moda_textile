-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2022 at 11:40 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kel3-api`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_admin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp_admin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_admin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_admin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `nama_admin`, `no_hp_admin`, `email_admin`, `password_admin`, `created_at`, `updated_at`) VALUES
(1, 'Kaka Gata L', '082134567878', 'kakagata@gmail.com', 'kaka1211', '2022-11-15 11:27:56', '2022-11-29 18:27:47'),
(4, 'Yofie Jiddan', '081234565543', 'yofie@gmail.com', 'yofieee15', '2022-11-29 19:24:35', '2022-11-29 19:26:31'),
(5, 'Khairi', '082345654456', 'khairi@gmail.com', 'khai1212', '2022-11-29 21:05:20', '2022-11-29 21:05:39'),
(6, 'Khairi Annisa', '0895634801021', 'khairi@gmail.com', 'khai12345', '2022-11-30 00:14:05', '2022-11-30 00:15:47');

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_jenis_barang` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_barang` int(11) NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lebar_kain` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `id_jenis_barang`, `nama_barang`, `harga_barang`, `gambar`, `lebar_kain`, `stok`, `created_at`, `updated_at`) VALUES
(1, 1, 'Batik Jayapura', 25000, 'yIAwCttVHjXnBsP3viteJAf44sLmMLDvDz8KgXSt.png', 135, 70, '2022-11-15 11:28:43', '2022-11-15 11:28:43'),
(6, 1, 'Tile Salur', 25000, 'UGUYfHwt5fbvaPyCT2W5yqIGSv9ZRaqOfI27Iyba.jpg', 200, 20, '2022-11-30 01:01:37', '2022-11-30 01:01:37'),
(7, 1, 'Brokat Payet', 45000, 'DMo8QzLw5wOPYjHtFhEMAfnHjRgeGpUGCb5YhYE6.jpg', 150, 4, '2022-11-30 08:03:10', '2022-11-30 08:03:10');

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluars`
--

CREATE TABLE `barang_keluars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pegawai` bigint(20) UNSIGNED NOT NULL,
  `id_barang` bigint(20) UNSIGNED NOT NULL,
  `tgl_keluar` date NOT NULL,
  `jml_brg_keluar` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang_keluars`
--

INSERT INTO `barang_keluars` (`id`, `id_pegawai`, `id_barang`, `tgl_keluar`, `jml_brg_keluar`, `created_at`, `updated_at`) VALUES
(4, 1, 1, '2022-11-29', 2, '2022-11-29 08:23:28', '2022-11-29 08:23:40'),
(5, 1, 1, '2022-11-30', 14, '2022-11-30 00:47:15', '2022-11-30 00:48:17');

--
-- Triggers `barang_keluars`
--
DELIMITER $$
CREATE TRIGGER `stok_kurang` AFTER INSERT ON `barang_keluars` FOR EACH ROW BEGIN
	UPDATE barangs SET stok = stok - NEW.jml_brg_keluar
    WHERE id = NEW.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `stok_kurang1` AFTER UPDATE ON `barang_keluars` FOR EACH ROW BEGIN
	UPDATE barangs SET stok = stok + OLD.jml_brg_keluar - NEW.jml_brg_keluar
    WHERE id = OLD.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `stok_kurang2` AFTER DELETE ON `barang_keluars` FOR EACH ROW BEGIN
	UPDATE barangs SET stok = stok + OLD.jml_brg_keluar
    WHERE id = OLD.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuks`
--

CREATE TABLE `barang_masuks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_supplier` bigint(20) UNSIGNED NOT NULL,
  `id_barang` bigint(20) UNSIGNED NOT NULL,
  `id_admin` bigint(20) UNSIGNED NOT NULL,
  `tgl_masuk` date NOT NULL,
  `jml_brg_masuk` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang_masuks`
--

INSERT INTO `barang_masuks` (`id`, `id_supplier`, `id_barang`, `id_admin`, `tgl_masuk`, `jml_brg_masuk`, `created_at`, `updated_at`) VALUES
(5, 1, 1, 1, '2022-11-16', 3, '2022-11-27 23:39:53', '2022-11-27 23:39:53'),
(6, 1, 1, 1, '2022-11-16', 13, '2022-11-27 23:52:27', '2022-11-29 07:52:37'),
(7, 1, 1, 1, '2022-11-30', 35, '2022-11-30 00:49:59', '2022-11-30 00:52:04');

--
-- Triggers `barang_masuks`
--
DELIMITER $$
CREATE TRIGGER `stok_tambah` AFTER INSERT ON `barang_masuks` FOR EACH ROW BEGIN
	UPDATE barangs SET stok = stok + NEW.jml_brg_masuk
    WHERE id = NEW.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `stok_tambah2` AFTER UPDATE ON `barang_masuks` FOR EACH ROW BEGIN
	UPDATE barangs SET stok = stok - OLD.jml_brg_masuk + NEW.jml_brg_masuk
    WHERE id = OLD.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `stok_tambah3` AFTER DELETE ON `barang_masuks` FOR EACH ROW BEGIN
	UPDATE barangs SET stok = stok - OLD.jml_brg_masuk
    WHERE id = OLD.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barangs`
--

CREATE TABLE `jenis_barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_barangs`
--

INSERT INTO `jenis_barangs` (`id`, `jenis_barang`, `created_at`, `updated_at`) VALUES
(1, 'Brokat Jawa', '2022-11-15 11:28:33', '2022-11-15 11:28:33'),
(5, 'Tile Premium', '2022-11-30 00:39:17', '2022-11-30 00:41:59');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(152, '2014_10_12_000000_create_users_table', 1),
(153, '2014_10_12_100000_create_password_resets_table', 1),
(154, '2019_08_19_000000_create_failed_jobs_table', 1),
(155, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(156, '2022_11_09_081338_create_jenis_barangs_table', 1),
(157, '2022_11_09_082349_create_suppliers_table', 1),
(158, '2022_11_09_082719_create_pegawais_table', 1),
(159, '2022_11_09_082902_create_admins_table', 1),
(160, '2022_11_09_083053_create_barangs_table', 1),
(161, '2022_11_09_084808_create_barang_masuks_table', 1),
(162, '2022_11_09_085038_create_barang_keluars_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pegawais`
--

CREATE TABLE `pegawais` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_pegawai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp_pegawai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_pegawai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_pegawai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pegawais`
--

INSERT INTO `pegawais` (`id`, `nama_pegawai`, `no_hp_pegawai`, `email_pegawai`, `password_pegawai`, `created_at`, `updated_at`) VALUES
(1, 'Mardhiyah Hayaty', '082390908999', 'mar@gmail.com', 'mar123', '2022-11-15 11:28:11', '2022-11-15 11:28:11'),
(4, 'Khairi', '082234334432', 'khai@gmail.com', 'khai123', '2022-11-29 10:10:20', '2022-11-29 10:10:35'),
(5, 'Mas Puja Arya', '081233567091', 'mas@gmail.com', 'maspuja123', '2022-11-30 00:22:31', '2022-11-30 00:23:46');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_supplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp_supplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_supplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_supplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `nama_supplier`, `no_hp_supplier`, `email_supplier`, `password_supplier`, `created_at`, `updated_at`) VALUES
(1, 'Figky Mandala P', '089609454565', 'figky@pcr.ac.id', 'figky1234', '2022-11-15 11:28:19', '2022-11-29 10:10:55'),
(4, 'Mas Puja', '081234565578', 'mas@gmail.com', 'mas1212', '2022-11-29 10:13:23', '2022-11-29 10:13:23'),
(5, 'Kaka Gata', '082321996670', 'kakagata@gmail.com', 'kaka123', '2022-11-30 00:31:50', '2022-11-30 00:32:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barangs_id_jenis_barang_foreign` (`id_jenis_barang`);

--
-- Indexes for table `barang_keluars`
--
ALTER TABLE `barang_keluars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barang_keluars_id_pegawai_foreign` (`id_pegawai`),
  ADD KEY `barang_keluars_id_barang_foreign` (`id_barang`);

--
-- Indexes for table `barang_masuks`
--
ALTER TABLE `barang_masuks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barang_masuks_id_supplier_foreign` (`id_supplier`),
  ADD KEY `barang_masuks_id_barang_foreign` (`id_barang`),
  ADD KEY `barang_masuks_id_admin_foreign` (`id_admin`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jenis_barangs`
--
ALTER TABLE `jenis_barangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pegawais`
--
ALTER TABLE `pegawais`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `barang_keluars`
--
ALTER TABLE `barang_keluars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `barang_masuks`
--
ALTER TABLE `barang_masuks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_barangs`
--
ALTER TABLE `jenis_barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `pegawais`
--
ALTER TABLE `pegawais`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barangs`
--
ALTER TABLE `barangs`
  ADD CONSTRAINT `barangs_id_jenis_barang_foreign` FOREIGN KEY (`id_jenis_barang`) REFERENCES `jenis_barangs` (`id`);

--
-- Constraints for table `barang_keluars`
--
ALTER TABLE `barang_keluars`
  ADD CONSTRAINT `barang_keluars_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `jenis_barangs` (`id`),
  ADD CONSTRAINT `barang_keluars_id_pegawai_foreign` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawais` (`id`);

--
-- Constraints for table `barang_masuks`
--
ALTER TABLE `barang_masuks`
  ADD CONSTRAINT `barang_masuks_id_admin_foreign` FOREIGN KEY (`id_admin`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `barang_masuks_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `barangs` (`id`),
  ADD CONSTRAINT `barang_masuks_id_supplier_foreign` FOREIGN KEY (`id_supplier`) REFERENCES `suppliers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
