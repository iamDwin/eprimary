-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 10, 2019 at 12:23 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

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
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `asID` int(255) NOT NULL,
  `cID` varchar(100) NOT NULL,
  `lecNum` int(10) NOT NULL,
  `type` varchar(100) NOT NULL,
  `question` longtext NOT NULL,
  `overallMark` int(100) NOT NULL,
  `passMark` int(100) NOT NULL,
  `dueDate` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `doe` datetime NOT NULL,
  `dor` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`asID`, `cID`, `lecNum`, `type`, `question`, `overallMark`, `passMark`, `dueDate`, `status`, `doe`, `dor`) VALUES
(1, 'PUIS221', 2, '', '', 20, 15, '2019-05-03', '', '2019-05-06 17:04:31', '2019-05-06 17:04:31'),
(3, 'PUIS221', 2, 'text', '', 22, 5, '2019-05-08', '', '2019-05-06 18:57:53', '2019-05-06 18:57:53'),
(4, 'PUIS221', 1, 'text', 'this is an assignment', 50, 35, '2019-05-17', '', '2019-05-07 13:23:05', '2019-05-07 18:56:56'),
(5, 'PUIS221', 2, 'file', 'uploads/PUIS221/assignment/PUIS221-assigment4.pdf', 50, 40, '2019-05-23', '', '2019-05-07 13:31:26', '2019-05-07 13:31:26');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_answers`
--

CREATE TABLE `assignment_answers` (
  `id` int(255) NOT NULL,
  `asID` varchar(100) NOT NULL,
  `studentID` varchar(100) NOT NULL,
  `answer` longtext NOT NULL,
  `score` int(100) NOT NULL,
  `doe` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'PUIS221', 'LEC-000001', 1, 'AI LECTURE 1.pptx', '2019-03-29 07:06:50', '2019-03-29 07:06:50'),
(2, 'PUIS221', 'LEC-000001', 4, 'AI LECTURE 4.pptx', '2019-03-29 07:16:32', '2019-03-29 07:16:32'),
(3, 'PUIS221', 'LEC-000001', 1, 'Account Opening Forms - Individual or Joint Account (2).pdf', '2019-04-28 13:43:38', '2019-04-28 13:43:38'),
(4, 'PUIS221', 'LEC-000001', 1, 'dataDictionary.pdf', '2019-05-03 01:59:16', '2019-05-03 01:59:16');

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
(8, 'DEP-000001', 'PUIS221', 'LEC-000001', '2019-03-29 02:03:48'),
(9, 'DEP-000001', 'PUIT123', 'LEC-000005', '2019-03-29 02:03:48');

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

--
-- Dumping data for table `cmedia`
--

INSERT INTO `cmedia` (`id`, `cID`, `lecID`, `lecture`, `mediatype`, `mediaName`, `path`, `doe`, `dor`) VALUES
(1, 'PUIS221', 'LEC-000001', 3, 'audio', 'elShaddai.mp3', '', '2019-03-29 07:09:04', '2019-03-29 07:11:28'),
(2, 'PUIS221', 'LEC-000001', 4, 'video', 'Ink In Motion.mp4', '', '2019-03-29 07:16:32', '2019-03-29 07:16:32');

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
('PUIS221', 'DEP-000001', 'Distributed Systems', 400, 2, '2019-03-29 02:03:46'),
('PUIT123', 'DEP-000001', 'Systems Integration', 400, 1, '2019-03-29 02:03:46');

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
('DEP-000007', 'FAC-000005', 'FTB DEP', '2019-03-26 11:03:25'),
('DEP-000008', 'FAC-000001', 'INFORMATION TECHNOLOGY 2', '2019-03-26 11:03:26');

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
(1, 'PUC/190002', 'PUIS221', '1007461', 15, 'FAILED', '2019-04-13 08:48:44'),
(2, 'PUC/190003', 'PUIS221', '1007461', 30, 'PASS', '2019-04-13 08:57:47');

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
(3, 'PUIS221', 'LEC-000001', 1, 'Introduction', '2019-03-29 07:06:50', '2019-04-28 13:43:54'),
(4, 'PUIS221', 'LEC-000001', 2, 'Literature Review', '2019-03-29 07:08:08', '2019-03-29 07:08:08'),
(5, 'PUIS221', 'LEC-000001', 3, 'Literature Review 2', '2019-03-29 07:09:04', '2019-04-28 13:44:49'),
(6, 'PUIS221', 'LEC-000001', 4, 'Conclusion', '2019-03-29 07:16:32', '2019-03-29 07:16:32');

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
('LEC-000003', 'FAC-000001', 'DEP-000001', 'Mary', 'Sheela', 'Immaculate', 'sheela@gmail.com', '0207892495', 'dean', '2019-03-03 20:03:43'),
('LEC-000004', 'FAC-000001', 'DEP-000001', 'Charlse', 'Andoh', 'Boabeng', 'charlse@gmail.com', '0541114785', 'hod', '2019-03-21 13:03:32'),
('LEC-000005', 'FAC-000001', 'DEP-000001', 'Godwin', 'Effah', 'Goodman', 'godwinabeaku2@ymail.com', '0207892496', 'lecturer', '2019-05-01 14:00:28'),
('LEC-000006', 'FAC-000001', 'DEP-000001', 'Michael', 'Segbefia', 'Sena', 'khasperh@gmail.com', '0541785085', 'lecturer', '2019-05-03 01:18:13');

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
(1, 'PUC/190002', 'LEC-000002', 'Greetins from Above', 'Hello sir, i send my warm regards', '2019-04-27', '13:35:38', 'read', '2019-04-27 13:35:50');

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
(1, '1007461', 1, 'PUC/190002', 4, 3, 0, '2019-04-13 07:35:48'),
(2, '1007461', 2, 'PUC/190002', 2, 2, 5, '2019-04-13 07:35:48'),
(3, '1007461', 3, 'PUC/190002', 4, 4, 5, '2019-04-13 07:35:48'),
(4, '1007461', 4, 'PUC/190002', 1, 2, 0, '2019-04-13 07:35:48'),
(5, '1007461', 5, 'PUC/190002', 2, 1, 0, '2019-04-13 07:35:48'),
(6, '1007461', 6, 'PUC/190002', 2, 2, 5, '2019-04-13 07:35:48'),
(7, '1007461', 1, 'PUC/190003', 3, 3, 5, '2019-04-13 08:57:08'),
(8, '1007461', 2, 'PUC/190003', 2, 2, 5, '2019-04-13 08:57:08'),
(9, '1007461', 3, 'PUC/190003', 4, 4, 5, '2019-04-13 08:57:08'),
(10, '1007461', 4, 'PUC/190003', 2, 2, 5, '2019-04-13 08:57:08'),
(11, '1007461', 5, 'PUC/190003', 1, 1, 5, '2019-04-13 08:57:08'),
(12, '1007461', 6, 'PUC/190003', 2, 2, 5, '2019-04-13 08:57:08');

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
(1, '1007461', 'first Question', 'first', 'second', 'third', 'fourth', 3, '0000-00-00 00:00:00'),
(2, '1007461', 'first Question 2', 'first 2', 'second 2', 'third 2', 'fourth 2', 2, '0000-00-00 00:00:00'),
(3, '1007461', 'first Question 3', 'first 3', 'second 3', 'third 3', 'fourth 3', 4, '0000-00-00 00:00:00'),
(4, '1007461', 'One way you can become loyal to the group.', 'Be a good ambassador', 'Never withhold personal information', 'Ensure that everything is well with yourself', 'Do not become a receiver of complaints but giver of bad news.', 2, '0000-00-00 00:00:00'),
(5, '1007461', 'Bad habits are easy to form and not difficult to live with whiles good habits are easy to form and easy to live with', 'True', 'False', 'Maybe', 'None', 1, '0000-00-00 00:00:00'),
(6, '1007461', 'He persisted and his relentless efforts paid off in the end. He failed in business in 1831, He was defeated for legislature in 1832, He experienced a second failure in business in 1833, He suffered nervous breakdown in 1836, He was defeated for Speaker in 1838, He was defeated for Elector in 1840, He was defeated for Congress in 1843.', 'John Fitzgerald Kennedy', 'Bill Clinton', 'Abraham Lincoln', 'George Bush', 2, '0000-00-00 00:00:00'),
(7, '1342232', 'first Question 2', 'first', 'second 2', 'third 2', 'fourth', 2, '0000-00-00 00:00:00');

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
(1, 'PUIS221', 'LEC-000001', 'PUIS221-outline.doc', '2019-03-29 03:41:59', '2019-03-29 03:41:59'),
(3, 'PUIT123', 'LEC-000001', 'PUIT123-outline.doc', '2019-03-29 04:59:34', '2019-03-29 04:59:34');

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
(2, 'PUIS221', 'LEC-000001', 'book', 'Morden Day Distributed Systems by John D.A Goodman', '2019-03-29 04:19:44', '2019-03-29 04:19:44'),
(3, 'PUIS221', 'LEC-000001', 'file', '9901993-dzone2018-researchguide-ai.pdf', '2019-03-29 04:32:00', '2019-03-29 04:32:00'),
(4, 'PUIT123', 'LEC-000001', 'url', 'http://localhost:8080/Elearn/form-elements.html', '2019-03-29 16:18:24', '2019-03-29 16:18:24'),
(5, 'PUIS221', 'LEC-000001', 'url', 'http://localhost:8080/Elearn/form-elements.html', '2019-04-19 12:28:54', '2019-04-19 12:28:54');

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
(1, 'PUIS221', '1007461', 1, 20, 5, 50, '', '2019-04-10 16:46:44'),
(2, 'PUIS221', '1342232', 2, 50, 2, 1500, '', '2019-04-13 09:24:11');

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
(1, 'USER-000001', 'godwinabeaku@gmail.com', 'password1.', 'manager', '2', '', 0, '2019-02-16 03:06:05'),
(8, 'LEC-000001', 'michael@gmail.com', 'password', 'lecturer', '2', '', 0, '2019-03-03 20:03:35'),
(10, 'LEC-000002', 'michael@ymail.com', '12161041', 'lecturer', '1', '', 0, '2019-03-03 20:03:41'),
(11, 'LEC-000003', 'sheela@gmail.com', '7468043', 'dean', '1', '', 0, '2019-03-03 20:03:43'),
(12, 'LEC-000004', 'okai@gmail.com', '1057416', 'lecturer', '1', '', 0, '2019-03-03 21:03:16'),
(13, 'LEC-000005', 'phil@gmail.com', '5763819', 'lecturer', '1', '', 0, '2019-03-03 21:03:19'),
(14, 'LEC-000006', 'fred@gmail.com', '4950421', 'lecturer', '1', '', 0, '2019-03-03 21:03:21'),
(15, 'PUC/190001', 'felix@gmail.com', 'password', 'student', '2', '', 0, '2019-03-03 21:03:59'),
(16, 'PUC/190002', 'enoch@gmail.com', 'password1.', 'student', '2', '', 0, '2019-03-03 22:03:02'),
(18, 'PUC/190003', 'peace@gmail.com', 'peace', 'student', '2', '', 0, '2019-03-10 10:03:58'),
(19, 'LEC-000008', 'john@gmail.com', '4759913', 'lecturer', '1', '', 0, '2019-03-20 18:03:13'),
(20, 'LEC-000009', 'segbefia@gmail.com', 'password', 'hod', '2', '', 0, '2019-03-20 18:03:14'),
(21, 'LEC-000004', 'charlse@gmail.com', 'password', 'hod', '2', '', 0, '2019-03-21 13:03:32'),
(22, 'LEC-000005', 'godwinabeaku2@ymail.com', 'password1.', 'lecturer', '2', '', 0, '2019-05-01 14:00:28'),
(25, 'LEC-000006', 'khasperh@gmail.com', 'sena', 'lecturer', '2', '', 0, '2019-05-03 01:18:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`asID`);

--
-- Indexes for table `assignment_answers`
--
ALTER TABLE `assignment_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cdocument`
--
ALTER TABLE `cdocument`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lecID` (`lecID`);

