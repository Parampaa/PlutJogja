-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2018 at 12:36 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `plut_kumkm`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_usaha`
--

CREATE TABLE `jenis_usaha` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_usaha`
--

INSERT INTO `jenis_usaha` (`id`, `nama`, `deskripsi`) VALUES
(1, 'Kuliner', 'intinya tentang makanan dan minuman'),
(2, 'Fashion', 'intinya tentang model baju dll.'),
(3, 'Pertanian', NULL),
(4, 'Kerajinan', NULL),
(5, 'Peternakan', NULL),
(6, 'Jasa', NULL),
(7, 'Perikanan', NULL),
(8, 'Koperasi', NULL),
(9, 'Perdagangan', NULL),
(10, 'Otomotif', NULL),
(11, 'Pendidikan', 'Bimbel'),
(12, 'Teknologi Internet', NULL),
(13, 'Elektronik dan Gadget', NULL),
(14, 'Produksi', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kabupaten`
--

CREATE TABLE `kabupaten` (
  `id` int(1) NOT NULL,
  `nama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kabupaten`
--

INSERT INTO `kabupaten` (`id`, `nama`) VALUES
(1, 'Yogyakarta'),
(2, 'Sleman'),
(3, 'Gunung Kidul'),
(4, 'Kulon Progo'),
(5, 'Bantul');

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id` int(3) NOT NULL,
  `id_kabupaten` int(1) DEFAULT NULL,
  `kecamatan` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`id`, `id_kabupaten`, `kecamatan`) VALUES
(1, 1, 'Wirobrajan'),
(2, 1, 'Umbulharjo'),
(3, 1, 'Tegalrejo'),
(4, 1, 'Pakualaman'),
(5, 1, 'Ngampilan'),
(6, 1, 'Mergangsan'),
(7, 1, 'Mantrijeron'),
(8, 1, 'Kraton'),
(9, 1, 'Kotagede'),
(10, 1, 'Jetis'),
(11, 1, 'Gondomanan'),
(12, 1, 'Gondokusuman'),
(13, 1, 'Gedong Tengen'),
(14, 1, 'Danurejan'),
(15, 2, 'Turi'),
(16, 2, 'Tempel'),
(17, 2, 'Sleman'),
(18, 2, 'Seyegan'),
(19, 2, 'Prambanan'),
(20, 2, 'Pakem'),
(21, 2, 'Ngemplak'),
(22, 2, 'Ngaglik'),
(23, 2, 'Moyudan'),
(24, 2, 'Mlati'),
(25, 2, 'Minggir'),
(26, 2, 'Kalasan'),
(27, 2, 'Godean'),
(28, 2, 'Gamping'),
(29, 2, 'Depok'),
(30, 2, 'Cangkringan'),
(31, 2, 'Berbah'),
(32, 3, 'Wonosari'),
(33, 3, 'Tepus'),
(34, 3, 'Tanjungsari'),
(35, 3, 'Semin'),
(36, 3, 'Semanu'),
(37, 3, 'Sapto Sari'),
(38, 3, 'Rongkop'),
(39, 3, 'Purwosari'),
(40, 3, 'Ponjong'),
(41, 3, 'Playen'),
(42, 3, 'Patuk'),
(43, 3, 'Panggang'),
(44, 3, 'Paliyan'),
(45, 3, 'Nglipar'),
(46, 3, 'Ngawen'),
(47, 3, 'Karangmojo'),
(48, 3, 'Girisubo'),
(49, 3, 'Gedang Sari'),
(50, 4, 'Wates'),
(51, 4, 'Temon'),
(52, 4, 'Sentolo'),
(53, 4, 'Samigaluh'),
(54, 4, 'Pengasih'),
(55, 4, 'Panjatan'),
(56, 4, 'Nanggulan'),
(57, 4, 'Lendah'),
(58, 4, 'Kokap'),
(59, 4, 'Kalibawang'),
(60, 4, 'Girimulyo'),
(61, 4, 'Galur'),
(62, 5, 'Srandakan'),
(63, 5, 'Sewon'),
(64, 5, 'Sedayu'),
(65, 5, 'Sanden'),
(66, 5, 'Pundong'),
(67, 5, 'Pleret'),
(68, 5, 'Piyungan'),
(69, 5, 'Pandak'),
(70, 5, 'Pajangan'),
(71, 5, 'Kretek'),
(72, 5, 'Kasihan'),
(73, 5, 'Jetis'),
(74, 5, 'Imogiri'),
(75, 5, 'Dlingo'),
(76, 5, 'Bantul'),
(77, 5, 'Banguntapan'),
(78, 5, 'Bambang Lipuro');

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi`
--

CREATE TABLE `konsultasi` (
  `id` int(10) UNSIGNED NOT NULL,
  `mitra` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `masalah` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diagnosa` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `solusi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kriteria_umkm`
--

