-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2022 at 05:02 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_hc`
--

-- --------------------------------------------------------

--
-- Table structure for table `leader`
--

CREATE TABLE `leader` (
  `id` int(11) NOT NULL,
  `leader_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `profile_picture` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leader`
--

INSERT INTO `leader` (`id`, `leader_name`, `email`, `profile_picture`) VALUES
(1, 'Indra Setiawan', 'indra.setiawan@gmail.com', 'indraSetiawan.jpg'),
(2, 'Hilman Syahputra', 'hilman.syah@gmail.com', 'hilmanSyah.jpg'),
(3, 'Febri Gunawan', 'febri.gunawan@gmail.com', 'febriGun.jpg'),
(4, 'Handoko Aji', 'handoko.Aji@gmail.com', 'handokoAji.jpg'),
(5, 'Nirina Aini', 'niraini@gmail.com', 'niraini.jpg'),
(6, 'Cakra Andi', 'cakrandi@gmail.com', 'cakrandi.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `monitoring`
--

CREATE TABLE `monitoring` (
  `id` int(11) NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `leader_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `progress` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `monitoring`
--

INSERT INTO `monitoring` (`id`, `project_name`, `client_name`, `leader_id`, `start_date`, `end_date`, `progress`) VALUES
(6, ' Pembuatan SI Keuangan', 'Bakeuda Prov. Kalsel', 1, '2022-01-14', '2022-08-14', 0.35),
(7, ' Learning Management System', 'Ruang Guru', 2, '2022-01-30', '2022-04-10', 0.5),
(8, ' SI Pendaftaran Atlet Daerah', 'Dispora Jawa Timur', 3, '2022-02-02', '2022-05-30', 0.8),
(9, ' Employee Monitoring', 'PT Bina Sarana Sukses', 4, '2021-09-02', '2022-01-15', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `leader`
--
ALTER TABLE `leader`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monitoring`
--
ALTER TABLE `monitoring`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk1` (`leader_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `leader`
--
ALTER TABLE `leader`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `monitoring`
--
ALTER TABLE `monitoring`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `monitoring`
--
ALTER TABLE `monitoring`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`leader_id`) REFERENCES `leader` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
