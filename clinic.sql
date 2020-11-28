-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 28, 2020 at 08:31 PM
-- Server version: 10.5.4-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinic`
--
CREATE DATABASE IF NOT EXISTS `clinic` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `clinic`;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `commented_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`comment_id`),
  KEY `fk_user_id_comment` (`user_id`),
  KEY `fk_question_id_comment` (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `question_id`, `user_id`, `comment`, `commented_at`) VALUES
(1, 1, 2, 'First comment as the clinic 1', '2020-11-28 19:15:00'),
(2, 1, 2, 'This is a clinic\r\nTesting again', '2020-11-28 19:24:42'),
(3, 1, 3, 'This is the OP', '2020-11-28 19:25:23'),
(4, 1, 3, 'All good', '2020-11-28 19:25:35'),
(5, 1, 2, 'Another comment as a clinic', '2020-11-28 19:35:56'),
(6, 2, 3, 'A comment here', '2020-11-28 19:36:26'),
(7, 1, 3, 'And another comment here', '2020-11-28 19:36:41'),
(8, 3, 2, 'A comment from Test Clinic 1 account', '2020-11-28 19:46:03'),
(9, 3, 2, 'Another comment from Test Clinic 1 account', '2020-11-28 19:46:21'),
(10, 3, 6, 'A comment from Test Clinic 2 account', '2020-11-28 19:46:45'),
(11, 3, 7, 'A comment from Test Clinic 3 account', '2020-11-28 19:47:11'),
(12, 3, 3, 'A comment from Pet Owner 1 account. This is the OP', '2020-11-28 19:47:50'),
(13, 3, 7, 'Another comment from Test Clinic 3 account', '2020-11-28 19:48:27'),
(14, 3, 7, 'Second comment from Test Clinic 3 account after the OPs comment', '2020-11-28 19:48:58'),
(15, 7, 7, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud', '2020-11-28 19:49:57');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`question_id`),
  KEY `fk_user_id_question` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `user_id`, `title`, `description`, `timestamp`) VALUES
(1, 3, 'This is a test question', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum hendrerit mauris efficitur nisi auctor, nec interdum nunc tincidunt. Quisque mollis ipsum a nisi euismod rutrum. Phasellus placerat eu odio nec tempus. Aliquam facilisis risus felis, a blandit neque consequat sed. Vivamus quis erat volutpat, iaculis nunc in, aliquet mauris. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Quisque mauris nisl, vestibulum ac nulla quis, dapibus venenatis est. Donec tristique quam metus, a elementum risus bibendum a. Proin ac cursus dui. Phasellus imperdiet libero at varius tempus. Integer varius ante eget quam eleifend cursus.', '2020-11-28 15:00:41'),
(2, 3, 'This is another test question', 'Aliquam iaculis eget augue ut ultricies. Nulla a ex justo. Morbi imperdiet tincidunt tortor ornare ultrices. Curabitur ut convallis arcu, in mattis dui. Nunc quis enim non justo egestas gravida. Vestibulum congue iaculis nulla, eu interdum magna sagittis in. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vitae diam sed ipsum scelerisque molestie.', '2020-11-28 15:04:10'),
(3, 3, 'Third test', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur ac nisi in nibh placerat viverra nec sed nibh. Etiam interdum porta elementum. Integer ipsum sapien, maximus nec lorem id, tincidunt tincidunt sapien. Donec rhoncus ligula consequat lorem posuere, vel vehicula libero pretium. Integer varius eleifend diam, ut blandit quam tempor eu. Nulla nec imperdiet felis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris lectus libero, hendrerit vitae lobortis et, condimentum a felis. In id lacus consequat ante mollis egestas. Sed ex eros, condimentum quis mauris at, tristique imperdiet dui. Sed interdum elit sed justo consequat tempor. Sed interdum, ipsum sed scelerisque pretium, massa est varius odio, non tristique justo est ut quam. Aenean ut ultricies urna. Praesent aliquam augue non vehicula aliquam. Curabitur lacinia ultrices libero, et efficitur sem ultrices vitae.', '2020-11-28 15:05:23'),
(4, 3, 'Fourth test', 'Ut ac diam mattis, accumsan ligula sit amet, sollicitudin dolor. Nam convallis risus nisl, a rutrum ipsum molestie vel. Cras blandit lorem sit amet neque pretium auctor quis non dui. Etiam et nisl nec quam ornare commodo. Curabitur id est mi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In non lobortis mauris. Mauris porta tincidunt justo, nec consectetur nulla congue sit amet.', '2020-11-28 15:06:28'),
(5, 3, 'This is the fifth test', 'Vestibulum hendrerit accumsan erat, congue luctus est rhoncus non. Curabitur lacinia, ex eget tristique ornare, odio ligula aliquet sapien, sit amet mollis nulla ipsum ut sapien. Ut cursus turpis arcu, tristique pharetra tellus ultrices vitae. Integer ligula arcu, fringilla vitae vestibulum volutpat, eleifend at nisl. Cras a nibh nibh. Mauris facilisis, nibh vel dictum luctus, ipsum odio porttitor tortor, eget aliquam mauris orci eu tortor. Quisque accumsan justo et nisl tincidunt, a porta ligula gravida. Mauris imperdiet libero mollis pretium convallis.', '2020-11-28 15:09:00'),
(7, 4, 'Second account question 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2020-11-28 19:39:27'),
(8, 5, 'First question from owner 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2020-11-28 19:40:44'),
(9, 5, 'Second question from owner 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2020-11-28 19:41:04'),
(10, 5, 'Third question from owner 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2020-11-28 19:41:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` enum('ADMIN','PET_OWNER','CLINIC','') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('PENDING','ACTIVE','SUSPENDED','') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `username`, `email`, `contact`, `password`, `user_type`, `status`) VALUES
(1, 'Test', 'Admin', 'admin', 'admin@gmail.com', '0754865489', '202cb962ac59075b964b07152d234b70', 'ADMIN', 'ACTIVE'),
(2, 'Test', 'Clinic 1', 'clinic1', 'clinic@gmail.com', '0184455678', '202cb962ac59075b964b07152d234b70', 'CLINIC', 'ACTIVE'),
(3, 'Pet', 'Owner 1', 'owner1', 'pet@gmail.com', '0758456789', '202cb962ac59075b964b07152d234b70', 'PET_OWNER', 'ACTIVE'),
(4, 'Pet', 'Owner 2', 'owner2', 'owner2@gmail.com', '0147586923', '202cb962ac59075b964b07152d234b70', 'PET_OWNER', 'ACTIVE'),
(5, 'Pet', 'Owner 3', 'owner3', 'owner3@gmail.com', '0152456789', '202cb962ac59075b964b07152d234b70', 'PET_OWNER', 'ACTIVE'),
(6, 'Test', 'Clinic 2', 'clinic2', 'clinic2@gmail.com', '0156457892', '202cb962ac59075b964b07152d234b70', 'CLINIC', 'ACTIVE'),
(7, 'Test', 'Clinic 3', 'clinic3', 'clinic3@gmail.com', '0015485789', '202cb962ac59075b964b07152d234b70', 'CLINIC', 'ACTIVE');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_question_id_comment` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`),
  ADD CONSTRAINT `fk_user_id_comment` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_user_id_question` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
