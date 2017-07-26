-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 18, 2017 at 01:54 AM
-- Server version: 5.6.25
-- PHP Version: 5.5.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dicoblos`
--
CREATE DATABASE IF NOT EXISTS `dicoblos` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dicoblos`;

-- --------------------------------------------------------

--
-- Table structure for table `coblos`
--

CREATE TABLE IF NOT EXISTS `coblos` (
  `id_coblos` varchar(10) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `awal` datetime NOT NULL,
  `akhir` datetime NOT NULL,
  `aktif` varchar(3) NOT NULL DEFAULT 'off'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coblos`
--

INSERT INTO `coblos` (`id_coblos`, `judul`, `awal`, `akhir`, `aktif`) VALUES
('SXXX6', 'Pilkada Jateng', '2016-12-14 08:00:00', '2016-12-14 13:30:00', 'off'),
('W7M4Q', 'Pilbup Wonosobo', '2017-03-14 08:00:00', '2017-03-14 13:30:00', 'off'),
('IIO6W', 'Pilpres 2016', '2016-12-14 08:00:00', '2016-12-14 13:30:00', 'off'),
('BOD3T', 'Pemilu Legislatif Jateng', '2017-04-10 08:00:00', '2017-04-10 13:00:00', 'off');

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE IF NOT EXISTS `info` (
  `id_info` int(10) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `isi` text NOT NULL,
  `waktu` datetime NOT NULL,
  `foto` varchar(255) NOT NULL,
  `pengirim` varchar(50) NOT NULL,
  `counter` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`id_info`, `judul`, `isi`, `waktu`, `foto`, `pengirim`, `counter`) VALUES
(1, 'Pemilu Legislatif Jateng', '<p>Kapan kapan</p>', '2017-03-17 11:06:51', 'app4.jpg', 'gopal', 0),
(2, 'Qiuck Count PilBup Wonosobo ', '<p>ngesok kayane</p>', '2017-03-17 11:07:37', 'tech_tablet.jpg', 'gopal', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kandidat`
--

CREATE TABLE IF NOT EXISTS `kandidat` (
  `id_kandidat` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `alamat` text NOT NULL,
  `partai` varchar(100) NOT NULL,
  `nama2` varchar(100) NOT NULL,
  `jk2` varchar(10) NOT NULL,
  `alamat2` text NOT NULL,
  `partai2` varchar(100) NOT NULL,
  `visi` text NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `id_coblos` varchar(10) NOT NULL,
  `no_urut` int(10) DEFAULT NULL,
  `jml_suara` int(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kandidat`
--

INSERT INTO `kandidat` (`id_kandidat`, `nama`, `jk`, `alamat`, `partai`, `nama2`, `jk2`, `alamat2`, `partai2`, `visi`, `foto`, `id_coblos`, `no_urut`, `jml_suara`) VALUES
('3MD5PX', 'Bachtiar Munir', 'Pria', 'Kendal', 'PLKJ', '', '', '', '', 'Wuuuusss', 'avatar1.png', 'BOD3T', 4, 0),
('9E997T', 'Indah Purwaningsih', 'Wanita', 'Tambi', 'PPJO', '', '', '', '', 'Maneni', 'avatar5.png', 'BOD3T', 2, 0),
('9TLIJ8', 'Sabila Ajeng  ', 'Wanita', 'Brebes', 'PKK', 'Wahyu TRi', 'Pria', 'Tegal', 'PKT', 'Nganu', 'avatar2.png', 'W7M4Q', 1, 0),
('ADV6JZ', 'Andila Nazarudin', 'Wanita', 'Blora', 'PKHO', '', '', '', '', 'bcjkdsbcjksb', 'avatar5.png', 'BOD3T', 6, 0),
('B95YMA', 'Ir. H Naim', 'Pria', 'Depok', 'PNK', 'Drs. H Jamal', 'Pria', 'BLora', 'POKL', 'Nanti aja ya', 'avatar3.png', 'IIO6W', 1, 0),
('DI0HTY', 'Lia Fairuz', 'Wanita', 'Manggisan', 'PKKLJ', '', '', '', '', 'ckbjafbakj', 'avatar6.png', 'BOD3T', 3, 0),
('EKPEQL', 'Naofal Mufid', 'Pria', 'Klesman', 'PHP', 'Ririn Riyana', 'Wanita', 'Kejajar', 'HIJUP', 'Endak kemana', 'avatar1.png', 'W7M4Q', 6, 0),
('EVMEUR', 'Agung Laksono', 'Pria', 'Magelang', 'PKKM', 'Wanda nara', 'Pria', 'Sragen', 'PKSK', 'lalalalalalalalalala', 'avatar5.png', 'W7M4Q', 3, 0),
('SZLQBH', 'Samsul Arif', 'Pria', 'Malang', 'PKM', 'Angelina Jolie', 'Wanita', 'Tuban', 'PKT', 'Terus terus kanan kanan', 'avatar6.png', 'W7M4Q', 2, 0),
('XB9SBZ', 'Anjar Fauzi', 'Pria', 'Lengkong', 'PUOHK', '', '', '', '', 'aklaskjabkj', 'avatar3.png', 'BOD3T', 1, 0),
('XY0TG1', 'Farhat Baskoro', 'Pria', 'Batang', 'PBBBK', '', '', '', '', 'aslkhbakaskjb', 'avatar2.png', 'BOD3T', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE IF NOT EXISTS `kontak` (
  `id_kontak` int(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subjek` text,
  `pesan` text NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `panduan`
--

CREATE TABLE IF NOT EXISTS `panduan` (
  `id_panduan` int(5) NOT NULL,
  `judul` text NOT NULL,
  `isi` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `panduan`
--

INSERT INTO `panduan` (`id_panduan`, `judul`, `isi`) VALUES
(1, 'Qiuck Count PilBup Wonosobo', '<p>hasilnya</p>');

-- --------------------------------------------------------

--
-- Table structure for table `pemilih`
--

CREATE TABLE IF NOT EXISTS `pemilih` (
  `nik` varchar(16) NOT NULL,
  `password` varchar(8) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` varchar(10) NOT NULL,
  `alamat` text NOT NULL,
  `id_coblos` varchar(10) NOT NULL,
  `aktif` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemilih`
--

INSERT INTO `pemilih` (`nik`, `password`, `nama`, `tgl_lahir`, `jk`, `alamat`, `id_coblos`, `aktif`) VALUES
('2016150002', 'eOiOGZ1J', 'Ririn Riyana', '1998-10-15', 'Wanita', 'Kejajar', 'W7M4Q', 1),
('2016150003', 'qWUtBIfd', 'Rizki Mei Nur Aulana', '1997-03-21', 'Pria', 'Mirombo Wonosobo', 'W7M4Q', 1),
('2016150009', 'xYVkLrCM', 'Muhammad Naofal Mufid', '1998-07-01', 'Pria', 'Wonosobo', 'W7M4Q', 1),
('2016150010', 'K2o9Df3s', 'Rifkiyantoro', '1998-10-05', 'Pria', 'Dieng Banjarnegara', 'BOD3T', 1),
('2016150026', 'VoTFPFuf', 'Ahmad Rozikin', '1998-04-22', 'Pria', 'Pemalang', 'BOD3T', 1),
('2016150027', 'G5mbmHqk', 'Ofik Aprilyanto', '1997-03-21', 'Pria', 'Mendolo Wonosobo', 'BOD3T', 1),
('2016150030', 'iqw16a8X', 'Entah kemana', '1998-09-07', 'Wanita', 'Love you', 'BOD3T', 1),
('2016150050', 'CDcoA1CJ', 'Arizal Ariyadi', '1997-03-18', 'Pria', 'Pungangan Mojotengah', 'W7M4Q', 1);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE IF NOT EXISTS `petugas` (
  `nik` varchar(16) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `jk` varchar(20) NOT NULL,
  `level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`nik`, `username`, `password`, `nama`, `alamat`, `jk`, `level`) VALUES
('2016150009', 'gopal', 'coyg212', 'Mohammad Naofal Mufid', 'Klesman Blederan Mojotengah Wonosobo', 'Pria', 'Super Admin'),
('2016150026', 'zickin', 'Gs7KcIK2yX', 'Ahmad Rozikin', 'Pemalang', 'Pria', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id_info`);

--
-- Indexes for table `kandidat`
--
ALTER TABLE `kandidat`
  ADD PRIMARY KEY (`id_kandidat`),
  ADD UNIQUE KEY `nama` (`nama`),
  ADD KEY `fk_cbl` (`id_coblos`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id_kontak`);

--
-- Indexes for table `panduan`
--
ALTER TABLE `panduan`
  ADD PRIMARY KEY (`id_panduan`);

--
-- Indexes for table `pemilih`
--
ALTER TABLE `pemilih`
  ADD PRIMARY KEY (`nik`),
  ADD KEY `fk_cbl` (`id_coblos`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`nik`) COMMENT 'nomor induk kependudukan';

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `id_info` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `panduan`
--
ALTER TABLE `panduan`
  MODIFY `id_panduan` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
