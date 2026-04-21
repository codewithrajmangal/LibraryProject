-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2024 at 05:15 PM
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
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `BookId` int(10) NOT NULL,
  `Author` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`BookId`, `Author`) VALUES
(3, 'Jay Prakash'),
(5, 'x'),
(6, 'a1'),
(7, 'Bogart'),
(7, 'Kenneth'),
(8, 'Auer'),
(8, 'Davil J.'),
(9, 'Rob'),
(9, 'Williams'),
(10, 'Deiteil'),
(11, 'Sharma'),
(12, 'Barney Stinson'),
(13, 'Puri'),
(14, 'Manna'),
(15, 'Jindal U.C'),
(16, 'Prasad'),
(17, 'Aravind Alex'),
(17, 'Haldar Sibsankar'),
(18, 'Sandhu'),
(18, 'Singh'),
(19, 'ranjita'),
(20, 'rajita'),
(21, 'ranjita'),
(22, 'ranjita');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `BookId` int(10) NOT NULL,
  `Title` varchar(50) DEFAULT NULL,
  `Publisher` varchar(50) DEFAULT NULL,
  `Year` varchar(50) DEFAULT NULL,
  `Availability` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`BookId`, `Title`, `Publisher`, `Year`, `Availability`) VALUES
(2, 'DBMS', 'TARGET67', '2010', 0),
(3, 'TOC', 'NITC', '2018', 1),
(5, 'DAA', 'y', '2014', 0),
(6, 'DSA', 'X', '2010', 7),
(7, 'Discrete Structures', 'Pearson', '2010', 9),
(8, 'Database Processing', 'Prentice Hall', '2013', 8),
(9, 'Computer System Architecture', 'Prentice Hall', '2015', 4),
(10, 'C: How to program', 'Prentice Hall', '2009', 0),
(11, 'Atomic and Nuclear Systems', 'Pearson India ', '2017', 10),
(12, 'The PlayBook', 'Stinson', '2010', 9),
(13, 'General Theory of Relativity', 'Pearson India ', '2012', 2),
(14, 'Heat and Thermodynamics', 'Pearson', '2013', 6),
(15, 'Machine Design', 'Pearson India ', '2012', 1),
(16, 'Nuclear Physics', 'Pearson India ', '1998', 6),
(17, 'Operating System', 'Pearson India ', '1990', 6),
(18, 'Theory of Machines', 'Pearson', '1992', 10),
(19, 'OS', 'suman', '2005', 7),
(20, 'operating system', 'suman', '2005', 3),
(21, 'operating', 'su', '2005', 3),
(22, 'mobile programming', 'kec', '2025', -4);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `M_Id` int(10) NOT NULL,
  `RollNo` varchar(50) DEFAULT NULL,
  `Msg` varchar(255) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`M_Id`, `RollNo`, `Msg`, `Date`, `Time`) VALUES
