-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 06, 2019 at 01:43 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `GordBond-imgFiles`
--

-- --------------------------------------------------------

--
-- Table structure for table `imgFiles`
--

CREATE TABLE `imgFiles` (
  `img_id` int(11) NOT NULL,
  `head` varchar(65) NOT NULL DEFAULT 'img/head.jpg',
  `body` varchar(65) NOT NULL DEFAULT 'img/body.jpg',
  `legs` varchar(65) NOT NULL DEFAULT 'img/legs.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imgFiles`
--

INSERT INTO `imgFiles` (`img_id`, `head`, `body`, `legs`) VALUES
(2, 'img/drawings/h1.jpg', 'img/drawings/b1.jpg', 'img/drawings/l1.jpg'),
(3, 'img/drawings/h2.jpg', 'img/drawings/b2.jpg', 'img/drawings/l2.jpg'),
(4, 'img/drawings/h3.jpg', 'img/drawings/b3.jpg', 'img/drawings/l3.jpg'),
(5, 'img/drawings/h4.jpg', 'img/drawings/b4.jpg', 'img/drawings/l4.jpg'),
(6, 'img/drawings/h5.jpg', 'img/drawings/b5.jpg', 'img/drawings/l5.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `imgFiles`
--
ALTER TABLE `imgFiles`
  ADD PRIMARY KEY (`img_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `imgFiles`
--
ALTER TABLE `imgFiles`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
