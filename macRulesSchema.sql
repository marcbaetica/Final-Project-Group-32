-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 19, 2015 at 08:28 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `macRulesSchema`
--
CREATE DATABASE IF NOT EXISTS `macRulesSchema` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `macRulesSchema`;

-- --------------------------------------------------------

--
-- Table structure for table `macRulesTable`
--

DROP TABLE IF EXISTS `macRulesTable`;
CREATE TABLE IF NOT EXISTS `macRulesTable` (
`entry` int(11) NOT NULL,
  `mac` bigint(228) NOT NULL,
  `block` int(3) DEFAULT '1',
  `user_total` bigint(9) DEFAULT '20',
  `total_all` bigint(9) DEFAULT '60',
  `start_time` time DEFAULT '12:00:00',
  `stop_time` time DEFAULT '12:00:00',
  `bw_limit` bigint(10) DEFAULT '4294967294',
  `current_user_usage` bigint(10) DEFAULT '15',
  `current_total_usage` bigint(10) DEFAULT '20',
  `terminal_name` varchar(17) DEFAULT NULL,
  `total_bw` bigint(10) NOT NULL DEFAULT '15000',
  `total_data` bigint(15) NOT NULL DEFAULT '60000000000'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `UserInfoTable`
--

DROP TABLE IF EXISTS `UserInfoTable`;
CREATE TABLE IF NOT EXISTS `UserInfoTable` (
`index` int(11) NOT NULL,
  `Nwrk_DataCap` int(11) NOT NULL DEFAULT '60',
  `Nwrk_BW` int(11) NOT NULL DEFAULT '15'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `UserInfoTable`
--

INSERT INTO `UserInfoTable` (`index`, `Nwrk_DataCap`, `Nwrk_BW`) VALUES
(1, 60, 15);

-- --------------------------------------------------------

--
-- Table structure for table `users_session`
--

DROP TABLE IF EXISTS `users_session`;
CREATE TABLE IF NOT EXISTS `users_session` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `macRulesTable`
--
ALTER TABLE `macRulesTable`
 ADD PRIMARY KEY (`entry`);

--
-- Indexes for table `UserInfoTable`
--
ALTER TABLE `UserInfoTable`
 ADD PRIMARY KEY (`index`);

--
-- Indexes for table `users_session`
--
ALTER TABLE `users_session`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `macRulesTable`
--
ALTER TABLE `macRulesTable`
MODIFY `entry` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `UserInfoTable`
--
ALTER TABLE `UserInfoTable`
MODIFY `index` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users_session`
--
ALTER TABLE `users_session`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
