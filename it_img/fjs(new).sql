-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2022 at 10:13 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fjs`
--

-- --------------------------------------------------------

--
-- Table structure for table `buy`
--

CREATE TABLE `buy` (
  `buy_id` varchar(50) NOT NULL,
  `sup_id` varchar(50) DEFAULT NULL,
  `buy_date` date DEFAULT NULL,
  `buy_time` time DEFAULT NULL,
  `buy_qty` tinyint(4) DEFAULT NULL,
  `buy_money` float DEFAULT NULL,
  `buy_paid` varchar(1) DEFAULT 'N',
  `buy_recv` varchar(1) DEFAULT 'N',
  `key_date` date DEFAULT NULL,
  `key_time` time DEFAULT NULL,
  `key_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `buy`
--

INSERT INTO `buy` (`buy_id`, `sup_id`, `buy_date`, `buy_time`, `buy_qty`, `buy_money`, `buy_paid`, `buy_recv`, `key_date`, `key_time`, `key_id`) VALUES
('B21031201', 'S003', '2021-03-14', NULL, 23, 6400, 'N', 'Y', '2021-03-12', '14:47:36', 'user0'),
('B21031801', 'S001', '2021-03-18', NULL, 5, 1200, 'N', 'N', '2021-03-18', '12:26:10', 'user0'),
('B21031802', 'S002', '2021-03-16', NULL, 10, 3200, 'N', 'Y', '2021-03-19', '13:18:07', 'user0'),
('B21100701', 'S001', '2021-10-27', NULL, 2, 200, 'N', 'N', '2021-10-07', '21:10:37', 'user0'),
('B21100702', 'S002', '2021-10-07', NULL, 20, 4000, 'N', 'Y', '2021-10-07', '22:39:47', 'user0'),
('B21100703', 'S003', '2021-10-07', NULL, 10, 3000, 'N', 'Y', '2021-10-07', '22:40:33', 'user0'),
('B21120101', 'S001', '2021-12-01', NULL, 30, 18000, 'N', 'Y', '2021-12-01', '11:23:45', 'user0');

-- --------------------------------------------------------

--
-- Table structure for table `buy_item`
--

CREATE TABLE `buy_item` (
  `buy_id` varchar(50) NOT NULL,
  `item_id` varchar(50) NOT NULL,
  `price` float DEFAULT NULL,
  `qty` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `buy_item`
--

INSERT INTO `buy_item` (`buy_id`, `item_id`, `price`, `qty`) VALUES
('B21031201', 'it003', 200, 20),
('B21031201', 'it010', 800, 3),
('B21031801', 'it004', 300, 2),
('B21031801', 'it011', 200, 3),
('B21031802', 'it001', 200, 3),
('B21031802', 'it004', 400, 5),
('B21031802', 'it005', 300, 2),
('B21100701', 'it003', 100, 2),
('B21100702', 'it001', 200, 20),
('B21100703', 'it002', 300, 10),
('B21120101', 'it002', 800, 10),
('B21120101', 'it011', 500, 20);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` varchar(50) NOT NULL,
  `cus_id` varchar(50) DEFAULT NULL,
  `cart_date` date DEFAULT NULL,
  `cart_time` time DEFAULT NULL,
  `cart_qty` tinyint(4) DEFAULT NULL,
  `cart_money` float DEFAULT NULL,
  `cart_cf` varchar(1) DEFAULT 'N',
  `cart_paid` varchar(1) DEFAULT 'N',
  `cart_sent` varchar(1) DEFAULT 'N',
  `key_date` date DEFAULT NULL,
  `key_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `cus_id`, `cart_date`, `cart_time`, `cart_qty`, `cart_money`, `cart_cf`, `cart_paid`, `cart_sent`, `key_date`, `key_time`) VALUES
('202204152207561', 'Frank', '2022-04-15', '22:07:56', 1, 1100, 'N', 'N', 'N', '2022-04-15', '22:08:20'),
('202204170256001', 'Frank', '2022-04-17', '02:56:00', 1, 1990, 'N', 'N', 'N', '2022-04-17', '02:56:00');

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `cart_id` varchar(50) NOT NULL,
  `item_id` varchar(50) NOT NULL,
  `price` float DEFAULT NULL,
  `qty` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `cart_item`
--

