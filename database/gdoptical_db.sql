-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2024 at 07:52 AM
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
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `accounts_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `birthdate` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `account_type` enum('doctor','secretary') NOT NULL DEFAULT 'secretary'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`accounts_id`, `username`, `password`, `fullname`, `gender`, `birthdate`, `address`, `contact_number`, `account_type`) VALUES
(1, 'raphyy', '123', 'Ralph Justin Saransate', 'male', '2002-12-08', 'Gensanville Subdivision Phase 2 Chapel, Jorge Royeca Boulevard, Bula, General Santos, 9500 Soccsksargen', '09999278895', 'doctor'),
(2, 'jules', '123', 'Jules Martin Enolva', 'female', '1995-05-15', '456 Elm St', '9876543210', 'secretary'),
(54, 'raphyy12313', '123', 'Ralph Gacal Saransate II', 'male', '2006-08-30', 'Barangay 19 (San Francisco), Laoag City, Ilocos Norte, Region I – Ilocos Region', '1231231', 'doctor'),
(56, '123123', '123123', '1231231', 'male', '2006-08-29', 'Barangay 19 (San Francisco), Laoag City, Ilocos Norte, Region I – Ilocos Region', '1231231', 'doctor'),
(59, 'raphyy123123123', '123', 'megrod annette', 'male', '2006-09-13', 'Barangay 19 (San Francisco), Laoag City, Ilocos Norte, Region I – Ilocos Region', '1231231231', 'doctor'),
(60, '12313132', '123123123', 'ralph 000000000123123', 'male', '2006-08-30', 'Barangay 19 (San Francisco), Laoag City, Ilocos Norte, Region I – Ilocos Region', '12313132', 'secretary'),
(62, 'raphyy12315', '123', 'Ralph Gacal Saransate IIX', 'male', '2006-10-05', 'Barangay 9 (San Nicolas), Laoag City, Ilocos Norte, Region I – Ilocos Region', '123123123123', 'doctor'),
(63, 'haha', '123', 'Ralph Gacal Saransate II test', 'male', '2006-10-05', 'Barangay 10 (San Guillermo), Laoag City, Ilocos Norte, Region I – Ilocos Region', '123122312313', 'doctor'),
(65, 'teeeest', '123', 'Ralph Gacal test', 'female', '2006-10-04', 'Barangay 19 (San Francisco), Laoag City, Ilocos Norte, Region I – Ilocos Region', '09999278894123', 'secretary');

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
  `diagnosis` text NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eye_result`
--

