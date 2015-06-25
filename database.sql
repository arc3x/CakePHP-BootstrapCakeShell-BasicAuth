-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 25, 2015 at 12:12 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `clientportal`
--
CREATE DATABASE IF NOT EXISTS `clientportal` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `clientportal`;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `thumbnail_picture` varchar(255) NOT NULL,
  `bio` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `full_name`, `picture`, `thumbnail_picture`, `bio`, `created`, `modified`) VALUES
(2, 11, '', '', '', '', '2015-06-24 23:38:52', '2015-06-24 23:38:52'),
(3, 12, '', '', '', '', '2015-06-25 00:02:41', '2015-06-25 00:02:41'),
(4, 13, '', '', '', '', '2015-06-25 00:03:13', '2015-06-25 00:03:13'),
(5, 14, '', '', '', '', '2015-06-25 00:07:09', '2015-06-25 00:07:09');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `value` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `created`, `modified`) VALUES
(1, 'Company Name', 'Theta Designs', '2014-09-07 01:02:08', '2014-09-07 01:02:08'),
(2, 'Company Email (Send [can be fake])', 'noreply@thetadesigns.com', '2014-09-07 01:02:51', '2014-09-11 19:44:01'),
(3, 'Company Email (Recieve)', 'arco000@gmail.com', '2014-09-07 15:21:07', '2014-09-07 15:22:47');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE IF NOT EXISTS `tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `token` varchar(32) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`id`, `userid`, `type`, `role`, `token`, `created`, `modified`) VALUES
(1, 11, 'account', '1', '0adccc3058e0fdd6ea19ef82aa963fe5', '2015-06-24 23:38:52', '2015-06-24 23:38:52'),
(2, 12, 'account', '1', 'b02613e6e34638ddfba2bd4bd56c7272', '2015-06-25 00:02:41', '2015-06-25 00:02:41'),
(4, 14, 'account', '1', 'df1de734cf7c76942d80b4d3d5ff01cd', '2015-06-25 00:07:09', '2015-06-25 00:07:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` int(1) NOT NULL DEFAULT '0',
  `role_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `active`, `role_id`, `username`, `password`, `email`, `created`, `modified`) VALUES
(1, 1, 3, 'tester', '$2a$10$g45WpibRUXtpEV9mVKLQeO17qerMVCmHENX20aE2CpASZxFr7q6/y', 'test@test.com', '2015-06-25 00:07:09', '2015-06-25 00:07:09');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
