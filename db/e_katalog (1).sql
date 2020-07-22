-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2020 at 04:39 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_katalog`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` varchar(11) NOT NULL,
  `namabarang` varchar(255) NOT NULL,
  `warna` text NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` varchar(11) NOT NULL,
  `nama_file` varchar(255) DEFAULT NULL,
  `id_merk` varchar(11) NOT NULL,
  `id_jenisbarang` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `namabarang`, `warna`, `stok`, `harga`, `nama_file`, `id_merk`, `id_jenisbarang`) VALUES
('BRG01', 'mouse razer', 'hitam', 10, '900000', NULL, 'M02', 'J01'),
('BRG02', 'asdas', 'da', 11, '11', '927c07dc27f1db0ede925d8a7667c062.jpg', 'M04', 'J05'),
('BRG03', 'aa', 'asdasd', 1222, '222', '68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f776174747061642d6d656469612d736572766963652f53746f7279496d6167652f5a6b59306b73473036704b4a4f513d3d2d3437313637333034302e313465356332336331666338313630373935373335363036.jpg', 'M08', 'J01');

-- --------------------------------------------------------

--
-- Table structure for table `jenisbarang`
--

CREATE TABLE `jenisbarang` (
  `id` varchar(11) NOT NULL,
  `jenis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenisbarang`
--

INSERT INTO `jenisbarang` (`id`, `jenis`) VALUES
('J01', 'Pakaian Pria'),
('J02', 'Pakaian Wanita'),
('J03', 'Sepatu Pria'),
('J04', 'Sepatu Wanita'),
('J05', 'Hardware / Komputer'),
('J06', 'Testing');

-- --------------------------------------------------------

--
-- Table structure for table `merk`
--

CREATE TABLE `merk` (
  `id` varchar(11) NOT NULL,
  `nama_merk` varchar(255) NOT NULL,
  `id_jenis` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `merk`
--

INSERT INTO `merk` (`id`, `nama_merk`, `id_jenis`) VALUES
('M01', 'Zara', 'J03'),
('M02', 'Razer', 'J01'),
('M03', 'sablon hitam', 'J01'),
('M04', 'AMD', 'J05'),
('M05', 'Logitech', 'J05'),
('M06', 'Intel', 'J05'),
('M07', 'Rexus', 'J05'),
('M08', 'Deus', 'J01');

-- --------------------------------------------------------

--
-- Table structure for table `upload_file`
--

CREATE TABLE `upload_file` (
  `id` int(11) NOT NULL,
  `nama_file` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `tipe_berkas` varchar(255) DEFAULT NULL,
  `ukuran_berkas` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `upload_file`
--

INSERT INTO `upload_file` (`id`, `nama_file`, `keterangan`, `tipe_berkas`, `ukuran_berkas`) VALUES
(1, '101db7ffb5c92924d39277debaf2897a.jpg', 'asdasd', '.jpg', 11.87),
(2, '751c2b8e02be474962506fee644b27ef.png', '1', '.png', 1398.51);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenisbarang`
--
ALTER TABLE `jenisbarang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merk`
--
ALTER TABLE `merk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upload_file`
--
ALTER TABLE `upload_file`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `upload_file`
--
ALTER TABLE `upload_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
