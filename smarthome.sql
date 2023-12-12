-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2022 at 05:46 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smarthome`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id`, `nama_barang`) VALUES
(1, 'charger laptop'),
(2, 'setrika');

-- --------------------------------------------------------

--
-- Table structure for table `tb_data`
--

CREATE TABLE `tb_data` (
  `id` int(11) NOT NULL,
  `energy` decimal(10,2) NOT NULL,
  `voltage` decimal(10,2) NOT NULL,
  `current` decimal(10,2) NOT NULL,
  `power` decimal(10,2) NOT NULL,
  `sensor_id` int(11) DEFAULT NULL,
  `barang_id` int(11) NOT NULL,
  `user_id` bigint(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_data`
--

INSERT INTO `tb_data` (`id`, `energy`, `voltage`, `current`, `power`, `sensor_id`, `barang_id`, `user_id`, `date`) VALUES
(14, '10.00', '10.00', '10.00', '10.00', 1, 1, 14, '2022-05-31 21:04:30'),
(15, '20.00', '20.00', '20.00', '20.00', 1, 1, 14, '2022-06-01 21:04:30'),
(16, '10.00', '10.00', '10.00', '10.00', 1, 1, 14, '2022-06-02 21:05:38'),
(17, '20.00', '20.00', '20.00', '20.00', 1, 1, 14, '2022-06-03 21:05:38'),
(18, '10.00', '10.00', '10.00', '10.00', 1, 1, 14, '2022-06-04 21:06:21'),
(19, '10.00', '10.00', '10.00', '10.00', 1, 1, 14, '2022-06-11 21:06:56'),
(20, '20.00', '20.00', '20.00', '20.00', 1, 1, 14, '2022-06-18 21:06:56'),
(21, '10.00', '10.00', '10.00', '10.00', 1, 1, 14, '2022-06-30 21:07:44'),
(22, '10.00', '10.00', '10.00', '10.00', 2, 2, 14, '2022-06-01 13:01:45');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sensor`
--

CREATE TABLE `tb_sensor` (
  `id` int(11) NOT NULL,
  `mac_address` varchar(100) NOT NULL,
  `user_id` bigint(11) NOT NULL,
  `barang_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_sensor`
--

INSERT INTO `tb_sensor` (`id`, `mac_address`, `user_id`, `barang_id`) VALUES
(1, '98:CD:AC:26:21:76', 14, 1),
(2, 'C4:5B:BE:63:0B:40', 14, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `avatar` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `nama`, `email`, `password`, `avatar`) VALUES
(14, 'Fashan Saraya', 'fashan@undiksha.ac.id', '$2y$10$WTIJ6BQ1g9.o2gDuCqeGkee4j37QiDsyz8f3wKoR4kpJcQY3yj0R.', NULL),
(22, 'Ayu Intan Galby Catriesya', 'ayu@undiksha.ac.id', '$2y$10$5h2CHGoDP/ZyyXpse8RwPOhL./CD2VFntkWTNr0RRFHB6/EKZYL..', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_data`
--
ALTER TABLE `tb_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_data_ibfk_1` (`barang_id`),
  ADD KEY `tb_data_ibfk_2` (`sensor_id`),
  ADD KEY `tb_data_ibfk_3` (`user_id`);

--
-- Indexes for table `tb_sensor`
--
ALTER TABLE `tb_sensor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_sensor_ibfk_1` (`barang_id`),
  ADD KEY `tb_sensor_ibfk_3` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_data`
--
ALTER TABLE `tb_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_sensor`
--
ALTER TABLE `tb_sensor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_data`
--
ALTER TABLE `tb_data`
  ADD CONSTRAINT `tb_data_ibfk_1` FOREIGN KEY (`barang_id`) REFERENCES `tb_barang` (`id`),
  ADD CONSTRAINT `tb_data_ibfk_2` FOREIGN KEY (`sensor_id`) REFERENCES `tb_sensor` (`id`),
  ADD CONSTRAINT `tb_data_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `tb_sensor`
--
ALTER TABLE `tb_sensor`
  ADD CONSTRAINT `tb_sensor_ibfk_1` FOREIGN KEY (`barang_id`) REFERENCES `tb_barang` (`id`),
  ADD CONSTRAINT `tb_sensor_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `tb_sensor_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
