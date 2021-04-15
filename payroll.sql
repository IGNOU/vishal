-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 15, 2021 at 09:15 AM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payroll`
--

-- --------------------------------------------------------

--
-- Table structure for table `allowance`
--

DROP TABLE IF EXISTS `allowance`;
CREATE TABLE IF NOT EXISTS `allowance` (
  `aid` int NOT NULL AUTO_INCREMENT,
  `allowance` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allowance`
--

INSERT INTO `allowance` (`aid`, `allowance`, `type`, `client_id`) VALUES
(1, 'Basic', 'Fix', 2),
(2, 'HRA', 'Fix', 2),
(3, 'Med. Allow', 'Fix', 2),
(4, 'Conv. Allow.', 'Fix', 2),
(5, 'Other Allow', 'Fix', 2),
(6, 'Incentive', 'Variable', 2),
(7, 'Arrear', 'Variable', 2),
(8, 'Reimb.', 'Variable', 2);

-- --------------------------------------------------------

--
-- Table structure for table `appointment_letter`
--

DROP TABLE IF EXISTS `appointment_letter`;
CREATE TABLE IF NOT EXISTS `appointment_letter` (
  `aid` int NOT NULL AUTO_INCREMENT,
  `details` longtext NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment_letter`
--

INSERT INTO `appointment_letter` (`aid`, `details`, `client_id`) VALUES
(1, '&lt;p&gt;Your services may be utilized in any of the offices of branches of the Company or in any department of the Company or in any of the associated Companies as may be required from time to time. Your services can be transferred to any of the department / Establishment / Division of the company or associated company located in India whether in existence at the time of your appointment or set up at a later date at the sole discretion of the management without being detrimental to your status and emoluments.&lt;/p&gt;\r\n&lt;p&gt;You will not at any time hereafter, without the consent in writing of the Company, except when required by law, divulge or make public any matter relating to the business of the Company, which are confidential in nature. You will not divulge or disclose any information relating to the company or its associates to any unauthorized person, firm or company or any other agency whatsoever either during your employment with the company or after separation. Similarly, you will also keep information relating to your payroll, strictly confidential.&lt;/p&gt;\r\n&lt;p&gt;&quot;a) You shall be on probation for a period of 6 months.&lt;br /&gt;b) During the probation period, if your performance is not satisfactory, the management reserves the right to terminate your service without assigning any reason thereof or without any notice or notice pay thereof.&lt;br /&gt;c) The Management also reserves the right to extend the probation period if your performance is not satisfactory.&lt;br /&gt;d) However, after successful completion of probation, your appointment shall be confirmed, in writing, by the management.&quot;&lt;/p&gt;\r\n&lt;p&gt;During your employment with the company, you will be governed by the Service Rules and Regulation of the Company as in force or introduced /amended from time to time. You will also be governed by the company&amp;rsquo;s policies and rules regarding Attendance, Office timing, Leave, Holidays, Overtime, resignation, Confidentiality, Instructions given by Reporting Manager, Medical Reimbursement, Conduct and Disciplinary Procedures etc.&lt;/p&gt;\r\n&lt;p&gt;You will be true and faithful to the Company in all your accounts, dealing and transactions whatsoever in and relating to the business of the Company. Any damages, shortage of stock, shortage of cash is occurred by you, will be responsible to pay the company or company is authorized to recover the same from my salary.&lt;/p&gt;\r\n&lt;p&gt;It is agreed that it shall be open to the Company to add, modify or abrogate from time to time any remuneration extended to you, or the Company&amp;rsquo;s functioning, finances and prospects, and you shall be bound by the Company&amp;rsquo;s decision in this behalf.&lt;/p&gt;\r\n&lt;p&gt;If any changes into employee current address, permanent address, mobile no &amp;amp; Email ID, I will inform to company HR person.&lt;/p&gt;\r\n&lt;p&gt;If for any reason you wish to resign from the Company&amp;rsquo;s services, you may do so by giving 15 days notice period in writing or pay to Company 15 days salary in lieu thereof and the company can terminate the service by giving 15 days notice period or 15 days payment of salary.&lt;/p&gt;\r\n&lt;p&gt;&quot;We welcome you as a member of our organization. We hope that our association will be a mutually happy and rewarding one.&lt;/p&gt;\r\n&lt;p&gt;Please sign and return the duplicate copy of this letter in token of your acceptance of the above terms and conditions, at the earliest.&lt;/p&gt;', 2);

-- --------------------------------------------------------

--
-- Table structure for table `attandance_approve`
--

DROP TABLE IF EXISTS `attandance_approve`;
CREATE TABLE IF NOT EXISTS `attandance_approve` (
  `apid` int NOT NULL AUTO_INCREMENT,
  `eid` int NOT NULL,
  `month` int NOT NULL,
  `year` varchar(8) NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`apid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `atdid` int NOT NULL AUTO_INCREMENT,
  `atd_date` date NOT NULL,
  `intime` varchar(20) NOT NULL,
  `outtime` varchar(20) NOT NULL,
  `atd` varchar(2) NOT NULL,
  `oth` decimal(4,2) NOT NULL,
  `location` longtext NOT NULL,
  `empid` int NOT NULL,
  `emp_code` varchar(11) NOT NULL,
  `client_id` int NOT NULL,
  `year` varchar(10) NOT NULL,
  `month` int NOT NULL,
  PRIMARY KEY (`atdid`)
) ENGINE=InnoDB AUTO_INCREMENT=188 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`atdid`, `atd_date`, `intime`, `outtime`, `atd`, `oth`, `location`, `empid`, `emp_code`, `client_id`, `year`, `month`) VALUES
(1, '2021-03-10', '12:59', '13:28', 'P', '0.00', '', 1, 'ER0004', 2, '2021', 3),
(95, '2021-01-01', '', '', 'P', '0.00', '', 1, 'ER0004', 2, '2021', 1),
(96, '2021-01-02', '', '', 'P', '0.00', '', 1, 'ER0004', 2, '2021', 1),
(97, '2021-01-03', '', '', 'W', '0.00', '', 1, 'ER0004', 2, '2021', 1),
(98, '2021-01-04', '', '', 'P', '0.00', '', 1, 'ER0004', 2, '2021', 1),
(99, '2021-01-05', '', '', 'P', '0.00', '', 1, 'ER0004', 2, '2021', 1),
(100, '2021-01-06', '', '', 'P', '4.00', '', 1, 'ER0004', 2, '2021', 1),
(101, '2021-01-07', '', '', 'W', '0.00', '', 1, 'ER0004', 2, '2021', 1),
(102, '2021-01-08', '', '', 'P', '0.00', '', 1, 'ER0004', 2, '2021', 1),
(103, '2021-01-09', '', '', 'P', '0.00', '', 1, 'ER0004', 2, '2021', 1),
(104, '2021-01-10', '', '', 'P', '0.00', '', 1, 'ER0004', 2, '2021', 1),
(105, '2021-01-11', '', '', 'P', '0.00', '', 1, 'ER0004', 2, '2021', 1),
(106, '2021-01-12', '', '', 'P', '0.00', '', 1, 'ER0004', 2, '2021', 1),
(107, '2021-01-13', '', '', 'P', '0.00', '', 1, 'ER0004', 2, '2021', 1),
(108, '2021-01-14', '', '', 'P', '0.00', '', 1, 'ER0004', 2, '2021', 1),
(109, '2021-01-15', '', '', 'P', '0.00', '', 1, 'ER0004', 2, '2021', 1),
(110, '2021-01-16', '', '', 'W', '0.00', '', 1, 'ER0004', 2, '2021', 1),
(111, '2021-01-17', '', '', 'P', '0.00', '', 1, 'ER0004', 2, '2021', 1),
(112, '2021-01-18', '', '', 'P', '0.00', '', 1, 'ER0004', 2, '2021', 1),
(113, '2021-01-19', '', '', 'P', '0.00', '', 1, 'ER0004', 2, '2021', 1),
(114, '2021-01-20', '', '', 'P', '0.00', '', 1, 'ER0004', 2, '2021', 1),
(115, '2021-01-21', '', '', 'P', '0.00', '', 1, 'ER0004', 2, '2021', 1),
(116, '2021-01-22', '', '', 'P', '0.00', '', 1, 'ER0004', 2, '2021', 1),
(117, '2021-01-23', '', '', 'P', '0.00', '', 1, 'ER0004', 2, '2021', 1),
(118, '2021-01-24', '', '', 'P', '0.00', '', 1, 'ER0004', 2, '2021', 1),
(119, '2021-01-25', '', '', 'W', '0.00', '', 1, 'ER0004', 2, '2021', 1),
(120, '2021-01-26', '', '', 'P', '0.00', '', 1, 'ER0004', 2, '2021', 1),
(121, '2021-01-27', '', '', 'P', '0.00', '', 1, 'ER0004', 2, '2021', 1),
(122, '2021-01-28', '', '', 'P', '0.00', '', 1, 'ER0004', 2, '2021', 1),
(123, '2021-01-29', '', '', 'P', '0.00', '', 1, 'ER0004', 2, '2021', 1),
(124, '2021-01-30', '', '', 'P', '0.00', '', 1, 'ER0004', 2, '2021', 1),
(125, '2021-01-31', '', '', 'P', '0.00', '', 1, 'ER0004', 2, '2021', 1),
(126, '2021-01-01', '', '', 'P', '0.00', '', 2, 'ER0005', 2, '2021', 1),
(127, '2021-01-02', '', '', 'P', '0.00', '', 2, 'ER0005', 2, '2021', 1),
(128, '2021-01-03', '', '', 'W', '0.00', '', 2, 'ER0005', 2, '2021', 1),
(129, '2021-01-04', '', '', 'P', '0.00', '', 2, 'ER0005', 2, '2021', 1),
(130, '2021-01-05', '', '', 'P', '0.00', '', 2, 'ER0005', 2, '2021', 1),
(131, '2021-01-06', '', '', 'P', '0.00', '', 2, 'ER0005', 2, '2021', 1),
(132, '2021-01-07', '', '', 'W', '0.00', '', 2, 'ER0005', 2, '2021', 1),
(133, '2021-01-08', '', '', 'P', '4.00', '', 2, 'ER0005', 2, '2021', 1),
(134, '2021-01-09', '', '', 'P', '0.00', '', 2, 'ER0005', 2, '2021', 1),
(135, '2021-01-10', '', '', 'P', '0.00', '', 2, 'ER0005', 2, '2021', 1),
(136, '2021-01-11', '', '', 'P', '0.00', '', 2, 'ER0005', 2, '2021', 1),
(137, '2021-01-12', '', '', 'P', '0.00', '', 2, 'ER0005', 2, '2021', 1),
(138, '2021-01-13', '', '', 'P', '0.00', '', 2, 'ER0005', 2, '2021', 1),
(139, '2021-01-14', '', '', 'P', '0.00', '', 2, 'ER0005', 2, '2021', 1),
(140, '2021-01-15', '', '', 'P', '0.00', '', 2, 'ER0005', 2, '2021', 1),
(141, '2021-01-16', '', '', 'W', '0.00', '', 2, 'ER0005', 2, '2021', 1),
(142, '2021-01-17', '', '', 'P', '0.00', '', 2, 'ER0005', 2, '2021', 1),
(143, '2021-01-18', '', '', 'P', '0.00', '', 2, 'ER0005', 2, '2021', 1),
(144, '2021-01-19', '', '', 'P', '0.00', '', 2, 'ER0005', 2, '2021', 1),
(145, '2021-01-20', '', '', 'P', '0.00', '', 2, 'ER0005', 2, '2021', 1),
(146, '2021-01-21', '', '', 'P', '0.00', '', 2, 'ER0005', 2, '2021', 1),
(147, '2021-01-22', '', '', 'P', '0.00', '', 2, 'ER0005', 2, '2021', 1),
(148, '2021-01-23', '', '', 'P', '0.00', '', 2, 'ER0005', 2, '2021', 1),
(149, '2021-01-24', '', '', 'P', '0.00', '', 2, 'ER0005', 2, '2021', 1),
(150, '2021-01-25', '', '', 'W', '0.00', '', 2, 'ER0005', 2, '2021', 1),
(151, '2021-01-26', '', '', 'P', '0.00', '', 2, 'ER0005', 2, '2021', 1),
(152, '2021-01-27', '', '', 'P', '0.00', '', 2, 'ER0005', 2, '2021', 1),
(153, '2021-01-28', '', '', 'P', '0.00', '', 2, 'ER0005', 2, '2021', 1),
(154, '2021-01-29', '', '', 'P', '0.00', '', 2, 'ER0005', 2, '2021', 1),
(155, '2021-01-30', '', '', 'P', '0.00', '', 2, 'ER0005', 2, '2021', 1),
(156, '2021-01-31', '', '', 'P', '0.00', '', 2, 'ER0005', 2, '2021', 1),
(157, '2021-01-01', '', '', 'P', '0.00', '', 3, 'ER0007', 2, '2021', 1),
(158, '2021-01-02', '', '', 'P', '0.00', '', 3, 'ER0007', 2, '2021', 1),
(159, '2021-01-03', '', '', 'W', '0.00', '', 3, 'ER0007', 2, '2021', 1),
(160, '2021-01-04', '', '', 'P', '0.00', '', 3, 'ER0007', 2, '2021', 1),
(161, '2021-01-05', '', '', 'P', '0.00', '', 3, 'ER0007', 2, '2021', 1),
(162, '2021-01-06', '', '', 'P', '0.00', '', 3, 'ER0007', 2, '2021', 1),
(163, '2021-01-07', '', '', 'W', '0.00', '', 3, 'ER0007', 2, '2021', 1),
(164, '2021-01-08', '', '', 'P', '0.00', '', 3, 'ER0007', 2, '2021', 1),
(165, '2021-01-09', '', '', 'P', '0.00', '', 3, 'ER0007', 2, '2021', 1),
(166, '2021-01-10', '', '', 'P', '0.00', '', 3, 'ER0007', 2, '2021', 1),
(167, '2021-01-11', '', '', 'P', '0.00', '', 3, 'ER0007', 2, '2021', 1),
(168, '2021-01-12', '', '', 'P', '4.00', '', 3, 'ER0007', 2, '2021', 1),
(169, '2021-01-13', '', '', 'P', '0.00', '', 3, 'ER0007', 2, '2021', 1),
(170, '2021-01-14', '', '', 'P', '0.00', '', 3, 'ER0007', 2, '2021', 1),
(171, '2021-01-15', '', '', 'P', '0.00', '', 3, 'ER0007', 2, '2021', 1),
(172, '2021-01-16', '', '', 'W', '0.00', '', 3, 'ER0007', 2, '2021', 1),
(173, '2021-01-17', '', '', 'P', '0.00', '', 3, 'ER0007', 2, '2021', 1),
(174, '2021-01-18', '', '', 'P', '0.00', '', 3, 'ER0007', 2, '2021', 1),
(175, '2021-01-19', '', '', 'P', '0.00', '', 3, 'ER0007', 2, '2021', 1),
(176, '2021-01-20', '', '', 'P', '0.00', '', 3, 'ER0007', 2, '2021', 1),
(177, '2021-01-21', '', '', 'P', '0.00', '', 3, 'ER0007', 2, '2021', 1),
(178, '2021-01-22', '', '', 'P', '0.00', '', 3, 'ER0007', 2, '2021', 1),
(179, '2021-01-23', '', '', 'P', '0.00', '', 3, 'ER0007', 2, '2021', 1),
(180, '2021-01-24', '', '', 'P', '0.00', '', 3, 'ER0007', 2, '2021', 1),
(181, '2021-01-25', '', '', 'W', '0.00', '', 3, 'ER0007', 2, '2021', 1),
(182, '2021-01-26', '', '', 'P', '0.00', '', 3, 'ER0007', 2, '2021', 1),
(183, '2021-01-27', '', '', 'P', '0.00', '', 3, 'ER0007', 2, '2021', 1),
(184, '2021-01-28', '', '', 'P', '0.00', '', 3, 'ER0007', 2, '2021', 1),
(185, '2021-01-29', '', '', 'P', '0.00', '', 3, 'ER0007', 2, '2021', 1),
(186, '2021-01-30', '', '', 'P', '0.00', '', 3, 'ER0007', 2, '2021', 1),
(187, '2021-01-31', '', '', 'P', '0.00', '', 3, 'ER0007', 2, '2021', 1);

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