INSERT INTO `cart_item` (`cart_id`, `item_id`, `price`, `qty`) VALUES
('202204152207561', 'it12', 1100, 1),
('202204170256001', 'it001', 1990, 1);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `item_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_price` float DEFAULT 0,
  `cur_stk` int(11) DEFAULT 0,
  `item_rem` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_img` varchar(3000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `item_price`, `cur_stk`, `item_rem`, `item_img`) VALUES
('it001', 'NIKE CHELSEA 2021/2022 HOME', 1990, 50, 'More Details: Slim fit for a tailored feel, 100% polyester, Machine wash, Imported', 'chelsea_1.png'),
('it002', 'NIKE CHELSEA 2021/2022 AWAY', 1990, 30, 'More Details: Slim fit for a tailored feel, 100% polyester, Machine wash, Imported', 'chelsea_2.png'),
('it003', 'ADDIDAS ARSENAL 2021/2022 HOME', 1990, 40, 'More Details: Slim fit for a tailored feel, 100% polyester, Machine wash, Imported', 'arsenal_1.jpg'),
('it004', 'ADDIDAS ARSENAL 2021/2022 AWAY', 1990, 30, 'More Details: Slim fit for a tailored feel, 100% polyester, Machine wash, Imported', 'arsenal_2.png'),
('it005', 'NIKE LIVERPOOL 2021/2022 HOME', 1990, 40, 'More Details: Slim fit for a tailored feel, 100% polyester, Machine wash, Imported', 'liverpool_1.jpg'),
('it007', 'NIKE LIVERPOOL 2021/2022 AWAY', 1990, 40, 'More Details: Slim fit for a tailored feel, 100% polyester, Machine wash, Imported', 'liverpool_2.png'),
('it008', 'ADIDAS MANCHESTER UNITED 2021/2022 HOME', 1990, 50, 'More Details: Slim fit for a tailored feel, 100% polyester, Machine wash, Imported', 'manu_1.png'),
('it009', 'ADIDAS MANCHESTER UNITED 2021/2022 AWAY', 1990, 50, 'More Details: Slim fit for a tailored feel, 100% polyester, Machine wash, Imported', 'manu_2.png'),
('it010', 'ADIDAS MANCHESTER CITY 2021/2022 HOME', 1990, 50, 'More Details: Slim fit for a tailored feel, 100% polyester, Machine wash, Imported', 'mancity_1.png'),
('it011', 'ADIDAS MANCHESTER CITY 2021/2022 AWAY', 1990, 35, 'More Details: Slim fit for a tailored feel, 100% polyester, Machine wash, Imported', 'mancity_2.png'),
('it012', 'NIKE SPUR 2021/2022 HOME', 1990, 25, 'More Details: Slim fit for a tailored feel, 100% polyester, Machine wash, Imported\r\n', 'spur_1.jpg'),
('it013', 'NIKE SPUR 2021/2022 AWAY', 1990, 30, 'More Details: Slim fit for a tailored feel, 100% polyester, Machine wash, Imported', 'spur_2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sup`
--

CREATE TABLE `sup` (
  `sup_id` varchar(50) DEFAULT NULL,
  `sup_name` varchar(50) DEFAULT NULL,
  `sup_contact` varchar(100) DEFAULT NULL,
  `sup_add` text DEFAULT NULL,
  `sup_tel` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sup`
--

INSERT INTO `sup` (`sup_id`, `sup_name`, `sup_contact`, `sup_add`, `sup_tel`) VALUES
('S001', 'ร้านทดสอบ1', 'คุณสมชาย', '123 บางยี่ขัน บางพลัด กรุงเทพฯ 10700', '02-123456 , 02-2223333'),
('S002', 'บจก.ทดสอบ2', 'คุณสมหมาย', '222 บางละมุง ชลบุรี 21112', ''),
('S003', 'หจก.ทดสอบ3', 'คุณสมหญิง', '333 ศรีราชา ชลบุรี', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` text NOT NULL,
  `u_name` text NOT NULL,
  `u_pwd` text NOT NULL,
  `u_level` text NOT NULL,
  `u_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `u_name`, `u_pwd`, `u_level`, `u_desc`) VALUES
('dev', 'dev', '1234', 'admin', 'dev'),
('Frank', 'ชิโนภาส เมืองไทย', '1234', 'user', 'ผู้ใช้');

-- --------------------------------------------------------

--
-- Table structure for table `user_date_login_user`
--

CREATE TABLE `user_date_login_user` (
  `user_id_login` int(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `date_time_login` datetime NOT NULL,
  `date_time_logout` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_date_login_user`
--

INSERT INTO `user_date_login_user` (`user_id_login`, `user_id`, `date_time_login`, `date_time_logout`) VALUES
(8, 'dev', '2022-04-17 02:12:20', '2022-04-17 02:55:36'),
(9, 'dev', '2022-04-17 02:20:53', '2022-04-17 02:55:36'),
(10, 'dev', '2022-04-17 02:41:56', '2022-04-17 02:55:36'),
(11, 'dev', '2022-04-17 02:55:02', '2022-04-17 02:55:36'),
(12, 'Frank', '2022-04-17 02:55:55', '2022-04-17 02:58:01'),
(13, 'dev', '2022-04-17 02:58:07', '2022-04-17 02:58:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buy`
--
ALTER TABLE `buy`
  ADD PRIMARY KEY (`buy_id`) USING BTREE;

--
-- Indexes for table `buy_item`
--
ALTER TABLE `buy_item`
  ADD PRIMARY KEY (`buy_id`,`item_id`) USING BTREE;

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`) USING BTREE;

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`cart_id`,`item_id`) USING BTREE;

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`) USING BTREE;

--
-- Indexes for table `user_date_login_user`
--
ALTER TABLE `user_date_login_user`
  ADD PRIMARY KEY (`user_id_login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_date_login_user`
--
ALTER TABLE `user_date_login_user`
  MODIFY `user_id_login` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
