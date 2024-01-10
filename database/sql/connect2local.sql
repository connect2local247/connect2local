-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 10, 2024 at 02:31 AM
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
-- Table structure for table `business_info`
--

DROP TABLE IF EXISTS `business_info`;
CREATE TABLE IF NOT EXISTS `business_info` (
  `BUSINESS_CODE` varchar(7) NOT NULL,
  `FNAME` varchar(15) DEFAULT NULL,
  `LNAME` varchar(15) DEFAULT NULL,
  `BUSINESS_NAME` varchar(50) DEFAULT NULL,
  `CATEGORY` varchar(50) DEFAULT NULL,
  `ADDRESS` varchar(100) DEFAULT NULL,
  `OPERATE_TIME` varchar(50) DEFAULT NULL,
  `PHONE` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `WEB_URL` varchar(255) DEFAULT NULL,
  `IG_URL` varchar(255) DEFAULT NULL,
  `FB_URL` varchar(255) DEFAULT NULL,
  `X_URL` varchar(255) DEFAULT NULL,
  `LINKEDIN_URL` varchar(255) DEFAULT NULL,
  `DESCRIPTION` varchar(150) NOT NULL,
  `APPROVAL_STATUS` varchar(3) NOT NULL DEFAULT 'No',
  `REQUEST_TIME` datetime NOT NULL,
  `APPROVAL_TIME` datetime DEFAULT NULL,
  `B_KEY` int(6) NOT NULL,
  `B_ID` varchar(10) NOT NULL,
  PRIMARY KEY (`BUSINESS_CODE`),
  UNIQUE KEY `PHONE` (`PHONE`,`EMAIL`),
  KEY `business_info_fk` (`B_KEY`,`B_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business_info`
--

INSERT INTO `business_info` (`BUSINESS_CODE`, `FNAME`, `LNAME`, `BUSINESS_NAME`, `CATEGORY`, `ADDRESS`, `OPERATE_TIME`, `PHONE`, `EMAIL`, `WEB_URL`, `IG_URL`, `FB_URL`, `X_URL`, `LINKEDIN_URL`, `DESCRIPTION`, `APPROVAL_STATUS`, `REQUEST_TIME`, `APPROVAL_TIME`, `B_KEY`, `B_ID`) VALUES
('C2L0001', 'Bhavesh', 'Parmar', 'LAB Solutions', 'Automobile', 'Dhaval Plaza', '', '9723884857', 'mycoding1724@gmail.com', '', '', '', '', '', 'Lab Solutions, a prominent name in the automobile industry, stands as a beacon of innovation and excellence.', 'No', '2024-01-09 16:45:39', NULL, 315276, 'C2LB000001'),
('C2L0002', 'Bhavesh', 'Parmar', 'LAB Solutions', 'Automobile', 'Dhaval Plaza', '', 'V+EHW14u4mF3m2bRSC0jgVVkQzMzVzROWG1yT0lWYXFGT3VTWEE9PQ==', 'SFmQewBpN04OnFTmQUoHdmRsbzBTU1JoS2doVzhrT1lmQ2VDaWRiZEFGUGlVTHpGQkFZdDYyK2F0N1U9', '', '', '', '', '', 'Lab Solutions, a prominent name in the automobile industry, stands as a beacon of innovation and excellence.', 'No', '2024-01-09 16:49:25', NULL, 315276, 'C2LB000001');

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
('C2LB000001', 'Bhavesh', 'Parmar', '2004-02-17', 19, 'Male', 'Dhaval Plaza,Kadi-382715,Gujarat', 'Automobile', 'xgcyFrdKyXHAtEY0cwuqvFF6Qlo0YW1GdEJUWk5CYnJLbFV0dGc9PQ==', 'aL9+zAVwkqxPxH5o/h4vuDFQMGpWb1RQZFBDQ1ZRNWZEQTJWOFc0WFMwcHFOUFhPTllTT3d5M3k5Tms9', '/ZZ10n5iKO+5QMz1n41t4kxod0d3SVA4OTYwMEFVZWNXZTgxalE9PQ==', 'Yes', '2024-01-09 16:37:53');

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
(315276, 'Yes', '0', NULL, 'C2LB000001');

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
('C2L0000001', 'Bhavesh', 'Parmar', '2004-02-17', 19, 'Male', '29aojGrSeFXJom+kI/Isw2Z5cEFzQVIyVGovZkdIbVp1T1hWTXc9PQ==', 'G4LXf7yiyxut+/rD4REUImNFNDl4NUQyQ3lqMFB6R0VrTGFvemdPKzFpRDVnUE8ySUNUTVdRSnpocFE9', 'ef7p0nrZhq9ybhfXBa0AJXZ1OSt0RmsxNDFXOUoyRjd4STdZS2c9PQ==', 'Yes', '2024-01-05 10:28:50'),
('C2L0000002', 'Bhavesh', 'Parmar', '2004-02-17', 19, 'Male', 'pLLsDXPS2YRYUDj2lGad00xDVktla1pWaVV4Syt2cFpWRmkxaUE9PQ==', 'Ry/nKVsC9QTcwP8xyljhH3hXWXVJYlE1YXVxbDNLVGRxNXBVWE9EdGhHV1dNejNNbmFpdnZ2T3lJclE9', '+X9XbuFTzIoxasGVwNGqHkRCL0xkUDBpREdaZU1xNjk3c1VyNnc9PQ==', 'Yes', '2024-01-05 11:18:23'),
('C2L0000003', 'Bhavesh', 'Parmar', '2004-02-17', 19, 'Male', 'tgEvjDtQ9GPnfu3A1RfwoE1xVUtlQjVnbXc1c0xGTS9CbDFxQnc9PQ==', '+ZVvH+PdOhysYkhqW3WbFFV3UERPZitZRjhnOFhuWDlKMzhlcWl2ZVFxeHNQUzhWNUpyNXRyalduY0k9', 'kjPM7fTS9zt179bQFmEQPXJPTjZPM29BNHhZNkZRNEx4THhOR2c9PQ==', 'Yes', '2024-01-05 11:51:48');

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
(994476, 'Yes', '$2y$10$YDXzBO73ENxWaSxw80NrA.n0BmT5Y.s5veFBA530eoylA/I1bhqNW', 0, 'C2L0000001'),
(374538, 'Yes', '$2y$10$4ifdAJlU3Bffk51hvTO.z.w9H5onFOu3yim.Egj9x0S5czgT9Mz3i', 0, 'C2L0000002'),
(520437, 'Yes', '$2y$10$Sx4W8eQbaP5xIRg9nheiFu1GFqKBU18K60mKIjbutPOQFNWEcKTVK', 0, 'C2L0000003');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
