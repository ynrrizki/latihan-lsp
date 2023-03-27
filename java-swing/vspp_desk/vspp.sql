-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2023 at 04:44 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vspp`
--

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(15) NOT NULL,
  `nama_kelas` varchar(20) NOT NULL,
  `jurusan` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `jurusan`) VALUES
(1, '10 PPLG ', 'Rekayasa Perangkat Lunak'),
(3, '11 RPL', 'Rekayasa Perangkat Lunak'),
(5, '12 RPL ', 'Rekayasa Perangkat Lunak'),
(9, '10 TKJT', 'Teknik Komputer Jaringan'),
(10, '10 DKV', 'Multimedia'),
(11, '12 BC', 'Broadcast');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nisn` int(20) NOT NULL,
  `nis` int(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kelas_id` varchar(70) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(40) NOT NULL,
  `spp_id` varchar(20) NOT NULL,
  `level` varchar(20) NOT NULL DEFAULT 'SISWA'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nisn`, `nis`, `nama`, `kelas_id`, `alamat`, `telp`, `spp_id`, `level`) VALUES
(121, 1221, 'tsya', '12 RPL |Rekayasa Perangkat Lunak', 'ss', 'ss', '2021|400000', 'SISWA'),
(24101010, 1222, 'tasyakhoirunnisa', '12 RPL |Rekayasa Perangkat Lunak', 'jakarta', '08287382', '2022|400000', 'SISWA'),
(1213141516, 12131415, 'Ramadhinta', '12 RPL |Rekayasa Perangkat Lunak', 'Jakarta', '083932', '2022|400000', 'SISWA');

-- --------------------------------------------------------

--
-- Table structure for table `spp`
--

CREATE TABLE `spp` (
  `id` int(15) NOT NULL,
  `tahun` varchar(15) NOT NULL,
  `bulan` varchar(15) NOT NULL,
  `nominal` int(30) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `spp`
--

INSERT INTO `spp` (`id`, `tahun`, `bulan`, `nominal`) VALUES
(2, '2021', 'Oktober', 120000),
(3, '2021', 'Maret', 400000),
(5, '2022', 'Januari', 400000),
(7, '2023', 'Februari', 200000),
(8, '2023', 'April', 200000),
(9, '2325', 'okt', 30000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(15) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `nisn` int(20) NOT NULL,
  `tgl_bayar` char(15) NOT NULL,
  `bln_bayar` varchar(15) NOT NULL,
  `th_bayar` char(10) NOT NULL,
  `spp_id` varchar(20) NOT NULL,
  `jml_bayar` varchar(30) NOT NULL,
  `status` enum('Lunas','Tertunda') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `nama`, `nisn`, `tgl_bayar`, `bln_bayar`, `th_bayar`, `spp_id`, `jml_bayar`, `status`) VALUES
(1, 'ca', 844232, '24', 'Oktober', '2023', '2', '120000', 'Lunas'),
(2, 'Ramadhinta', 1213141516, '22', 'apr', '2021', '2021|400000', '400000', 'Lunas'),
(3, 'tsya', 121, '24', 'oktober', '2025', '2022|400000', '40000', 'Lunas'),
(4, 'tasyakhoirunnisa', 24101010, '30', 'Desember', '2436', '2021|400000', '40000', 'Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(15) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('ADMIN','PETUGAS') NOT NULL DEFAULT 'PETUGAS',
  `status` enum('AKTIF','PASIF') NOT NULL DEFAULT 'AKTIF'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama_user`, `username`, `password`, `level`, `status`) VALUES
(1, 'Tasya Ramadhinta', 'Tasya', '7d19636b89246d5a90c4a7ceb0a7142345bbf020', 'ADMIN', 'AKTIF'),
(2, 'Nischa', 'nischa', 'da7921c262ceb7116998166d2bc41029906208e0', 'PETUGAS', 'PASIF'),
(3, 'caca', 'caca', 'caca', 'ADMIN', 'AKTIF'),
(6, 'Jyena', 'Jyena', 'jyena', 'PETUGAS', 'AKTIF'),
(7, 'Orlana', 'Orlan', 'orlan', 'ADMIN', 'PASIF'),
(8, 'Rina', 'rina', 'rina', 'PETUGAS', 'AKTIF'),
(9, 'Mina', 'mina', 'mina', 'PETUGAS', 'PASIF');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nisn`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `spp_id` (`spp_id`);

--
-- Indexes for table `spp`
--
ALTER TABLE `spp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`nama`),
  ADD KEY `nisn` (`nisn`),
  ADD KEY `spp_id` (`spp_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `spp`
--
ALTER TABLE `spp`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
