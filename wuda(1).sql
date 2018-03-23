-- phpMyAdmin SQL Dump
-- version 4.4.15
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2018-03-21 09:13:41
-- 服务器版本： 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wuda`
--

-- --------------------------------------------------------

--
-- 表的结构 `calendar`
--

CREATE TABLE IF NOT EXISTS `calendar` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `info` varchar(200) NOT NULL,
  `starttime` int(11) NOT NULL,
  `endtime` int(11) DEFAULT NULL,
  `allday` tinyint(1) NOT NULL DEFAULT '0',
  `color` varchar(20) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `calendar`
--

INSERT INTO `calendar` (`id`, `title`, `info`, `starttime`, `endtime`, `allday`, `color`) VALUES
(59, 'root', 'ikj', 1521504000, 1521525600, 0, '#f30');

-- --------------------------------------------------------

--
-- 表的结构 `calendar2`
--

CREATE TABLE IF NOT EXISTS `calendar2` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `info` varchar(200) NOT NULL,
  `starttime` int(11) NOT NULL,
  `endtime` int(11) DEFAULT NULL,
  `allday` tinyint(1) NOT NULL DEFAULT '0',
  `color` varchar(20) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `calendar2`
--

INSERT INTO `calendar2` (`id`, `title`, `info`, `starttime`, `endtime`, `allday`, `color`) VALUES
(1, 'root', 'frg', 1521441000, 1521450000, 0, '#f30'),
(2, 'root', 'ffr', 1521423000, 1521432000, 0, '#f30');

-- --------------------------------------------------------

--
-- 表的结构 `calendar3`
--

CREATE TABLE IF NOT EXISTS `calendar3` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `info` varchar(200) NOT NULL,
  `starttime` int(11) NOT NULL,
  `endtime` int(11) DEFAULT NULL,
  `allday` tinyint(1) NOT NULL DEFAULT '0',
  `color` varchar(20) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `calendar3`
--

INSERT INTO `calendar3` (`id`, `title`, `info`, `starttime`, `endtime`, `allday`, `color`) VALUES
(1, 'root', 'wsx', 1521423000, 1521477000, 0, '#06c'),
(3, 'root', 'ooooo', 1521417600, 1521471600, 0, '#06c');

-- --------------------------------------------------------

--
-- 表的结构 `calendar4`
--

CREATE TABLE IF NOT EXISTS `calendar4` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `info` varchar(200) NOT NULL,
  `starttime` int(11) NOT NULL,
  `endtime` int(11) DEFAULT NULL,
  `allday` tinyint(1) NOT NULL DEFAULT '0',
  `color` varchar(20) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `calendar4`
--

INSERT INTO `calendar4` (`id`, `title`, `info`, `starttime`, `endtime`, `allday`, `color`) VALUES
(2, 'root', '123', 1521417600, 1521471600, 0, '#06c');

-- --------------------------------------------------------

--
-- 表的结构 `calendar5`
--

CREATE TABLE IF NOT EXISTS `calendar5` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `info` varchar(200) NOT NULL,
  `starttime` int(11) NOT NULL,
  `endtime` int(11) DEFAULT NULL,
  `allday` tinyint(1) NOT NULL DEFAULT '0',
  `color` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `calendar6`
--

CREATE TABLE IF NOT EXISTS `calendar6` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `info` varchar(200) NOT NULL,
  `starttime` int(11) NOT NULL,
  `endtime` int(11) DEFAULT NULL,
  `allday` tinyint(1) NOT NULL DEFAULT '0',
  `color` varchar(20) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `calendar6`
--

INSERT INTO `calendar6` (`id`, `title`, `info`, `starttime`, `endtime`, `allday`, `color`) VALUES
(1, 'root', 'hjj', 1521437400, 1521451800, 0, '#f30'),
(2, 'root', 'tggggg', 1521172800, 1521181800, 0, '#360');

-- --------------------------------------------------------

--
-- 表的结构 `calendar7`
--

CREATE TABLE IF NOT EXISTS `calendar7` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `info` varchar(200) NOT NULL,
  `starttime` int(11) NOT NULL,
  `endtime` int(11) DEFAULT NULL,
  `allday` tinyint(1) NOT NULL DEFAULT '0',
  `color` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `id` int(11) NOT NULL,
  `money` float(12,2) NOT NULL DEFAULT '0.00',
  `username` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  `realname` varchar(255) DEFAULT NULL,
  `age` varchar(3) DEFAULT NULL,
  `gender` varchar(12) DEFAULT NULL,
  `picurl` varchar(255) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `member`
--

INSERT INTO `member` (`id`, `money`, `username`, `password`, `realname`, `age`, `gender`, `picurl`) VALUES
(44, 0.00, 'test', 'e10adc3949ba59abbe56e057f20f883e', '张晓燕', '32', '女', 'uploadfile/2017-12/1514435600Bf2Wb88IEY4a.jpg'),
(45, 0.00, 'test2', 'e10adc3949ba59abbe56e057f20f883e', '李猛', '23', '男', 'uploadfile/2017-12/1514438193ktiz3kiWyrCF.jpg'),
(46, 0.00, 'aoe', 'dd4b85c4de563d96b451f2a98dfa5f79', 'aoe', '12', '男', NULL),
(47, 0.00, 'wuda', '2a0963f04dd54b3a76a163fdf9af2480', 'wuda', '4', '男', NULL),
(48, 0.00, 'zhuitian', '2a0963f04dd54b3a76a163fdf9af2480', 'zhuitian', '6', '男', NULL),
(49, 0.00, 'a123', '4297f44b13955235245b2497399d7a93', '123', '', '男', NULL),
(50, 0.00, 'root', '63a9f0ea7bb98050796b649e85481845', 'root', '', '男', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  `age` varchar(3) DEFAULT NULL,
  `gender` varchar(12) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `age`, `gender`) VALUES
(21, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '12', '男');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `starttime` (`starttime`),
  ADD UNIQUE KEY `endtime` (`endtime`);

--
-- Indexes for table `calendar2`
--
ALTER TABLE `calendar2`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `starttime` (`starttime`),
  ADD UNIQUE KEY `endtime` (`endtime`);

--
-- Indexes for table `calendar3`
--
ALTER TABLE `calendar3`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `starttime` (`starttime`),
  ADD UNIQUE KEY `endtime` (`endtime`);

--
-- Indexes for table `calendar4`
--
ALTER TABLE `calendar4`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `starttime` (`starttime`),
  ADD UNIQUE KEY `endtime` (`endtime`);

--
-- Indexes for table `calendar5`
--
ALTER TABLE `calendar5`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `starttime` (`starttime`),
  ADD UNIQUE KEY `endtime` (`endtime`);

--
-- Indexes for table `calendar6`
--
ALTER TABLE `calendar6`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `starttime` (`starttime`),
  ADD UNIQUE KEY `endtime` (`endtime`);

--
-- Indexes for table `calendar7`
--
ALTER TABLE `calendar7`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `starttime` (`starttime`),
  ADD UNIQUE KEY `endtime` (`endtime`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calendar`
--
ALTER TABLE `calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `calendar2`
--
ALTER TABLE `calendar2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `calendar3`
--
ALTER TABLE `calendar3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `calendar4`
--
ALTER TABLE `calendar4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `calendar5`
--
ALTER TABLE `calendar5`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `calendar6`
--
ALTER TABLE `calendar6`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `calendar7`
--
ALTER TABLE `calendar7`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
