-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 20, 2015 at 12:15 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dreamjob`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`, `picture`) VALUES
(1, 'Kams', 'kam@yahoo.com', '10c4981bb793e1698a83aea43030a388', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_title` text NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `expired_date` datetime DEFAULT NULL,
  `status` enum('pending','expired','approved','live') NOT NULL,
  `expert_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `user_msg` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `job_title`, `created_date`, `expired_date`, `status`, `expert_id`, `user_id`, `user_msg`) VALUES
(1, 'test', '2015-03-11 18:51:37', NULL, 'approved', 1487596926, 1487596926, 'test'),
(2, 'cheicken', '2015-03-12 09:01:06', NULL, 'pending', 1382715758, 1487596926, 'rtt'),
(3, 'cheicken', '2015-03-12 09:01:06', NULL, 'pending', 1382715758, 1487596926, 'rtt'),
(4, 'cheicken', '2015-03-12 09:01:06', NULL, 'pending', 1382715758, 1487596926, 'rtt'),
(5, 'cheicken', '2015-03-12 09:01:06', NULL, 'pending', 1382715758, 1487596926, 'rtt'),
(6, 'cheicken', '2015-03-12 09:01:06', NULL, 'pending', 1382715758, 1487596926, 'rtt'),
(7, 'cheicken', '2015-03-12 09:01:06', NULL, 'pending', 1382715758, 1487596926, 'rtt'),
(8, 'cheicken', '2015-03-12 09:01:06', NULL, 'pending', 1382715758, 1487596926, 'rtt'),
(9, 'cheicken', '2015-03-12 09:01:06', NULL, 'pending', 1382715758, 1487596926, 'rtt'),
(10, 'cheicken', '2015-03-12 09:01:06', NULL, 'pending', 1382715758, 1487596926, 'rtt'),
(11, 'cheicken', '2015-03-12 09:01:06', NULL, 'pending', 1382715758, 1487596926, 'rtt'),
(12, 'cheicken', '2015-03-12 09:01:06', NULL, 'pending', 1382715758, 1487596926, 'rtt'),
(13, 'cheicken', '2015-03-12 09:01:06', NULL, 'pending', 1382715758, 1487596926, 'rtt'),
(14, 'cheicken', '2015-03-12 09:01:06', NULL, 'pending', 1382715758, 1487596926, 'rtt'),
(15, 'cheicken', '2015-03-12 09:01:06', NULL, 'pending', 1382715758, 1487596926, 'rtt'),
(16, 'cheicken', '2015-03-12 09:01:06', NULL, 'pending', 1382715758, 1487596926, 'rtt'),
(17, 'cheicken', '2015-03-12 09:01:06', NULL, 'pending', 1382715758, 1487596926, 'rtt'),
(18, 'cheicken', '2015-03-12 09:01:06', NULL, 'pending', 1382715758, 1487596926, 'rtt'),
(19, 'cheicken', '2015-03-12 09:01:06', NULL, 'pending', 1382715758, 1487596926, 'rtt'),
(20, 'cheicken', '2015-03-12 09:01:06', NULL, 'pending', 1382715758, 1487596926, 'rtt'),
(21, 'cheicken', '2015-03-12 09:01:06', NULL, 'pending', 1382715758, 1487596926, 'rtt'),
(22, 'cheicken', '2015-03-12 09:01:06', NULL, 'pending', 1382715758, 1487596926, 'rtt'),
(23, 'cheicken', '2015-03-12 09:01:06', NULL, 'pending', 1382715758, 1487596926, 'rtt'),
(24, 'cheicken', '2015-03-12 09:01:06', NULL, 'pending', 1382715758, 1487596926, 'rtt'),
(25, 'cheicken', '2015-03-12 09:01:06', NULL, 'pending', 1382715758, 1487596926, 'rtt'),
(26, 'cheicken', '2015-03-12 09:01:06', NULL, 'pending', 1382715758, 1487596926, 'rtt'),
(27, 'cheicken', '2015-03-12 09:01:06', NULL, 'pending', 1382715758, 1487596926, 'rtt'),
(28, 'cheicken', '2015-03-12 09:01:06', NULL, 'pending', 1382715758, 1487596926, 'rtt'),
(29, 'cheicken', '2015-03-12 09:01:06', NULL, 'pending', 1382715758, 1487596926, 'rtt'),
(30, 'cheicken', '2015-03-12 09:01:06', NULL, 'pending', 1382715758, 1487596926, 'rtt');

-- --------------------------------------------------------

--
-- Table structure for table `steps`
--

CREATE TABLE IF NOT EXISTS `steps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `step` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `steps`
--

INSERT INTO `steps` (`id`, `job_id`, `step`) VALUES
(1, 1, 'A'),
(2, 1, 'B'),
(3, 1, 'C');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `twitter_id` bigint(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `bio` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `twitter_id`, `name`, `username`, `pic`, `bio`) VALUES
(1, 98217866, '[TEST]/æ¾æ‘å¼˜åŸº', 'hiroki_test', 'http://pbs.twimg.com/profile_images/555422781962084354/K-HrbGZz_bigger.jpeg', 'ã‚¹ã‚¿ã‚¸ã‚ªã€ãƒ„ã‚¢ãƒ¼ãƒŸãƒ¥ãƒ¼ã‚¸ã‚·ãƒ£ãƒ³ã—ãŸã‚Šæ›²ä½œã£ãŸã‚Šã€ãƒ‹ã‚³å‹•ã§[TEST]ã¨ã—ã¦æ¼”å¥æ´»å‹•ã—ãŸã‚Šã€‚\nåŸºæœ¬ã‚®ã‚¿ãƒªã‚¹ãƒˆã§ã™ãŒã€ä½œç·¨æ›²ã€æŽ¡è­œã€ãƒ™ãƒ¼ã‚¹æ¼”å¥ã€ãƒ¬ãƒƒã‚¹ãƒ³ãªã©ã‚‚è«‹ã‘è² ã£ã¦ãŠã‚Šã¾ã™ã€‚\n\nãŠä»•äº‹ã®ã”ä¾é ¼ã¯â€test2525es335@gmail.comâ€ã¾ã§ãŠå•ã„åˆã‚ã›ä¸‹ã•ã„ã€‚\nHiroki Matsumura'),
(2, 1487596926, 'Iqbal Malik', 'iqbal_malik89', 'http://pbs.twimg.com/profile_images/549045451849093120/Q1ret5fu_bigger.jpeg', 'PHP Evangelist, API Engineer'),
(3, 1382715758, 'ã¡ã‡ã„', 'cheicken_GB', 'http://pbs.twimg.com/profile_images/537544501481316352/DmsSxg5x_bigger.jpeg', 'ã‚ã åˆ‡ãªã ç‰‡æƒ³ã²â€¥');

-- --------------------------------------------------------

--
-- Table structure for table `watch`
--

CREATE TABLE IF NOT EXISTS `watch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `twitter_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `sent` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
