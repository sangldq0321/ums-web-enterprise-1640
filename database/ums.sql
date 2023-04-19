-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 19, 2023 at 01:20 AM
-- Server version: 10.6.10-MariaDB-cll-lve-log
-- PHP Version: 7.4.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wqsoditr_ums`
--

-- --------------------------------------------------------

--
-- Table structure for table `academicyear`
--

CREATE TABLE `academicyear` (
  `academicYearID` bigint(20) UNSIGNED NOT NULL,
  `open_date` date NOT NULL,
  `close_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `academicyear`
--

INSERT INTO `academicyear` (`academicYearID`, `open_date`, `close_date`) VALUES
(1, '2023-04-05', '2023-04-19');

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
(1, 'Request', '<p>Request</p>', '2023-03-30 03:38:49', '2023-04-07 01:23:11'),
(2, 'Feature', '<p>Feature</p>', '2023-03-30 03:38:49', '2023-04-08 01:47:31');

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
  `view` bigint(20) NOT NULL DEFAULT 0,
  `document` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `likeCount` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ideas`
--

INSERT INTO `ideas` (`ideaID`, `ideaName`, `categoryID`, `ideaContent`, `uploader`, `view`, `document`, `likeCount`, `created_at`, `updated_at`) VALUES
(34, 'Please add chatbox', 2, '<p>Please add chatbox</p>', 5, 3, NULL, 0, '2023-03-08 03:40:23', '2023-04-18 09:28:31'),
(35, 'Please update Term of Service', 1, '<p>Please update Term of Service</p>', 5, 11, 'document_Please update Windows to Windows 11_1681827996.docx', 0, '2023-03-22 04:00:00', '2023-04-18 14:53:05'),
(36, 'Room need more chairs', 1, '<p>Room need more chairs</p>', 5, 0, NULL, 0, '2023-01-13 03:41:48', '2023-04-09 02:41:48'),
(37, 'Please add document', 1, '<p>Please add document</p>', 7, 4, NULL, 0, '2023-04-03 05:01:02', '2023-04-18 14:36:07'),
(38, 'Please add submission', 1, '<p>Please add submission</p>', 7, 4, NULL, 0, '2023-04-09 05:01:20', '2023-04-18 10:19:48'),
(39, 'Please add grade system', 1, '<p>Please add grade system</p>', 7, 1, NULL, 0, '2023-02-28 06:01:36', '2023-04-18 06:08:55'),
(40, 'Add attendance system', 1, '<p>Add attendance system</p>', 5, 2, NULL, 0, '2023-02-14 06:28:53', '2023-04-18 09:10:26'),
(41, 'The University need to check its air conditioners!', 1, '<p>I have visited several classes and sometime they turn off suddenly while no one was noticing, since it was a hot day it\'s hard to keep track of it and turn them on every single time! We need a check up on those air conditioners for our students or possibly upgrade them as well since some of them seem to be quite old.</p>', 8, 2, NULL, 0, '2023-04-18 18:13:03', '2023-04-18 18:18:39');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notiID` bigint(20) UNSIGNED NOT NULL,
  `userID` bigint(20) UNSIGNED NOT NULL,
  `notiContent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notiFor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isRead` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notiID`, `userID`, `notiContent`, `notiFor`, `isRead`, `created_at`, `updated_at`) VALUES
(15, 5, 'Someone is added new idea', 'idea', 0, '2023-04-09 02:40:23', '2023-04-09 02:40:23'),
(16, 5, 'Someone is added new idea', 'idea', 0, '2023-04-09 02:41:20', '2023-04-09 02:41:20'),
(17, 5, 'Someone is added new idea', 'idea', 0, '2023-04-09 02:41:48', '2023-04-09 02:41:48'),
(18, 7, 'Someone is added new idea', 'idea', 0, '2023-04-09 05:01:02', '2023-04-09 05:01:02'),
(19, 7, 'Someone is added new idea', 'idea', 0, '2023-04-09 05:01:20', '2023-04-09 05:01:20'),
(20, 7, 'Someone is added new idea', 'idea', 0, '2023-04-09 05:01:36', '2023-04-09 05:01:36'),
(21, 5, 'Someone is added new idea', 'idea', 0, '2023-04-09 05:28:53', '2023-04-09 05:28:53'),
(22, 8, 'Someone is added new idea', 'idea', 0, '2023-04-18 18:13:03', '2023-04-18 18:13:03');

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
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isPassReset` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `fullname`, `password`, `roleID`, `remember_token`, `isPassReset`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '$2y$10$Gh4v05aAC0hl7xtq4y3CQuUzTnd7iO5qc/lOvZCfrQujajhkoYQoS', 1, NULL, 1, 1, '2023-03-26 07:42:54', '2023-03-26 00:52:49'),
(2, 'qamanager', 'QA Manager', '$2y$10$W0cv3X.R3FeBtgJKi.nSZOQ0Z74x8mnwQz.q8r2f4l.GONqAg5FvW', 2, NULL, 1, 1, '2023-03-26 07:46:46', '2023-03-26 00:48:33'),
(3, 'qacooraca', 'QA Coordinator Academic', '$2a$10$XFm43675iWjRe4ULhtb7iuASSCmbPjF45fBJH8TJSM5k0/kUVyhf6', 3, NULL, 1, 1, '2023-03-30 20:48:47', '2023-03-30 20:48:47'),
(4, 'qacoorsup', 'QA Coordinator Support', '$2a$10$XFm43675iWjRe4ULhtb7iuASSCmbPjF45fBJH8TJSM5k0/kUVyhf6', 3, NULL, 1, 1, '2023-03-30 20:48:47', '2023-03-30 20:48:47'),
(5, 'acastaff1', 'Staff Academic 1', '$2a$10$3y4hvQ0pIa1F3k.DR.eJQeLYirIvsHOhhQsG9DSl0H4Da1egyX/c2', 4, NULL, 1, 1, '2023-03-30 21:04:17', '2023-04-18 18:14:00'),
(6, 'acastaff2', 'Staff Academic 2', '$2a$10$3y4hvQ0pIa1F3k.DR.eJQeLYirIvsHOhhQsG9DSl0H4Da1egyX/c2', 4, NULL, 1, 1, '2023-03-30 21:04:17', '2023-03-30 21:04:17'),
(7, 'supstaff1', 'Staff Support 1', '$2a$10$3y4hvQ0pIa1F3k.DR.eJQeLYirIvsHOhhQsG9DSl0H4Da1egyX/c2', 5, NULL, 1, 1, '2023-03-30 21:04:17', '2023-03-30 21:04:17'),
(8, 'supstaff2', 'Staff Support 2', '$2a$10$3y4hvQ0pIa1F3k.DR.eJQeLYirIvsHOhhQsG9DSl0H4Da1egyX/c2', 5, NULL, 1, 1, '2023-03-30 21:04:17', '2023-03-30 21:04:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academicyear`
--
ALTER TABLE `academicyear`
  ADD PRIMARY KEY (`academicYearID`);

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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notiID`),
  ADD KEY `userID` (`userID`);

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
-- AUTO_INCREMENT for table `academicyear`
--
ALTER TABLE `academicyear`
  MODIFY `academicYearID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ideas`
--
ALTER TABLE `ideas`
  MODIFY `ideaID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notiID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
  ADD CONSTRAINT `ideas_ibfk_2` FOREIGN KEY (`uploader`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ideas_ibfk_3` FOREIGN KEY (`categoryID`) REFERENCES `categories` (`categoryID`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_roleid_foreign` FOREIGN KEY (`roleID`) REFERENCES `roles` (`roleID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
