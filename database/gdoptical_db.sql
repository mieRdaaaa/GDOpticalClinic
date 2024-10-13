-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2024 at 07:30 PM
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
(1, 'raphyy', '123', 'Ralph Justin Saransate', 'male', '1990-01-01', '123 Main St', '1234567890', 'doctor'),
(2, 'jules', '123', 'Jules Martin Enolva', 'female', '1995-05-15', '456 Elm St', '9876543210', 'secretary'),
(54, 'raphyy12313', '123', 'Ralph Gacal Saransate II', 'male', '2006-08-30', 'Barangay 19 (San Francisco), Laoag City, Ilocos Norte, Region I – Ilocos Region', '1231231', 'doctor'),
(56, '123123', '123123', '1231231', 'male', '2006-08-29', 'Barangay 19 (San Francisco), Laoag City, Ilocos Norte, Region I – Ilocos Region', '1231231', 'doctor'),
(60, '12313132', '123123123', 'ralph 000000000123123', 'male', '2006-08-30', 'Barangay 19 (San Francisco), Laoag City, Ilocos Norte, Region I – Ilocos Region', '12313132', 'secretary');

-- --------------------------------------------------------

--
-- Table structure for table `certificate`
--

CREATE TABLE `certificate` (
  `certificate_id` int(11) NOT NULL,
  `patients_id` int(11) NOT NULL,
  `eye_result_id` int(11) NOT NULL,
  `symptoms` varchar(255) NOT NULL,
  `examination` varchar(255) NOT NULL,
  `recommendation` varchar(255) NOT NULL,
  `license_no` varchar(255) NOT NULL,
  `ptr_no` varchar(255) NOT NULL,
  `osuva` varchar(255) NOT NULL,
  `oduva` varchar(255) NOT NULL,
  `odadd` varchar(255) NOT NULL,
  `osadd` varchar(255) NOT NULL,
  `odbcva` varchar(255) NOT NULL,
  `osbcva` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certificate`
--

INSERT INTO `certificate` (`certificate_id`, `patients_id`, `eye_result_id`, `symptoms`, `examination`, `recommendation`, `license_no`, `ptr_no`, `osuva`, `oduva`, `odadd`, `osadd`, `odbcva`, `osbcva`, `date_added`) VALUES
(26, 3, 1, '', 'd', 'd', '', '', '', '', '', '', '', '', '2024-10-09 15:04:46'),
(27, 3, 1, '', 'dd', 'dasdas', '', '', '', '', '', '', '', '', '2024-10-09 15:05:41'),
(28, 3, 1, '', 'das', 'd', '', '', '', '', '', '', '', '', '2024-10-09 15:06:54'),
(34, 3, 23, '', 'd', 'd', '', '', '', '', '', '', '', '', '2024-10-09 15:34:34'),
(35, 5, 27, '', 'd', 'd', '', '', '', '', '', '', '', '', '2024-10-09 15:57:41'),
(36, 5, 27, 'd', 'd', 'd', '', '', '', '', '', '', '', '', '2024-10-09 16:00:43'),
(37, 5, 14, 'd', 'd', 'd', '', '', '', '', '', '', '', '', '2024-10-09 16:00:54'),
(38, 5, 27, 'd', 'd', 'd', '', '', '', '', '', '', '', '', '2024-10-09 16:01:28'),
(43, 3, 25, 'Dry eyes', 'Visual acuity testa', 'asdas', '', '', 'dasdad', 'asdasd', 'asda', 'asdasd', 'dasdasd', 'asdasd', '2024-10-12 16:37:41'),
(49, 40, 29, 'Dry eyes', 'Visual acuity', 'Schedule a follow-up appointment in six months.', '', '', '-2.00', '-2.00', '-0.25', '-0.50', '20/25', '20', '2024-10-12 21:15:00');

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
(14, 5, '32', '3', '3', '3', '2', '1', '2', '', '2024-08-15 14:00:14'),
(21, 25, '12', '22', '212', '1212', '121', '1212', '123123', '', '2024-10-05 15:12:45'),
(22, 23, '12', '12', '12', '12', '12', '12', '12', 'farsighted', '2024-10-05 15:15:07'),
(23, 3, '-2.25', '-1.75', '-1', '-0.5', '180', '90', '63.5', 'Mild myopia, regular astigmatism', '2024-10-05 16:16:27'),
(24, 18, '123', '123', '123', '321', '321', '33213', '32', '', '2024-10-07 13:54:05'),
(25, 3, '1', '1', '1', '1', '1', '1', '1', '1', '2024-10-07 14:48:37'),
(26, 26, '-1', '-21.25', '-1', '-1', '-1', '-1', '60', 'Myopic Astigmatism tungod sa kabulok', '2024-10-07 16:03:42'),
(27, 5, '5', '5', '5', '5', '5', '5', '5', '', '2024-10-09 14:38:20'),
(28, 39, '-2', '-1.5', '-0.25', '-0.5', '175', '180', '62', ' Myopia with mild astigmatism', '2024-10-12 16:26:54'),
(29, 40, '-2', '-1.5', '-0.5', '-0.45', '180', '175', '62', 'Mild astigmatism', '2024-10-12 21:11:51');

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
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `medical_history` text DEFAULT NULL,
  `previous_eye_conditions` text DEFAULT NULL,
  `additional_notes` text DEFAULT NULL,
  `allergies` varchar(255) DEFAULT NULL,
  `allergy_specify` varchar(255) DEFAULT NULL,
  `eye_conditions` varchar(255) DEFAULT NULL,
  `eye_conditions_specify` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patients_id`, `first_name`, `last_name`, `middle_name`, `address`, `medication_history`, `date_of_birth`, `gender`, `contact_no`, `date_added`, `medical_history`, `previous_eye_conditions`, `additional_notes`, `allergies`, `allergy_specify`, `eye_conditions`, `eye_conditions_specify`) VALUES
