-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2023 at 11:54 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kebon`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_group_sensor`
--

CREATE TABLE `t_group_sensor` (
  `group_id` int(11) NOT NULL,
  `group_name` text NOT NULL,
  `sensor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_group_sensor`
--

INSERT INTO `t_group_sensor` (`group_id`, `group_name`, `sensor_id`) VALUES
(2, 'tomato_g', 1),
(3, 'carrot_g', 1),
(4, 'eggplant_g', 2);

-- --------------------------------------------------------

--
-- Table structure for table `t_sensor`
--

CREATE TABLE `t_sensor` (
  `sensor_id` int(11) NOT NULL,
  `sensor_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_sensor`
--

INSERT INTO `t_sensor` (`sensor_id`, `sensor_name`) VALUES
(1, 'humid'),
(2, 'temp');

-- --------------------------------------------------------

--
-- Table structure for table `t_sensor_v`
--

CREATE TABLE `t_sensor_v` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `humid_v` double NOT NULL,
  `temp_v` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_sensor_v`
--

INSERT INTO `t_sensor_v` (`id`, `group_id`, `humid_v`, `temp_v`) VALUES
(1, 3, 49.21, 25.35),
(2, 3, 79.24, 25.72),
(3, 3, 67.28, 24.72),
(4, 3, 71.23, 25.22),
(5, 4, 66.22, 25.78),
(6, 4, 52.53, 25.35),
(7, 4, 51.24, 25.41);

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `authKey` varchar(11) NOT NULL,
  `accessToken` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`user_id`, `username`, `password`, `authKey`, `accessToken`) VALUES
(1, 'ali', '123123', 'test100key', '100-token'),
(2, 'bay', '123123', 'test101key', '101-token');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_group_sensor`
--
ALTER TABLE `t_group_sensor`
  ADD PRIMARY KEY (`group_id`),
  ADD KEY `sensor_id` (`sensor_id`);

--
-- Indexes for table `t_sensor`
--
ALTER TABLE `t_sensor`
  ADD PRIMARY KEY (`sensor_id`);

--
-- Indexes for table `t_sensor_v`
--
ALTER TABLE `t_sensor_v`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_group` (`group_id`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_group_sensor`
--
ALTER TABLE `t_group_sensor`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_sensor`
--
ALTER TABLE `t_sensor`
  MODIFY `sensor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_sensor_v`
--
ALTER TABLE `t_sensor_v`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_group_sensor`
--
ALTER TABLE `t_group_sensor`
  ADD CONSTRAINT `t_group_sensor_ibfk_1` FOREIGN KEY (`sensor_id`) REFERENCES `t_sensor` (`sensor_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `t_sensor_v`
--
ALTER TABLE `t_sensor_v`
  ADD CONSTRAINT `t_sensor_v_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `t_group_sensor` (`group_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
