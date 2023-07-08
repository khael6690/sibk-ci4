-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 27, 2023 at 03:06 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sibk`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'group admin'),
(2, 'user', 'group user');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int UNSIGNED NOT NULL DEFAULT '0',
  `permission_id` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_groups_permissions`
--

INSERT INTO `auth_groups_permissions` (`group_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int UNSIGNED NOT NULL DEFAULT '0',
  `user_id` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 3),
(1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'umam', NULL, '2023-06-26 08:07:49', 0),
(2, '::1', 'umam', 2, '2023-06-26 08:10:45', 0),
(3, '::1', 'umam', 2, '2023-06-26 08:11:04', 0),
(4, '::1', 'umamjr007@gmail.com', 3, '2023-06-26 08:14:25', 1),
(5, '::1', 'umamjr007@gmail.com', 3, '2023-06-26 09:04:54', 1),
(6, '::1', 'umamjr007@gmail.com', 3, '2023-06-26 09:06:32', 1),
(7, '::1', 'umamjr007@gmail.com', 3, '2023-06-26 09:09:32', 1),
(8, '::1', 'umamjr007@gmail.com', 3, '2023-06-26 09:14:59', 1),
(9, '::1', 'umamjr007@gmail.com', 3, '2023-06-26 10:34:12', 1),
(10, '::1', 'umamjr007@gmail.com', 3, '2023-06-26 10:35:06', 1),
(11, '::1', 'umamjr007@gmail.com', 3, '2023-06-26 13:57:51', 1),
(12, '::1', 'umamjr007@gmail.com', 3, '2023-06-27 00:47:53', 1),
(13, '::1', 'userbaru@mail', 4, '2023-06-27 00:59:48', 1),
(14, '::1', 'umam', NULL, '2023-06-27 01:03:15', 0),
(15, '::1', 'umamjr007@gmail.com', 3, '2023-06-27 01:03:26', 1),
(16, '::1', 'adminbk@mail', 5, '2023-06-27 01:05:13', 1),
(17, '::1', 'umamjr007@gmail.com', 3, '2023-06-27 01:05:50', 1),
(18, '::1', 'userbaru@mail', 4, '2023-06-27 01:21:40', 1),
(19, '::1', 'umamjr007@gmail.com', 3, '2023-06-27 01:22:32', 1),
(20, '::1', 'userbaru@mail', 4, '2023-06-27 01:22:44', 1),
(21, '::1', 'umamjr007@gmail.com', 3, '2023-06-27 01:46:53', 1),
(22, '::1', 'userbaru@mail', 4, '2023-06-27 02:05:03', 1),
(23, '::1', 'umamjr007@gmail.com', 3, '2023-06-27 02:38:57', 1),
(24, '::1', 'umamjr007@gmail.com', 3, '2023-06-27 02:39:07', 1),
(25, '::1', 'umamjr007@gmail.com', 3, '2023-06-27 02:40:33', 1),
(26, '::1', 'umamjr007@gmail.com', 3, '2023-06-27 02:42:07', 1),
(27, '::1', 'userbaru', 4, '2023-06-27 02:42:36', 0),
(28, '::1', 'userbaru', 4, '2023-06-27 02:43:04', 0),
(29, '::1', 'umamjr007@gmail.com', 3, '2023-06-27 02:51:02', 1),
(30, '::1', 'umamjr007@gmail.com', 3, '2023-06-27 02:51:55', 1),
(31, '::1', 'userbaru', 4, '2023-06-27 02:56:10', 0),
(32, '::1', 'userbaru', 4, '2023-06-27 02:56:44', 0),
(33, '::1', 'umamjr007@gmail.com', 3, '2023-06-27 02:56:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_permissions`
--

INSERT INTO `auth_permissions` (`id`, `name`, `description`) VALUES
(1, 'manage-data', 'full akses'),
(2, 'manage-pelanggaran', 'akses manage-pelanggaran');

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `permission_id` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `guru_id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jk` varchar(1) NOT NULL,
  `no_hp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`guru_id`, `nama`, `alamat`, `jk`, `no_hp`, `created_at`, `updated_at`) VALUES
(1, 'susilo wahyono', 'jl. kalijaga', 'l', '08212345678', '2023-06-22 09:02:34', '2023-06-22 14:23:55'),
(2, 'khael umam', 'JL. Perjuangan', 'l', '898 1234 4444', '2023-06-22 11:46:28', '2023-06-25 08:35:29'),
(4, 'dewi', 'jalan jalan', 'p', '123 1234 1234', '2023-06-22 14:49:38', '2023-06-26 10:27:39');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `jurusan_id` int NOT NULL,
  `nama_jurusan` varchar(255) NOT NULL,
  `singkatan` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`jurusan_id`, `nama_jurusan`, `singkatan`, `created_at`, `updated_at`) VALUES
(1, 'Ilmu Pengetahuan Alam', 'IPA', '2023-06-22 09:03:24', '2023-06-23 07:16:37'),
(2, 'Ilmu Pengetahuan Sosial', 'IPS', '2023-06-23 06:16:32', '2023-06-23 06:16:32'),
(3, 'Teknik Jaringan Komputer', 'TKJ', '2023-06-23 06:17:37', '2023-06-23 06:17:37');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int NOT NULL,
  `jenis` int NOT NULL DEFAULT '1',
  `nama` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `jenis`, `nama`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Disiplin Dalam PBM', 'Tidak menggangu Kegiatan Belajar Mengajar', '2023-06-24 04:05:58', '2023-06-24 11:42:26'),
(14, 2, 'Testing 1', '', '2023-06-27 01:48:01', '2023-06-27 01:55:07'),
(15, 1, 'Testing 2', '', '2023-06-27 01:48:58', '2023-06-27 01:50:47');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `kelas_id` int NOT NULL,
  `jurusan_id` int NOT NULL,
  `guru_id` int NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kelas_id`, `jurusan_id`, `guru_id`, `nama_kelas`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'IIX', '2023-06-22 09:01:48', '2023-06-22 09:01:48'),
