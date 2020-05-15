-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2019 at 04:10 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit`
--

CREATE TABLE `audit` (
  `id` int(255) NOT NULL,
  `userID` varchar(50) NOT NULL,
  `action` varchar(255) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `audit`
--

INSERT INTO `audit` (`id`, `userID`, `action`, `doe`) VALUES
(1, 'USER-000001', 'LOGIN', '2019-06-07 06:59:05'),
(2, 'USER-000001', 'LOGIN', '2019-06-07 06:59:48'),
(3, 'USER-000001', 'LOGOUT', '2019-06-07 07:03:50'),
(4, 'USER-000001', 'LOGIN', '2019-06-07 07:04:20'),
(5, 'USER-000001', 'LOGOUT', '2019-06-07 07:04:31'),
(6, 'USER-000001', 'LOGIN', '2019-06-07 07:04:57'),
(7, 'USER-000001', 'LOGOUT', '2019-06-07 07:05:10'),
(8, 'LEC-000004', 'LOGIN', '2019-06-07 07:05:17'),
(9, 'PUC/190002', 'LOGOUT', '2019-06-07 07:35:19'),
(10, 'PUC/190002', 'LOGIN', '2019-06-07 07:35:31'),
(11, 'LEC-000004', 'LOGOUT', '2019-06-07 09:16:30'),
(12, 'LEC-000001', 'LOGIN', '2019-06-07 09:16:36'),
(13, 'LEC-000001', 'LOGOUT', '2019-06-07 09:40:01'),
(14, 'LEC-000001', 'LOGIN', '2019-06-07 09:41:06'),
(15, 'LEC-000001', 'LOGOUT', '2019-06-07 09:41:12'),
(16, 'LEC-000004', 'LOGIN', '2019-06-07 09:41:15'),
(17, 'LEC-000004', 'LOGOUT', '2019-06-07 09:56:46'),
(18, 'USER-000001', 'LOGIN', '2019-06-07 09:56:54'),
(19, 'USER-000001', 'LOGOUT', '2019-06-07 10:00:25'),
(20, 'LEC-000004', 'LOGIN', '2019-06-07 10:00:41'),
(21, 'LEC-000004', 'LOGOUT', '2019-06-07 10:02:52'),
(22, 'LEC-000005', 'LOGIN', '2019-06-07 10:03:45'),
(23, 'LEC-000005', 'LOGOUT', '2019-06-07 10:04:36'),
(24, 'LEC-000004', 'LOGIN', '2019-06-07 10:04:40'),
(25, 'LEC-000004', 'LOGOUT', '2019-06-07 10:05:05'),
(26, 'LEC-000005', 'LOGIN', '2019-06-07 10:05:10'),
(27, 'LEC-000005', 'LOGOUT', '2019-06-07 10:05:31'),
(28, 'LEC-000001', 'LOGIN', '2019-06-07 10:05:34'),
(29, 'LEC-000001', 'LOGOUT', '2019-06-07 10:05:50'),
(30, 'LEC-000005', 'LOGIN', '2019-06-07 10:06:04'),
(31, 'LEC-000005', 'LOGOUT', '2019-06-07 10:06:06'),
(32, 'LEC-000005', 'LOGIN', '2019-06-07 10:09:21'),
(33, 'LEC-000005', 'LOGOUT', '2019-06-07 10:09:29'),
(34, 'LEC-000005', 'LOGIN', '2019-06-07 10:09:40'),
(35, 'LEC-000005', 'LOGOUT', '2019-06-07 10:10:11'),
(36, 'LEC-000005', 'LOGIN', '2019-06-07 10:10:14'),
(37, 'LEC-000005', 'LOGOUT', '2019-06-07 10:10:33'),
(38, 'LEC-000005', 'LOGIN', '2019-06-07 10:10:37'),
(39, 'LEC-000005', 'LOGOUT', '2019-06-07 10:10:42'),
(40, 'PUC/190002', 'LOGOUT', '2019-06-07 10:11:23'),
(41, 'USER-000001', 'LOGIN', '2019-06-07 10:11:28'),
(42, 'USER-000001', 'LOGOUT', '2019-06-07 10:12:03'),
(43, 'LEC-000004', 'LOGIN', '2019-06-07 10:12:09'),
(44, 'LEC-000004', 'LOGOUT', '2019-06-07 10:15:10'),
(45, 'LEC-000005', 'LOGIN', '2019-06-07 10:15:14'),
(46, 'PUC/190002', 'LOGIN', '2019-06-07 10:16:50'),
(47, 'LEC-000005', 'LOGOUT', '2019-06-07 10:26:40'),
(48, 'LEC-000005', 'LOGIN', '2019-06-07 10:27:06'),
(49, 'PUC/190002', 'LOGOUT', '2019-06-07 17:47:31'),
(50, 'LEC-000005', 'LOGOUT', '2019-06-07 17:47:47'),
(51, 'LEC-000001', 'LOGIN', '2019-06-07 17:47:55'),
(52, 'LEC-000001', 'LOGOUT', '2019-06-07 17:48:40'),
(53, 'LEC-000001', 'LOGIN', '2019-06-07 20:26:02'),
(54, 'LEC-000001', 'LOGOUT', '2019-06-07 20:26:24'),
(55, 'LEC-000005', 'LOGIN', '2019-06-07 20:26:54'),
(56, 'PUC/190002', 'LOGIN', '2019-06-07 20:29:26'),
(57, 'PUC/160222', 'LOGIN', '2019-06-08 20:37:14'),
(58, 'PUC/160222', 'LOGOUT', '2019-06-08 20:38:48'),
(59, 'PUC/190001', 'LOGIN', '2019-06-08 20:39:22'),
(60, 'PUC/190001', 'LOGOUT', '2019-06-08 20:39:30'),
(61, 'PUC/150332', 'LOGIN', '2019-06-08 20:40:32'),
(62, 'PUC/150332', 'LOGOUT', '2019-06-08 20:46:13'),
(63, 'PUC/150332', 'LOGOUT', '2019-06-08 20:46:57'),
(64, 'PUC/150332', 'LOGIN', '2019-06-08 20:49:12'),
(65, 'PUC/150332', 'LOGOUT', '2019-06-08 20:50:32'),
(66, 'PUC/150332', 'LOGOUT', '2019-06-08 20:57:42'),
(67, '1911199', 'LOGIN', '2019-06-08 21:01:07'),
(68, '1911199', 'LOGOUT', '2019-06-08 21:01:53'),
(69, 'PUC/150332', 'LOGIN', '2019-06-08 21:02:03'),
(70, 'PUC/150332', 'LOGOUT', '2019-06-08 21:04:23'),
(71, 'PUC/150332', 'LOGIN', '2019-06-08 21:05:54'),
(72, 'PUC/150332', 'LOGOUT', '2019-06-08 21:06:53'),
(73, 'LEC-000005', 'LOGOUT', '2019-06-08 21:27:12'),
(74, 'LEC-000004', 'LOGIN', '2019-06-08 21:55:10'),
(75, 'LEC-000004', 'LOGOUT', '2019-06-08 21:56:08'),
(77, 'LEC-000004', 'LOGIN', '2019-06-11 00:42:15'),
(78, 'LEC-000004', 'LOGOUT', '2019-06-11 00:44:31'),
(79, 'LEC-000004', 'LOGIN', '2019-06-11 00:45:06'),
(80, 'LEC-000004', 'LOGOUT', '2019-06-11 00:45:15'),
(81, 'USER-000001', 'LOGIN', '2019-06-11 00:45:24'),
(82, 'USER-000001', 'LOGOUT', '2019-06-11 00:47:19'),
(83, 'LEC-000004', 'LOGIN', '2019-06-11 00:47:25'),
(84, 'LEC-000004', 'LOGOUT', '2019-06-11 00:48:12'),
(85, 'USER-000001', 'LOGIN', '2019-06-11 00:48:19'),
(86, 'USER-000001', 'LOGOUT', '2019-06-11 00:53:41'),
(87, 'LEC-000004', 'LOGIN', '2019-06-11 00:53:58'),
(88, 'LEC-000004', 'LOGOUT', '2019-06-11 00:57:16'),
(89, 'USER-000001', 'LOGIN', '2019-06-11 00:57:23'),
(90, 'PUC/190002', 'LOGIN', '2019-06-11 02:00:39');

-- --------------------------------------------------------

--
-- Table structure for table `cdocument`
--

CREATE TABLE `cdocument` (
  `id` int(255) NOT NULL,
  `cID` varchar(50) NOT NULL,
  `lecID` varchar(50) NOT NULL,
  `lecture` int(100) NOT NULL,
  `docName` varchar(255) NOT NULL,
  `doe` datetime NOT NULL,
  `dor` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cdocument`
