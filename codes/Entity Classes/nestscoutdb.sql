-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2020 at 04:40 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nestscout`
--

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `PropertyID` int(11) NOT NULL,
  `Address` varchar(256) NOT NULL,
  `Block` int(3) NOT NULL,
  `Price` int(11) NOT NULL,
  `Town` varchar(50) NOT NULL,
  `Flat_Type` varchar(50) NOT NULL,
  `Flat_Model` varchar(50) NOT NULL,
  `Lease` int(2) NOT NULL,
  `Amenities` varchar(256) DEFAULT NULL,
  `About` varchar(300) DEFAULT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`PropertyID`, `Address`, `Block`, `Price`, `Town`, `Flat_Type`, `Flat_Model`, `Lease`, `Amenities`, `About`, `UserID`) VALUES
(1, 'BUKIT BATOK WEST AVE 6', 420, 690000, 'BUKIT BATOK', '4 ROOM', 'Standard', 87, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `Type` int(1) NOT NULL,
  `FirstName` varchar(20) DEFAULT NULL,
  `LastName` varchar(20) DEFAULT NULL,
  `BirthDate` varchar(8) DEFAULT NULL,
  `Gender` char(1) DEFAULT NULL,
  `CurrentAddress` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`, `PhoneNumber`, `Type`, `FirstName`, `LastName`, `BirthDate`, `Gender`, `CurrentAddress`) VALUES
(2, 'lizard', '429769aafaeb20ac638f', 'lizard@hello.com', '11247012', 2, 'liz', 'ard', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`PropertyID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `PropertyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