(3, 'Ralph', 'Saransate', 'Justin', '21312312', 'askit', '2006-02-09', 'Male', '09992788911', '2024-08-13 14:38:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Jules Martin', 'Enolva', 'Arcega', 'General Santos City', 'Astigmatism', '2020-01-08', 'Male', '09123489753', '2024-08-13 14:06:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Raphyy', 'SnoopX', 'asdasd', 'asdasd', 'asdasda', '2024-03-14', 'Male', '323131', '2024-09-21 17:57:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'asdasdasda', 'asdasdasd', 'asdasdasdasd', 'asdasdad', 'asdasdasda', '2024-03-04', 'Female', '12312313123', '2024-09-21 20:05:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'testtest', 'testtest', 'testv', 'testtest', 'testtest', '2024-03-22', 'Female', '3123123123', '2024-09-26 17:10:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'testtest', 'testtesttesttest', 'test', 'test', 'test', '2024-03-05', 'Male', '12312312', '2024-09-26 17:11:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'John', 'Doe', 'A', '123 Main St', 'Prescribed glasses for myopia', '1985-05-10', 'Male', '09123456789', '2024-10-05 02:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'Jane', 'Smith', 'B', '456 Elm St', 'Glaucoma treatment', '1990-03-15', 'Female', '09198765432', '2024-10-05 02:10:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'Alice', 'Johnson', 'C', '789 Oak St', 'Contact lenses for astigmatism', '1992-12-20', 'Female', '09112345678', '2024-10-05 02:20:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Bob', 'Williams', 'D', '321 Pine St', 'Cataract surgery follow-up', '1975-08-22', 'Male', '09187654321', '2024-10-05 02:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'Chris', 'Brown', 'E', '654 Cedar St', 'Dry eye syndrome treatment', '2000-01-01', 'Male', '09156473829', '2024-10-05 02:40:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'Emily', 'Davis', 'F', '987 Birch St', 'LASIK surgery consultation', '1988-06-18', 'Female', '09187639201', '2024-10-05 02:50:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'Michael', 'Martinez', 'G', '432 Spruce St', 'Prescribed bifocal lenses', '1995-09-30', 'Male', '09120987654', '2024-10-05 03:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'Olivia', 'Garcia', 'H', '165 Maple St', 'Macular degeneration treatment', '1982-04-25', 'Female', '09187654320', '2024-10-05 03:10:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'Sophia', 'Rodriguez', 'I', '345 Walnut St', 'Prescribed anti-glare lenses', '1979-07-14', 'Female', '09129876543', '2024-10-05 03:20:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'Liam', 'Hernandez', 'J', '879 Chestnut St', 'Routine eye exam', '1997-11-05', 'Male', '09182347659', '2024-10-05 03:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'Mason', 'Lopez', 'K', '341 Aspen St', 'Prescribed glasses for hyperopia', '1983-02-17', 'Male', '09145372619', '2024-10-05 03:40:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'Isabella', 'Gonzalez', 'L', '678 Hickory St', 'Keratoconus treatment', '1999-12-12', 'Female', '09154273819', '2024-10-05 03:50:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'Jacob', 'Wilson', 'M', '459 Redwood St', 'Eye drops for conjunctivitis', '2001-07-19', 'Male', '09112345678', '2024-10-05 04:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'Ethan', 'Anderson', '', '891 Birchwood St', 'Scleral lenses for keratoconus', '1990-09-14', 'Male', '09163482901', '2024-10-08 16:51:05', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 'Charlotte', 'Thomas', 'O', '253 Oakwood St', 'Routine contact lens check', '1996-11-22', 'Female', '09174392814', '2024-10-05 04:20:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 'Ava', 'Jackson', 'P', '725 Willow St', 'Eye strain from computer use', '1988-04-30', 'Female', '09193284356', '2024-10-05 04:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 'James', 'White', 'Q', '908 Cedarwood St', 'Glasses for presbyopia', '1983-07-21', 'Male', '09192837465', '2024-10-05 04:40:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 'Amelia', 'Harris', 'R', '316 Oak St', 'Retinal detachment follow-up', '1992-03-03', 'Female', '09183729456', '2024-10-05 04:50:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 'Benjamin', 'Clark', 'S', '527 Maple St', 'Floaters and flashes check', '1977-12-18', 'Male', '09192387456', '2024-10-05 05:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'Mia', 'Lewis', 'T', '823 Walnut St', 'Corneal abrasion treatment', '2002-05-14', 'Female', '09173824567', '2024-10-05 05:10:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 'Lucas', 'Walker', 'U', '314 Birchwood St', 'Glasses for photophobia', '1995-08-28', 'Male', '09184736291', '2024-10-05 05:20:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 'Harper', 'Young', 'V', '671 Oakwood St', 'Dry eyes from contact lens use', '1987-09-09', 'Female', '09184372856', '2024-10-05 05:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 'Elijah', 'King', 'W', '233 Chestnut St', 'Routine vision check', '2000-11-23', 'Male', '09183749281', '2024-10-05 05:40:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 'Abigail', 'Scott', 'X', '819 Spruce St', 'Eye irritation from allergies', '1998-06-01', 'Female', '09183472846', '2024-10-05 05:50:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 'Henry', 'Hall', 'Y', '162 Maplewood St', 'Retinal exam for diabetes', '1985-10-14', 'Male', '09184629174', '2024-10-05 06:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 'Sinatra', 'Mooda', 'Subroza', 'Barangay 5 (San Vicente), Laoag City, Ilocos Norte, Region I – Ilocos Region', 'Medication: Metformin\r\nDosage: 500 mg\r\nFrequency: Twice daily\r\nStart Date: March 1, 2020\r\nEnd Date: Ongoing\r\nReason for Use: Type 2 Diabetes', '2002-07-11', 'Male', '0999927889', '2024-10-12 15:31:54', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 'Razzie', 'Binx', '', 'Barangay 1 (Calabaza), Laoag City, Ilocos Norte, Region I – Ilocos Region', 'Glaucoma', '2024-04-03', 'Male', '09999278894', '2024-10-12 15:40:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 'Chito', 'Miranda', '', 'Brgy. Asipulo, Adams, Ilocos Norte, Region I – Ilocos Region', '', '2024-04-04', 'Male', '09999278894', '2024-10-12 20:51:00', NULL, NULL, 'Experiences occasional dry eyes, currently using over-the-counter lubricating drops.', 'Yes', 'Penicillin', 'Yes', 'Lasik surgery in 2020, cataracts in 2018');

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
-- Indexes for table `certificate`
--
ALTER TABLE `certificate`
  ADD PRIMARY KEY (`certificate_id`),
  ADD KEY `patients_id` (`patients_id`),
  ADD KEY `eye_result_id` (`eye_result_id`);

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
  MODIFY `accounts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `certificate`
--
ALTER TABLE `certificate`
  MODIFY `certificate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `eye_result`
--
ALTER TABLE `eye_result`
  MODIFY `eye_result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patients_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `certificate`
--
ALTER TABLE `certificate`
  ADD CONSTRAINT `certificate_ibfk_3` FOREIGN KEY (`patients_id`) REFERENCES `patients` (`patients_id`),
  ADD CONSTRAINT `certificate_ibfk_4` FOREIGN KEY (`eye_result_id`) REFERENCES `eye_result` (`eye_result_id`);

--
-- Constraints for table `eye_result`
--
ALTER TABLE `eye_result`
  ADD CONSTRAINT `eye_result_ibfk_1` FOREIGN KEY (`patients_id`) REFERENCES `patients` (`patients_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
