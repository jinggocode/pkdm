-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2018 at 10:07 AM
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

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `jumlah_klasifikasi` (`id_dosen` INT, `id_per` INT, `k` VARCHAR(50)) RETURNS INT(11) BEGIN
DECLARE kls int;
select count(*) INTO kls from kuesioner_isi WHERE id_pengampu = id_dosen and id_periode = id_per and klasifikasi =k;  
return kls;
END$$

DELIMITER ;

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
(2, '2016', '2018-03-27 10:30:16', 1, '2018-03-27 10:30:21', 1),
(3, '2015', '2018-05-28 07:00:56', 1, NULL, NULL);

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
(5, 24, 1, '199010052014041002', 'Alfin Hidayat,S.T.,M.T.', '2018-05-28 07:04:03', 1, NULL, NULL),
(6, 25, 1, '201636185', 'Alif Akbar Fitrawan, S.Pd, M.Kom', '2018-05-28 07:04:36', 1, NULL, NULL),
(7, 26, 1, '201136079', 'Dedy Hidayat Kusuma, S.T, M.Cs', '2018-05-28 07:05:12', 1, NULL, NULL),
(8, 27, 1, '198310202014042001', 'Eka Mistiko Rini, S.Kom, M. Kom', '2018-05-28 07:05:37', 1, NULL, NULL),
(9, 28, 1, '198010222015041001', 'I Wayan Suardinata, S.Kom, M.T', '2018-05-28 07:35:17', 1, NULL, NULL),
(10, 29, 1, '201136080', 'Subono, S.T, M.T', '2018-05-28 07:35:59', 1, NULL, NULL),
(11, 30, 1, '200836005', 'Dianni Yusuf, S.Kom, M. Kom', '2018-05-28 07:36:43', 1, NULL, NULL),
(12, 31, 1, '201136073', 'Herman Yuliandoko, S.T, M.T', '2018-05-28 07:37:29', 1, NULL, NULL),
(13, 40, 1, '2010.36.057', 'Endi Sailul Haq, S.T., M.Kom', '2018-05-29 00:07:23', 1, NULL, NULL),
(14, 41, 1, '201136078', 'Vivien Arief Wardhany, S.T,M.T', '2018-05-29 00:10:01', 1, NULL, NULL),
(15, 42, 1, '201336106', 'Farizqi Panduardi, S.ST., M.T', '2018-05-29 00:12:29', 1, NULL, NULL);

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
(3, 'mahasiswa', 'Mahasiswa'),
(4, 'pimpinan', 'Pimpinan Kampus');

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
(4, 'B', '2018-04-10 05:18:06', 1, NULL, NULL),
(5, 'C', '2018-05-28 08:14:42', 1, NULL, NULL),
(6, 'D', '2018-05-29 00:02:11', 1, NULL, NULL),
(7, 'E', '2018-05-29 00:02:17', 1, NULL, NULL),
(8, 'F', '2018-05-29 00:04:17', 1, NULL, NULL);

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
(3, 3, '1', '1', '1. Pelaksanaan praktikum tepat waktu dan sesuai dengan waktu yang terjadwal', '2018-04-24 03:38:26', 1, '2018-05-29 00:36:03', 1),
(4, 3, '1', '1', '2. Praktikum menambah pemahaman teori dan ketrampilan waktu yang terjadwal', '2018-04-24 03:38:43', 1, '2018-05-29 00:36:32', 1),
(5, 3, '1', '1', '3. Setiap percobaan/praktikum sinergi dengan materi yang diajarkan saat teori', '2018-04-24 03:40:12', 1, '2018-05-29 00:36:44', 1),
(6, 5, '1', '1', '1. Dosen selalu datang setiap praktikum', '2018-04-24 03:42:05', 1, '2018-05-29 00:49:11', 1),
(7, 5, '1', '1', '2. Dosen menjelaskan arah dan tujuan dalam setiap percobaan', '2018-04-24 03:42:24', 1, '2018-05-29 00:49:22', 1),
(8, 5, '1', '1', '3. Penguasaan dan wawasan dosen terhadap modul praktikum', '2018-04-24 03:43:57', 1, '2018-05-29 00:37:38', 1),
(9, 5, '1', '1', '4. Kemampuan menjawab persoalan yang muncul selama percobaan berlangsung', '2018-04-24 05:01:17', 1, '2018-05-29 00:37:48', 1),
(10, 5, '1', '1', '5. Diadakan diskusi & tanya jawab dalam setiap percobaan', '2018-04-24 05:01:38', 1, '2018-05-29 00:38:15', 1),
(11, 5, '1', '1', '6. Semangat dosen selama praktikum', '2018-05-26 08:43:00', 1, '2018-05-29 00:38:06', 1),
(12, 5, '1', '1', '7. Hasil laporan percobaan dikoreksi/dievaluasi', '2018-05-26 08:43:34', 1, '2018-05-29 00:37:57', 1),
(13, 6, '1', '1', '1. Penguasaan dan wawasan asisten terhadap modul praktikum', '2018-05-28 10:12:26', 1, '2018-05-29 00:38:37', 1),
(14, 6, '1', '1', '2. Kemampuan menjawab persoalan yang muncul selama percobaan berlangsung', '2018-05-28 10:17:48', 1, '2018-05-29 00:39:41', 1),
(15, 6, '1', '1', '3. Semangat dalam membantu pelaksanaan praktikum (jika dosen HADIR)', '2018-05-28 10:18:08', 1, '2018-05-29 00:39:22', 1),
(16, 6, '1', '1', '4. Semangat dalam membantu pelaksanaan praktikum (jika dosen TIDAK HADIR)', '2018-05-28 10:18:26', 1, '2018-05-29 00:39:10', 1),
(17, 6, '1', '1', '5. Asisten selalu mendampingi pada saat praktikum berlangsung', '2018-05-28 10:18:44', 1, '2018-05-29 00:38:51', 1),
(18, 7, '1', '1', '1. Tingkat pemahaman anda secara umum terhadap mata kuliah praktikum ini', '2018-05-28 10:19:11', 1, '2018-05-29 00:40:36', 1),
(19, 7, '1', '1', '2. Rerata keaktifan dan attitude anda selama praktikum', '2018-05-28 10:19:28', 1, '2018-05-29 00:40:24', 1),
(20, 7, '1', '1', '3.Ketrampilan anda saat praktikum secara umum', '2018-05-28 10:19:50', 1, '2018-05-29 00:40:11', 1),
(21, 8, '1', '0', '1. Petunjuk praktikum (buku diktat/file dosen) tersedia dengan baik', '2018-05-28 10:20:22', 1, '2018-05-29 00:40:57', 1),
(22, 8, '1', '0', '2. Peralatan/modul praktikum tersedia dengan baik', '2018-05-28 10:20:40', 1, '2018-05-29 00:41:11', 1),
(24, 1, '0', '1', '1.Rencana materi dan tujuan mata kuliah diberikan di awal perkuliahan', '2018-05-28 10:37:31', 1, '2018-05-29 00:41:49', 1),
(25, 1, '0', '1', '2. Dosen datang tepat waktu & mengajar sesuai waktu yang terjadwal', '2018-05-28 10:37:49', 1, '2018-05-29 00:41:59', 1),
(26, 1, '0', '1', '3.Diadakan diskusi & tanya jawab', '2018-05-28 10:38:09', 1, '2018-05-29 00:42:20', 1),
(27, 1, '0', '1', '4.Manfaat soal latihan dalam menambah pemahaman mata kuliah ini', '2018-05-28 10:38:24', 1, '2018-05-29 00:43:24', 1),
(28, 1, '0', '1', '5.Kesesuaian evaluasi (tugas dan UTS) dengan materi yang diajarkan', '2018-05-28 10:38:40', 1, '2018-05-29 00:43:50', 1),
(29, 1, '0', '1', '6.Pembahasan soal-soal, tugas dan UTS yang diberikan', '2018-05-28 10:39:05', 1, '2018-05-29 00:43:38', 1),
(30, 1, '0', '1', '7.Sistematika menjelaskan kuliah', '2018-05-28 10:39:25', 1, '2018-05-29 00:43:09', 1),
(31, 1, '0', '1', '8.Latihan soal terhadap setiap materi yang diberikan', '2018-05-28 10:39:47', 1, '2018-05-29 00:42:57', 1),
(32, 1, '0', '1', '9.Kesesuaian materi yang diberikan terhadap rencana di awal perkuliahan', '2018-05-28 10:40:05', 1, '2018-05-29 00:42:09', 1),
(33, 4, '0', '1', '10.Kemampuan dosen dalam menjelaskan materi perkuliahan', '2018-05-28 10:48:04', 1, '2018-05-29 00:44:16', 1),
(34, 4, '0', '1', '11.Penguasaan materi, wawasan, dan implementasi mata kuliah ini', '2018-05-28 10:48:22', 1, '2018-05-29 00:44:30', 1),
(35, 4, '0', '1', '12.Kemampuan dosen menjawab pertanyaan', '2018-05-28 10:48:41', 1, '2018-05-29 00:44:45', 1),
(36, 4, '0', '1', '13. Semangat dosen dalam memberikan kuliah', '2018-05-28 10:48:59', 1, '2018-05-29 00:45:14', 1),
(37, 4, '0', '1', '14. Kemampuan dosen dalam memberikan motivasi/membangkitkan minat belajar', '2018-05-28 10:49:17', 1, '2018-05-29 00:45:29', 1),
(38, 8, '0', '0', '1. Bahan ajar (diktat/handout/file ppt) tersedia dengan baik', '2018-05-28 10:49:43', 1, '2018-05-29 00:45:48', 1),
(39, 8, '0', '0', '2. Buku referensi (textbook) tersedia dengan baik', '2018-05-28 10:50:08', 1, '2018-05-29 00:45:59', 1);

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
  `klasifikasi` enum('0','1','2','3') DEFAULT NULL,
  `status_selesai` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0: belum selesai, 1: sudah selesai',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kuesioner_isi`
