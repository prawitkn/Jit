-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2018 at 04:09 AM
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
(1, 1204, 20, 0, '2018-08-22 08:30:00', '094-999-8958', '2018-08-15 09:57:07', 1, '2018-08-15 10:11:48', 1),
(2, 1208, 15, 0, '2018-08-22 08:34:00', '025750161', '2018-08-15 09:57:19', 1, '2018-08-16 10:13:02', 1),
(3, 1103, 31, 0, '2018-08-22 08:36:00', '025721833', '2018-08-15 09:57:32', 1, '2018-08-16 10:13:14', 1),
(4, 1104, 15, 0, '2018-08-22 08:42:00', '-', '2018-08-15 09:57:40', 1, NULL, NULL),
(5, 2101, 30, 0, '2018-08-22 08:46:00', '-', '2018-08-15 09:58:01', 1, NULL, NULL),
(6, 2107, 100, 0, '2018-08-22 08:52:00', '-', '2018-08-15 09:58:29', 1, NULL, NULL),
(7, 2108, 2, 0, '2018-08-22 09:04:00', '0899998699', '2018-08-15 09:58:46', 1, NULL, NULL),
(8, 1208, 25, 0, '2018-08-22 09:06:00', '090999999', '2018-08-16 09:27:28', 2, NULL, NULL),
(9, 2201, 30, 0, '2018-08-22 09:12:00', '0954445567', '2018-08-16 09:31:34', 1, NULL, NULL),
(10, 2101, 80, 0, '2018-08-22 09:16:00', '0898-0', '2018-08-16 10:43:42', 2, NULL, NULL);

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
(1, 1100, 'สร.', 120),
(2, 1101, 'สำนักงานรัฐมนตรีช่วย', 120),
(3, 1102, 'สน.ปล.กห.', 120),
(4, 1103, 'สงป.กห. ', 120),
(5, 1104, 'สนพ.สสน.สป', 120),
(6, 1200, 'สน.ผบช.สนผ.กห.', 120),
(7, 1201, 'สนย.สนผ.กห.', 120),
(8, 1202, 'สอซ.สนผ.กห.', 120),
(9, 1203, 'สวส.สนผ.กห.', 120),
(10, 1204, 'สกร.สนผ.กห.', 120),
(11, 1205, 'สง.ปรมน.สนผ.กห.', 120),
(12, 1206, 'กลาง.สนผ.กห.', 120),
(13, 1207, 'กผจ.สนผ.กห.', 120),
(14, 1208, 'กรภ.สนผ.กห.', 120),
(15, 1209, 'กปช.สนผ.กห.', 120),
(16, 1210, 'สกง.สนผ.กห.', 120),
(17, 1211, 'พัน.สห.สป.', 120),
(18, 1301, 'ธน.', 120),
(19, 1302, 'กง.กห.', 120),
(20, 1303, 'ศอพท.กห.', 120),
(21, 1304, 'กกส.กห.', 120),
(22, 2100, 'สน.ผบ.ทสส.', 120),
(23, 2101, 'สน.รอง ผบ.ทสส.(1)', 120),
(24, 2102, 'สน.รอง ผบ.ทสส.(2)', 120),
(25, 2103, 'สน.รอง ผบ.ทสส.(3)', 120),
(26, 2104, 'สน.รอง ผบ.ทสส.(4)', 120),
(27, 2105, 'สน.เสธ.ทหาร', 120),
(28, 2106, 'สน.รอง เสธ.ทหาร (1)', 120),
(29, 2107, 'สน.รอง เสธ.ทหาร (2)', 120),
(30, 2108, 'สน.รอง เสธ.ทหาร (3)', 120),
(31, 2109, 'สน.รอง เสธ.ทหาร (4)', 120),
(32, 2201, 'ศปร.', 120),
(33, 2202, 'สน.บก.บก.ทท.', 120),
(34, 2203, 'สลก.บก.ทท.', 120),
(35, 2204, 'สจร.ทหาร', 120),
(36, 2205, 'สตน.ทหาร', 120),
(37, 2206, 'สธน.ทหาร', 120),
(38, 2207, 'สสก.ทหาร', 120),
(39, 2208, 'สยย.ทหาร', 120),
(40, 2209, 'ศซบ.ทหาร', 120),
(41, 2210, 'ศทช.ศบท.บก.ทท.', 120),
(42, 2301, 'กพ.ทหาร', 120),
(43, 2302, 'ขว.ทหาร', 120),
(44, 2303, 'ยก.ทหาร', 120),
(45, 2304, 'กบ.ทหาร', 120),
(46, 2305, 'กร.ทหาร', 120),
(47, 2306, 'สส.ทหาร', 120),
(48, 2307, 'สปช.ทหาร', 120),
(49, 2401, 'นทพ.', 120),
(50, 2402, 'ศรภ.', 120),
(51, 2403, 'ศตก.', 120),
(52, 2501, 'สบ.ทหาร', 120),
(53, 2502, 'กง.ทหาร', 120),
(54, 2503, 'ผท.ทหาร', 120),
(55, 2504, 'ยบ.ทหาร', 120),
(56, 2505, 'ชด.ทหาร', 120),
(57, 2601, 'สปท.', 120),
(58, 2602, 'วปอ.', 120),
(59, 2603, 'วสท.', 120),
(60, 2604, 'สจว.', 120),
(61, 2605, 'ศศย.', 120),
(62, 2606, 'รร.ตท.', 120),
(63, 2607, 'รร.ชท.', 120);

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
(1, '2018-08-22 09:28:00', 348, 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jit_user`
--

CREATE TABLE `jit_user` (
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
  `StatusId` char(1) DEFAULT NULL,
  `CreateTime` datetime NOT NULL,
  `CreateUserId` int(11) NOT NULL,
  `UpdateTime` datetime NOT NULL,
  `UpdateUserId` int(11) NOT NULL,
  `loginStatus` int(11) NOT NULL DEFAULT '0',
  `lastLoginTime` datetime NOT NULL,
  `SID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jit_user`
--

INSERT INTO `jit_user` (`userId`, `userName`, `userPassword`, `userPin`, `userFullname`, `userGroupCode`, `userDeptCode`, `userEmail`, `userTel`, `userPicture`, `StatusId`, `CreateTime`, `CreateUserId`, `UpdateTime`, `UpdateUserId`, `loginStatus`, `lastLoginTime`, `SID`) VALUES
(1, 'admin', 'f9c6c2e7d2dd5c8773d97faaa399692d', '43366a8c6902767fc2157b7def389f5e60f8b7ba1c36e546ce2c3beabca85ae9', 'Administrator', '1', '', 'admin@gmail.com', 'admin', 'user_admin.jpg', '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, '2018-08-16 13:38:24', ''),
(2, 'ni', '125d2bd3d7630563306813fd1b769ece710ea13b05a7a57e984c79726f99d5f3', '125d2bd3d7630563306813fd1b769ece710ea13b05a7a57e984c79726f99d5f3', 'ร.ท.หญิง หัชญา สุพัฒนานนท์', '3', '0', 'ni1234@rtarf.mi.th', '-', '', '1', '2018-08-14 10:22:47', 1, '0000-00-00 00:00:00', 0, 0, '2018-08-16 13:18:34', ''),
(3, 'oil', '125d2bd3d7630563306813fd1b769ece710ea13b05a7a57e984c79726f99d5f3', '125d2bd3d7630563306813fd1b769ece710ea13b05a7a57e984c79726f99d5f3', 'พ.จ.ต. สมพงษ์   ภูคงน้ำ', '3', '0', 'oil1234@rtarf.mi.th', '-', '', '1', '2018-08-14 10:29:53', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', ''),
(4, 'aof', '125d2bd3d7630563306813fd1b769ece710ea13b05a7a57e984c79726f99d5f3', '125d2bd3d7630563306813fd1b769ece710ea13b05a7a57e984c79726f99d5f3', 'พ.อ.อ. กันตพงศ์   ประไพเพชร', '3', '0', 'aof1234@rtarf.mi.th', '-', '', '1', '2018-08-14 10:47:18', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', ''),
(5, 'tawan', '125d2bd3d7630563306813fd1b769ece710ea13b05a7a57e984c79726f99d5f3', '125d2bd3d7630563306813fd1b769ece710ea13b05a7a57e984c79726f99d5f3', 'ส.อ. ตะวัน อินแผง', '3', '0', 'tawan1234@rtarf.mi.th', '-', '', '1', '2018-08-14 10:48:57', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', ''),
(6, 'nk', '125d2bd3d7630563306813fd1b769ece710ea13b05a7a57e984c79726f99d5f3', '125d2bd3d7630563306813fd1b769ece710ea13b05a7a57e984c79726f99d5f3', 'นางสาว ภูริพัชร นาคบุญมา', '3', '0', 'nk1234@rtarf.mi.th', '-', '', '1', '2018-08-14 10:49:43', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', ''),
(7, 'tong', '125d2bd3d7630563306813fd1b769ece710ea13b05a7a57e984c79726f99d5f3', '125d2bd3d7630563306813fd1b769ece710ea13b05a7a57e984c79726f99d5f3', 'ร.ท. พิชาคร   นุ้ยสุข', '3', '0', 'tong1234@rtarf.mi.th', '-', '', '1', '2018-08-14 10:50:42', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', ''),
(8, 'rong', '125d2bd3d7630563306813fd1b769ece710ea13b05a7a57e984c79726f99d5f3', '125d2bd3d7630563306813fd1b769ece710ea13b05a7a57e984c79726f99d5f3', 'น.อ.หญิง วรารัตน์   นรินทรภักดี', '3', '0', 'rong1234@rtarf.mi.th', '-', '', '1', '2018-08-14 10:55:16', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', ''),
(9, 'tick', '125d2bd3d7630563306813fd1b769ece710ea13b05a7a57e984c79726f99d5f3', '125d2bd3d7630563306813fd1b769ece710ea13b05a7a57e984c79726f99d5f3', 'พ.อ. ไพบูลย์   โกมลทัต', '3', '0', 'tick1234@rtarf.mi.th', '-', '', '1', '2018-08-14 10:56:07', 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `jit_user_group`
--

CREATE TABLE `jit_user_group` (
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
-- Dumping data for table `jit_user_group`
--

INSERT INTO `jit_user_group` (`Id`, `Code`, `Name`, `StatusId`, `CreateTime`, `CreateUserId`, `UpdateTime`, `UpdateUserId`) VALUES
(1, 'admin', 'admin', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(2, 'guest', 'Guest', 1, '2018-08-01 15:24:03', 1, '2018-08-01 15:54:08', 1),
(3, 'superUser', 'Super User', 1, '2018-08-01 15:24:03', 1, '2018-08-01 15:54:08', 1);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `jit_user`
--
ALTER TABLE `jit_user`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `jit_user_group`
--
ALTER TABLE `jit_user_group`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jit_data`
--
ALTER TABLE `jit_data`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `jit_group`
--
ALTER TABLE `jit_group`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `jit_time`
--
ALTER TABLE `jit_time`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `jit_user`
--
ALTER TABLE `jit_user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `jit_user_group`
--
ALTER TABLE `jit_user_group`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
