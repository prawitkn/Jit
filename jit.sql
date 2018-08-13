-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2018 at 01:34 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jit`
--

-- --------------------------------------------------------

--
-- Table structure for table `cr_user`
--

CREATE TABLE `cr_user` (
  `userId` int(11) NOT NULL,
  `userName` varchar(50) DEFAULT NULL,
  `userPassword` varchar(250) DEFAULT NULL,
  `userPin` varchar(250) NOT NULL,
  `userFullname` varchar(200) DEFAULT NULL,
  `userGroupCode` varchar(20) NOT NULL,
  `userDeptCode` varchar(10) NOT NULL,
  `userEmail` varchar(100) DEFAULT NULL,
  `userTel` varchar(100) DEFAULT NULL,
  `userPicture` varchar(250) DEFAULT NULL,
  `statusCode` char(1) DEFAULT NULL,
  `loginStatus` int(11) NOT NULL DEFAULT '0',
  `lastLoginTime` datetime NOT NULL,
  `SID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_user`
--

INSERT INTO `cr_user` (`userId`, `userName`, `userPassword`, `userPin`, `userFullname`, `userGroupCode`, `userDeptCode`, `userEmail`, `userTel`, `userPicture`, `statusCode`, `loginStatus`, `lastLoginTime`, `SID`) VALUES
(1, 'admin', 'f9c6c2e7d2dd5c8773d97faaa399692d', '43366a8c6902767fc2157b7def389f5e60f8b7ba1c36e546ce2c3beabca85ae9', 'Administrator', 'admin', '', 'admin@gmail.com', 'admin', 'user_admin.jpg', 'A', 1, '2018-08-13 15:36:22', '');

-- --------------------------------------------------------

--
-- Table structure for table `cr_user_group`
--

CREATE TABLE `cr_user_group` (
  `Id` int(11) NOT NULL,
  `Code` varchar(20) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `StatusId` int(11) NOT NULL,
  `CreateTime` datetime NOT NULL,
  `CreateUserId` int(11) NOT NULL,
  `UpdateTime` datetime NOT NULL,
  `UpdateUserId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_user_group`
--

INSERT INTO `cr_user_group` (`Id`, `Code`, `Name`, `StatusId`, `CreateTime`, `CreateUserId`, `UpdateTime`, `UpdateUserId`) VALUES
(1, 'admin', 'admin', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(2, 'guest', 'Guest', 2, '2018-08-01 15:24:03', 1, '2018-08-01 15:54:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jit_data`
--

