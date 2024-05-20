-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2024 at 07:51 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms`
--

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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `IDNo`, `section`, `role`, `password`, `created_at`) VALUES
(1, 'Justine Christ Cabornay', 'Admin-01', '', 'admin', '$2y$10$ZR0Un6m.GUnzxvIhz2/QZe.m50EiWLXWRp1jHvg2sfgtOg5eQu78u', '2024-05-20 00:25:17'),
(2, 'test', 'test', '', 'admin', '$2y$10$G/AjiZ4sW6bDvJzHzUNHueLnI6oLBxGhnMtRlsB80xPEx4BBlTg/K', '2024-05-20 01:08:04'),
(3, 'Kamisato Ayaka', 'STD-01', '4-G', 'student', '$2y$10$JUauB.NAdkLpSrRlQ9IITuW5jtN4AkVKuIDfoCChyX.30ZOgeYpp.', '2024-05-20 01:14:44'),
(4, 'Lisa Minci', 'INST-039', '4-G', 'instructor', '$2y$10$aD1XFdLyme0PQXy0Zq.Zde6Xamhzh8BLGIZJPW/eX10gZ1r3nW54W', '2024-05-20 01:29:17'),
(5, 'Juan Dela Cruz', 'Juan-1', '4-A', 'instructor', '$2y$10$tr8Y2N4kNbMQHallaxjsT.dsaGpWB46zFgjzhMwSlw75C4pPTBNwa', '2024-05-20 01:29:58'),
(6, 'Jean Gunnhildr', 'STD-02', '4-G', 'student', '$2y$10$vxfjVXwqEfxmz5s9oUVPnegIR9YThKVwQ.yuyNXhrnM3wgCra9mAa', '2024-05-20 05:19:10'),
(7, 'Raiden Ei', 'STD-03', '4-F', 'student', '$2y$10$cv4byV0LMWtcXw3fmdwfAun4C1//EZ9IYQh5l5aqItyIL6HW1L.Mi', '2024-05-20 05:39:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
