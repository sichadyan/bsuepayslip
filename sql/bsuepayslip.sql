-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2018 at 11:24 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bsuepayslip`
--

-- --------------------------------------------------------

--
-- Table structure for table `deduction`
--

CREATE TABLE IF NOT EXISTS `deduction` (
`id` int(10) NOT NULL,
  `deductionname` varchar(100) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `amount` decimal(20,0) NOT NULL,
  `createdby` varchar(50) NOT NULL,
  `createddate` datetime(6) NOT NULL,
  `modifiedby` varchar(50) DEFAULT NULL,
  `modifieddate` datetime(6) DEFAULT NULL,
  `isactive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
`id` int(10) NOT NULL,
  `departmentname` varchar(100) NOT NULL,
  `departmentdescription` varchar(250) DEFAULT NULL,
  `createdby` varchar(50) NOT NULL,
  `createddate` datetime(6) NOT NULL,
  `modifiedby` varchar(50) DEFAULT NULL,
  `modifieddate` datetime(6) DEFAULT NULL,
  `isactive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE IF NOT EXISTS `position` (
`id` int(10) NOT NULL,
  `positionname` varchar(50) NOT NULL,
  `positiondescription` varchar(250) DEFAULT NULL,
  `createdby` varchar(50) NOT NULL,
  `createddate` datetime(6) NOT NULL,
  `modifiedby` varchar(50) DEFAULT NULL,
  `modifieddate` datetime(6) DEFAULT NULL,
  `isactive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(10) NOT NULL,
  `roleid` int(10) NOT NULL,
  `idnumber` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `departmentid` int(10) NOT NULL,
  `positionid` int(10) NOT NULL,
  `address` varchar(250) NOT NULL,
  `contactnumber` varchar(30) NOT NULL,
  `emailadd` varchar(50) NOT NULL,
  `createdby` varchar(50) NOT NULL,
  `createddate` datetime(6) NOT NULL,
  `modifiedby` varchar(50) DEFAULT NULL,
  `modifieddate` datetime(6) DEFAULT NULL,
  `isactive` bit(10) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `roleid`, `idnumber`, `password`, `firstname`, `middlename`, `lastname`, `birthdate`, `gender`, `departmentid`, `positionid`, `address`, `contactnumber`, `emailadd`, `createdby`, `createddate`, `modifiedby`, `modifieddate`, `isactive`) VALUES
(28, 1, '123123         ', '4297f44b13955235245b2497399d7a93', 'John Patrick        ', '1       ', 'Galacgac         ', '0000-00-00', 'Male      ', 1, 1, 'Road 9 Block 11 Lot 5\r\nPAVAHAI          ', '9179524856    ', 'qawqwe@mail.com         ', 'John Patrick Galacgac        ', '2018-06-21 10:54:03.000000', NULL, NULL, b'0000000001');

-- --------------------------------------------------------

--
-- Table structure for table `user_deduction_config`
--

CREATE TABLE IF NOT EXISTS `user_deduction_config` (
`id` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `deductionid` int(10) NOT NULL,
  `deductionname` varchar(100) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `amount` decimal(10,0) NOT NULL,
  `deductiondatestart` date NOT NULL,
  `deductiondateend` date NOT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  `createdby` varchar(50) NOT NULL,
  `createddate` datetime(6) NOT NULL,
  `modifiedby` varchar(50) DEFAULT NULL,
  `modifieddate` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
`id` int(10) NOT NULL,
  `rolename` varchar(20) NOT NULL,
  `roledescription` int(250) DEFAULT NULL,
  `createdby` varchar(50) NOT NULL,
  `createddate` datetime(6) NOT NULL,
  `modifiedby` varchar(50) DEFAULT NULL,
  `modifieddate` datetime(6) DEFAULT NULL,
  `isactive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_salary_config`
--

CREATE TABLE IF NOT EXISTS `user_salary_config` (
`id` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `basicsalary` decimal(20,2) NOT NULL,
  `totalsalarydeduction` decimal(20,2) NOT NULL,
  `netsalary` decimal(20,2) NOT NULL,
  `salarycutoffstartdate` date NOT NULL,
  `salarycutoffenddate` date NOT NULL,
  `createdby` varchar(50) NOT NULL,
  `createddate` datetime(6) NOT NULL,
  `verifiedby` varchar(50) DEFAULT NULL,
  `verifieddate` datetime(6) DEFAULT NULL,
  `releasedby` varchar(50) DEFAULT NULL,
  `releaseddate` datetime(6) DEFAULT NULL,
  `isverified` bit(1) NOT NULL DEFAULT b'0',
  `isreleased` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deduction`
--
ALTER TABLE `deduction`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_deduction_config`
--
ALTER TABLE `user_deduction_config`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_salary_config`
--
ALTER TABLE `user_salary_config`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deduction`
--
ALTER TABLE `deduction`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `user_deduction_config`
--
ALTER TABLE `user_deduction_config`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_salary_config`
--
ALTER TABLE `user_salary_config`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