CREATE TABLE `kriteria_umkm` (
  `id` int(10) UNSIGNED NOT NULL,
  `label` varchar(20) NOT NULL,
  `batas_asset` bigint(20) NOT NULL,
  `batas_omset` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria_umkm`
--

INSERT INTO `kriteria_umkm` (`id`, `label`, `batas_asset`, `batas_omset`) VALUES
(1, 'Mikro', 50000000, 300000000),
(2, 'Kecil', 500000000, 2500000000),
(3, 'Menengah', 10000000000, 50000000000);

-- --------------------------------------------------------

--
-- Table structure for table `legalitas`
--

CREATE TABLE `legalitas` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `deskripsi` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `legalitas`
--

INSERT INTO `legalitas` (`id`, `nama`, `deskripsi`) VALUES
(1, 'Domisili', 'Domisili'),
(2, 'SIUP', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `masalah`
--

CREATE TABLE `masalah` (
  `id` int(10) UNSIGNED NOT NULL,
  `idMitra` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idKonsultan` int(10) UNSIGNED DEFAULT NULL,
  `jenis` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `masalah` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `terbaca` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_01_09_082057_create_jenis_usahas_table', 1),
(2, '2014_10_06_171851_create_privileges_table', 1),
(3, '2014_10_12_000000_create_users_table', 1),
(4, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2018_01_06_171730_create_mitras_table', 1),
(6, '2018_01_09_070433_create_produks_table', 1),
(7, '2018_01_09_070703_masalah', 1),
(8, '2018_01_09_070704_create_konsultasis_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mitra`
--

CREATE TABLE `mitra` (
  `id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `namaPemilik` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `namaBadan` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan` int(3) DEFAULT NULL,
  `kabupaten` int(1) DEFAULT NULL,
  `kontak` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `npwp` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `legalitas` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sentra` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modal` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `omset` bigint(20) DEFAULT NULL,
  `asset` bigint(20) DEFAULT NULL,
  `volume` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `karyawan_l` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `karyawan_p` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `total_karyawan` int(11) DEFAULT NULL,
  `pelatihan` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery` tinyint(1) DEFAULT NULL,
  `pustakapreneur` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

CREATE TABLE `privileges` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `privileges`
--

INSERT INTO `privileges` (`id`, `nama`, `level`) VALUES
(1, 'Sistem Administrator', 0),
(2, 'Administrator', 1),
(3, 'Konsultan', 2);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(10) UNSIGNED NOT NULL,
  `mitra` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis` int(10) UNSIGNED DEFAULT NULL,
  `nama` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `track_omset`
--

CREATE TABLE `track_omset` (
  `id` int(11) NOT NULL,
  `mitra` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `omset` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `privilege` int(10) UNSIGNED DEFAULT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `image`, `privilege`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Rizal Ardhi Rahmadani', 'rizal.ardhi.rahmadani@gmail.com', NULL, 2, '$2y$10$bOLbTtmJKS.bHViY/MXL2.Ifc/Unjd.Varvpmdw3RoHPgWs8R0TfW', 'AWyqxhyyj9KHpaVV7oPHLZlGDfPfqpHVmbBZ6TPQrzxoESETIPdwJVAq3V2c', NULL, NULL),
(2, 'andri', 'a@a.a', NULL, NULL, '$2y$10$TqjSq/S1FHq1RkRLITKtv.YZ.ZNEkRFouPacaUMbaXwthot6/s7Eu', '5QFIrgIMEIEOaDKk81ezGG1tfWW8O9XbccijhIPaVxzWAK814oR7VfNAoCVC', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_usaha`
--
ALTER TABLE `jenis_usaha`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kabupaten_foreign` (`id_kabupaten`);

--
-- Indexes for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mitra` (`mitra`);

--
-- Indexes for table `kriteria_umkm`
--
ALTER TABLE `kriteria_umkm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `legalitas`
--
ALTER TABLE `legalitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `masalah`
--
ALTER TABLE `masalah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `masalah_idmitra_foreign` (`idMitra`),
  ADD KEY `masalah_idkonsultan_foreign` (`idKonsultan`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mitra`
--
ALTER TABLE `mitra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mitra_ibfk_1` (`kabupaten`),
  ADD KEY `mitra_kecamatan_foreign` (`kecamatan`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `privileges`
--
ALTER TABLE `privileges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis_usaha_foreign` (`jenis`),
  ADD KEY `produk_mitra_foreign` (`mitra`);

--
-- Indexes for table `track_omset`
--
ALTER TABLE `track_omset`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mitra` (`mitra`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_privilege_foreign` (`privilege`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_usaha`
--
ALTER TABLE `jenis_usaha`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kriteria_umkm`
--
ALTER TABLE `kriteria_umkm`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `legalitas`
--
ALTER TABLE `legalitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `masalah`
--
ALTER TABLE `masalah`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `privileges`
--
ALTER TABLE `privileges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `track_omset`
--
ALTER TABLE `track_omset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD CONSTRAINT `kabupaten_foreign` FOREIGN KEY (`id_kabupaten`) REFERENCES `kabupaten` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD CONSTRAINT `konsultasi_ibfk_1` FOREIGN KEY (`mitra`) REFERENCES `mitra` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `masalah`
--
ALTER TABLE `masalah`
  ADD CONSTRAINT `masalah_idkonsultan_foreign` FOREIGN KEY (`idKonsultan`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `mitra`
--
ALTER TABLE `mitra`
  ADD CONSTRAINT `mitra_ibfk_1` FOREIGN KEY (`kabupaten`) REFERENCES `kabupaten` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `mitra_kecamatan_foreign` FOREIGN KEY (`kecamatan`) REFERENCES `kecamatan` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `jenis_usaha_foreign` FOREIGN KEY (`jenis`) REFERENCES `jenis_usaha` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `produk_mitra_foreign` FOREIGN KEY (`mitra`) REFERENCES `mitra` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `track_omset`
--
ALTER TABLE `track_omset`
  ADD CONSTRAINT `track_omset_ibfk_1` FOREIGN KEY (`mitra`) REFERENCES `mitra` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_privilege_foreign` FOREIGN KEY (`privilege`) REFERENCES `privileges` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
