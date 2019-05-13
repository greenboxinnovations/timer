-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 13, 2019 at 06:38 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timer`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `sr_no` int(11) DEFAULT '0',
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `no` varchar(13) NOT NULL,
  `best_lap` varchar(10) DEFAULT NULL,
  `best_total` varchar(10) DEFAULT NULL,
  `visits` int(11) NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL,
  `email` varchar(90) NOT NULL,
  `age` int(11) NOT NULL,
  `cust_type` varchar(2) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `sr_no`, `firstname`, `lastname`, `no`, `best_lap`, `best_total`, `visits`, `count`, `email`, `age`, `cust_type`, `date`) VALUES
(1, 11, 'Nikhil', 'Jigjinni', '9763366615', NULL, NULL, 0, 19, 'nikhiljigjinni@gmail.com', 21, 'p', '2017-07-25 13:17:42'),
(2, 2, 's', 'j', '1', NULL, NULL, 0, 5, 'sourabhjigjinni@gmail.com', 27, 'p', '2017-07-20 13:58:23'),
(3, 3, 'Akshay', 'Bhilare', '9762230207', NULL, NULL, 0, 22, 'hmgfjhgf', 27, 'p', '2017-07-11 09:49:29'),
(4, 1, 'aa', 'Jig', '9822051615', NULL, NULL, 0, 16, 'bgcnhfdk', 55, 'p', '2017-07-20 12:27:59'),
(5, 2, 'bb', 'Jig', '9822051615', NULL, NULL, 0, 4, 'bgcnhfdkl', 55, '', '2017-07-20 12:27:51'),
(6, 6, 'qwe', 'drt', '1234567890', NULL, NULL, 0, 10, 'tukutf', 15, 'p', '2017-07-11 11:58:43'),
(7, 7, 'akshay', 'bhilare', '9762230207', NULL, NULL, 0, 1, 'fvdkjbk@jkbn.in', 26, 'p', '2017-07-11 14:07:37'),
(20, 8, 'sagar', 'pilavare', '1234567896', NULL, NULL, 0, 4, 'jk@jk.com', 26, 'p', '2017-07-11 13:45:24'),
(21, 12, 's', 'fg', '1234567895', NULL, NULL, 0, 0, '1212', 34, 'p', '2017-07-20 14:01:11'),
(22, 13, '', '', '', NULL, NULL, 0, 0, '', 0, 'p', '2017-07-20 14:08:49'),
(23, 14, 'a', 'aa', '3216547895', NULL, NULL, 0, 0, 'asd', 3, 'p', '2017-07-20 14:23:29'),
(24, 15, 'er', 'er', '3216547415', NULL, NULL, 0, 0, 'er', 3, 'p', '2017-07-20 14:24:20'),
(25, 16, 't', 't', '1236565123', NULL, NULL, 0, 0, '3', 3, 'p', '2017-07-20 14:27:24'),
(26, 17, 'w', 'w', '7418529632', NULL, NULL, 0, 0, '1', 4, 'p', '2017-07-20 14:29:48'),
(27, 18, 'e', 'e', '7896541238', NULL, NULL, 0, 0, '445', 3, 'p', '2017-07-20 14:30:20'),
(28, 19, 'r', 'e', '3214567899', NULL, NULL, 0, 0, '4', 2, 'p', '2017-07-20 14:33:08'),
(29, 20, 'er', 'e', '3214567899', NULL, NULL, 0, 0, '4', 1231, 'c', '2017-07-20 14:34:50'),
(30, 21, 'asdqwe', 'e', '3214567899', NULL, NULL, 0, 0, '4', 445, 'c', '2017-07-20 14:34:54'),
(31, 22, 'u', 'o', '1459357233', NULL, NULL, 0, 0, 'uij', 23, 'p', '2017-07-20 14:36:37'),
(32, 23, 'sourabh', 'modi', '1472583695', NULL, NULL, 0, 3, 'jh', 12, 'p', '2017-07-20 14:41:25'),
(33, 24, 'yhg', 'modi', '1472583695', NULL, NULL, 0, 3, 'jh', 12, 'c', '2017-07-20 15:37:50'),
(34, 25, 'gh', 'modi', '1472583695', NULL, NULL, 0, 0, 'jh', 12, 'c', '2017-07-20 15:37:53'),
(35, 12, 'do', 'er', '1593571236', NULL, NULL, 0, 0, 'yu', 12, 'p', '2017-07-21 16:23:13'),
(36, 13, 'ui', 'ui', '3698521475', NULL, NULL, 0, 0, 'ui', 12, 'p', '2017-07-21 16:33:16');

-- --------------------------------------------------------

--
-- Table structure for table `id_map`
--

CREATE TABLE `id_map` (
  `map_id` int(11) NOT NULL,
  `kart_id` int(3) NOT NULL,
  `kart_no` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `id_map`
--

INSERT INTO `id_map` (`map_id`, `kart_id`, `kart_no`, `active`, `timestamp`) VALUES
(1, 1, 1, 0, '0000-00-00 00:00:00'),
(2, 2, 2, 1, '0000-00-00 00:00:00'),
(3, 3, 3, 1, '0000-00-00 00:00:00'),
(4, 4, 4, 1, '0000-00-00 00:00:00'),
(5, 5, 5, 1, '0000-00-00 00:00:00'),
(6, 6, 6, 1, '0000-00-00 00:00:00'),
(7, 7, 7, 1, '0000-00-00 00:00:00'),
(8, 8, 8, 1, '0000-00-00 00:00:00'),
(11, 11, 11, 1, '0000-00-00 00:00:00'),
(13, 13, 13, 1, '0000-00-00 00:00:00'),
(14, 14, 14, 1, '0000-00-00 00:00:00'),
(15, 15, 15, 1, '0000-00-00 00:00:00'),
(16, 16, 16, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `master`
--

CREATE TABLE `master` (
  `id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `ride_id` int(3) NOT NULL DEFAULT '0',
  `amount` int(5) NOT NULL DEFAULT '0',
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master`
--

INSERT INTO `master` (`id`, `cust_id`, `ride_id`, `amount`, `date`) VALUES
(13, 1, 1, 400, '2017-07-25');

-- --------------------------------------------------------

--
-- Table structure for table `operations`
--

CREATE TABLE `operations` (
  `op_id` int(11) NOT NULL,
  `kart_no` int(3) NOT NULL,
  `kart_id` int(3) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `ride_id` int(11) DEFAULT NULL,
  `ticket_code` int(11) NOT NULL,
  `name` varchar(90) DEFAULT NULL,
  `cur_lap` int(3) NOT NULL,
  `max_lap` int(3) NOT NULL,
  `timing` text,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `operations`
--

INSERT INTO `operations` (`op_id`, `kart_no`, `kart_id`, `cust_id`, `ride_id`, `ticket_code`, `name`, `cur_lap`, `max_lap`, `timing`, `time`) VALUES
(1, 2, 2, 11, 2, 3853, NULL, 0, 0, NULL, '2017-07-25 10:50:47'),
(2, 0, 0, 11, 2, 8863, NULL, 0, 0, NULL, '2017-07-25 11:01:42'),
(3, 0, 0, 11, 2, 7776, NULL, 0, 0, NULL, '2017-07-25 11:02:18'),
(4, 0, 0, 11, 2, 3245, NULL, 0, 0, NULL, '2017-07-25 11:03:01'),
(5, 0, 0, 11, 1, 4506, NULL, 0, 0, NULL, '2017-07-25 11:03:34'),
(6, 0, 0, 11, 2, 7712, NULL, 0, 0, NULL, '2017-07-25 11:11:32'),
(7, 0, 0, 11, 2, 6214, NULL, 0, 0, NULL, '2017-07-25 11:14:07'),
(8, 0, 0, 11, 1, 8967, NULL, 0, 0, NULL, '2017-07-25 12:30:03'),
(9, 0, 0, 11, 2, 3341, NULL, 0, 0, NULL, '2017-07-25 12:30:32'),
(10, 0, 0, 11, 3, 7793, NULL, 0, 0, NULL, '2017-07-25 12:33:09'),
(11, 0, 0, 11, 1, 8386, NULL, 0, 0, NULL, '2017-07-25 12:33:13'),
(12, 0, 0, 11, 2, 6432, NULL, 0, 0, NULL, '2017-07-25 12:47:02'),
(13, 0, 0, 11, 1, 6043, NULL, 0, 0, NULL, '2017-07-25 12:47:26'),
(14, 0, 0, 11, 2, 9930, NULL, 0, 0, NULL, '2017-07-25 12:51:10'),
(15, 0, 0, 11, 2, 5912, NULL, 0, 0, NULL, '2017-07-25 12:51:25'),
(16, 0, 0, 11, 2, 8558, NULL, 0, 0, NULL, '2017-07-25 12:53:36'),
(17, 0, 0, 11, 2, 5768, NULL, 0, 0, NULL, '2017-07-25 12:53:50'),
(18, 0, 0, 11, 1, 4733, NULL, 0, 0, NULL, '2017-07-25 13:07:30'),
(19, 0, 0, 11, 3, 6645, NULL, 0, 0, NULL, '2017-07-25 13:07:30'),
(20, 0, 0, 11, 1, 9979, NULL, 0, 0, NULL, '2017-07-25 13:17:42'),
(21, 8, 8, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 06:16:09'),
(22, 8, 8, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 06:30:55'),
(23, 8, 8, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 06:32:46'),
(24, 8, 8, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 06:34:34'),
(25, 6, 6, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 06:50:17'),
(26, 7, 7, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 06:53:38'),
(27, 5, 5, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 06:54:43'),
(28, 4, 4, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 06:56:04'),
(29, 3, 3, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 06:58:10'),
(30, 1, 1, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 06:59:45'),
(31, 19, 19, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 07:01:24'),
(32, 16, 16, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 07:02:47'),
(33, 15, 15, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 07:04:20'),
(34, 14, 14, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 07:05:41'),
(35, 13, 13, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 07:06:55'),
(36, 11, 11, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 07:09:32'),
(37, 11, 11, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 07:44:50'),
(38, 6, 6, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 12:51:36'),
(39, 6, 6, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 12:51:54'),
(40, 6, 6, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 13:00:40'),
(41, 6, 6, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 13:02:11'),
(42, 7, 7, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 13:02:14'),
(43, 8, 8, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 13:02:14'),
(44, 6, 6, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 13:03:59'),
(45, 6, 6, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 13:05:17'),
(46, 1, 1, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 13:18:36'),
(47, 1, 1, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 13:55:32'),
(48, 6, 6, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 13:55:32'),
(49, 15, 15, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 14:09:44'),
(50, 15, 15, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 14:10:02'),
(51, 15, 15, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 14:11:08'),
(52, 4, 4, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 14:17:28'),
(53, 4, 4, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 14:17:49'),
(54, 4, 4, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 14:18:42'),
(55, 11, 11, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 14:33:48'),
(56, 5, 5, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 14:33:48'),
(57, 5, 5, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 14:34:27'),
(58, 3, 3, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 14:45:18'),
(59, 3, 3, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 14:45:33'),
(60, 3, 3, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 14:47:18'),
(61, 7, 7, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 14:53:48'),
(62, 1, 1, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 15:06:13'),
(63, 14, 14, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 15:22:51'),
(64, 14, 14, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 15:23:04'),
(65, 16, 16, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 15:31:06'),
(66, 16, 16, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 15:32:02'),
(67, 13, 13, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 15:38:08'),
(68, 13, 13, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 15:38:50'),
(69, 19, 19, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 15:45:47'),
(70, 19, 19, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 15:46:16'),
(71, 2, 2, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 15:54:12'),
(72, 2, 2, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-29 16:05:52'),
(73, 1, 1, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 04:58:22'),
(74, 3, 3, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 04:58:23'),
(75, 7, 7, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 04:58:23'),
(76, 8, 8, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 04:58:23'),
(77, 4, 4, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:20:07'),
(78, 4, 4, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:21:31'),
(79, 14, 14, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:21:53'),
(80, 14, 14, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:22:33'),
(81, 1, 1, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:23:02'),
(82, 1, 1, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:23:22'),
(83, 5, 5, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:24:09'),
(84, 5, 5, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:24:43'),
(85, 3, 3, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:25:20'),
(86, 8, 8, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:26:00'),
(87, 8, 8, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:26:25'),
(88, 8, 8, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:26:44'),
(89, 6, 6, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:27:06'),
(90, 6, 6, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:27:18'),
(91, 2, 2, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:28:09'),
(92, 2, 2, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:28:20'),
(93, 7, 7, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:28:21'),
(94, 7, 7, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:28:43'),
(95, 13, 13, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:29:45'),
(96, 16, 16, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:29:46'),
(97, 15, 15, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:30:01'),
(98, 16, 16, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:30:22'),
(99, 13, 13, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:30:44'),
(100, 15, 15, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:30:59'),
(101, 7, 7, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:39:19'),
(102, 5, 5, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:39:24'),
(103, 1, 1, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:41:05'),
(104, 5, 5, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:41:17'),
(105, 8, 8, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:41:37'),
(106, 6, 6, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:41:37'),
(107, 3, 3, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:41:38'),
(108, 1, 1, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:41:38'),
(109, 4, 4, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:41:38'),
(110, 7, 7, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:41:39'),
(111, 15, 15, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:41:40'),
(112, 14, 14, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:41:40'),
(113, 13, 13, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:41:41'),
(114, 16, 16, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:41:41'),
(115, 11, 11, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 09:50:58'),
(116, 2, 2, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 10:05:21'),
(117, 6, 6, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 10:14:02'),
(118, 4, 4, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 10:22:59'),
(119, 15, 15, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 10:23:33'),
(120, 1, 1, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 10:24:00'),
(121, 16, 16, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 10:42:32'),
(122, 13, 13, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 10:42:32'),
(123, 14, 14, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 10:42:32'),
(124, 15, 15, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 10:42:33'),
(125, 11, 11, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 10:42:33'),
(126, 7, 7, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 10:42:33'),
(127, 4, 4, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 10:42:34'),
(128, 5, 5, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 10:42:34'),
(129, 6, 6, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 10:42:35'),
(130, 8, 8, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 10:42:35'),
(131, 6, 6, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 10:45:11'),
(132, 1, 1, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 10:59:53'),
(133, 2, 2, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 10:59:53'),
(134, 3, 3, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 10:59:54'),
(135, 2, 2, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 11:08:56'),
(136, 2, 2, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 11:22:04'),
(137, 5, 5, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 11:22:05'),
(138, 7, 7, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 11:22:05'),
(139, 3, 3, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 11:22:06'),
(140, 1, 1, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 11:24:10'),
(141, 8, 8, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 11:24:10'),
(142, 5, 5, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 11:24:26'),
(143, 7, 7, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 11:34:31'),
(144, 16, 16, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 11:34:32'),
(145, 13, 13, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 11:36:17'),
(146, 1, 1, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 11:37:34'),
(147, 5, 5, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 11:37:35'),
(148, 7, 7, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 11:37:35'),
(149, 14, 14, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 11:37:35'),
(150, 1, 1, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 11:43:16'),
(151, 5, 5, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 11:43:17'),
(152, 7, 7, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 11:43:17'),
(153, 5, 5, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 12:29:39'),
(154, 16, 16, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 12:29:39'),
(155, 8, 8, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 12:40:13'),
(156, 1, 1, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 12:40:13'),
(157, 6, 6, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 12:45:33'),
(158, 13, 13, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 12:45:33'),
(159, 2, 2, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 12:48:03'),
(160, 14, 14, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 12:48:04'),
(161, 13, 13, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 12:48:39'),
(162, 5, 5, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 12:49:53'),
(163, 3, 3, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 12:49:54'),
(164, 7, 7, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 12:49:54'),
(165, 15, 15, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 12:49:54'),
(166, 14, 14, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 12:49:55'),
(167, 16, 16, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 12:49:55'),
(168, 14, 14, 0, 1, 0, ' ', 0, 0, NULL, '2019-03-30 12:53:21'),
(169, 1, 1, 0, 1, 0, ' ', 0, 0, NULL, '2019-05-13 16:35:08'),
(170, 1, 1, 0, 1, 0, ' ', 0, 0, NULL, '2019-05-13 16:35:57');

-- --------------------------------------------------------

--
-- Table structure for table `ping_kart`
--

CREATE TABLE `ping_kart` (
  `ping_id` int(11) NOT NULL,
  `kart_no` int(11) NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ping_kart`
