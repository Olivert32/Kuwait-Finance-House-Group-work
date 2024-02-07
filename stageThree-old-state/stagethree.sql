-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 31, 2023 at 12:21 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stageThree`
--

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `documentID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `filePath` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `level` varchar(20) NOT NULL,
  `date` varchar(15) NOT NULL,
  `editorID` int(11) DEFAULT NULL,
  `editDate` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `summary`
--

CREATE TABLE `summary` (
  `summary_id` int(11) NOT NULL,
  `action` varchar(50) NOT NULL,
  `date` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `timeline`
--

CREATE TABLE `timeline` (
  `action_ID` int(11) NOT NULL,
  `action_name` varchar(255) NOT NULL,
  `action_userID` int(11) NOT NULL,
  `action_documentID` int(11) DEFAULT NULL,
  `hour` varchar(20) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` int(25) NOT NULL,
  `role` varchar(10) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `isVerified` int(11) NOT NULL DEFAULT 0,
  `newUser` int(11) NOT NULL DEFAULT 0,
  `validationCode` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `username`, `password`, `firstName`, `lastName`, `email`, `mobile`, `role`, `active`, `isVerified`, `newUser`, `validationCode`) VALUES
(1000, 'admin', '$2y$10$m8Dvj.ZxpS.0WLbDy4ZPUesEulwBQcXrLUDBIhfi85rrVu0ic7w76', 'Ryan', 'Smith', 'sammo@gmail.com', 712392343, 'admin', 1, 0, 1, 0),
(1002, 'add', '$2y$10$m8Dvj.ZxpS.0WLbDy4ZPUesEulwBQcXrLUDBIhfi85rrVu0ic7w76', 'Olivia', 'Emma', 'Olivia@gmail.com', 12345, 'adder', 1, 0, 1, 0),
(1003, 'edit', '$2y$10$m8Dvj.ZxpS.0WLbDy4ZPUesEulwBQcXrLUDBIhfi85rrVu0ic7w76', 'Ethan', 'David', 'Ethan@gmail.com', 12345, 'editor', 1, 0, 1, 0),
(1004, 'view', '$2y$10$m8Dvj.ZxpS.0WLbDy4ZPUesEulwBQcXrLUDBIhfi85rrVu0ic7w76', 'Ava', 'Sophia', 'Ava@gmail.com', 123, 'viewer', 0, 0, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`documentID`);

--
-- Indexes for table `summary`
--
ALTER TABLE `summary`
  ADD PRIMARY KEY (`summary_id`);

--
-- Indexes for table `timeline`
--
ALTER TABLE `timeline`
  ADD PRIMARY KEY (`action_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `documentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;

--
-- AUTO_INCREMENT for table `summary`
--
ALTER TABLE `summary`
  MODIFY `summary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;

--
-- AUTO_INCREMENT for table `timeline`
--
ALTER TABLE `timeline`
  MODIFY `action_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
