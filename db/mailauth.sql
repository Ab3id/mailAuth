-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2023 at 01:56 PM
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
-- Database: `mailauth`
--

-- --------------------------------------------------------

--
-- Table structure for table `otp_auth`
--

CREATE TABLE `otp_auth` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `used` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `otp_auth`
--

INSERT INTO `otp_auth` (`id`, `code`, `user_id`, `used`) VALUES
(1, '1653984347', 1, 0),
(2, '970333519', 1, 1),
(3, '1660085250', 1, 1),
(4, '255215828', 1, 1),
(5, '387234811', 1, 1),
(6, '1977582645', 1, 1),
(7, '1425024769', 1, 1),
(8, '1825675088', 1, 1),
(9, '1726747826', 1, 1),
(10, '1384251193', 1, 1),
(11, '104625245', 1, 1),
(12, '1878526158', 1, 1),
(13, '514796998', 1, 1),
(14, '1526353140', 1, 1),
(15, '820921057', 1, 1),
(16, '517175441', 1, 1),
(17, '2133793663', 1, 1),
(18, '109188737', 1, 1),
(19, '1327821839', 1, 1),
(20, '36634674', 1, 1),
(21, '639950991', 1, 1),
(22, '1123393473', 1, 1),
(23, '399288498', 1, 1),
(24, '793279909', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'Kibamba', 'kiba@gmail.com', '$2b$12$.wBOjWv6uPdLp9Rqm5Rm8Oz4cuDca.Wy5IyUI0bB9FWgIcBnmNqjy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `otp_auth`
--
ALTER TABLE `otp_auth`
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
-- AUTO_INCREMENT for table `otp_auth`
--
ALTER TABLE `otp_auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
