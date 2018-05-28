-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 28, 2018 at 04:37 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kuesioner`
--

-- --------------------------------------------------------

--
-- Table structure for table `angkatan`
--

CREATE TABLE `angkatan` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `angkatan`
--

INSERT INTO `angkatan` (`id`, `nama`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, '2017', '2018-03-27 10:29:24', 1, '2018-03-27 10:30:10', 1),
(2, '2016', '2018-03-27 10:30:16', 1, '2018-03-27 10:30:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_prodi` int(11) DEFAULT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `id_user`, `id_prodi`, `nik`, `nama`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(3, 16, 1, '105105', 'ALIF AKBAR', '2018-05-27 21:08:52', 1, NULL, NULL),
(4, 17, 1, '102102', 'ALFIN HIDAYAT', '2018-05-27 21:10:11', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'dosen', 'Dosen'),
(3, 'mahasiswa', 'Mahasiswa');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(3, 'A', '2018-03-27 10:52:12', 1, '2018-03-27 10:54:49', 1),
(4, 'B', '2018-04-10 05:18:06', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kuesioner`
--

CREATE TABLE `kuesioner` (
  `id` int(11) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `jenis` enum('0','1') DEFAULT NULL COMMENT '0:Teori, 1: Praktek',
  `jenis_jawaban` enum('0','1') DEFAULT NULL,
  `isi` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kuesioner`
--

INSERT INTO `kuesioner` (`id`, `id_kategori`, `jenis`, `jenis_jawaban`, `isi`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(3, 4, '1', '1', '1. Pelaksanaan praktikum tepat waktu dan sesuai dengan waktu yang terjadwal', '2018-04-24 03:38:26', 1, NULL, NULL),
(4, 4, '1', '1', '2. Praktikum menambah pemahaman teori dan ketrampilan waktu yang terjadwal', '2018-04-24 03:38:43', 1, NULL, NULL),
(5, 4, '1', '1', '3. Setiap percobaan/praktikum sinergi dengan materi yang diajarkan saat teori', '2018-04-24 03:40:12', 1, NULL, NULL),
(6, 7, '0', '1', '1. Rencana materi dan tujuan mata kuliah diberikan di awal perkuliahan', '2018-04-24 03:42:05', 1, NULL, NULL),
(7, 7, '0', '1', '2. Dosen datang tepat waktu & mengajar sesuai waktu yang terjadwal', '2018-04-24 03:42:24', 1, NULL, NULL),
(8, 7, '0', '1', '3. Diadakan diskusi & tanya jawab', '2018-04-24 03:43:57', 1, '2018-04-24 03:44:02', 1),
(9, 1, '1', '1', '1. Dosen selalu datang setiap praktikum', '2018-04-24 05:01:17', 1, '2018-04-24 05:01:23', 1),
(10, 1, '1', '1', '2. Dosen menjelaskan arah dan tujuan dalam setiap percobaan', '2018-04-24 05:01:38', 1, NULL, NULL),
(11, 6, '1', '0', '1. Petunjuk praktikum (buku diktat/file dosen) tersedia dengan baik', '2018-05-26 08:43:00', 1, '2018-05-26 08:43:07', 1),
(12, 6, '1', '0', '2. Peralatan/modul praktikum tersedia dengan baik', '2018-05-26 08:43:34', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kuesioner_isi`
--

CREATE TABLE `kuesioner_isi` (
  `id` int(11) NOT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  `id_periode` int(11) DEFAULT NULL,
  `id_mahasiswa` int(11) DEFAULT NULL,
  `id_pengampu` int(11) DEFAULT NULL,
  `total_nilai` int(11) DEFAULT NULL,
  `klasifikasi` enum('0','1') DEFAULT NULL,
  `status_selesai` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0: belum selesai, 1: sudah selesai',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kuesioner_isi_detail`
--

CREATE TABLE `kuesioner_isi_detail` (
  `id` int(11) NOT NULL,
  `id_kuesioner_isi` int(11) DEFAULT NULL,
  `id_periode` int(11) DEFAULT NULL,
  `id_pengampu` int(11) DEFAULT NULL,
  `id_kuesioner` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kuesioner_kategori`
--

CREATE TABLE `kuesioner_kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kuesioner_kategori`
--

INSERT INTO `kuesioner_kategori` (`id`, `nama`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'B. KINERJA DOSEN', '0000-00-00 00:00:00', 0, '2018-04-24 03:36:14', 1),
(3, 'C. KINERJA ASISTEN', '2018-04-24 03:24:16', 1, '2018-04-24 03:36:42', 1),
(4, 'A. PELAKSANAAN PRAKTIKUM', '2018-04-24 03:35:55', 1, '0000-00-00 00:00:00', 0),
(5, 'D. EVALUASI DIRI MAHASISWA', '2018-04-24 03:36:55', 1, '2018-04-24 03:37:04', 1),
(6, 'E. KETERSEDIAAN SARANA', '2018-04-24 03:37:24', 1, '0000-00-00 00:00:00', 0),
(7, 'A. PROSES BELAJAR MENGAJAR', '2018-04-24 03:40:30', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_prodi` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `id_angkatan` int(11) DEFAULT NULL,
  `nim` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `id_user`, `id_prodi`, `id_kelas`, `id_angkatan`, `nim`, `nama`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(8, 19, 1, 3, 1, '361555401033', 'Rahmat Ramadhan', '2018-05-27 21:56:50', 1, '2018-05-27 22:54:56', 1);

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `id` int(11) NOT NULL,
  `id_prodi` int(11) DEFAULT NULL,
  `jenis` enum('0','1') DEFAULT NULL COMMENT '0:Teori, 1: Praktek',
  `nama` varchar(50) DEFAULT NULL,
  `semester` enum('1','2','3','4','5','6','7','8') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`id`, `id_prodi`, `jenis`, `nama`, `semester`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, '0', 'JARINGAN KOMPUTER', '2', '2018-03-27 10:54:37', 1, '2018-05-27 21:10:31', 1),
(2, 1, '1', 'PERMROGRAMAN WEB', '2', '2018-03-27 10:55:05', 1, '2018-05-27 21:10:43', 1),
(3, 1, '0', 'KECERDASAN BUATAN', '2', '2018-04-25 06:33:53', 1, '2018-05-27 21:10:56', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pengampu_makul`
--

CREATE TABLE `pengampu_makul` (
  `id` int(11) NOT NULL,
  `id_prodi` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `id_makul` int(11) DEFAULT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE `periode` (
  `id` int(11) NOT NULL,
  `semester` enum('1','2') DEFAULT NULL COMMENT '0:genap, 1:ganjil',
  `tahun` year(4) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`id`, `semester`, `tahun`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, '1', 2018, '1', '2018-03-27 11:31:29', 1, '2018-04-24 22:16:52', 1),
(2, '2', 2018, '0', '2018-03-27 11:34:53', 1, '2018-04-24 21:59:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id`, `nama`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'TEKNIK INFORMATIKA', '2018-03-27 09:55:43', 1, '2018-05-27 21:31:30', 1),
(3, 'TEKNIK SIPIL', '2018-03-27 10:18:42', 1, '2018-05-27 21:31:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `status_password` enum('0','1') NOT NULL DEFAULT '0',
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `group_id`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `status_password`, `first_name`, `last_name`, `company`, `phone`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, '192.168.137.1', 1, 'admin', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', NULL, NULL, NULL, NULL, 0, 1527474157, 1, '1', 'Admin', 'Istrator', 'Admin', NULL, NULL, NULL, '2018-03-26 12:51:47', 1),
(6, '', 3, 'rahmat', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'rahmat@rahmat.com', NULL, NULL, NULL, NULL, 0, 1519979910, 1, '1', 'Rahmat', 'Ramadhan', NULL, NULL, NULL, NULL, NULL, NULL),
(8, '::1', 3, NULL, '$2y$08$a6kV9hh03Tjqczmd3yuuUuX0tleO4afU2w7WlX.z9UhkZbrxp/xC.', '', 'ronaldo@gmail.com', NULL, NULL, NULL, NULL, 1519614536, 1519628347, 1, '1', 'Ronaldo', NULL, NULL, '082146631959', NULL, NULL, NULL, NULL),
(9, '::1', 3, NULL, '$2y$08$sqegjBhnyErZAaLN3zl8B.ar1P40y7S3LbUg8GBeEFJksWJqykD8O', '', 'edi@gmail.com', NULL, NULL, NULL, NULL, 1519723739, 1519725083, 1, '1', 'Edi Siswanto', NULL, NULL, '0822526535', NULL, NULL, NULL, NULL),
(10, '192.168.137.220', 3, NULL, '$2y$08$gMk5Bjj5L9PC5wN51pesY.JhOpZiBvUIEch9/tRBH1byvXHppfMcG', '', 'rukuman25@gmail.com', NULL, NULL, NULL, NULL, 1519878078, 1519878105, 1, '1', 'Eman', NULL, NULL, '085331358840', NULL, NULL, NULL, NULL),
(11, '192.168.137.1', 1, 'dimas', '$2y$10$Wd9y7.MLIVeXrfDQsQn3BexGNihlHH0NgHjm2J3paxo1m8AtPFGkO', '', '', NULL, NULL, NULL, NULL, 0, 1522061700, 1, '1', 'dimas', NULL, NULL, NULL, '2018-03-26 12:41:33', 1, NULL, NULL),
(16, '', 2, '105105', '$2y$10$WNhdVFNSD4K6wg4uyDr8S.rXoLYfzhfQsUk17mDxlFOPpjqKJQAnC', '', '', NULL, NULL, NULL, NULL, 0, 1527472872, 1, '1', 'ALIF AKBAR', NULL, NULL, NULL, '2018-05-27 21:08:52', 1, '2018-05-28 04:01:01', 16),
(17, '', 2, '102102', '$2y$10$xv50UiK/Hflr9AfV3wEtR.71jI23NTF22m5KB6lImUxTEhxhM1WbC', '', '', NULL, NULL, NULL, NULL, 0, 1527471333, 1, '0', 'ALFIN HIDAYAT', NULL, NULL, NULL, '2018-05-27 21:10:11', 1, NULL, NULL),
(19, '', 3, '361555401033', '$2y$10$.FoFJjV26Lk5E73rffMcVeT4WD9gT38TNFOOvjpODFTKn9HskOI72', '', '', NULL, NULL, NULL, NULL, 0, 1527474430, 1, '1', 'Rahmat Ramadhan', NULL, NULL, NULL, '2018-05-27 21:56:50', 1, '2018-05-28 03:57:33', 19);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` mediumint(9) NOT NULL,
  `name` varchar(10) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'dosen', 'Dosen'),
(3, 'mahasiswa', 'Mahasiswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `angkatan`
--
ALTER TABLE `angkatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kuesioner`
--
ALTER TABLE `kuesioner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kuesioner_isi`
--
ALTER TABLE `kuesioner_isi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kuesioner_isi_detail`
--
ALTER TABLE `kuesioner_isi_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK__periode` (`id_periode`),
  ADD KEY `FK__kuesioner` (`id_kuesioner`),
  ADD KEY `FK__kuesioner_isi` (`id_kuesioner_isi`),
  ADD KEY `FK__pengampu_makul` (`id_pengampu`);

--
-- Indexes for table `kuesioner_kategori`
--
ALTER TABLE `kuesioner_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengampu_makul`
--
ALTER TABLE `pengampu_makul`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_users_groups` (`group_id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `angkatan`
--
ALTER TABLE `angkatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kuesioner`
--
ALTER TABLE `kuesioner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kuesioner_isi`
--
ALTER TABLE `kuesioner_isi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `kuesioner_isi_detail`
--
ALTER TABLE `kuesioner_isi_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `kuesioner_kategori`
--
ALTER TABLE `kuesioner_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `matakuliah`
--
ALTER TABLE `matakuliah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengampu_makul`
--
ALTER TABLE `pengampu_makul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `periode`
--
ALTER TABLE `periode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kuesioner_isi_detail`
--
ALTER TABLE `kuesioner_isi_detail`
  ADD CONSTRAINT `FK__pengampu_makul` FOREIGN KEY (`id_pengampu`) REFERENCES `pengampu_makul` (`id`),
  ADD CONSTRAINT `FK__periode` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
