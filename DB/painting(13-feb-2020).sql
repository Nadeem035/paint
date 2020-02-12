-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2020 at 09:30 PM
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
  `at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `profit` int(11) NOT NULL,
  `pending_amount` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `affiliate`
--

INSERT INTO `affiliate` (`affiliate_id`, `name`, `phone`, `email`, `country`, `city`, `address`, `password`, `paypal_account`, `status`, `link`, `at`, `profit`, `pending_amount`) VALUES
(1, 'Aftab Khan', '0312456789', 'a@mail.com', 'india', 'multan', 'Gulberg 3 Lahore Pakistan', '4ba674d85fbee92042e7d76e61145904', '1234441221', 'active', '', '2020-02-03 08:36:17', 10, 7),
(2, 'aftab', '01231451', 'mail@mail.com', 'pakistan', 'lahore', 'Lahore pakistan', '4ba674d85fbee92042e7d76e61145904', '11002200114', 'active', '', '2020-02-05 08:36:17', 10, 500),
(15, 'asda', '03034712706', 'ali@khan.com', 'pakistan', 'lahore', 'fasdfsdafsdaf', '4ba674d85fbee92042e7d76e61145904', '54123541', 'active', '4ba674d85fbee92042e7d76e6114590415', '2020-02-05 08:36:17', 10, 1200);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `slug` varchar(40) NOT NULL,
  `at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `icon` varchar(40) NOT NULL,
  `detail` text NOT NULL,
  `img` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`, `slug`, `at`, `icon`, `detail`, `img`) VALUES
(1, 'Home improvement', 'home_improvement', '2020-02-05 08:36:01', 'c479f0de6881b1d13aeb2876a5fb0e65.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum culpa tempore, quis vitae. Deserunt numquam distinctio esse non quod dolorem excepturi tempore error perferendis adipisci, aspernatur dolores suscipit ipsam, maiores! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum culpa tempore, quis vitae. Deserunt numquam distinctio esse non quod dolorem excepturi tempore error perferendis adipisci, aspernatur dolores suscipit ipsam, maiores! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum culpa tempore, quis vitae. Deserunt numquam distinctio esse non quod dolorem excepturi tempore error perferendis adipisci, aspernatur dolores suscipit ipsam, maiores!', 'adbcf5e0689a08b0a9d6b439925da4ee.jpg'),
(2, 'renovation', 'renovation', '2020-02-05 08:36:01', '51c5b0591a00e215fcef09fba20022e0.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum culpa tempore, quis vitae. Deserunt numquam distinctio esse non quod dolorem excepturi tempore error perferendis adipisci, aspernatur dolores suscipit ipsam, maiores!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum culpa tempore, quis vitae. Deserunt numquam distinctio esse non quod dolorem excepturi tempore error perferendis adipisci, aspernatur dolores suscipit ipsam, maiores!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum culpa tempore, quis vitae. Deserunt numquam distinctio esse non quod dolorem excepturi tempore error perferendis adipisci, aspernatur dolores suscipit ipsam, maiores!', 'c85158014e5a74eddcfc4b65e01bf71f.jpg'),
(3, 'Painting', 'painting', '2020-02-07 10:20:43', '4f23d4b2d50d2b28ce9749e9bf2d5180.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum culpa tempore, quis vitae. Deserunt numquam distinctio esse non quod dolorem excepturi tempore error perferendis adipisci, aspernatur dolores suscipit ipsam, maiores!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum culpa tempore, quis vitae. Deserunt numquam distinctio esse non quod dolorem excepturi tempore error perferendis adipisci, aspernatur dolores suscipit ipsam, maiores!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum culpa tempore, quis vitae. Deserunt numquam distinctio esse non quod dolorem excepturi tempore error perferendis adipisci, aspernatur dolores suscipit ipsam, maiores!', '8a9890e8eac92012aaf05f193e74a19a.jpg'),
(4, 'Garage doors', 'garage_doors', '2020-02-07 10:20:51', '2e04fa2e320f6651e88db9aa466be138.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum culpa tempore, quis vitae. Deserunt numquam distinctio esse non quod dolorem excepturi tempore error perferendis adipisci, aspernatur dolores suscipit ipsam, maiores!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum culpa tempore, quis vitae. Deserunt numquam distinctio esse non quod dolorem excepturi tempore error perferendis adipisci, aspernatur dolores suscipit ipsam, maiores!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum culpa tempore, quis vitae. Deserunt numquam distinctio esse non quod dolorem excepturi tempore error perferendis adipisci, aspernatur dolores suscipit ipsam, maiores!', 'f0eca5356cfd707bc742690fbeb2630f.jpg'),
(5, 'Locksmith', 'locksmith', '2020-02-07 10:20:59', 'ba5c234b69352735cab2bf45fff51172.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum culpa tempore, quis vitae. Deserunt numquam distinctio esse non quod dolorem excepturi tempore error perferendis adipisci, aspernatur dolores suscipit ipsam, maiores!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum culpa tempore, quis vitae. Deserunt numquam distinctio esse non quod dolorem excepturi tempore error perferendis adipisci, aspernatur dolores suscipit ipsam, maiores!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum culpa tempore, quis vitae. Deserunt numquam distinctio esse non quod dolorem excepturi tempore error perferendis adipisci, aspernatur dolores suscipit ipsam, maiores!', '6411d1e7bbff2c8dfa9d98102135786d.jpg');

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
(4, 'Working', '012546', 'pakistan', '2,1', 1, 2, 0, '', 'valid', '2020-02-05 08:45:25'),
(5, 'Nothing', '321134', 'pakistan', '1,2', 1, 2, 0, '', 'valid', '2020-02-05 08:45:25'),
(6, 'Work', '65465', 'pakistan', '2', 1, 3, 0, '', 'valid', '2020-02-05 08:45:25'),
(7, 'Aftab Ali', '03034712706', 'pakistan', '2,1', 15, 2, 0, '', 'valid', '2020-02-05 08:45:25'),
(8, 'Nadeem Akram', '03034712706', 'pakistan', '2,1', 0, 1, 0, '', 'valid', '2020-02-05 08:45:25'),
(9, 'Working', '03034712706', 'pakistan', '5,4,3', 15, 3, 0, '', 'valid', '2020-02-10 06:54:55');

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
(1, 'Nadeem Akram', '03034712706', 'ali@khan.com', '202cb962ac59075b964b07152d234b70', 'pakistan', 'multan', 'Gulberg 3 Lahore pakistan', '1,2', 2, 'active', '2020-02-05 08:43:39'),
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
(9, 1, 8, 'successful', 'Thank you  so much ', '2020-02-05 08:35:11'),
(10, 6, 9, 'pending', '', '2020-02-11 19:35:36'),
(11, 4, 9, 'pending', '', '2020-02-11 19:35:36'),
(12, 2, 9, 'pending', '', '2020-02-11 19:35:36'),
(13, 1, 9, 'successful', '', '2020-02-11 19:35:36'),
(14, 6, 9, 'pending', '', '2020-02-11 19:36:23'),
(15, 4, 9, 'pending', '', '2020-02-11 19:36:23'),
(16, 2, 9, 'pending', '', '2020-02-11 19:36:23'),
(17, 1, 9, 'pending', '', '2020-02-11 19:36:23'),
(18, 6, 9, 'pending', '', '2020-02-11 19:36:29'),
(19, 4, 9, 'pending', '', '2020-02-11 19:36:29'),
(20, 2, 9, 'pending', '', '2020-02-11 19:36:29'),
(21, 1, 9, 'pending', '', '2020-02-11 19:36:29');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `setting_id` int(11) NOT NULL,
  `profit` int(11) NOT NULL,
  `at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`setting_id`, `profit`, `at`) VALUES
