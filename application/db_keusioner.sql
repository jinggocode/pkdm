-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2018 at 10:57 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_keusioner`
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
  `nik` int(11) DEFAULT NULL,
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
(1, NULL, 1, 654654645, 'Alif AK', '2018-04-03 15:37:35', 1, '2018-04-03 15:45:40', 1);

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
(2, 'operator', 'Operator'),
(3, 'investor', 'Investor');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `id_prodi` int(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `id_prodi`, `nama`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(3, 1, '3A', '2018-03-27 10:52:12', 1, '2018-03-27 10:54:49', 1),
(4, 3, '1A', '2018-04-10 05:18:06', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kuisioner`
--

CREATE TABLE `kuisioner` (
  `id` int(11) NOT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  `id_periode` int(11) DEFAULT NULL,
  `total_nilai` int(11) DEFAULT NULL,
  `rata_rata` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

INSERT INTO `mahasiswa` (`id`, `id_user`, `id_kelas`, `id_angkatan`, `nim`, `nama`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(4, 13, 3, 1, '123', 'Savicri', '2018-04-10 05:17:00', 1, '2018-04-10 05:37:11', 1),
(5, 14, 4, 2, '361555401033', 'Rahmat Ramadhan', '2018-04-10 05:17:35', 1, '2018-04-10 05:37:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `id` int(11) NOT NULL,
  `id_prodi` int(11) DEFAULT NULL,
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

INSERT INTO `matakuliah` (`id`, `id_prodi`, `nama`, `semester`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 'Jaringan', '1', '2018-03-27 10:54:37', 1, '2018-03-27 10:54:56', 1),
(2, 1, 'Pemrograman Web', '1', '2018-03-27 10:55:05', 1, '2018-03-27 10:55:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pengampu_makul`
--

CREATE TABLE `pengampu_makul` (
  `id` int(11) NOT NULL,
  `id_makul` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengampu_makul`
--

INSERT INTO `pengampu_makul` (`id`, `id_makul`, `id_kelas`, `id_dosen`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 4, 1, '2018-04-10 09:10:36', 1, '2018-04-10 09:34:25', 1),
(2, 2, 4, 1, '2018-04-10 09:34:45', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE `periode` (
  `id` int(11) NOT NULL,
  `semester` enum('1','2') DEFAULT NULL COMMENT '0:genap, 1:ganjil',
  `tahun` year(4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`id`, `semester`, `tahun`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, '1', 2018, '2018-03-27 11:31:29', 1, '2018-03-27 11:34:46', 1),
(2, '2', 2020, '2018-03-27 11:34:53', 1, '2018-03-27 11:35:05', 1);

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
(1, 'Teknik Informatika', '2018-03-27 09:55:43', 1, '2018-03-27 10:03:09', 1),
(3, 'Teknik Sipli', '2018-03-27 10:18:42', 1, NULL, NULL);

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

INSERT INTO `users` (`id`, `ip_address`, `group_id`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, '192.168.137.1', 1, 'admin', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', NULL, NULL, NULL, NULL, 0, 1523350451, 1, 'Admin', 'Istrator', 'Admin', NULL, NULL, NULL, '2018-03-26 12:51:47', 1),
(6, '', 3, 'rahmat', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'rahmat@rahmat.com', NULL, NULL, NULL, NULL, 0, 1519979910, 1, 'Rahmat', 'Ramadhan', NULL, NULL, NULL, NULL, NULL, NULL),
(8, '::1', 3, NULL, '$2y$08$a6kV9hh03Tjqczmd3yuuUuX0tleO4afU2w7WlX.z9UhkZbrxp/xC.', '', 'ronaldo@gmail.com', NULL, NULL, NULL, NULL, 1519614536, 1519628347, 1, 'Ronaldo', NULL, NULL, '082146631959', NULL, NULL, NULL, NULL),
(9, '::1', 3, NULL, '$2y$08$sqegjBhnyErZAaLN3zl8B.ar1P40y7S3LbUg8GBeEFJksWJqykD8O', '', 'edi@gmail.com', NULL, NULL, NULL, NULL, 1519723739, 1519725083, 1, 'Edi Siswanto', NULL, NULL, '0822526535', NULL, NULL, NULL, NULL),
(10, '192.168.137.220', 3, NULL, '$2y$08$gMk5Bjj5L9PC5wN51pesY.JhOpZiBvUIEch9/tRBH1byvXHppfMcG', '', 'rukuman25@gmail.com', NULL, NULL, NULL, NULL, 1519878078, 1519878105, 1, 'Eman', NULL, NULL, '085331358840', NULL, NULL, NULL, NULL),
(11, '192.168.137.1', 1, 'dimas', '$2y$10$Wd9y7.MLIVeXrfDQsQn3BexGNihlHH0NgHjm2J3paxo1m8AtPFGkO', '', '', NULL, NULL, NULL, NULL, 0, 1522061700, 1, 'dimas', NULL, NULL, NULL, '2018-03-26 12:41:33', 1, NULL, NULL),
(13, '', 3, '123', '$2y$10$K55A6OkxV32GNSAZfG6M0O5oMuXTMJxpCk0fqEzO4tskVW0BYS5Sy', '', '', NULL, NULL, NULL, NULL, 0, NULL, 1, 'Savicri', NULL, NULL, NULL, '2018-04-10 05:17:00', 1, '2018-04-10 05:37:11', 1),
(14, '', 3, '361555401033', '$2y$10$.9VMsNMVAdpKDFsjZ21zlO.RuiHL.nV12NRClw/NwJrDdA.W2O13G', '', '', NULL, NULL, NULL, NULL, 0, 1523350379, 1, 'Rahmat Ramadhan', NULL, NULL, NULL, '2018-04-10 05:17:35', 1, '2018-04-10 05:37:36', 1);

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
-- Indexes for table `kuisioner`
--
ALTER TABLE `kuisioner`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `matakuliah`
--
ALTER TABLE `matakuliah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pengampu_makul`
--
ALTER TABLE `pengampu_makul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
