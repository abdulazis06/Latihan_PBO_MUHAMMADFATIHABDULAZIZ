-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 11, 2026 at 07:11 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_latihan_pbo_ti-1d_muhammadfatihabdulaziz`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_tiket`
--

CREATE TABLE `tabel_tiket` (
  `id_tiket` int NOT NULL,
  `nama_film` varchar(255) NOT NULL,
  `jadwal_tayang` datetime NOT NULL,
  `jumlah_kursi` int NOT NULL,
  `harga_dasar_tiket` int NOT NULL,
  `jenis_studio` enum('Regular','IMAX','Velvet') NOT NULL,
  `tipe_audio` varchar(100) DEFAULT NULL,
  `lokasi_baris` varchar(10) DEFAULT NULL,
  `kacamata_3d_id` varchar(50) DEFAULT NULL,
  `efek_gerak_fitur` tinyint(1) DEFAULT NULL,
  `bantal_selimut_pack` tinyint(1) DEFAULT NULL,
  `layanan_butler` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_tiket`
--

INSERT INTO `tabel_tiket` (`id_tiket`, `nama_film`, `jadwal_tayang`, `jumlah_kursi`, `harga_dasar_tiket`, `jenis_studio`, `tipe_audio`, `lokasi_baris`, `kacamata_3d_id`, `efek_gerak_fitur`, `bantal_selimut_pack`, `layanan_butler`) VALUES
(1, 'Kutukan Suster Ngesot', '2026-06-12 13:00:00', 50, 35000, 'Regular', 'Dolby 7.1', 'Row A', NULL, NULL, NULL, NULL),
(2, 'Kutukan Suster Ngesot', '2026-06-12 15:30:00', 50, 35000, 'Regular', 'Dolby 7.1', 'Row B', NULL, NULL, NULL, NULL),
(3, 'Detektif Conan: The Movie', '2026-06-12 14:00:00', 60, 40000, 'Regular', 'Dolby 7.1', 'Row C', NULL, NULL, NULL, NULL),
(4, 'Detektif Conan: The Movie', '2026-06-12 16:45:00', 60, 40000, 'Regular', 'Dolby 7.1', 'Row D', NULL, NULL, NULL, NULL),
(5, 'Petualangan Sherina 3', '2026-06-13 11:00:00', 45, 35000, 'Regular', 'Dolby 5.1', 'Row E', NULL, NULL, NULL, NULL),
(6, 'Petualangan Sherina 3', '2026-06-13 13:15:00', 45, 35000, 'Regular', 'Dolby 5.1', 'Row F', NULL, NULL, NULL, NULL),
(7, 'Action Hero: Bangkit', '2026-06-13 19:00:00', 55, 45000, 'Regular', 'Dolby 7.1', 'Row G', NULL, NULL, NULL, NULL),
(8, 'Action Hero: Bangkit', '2026-06-13 21:30:00', 55, 45000, 'Regular', 'Dolby 7.1', 'Row H', NULL, NULL, NULL, NULL),
(9, 'Interstellar Re-release', '2026-06-12 12:00:00', 120, 75000, 'IMAX', 'IMAX 12-Channel', 'Row IMAX-A', 'KC-3D-001', 1, NULL, NULL),
(10, 'Interstellar Re-release', '2026-06-12 15:15:00', 120, 75000, 'IMAX', 'IMAX 12-Channel', 'Row IMAX-B', 'KC-3D-002', 1, NULL, NULL),
(11, 'Avatar: The Deep Ocean', '2026-06-12 18:30:00', 150, 85000, 'IMAX', 'IMAX 12-Channel', 'Row IMAX-C', 'KC-3D-003', 1, NULL, NULL),
(12, 'Avatar: The Deep Ocean', '2026-06-12 22:00:00', 150, 85000, 'IMAX', 'IMAX 12-Channel', 'Row IMAX-D', 'KC-3D-004', 0, NULL, NULL),
(13, 'Dune: Part Three', '2026-06-14 13:00:00', 130, 80000, 'IMAX', 'IMAX 6-Channel', 'Row IMAX-E', 'KC-3D-005', 1, NULL, NULL),
(14, 'Dune: Part Three', '2026-06-14 16:30:00', 130, 80000, 'IMAX', 'IMAX 6-Channel', 'Row IMAX-F', 'KC-3D-006', 1, NULL, NULL),
(15, 'Cinta di Batas Kota', '2026-06-12 14:30:00', 20, 120000, 'Velvet', 'Dolby Atmos', 'Suite 01', NULL, NULL, 1, 1),
(16, 'Cinta di Batas Kota', '2026-06-12 17:00:00', 20, 120000, 'Velvet', 'Dolby Atmos', 'Suite 02', NULL, NULL, 1, 1),
(17, 'Misteri Rumah Tua', '2026-06-12 19:30:00', 24, 150000, 'Velvet', 'Dolby Atmos', 'Suite 03', NULL, NULL, 1, 1),
(18, 'Misteri Rumah Tua', '2026-06-12 22:15:00', 24, 150000, 'Velvet', 'Dolby Atmos', 'Suite 04', NULL, NULL, 1, 1),
(19, 'The Great Gatsby: Remake', '2026-06-15 15:00:00', 20, 130000, 'Velvet', 'Dolby 7.1', 'Suite 05', NULL, NULL, 1, 0),
(20, 'The Great Gatsby: Remake', '2026-06-15 18:00:00', 20, 130000, 'Velvet', 'Dolby 7.1', 'Suite 06', NULL, NULL, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_tiket`
--
ALTER TABLE `tabel_tiket`
  ADD PRIMARY KEY (`id_tiket`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_tiket`
--
ALTER TABLE `tabel_tiket`
  MODIFY `id_tiket` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
