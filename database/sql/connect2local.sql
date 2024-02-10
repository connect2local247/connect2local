-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 10, 2024 at 02:03 AM
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
-- Table structure for table `admin_login`
--

DROP TABLE IF EXISTS `admin_login`;
CREATE TABLE IF NOT EXISTS `admin_login` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(32) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `SECURITY_KEY` int(6) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`ID`, `NAME`, `EMAIL`, `PASSWORD`, `SECURITY_KEY`) VALUES
(1, 'Bhavesh Parmar', 'mDOFeIyoW8u1viPXYZDZ0GxKM05wM3BzNnJaWE5KNTk4d3RzQjNPNFcxNnpGMkl6dy9rZnBUTjJpajg9', 'J55D7DOVd9gtdFmfxZdbM2pYNEZ4WjNIYkJIWGR6aW81cktjS3c9PQ==', 171392);

-- --------------------------------------------------------

--
-- Table structure for table `blog_data`
--

DROP TABLE IF EXISTS `blog_data`;
CREATE TABLE IF NOT EXISTS `blog_data` (
  `BLG_ID` varchar(15) NOT NULL,
  `BLG_TITLE` varchar(50) DEFAULT NULL,
  `BLG_USERNAME` varchar(20) DEFAULT NULL,
  `BLG_USER_IMG_URL` varchar(255) DEFAULT NULL,
  `BLG_CONTENT_URL` varchar(255) DEFAULT NULL,
  `BLG_CONTENT_SIZE` varchar(12) NOT NULL DEFAULT '0',
  `BLG_DESCRIPT` text,
  `BLG_AUTHOR_NAME` varchar(32) DEFAULT NULL,
  `BLG_CONTENT_TYPE` varchar(10) DEFAULT NULL,
  `BLG_CATEGORY` varchar(50) DEFAULT NULL,
  `BLG_LIKE_COUNT` varchar(4) DEFAULT NULL,
  `BLG_COMMENT_COUNT` varchar(4) DEFAULT NULL,
  `BLG_SHARE_LINK` varchar(255) DEFAULT NULL,
  `BLGR_PROFILE_URL` varchar(255) NOT NULL,
  `BLG_RELEASE_DATE` datetime DEFAULT NULL,
  `BLG_UPDATE_TIME` datetime DEFAULT NULL,
  `USER_ID` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`BLG_ID`),
  KEY `B_ID` (`USER_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_data`
--

INSERT INTO `blog_data` (`BLG_ID`, `BLG_TITLE`, `BLG_USERNAME`, `BLG_USER_IMG_URL`, `BLG_CONTENT_URL`, `BLG_CONTENT_SIZE`, `BLG_DESCRIPT`, `BLG_AUTHOR_NAME`, `BLG_CONTENT_TYPE`, `BLG_CATEGORY`, `BLG_LIKE_COUNT`, `BLG_COMMENT_COUNT`, `BLG_SHARE_LINK`, `BLGR_PROFILE_URL`, `BLG_RELEASE_DATE`, `BLG_UPDATE_TIME`, `USER_ID`) VALUES
('BLG0000001', 'First Blog', 'connect2local', '', '145864 (Original).mp4', '1.84 MB', 'Hi I am Bhavesh', '', 'video/mp4', 'Advertising', '0', '0', 'http://connect2local/pages/blog/blog.php?blog_id=BLG0000001', 'https://connect2local/pages/profile/blogger-profile.php?blogger_id=C2LBU00001', '2024-02-09 09:35:41', NULL, 'C2LBU00001'),
('BLG0000002', 'Professional Advice for All Student', 'connect2local', '', '139165 (Original).mp4', '1.25 MB', 'Hi I am Bhavesh', '', 'video/mp4', 'Advertising', '0', '0', 'http://connect2local/pages/blog/blog.php?blog_id=BLG0000002', 'https://connect2local/pages/profile/blogger-profile.php?blogger_id=C2LBU00001', '2024-02-09 09:39:07', NULL, 'C2LBU00001'),
('BLG0000003', 'My Blog', 'connect2local', '', '1775365.jpg', '74.73 KB', 'HI how are you', '', 'image/jpeg', 'Advertising', '0', '0', 'http://connect2local/pages/blog/blog.php?blog_id=BLG0000003', 'https://connect2local/pages/profile/blogger-profile.php?blogger_id=C2LBU00001', '2024-02-09 09:39:57', NULL, 'C2LBU00001'),
('BLG0000004', 'First Blog', 'Bhavesh_1724', '', 'ai-generated-8018472_1920.png', '2.23 MB', 'Hi I am Bhavesh', '', 'image/png', 'Construction', '0', '0', 'http://connect2local/pages/blog/blog.php?blog_id=BLG0000004', 'https://connect2local/pages/profile/blogger-profile.php?blogger_id=C2LBU00002', '2024-02-09 17:05:19', NULL, 'C2LBU00002'),
('BLG0000005', 'First Blog', 'Bhavesh_1724', '', 'ai-generated-8018472_1920.png', '2.23 MB', 'Hi I am Bhavesh', '', 'image/png', 'Construction', '0', '0', 'http://connect2local/pages/blog/blog.php?blog_id=BLG0000005', 'https://connect2local/pages/profile/blogger-profile.php?blogger_id=C2LBU00002', '2024-02-09 17:06:41', NULL, 'C2LBU00002'),
('BLG0000006', 'First Blog', 'Bhavesh_1724', '', 'ai-generated-8018472_1920.png', '2.23 MB', 'Hi I am Bhavesh', '', 'image/png', 'Construction', '0', '0', 'http://connect2local/pages/blog/blog.php?blog_id=BLG0000006', 'https://connect2local/pages/profile/blogger-profile.php?blogger_id=C2LBU00002', '2024-02-09 17:07:10', NULL, 'C2LBU00002'),
('BLG0000007', 'First Blog', 'Bhavesh_1724', '', 'ai-generated-8018472_1920.png', '2.23 MB', 'Hi I am Bhavesh', '', 'image/png', 'Construction', '0', '0', 'http://connect2local/pages/blog/blog.php?blog_id=BLG0000007', 'https://connect2local/pages/profile/blogger-profile.php?blogger_id=C2LBU00002', '2024-02-09 17:07:57', NULL, 'C2LBU00002'),
('BLG0000008', 'First Blog', 'Bhavesh_1724', '', 'ai-generated-8018472_1920.png', '2.23 MB', 'Hi I am Bhavesh', '', 'image/png', 'Construction', '0', '0', 'http://connect2local/pages/blog/blog.php?blog_id=BLG0000008', 'https://connect2local/pages/profile/blogger-profile.php?blogger_id=C2LBU00002', '2024-02-09 17:10:18', NULL, 'C2LBU00002'),
('BLG0000009', 'Professional Advice for All Student', 'bhavesh_web_studio', 'antivirus-pd6fqgnbeeklbecr.jpg', '145864 (Original).mp4', '1.84 MB', 'Hi Today is the best day for all of us and i am grateful to give you advice as professional in web design that is you need to focus on project based approach rather then focusing object based approach', '', 'video/mp4', 'Construction', '0', '0', 'http://connect2local/pages/blog/blog.php?blog_id=BLG0000009', 'https://connect2local/pages/profile/blogger-profile.php?blogger_id=C2LBU00003', '2024-02-09 17:23:22', NULL, 'C2LBU00003'),
('BLG0000010', 'Tech Problem', 'bhavesh_web_studio', 'antivirus-pd6fqgnbeeklbecr.jpg', '_27x_hwo5kokwi_1438631047.jpg', '2.17 MB', 'Hi how are you', '', 'image/jpeg', 'Construction', '0', '0', 'http://connect2local/pages/blog/blog.php?blog_id=BLG0000010', 'https://connect2local/pages/profile/blogger-profile.php?blogger_id=C2LBU00003', '2024-02-09 17:56:33', NULL, 'C2LBU00003'),
('BLG0000011', 'First Blog', 'bhavesh_web_studio', 'antivirus-pd6fqgnbeeklbecr.jpg', '69986_3D_building_backgound_HD_BG.mp4', '17.38 MB', 'dgdgdgd', '', 'video/mp4', 'Construction', '0', '0', 'http://connect2local/pages/blog/blog.php?blog_id=BLG0000011', 'https://connect2local/pages/profile/blogger-profile.php?blogger_id=C2LBU00003', '2024-02-09 17:57:15', NULL, 'C2LBU00003'),
('BLG0000012', 'My Blog', 'bhavesh_web_studio', 'antivirus-pd6fqgnbeeklbecr.jpg', 'Skill Showcase.png', '67.08 KB', 'hi', '', 'image/png', 'Construction', '0', '0', 'http://connect2local/pages/blog/blog.php?blog_id=BLG0000012', 'https://connect2local/pages/profile/blogger-profile.php?blogger_id=C2LBU00003', '2024-02-09 17:58:20', NULL, 'C2LBU00003');

-- --------------------------------------------------------

--
-- Table structure for table `blog_like_data`
--

DROP TABLE IF EXISTS `blog_like_data`;
CREATE TABLE IF NOT EXISTS `blog_like_data` (
  `BLGR_ID` varchar(10) NOT NULL,
  `BLGR_USERNAME` varchar(20) DEFAULT NULL,
  `LIKE_USERNAME` varchar(20) DEFAULT NULL,
  `LIKE_IMG_URL` varchar(255) DEFAULT NULL,
  `LIKE_PROFILE_URL` varchar(255) DEFAULT NULL,
  `LIKE_COUNT` varchar(4) DEFAULT NULL,
  `LIKE_TIME` datetime DEFAULT NULL,
  PRIMARY KEY (`BLGR_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_link_data`
--

DROP TABLE IF EXISTS `blog_link_data`;
CREATE TABLE IF NOT EXISTS `blog_link_data` (
  `BLG_ID` varchar(15) NOT NULL,
  `BLGR_ID` varchar(10) DEFAULT NULL,
  `BLGR_USERNAME` varchar(20) NOT NULL,
  `LINK_TITLE` varchar(50) NOT NULL,
  `LINK_URL` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_link_data`
--

INSERT INTO `blog_link_data` (`BLG_ID`, `BLGR_ID`, `BLGR_USERNAME`, `LINK_TITLE`, `LINK_URL`) VALUES
('BLG0000001', 'C2LBU00001', 'connect2local', 'Youtube', 'https://youtube.com'),
('BLG0000001', 'C2LBU00001', 'connect2local', 'Instagram', 'https://instagram.com'),
('BLG0000001', 'C2LBU00001', 'connect2local', 'Facebook', 'https://facebook.com'),
('BLG0000002', 'C2LBU00001', 'connect2local', 'Instagram', 'https://instagram.com'),
('BLG0000002', 'C2LBU00001', 'connect2local', 'Youtube', 'https://youtube.com'),
('BLG0000004', 'C2LBU00002', 'Bhavesh_1724', 'Youtube', 'https://youtube.com'),
('BLG0000004', 'C2LBU00002', 'Bhavesh_1724', 'Instagram', 'https://instagram.com'),
('BLG0000005', 'C2LBU00002', 'Bhavesh_1724', 'Youtube', 'https://youtube.com'),
('BLG0000005', 'C2LBU00002', 'Bhavesh_1724', 'Instagram', 'https://instagram.com'),
('BLG0000006', 'C2LBU00002', 'Bhavesh_1724', 'Youtube', 'https://youtube.com'),
('BLG0000006', 'C2LBU00002', 'Bhavesh_1724', 'Instagram', 'https://instagram.com'),
('BLG0000007', 'C2LBU00002', 'Bhavesh_1724', 'Youtube', 'https://youtube.com'),
('BLG0000007', 'C2LBU00002', 'Bhavesh_1724', 'Instagram', 'https://instagram.com'),
('BLG0000008', 'C2LBU00002', 'Bhavesh_1724', 'Youtube', 'https://youtube.com'),
('BLG0000008', 'C2LBU00002', 'Bhavesh_1724', 'Instagram', 'https://instagram.com'),
('BLG0000009', 'C2LBU00003', 'bhavesh_web_studio', 'Youtube', 'https://youtube.com'),
('BLG0000009', 'C2LBU00003', 'bhavesh_web_studio', 'Instagram', 'https://instagram.com'),
('BLG0000010', 'C2LBU00003', 'bhavesh_web_studio', 'Instagram', 'https://instagram.com'),
('BLG0000011', 'C2LBU00003', 'bhavesh_web_studio', 'Youtube', 'https://youtube.com'),
('BLG0000011', 'C2LBU00003', 'bhavesh_web_studio', 'Facebook', 'https://facebook.com'),
('BLG0000012', 'C2LBU00003', 'bhavesh_web_studio', 'Instagram', 'https://instagram.com/bhavesh_web_studio'),
('BLG0000012', 'C2LBU00003', 'bhavesh_web_studio', 'Facebook', 'https://instagram.com/bhavesh_1724');

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
('C2L0001', 'Bhavesh', 'Parmar', 'LAB Solutions', 'Advertising', 'Meldikrupa Society', '', 'fCKmN1LUo4Gy4O5A/MVa5HVaTkJlOE9vUnd6UHJKN3ozdFk0dHc9PQ==', '+RYvKIm2oq9mwlNy9RoNX0NTVHozQjFBRml0R24wamxxMUVGWFlpY3JSNkFpOWVMSUMveWt1QWlFMk09', '', '', '', '', '', 'Hi I am Bhavesh and I am close to finish my bachelours in computer', 'No', '2024-02-09 09:22:28', NULL, 286207, 'C2LB000001'),
('C2L0002', 'Bhavesh', 'Parmar', 'Bhavesh Web Studio', 'Construction', 'Meldikrupa Society', '', 'BN6epqwNrZQlKE5tX0YeV3ZPak0wRkdqNVkxbXpmS2tKUUttQkE9PQ==', 'gKszXJnmWQLwOKxpLxsi8WpuL2R1dHc0TTIwN2RPbXhJTEFEblhzTjVncWhyUHYydWVrd0pIdWRZa1E9', '', '', '', '', '', 'Hi I am Bhavesh', 'No', '2024-02-09 16:52:59', NULL, 323493, 'C2LB000002'),
('C2L0003', 'Bhavesh', 'Parmar', 'Bhavesh Web Studio', 'Construction', 'Meldikrupa Society', '07:45', '4ctA3gW7vbh4JhFsOhRFHkhzaDU1QUlqaXZVN05mQm5HUEVkb3c9PQ==', 'x2fkjHMK1B66voO1LCSQAjMwY1dDMUVwNDlRbUN6WDB5NjVyTm5QWXJpQk9Da1BVUWY1V2Nia1MzLzA9', 'https://www.youtube.com', '', '', '', '', 'Hi I am Bhavesh', 'No', '2024-02-09 17:21:21', NULL, 824068, 'C2LB000003');

-- --------------------------------------------------------

--
-- Table structure for table `business_profile`
--

DROP TABLE IF EXISTS `business_profile`;
CREATE TABLE IF NOT EXISTS `business_profile` (
  `USER_ID` varchar(10) NOT NULL,
  `USERNAME` varchar(30) DEFAULT NULL,
  `FNAME` varchar(15) DEFAULT NULL,
  `LNAME` varchar(15) DEFAULT NULL,
  `BIRTH_DATE` date DEFAULT NULL,
  `GENDER` varchar(6) DEFAULT NULL,
  `BUSINESS_NAME` varchar(50) DEFAULT NULL,
  `ADDRESS` varchar(100) DEFAULT NULL,
  `CATEGORY` varchar(50) DEFAULT NULL,
  `PROFILE_IMG` varchar(255) DEFAULT NULL,
  `BIO` varchar(150) DEFAULT NULL,
  `UPDATE_TIME` datetime DEFAULT NULL,
  `B_ID` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`USER_ID`),
  UNIQUE KEY `B_USERNAME` (`USERNAME`),
  KEY `business_id_fk` (`B_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business_profile`
--

INSERT INTO `business_profile` (`USER_ID`, `USERNAME`, `FNAME`, `LNAME`, `BIRTH_DATE`, `GENDER`, `BUSINESS_NAME`, `ADDRESS`, `CATEGORY`, `PROFILE_IMG`, `BIO`, `UPDATE_TIME`, `B_ID`) VALUES
('C2LBU00001', 'connect2local', 'Bhavesh', 'Parmar', '2004-02-17', 'Male', 'LAB Solutions', 'Meldikrupa Society,Kadi-382715,Gujarat', 'Advertising', NULL, 'hi', '2024-02-09 09:17:20', 'C2LB000001'),
('C2LBU00002', 'Bhavesh_1724', 'Bhavesh', 'Parmar', '2004-02-17', 'Male', 'Bhavesh Web Studio', 'Meldikrupa Society,Kadi-382715,Gujarat', 'Construction', NULL, ' Hi I am Bhavesh', '2024-02-09 16:45:06', 'C2LB000002'),
('C2LBU00003', 'bhavesh_web_studio', 'Bhavesh', 'Parmar', '2004-02-17', 'Male', 'Bhavesh Web Studio', 'Meldikrupa Society,Kadi-382715,Gujarat', 'Construction', 'antivirus-pd6fqgnbeeklbecr.jpg', 'Hi I am Bhavesh best Web Designer For you             ', '2024-02-09 17:14:42', 'C2LB000003');

-- --------------------------------------------------------

--
-- Table structure for table `business_profile_interaction`
--

DROP TABLE IF EXISTS `business_profile_interaction`;
CREATE TABLE IF NOT EXISTS `business_profile_interaction` (
  `USER_ID` varchar(10) NOT NULL,
  `USERNAME` varchar(30) DEFAULT NULL,
  `BLOG_COUNT` int(5) NOT NULL DEFAULT '0',
  `FOLLOWER_COUNT` int(10) NOT NULL DEFAULT '0',
  `FOLLOWING_COUNT` int(10) NOT NULL DEFAULT '0',
  `B_ID` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`USER_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business_profile_interaction`
--

INSERT INTO `business_profile_interaction` (`USER_ID`, `USERNAME`, `BLOG_COUNT`, `FOLLOWER_COUNT`, `FOLLOWING_COUNT`, `B_ID`) VALUES
('C2LBU00002', NULL, 4, 0, 0, 'C2LB000002'),
('C2LBU00003', NULL, 4, 0, 0, 'C2LB000003');

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
('C2LB000001', 'Bhavesh', 'Parmar', '2004-02-17', 19, 'Male', 'Meldikrupa Society,Kadi-382715,Gujarat', 'Advertising', 'bCohpIssL3nxII7LAoBxEVdwZUFvd3c5TU5HeGFJbmxDYjhjQ1E9PQ==', 'X9kNLODZNQM392jNxzv90kNDMWREWGJOOWJPak85ekgxVkVlTGcwR2hvN05EYUE1aGRrK3puNTlLVW89', 'WuGw3KdBeCcxyMLdwdwkUE5UWURkd1lnVHdxejNxM2QrRWpjT0E9PQ==', 'Yes', '2024-02-09 09:17:20'),
('C2LB000002', 'Bhavesh', 'Parmar', '2004-02-17', 19, 'Male', 'Meldikrupa Society,Kadi-382715,Gujarat', 'Construction', 'EuDGK0PaQPSGc3NuBFT/uGVaTHRKZ3RvOVNmM1V6K2lIN2dBVFE9PQ==', 'KS+DR01Fbs0Guky77O/iDHltUXVhT2p2OHZYQXpEWWRMdXlyN2xGSmUyNXp3TWRGZWJOS3ZvRmx4Z1k9', 'p2kQL/5ltY43G7cQRpsI9lRhMVk2MEtLY2h3MXFpRWtUVHI5ZWc9PQ==', 'Yes', '2024-02-09 16:45:06'),
('C2LB000003', 'Bhavesh', 'Parmar', '2004-02-17', 19, 'Male', 'Meldikrupa Society,Kadi-382715,Gujarat', 'Construction', 'W8EpKB1OsFqjpPocoQ1d+DZEWVh4bG5jY0tqQ3o0Q1RHYkpZdXc9PQ==', 'MISsxVuPsEFXGE5bI/TjP1JYdUt6QlhHR29WQVQ0Q2k2VnBoZ0pMVzdwSGVZTEpkVE0xSmhLZTloYXc9', 'JwncTlnSBSjgL+J9mAbMCzd0NDA4NzRzQkVMajhVZ1RZc1IxaHc9PQ==', 'Yes', '2024-02-09 17:14:42');

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
(286207, 'Yes', '0', NULL, 'C2LB000001'),
(323493, 'Yes', '0', NULL, 'C2LB000002'),
(824068, 'Yes', '0', NULL, 'C2LB000003');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `text` text,
  `parent_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`parent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
