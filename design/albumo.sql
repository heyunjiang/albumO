-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016 年 05 月 18 日 22:02
-- 服务器版本: 5.5.47
-- PHP 版本: 5.3.29

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `albumo`
--

-- --------------------------------------------------------

--
-- 表的结构 `albumcategory`
--

CREATE TABLE IF NOT EXISTS `albumcategory` (
  `ac_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ac_name` varchar(50) NOT NULL,
  `ac_description` longtext,
  `ac_add_time` date NOT NULL,
  PRIMARY KEY (`ac_id`),
  KEY `FK_createCate` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `albumcategory`
--

INSERT INTO `albumcategory` (`ac_id`, `user_id`, `ac_name`, `ac_description`, `ac_add_time`) VALUES
(7, 16, '萌萌哒', '最可爱的孩子11111111', '2016-05-16'),
(6, 16, '美丽', '天下最美丽的地方-同心乡', '2016-05-13'),
(8, 16, '一家人', '这里是一家人的照片', '2016-05-13'),
(11, 19, '天天快乐', '开心Happy', '2016-05-17'),
(10, 16, '小不点', '这个有点帅', '2016-05-13'),
(12, 19, '时间', '时间像一滴滴雨水，落进泥土里，就消失不见', '2016-05-17'),
(13, 19, 'lalal', 'hehehhe', '2016-05-17');

-- --------------------------------------------------------

--
-- 表的结构 `img`
--

CREATE TABLE IF NOT EXISTS `img` (
  `img_id` int(11) NOT NULL AUTO_INCREMENT,
  `ac_id` int(11) NOT NULL,
  `img_name` varchar(50) NOT NULL,
  `img_url` varchar(500) NOT NULL,
  `img_description` varchar(500) DEFAULT NULL,
  `img_click` bigint(20) DEFAULT '0',
  `img_main` char(2) NOT NULL DEFAULT '0',
  `img_add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`img_id`),
  KEY `FK_img_album` (`ac_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `img`
--

INSERT INTO `img` (`img_id`, `ac_id`, `img_name`, `img_url`, `img_description`, `img_click`, `img_main`, `img_add_time`) VALUES
(3, 7, '天使喵喵', '/Public/img/pic/head1463130196.jpg', '可爱的天使喵', 7, '1', '2016-05-17 07:54:33'),
(4, 7, '和合伙', '/Public/img/pic/head1463131838.png', '哟西哟西', 8, '0', '2016-05-17 07:56:43'),
(6, 6, '我的心', '/Public/img/pic/head1463449644.png', '我的心', 0, '1', '2016-05-17 07:40:16'),
(7, 8, '我的心', '/Public/img/pic/head1463449665.png', '我的心', 0, '0', '2016-05-17 07:40:18'),
(8, 10, '我的心', '/Public/img/pic/head1463449679.png', '我的心', 0, '1', '2016-05-17 07:40:21'),
(9, 7, '我的心', '/Public/img/pic/head1463449711.jpg', '我的心', 5, '0', '2016-05-17 07:56:51'),
(10, 11, '哟西哟西', '/Public/img/pic/head1463453268.jpg', '反对萨反对萨凡四大佛萨', 1, '1', '2016-05-17 07:59:25');

-- --------------------------------------------------------

--
-- 表的结构 `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `img_id` int(11) NOT NULL,
  `m_content` varchar(500) NOT NULL,
  PRIMARY KEY (`m_id`),
  KEY `FK_img_message` (`img_id`),
  KEY `FK_leaveMessage` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `message`
--

INSERT INTO `message` (`m_id`, `user_id`, `img_id`, `m_content`) VALUES
(1, 16, 3, '好漂亮'),
(2, 19, 3, '这是真的'),
(3, 16, 3, '可爱的猫猫'),
(4, 16, 3, '美丽测试'),
(5, 16, 4, '这是什么鬼'),
(6, 16, 9, '好有爱'),
(7, 16, 4, '真帅');

-- --------------------------------------------------------

--
-- 表的结构 `total`
--

CREATE TABLE IF NOT EXISTS `total` (
  `t_id` int(11) NOT NULL,
  `t_value` int(11) NOT NULL,
  PRIMARY KEY (`t_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `total`
--

INSERT INTO `total` (`t_id`, `t_value`) VALUES
(0, 7015);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `sex` char(2) DEFAULT NULL,
  `headurl` longtext,
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `power` char(2) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`email`, `password`, `nickname`, `sex`, `headurl`, `user_id`, `power`) VALUES
('163@qq.com', '111', '123', '1', '/Public/img/head/head1463472399.jpg', 24, '1'),
('4456@qq.com', '111', '哟西123', '1', '/Public/img/head/head1463387098.jpg', 20, '1'),
('536@qq.com', '111', '可爱', '0', '/Public/img/head/head1463386940.jpg', 19, '1'),
('132@qq.com', '111', '111', '1', '/Public/img/head/head1463472047.jpg', 22, '1'),
('645@qq.com', '111', '11', '0', '/Public/img/head/head1463472167.jpg', 23, '1'),
('1065031646@qq.com', '111', '萌萌哒', '0', '/Public/img/head/head1462947740.jpg', 17, '1'),
('598119677@qq.com', 'gad', '小江哥', '0', '/Public/img/head/head1463473315.jpg', 16, '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
