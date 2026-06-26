-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 26, 2026 at 02:42 AM
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
-- Database: `db_uas_pbo_trpl1a_sofyanapriadhinugroho`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_mahasiswa`
--

CREATE TABLE `tabel_mahasiswa` (
  `id_mahasiswa` int NOT NULL,
  `nama_mahasiswa` varchar(100) NOT NULL,
  `nim` varchar(15) NOT NULL,
  `semester` int NOT NULL,
  `tarif_ukt_nominal` decimal(12,2) NOT NULL,
  `jenis_pembayaran` enum('Mandiri','Bidikmisi','Prestasi') NOT NULL,
  `golongan_ukt` varchar(10) DEFAULT NULL,
  `nama_wali` varchar(100) DEFAULT NULL,
  `nomor_kip_kuliah` varchar(30) DEFAULT NULL,
  `dana_saku_subsidi` decimal(12,2) DEFAULT NULL,
  `nama_instansi_beasiswa` varchar(100) DEFAULT NULL,
  `minimal_ipk_syarat` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_mahasiswa`
--

INSERT INTO `tabel_mahasiswa` (`id_mahasiswa`, `nama_mahasiswa`, `nim`, `semester`, `tarif_ukt_nominal`, `jenis_pembayaran`, `golongan_ukt`, `nama_wali`, `nomor_kip_kuliah`, `dana_saku_subsidi`, `nama_instansi_beasiswa`, `minimal_ipk_syarat`) VALUES
(1, 'Ahmad Fauzi', '231001', 4, '4500000.00', 'Mandiri', 'UKT 4', 'Slamet Riyadi', NULL, NULL, NULL, NULL),
(2, 'Budi Santoso', '231002', 4, '5500000.00', 'Mandiri', 'UKT 5', 'Sutrisno', NULL, NULL, NULL, NULL),
(3, 'Citra Lestari', '231003', 2, '3500000.00', 'Mandiri', 'UKT 3', 'Suyatmi', NULL, NULL, NULL, NULL),
(4, 'Dewi Anggraini', '231004', 6, '6500000.00', 'Mandiri', 'UKT 6', 'Sugeng', NULL, NULL, NULL, NULL),
(5, 'Eko Prasetyo', '231005', 8, '7500000.00', 'Mandiri', 'UKT 7', 'Hartono', NULL, NULL, NULL, NULL),
(6, 'Fajar Nugroho', '231006', 2, '2500000.00', 'Mandiri', 'UKT 2', 'Sunarto', NULL, NULL, NULL, NULL),
(7, 'Gina Maharani', '231007', 4, '1500000.00', 'Mandiri', 'UKT 1', 'Suhardi', NULL, NULL, NULL, NULL),
(8, 'Hendra Saputra', '231008', 6, '4500000.00', 'Mandiri', 'UKT 4', 'Widodo', NULL, NULL, NULL, NULL),
(9, 'Intan Permata', '231009', 2, '0.00', 'Bidikmisi', NULL, NULL, 'KIP001', '700000.00', NULL, NULL),
(10, 'Joko Susilo', '231010', 4, '0.00', 'Bidikmisi', NULL, NULL, 'KIP002', '700000.00', NULL, NULL),
(11, 'Kartika Sari', '231011', 6, '0.00', 'Bidikmisi', NULL, NULL, 'KIP003', '700000.00', NULL, NULL),
(12, 'Lukman Hakim', '231012', 8, '0.00', 'Bidikmisi', NULL, NULL, 'KIP004', '700000.00', NULL, NULL),
(13, 'Maya Putri', '231013', 2, '0.00', 'Bidikmisi', NULL, NULL, 'KIP005', '700000.00', NULL, NULL),
(14, 'Nanda Prakoso', '231014', 4, '0.00', 'Bidikmisi', NULL, NULL, 'KIP006', '700000.00', NULL, NULL),
(15, 'Olivia Putri', '231015', 2, '0.00', 'Prestasi', NULL, NULL, NULL, NULL, 'Bank Indonesia', '3.50'),
(16, 'Putra Ramadhan', '231016', 4, '0.00', 'Prestasi', NULL, NULL, NULL, NULL, 'Djarum Foundation', '3.60'),
(17, 'Qori Aulia', '231017', 6, '0.00', 'Prestasi', NULL, NULL, NULL, NULL, 'Pertamina', '3.50'),
(18, 'Rina Oktaviani', '231018', 8, '0.00', 'Prestasi', NULL, NULL, NULL, NULL, 'Telkom Indonesia', '3.75'),
(19, 'Satria Wijaya', '231019', 4, '0.00', 'Prestasi', NULL, NULL, NULL, NULL, 'PLN', '3.40'),
(20, 'Tania Maharani', '231020', 2, '0.00', 'Prestasi', NULL, NULL, NULL, NULL, 'BRI', '3.50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_mahasiswa`
--
ALTER TABLE `tabel_mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_mahasiswa`
--
ALTER TABLE `tabel_mahasiswa`
  MODIFY `id_mahasiswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
