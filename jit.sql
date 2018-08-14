-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2018 at 10:37 AM
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
(1, 1201, 29, 0, '2018-08-14 08:00:00', '29', '2018-08-14 10:37:08', 2, '2018-08-14 10:43:06', 2),
(2, 1301, 33, 0, '2018-08-14 08:04:00', '08412347777', '2018-08-14 10:37:44', 2, '2018-08-14 12:56:13', 2),
(3, 2100, 23, 0, '2018-08-14 08:10:00', '125486613613', '2018-08-14 10:41:19', 2, NULL, NULL),
(4, 1100, 20, 0, '2018-08-14 08:14:00', '-', '2018-08-14 11:21:49', 2, NULL, NULL),
(5, 1200, 23, 0, '2018-08-14 08:18:00', '2566', '2018-08-14 12:54:24', 2, '2018-08-14 15:33:58', 1),
(6, 2101, 2, 0, '2018-08-14 08:24:00', '', '2018-08-14 13:14:02', 1, '2018-08-14 15:34:05', 1),
(7, 2101, 3, 0, '2018-08-14 08:26:00', '', '2018-08-14 13:14:06', 1, '2018-08-14 15:34:09', 1),
(8, 2102, 10, 0, '2018-08-14 08:28:00', '', '2018-08-14 13:19:01', 1, NULL, NULL),
(9, 2102, 5, 0, '2018-08-14 08:30:00', '', '2018-08-14 13:21:29', 1, '2018-08-14 14:53:00', 1),
(10, 2100, 1, 0, '2018-08-14 08:34:00', '111', '2018-08-14 14:52:50', 1, NULL, NULL),
(11, 1101, 10, 0, '2018-08-14 08:36:00', '6555', '2018-08-14 15:15:26', 1, NULL, NULL),
(12, 1101, 10, 0, '2018-08-14 08:38:00', '6555', '2018-08-14 15:15:39', 1, NULL, NULL),
(13, 1101, 1, 0, '2018-08-14 08:42:00', '6555', '2018-08-14 15:15:50', 1, NULL, NULL),
(14, 1101, 2, 0, '2018-08-14 08:44:00', '6555', '2018-08-14 15:15:55', 1, NULL, NULL),
(15, 1101, 120, 0, '2018-08-14 08:46:00', 'fdsa', '2018-08-14 15:25:05', 1, NULL, NULL),
(16, 1101, 200, 0, '2018-08-14 09:02:00', 'fdsa', '2018-08-14 15:25:28', 1, NULL, NULL),
(17, 1101, 1111, 0, '2018-08-14 09:26:00', '56', '2018-08-14 15:25:51', 1, NULL, NULL),
(18, 1101, 1, 0, '2018-08-14 11:32:00', '12', '2018-08-14 15:26:11', 1, NULL, NULL),
(19, 1101, 2, 0, '2018-08-14 11:34:00', '12', '2018-08-14 15:26:16', 1, NULL, NULL),
(20, 1101, 1, 0, '2018-08-14 11:36:00', 'fdsa1', '2018-08-14 15:26:41', 1, NULL, NULL),
(21, 1101, 2, 0, '2018-08-14 11:38:00', 'fdsa1', '2018-08-14 15:26:45', 1, NULL, NULL),
(22, 1101, 1000, 0, '2018-08-14 11:40:00', 'fdasf', '2018-08-14 15:26:59', 1, NULL, NULL),
(23, 1101, 1, 0, '2018-08-14 13:32:00', 'afdssa1', '2018-08-14 15:28:58', 1, NULL, NULL),
(24, 1102, 29, 0, '2018-08-14 13:34:00', 'afdssa1', '2018-08-14 15:29:20', 1, NULL, NULL),
(25, 1102, 1, 0, '2018-08-14 13:38:00', 'afdssa1', '2018-08-14 15:29:23', 1, NULL, NULL),
(26, 1102, 1, 0, '2018-08-14 13:40:00', 'afdssa1', '2018-08-14 15:29:26', 1, NULL, NULL),
(27, 1102, 1, 0, '2018-08-14 13:42:00', 'afdssa1', '2018-08-14 15:29:36', 1, NULL, NULL);

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
(1, 1100, 'สร.', 10),
(2, 1101, 'สำนักงานรัฐมนตรีช่วย', 20),
(3, 1102, 'สน.ปล.กห.', 30),
(4, 1103, 'สงป.กห. ', 40),
(5, 1104, 'สนพ.สสน.สป', 50),
(6, 1200, 'สน.ผบช.สนผ.กห.', 60),
(7, 1201, 'สนย.สนผ.กห.', 70),
(8, 1202, 'สอซ.สนผ.กห.', 80),
(9, 1203, 'สวส.สนผ.กห.', 90),
(10, 1204, 'สกร.สนผ.กห.', 100),
(11, 1205, 'สง.ปรมน.สนผ.กห.', 110),
(12, 1206, 'กลาง.สนผ.กห.', 120),
(13, 1207, 'กผจ.สนผ.กห.', 130),
(14, 1208, 'กรภ.สนผ.กห.', 140),
(15, 1209, 'กปช.สนผ.กห.', 150),
(16, 1210, 'สกง.สนผ.กห.', 160),
(17, 1211, 'พัน.สห.สป.', 170),
(18, 1301, 'ธน.', 180),
(19, 1302, 'กง.กห.', 190),
(20, 1303, 'ศอพท.กห.', 200),
(21, 1304, 'กกส.กห.', 210),
(22, 2100, 'สน.ผบ.ทสส.', 220),
(23, 2101, 'สน.รอง ผบ.ทสส.(1)', 230),
(24, 2102, 'สน.รอง ผบ.ทสส.(2)', 240),
(25, 2103, 'สน.รอง ผบ.ทสส.(3)', 250),
(26, 2104, 'สน.รอง ผบ.ทสส.(4)', 260),
(27, 2105, 'สน.เสธ.ทหาร', 270),
(28, 2106, 'สน.รอง เสธ.ทหาร (1)', 280),
(29, 2107, 'สน.รอง เสธ.ทหาร (2)', 290),
(30, 2108, 'สน.รอง เสธ.ทหาร (3)', 300),
(31, 2109, 'สน.รอง เสธ.ทหาร (4)', 310),
(32, 2201, 'ศปร.', 320),
(33, 2202, 'สน.บก.บก.ทท.', 330),
(34, 2203, 'สลก.บก.ทท.', 340),
(35, 2204, 'สจร.ทหาร', 350),
(36, 2205, 'สตน.ทหาร', 360),
(37, 2206, 'สธน.ทหาร', 370),
(38, 2207, 'สสก.ทหาร', 380),
(39, 2208, 'สยย.ทหาร', 390),
(40, 2209, 'ศซบ.ทหาร', 400),
(41, 2210, 'ศทช.ศบท.บก.ทท.', 410),
(42, 2301, 'กพ.ทหาร', 420),
(43, 2302, 'ขว.ทหาร', 430),
(44, 2303, 'ยก.ทหาร', 440),
(45, 2304, 'กบ.ทหาร', 450),
(46, 2305, 'กร.ทหาร', 460),
(47, 2306, 'สส.ทหาร', 470),
(48, 2307, 'สปช.ทหาร', 480),
(49, 2401, 'นทพ.', 490),
(50, 2402, 'ศรภ.', 500),
(51, 2403, 'ศตก.', 510),
(52, 2501, 'สบ.ทหาร', 520),
(53, 2502, 'กง.ทหาร', 530),
(54, 2503, 'ผท.ทหาร', 540),
(55, 2504, 'ยบ.ทหาร', 550),
(56, 2505, 'ชด.ทหาร', 560),
(57, 2601, 'สปท.', 570),
(58, 2602, 'วปอ.', 580),
(59, 2603, 'วสท.', 590),
(60, 2604, 'สจว.', 600),
(61, 2605, 'ศศย.', 610),
(62, 2606, 'รร.ตท.', 620),
(63, 2607, 'รร.ชท.', 630);

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
(1, '2018-08-14 13:44:00', 2642, 14, 0);

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
(1, 'admin', 'f9c6c2e7d2dd5c8773d97faaa399692d', '43366a8c6902767fc2157b7def389f5e60f8b7ba1c36e546ce2c3beabca85ae9', 'Administrator', '1', '', 'admin@gmail.com', 'admin', 'user_admin.jpg', '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, '2018-08-14 15:35:28', ''),
(2, 'ni', '125d2bd3d7630563306813fd1b769ece710ea13b05a7a57e984c79726f99d5f3', '125d2bd3d7630563306813fd1b769ece710ea13b05a7a57e984c79726f99d5f3', 'ร.ท.หญิง หัชญา สุพัฒนานนท์', '3', '0', 'ni1234@rtarf.mi.th', '-', '', '1', '2018-08-14 10:22:47', 1, '0000-00-00 00:00:00', 0, 0, '2018-08-14 12:56:39', ''),
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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
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
