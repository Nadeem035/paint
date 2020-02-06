-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2020 at 07:32 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `painting`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', '4ba674d85fbee92042e7d76e61145904');

-- --------------------------------------------------------

--
-- Table structure for table `affiliate`
--

CREATE TABLE `affiliate` (
  `affiliate_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `country` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(40) NOT NULL,
  `paypal_account` varchar(40) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `link` varchar(255) NOT NULL,
  `at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `affiliate`
--

INSERT INTO `affiliate` (`affiliate_id`, `name`, `phone`, `email`, `country`, `city`, `address`, `password`, `paypal_account`, `status`, `link`, `at`) VALUES
(1, 'Aftab Khan', '0312456789', 'a@mail.com', 'india', 'multan', 'Gulberg 3 Lahore Pakistan', '4ba674d85fbee92042e7d76e61145904', '1234441221', 'active', '', '2020-02-03 08:36:17'),
(2, 'aftab', '01231451', 'mail@mail.com', 'pakistan', 'lahore', 'Lahore pakistan', '4ba674d85fbee92042e7d76e61145904', '11002200114', 'active', '', '2020-02-05 08:36:17'),
(15, 'asda', '03034712706', 'ali@khan.com', 'pakistan', 'lahore', 'fasdfsdafsdaf', '4ba674d85fbee92042e7d76e61145904', '54123541', 'active', '4ba674d85fbee92042e7d76e6114590415/asda/a00e2b9fc8ac1e87112b6d00b0958393', '2020-02-05 08:36:17');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`, `at`) VALUES
(1, 'Wall Painting ', '2020-02-05 08:36:01'),
(2, 'House Hold', '2020-02-05 08:36:01');

-- --------------------------------------------------------

--
-- Table structure for table `lead`
--

CREATE TABLE `lead` (
  `lead_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `services` varchar(20) NOT NULL,
  `affiliate_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `clicks` int(11) NOT NULL,
  `invalid_reason` varchar(255) NOT NULL,
  `status` enum('new','valid','invalid') NOT NULL DEFAULT 'new',
  `at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lead`
--

INSERT INTO `lead` (`lead_id`, `name`, `phone`, `country`, `services`, `affiliate_id`, `package_id`, `clicks`, `invalid_reason`, `status`, `at`) VALUES
(4, 'Working', '012546', 'pakistan', '2,1', 0, 2, 0, '', 'valid', '2020-02-05 08:45:25'),
(5, 'Nothing', '321134', 'pakistan', '1,2', 0, 2, 0, '', 'valid', '2020-02-05 08:45:25'),
(6, 'Work', '65465', 'pakistan', '2', 0, 3, 0, '', 'valid', '2020-02-05 08:45:25'),
(7, 'Aftab Ali', '03034712706', 'pakistan', '2,1', 15, 2, 0, '', 'valid', '2020-02-05 08:45:25'),
(8, 'Nadeem Akram', '03034712706', 'pakistan', '2,1', 0, 1, 0, '', 'valid', '2020-02-05 08:45:25');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `package_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `detail` text NOT NULL,
  `price` varchar(10) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`package_id`, `name`, `detail`, `price`, `status`, `at`) VALUES
