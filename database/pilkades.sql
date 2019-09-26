-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 26, 2019 at 10:00 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pilkades_old`
--

-- --------------------------------------------------------

--
-- Table structure for table `berkas`
--

CREATE TABLE `berkas` (
  `id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `filename` varchar(128) NOT NULL,
  `aktif` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `berkas`
--

INSERT INTO `berkas` (`id`, `title`, `filename`, `aktif`) VALUES
(1, 'SK Pelaksanaan PILKADES', 'sk-pelaksanaan-pilkades.pdf', 1),
(2, 'Perbup PILKADES 2019', 'perbub-41-th-2019-tentang-pelaksanaan-pemilihan-kades-serentak-dan-antar-waktu.pdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `app_status` tinyint(4) NOT NULL DEFAULT '1',
  `desa_kode` varchar(14) NOT NULL,
  `sistem` varchar(24) NOT NULL,
  `dig_no_und` tinyint(3) NOT NULL,
  `und_yth` tinyint(4) NOT NULL DEFAULT '1',
  `antri` int(11) NOT NULL,
  `per_dapil` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'kehadiran per dapil',
  `qr_code` tinyint(4) NOT NULL,
  `bar_code` tinyint(4) NOT NULL,
  `sis_pem` varchar(12) NOT NULL DEFAULT 'Desa',
  `sis_kabkot` varchar(12) NOT NULL DEFAULT 'Kabupaten',
  `desa` varchar(32) NOT NULL,
  `kec` varchar(32) NOT NULL,
  `kabkot` varchar(32) NOT NULL,
  `prop` varchar(16) NOT NULL,
  `logo_kab` varchar(256) NOT NULL,
  `logo_fav` varchar(256) NOT NULL,
  `sis_hitung` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1:manual,2:rkp'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `app_status`, `desa_kode`, `sistem`, `dig_no_und`, `und_yth`, `antri`, `per_dapil`, `qr_code`, `bar_code`, `sis_pem`, `sis_kabkot`, `desa`, `kec`, `kabkot`, `prop`, `logo_kab`, `logo_fav`, `sis_hitung`) VALUES
(1, 0, '3206240004', 'Desa', 4, 1, 0, 1, 0, 0, 'Desa', 'Kabupaten', 'Ngromo', 'Nawangan', 'Pacitan', 'Jawa Barat', 'kab-tasikmalaya.png', 'kab_tasikmalaya_wXk_icon.ico', 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_panitia`
--

CREATE TABLE `data_panitia` (
  `id` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `id_jab` tinyint(4) NOT NULL,
  `ket` varchar(32) NOT NULL,
  `photo` varchar(128) NOT NULL,
  `sort` smallint(6) NOT NULL DEFAULT '999',
  `aktif` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data_panitia`
--

INSERT INTO `data_panitia` (`id`, `nama`, `id_jab`, `ket`, `photo`, `sort`, `aktif`) VALUES
(1, 'Supriadi, S.Sos', 1, 'Ketua BPD', 'ketuabpd.jpg', 990, 1),
(2, 'Endang Sumaeni', 1, 'BPD', 'Endang-Sumaeni.jpg', 999, 1),
(3, 'Aning Puji Lestari, S.Pd.', 1, 'BPD/Pengawas Bumdesa', 'Aning-Puji-Lestari.jpg', 999, 1),
(4, 'Abd. Rohman Basthomi, S.Pd.', 1, 'BPD', 'ABD.-ROHMAN-BASTHOMI.jpg', 999, 1),
(5, 'Putro Mustiaji ', 1, 'BPD', 'PUTRO-MUSTIAJI.jpg', 999, 1),
(6, 'Titis Puspaningrum', 2, 'Kepala Desa Grenden', 'Titis-Puspaningrum.jpg', 1, 1),
(7, 'Anda Asmara', 2, 'Kepala Seksi Pemerintahan', 'anda-asmara.jpg', 2, 1),
(8, 'Edi Imam Munajat', 2, 'Sekretaris Desa', 'Edi-Imam-Munajad.jpg', 3, 1),
(10, 'Hermini, S.Pd.', 5, 'Unit Usaha Pertanian/UKM', 'hermini.jpg', 999, 1),
(11, 'Denik Agus Setiawan', 2, 'Kepala Dusun Krajan I', 'Denik-Agus-Setiawan.jpg', 999, 1),
(13, 'Rineke Mayawati', 3, 'Bendahara', 'rineke-mayawati.jpg', 999, 1),
(14, 'Ir. Agus Subandiyono', 3, 'Sekretaris', 'agus-subandiyono.jpg', 999, 1),
(15, 'USMAN PERMANA', 3, 'Bendahara', 'anda-asmara.jpg', 999, 1),
(16, 'M. Solikin, M.Pd', 3, 'Seksi Pantarlih', 'sholikin.jpg', 999, 1),
(17, 'Subandi ', 3, 'Seksi Perlengkapan', 'Subandi.jpg', 999, 1),
(19, 'Indah Nurhayati', 4, 'Karetan RW 01', 'Indah-Nurhayati.jpg', 2, 1),
(20, 'Sri Hartatik', 4, 'Karetan RW 01', 'Sri-Hartatik.jpg', 1, 1),
(21, 'Puji Indayani', 4, 'Karetan RW 02', 'Puji-Indayani.jpg', 3, 1),
(22, 'Idatul Fitriyah', 4, 'Karangsono RW 03', 'Idatul-Fitriyah.jpg', 5, 1),
(23, 'Refi Mayangsari', 4, 'Karangsono RW 04', 'refi-mayangsari.jpg', 6, 1),
(24, 'Siti Mahmudah', 4, 'Krajan II RW 12', 'siti-mahmudah.jpg', 19, 1),
(25, 'Eni Dwi Fatma', 4, 'Karangsono RW 04', 'Eni-Dwi-Fatmawati.jpg', 6, 1),
(26, 'Endah Yuliati', 4, 'Karangsono RW 05', 'endah-yuliati.jpg', 6, 1),
(27, 'Jemiatiningsih', 4, 'Karangsono RW 06', 'jemiatiningsih.jpg', 8, 1),
(28, 'Ditia Ainur R.', 4, 'Karangsono RW 06', 'ditia-ainurohmah.jpg', 7, 1),
(30, 'Hermini, S.Pd', 4, 'Kumitir RW 07', 'Hermini,-S.Pd.jpg', 10, 1),
(31, 'Ika Trisnawati', 4, 'Kumitir RW 07', 'ika-trisnawati.jpg', 11, 1),
(32, 'Nurhayati', 4, 'Kumitir RW 08', 'nurhayati.jpg', 12, 1),
(33, 'Istiar Sri Rejeki', 4, 'Krajan II RW 09', 'Istiar-Sri-Rejeki.jpg', 14, 1),
(34, 'Asianti', 4, 'Krajan II RW 09', 'Asianti.jpg', 14, 1),
(35, 'Reni Eka A.', 4, 'Krajan II RW 10', 'reni-eka-aprilliyawati.jpg', 14, 1),
(36, 'Supiyani', 4, 'Krajan II RW 10', 'supiyani.jpg', 14, 1),
(37, 'Nurul Hikmah', 4, 'Krajan II RW 11', 'hurul-hikmah.jpg', 15, 1),
(38, 'Widayati', 4, 'Krajan II RW 11', 'widayati.jpg', 15, 1),
(39, 'Lilik Muryani', 4, 'Krajan II RW 12', 'Lilik-Muryani.jpg', 18, 1),
(40, 'Emi Suslatifah', 4, 'Krajan I RW 13', 'EMI-SUSLATIFAH.jpg', 999, 1),
(41, 'Eni Fadilah', 4, 'Krajan I RW 14', 'eni-fadilah.jpg', 999, 1),
(42, 'Witingtyas WW.', 4, 'Krajan I RW 14', 'f14650b1072c6dafb3a1aad96f3b94fa.jpg', 999, 1),
(43, 'Musriani Ratna D', 4, 'Krajan I RW 15', 'musriani-ratna-dewi.jpg', 999, 1),
(44, 'Mamik Widyawati', 4, 'Krajan I RW 16', 'manik-widyawati.jpg', 9997, 1),
(45, 'Winarsih', 4, 'Kapuran RW 17', 'Winarsih.jpg', 9998, 1),
(46, 'Erni Ernawati', 4, 'Kapuran RW 19', 'Erni-Ernawati.jpg', 10001, 1),
(47, 'Utsiyah M.', 4, 'Kapuran RW 19', 'Utsiyah-Mulyaningsih.jpg', 10000, 1),
(48, 'Imam Wahyudi', 1, 'BPD', 'Imam-Wahyudi.jpg', 999, 1),
(49, 'Suwantoro, S.Pd.', 1, 'BPD/Pengawas Bumdesa', 'Suwantoro.jpg', 992, 1),
(50, 'Baru Basuki', 2, 'Kepala Dusun Kumitir', 'Baru-Basuki.jpg', 999, 1),
(51, 'Deny Yuli Istanto', 2, 'Kepala Dusun Karangsono', 'Deny-Yuli-Istanto.jpg', 999, 1),
(52, 'Emi Suslatifah', 2, 'Staf Kaur Keuangan', 'Emi-Suslatifah.jpg', 991, 1),
(53, 'Moh. Nurhayin', 2, 'Kasi Kesra', 'Moh.-Nurhayin.jpg', 990, 1),
(54, 'Mohamad Arif Budiman', 2, 'Kepala Dusun Krajan II', 'Mohamad-Arif-Budiman.jpg', 999, 1),
(55, 'Muhammad Anas', 2, 'Staf Kaur Perencanaan', 'Muhammad-Anas.jpg', 991, 1),
(56, 'Painten', 2, 'Kasi Pelayanan', 'Painten.jpg', 990, 1),
(57, 'Rineke Mayawati', 2, 'Kaur Tata Usaha dan Umum', 'Rineke-Mayawati.jpg', 990, 1),
(58, 'Sujaeni Hadi S.', 2, 'Kaur Perencanaan', 'Sujaeni-Hadi-S.jpg', 989, 1),
(59, 'Yudi Setiawan', 3, 'Seksi Administrasi', 'Yudi-Setiawan.jpg', 999, 1),
(60, 'Yayuk Sugiarti', 4, 'Krajan I RW 13', 'Yayuk-Sugiarti.jpg', 999, 1),
(61, 'Eka Widia Wati', 4, 'Krajan I RW 15', '421e0252c8949dc0f4b85e8aa812f3d4.jpg', 999, 1),
(62, 'Suwarni', 4, 'Kumitir RW 08', 'Suwarni.jpg', 13, 1),
(63, 'M. Solikin, M.Pd.', 5, 'Direktur Bumdesa', 'Mohamad-Solikin,-M.Pd.jpg', 1, 1),
(64, 'Drs. Bambang H.', 5, 'Sekretaris Bumdesa', 'Drs.-Bambang-Hariono.jpg', 2, 1),
(65, 'Nurhamid', 5, 'Bendahara Bumdesa', 'Nurhamid.jpg', 3, 1),
(66, 'Ayu Cahyaningtias', 5, 'Tim Kreatif Bumdesa', 'Ayu-Cahyaningtias.jpg', 999, 1),
(67, 'Dewik Susanti', 5, 'Unit Usaha Layanan Jasa Umum', 'Dewik-Susanti.jpg', 999, 1),
(68, 'Erfan Febriantoro,S.Kom', 5, 'IT Support Bumdesa', 'Erfan-Febriantoro,-S.Kom.jpg', 999, 1),
(69, 'Nurudin Yahya', 5, 'Unit Bumdes@Net', 'Nurudin-Yahya.jpg', 999, 1),
(70, 'Toni Megan Wiranata', 5, 'Tim Kreatif Bumdesa', 'Toni-Megan-Wiranata.jpg', 999, 1),
(71, 'Zulfatul Mahmudah', 5, 'Tim Kreatif Bumdesa', 'Zulfatul-Mahmudah.jpg', 999, 1),
(72, 'Yulia Nur Sasi', 4, 'Kapuran RW 18', 'Yulia-Nur-Sasi.jpg', 9999, 1),
(73, 'AISYAH', 3, 'Sekretaris', 'sujaeni.jpg', 999, 1),
(74, 'Suyono', 2, 'Kepala Dusun Karetan', '0ead4748270f64c79d1c9608bded9812.jpg', 999, 1),
(83, 'Amar Husni', 5, 'Unit Pande Besi, Pertambangan', '3341ac4ec5d4bd421888c84c135f8c1e.jpg', 999, 1),
(87, 'Sutrisno, S.Pd.', 1, 'Sekretaris BPD/Pengawas Bumdesa', '1ca150618f058240fe1b5dcb8c2c94c2.jpg', 991, 1),
(88, 'Angga Dika Pratama', 1, 'BPD', 'fe49604f8fdc716653dfd7c7bbf5e3a7.jpg', 10001, 1),
(89, 'Anas Tohir', 2, 'Kepala Dusun Kapuran', 'e26b43178f66e5efaebcd7fca0045f01.jpg', 999, 1),
(90, 'Rupono', 2, 'Kaur Keuangan', '37ac87d5475405cb4adcd7cf901536a1.jpg', 988, 1),
(91, 'masjum.com', 5, 'IT Support', '4ed29867e67e53abc7bb9bc5f34273d8.jpg', 999, 1),
(92, 'Sulistiyani', 4, 'Krajan I RW 16', 'aa91e8691cfc6e4c178604437f250737.jpg', 999, 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_panitia_jab`
--

CREATE TABLE `data_panitia_jab` (
  `id` int(11) NOT NULL,
  `jab` varchar(32) NOT NULL,
  `aktif` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data_panitia_jab`
--

INSERT INTO `data_panitia_jab` (`id`, `jab`, `aktif`) VALUES
(1, 'BPD', 1),
(2, 'Perangkat Desa', 1),
(3, 'Panitia Pilkades', 1),
(4, 'Gastarlih', 1),
(5, 'BUMDES', 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_pemilih`
--

CREATE TABLE `data_pemilih` (
  `id` int(11) NOT NULL,
  `nokk` varchar(20) NOT NULL,
  `nik` varchar(18) NOT NULL,
  `nama_lengkap` varchar(128) NOT NULL,
  `tmp_lahir` varchar(32) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `lp` varchar(1) NOT NULL,
  `id_dusun` tinyint(4) NOT NULL,
  `rt` varchar(4) NOT NULL,
  `rw` varchar(4) NOT NULL,
  `id_dapil` tinyint(4) NOT NULL DEFAULT '1',
  `sts_nikah` tinyint(4) NOT NULL,
  `no_urut` int(11) NOT NULL,
  `qr_code` text NOT NULL,
  `aktif` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data_pemilih`
--

INSERT INTO `data_pemilih` (`id`, `nokk`, `nik`, `nama_lengkap`, `tmp_lahir`, `tgl_lahir`, `lp`, `id_dusun`, `rt`, `rw`, `id_dapil`, `sts_nikah`, `no_urut`, `qr_code`, `aktif`) VALUES
(1, '', '', 'SUP0N0', 'JEMBER', '0002-08-05', '2', 4, '001', '001', 1, 0, 1, '', 1),
(2, '', '', 'MARUKDIN', 'JEMBER', '2013-08-10', '2', 4, '001', '001', 1, 0, 2, '', 1),
(3, '', '', 'SATIJO', 'JEMBER', '2026-07-01', '1', 4, '001', '001', 1, 0, 3, '', 1),
(4, '', '', 'TOMAR', 'JEMBER', '2023-07-01', '2', 4, '001', '001', 1, 0, 4, '', 1),
(5, '', '', 'SAKDIYAH', 'JEMBER', '0003-07-01', '1', 4, '001', '001', 1, 0, 5, '', 1),
(6, '', '', 'SAMAT', 'JEMBER', '2021-06-05', '2', 4, '001', '001', 1, 0, 6, '', 1),
(7, '', '', 'SANTOSO', 'JEMBER', '2018-03-06', '1', 4, '001', '001', 1, 0, 7, '', 1),
(8, '', '', 'MARIYAMAH', 'JEMBER', '2019-03-15', '2', 4, '001', '001', 1, 0, 8, '', 1),
(9, '', '', 'PU\'AT BAHRUDIN', 'JEMBER', '2018-06-15', '1', 4, '001', '001', 1, 0, 9, '', 1),
(10, '', '', 'ASAN', 'JEMBER', '2010-06-30', '2', 4, '001', '001', 1, 0, 10, '', 1),
(11, '', '', 'HATI', 'JEMBER', '2018-01-07', '1', 4, '001', '001', 1, 0, 11, '', 1),
(12, '', '', 'MARSUKI', 'JEMBER', '2028-10-05', '2', 4, '001', '001', 1, 0, 12, '', 1),
(13, '', '', 'JUMAILATUL JANAH', 'JEMBER', '0004-07-01', '2', 4, '001', '001', 1, 0, 13, '', 1),
(14, '', '', 'SITTI AMINAH', 'JEMBER', '2011-04-01', '1', 4, '001', '001', 1, 0, 14, '', 1),
(15, '', '', 'SAYANI', 'JEMBER', '2027-08-06', '2', 4, '001', '001', 1, 0, 15, '', 1),
(16, '', '', 'ISMAIL', 'JEMBER', '2012-01-27', '2', 4, '001', '001', 1, 0, 16, '', 1),
(17, '', '', 'A NUR ANSORI', 'JEMBER', '2016-07-01', '2', 4, '001', '001', 1, 0, 17, '', 1),
(18, '', '', 'AHMAD MUZAKI', 'JEMBER', '2018-07-01', '2', 4, '001', '001', 1, 0, 18, '', 1),
(19, '', '', 'MUSLIMIN', 'JEMBER', '2027-07-01', '1', 4, '001', '001', 1, 0, 19, '', 1),
(20, '', '', 'TIPAH', 'JEMBER', '2031-07-01', '2', 4, '001', '001', 1, 0, 20, '', 1),
(21, '', '', 'AHMAD MUNIR', 'JEMBER', '2019-03-06', '1', 4, '001', '001', 1, 0, 21, '', 1),
(22, '', '', 'JUMADI', 'JEMBER', '2025-02-11', '1', 4, '001', '001', 1, 0, 22, '', 1),
(23, '', '', 'SITTI SOLEHA', 'JEMBER', '0001-06-18', '2', 4, '001', '001', 1, 0, 23, '', 1),
(24, '', '', 'TORINA', 'JEMBER', '2015-09-02', '1', 4, '001', '001', 1, 0, 24, '', 1),
(25, '', '', 'FADLI', 'JEMBER', '2015-07-01', '2', 4, '001', '001', 1, 0, 25, '', 1),
(26, '', '', 'ANI', 'JEMBER', '0003-08-03', '1', 4, '001', '001', 1, 0, 26, '', 1),
(27, '', '', 'SIYAMA', 'JEMBER', '0008-07-01', '2', 4, '001', '001', 1, 0, 27, '', 1),
(28, '', '', 'MISNADIN', 'JEMBER', '0009-09-19', '1', 4, '001', '001', 1, 0, 28, '', 1),
(29, '', '', 'MISTAM', 'JEMBER', '2010-08-17', '2', 4, '001', '001', 1, 0, 29, '', 1),
(30, '', '', 'SUTINI', 'JEMBER', '2013-09-18', '2', 4, '001', '001', 1, 0, 30, '', 1),
(31, '', '', 'ADLA', 'JEMBER', '0003-07-01', '2', 4, '001', '001', 1, 0, 31, '', 1),
(32, '', '', 'SITI', 'JEMBER', '2010-07-01', '2', 4, '001', '001', 1, 0, 32, '', 1),
(33, '', '', 'SUPAMI', 'JEMBER', '2013-07-01', '1', 4, '001', '001', 1, 0, 33, '', 1),
(34, '', '', 'ROHENA', 'JEMBER', '0002-07-01', '2', 4, '001', '001', 1, 0, 34, '', 1),
(35, '', '', 'MAT JAHRI', 'JEMBER', '2018-06-07', '1', 4, '001', '001', 1, 0, 35, '', 1),
(36, '', '', 'SUNARTI', 'JEMBER', '2023-07-08', '1', 4, '001', '001', 1, 0, 36, '', 1),
(37, '', '', 'INDAWATI', 'JEMBER', '2012-01-07', '1', 4, '001', '001', 1, 0, 37, '', 1),
(38, '', '', 'HOLIK KINUR', 'JEMBER', '2016-08-13', '2', 4, '001', '001', 1, 0, 38, '', 1),
(39, '', '', 'NUR BARDI', 'JEMBER', '0002-07-01', '1', 4, '001', '001', 1, 0, 39, '', 1),
(40, '', '', 'PAINTEN', 'JEMBER', '0008-07-01', '2', 4, '001', '001', 1, 0, 40, '', 1),
(41, '', '', 'MATRAWI', 'JEMBER', '2028-07-01', '1', 4, '001', '001', 1, 0, 41, '', 1),
(42, '', '', 'SIWO', 'JEMBER', '0008-07-01', '2', 4, '001', '001', 1, 0, 42, '', 1),
(43, '', '', 'USMAN', 'JEMBER', '2013-07-01', '2', 4, '001', '001', 1, 0, 43, '', 1),
(44, '', '', 'SITI HAMDATUN', 'JEMBER', '2024-07-01', '1', 4, '001', '001', 1, 0, 44, '', 1),
(45, '', '', 'MURSINI', 'JEMBER', '2023-07-01', '2', 4, '001', '001', 1, 0, 45, '', 1),
(46, '', '', 'MARDIYAH', 'JEMBER', '0002-07-01', '2', 4, '001', '001', 1, 0, 46, '', 1),
(47, '', '', 'YUSUP', 'JEMBER', '2023-07-01', '1', 4, '001', '001', 1, 0, 47, '', 1),
(48, '', '', 'SITI NUR HASIYAH', 'JEMBER', '2019-07-01', '2', 4, '001', '001', 1, 0, 48, '', 1),
(49, '', '', 'MURNIATI', 'JEMBER', '2016-06-01', '2', 4, '001', '001', 1, 0, 49, '', 1),
(50, '', '', 'JUMAIYA', 'JEMBER', '2023-07-01', '1', 4, '001', '001', 1, 0, 50, '', 1),
(51, '', '', 'JUMAT', 'JEMBER', '0007-07-10', '1', 4, '001', '001', 1, 0, 51, '', 1),
(52, '', '', 'PAINI', 'JEMBER', '2021-07-01', '1', 4, '001', '001', 1, 0, 52, '', 1),
(53, '', '', 'JUNIATI PURWANINGSIH', 'JEMBER', '2012-07-01', '1', 4, '001', '001', 1, 0, 53, '', 1),
(54, '', '', 'AHMAD TAUFIK', 'JEMBER', '2015-07-01', '1', 4, '001', '001', 1, 0, 54, '', 1),
(55, '', '', 'SAFI\'I', 'JEMBER', '2028-05-20', '1', 4, '001', '001', 1, 0, 55, '', 1),
(56, '', '', 'SULAMI', 'JEMBER', '2031-07-01', '2', 4, '001', '001', 1, 0, 56, '', 1),
(57, '', '', 'MISNAWATI', 'JEMBER', '0002-07-01', '2', 4, '001', '001', 1, 0, 57, '', 1),
(58, '', '', 'UMMI HANIK', 'JEMBER', '0005-07-20', '2', 4, '001', '001', 1, 0, 58, '', 1),
(59, '', '', 'MISNAWAR', 'JEMBER', '0007-02-12', '1', 4, '001', '001', 1, 0, 59, '', 1),
(60, '', '', 'SITI MARATUS SOLEHA', 'JEMBER', '0002-03-27', '2', 4, '001', '001', 1, 0, 60, '', 1),
(61, '', '', 'TAMI', 'JEMBER', '2027-07-01', '1', 4, '001', '001', 1, 0, 61, '', 1),
(62, '', '', 'MISGI', 'JEMBER', '0007-07-01', '2', 4, '001', '001', 1, 0, 62, '', 1),
(63, '', '', 'SITI WAHYUNI', 'JEMBER', '0009-07-06', '1', 4, '001', '001', 1, 0, 63, '', 1),
(64, '', '', 'ABDUL MUKTI', 'JEMBER', '2023-07-01', '2', 4, '001', '001', 1, 0, 64, '', 1),
(65, '', '', 'SURANI', 'JEMBER', '2026-03-11', '2', 4, '001', '001', 1, 0, 65, '', 1),
(66, '', '', 'MOHER', 'JEMBER', '2031-10-02', '1', 4, '001', '001', 1, 0, 66, '', 1),
(67, '', '', 'ABDUL HAMID', 'JEMBER', '2013-05-06', '2', 4, '001', '001', 1, 0, 67, '', 1),
(68, '', '', 'MISNANTI', 'JEMBER', '2022-01-08', '2', 4, '001', '001', 1, 0, 68, '', 1),
(69, '', '', 'MARTIYEM', 'JEMBER', '0003-07-01', '2', 4, '001', '001', 1, 0, 69, '', 1),
(70, '', '', 'DUL HADI', 'JEMBER', '2025-03-01', '1', 4, '001', '001', 1, 0, 70, '', 1),
(71, '', '', 'MISIYATI', 'JEMBER', '2028-01-02', '1', 4, '001', '001', 1, 0, 71, '', 1),
(72, '', '', 'BURHANAS HADI HAMSAH', 'JEMBER', '2017-01-27', '2', 4, '001', '001', 1, 0, 72, '', 1),
(73, '', '', 'MISYANI', 'JEMBER', '2018-07-01', '1', 4, '001', '001', 1, 0, 73, '', 1),
(74, '', '', 'ELMI', 'JEMBER', '2010-07-01', '2', 4, '001', '001', 1, 0, 74, '', 1),
(75, '', '', 'MOHAMAD SADUN', 'JEMBER', '0006-07-01', '1', 4, '001', '001', 1, 0, 75, '', 1),
(76, '', '', 'FITRIANINGSIH', 'JEMBER', '2012-07-01', '2', 4, '001', '001', 1, 0, 76, '', 1),
(77, '', '', 'PAINEM', 'JEMBER', '2024-06-16', '1', 4, '001', '001', 1, 0, 77, '', 1),
(78, '', '', 'NURSALIM', 'JEMBER', '2025-07-01', '2', 4, '001', '001', 1, 0, 78, '', 1),
(79, '', '', 'TORI', 'JEMBER', '2013-07-01', '1', 4, '001', '001', 1, 0, 79, '', 1),
(80, '', '', 'PAINI', 'JEMBER', '2018-07-01', '2', 4, '001', '001', 1, 0, 80, '', 1),
(81, '', '', 'MAULIDATUL ASANAH', 'JEMBER', '2017-03-05', '1', 4, '001', '001', 1, 0, 81, '', 1),
(82, '', '', 'HOIRIYAH', 'JEMBER', '2027-01-07', '2', 4, '001', '001', 1, 0, 82, '', 1),
(83, '', '', 'ABDUL AZIZ', 'JEMBER', '2023-05-11', '1', 4, '001', '001', 1, 0, 83, '', 1),
(84, '', '', 'SUWARTI', 'JEMBER', '2028-06-01', '1', 4, '001', '001', 1, 0, 84, '', 1),
(85, '', '', 'HASAN JAMIN', 'JEMBER', '2018-07-01', '2', 4, '001', '001', 1, 0, 85, '', 1),
(86, '', '', 'MARTI\'AH', 'JEMBER', '2020-07-02', '1', 4, '001', '001', 1, 0, 86, '', 1),
(87, '', '', 'MIFTAHUL ULUM', 'JEMBER', '0004-06-17', '1', 4, '001', '001', 1, 0, 87, '', 1),
(88, '', '', 'SULAIMI', 'JEMBER', '0008-04-15', '2', 4, '001', '001', 1, 0, 88, '', 1),
(89, '', '', 'MISNALI', 'JEMBER', '2015-07-01', '1', 4, '001', '001', 1, 0, 89, '', 1),
(90, '', '', 'NANIK', 'JEMBER', '0001-07-02', '2', 4, '001', '001', 1, 0, 90, '', 1),
(91, '', '', 'SUMARTO', 'JEMBER', '2010-07-01', '1', 4, '001', '001', 1, 0, 91, '', 1),
(92, '', '', 'BUNAYA', 'JEMBER', '2018-07-01', '1', 4, '001', '001', 1, 0, 92, '', 1),
(93, '', '', 'SUCIK CAHYATI', 'JEMBER', '2015-08-15', '2', 4, '001', '001', 1, 0, 93, '', 1),
(94, '', '', 'PONISA', 'JEMBER', '2013-03-07', '1', 4, '001', '001', 1, 0, 94, '', 1),
(95, '', '', 'SULAIMAN', 'JEMBER', '0004-06-03', '2', 4, '001', '001', 1, 0, 95, '', 1),
(96, '', '', 'DWI NINGSIH', 'JEMBER', '0007-03-07', '1', 4, '001', '001', 1, 0, 96, '', 1),
(97, '', '', 'AMINA', 'JEMBER', '2028-07-02', '2', 4, '001', '001', 1, 0, 97, '', 1),
(98, '', '', 'AHMAD MUZAMIL', 'JEMBER', '0005-07-18', '1', 4, '001', '001', 1, 0, 98, '', 1),
(99, '', '', 'RENI WIJAYATI', 'JEMBER', '2013-06-26', '2', 4, '001', '001', 1, 0, 99, '', 1),
(100, '', '', 'MISTAR', 'JEMBER', '2028-07-10', '1', 4, '001', '001', 1, 0, 100, '', 1),
(101, '', '', 'HAMIDAH', 'JEMBER', '0001-06-01', '2', 4, '001', '001', 1, 0, 101, '', 1),
(102, '', '', 'NASIRUDIN', 'JEMBER', '2024-07-01', '1', 4, '001', '001', 1, 0, 102, '', 1),
(103, '', '', 'NORYAMI', 'JEMBER', '2025-07-03', '1', 4, '001', '001', 1, 0, 103, '', 1),
(104, '', '', 'TONIMAN', 'JEMBER', '2028-07-01', '2', 4, '001', '001', 1, 0, 104, '', 1),
(105, '', '', 'AMINA', 'JEMBER', '0002-07-01', '1', 4, '001', '001', 1, 0, 105, '', 1),
(106, '', '', 'BUSIA', 'JEMBER', '2028-07-01', '2', 4, '001', '001', 1, 0, 106, '', 1),
(107, '', '', 'AHMAD SAIFULLAH', 'JEMBER', '2012-12-26', '1', 4, '001', '001', 1, 0, 107, '', 1),
(108, '', '', 'HASNAN', 'JEMBER', '0004-02-12', '2', 4, '001', '001', 1, 0, 108, '', 1),
(109, '', '', 'FAIQOTUL HIMMAH', 'JEMBER', '2011-12-05', '1', 4, '001', '001', 1, 0, 109, '', 1),
(110, '', '', 'HARIYONO', 'JEMBER', '0004-11-15', '1', 4, '001', '001', 1, 0, 110, '', 1),
(111, '', '', 'SITI MUSYAROFAH', 'JEMBER', '2010-07-01', '2', 4, '001', '001', 1, 0, 111, '', 1),
(112, '', '', 'IMAM WAHYUDI', 'JEMBER', '2011-09-01', '1', 4, '001', '001', 1, 0, 112, '', 1),
(113, '', '', 'M. SURAHMAN', 'JEMBER', '2029-06-04', '2', 4, '001', '001', 1, 0, 113, '', 1),
(114, '', '', 'SOLEHAN', 'JEMBER', '0004-07-01', '1', 4, '001', '001', 1, 0, 114, '', 1),
(115, '', '', 'SAGI AGUS HARIYANTO', 'JEMBER', '2023-03-06', '2', 4, '001', '001', 1, 0, 115, '', 1),
(116, '', '', 'JUMA\'ATI', 'JEMBER', '2027-07-01', '2', 4, '001', '001', 1, 0, 116, '', 1),
(117, '', '', 'NIMO EFENDI', 'JEMBER', '0001-02-06', '1', 4, '001', '001', 1, 0, 117, '', 1),
(118, '', '', 'RINAWATI', 'JEMBER', '0004-07-01', '1', 4, '001', '001', 1, 0, 118, '', 1),
(119, '', '', 'NUR HASANAH', 'JEMBER', '0004-05-02', '2', 4, '001', '001', 1, 0, 119, '', 1),
(120, '', '', 'ABDUL WAFI', 'JEMBER', '2010-02-04', '2', 4, '001', '001', 1, 0, 120, '', 1),
(121, '', '', 'IKA PUSPITASARI', 'JEMBER', '2013-02-06', '1', 4, '001', '001', 1, 0, 121, '', 1),
(122, '', '', 'SUTOMO', 'JEMBER', '0007-12-30', '1', 4, '001', '001', 1, 0, 122, '', 1),
(123, '', '', 'SITI MUBLIHATUR ROPIAH', 'JEMBER', '0009-04-02', '1', 4, '001', '001', 1, 0, 123, '', 1),
(124, '', '', 'HERMAN', 'JEMBER', '2011-02-02', '2', 4, '001', '001', 1, 0, 124, '', 1),
(125, '', '', 'RIA HESTI AGUSTIN', 'JEMBER', '2013-08-07', '2', 4, '001', '001', 1, 0, 125, '', 1),
(126, '', '', 'SAMI', 'JEMBER', '2010-07-01', '1', 4, '001', '001', 1, 0, 126, '', 1),
(127, '', '', 'AHMAD SAIFUL ANAM', 'JEMBER', '0009-09-10', '1', 4, '001', '001', 1, 0, 127, '', 1),
(128, '', '', 'RAMLI', 'JEMBER', '2023-05-21', '1', 4, '001', '001', 1, 0, 128, '', 1),
(129, '', '', 'ERNAWAI', 'JEMBER', '0006-01-07', '2', 4, '001', '001', 1, 0, 129, '', 1),
(130, '', '', 'MUHAMMAD SA\'I', 'JEMBER', '2016-07-01', '1', 4, '001', '001', 1, 0, 130, '', 1),
(131, '', '', 'SUMALIYAH', 'JEMBER', '2024-07-01', '2', 4, '001', '001', 1, 0, 131, '', 1),
(132, '', '', 'GIMAH', 'JEMBER', '2011-03-20', '1', 4, '001', '001', 1, 0, 132, '', 1),
(133, '', '', 'BUNASIR', 'JEMBER', '2020-09-09', '1', 4, '001', '001', 1, 0, 133, '', 1),
(134, '', '', 'ASTIMA', 'JEMBER', '2025-07-06', '2', 4, '001', '001', 1, 0, 134, '', 1),
(135, '', '', 'JUMANI', 'JEMBER', '0002-10-05', '1', 4, '001', '001', 1, 0, 135, '', 1),
(136, '', '', 'IKSAN NUR KHARIRI', 'JEMBER', '2022-06-18', '1', 4, '001', '001', 1, 0, 136, '', 1),
(137, '', '', 'SUPRIYADI', 'JEMBER', '2022-11-20', '1', 4, '001', '001', 1, 0, 137, '', 1),
(138, '', '', 'INDRA ABDUL MU\'IS', 'JEMBER', '2022-10-10', '2', 4, '001', '001', 1, 0, 138, '', 1),
(139, '', '', 'JUNIANTO', 'JEMBER', '2012-07-01', '1', 4, '001', '001', 1, 0, 139, '', 1),
(140, '', '', 'ANTOK PRASETYO', 'JEMBER', '2018-04-02', '2', 4, '001', '001', 1, 0, 140, '', 1),
(141, '', '', 'MUHAMMAD YASIR', 'JEMBER', '2021-02-03', '2', 4, '001', '001', 1, 0, 141, '', 1),
(142, '', '', 'FEBRI RIYANTOKO', 'JEMBER', '2022-08-18', '1', 4, '001', '001', 1, 0, 142, '', 1),
(143, '', '', 'FARIDLATUS SHOLEHAH', 'JEMBER', '2021-02-08', '1', 4, '001', '001', 1, 0, 143, '', 1),
(144, '', '', 'MUHAMAD AINUR RIZAL', 'JEMBER', '2022-08-01', '2', 4, '001', '001', 1, 0, 144, '', 1),
(145, '', '', 'SUPANDI', 'JEMBER', '0005-07-01', '1', 4, '001', '001', 1, 0, 145, '', 1),
(146, '', '', 'SITI NURHALIMAH', 'JEMBER', '2022-02-20', '2', 4, '001', '001', 1, 0, 146, '', 1),
(147, '', '', 'DEWI MURYANI', 'JEMBER', '2022-03-02', '2', 4, '001', '001', 1, 0, 147, '', 1),
(148, '', '', 'MOH. YANTO', 'JEMBER', '2023-03-12', '1', 4, '001', '001', 1, 0, 148, '', 1),
(149, '', '', 'AHMADI', 'JEMBER', '0004-12-02', '2', 4, '001', '001', 1, 0, 149, '', 1),
(150, '', '', 'MUHAMAD ARIF', 'JEMBER', '2021-07-13', '1', 4, '001', '001', 1, 0, 150, '', 1),
(151, '', '', 'NAISATUS SOFIA', 'JEMBER', '2022-09-09', '2', 4, '001', '001', 1, 0, 151, '', 1),
(152, '', '', 'MOCH HOLILI', 'JEMBER', '2023-05-01', '1', 4, '001', '001', 1, 0, 152, '', 1),
(153, '', '', 'NUR AINI', 'JEMBER', '2021-06-02', '2', 4, '001', '001', 1, 0, 153, '', 1),
(154, '', '', 'MUHAMAD RIZKI', 'JEMBER', '2022-10-09', '1', 4, '001', '001', 1, 0, 154, '', 1),
(155, '', '', 'DARMADI', 'JEMBER', '2030-10-05', '1', 4, '001', '001', 1, 0, 155, '', 1),
(156, '', '', 'NUR FADILAH', 'JEMBER', '2022-12-02', '2', 4, '001', '001', 1, 0, 156, '', 1),
(157, '', '', 'YULIANA', 'JEMBER', '0007-02-02', '1', 4, '001', '001', 1, 0, 157, '', 1),
(158, '', '', 'MOHTAR', 'JEMBER', '2031-04-17', '2', 4, '001', '001', 1, 0, 158, '', 1),
(159, '', '', 'AHMAD LUTFI', 'JEMBER', '2013-12-12', '1', 4, '001', '001', 1, 0, 159, '', 1),
(160, '', '', 'AHMAD ZAINI', 'JEMBER', '0007-07-01', '2', 4, '001', '001', 1, 0, 160, '', 1),
(161, '', '', 'ABDUL AZIZ', 'JEMBER', '2014-01-27', '1', 4, '001', '001', 1, 0, 161, '', 1),
(162, '', '', 'SISWAWANDI', 'JEMBER', '2028-08-04', '1', 4, '001', '001', 1, 0, 162, '', 1),
(163, '', '', 'FITRIANI', 'JEMBER', '0007-03-08', '2', 4, '001', '001', 1, 0, 163, '', 1),
(164, '', '', 'SITI NUR HAMIDAH', 'JEMBER', '2020-07-01', '1', 4, '001', '001', 1, 0, 164, '', 1),
(165, '', '', 'YUNI SULISWATI', 'JEMBER', '2020-06-01', '2', 4, '001', '001', 1, 0, 165, '', 1),
(166, '', '', 'JUMADI', 'JEMBER', '0005-10-11', '1', 4, '001', '001', 1, 0, 166, '', 1),
(167, '', '', 'BUDIONO', 'JEMBER', '2011-05-03', '2', 4, '001', '001', 1, 0, 167, '', 1),
(168, '', '', 'MOH WAFA\'IT', 'JEMBER', '2023-07-07', '1', 4, '002', '001', 1, 0, 168, '', 1),
(169, '', '', 'MUHAMMAD YASID', 'JEMBER', '2023-09-07', '2', 4, '002', '001', 1, 0, 169, '', 1),
(170, '', '', 'FAUZAN', 'JEMBER', '2023-07-06', '1', 4, '001', '001', 1, 0, 170, '', 1),
(171, '', '', 'ZULFIKAR', 'JEMBER', '2024-04-02', '2', 4, '001', '001', 1, 0, 171, '', 1),
(172, '', '', 'UMMI MASRUROH', 'JEMBER', '2023-09-21', '1', 4, '001', '001', 1, 0, 172, '', 1),
(173, '', '', 'IRMA HARIROH', 'JEMBER', '2023-12-31', '2', 4, '001', '001', 1, 0, 173, '', 1),
(174, '', '', 'SITI NUR AZIZAH', 'JEMBER', '2023-07-01', '1', 4, '001', '001', 1, 0, 174, '', 1),
(175, '', '', 'AAR ARSUDAIS', 'JEMBER', '2024-02-02', '1', 4, '001', '001', 1, 0, 175, '', 1),
(176, '', '', 'UMAR', 'JEMBER', '0004-11-09', '1', 4, '001', '001', 1, 0, 176, '', 1),
(177, '', '', 'SITTI SABIYA', 'JEMBER', '2011-01-10', '2', 4, '001', '001', 1, 0, 177, '', 1),
(178, '', '', 'SITUM', 'JEMBER', '2029-06-30', '1', 4, '001', '001', 1, 0, 178, '', 1),
(179, '', '', 'SUMIATI', 'JEMBER', '2018-06-04', '2', 4, '001', '001', 1, 0, 179, '', 1),
(180, '', '', 'SIRAWATI', 'JEMBER', '2022-07-04', '2', 4, '001', '001', 1, 0, 180, '', 1),
(181, '', '', 'AHMAD HUZA', 'JEMBER', '2020-01-06', '1', 4, '001', '001', 1, 0, 181, '', 1),
(182, '', '', 'SATIM', 'JEMBER', '0008-07-01', '2', 4, '002', '001', 1, 0, 182, '', 1),
(183, '', '', 'NASIHA', 'JEMBER', '2013-07-01', '1', 4, '002', '001', 1, 0, 183, '', 1),
(184, '', '', 'SAMSUL', 'JEMBER', '2019-01-01', '2', 4, '002', '001', 1, 0, 184, '', 1),
(185, '', '', 'MANISA', 'JEMBER', '2025-04-18', '1', 4, '001', '001', 1, 0, 185, '', 1),
(186, '', '', 'MUZAMIL', 'JEMBER', '2018-01-04', '2', 4, '001', '001', 1, 0, 186, '', 1),
(187, '', '', 'SAMSUL ARIFIN', 'JEMBER', '0009-06-16', '2', 4, '002', '001', 1, 0, 187, '', 1),
(188, '', '', 'AJIS', 'JEMBER', '2028-07-01', '1', 4, '002', '001', 1, 0, 188, '', 1),
(189, '', '', 'SATUNI', 'JEMBER', '0003-04-05', '2', 4, '002', '001', 1, 0, 189, '', 1),
(190, '', '', 'SAYANI', 'JEMBER', '2023-06-01', '1', 4, '002', '001', 1, 0, 190, '', 1),
(191, '', '', 'SUGIANTO', 'JEMBER', '2018-05-10', '2', 4, '002', '001', 1, 0, 191, '', 1),
(192, '', '', 'JURI', 'JEMBER', '2015-07-02', '1', 4, '002', '001', 1, 0, 192, '', 1),
(193, '', '', 'JUANI', 'JEMBER', '2023-07-01', '2', 4, '002', '001', 1, 0, 193, '', 1),
(194, '', '', 'ASMADI', 'JEMBER', '2020-07-01', '1', 4, '002', '001', 1, 0, 194, '', 1),
(195, '', '', 'SABIYA', 'JEMBER', '2028-05-03', '2', 4, '002', '001', 1, 0, 195, '', 1),
(196, '', '', 'YUSUF', 'JEMBER', '2027-07-01', '2', 4, '002', '001', 1, 0, 196, '', 1),
(197, '', '', 'HOTIMAH', 'JEMBER', '0007-06-01', '1', 4, '002', '001', 1, 0, 197, '', 1),
(198, '', '', 'BUSRA', 'JEMBER', '2022-07-01', '1', 4, '002', '001', 1, 0, 198, '', 1),
(199, '', '', 'MAISAROH', 'JEMBER', '2018-07-01', '2', 4, '002', '001', 1, 0, 199, '', 1),
(200, '', '', 'SUPARTI', 'JEMBER', '2023-07-01', '1', 4, '002', '001', 1, 0, 200, '', 1),
(201, '', '', 'MUARIF', 'JEMBER', '2022-09-08', '2', 4, '002', '001', 1, 0, 201, '', 1),
(202, '', '', 'SAMAH', 'JEMBER', '2027-07-01', '1', 4, '002', '001', 1, 0, 202, '', 1),
(203, '', '', 'SAINAH', 'JEMBER', '2012-07-01', '1', 4, '002', '001', 1, 0, 203, '', 1),
(204, '', '', 'MARLUKDIN', 'JEMBER', '0003-12-12', '2', 4, '002', '001', 1, 0, 204, '', 1),
(205, '', '', 'BUHARI MUSLIM', 'JEMBER', '2018-06-12', '1', 4, '002', '001', 1, 0, 205, '', 1),
(206, '', '', 'BUNARTI', 'JEMBER', '2022-06-01', '2', 4, '002', '001', 1, 0, 206, '', 1),
(207, '', '', 'ANDI SUHERMANTO', 'JEMBER', '0007-05-10', '1', 4, '002', '001', 1, 0, 207, '', 1),
(208, '', '', 'IVAN EVENDI', 'JEMBER', '0009-02-01', '1', 4, '002', '001', 1, 0, 208, '', 1),
(209, '', '', 'INDRA MARTA IRAWAN', 'JEMBER', '2014-03-26', '2', 4, '002', '001', 1, 0, 209, '', 1),
(210, '', '', 'ASMU\'I', 'JEMBER', '2029-07-01', '1', 4, '002', '001', 1, 0, 210, '', 1),
(211, '', '', 'ENDANG RATNA WATI', 'JEMBER', '0001-09-09', '1', 4, '002', '001', 1, 0, 211, '', 1),
(212, '', '', 'IRAWATI', 'MEDAN', '2031-07-01', '2', 4, '002', '001', 1, 0, 212, '', 1),
(213, '', '', 'ABSAH', 'JEMBER', '0008-11-11', '1', 4, '002', '001', 1, 0, 213, '', 1),
(214, '', '', 'LIDIN', 'JEMBER', '2028-07-01', '2', 4, '002', '001', 1, 0, 214, '', 1),
(215, '', '', 'TIMA', 'JEMBER', '2014-07-01', '1', 4, '002', '001', 1, 0, 215, '', 1),
(216, '', '', 'FAHRUR ROZI', 'JEMBER', '2020-02-16', '2', 4, '002', '001', 1, 0, 216, '', 1),
(217, '', '', 'MURSID', 'JEMBER', '0007-01-02', '1', 4, '002', '001', 1, 0, 217, '', 1),
(218, '', '', 'SA\'IYA', 'JEMBER', '0009-07-06', '2', 4, '002', '001', 1, 0, 218, '', 1),
(219, '', '', 'PONIRAH', 'JEMBER', '0003-12-07', '1', 4, '002', '001', 1, 0, 219, '', 1),
(220, '', '', 'GIMUN', 'JEMBER', '2019-07-01', '2', 4, '002', '001', 1, 0, 220, '', 1),
(221, '', '', 'SENIMIN', 'JEMBER', '2022-07-01', '1', 4, '002', '001', 1, 0, 221, '', 1),
(222, '', '', 'SUMARNI', 'JEMBER', '2027-07-01', '2', 4, '002', '001', 1, 0, 222, '', 1),
(223, '', '', 'SALAM', 'JEMBER', '2011-08-03', '1', 4, '002', '001', 1, 0, 223, '', 1),
(224, '', '', 'SUPIYANA', 'JEMBER', '2018-09-09', '2', 4, '002', '001', 1, 0, 224, '', 1),
(225, '', '', 'SOARMAN', 'JEMBER', '0001-07-01', '2', 4, '002', '001', 1, 0, 225, '', 1),
(226, '', '', 'SUNIAH', 'JEMBER', '2023-12-12', '2', 4, '002', '001', 1, 0, 226, '', 1),
(227, '', '', 'SULAIMAN', 'JEMBER', '2031-07-02', '1', 4, '002', '001', 1, 0, 227, '', 1),
(228, '', '', 'EVI SUSANTI', 'JEMBER', '0008-06-11', '2', 4, '002', '001', 1, 0, 228, '', 1),
(229, '', '', 'SAMSUL ARIFIN', 'JEMBER', '2019-07-01', '1', 4, '002', '001', 1, 0, 229, '', 1),
(230, '', '', 'SITI MARYAM', 'JEMBER', '2029-07-01', '2', 4, '002', '001', 1, 0, 230, '', 1),
(231, '', '', 'SITI NURHASANAH', 'JEMBER', '2014-06-15', '1', 4, '002', '001', 1, 0, 231, '', 1),
(232, '', '', 'ABDUL WASIL ISMAIL', 'JEMBER', '2019-03-31', '2', 4, '002', '001', 1, 0, 232, '', 1),
(233, '', '', 'SELAMI', 'JEMBER', '2023-07-01', '1', 4, '002', '001', 1, 0, 233, '', 1),
(234, '', '', 'NAHRAWI', 'JEMBER', '0009-07-01', '2', 4, '002', '001', 1, 0, 234, '', 1),
(235, '', '', 'MARIYA', 'JEMBER', '2013-07-01', '1', 4, '002', '001', 1, 0, 235, '', 1),
(236, '', '', 'HALIL', 'JEMBER', '2022-07-01', '2', 4, '002', '001', 1, 0, 236, '', 1),
(237, '', '', 'SITI AMINAH', 'JEMBER', '2028-06-02', '2', 4, '002', '001', 1, 0, 237, '', 1),
(238, '', '', 'ALI WAFA', 'JEMBER', '2015-05-05', '1', 4, '002', '001', 1, 0, 238, '', 1),
(239, '', '', 'BURANI', 'JEMBER', '0007-03-11', '2', 4, '002', '001', 1, 0, 239, '', 1),
(240, '', '', 'MOH RIFA\'I', 'JEMBER', '2022-07-01', '1', 4, '002', '001', 1, 0, 240, '', 1),
(241, '', '', 'ARSIYAH', 'JEMBER', '2028-07-01', '2', 4, '002', '001', 1, 0, 241, '', 1),
(242, '', '', 'MUSFIROH', 'JEMBER', '2019-06-23', '1', 4, '002', '001', 1, 0, 242, '', 1),
(243, '', '', 'BUAMI', 'JEMBER', '0008-09-05', '1', 4, '002', '001', 1, 0, 243, '', 1),
(244, '', '', 'JEFRI', 'JEMBER', '2025-08-09', '1', 4, '002', '001', 1, 0, 244, '', 1),
(245, '', '', 'DANI KARTIKA SARI', 'MEDAN', '0002-06-15', '1', 4, '002', '001', 1, 0, 245, '', 1),
(246, '', '', 'SAMSUL ARIFIN', 'JEMBER', '2019-07-01', '2', 4, '002', '001', 1, 0, 246, '', 1),
(247, '', '', 'SAMIN', 'JEMBER', '2021-07-01', '1', 4, '002', '001', 1, 0, 247, '', 1),
(248, '', '', 'BUHARI', 'JEMBER', '2029-05-11', '2', 4, '002', '001', 1, 0, 248, '', 1),
(249, '', '', 'ROFIQDATUL KOYIMAH', 'JEMBER', '0009-10-16', '1', 4, '002', '001', 1, 0, 249, '', 1),
(250, '', '', 'SIYA', 'JEMBER', '2028-07-01', '2', 4, '002', '001', 1, 0, 250, '', 1),
(251, '', '', 'YESMAN', 'JEMBER', '2027-03-03', '1', 4, '002', '001', 1, 0, 251, '', 1),
(252, '', '', 'ABDUL MISLAM', 'JEMBER', '2018-05-16', '2', 4, '002', '001', 1, 0, 252, '', 1),
(253, '', '', 'SUMILAH', 'JEMBER', '2024-02-01', '1', 4, '002', '001', 1, 0, 253, '', 1),
(254, '', '', 'SUSIYANTO', 'JEMBER', '2028-08-09', '2', 4, '002', '001', 1, 0, 254, '', 1),
(255, '', '', 'FATIMA', 'JEMBER', '0002-06-02', '1', 4, '002', '001', 1, 0, 255, '', 1),
(256, '', '', 'PONI\'AH', 'JEMBER', '2028-04-01', '2', 4, '002', '001', 1, 0, 256, '', 1),
(257, '', '', 'MUNAWAR', 'JEMBER', '0004-07-01', '1', 4, '002', '001', 1, 0, 257, '', 1),
(258, '', '', 'SUYATNO', 'JEMBER', '0002-06-13', '2', 4, '002', '001', 1, 0, 258, '', 1),
(259, '', '', 'MISRA\'I', 'JEMBER', '0007-07-01', '2', 4, '002', '001', 1, 0, 259, '', 1),
(260, '', '', 'SRI WAHYUNINGSIH', 'JEMBER', '2011-01-01', '1', 4, '002', '001', 1, 0, 260, '', 1),
(261, '', '', 'TONI', 'JEMBER', '2025-01-28', '2', 4, '002', '001', 1, 0, 261, '', 1),
(262, '', '', 'USAINI', 'JEMBER', '0005-06-10', '1', 4, '002', '001', 1, 0, 262, '', 1),
(263, '', '', 'HASAN BUSRI', 'JEMBER', '0002-05-03', '2', 4, '002', '001', 1, 0, 263, '', 1),
(264, '', '', 'MISYATI', 'JEMBER', '0006-02-17', '1', 4, '002', '001', 1, 0, 264, '', 1),
(265, '', '', 'HOSNA', 'JEMBER', '0006-01-08', '2', 4, '002', '001', 1, 0, 265, '', 1),
(266, '', '', 'HERMAN', 'JEMBER', '2031-07-01', '1', 4, '002', '001', 1, 0, 266, '', 1),
(267, '', '', 'SITI MARYAM', 'JEMBER', '0007-07-01', '2', 4, '002', '001', 1, 0, 267, '', 1),
(268, '', '', 'SAYATI', 'JEMBER', '0001-07-01', '1', 4, '002', '001', 1, 0, 268, '', 1),
(269, '', '', 'SAMSUL ARIFIN', 'JEMBER', '0001-07-01', '2', 4, '002', '001', 1, 0, 269, '', 1),
(270, '', '', 'SENIMAN', 'JEMBER', '2025-07-06', '1', 4, '002', '001', 1, 0, 270, '', 1),
(271, '', '', 'YUSMIATI', 'JEMBER', '2029-01-28', '1', 4, '002', '001', 1, 0, 271, '', 1),
(272, '', '', 'ANA MARIYA', 'JEMBER', '2019-09-14', '2', 4, '002', '001', 1, 0, 272, '', 1),
(273, '', '', 'AGUS HARIYANTO', 'JEMBER', '2011-09-05', '1', 4, '002', '001', 1, 0, 273, '', 1),
(274, '', '', 'SITI AISAH', 'JEMBER', '2016-07-04', '2', 4, '002', '001', 1, 0, 274, '', 1),
(275, '', '', 'JUNIANTO', 'JEMBER', '2011-06-13', '1', 4, '002', '001', 1, 0, 275, '', 1),
(276, '', '', 'SUMARTONO', 'JEMBER', '0006-03-13', '2', 4, '002', '001', 1, 0, 276, '', 1),
(277, '', '', 'SURTI HARTATIK', 'JEMBER', '2011-04-01', '1', 4, '002', '001', 1, 0, 277, '', 1),
(278, '', '', 'HAMI', 'JEMBER', '2023-08-02', '2', 4, '002', '001', 1, 0, 278, '', 1),
(279, '', '', 'MUALI', 'JEMBER', '2028-03-17', '2', 4, '002', '001', 1, 0, 279, '', 1),
(280, '', '', 'SITI ROMLAH', 'JEMBER', '0003-12-12', '1', 4, '002', '001', 1, 0, 280, '', 1),
(281, '', '', 'BUSRO', 'JEMBER', '2022-08-07', '2', 4, '002', '001', 1, 0, 281, '', 1),
(282, '', '', 'SIYA', 'JEMBER', '2023-07-01', '1', 4, '002', '001', 1, 0, 282, '', 1),
(283, '', '', 'HOLIFAH', 'JEMBER', '2013-12-02', '1', 4, '002', '001', 1, 0, 283, '', 1),
(284, '', '', 'NANGWAR', 'JEMBER', '2023-01-05', '1', 4, '002', '001', 1, 0, 284, '', 1),
(285, '', '', 'SULASTRI', 'JEMBER', '0002-12-28', '2', 4, '002', '001', 1, 0, 285, '', 1),
(286, '', '', 'MOH CANDRA', 'JEMBER', '2020-06-22', '1', 4, '002', '001', 1, 0, 286, '', 1),
(287, '', '', 'SAMAN', 'JEMBER', '2018-04-24', '2', 4, '002', '001', 1, 0, 287, '', 1),
(288, '', '', 'SITI MORANI', 'JEMBER', '2025-03-07', '1', 4, '002', '001', 1, 0, 288, '', 1),
(289, '', '', 'MUKHSON FAUZI', 'JEMBER', '2026-03-11', '2', 4, '002', '001', 1, 0, 289, '', 1),
(290, '', '', 'SITI RAHAYU', 'JEMBER', '2026-05-09', '1', 4, '002', '001', 1, 0, 290, '', 1),
(291, '', '', 'KARINA', 'JEMBER', '2015-06-10', '2', 4, '002', '001', 1, 0, 291, '', 1),
(292, '', '', 'SUJARI', 'JEMBER', '2027-07-01', '1', 4, '002', '001', 1, 0, 292, '', 1),
(293, '', '', 'ENDANG SULISWANI', 'JEMBER', '2030-07-01', '2', 4, '002', '001', 1, 0, 293, '', 1),
(294, '', '', 'TOYATI', 'JEMBER', '0001-07-01', '2', 4, '002', '001', 1, 0, 294, '', 1),
(295, '', '', 'HOLEK', 'JEMBER', '2027-05-22', '1', 4, '002', '001', 1, 0, 295, '', 1),
(296, '', '', 'YAYAN ANDIKA', 'JEMBER', '2017-09-12', '2', 4, '002', '001', 1, 0, 296, '', 1),
(297, '', '', 'SAMI', 'JEMBER', '2031-07-01', '1', 4, '002', '001', 1, 0, 297, '', 1),
(298, '', '', 'JUNAEDI', 'JEMBER', '0002-05-05', '1', 4, '002', '001', 1, 0, 298, '', 1),
(299, '', '', 'SAMINAH', 'JEMBER', '0006-07-01', '2', 4, '002', '001', 1, 0, 299, '', 1),
(300, '', '', 'HOLILI', 'JEMBER', '2011-06-06', '1', 4, '002', '001', 1, 0, 300, '', 1),
(301, '', '', 'AFIK ZAMANI', 'JEMBER', '2021-07-28', '2', 4, '002', '001', 1, 0, 301, '', 1),
(302, '', '', 'LINA AWALIATUS AFIFAH', 'JEMBER', '2021-03-30', '1', 4, '002', '001', 1, 0, 302, '', 1),
(303, '', '', 'RIZAL', 'JEMBER', '2021-07-01', '2', 4, '002', '001', 1, 0, 303, '', 1),
(304, '', '', 'MUHAMMAD AMIRUDIN', 'JEMBER', '2022-12-08', '1', 4, '002', '001', 1, 0, 304, '', 1),
(305, '', '', 'MOH WAHDANA', 'JEMBER', '2023-04-16', '2', 4, '002', '001', 1, 0, 305, '', 1),
(306, '', '', 'MOH GANDA WIJAYA', 'JEMBER', '2021-08-02', '1', 4, '002', '001', 1, 0, 306, '', 1),
(307, '', '', 'DONI IRAWAN', 'JEMBER', '2021-12-27', '2', 4, '002', '001', 1, 0, 307, '', 1),
(308, '', '', 'IKRAM', 'JEMBER', '2020-07-01', '1', 4, '002', '001', 1, 0, 308, '', 1),
(309, '', '', 'AHMAD ABDUL GANI', 'JEMBER', '2023-04-21', '1', 4, '002', '001', 1, 0, 309, '', 1),
(310, '', '', 'SUGIARTO', 'JEMBER', '0001-12-27', '2', 4, '002', '001', 1, 0, 310, '', 1),
(311, '', '', 'ANNISA MOKARROMAH', 'JEMBER', '2022-04-05', '2', 4, '002', '001', 1, 0, 311, '', 1),
(312, '', '', 'RUDI HARTONO', 'JEMBER', '2011-07-01', '2', 4, '002', '001', 1, 0, 312, '', 1),
(313, '', '', 'BUDIONO', 'JEMBER', '0004-07-01', '1', 4, '002', '001', 1, 0, 313, '', 1),
(314, '', '', 'ABDUL HADI', 'JEMBER', '2030-07-01', '2', 4, '002', '001', 1, 0, 314, '', 1),
(315, '', '', 'ARDI HIDAYAT', 'JEMBER', '2012-08-14', '1', 4, '002', '001', 1, 0, 315, '', 1),
(316, '', '', 'ATIK NUR INAYAH', 'JEMBER', '2021-11-10', '1', 4, '002', '001', 1, 0, 316, '', 1),
(317, '', '', 'SUNARTO', 'JEMBER', '2013-07-01', '2', 4, '002', '001', 1, 0, 317, '', 1),
(318, '', '', 'MUHAMMAT MISTO', 'JEMBER', '2019-07-01', '1', 4, '002', '001', 1, 0, 318, '', 1),
(319, '', '', 'ANI WINDA SARI', 'JEMBER', '2017-01-15', '1', 4, '001', '001', 1, 0, 319, '', 1),
(320, '', '', 'SAMSUL ARIFIN', 'JEMBER', '0008-04-02', '2', 4, '002', '001', 1, 0, 320, '', 1),
(321, '', '', 'EDY SUPRIANTO', 'JEMBER', '0004-10-02', '2', 4, '001', '001', 1, 0, 321, '', 1),
(322, '', '', 'AHMAD NOVAL', 'JEMBER', '2013-03-08', '1', 4, '001', '001', 1, 0, 322, '', 1),
(323, '', '', 'SATINI', 'JEMBER', '2021-02-11', '2', 4, '001', '001', 1, 0, 323, '', 1),
(324, '', '', 'ALDI FAHREZI', 'JEMBER', '2021-07-22', '1', 4, '001', '001', 1, 0, 324, '', 1),
(325, '', '', 'SITI NUR HALIMA', 'JEMBER', '2022-08-24', '2', 4, '001', '001', 1, 0, 325, '', 1),
(326, '', '', 'JUMIRAN', 'JEMBER', '2023-07-01', '2', 4, '001', '001', 1, 0, 326, '', 1),
(327, '', '', 'SAMSUL ARIFIN', 'JEMBER', '2013-01-13', '1', 4, '001', '001', 1, 0, 327, '', 1),
(328, '', '', 'ARMONA', 'JEMBER', '2012-06-01', '2', 4, '001', '001', 1, 0, 328, '', 1),
(329, '', '', 'RAHEMAH', 'PAMEKASAN', '2029-07-01', '2', 4, '002', '001', 1, 0, 329, '', 1),
(330, '', '', 'AHMAD HUZAIN', 'JEMBER', '2020-01-06', '2', 4, '002', '001', 1, 0, 330, '', 1),
(331, '', '', 'PAIMIN', 'JEMBER', '2019-07-01', '1', 4, '002', '001', 1, 0, 331, '', 1),
(332, '', '', 'MISTARI', 'JEMBER', '0005-02-16', '2', 4, '001', '001', 1, 0, 332, '', 1),
(333, '', '', 'SENITI', 'JEMBER', '2013-07-01', '1', 4, '001', '001', 1, 0, 333, '', 1),
(334, '', '', 'BAMBANG', 'JEMBER', '2011-07-01', '2', 4, '001', '001', 1, 0, 334, '', 1),
(335, '', '', 'ZULFA ALIMIAH', 'JEMBER', '2023-09-21', '2', 4, '002', '001', 1, 0, 335, '', 1),
(336, '', '', 'HAMIDAH', 'JEMBER', '2028-10-07', '1', 4, '002', '001', 1, 0, 336, '', 1),
(337, '', '', 'RAWATI', 'JEMBER', '0007-08-07', '1', 4, '002', '001', 1, 0, 337, '', 1),
(338, '', '', 'ZULFATUL KARIMAH', 'JEMBER', '2019-02-06', '2', 4, '002', '001', 1, 0, 338, '', 1),
(339, '', '', 'PAIMAN', 'JEMBER', '0005-07-01', '1', 4, '002', '001', 1, 0, 339, '', 1),
(340, '', '', 'MURTINI', 'JEMBER', '2021-01-01', '1', 4, '002', '001', 1, 0, 340, '', 1),
(341, '', '', 'ABDUL WAHAB', 'JEMBER', '2021-10-01', '1', 4, '002', '001', 1, 0, 341, '', 1),
(342, '', '', 'SULAMI', 'JEMBER', '2020-07-01', '1', 4, '002', '001', 1, 0, 342, '', 1),
(343, '', '', 'SRI WAHYUNINGSIH', 'JEMBER', '2021-04-12', '1', 4, '002', '001', 1, 0, 343, '', 1),
(344, '', '', 'DEDI ISMAIL', 'JEMBER', '2017-01-02', '2', 4, '002', '001', 1, 0, 344, '', 1),
(345, '', '', 'SITI NUR HAMIDA', 'JEMBER', '2000-06-21', '1', 4, '001', '001', 1, 0, 345, '', 1),
(346, '', '', 'SATIYA', 'JEMBER', '1950-07-01', '1', 4, '002', '001', 1, 0, 346, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dusun`
--

CREATE TABLE `dusun` (
  `id` int(11) NOT NULL,
  `uid` tinyint(4) NOT NULL,
  `dusun` varchar(32) NOT NULL,
  `aktif` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dusun`
--

INSERT INTO `dusun` (`id`, `uid`, `dusun`, `aktif`) VALUES
(12, 1, 'Krajan', 1),
(13, 2, 'Bulu', 1),
(14, 3, 'Ngetep', 1),
(15, 4, 'Tugu', 1),
(16, 5, 'CIKANTENG', 1),
(17, 6, 'CIRANCA', 1),
(18, 7, 'LEUWI BILIK', 1),
(19, 8, 'PEKAPURAN', 1),
(20, 9, 'PARUNG PONTENG', 1);

-- --------------------------------------------------------

--
-- Table structure for table `otoritas`
--

CREATE TABLE `otoritas` (
  `id` tinyint(11) NOT NULL,
  `otoritas` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `otoritas`
--

INSERT INTO `otoritas` (`id`, `otoritas`) VALUES
(1, 'Operator Kecamatan'),
(2, 'Operator Desa'),
(3, 'Operator Admin PILKADES'),
(4, 'Operator PILKADES');

-- --------------------------------------------------------

--
-- Table structure for table `pilkades_calon`
--

CREATE TABLE `pilkades_calon` (
  `id` int(11) NOT NULL,
  `nomor` tinyint(4) NOT NULL,
  `nama_calon` varchar(64) NOT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT '1',
  `alamat` varchar(128) NOT NULL,
  `lahir_tmp` varchar(32) NOT NULL,
  `lahir_tgl` date NOT NULL,
  `sts_nikah` tinyint(4) NOT NULL,
  `pekerjaan` varchar(32) NOT NULL,
  `pend_tingkat` varchar(16) NOT NULL,
  `pend_nama` varchar(64) NOT NULL,
  `pend_thn` varchar(4) NOT NULL,
  `photo` varchar(128) NOT NULL,
  `nama_pasangan` varchar(64) NOT NULL,
  `color` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pilkades_calon`
--

INSERT INTO `pilkades_calon` (`id`, `nomor`, `nama_calon`, `gender`, `alamat`, `lahir_tmp`, `lahir_tgl`, `sts_nikah`, `pekerjaan`, `pend_tingkat`, `pend_nama`, `pend_thn`, `photo`, `nama_pasangan`, `color`) VALUES
(1, 0, 'Tidak Sah', 1, '', '', '0000-00-00', 0, '', '', '', '', '', '', 'red'),
(2, 1, 'Ruly Juniar Lo', 1, '', 'Bogor', '1995-11-30', 0, '', '1', 'Sunan Ampel', '2019', '8e028e075133818f3db3d4bdb3918e79.jpg', '', ''),
(3, 2, 'Cecep Giri233', 1, '', 'Bogor', '1990-11-30', 0, '', '1', 'Madrasah', '1990', 'ee7390b80157267ece36eaadeeeed8c8.jpg', '', ''),
(4, 3, 'Wawang Taswang', 1, '', 'Malang', '2019-08-12', 0, '', '1', 'SMS', '1021', '716a9e443d8bf838270130675290aebd.jpeg', '', ''),
(14, 4, 'Riki Muhamad Iqbal', 1, '', 'Tasikmalaya', '2000-09-03', 0, '', '1', 'SMPI', '2018', '5f6241a3c55bd9e56417ca94eb12c679.jpg', '', ''),
(16, 5, 'Jamal Iryad33', 1, '', 'Tasikmalaya', '2000-09-03', 0, '', '1', 'SMPI', '2018', '882d53af893973642e51ad8415a7fb36.png', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `pilkades_dapil`
--

CREATE TABLE `pilkades_dapil` (
  `id` int(11) NOT NULL,
  `uid` tinyint(4) NOT NULL,
  `dapil` varchar(32) NOT NULL,
  `uid_khadir` text NOT NULL,
  `uid_phitung` text NOT NULL,
  `aktif` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pilkades_dapil`
--

INSERT INTO `pilkades_dapil` (`id`, `uid`, `dapil`, `uid_khadir`, `uid_phitung`, `aktif`) VALUES
(1, 1, 'Dapil 1', '112233', '112233', 1),
(2, 2, 'Dapil 2', '38886466', '38886466', 1),
(3, 3, 'Dapil 3', '112244', '112244', 1),
(4, 4, 'Dapil 4', '46035766', '46035766', 1),
(5, 5, 'Dapil 5', '28313334', '28313334', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pilkades_hitung_manual`
--

CREATE TABLE `pilkades_hitung_manual` (
  `id` int(11) NOT NULL,
  `unix_id` varchar(18) NOT NULL,
  `created_at` datetime NOT NULL,
  `id_cal` tinyint(4) NOT NULL,
  `no_cal` tinyint(4) NOT NULL,
  `id_dapil` int(11) NOT NULL,
  `uid_opr` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pilkades_hitung_manual`
--

INSERT INTO `pilkades_hitung_manual` (`id`, `unix_id`, `created_at`, `id_cal`, `no_cal`, `id_dapil`, `uid_opr`) VALUES
(1, '15690593691216', '2019-09-21 09:49:33', 2, 1, 1, '112233'),
(2, '15690593731830', '2019-09-21 09:49:46', 2, 1, 1, '112233'),
(3, '15690593861413', '2019-09-21 09:50:03', 3, 2, 1, '112233'),
(4, '15690594031011', '2019-09-21 09:50:05', 3, 2, 1, '112233'),
(5, '15690594051931', '2019-09-21 09:50:07', 3, 2, 1, '112233'),
(6, '15694682351565', '2019-09-26 03:24:23', 2, 1, 1, '112233'),
(7, '15694682631543', '2019-09-26 03:24:29', 2, 1, 1, '112233'),
(8, '15694682691390', '2019-09-26 03:24:31', 2, 1, 1, '112233'),
(9, '15694682711890', '2019-09-26 03:24:33', 2, 1, 1, '112233'),
(10, '15694682731093', '2019-09-26 03:24:35', 3, 2, 1, '112233'),
(11, '15694682751898', '2019-09-26 03:24:37', 3, 2, 1, '112233'),
(12, '15694682771535', '2019-09-26 03:24:38', 4, 3, 1, '112233'),
(13, '15694682781129', '2019-09-26 03:24:40', 2, 1, 1, '112233');

-- --------------------------------------------------------

--
-- Table structure for table `pilkades_hitung_rekap`
--

CREATE TABLE `pilkades_hitung_rekap` (
  `id` int(11) NOT NULL,
  `id_dapil` int(11) NOT NULL,
  `no_calon` tinyint(4) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `datetime_update` datetime NOT NULL,
  `uid` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pilkades_hitung_rekap`
--

INSERT INTO `pilkades_hitung_rekap` (`id`, `id_dapil`, `no_calon`, `jumlah`, `datetime_update`, `uid`) VALUES
(1, 1, 0, 10, '0000-00-00 00:00:00', '112233'),
(2, 2, 0, 15, '0000-00-00 00:00:00', '112244'),
(3, 2, 1, 34, '2019-06-20 00:34:25', '112244'),
(6, 2, 2, 30, '2019-06-20 00:34:02', '112244');

-- --------------------------------------------------------

--
-- Table structure for table `pilkades_kegiatan`
--

CREATE TABLE `pilkades_kegiatan` (
  `id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `keterangan` varchar(128) NOT NULL,
  `filename` varchar(256) NOT NULL,
  `date` date NOT NULL,
  `aktif` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pilkades_kegiatan`
--

INSERT INTO `pilkades_kegiatan` (`id`, `title`, `keterangan`, `filename`, `date`, `aktif`) VALUES
(1, 'Pendataaan Pemilih', 'Musriani Ratna Dewi Gastarlih RT 14', '02029138-5e62-40b9-bdca-97cefed55e8c.jpg', '2019-07-01', 1),
(2, 'Sosialisasi', 'Panitia Pilkades', '8643d37c-310a-4065-9b68-96465a322973.jpg', '2019-07-02', 1),
(3, 'Musdes Pembentukan Panitia', 'Kantor Desa Grenden', 'musdes_panitia.jpg', '2019-07-02', 1),
(4, 'Musdes Pembentukan Panitia', 'Kantor Desa Grenden', 'musdes_panitia2.jpg', '2019-07-02', 1),
(5, 'Musdes Perencanaan Anggaran', 'Kantor Desa Grenden', 'musdes1.jpg', '2019-07-02', 1),
(6, 'Musdes Perencanaan Anggaran', 'Kantor Desa Grenden', 'musdes2.jpg', '2019-07-02', 1),
(7, 'Musdes Perencanaan Anggaran', 'Kantor Desa Grenden', 'musdes3.jpg', '2019-07-02', 1),
(8, 'Sosialisasi Pilkades', 'Kantor Desa Grenden', 'sosialisasi1.jpg', '2019-07-02', 1),
(9, 'Sosialisasi Pilkades', 'Kantor Desa Grenden', 'sosialisasi2.jpg', '2019-07-02', 1),
(10, 'Sosialisasi Pilkades', 'Kantor Desa Grenden', 'sosialisasi3.jpg', '2019-07-02', 1),
(11, 'Penerimaan Pendaftaran Balon', 'Redi Isti Priyono', 'pen_balon1.jpg', '2019-07-02', 1),
(12, 'Penerimaan Pendaftaran Bakal Calon', 'Suyono', 'pen_balon2.jpg', '2019-07-02', 1),
(13, 'Penerimaan Pendaftaran  Bakal Calon', 'Agus Widianto', 'pen_balon3.jpg', '2019-07-02', 1),
(14, 'Penerimaan Pendaftaran  Bakal Calon', 'Purwanto', 'pen_balon4.jpg', '2019-07-02', 1),
(15, 'Penerimaan Pendaftaran  Bakal Calon', 'Busono', 'pen_balon5.jpg', '2019-07-02', 1),
(16, 'Penerimaan Pendaftaran  Bakal Calon', 'Mohamad Arif Budiman', 'pen_balon6.jpg', '2019-07-02', 1),
(23, 'Verifikasi Berkas di Pendopo Kecamatan Puger', 'Busono', '09e595ea1a2ffa32a964cbca1d49c0f8.jpg', '0000-00-00', 1),
(24, 'Verifikasi Berkas di Pendopo Kecamatan Puger', 'Mohamad Arif Budiman', 'ac071da5bdde596eafd6a031968b5ae1.jpg', '0000-00-00', 1),
(25, 'Verifikasi Berkas di Kecamatan', 'Purwanto', 'b25c961ecf5f4861bbc3152fae33cbb4.jpg', '0000-00-00', 1),
(26, 'Verifikasi Berkas di Kecamatan', 'Agus Widianto', 'ceae8a45316ed0c5bb03d79864f2ed77.jpg', '0000-00-00', 1),
(27, 'Verifikasi Berkas di Kecamatan', 'Redi Isti Priyono', 'ed0a093c255914154ed4c9bb03f3d0db.jpg', '0000-00-00', 1),
(28, 'Verifikasi Berkas di Kecamatan', 'Suyono', '4b0473992375e29e1b96f9e4ab68d3aa.jpg', '0000-00-00', 1),
(29, 'Verifikasi Berkas di Pendopo Kecamatan Puger', 'Tim Verifikator', '2a7fc8e70d5eb1eab1d7edca428d81bf.jpg', '0000-00-00', 1),
(30, 'Lay out Pemilihan Kepala Desa Grenden', 'Kamis, 12 September 2019', '03e0d25d4db169fdfb3a60baa54862d9.jpg', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pilkades_kehadiran`
--

CREATE TABLE `pilkades_kehadiran` (
  `id` int(11) NOT NULL,
  `id_pemilih` int(11) NOT NULL,
  `antri` int(11) NOT NULL,
  `datetime_create` datetime NOT NULL,
  `id_uid` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pilkades_kehadiran`
--

INSERT INTO `pilkades_kehadiran` (`id`, `id_pemilih`, `antri`, `datetime_create`, `id_uid`) VALUES
(1, 1, 0, '2019-09-21 14:42:27', '112233'),
(2, 2, 0, '2019-09-21 14:42:41', '112233'),
(3, 3, 0, '2019-09-21 14:42:49', '112233'),
(4, 6, 0, '2019-09-21 14:43:01', '112233');

-- --------------------------------------------------------

--
-- Table structure for table `print_und_setup`
--

CREATE TABLE `print_und_setup` (
  `id` int(11) NOT NULL,
  `uid_user` varchar(8) NOT NULL,
  `wrap` varchar(12) NOT NULL,
  `no_urut_top` varchar(12) NOT NULL,
  `nama_pemilih` varchar(12) NOT NULL,
  `alamat_pemilih` varchar(12) NOT NULL,
  `alamat_pemilih2` varchar(12) NOT NULL,
  `qr_code` varchar(32) NOT NULL,
  `bar_code` varchar(32) NOT NULL,
  `no_urut_bottom` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `print_und_setup`
--

INSERT INTO `print_und_setup` (`id`, `uid_user`, `wrap`, `no_urut_top`, `nama_pemilih`, `alamat_pemilih`, `alamat_pemilih2`, `qr_code`, `bar_code`, `no_urut_bottom`) VALUES
(1, '0', '0,0', '90,280,26', '90,280,22', '0,280,22', '0,280,22', '90,850', '700,140', '600,280,26'),
(4, '112233', '0,0', '90,260,36', '90,260,24', '0,260,22', '0,260,22', '0,850', '780,200', '800,260,28'),
(5, '38886466', '0,0', '90,280,26', '90,280,22', '0,280,22', '0,280,22', '', '', '600,280,26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uid` varchar(8) NOT NULL,
  `password` varchar(128) NOT NULL,
  `id_oto` tinyint(4) NOT NULL,
  `id_akses` char(10) NOT NULL,
  `rules_akses` varchar(256) NOT NULL,
  `aktif` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uid`, `password`, `id_oto`, `id_akses`, `rules_akses`, `aktif`) VALUES
(1, '112233', 'c30512cacbe63a41c52dac436562e4b6', 2, '1101010008', '3,4,5', 1),
(2, '112244', '1e9a2e571cfe99ce9285fb18d1e67a79', 1, '1102011', '4,5', 1),
(3, '28313334', '9d6fb1393e755d3f6fa612443b984696', 0, '', '4,5', 1),
(4, '46035766', '653be86a45d089846135f76c1f208c14', 0, '', '4,5', 1),
(5, '38886466', '141232e9f1b4f12eaeaf38946d73df20', 0, '', '3,4,5', 1),
(6, '63310895', '39d354b415d2f74eeaa38a81d2712d40', 0, '', '4', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_profile`
--

CREATE TABLE `users_profile` (
  `id` int(11) NOT NULL,
  `uid` varchar(8) NOT NULL,
  `nama_depan` varchar(32) NOT NULL,
  `nama_belakang` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_profile`
--

INSERT INTO `users_profile` (`id`, `uid`, `nama_depan`, `nama_belakang`, `email`) VALUES
(1, '112233', 'Masim', 'Masim', 'admin@gmail.com'),
(2, '112244', 'Abdul', 'Waseh', 'operator@gmail.com'),
(3, '28313334', 'Sumantri', 'Sumantri', 'rifki'),
(4, '46035766', 'Hasan', 'Nudin', '87654321'),
(5, '38886466', 'Sohibul', 'Anwar', 'sandisunarya22@gmail.com'),
(6, '63310895', 'Dudun', 'aja', 'dudun');

-- --------------------------------------------------------

--
-- Table structure for table `user_rules`
--

CREATE TABLE `user_rules` (
  `id` tinyint(4) NOT NULL,
  `rule` varchar(16) NOT NULL,
  `aktif` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_rules`
--

INSERT INTO `user_rules` (`id`, `rule`, `aktif`) VALUES
(1, 'Admin', 1),
(2, 'Cek Kehadiran', 1),
(3, 'Penghitungan', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berkas`
--
ALTER TABLE `berkas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_panitia`
--
ALTER TABLE `data_panitia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_panitia_jab`
--
ALTER TABLE `data_panitia_jab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_pemilih`
--
ALTER TABLE `data_pemilih`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dusun`
--
ALTER TABLE `dusun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otoritas`
--
ALTER TABLE `otoritas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pilkades_calon`
--
ALTER TABLE `pilkades_calon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pilkades_dapil`
--
ALTER TABLE `pilkades_dapil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pilkades_hitung_manual`
--
ALTER TABLE `pilkades_hitung_manual`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pilkades_hitung_rekap`
--
ALTER TABLE `pilkades_hitung_rekap`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pilkades_kegiatan`
--
ALTER TABLE `pilkades_kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pilkades_kehadiran`
--
ALTER TABLE `pilkades_kehadiran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `print_und_setup`
--
ALTER TABLE `print_und_setup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_profile`
--
ALTER TABLE `users_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_rules`
--
ALTER TABLE `user_rules`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berkas`
--
ALTER TABLE `berkas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_panitia`
--
ALTER TABLE `data_panitia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `data_panitia_jab`
--
ALTER TABLE `data_panitia_jab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `data_pemilih`
--
ALTER TABLE `data_pemilih`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=347;

--
-- AUTO_INCREMENT for table `dusun`
--
ALTER TABLE `dusun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `otoritas`
--
ALTER TABLE `otoritas`
  MODIFY `id` tinyint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pilkades_calon`
--
ALTER TABLE `pilkades_calon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pilkades_dapil`
--
ALTER TABLE `pilkades_dapil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pilkades_hitung_manual`
--
ALTER TABLE `pilkades_hitung_manual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pilkades_hitung_rekap`
--
ALTER TABLE `pilkades_hitung_rekap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pilkades_kegiatan`
--
ALTER TABLE `pilkades_kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pilkades_kehadiran`
--
ALTER TABLE `pilkades_kehadiran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `print_und_setup`
--
ALTER TABLE `print_und_setup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users_profile`
--
ALTER TABLE `users_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_rules`
--
ALTER TABLE `user_rules`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