(1, 'admin2', 'Your request for issue of BookId: 17  has been rejected', '2024-05-21', '14:15:03'),
(94, 'b07825', 'Your request for issue of BookId: 12  has been accepted', '2024-05-21', '21:36:28'),
(95, 'b07825', 'Your request for issue of BookId: 12 has been accepted', '2024-05-21', '21:36:28'),
(96, 'b07825', 'Your request for return of BookId: 12  has been accepted', '2024-05-21', '21:37:30'),
(97, 'c08001', 'Your request for issue of BookId: 12  has been accepted', '2024-05-22', '07:22:47'),
(98, 'c08001', 'Your request for issue of BookId: 12 has been accepted', '2024-05-22', '07:22:47'),
(99, 'c08001', 'this is test message', '2024-05-22', '07:30:35'),
(100, 'b07817', 'Your request for issue of BookId: 19  has been accepted', '2024-05-28', '09:58:14'),
(101, 'b07817', 'Your request for issue of BookId: 19 has been accepted', '2024-05-28', '09:58:14'),
(102, 'b07825', 'Your request for issue of BookId: 19  has been accepted', '2024-05-28', '12:06:03'),
(103, 'b07825', 'Your request for issue of BookId: 19 has been accepted', '2024-05-28', '12:06:03'),
(104, 'b07825', 'Your request for issue of BookId: 18  has been accepted', '2024-05-28', '12:30:46'),
(105, 'b07825', 'Your request for issue of BookId: 18 has been accepted', '2024-05-28', '12:30:46'),
(106, 'b07825', 'Your request for issue of BookId: 6  has been accepted', '2024-05-28', '12:35:56'),
(107, 'b07825', 'Your request for return of BookId: 19  has been accepted', '2024-05-28', '12:45:13'),
(108, 'b07825', 'Your request for issue of BookId: 3  has been accepted', '2024-05-28', '12:51:07'),
(109, 'b07825', 'Your request for return of BookId: 6  has been accepted', '2024-05-28', '12:52:58'),
(110, 'b07804', 'Your request for issue of BookId: 14  has been accepted', '2024-05-28', '15:20:15'),
(111, 'b08035', 'Your request for issue of BookId: 6  has been accepted', '2024-05-28', '15:44:48'),
(112, 'b07825', 'Your request for issue of BookId: 17  has been accepted', '2024-05-29', '10:12:50');

-- --------------------------------------------------------

--
-- Table structure for table `recommendations`
--

