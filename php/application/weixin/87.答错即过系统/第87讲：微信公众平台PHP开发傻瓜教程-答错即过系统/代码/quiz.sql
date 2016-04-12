-- phpMyAdmin SQL Dump
-- version 3.3.8.1
-- http://www.phpmyadmin.net
--
-- 主机: w.rdc.sae.sina.com.cn:3307
-- 生成日期: 2014 年 02 月 21 日 22:23
-- 服务器版本: 5.5.23
-- PHP 版本: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `app_fswange`
--

-- --------------------------------------------------------

--
-- 表的结构 `quiz`
--

CREATE TABLE IF NOT EXISTS `quiz` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `que` varchar(255) NOT NULL,
  `ans` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `quiz`
--

INSERT INTO `quiz` (`id`, `que`, `ans`) VALUES
(1, '郭沫若的诗集有：  1《子夜》 2《女神》 3《春》 ', 2),
(2, '《童年》的词曲作者是： 1 罗大佑 2刘传 3王洛宾', 1),
(3, '《黄河大合唱》的作曲者是：1聂耳 2冼星海 3阿炳-', 1),
(4, '哪一种米最有黏性？1大米 2糯米 3小米', 2),
(5, '"蒙太奇"一词源于哪国语言？  1法国 2德国 3英国-', 1),
(6, '普洱茶的产地在哪？ 1广西 2 云南 3贵州 ', 2),
(7, 'internet的中文名称是：1 世界网 2 因特网 3万维网', 2),
(8, '自然界已知的最硬物质为： 1石墨 2金刚石 3晶体硅', 2),
(9, '宋代的"学象生"同现代的： 1相声 2口技 3杂技', 2),
(10, '"玛祖卡舞"起源于： 1荷兰 2罗马尼亚 3 波兰 ', 3);
