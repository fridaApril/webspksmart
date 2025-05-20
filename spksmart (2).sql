-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2025 at 08:39 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spksmart`
--
CREATE DATABASE IF NOT EXISTS `spksmart` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `spksmart`;

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `nama_alternatif` varchar(10) NOT NULL,
  `merk_susu` varchar(100) DEFAULT NULL,
  `usia` varchar(10) NOT NULL,
  `kandungan_nutrisi` varchar(50) DEFAULT NULL,
  `kandungan_kalsium` varchar(50) DEFAULT NULL,
  `kandungan_gula` varchar(50) DEFAULT NULL,
  `kandungan_protein` varchar(50) DEFAULT NULL,
  `kandungan_lemak` varchar(50) DEFAULT NULL,
  `harga` varchar(100) DEFAULT NULL,
  `rasa` varchar(100) DEFAULT NULL,
  `ketersediaan_produk` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `nama_alternatif`, `merk_susu`, `usia`, `kandungan_nutrisi`, `kandungan_kalsium`, `kandungan_gula`, `kandungan_protein`, `kandungan_lemak`, `harga`, `rasa`, `ketersediaan_produk`) VALUES
(1, 'A1', 'Anline Gold Plus', '51', 'Vitamin D, Magnesium, dan Zinc', '500', 'Rendah', '6', '3', '100.000/150.000', 'Vanilla dan Cokelat', 'Sangat Tersedia'),
(2, 'A2', 'Ensure Gold HMB', '50', 'Vitamin K, Omega-3, Vitamin D', '500', 'Sedang', '8', '7', '296.000', 'Vanilla', 'Cukup Tersedia'),
(3, 'A3', 'Appeton 60 Plus', '60', 'Kalsium, fosfor dan multivitamin', '800', 'Sedang', '7', '8', '248.000/466.800', 'Vanilla dan Cokelat', 'Terbatas'),
(4, 'A4', 'Entrasol Platinum', '51', 'Kaya Kalsium, Fitokal dan Vitamin D', '600', 'Rendah', '5', '5', '109.000', 'Vanilla', 'Sangat Tersedia'),
(5, 'A5', 'Nestle Boost Optimum', '50', 'Vitamin D dan Kalsium', '500', 'Rendah', '11', '6', '150.000/200.000', 'Vanilla', 'Cukup Tersedia'),
(6, 'A6', 'Hilo Gold', '51', 'Vitamin D', '500', 'Rendah', '6', '3', '90.000/120.000', 'Vanilla dan Cokelat', 'Sangat Tersedia'),
(7, 'A7', 'Prosteo Plus', '50', 'Vitamin D dan Prebiotk', '500', 'Rendah', '7', '4', '130.000/180.000', 'Vanilla dan Cokelat', 'Cukup Tersedia'),
(8, 'A8', 'Vidoran Xmart Active', '51', 'Kalsium, Fosfor dan Vitamin D', '400', 'Rendah', '6', '4', '80.000/110.000', 'Cokelat', 'Sangat Tersedia'),
(9, 'A9', 'Frisian Flag Kompleta', '51', 'Kalsium dan Vitamin D', '400', 'Sedang', '6', '5', '60.000/90.000', 'Original (plain)', 'Sangat Tersedia'),
(10, 'A10', 'Boneeto Adult Milk', '51', 'Kalsium dan Vitamin D', '500', 'Sedang', '6', '5', '50.000/Rp.70.000', 'Vanilla', 'Sangat Tersedia'),
(11, 'A11', 'Etawaku', '51', 'Vitamin A, Vitamin C, Vitamin D, Zat Besi dan Magn', '134', 'Rendah', '3,6', '4,1', '85.000/258.000', 'Original', 'Cukup Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id` int(11) NOT NULL,
  `alternatif` varchar(10) DEFAULT NULL,
  `C1` float DEFAULT NULL,
  `C2` float DEFAULT NULL,
  `C3` float DEFAULT NULL,
  `C4` float DEFAULT NULL,
  `C5` float DEFAULT NULL,
  `C6` float DEFAULT NULL,
  `C7` float DEFAULT NULL,
  `C8` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id`, `alternatif`, `C1`, `C2`, `C3`, `C4`, `C5`, `C6`, `C7`, `C8`) VALUES
(1, 'A1', 100, 100, 100, 0, 100, 50, 0, 100),
(2, 'A2', 100, 100, 0, 0, 0, 0, 0, 66.67),
(3, 'A3', 100, 100, 0, 0, 0, 0, 0, 0),
(4, 'A4', 0, 100, 100, 0, 40, 33.33, 0, 100),
(5, 'A5', 100, 100, 100, 100, 0, 33.33, 0, 66.67),
(6, 'A6', 100, 100, 100, 0, 100, 33.33, 0, 100),
(7, 'A7', 100, 100, 100, 0, 40, 66.67, 0, 0),
(8, 'A8', 100, 0, 100, 0, 40, 66.67, 0, 100),
(9, 'A9', 100, 0, 0, 0, 40, 66.67, 100, 100),
(10, 'A10', 100, 100, 0, 0, 40, 100, 0, 100),
(11, 'A11', 100, 100, 100, 0, 100, 66.67, 0, 100);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(10) NOT NULL,
  `kriteria` varchar(11) NOT NULL,
  `nama_kriteria` text NOT NULL,
  `bobot` varchar(10) NOT NULL,
  `normalisasi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id`, `kriteria`, `nama_kriteria`, `bobot`, `normalisasi`) VALUES
(1, 'C1', 'Kandungan Nutrisi', '20.00', '0.20'),
(2, 'C2', 'Kandungan kalsium', '25.00', '0.25'),
(3, 'C3', 'Kandungan Gula', '15.00', '0.15'),
(4, 'C4', 'Kandungan protein', '15.00', '0.15'),
(5, 'C5', 'Kandungan Lemak', '10.00', '0.10'),
(6, 'C6', 'Harga', '5.00', '0.05'),
(7, 'C7', 'Rasa', '5.00', '0.05'),
(8, 'C8', 'Ketersediaan Produk', '5.00', '0.05');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` int(11) NOT NULL,
  `alternatif` varchar(10) DEFAULT NULL,
  `C1` int(11) DEFAULT NULL,
  `C2` int(11) DEFAULT NULL,
  `C3` int(11) DEFAULT NULL,
  `C4` int(11) DEFAULT NULL,
  `C5` int(11) DEFAULT NULL,
  `C6` int(11) DEFAULT NULL,
  `C7` int(11) DEFAULT NULL,
  `C8` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `alternatif`, `C1`, `C2`, `C3`, `C4`, `C5`, `C6`, `C7`, `C8`) VALUES
