-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2024 at 06:43 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gdoptical_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `eye_result`
--

CREATE TABLE `eye_result` (
  `eye_result_id` int(11) NOT NULL,
  `patients_id` int(11) NOT NULL,
  `r_sphere` varchar(255) NOT NULL,
  `l_sphere` varchar(255) NOT NULL,
  `r_cylinder` varchar(255) NOT NULL,
  `l_cylinder` varchar(255) NOT NULL,
  `r_axis` varchar(255) NOT NULL,
  `l_axis` varchar(255) NOT NULL,
  `pd` varchar(255) NOT NULL,
  `diagnosis` varchar(255) DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `other_conditions` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eye_result`
--

INSERT INTO `eye_result` (`eye_result_id`, `patients_id`, `r_sphere`, `l_sphere`, `r_cylinder`, `l_cylinder`, `r_axis`, `l_axis`, `pd`, `diagnosis`, `date_added`, `other_conditions`) VALUES
(1, 3, '123', '123', '321', '123', '312', '321', '123', 'Myopia (Nearsightedness)', '2024-10-05 15:02:01', NULL),
(2, 3, '12', '12', '23', '21', '21', '2', '2', '', '2024-08-15 13:26:37', NULL),
(3, 3, '12', '12', '23', '21', '21', '2', '2', '', '2024-08-15 13:28:25', NULL),
(4, 3, '123', '32', '32', '12', '123', '213', '467', '', '2024-08-15 13:28:38', NULL),
(8, 3, '123', '132', '123', '1', '1', '1', '1', '', '2024-08-15 13:50:59', NULL),
(9, 3, '1', '1', '1', '1', '1', '1', '1', '', '2024-08-15 13:51:14', NULL),
(10, 3, '123', '12', '11', '1', '1', '1', '1', '', '2024-08-15 13:52:12', NULL),
(11, 5, '323', '32', '32', '32', '32', '32', '32', '', '2024-08-15 13:52:35', NULL),
(12, 3, '1', '1', '1', '1', '1', '11', '1', '', '2024-08-15 13:52:41', NULL),
(13, 5, '32', '3', '3', '3', '2', '1', '2', '', '2024-08-15 14:00:08', NULL),
(14, 5, '32', '3', '3', '3', '2', '1', '2', '', '2024-08-15 14:00:14', NULL),
(15, 3, '12', '3', '2332', '12', '321', '321', '321', '', '2024-08-15 14:00:56', NULL),
(16, 3, '123', '132', '312', '312', '12', '123', '321', '', '2024-08-15 14:01:27', NULL),
(17, 3, '2', '3', '3', '5', '7', '6', '4', '', '2024-08-15 14:02:55', NULL),
(18, 3, '2', '3', '5', '3', '21', '24', '53', '', '2024-08-15 14:03:29', NULL),
(19, 3, '1', '2', '3', '4', '5', '6', '6', '', '2024-08-15 14:05:55', NULL),
(20, 3, '12', '23', '42', '42', '42', '42', '42', '', '2024-08-15 14:06:16', NULL),
(21, 25, '12', '22', '212', '1212', '121', '1212', '123123', '', '2024-10-05 15:12:45', NULL),
(22, 23, '12', '12', '12', '12', '12', '12', '12', 'farsighted', '2024-10-05 15:15:07', NULL),
(23, 3, '-2.25', '-1.75', '-1', '-0.5', '180', '90', '63.5', 'Mild myopia, regular astigmatism', '2024-10-05 16:16:27', NULL),
(24, 18, '123', '123', '123', '321', '321', '33213', '32', '', '2024-10-07 13:54:05', NULL),
(25, 3, '1', '1', '1', '1', '1', '1', '1', '1', '2024-10-07 14:48:37', NULL),
(26, 26, '-1', '-21.25', '-1', '-1', '-1', '-1', '60', 'Myopic Astigmatism tungod sa kabulok', '2024-10-07 16:03:42', NULL),
(27, 5, '5', '5', '5', '5', '5', '5', '5', '', '2024-10-09 14:38:20', NULL),
(28, 27, '-1', '-1.25', '-2.5', '-2.5', '180', '180', '64', '', '2024-10-10 00:50:22', NULL),
(29, 26, '3', '2.24', '-1', '-1.25', '180', '180', '65.1', 'Astigmatism', '2024-10-25 05:53:49', NULL),
(30, 42, '-2.5', '-2.25', '-1', '-0.75', '90', '85', '62', 'Myopia with Astigmatism', '2024-11-13 06:00:14', NULL),
(31, 42, '12', '12', '12', '12', '12', '12', '12', 'Cataracts', '2024-11-22 05:20:37', NULL),
(32, 42, '13', '13', '13', '13', '13', '13', '13', NULL, '2024-11-22 05:24:54', NULL),
(33, 42, '12', '12', '121', '12', '1212', '121', '12', NULL, '2024-11-22 05:33:07', 'test'),
(34, 42, '12', '12', '12', '123', '12', '12', '123', 'Presbyopia', '2024-11-22 05:38:46', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eye_result`
--
ALTER TABLE `eye_result`
  ADD PRIMARY KEY (`eye_result_id`),
  ADD KEY `patients_id` (`patients_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eye_result`
--
ALTER TABLE `eye_result`
  MODIFY `eye_result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `eye_result`
--
ALTER TABLE `eye_result`
  ADD CONSTRAINT `eye_result_ibfk_1` FOREIGN KEY (`patients_id`) REFERENCES `patients` (`patients_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
