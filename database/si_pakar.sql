-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2021 at 06:37 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si_pakar`
--

-- --------------------------------------------------------

--
-- Table structure for table `storage`
--

CREATE TABLE `storage` (
  `id_store` int(11) NOT NULL,
  `nama_gejala` varchar(255) NOT NULL,
  `cf_user` varchar(255) NOT NULL,
  `nilai_gejala` float NOT NULL,
  `nilai_cfuser` float NOT NULL,
  `cf_he` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblbobot`
--

CREATE TABLE `tblbobot` (
  `id_bobot` int(11) NOT NULL,
  `bobot` varchar(100) DEFAULT NULL,
  `nilai` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblbobot`
--

INSERT INTO `tblbobot` (`id_bobot`, `bobot`, `nilai`) VALUES
(1, 'sangat tidak yakin', 0.2),
(2, 'tidak yakin', 0.4),
(3, 'yakin', 0.6),
(4, 'cukup yakin', 0.8),
(5, 'sangat yakin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbldiagnosa`
--

CREATE TABLE `tbldiagnosa` (
  `id_diagnosa` int(11) NOT NULL,
  `nama_gejala` varchar(255) NOT NULL,
  `cf_user` varchar(255) NOT NULL,
  `nilai_gejala` float NOT NULL,
  `nilai_cfuser` float NOT NULL,
  `cf_he` float NOT NULL,
  `cfold_akhir` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblgejala`
--

CREATE TABLE `tblgejala` (
  `id_gejala` int(255) NOT NULL,
  `gejala` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `cfpakar` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblgejala`
--

INSERT INTO `tblgejala` (`id_gejala`, `gejala`, `keterangan`, `cfpakar`) VALUES
(1, 'Tinja berwarna hijau lumut dengan gumpalan putih', NULL, 0.4),
(2, 'Ayam gemetar', NULL, 0.4),
(3, 'Kelumpuhan pada kaki', NULL, 0.6),
(4, 'Kelumpuhan pada sayap', NULL, 0.2),
(5, 'Leher terpelintir', NULL, 0.2),
(6, 'Ayam berputar-putar', NULL, 0.4),
(7, 'Nafsu makan menurun', NULL, 0.2),
(8, 'Lemas', NULL, 0.8),
(9, 'Bulu menjadi kusam dan berdiri', NULL, 0.6),
(10, 'Tinja cair dan berwarna putih', NULL, 0.4),
(11, 'Jengger Ayam membengkak dengan warna kebiruan', NULL, 0.6),
(12, 'kaki kerokan', NULL, 0.4),
(13, 'Gangguan pernafasan', NULL, 0.8),
(14, 'Keluar cairan dari rongga mulut', NULL, 0.4),
(15, 'Diare', NULL, 1),
(16, 'Heus berlebihan / lebih banyak minum', NULL, 0.6),
(17, 'Kerabang telur lembek', NULL, 0.2),
(18, 'Sayap terkulai', NULL, 1),
(19, 'Gerakan tidak seimbang / sempoyongan', NULL, 0.8),
(20, 'Jengger dan pial memucat', NULL, 0.4),
(21, 'Ayam terengah - engah', NULL, 1),
(22, 'Batuk', NULL, 1),
(23, 'Bersin', NULL, 1),
(24, 'Ngorok', NULL, 1),
(25, 'Keluar lendir dari hidung', NULL, 0.8),
(26, 'Kelopak mata mengalami peradangan', NULL, 0.6),
(27, 'Mata bengkak dan berair', NULL, 0.6),
(28, 'Kaki pucat', NULL, 0.2),
(29, 'Pertumbuhan yang lambat', NULL, 0.4),
(30, 'Penurunan konsumsi ransum', NULL, 0.4),
(31, 'Menggigil', NULL, 0.6),
(32, 'Tinja berwarna putih seperti kapur', NULL, 0.8),
(33, 'Kotoran menempel di sekitar dubur', NULL, 0.4),
(34, 'Jengger berwarna keabuan', NULL, 0.6),
(35, 'Mata sayu / menutup', NULL, 0.8),
(36, 'Sayap menggentung dan kusam', NULL, 0.8),
(37, 'Ayam bergerombol', NULL, 0.2),
(38, 'Kepala disembunyikan pada ketiak', NULL, 0.4),
(39, 'terlihat lesu dan lemas', NULL, 0.6),
(40, 'Tinja encer', NULL, 0.8),
(41, 'Perubahan warna pada kotoran', NULL, 0.4),
(42, 'Kondisi tubuh panas', NULL, 0.6),
(43, 'Ayam enggan berlari', NULL, 0.6),
(44, 'Ayam lebih suka menyendiri', NULL, 0.4),
(45, 'Tinja berdarah dan mencret', NULL, 0.4),
(46, 'Kepala dan leher menekuk', NULL, 0.4),
(47, 'Ayam menjadi kurus', NULL, 0.6),
(48, 'Ayam mengalami sembelit', NULL, 0.4);

-- --------------------------------------------------------

--
-- Table structure for table `tblkategori_gejala`
--

CREATE TABLE `tblkategori_gejala` (
  `id_katgejala` int(255) NOT NULL,
  `id_penyakit` int(255) DEFAULT NULL,
  `id_gejala` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblkategori_gejala`
--

INSERT INTO `tblkategori_gejala` (`id_katgejala`, `id_penyakit`, `id_gejala`) VALUES
(1, 0, 1),
(2, 0, 2),
(3, 0, 3),
(4, 0, 4),
(5, 0, 5),
(6, 0, 6),
(7, 2, 7),
(8, 2, 8),
(9, 2, 2),
(10, 2, 9),
(11, 2, 10),
(12, 3, 11),
(13, 3, 12),
(14, 3, 13),
(15, 3, 14),
(16, 3, 15),
(17, 3, 16),
(18, 3, 17),
(19, 4, 18),
(20, 4, 19),
(21, 4, 20),
(22, 4, 2),
(23, 5, 21),
(24, 5, 22),
(25, 5, 23),
(26, 5, 24),
(27, 6, 21),
(28, 6, 25),
(29, 6, 26),
(30, 6, 27),
(31, 7, 28),
(32, 7, 29),
(33, 8, 25),
(34, 8, 24),
(35, 8, 27),
(36, 8, 30),
(37, 8, 29),
(38, 8, 31),
(39, 8, 7),
(40, 9, 7),
(41, 9, 8),
(42, 9, 32),
(43, 9, 33),
(44, 9, 34),
(45, 9, 35),
(46, 9, 36),
(47, 9, 3),
(48, 9, 4),
(49, 9, 37),
(50, 10, 7),
(51, 10, 38),
(52, 10, 39),
(53, 10, 40),
(54, 10, 13),
(55, 10, 41),
(56, 10, 42),
(57, 10, 43),
(58, 10, 35),
(59, 10, 44),
(60, 11, 9),
(61, 11, 39),
(62, 11, 46),
(63, 11, 35),
(64, 12, 7),
(65, 12, 22),
(66, 12, 13),
(67, 12, 47),
(79, 8, 2),
(80, 8, 3),
(81, 10, 2),
(82, 10, 1),
(83, 12, 1),
(84, 12, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbllogin`
--

CREATE TABLE `tbllogin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbllogin`
--

INSERT INTO `tbllogin` (`id`, `username`, `password`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(2, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tblpenyakit`
--

CREATE TABLE `tblpenyakit` (
  `id_penyakit` int(255) NOT NULL,
  `penyakit` varchar(100) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblpenyakit`
--

INSERT INTO `tblpenyakit` (`id_penyakit`, `penyakit`, `keterangan`) VALUES
(0, 'ND', 'ini penyakit ND'),
(2, 'Gumboro', NULL),
(3, 'Flu Burung', NULL),
(4, 'IBH', NULL),
(5, 'IB', NULL),
(6, 'Snot', NULL),
(7, 'Kolibasilosis', NULL),
(8, 'CRD', NULL),
(9, 'Pullorum', NULL),
(10, 'Kolera', NULL),
(11, 'Berak Darah', NULL),
(12, 'Aspergillosis', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `viewkategori_gejala`
-- (See below for the actual view)
--
CREATE TABLE `viewkategori_gejala` (
`id_penyakit` int(255)
,`penyakit` varchar(100)
,`gejala` varchar(255)
,`cfpakar` double
);

-- --------------------------------------------------------

--
-- Structure for view `viewkategori_gejala`
--
DROP TABLE IF EXISTS `viewkategori_gejala`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewkategori_gejala`  AS  select `tblpenyakit`.`id_penyakit` AS `id_penyakit`,`tblpenyakit`.`penyakit` AS `penyakit`,`tblgejala`.`gejala` AS `gejala`,`tblgejala`.`cfpakar` AS `cfpakar` from ((`tblkategori_gejala` join `tblgejala` on((`tblkategori_gejala`.`id_gejala` = `tblgejala`.`id_gejala`))) join `tblpenyakit` on((`tblkategori_gejala`.`id_penyakit` = `tblpenyakit`.`id_penyakit`))) order by `tblpenyakit`.`id_penyakit` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `storage`
--
ALTER TABLE `storage`
  ADD PRIMARY KEY (`id_store`);

--
-- Indexes for table `tblbobot`
--
ALTER TABLE `tblbobot`
  ADD PRIMARY KEY (`id_bobot`);

--
-- Indexes for table `tbldiagnosa`
--
ALTER TABLE `tbldiagnosa`
  ADD PRIMARY KEY (`id_diagnosa`);

--
-- Indexes for table `tblgejala`
--
ALTER TABLE `tblgejala`
  ADD PRIMARY KEY (`id_gejala`);

--
-- Indexes for table `tblkategori_gejala`
--
ALTER TABLE `tblkategori_gejala`
  ADD PRIMARY KEY (`id_katgejala`),
  ADD KEY `fk_penyakit` (`id_penyakit`),
  ADD KEY `fk_gejala` (`id_gejala`);

--
-- Indexes for table `tbllogin`
--
ALTER TABLE `tbllogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpenyakit`
--
ALTER TABLE `tblpenyakit`
  ADD PRIMARY KEY (`id_penyakit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `storage`
--
ALTER TABLE `storage`
  MODIFY `id_store` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tblbobot`
--
ALTER TABLE `tblbobot`
  MODIFY `id_bobot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbldiagnosa`
--
ALTER TABLE `tbldiagnosa`
  MODIFY `id_diagnosa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tblgejala`
--
ALTER TABLE `tblgejala`
  MODIFY `id_gejala` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tblkategori_gejala`
--
ALTER TABLE `tblkategori_gejala`
  MODIFY `id_katgejala` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `tbllogin`
--
ALTER TABLE `tbllogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblpenyakit`
--
ALTER TABLE `tblpenyakit`
  MODIFY `id_penyakit` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblkategori_gejala`
--
ALTER TABLE `tblkategori_gejala`
  ADD CONSTRAINT `fk_gejala` FOREIGN KEY (`id_gejala`) REFERENCES `tblgejala` (`id_gejala`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_penyakit` FOREIGN KEY (`id_penyakit`) REFERENCES `tblpenyakit` (`id_penyakit`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