(1, 'A1', 100, 100, 80, 80, 100, 60, 90, 100),
(2, 'A2', 100, 100, 60, 80, 50, 40, 90, 90),
(3, 'A3', 100, 100, 60, 80, 50, 40, 90, 70),
(4, 'A4', 80, 100, 80, 80, 70, 60, 90, 100),
(5, 'A5', 100, 100, 80, 100, 50, 60, 90, 90),
(6, 'A6', 100, 100, 80, 80, 100, 60, 90, 100),
(7, 'A7', 100, 100, 80, 80, 70, 80, 90, 90),
(8, 'A8', 100, 90, 80, 80, 70, 80, 90, 100),
(9, 'A9', 100, 90, 60, 80, 70, 80, 100, 100),
(10, 'A10', 100, 100, 60, 80, 70, 100, 90, 100),
(11, 'A11', 100, 100, 80, 80, 100, 80, 90, 100);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_batas`
--

CREATE TABLE `nilai_batas` (
  `id` int(11) NOT NULL,
  `alternatif` varchar(10) DEFAULT NULL,
  `kriteria` varchar(10) DEFAULT NULL,
  `nilai_min` int(11) DEFAULT NULL,
  `nilai_max` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai_batas`
--

INSERT INTO `nilai_batas` (`id`, `alternatif`, `kriteria`, `nilai_min`, `nilai_max`) VALUES
(1, 'A1', 'C1', 60, 100),
(2, 'A1', 'C2', 90, 100),
(3, 'A1', 'C3', 60, 80),
(4, 'A1', 'C4', 80, 100),
(5, 'A1', 'C5', 50, 100),
(6, 'A1', 'C6', 40, 80),
(7, 'A1', 'C7', 90, 100),
(8, 'A1', 'C8', 70, 100),
(9, 'A2', 'C1', 80, 100),
(10, 'A2', 'C2', 90, 100),
(11, 'A2', 'C3', 60, 80),
(12, 'A2', 'C4', 80, 100),
(13, 'A2', 'C5', 50, 100),
(14, 'A2', 'C6', 40, 80),
(15, 'A2', 'C7', 90, 100),
(16, 'A2', 'C8', 70, 100),
(17, 'A3', 'C1', 80, 100),
(18, 'A3', 'C2', 90, 100),
(19, 'A3', 'C3', 60, 80),
(20, 'A3', 'C4', 80, 100),
(21, 'A3', 'C5', 50, 100),
(22, 'A3', 'C6', 40, 100),
(23, 'A3', 'C7', 90, 100),
(24, 'A3', 'C8', 70, 100),
(25, 'A4', 'C1', 80, 100),
(26, 'A4', 'C2', 90, 100),
(27, 'A4', 'C3', 60, 80),
(28, 'A4', 'C4', 80, 100),
(29, 'A4', 'C5', 50, 100),
(30, 'A4', 'C6', 40, 100),
(31, 'A4', 'C7', 90, 100),
(32, 'A4', 'C8', 70, 100),
(33, 'A5', 'C1', 80, 100),
(34, 'A5', 'C2', 90, 100),
(35, 'A5', 'C3', 60, 80),
(36, 'A5', 'C4', 80, 100),
(37, 'A5', 'C5', 50, 100),
(38, 'A5', 'C6', 40, 100),
(39, 'A5', 'C7', 90, 100),
(40, 'A5', 'C8', 70, 100),
(41, 'A6', 'C1', 80, 100),
(42, 'A6', 'C2', 90, 100),
(43, 'A6', 'C3', 60, 80),
(44, 'A6', 'C4', 80, 100),
(45, 'A6', 'C5', 50, 100),
(46, 'A6', 'C6', 40, 100),
(47, 'A6', 'C7', 90, 100),
(48, 'A6', 'C8', 70, 100),
(49, 'A7', 'C1', 80, 100),
(50, 'A7', 'C2', 90, 100),
(51, 'A7', 'C3', 60, 80),
(52, 'A7', 'C4', 80, 100),
(53, 'A7', 'C5', 50, 100),
(54, 'A7', 'C6', 40, 100),
(55, 'A7', 'C7', 90, 100),
(56, 'A7', 'C8', 90, 100),
(57, 'A8', 'C1', 80, 100),
(58, 'A8', 'C2', 90, 100),
(59, 'A8', 'C3', 60, 80),
(60, 'A8', 'C4', 80, 100),
(61, 'A8', 'C5', 50, 100),
(62, 'A8', 'C6', 40, 100),
(63, 'A8', 'C7', 90, 100),
(64, 'A8', 'C8', 70, 100),
(65, 'A9', 'C1', 80, 100),
(66, 'A9', 'C2', 90, 100),
(67, 'A9', 'C3', 60, 80),
(68, 'A9', 'C4', 80, 100),
(69, 'A9', 'C5', 50, 100),
(70, 'A9', 'C6', 40, 100),
(71, 'A9', 'C7', 90, 100),
(72, 'A9', 'C8', 70, 100),
(73, 'A10', 'C1', 80, 100),
(74, 'A10', 'C2', 90, 100),
(75, 'A10', 'C3', 60, 80),
(76, 'A10', 'C4', 80, 100),
(77, 'A10', 'C5', 50, 100),
(78, 'A10', 'C6', 40, 100),
(79, 'A10', 'C7', 90, 100),
(80, 'A10', 'C8', 70, 100),
(81, 'A11', 'C1', 70, 100),
(82, 'A11', 'C2', 90, 100),
(83, 'A11', 'C3', 60, 80),
(84, 'A11', 'C4', 80, 100),
(85, 'A11', 'C5', 50, 100),
(86, 'A11', 'C6', 40, 100),
(87, 'A11', 'C7', 90, 100),
(88, 'A11', 'C8', 70, 100);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `user_type`) VALUES
(2, 'User', 'user', 'user', 'user'),
(4, 'frida', 'frida', 'frida', 'user'),
(5, 'admin', 'admin', 'admin', 'admin'),
(6, 'april', 'april', 'april', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_batas`
--
ALTER TABLE `nilai_batas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `nilai_batas`
--
ALTER TABLE `nilai_batas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
