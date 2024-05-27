-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2024 at 10:32 AM
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
-- Database: `strv`
--

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `grade_int` int(6) NOT NULL,
  `user_id` int(6) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `grade` decimal(5,2) NOT NULL,
  `semester` int(6) NOT NULL,
  `year` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `IDNo`, `section`, `role`, `password`, `imgPath`, `created_at`) VALUES
(1, 'Justine Christ Cabornay', 'Admin-01', '', 'admin', '$2y$10$ZR0Un6m.GUnzxvIhz2/QZe.m50EiWLXWRp1jHvg2sfgtOg5eQu78u', './images/admin/default.jpg', '2024-05-20 00:25:17'),
(2, 'test', 'test', '', 'admin', '$2y$10$G/AjiZ4sW6bDvJzHzUNHueLnI6oLBxGhnMtRlsB80xPEx4BBlTg/K', '', '2024-05-20 01:08:04'),
(3, 'Kamisato Ayaka', 'STD-01', '4-G', 'student', '$2y$10$JUauB.NAdkLpSrRlQ9IITuW5jtN4AkVKuIDfoCChyX.30ZOgeYpp.', '', '2024-05-20 01:14:44'),
(4, 'Lisa Minci', 'INST-039', '4-G', 'instructor', '$2y$10$aD1XFdLyme0PQXy0Zq.Zde6Xamhzh8BLGIZJPW/eX10gZ1r3nW54W', '', '2024-05-20 01:29:17'),
(6, 'Jean Gunnhildr', 'STD-02', '4-G', 'student', '$2y$10$vxfjVXwqEfxmz5s9oUVPnegIR9YThKVwQ.yuyNXhrnM3wgCra9mAa', '', '2024-05-20 05:19:10'),
(7, 'Raiden Ei', 'STD-03', '4-F', 'student', '$2y$10$cv4byV0LMWtcXw3fmdwfAun4C1//EZ9IYQh5l5aqItyIL6HW1L.Mi', '', '2024-05-20 05:39:50'),
(9, 'test1', 'test1', 'test1', 'admin', '$2y$10$kF7eJZDZgtcsqP.fDSDjceRv2q/BgICiRaOuR92f5cE7shrhoLTCO', '', '2024-05-20 13:50:06'),
(10, 'Kirk En', 'STD-04', '1-A', 'student', '$2y$10$zlhXcbzbzx3AbCFu1pmDXuKn4MNjLDHE/OzUpKmhmN63fcUugK1G2', '', '2024-05-27 00:22:54'),
(11, 'Tommie Webb', 'STD-05', '5-F', 'student', '$2y$10$Pap.96sWZ7.iOyMt4wkFFOl7ZvV87SDylBt9hJ7TY26GGxMWvBmJu', '', '2024-05-27 00:25:29'),
(12, 'Lennox Tobb', 'STD-06', '2-C', 'student', '$2y$10$hQZpjfxcbODHIb0TAbNN2uO024VWOLkjLrrhpI3BgSSQZZ5ohDQr.', '', '2024-05-27 00:26:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`grade_int`);

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
  MODIFY `grade_int` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
