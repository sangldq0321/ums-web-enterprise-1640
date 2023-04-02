-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th4 02, 2023 lúc 11:04 AM
-- Phiên bản máy phục vụ: 8.0.31
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ums`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `categoryID` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoryDesc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`categoryID`, `categoryName`, `categoryDesc`, `created_at`, `updated_at`) VALUES
(1, 'Request', 'A request is a desire for something specific — such as a new feature or enhancement.', '2023-03-30 03:38:49', '2023-03-30 04:48:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `commentID` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `userID` bigint UNSIGNED NOT NULL,
  `commentContent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ideaID` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`commentID`),
  KEY `ideaID` (`ideaID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`commentID`, `userID`, `commentContent`, `ideaID`, `created_at`, `updated_at`) VALUES
(11, 2, 'Good idea !', 4, '2023-03-30 18:08:54', '2023-03-31 19:45:36'),
(12, 5, 'Pending request', 8, '2023-03-31 20:00:23', '2023-03-31 20:01:12'),
(13, 4, '123', 8, '2023-03-31 10:56:15', '2023-03-31 10:56:15'),
(14, 4, '123', 8, '2023-03-31 10:56:19', '2023-03-31 10:56:19'),
(15, 4, '123', 8, '2023-03-31 13:02:05', '2023-03-31 13:02:05'),
(16, 4, '123', 8, '2023-03-31 13:09:22', '2023-03-31 13:09:22'),
(17, 4, '123', 8, '2023-03-31 13:15:23', '2023-03-31 13:15:23'),
(18, 4, '123', 8, '2023-03-31 21:29:52', '2023-03-31 21:29:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ideas`
--

DROP TABLE IF EXISTS `ideas`;
CREATE TABLE IF NOT EXISTS `ideas` (
  `ideaID` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `ideaName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoryID` bigint UNSIGNED NOT NULL,
  `ideaContent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `uploader` bigint UNSIGNED NOT NULL,
  `view` bigint NOT NULL DEFAULT '0',
  `document` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `likeCount` bigint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ideaID`),
  KEY `categoryID` (`categoryID`),
  KEY `uploader` (`uploader`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ideas`
--

INSERT INTO `ideas` (`ideaID`, `ideaName`, `categoryID`, `ideaContent`, `uploader`, `view`, `document`, `likeCount`, `created_at`, `updated_at`) VALUES
(1, 'Add closure date for ideas', 1, '<p>Please add <strong>closure date</strong> for ideas</p>', 2, 6, NULL, 0, '2023-03-30 04:13:09', '2023-03-31 19:46:27'),
(4, 'Add dashboard', 1, '<p>Please add <strong>dashboard</strong></p>', 2, 0, NULL, 0, '2023-03-30 16:40:20', '2023-03-30 16:40:20'),
(5, 'Add report system', 1, '<p>Please add <strong>report system</strong></p>', 5, 15, NULL, 0, '2023-03-31 19:47:13', '2023-03-31 19:47:13'),
(6, 'Add like function', 1, '<p>Please add <strong>like function</strong></p>', 5, 1, NULL, 0, '2023-03-31 19:47:48', '2023-03-31 13:24:38'),
(7, 'Add dislike function', 1, '<p>Please add <strong>dislike function</strong></p>', 5, 2, NULL, 0, '2023-03-31 19:48:10', '2023-04-01 18:52:13'),
(8, 'Add chatbox', 1, '<p>Please add <strong>chatbox</strong></p>', 5, 25, NULL, 0, '2023-03-31 19:48:39', '2023-04-02 10:54:39');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `roleID` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `roleName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`roleID`),
  UNIQUE KEY `roles_rolename_unique` (`roleName`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`roleID`, `roleName`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', '2023-03-26 07:42:39', '2023-03-25 17:00:00'),
(2, 'QA Manager', '2023-03-26 07:44:27', '2023-03-26 07:44:27'),
(3, 'QA Coordinator', '2023-03-26 09:04:13', '2023-03-26 09:04:13'),
(4, 'Academic staff', '2023-03-26 09:01:55', '2023-03-26 09:01:55'),
(5, 'Support staff', '2023-03-26 09:03:54', '2023-03-26 09:03:54');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userID` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `fullname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `roleID` bigint UNSIGNED NOT NULL,
  `isPassReset` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `users_username_unique` (`username`),
  KEY `users_roleid_foreign` (`roleID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
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
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`ideaID`) REFERENCES `ideas` (`ideaID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `ideas`
--
ALTER TABLE `ideas`
  ADD CONSTRAINT `ideas_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `categories` (`categoryID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ideas_ibfk_2` FOREIGN KEY (`uploader`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_roleid_foreign` FOREIGN KEY (`roleID`) REFERENCES `roles` (`roleID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
