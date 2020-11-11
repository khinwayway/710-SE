-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2020 at 07:15 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `list_id` int(3) NOT NULL,
  `town` varchar(50) NOT NULL,
  `flat_type` varchar(50) NOT NULL,
  `flat_model` varchar(50) NOT NULL,
  `block` int(3) NOT NULL,
  `street_name` varchar(100) NOT NULL,
  `remaining_lease` int(3) NOT NULL,
  `price` int(6) NOT NULL,
  `seller_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`list_id`, `town`, `flat_type`, `flat_model`, `block`, `street_name`, `remaining_lease`, `price`, `seller_id`) VALUES
(1, 'BUKIT BATOK', '3 ROOM', 'Standard', 244, 'BT BATOK EAST AVE 5', 64, 450000, 1),
(3, 'BUKIT BATOK', '4 ROOM', 'DBSS', 283, 'BUKIT BATOK WEST AVE 6', 69, 369000, 54),
(4, 'CHOA CHU KANG', '4 ROOM', 'Standard', 427, 'CHOA CHU KANG AVE 4', 75, 654321, 15),
(7, 'WOODLANDS', '4 ROOM', 'Model A', 588, 'WOODLANDS DR 18', 85, 420000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `type` int(1) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `hp` int(8) NOT NULL,
  `verification` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `type`, `username`, `password`, `email`, `hp`, `verification`) VALUES
(3, 1, 'thisisbiged', '468427ee7e02d7eb3bba300ee68dc635', 'ahmadjaz001@e.ntu.edu.sg', 88233991, 0),
(5, 1, 'sdada', '904f54642bb09ec9b61675650f012222', 'ilzajazli@yahoo.com.sg', 7785432, 0),
(6, 1, 'ajazli', 'ac92a11da3ef1a027bd734bca7345f55', 'ajazli97@gmail.com', 88262590, 0),
(7, 1, 'yejiitzy', 'ffceba0b2b56c37d23650435bb220cb6', 'yeji@jype.com.kr', 33442299, 0),
(8, 1, 'abcdef', '25f9e794323b453885f5181f1b624d0b', '8jcrc.xvi@gmail.com', 33456789, 0),
(9, 1, 'abcdefgh', 'a0ac4e77dc0916c07d6ca040b82bb363', 'ajsjdlsajfd@gmail.com', 88888888, 0),
(10, 1, 'yoyoyo', '33bcea61ff7edac1e6c777b5d6607076', 'yoyoyo@yoyo.com', 12345678, 0),
(11, 1, 'hihihi', 'c4bb408471eb7727e59e11385b0a8c19', 'hihihi@hihi.com', 87654321, 0),
(12, 1, 'btstxt', '43334fe4b79fd7dbc08401dc0c5cf420', 'bangpd@ibighit.corp', 82838439, 0),
(13, 1, 'got7', '260bc58a3fe517bdaa95e5d93e952561', 'got7@jype.com', 33445566, 0),
(14, 1, 'asdfg', '62cadae65f54888f214aa0673003ab59', 'sdafg@gmail.com', 123456778, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`list_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `list_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
