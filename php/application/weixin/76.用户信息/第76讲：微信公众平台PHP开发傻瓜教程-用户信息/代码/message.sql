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
-- 表的结构 `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `openid` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=117 ;

--
-- 转存表中的数据 `message`
--

INSERT INTO `message` (`id`, `openid`, `message`) VALUES
(98, 'ovUyZjjhTEZTz0wk1uj44kVr4zpI', '擦'),
(99, 'ovUyZjjhTEZTz0wk1uj44kVr4zpI', '测试'),
(100, 'ovUyZjjhTEZTz0wk1uj44kVr4zpI', '你爸爸巴闭咯莫呢'),
(101, 'ovUyZjm13TqORNWexLOlC9-fZ1Po', 'Try'),
(102, 'ovUyZjm13TqORNWexLOlC9-fZ1Po', 'Tying'),
(103, 'ovUyZjm13TqORNWexLOlC9-fZ1Po', 'Sigh'),
(104, 'ovUyZjjhTEZTz0wk1uj44kVr4zpI', 'yjh'),
(105, 'ovUyZjm13TqORNWexLOlC9-fZ1Po', 'Gh'),
(106, 'ovUyZjjhTEZTz0wk1uj44kVr4zpI', 'efg'),
(107, 'ovUyZjm13TqORNWexLOlC9-fZ1Po', 'Eric'),
(108, 'ovUyZjuKsRtNC_2Y8qcCT8zVqtJ8', '好'),
(109, 'ovUyZjhXOqGwSCtIoJhH8fUNdung', 'Hello'),
(110, 'ovUyZjm13TqORNWexLOlC9-fZ1Po', 'Fight'),
(111, 'ovUyZjm13TqORNWexLOlC9-fZ1Po', 'Hh'),
(112, 'ovUyZjm13TqORNWexLOlC9-fZ1Po', 'Ghj'),
(113, 'ovUyZjjhTEZTz0wk1uj44kVr4zpI', '测试'),
(114, 'ovUyZjjhTEZTz0wk1uj44kVr4zpI', '阿爸'),
(115, 'ovUyZjjhTEZTz0wk1uj44kVr4zpI', '罢了'),
(116, 'ovUyZjjhTEZTz0wk1uj44kVr4zpI', '巴黎');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