CREATE TABLE `recommendations` (
  `R_ID` int(10) NOT NULL,
  `Book_Name` varchar(50) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `RollNo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `recommendations`
--

INSERT INTO `recommendations` (`R_ID`, `Book_Name`, `Description`, `RollNo`) VALUES
(13, 'eat that from', 'best book for overcoming procastination', 'b07825'),
(14, 'eat that frog', 'best book for overcoming procastination', 'c08001'),
(15, 'os', 'insert this', 'b07825');

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

CREATE TABLE `record` (
  `RollNo` varchar(50) NOT NULL,
  `BookId` int(10) NOT NULL,
  `Date_of_Issue` date DEFAULT NULL,
  `Due_Date` date DEFAULT NULL,
  `Date_of_Return` date DEFAULT NULL,
  `Dues` int(10) DEFAULT NULL,
  `Renewals_left` int(10) DEFAULT NULL,
  `Time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `record`
--

INSERT INTO `record` (`RollNo`, `BookId`, `Date_of_Issue`, `Due_Date`, `Date_of_Return`, `Dues`, `Renewals_left`, `Time`) VALUES
('admin1', 8, '2024-05-18', '2024-11-14', '2024-05-18', -180, 1, NULL),
('admin2', 6, '2024-05-21', '2024-11-17', '2024-05-21', -180, 1, NULL),
('b07701', 14, '2024-05-19', '2024-11-15', '2024-05-19', -180, 1, NULL),
('b07804', 14, '2024-05-28', '2024-07-27', NULL, NULL, 1, NULL),
('b07817', 19, '2024-05-28', '2024-11-24', NULL, NULL, 1, NULL),
('b07825', 3, '2024-05-28', '2024-07-27', NULL, NULL, 1, NULL),
('b07825', 6, '2024-05-28', '2024-07-27', '2024-05-28', -60, 1, NULL),
('b07825', 12, '2024-05-21', '2024-11-17', '2024-05-21', -180, 1, NULL),
('b07825', 17, '2024-05-29', '2024-07-28', NULL, NULL, 1, NULL),
('b07825', 18, '2024-05-28', '2024-11-24', NULL, NULL, 1, NULL),
('b07825', 19, '2024-05-28', '2024-11-24', '2024-05-28', -180, 1, NULL),
('b08035', 6, '2024-05-28', '2024-07-27', NULL, NULL, 1, NULL),
('b08035', 18, NULL, NULL, NULL, NULL, NULL, NULL),
('c08001', 12, '2024-05-22', '2024-11-18', NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `renew`
--

CREATE TABLE `renew` (
  `RollNo` varchar(50) NOT NULL,
  `BookId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `renew`
--

INSERT INTO `renew` (`RollNo`, `BookId`) VALUES
('b08035', 6);

-- --------------------------------------------------------

--
-- Table structure for table `return`
--

CREATE TABLE `return` (
  `RollNo` varchar(50) NOT NULL,
  `BookId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `return`
--

INSERT INTO `return` (`RollNo`, `BookId`) VALUES
('b08035', 6);

-- --------------------------------------------------------

--
-- Table structure for table `temp_user`
--

CREATE TABLE `temp_user` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `Category` varchar(50) NOT NULL,
  `RollNo` varchar(50) NOT NULL,
  `EmailId` varchar(255) NOT NULL,
  `MobNo` varchar(15) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `VerificationCode` varchar(6) NOT NULL,
  `VerificationExpiry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temp_user`
--

INSERT INTO `temp_user` (`ID`, `Name`, `Type`, `Category`, `RollNo`, `EmailId`, `MobNo`, `Password`, `VerificationCode`, `VerificationExpiry`) VALUES
(30, 'Suman Dangal', 'Student', 'bca', 'bca', 'sumandagalpro@gmail.com', '9803340062', '$2y$10$qcRysEjXhRD0LF/houf29.JRqT.cmjk9JwL/4pHXk73fEcW2vuwMe', '948268', '2024-05-28 10:25:18'),
(32, 'Suman Dangal', 'Student', 'bca', 'b07825', 'sumandangalpro@gmail.com', '9803340062', '$2y$10$Vlxl0y5RyUCeo72nBkZB7e9d9TOrBAJWC8J3.9Xgiz5b6yb.UJ1Me', '576517', '2024-05-28 11:05:24'),
(44, 'ranjita ghimire', 'Student', 'bca', 'b08001', 'abc@gmail.com', '9866126783', '$2y$10$wagpFOBoqxz4dqUpw4vDMOeGxf3ZHFzdJG47/SsaVsMKKBQmD2fvW', '925269', '2024-05-29 11:25:06');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `RollNo` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `Category` varchar(20) NOT NULL,
  `EmailId` varchar(50) NOT NULL,
  `MobNo` varchar(11) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`RollNo`, `Name`, `Type`, `Category`, `EmailId`, `MobNo`, `Password`) VALUES
('admin1', 'admin first', 'Admin', '', 'adminfirst@gmail.com', '9803350052', 'admin@123'),
('admin2', 'admin second', 'Admin', '', 'adminsecond@gmail.com', '9803350051', '$2y$10$GH46jMJ1oJUTemNplsOHfu4XqX/YZypXi.yEb36YLjaWVb6BH6jvi'),
('admin3', 'admin third', 'Admin', '', 'adminthird@gmail.com', '9803350053', '$2y$10$PPS1GIpl5cWb2RUT6/zF3ONnt8ILUu6ASHYQSwVzmzMyLOES5CS.u'),
('b07701', 'second user', 'Student', 'bca', 'seconduser@gmail.com', '9803340062', 'user@123'),
('b07804', 'user one', 'Student', 'bca', 'sijan.dhami@gmail.com', '9803340062', '$2y$10$tddwJVGw7P0s/LNjd302ue2rzQpMgla.1Lxxy4MQuUwGFIF4g7MH2'),
('b07817', 'Ranjita Ghimire', 'Student', 'bca', 'sumandangalbro@gmail.com', '9803340062', '$2y$10$PhS7roJo1Y83gE86EXpw7OQsaQUyvb.0Y7c33/8gzFanV8ilpHGc2'),
('b07825', 'Suman Dangal', 'Student', 'bca', 'countryanother0@gmail.com', '9803340062', '$2y$10$n7S8yfG.4OaGlBlBFg.cs.q8WHhpyp3rO7i.mUOd79F9mEql1q3fG'),
('b07901', 'ajaya tamang', 'Student', 'bca', 'ajaya@gmail.com', '9800045587', '$2y$10$GpMu9hF5NW/whKce.o445OwXo7Lrg9TYtVyQu5yx/vrcr24De7nk2'),
('b07906', 'anup shrestha', 'Student', 'bca', 'anupshrestha@gmail.com', '9800045587', ' password_hash(user@123, PASSWORD_DEFAULT)'),
('b08035', 'user four', 'Student', 'bca', 'srijan.dhami@gmail.com', '9803340062', '$2y$10$pvRhio1DOJPEWtqOqYHdpucPI6GNKwI1hBR8Mms58jikBfa4w0ipi'),
('c08001', 'prashant sir', 'Student', 'csit', 'prashant.kct@gmail.com', '9803340062', '$2y$10$117Pi/lGe3twtkUIejigLOSEVpffybBfab1o8ymfDKZNtlxrke75O');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`BookId`,`Author`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`BookId`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`M_Id`),
  ADD KEY `RollNo` (`RollNo`);

--
-- Indexes for table `recommendations`
--
ALTER TABLE `recommendations`
  ADD PRIMARY KEY (`R_ID`),
  ADD KEY `RollNo` (`RollNo`);

--
-- Indexes for table `record`
--
ALTER TABLE `record`
  ADD PRIMARY KEY (`RollNo`,`BookId`),
  ADD KEY `BookId` (`BookId`);

--
-- Indexes for table `renew`
--
ALTER TABLE `renew`
  ADD PRIMARY KEY (`RollNo`,`BookId`),
  ADD KEY `BookId` (`BookId`);

--
-- Indexes for table `return`
--
ALTER TABLE `return`
  ADD PRIMARY KEY (`RollNo`,`BookId`),
  ADD KEY `BookId` (`BookId`);

--
-- Indexes for table `temp_user`
--
ALTER TABLE `temp_user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `EmailId` (`EmailId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`RollNo`),
  ADD UNIQUE KEY `EmailId` (`EmailId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `BookId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `M_Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `recommendations`
--
ALTER TABLE `recommendations`
  MODIFY `R_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `temp_user`
--
ALTER TABLE `temp_user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `author`
--
ALTER TABLE `author`
  ADD CONSTRAINT `author_ibfk_1` FOREIGN KEY (`BookId`) REFERENCES `book` (`BookId`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`RollNo`) REFERENCES `user` (`RollNo`);

--
-- Constraints for table `recommendations`
--
ALTER TABLE `recommendations`
  ADD CONSTRAINT `recommendations_ibfk_1` FOREIGN KEY (`RollNo`) REFERENCES `user` (`RollNo`);

--
-- Constraints for table `record`
--
ALTER TABLE `record`
  ADD CONSTRAINT `record_ibfk_1` FOREIGN KEY (`RollNo`) REFERENCES `user` (`RollNo`),
  ADD CONSTRAINT `record_ibfk_2` FOREIGN KEY (`BookId`) REFERENCES `book` (`BookId`);

--
-- Constraints for table `renew`
--
ALTER TABLE `renew`
  ADD CONSTRAINT `renew_ibfk_1` FOREIGN KEY (`RollNo`) REFERENCES `user` (`RollNo`),
  ADD CONSTRAINT `renew_ibfk_2` FOREIGN KEY (`BookId`) REFERENCES `book` (`BookId`);

--
-- Constraints for table `return`
--
ALTER TABLE `return`
  ADD CONSTRAINT `return_ibfk_1` FOREIGN KEY (`RollNo`) REFERENCES `user` (`RollNo`),
  ADD CONSTRAINT `return_ibfk_2` FOREIGN KEY (`BookId`) REFERENCES `book` (`BookId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
