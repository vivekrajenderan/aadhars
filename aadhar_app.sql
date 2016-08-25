-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2016 at 09:08 AM
-- Server version: 5.6.26
-- PHP Version: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aadhar_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_mst`
--

CREATE TABLE IF NOT EXISTS `category_mst` (
  `pk_cat_id` int(11) NOT NULL,
  `cate_name` varchar(100) NOT NULL,
  `standing` enum('1','0') NOT NULL DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_mst`
--

INSERT INTO `category_mst` (`pk_cat_id`, `cate_name`, `standing`, `created_on`) VALUES
(1, 'sdafsaf', '1', '2016-08-09 04:57:32'),
(2, 'Kids', '0', '2016-08-09 04:42:37'),
(4, 'sgsgsgs', '1', '2016-08-09 04:58:11');

-- --------------------------------------------------------

--
-- Table structure for table `channel_mst`
--

CREATE TABLE IF NOT EXISTS `channel_mst` (
  `pk_ch_id` int(11) NOT NULL,
  `fk_cat_id` int(11) NOT NULL,
  `channel_name` varchar(100) NOT NULL,
  `channel_logo` text NOT NULL,
  `channel_no` varchar(100) NOT NULL,
  `channel_url` text NOT NULL,
  `standing` enum('1','0') NOT NULL DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `channel_mst`
--

INSERT INTO `channel_mst` (`pk_ch_id`, `fk_cat_id`, `channel_name`, `channel_logo`, `channel_no`, `channel_url`, `standing`, `created_on`, `updated_on`) VALUES
(1, 2, 'pogo', '1470717431-channel_logo.jpg', 'pg-001', 'http://www.pogo.com', '1', '2016-08-09 04:37:11', '0000-00-00 00:00:00'),
(2, 2, 'chutt tv', '1470717635-channel_logo.gif', 'chu', 'http://www.chuttitv.com', '1', '2016-08-09 04:40:35', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cust_mst`
--

CREATE TABLE IF NOT EXISTS `cust_mst` (
  `pk_cust_id` int(11) NOT NULL,
  `fname` varchar(64) NOT NULL,
  `lname` varchar(64) NOT NULL,
  `emailid` varchar(64) NOT NULL,
  `mobileno` bigint(20) NOT NULL,
  `vc_number` varchar(100) NOT NULL,
  `standing` enum('1','0') NOT NULL DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cust_mst`
--

INSERT INTO `cust_mst` (`pk_cust_id`, `fname`, `lname`, `emailid`, `mobileno`, `vc_number`, `standing`, `created_on`) VALUES
(1, 'vivek', 'raj', 'vivek@gmail.com', 5465555555, 'VC-001', '1', '2016-08-09 04:26:18');

-- --------------------------------------------------------

--
-- Table structure for table `user_mst`
--

CREATE TABLE IF NOT EXISTS `user_mst` (
  `pk_uid` int(11) NOT NULL,
  `fname` varchar(64) NOT NULL,
  `lname` varchar(64) NOT NULL,
  `emailid` varchar(64) NOT NULL,
  `secret_pass` text NOT NULL,
  `mobileno` bigint(20) NOT NULL,
  `standing` enum('1','0') NOT NULL DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_mst`
--

INSERT INTO `user_mst` (`pk_uid`, `fname`, `lname`, `emailid`, `secret_pass`, `mobileno`, `standing`, `created_on`) VALUES
(1, 'admin', 'app', 'admin@aadhar.com', 'Oh/GuheM8lgeNvOQe8u4Og==', 9865656656, '1', '2016-08-08 07:38:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_mst`
--
ALTER TABLE `category_mst`
  ADD PRIMARY KEY (`pk_cat_id`);

--
-- Indexes for table `channel_mst`
--
ALTER TABLE `channel_mst`
  ADD PRIMARY KEY (`pk_ch_id`);

--
-- Indexes for table `cust_mst`
--
ALTER TABLE `cust_mst`
  ADD PRIMARY KEY (`pk_cust_id`);

--
-- Indexes for table `user_mst`
--
ALTER TABLE `user_mst`
  ADD PRIMARY KEY (`pk_uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_mst`
--
ALTER TABLE `category_mst`
  MODIFY `pk_cat_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `channel_mst`
--
ALTER TABLE `channel_mst`
  MODIFY `pk_ch_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cust_mst`
--
ALTER TABLE `cust_mst`
  MODIFY `pk_cust_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_mst`
--
ALTER TABLE `user_mst`
  MODIFY `pk_uid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
