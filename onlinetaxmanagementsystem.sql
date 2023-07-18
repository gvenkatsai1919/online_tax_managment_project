-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2022 at 05:01 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinetaxmanagementsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `acc_details`
--

CREATE TABLE `acc_details` (
  `acc_no` varchar(16) NOT NULL,
  `acc_pwd` varchar(20) DEFAULT NULL,
  `bname` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `acc_details`
--

INSERT INTO `acc_details` (`acc_no`, `acc_pwd`, `bname`) VALUES
('123412341234', 'asedef123', 'icici'),
('123456789012', 'asedef123', 'icici'),
('213412345235', 'asedef123', 'hdfc'),
('234523413532', 'asedef123', 'hdfc'),
('234567890123', 'adfgaeeq', 'hdfc'),
('298345893451', 'asedef123', 'hdfc'),
('345234523423', 'asedef123', 'idfc'),
('523456341234', 'asedef123', 'sbi'),
('531583400623', 'awefawefae', 'sbi'),
('786745623413', 'asedef123', 'kotak'),
('923421573434', 'asedef123', 'axis');

-- --------------------------------------------------------

--
-- Table structure for table `acc_no`
--

CREATE TABLE `acc_no` (
  `reg_id` varchar(10) NOT NULL,
  `acc_no` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `acc_no`
--

INSERT INTO `acc_no` (`reg_id`, `acc_no`) VALUES
('ABCTY1191S', '123412341234'),
('ABCTY1191S', '213412345235'),
('ABCTY1191S', '523456341234'),
('ABCTY1234D', '123456789012'),
('ABCTY1234D', '234567890123'),
('ABCTY1567E', '298345893451'),
('ABCTY1567E', '531583400623'),
('ABCTY1987E', '234523413532'),
('ABCTY1987E', '786745623413'),
('ABCTY1987E', '923421573434'),
('ABCTY8986D', '345234523423');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` varchar(10) NOT NULL,
  `admin_uid` varchar(40) DEFAULT NULL,
  `admin_pwd` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_uid`, `admin_pwd`) VALUES
('130822', 'admin420@gmail.com', '@admin42');

-- --------------------------------------------------------

--
-- Table structure for table `card_details`
--

CREATE TABLE `card_details` (
  `card_name` varchar(20) DEFAULT NULL,
  `card_no` varchar(16) NOT NULL,
  `card_exp` date DEFAULT NULL,
  `cvv` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `card_details`
--

INSERT INTO `card_details` (`card_name`, `card_no`, `card_exp`, `cvv`) VALUES
('Dhanush', '1234567890123456', '2026-04-01', 403),
('dhanush', '2345672342374034', '2027-07-01', 213),
('dhanush', '2375854635467564', '2025-03-01', 200),
('DHANUSH', '2835457843576479', '2029-09-01', 500),
('harshith', '3153513534113435', '2027-12-01', 123),
('venkatg', '4753845762384934', '2030-11-01', 246),
('viveksk', '5647264245974053', '2027-02-01', 563),
('dhanush', '6547424576454359', '2027-04-01', 248),
('vishnub', '6556264582743724', '2032-08-01', 345),
('VIVEK', '6894234587659435', '2029-08-01', 264),
('venkatg', '7845734720248205', '2024-07-01', 234),
('vishnub', '7965973645872693', '2026-06-01', 645);

-- --------------------------------------------------------

--
-- Table structure for table `card_no`
--

CREATE TABLE `card_no` (
  `reg_id` varchar(10) NOT NULL,
  `card_no` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `card_no`
--

INSERT INTO `card_no` (`reg_id`, `card_no`) VALUES
('ABCTY1191S', '4753845762384934'),
('ABCTY1191S', '7845734720248205'),
('ABCTY1234D', '3153513534113435'),
('ABCTY1567E', '1234567890123456'),
('ABCTY1567E', '2345672342374034'),
('ABCTY1567E', '2375854635467564'),
('ABCTY1567E', '2835457843576479'),
('ABCTY1567E', '6547424576454359'),
('ABCTY1987E', '6556264582743724'),
('ABCTY1987E', '7965973645872693'),
('ABCTY8986D', '5647264245974053'),
('ABCTY8986D', '6894234587659435');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city` varchar(20) NOT NULL,
  `zip` int(11) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city`, `zip`, `state`) VALUES
('guntur', 500520, 'andrapradesh'),
('hyderbad', 500790, 'telangana'),
('khammam', 500702, 'telangana'),
('nellore', 500560, 'andrapradesh'),
('tenali', 522201, 'andrapradesh'),
('warangal', 500765, 'telangana');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `reg_id` varchar(10) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `client_uid` varchar(40) NOT NULL,
  `client_pwd` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`reg_id`, `fname`, `lname`, `gender`, `email`, `dob`, `city`, `client_uid`, `client_pwd`) VALUES
('ABCTY1191S', 'Venkat', 'Sai', 'male', 'venkatsai21@gmail.com', '2002-09-09', 'khammam', 'venkatsai21@gmail.com', 'venkatsai21'),
('ABCTY1234D', 'Harshith', 'reddy', 'male', 'harshith15@gmail.com', '2000-05-08', 'hyderbad', 'harshith15@gmail.com', 'harshith15'),
('ABCTY1507E', 'suresh', 'nani', 'male', 'suresh98@gmail.com', '1993-01-02', 'warangal', 'suresh98@gmail.com', 'suresh98'),
('ABCTY1567E', 'Dhanush', 'Penugonda', 'male', 'dhanush.penugonda@gmail.com', '2022-01-05', 'Tenali', 'dhanush16@gmail.com', 'dhanush16'),
('ABCTY1983D', 'sampath', 'reddy', 'male', 'sampath615@gmail.com', '1996-06-07', 'hyderbad', 'sampath615@gmail.com', 'sampath615'),
('ABCTY1987E', 'Vishnu', 'Kumar', 'male', 'vishnu716@gmail.com', '2002-07-07', 'guntur', 'vishnu716@gmail.com', 'vishnu716'),
('ABCTY8986D', 'Vivek', 'Sai', 'male', 'vivek32@gmail.com', '2002-10-24', 'nellore', 'vivek32@gmail.com', 'vivek32');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `pay_id` varchar(10) NOT NULL,
  `reg_id` varchar(10) DEFAULT NULL,
  `pay_date` date DEFAULT NULL,
  `pay_status` varchar(10) DEFAULT NULL,
  `total_income` int(11) DEFAULT NULL,
  `loan_deductions` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`pay_id`, `reg_id`, `pay_date`, `pay_status`, `total_income`, `loan_deductions`) VALUES