--

INSERT INTO `ping_kart` (`ping_id`, `kart_no`, `timestamp`) VALUES
(1, 1, '2019-05-13 22:05:56'),
(2, 2, '2019-04-05 11:06:08'),
(3, 3, '2019-04-10 07:35:08'),
(4, 4, '2019-03-31 09:41:34'),
(5, 5, '2019-04-13 07:50:23'),
(6, 6, '2019-04-03 20:18:14'),
(7, 7, '2019-04-05 20:37:38'),
(8, 8, '2019-04-11 06:01:36'),
(11, 11, '2019-03-31 09:41:34'),
(13, 13, '2019-04-05 20:37:38'),
(14, 14, '2019-04-05 20:37:38'),
(15, 15, '2019-03-31 09:41:34'),
(16, 16, '2019-04-05 20:37:38');

-- --------------------------------------------------------

--
-- Table structure for table `rides`
--

CREATE TABLE `rides` (
  `id` int(11) NOT NULL,
  `name` varchar(90) NOT NULL,
  `img` varchar(90) NOT NULL,
  `rate` int(5) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rides`
--

INSERT INTO `rides` (`id`, `name`, `img`, `rate`) VALUES
(1, 'go karting 1', 'ic_gk1.png', 400),
(2, 'go karting 2', 'ic_gk2.png', 700),
(3, 'atv bikes', 'ic_atv.png', 400),
(4, 'zipline', 'ic_zipline.png', 550),
(5, 'dashing car', 'ic_dash.png', 250),
(6, 'giant wheel', 'ic_wheel.png', 90),
(7, 'gyroscope', 'ic_gyro.png', 150),
(8, 'rodeo bull', 'ic_bull.png', 200),
(9, 'bungee trampoline', 'ic_tramp.png', 200),
(10, 'bungee ejection', 'ic_eject.png', 250),
(11, 'drop tower', 'ic_tower.png', 250),
(12, 'merry go round', 'ic_round.png', 90),
(13, 'indoor games', 'ic_indoorgames.png', 70),
(14, 'shooting', 'ic_shooting.png', 120),
(15, 'video games', 'ic_video.png', 15),
(16, 'air hockey', 'ic_hockey.png', 130),
(17, 'massage chair', 'ic_massage.png', 150);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `pass` text NOT NULL,
  `role` varchar(30) NOT NULL,
  `camera` int(1) NOT NULL,
  `p_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `pass`, `role`, `camera`, `p_status`) VALUES