--

INSERT INTO `kuesioner_isi` (`id`, `id_dosen`, `id_periode`, `id_mahasiswa`, `id_pengampu`, `total_nilai`, `klasifikasi`, `status_selesai`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(20, 9, 1, 12, 10, 54, '3', '1', '2018-05-30 23:28:10', 23, '2018-05-30 23:28:44', 23),
(21, 9, 1, 12, 11, 68, '3', '1', '2018-05-30 23:28:38', 23, '2018-05-30 23:28:44', 23),
(22, 11, 1, 30, 16, 53, '3', '1', '2018-05-30 23:29:14', 53, '2018-05-30 23:30:10', 53),
(23, 11, 1, 30, 17, 69, '3', '1', '2018-05-30 23:29:40', 53, '2018-05-30 23:30:10', 53),
(24, 9, 1, 30, 26, 41, '2', '1', '2018-05-30 23:30:05', 53, '2018-05-30 23:30:10', 53);

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

--
-- Dumping data for table `kuesioner_isi_detail`
--

INSERT INTO `kuesioner_isi_detail` (`id`, `id_kuesioner_isi`, `id_periode`, `id_pengampu`, `id_kuesioner`, `nilai`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(341, 20, 1, 10, 24, 4, '2018-05-30 23:28:10', 23, NULL, NULL),
(342, 20, 1, 10, 25, 4, '2018-05-30 23:28:10', 23, NULL, NULL),
(343, 20, 1, 10, 26, 4, '2018-05-30 23:28:10', 23, NULL, NULL),
(344, 20, 1, 10, 27, 3, '2018-05-30 23:28:11', 23, NULL, NULL),
(345, 20, 1, 10, 28, 4, '2018-05-30 23:28:11', 23, NULL, NULL),
(346, 20, 1, 10, 29, 4, '2018-05-30 23:28:11', 23, NULL, NULL),
(347, 20, 1, 10, 30, 4, '2018-05-30 23:28:11', 23, NULL, NULL),
(348, 20, 1, 10, 31, 4, '2018-05-30 23:28:11', 23, NULL, NULL),
(349, 20, 1, 10, 32, 4, '2018-05-30 23:28:11', 23, NULL, NULL),
(350, 20, 1, 10, 33, 3, '2018-05-30 23:28:11', 23, NULL, NULL),
(351, 20, 1, 10, 34, 3, '2018-05-30 23:28:11', 23, NULL, NULL),
(352, 20, 1, 10, 35, 3, '2018-05-30 23:28:11', 23, NULL, NULL),
(353, 20, 1, 10, 36, 3, '2018-05-30 23:28:11', 23, NULL, NULL),
(354, 20, 1, 10, 37, 3, '2018-05-30 23:28:11', 23, NULL, NULL),
(355, 20, 1, 10, 38, 2, '2018-05-30 23:28:11', 23, NULL, NULL),
(356, 20, 1, 10, 39, 2, '2018-05-30 23:28:11', 23, NULL, NULL),
(357, 21, 1, 11, 3, 2, '2018-05-30 23:28:38', 23, NULL, NULL),
(358, 21, 1, 11, 4, 3, '2018-05-30 23:28:38', 23, NULL, NULL),
(359, 21, 1, 11, 5, 4, '2018-05-30 23:28:38', 23, NULL, NULL),
(360, 21, 1, 11, 6, 4, '2018-05-30 23:28:38', 23, NULL, NULL),
(361, 21, 1, 11, 7, 4, '2018-05-30 23:28:39', 23, NULL, NULL),
(362, 21, 1, 11, 8, 4, '2018-05-30 23:28:39', 23, NULL, NULL),
(363, 21, 1, 11, 9, 4, '2018-05-30 23:28:39', 23, NULL, NULL),
(364, 21, 1, 11, 10, 4, '2018-05-30 23:28:39', 23, NULL, NULL),
(365, 21, 1, 11, 11, 3, '2018-05-30 23:28:39', 23, NULL, NULL),
(366, 21, 1, 11, 12, 3, '2018-05-30 23:28:39', 23, NULL, NULL),
(367, 21, 1, 11, 13, 4, '2018-05-30 23:28:39', 23, NULL, NULL),
(368, 21, 1, 11, 14, 4, '2018-05-30 23:28:39', 23, NULL, NULL),
(369, 21, 1, 11, 15, 4, '2018-05-30 23:28:39', 23, NULL, NULL),
(370, 21, 1, 11, 16, 3, '2018-05-30 23:28:39', 23, NULL, NULL),
(371, 21, 1, 11, 17, 4, '2018-05-30 23:28:39', 23, NULL, NULL),
(372, 21, 1, 11, 18, 3, '2018-05-30 23:28:39', 23, NULL, NULL),
(373, 21, 1, 11, 19, 3, '2018-05-30 23:28:39', 23, NULL, NULL),
(374, 21, 1, 11, 20, 4, '2018-05-30 23:28:39', 23, NULL, NULL),
(375, 21, 1, 11, 21, 2, '2018-05-30 23:28:39', 23, NULL, NULL),
(376, 21, 1, 11, 22, 2, '2018-05-30 23:28:39', 23, NULL, NULL),
(377, 22, 1, 16, 24, 4, '2018-05-30 23:29:14', 53, NULL, NULL),
(378, 22, 1, 16, 25, 4, '2018-05-30 23:29:14', 53, NULL, NULL),
(379, 22, 1, 16, 26, 4, '2018-05-30 23:29:14', 53, NULL, NULL),
(380, 22, 1, 16, 27, 3, '2018-05-30 23:29:14', 53, NULL, NULL),
(381, 22, 1, 16, 28, 4, '2018-05-30 23:29:14', 53, NULL, NULL),
(382, 22, 1, 16, 29, 3, '2018-05-30 23:29:14', 53, NULL, NULL),
(383, 22, 1, 16, 30, 4, '2018-05-30 23:29:14', 53, NULL, NULL),
(384, 22, 1, 16, 31, 3, '2018-05-30 23:29:15', 53, NULL, NULL),
(385, 22, 1, 16, 32, 4, '2018-05-30 23:29:15', 53, NULL, NULL),
(386, 22, 1, 16, 33, 3, '2018-05-30 23:29:15', 53, NULL, NULL),
(387, 22, 1, 16, 34, 4, '2018-05-30 23:29:15', 53, NULL, NULL),
(388, 22, 1, 16, 35, 3, '2018-05-30 23:29:15', 53, NULL, NULL),
(389, 22, 1, 16, 36, 3, '2018-05-30 23:29:15', 53, NULL, NULL),
(390, 22, 1, 16, 37, 3, '2018-05-30 23:29:15', 53, NULL, NULL),
(391, 22, 1, 16, 38, 2, '2018-05-30 23:29:15', 53, NULL, NULL),
(392, 22, 1, 16, 39, 2, '2018-05-30 23:29:15', 53, NULL, NULL),
(393, 23, 1, 17, 3, 4, '2018-05-30 23:29:40', 53, NULL, NULL),
(394, 23, 1, 17, 4, 4, '2018-05-30 23:29:40', 53, NULL, NULL),
(395, 23, 1, 17, 5, 3, '2018-05-30 23:29:41', 53, NULL, NULL),
(396, 23, 1, 17, 6, 4, '2018-05-30 23:29:41', 53, NULL, NULL),
(397, 23, 1, 17, 7, 4, '2018-05-30 23:29:41', 53, NULL, NULL),
(398, 23, 1, 17, 8, 3, '2018-05-30 23:29:41', 53, NULL, NULL),
(399, 23, 1, 17, 9, 4, '2018-05-30 23:29:41', 53, NULL, NULL),
(400, 23, 1, 17, 10, 3, '2018-05-30 23:29:41', 53, NULL, NULL),
(401, 23, 1, 17, 11, 4, '2018-05-30 23:29:41', 53, NULL, NULL),
(402, 23, 1, 17, 12, 4, '2018-05-30 23:29:41', 53, NULL, NULL),
(403, 23, 1, 17, 13, 4, '2018-05-30 23:29:41', 53, NULL, NULL),
(404, 23, 1, 17, 14, 4, '2018-05-30 23:29:41', 53, NULL, NULL),
(405, 23, 1, 17, 15, 3, '2018-05-30 23:29:41', 53, NULL, NULL),
(406, 23, 1, 17, 16, 4, '2018-05-30 23:29:41', 53, NULL, NULL),
(407, 23, 1, 17, 17, 3, '2018-05-30 23:29:41', 53, NULL, NULL),
(408, 23, 1, 17, 18, 4, '2018-05-30 23:29:41', 53, NULL, NULL),
(409, 23, 1, 17, 19, 3, '2018-05-30 23:29:41', 53, NULL, NULL),
(410, 23, 1, 17, 20, 3, '2018-05-30 23:29:41', 53, NULL, NULL),
(411, 23, 1, 17, 21, 2, '2018-05-30 23:29:41', 53, NULL, NULL),
(412, 23, 1, 17, 22, 2, '2018-05-30 23:29:41', 53, NULL, NULL),
(413, 24, 1, 26, 24, 4, '2018-05-30 23:30:05', 53, NULL, NULL),
(414, 24, 1, 26, 25, 1, '2018-05-30 23:30:06', 53, NULL, NULL),
(415, 24, 1, 26, 26, 3, '2018-05-30 23:30:06', 53, NULL, NULL),
(416, 24, 1, 26, 27, 2, '2018-05-30 23:30:06', 53, NULL, NULL),
(417, 24, 1, 26, 28, 2, '2018-05-30 23:30:06', 53, NULL, NULL),
(418, 24, 1, 26, 29, 2, '2018-05-30 23:30:06', 53, NULL, NULL),
(419, 24, 1, 26, 30, 3, '2018-05-30 23:30:06', 53, NULL, NULL),
(420, 24, 1, 26, 31, 3, '2018-05-30 23:30:06', 53, NULL, NULL),
(421, 24, 1, 26, 32, 3, '2018-05-30 23:30:06', 53, NULL, NULL),
(422, 24, 1, 26, 33, 3, '2018-05-30 23:30:06', 53, NULL, NULL),
(423, 24, 1, 26, 34, 3, '2018-05-30 23:30:06', 53, NULL, NULL),
(424, 24, 1, 26, 35, 4, '2018-05-30 23:30:06', 53, NULL, NULL),
(425, 24, 1, 26, 36, 3, '2018-05-30 23:30:06', 53, NULL, NULL),
(426, 24, 1, 26, 37, 3, '2018-05-30 23:30:06', 53, NULL, NULL),
(427, 24, 1, 26, 38, 1, '2018-05-30 23:30:06', 53, NULL, NULL),
(428, 24, 1, 26, 39, 1, '2018-05-30 23:30:06', 53, NULL, NULL);

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
(1, 'A. PROSES BELAJAR MENGAJAR', '0000-00-00 00:00:00', 0, '2018-05-29 00:30:05', 1),
(3, 'A. PELAKSANAAN PRAKTIKUM', '2018-04-24 03:24:16', 1, '2018-05-29 00:30:20', 1),
(4, 'B.KAPABILITAS (KOPETENSI DOSEN)', '2018-04-24 03:35:55', 1, '2018-05-29 00:32:17', 1),
(5, 'B. KINERJA DOSEN', '2018-04-24 03:36:55', 1, '2018-05-29 00:32:30', 1),
(6, 'C. KINERJA ASISTEN', '2018-04-24 03:37:24', 1, '2018-05-29 00:32:57', 1),
(7, 'D. EVALUASI DIRI MAHASISWA', '2018-04-24 03:40:30', 1, '2018-05-29 00:33:11', 1),
(8, 'E. KETERSEDIAAN SARANA', '2018-05-28 10:47:18', 1, '2018-05-29 00:33:37', 1);

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
(9, 20, 1, 3, 1, '361555401013', 'Savicri Vidirila', '2018-05-28 07:01:12', 1, '2018-05-30 15:07:19', 1),
(10, 21, 1, 3, 1, '361555401015', 'Teguh Faizin', '2018-05-28 07:01:50', 1, '2018-05-30 15:07:25', 1),
(11, 22, 1, 3, 1, '361555401012', 'Defrimont Era', '2018-05-28 07:02:32', 1, '2018-05-30 15:07:35', 1),
(12, 23, 1, 3, 1, '361555401033', 'Rahmat Ramadhan Putra', '2018-05-28 07:03:14', 1, '2018-05-28 23:10:51', 1),
(26, 49, 1, 3, 1, '361755401011', 'DEDY JONI KURNIAWAN', '2018-05-30 15:22:34', 1, NULL, NULL),
(27, 50, 1, 3, 1, '361755401012', 'ARYO WHISNU W', '2018-05-30 15:23:01', 1, NULL, NULL),
(28, 51, 1, 3, 1, '361755401016', 'MIRTA JHOSWANDA', '2018-05-30 15:44:43', 1, NULL, NULL),
(29, 52, 1, 3, 1, '361755401017', 'DINGA SANGATA', '2018-05-30 15:45:20', 1, NULL, NULL),
(30, 53, 1, 4, 1, '123', 'Beni', '2018-05-30 23:12:25', 1, NULL, NULL);

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
(4, 1, '0', 'Algoritma & Struktur Data', '2', '2018-05-28 07:09:08', 1, '2018-05-28 07:13:59', 1),
(5, 1, '1', 'Algoritma & Struktur Data', '2', '2018-05-28 07:09:30', 1, '2018-05-28 07:29:53', 1),
(6, 1, '0', 'Teknik Digital', '2', '2018-05-28 07:09:56', 1, '2018-05-28 07:30:02', 1),
(7, 1, '1', 'Teknik Digital', '2', '2018-05-28 07:10:37', 1, '2018-05-28 07:30:10', 1),
(8, 1, '0', 'Jaringan Nirkabel', '4', '2018-05-28 07:11:43', 1, '2018-05-28 07:30:38', 1),
(9, 1, '1', 'Jaringan Nirkabel', '4', '2018-05-28 07:11:58', 1, '2018-05-28 07:30:45', 1),
(10, 1, '0', 'Kecerdasan Buatan', '4', '2018-05-28 07:12:25', 1, '2018-05-28 07:31:31', 1),
(11, 1, '1', 'Kecerdasan Buatan', '4', '2018-05-28 07:12:38', 1, '2018-05-28 07:31:58', 1),
(12, 1, '0', 'Penggunaan Basis Data', '2', '2018-05-28 10:53:24', 1, '2018-05-28 10:53:49', 1),
(13, 1, '1', 'Penggunaan Basis Data', '2', '2018-05-28 10:53:37', 1, '2018-05-28 10:53:55', 1),
(14, 1, '0', 'Metode Numerik', '2', '2018-05-29 00:06:13', 1, '2018-05-29 00:08:25', 1),
(15, 1, '1', 'Metode Numerik', '2', '2018-05-29 00:06:22', 1, '2018-05-29 00:08:33', 1),
(16, 1, '0', 'Dasar Jaringan Komputer', '2', '2018-05-29 00:08:05', 1, '2018-05-29 00:08:41', 1),
(17, 1, '1', 'Dasar Jaringan Komputer', '2', '2018-05-29 00:08:15', 1, '2018-05-29 00:08:48', 1);

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

--
-- Dumping data for table `pengampu_makul`
--

INSERT INTO `pengampu_makul` (`id`, `id_prodi`, `id_kelas`, `id_makul`, `id_dosen`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(10, 1, 3, 4, 9, '2018-05-28 07:38:39', 1, NULL, NULL),
(11, 1, 3, 5, 9, '2018-05-28 07:39:02', 1, NULL, NULL),
(12, 1, 3, 10, 7, '2018-05-28 07:39:25', 1, NULL, NULL),
(13, 1, 3, 11, 7, '2018-05-28 07:39:41', 1, NULL, NULL),
(14, 1, 3, 8, 12, '2018-05-28 07:40:32', 1, NULL, NULL),
(15, 1, 3, 9, 12, '2018-05-28 10:52:24', 1, NULL, NULL),
(16, 1, 4, 4, 11, '2018-05-29 00:11:07', 1, NULL, NULL),
(17, 1, 4, 5, 11, '2018-05-29 00:11:31', 1, NULL, NULL),
(18, 1, 5, 12, 15, '2018-05-29 00:13:05', 1, NULL, NULL),
(19, 1, 5, 13, 15, '2018-05-29 00:13:46', 1, NULL, NULL),
(20, 1, 6, 14, 13, '2018-05-29 00:14:17', 1, NULL, NULL),
(21, 1, 6, 15, 13, '2018-05-29 00:14:39', 1, NULL, NULL),
(22, 1, 7, 16, 14, '2018-05-29 00:15:03', 1, NULL, NULL),
(23, 1, 7, 17, 14, '2018-05-29 00:15:18', 1, NULL, NULL),
(24, 1, 8, 6, 5, '2018-05-29 00:15:44', 1, NULL, NULL),
(25, 1, 7, 7, 5, '2018-05-29 00:16:03', 1, NULL, NULL),
(26, 1, 4, 4, 9, '2018-05-30 23:13:23', 1, NULL, NULL);

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
(1, '1', 2018, '1', '2018-03-27 11:31:29', 1, '2018-05-28 08:48:56', 1),
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
(3, 'TEKNIK SIPIL', '2018-03-27 10:18:42', 1, '2018-05-27 21:31:37', 1),
(4, 'TEKNIK MESIN', '2018-05-28 07:05:55', 1, NULL, NULL);

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
(1, '192.168.137.1', 1, 'admin', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', NULL, NULL, NULL, NULL, 0, 1529743314, 1, '1', 'Admin', 'Istrator', 'Admin', NULL, NULL, NULL, '2018-03-26 12:51:47', 1),
(8, '::1', 3, NULL, '$2y$08$a6kV9hh03Tjqczmd3yuuUuX0tleO4afU2w7WlX.z9UhkZbrxp/xC.', '', 'ronaldo@gmail.com', NULL, NULL, NULL, NULL, 1519614536, 1519628347, 1, '1', 'Ronaldo', NULL, NULL, '082146631959', NULL, NULL, NULL, NULL),
(9, '::1', 3, NULL, '$2y$08$sqegjBhnyErZAaLN3zl8B.ar1P40y7S3LbUg8GBeEFJksWJqykD8O', '', 'edi@gmail.com', NULL, NULL, NULL, NULL, 1519723739, 1519725083, 1, '1', 'Edi Siswanto', NULL, NULL, '0822526535', NULL, NULL, NULL, NULL),
(10, '192.168.137.220', 3, NULL, '$2y$08$gMk5Bjj5L9PC5wN51pesY.JhOpZiBvUIEch9/tRBH1byvXHppfMcG', '', 'rukuman25@gmail.com', NULL, NULL, NULL, NULL, 1519878078, 1519878105, 1, '1', 'Eman', NULL, NULL, '085331358840', NULL, NULL, NULL, NULL),
(11, '192.168.137.1', 1, 'dimas', '$2y$10$Wd9y7.MLIVeXrfDQsQn3BexGNihlHH0NgHjm2J3paxo1m8AtPFGkO', '', '', NULL, NULL, NULL, NULL, 0, 1522061700, 1, '1', 'dimas', NULL, NULL, NULL, '2018-03-26 12:41:33', 1, NULL, NULL),
(16, '', 2, '105105', '$2y$10$WNhdVFNSD4K6wg4uyDr8S.rXoLYfzhfQsUk17mDxlFOPpjqKJQAnC', '', '', NULL, NULL, NULL, NULL, 0, 1527472872, 1, '1', 'ALIF AKBAR', NULL, NULL, NULL, '2018-05-27 21:08:52', 1, '2018-05-28 04:01:01', 16),
(17, '', 2, '102102', '$2y$10$xv50UiK/Hflr9AfV3wEtR.71jI23NTF22m5KB6lImUxTEhxhM1WbC', '', '', NULL, NULL, NULL, NULL, 0, 1527471333, 1, '0', 'ALFIN HIDAYAT', NULL, NULL, NULL, '2018-05-27 21:10:11', 1, NULL, NULL),
(20, '', 3, '361555401013', '$2y$10$aEoRRXAOgGxuZFMecIaqKerQR1iZwaKPLGmi49nZRPCNIbSC/x7YC', '', '', NULL, NULL, NULL, NULL, 0, NULL, 1, '0', 'Savicri Vidirila', NULL, NULL, NULL, '2018-05-28 07:01:12', 1, '2018-05-30 15:07:18', 1),
(21, '', 3, '361555401015', '$2y$10$ldd8FYS7JSSI/NDc13iyEerHCJ.OQop51GlCpKaim8IFwTilO5hKK', '', '', NULL, NULL, NULL, NULL, 0, 1527541720, 1, '0', 'Teguh Faizin', NULL, NULL, NULL, '2018-05-28 07:01:49', 1, '2018-05-30 15:07:24', 1),
(22, '', 3, '361555401012', '$2y$10$ianYAosO1hZY5Lf6JCy73OrdIodv5/2uI2ZqDAqHuWE1Epk/gbjBK', '', '', NULL, NULL, NULL, NULL, 0, NULL, 1, '0', 'Defrimont Era', NULL, NULL, NULL, '2018-05-28 07:02:32', 1, '2018-05-30 15:07:35', 1),
(23, '', 3, '361555401033', '$2y$10$Hh7qqDoJqkH8TZvmwkIf1.//DPEyoYxIeBTtHvRE6i6DdOKN6N7yy', '', '', NULL, NULL, NULL, NULL, 0, 1527715669, 1, '1', 'Rahmat Ramadhan Putra', NULL, NULL, NULL, '2018-05-28 07:03:14', 1, '2018-05-29 08:40:50', 23),
(24, '', 2, '199010052014041002', '$2y$10$XF5bHjxRyZwQNgrKQjGPmOCDOpADFuaff1GME/q6Ki/Y1wE1oIkWm', '', '', NULL, NULL, NULL, NULL, 0, 1527556046, 1, '0', 'Alfin Hidayat,S.T.,M.T.', NULL, NULL, NULL, '2018-05-28 07:04:03', 1, NULL, NULL),
(25, '', 2, '201636185', '$2y$10$x.9Imd3t3Cc5fw8rXmk/eeiRFQl3g5cLoJLBY4Jk9Ud9Q9/cSVC.6', '', '', NULL, NULL, NULL, NULL, 0, NULL, 1, '0', 'Alif Akbar Fitrawan, S.Pd, M.Kom', NULL, NULL, NULL, '2018-05-28 07:04:35', 1, NULL, NULL),
(26, '', 2, '201136079', '$2y$10$vze2rdff3srpdlAZNL99V.scAJVFnGBPK.ar9mKDc6OEaWybl5VIG', '', '', NULL, NULL, NULL, NULL, 0, NULL, 1, '0', 'Dedy Hidayat Kusuma, S.T, M.Cs', NULL, NULL, NULL, '2018-05-28 07:05:11', 1, NULL, NULL),
(27, '', 2, '198310202014042001', '$2y$10$QjOkxY8zcKvJQ09YBFzrzO1VfmHa7mKeSRqEzfmJL1zCWW/dWGXke', '', '', NULL, NULL, NULL, NULL, 0, NULL, 1, '0', 'Eka Mistiko Rini, S.Kom, M. Kom', NULL, NULL, NULL, '2018-05-28 07:05:37', 1, NULL, NULL),
(28, '', 2, '198010222015041001', '$2y$10$05ELO7z9SvB6HULzjPjR7uvZ8Yb0FfcGBqwJuWtW08Gp2iq1mD0Ry', '', '', NULL, NULL, NULL, NULL, 0, 1529743560, 1, '0', 'I Wayan Suardinata, S.Kom, M.T', NULL, NULL, NULL, '2018-05-28 07:35:17', 1, NULL, NULL),
(29, '', 2, '201136080', '$2y$10$mJW3RefDK16zqJuUoZE/PuEkjc08kYei6FfEL5JRq9kcbSNQrTmMi', '', '', NULL, NULL, NULL, NULL, 0, NULL, 1, '0', 'Subono, S.T, M.T', NULL, NULL, NULL, '2018-05-28 07:35:59', 1, NULL, NULL),
(30, '', 2, '200836005', '$2y$10$x0ZMgK7KqphxzxvRJ/ZSA.zHVn1iKlJHyXWBMDGIPVAqAXbbhouVm', '', '', NULL, NULL, NULL, NULL, 0, 1527556239, 1, '0', 'Dianni Yusuf, S.Kom, M. Kom', NULL, NULL, NULL, '2018-05-28 07:36:43', 1, NULL, NULL),
(31, '', 2, '201136073', '$2y$10$yjogf.l/xLct7k82WuaDzeIDyLbtBv8ruYVoZ98.jtAYEYcOM4zv6', '', '', NULL, NULL, NULL, NULL, 0, NULL, 1, '0', 'Herman Yuliandoko, S.T, M.T', NULL, NULL, NULL, '2018-05-28 07:37:29', 1, NULL, NULL),
(40, '', 2, '2010.36.057', '$2y$10$ydmuSUJKNJVYNagvM1guz.atszekb/RYO4AZVfk/iIbkm3LNIy/LK', '', '', NULL, NULL, NULL, NULL, 0, NULL, 1, '0', 'Endi Sailul Haq, S.T., M.Kom', NULL, NULL, NULL, '2018-05-29 00:07:23', 1, NULL, NULL),
(41, '', 2, '201136078', '$2y$10$lcs1/nPThFyHxZ/2Z9.zpukDwGGgSYqNhJPEp68nWBwnJ97SkYXc6', '', '', NULL, NULL, NULL, NULL, 0, NULL, 1, '0', 'Vivien Arief Wardhany, S.T,M.T', NULL, NULL, NULL, '2018-05-29 00:10:01', 1, NULL, NULL),
(42, '', 2, '201336106', '$2y$10$xLgMRHXCBg28zlBdd5SeteNfwONGqsQiBv8rF9p/L.2X.XS14BSxm', '', '', NULL, NULL, NULL, NULL, 0, NULL, 1, '0', 'Farizqi Panduardi, S.ST., M.T', NULL, NULL, NULL, '2018-05-29 00:12:29', 1, NULL, NULL),
(47, '', 2, '361755401008', '$2y$10$22aztk4vZ2114xySnseQMeZlUyAgqJm11rIR7eexnlcYM3ao/ZgDi', '', '', NULL, NULL, NULL, NULL, 0, NULL, 1, '0', 'FIKRI HAZMI ROZAQI', NULL, NULL, NULL, '2018-05-30 07:19:14', 1, NULL, NULL),
(49, '', 3, '361755401011', '$2y$10$HRMjGRmrGomOAyZbnUBSveQ3kHCXPZWijA1r9.81X0RecfGw7dxyO', '', '', NULL, NULL, NULL, NULL, 0, 1527690536, 1, '0', 'DEDY JONI KURNIAWAN', NULL, NULL, NULL, '2018-05-30 15:22:34', 1, NULL, NULL),
(50, '', 3, '361755401012', '$2y$10$cNe08ZfWvzazGhW.PfCrOupkSboydHgdMc7IM7axjCT5InxHfiOeC', '', '', NULL, NULL, NULL, NULL, 0, 1527690570, 1, '0', 'ARYO WHISNU W', NULL, NULL, NULL, '2018-05-30 15:23:01', 1, NULL, NULL),
(51, '', 3, '361755401016', '$2y$10$9B1wEJsqHT4yiY6kVA4K2OYDYHMILAW5E26ea1LpPOwbU1CyXDMya', '', '', NULL, NULL, NULL, NULL, 0, 1527690618, 1, '0', 'MIRTA JHOSWANDA', NULL, NULL, NULL, '2018-05-30 15:44:43', 1, NULL, NULL),
(52, '', 3, '361755401017', '$2y$10$N/TF9TPB4mxMRp/zeXkmqOZRzQG4bUilbewXHzuPNpFnHf8DWs9O2', '', '', NULL, NULL, NULL, NULL, 0, 1527690647, 1, '0', 'DINGA SANGATA', NULL, NULL, NULL, '2018-05-30 15:45:20', 1, NULL, NULL),
(53, '', 3, '123', '$2y$10$FwwaImNDm9kLbY/P/Eu0cOJchBZ/cCYQJHp9sgrN6gfkhiBHtF0Ou', '', '', NULL, NULL, NULL, NULL, 0, 1527715735, 1, '0', 'Beni', NULL, NULL, NULL, '2018-05-30 23:12:25', 1, NULL, NULL),
(54, '::1', 4, '123123', '$2y$10$u5NcSkHyGrjWjKmJ8wtxKONXVQ4siu7/L0yd0CHUG0u1PluCfiozm', '', '', NULL, NULL, NULL, NULL, 0, 1529743288, 1, '0', 'Pak Dir', NULL, NULL, NULL, '2018-06-07 10:26:11', 1, '2018-06-07 10:43:12', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kuesioner`
--
ALTER TABLE `kuesioner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `kuesioner_isi`
--
ALTER TABLE `kuesioner_isi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `kuesioner_isi_detail`
--
ALTER TABLE `kuesioner_isi_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=429;

--
-- AUTO_INCREMENT for table `kuesioner_kategori`
--
ALTER TABLE `kuesioner_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `matakuliah`
--
ALTER TABLE `matakuliah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pengampu_makul`
--
ALTER TABLE `pengampu_makul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `periode`
--
ALTER TABLE `periode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

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