--
-- Indexes for table `cmanagement`
--
ALTER TABLE `cmanagement`
  ADD PRIMARY KEY (`assignID`),
  ADD KEY `cID` (`cID`),
  ADD KEY `lecID` (`lecID`);

--
-- Indexes for table `cmedia`
--
ALTER TABLE `cmedia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lecID` (`lecID`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `testID` (`testID`);

--
-- Indexes for table `lecture`
--
ALTER TABLE `lecture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cID` (`cID`);

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
  ADD PRIMARY KEY (`rid`),
  ADD KEY `mid` (`mid`);

--
-- Indexes for table `objans`
--
ALTER TABLE `objans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `qid` (`qid`);

--
-- Indexes for table `objtest`
--
ALTER TABLE `objtest`
  ADD PRIMARY KEY (`qid`),
  ADD KEY `testID` (`testID`);

--
-- Indexes for table `outline`
--
ALTER TABLE `outline`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lecID` (`lecID`);

--
-- Indexes for table `reqreading`
--
ALTER TABLE `reqreading`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lecID` (`lecID`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `cID` (`cID`);

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
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `asID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `assignment_answers`
--
ALTER TABLE `assignment_answers`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cdocument`
--
ALTER TABLE `cdocument`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cmanagement`
--
ALTER TABLE `cmanagement`
  MODIFY `assignID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cmedia`
--
ALTER TABLE `cmedia`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `generalreport`
--
ALTER TABLE `generalreport`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lecture`
--
ALTER TABLE `lecture`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `mid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `message_reply`
--
ALTER TABLE `message_reply`
  MODIFY `rid` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `objans`
--
ALTER TABLE `objans`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `objtest`
--
ALTER TABLE `objtest`
  MODIFY `qid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `outline`
--
ALTER TABLE `outline`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reqreading`
--
ALTER TABLE `reqreading`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cmanagement`
--
ALTER TABLE `cmanagement`
  ADD CONSTRAINT `cmanagement_ibfk_1` FOREIGN KEY (`cID`) REFERENCES `courses` (`cID`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`depID`) REFERENCES `department` (`depID`);

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_ibfk_1` FOREIGN KEY (`facID`) REFERENCES `faculty` (`facID`);

--
-- Constraints for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD CONSTRAINT `lecturer_ibfk_1` FOREIGN KEY (`depID`) REFERENCES `department` (`depID`);

--
-- Constraints for table `objans`
--
ALTER TABLE `objans`
  ADD CONSTRAINT `objans_ibfk_1` FOREIGN KEY (`qid`) REFERENCES `objtest` (`qid`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`depID`) REFERENCES `department` (`depID`),
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