CREATE TABLE `jit_data` (
  `Id` int(11) NOT NULL,
  `GroupId` int(11) NOT NULL,
  `Qty` int(11) NOT NULL,
  `QtyCheckIn` int(11) NOT NULL,
  `QueueTime` datetime NOT NULL,
  `Remark` varchar(100) NOT NULL,
  `CreateTime` datetime NOT NULL,
  `CreateUserId` int(11) NOT NULL,
  `CheckInTime` datetime DEFAULT NULL,
  `CheckInUserId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jit_data`
--

INSERT INTO `jit_data` (`Id`, `GroupId`, `Qty`, `QtyCheckIn`, `QueueTime`, `Remark`, `CreateTime`, `CreateUserId`, `CheckInTime`, `CheckInUserId`) VALUES
(1, 101, 20, 0, '0000-00-00 00:00:00', '', '2018-08-10 15:19:31', 1, '2018-08-13 10:21:05', 1),
(2, 101, 30, 0, '0000-00-00 00:00:00', '', '2018-08-10 15:20:31', 1, NULL, 0),
(3, 101, 200, 0, '0000-00-00 00:00:00', '', '2018-08-10 15:37:12', 1, '2018-08-13 11:53:27', 1),
(4, 101, 55, 0, '0000-00-00 00:00:00', '', '2018-08-10 15:38:47', 1, NULL, 0),
(5, 101, 22, 0, '0000-00-00 00:00:00', '', '2018-08-10 15:41:29', 1, NULL, 0),
(6, 101, 66, 0, '0000-00-00 00:00:00', '', '2018-08-10 15:42:25', 1, NULL, 0),
(7, 101, 33, 0, '0000-00-00 00:00:00', '', '2018-08-10 15:42:50', 1, NULL, 0),
(8, 101, 33, 0, '0000-00-00 00:00:00', '', '2018-08-10 15:43:12', 1, NULL, 0),
(9, 101, 6, 0, '0000-00-00 00:00:00', '', '2018-08-10 15:44:36', 1, NULL, 0),
(10, 101, 6, 0, '0000-00-00 00:00:00', '', '2018-08-10 15:46:37', 1, NULL, 0),
(11, 101, 66, 0, '0000-00-00 00:00:00', '', '2018-08-10 15:47:15', 1, NULL, 0),
(12, 101, 66, 0, '0000-00-00 00:00:00', '', '2018-08-10 15:47:16', 1, NULL, 0),
(13, 101, 66, 0, '0000-00-00 00:00:00', '', '2018-08-10 15:47:40', 1, NULL, 0),
(14, 101, 55, 0, '0000-00-00 00:00:00', '', '2018-08-10 15:50:41', 1, NULL, 0),
(15, 101, 77, 0, '0000-00-00 00:00:00', '', '2018-08-10 15:51:20', 1, NULL, 0),
(16, 101, 99, 0, '0000-00-00 00:00:00', '', '2018-08-10 15:51:24', 1, NULL, 0),
(17, 101, 8, 0, '0000-00-00 00:00:00', '', '2018-08-10 15:52:55', 1, NULL, 0),
(18, 101, 8, 0, '0000-00-00 00:00:00', '', '2018-08-10 15:52:58', 1, NULL, 0),
(19, 101, 11, 0, '0000-00-00 00:00:00', '', '2018-08-10 15:53:06', 1, NULL, 0),
(20, 101, 11, 0, '0000-00-00 00:00:00', '', '2018-08-10 15:53:09', 1, NULL, 0),
(21, 101, 99, 0, '0000-00-00 00:00:00', '', '2018-08-10 15:54:29', 1, NULL, 0),
(22, 101, 20, 0, '0000-00-00 00:00:00', '', '2018-08-10 15:58:16', 1, NULL, 0),
(23, 101, 10, 0, '0000-00-00 00:00:00', '', '2018-08-10 22:28:21', 1, NULL, 0),
(24, 101, 10, 0, '0000-00-00 00:00:00', '', '2018-08-10 22:28:23', 1, NULL, 0),
(25, 102, 300, 0, '0000-00-00 00:00:00', '', '2018-08-10 22:40:25', 1, NULL, 0),
(26, 102, 23, 0, '0000-00-00 00:00:00', '', '2018-08-10 22:40:31', 1, NULL, 0),
(27, 102, 230, 0, '0000-00-00 00:00:00', '', '2018-08-10 22:40:35', 1, NULL, 0),
(28, 102, 90, 0, '0000-00-00 00:00:00', '90', '2018-08-10 22:49:17', 1, NULL, 0),
(29, 102, 10, 0, '0000-00-00 00:00:00', '10', '2018-08-10 22:50:46', 1, NULL, 0),
(30, 102, 10, 0, '0000-00-00 00:00:00', '10', '2018-08-10 22:50:49', 1, NULL, 0),
(31, 102, 10, 0, '0000-00-00 00:00:00', '0898908', '2018-08-12 19:41:44', 1, NULL, 0),
(32, 102, 10, 0, '0000-00-00 00:00:00', '0898908', '2018-08-12 19:41:45', 1, NULL, 0),
(33, 102, 10, 0, '0000-00-00 00:00:00', '0898908', '2018-08-12 19:41:45', 1, NULL, 0),
(34, 102, 10, 0, '0000-00-00 00:00:00', '0898908', '2018-08-12 19:41:45', 1, NULL, 0),
(35, 102, 2, 0, '0000-00-00 00:00:00', '0898908', '2018-08-12 19:41:53', 1, NULL, 0),
(36, 102, 2, 0, '0000-00-00 00:00:00', '0898908', '2018-08-12 19:42:01', 1, NULL, 0),
(37, 102, 2, 0, '0000-00-00 00:00:00', '0898908', '2018-08-12 19:42:48', 1, NULL, 0),
(38, 102, 10, 0, '0000-00-00 00:00:00', '10', '2018-08-12 19:47:35', 1, NULL, 0),
(41, 102, 200, 0, '0000-00-00 00:00:00', '20', '2018-08-12 20:00:52', 1, NULL, 0),
(42, 102, 10, 0, '0000-00-00 00:00:00', '10', '2018-08-12 20:05:15', 1, NULL, 0),
(43, 102, 22, 0, '0000-00-00 00:00:00', '10', '2018-08-12 20:06:45', 1, NULL, 0),
(44, 101, 11, 0, '0000-00-00 00:00:00', '11', '2018-08-12 20:09:50', 1, NULL, 0),
(45, 101, 1, 0, '0000-00-00 00:00:00', '000', '2018-08-12 20:11:06', 1, NULL, 0),
(46, 101, 1, 0, '0000-00-00 00:00:00', '1', '2018-08-12 20:44:50', 1, NULL, 0),
(47, 102, 2, 0, '0000-00-00 00:00:00', '222', '2018-08-12 20:46:55', 1, NULL, 0),
(48, 102, 1, 0, '0000-00-00 00:00:00', '1', '2018-08-13 10:37:10', 1, NULL, NULL),
(49, 102, 2, 0, '0000-00-00 00:00:00', '1', '2018-08-13 10:37:16', 1, NULL, NULL),
(50, 102, 3, 0, '0000-00-00 00:00:00', '1', '2018-08-13 10:37:23', 1, NULL, NULL),
(51, 102, 4, 0, '0000-00-00 00:00:00', '1', '2018-08-13 10:37:31', 1, NULL, NULL),
(52, 102, 3, 0, '0000-00-00 00:00:00', '2', '2018-08-13 10:37:51', 1, NULL, NULL),
(53, 102, 10, 0, '0000-00-00 00:00:00', '9999', '2018-08-13 10:38:21', 1, NULL, NULL),
(54, 102, 20, 0, '0000-00-00 00:00:00', '8888', '2018-08-13 10:38:26', 1, NULL, NULL),
(55, 102, 9, 0, '0000-00-00 00:00:00', '999', '2018-08-13 10:38:31', 1, NULL, NULL),
(56, 102, 11, 0, '0000-00-00 00:00:00', '999', '2018-08-13 10:38:41', 1, NULL, NULL),
(57, 102, 2, 0, '0000-00-00 00:00:00', '999', '2018-08-13 10:38:51', 1, NULL, NULL),
(58, 102, 1, 0, '0000-00-00 00:00:00', '999', '2018-08-13 10:39:48', 1, NULL, NULL),
(59, 101, 1, 0, '0000-00-00 00:00:00', '000', '2018-08-13 10:46:08', 1, NULL, NULL),
(60, 101, 1, 0, '0000-00-00 00:00:00', '000', '2018-08-13 10:46:10', 1, NULL, NULL),
(62, 101, 3, 0, '0000-00-00 00:00:00', '999', '2018-08-13 10:48:16', 1, NULL, NULL),
(63, 101, 7, 0, '0000-00-00 00:00:00', '999', '2018-08-13 10:48:29', 1, NULL, NULL),
(64, 101, 90, 0, '0000-00-00 00:00:00', '999', '2018-08-13 10:48:41', 1, NULL, NULL),
(67, 102, 2, 0, '0000-00-00 00:00:00', '2', '2018-08-13 10:54:49', 1, NULL, NULL),
(70, 102, 10, 0, '0000-00-00 00:00:00', '1', '2018-08-13 11:04:25', 1, NULL, NULL),
(71, 102, 10, 0, '0000-00-00 00:00:00', '1099', '2018-08-13 12:14:10', 1, NULL, NULL),
(72, 102, 1, 0, '0000-00-00 00:00:00', '1uu', '2018-08-13 12:14:38', 1, NULL, NULL),
(73, 102, 2, 0, '0000-00-00 00:00:00', 'jkl', '2018-08-13 12:18:50', 1, NULL, NULL),
(74, 102, 1, 0, '0000-00-00 00:00:00', 'jkl', '2018-08-13 12:19:33', 1, NULL, NULL),
(75, 102, 2, 0, '0000-00-00 00:00:00', '2', '2018-08-13 12:21:46', 1, NULL, NULL),
(76, 102, 1, 0, '0000-00-00 00:00:00', 'jkl', '2018-08-13 12:24:39', 1, NULL, NULL),
(77, 102, 1, 0, '0000-00-00 00:00:00', 'kjfds', '2018-08-13 12:25:23', 1, NULL, NULL),
(78, 102, 1, 0, '0000-00-00 00:00:00', 'kjfds', '2018-08-13 12:26:07', 1, NULL, NULL),
(79, 102, 1, 0, '0000-00-00 00:00:00', '1', '2018-08-13 12:27:29', 1, NULL, NULL),
(80, 102, 19, 0, '0000-00-00 00:00:00', '1', '2018-08-13 12:27:48', 1, NULL, NULL),
(81, 101, 19, 0, '0000-00-00 00:00:00', '19', '2018-08-13 12:28:23', 1, NULL, NULL),
(82, 102, 1, 0, '0000-00-00 00:00:00', 'jfkdls', '2018-08-13 12:31:56', 1, NULL, NULL),
(83, 101, 2, 0, '0000-00-00 00:00:00', 'jkl', '2018-08-13 12:32:53', 1, NULL, NULL),
(86, 102, 1, 0, '0000-00-00 00:00:00', 'jkl', '2018-08-13 13:45:16', 1, NULL, NULL),
(87, 102, 9, 0, '0000-00-00 00:00:00', 'fjkdsla', '2018-08-13 13:46:33', 1, NULL, NULL),
(88, 102, 1, 0, '0000-00-00 00:00:00', 'fjkdsla', '2018-08-13 13:48:11', 1, NULL, NULL),
(89, 101, 2, 0, '0000-00-00 00:00:00', 'jfkdsl', '2018-08-13 13:49:21', 1, NULL, NULL),
(90, 101, 1, 0, '0000-00-00 00:00:00', 'fdsa', '2018-08-13 13:50:10', 1, NULL, NULL),
(91, 102, 2, 0, '0000-00-00 00:00:00', 'fjksdl', '2018-08-13 13:52:12', 1, NULL, NULL),
(92, 101, 19, 0, '0000-00-00 00:00:00', 'fjkdslafkj', '2018-08-13 13:52:42', 1, NULL, NULL),
(93, 101, 2, 0, '2018-08-13 13:34:00', 'jfkdsl', '2018-08-13 13:55:54', 1, NULL, NULL),
(94, 102, 32, 0, '2018-08-13 13:36:00', '', '2018-08-13 13:56:13', 1, NULL, NULL),
(95, 101, 33, 0, '2018-08-13 13:42:00', 'afjdksal', '2018-08-13 13:58:02', 1, NULL, NULL),
(96, 102, 1, 0, '2018-08-13 13:48:00', 'fdksj', '2018-08-13 13:58:45', 1, NULL, NULL),
(97, 102, 2, 0, '2018-08-13 13:50:00', 'fjkdls', '2018-08-13 13:59:07', 1, NULL, NULL),
(98, 102, 1, 0, '2018-08-13 13:52:00', 'jfkdsla', '2018-08-13 14:00:18', 1, NULL, NULL),
(99, 102, 2, 0, '2018-08-13 13:54:00', 'fjkdsadjk2', '2018-08-13 14:00:25', 1, NULL, NULL),
(100, 101, 1, 0, '2018-08-13 13:56:00', 'fjdksla', '2018-08-13 14:01:07', 1, NULL, NULL),
(101, 102, 11, 0, '2018-08-13 13:58:00', 'ajfksl', '2018-08-13 14:02:48', 1, '2018-08-13 14:30:29', 1),
(102, 101, 12, 0, '2018-08-13 14:02:00', 'afjksld', '2018-08-13 14:02:55', 1, NULL, NULL),
(103, 101, 17, 0, '2018-08-13 14:04:00', 'fjkdsla', '2018-08-13 14:03:12', 1, NULL, NULL),
(104, 101, 1, 0, '2018-08-13 14:08:00', 'afjdsk', '2018-08-13 14:04:05', 1, NULL, NULL),
(105, 101, 1, 0, '2018-08-13 14:10:00', 'fajksd', '2018-08-13 14:05:13', 1, NULL, NULL),
(106, 102, 9, 0, '2018-08-13 14:12:00', 'fjaks', '2018-08-13 14:05:56', 1, NULL, NULL),
(107, 102, 1, 0, '2018-08-13 14:16:00', 'fjkdsa', '2018-08-13 14:06:18', 1, NULL, NULL),
(108, 101, 1, 0, '2018-08-13 14:18:00', 'jafksld1', '2018-08-13 14:06:23', 1, NULL, NULL),
(109, 101, 2, 0, '2018-08-13 14:20:00', 'ajfkds', '2018-08-13 14:07:15', 1, NULL, NULL),
(110, 101, 9, 0, '2018-08-13 14:22:00', 'jdkflasd', '2018-08-13 14:07:20', 1, NULL, NULL),
(111, 101, 1, 0, '2018-08-13 14:24:00', 'fjkdsa', '2018-08-13 14:30:18', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jit_group`
--

CREATE TABLE `jit_group` (
  `Id` int(11) NOT NULL,
  `Code` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `qtyMax` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jit_group`
--

INSERT INTO `jit_group` (`Id`, `Code`, `Name`, `qtyMax`) VALUES
(1, 101, 'กรมสารบรรณทหาร', 1500),
(2, 102, 'การเงินทหาร', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `jit_time`
--

CREATE TABLE `jit_time` (
  `Id` int(11) NOT NULL,
  `QueueTime` datetime NOT NULL,
  `QtyTotal` int(11) NOT NULL,
  `InBit` int(11) NOT NULL,
  `OutBit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jit_time`
--

INSERT INTO `jit_time` (`Id`, `QueueTime`, `QtyTotal`, `InBit`, `OutBit`) VALUES
(1, '2018-08-13 14:26:00', 235, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cr_user`
--
ALTER TABLE `cr_user`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `cr_user_group`
--
ALTER TABLE `cr_user_group`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `jit_data`
--
ALTER TABLE `jit_data`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `jit_group`
--
ALTER TABLE `jit_group`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `jit_time`
--
ALTER TABLE `jit_time`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cr_user`
--
ALTER TABLE `cr_user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cr_user_group`
--
ALTER TABLE `cr_user_group`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `jit_data`
--
ALTER TABLE `jit_data`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;
--
-- AUTO_INCREMENT for table `jit_group`
--
ALTER TABLE `jit_group`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `jit_time`
--
ALTER TABLE `jit_time`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
