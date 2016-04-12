-- phpMyAdmin SQL Dump
-- version 3.3.8.1
-- http://www.phpmyadmin.net
--
-- 主机: w.rdc.sae.sina.com.cn:3307
-- 生成日期: 2014 年 02 月 23 日 23:21
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
-- 表的结构 `kefu`
--

CREATE TABLE IF NOT EXISTS `kefu` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `user2` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `kefu`
--

INSERT INTO `kefu` (`id`, `user`, `user2`) VALUES
(1, 'os7R7uKWQXK0SnQk_XdRieAlrMdo', 'os7R7uGofd69mYftQo7NTBgAFqTg'),
(2, '55', '888os7R7uKWQXK0SnQk_XdRieAlrMdo');
