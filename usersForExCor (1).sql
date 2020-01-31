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
-- Database: `000786196`
--

-- --------------------------------------------------------

--
-- Table structure for table `usersForExCor`
--

CREATE TABLE `usersForExCor` (
  `id` int(11) NOT NULL,
  `userName` varchar(65) NOT NULL,
  `password1` varchar(65) NOT NULL,
  `head` varchar(65) DEFAULT NULL,
  `body` varchar(65) DEFAULT NULL,
  `legs` varchar(65) DEFAULT NULL,
  `head_id` int(11) DEFAULT NULL,
  `body_id` int(11) DEFAULT NULL,
  `legs_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usersForExCor`
--

INSERT INTO `usersForExCor` (`id`, `userName`, `password1`, `head`, `body`, `legs`, `head_id`, `body_id`, `legs_id`) VALUES
(25, 'test18', '$2y$10$LkZuOYRnh1esF31Z3WTol./BxNOR6ORIh2G/N9RDl7IU9AWRSGIuC', NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'test19', '$2y$10$Z/lSo2Mikdmah/dardPQsuQtsGEYrxtS/vUe9ki69yzT/RvTKdNdq', NULL, NULL, NULL, NULL, NULL, NULL),
(27, 'test20', '$2y$10$jc/IAs/PUZb1Th10hVeWx.MWWP0imASWNnXsK.URRTDgw6NrOasV2', NULL, NULL, NULL, NULL, NULL, NULL),
(28, 'gordbond', '$2y$10$27JdWmlSuyODW9/BTy90Zu.uIJ1A0viQBPNMoEeiagmb66OIcPtlK', 'img/drawings/h3.jpg', 'img/drawings/b2.jpg', 'img/drawings/l1.jpg', 4, 3, 2),
(29, 'test1', '$2y$10$W8EfRHmaVnewMdWMkAzK5OBxcXoRQP5AsEervHLfnTvH7UQxY.8fe', NULL, NULL, NULL, NULL, NULL, NULL),
(30, 'cammy', '$2y$10$J4beWDfIS/UAVT7HUM3GVujSz878FHFu4BnVy0JBE1yUySzmNe8rW', 'img/drawings/h3.jpg', 'img/drawings/b2.jpg', 'img/drawings/l1.jpg', 4, 3, 2),
(31, 'test2', '$2y$10$mFnZCyB4TxHt5WLfltwlDOj98Zz22PCfZ/QllWHSdJ97si5ROB13O', NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'test3', '$2y$10$OaKlEI7sSfqPmVOIzcKwrOM5Xy98weCrllfRN2SV6SmUj4b/O8sju', NULL, NULL, NULL, NULL, NULL, NULL),
(33, '', '$2y$10$FXRlbFazK0A6.wQ6Hg8r2uFhpiJwSc2t4/QhjM/NwPjMwO9MzW2lG', NULL, NULL, NULL, NULL, NULL, NULL),
(34, 'test4', '$2y$10$oiRQxFChOdAEnazx3jJ.pe2LPs9sI9Jctu5u3jpbWw9sp4R7DRQOm', NULL, NULL, NULL, NULL, NULL, NULL),
(35, 'lisabond', '$2y$10$c7t1kDd1cWSCKbctGjtHb.Neg5V28zzjhcxpZFAgI.aqBL//YXjme', NULL, NULL, NULL, NULL, NULL, NULL),
(36, 'test8', '$2y$10$FTbStwvrWA6Z41p.syJQMe8IVBQ7jFKE4n9dNSwYiFMhFjZFRreTS', NULL, NULL, NULL, NULL, NULL, NULL),
(37, 'gordbond1', '$2y$10$QzIMSRP6RWLrDrdiKMlRdOSxPm.RAaknWCPtqps2mJzNqVBgn2F4a', NULL, NULL, NULL, NULL, NULL, NULL),
(38, 'test15', '$2y$10$Qf8INUB2M.FDB7TalC/X1.58.DSz0e8ANny6/oxDT0PSHu9nDfffu', 'img/drawings/h2.jpg', 'img/drawings/b1.jpg', 'img/drawings/l1.jpg', 3, 2, 2),
(39, 'test16', '$2y$10$qj89fAx8P5iowQ63Y5be.O5fod9GDcgZqJnsF7leuQgzMb.cHPfDO', NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usersForExCor`
--
ALTER TABLE `usersForExCor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usersForExCor`
--
ALTER TABLE `usersForExCor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