--

INSERT INTO `cdocument` (`id`, `cID`, `lecID`, `lecture`, `docName`, `doe`, `dor`) VALUES
(1, 'PUIS401', 'LEC-000005', 1, 'DS_LECTURE_1.pptx', '2019-06-07 10:38:14', '2019-06-07 10:38:14'),
(2, 'PUIS401', 'LEC-000005', 2, 'DS LECTURE 2R.pptx', '2019-06-07 10:39:26', '2019-06-07 10:39:26'),
(3, 'PUIS401', 'LEC-000005', 3, 'DS LECTURE 3R.pptx', '2019-06-07 10:40:01', '2019-06-07 10:40:02');

-- --------------------------------------------------------

--
-- Table structure for table `cmanagement`
--

CREATE TABLE `cmanagement` (
  `assignID` int(255) NOT NULL,
  `depID` varchar(50) NOT NULL,
  `cID` varchar(50) NOT NULL,
  `lecID` varchar(50) NOT NULL,
  `doe` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cmanagement`
--

INSERT INTO `cmanagement` (`assignID`, `depID`, `cID`, `lecID`, `doe`) VALUES
(1, 'DEP-000001', 'PUIS403', 'LEC-000006', '2019-06-07 10:02:10'),
(2, 'DEP-000001', 'PUIS404', 'LEC-000001', '2019-06-07 10:02:10'),
(3, 'DEP-000001', 'PUIS407', 'LEC-000006', '2019-06-07 10:02:10'),
(4, 'DEP-000001', 'PUIS405', 'LEC-000005', '2019-06-07 10:02:10'),
(5, 'DEP-000001', 'PUIS401', 'LEC-000005', '2019-06-07 10:02:10'),
(6, 'DEP-000001', 'PUIS402', 'LEC-000002', '2019-06-07 10:02:10'),
(7, 'DEP-000001', 'PUIS406', 'LEC-000005', '2019-06-07 10:02:10');

-- --------------------------------------------------------

--
-- Table structure for table `cmedia`
--

CREATE TABLE `cmedia` (
  `id` int(255) NOT NULL,
  `cID` varchar(50) NOT NULL,
  `lecID` varchar(50) NOT NULL,
  `lecture` int(100) NOT NULL,
  `mediatype` varchar(30) NOT NULL,
  `mediaName` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `doe` datetime NOT NULL,
  `dor` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `cID` varchar(50) NOT NULL,
  `depID` varchar(50) NOT NULL,
  `courseName` varchar(255) NOT NULL,
  `level` int(10) NOT NULL,
  `semester` int(10) NOT NULL,
  `doe` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`cID`, `depID`, `courseName`, `level`, `semester`, `doe`) VALUES
('PUIS401', 'DEP-000001', 'Distributed System', 400, 2, '2019-06-07 09:51:22'),
('PUIS402', 'DEP-000001', 'Systems Integration', 400, 2, '2019-06-07 09:51:22'),
('PUIS403', 'DEP-000001', 'System Analysis And Design', 400, 1, '2019-06-07 09:51:22'),
('PUIS404', 'DEP-000001', 'I.T Entrepreneurship And Innovation', 400, 1, '2019-06-07 09:51:22'),
('PUIS405', 'DEP-000001', 'Artificial Intelligence', 400, 1, '2019-06-07 09:51:22'),
('PUIS406', 'DEP-000001', 'I.T.P.M', 400, 2, '2019-06-07 09:51:22'),
('PUIS407', 'DEP-000001', 'Computer Forensics', 400, 2, '2019-06-07 09:51:22');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `depID` varchar(50) NOT NULL,
  `facID` varchar(50) NOT NULL,
  `departmentName` varchar(100) NOT NULL,
  `doe` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`depID`, `facID`, `departmentName`, `doe`) VALUES
('DEP-000001', 'FAC-000001', 'Information Technology', '2019-02-16 17:02:59'),
('DEP-000002', 'FAC-000001', 'Insurance', '2019-02-16 17:02:59'),
('DEP-000003', 'FAC-000002', 'FTM DEPARTMENT', '2019-03-21 13:03:34'),
('DEP-000004', 'FAC-000002', 'SDDD', '2019-03-21 16:03:37'),
('DEP-000005', 'FAC-000005', 'Insurance With Actuarial Science', '2019-03-22 13:03:10'),
('DEP-000006', 'FAC-000001', 'Building And Constructions', '2019-03-22 13:03:11'),
('DEP-000007', 'FAC-000005', 'FTB DEP', '2019-03-26 11:03:25');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `facID` varchar(50) NOT NULL,
  `facultyName` varchar(100) NOT NULL,
  `doe` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`facID`, `facultyName`, `doe`) VALUES
('FAC-000001', 'FESAC', '2019-02-16 17:02:58'),
('FAC-000002', 'FTM', '2019-03-21 13:03:34'),
('FAC-000003', 'FBM', '2019-03-21 16:03:36'),
('FAC-000004', 'FBA', '2019-03-21 16:03:37'),
('FAC-000005', 'FTB', '2019-03-22 13:03:10');

-- --------------------------------------------------------

--
-- Table structure for table `generalreport`
--

CREATE TABLE `generalreport` (
  `id` int(255) NOT NULL,
  `studentID` varchar(50) NOT NULL,
  `cID` varchar(100) NOT NULL,
  `testID` varchar(50) NOT NULL,
  `totalScore` int(100) NOT NULL,
  `teststatus` varchar(100) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `generalreport`
--

INSERT INTO `generalreport` (`id`, `studentID`, `cID`, `testID`, `totalScore`, `teststatus`, `doe`) VALUES
(1, 'PUC/150332', 'PUIS401', '0754511', 0, 'FAILED', '2019-06-08 20:57:42');

-- --------------------------------------------------------

--
-- Table structure for table `lecture`
--

CREATE TABLE `lecture` (
  `id` int(255) NOT NULL,
  `cID` varchar(50) NOT NULL,
  `lecID` varchar(255) NOT NULL,
  `lecNum` int(20) NOT NULL,
  `lecTitle` longtext NOT NULL,
  `doe` datetime NOT NULL,
  `dor` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecture`
--

INSERT INTO `lecture` (`id`, `cID`, `lecID`, `lecNum`, `lecTitle`, `doe`, `dor`) VALUES
(1, 'PUIS401', 'LEC-000005', 1, 'INTRODUCTION', '2019-06-07 10:38:14', '2019-06-07 10:43:34'),
(2, 'PUIS401', 'LEC-000005', 2, 'ARCHITECTURAL STYLES &amp; SYSTEM ARCHITECTURES', '2019-06-07 10:39:26', '2019-06-07 10:44:13'),
(3, 'PUIS401', 'LEC-000005', 3, 'PROCESSES (THREADS &amp; VIRTUALIZATION)', '2019-06-07 10:40:01', '2019-06-07 10:40:01');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE `lecturer` (
  `lecID` varchar(50) NOT NULL,
  `facID` varchar(50) NOT NULL,
  `depID` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `otherName` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `position` varchar(100) NOT NULL,
  `doe` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`lecID`, `facID`, `depID`, `firstName`, `lastName`, `otherName`, `email`, `phone`, `position`, `doe`) VALUES
('LEC-000001', 'FAC-000001', 'DEP-000001', 'Michael', 'Agbeko', 'Nartey', 'michael@gmail.com', '0541524233', 'lecturer', '2019-03-03 20:03:35'),
('LEC-000002', 'FAC-000001', 'DEP-000001', 'Michael', 'Delove', 'Kwame', 'michael@ymail.com', '0269807823', 'lecturer', '2019-03-03 20:03:41'),
('LEC-000003', 'FAC-000001', 'DEP-000001', 'Mary', 'Sheela', 'Immaculate', 'sheela@gmail.com', '0207892496', 'dean', '2019-03-03 20:03:43'),
('LEC-000004', 'FAC-000001', 'DEP-000001', 'Charlse', 'Andoh', 'Boabeng', 'charlse@gmail.com', '0541114785', 'hod', '2019-03-21 13:03:32'),
('LEC-000005', 'FAC-000001', 'DEP-000001', 'Savior', 'Okine', '', 'savior@gmail.com', '0201425875', 'lecturer', '2019-06-07 09:57:47'),
('LEC-000006', 'FAC-000001', 'DEP-000001', 'Fred', 'Tottimeh', '', 'fred@gmail.com', '0201154875', 'lecturer', '2019-06-07 09:59:46');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `mid` int(255) NOT NULL,
  `sender` varchar(100) NOT NULL,
  `recipient` varchar(100) NOT NULL,
  `heading` longtext NOT NULL,
  `text` longtext NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` varchar(50) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`mid`, `sender`, `recipient`, `heading`, `text`, `date`, `time`, `status`, `doe`) VALUES
(1, 'PUC/190002', 'LEC-000001', 'Help On Project', 'Hello sir', '2019-06-02', '21:46:34', 'read', '2019-06-07 17:47:11');

-- --------------------------------------------------------

--
-- Table structure for table `message_reply`
--

CREATE TABLE `message_reply` (
  `rid` int(255) NOT NULL,
  `mid` int(255) NOT NULL,
  `sender` varchar(100) NOT NULL,
  `text` longtext NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` varchar(100) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message_reply`
--

INSERT INTO `message_reply` (`rid`, `mid`, `sender`, `text`, `date`, `time`, `status`, `doe`) VALUES
(1, 1, 'LEC-000001', 'Hello enoch', '2019-06-06', '22:42:09', 'unread', '2019-06-06 22:42:09');

-- --------------------------------------------------------

--
-- Table structure for table `objans`
--

CREATE TABLE `objans` (
  `id` int(255) NOT NULL,
  `testID` varchar(20) NOT NULL,
  `qid` int(20) NOT NULL,
  `studentID` varchar(50) NOT NULL,
  `answer` int(10) NOT NULL,
  `right_ans` int(10) NOT NULL,
  `score` int(5) NOT NULL,
  `doe` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `objans`
--

INSERT INTO `objans` (`id`, `testID`, `qid`, `studentID`, `answer`, `right_ans`, `score`, `doe`) VALUES
(1, '0754511', 1, 'PUC/150332', 1, 2, 0, '2019-06-08 20:57:36'),
(2, '0754511', 2, 'PUC/150332', 2, 4, 0, '2019-06-08 20:57:36'),
(3, '0754511', 3, 'PUC/150332', 2, 1, 0, '2019-06-08 20:57:36');

-- --------------------------------------------------------

--
-- Table structure for table `objtest`
--

CREATE TABLE `objtest` (
  `qid` int(255) NOT NULL,
  `testID` varchar(20) NOT NULL,
  `question` longtext NOT NULL,
  `option1` varchar(255) NOT NULL,
  `option2` varchar(255) NOT NULL,
  `option3` varchar(255) NOT NULL,
  `option4` varchar(255) NOT NULL,
  `answer` int(10) NOT NULL,
  `doe` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `objtest`
--

INSERT INTO `objtest` (`qid`, `testID`, `question`, `option1`, `option2`, `option3`, `option4`, `answer`, `doe`) VALUES
(1, '0754511', 'One approach for organizing the clients and servers is to distribute the programs in the application layers across different machines, this is known as ?', 'Hybrid Architecture', 'multi-tiered Architecture.', 'Decentralized Architecture', 'Centralized Architecture', 2, '0000-00-00 00:00:00'),
(2, '0754511', 'Examples of software architecture include Centralized, Decentralized and ... ?', 'Concentrated Architecture', 'Distributed Architecture', 'Combined Architecture', 'Hybrid Architecture', 4, '0000-00-00 00:00:00'),
(3, '0754511', '3 types of application layering include the user-interface level, the processing level and ... ?', 'Data Level', 'Digital Level', 'Output Level', 'Manufacturing Level', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `outline`
--

CREATE TABLE `outline` (
  `id` int(255) NOT NULL,
  `cID` varchar(50) NOT NULL,
  `lecID` varchar(50) NOT NULL,
  `outline` varchar(255) NOT NULL,
  `doe` datetime NOT NULL,
  `dor` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outline`
--

INSERT INTO `outline` (`id`, `cID`, `lecID`, `outline`, `doe`, `dor`) VALUES
(1, 'PUIS401', 'LEC-000005', 'PUIS401-outline.docx', '2019-06-07 10:16:43', '2019-06-07 10:16:43');

-- --------------------------------------------------------

--
-- Table structure for table `reqreading`
--

CREATE TABLE `reqreading` (
  `id` int(255) NOT NULL,
  `cID` varchar(50) NOT NULL,
  `lecID` varchar(50) NOT NULL,
  `readType` varchar(30) NOT NULL,
  `content` longtext NOT NULL,
  `doe` datetime NOT NULL,
  `dor` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reqreading`
--

INSERT INTO `reqreading` (`id`, `cID`, `lecID`, `readType`, `content`, `doe`, `dor`) VALUES
(1, 'PUIS401', 'LEC-000005', 'url', 'https://www.distributedsystems.com', '2019-06-07 10:27:48', '2019-06-07 10:27:48');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentID` varchar(50) NOT NULL,
  `depID` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `otherName` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `school` varchar(20) NOT NULL,
  `level` int(10) NOT NULL,
  `doe` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `depID`, `firstName`, `lastName`, `otherName`, `email`, `phone`, `school`, `level`, `doe`) VALUES
('1911199', 'DEP-000007', 'Kwame', 'Akwasi', 'Nipa', 'meandyou@us.com', '019900', 'Evening', 200, '2019-06-08 00:00:00'),
('PUC/150332', 'DEP-000001', 'Samuel', 'Sarpong', 'Bills', 'bills@gmail.com', '0209153288', 'Regular', 400, '2019-06-03 00:00:00'),
('PUC/160222', 'DEP-000001', 'Florence', 'Takyi', 'Ahemaa', 'ftakyi@gmail.com', '0268511953', 'Regular', 100, '2019-06-03 00:00:00'),
('PUC/190001', 'DEP-000001', 'Felix', 'Amponsah', 'Kofi', 'felix@gmail.com', '02487755412', 'Regular', 100, '2019-03-03 21:03:59'),
('PUC/190002', 'DEP-000001', 'Enoch', 'Tetteh', 'Paa Kwesi', 'enoch@gmail.com', '0544265478', 'Regular', 400, '2019-03-03 22:03:02'),
('PUC/190003', 'DEP-000001', 'Ijeoma', 'Onyesom', 'Peace', 'peace@gmail.com', '0261713219', 'Regular', 400, '2019-03-10 10:03:58');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(255) NOT NULL,
  `cID` varchar(50) NOT NULL,
  `testID` varchar(20) NOT NULL,
  `lecture` int(20) NOT NULL,
  `passMark` int(100) NOT NULL,
  `questionMark` int(30) NOT NULL,
  `duration` int(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `doe` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `cID`, `testID`, `lecture`, `passMark`, `questionMark`, `duration`, `status`, `doe`) VALUES
(1, 'PUIS401', '0754511', 2, 40, 10, 3600, '', '2019-06-07 10:53:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `userID` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `access` varchar(50) NOT NULL,
  `flogin` varchar(50) NOT NULL,
  `userstatus` varchar(100) NOT NULL,
  `onlinestatus` int(11) NOT NULL DEFAULT '0',
  `doe` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userID`, `email`, `password`, `access`, `flogin`, `userstatus`, `onlinestatus`, `doe`) VALUES
(1, 'USER-000001', 'godwinabeaku@gmail.com', 'password1.', 'manager', '2', '', 1, '2019-02-16 03:06:05'),
(8, 'LEC-000001', 'michael@gmail.com', 'password', 'lecturer', '2', '', 0, '2019-03-03 20:03:35'),
(10, 'LEC-000002', 'michael@ymail.com', '12161041', 'lecturer', '1', '', 0, '2019-03-03 20:03:41'),
(11, 'LEC-000003', 'sheela@gmail.com', '7468043', 'dean', '1', '', 0, '2019-03-03 20:03:43'),
(12, 'LEC-000004', 'okai@gmail.com', '1057416', 'lecturer', '1', '', 0, '2019-03-03 21:03:16'),
(13, 'LEC-000005', 'phil@gmail.com', '5763819', 'lecturer', '1', '', 0, '2019-03-03 21:03:19'),
(15, 'PUC/190001', 'felix@gmail.com', 'password', 'student', '2', '', 0, '2019-03-03 21:03:59'),
(16, 'PUC/190002', 'enoch@gmail.com', 'password1.', 'student', '2', '', 1, '2019-03-03 22:03:02'),
(18, 'PUC/190003', 'peace@gmail.com', 'peace', 'student', '2', '', 0, '2019-03-10 10:03:58'),
(19, 'LEC-000008', 'john@gmail.com', '4759913', 'lecturer', '1', '', 0, '2019-03-20 18:03:13'),
(20, 'LEC-000009', 'segbefia@gmail.com', 'password', 'hod', '2', '', 0, '2019-03-20 18:03:14'),
(21, 'LEC-000004', 'charlse@gmail.com', 'password', 'hod', '2', '', 0, '2019-03-21 13:03:32'),
(24, 'PUC/160222', 'ftakyi@gmail.com', 'takyi', 'student', '2', '', 0, '2019-06-03 00:00:00'),
(25, 'PUC/150332', 'bills@gmail.com', 'bills2', 'student', '2', '', 0, '2019-06-03 00:00:00'),
(26, 'LEC-000005', 'savior@gmail.com', 'password', 'lecturer', '2', '', 0, '2019-06-07 09:57:47'),
(27, 'LEC-000006', 'fred@gmail.com', '7061959', 'lecturer', '1', '', 0, '2019-06-07 09:59:46'),
(28, '1911199', 'meandyou@us.com', 'smallboy', 'student', '2', '', 0, '2019-06-08 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit`
--
ALTER TABLE `audit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cdocument`
--
ALTER TABLE `cdocument`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cmanagement`
--
ALTER TABLE `cmanagement`
  ADD PRIMARY KEY (`assignID`),
  ADD KEY `cID` (`cID`);

--
-- Indexes for table `cmedia`
--
ALTER TABLE `cmedia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`cID`),
  ADD KEY `depID` (`depID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`depID`),
  ADD KEY `facID` (`facID`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`facID`);

--
-- Indexes for table `generalreport`
--
ALTER TABLE `generalreport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecture`
--
ALTER TABLE `lecture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`lecID`),
  ADD KEY `depID` (`depID`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `message_reply`
--
ALTER TABLE `message_reply`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `objans`
--
ALTER TABLE `objans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `objtest`
--
ALTER TABLE `objtest`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `outline`
--
ALTER TABLE `outline`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reqreading`
--
ALTER TABLE `reqreading`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentID`),
  ADD KEY `depID` (`depID`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `userID` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit`
--
ALTER TABLE `audit`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `cdocument`
--
ALTER TABLE `cdocument`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cmanagement`
--
ALTER TABLE `cmanagement`
  MODIFY `assignID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cmedia`
--
ALTER TABLE `cmedia`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `generalreport`
--
ALTER TABLE `generalreport`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lecture`
--
ALTER TABLE `lecture`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `mid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `message_reply`
--
ALTER TABLE `message_reply`
  MODIFY `rid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `objans`
--
ALTER TABLE `objans`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `objtest`
--
ALTER TABLE `objtest`
  MODIFY `qid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `outline`
--
ALTER TABLE `outline`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reqreading`
--
ALTER TABLE `reqreading`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
