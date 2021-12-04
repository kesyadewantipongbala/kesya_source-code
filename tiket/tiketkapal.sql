-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2021 at 08:39 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tiketkapal`
--

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_kapal`
--

CREATE TABLE `jadwal_kapal` (
  `kode_jadwal_kapal` varchar(11) NOT NULL,
  `kode_kapal` varchar(11) NOT NULL,
  `tgl_jam_berangkat` datetime NOT NULL,
  `tgl_jam_tiba` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal_kapal`
--

INSERT INTO `jadwal_kapal` (`kode_jadwal_kapal`, `kode_kapal`, `tgl_jam_berangkat`, `tgl_jam_tiba`) VALUES
('C001', 'A001', '2021-12-04 08:00:00', '2021-12-05 08:00:00'),
('C002', 'F002', '2021-12-05 00:00:00', '2021-12-06 13:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `kapal`
--

CREATE TABLE `kapal` (
  `kode_kapal` varchar(11) NOT NULL,
  `nama_kapal` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kapal`
--

INSERT INTO `kapal` (`kode_kapal`, `nama_kapal`) VALUES
('A001', 'New Empire Feri'),
('F002', 'Fefe');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `kode_kelas` varchar(11) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kode_kelas`, `nama_kelas`) VALUES
('B1', 'Bisnis 1'),
('E1', 'Ekonomi 1');

-- --------------------------------------------------------

--
-- Table structure for table `kelas_kapal`
--

CREATE TABLE `kelas_kapal` (
  `id_kelas_kapal` int(11) NOT NULL,
  `kode_jadwal_kapal` varchar(11) NOT NULL,
  `kode_kelas` varchar(11) NOT NULL,
  `jumlah_penumpang` int(6) NOT NULL,
  `harga_tiket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas_kapal`
--

INSERT INTO `kelas_kapal` (`id_kelas_kapal`, `kode_jadwal_kapal`, `kode_kelas`, `jumlah_penumpang`, `harga_tiket`) VALUES
(3, 'C001', 'E1', 100, 15000),
(4, 'C001', 'B1', 20, 150000),
(6, 'C002', 'E1', 10, 15000);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `nama_petugas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`) VALUES
(4, 'Joni'),
(5, 'Jono');

-- --------------------------------------------------------

--
-- Table structure for table `tiket`
--

CREATE TABLE `tiket` (
  `no_tiket` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `id_kelas_kapal` int(11) NOT NULL,
  `nama_penumpang` varchar(100) NOT NULL,
  `tgl_berangkat` date NOT NULL,
  `tgl_pembayaran` date NOT NULL,
  `total_pembayaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tiket`
--

INSERT INTO `tiket` (`no_tiket`, `id_petugas`, `id_kelas_kapal`, `nama_penumpang`, `tgl_berangkat`, `tgl_pembayaran`, `total_pembayaran`) VALUES
(1, 4, 3, 'Judika', '2021-12-04', '2021-12-01', 15000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jadwal_kapal`
--
ALTER TABLE `jadwal_kapal`
  ADD PRIMARY KEY (`kode_jadwal_kapal`),
  ADD KEY `fk_kapal_jadwalKapal` (`kode_kapal`);

--
-- Indexes for table `kapal`
--
ALTER TABLE `kapal`
  ADD PRIMARY KEY (`kode_kapal`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kode_kelas`);

--
-- Indexes for table `kelas_kapal`
--
ALTER TABLE `kelas_kapal`
  ADD PRIMARY KEY (`id_kelas_kapal`),
  ADD KEY `fk_kelasKapal_kelas` (`kode_kelas`),
  ADD KEY `fk_kelasKapal_jadwalKapal` (`kode_jadwal_kapal`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`no_tiket`),
  ADD KEY `fk_tiket_petugas` (`id_petugas`),
  ADD KEY `fk_tiket_kelasKapal` (`id_kelas_kapal`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelas_kapal`
--
ALTER TABLE `kelas_kapal`
  MODIFY `id_kelas_kapal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tiket`
--
ALTER TABLE `tiket`
  MODIFY `no_tiket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwal_kapal`
--
ALTER TABLE `jadwal_kapal`
  ADD CONSTRAINT `fk_kapal_jadwalKapal` FOREIGN KEY (`kode_kapal`) REFERENCES `kapal` (`kode_kapal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelas_kapal`
--
ALTER TABLE `kelas_kapal`
  ADD CONSTRAINT `fk_kelasKapal_jadwalKapal` FOREIGN KEY (`kode_jadwal_kapal`) REFERENCES `jadwal_kapal` (`kode_jadwal_kapal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_kelasKapal_kelas` FOREIGN KEY (`kode_kelas`) REFERENCES `kelas` (`kode_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tiket`
--
ALTER TABLE `tiket`
  ADD CONSTRAINT `fk_tiket_kelasKapal` FOREIGN KEY (`id_kelas_kapal`) REFERENCES `kelas_kapal` (`id_kelas_kapal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tiket_petugas` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
