-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016 年 05 月 09 日 15:17
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
  PRIMARY KEY (`ac_id`),
  KEY `FK_createCate` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `img_click` bigint(20) DEFAULT NULL,
  `img_main` char(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`img_id`),
  KEY `FK_img_album` (`ac_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
(0, 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`email`, `password`, `nickname`, `sex`, `headurl`, `user_id`, `power`) VALUES
('598119677@qq.com', '111111', '小江哥', '0', '', 1, '2');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
