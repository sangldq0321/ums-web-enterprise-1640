-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql207.epizy.com
-- Generation Time: Mar 31, 2023 at 05:20 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_33912338_umsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryID` bigint(20) UNSIGNED NOT NULL,
  `categoryName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoryDesc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryID`, `categoryName`, `categoryDesc`, `created_at`, `updated_at`) VALUES
(1, 'Request', 'A request is a desire for something specific — such as a new feature or enhancement.', '2023-03-30 03:38:49', '2023-03-30 04:48:18');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentID` bigint(20) UNSIGNED NOT NULL,
  `userID` bigint(20) UNSIGNED NOT NULL,
  `commentContent` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ideaID` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentID`, `userID`, `commentContent`, `ideaID`, `created_at`, `updated_at`) VALUES
(11, 2, 'Good idea !', 4, '2023-03-30 18:08:54', '2023-03-31 19:45:36'),
(12, 5, 'Pending request', 8, '2023-03-31 20:00:23', '2023-03-31 20:01:12');

-- --------------------------------------------------------

--
-- Table structure for table `ideas`
--

CREATE TABLE `ideas` (
  `ideaID` bigint(20) UNSIGNED NOT NULL,
  `ideaName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoryID` bigint(20) UNSIGNED NOT NULL,
  `ideaContent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uploader` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ideas`
--

INSERT INTO `ideas` (`ideaID`, `ideaName`, `categoryID`, `ideaContent`, `uploader`, `created_at`, `updated_at`) VALUES
(1, 'Add closure date for ideas', 1, '<p>Please add <strong>closure date</strong> for ideas</p>', 2, '2023-03-30 04:13:09', '2023-03-31 19:46:27'),
(4, 'Add dashboard', 1, '<p>Please add <strong>dashboard</strong></p>', 2, '2023-03-30 16:40:20', '2023-03-30 16:40:20'),
(5, 'Add report system', 1, '<p>Please add <strong>report system</strong></p>', 5, '2023-03-31 19:47:13', '2023-03-31 19:47:13'),
(6, 'Add like function', 1, '<p>Please add <strong>like function</strong></p>', 5, '2023-03-31 19:47:48', '2023-03-31 19:47:48'),
(7, 'Add dislike function', 1, '<p>Please add <strong>dislike function</strong></p>', 5, '2023-03-31 19:48:10', '2023-03-31 19:48:10'),
(8, 'Add chatbox', 1, '<p>Please add <strong>chatbox</strong></p>', 5, '2023-03-31 19:48:39', '2023-03-31 19:48:39');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roleID` bigint(20) UNSIGNED NOT NULL,
  `roleName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roleID`, `roleName`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', '2023-03-26 07:42:39', '2023-03-25 17:00:00'),
(2, 'QA Manager', '2023-03-26 07:44:27', '2023-03-26 07:44:27'),
(3, 'QA Coordinator', '2023-03-26 09:04:13', '2023-03-26 09:04:13'),
(4, 'Academic staff', '2023-03-26 09:01:55', '2023-03-26 09:01:55'),
(5, 'Support staff', '2023-03-26 09:03:54', '2023-03-26 09:03:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roleID` bigint(20) UNSIGNED NOT NULL,
  `isPassReset` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `fullname`, `password`, `roleID`, `isPassReset`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '$2y$10$Gh4v05aAC0hl7xtq4y3CQuUzTnd7iO5qc/lOvZCfrQujajhkoYQoS', 1, 1, '2023-03-26 07:42:54', '2023-03-26 00:52:49'),
(2, 'qamanager', 'QA Manager', '$2y$10$W0cv3X.R3FeBtgJKi.nSZOQ0Z74x8mnwQz.q8r2f4l.GONqAg5FvW', 2, 1, '2023-03-26 07:46:46', '2023-03-26 00:48:33'),
(3, 'qacoor1', 'QA Coordinator 1', '$2a$10$XFm43675iWjRe4ULhtb7iuASSCmbPjF45fBJH8TJSM5k0/kUVyhf6', 3, 1, '2023-03-30 20:48:47', '2023-03-30 20:48:47'),
(4, 'acastaff1', 'Staff Academic 1', '$2a$10$3y4hvQ0pIa1F3k.DR.eJQeLYirIvsHOhhQsG9DSl0H4Da1egyX/c2', 4, 1, '2023-03-30 21:04:17', '2023-03-30 21:04:17'),
(5, 'acastaff2', 'Staff Academic 2', '$2a$10$3y4hvQ0pIa1F3k.DR.eJQeLYirIvsHOhhQsG9DSl0H4Da1egyX/c2', 4, 1, '2023-03-30 21:04:17', '2023-03-30 21:04:17'),
(6, 'qacoor2', 'QA Coordinator 2', '$2a$10$XFm43675iWjRe4ULhtb7iuASSCmbPjF45fBJH8TJSM5k0/kUVyhf6', 3, 1, '2023-03-30 20:48:47', '2023-03-30 20:48:47'),
(7, 'supstaff1', 'Staff Support 1', '$2a$10$3y4hvQ0pIa1F3k.DR.eJQeLYirIvsHOhhQsG9DSl0H4Da1egyX/c2', 5, 1, '2023-03-30 21:04:17', '2023-03-30 21:04:17'),
(8, 'supstaff2', 'Staff Support 2', '$2a$10$3y4hvQ0pIa1F3k.DR.eJQeLYirIvsHOhhQsG9DSl0H4Da1egyX/c2', 5, 1, '2023-03-30 21:04:17', '2023-03-30 21:04:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `ideaID` (`ideaID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `ideas`
--
ALTER TABLE `ideas`
  ADD PRIMARY KEY (`ideaID`),
  ADD KEY `categoryID` (`categoryID`),
  ADD KEY `uploader` (`uploader`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleID`),
  ADD UNIQUE KEY `roles_rolename_unique` (`roleName`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_roleid_foreign` (`roleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ideas`
--
ALTER TABLE `ideas`
  MODIFY `ideaID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `roleID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`ideaID`) REFERENCES `ideas` (`ideaID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ideas`
--
ALTER TABLE `ideas`
  ADD CONSTRAINT `ideas_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `categories` (`categoryID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ideas_ibfk_2` FOREIGN KEY (`uploader`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_roleid_foreign` FOREIGN KEY (`roleID`) REFERENCES `roles` (`roleID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
