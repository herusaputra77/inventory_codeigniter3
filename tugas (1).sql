-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2024 at 04:01 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tugas`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
`id_brg` int(11) NOT NULL,
  `kode_brg` varchar(50) NOT NULL,
  `nama_brg` varchar(200) NOT NULL,
  `harga_beli` double NOT NULL DEFAULT '0',
  `harga_jual` double NOT NULL DEFAULT '0',
  `tgl_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Aktif','Tidak Aktif') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_brg`, `kode_brg`, `nama_brg`, `harga_beli`, `harga_jual`, `tgl_input`, `status`) VALUES
(3, 'BR20240001', 'MARJAN', 20000, 25000, '2024-03-19 17:00:00', 'Aktif'),
(7, 'BR20240003', 'BIMOLI', 20000, 25000, '2024-03-19 17:00:00', 'Aktif'),
(8, 'BR20240004', 'ULTRA MILK', 3000, 3750, '2024-03-19 17:00:00', 'Aktif'),
(9, 'BR20240005', 'RINSO', 5000, 6250, '2024-03-19 17:00:00', 'Aktif'),
(10, 'BR20240006', 'SIRUP ABC', 22000, 27500, '2024-03-19 17:00:00', 'Aktif'),
(11, 'BR20240007', 'YAKULT', 2000, 2500, '2024-03-19 17:00:00', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `brg_keluar`
--

CREATE TABLE IF NOT EXISTS `brg_keluar` (
`ids` int(11) NOT NULL,
  `id_brg` int(11) NOT NULL,
  `notr` varchar(20) NOT NULL,
  `jenis_tr` varchar(10) NOT NULL DEFAULT ' OUT',
  `harga` int(11) NOT NULL DEFAULT '0',
  `jumlah` int(11) NOT NULL,
  `tgl_keluar` date NOT NULL,
  `status_bk` char(12) NOT NULL DEFAULT 'Proses'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `brg_keluar`
--

INSERT INTO `brg_keluar` (`ids`, `id_brg`, `notr`, `jenis_tr`, `harga`, `jumlah`, `tgl_keluar`) VALUES
(1, 3, 'TR-BK00001', 'OUT', 15000, 10, '2024-01-09'),
(4, 3, 'TR-BK00002', 'OUT', 300000, 20, '2024-01-22'),
(6, 3, 'TR-BK00004', 'OUT', 160000, 10, '2024-04-03'),
(7, 3, 'TR-BK00005', 'OUT', 85000, 5, '2024-04-11');

-- --------------------------------------------------------

--
-- Table structure for table `brg_masuk`
--

CREATE TABLE IF NOT EXISTS `brg_masuk` (
`ids` int(11) NOT NULL,
  `id_brg` int(11) NOT NULL,
  `notr` varchar(20) NOT NULL,
  `jenis_tr` varchar(10) NOT NULL DEFAULT 'IN ',
  `harga` int(11) DEFAULT '0',
  `jumlah` int(11) NOT NULL DEFAULT '0',
  `supplier` varchar(255) NOT NULL DEFAULT ' ',
  `tgl_masuk` date NOT NULL,
  `status_bm` char(12) NOT NULL DEFAULT 'Proses'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `brg_masuk`
--

INSERT INTO `brg_masuk` (`ids`, `id_brg`, `notr`, `jenis_tr`, `harga`, `jumlah`, `supplier`, `tgl_masuk`) VALUES
(1, 3, 'TR-BM00001', 'IN ', 1000000, 100, 'www', '2024-01-02'),
(6, 7, 'TR-BM00002', 'IN ', 900000, 50, 'ww', '2024-04-01');

-- --------------------------------------------------------

--
-- Table structure for table `closing`
--

CREATE TABLE IF NOT EXISTS `closing` (
`ids` int(11) NOT NULL,
  `bulan` varchar(100) NOT NULL,
  `tahun` varchar(100) NOT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `closing`
--

INSERT INTO `closing` (`ids`, `bulan`, `tahun`, `status`) VALUES
(1, '01', '2024', '1'),
(2, '02', '2024', '1'),
(10, '02', '2024', '1'),
(11, '03', '2024', '1');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
`id_role` int(11) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `role`) VALUES
(1, 'admin'),
(2, 'member');

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE IF NOT EXISTS `stok` (
`id_stok` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_brg` int(10) NOT NULL,
  `kode_brg` varchar(20) NOT NULL,
  `jenis_tr` varchar(10) NOT NULL DEFAULT ' ',
  `notr` varchar(25) NOT NULL DEFAULT ' ',
  `nama_brg` varchar(255) NOT NULL DEFAULT ' ',
  `masuk` int(5) NOT NULL DEFAULT '0',
  `keluar` int(5) NOT NULL DEFAULT '0',
  `sisa` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`id_stok`, `tanggal`, `id_brg`, `kode_brg`, `jenis_tr`, `notr`, `nama_brg`, `masuk`, `keluar`, `sisa`) VALUES
(1, '2024-01-02', 3, 'BR20240001', 'IN', 'TR-BM00001', 'MARJAN', 100, 0, 0),
(2, '2024-01-09', 3, 'BR20240001', 'OUT', 'TR-BK00001', 'MARJAN', 0, 10, 0),
(3, '2024-01-22', 3, 'BR20240001', 'OUT', 'TR-BK00002', 'MARJAN', 0, 20, 0),
(6, '2024-02-01', 3, 'BR20240001', 'AWL', 'AWL1', 'MARJAN', 0, 0, 70),
(21, '2024-03-01', 3, 'BR20240001', 'AWL', 'AWL1', 'MARJAN', 0, 0, 70),
(22, '2024-04-01', 3, 'BR20240001', 'AWL', 'AWL1', 'MARJAN', 0, 0, 70),
(23, '2024-04-03', 3, 'BR20240001', 'OUT', 'TR-BK00004', 'MARJAN', 0, 10, 0),
(24, '2024-04-11', 3, 'BR20240001', 'OUT', 'TR-BK00005', 'MARJAN', 0, 5, 0),
(25, '2024-04-01', 7, 'BR20240003', 'IN', 'TR-BM00002', 'BIMOLI', 50, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_setting`
--

CREATE TABLE IF NOT EXISTS `tb_setting` (
  `periode_closing` varchar(6) NOT NULL,
  `periode_berjalan` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_setting`
--

INSERT INTO `tb_setting` (`periode_closing`, `periode_berjalan`) VALUES
('202403', '202404');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_stok`
--

CREATE TABLE IF NOT EXISTS `tmp_stok` (
`id_stok` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_brg` int(10) NOT NULL,
  `kode_brg` varchar(20) NOT NULL,
  `jenis_tr` varchar(10) NOT NULL DEFAULT ' ',
  `notr` varchar(25) NOT NULL DEFAULT ' ',
  `nama_brg` varchar(255) NOT NULL DEFAULT ' ',
  `masuk` int(5) NOT NULL DEFAULT '0',
  `keluar` int(5) NOT NULL DEFAULT '0',
  `sisa` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id_user` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL,
  `tanggal_buat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `password`, `role_id`, `tanggal_buat`, `status`, `created_at`, `updated_at`) VALUES
(1, 'vani', 'vani@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, '2024-03-21 02:49:47', 1, '2024-03-13 14:00:33', '2024-03-21 02:49:47'),
(6, 'Rahman', 'rahman@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 2, '2024-03-18 00:47:37', 1, '2024-03-13 15:23:53', '2024-03-18 00:47:37'),
(8, 'ICA', 'ica@gmail.com', 'ec6a6536ca304edf844d1d248a4f08dc', 1, '2024-03-21 02:49:13', 0, '2024-03-13 16:21:03', '2024-03-21 02:49:13'),
(9, 'Midun', 'midun@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 2, '2024-03-21 02:48:58', 1, '2024-03-18 02:07:19', '2024-03-21 02:48:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
 ADD PRIMARY KEY (`id_brg`);

--
-- Indexes for table `brg_keluar`
--
ALTER TABLE `brg_keluar`
 ADD PRIMARY KEY (`ids`);

--
-- Indexes for table `brg_masuk`
--
ALTER TABLE `brg_masuk`
 ADD PRIMARY KEY (`ids`);

--
-- Indexes for table `closing`
--
ALTER TABLE `closing`
 ADD PRIMARY KEY (`ids`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
 ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
 ADD PRIMARY KEY (`id_stok`);

--
-- Indexes for table `tmp_stok`
--
ALTER TABLE `tmp_stok`
 ADD PRIMARY KEY (`id_stok`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
MODIFY `id_brg` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `brg_keluar`
--
ALTER TABLE `brg_keluar`
MODIFY `ids` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `brg_masuk`
--
ALTER TABLE `brg_masuk`
MODIFY `ids` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `closing`
--
ALTER TABLE `closing`
MODIFY `ids` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `tmp_stok`
--
ALTER TABLE `tmp_stok`
MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
