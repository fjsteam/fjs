-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2022 at 09:58 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

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
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_ID` int(11) NOT NULL,
  `item_name` varchar(200) NOT NULL,
  `item_type` varchar(50) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `item_price` double NOT NULL,
  `item_desc` varchar(1000) NOT NULL,
  `item_img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `item_date_list_buy`
--

CREATE TABLE `item_date_list_buy` (
  `ITEM_LISTSALE_ID` int(11) NOT NULL,
  `ITEM_ID` int(11) NOT NULL,
  `DATE_TIME` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `item_date_list_sale`
--

CREATE TABLE `item_date_list_sale` (
  `ITEM_LISTBUY_ID` int(11) NOT NULL,
  `ITEM_ID` int(11) NOT NULL,
  `DATE_TIME` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `u_pwd` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `u_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `u_level` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `u_desc` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `u_phone` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `u_email` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `u_pwd`, `u_name`, `u_level`, `u_desc`, `u_phone`, `u_email`) VALUES
('dev', '1234', 'ชิโนภาส เมืองไทย', 'Admin', 'ต.บางพูด อ.ปากเกร็ด จ.นนทบุรี', '0886244920', 'Chinopas.m@ku.th');

-- --------------------------------------------------------

--
-- Table structure for table `use_date_login_user`
--

CREATE TABLE `use_date_login_user` (
  `USER_ID_LOGIN` int(11) NOT NULL,
  `USER_ID` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `DATE_TIME` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_ID`);

--
-- Indexes for table `item_date_list_buy`
--
ALTER TABLE `item_date_list_buy`
  ADD PRIMARY KEY (`ITEM_LISTSALE_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `use_date_login_user`
--
ALTER TABLE `use_date_login_user`
  ADD PRIMARY KEY (`USER_ID_LOGIN`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