DROP TABLE IF EXISTS `branch`;
CREATE TABLE IF NOT EXISTS `branch` (
  `bid` int NOT NULL AUTO_INCREMENT,
  `branch` varchar(30) NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`bid`, `branch`, `client_id`) VALUES
(1, 'HO-Delhi', 2),
(2, 'Meerut', 2);

-- --------------------------------------------------------

--
-- Table structure for table `categary`
--

DROP TABLE IF EXISTS `categary`;
CREATE TABLE IF NOT EXISTS `categary` (
  `ctid` int NOT NULL AUTO_INCREMENT,
  `categary` varchar(30) NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`ctid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categary`
--

INSERT INTO `categary` (`ctid`, `categary`, `client_id`) VALUES
(1, 'Onroll', 2),
(2, 'Offroll', 2);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `cid` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(50) NOT NULL,
  `plan` varchar(11) NOT NULL,
  `plan_start` date NOT NULL,
  `plan_end` date NOT NULL,
  `usertype` varchar(20) NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`cid`, `name`, `gender`, `phone`, `mobile`, `email`, `password`, `plan`, `plan_start`, `plan_end`, `usertype`, `amount`, `status`) VALUES
(1, 'Santoo Verma', 'M', '', '6206219342', 'satya@gmail.com', '1234567890', '1', '2021-03-09', '2022-03-09', 'Admin', '10.00', 'Active'),
(2, 'Demo', 'M', '9990458999', '9990458999', 'shyam.cogent@gmail.com', '123', '1', '2021-03-09', '2022-03-09', 'Admin', '10.00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `cmid` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `gst` varchar(30) NOT NULL,
  `pan` varchar(30) NOT NULL,
  `cin` varchar(30) NOT NULL,
  `pf` varchar(30) NOT NULL,
  `esi` varchar(30) NOT NULL,
  `lwf` varchar(30) NOT NULL,
  `pt` varchar(30) NOT NULL,
  `bank` varchar(30) NOT NULL,
  `ifsc` varchar(20) NOT NULL,
  `account` varchar(20) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `client_id` int NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`cmid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`cmid`, `name`, `email`, `mobile`, `gst`, `pan`, `cin`, `pf`, `esi`, `lwf`, `pt`, `bank`, `ifsc`, `account`, `branch`, `logo`, `address`, `client_id`, `status`) VALUES
(1, 'Demo', 'shyam.cogent@gmail.com', '9990458999', '', '', '', '', '', '', '', '', '', '', '', '156604610Logo - Copy.png', 'Plot No , Pocket 12, Rohini Sec 20', 2, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `com_abm`
--

DROP TABLE IF EXISTS `com_abm`;
CREATE TABLE IF NOT EXISTS `com_abm` (
  `abmid` int NOT NULL AUTO_INCREMENT,
  `details` longtext NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`abmid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `com_bonus`
--

DROP TABLE IF EXISTS `com_bonus`;
CREATE TABLE IF NOT EXISTS `com_bonus` (
  `bid` int NOT NULL AUTO_INCREMENT,
  `sallery` decimal(20,2) NOT NULL,
  `sallery_to` decimal(20,2) NOT NULL,
  `month` varchar(2) NOT NULL,
  `bonus` decimal(10,2) NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_bonus`
--

INSERT INTO `com_bonus` (`bid`, `sallery`, `sallery_to`, `month`, `bonus`, `client_id`) VALUES
(1, '1.00', '10000.00', '10', '8.33', 2);

-- --------------------------------------------------------

--
-- Table structure for table `com_bonus_allowance`
--

DROP TABLE IF EXISTS `com_bonus_allowance`;
CREATE TABLE IF NOT EXISTS `com_bonus_allowance` (
  `cbid` int NOT NULL AUTO_INCREMENT,
  `bid` int NOT NULL,
  `b_allowance` varchar(40) NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`cbid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_bonus_allowance`
--

INSERT INTO `com_bonus_allowance` (`cbid`, `bid`, `b_allowance`, `client_id`) VALUES
(1, 1, 'Basic', 2);

-- --------------------------------------------------------

--
-- Table structure for table `com_esi`
--

DROP TABLE IF EXISTS `com_esi`;
CREATE TABLE IF NOT EXISTS `com_esi` (
  `esi_id` int NOT NULL AUTO_INCREMENT,
  `ee_share` decimal(10,2) NOT NULL,
  `er_share` decimal(10,2) NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`esi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_esi`
--

INSERT INTO `com_esi` (`esi_id`, `ee_share`, `er_share`, `client_id`) VALUES
(1, '0.75', '3.25', 2);

-- --------------------------------------------------------

--
-- Table structure for table `com_esi_allowance`
--

DROP TABLE IF EXISTS `com_esi_allowance`;
CREATE TABLE IF NOT EXISTS `com_esi_allowance` (
  `ceid` int NOT NULL AUTO_INCREMENT,
  `esi_id` int NOT NULL,
  `esi_allowance` varchar(50) NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`ceid`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_esi_allowance`
--

INSERT INTO `com_esi_allowance` (`ceid`, `esi_id`, `esi_allowance`, `client_id`) VALUES
(8, 1, 'Arrear', 2),
(9, 1, 'Basic', 2),
(10, 1, 'Conv. Allow.', 2),
(11, 1, 'HRA', 2),
(12, 1, 'Incentive', 2),
(13, 1, 'Med. Allow', 2),
(14, 1, 'Other Allow', 2);

-- --------------------------------------------------------

--
-- Table structure for table `com_gratuty`
--

DROP TABLE IF EXISTS `com_gratuty`;
CREATE TABLE IF NOT EXISTS `com_gratuty` (
  `gid` int NOT NULL AUTO_INCREMENT,
  `multiple` int NOT NULL,
  `devided` int NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_gratuty`
--

INSERT INTO `com_gratuty` (`gid`, `multiple`, `devided`, `client_id`) VALUES
(1, 15, 26, 2);

-- --------------------------------------------------------

--
-- Table structure for table `com_gratuty_allowance`
--

DROP TABLE IF EXISTS `com_gratuty_allowance`;
CREATE TABLE IF NOT EXISTS `com_gratuty_allowance` (
  `cgid` int NOT NULL AUTO_INCREMENT,
  `gid` int NOT NULL,
  `g_allowance` varchar(50) NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`cgid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_gratuty_allowance`
--

INSERT INTO `com_gratuty_allowance` (`cgid`, `gid`, `g_allowance`, `client_id`) VALUES
(1, 1, 'Basic', 2);

-- --------------------------------------------------------

--
-- Table structure for table `com_incometax`
--

DROP TABLE IF EXISTS `com_incometax`;
CREATE TABLE IF NOT EXISTS `com_incometax` (
  `itid` int NOT NULL AUTO_INCREMENT,
  `hra` decimal(20,2) DEFAULT NULL,
  `std` decimal(20,2) DEFAULT NULL,
  `reimbursment` decimal(20,2) DEFAULT NULL,
  `prof_tax` decimal(20,2) DEFAULT NULL,
  `deduction_80c` decimal(20,2) DEFAULT NULL,
  `deduction_80ccd` decimal(20,2) DEFAULT NULL,
  `deduction_80d` decimal(20,2) DEFAULT NULL,
  `deduction_80d2` decimal(20,2) DEFAULT NULL,
  `deduction_80g` decimal(20,2) DEFAULT NULL,
  `deduction_80e` decimal(20,2) DEFAULT NULL,
  `deduction_80tta` decimal(20,2) DEFAULT NULL,
  `ss1` decimal(20,2) DEFAULT NULL,
  `ssto1` decimal(20,2) DEFAULT NULL,
  `slm1` decimal(20,2) DEFAULT NULL,
  `slf1` decimal(20,2) DEFAULT NULL,
  `ss2` decimal(20,2) DEFAULT NULL,
  `ssto2` decimal(20,2) DEFAULT NULL,
  `slm2` decimal(20,2) DEFAULT NULL,
  `slf2` decimal(20,2) DEFAULT NULL,
  `ss3` decimal(20,2) DEFAULT NULL,
  `ssto3` decimal(20,2) DEFAULT NULL,
  `slm3` decimal(20,2) DEFAULT NULL,
  `slf3` decimal(20,2) DEFAULT NULL,
  `ss4` decimal(20,2) DEFAULT NULL,
  `ssto4` decimal(20,2) DEFAULT NULL,
  `slm4` decimal(20,2) DEFAULT NULL,
  `slf4` decimal(20,2) DEFAULT NULL,
  `slm_metro` decimal(20,2) DEFAULT NULL,
  `slf_metro` decimal(20,2) DEFAULT NULL,
  `slm_nonmetro` decimal(20,2) DEFAULT NULL,
  `slf_nonmetro` decimal(20,2) DEFAULT NULL,
  `rebeat` decimal(20,2) DEFAULT NULL,
  `slm_rebeat` decimal(20,2) DEFAULT NULL,
  `slf_rebeat` decimal(20,2) DEFAULT NULL,
  `tax_sur1` decimal(20,2) DEFAULT NULL,
  `slm_tax1` decimal(20,2) DEFAULT NULL,
  `slf_tax1` decimal(20,2) DEFAULT NULL,
  `tax_sur2` decimal(20,2) DEFAULT NULL,
  `slm_tax2` decimal(20,2) DEFAULT NULL,
  `slf_tax2` decimal(20,2) DEFAULT NULL,
  `tax_sur3` decimal(20,2) DEFAULT NULL,
  `slm_tax3` decimal(20,2) DEFAULT NULL,
  `slf_tax3` decimal(20,2) DEFAULT NULL,
  `tax_sur4` decimal(20,2) DEFAULT NULL,
  `slm_tax4` decimal(20,2) DEFAULT NULL,
  `slf_tax4` decimal(20,2) DEFAULT NULL,
  `slm_edu` decimal(20,2) DEFAULT NULL,
  `slf_edu` decimal(20,2) DEFAULT NULL,
  `slm_rent` decimal(20,2) DEFAULT NULL,
  `slf_rent` decimal(20,2) DEFAULT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`itid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `com_incometax_allowance`
--

DROP TABLE IF EXISTS `com_incometax_allowance`;
CREATE TABLE IF NOT EXISTS `com_incometax_allowance` (
  `ciaid` int NOT NULL AUTO_INCREMENT,
  `it_id` int NOT NULL,
  `alw` varchar(20) NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`ciaid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `com_incometax_emp`
--

DROP TABLE IF EXISTS `com_incometax_emp`;
CREATE TABLE IF NOT EXISTS `com_incometax_emp` (
  `cie_id` int NOT NULL AUTO_INCREMENT,
  `emp_code` varchar(20) NOT NULL,
  `other` decimal(20,2) NOT NULL,
  `hra` decimal(20,2) DEFAULT NULL,
  `std` decimal(20,2) DEFAULT NULL,
  `reimbursment` decimal(20,2) DEFAULT NULL,
  `prof_tax` decimal(20,2) DEFAULT NULL,
  `deduction_80c` decimal(20,2) DEFAULT NULL,
  `deduction_80ccd` decimal(20,2) DEFAULT NULL,
  `deduction_80d` decimal(20,2) DEFAULT NULL,
  `deduction_80d2` decimal(20,2) DEFAULT NULL,
  `deduction_80g` decimal(20,2) DEFAULT NULL,
  `deduction_80e` decimal(20,2) DEFAULT NULL,
  `deduction_80tta` decimal(20,2) DEFAULT NULL,
  `client_id` int DEFAULT NULL,
  `year` int NOT NULL,
  `month` int NOT NULL,
  PRIMARY KEY (`cie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `com_leave`
--

DROP TABLE IF EXISTS `com_leave`;
CREATE TABLE IF NOT EXISTS `com_leave` (
  `lid` int NOT NULL AUTO_INCREMENT,
  `month` varchar(11) NOT NULL,
  `calculation` varchar(20) NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`lid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `com_leave_allowance`
--

DROP TABLE IF EXISTS `com_leave_allowance`;
CREATE TABLE IF NOT EXISTS `com_leave_allowance` (
  `laid` int NOT NULL AUTO_INCREMENT,
  `l_id` int NOT NULL,
  `l_alw` varchar(30) NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`laid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `com_lwf`
--

DROP TABLE IF EXISTS `com_lwf`;
CREATE TABLE IF NOT EXISTS `com_lwf` (
  `lwf_id` int NOT NULL AUTO_INCREMENT,
  `ee_share` decimal(10,2) NOT NULL,
  `er_share` decimal(10,2) NOT NULL,
  `state` varchar(50) NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`lwf_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_lwf`
--

INSERT INTO `com_lwf` (`lwf_id`, `ee_share`, `er_share`, `state`, `client_id`) VALUES
(1, '10.00', '20.00', 'Haryana', 2);

-- --------------------------------------------------------

--
-- Table structure for table `com_lwf_allowance`
--

DROP TABLE IF EXISTS `com_lwf_allowance`;
CREATE TABLE IF NOT EXISTS `com_lwf_allowance` (
  `lwfid` int NOT NULL AUTO_INCREMENT,
  `lwf_id` int NOT NULL,
  `lwf_allowance` varchar(40) NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`lwfid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_lwf_allowance`
--

INSERT INTO `com_lwf_allowance` (`lwfid`, `lwf_id`, `lwf_allowance`, `client_id`) VALUES
(1, 1, '01', 2),
(2, 1, '02', 2),
(3, 1, '03', 2),
(4, 1, '04', 2),
(5, 1, '05', 2),
(6, 1, '06', 2),
(7, 1, '07', 2),
(8, 1, '08', 2),
(9, 1, '09', 2),
(10, 1, '10', 2),
(11, 1, '11', 2),
(12, 1, '12', 2);

-- --------------------------------------------------------

--
-- Table structure for table `com_notice`
--

DROP TABLE IF EXISTS `com_notice`;
CREATE TABLE IF NOT EXISTS `com_notice` (
  `nid` int NOT NULL AUTO_INCREMENT,
  `msg` longtext NOT NULL,
  `date` date NOT NULL,
  `period` varchar(20) NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `com_notice_details`
--

DROP TABLE IF EXISTS `com_notice_details`;
CREATE TABLE IF NOT EXISTS `com_notice_details` (
  `cndid` int NOT NULL AUTO_INCREMENT,
  `nid` int NOT NULL,
  `emp_id` int NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`cndid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `com_overtime`
--

DROP TABLE IF EXISTS `com_overtime`;
CREATE TABLE IF NOT EXISTS `com_overtime` (
  `ov_id` int NOT NULL AUTO_INCREMENT,
  `calculation` varchar(50) NOT NULL,
  `multiple` int NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`ov_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_overtime`
--

INSERT INTO `com_overtime` (`ov_id`, `calculation`, `multiple`, `client_id`) VALUES
(1, 'Monthly', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `com_overtime_allowance`
--

DROP TABLE IF EXISTS `com_overtime_allowance`;
CREATE TABLE IF NOT EXISTS `com_overtime_allowance` (
  `ovid` int NOT NULL AUTO_INCREMENT,
  `ov_id` int NOT NULL,
  `ov_allowance` varchar(40) NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`ovid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_overtime_allowance`
--

INSERT INTO `com_overtime_allowance` (`ovid`, `ov_id`, `ov_allowance`, `client_id`) VALUES
(1, 1, 'Basic', 2),
(2, 1, 'Conv. Allow.', 2),
(3, 1, 'HRA', 2),
(4, 1, 'Med. Allow', 2),
(5, 1, 'Other Allow', 2);

-- --------------------------------------------------------

--
-- Table structure for table `com_pf`
--

DROP TABLE IF EXISTS `com_pf`;
CREATE TABLE IF NOT EXISTS `com_pf` (
  `pfid` int NOT NULL AUTO_INCREMENT,
  `pf_limit` int NOT NULL,
  `person_limit` int NOT NULL,
  `ee_pf` decimal(10,2) NOT NULL,
  `er_pf` decimal(10,2) NOT NULL,
  `er_eps` decimal(10,2) NOT NULL,
  `admin` decimal(20,2) NOT NULL,
  `edli21` decimal(20,2) NOT NULL,
  `edli22` decimal(20,2) NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`pfid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_pf`
--

INSERT INTO `com_pf` (`pfid`, `pf_limit`, `person_limit`, `ee_pf`, `er_pf`, `er_eps`, `admin`, `edli21`, `edli22`, `client_id`) VALUES
(1, 15000, 15000, '12.00', '3.67', '8.33', '0.50', '0.50', '0.00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `com_pf_allowance`
--

DROP TABLE IF EXISTS `com_pf_allowance`;
CREATE TABLE IF NOT EXISTS `com_pf_allowance` (
  `pai` int NOT NULL AUTO_INCREMENT,
  `pf_id` int NOT NULL,
  `pf_allowance` varchar(50) NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`pai`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_pf_allowance`
--

INSERT INTO `com_pf_allowance` (`pai`, `pf_id`, `pf_allowance`, `client_id`) VALUES
(1, 1, 'Basic', 2),
(2, 1, 'Conv. Allow.', 2),
(3, 1, 'Med. Allow', 2),
(4, 1, 'Other Allow', 2);

-- --------------------------------------------------------

--
-- Table structure for table `com_pt`
--

DROP TABLE IF EXISTS `com_pt`;
CREATE TABLE IF NOT EXISTS `com_pt` (
  `pt_id` int NOT NULL AUTO_INCREMENT,
  `sallery` decimal(20,2) NOT NULL,
  `sallery_to` decimal(20,2) NOT NULL,
  `ee_share` decimal(10,2) NOT NULL,
  `er_share` decimal(10,2) NOT NULL,
  `state` varchar(50) NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`pt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_pt`
--

INSERT INTO `com_pt` (`pt_id`, `sallery`, `sallery_to`, `ee_share`, `er_share`, `state`, `client_id`) VALUES
(1, '1.00', '10000.00', '150.00', '0.00', 'Haryana', 2);

-- --------------------------------------------------------

--
-- Table structure for table `com_pt_allowance`
--

DROP TABLE IF EXISTS `com_pt_allowance`;
CREATE TABLE IF NOT EXISTS `com_pt_allowance` (
  `ptid` int NOT NULL AUTO_INCREMENT,
  `pt_id` int NOT NULL,
  `pt_allowance` varchar(40) NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`ptid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_pt_allowance`
--

INSERT INTO `com_pt_allowance` (`ptid`, `pt_id`, `pt_allowance`, `client_id`) VALUES
(1, 1, 'Basic', 2),
(2, 1, 'Conv. Allow.', 2),
(3, 1, 'HRA', 2),
(4, 1, 'Med. Allow', 2),
(5, 1, 'Other Allow', 2);

-- --------------------------------------------------------

--
-- Table structure for table `com_shift`
--

DROP TABLE IF EXISTS `com_shift`;
CREATE TABLE IF NOT EXISTS `com_shift` (
  `csid` int NOT NULL AUTO_INCREMENT,
  `hour` varchar(10) NOT NULL,
  `half` varchar(10) NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`csid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_shift`
--

INSERT INTO `com_shift` (`csid`, `hour`, `half`, `client_id`) VALUES
(1, '9', '4', 2);

-- --------------------------------------------------------

--
-- Table structure for table `com_wap`
--

DROP TABLE IF EXISTS `com_wap`;
CREATE TABLE IF NOT EXISTS `com_wap` (
  `wid` int NOT NULL AUTO_INCREMENT,
  `machine` varchar(50) NOT NULL,
  `ipaddress` varchar(50) NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`wid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `com_week`
--

DROP TABLE IF EXISTS `com_week`;
CREATE TABLE IF NOT EXISTS `com_week` (
  `cwid` int NOT NULL AUTO_INCREMENT,
  `day` varchar(10) NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`cwid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `deduction`
--

DROP TABLE IF EXISTS `deduction`;
CREATE TABLE IF NOT EXISTS `deduction` (
  `did` int NOT NULL AUTO_INCREMENT,
  `deduction` varchar(50) NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`did`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deduction`
--

INSERT INTO `deduction` (`did`, `deduction`, `client_id`) VALUES
(1, 'Advance', 2);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `depid` int NOT NULL AUTO_INCREMENT,
  `department` varchar(30) NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`depid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`depid`, `department`, `client_id`) VALUES
(1, 'Accounts', 2),
(2, 'Sales', 2);

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

DROP TABLE IF EXISTS `designation`;
CREATE TABLE IF NOT EXISTS `designation` (
  `des_id` int NOT NULL AUTO_INCREMENT,
  `designation` varchar(30) NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`des_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`des_id`, `designation`, `client_id`) VALUES
(1, 'Account Executive', 2),
(2, 'Store Manager', 2);

-- --------------------------------------------------------

--
-- Table structure for table `d_setting`
--

DROP TABLE IF EXISTS `d_setting`;
CREATE TABLE IF NOT EXISTS `d_setting` (
  `dsid` int NOT NULL AUTO_INCREMENT,
  `licence_to` date NOT NULL,
  `licence_from` date NOT NULL,
  `site_name` varchar(50) NOT NULL,
  `developer` varchar(30) NOT NULL,
  `url` varchar(100) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `contact2` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  PRIMARY KEY (`dsid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_setting`
--

INSERT INTO `d_setting` (`dsid`, `licence_to`, `licence_from`, `site_name`, `developer`, `url`, `contact`, `contact2`, `email`, `user_type`) VALUES
(1, '2019-10-20', '2021-11-20', 'Payroll Software', 'Hawakatech', 'http://hawakatech.com/', '9128280580', '7838504384', 'info@hawakatech.com', 'santoo.gaya@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `emp_id` int NOT NULL AUTO_INCREMENT,
  `empcode` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `relation` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(1) NOT NULL,
  `marital` varchar(20) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `current_address` varchar(500) NOT NULL,
  `permanent_address` varchar(500) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `education` varchar(50) NOT NULL,
  `adhaar` varchar(12) NOT NULL,
  `city_type` varchar(20) NOT NULL,
  `religion` varchar(20) NOT NULL,
  `image` varchar(200) NOT NULL,
  `pan` varchar(20) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `account` varchar(50) NOT NULL,
  `ifsc` varchar(11) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `payment_mode` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `doj` date NOT NULL,
  `department` varchar(50) NOT NULL,
  `category` varchar(20) NOT NULL,
  `location` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `uan` varchar(50) NOT NULL,
  `pf_code` varchar(50) NOT NULL,
  `esi_code` varchar(50) NOT NULL,
  `rep_manager` varchar(50) NOT NULL,
  `rmid` varchar(11) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `dol` varchar(50) NOT NULL,
  `field1` varchar(50) NOT NULL,
  `field2` varchar(50) NOT NULL,
  `field3` varchar(50) NOT NULL,
  `field4` varchar(50) NOT NULL,
  `field5` varchar(50) NOT NULL,
  `el` varchar(5) NOT NULL,
  `sl` varchar(5) NOT NULL,
  `cl` varchar(5) NOT NULL,
  `ho` varchar(5) NOT NULL,
  `pf` varchar(5) NOT NULL,
  `pension` varchar(5) NOT NULL,
  `esi` varchar(5) NOT NULL,
  `lwf` varchar(5) NOT NULL,
  `tds` varchar(5) NOT NULL,
  `pt` varchar(5) NOT NULL,
  `ot` varchar(5) NOT NULL,
  `bonus` varchar(5) NOT NULL,
  `gratuty` varchar(5) NOT NULL,
  `login` varchar(5) NOT NULL,
  `atd` varchar(5) NOT NULL,
  `work_hour` varchar(5) NOT NULL,
  `card` varchar(10) NOT NULL,
  `cm_id` int NOT NULL,
  `client_id` int NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `empcode`, `name`, `fname`, `relation`, `dob`, `gender`, `marital`, `mobile`, `email`, `current_address`, `permanent_address`, `nationality`, `education`, `adhaar`, `city_type`, `religion`, `image`, `pan`, `bank`, `account`, `ifsc`, `branch`, `payment_mode`, `designation`, `doj`, `department`, `category`, `location`, `state`, `uan`, `pf_code`, `esi_code`, `rep_manager`, `rmid`, `email_id`, `dol`, `field1`, `field2`, `field3`, `field4`, `field5`, `el`, `sl`, `cl`, `ho`, `pf`, `pension`, `esi`, `lwf`, `tds`, `pt`, `ot`, `bonus`, `gratuty`, `login`, `atd`, `work_hour`, `card`, `cm_id`, `client_id`, `password`) VALUES
(1, 'ER0004', 'Chetan Parkash', 'Pooran Chand', 'F', '1992-09-26', 'M', 'Unmarried', '7827621239', 'chetan7.parkash@gmail.com', 'H-1/349, Sultan Puri, ', 'H-1/349, Sultan Puri, ', 'Indian', 'NA', '403520573243', 'NA', 'NA', '', 'BJVPP6358M', 'SBI Bank', '00000038418586817 ', 'SBIN0016202', 'Mianwali Nagar', 'Bank Trf', 'Account Executive', '2010-01-01', 'Accounts', 'Onroll', 'HO-Delhi', 'Delhi', 'NA', 'NA', 'NA', '', '', 'NA', '2021-01-30', '', '', '', '', '', '5', '0', '0', '0', 'Y', 'Y', 'Y', 'Y', 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', '9', '', 0, 2, '123'),
(2, 'ER0005', 'Dataram', 'Chet Ram', 'F', '1988-05-11', 'M', 'Married', '8860843807', 'dataramraina@gmail.com', '352-D, Prajapati Mohalla,Munirka Village,', '352-D, Prajapati Mohalla,Munirka Village,', 'Indian', 'NA', '271129775197', 'NA', 'NA', '', 'BNBPD8899R', 'SBI Bank', '00000035643989015', 'SBIN0016202', 'Mianwali Nagar,Delhi', 'Bank Trf', 'Account Executive', '2015-07-28', 'Accounts', 'Onroll', 'HO-Delhi', 'Delhi', 'NA', 'NA', 'NA', '', '', 'NA', '', '', '', '', '', '', '5', '0', '0', '0', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'Y', 'Y', '9', '', 0, 2, '124'),
(3, 'ER0007', 'SIDHARTH SHARMA', 'VIJAY SHARMA', 'F', '1984-07-28', 'M', 'Married', '9017171741', 'sidsharma1717@gmail.com', '16/4, Gandhi Nagar, ', '16/4, Gandhi Nagar, ', 'Indian', 'NA', '240794955803', 'NA', 'NA', '', 'EHNPS1788D', 'HDFC Bank', '50100048906905', 'HDFC0000176', 'Rohtak', 'Bank Trf', 'Store Manager', '2017-03-01', 'Sales', 'Onroll', '', 'Haryana', 'NA', 'NA', 'NA', '', '', 'NA', '', '', '', '', '', '', '0', '0', '0', '0', 'N', 'N', 'N', 'Y', 'N', 'N', 'Y', 'N', 'N', 'Y', 'Y', '9', '', 0, 2, '125');

-- --------------------------------------------------------

--
-- Table structure for table `employee_breakup`
--

DROP TABLE IF EXISTS `employee_breakup`;
CREATE TABLE IF NOT EXISTS `employee_breakup` (
  `ebid` int NOT NULL AUTO_INCREMENT,
  `emp_allowance` varchar(50) NOT NULL,
  `amount` decimal(30,2) NOT NULL,
  `emp_code` varchar(11) NOT NULL,
  `client_id` varchar(11) NOT NULL,
  PRIMARY KEY (`ebid`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_breakup`
--

INSERT INTO `employee_breakup` (`ebid`, `emp_allowance`, `amount`, `emp_code`, `client_id`) VALUES
(21, 'Basic', '15100.00', 'ER0005', '2'),
(22, 'HRA', '5980.00', 'ER0005', '2'),
(23, 'Med. Allow', '1250.00', 'ER0005', '2'),
(24, 'Conv. Allow.', '1000.00', 'ER0005', '2'),
(25, 'Other Allow', '3336.00', 'ER0005', '2'),
(26, 'Basic', '15050.00', 'ER0007', '2'),
(27, 'HRA', '5300.00', 'ER0007', '2'),
(28, 'Med. Allow', '1526.00', 'ER0007', '2'),
(29, 'Conv. Allow.', '1000.00', 'ER0007', '2'),
(30, 'Other Allow', '2134.00', 'ER0007', '2'),
(41, 'Basic', '12000.00', 'ER0004', '2'),
(42, 'HRA', '1000.00', 'ER0004', '2'),
(43, 'Med. Allow', '500.00', 'ER0004', '2'),
(44, 'Conv. Allow.', '500.00', 'ER0004', '2'),
(45, 'Other Allow', '500.00', 'ER0004', '2');

-- --------------------------------------------------------

--
-- Table structure for table `leave_update`
--

DROP TABLE IF EXISTS `leave_update`;
CREATE TABLE IF NOT EXISTS `leave_update` (
  `luid` int NOT NULL AUTO_INCREMENT,
  `emp_code` varchar(10) NOT NULL,
  `el` int NOT NULL,
  `el_l` int NOT NULL,
  `sl` int NOT NULL,
  `sl_l` int NOT NULL,
  `cl` int NOT NULL,
  `cl_l` int NOT NULL,
  `ho` int NOT NULL,
  `ho_l` int NOT NULL,
  `year` int NOT NULL,
  `month` int NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`luid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_update`
--

INSERT INTO `leave_update` (`luid`, `emp_code`, `el`, `el_l`, `sl`, `sl_l`, `cl`, `cl_l`, `ho`, `ho_l`, `year`, `month`, `client_id`) VALUES
(1, 'ER0004', 5, 0, 0, 0, 0, 0, 0, 0, 2021, 3, 2),
(2, 'ER0005', 5, 0, 0, 0, 0, 0, 0, 0, 2021, 3, 2),
(3, 'ER0007', 0, 0, 0, 0, 0, 0, 0, 0, 2021, 3, 2),
(7, 'ER0004', 5, 0, 0, 0, 0, 0, 0, 0, 2021, 1, 2),
(8, 'ER0005', 5, 0, 0, 0, 0, 0, 0, 0, 2021, 1, 2),
(9, 'ER0007', 0, 0, 0, 0, 0, 0, 0, 0, 2021, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

DROP TABLE IF EXISTS `plan`;
CREATE TABLE IF NOT EXISTS `plan` (
  `pid` int NOT NULL AUTO_INCREMENT,
  `plan` varchar(50) NOT NULL,
  `validity` varchar(50) NOT NULL,
  `price` decimal(30,2) NOT NULL,
  `emp_limit` varchar(15) NOT NULL,
  `details` longtext NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`pid`, `plan`, `validity`, `price`, `emp_limit`, `details`) VALUES
(1, '0-10', '12', '10.00', '10', '');

-- --------------------------------------------------------

--
-- Table structure for table `plan_payment`
--

DROP TABLE IF EXISTS `plan_payment`;
CREATE TABLE IF NOT EXISTS `plan_payment` (
  `ppid` int NOT NULL AUTO_INCREMENT,
  `clid` int NOT NULL,
  `plid` int NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `cheque_no` varchar(20) NOT NULL,
  `cheque_date` date NOT NULL,
  `payment` decimal(30,2) NOT NULL,
  `pay_date` date NOT NULL,
  `sms` varchar(10) NOT NULL,
  PRIMARY KEY (`ppid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

DROP TABLE IF EXISTS `salary`;
CREATE TABLE IF NOT EXISTS `salary` (
  `slid` int NOT NULL AUTO_INCREMENT,
  `emp_code` varchar(20) NOT NULL,
  `pay_day` int NOT NULL,
  `ot_hrs` decimal(20,2) NOT NULL,
  `gross` decimal(20,2) NOT NULL,
  `bonus_alw_pay` decimal(20,2) NOT NULL,
  `bonus` decimal(20,2) NOT NULL,
  `overtime_alw_pay` decimal(20,2) NOT NULL,
  `over_time` decimal(20,2) NOT NULL,
  `leave_alw_pay` decimal(20,2) NOT NULL,
  `leave_ench` decimal(20,2) NOT NULL,
  `gross_salary` decimal(20,2) NOT NULL,
  `pf_alw_pay` decimal(20,2) NOT NULL,
  `pf` decimal(20,2) NOT NULL,
  `esi_alw_pay` decimal(20,2) NOT NULL,
  `esi` decimal(20,2) NOT NULL,
  `tds` decimal(20,2) NOT NULL,
  `pt_alw_pay` decimal(20,2) NOT NULL,
  `pt` decimal(20,2) NOT NULL,
  `lwf_alw_pay` decimal(20,2) NOT NULL,
  `lwf` decimal(20,2) NOT NULL,
  `total_dec` decimal(20,2) NOT NULL,
  `net_payable` decimal(20,2) NOT NULL,
  `er_pf` decimal(20,2) NOT NULL,
  `er_esi` decimal(20,2) NOT NULL,
  `er_pt` decimal(20,2) NOT NULL,
  `er_lwf` decimal(20,2) NOT NULL,
  `paid_ctc` decimal(20,2) NOT NULL,
  `year` varchar(10) NOT NULL,
  `month` int NOT NULL,
  `client_id` int NOT NULL,
  `date` date NOT NULL,
  `ym` varchar(15) NOT NULL,
  PRIMARY KEY (`slid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`slid`, `emp_code`, `pay_day`, `ot_hrs`, `gross`, `bonus_alw_pay`, `bonus`, `overtime_alw_pay`, `over_time`, `leave_alw_pay`, `leave_ench`, `gross_salary`, `pf_alw_pay`, `pf`, `esi_alw_pay`, `esi`, `tds`, `pt_alw_pay`, `pt`, `lwf_alw_pay`, `lwf`, `total_dec`, `net_payable`, `er_pf`, `er_esi`, `er_pt`, `er_lwf`, `paid_ctc`, `year`, `month`, `client_id`, `date`, `ym`) VALUES
(1, 'ER0004', 1, '0.00', '23102.00', '0.00', '0.00', '23102.00', '0.00', '0.00', '0.00', '745.23', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '745.23', '0.00', '0.00', '0.00', '0.00', '745.23', '2021', 3, 2, '2021-03-10', '2021-03'),
(2, 'ER0005', 0, '0.00', '26666.00', '0.00', '0.00', '26666.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '2021', 3, 2, '2021-03-10', '2021-03'),
(3, 'ER0007', 0, '0.00', '25010.00', '0.00', '0.00', '25010.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '2021', 3, 2, '2021-03-10', '2021-03'),
(7, 'ER0004', 31, '4.00', '14500.00', '0.00', '0.00', '14500.00', '415.77', '0.00', '0.00', '16915.77', '13500.00', '1620.00', '16000.00', '520.00', '0.00', '0.00', '0.00', '0.00', '0.00', '2240.00', '14675.77', '1620.00', '120.00', '0.00', '0.00', '18655.77', '2021', 1, 2, '2021-03-13', '2021-01'),
(8, 'ER0005', 31, '4.00', '26666.00', '0.00', '0.00', '26666.00', '764.62', '0.00', '0.00', '28830.62', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '200.00', '28630.62', '0.00', '0.00', '0.00', '0.00', '28830.62', '2021', 1, 2, '2021-03-13', '2021-01'),
(9, 'ER0007', 31, '4.00', '25010.00', '0.00', '0.00', '25010.00', '717.13', '0.00', '0.00', '27427.13', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '10.00', '310.00', '27117.13', '0.00', '0.00', '0.00', '20.00', '27447.13', '2021', 1, 2, '2021-03-13', '2021-01');

-- --------------------------------------------------------

--
-- Table structure for table `salary_breakup`
--

DROP TABLE IF EXISTS `salary_breakup`;
CREATE TABLE IF NOT EXISTS `salary_breakup` (
  `sbid` int NOT NULL AUTO_INCREMENT,
  `year` varchar(10) NOT NULL,
  `month` int NOT NULL,
  `emp_code` varchar(20) NOT NULL,
  `variable` varchar(50) NOT NULL,
  `amt` decimal(20,2) NOT NULL,
  `client_id` int NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`sbid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salary_breakup`
--

INSERT INTO `salary_breakup` (`sbid`, `year`, `month`, `emp_code`, `variable`, `amt`, `client_id`, `date`) VALUES
(1, '2021', 1, 'ER0004', 'Incentive', '500.00', 2, '2021-03-13'),
(2, '2021', 1, 'ER0004', 'Arrear', '1000.00', 2, '2021-03-13'),
(3, '2021', 1, 'ER0004', 'Reimb.', '500.00', 2, '2021-03-13'),
(4, '2021', 1, 'ER0004', 'Advance', '100.00', 2, '2021-03-13'),
(5, '2021', 1, 'ER0005', 'Incentive', '300.00', 2, '2021-03-13'),
(6, '2021', 1, 'ER0005', 'Arrear', '1000.00', 2, '2021-03-13'),
(7, '2021', 1, 'ER0005', 'Reimb.', '100.00', 2, '2021-03-13'),
(8, '2021', 1, 'ER0005', 'Advance', '200.00', 2, '2021-03-13'),
(9, '2021', 1, 'ER0007', 'Incentive', '200.00', 2, '2021-03-13'),
(10, '2021', 1, 'ER0007', 'Arrear', '1000.00', 2, '2021-03-13'),
(11, '2021', 1, 'ER0007', 'Reimb.', '500.00', 2, '2021-03-13'),
(12, '2021', 1, 'ER0007', 'Advance', '300.00', 2, '2021-03-13');

-- --------------------------------------------------------

--
-- Table structure for table `salary_breakup_amt`
--

DROP TABLE IF EXISTS `salary_breakup_amt`;
CREATE TABLE IF NOT EXISTS `salary_breakup_amt` (
  `sba_id` int NOT NULL AUTO_INCREMENT,
  `slid` int NOT NULL,
  `code` varchar(20) NOT NULL,
  `alw` varchar(30) NOT NULL,
  `amt` decimal(20,2) NOT NULL,
  `pay_amt` decimal(20,2) NOT NULL,
  `year` varchar(10) NOT NULL,
  `month` int NOT NULL,
  `client_id` int NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`sba_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salary_breakup_amt`
--

INSERT INTO `salary_breakup_amt` (`sba_id`, `slid`, `code`, `alw`, `amt`, `pay_amt`, `year`, `month`, `client_id`, `date`) VALUES
(1, 1, 'ER0004', 'Basic', '15500.00', '500.00', '2021', 3, 2, '2021-03-10'),
(2, 1, 'ER0004', 'HRA', '4412.00', '142.32', '2021', 3, 2, '2021-03-10'),
(3, 1, 'ER0004', 'Med. Allow', '1250.00', '40.32', '2021', 3, 2, '2021-03-10'),
(4, 1, 'ER0004', 'Conv. Allow.', '1000.00', '32.26', '2021', 3, 2, '2021-03-10'),
(5, 1, 'ER0004', 'Other Allow', '940.00', '30.32', '2021', 3, 2, '2021-03-10'),
(6, 2, 'ER0005', 'Basic', '15100.00', '0.00', '2021', 3, 2, '2021-03-10'),
(7, 2, 'ER0005', 'HRA', '5980.00', '0.00', '2021', 3, 2, '2021-03-10'),
(8, 2, 'ER0005', 'Med. Allow', '1250.00', '0.00', '2021', 3, 2, '2021-03-10'),
(9, 2, 'ER0005', 'Conv. Allow.', '1000.00', '0.00', '2021', 3, 2, '2021-03-10'),
(10, 2, 'ER0005', 'Other Allow', '3336.00', '0.00', '2021', 3, 2, '2021-03-10'),
(11, 3, 'ER0007', 'Basic', '15050.00', '0.00', '2021', 3, 2, '2021-03-10'),
(12, 3, 'ER0007', 'HRA', '5300.00', '0.00', '2021', 3, 2, '2021-03-10'),
(13, 3, 'ER0007', 'Med. Allow', '1526.00', '0.00', '2021', 3, 2, '2021-03-10'),
(14, 3, 'ER0007', 'Conv. Allow.', '1000.00', '0.00', '2021', 3, 2, '2021-03-10'),
(15, 3, 'ER0007', 'Other Allow', '2134.00', '0.00', '2021', 3, 2, '2021-03-10'),
(31, 7, 'ER0004', 'Basic', '12000.00', '12000.00', '2021', 1, 2, '2021-03-13'),
(32, 7, 'ER0004', 'HRA', '1000.00', '1000.00', '2021', 1, 2, '2021-03-13'),
(33, 7, 'ER0004', 'Med. Allow', '500.00', '500.00', '2021', 1, 2, '2021-03-13'),
(34, 7, 'ER0004', 'Conv. Allow.', '500.00', '500.00', '2021', 1, 2, '2021-03-13'),
(35, 7, 'ER0004', 'Other Allow', '500.00', '500.00', '2021', 1, 2, '2021-03-13'),
(36, 8, 'ER0005', 'Basic', '15100.00', '15100.00', '2021', 1, 2, '2021-03-13'),
(37, 8, 'ER0005', 'HRA', '5980.00', '5980.00', '2021', 1, 2, '2021-03-13'),
(38, 8, 'ER0005', 'Med. Allow', '1250.00', '1250.00', '2021', 1, 2, '2021-03-13'),
(39, 8, 'ER0005', 'Conv. Allow.', '1000.00', '1000.00', '2021', 1, 2, '2021-03-13'),
(40, 8, 'ER0005', 'Other Allow', '3336.00', '3336.00', '2021', 1, 2, '2021-03-13'),
(41, 9, 'ER0007', 'Basic', '15050.00', '15050.00', '2021', 1, 2, '2021-03-13'),
(42, 9, 'ER0007', 'HRA', '5300.00', '5300.00', '2021', 1, 2, '2021-03-13'),
(43, 9, 'ER0007', 'Med. Allow', '1526.00', '1526.00', '2021', 1, 2, '2021-03-13'),
(44, 9, 'ER0007', 'Conv. Allow.', '1000.00', '1000.00', '2021', 1, 2, '2021-03-13'),
(45, 9, 'ER0007', 'Other Allow', '2134.00', '2134.00', '2021', 1, 2, '2021-03-13');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
CREATE TABLE IF NOT EXISTS `setting` (
  `sid` int NOT NULL AUTO_INCREMENT,
  `sett` varchar(10) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`sid`, `sett`) VALUES
(1, 'OFF');

-- --------------------------------------------------------

--
-- Table structure for table `user1`
--

DROP TABLE IF EXISTS `user1`;
CREATE TABLE IF NOT EXISTS `user1` (
  `uid` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address` varchar(400) NOT NULL,
  `userid` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` varchar(15) NOT NULL,
  `usertype` varchar(20) NOT NULL,
  `img` varchar(200) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user1`
--

INSERT INTO `user1` (`uid`, `name`, `gender`, `mobile`, `address`, `userid`, `password`, `status`, `usertype`, `img`) VALUES
(1, 'Santoo Verma', 'M', '6206219342', 'Manpur Gaya', 'santoo.gaya@gmail.com', '1234567890', 'Active', 'Supper-Admin', ''),
(2, 'Shayam', 'M', '', '', 'admin@gmail.com', 'admin@1234', 'Active', 'Supper-Admin', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