(1, 'admin', '$2y$12$69fxRHZrRlwlFj9gc4HloOf9GvicMzhag6/lGwTz1e2wIgFsrLj32', 'admin', 1, 8),
(2, 'user1', '$2y$12$UrkJsg6fHHBLidX/rHAH2u9L1dZAMX5WR3zrpIH4nN2ms3//fJyiq', 'cashier', 0, 0),
(3, 'user2', '$2y$12$2qx9/DYye5GwdW.2hesLJ.GYg4Ru/WBGCM23pB3YB.EthSCg2VZTe', 'cashier', 0, 0),
(4, 'superadmin', '12345', 'superadmin', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `id_map`
--
ALTER TABLE `id_map`
  ADD PRIMARY KEY (`map_id`);

--
-- Indexes for table `master`
--
ALTER TABLE `master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operations`
--
ALTER TABLE `operations`
  ADD PRIMARY KEY (`op_id`);

--
-- Indexes for table `ping_kart`
--
ALTER TABLE `ping_kart`
  ADD PRIMARY KEY (`ping_id`);

--
-- Indexes for table `rides`
--
ALTER TABLE `rides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `id_map`
--
ALTER TABLE `id_map`
  MODIFY `map_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `master`
--
ALTER TABLE `master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `operations`
--
ALTER TABLE `operations`
  MODIFY `op_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `ping_kart`
--
ALTER TABLE `ping_kart`
  MODIFY `ping_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `rides`
--
ALTER TABLE `rides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
