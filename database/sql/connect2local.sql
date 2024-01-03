-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 29, 2023 at 03:04 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `connect2local`
--

-- --------------------------------------------------------

--
-- Table structure for table `business_register`
--

DROP TABLE IF EXISTS `business_register`;
CREATE TABLE IF NOT EXISTS `business_register` (
  `B_ID` varchar(15) NOT NULL,
  `B_FNAME` varchar(15) DEFAULT NULL,
  `B_LNAME` varchar(15) DEFAULT NULL,
  `B_BIRTH_DATE` date DEFAULT NULL,
  `B_AGE` int(3) NOT NULL DEFAULT '0',
  `B_GENDER` varchar(6) DEFAULT NULL,
  `B_ADDRESS` varchar(255) DEFAULT NULL,
  `B_CATEGORY` varchar(25) DEFAULT NULL,
  `B_CONTACT` varchar(255) DEFAULT NULL,
  `B_EMAIL` varchar(255) DEFAULT NULL,
  `B_PASSWORD` varchar(255) DEFAULT NULL,
  `B_TERM_AGREE` varchar(3) DEFAULT NULL,
  `JOIN_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`B_ID`),
  UNIQUE KEY `B_CONTACT` (`B_CONTACT`),
  UNIQUE KEY `B_EMAIL` (`B_EMAIL`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business_register`
--

INSERT INTO `business_register` (`B_ID`, `B_FNAME`, `B_LNAME`, `B_BIRTH_DATE`, `B_AGE`, `B_GENDER`, `B_ADDRESS`, `B_CATEGORY`, `B_CONTACT`, `B_EMAIL`, `B_PASSWORD`, `B_TERM_AGREE`, `JOIN_DATE`) VALUES
('C2LB000001', 'Bhavesh', 'Parmar', '2004-02-17', 19, 'Male', 'Meldikrupa Society', 'Advertising', '/lnZab/UayO8uJ1UFkcdB21mT2hVc01qUHBRTXVXUCtScWticUE9PQ==', '5p9g0a9hembh8W4AHrg2ojNBS3YySDg5SWtQU21hSE1qSTFLZW11aEM0REdlWFhialMzdkdHTEpLQjA9', 'oVjp23QPn6s68p/leDPzWmVjTkpDVjBsaE5jK0UxUWx1S2M5dkE9PQ==', 'Yes', '2023-12-29 17:31:02');

-- --------------------------------------------------------

--
-- Table structure for table `business_verification`
--

DROP TABLE IF EXISTS `business_verification`;
CREATE TABLE IF NOT EXISTS `business_verification` (
  `B_KEY` int(6) NOT NULL,
  `B_EMAIL_VERIFIED` varchar(3) NOT NULL DEFAULT 'No',
  `B_VERIFICATION_CODE` varchar(4) NOT NULL DEFAULT '0',
  `B_VERIFICATION_TOKEN` varchar(255) DEFAULT NULL,
  `B_ID` varchar(15) NOT NULL,
  PRIMARY KEY (`B_KEY`),
  KEY `business_fk` (`B_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business_verification`
--

INSERT INTO `business_verification` (`B_KEY`, `B_EMAIL_VERIFIED`, `B_VERIFICATION_CODE`, `B_VERIFICATION_TOKEN`, `B_ID`) VALUES
(302952, 'No', '0', NULL, 'C2LB000001');

-- --------------------------------------------------------

--
-- Table structure for table `customer_register`
--

DROP TABLE IF EXISTS `customer_register`;
CREATE TABLE IF NOT EXISTS `customer_register` (
  `C_ID` varchar(20) NOT NULL,
  `C_FNAME` varchar(15) DEFAULT NULL,
  `C_LNAME` varchar(15) DEFAULT NULL,
  `C_BIRTH_DATE` date DEFAULT NULL,
  `C_AGE` int(2) NOT NULL DEFAULT '0',
  `C_GENDER` varchar(6) DEFAULT NULL,
  `C_CONTACT` varchar(255) DEFAULT NULL,
  `C_EMAIL` varchar(255) DEFAULT NULL,
  `C_PASSWORD` varchar(255) DEFAULT NULL,
  `C_TERM_AGREE` varchar(3) NOT NULL DEFAULT 'No',
  `JOIN_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`C_ID`),
  UNIQUE KEY `C_EMAIL` (`C_EMAIL`),
  UNIQUE KEY `C_CONTACT` (`C_CONTACT`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_register`
--

INSERT INTO `customer_register` (`C_ID`, `C_FNAME`, `C_LNAME`, `C_BIRTH_DATE`, `C_AGE`, `C_GENDER`, `C_CONTACT`, `C_EMAIL`, `C_PASSWORD`, `C_TERM_AGREE`, `JOIN_DATE`) VALUES
('C2L0000002', 'Bhavesh', 'Parmar', '2004-02-17', 19, 'Male', 'bg5kRqpaX8EI3GVVBER2NmhrUGI1Uk9OTXp4TDYvQUIzRUwxeEE9PQ==', 'iUQoOlkm50NmzXSd45HNMzFRNmM5b2hvRlNUY2xJYUp1VTNkZkpOdGRGY2p6RG0wWktWWXcxUlBaNGM9', 'mkbvFrHmpz20rrDJZ198wkcxZ2s2SXc3cER4QW5GVkNWQnNKdEE9PQ==', 'Yes', '2023-12-29 17:28:40'),
('C2L0000001', 'Bhavesh', 'Parmar', '2004-02-17', 19, 'Male', 'sxEFdDeq5Ay/C/YAkZbIGVFUdW5vbjNlU0VLaGdCajlUUGhmNUE9PQ==', 'UsrfCreWef8ybuPXRLX5wmZvMXdyb1BIdXZsUzdKdkdsZUxqRGpoTWJoRUdhdzhwUWVBd2o3Y1dIZFE9', 'nV9AeKcbdSnPtAl1HkSqtCtkdGF0cDVqV1VqQU11Y3V0SDhwSHc9PQ==', 'Yes', '2023-12-25 13:42:50');

-- --------------------------------------------------------

--
-- Table structure for table `customer_verification`
--

DROP TABLE IF EXISTS `customer_verification`;
CREATE TABLE IF NOT EXISTS `customer_verification` (
  `C_KEY` int(6) NOT NULL,
  `C_EMAIL_VERIFIED` varchar(3) DEFAULT NULL,
  `C_VERIFY_TOKEN` varchar(255) DEFAULT NULL,
  `C_VERIFICATION_CODE` int(6) NOT NULL DEFAULT '0',
  `C_ID` varchar(20) NOT NULL DEFAULT 'none',
  PRIMARY KEY (`C_KEY`),
  KEY `C_FK_ID` (`C_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_verification`
--

INSERT INTO `customer_verification` (`C_KEY`, `C_EMAIL_VERIFIED`, `C_VERIFY_TOKEN`, `C_VERIFICATION_CODE`, `C_ID`) VALUES
(144309, NULL, NULL, 0, 'C2L0000002'),
(170644, NULL, NULL, 0, 'C2L0000001');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
