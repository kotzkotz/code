-- phpMyAdmin SQL Dump
-- version 3.3.8.1
-- http://www.phpmyadmin.net
--
-- 主机: w.rdc.sae.sina.com.cn:3307
-- 生成日期: 2014 年 02 月 27 日 21:21
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
-- 表的结构 `fenci`
--

CREATE TABLE IF NOT EXISTS `fenci` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `que` varchar(255) NOT NULL,
  `ans` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `fenci`
--

INSERT INTO `fenci` (`id`, `que`, `ans`) VALUES
(1, '如何防范撞车党', '撞车党一般有几个特点: 　　(1)事故后可能先是1个人，接着很快就有3-5个人过来帮腔,形成团伙； 　　(2)帮腔或受伤的人对交通事故处理程序和赔偿异常熟悉； 　　(3)受伤的人希望要钱而不是急着去医院治疗。住院后也会1-2天就出院； 　　(4)不希望报交警,要求私了。 　　防范措施有以下几点: 　　做好伤者检查,看是否有擦伤等,是否符合车辆致伤情况.特别是有骨折时,要注意伤者是否伪装。正常骨折的伤者一般骨折处会疼痛明显,而伪装者则碰哪哪疼。 　　如伤者手中有X片，要注意片中的姓名、时间，及男女区别，是否'),
(2, '申请救助基金抢救费用的流程是什么', '抢救病人家属向救助受理岗申请填表，1天内上报基金管理工作小组审核，小组审核后1天内向医疗机构送达《同意垫付抢救费用通知书》。抢救完成后，医疗机构向基金管理工作小组申领抢救费报销，5个工作日报销。'),
(3, '汕头交通事故如何处理', '交通事故发生后无法协商的应及时报110');