INSERT INTO `eye_result` (`eye_result_id`, `patients_id`, `r_sphere`, `l_sphere`, `r_cylinder`, `l_cylinder`, `r_axis`, `l_axis`, `pd`, `diagnosis`, `date_added`) VALUES
(1, 3, '123', '123', '321', '123', '312', '321', '123', 'Myopia (Nearsightedness)', '2024-10-05 15:02:01'),
(2, 3, '12', '12', '23', '21', '21', '2', '2', '', '2024-08-15 13:26:37'),
(3, 3, '12', '12', '23', '21', '21', '2', '2', '', '2024-08-15 13:28:25'),
(4, 3, '123', '32', '32', '12', '123', '213', '467', '', '2024-08-15 13:28:38'),
(5, 3, '1', '1', '1', '1', '1', '1', '1', '', '2024-08-15 13:34:41'),
(6, 5, '1', '1', '1', '1', '1', '1', '1', '', '2024-08-15 13:34:51'),
(7, 5, '2', '2', '2', '2', '2', '2', '2', '', '2024-08-15 13:35:34'),
(8, 3, '123', '132', '123', '1', '1', '1', '1', '', '2024-08-15 13:50:59'),
(9, 3, '1', '1', '1', '1', '1', '1', '1', '', '2024-08-15 13:51:14'),
(10, 3, '123', '12', '11', '1', '1', '1', '1', '', '2024-08-15 13:52:12'),
(11, 5, '323', '32', '32', '32', '32', '32', '32', '', '2024-08-15 13:52:35'),
(12, 3, '1', '1', '1', '1', '1', '11', '1', '', '2024-08-15 13:52:41'),
(13, 5, '32', '3', '3', '3', '2', '1', '2', '', '2024-08-15 14:00:08'),
(14, 5, '32', '3', '3', '3', '2', '1', '2', '', '2024-08-15 14:00:14'),
(15, 3, '12', '3', '2332', '12', '321', '321', '321', '', '2024-08-15 14:00:56'),
(16, 3, '123', '132', '312', '312', '12', '123', '321', '', '2024-08-15 14:01:27'),
(17, 3, '2', '3', '3', '5', '7', '6', '4', '', '2024-08-15 14:02:55'),
(18, 3, '2', '3', '5', '3', '21', '24', '53', '', '2024-08-15 14:03:29'),
(19, 3, '1', '2', '3', '4', '5', '6', '6', '', '2024-08-15 14:05:55'),
(20, 3, '12', '23', '42', '42', '42', '42', '42', '', '2024-08-15 14:06:16'),
(22, 23, '12', '12', '12', '12', '12', '12', '12', 'farsighted', '2024-10-05 15:15:07'),
(23, 3, '-2.25', '-1.75', '-1', '-0.5', '180', '90', '63.5', 'Mild myopia, regular astigmatism', '2024-10-05 16:16:27'),
(24, 15, '-2.25', '-2.25', '-2.25', '-2.25', '-2.25', '-2.25', '154', 'Mild myopia', '2024-10-05 16:26:02'),
(25, 18, '-2.35', '-2.35', '-2.35', '-2.35', '-2.35', '-2.35', '150', 'Farsighted', '2024-10-05 17:23:57'),
(26, 5, '2.45', '-2.45', '2.5', '-2.5', '2.25', '2.25', '160', 'Nearsighted', '2024-10-05 18:38:16'),
(27, 5, '2.25', '2.25', '2.25', '2.25', '-2.25', '-2.25', '180', 'Nearsighted, Astigmatism', '2024-10-05 18:38:52'),
(28, 19, '-2.65', '-2.65', '-2.65', '2.65', '2.65', '2.65', '160', 'Farsighted, Astigmatism', '2024-10-06 05:18:44'),
(29, 19, '2.65', '2.65', '2.65', '2.65', '2.65', '2.65', '180', 'Nearsighted', '2024-10-06 05:19:37'),
(30, 23, '2.25', '2.25', '2.25', '2.25', '-2.25', '-2.55', '160', 'Farsighted', '2024-10-06 05:24:34');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patients_id` int(6) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `medication_history` text DEFAULT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patients_id`, `first_name`, `last_name`, `middle_name`, `address`, `medication_history`, `date_of_birth`, `gender`, `contact_no`, `date_added`) VALUES
(3, 'Ralph', 'Saransate', 'Justin', 'Gensanville Subdivision Phase 2 Chapel, Jorge Royeca Boulevard, Bula, General Santos, 9500 Soccsksargen', 'Latanoprost (Xalatan). - test', '2024-04-04', 'Male', '09999278894', '2024-08-13 14:38:27'),
(5, 'Jules Martin', 'Enolva', 'Arcega', 'General Santos City', 'Astigmatism', '2020-01-08', 'Male', '09123489753', '2024-08-13 14:06:35'),
(6, 'Raphyy', 'SnoopX', 'asdasd', 'asdasd', 'asdasda', '2024-03-14', 'Male', '323131', '2024-09-21 17:57:26'),
(8, 'asdasdasda', 'asdasdasd', 'asdasdasdasd', 'asdasdad', 'asdasdasda', '2024-03-04', 'Female', '12312313123', '2024-09-21 20:05:17'),
(11, 'testtest', 'testtest', 'testv', 'testtest', 'testtest', '2024-03-22', 'Female', '3123123123', '2024-09-26 17:10:50'),
(12, 'testtest', 'testtesttesttest', 'test', 'test', 'test', '2024-03-05', 'Male', '12312312', '2024-09-26 17:11:15'),
(13, 'John', 'Doe', 'A', '123 Main St', 'Prescribed glasses for myopia', '1985-05-10', 'Male', '09123456789', '2024-10-05 02:00:00'),
(14, 'Jane', 'Smith', 'B', '456 Elm St', 'Glaucoma treatment', '1990-03-15', 'Female', '09198765432', '2024-10-05 02:10:00'),
(15, 'Alice', 'Johnson', 'C', '789 Oak St', 'Contact lenses for astigmatism', '1992-12-20', 'Female', '09112345678', '2024-10-05 02:20:00'),
(17, 'Chris', 'Brown', 'E', '654 Cedar St', 'Dry eye syndrome treatment', '2000-01-01', 'Male', '09156473829', '2024-10-05 02:40:00'),
(18, 'Emily', 'Davis', 'F', '987 Birch St', 'LASIK surgery consultation', '1988-06-18', 'Female', '09187639201', '2024-10-05 02:50:00'),
(19, 'Michael', 'Martinez', 'G', '432 Spruce St', 'Prescribed bifocal lenses', '1995-09-30', 'Male', '09120987654', '2024-10-05 03:00:00'),
(23, 'Mason', 'Lopez', 'K', '341 Aspen St', 'Prescribed glasses for hyperopia', '1983-02-17', 'Male', '09145372619', '2024-10-05 03:40:00'),
(24, 'Isabella', 'Gonzalez', 'L', '678 Hickory St GSC', 'Keratoconus treatment', '1999-12-12', 'Female', '09154273819', '2024-10-05 03:50:00'),
(27, 'Charlotte', 'Thomas', 'O', '253 Oakwood St', 'Routine contact lens check', '1996-11-22', 'Female', '09174392814', '2024-10-05 04:20:00'),
(28, 'Ava', 'Jackson', 'P', '725 Willow St', 'Eye strain from computer use', '1988-04-30', 'Female', '09193284356', '2024-10-05 04:30:00'),
(29, 'James', 'White', 'Q', '908 Cedarwood St', 'Glasses for presbyopia', '1983-07-21', 'Male', '09192837465', '2024-10-05 04:40:00'),
(30, 'Amelia', 'Harris', 'R', '316 Oak St', 'Retinal detachment follow-up', '1992-03-03', 'Female', '09183729456', '2024-10-05 04:50:00'),
(31, 'Benjamin', 'Clark', 'S', '527 Maple St', 'Floaters and flashes check', '1977-12-18', 'Male', '09192387456', '2024-10-05 05:00:00'),
(32, 'Mia', 'Lewis', 'T', '823 Walnut St', 'Corneal abrasion treatment', '2002-05-14', 'Female', '09173824567', '2024-10-05 05:10:00'),
(33, 'Lucas', 'Walker', 'U', '314 Birchwood St', 'Glasses for photophobia', '1995-08-28', 'Male', '09184736291', '2024-10-05 05:20:00'),
(34, 'Harper', 'Young', 'V', '671 Oakwood St', 'Dry eyes from contact lens use', '1987-09-09', 'Female', '09184372856', '2024-10-05 05:30:00'),
(35, 'Elijah', 'King', 'W', '233 Chestnut St', 'Routine vision check', '2000-11-23', 'Male', '09183749281', '2024-10-05 05:40:00'),
(36, 'Abigail', 'Scott', 'X', '819 Spruce St', 'Eye irritation from allergies', '1998-06-01', 'Female', '09183472846', '2024-10-05 05:50:00'),
(37, 'Henry', 'Hall', 'Y', '162 Maplewood St', 'Retinal exam for diabetes', '1985-10-14', 'Male', '09184629174', '2024-10-05 06:00:00'),
(39, 'Raphyy', 'YouTuber', 'Million Subs', 'Brgy. Baloctaoc, Batac City, Ilocos Norte, Region I – Ilocos Region', 'Happy 1M subscribers - test', '2020-06-18', 'Male', '09999278897', '2024-10-06 05:48:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`accounts_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `eye_result`
--
ALTER TABLE `eye_result`
  ADD PRIMARY KEY (`eye_result_id`),
  ADD KEY `patients_id` (`patients_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patients_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `accounts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `eye_result`
--
ALTER TABLE `eye_result`
  MODIFY `eye_result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patients_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

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
