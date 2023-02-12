-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2023 at 01:07 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`) VALUES
(1, 'user'),
(2, 'role'),
(3, 'customer'),
(4, 'supplier'),
(5, 'product'),
(6, '(export csv/export excel/print/pdf)buttons on tables');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `feature_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `feature_id`) VALUES
(1, 'view', 1),
(2, 'create', 1),
(3, 'edit', 1),
(4, 'delete', 1),
(5, 'view', 2),
(6, 'create', 2),
(7, 'edit', 2),
(8, 'delete', 2),
(9, 'view', 3),
(10, 'create', 3),
(11, 'edit', 3),
(12, 'delete', 3),
(13, 'view', 4),
(14, 'create', 4),
(15, 'edit', 4),
(16, 'delete', 4),
(17, 'view', 5),
(18, 'create', 5),
(19, 'edit', 5),
(20, 'delete', 5),
(21, 'view', 6);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Default Administrator'),
(15, 'Staff'),
(16, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permissions_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `role_id`, `permissions_id`) VALUES
(1, 1, 21),
(2, 1, 1),
(3, 1, 2),
(4, 1, 3),
(5, 1, 4),
(6, 1, 5),
(7, 1, 6),
(8, 1, 7),
(9, 1, 8),
(91, 15, 0),
(92, 15, 1),
(93, 15, 0),
(94, 15, 0),
(95, 15, 0),
(96, 15, 5),
(97, 15, 0),
(98, 15, 0),
(99, 15, 0),
(100, 16, 21),
(101, 16, 1),
(102, 16, 2),
(103, 16, 3),
(104, 16, 4),
(105, 16, 5),
(106, 16, 6),
(107, 16, 7),
(108, 16, 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `role_id`, `phone`, `email`, `password`, `gender`, `is_active`) VALUES
(58, 'Mr   Paing Soe Ko  ', 'admin', 1, '09944251199', 'dev.kopaing@gmail.com', '$2y$10$4ihzJJ1Lj.QFUv9PsraPb.lSSbi1w2S0W/uccbCANbxGU5H9TmK/u', 0, 1),
(59, 'Mr  Demo User 1 ', 'demo1', 16, '09123456789', 'demo1@mail.com', '$2y$10$w3nWwZgSSkZ0dx7GwLvQXeObXQhif/9fen3T6HiUJ5y6/l5IqV84.', 2, 1),
(60, 'Miss Demo User 2', 'demo2', 15, '09123456789', 'demo2@main.com', '$2y$10$.dkDuJPkvLx5Kzv598085OAIYpLcLG22UtImHH1w/l4pg4Q9/koLa', 1, 1),
(61, 'Mrs Demo User 3', 'demo3', 15, '09123456789', 'demo3@mail.com', '$2y$10$IlE5ZRDhUwBjycBDoc3zbu/67KN1Khp5idJLu/AmEn9qNOmqqoYG.', 2, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
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
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
