-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2024 at 01:34 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `strv`
--

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `first_semester_grade` decimal(5,2) NOT NULL,
  `second_semester_grade` decimal(5,2) NOT NULL,
  `final_grade` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `instructor_id`, `student_id`, `year`, `subject`, `first_semester_grade`, `second_semester_grade`, `final_grade`) VALUES
(1, 11, 10, 1, 'Math', 85.00, 87.00, 86.00),
(2, 12, 10, 1, 'HughieTestSubject', 82.00, 86.00, 84.00),
(3, 13, 10, 2, 'WilburTestSubject', 88.00, 90.00, 89.00),
(4, 11, 3, 1, 'Literature', 90.00, 88.00, 89.00),
(5, 12, 3, 1, 'HughieTestSubject', 85.00, 83.00, 84.00),
(6, 13, 3, 1, 'Social Studies', 119.00, 83.00, 84.50),
(7, 11, 6, 2, 'VeraTestSubject', 90.00, 90.00, 91.00),
(8, 12, 6, 2, 'HughieTestSubject', 91.00, 92.00, 91.50),
(10, 11, 7, 2, 'VeraTestSubject', 88.00, 85.00, 86.50),
(11, 12, 7, 2, 'HughieTestSubject', 85.00, 87.00, 86.00),
(12, 13, 7, 2, 'HughieTestSubject', 83.00, 84.00, 83.50),
(13, 11, 10, 2, 'Math', 82.00, 85.00, 83.50),
(14, 12, 10, 3, 'Physics', 79.00, 84.00, 81.50),
(15, 13, 10, 3, 'Chemistry', 85.00, 88.00, 86.50),
(16, 11, 3, 2, 'VeraTestSubject', 88.00, 86.00, 86.50),
(17, 12, 3, 2, 'Geography', 82.00, 85.00, 83.50),
(19, 11, 6, 2, 'Art', 89.00, 91.00, 90.00),
(20, 12, 6, 2, 'Music', 90.00, 93.00, 91.50),
(21, 13, 6, 2, 'Physical Education', 99.00, 88.00, 86.50),
(22, 11, 7, 2, 'Computer Science', 87.00, 86.00, 86.50),
(23, 12, 7, 2, 'Economics', 84.00, 87.00, 85.50),
(24, 13, 7, 2, 'Foreign Language', 82.00, 85.00, 83.50),
(55, 4, 14, 1, 'LisaTestSubject', 81.00, 82.00, 83.00),
(56, 4, 3, 2, 'LisaTestSubject', 90.00, 90.00, 90.00),
(57, 4, 17, 3, 'LisaTestSubject', 80.00, 80.00, 80.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `IDNo` varchar(50) NOT NULL,
  `section` varchar(15) NOT NULL,
  `role` enum('student','instructor','admin') NOT NULL,
  `password` varchar(255) NOT NULL,
  `imgPath` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `IDNo`, `section`, `role`, `password`, `imgPath`, `created_at`) VALUES
(1, 'Justine Christ Cabornay', 'Admin-01', '', 'admin', '$2y$10$ZR0Un6m.GUnzxvIhz2/QZe.m50EiWLXWRp1jHvg2sfgtOg5eQu78u', '', '2024-05-20 00:25:17'),
(3, 'Kamisato Ayaka', 'STD-01', '4-G', 'student', '$2y$10$JUauB.NAdkLpSrRlQ9IITuW5jtN4AkVKuIDfoCChyX.30ZOgeYpp.', '', '2024-05-20 01:14:44'),
(4, 'Lisa Minci', 'INST-039', '4-G', 'instructor', '$2y$10$aD1XFdLyme0PQXy0Zq.Zde6Xamhzh8BLGIZJPW/eX10gZ1r3nW54W', '', '2024-05-20 01:29:17'),
(6, 'Jean Gunnhildr', 'STD-02', '4-G', 'student', '$2y$10$vxfjVXwqEfxmz5s9oUVPnegIR9YThKVwQ.yuyNXhrnM3wgCra9mAa', '', '2024-05-20 05:19:10'),
(7, 'Raiden Ei', 'STD-03', '4-F', 'student', '$2y$10$cv4byV0LMWtcXw3fmdwfAun4C1//EZ9IYQh5l5aqItyIL6HW1L.Mi', '', '2024-05-20 05:39:50'),
(8, 'Marc Cags', 'Marc-01', '4-F', 'student', '$2y$10$pxFcKxAX9RaVzmlw4s5C9.PpzIAymov2OOdgDW60LebI4gURiQoFG', '', '2024-05-20 13:16:14'),
(10, 'tryRemove', 'test', '4-G', 'student', '$2y$10$qAcD6fi9OUkonm1nehFrzODW2SDGfYrKNYKXiDCnw7USFgp/q/PBS', '', '2024-05-27 11:05:02'),
(11, 'Vere Silva', 'INST-040', '4-A', 'instructor', '$2y$10$laUVFftCzZ1DjpiUzW0LfO0x8i4eugwGSBqWHG.YVMiW4CNVdOZxm', '', '2024-05-27 13:05:15'),
(12, 'Hughie Terry', 'INST-041', '4-B', 'instructor', '$2y$10$BAZC3Hur4onrEyKgdIM2re7oHXpBe4fw2SvMxmyBC8.C2GHyekLrS', '', '2024-05-27 13:05:38'),
(13, 'Wilbur Blake', 'INST-042', '5-C', 'instructor', '$2y$10$9fhzDWDhoilVA/KGKf6krOP4QRi1YvYZ5PJS7rWJ3ZYDpXH/nmJHu', '', '2024-05-27 13:05:59'),
(14, 'Marvies', 'STD-04', '1-A', 'student', '$2y$10$YCET4d87IJXy9h7HgLr/5eNO2KTb1sb1zQ8GWi1/SH2QK2or.0xWe', '', '2024-05-27 15:07:24'),
(17, 'Juan Dela Cruz', 'STD-05', '5-G', 'student', '$2y$10$eYC3BFxLWf.2qcy8RVDNXu3o1uduhGaHSL1l8efrdbAtEay5v2Ph.', '', '2024-06-01 11:07:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FOREIGN` (`instructor_id`,`student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