(1, 10, '2020-02-11 18:57:53');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `slider_id` int(11) NOT NULL,
  `img` varchar(40) NOT NULL,
  `link` varchar(255) NOT NULL DEFAULT 'javascript://',
  `status` enum('1','0') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`slider_id`, `img`, `link`, `status`) VALUES
(1, 'ab911b6a0474aa6bb7bd7b9c074a5711.jpg', 'javascript://', '1'),
(3, 'db69bc196a8ece1feca495fa105145fd.jpg', 'javascript://', '1');

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
  `payment_method` enum('paypal') NOT NULL,
  `account_info` varchar(50) NOT NULL,
  `affiliate_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `amount`, `at`, `status`, `painter_id`, `payment_method`, `account_info`, `affiliate_id`) VALUES
(1, 2000, '2020-02-09 19:15:08', 'credit', 1, 'paypal', '4151525', 0),
(2, 3000, '2020-02-09 19:15:49', 'credit', 1, 'paypal', '235236', 0),
(3, 233, '2020-02-10 08:48:55', 'debit', 0, 'paypal', '', 1),
(4, 60, '2020-02-10 12:21:06', 'debit', 0, 'paypal', '1234441221', 1),
(5, 2000, '2020-02-10 12:22:36', 'debit', 0, 'paypal', '11002200114', 2),
(6, 2000, '2020-02-11 19:37:16', 'debit', 0, 'paypal', '54123541', 15);

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
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slider_id`);

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
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `lead`
--
ALTER TABLE `lead`
  MODIFY `lead_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
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
  MODIFY `painter_lead_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `worker`
--
ALTER TABLE `worker`
  MODIFY `worker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