('170456', 'ABCTY1567E', '2021-10-29', 'done', 90000, 3000),
('189166', 'ABCTY1567E', '2022-01-10', 'done', 750000, 25000),
('190101', 'ABCTY8986D', '2022-01-11', 'done', 1000000, 20000),
('330638', 'ABCTY1567E', '2022-01-10', 'fail', 1000000, 20000),
('427874', 'ABCTY1567E', '2022-01-10', 'done', 600000, 20000),
('570456', 'ABCTY8986D', '2021-11-30', 'done', 60000, 1500),
('665032', 'ABCTY1567E', '2022-01-10', 'fail', 600000, 4000),
('690346', 'ABCTY1567E', '2022-01-10', 'done', 600000, 0),
('932251', 'ABCTY1567E', '2022-01-10', 'fail', 1000000, 20000),
('970456', 'ABCTY1191S', '2021-12-22', 'fail', 40000, 1200),
('971868', 'ABCTY8986D', '2022-01-11', 'done', 900000, 3000);

-- --------------------------------------------------------

--
-- Table structure for table `phone`
--

CREATE TABLE `phone` (
  `reg_id` varchar(10) NOT NULL,
  `phone_no` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `phone`
--

INSERT INTO `phone` (`reg_id`, `phone_no`) VALUES
('ABCTY1191S', '9966775588'),
('ABCTY1234D', '9988776655'),
('ABCTY1567E', '8639057707'),
('ABCTY1567E', '8899778877'),
('ABCTY1987E', '9977112266'),
('ABCTY8986D', '8877332244');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` varchar(10) NOT NULL,
  `reg_id` varchar(10) DEFAULT NULL,
  `schedule_date` date DEFAULT NULL,
  `assign` varchar(10) DEFAULT NULL,
  `schedule_status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `reg_id`, `schedule_date`, `assign`, `schedule_status`) VALUES
('2021102901', 'ABCTY1567E', '2021-10-29', '130822', 'no'),
('2021112401', 'ABCTY1191S', '2021-11-24', '130822', 'yes'),
('2022122701', 'ABCTY8986D', '2022-12-27', '130822', 'no'),
('2107130820', 'ABCTY1234D', '2021-12-20', '130822', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acc_details`
--
ALTER TABLE `acc_details`
  ADD PRIMARY KEY (`acc_no`);

--
-- Indexes for table `acc_no`
--
ALTER TABLE `acc_no`
  ADD PRIMARY KEY (`reg_id`,`acc_no`),
  ADD KEY `acc_no` (`acc_no`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `card_details`
--
ALTER TABLE `card_details`
  ADD PRIMARY KEY (`card_no`);

--
-- Indexes for table `card_no`
--
ALTER TABLE `card_no`
  ADD PRIMARY KEY (`reg_id`,`card_no`),
  ADD KEY `card_no` (`card_no`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`reg_id`),
  ADD UNIQUE KEY `client_uid` (`client_uid`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`pay_id`),
  ADD KEY `reg_id` (`reg_id`);

--
-- Indexes for table `phone`
--
ALTER TABLE `phone`
  ADD PRIMARY KEY (`reg_id`,`phone_no`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `reg_id` (`reg_id`),
  ADD KEY `assign` (`assign`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `acc_no`
--
ALTER TABLE `acc_no`
  ADD CONSTRAINT `acc_no_ibfk_1` FOREIGN KEY (`reg_id`) REFERENCES `client` (`reg_id`),
  ADD CONSTRAINT `acc_no_ibfk_2` FOREIGN KEY (`acc_no`) REFERENCES `acc_details` (`acc_no`);

--
-- Constraints for table `card_no`
--
ALTER TABLE `card_no`
  ADD CONSTRAINT `card_no_ibfk_1` FOREIGN KEY (`reg_id`) REFERENCES `client` (`reg_id`),
  ADD CONSTRAINT `card_no_ibfk_2` FOREIGN KEY (`card_no`) REFERENCES `card_details` (`card_no`);

--
-- Constraints for table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`city`) REFERENCES `city` (`city`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`reg_id`) REFERENCES `client` (`reg_id`);

--
-- Constraints for table `phone`
--
ALTER TABLE `phone`
  ADD CONSTRAINT `phone_ibfk_1` FOREIGN KEY (`reg_id`) REFERENCES `client` (`reg_id`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`reg_id`) REFERENCES `client` (`reg_id`),
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`assign`) REFERENCES `admin` (`admin_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
