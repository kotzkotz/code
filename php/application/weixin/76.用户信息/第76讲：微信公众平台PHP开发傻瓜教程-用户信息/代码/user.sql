-- phpMyAdmin SQL Dump
-- http://www.phpmyadmin.net
--
-- 生成日期: 2013 年 12 月 22 日 22:06

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `VnUjNPfdPVxbWdRIoWJI`
--

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `openid` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `sex` int(1) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `image` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `openid`, `nickname`, `sex`, `city`, `province`, `image`) VALUES
(8, 'ovUyZjjhTEZTz0wk1uj44kVr4zpI', '易伟', 1, '汕头', '广东', 'ovUyZjjhTEZTz0wk1uj44kVr4zpI.jpg'),
(9, 'ovUyZjuKsRtNC_2Y8qcCT8zVqtJ8', 'ACOO', 1, '保山', '云南', 'ovUyZjuKsRtNC_2Y8qcCT8zVqtJ8.jpg'),
(10, 'ovUyZjhXOqGwSCtIoJhH8fUNdung', 'Empty', 1, '湖州', '浙江', 'ovUyZjhXOqGwSCtIoJhH8fUNdung.jpg'),
(12, 'ovUyZjm13TqORNWexLOlC9-fZ1Po', '此号用来测试,好友请加qianlong4', 1, '汕头', '广东', 'ovUyZjm13TqORNWexLOlC9-fZ1Po.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