(2, 2, 4, 'XII', '2023-06-23 04:30:45', '2023-06-23 09:28:35'),
(3, 3, 2, 'IX', '2023-06-23 04:31:07', '2023-06-23 09:28:40');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1687765847, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ortu`
--

CREATE TABLE `ortu` (
  `ortu_id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jk` varchar(1) NOT NULL,
  `no_hp` varchar(12) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ortu`
--

INSERT INTO `ortu` (`ortu_id`, `nama`, `jk`, `no_hp`, `created_at`, `updated_at`) VALUES
(6, 'abdul', 'l', '1234567890', '2023-06-24 09:01:12', '2023-06-24 09:01:12'),
(7, 'budi', 'l', '1234567890', '2023-06-24 09:01:54', '2023-06-25 08:50:46'),
(8, 'aldi taher', 'l', '08212345678', '2023-06-26 04:52:27', '2023-06-26 04:52:27');

-- --------------------------------------------------------

--
-- Table structure for table `panggilan_ortu`
--

CREATE TABLE `panggilan_ortu` (
  `panggilan_id` int NOT NULL,
  `nis` bigint NOT NULL,
  `status` int DEFAULT '0',
  `keterangan` text NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `panggilan_ortu`
--

INSERT INTO `panggilan_ortu` (`panggilan_id`, `nis`, `status`, `keterangan`, `created_at`, `updated_at`) VALUES
(8, 100003, 0, '', '2023-06-27', '2023-06-27');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggaran`
--

CREATE TABLE `pelanggaran` (
  `pelanggaran_id` int NOT NULL,
  `kategori_id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `hukuman` text NOT NULL,
  `bobot` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pelanggaran`
--

INSERT INTO `pelanggaran` (`pelanggaran_id`, `kategori_id`, `nama`, `deskripsi`, `hukuman`, `bobot`, `created_at`, `updated_at`) VALUES
(1, 1, 'Datang Terlambat', 'siswa datang terlambat lebih dari 1 jam masuk sekolah', 'nyapu sekolah', 2, '2023-06-24 04:51:27', '2023-06-24 04:51:27'),
(11, 14, 'list test 1', '', 'hukuman 1', 1, '2023-06-27 01:48:37', '2023-06-27 01:48:37'),
(12, 14, 'list test 2', '', 'hukuman 2', 2, '2023-06-27 01:49:17', '2023-06-27 01:49:17'),
(13, 14, 'list test 3', '', 'hukuman 3', 3, '2023-06-27 01:50:12', '2023-06-27 01:50:12');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggaran_siswa`
--

CREATE TABLE `pelanggaran_siswa` (
  `pelsiswa_id` int NOT NULL,
  `nis` int NOT NULL,
  `pelanggaran_id` int NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tindakan` text NOT NULL,
  `panggil_ortu` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pelanggaran_siswa`
--

INSERT INTO `pelanggaran_siswa` (`pelsiswa_id`, `nis`, `pelanggaran_id`, `keterangan`, `tindakan`, `panggil_ortu`, `status`, `created_at`, `updated_at`) VALUES
(3, 100003, 13, '', '', 0, 0, '2023-06-27 01:55:26', '2023-06-27 01:55:26');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nis` bigint NOT NULL,
  `kelas_id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `ortu_id` int DEFAULT NULL,
  `jk` varchar(1) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `kelas_id`, `nama`, `ortu_id`, `jk`, `no_hp`, `alamat`, `created_at`, `updated_at`) VALUES
(100000, 2, 'vivi', 6, 'p', '1234567890', 'Jl. bahagia', '2023-06-24 09:01:00', '2023-06-25 08:50:09'),
(100002, 3, 'maman', 7, 'l', '1234567890', 'jl. kalijaga', '2023-06-24 09:01:40', '2023-06-25 08:50:00'),
(100003, 1, 'wiwin', 8, 'p', '08212345678', 'jl. jalan aja', '2023-06-26 04:52:08', '2023-06-26 04:52:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'umamjr007@gmail.com', 'umam', '$2y$10$BxUy5Kx0NwBKiqM/6ev1t.TXiiMkFZnck7qccXx0.HRNz4jqgVnfK', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-06-26 08:14:13', '2023-06-27 01:05:34', NULL),
(4, 'userbaru@mail', 'userbaru', '$2y$10$g6/5L/obpSzeHOw5wo8FP.PrD8EQt3w80Tuitv7Igpd9Dy3NNnOMm', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-06-27 00:48:32', '2023-06-27 02:58:08', NULL),
(5, 'adminbk@mail', 'adminbk', '$2y$10$mVMVpQXOTuVMAzvmOVRAd.1353dJgLPXq6AVcypTBibc11SYy56sC', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-06-27 01:04:56', '2023-06-27 03:00:32', '2023-06-27 03:00:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`guru_id`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`jurusan_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kelas_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ortu`
--
ALTER TABLE `ortu`
  ADD PRIMARY KEY (`ortu_id`);

--
-- Indexes for table `panggilan_ortu`
--
ALTER TABLE `panggilan_ortu`
  ADD PRIMARY KEY (`panggilan_id`);

--
-- Indexes for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD PRIMARY KEY (`pelanggaran_id`);

--
-- Indexes for table `pelanggaran_siswa`
--
ALTER TABLE `pelanggaran_siswa`
  ADD PRIMARY KEY (`pelsiswa_id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `guru_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `jurusan_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `kelas_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ortu`
--
ALTER TABLE `ortu`
  MODIFY `ortu_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `panggilan_ortu`
--
ALTER TABLE `panggilan_ortu`
  MODIFY `panggilan_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  MODIFY `pelanggaran_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pelanggaran_siswa`
--
ALTER TABLE `pelanggaran_siswa`
  MODIFY `pelsiswa_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