(1, 'tier 1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam ea sequi veniam incidunt qui fugit enim perspiciatis dolore ducimus, nulla. Illo impedit iure atque, praesentium, dignissimos quas veritatis est unde.', '1500', 'active', '2020-02-05 08:44:53'),
(2, 'tier 2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam ea sequi veniam incidunt qui fugit enim perspiciatis dolore ducimus, nulla. Illo impedit iure atque, praesentium, dignissimos quas veritatis est unde.', '3000', 'active', '2020-02-05 08:44:53'),
(3, 'tier 3', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam ea sequi veniam incidunt qui fugit enim perspiciatis dolore ducimus, nulla. Illo impedit iure atque, praesentium, dignissimos quas veritatis est unde.', '5000', 'active', '2020-02-05 08:44:53');

-- --------------------------------------------------------

--
-- Table structure for table `painter`
--

CREATE TABLE `painter` (
  `painter_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `country` varchar(20) NOT NULL,
  `city` varchar(40) NOT NULL,
  `address` text NOT NULL,
  `services` varchar(30) NOT NULL,
  `package_id` int(11) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `painter`
--

INSERT INTO `painter` (`painter_id`, `name`, `phone`, `email`, `password`, `country`, `city`, `address`, `services`, `package_id`, `status`, `at`) VALUES
(1, 'Nadeem Akram', '03034712706', 'ali@khan.com', '202cb962ac59075b964b07152d234b70', 'pakistan', 'multan', 'Gulberg 3 Lahore pakistan', '1,2', 1, 'active', '2020-02-05 08:43:39'),
(2, 'Ali', '012345678', 'abc@mail.com', '4ba674d85fbee92042e7d76e61145904', 'pakistan', 'lahore', 'Kahna lahore Pakistan', '2,1', 2, 'active', '2020-02-05 08:43:39'),
(3, 'Aftab', '0123456789', 'a@abc.com', '4ba674d85fbee92042e7d76e61145904', 'pakistan', 'lahore', 'Lahore Pakistan', '2,1', 1, 'active', '2020-02-05 08:43:39'),
(4, 'Aftab', '0123456789', 'ab@domain.com', '4ba674d85fbee92042e7d76e61145904', 'pakistan', 'lahore', 'Lahore Pakistan', '2,1', 2, 'active', '2020-02-05 08:43:39'),
(5, 'khan', '0123456789', 'z@abc.com', '4ba674d85fbee92042e7d76e61145904', 'pakistan', 'lahore', 'Lahore Pakistan', '2,1', 1, 'active', '2020-02-05 08:43:39'),
(6, 'baba g', '0123456789', 'baba@abc.com', '4ba674d85fbee92042e7d76e61145904', 'pakistan', 'lahore', 'Lahore Pakistan', '2,1', 2, 'active', '2020-02-05 08:43:39');

-- --------------------------------------------------------

--
-- Table structure for table `painter_lead`
--

CREATE TABLE `painter_lead` (
  `painter_lead_id` int(11) NOT NULL,
  `painter_id` int(11) NOT NULL,
  `lead_id` int(11) NOT NULL,
  `status` enum('successful','reject','pending') NOT NULL DEFAULT 'pending',
  `note` text NOT NULL,
  `at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `painter_lead`
--

INSERT INTO `painter_lead` (`painter_lead_id`, `painter_id`, `lead_id`, `status`, `note`, `at`) VALUES
(1, 6, 5, 'successful', '', '2020-02-05 08:35:11'),
(2, 4, 5, 'pending', '', '2020-02-05 08:35:11'),
(3, 1, 5, 'reject', 'ki paain yakki ae', '2020-02-05 08:35:11'),
(4, 6, 7, 'pending', '', '2020-02-05 08:35:11'),
(5, 4, 7, 'pending', '', '2020-02-05 08:35:11'),
(6, 2, 7, 'pending', '', '2020-02-05 08:35:11'),
(7, 5, 8, 'pending', '', '2020-02-05 08:35:11'),
(8, 3, 8, 'pending', '', '2020-02-05 08:35:11'),
(9, 1, 8, 'successful', 'Thank you  so much ', '2020-02-05 08:35:11');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('credit','debit') NOT NULL,
  `painter_id` int(11) NOT NULL,
  `payment_method` enum('paypal') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `worker`
--

CREATE TABLE `worker` (
  `worker_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `country` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(40) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `worker`
--

INSERT INTO `worker` (`worker_id`, `name`, `phone`, `email`, `country`, `city`, `address`, `password`, `status`, `at`) VALUES
(1, 'Nadeem Arkam', '03034712706', 'nakram035@gmail.com', 'pakistan', 'lahore', 'Gulberg 3 Lahore Pakistan ', '25d55ad283aa400af464c76d713c07ad', 'active', '2020-02-05 08:34:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `affiliate`
--
ALTER TABLE `affiliate`
  ADD PRIMARY KEY (`affiliate_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `lead`
--
ALTER TABLE `lead`
  ADD PRIMARY KEY (`lead_id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `painter`
--
ALTER TABLE `painter`
  ADD PRIMARY KEY (`painter_id`);

--
-- Indexes for table `painter_lead`
--
ALTER TABLE `painter_lead`
  ADD PRIMARY KEY (`painter_lead_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`worker_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `affiliate`
--
ALTER TABLE `affiliate`
  MODIFY `affiliate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `lead`
--
ALTER TABLE `lead`
  MODIFY `lead_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `painter`
--
ALTER TABLE `painter`
  MODIFY `painter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `painter_lead`
--
ALTER TABLE `painter_lead`
  MODIFY `painter_lead_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `worker`
--
ALTER TABLE `worker`
  MODIFY `worker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
