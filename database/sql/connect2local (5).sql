-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 11, 2024 at 02:30 AM
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
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(32) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_otp` int(6) DEFAULT NULL,
  `verification_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`admin_id`, `admin_name`, `admin_email`, `admin_password`, `admin_otp`, `verification_token`) VALUES
(1, 'Bhavesh Parmar', '8EakpShlx3xeEJsj0yHoOFZ4NmlyOGhLYWRKUklocnU3eUhPb2h5aFhBTHVhY1lYZXhCaHdWUzBQd1E9', 'KI7fI4Ez4FXmzF69dlQMn2NtTUxIamRydTN4Z2JERHpINFQ3S1E9PQ==', 828850, '$2y$10$dy2eLGg8gBo7.e97LvHZlORCYdoslgpZ8bkaNeJUtnc1vBEvubkdi');

-- --------------------------------------------------------

--
-- Table structure for table `blocked_user_data`
--

DROP TABLE IF EXISTS `blocked_user_data`;
CREATE TABLE IF NOT EXISTS `blocked_user_data` (
  `bu_business_id` varchar(10) NOT NULL,
  `bu_user_id` varchar(10) NOT NULL,
  `bu_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_data`
--

DROP TABLE IF EXISTS `blog_data`;
CREATE TABLE IF NOT EXISTS `blog_data` (
  `blg_id` varchar(10) NOT NULL,
  `bp_user_id` varchar(10) DEFAULT NULL,
  `blg_title` varchar(50) DEFAULT NULL,
  `blg_username` varchar(20) DEFAULT NULL,
  `blg_user_img_url` varchar(255) DEFAULT NULL,
  `blg_content_url` varchar(255) DEFAULT NULL,
  `blg_content_size` varchar(12) NOT NULL DEFAULT '0',
  `blg_description` text,
  `blg_author_name` varchar(32) DEFAULT NULL,
  `blg_content_type` varchar(10) DEFAULT NULL,
  `blg_category` varchar(50) DEFAULT NULL,
  `blg_like_count` int(8) DEFAULT NULL,
  `blg_comment_count` int(8) DEFAULT NULL,
  `blg_share_link` varchar(255) DEFAULT NULL,
  `blgr_profile_url` varchar(255) NOT NULL,
  `blg_release_time` datetime DEFAULT NULL,
  `blg_update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`blg_id`),
  KEY `B_ID` (`bp_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_like_data`
--

DROP TABLE IF EXISTS `blog_like_data`;
CREATE TABLE IF NOT EXISTS `blog_like_data` (
  `blg_id` varchar(10) NOT NULL,
  `like_user_id` varchar(10) NOT NULL,
  `like_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_link_data`
--

DROP TABLE IF EXISTS `blog_link_data`;
CREATE TABLE IF NOT EXISTS `blog_link_data` (
  `blg_id` varchar(10) NOT NULL,
  `bp_user_id` varchar(10) NOT NULL,
  `link_title` varchar(50) NOT NULL,
  `link_url` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_report`
--

DROP TABLE IF EXISTS `blog_report`;
CREATE TABLE IF NOT EXISTS `blog_report` (
  `report_id` varchar(10) NOT NULL,
  `blg_id` varchar(10) NOT NULL,
  `c_id` varchar(10) NOT NULL,
  `bp_user_id` varchar(10) NOT NULL,
  `report_content` varchar(200) NOT NULL,
  `report_time` datetime NOT NULL,
  `report_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`report_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_save_data`
--

DROP TABLE IF EXISTS `blog_save_data`;
CREATE TABLE IF NOT EXISTS `blog_save_data` (
  `blg_id` varchar(10) NOT NULL,
  `user_id` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `business_add_status`
--

DROP TABLE IF EXISTS `business_add_status`;
CREATE TABLE IF NOT EXISTS `business_add_status` (
  `request_id` varchar(10) NOT NULL,
  `business_code` varchar(7) NOT NULL,
  `approval_status` tinyint(1) NOT NULL DEFAULT '0',
  `request_time` datetime NOT NULL,
  `approval_time` datetime DEFAULT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `business_info`
--

DROP TABLE IF EXISTS `business_info`;
CREATE TABLE IF NOT EXISTS `business_info` (
  `business_code` varchar(7) NOT NULL,
  `b_id` varchar(10) NOT NULL,
  `b_key` int(6) NOT NULL,
  `bi_fname` varchar(15) NOT NULL,
  `bi_lname` varchar(15) NOT NULL,
  `business_name` varchar(50) NOT NULL,
  `bi_category` varchar(30) NOT NULL,
  `bi_address` varchar(100) NOT NULL,
  `bi_operate_time` varchar(50) NOT NULL,
  `bi_contact` varchar(255) NOT NULL,
  `bi_email` varchar(255) NOT NULL,
  `bi_web_url` varchar(255) DEFAULT NULL,
  `bi_ig_url` varchar(255) DEFAULT NULL,
  `bi_fb_url` varchar(255) DEFAULT NULL,
  `bi_twitter_url` varchar(255) DEFAULT NULL,
  `bi_linkedin_url` varchar(255) DEFAULT NULL,
  `bi_description` varchar(150) NOT NULL,
  PRIMARY KEY (`business_code`),
  UNIQUE KEY `PHONE` (`bi_contact`,`bi_email`),
  KEY `business_info_fk` (`b_key`,`b_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `business_profile`
--

DROP TABLE IF EXISTS `business_profile`;
CREATE TABLE IF NOT EXISTS `business_profile` (
  `bp_user_id` varchar(10) NOT NULL,
  `b_id` varchar(10) NOT NULL,
  `bp_username` varchar(20) DEFAULT NULL,
  `bp_fname` varchar(15) NOT NULL,
  `bp_lname` varchar(15) NOT NULL,
  `bp_birth_date` date NOT NULL,
  `bp_gender` varchar(6) NOT NULL,
  `bp_category` varchar(30) NOT NULL,
  `bp_profile_img_url` varchar(255) DEFAULT NULL,
  `bp_bio` varchar(150) DEFAULT NULL,
  `bp_update_time` datetime NOT NULL,
  PRIMARY KEY (`bp_user_id`),
  UNIQUE KEY `B_USERNAME` (`bp_username`),
  KEY `business_id_fk` (`b_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `business_profile_interaction`
--

DROP TABLE IF EXISTS `business_profile_interaction`;
CREATE TABLE IF NOT EXISTS `business_profile_interaction` (
  `bp_user_id` varchar(10) NOT NULL,
  `bpi_blog_count` int(5) NOT NULL DEFAULT '0',
  `bpi_follower_count` int(10) NOT NULL DEFAULT '0',
  `bpi_following_count` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bp_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `business_register`
--

DROP TABLE IF EXISTS `business_register`;
CREATE TABLE IF NOT EXISTS `business_register` (
  `b_id` varchar(10) NOT NULL,
  `b_fname` varchar(15) NOT NULL,
  `b_lname` varchar(15) NOT NULL,
  `b_birth_date` date NOT NULL,
  `b_gender` varchar(6) NOT NULL,
  `b_address` varchar(100) NOT NULL,
  `b_category` varchar(30) NOT NULL,
  `b_contact` varchar(255) NOT NULL,
  `b_email` varchar(255) NOT NULL,
  `b_password` varchar(255) NOT NULL,
  `b_term_status` tinyint(1) NOT NULL DEFAULT '0',
  `join_date` datetime DEFAULT NULL,
  PRIMARY KEY (`b_id`),
  UNIQUE KEY `B_CONTACT` (`b_contact`),
  UNIQUE KEY `B_EMAIL` (`b_email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `business_verification`
--

DROP TABLE IF EXISTS `business_verification`;
CREATE TABLE IF NOT EXISTS `business_verification` (
  `b_key` int(6) NOT NULL,
  `b_id` varchar(15) NOT NULL,
  `b_email_status` tinyint(1) NOT NULL DEFAULT '0',
  `b_verification_code` varchar(6) NOT NULL DEFAULT '0',
  `b_verification_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`b_key`),
  KEY `business_fk` (`b_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
-- Table structure for table `customer_data`
--

DROP TABLE IF EXISTS `customer_data`;
CREATE TABLE IF NOT EXISTS `customer_data` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(32) NOT NULL,
  `BIRTH_DATE` date NOT NULL,
  `AGE` int(2) NOT NULL,
  `GENDER` varchar(6) NOT NULL,
  `PHONE` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `NOTIFYFILE` varchar(255) NOT NULL,
  `C_KEY` int(6) NOT NULL,
  `C_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_customer_register` (`C_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_profile`
--

DROP TABLE IF EXISTS `customer_profile`;
CREATE TABLE IF NOT EXISTS `customer_profile` (
  `cp_user_id` varchar(10) NOT NULL,
  `c_id` varchar(10) NOT NULL,
  `cp_username` varchar(30) DEFAULT NULL,
  `cp_profile_img_url` varchar(255) DEFAULT NULL,
  `cp_update_time` datetime NOT NULL,
  PRIMARY KEY (`cp_user_id`),
  UNIQUE KEY `cp_username` (`cp_username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_register`
--

DROP TABLE IF EXISTS `customer_register`;
CREATE TABLE IF NOT EXISTS `customer_register` (
  `c_id` varchar(10) NOT NULL,
  `c_fname` varchar(15) NOT NULL,
  `c_lname` varchar(15) NOT NULL,
  `c_birth_date` date NOT NULL,
  `c_gender` varchar(6) NOT NULL,
  `c_contact` varchar(255) NOT NULL,
  `c_email` varchar(255) NOT NULL,
  `c_password` varchar(255) NOT NULL,
  `c_term_status` tinyint(1) NOT NULL DEFAULT '0',
  `join_date` datetime NOT NULL,
  PRIMARY KEY (`c_id`),
  UNIQUE KEY `C_EMAIL` (`c_email`),
  UNIQUE KEY `C_CONTACT` (`c_contact`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_verification`
--

DROP TABLE IF EXISTS `customer_verification`;
CREATE TABLE IF NOT EXISTS `customer_verification` (
  `c_key` int(6) NOT NULL,
  `c_id` varchar(10) NOT NULL DEFAULT 'none',
  `c_email_status` tinyint(1) NOT NULL DEFAULT '0',
  `c_verification_code` varchar(6) NOT NULL,
  `c_verification_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`c_key`),
  KEY `C_FK_ID` (`c_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `n_id` int(11) NOT NULL AUTO_INCREMENT,
  `n_content` varchar(70) NOT NULL,
  `n_time` datetime NOT NULL,
  `n_user_id` varchar(10) NOT NULL,
  `n_type` varchar(15) NOT NULL,
  `n_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`n_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `salesman_register`
--

DROP TABLE IF EXISTS `salesman_register`;
CREATE TABLE IF NOT EXISTS `salesman_register` (
  `S_ID` int(11) NOT NULL AUTO_INCREMENT,
  `S_FNAME` varchar(15) NOT NULL,
  `S_LNAME` varchar(15) NOT NULL,
  `S_BIRTH_DATE` date NOT NULL,
  `S_AGE` int(2) NOT NULL,
  `S_GENDER` varchar(6) NOT NULL,
  `S_CATEGORY` varchar(7) NOT NULL,
  `S_BUSINESS_NAME` varchar(50) NOT NULL,
  `S_HAVE_STORE` varchar(3) NOT NULL,
  `S_ADDRESS` varchar(255) NOT NULL,
  `S_CITY` varchar(20) NOT NULL,
  `S_PINCODE` int(6) NOT NULL,
  `S_STATE` varchar(20) NOT NULL,
  `S_PHONE` bigint(10) NOT NULL,
  `S_EMAIL` varchar(255) NOT NULL,
  `S_PASSWORD` varchar(255) NOT NULL,
  `S_EMAIL_VERIFIED` varchar(3) NOT NULL,
  `S_AGREE_TERM` varchar(3) NOT NULL,
  `S_JOIN_DATE` datetime NOT NULL,
  `S_KEY` int(6) NOT NULL,
  `S_PHONE_VERIFIED` varchar(3) NOT NULL,
  PRIMARY KEY (`S_ID`),
  UNIQUE KEY `S_EMAIL` (`S_EMAIL`),
  UNIQUE KEY `S_PHONE` (`S_PHONE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
