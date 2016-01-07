-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016 年 01 月 07 日 11:45
-- 服务器版本: 5.5.40
-- PHP 版本: 5.3.29

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `jfsd_youweihui`
--

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_action`
--

CREATE TABLE IF NOT EXISTS `jfsd_action` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` char(30) NOT NULL DEFAULT '' COMMENT '行为唯一标识',
  `title` char(80) NOT NULL DEFAULT '' COMMENT '行为说明',
  `remark` char(140) NOT NULL DEFAULT '' COMMENT '行为描述',
  `rule` text COMMENT '行为规则',
  `log` text COMMENT '日志规则',
  `type` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '类型',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='系统行为表' AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `jfsd_action`
--

INSERT INTO `jfsd_action` (`id`, `name`, `title`, `remark`, `rule`, `log`, `type`, `status`, `update_time`) VALUES
(1, 'user_login', '用户登录', '积分+10，每天一次', 'table:member|field:score|condition:uid={$self} AND status>-1|rule:score+10|cycle:24|max:1;', '[user|get_nickname]在[time|time_format]登录了后台', 1, 1, 1387181220),
(2, 'add_article', '发布文章', '积分+5，每天上限5次', 'table:member|field:score|condition:uid={$self}|rule:score+5|cycle:24|max:5', '', 2, 0, 1380173180),
(3, 'review', '评论', '评论积分+1，无限制', 'table:member|field:score|condition:uid={$self}|rule:score+1', '', 2, 1, 1383285646),
(4, 'add_document', '发表文档', '积分+10，每天上限5次', 'table:member|field:score|condition:uid={$self}|rule:score+10|cycle:24|max:5', '[user|get_nickname]在[time|time_format]发表了一篇文章。\r\n表[model]，记录编号[record]。', 2, 0, 1386139726),
(5, 'add_document_topic', '发表讨论', '积分+5，每天上限10次', 'table:member|field:score|condition:uid={$self}|rule:score+5|cycle:24|max:10', '', 2, 0, 1383285551),
(6, 'update_config', '更新配置', '新增或修改或删除配置', '', '', 1, 1, 1383294988),
(7, 'update_model', '更新模型', '新增或修改模型', '', '', 1, 1, 1383295057),
(8, 'update_attribute', '更新属性', '新增或更新或删除属性', '', '', 1, 1, 1383295963),
(9, 'update_channel', '更新导航', '新增或修改或删除导航', '', '', 1, 1, 1383296301),
(10, 'update_menu', '更新菜单', '新增或修改或删除菜单', '', '', 1, 1, 1383296392),
(11, 'update_category', '更新分类', '新增或修改或删除分类', '', '', 1, 1, 1383296765);

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_action_log`
--

CREATE TABLE IF NOT EXISTS `jfsd_action_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `action_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '行为id',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '执行用户id',
  `action_ip` bigint(20) NOT NULL COMMENT '执行行为者ip',
  `model` varchar(50) NOT NULL DEFAULT '' COMMENT '触发行为的表',
  `record_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '触发行为的数据id',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '日志备注',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '执行行为的时间',
  PRIMARY KEY (`id`),
  KEY `action_ip_ix` (`action_ip`),
  KEY `action_id_ix` (`action_id`),
  KEY `user_id_ix` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED COMMENT='行为日志表' AUTO_INCREMENT=121 ;

--
-- 转存表中的数据 `jfsd_action_log`
--

INSERT INTO `jfsd_action_log` (`id`, `action_id`, `user_id`, `action_ip`, `model`, `record_id`, `remark`, `status`, `create_time`) VALUES
(1, 1, 1, 2130706433, 'member', 1, 'admin在2015-12-09 14:54登录了后台', 1, 1449644040),
(2, 1, 1, 2130706433, 'member', 1, 'admin在2015-12-09 15:00登录了后台', 1, 1449644433),
(3, 10, 1, 2130706433, 'Menu', 93, '操作url：/admin.php?s=/Menu/edit.html', 1, 1449654315),
(4, 10, 1, 2130706433, 'Menu', 93, '操作url：/admin.php?s=/Menu/edit.html', 1, 1449654389),
(5, 10, 1, 2130706433, 'Menu', 124, '操作url：/admin.php?s=/Menu/add.html', 1, 1449654435),
(6, 10, 1, 2130706433, 'Menu', 1, '操作url：/admin.php?s=/Menu/edit.html', 1, 1449654446),
(7, 10, 1, 2130706433, 'Menu', 43, '操作url：/admin.php?s=/Menu/edit.html', 1, 1449654530),
(8, 10, 1, 2130706433, 'Menu', 43, '操作url：/admin.php?s=/Menu/edit.html', 1, 1449654746),
(9, 10, 1, 2130706433, 'Menu', 125, '操作url：/admin.php?s=/Menu/add.html', 1, 1449662799),
(10, 10, 1, 2130706433, 'Menu', 126, '操作url：/admin.php?s=/Menu/add.html', 1, 1449662875),
(11, 10, 1, 2130706433, 'Menu', 126, '操作url：/admin.php?s=/Menu/edit.html', 1, 1449662969),
(12, 10, 1, 2130706433, 'Menu', 93, '操作url：/admin.php?s=/Menu/edit.html', 1, 1449662995),
(13, 1, 1, 2130706433, 'member', 1, 'admin在2015-12-10 11:04登录了后台', 1, 1449716672),
(14, 11, 1, 2130706433, 'category', 39, '操作url：/admin.php?s=/Category/add.html', 1, 1449717365),
(15, 10, 1, 2130706433, 'Menu', 127, '操作url：/admin.php?s=/Menu/add.html', 1, 1449717748),
(16, 10, 1, 2130706433, 'Menu', 127, '操作url：/admin.php?s=/Menu/edit.html', 1, 1449717827),
(17, 10, 1, 2130706433, 'Menu', 127, '操作url：/admin.php?s=/Menu/edit.html', 1, 1449717853),
(18, 1, 1, 2130706433, 'member', 1, 'admin在2015-12-10 12:35登录了后台', 1, 1449722128),
(19, 10, 1, 2130706433, 'Menu', 128, '操作url：/admin.php?s=/Menu/add.html', 1, 1449722369),
(20, 10, 1, 2130706433, 'Menu', 128, '操作url：/admin.php?s=/Menu/edit.html', 1, 1449722391),
(21, 10, 1, 2130706433, 'Menu', 129, '操作url：/admin.php?s=/Menu/add.html', 1, 1449722410),
(22, 10, 1, 2130706433, 'Menu', 124, '操作url：/admin.php?s=/Menu/edit.html', 1, 1449729400),
(23, 10, 1, 2130706433, 'Menu', 128, '操作url：/admin.php?s=/Menu/edit.html', 1, 1449729550),
(24, 1, 1, 2130706433, 'member', 1, 'admin在2015-12-10 14:40登录了后台', 1, 1449729634),
(25, 11, 1, 2130706433, 'category', 40, '操作url：/admin.php?s=/Category/add.html', 1, 1449730130),
(26, 11, 1, 2130706433, 'category', 41, '操作url：/admin.php?s=/Category/add.html', 1, 1449730142),
(27, 11, 1, 2130706433, 'category', 2, '操作url：/admin.php?s=/Category/edit.html', 1, 1449730166),
(28, 10, 1, 2130706433, 'Menu', 130, '操作url：/admin.php?s=/Menu/add.html', 1, 1449730504),
(29, 10, 1, 2130706433, 'Menu', 127, '操作url：/admin.php?s=/Menu/edit.html', 1, 1449731247),
(30, 11, 1, 2130706433, 'category', 4, '操作url：/admin.php?s=/ProductCate/remove/id/4.html', 1, 1449734018),
(31, 11, 1, 2130706433, 'category', 3, '操作url：/admin.php?s=/ProductCate/remove/id/3.html', 1, 1449734022),
(32, 11, 1, 2130706433, 'category', 28, '操作url：/admin.php?s=/ProductCate/remove/id/28.html', 1, 1449734438),
(33, 11, 1, 2130706433, 'category', 30, '操作url：/admin.php?s=/ProductCate/remove/id/30.html', 1, 1449736262),
(34, 11, 1, 2130706433, 'category', 29, '操作url：/admin.php?s=/ProductCate/remove/id/29.html', 1, 1449736269),
(35, 10, 1, 2130706433, 'Menu', 127, '操作url：/admin.php?s=/Menu/edit.html', 1, 1449736727),
(36, 10, 1, 2130706433, 'Menu', 128, '操作url：/admin.php?s=/Menu/edit.html', 1, 1449736748),
(37, 10, 1, 2130706433, 'Menu', 129, '操作url：/admin.php?s=/Menu/edit.html', 1, 1449736755),
(38, 10, 1, 2130706433, 'Menu', 131, '操作url：/admin.php?s=/Menu/add.html', 1, 1449736774),
(39, 10, 1, 2130706433, 'Menu', 132, '操作url：/admin.php?s=/Menu/add.html', 1, 1449737175),
(40, 10, 1, 2130706433, 'Menu', 127, '操作url：/admin.php?s=/Menu/edit.html', 1, 1449737189),
(41, 10, 1, 2130706433, 'Menu', 133, '操作url：/admin.php?s=/Menu/add.html', 1, 1449737731),
(42, 10, 1, 2130706433, 'Menu', 134, '操作url：/admin.php?s=/Menu/add.html', 1, 1449737766),
(43, 10, 1, 2130706433, 'Menu', 135, '操作url：/admin.php?s=/Menu/add.html', 1, 1449738116),
(44, 10, 1, 2130706433, 'Menu', 136, '操作url：/admin.php?s=/Menu/add.html', 1, 1449738136),
(45, 10, 1, 2130706433, 'Menu', 137, '操作url：/admin.php?s=/Menu/add.html', 1, 1449738148),
(46, 10, 1, 2130706433, 'Menu', 138, '操作url：/admin.php?s=/Menu/add.html', 1, 1449738167),
(47, 10, 1, 2130706433, 'Menu', 139, '操作url：/admin.php?s=/Menu/add.html', 1, 1449738186),
(48, 10, 1, 2130706433, 'Menu', 131, '操作url：/admin.php?s=/Menu/edit.html', 1, 1449738557),
(49, 10, 1, 2130706433, 'Menu', 134, '操作url：/admin.php?s=/Menu/edit.html', 1, 1449738577),
(50, 10, 1, 2130706433, 'Menu', 0, '操作url：/admin.php?s=/Menu/del/id/133.html', 1, 1449738611),
(51, 10, 1, 2130706433, 'Menu', 137, '操作url：/admin.php?s=/Menu/edit.html', 1, 1449738659),
(52, 10, 1, 2130706433, 'Menu', 0, '操作url：/admin.php?s=/Menu/del/id/138.html', 1, 1449738666),
(53, 10, 1, 2130706433, 'Menu', 139, '操作url：/admin.php?s=/Menu/edit.html', 1, 1449738675),
(54, 10, 1, 2130706433, 'Menu', 140, '操作url：/admin.php?s=/Menu/add.html', 1, 1449741267),
(55, 1, 1, 2130706433, 'member', 1, 'admin在2015-12-11 09:08登录了后台', 1, 1449796139),
(56, 1, 1, 2130706433, 'member', 1, 'admin在2015-12-11 09:09登录了后台', 1, 1449796197),
(57, 10, 1, 2130706433, 'Menu', 125, '操作url：/admin.php?s=/Menu/edit.html', 1, 1449802183),
(58, 10, 1, 2130706433, 'Menu', 125, '操作url：/admin.php?s=/Menu/edit.html', 1, 1449802242),
(59, 1, 2, 2130706433, 'member', 2, '吴文豹在2015-12-11 10:52登录了后台', 1, 1449802331),
(60, 1, 1, 2130706433, 'member', 1, 'admin在2015-12-11 10:55登录了后台', 1, 1449802517),
(61, 1, 2, 2130706433, 'member', 2, '吴文豹在2015-12-11 10:56登录了后台', 1, 1449802574),
(62, 1, 1, 2130706433, 'member', 1, 'admin在2015-12-11 11:39登录了后台', 1, 1449805168),
(63, 1, 2, 2130706433, 'member', 2, '吴文豹在2015-12-11 11:45登录了后台', 1, 1449805556),
(64, 1, 1, 2130706433, 'member', 1, 'admin在2015-12-11 11:46登录了后台', 1, 1449805606),
(65, 1, 2, 2130706433, 'member', 2, '吴文豹在2015-12-11 11:47登录了后台', 1, 1449805638),
(66, 1, 1, 2130706433, 'member', 1, 'admin在2015-12-11 11:50登录了后台', 1, 1449805855),
(67, 6, 1, 2130706433, 'config', 40, '操作url：/admin.php?s=/Config/edit.html', 1, 1449826400),
(68, 1, 1, 2130706433, 'member', 1, 'admin在2015-12-14 09:56登录了后台', 1, 1450058175),
(69, 1, 2, 2130706433, 'member', 2, '吴文豹在2015-12-14 10:47登录了后台', 1, 1450061234),
(70, 1, 2, 2130706433, 'member', 2, '吴文豹在2015-12-14 11:00登录了后台', 1, 1450062001),
(71, 10, 1, 2130706433, 'Menu', 141, '操作url：/admin.php?m=Admin&c=Menu&a=add', 1, 1450063330),
(72, 10, 1, 2130706433, 'Menu', 142, '操作url：/admin.php?m=Admin&c=Menu&a=add', 1, 1450063343),
(73, 1, 1, 2130706433, 'member', 1, 'admin在2015-12-14 13:44登录了后台', 1, 1450071891),
(74, 1, 1, 2130706433, 'member', 1, 'admin在2015-12-15 09:31登录了后台', 1, 1450143113),
(75, 1, 1, 2130706433, 'member', 1, 'admin在2015-12-15 13:59登录了后台', 1, 1450159145),
(76, 1, 1, 2130706433, 'member', 1, 'admin在2015-12-16 08:58登录了后台', 1, 1450227537),
(77, 1, 1, 2130706433, 'member', 1, 'admin在2015-12-17 09:15登录了后台', 1, 1450314954),
(78, 1, 1, 2130706433, 'member', 1, 'admin在2015-12-18 09:05登录了后台', 1, 1450400759),
(79, 1, 1, 2130706433, 'member', 1, 'admin在2015-12-21 10:23登录了后台', 1, 1450664607),
(80, 10, 1, 2130706433, 'Menu', 143, '操作url：/admin.php?m=Admin&c=Menu&a=add', 1, 1450669833),
(81, 10, 1, 2130706433, 'Menu', 144, '操作url：/admin.php?m=Admin&c=Menu&a=add', 1, 1450669863),
(82, 10, 1, 2130706433, 'Menu', 141, '操作url：/admin.php?m=Admin&c=Menu&a=edit', 1, 1450669882),
(83, 10, 1, 2130706433, 'Menu', 145, '操作url：/admin.php?m=Admin&c=Menu&a=add', 1, 1450669924),
(84, 1, 1, 2130706433, 'member', 1, 'admin在2015-12-22 16:18登录了后台', 1, 1450772305),
(85, 1, 1, 2130706433, 'member', 1, 'admin在2015-12-23 09:41登录了后台', 1, 1450834910),
(86, 1, 1, 2130706433, 'member', 1, 'admin在2015-12-24 14:21登录了后台', 1, 1450938086),
(87, 1, 1, 2130706433, 'member', 1, 'admin在2015-12-25 15:01登录了后台', 1, 1451026863),
(88, 1, 1, 2130706433, 'member', 1, 'admin在2015-12-28 09:39登录了后台', 1, 1451266778),
(89, 1, 1, 2130706433, 'member', 1, 'admin在2015-12-30 09:30登录了后台', 1, 1451439041),
(90, 1, 1, 2130706433, 'member', 1, 'admin在2015-12-30 22:04登录了后台', 1, 1451484284),
(91, 1, 1, 2130706433, 'member', 1, 'admin在2016-01-05 20:38登录了后台', 1, 1451997499),
(92, 1, 3, 2130706433, 'member', 3, '在2016-01-05 20:51登录了后台', 1, 1451998300),
(93, 1, 3, 2130706433, 'member', 3, '在2016-01-06 09:37登录了后台', 1, 1452044277),
(94, 1, 3, 2130706433, 'member', 3, '在2016-01-06 10:11登录了后台', 1, 1452046304),
(95, 1, 3, 2130706433, 'member', 3, '在2016-01-06 10:35登录了后台', 1, 1452047738),
(96, 1, 3, 2130706433, 'member', 3, '在2016-01-06 10:38登录了后台', 1, 1452047925),
(97, 1, 3, 2130706433, 'member', 3, '在2016-01-06 10:47登录了后台', 1, 1452048459),
(98, 1, 3, 2130706433, 'member', 3, '在2016-01-06 10:48登录了后台', 1, 1452048501),
(99, 1, 3, 2130706433, 'member', 3, '在2016-01-06 11:15登录了后台', 1, 1452050134),
(100, 1, 3, 2130706433, 'member', 3, '在2016-01-06 11:18登录了后台', 1, 1452050289),
(101, 1, 3, 2130706433, 'member', 3, '在2016-01-06 13:32登录了后台', 1, 1452058379),
(102, 1, 4, 2130706433, 'member', 4, '在2016-01-06 13:51登录了后台', 1, 1452059493),
(103, 1, 3, 2130706433, 'member', 3, '拥抱在2016-01-06 14:20登录了后台', 1, 1452061212),
(104, 1, 3, 2130706433, 'member', 3, '拥抱在2016-01-06 14:20登录了后台', 1, 1452061253),
(105, 1, 3, 2130706433, 'member', 3, '阿斯蒂芬拉丝机在2016-01-06 14:23登录了后台', 1, 1452061380),
(106, 1, 3, 2130706433, 'member', 3, '阿斯蒂芬拉丝机在2016-01-06 14:26登录了后台', 1, 1452061561),
(107, 1, 2, 2130706433, 'member', 2, '吴文豹在2016-01-06 16:26登录了后台', 1, 1452068766),
(108, 1, 1, 2130706433, 'member', 1, 'admin在2016-01-06 16:33登录了后台', 1, 1452069218),
(109, 1, 1, 2130706433, 'member', 1, 'admin在2016-01-06 16:33登录了后台', 1, 1452069235),
(110, 1, 1, 2130706433, 'member', 1, 'admin在2016-01-06 16:34登录了后台', 1, 1452069252),
(111, 1, 3, 2130706433, 'member', 3, '阿斯蒂芬拉丝机在2016-01-06 16:49登录了后台', 1, 1452070176),
(112, 1, 3, 2130706433, 'member', 3, '阿斯蒂芬拉丝机在2016-01-06 18:08登录了后台', 1, 1452074921),
(113, 1, 3, 2130706433, 'member', 3, '阿斯蒂芬拉丝机在2016-01-06 19:47登录了后台', 1, 1452080871),
(114, 1, 3, 2130706433, 'member', 3, '吴文豹在2016-01-06 19:58登录了后台', 1, 1452081492),
(115, 1, 3, 2130706433, 'member', 3, '吴文豹在2016-01-06 19:59登录了后台', 1, 1452081546),
(116, 1, 3, 2130706433, 'member', 3, '吴文豹在2016-01-06 19:59登录了后台', 1, 1452081566),
(117, 1, 3, 2130706433, 'member', 3, '吴文豹在2016-01-06 20:09登录了后台', 1, 1452082158),
(118, 1, 3, 2130706433, 'member', 3, '吴文豹在2016-01-06 20:17登录了后台', 1, 1452082643),
(119, 1, 3, 2130706433, 'member', 3, '吴文豹在2016-01-06 20:17登录了后台', 1, 1452082671),
(120, 1, 3, 2130706433, 'member', 3, '吴文豹在2016-01-07 09:17登录了后台', 1, 1452129458);

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_addons`
--

CREATE TABLE IF NOT EXISTS `jfsd_addons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL COMMENT '插件名或标识',
  `title` varchar(20) NOT NULL DEFAULT '' COMMENT '中文名',
  `description` text COMMENT '插件描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `config` text COMMENT '配置',
  `author` varchar(40) DEFAULT '' COMMENT '作者',
  `version` varchar(20) DEFAULT '' COMMENT '版本号',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '安装时间',
  `has_adminlist` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否有后台列表',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='插件表' AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `jfsd_addons`
--

INSERT INTO `jfsd_addons` (`id`, `name`, `title`, `description`, `status`, `config`, `author`, `version`, `create_time`, `has_adminlist`) VALUES
(15, 'EditorForAdmin', '后台编辑器', '用于增强整站长文本的输入和显示', 1, '{"editor_type":"2","editor_wysiwyg":"1","editor_markdownpreview":"1","editor_height":"500px","editor_resize_type":"1"}', 'thinkphp', '0.1', 1383126253, 0),
(2, 'SiteStat', '站点统计信息', '统计站点的基础信息', 1, '{"title":"\\u7cfb\\u7edf\\u4fe1\\u606f","width":"1","display":"1","status":"0"}', 'thinkphp', '0.1', 1379512015, 0),
(3, 'DevTeam', '开发团队信息', '开发团队成员信息', 1, '{"title":"OneThink\\u5f00\\u53d1\\u56e2\\u961f","width":"2","display":"1"}', 'thinkphp', '0.1', 1379512022, 0),
(4, 'SystemInfo', '系统环境信息', '用于显示一些服务器的信息', 1, '{"title":"\\u7cfb\\u7edf\\u4fe1\\u606f","width":"2","display":"1"}', 'thinkphp', '0.1', 1379512036, 0),
(5, 'Editor', '前台编辑器', '用于增强整站长文本的输入和显示', 1, '{"editor_type":"4","editor_wysiwyg":"1","editor_height":"300px","editor_resize_type":"1"}', 'thinkphp', '0.1', 1379830910, 0),
(6, 'Attachment', '附件', '用于文档模型上传附件', 1, 'null', 'thinkphp', '0.1', 1379842319, 1),
(9, 'SocialComment', '通用社交化评论', '集成了各种社交化评论插件，轻松集成到系统中。', 1, '{"comment_type":"1","comment_uid_youyan":"","comment_short_name_duoshuo":"","comment_data_list_duoshuo":""}', 'thinkphp', '0.1', 1380273962, 0);

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_attachment`
--

CREATE TABLE IF NOT EXISTS `jfsd_attachment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `title` char(30) NOT NULL DEFAULT '' COMMENT '附件显示名',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '附件类型',
  `source` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '资源ID',
  `record_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '关联记录ID',
  `download` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '下载次数',
  `size` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '附件大小',
  `dir` int(12) unsigned NOT NULL DEFAULT '0' COMMENT '上级目录ID',
  `sort` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `idx_record_status` (`record_id`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='附件表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_attribute`
--

CREATE TABLE IF NOT EXISTS `jfsd_attribute` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '字段名',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '字段注释',
  `field` varchar(100) NOT NULL DEFAULT '' COMMENT '字段定义',
  `type` varchar(20) NOT NULL DEFAULT '' COMMENT '数据类型',
  `value` varchar(100) NOT NULL DEFAULT '' COMMENT '字段默认值',
  `remark` varchar(100) NOT NULL DEFAULT '' COMMENT '备注',
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示',
  `extra` varchar(255) NOT NULL DEFAULT '' COMMENT '参数',
  `model_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '模型id',
  `is_must` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否必填',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `validate_rule` varchar(255) NOT NULL DEFAULT '',
  `validate_time` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `error_info` varchar(100) NOT NULL DEFAULT '',
  `validate_type` varchar(25) NOT NULL DEFAULT '',
  `auto_rule` varchar(100) NOT NULL DEFAULT '',
  `auto_time` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `auto_type` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `model_id` (`model_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='模型属性表' AUTO_INCREMENT=33 ;

--
-- 转存表中的数据 `jfsd_attribute`
--

INSERT INTO `jfsd_attribute` (`id`, `name`, `title`, `field`, `type`, `value`, `remark`, `is_show`, `extra`, `model_id`, `is_must`, `status`, `update_time`, `create_time`, `validate_rule`, `validate_time`, `error_info`, `validate_type`, `auto_rule`, `auto_time`, `auto_type`) VALUES
(1, 'uid', '用户ID', 'int(10) unsigned NOT NULL ', 'num', '0', '', 0, '', 1, 0, 1, 1384508362, 1383891233, '', 0, '', '', '', 0, ''),
(2, 'name', '标识', 'char(40) NOT NULL ', 'string', '', '同一根节点下标识不重复', 1, '', 1, 0, 1, 1383894743, 1383891233, '', 0, '', '', '', 0, ''),
(3, 'title', '标题', 'char(80) NOT NULL ', 'string', '', '文档标题', 1, '', 1, 0, 1, 1383894778, 1383891233, '', 0, '', '', '', 0, ''),
(4, 'category_id', '所属分类', 'int(10) unsigned NOT NULL ', 'string', '', '', 0, '', 1, 0, 1, 1384508336, 1383891233, '', 0, '', '', '', 0, ''),
(5, 'description', '描述', 'char(140) NOT NULL ', 'textarea', '', '', 1, '', 1, 0, 1, 1383894927, 1383891233, '', 0, '', '', '', 0, ''),
(6, 'root', '根节点', 'int(10) unsigned NOT NULL ', 'num', '0', '该文档的顶级文档编号', 0, '', 1, 0, 1, 1384508323, 1383891233, '', 0, '', '', '', 0, ''),
(7, 'pid', '所属ID', 'int(10) unsigned NOT NULL ', 'num', '0', '父文档编号', 0, '', 1, 0, 1, 1384508543, 1383891233, '', 0, '', '', '', 0, ''),
(8, 'model_id', '内容模型ID', 'tinyint(3) unsigned NOT NULL ', 'num', '0', '该文档所对应的模型', 0, '', 1, 0, 1, 1384508350, 1383891233, '', 0, '', '', '', 0, ''),
(9, 'type', '内容类型', 'tinyint(3) unsigned NOT NULL ', 'select', '2', '', 1, '1:目录\r\n2:主题\r\n3:段落', 1, 0, 1, 1384511157, 1383891233, '', 0, '', '', '', 0, ''),
(10, 'position', '推荐位', 'smallint(5) unsigned NOT NULL ', 'checkbox', '0', '多个推荐则将其推荐值相加', 1, '[DOCUMENT_POSITION]', 1, 0, 1, 1383895640, 1383891233, '', 0, '', '', '', 0, ''),
(11, 'link_id', '外链', 'int(10) unsigned NOT NULL ', 'num', '0', '0-非外链，大于0-外链ID,需要函数进行链接与编号的转换', 1, '', 1, 0, 1, 1383895757, 1383891233, '', 0, '', '', '', 0, ''),
(12, 'cover_id', '封面', 'int(10) unsigned NOT NULL ', 'picture', '0', '0-无封面，大于0-封面图片ID，需要函数处理', 1, '', 1, 0, 1, 1384147827, 1383891233, '', 0, '', '', '', 0, ''),
(13, 'display', '可见性', 'tinyint(3) unsigned NOT NULL ', 'radio', '1', '', 1, '0:不可见\r\n1:所有人可见', 1, 0, 1, 1386662271, 1383891233, '', 0, '', 'regex', '', 0, 'function'),
(14, 'deadline', '截至时间', 'int(10) unsigned NOT NULL ', 'datetime', '0', '0-永久有效', 1, '', 1, 0, 1, 1387163248, 1383891233, '', 0, '', 'regex', '', 0, 'function'),
(15, 'attach', '附件数量', 'tinyint(3) unsigned NOT NULL ', 'num', '0', '', 0, '', 1, 0, 1, 1387260355, 1383891233, '', 0, '', 'regex', '', 0, 'function'),
(16, 'view', '浏览量', 'int(10) unsigned NOT NULL ', 'num', '0', '', 1, '', 1, 0, 1, 1383895835, 1383891233, '', 0, '', '', '', 0, ''),
(17, 'comment', '评论数', 'int(10) unsigned NOT NULL ', 'num', '0', '', 1, '', 1, 0, 1, 1383895846, 1383891233, '', 0, '', '', '', 0, ''),
(18, 'extend', '扩展统计字段', 'int(10) unsigned NOT NULL ', 'num', '0', '根据需求自行使用', 0, '', 1, 0, 1, 1384508264, 1383891233, '', 0, '', '', '', 0, ''),
(19, 'level', '优先级', 'int(10) unsigned NOT NULL ', 'num', '0', '越高排序越靠前', 1, '', 1, 0, 1, 1383895894, 1383891233, '', 0, '', '', '', 0, ''),
(20, 'create_time', '创建时间', 'int(10) unsigned NOT NULL ', 'datetime', '0', '', 1, '', 1, 0, 1, 1383895903, 1383891233, '', 0, '', '', '', 0, ''),
(21, 'update_time', '更新时间', 'int(10) unsigned NOT NULL ', 'datetime', '0', '', 0, '', 1, 0, 1, 1384508277, 1383891233, '', 0, '', '', '', 0, ''),
(22, 'status', '数据状态', 'tinyint(4) NOT NULL ', 'radio', '0', '', 0, '-1:删除\r\n0:禁用\r\n1:正常\r\n2:待审核\r\n3:草稿', 1, 0, 1, 1384508496, 1383891233, '', 0, '', '', '', 0, ''),
(23, 'parse', '内容解析类型', 'tinyint(3) unsigned NOT NULL ', 'select', '0', '', 0, '0:html\r\n1:ubb\r\n2:markdown', 2, 0, 1, 1384511049, 1383891243, '', 0, '', '', '', 0, ''),
(24, 'content', '文章内容', 'text NOT NULL ', 'editor', '', '', 1, '', 2, 0, 1, 1383896225, 1383891243, '', 0, '', '', '', 0, ''),
(25, 'template', '详情页显示模板', 'varchar(100) NOT NULL ', 'string', '', '参照display方法参数的定义', 1, '', 2, 0, 1, 1383896190, 1383891243, '', 0, '', '', '', 0, ''),
(26, 'bookmark', '收藏数', 'int(10) unsigned NOT NULL ', 'num', '0', '', 1, '', 2, 0, 1, 1383896103, 1383891243, '', 0, '', '', '', 0, ''),
(27, 'parse', '内容解析类型', 'tinyint(3) unsigned NOT NULL ', 'select', '0', '', 0, '0:html\r\n1:ubb\r\n2:markdown', 3, 0, 1, 1387260461, 1383891252, '', 0, '', 'regex', '', 0, 'function'),
(28, 'content', '下载详细描述', 'text NOT NULL ', 'editor', '', '', 1, '', 3, 0, 1, 1383896438, 1383891252, '', 0, '', '', '', 0, ''),
(29, 'template', '详情页显示模板', 'varchar(100) NOT NULL ', 'string', '', '', 1, '', 3, 0, 1, 1383896429, 1383891252, '', 0, '', '', '', 0, ''),
(30, 'file_id', '文件ID', 'int(10) unsigned NOT NULL ', 'file', '0', '需要函数处理', 1, '', 3, 0, 1, 1383896415, 1383891252, '', 0, '', '', '', 0, ''),
(31, 'download', '下载次数', 'int(10) unsigned NOT NULL ', 'num', '0', '', 1, '', 3, 0, 1, 1383896380, 1383891252, '', 0, '', '', '', 0, ''),
(32, 'size', '文件大小', 'bigint(20) unsigned NOT NULL ', 'num', '0', '单位bit', 1, '', 3, 0, 1, 1383896371, 1383891252, '', 0, '', '', '', 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_auth_extend`
--

CREATE TABLE IF NOT EXISTS `jfsd_auth_extend` (
  `group_id` mediumint(10) unsigned NOT NULL COMMENT '用户id',
  `extend_id` mediumint(8) unsigned NOT NULL COMMENT '扩展表中数据的id',
  `type` tinyint(1) unsigned NOT NULL COMMENT '扩展类型标识 1:栏目分类权限;2:模型权限;3:分站权限;',
  UNIQUE KEY `group_extend_type` (`group_id`,`extend_id`,`type`),
  KEY `uid` (`group_id`),
  KEY `group_id` (`extend_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组与分类的对应关系表';

--
-- 转存表中的数据 `jfsd_auth_extend`
--

INSERT INTO `jfsd_auth_extend` (`group_id`, `extend_id`, `type`) VALUES
(1, 1, 2),
(1, 1, 3),
(1, 2, 2),
(1, 2, 3),
(1, 3, 2),
(1, 3, 3),
(1, 4, 3),
(2, 1, 3),
(2, 2, 3),
(3, 2, 3),
(4, 3, 3);

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_auth_group`
--

CREATE TABLE IF NOT EXISTS `jfsd_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户组id,自增主键',
  `module` varchar(20) NOT NULL DEFAULT '' COMMENT '用户组所属模块',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '组类型',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '用户组中文名称',
  `description` varchar(80) NOT NULL DEFAULT '' COMMENT '描述信息',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户组状态：为1正常，为0禁用,-1为删除',
  `rules` varchar(500) NOT NULL DEFAULT '' COMMENT '用户组拥有的规则id，多个规则 , 隔开',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `jfsd_auth_group`
--

INSERT INTO `jfsd_auth_group` (`id`, `module`, `type`, `title`, `description`, `status`, `rules`) VALUES
(1, 'admin', 1, '管理员', '', 1, '1,2,3,4,5,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,79,80,81,82,83,84,86,87,88,89,90,91,92,93,94,95,100,102,103,107,108,109,110,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,221,222,226,228,229'),
(2, 'admin', 1, '北京', '', 1, '1,219,221,222,226,230'),
(3, 'admin', 1, '上海', '', 1, ''),
(4, 'admin', 1, '广州', '', 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_auth_group_access`
--

CREATE TABLE IF NOT EXISTS `jfsd_auth_group_access` (
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `group_id` mediumint(8) unsigned NOT NULL COMMENT '用户组id',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `jfsd_auth_group_access`
--

INSERT INTO `jfsd_auth_group_access` (`uid`, `group_id`) VALUES
(2, 2);

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_auth_rule`
--

CREATE TABLE IF NOT EXISTS `jfsd_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '规则id,自增主键',
  `module` varchar(20) NOT NULL COMMENT '规则所属module',
  `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1-url;2-主菜单',
  `name` char(80) NOT NULL DEFAULT '' COMMENT '规则唯一英文标识',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '规则中文描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否有效(0:无效,1:有效)',
  `condition` varchar(300) NOT NULL DEFAULT '' COMMENT '规则附加条件',
  PRIMARY KEY (`id`),
  KEY `module` (`module`,`status`,`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=241 ;

--
-- 转存表中的数据 `jfsd_auth_rule`
--

INSERT INTO `jfsd_auth_rule` (`id`, `module`, `type`, `name`, `title`, `status`, `condition`) VALUES
(1, 'admin', 2, 'Admin/Index/index', '首页', 1, ''),
(2, 'admin', 2, 'Admin/Article/index', '内容', 1, ''),
(3, 'admin', 2, 'Admin/User/index', '用户', 1, ''),
(4, 'admin', 2, 'Admin/Addons/index', '扩展', 1, ''),
(5, 'admin', 2, 'Admin/Config/group', '系统', 1, ''),
(7, 'admin', 1, 'Admin/article/add', '新增', 1, ''),
(8, 'admin', 1, 'Admin/article/edit', '编辑', 1, ''),
(9, 'admin', 1, 'Admin/article/setStatus', '改变状态', 1, ''),
(10, 'admin', 1, 'Admin/article/update', '保存', 1, ''),
(11, 'admin', 1, 'Admin/article/autoSave', '保存草稿', 1, ''),
(12, 'admin', 1, 'Admin/article/move', '移动', 1, ''),
(13, 'admin', 1, 'Admin/article/copy', '复制', 1, ''),
(14, 'admin', 1, 'Admin/article/paste', '粘贴', 1, ''),
(15, 'admin', 1, 'Admin/article/permit', '还原', 1, ''),
(16, 'admin', 1, 'Admin/article/clear', '清空', 1, ''),
(17, 'admin', 1, 'Admin/Article/examine', '审核列表', 1, ''),
(18, 'admin', 1, 'Admin/article/recycle', '回收站', 1, ''),
(19, 'admin', 1, 'Admin/User/addaction', '新增用户行为', 1, ''),
(20, 'admin', 1, 'Admin/User/editaction', '编辑用户行为', 1, ''),
(21, 'admin', 1, 'Admin/User/saveAction', '保存用户行为', 1, ''),
(22, 'admin', 1, 'Admin/User/setStatus', '变更行为状态', 1, ''),
(23, 'admin', 1, 'Admin/User/changeStatus?method=forbidUser', '禁用会员', 1, ''),
(24, 'admin', 1, 'Admin/User/changeStatus?method=resumeUser', '启用会员', 1, ''),
(25, 'admin', 1, 'Admin/User/changeStatus?method=deleteUser', '删除会员', 1, ''),
(26, 'admin', 1, 'Admin/User/index', '用户信息', 1, ''),
(27, 'admin', 1, 'Admin/User/action', '用户行为', 1, ''),
(28, 'admin', 1, 'Admin/AuthManager/changeStatus?method=deleteGroup', '删除', 1, ''),
(29, 'admin', 1, 'Admin/AuthManager/changeStatus?method=forbidGroup', '禁用', 1, ''),
(30, 'admin', 1, 'Admin/AuthManager/changeStatus?method=resumeGroup', '恢复', 1, ''),
(31, 'admin', 1, 'Admin/AuthManager/createGroup', '新增', 1, ''),
(32, 'admin', 1, 'Admin/AuthManager/editGroup', '编辑', 1, ''),
(33, 'admin', 1, 'Admin/AuthManager/writeGroup', '保存用户组', 1, ''),
(34, 'admin', 1, 'Admin/AuthManager/group', '授权', 1, ''),
(35, 'admin', 1, 'Admin/AuthManager/access', '访问授权', 1, ''),
(36, 'admin', 1, 'Admin/AuthManager/user', '成员授权', 1, ''),
(37, 'admin', 1, 'Admin/AuthManager/removeFromGroup', '解除授权', 1, ''),
(38, 'admin', 1, 'Admin/AuthManager/addToGroup', '保存成员授权', 1, ''),
(39, 'admin', 1, 'Admin/AuthManager/category', '分类授权', 1, ''),
(40, 'admin', 1, 'Admin/AuthManager/addToCategory', '保存分类授权', 1, ''),
(41, 'admin', 1, 'Admin/AuthManager/index', '权限管理', 1, ''),
(42, 'admin', 1, 'Admin/Addons/create', '创建', 1, ''),
(43, 'admin', 1, 'Admin/Addons/checkForm', '检测创建', 1, ''),
(44, 'admin', 1, 'Admin/Addons/preview', '预览', 1, ''),
(45, 'admin', 1, 'Admin/Addons/build', '快速生成插件', 1, ''),
(46, 'admin', 1, 'Admin/Addons/config', '设置', 1, ''),
(47, 'admin', 1, 'Admin/Addons/disable', '禁用', 1, ''),
(48, 'admin', 1, 'Admin/Addons/enable', '启用', 1, ''),
(49, 'admin', 1, 'Admin/Addons/install', '安装', 1, ''),
(50, 'admin', 1, 'Admin/Addons/uninstall', '卸载', 1, ''),
(51, 'admin', 1, 'Admin/Addons/saveconfig', '更新配置', 1, ''),
(52, 'admin', 1, 'Admin/Addons/adminList', '插件后台列表', 1, ''),
(53, 'admin', 1, 'Admin/Addons/execute', 'URL方式访问插件', 1, ''),
(54, 'admin', 1, 'Admin/Addons/index', '插件管理', 1, ''),
(55, 'admin', 1, 'Admin/Addons/hooks', '钩子管理', 1, ''),
(56, 'admin', 1, 'Admin/model/add', '新增', 1, ''),
(57, 'admin', 1, 'Admin/model/edit', '编辑', 1, ''),
(58, 'admin', 1, 'Admin/model/setStatus', '改变状态', 1, ''),
(59, 'admin', 1, 'Admin/model/update', '保存数据', 1, ''),
(60, 'admin', 1, 'Admin/Model/index', '模型管理', 1, ''),
(61, 'admin', 1, 'Admin/Config/edit', '编辑', 1, ''),
(62, 'admin', 1, 'Admin/Config/del', '删除', 1, ''),
(63, 'admin', 1, 'Admin/Config/add', '新增', 1, ''),
(64, 'admin', 1, 'Admin/Config/save', '保存', 1, ''),
(65, 'admin', 1, 'Admin/Config/group', '网站设置', 1, ''),
(66, 'admin', 1, 'Admin/Config/index', '配置管理', 1, ''),
(67, 'admin', 1, 'Admin/Channel/add', '新增', 1, ''),
(68, 'admin', 1, 'Admin/Channel/edit', '编辑', 1, ''),
(69, 'admin', 1, 'Admin/Channel/del', '删除', 1, ''),
(70, 'admin', 1, 'Admin/Channel/index', '导航管理', 1, ''),
(71, 'admin', 1, 'Admin/Category/edit', '编辑', 1, ''),
(72, 'admin', 1, 'Admin/Category/add', '新增', 1, ''),
(73, 'admin', 1, 'Admin/Category/remove', '删除', 1, ''),
(74, 'admin', 1, 'Admin/Category/index', '分类管理', 1, ''),
(75, 'admin', 1, 'Admin/file/upload', '上传控件', -1, ''),
(76, 'admin', 1, 'Admin/file/uploadPicture', '上传图片', -1, ''),
(77, 'admin', 1, 'Admin/file/download', '下载', -1, ''),
(94, 'admin', 1, 'Admin/AuthManager/modelauth', '模型授权', 1, ''),
(79, 'admin', 1, 'Admin/article/batchOperate', '导入', 1, ''),
(80, 'admin', 1, 'Admin/Database/index?type=export', '备份数据库', 1, ''),
(81, 'admin', 1, 'Admin/Database/index?type=import', '还原数据库', 1, ''),
(82, 'admin', 1, 'Admin/Database/export', '备份', 1, ''),
(83, 'admin', 1, 'Admin/Database/optimize', '优化表', 1, ''),
(84, 'admin', 1, 'Admin/Database/repair', '修复表', 1, ''),
(86, 'admin', 1, 'Admin/Database/import', '恢复', 1, ''),
(87, 'admin', 1, 'Admin/Database/del', '删除', 1, ''),
(88, 'admin', 1, 'Admin/User/add', '新增用户', 1, ''),
(89, 'admin', 1, 'Admin/Attribute/index', '属性管理', 1, ''),
(90, 'admin', 1, 'Admin/Attribute/add', '新增', 1, ''),
(91, 'admin', 1, 'Admin/Attribute/edit', '编辑', 1, ''),
(92, 'admin', 1, 'Admin/Attribute/setStatus', '改变状态', 1, ''),
(93, 'admin', 1, 'Admin/Attribute/update', '保存数据', 1, ''),
(95, 'admin', 1, 'Admin/AuthManager/addToModel', '保存模型授权', 1, ''),
(96, 'admin', 1, 'Admin/Category/move', '移动', -1, ''),
(97, 'admin', 1, 'Admin/Category/merge', '合并', -1, ''),
(98, 'admin', 1, 'Admin/Config/menu', '后台菜单管理', -1, ''),
(99, 'admin', 1, 'Admin/Article/mydocument', '内容', -1, ''),
(100, 'admin', 1, 'Admin/Menu/index', '菜单管理', 1, ''),
(101, 'admin', 1, 'Admin/other', '其他', -1, ''),
(102, 'admin', 1, 'Admin/Menu/add', '新增', 1, ''),
(103, 'admin', 1, 'Admin/Menu/edit', '编辑', 1, ''),
(104, 'admin', 1, 'Admin/Think/lists?model=article', '文章管理', -1, ''),
(105, 'admin', 1, 'Admin/Think/lists?model=download', '下载管理', -1, ''),
(106, 'admin', 1, 'Admin/Think/lists?model=config', '配置管理', -1, ''),
(107, 'admin', 1, 'Admin/Action/actionlog', '行为日志', 1, ''),
(108, 'admin', 1, 'Admin/User/updatePassword', '修改密码', 1, ''),
(109, 'admin', 1, 'Admin/User/updateNickname', '修改昵称', 1, ''),
(110, 'admin', 1, 'Admin/action/edit', '查看行为日志', 1, ''),
(205, 'admin', 1, 'Admin/think/add', '新增数据', 1, ''),
(111, 'admin', 2, 'Admin/article/index', '文档列表', -1, ''),
(112, 'admin', 2, 'Admin/article/add', '新增', -1, ''),
(113, 'admin', 2, 'Admin/article/edit', '编辑', -1, ''),
(114, 'admin', 2, 'Admin/article/setStatus', '改变状态', -1, ''),
(115, 'admin', 2, 'Admin/article/update', '保存', -1, ''),
(116, 'admin', 2, 'Admin/article/autoSave', '保存草稿', -1, ''),
(117, 'admin', 2, 'Admin/article/move', '移动', -1, ''),
(118, 'admin', 2, 'Admin/article/copy', '复制', -1, ''),
(119, 'admin', 2, 'Admin/article/paste', '粘贴', -1, ''),
(120, 'admin', 2, 'Admin/article/batchOperate', '导入', -1, ''),
(121, 'admin', 2, 'Admin/article/recycle', '回收站', -1, ''),
(122, 'admin', 2, 'Admin/article/permit', '还原', -1, ''),
(123, 'admin', 2, 'Admin/article/clear', '清空', -1, ''),
(124, 'admin', 2, 'Admin/User/add', '新增用户', -1, ''),
(125, 'admin', 2, 'Admin/User/action', '用户行为', -1, ''),
(126, 'admin', 2, 'Admin/User/addAction', '新增用户行为', -1, ''),
(127, 'admin', 2, 'Admin/User/editAction', '编辑用户行为', -1, ''),
(128, 'admin', 2, 'Admin/User/saveAction', '保存用户行为', -1, ''),
(129, 'admin', 2, 'Admin/User/setStatus', '变更行为状态', -1, ''),
(130, 'admin', 2, 'Admin/User/changeStatus?method=forbidUser', '禁用会员', -1, ''),
(131, 'admin', 2, 'Admin/User/changeStatus?method=resumeUser', '启用会员', -1, ''),
(132, 'admin', 2, 'Admin/User/changeStatus?method=deleteUser', '删除会员', -1, ''),
(133, 'admin', 2, 'Admin/AuthManager/index', '权限管理', -1, ''),
(134, 'admin', 2, 'Admin/AuthManager/changeStatus?method=deleteGroup', '删除', -1, ''),
(135, 'admin', 2, 'Admin/AuthManager/changeStatus?method=forbidGroup', '禁用', -1, ''),
(136, 'admin', 2, 'Admin/AuthManager/changeStatus?method=resumeGroup', '恢复', -1, ''),
(137, 'admin', 2, 'Admin/AuthManager/createGroup', '新增', -1, ''),
(138, 'admin', 2, 'Admin/AuthManager/editGroup', '编辑', -1, ''),
(139, 'admin', 2, 'Admin/AuthManager/writeGroup', '保存用户组', -1, ''),
(140, 'admin', 2, 'Admin/AuthManager/group', '授权', -1, ''),
(141, 'admin', 2, 'Admin/AuthManager/access', '访问授权', -1, ''),
(142, 'admin', 2, 'Admin/AuthManager/user', '成员授权', -1, ''),
(143, 'admin', 2, 'Admin/AuthManager/removeFromGroup', '解除授权', -1, ''),
(144, 'admin', 2, 'Admin/AuthManager/addToGroup', '保存成员授权', -1, ''),
(145, 'admin', 2, 'Admin/AuthManager/category', '分类授权', -1, ''),
(146, 'admin', 2, 'Admin/AuthManager/addToCategory', '保存分类授权', -1, ''),
(147, 'admin', 2, 'Admin/AuthManager/modelauth', '模型授权', -1, ''),
(148, 'admin', 2, 'Admin/AuthManager/addToModel', '保存模型授权', -1, ''),
(149, 'admin', 2, 'Admin/Addons/create', '创建', -1, ''),
(150, 'admin', 2, 'Admin/Addons/checkForm', '检测创建', -1, ''),
(151, 'admin', 2, 'Admin/Addons/preview', '预览', -1, ''),
(152, 'admin', 2, 'Admin/Addons/build', '快速生成插件', -1, ''),
(153, 'admin', 2, 'Admin/Addons/config', '设置', -1, ''),
(154, 'admin', 2, 'Admin/Addons/disable', '禁用', -1, ''),
(155, 'admin', 2, 'Admin/Addons/enable', '启用', -1, ''),
(156, 'admin', 2, 'Admin/Addons/install', '安装', -1, ''),
(157, 'admin', 2, 'Admin/Addons/uninstall', '卸载', -1, ''),
(158, 'admin', 2, 'Admin/Addons/saveconfig', '更新配置', -1, ''),
(159, 'admin', 2, 'Admin/Addons/adminList', '插件后台列表', -1, ''),
(160, 'admin', 2, 'Admin/Addons/execute', 'URL方式访问插件', -1, ''),
(161, 'admin', 2, 'Admin/Addons/hooks', '钩子管理', -1, ''),
(162, 'admin', 2, 'Admin/Model/index', '模型管理', -1, ''),
(163, 'admin', 2, 'Admin/model/add', '新增', -1, ''),
(164, 'admin', 2, 'Admin/model/edit', '编辑', -1, ''),
(165, 'admin', 2, 'Admin/model/setStatus', '改变状态', -1, ''),
(166, 'admin', 2, 'Admin/model/update', '保存数据', -1, ''),
(167, 'admin', 2, 'Admin/Attribute/index', '属性管理', -1, ''),
(168, 'admin', 2, 'Admin/Attribute/add', '新增', -1, ''),
(169, 'admin', 2, 'Admin/Attribute/edit', '编辑', -1, ''),
(170, 'admin', 2, 'Admin/Attribute/setStatus', '改变状态', -1, ''),
(171, 'admin', 2, 'Admin/Attribute/update', '保存数据', -1, ''),
(172, 'admin', 2, 'Admin/Config/index', '配置管理', -1, ''),
(173, 'admin', 2, 'Admin/Config/edit', '编辑', -1, ''),
(174, 'admin', 2, 'Admin/Config/del', '删除', -1, ''),
(175, 'admin', 2, 'Admin/Config/add', '新增', -1, ''),
(176, 'admin', 2, 'Admin/Config/save', '保存', -1, ''),
(177, 'admin', 2, 'Admin/Menu/index', '菜单管理', -1, ''),
(178, 'admin', 2, 'Admin/Channel/index', '导航管理', -1, ''),
(179, 'admin', 2, 'Admin/Channel/add', '新增', -1, ''),
(180, 'admin', 2, 'Admin/Channel/edit', '编辑', -1, ''),
(181, 'admin', 2, 'Admin/Channel/del', '删除', -1, ''),
(182, 'admin', 2, 'Admin/Category/index', '分类管理', -1, ''),
(183, 'admin', 2, 'Admin/Category/edit', '编辑', -1, ''),
(184, 'admin', 2, 'Admin/Category/add', '新增', -1, ''),
(185, 'admin', 2, 'Admin/Category/remove', '删除', -1, ''),
(186, 'admin', 2, 'Admin/Category/move', '移动', -1, ''),
(187, 'admin', 2, 'Admin/Category/merge', '合并', -1, ''),
(188, 'admin', 2, 'Admin/Database/index?type=export', '备份数据库', -1, ''),
(189, 'admin', 2, 'Admin/Database/export', '备份', -1, ''),
(190, 'admin', 2, 'Admin/Database/optimize', '优化表', -1, ''),
(191, 'admin', 2, 'Admin/Database/repair', '修复表', -1, ''),
(192, 'admin', 2, 'Admin/Database/index?type=import', '还原数据库', -1, ''),
(193, 'admin', 2, 'Admin/Database/import', '恢复', -1, ''),
(194, 'admin', 2, 'Admin/Database/del', '删除', -1, ''),
(195, 'admin', 2, 'Admin/other', '其他', -1, ''),
(196, 'admin', 2, 'Admin/Menu/add', '新增', -1, ''),
(197, 'admin', 2, 'Admin/Menu/edit', '编辑', -1, ''),
(198, 'admin', 2, 'Admin/Think/lists?model=article', '应用', -1, ''),
(199, 'admin', 2, 'Admin/Think/lists?model=download', '下载管理', -1, ''),
(200, 'admin', 2, 'Admin/Think/lists?model=config', '应用', -1, ''),
(201, 'admin', 2, 'Admin/Action/actionlog', '行为日志', -1, ''),
(202, 'admin', 2, 'Admin/User/updatePassword', '修改密码', -1, ''),
(203, 'admin', 2, 'Admin/User/updateNickname', '修改昵称', -1, ''),
(204, 'admin', 2, 'Admin/action/edit', '查看行为日志', -1, ''),
(206, 'admin', 1, 'Admin/think/edit', '编辑数据', 1, ''),
(207, 'admin', 1, 'Admin/Menu/import', '导入', 1, ''),
(208, 'admin', 1, 'Admin/Model/generate', '生成', 1, ''),
(209, 'admin', 1, 'Admin/Addons/addHook', '新增钩子', 1, ''),
(210, 'admin', 1, 'Admin/Addons/edithook', '编辑钩子', 1, ''),
(211, 'admin', 1, 'Admin/Article/sort', '文档排序', 1, ''),
(212, 'admin', 1, 'Admin/Config/sort', '排序', 1, ''),
(213, 'admin', 1, 'Admin/Menu/sort', '排序', 1, ''),
(214, 'admin', 1, 'Admin/Channel/sort', '排序', 1, ''),
(215, 'admin', 1, 'Admin/Category/operate/type/move', '移动', 1, ''),
(216, 'admin', 1, 'Admin/Category/operate/type/merge', '合并', 1, ''),
(217, 'admin', 1, 'Admin/article/index', '文档列表', 1, ''),
(218, 'admin', 1, 'Admin/think/lists', '数据列表', 1, ''),
(219, 'admin', 2, 'Admin/Line/index', '产品', 1, ''),
(220, 'admin', 2, 'Admin/Order', '交易', -1, ''),
(221, 'admin', 1, 'Admin/Line/index', '旅游线路', 1, ''),
(222, 'admin', 1, 'Admin/Visa/index', '签证线路', 1, ''),
(223, 'admin', 1, 'Admin/ProductCate/index', '产品分类', -1, ''),
(224, 'admin', 1, 'Admin/ProudctCate/add', '新增', -1, ''),
(225, 'admin', 1, 'Admin/ProudctCate/edit', '更新', -1, ''),
(226, 'admin', 2, 'Admin/Order/index', '交易', 1, ''),
(227, 'admin', 1, 'Admin/LineCate/index', '线路分类', 1, ''),
(228, 'admin', 1, 'Admin/LineCate/add', '新增', 1, ''),
(229, 'admin', 1, 'Admin/LineCate/edit', '更新', 1, ''),
(230, 'admin', 1, 'Admin/Order/index', '订单管理', 1, ''),
(231, 'admin', 1, 'Admin/LineCate/remove', '删除', 1, ''),
(232, 'admin', 1, 'Admin/VisaCate/index', '签证分类', 1, ''),
(233, 'admin', 1, 'Admin/LineCate/operate/type/move', '移动', 1, ''),
(234, 'admin', 1, 'Admin/VisaCate/add', '新增', 1, ''),
(235, 'admin', 1, 'Admin/VisaCate/edit', '更新', 1, ''),
(236, 'admin', 1, 'Admin/VisaCate/remove', '删除', 1, ''),
(237, 'admin', 1, 'Admin/VisaCate/operate/type/move', '移动', 1, ''),
(238, 'admin', 1, 'Admin/AuthManager/site', '站点授权', 1, ''),
(239, 'admin', 1, 'Admin/Line/edit', '修改', 1, ''),
(240, 'admin', 1, 'Admin/Line/add', '添加', 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_category`
--

CREATE TABLE IF NOT EXISTS `jfsd_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `name` varchar(30) NOT NULL COMMENT '标志',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `list_row` tinyint(3) unsigned NOT NULL DEFAULT '10' COMMENT '列表每页行数',
  `meta_title` varchar(50) NOT NULL DEFAULT '' COMMENT 'SEO的网页标题',
  `keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `template_index` varchar(100) NOT NULL DEFAULT '' COMMENT '频道页模板',
  `template_lists` varchar(100) NOT NULL DEFAULT '' COMMENT '列表页模板',
  `template_detail` varchar(100) NOT NULL DEFAULT '' COMMENT '详情页模板',
  `template_edit` varchar(100) NOT NULL DEFAULT '' COMMENT '编辑页模板',
  `model` varchar(100) NOT NULL DEFAULT '' COMMENT '列表绑定模型',
  `model_sub` varchar(100) NOT NULL DEFAULT '' COMMENT '子文档绑定模型',
  `type` varchar(100) NOT NULL DEFAULT '' COMMENT '允许发布的内容类型',
  `link_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '外链',
  `allow_publish` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许发布内容',
  `display` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '可见性',
  `reply` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许回复',
  `check` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '发布的文章是否需要审核',
  `reply_model` varchar(100) NOT NULL DEFAULT '',
  `extend` text COMMENT '扩展设置',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '数据状态',
  `icon` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分类图标',
  `groups` varchar(255) NOT NULL DEFAULT '' COMMENT '分组定义',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`name`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='分类表' AUTO_INCREMENT=42 ;

--
-- 转存表中的数据 `jfsd_category`
--

INSERT INTO `jfsd_category` (`id`, `name`, `title`, `pid`, `sort`, `list_row`, `meta_title`, `keywords`, `description`, `template_index`, `template_lists`, `template_detail`, `template_edit`, `model`, `model_sub`, `type`, `link_id`, `allow_publish`, `display`, `reply`, `check`, `reply_model`, `extend`, `create_time`, `update_time`, `status`, `icon`, `groups`) VALUES
(1, 'blog', '博客', 0, 0, 10, '', '', '', '', '', '', '', '2,3', '2', '2,1', 0, 0, 1, 0, 0, '1', '', 1379474947, 1382701539, 1, 0, ''),
(2, 'default_blog', '默认分类', 1, 0, 10, '', '', '', '', '', '', '', '2,3', '2', '2,1,3', 0, 1, 1, 0, 1, '1', '', 1379475028, 1449730166, 1, 0, ''),
(39, 'TOPC', '留言主题', 2, 0, 10, '', '', '', '', '', '', '', '', '', '', 0, 1, 1, 0, 0, '', NULL, 1449717365, 1449717365, 1, 0, ''),
(40, 'Criterion', '留言主题', 0, 0, 10, '', '', '', '', '', '', '', '', '', '', 0, 1, 1, 0, 0, '', NULL, 1449730130, 1449730130, 1, 0, ''),
(41, 'TOPC1', '阿萨德法撒旦', 39, 0, 10, '', '', '', '', '', '', '', '', '', '', 0, 1, 1, 0, 0, '', NULL, 1449730142, 1449730142, 1, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_channel`
--

CREATE TABLE IF NOT EXISTS `jfsd_channel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '频道ID',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级频道ID',
  `title` char(30) NOT NULL COMMENT '频道标题',
  `url` char(100) NOT NULL COMMENT '频道连接',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '导航排序',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `target` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '新窗口打开',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `jfsd_channel`
--

INSERT INTO `jfsd_channel` (`id`, `pid`, `title`, `url`, `sort`, `create_time`, `update_time`, `status`, `target`) VALUES
(1, 0, '首页', 'Index/index', 1, 1379475111, 1379923177, 1, 0),
(2, 0, '博客', 'Article/index?category=blog', 2, 1379475131, 1379483713, 1, 0),
(3, 0, '官网', 'http://www.onethink.cn', 3, 1379475154, 1387163458, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_config`
--

CREATE TABLE IF NOT EXISTS `jfsd_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '配置名称',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置类型',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '配置说明',
  `group` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置分组',
  `extra` varchar(255) NOT NULL DEFAULT '' COMMENT '配置值',
  `remark` varchar(100) NOT NULL DEFAULT '' COMMENT '配置说明',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `value` text COMMENT '配置值',
  `sort` smallint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`name`),
  KEY `type` (`type`),
  KEY `group` (`group`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- 转存表中的数据 `jfsd_config`
--

INSERT INTO `jfsd_config` (`id`, `name`, `type`, `title`, `group`, `extra`, `remark`, `create_time`, `update_time`, `status`, `value`, `sort`) VALUES
(1, 'WEB_SITE_TITLE', 1, '网站标题', 1, '', '网站标题前台显示标题', 1378898976, 1379235274, 1, '游尾会旅游管理系统', 0),
(2, 'WEB_SITE_DESCRIPTION', 2, '网站描述', 1, '', '网站搜索引擎描述', 1378898976, 1379235841, 1, '游尾会旅游管理系统', 1),
(3, 'WEB_SITE_KEYWORD', 2, '网站关键字', 1, '', '网站搜索引擎关键字', 1378898976, 1381390100, 1, '游尾会旅游管理系统', 8),
(4, 'WEB_SITE_CLOSE', 4, '关闭站点', 1, '0:关闭,1:开启', '站点关闭后其他用户不能访问，管理员可以正常访问', 1378898976, 1379235296, 1, '1', 1),
(9, 'CONFIG_TYPE_LIST', 3, '配置类型列表', 4, '', '主要用于数据解析和页面表单的生成', 1378898976, 1379235348, 1, '0:数字\r\n1:字符\r\n2:文本\r\n3:数组\r\n4:枚举', 2),
(10, 'WEB_SITE_ICP', 1, '网站备案号', 1, '', '设置在网站底部显示的备案号，如“沪ICP备12007941号-2', 1378900335, 1379235859, 1, '', 9),
(11, 'DOCUMENT_POSITION', 3, '文档推荐位', 2, '', '文档推荐位，推荐到多个位置KEY值相加即可', 1379053380, 1379235329, 1, '1:列表推荐\r\n2:频道推荐\r\n4:首页推荐', 3),
(12, 'DOCUMENT_DISPLAY', 3, '文档可见性', 2, '', '文章可见性仅影响前台显示，后台不收影响', 1379056370, 1379235322, 1, '0:所有人可见\r\n1:仅注册会员可见\r\n2:仅管理员可见', 4),
(13, 'COLOR_STYLE', 4, '后台色系', 1, 'default_color:默认\r\nblue_color:紫罗兰', '后台颜色风格', 1379122533, 1379235904, 1, 'default_color', 10),
(20, 'CONFIG_GROUP_LIST', 3, '配置分组', 4, '', '配置分组', 1379228036, 1384418383, 1, '1:基本\r\n2:内容\r\n3:旅游\r\n4:系统', 4),
(21, 'HOOKS_TYPE', 3, '钩子的类型', 4, '', '类型 1-用于扩展显示内容，2-用于扩展业务处理', 1379313397, 1379313407, 1, '1:视图\r\n2:控制器', 6),
(22, 'AUTH_CONFIG', 3, 'Auth配置', 4, '', '自定义Auth.class.php类配置', 1379409310, 1379409564, 1, 'AUTH_ON:1\r\nAUTH_TYPE:2', 8),
(23, 'OPEN_DRAFTBOX', 4, '是否开启草稿功能', 2, '0:关闭草稿功能\r\n1:开启草稿功能\r\n', '新增文章时的草稿功能配置', 1379484332, 1379484591, 1, '1', 1),
(24, 'DRAFT_AOTOSAVE_INTERVAL', 0, '自动保存草稿时间', 2, '', '自动保存草稿的时间间隔，单位：秒', 1379484574, 1386143323, 1, '60', 2),
(25, 'LIST_ROWS', 0, '后台每页记录数', 2, '', '后台数据每页显示记录数', 1379503896, 1380427745, 1, '10', 10),
(26, 'USER_ALLOW_REGISTER', 4, '是否允许用户注册', 3, '0:关闭注册\r\n1:允许注册', '是否开放用户注册', 1379504487, 1379504580, 1, '1', 3),
(27, 'CODEMIRROR_THEME', 4, '预览插件的CodeMirror主题', 4, '3024-day:3024 day\r\n3024-night:3024 night\r\nambiance:ambiance\r\nbase16-dark:base16 dark\r\nbase16-light:base16 light\r\nblackboard:blackboard\r\ncobalt:cobalt\r\neclipse:eclipse\r\nelegant:elegant\r\nerlang-dark:erlang-dark\r\nlesser-dark:lesser-dark\r\nmidnight:midnight', '详情见CodeMirror官网', 1379814385, 1384740813, 1, 'ambiance', 3),
(28, 'DATA_BACKUP_PATH', 1, '数据库备份根路径', 4, '', '路径必须以 / 结尾', 1381482411, 1381482411, 1, './Data/', 5),
(29, 'DATA_BACKUP_PART_SIZE', 0, '数据库备份卷大小', 4, '', '该值用于限制压缩后的分卷最大长度。单位：B；建议设置20M', 1381482488, 1381729564, 1, '20971520', 7),
(30, 'DATA_BACKUP_COMPRESS', 4, '数据库备份文件是否启用压缩', 4, '0:不压缩\r\n1:启用压缩', '压缩备份文件需要PHP环境支持gzopen,gzwrite函数', 1381713345, 1381729544, 1, '1', 9),
(31, 'DATA_BACKUP_COMPRESS_LEVEL', 4, '数据库备份文件压缩级别', 4, '1:普通\r\n4:一般\r\n9:最高', '数据库备份文件的压缩级别，该配置在开启压缩时生效', 1381713408, 1381713408, 1, '9', 10),
(32, 'DEVELOP_MODE', 4, '开启开发者模式', 4, '0:关闭\r\n1:开启', '是否开启开发者模式', 1383105995, 1383291877, 1, '1', 11),
(33, 'ALLOW_VISIT', 3, '不受限控制器方法', 0, '', '', 1386644047, 1386644741, 1, '0:article/draftbox\r\n1:article/mydocument\r\n2:Category/tree\r\n3:Index/verify\r\n4:file/upload\r\n5:file/download\r\n6:user/updatePassword\r\n7:user/updateNickname\r\n8:user/submitPassword\r\n9:user/submitNickname\r\n10:file/uploadpicture', 0),
(34, 'DENY_VISIT', 3, '超管专限控制器方法', 0, '', '仅超级管理员可访问的控制器方法', 1386644141, 1386644659, 1, '0:Addons/addhook\r\n1:Addons/edithook\r\n2:Addons/delhook\r\n3:Addons/updateHook\r\n4:Admin/getMenus\r\n5:Admin/recordList\r\n6:AuthManager/updateRules\r\n7:AuthManager/tree', 0),
(35, 'REPLY_LIST_ROWS', 0, '回复列表每页条数', 2, '', '', 1386645376, 1387178083, 1, '10', 0),
(36, 'ADMIN_ALLOW_IP', 2, '后台允许访问IP', 4, '', '多个用逗号分隔，如果不配置表示不限制IP访问', 1387165454, 1387165553, 1, '', 12),
(37, 'SHOW_PAGE_TRACE', 4, '是否显示页面Trace', 4, '0:关闭\r\n1:开启', '是否显示页面Trace信息', 1387165685, 1387165685, 1, '0', 1),
(38, 'SITE_LIST', 3, '站点列表', 3, '', '站点列表', 1449740310, 1449740310, 1, '1:北京\r\n2:上海\r\n3:广州\r\n4:天津', 0),
(39, 'CAN_TUAN', 3, '参团性质', 3, '', '参团性质', 1449816403, 1449816403, 1, '1:跟团游\r\n2:品质游\r\n3:独立包团\r\n4:自由行\r\n5:自驾游\r\n6:主题游', 0),
(40, 'LINE_TYPE', 3, '线路分类', 3, '', '线路分类', 1449826371, 1449826400, 1, '1:地接\r\n2:周边\r\n3:国内\r\n4:出境 ', 0);

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_document`
--

CREATE TABLE IF NOT EXISTS `jfsd_document` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `name` char(40) NOT NULL DEFAULT '' COMMENT '标识',
  `title` char(80) NOT NULL DEFAULT '' COMMENT '标题',
  `category_id` int(10) unsigned NOT NULL COMMENT '所属分类',
  `group_id` smallint(3) unsigned NOT NULL COMMENT '所属分组',
  `description` char(140) NOT NULL DEFAULT '' COMMENT '描述',
  `root` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '根节点',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属ID',
  `model_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '内容模型ID',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '2' COMMENT '内容类型',
  `position` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '推荐位',
  `link_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '外链',
  `cover_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '封面',
  `display` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '可见性',
  `deadline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '截至时间',
  `attach` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '附件数量',
  `view` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '浏览量',
  `comment` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论数',
  `extend` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '扩展统计字段',
  `level` int(10) NOT NULL DEFAULT '0' COMMENT '优先级',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '数据状态',
  PRIMARY KEY (`id`),
  KEY `idx_category_status` (`category_id`,`status`),
  KEY `idx_status_type_pid` (`status`,`uid`,`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='文档模型基础表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `jfsd_document`
--

INSERT INTO `jfsd_document` (`id`, `uid`, `name`, `title`, `category_id`, `group_id`, `description`, `root`, `pid`, `model_id`, `type`, `position`, `link_id`, `cover_id`, `display`, `deadline`, `attach`, `view`, `comment`, `extend`, `level`, `create_time`, `update_time`, `status`) VALUES
(1, 1, '', 'OneThink1.1开发版发布', 2, 0, '期待已久的OneThink最新版发布', 0, 0, 2, 2, 0, 0, 0, 1, 0, 0, 11, 0, 0, 0, 1406001413, 1406001413, 1);

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_document_article`
--

CREATE TABLE IF NOT EXISTS `jfsd_document_article` (
  `id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文档ID',
  `parse` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '内容解析类型',
  `content` text NOT NULL COMMENT '文章内容',
  `template` varchar(100) NOT NULL DEFAULT '' COMMENT '详情页显示模板',
  `bookmark` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收藏数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文档模型文章表';

--
-- 转存表中的数据 `jfsd_document_article`
--

INSERT INTO `jfsd_document_article` (`id`, `parse`, `content`, `template`, `bookmark`) VALUES
(1, 0, '<h1>\r\n	OneThink1.1开发版发布&nbsp;\r\n</h1>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<strong>OneThink是一个开源的内容管理框架，基于最新的ThinkPHP3.2版本开发，提供更方便、更安全的WEB应用开发体验，采用了全新的架构设计和命名空间机制，融合了模块化、驱动化和插件化的设计理念于一体，开启了国内WEB应用傻瓜式开发的新潮流。&nbsp;</strong> \r\n</p>\r\n<h2>\r\n	主要特性：\r\n</h2>\r\n<p>\r\n	1. 基于ThinkPHP最新3.2版本。\r\n</p>\r\n<p>\r\n	2. 模块化：全新的架构和模块化的开发机制，便于灵活扩展和二次开发。&nbsp;\r\n</p>\r\n<p>\r\n	3. 文档模型/分类体系：通过和文档模型绑定，以及不同的文档类型，不同分类可以实现差异化的功能，轻松实现诸如资讯、下载、讨论和图片等功能。\r\n</p>\r\n<p>\r\n	4. 开源免费：OneThink遵循Apache2开源协议,免费提供使用。&nbsp;\r\n</p>\r\n<p>\r\n	5. 用户行为：支持自定义用户行为，可以对单个用户或者群体用户的行为进行记录及分享，为您的运营决策提供有效参考数据。\r\n</p>\r\n<p>\r\n	6. 云端部署：通过驱动的方式可以轻松支持平台的部署，让您的网站无缝迁移，内置已经支持SAE和BAE3.0。\r\n</p>\r\n<p>\r\n	7. 云服务支持：即将启动支持云存储、云安全、云过滤和云统计等服务，更多贴心的服务让您的网站更安心。\r\n</p>\r\n<p>\r\n	8. 安全稳健：提供稳健的安全策略，包括备份恢复、容错、防止恶意攻击登录，网页防篡改等多项安全管理功能，保证系统安全，可靠、稳定的运行。&nbsp;\r\n</p>\r\n<p>\r\n	9. 应用仓库：官方应用仓库拥有大量来自第三方插件和应用模块、模板主题，有众多来自开源社区的贡献，让您的网站“One”美无缺。&nbsp;\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<strong>&nbsp;OneThink集成了一个完善的后台管理体系和前台模板标签系统，让你轻松管理数据和进行前台网站的标签式开发。&nbsp;</strong> \r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<h2>\r\n	后台主要功能：\r\n</h2>\r\n<p>\r\n	1. 用户Passport系统\r\n</p>\r\n<p>\r\n	2. 配置管理系统&nbsp;\r\n</p>\r\n<p>\r\n	3. 权限控制系统\r\n</p>\r\n<p>\r\n	4. 后台建模系统&nbsp;\r\n</p>\r\n<p>\r\n	5. 多级分类系统&nbsp;\r\n</p>\r\n<p>\r\n	6. 用户行为系统&nbsp;\r\n</p>\r\n<p>\r\n	7. 钩子和插件系统\r\n</p>\r\n<p>\r\n	8. 系统日志系统&nbsp;\r\n</p>\r\n<p>\r\n	9. 数据备份和还原\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	&nbsp;[ 官方下载：&nbsp;<a href="http://www.onethink.cn/download.html" target="_blank">http://www.onethink.cn/download.html</a>&nbsp;&nbsp;开发手册：<a href="http://document.onethink.cn/" target="_blank">http://document.onethink.cn/</a>&nbsp;]&nbsp;\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<strong>OneThink开发团队 2013~2014</strong> \r\n</p>', '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_document_download`
--

CREATE TABLE IF NOT EXISTS `jfsd_document_download` (
  `id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文档ID',
  `parse` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '内容解析类型',
  `content` text NOT NULL COMMENT '下载详细描述',
  `template` varchar(100) NOT NULL DEFAULT '' COMMENT '详情页显示模板',
  `file_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件ID',
  `download` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '下载次数',
  `size` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文档模型下载表';

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_file`
--

CREATE TABLE IF NOT EXISTS `jfsd_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文件ID',
  `name` char(30) NOT NULL DEFAULT '' COMMENT '原始文件名',
  `savename` char(20) NOT NULL DEFAULT '' COMMENT '保存名称',
  `savepath` char(30) NOT NULL DEFAULT '' COMMENT '文件保存路径',
  `ext` char(5) NOT NULL DEFAULT '' COMMENT '文件后缀',
  `mime` char(40) NOT NULL DEFAULT '' COMMENT '文件mime类型',
  `size` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `md5` char(32) NOT NULL DEFAULT '' COMMENT '文件md5',
  `sha1` char(40) NOT NULL DEFAULT '' COMMENT '文件 sha1编码',
  `location` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '文件保存位置',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '远程地址',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上传时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_md5` (`md5`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文件表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_hooks`
--

CREATE TABLE IF NOT EXISTS `jfsd_hooks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL DEFAULT '' COMMENT '钩子名称',
  `description` text COMMENT '描述',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '类型',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `addons` varchar(255) NOT NULL DEFAULT '' COMMENT '钩子挂载的插件 ''，''分割',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `jfsd_hooks`
--

INSERT INTO `jfsd_hooks` (`id`, `name`, `description`, `type`, `update_time`, `addons`, `status`) VALUES
(1, 'pageHeader', '页面header钩子，一般用于加载插件CSS文件和代码', 1, 0, '', 1),
(2, 'pageFooter', '页面footer钩子，一般用于加载插件JS文件和JS代码', 1, 0, 'ReturnTop', 1),
(3, 'documentEditForm', '添加编辑表单的 扩展内容钩子', 1, 0, 'Attachment', 1),
(4, 'documentDetailAfter', '文档末尾显示', 1, 0, 'Attachment,SocialComment', 1),
(5, 'documentDetailBefore', '页面内容前显示用钩子', 1, 0, '', 1),
(6, 'documentSaveComplete', '保存文档数据后的扩展钩子', 2, 0, 'Attachment', 1),
(7, 'documentEditFormContent', '添加编辑表单的内容显示钩子', 1, 0, 'Editor', 1),
(8, 'adminArticleEdit', '后台内容编辑页编辑器', 1, 1378982734, 'EditorForAdmin', 1),
(13, 'AdminIndex', '首页小格子个性化显示', 1, 1382596073, 'SiteStat,SystemInfo,DevTeam', 1),
(14, 'topicComment', '评论提交方式扩展钩子。', 1, 1380163518, 'Editor', 1),
(16, 'app_begin', '应用开始', 2, 1384481614, '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_line`
--

CREATE TABLE IF NOT EXISTS `jfsd_line` (
  `line_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `site_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '站点id',
  `title` varchar(150) NOT NULL DEFAULT '' COMMENT '线路主标题',
  `sub_title` varchar(150) NOT NULL DEFAULT '' COMMENT '线路副标题',
  `images` varchar(999) NOT NULL DEFAULT '' COMMENT '线路描述图集',
  `traffic` varchar(150) NOT NULL DEFAULT '' COMMENT '交通方式',
  `daynum` varchar(150) NOT NULL DEFAULT '' COMMENT '行程天数',
  `daytime` varchar(150) NOT NULL DEFAULT '' COMMENT '行程日期',
  `remark` varchar(999) NOT NULL DEFAULT '' COMMENT '备注',
  `stroke` varchar(999) NOT NULL DEFAULT '' COMMENT '行程',
  `view_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '人气',
  `order_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单数',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '线路状态0隐藏，1显示',
  `ct_type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '参团类型',
  `l_type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '线路分类',
  `base_hits` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '游客关注',
  `base_order` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最近订单',
  `sort` tinyint(4) NOT NULL DEFAULT '0' COMMENT '排序',
  `is_display` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否显示',
  `earlier_date` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '提前多少天报名',
  `is_position` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否推荐',
  `features` varchar(999) NOT NULL DEFAULT '' COMMENT '线路特色',
  `xingcheng` varchar(9999) NOT NULL DEFAULT '' COMMENT '线路行程',
  `dest` varchar(50) NOT NULL DEFAULT '' COMMENT '目的地',
  `starting` varchar(50) NOT NULL DEFAULT '' COMMENT '出发地',
  PRIMARY KEY (`line_id`),
  KEY `site_id` (`site_id`),
  KEY `title` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='线路表' AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `jfsd_line`
--

INSERT INTO `jfsd_line` (`line_id`, `site_id`, `title`, `sub_title`, `images`, `traffic`, `daynum`, `daytime`, `remark`, `stroke`, `view_num`, `order_num`, `create_time`, `update_time`, `status`, `ct_type`, `l_type`, `base_hits`, `base_order`, `sort`, `is_display`, `earlier_date`, `is_position`, `features`, `xingcheng`, `dest`, `starting`) VALUES
(1, 0, '（新春预订）【土耳其双飞全景9日】南航直飞', '2016年2月10、12日', '', '', '5', '5', '', '', 0, 0, 0, 1450835326, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', ''),
(2, 0, '（新春预订）【土耳其双飞全景9日】南航直飞', '2016年2月10、12日', '', '', '5', '5', '', '', 0, 0, 0, 1450835331, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', ''),
(3, 0, '（新春预订）【土耳其双飞全景9日】南航直飞', '2016年2月10、12日', '', '', '5', '5', '', '', 0, 0, 0, 1450835337, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', ''),
(4, 0, '（新春预订）【土耳其双飞全景9日】南航直飞', '2016年2月10、12日', '', '', '5', '5', '', '', 0, 0, 0, 1450835342, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', ''),
(5, 0, '（新春预订）【土耳其双飞全景9日】南航直飞', '2016年2月10、12日', '', '', '5', '5', '', '', 0, 0, 0, 1450835348, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', ''),
(6, 0, '（新春预订）【土耳其双飞全景9日】南航直飞', '2016年2月10、12日', '', '', '5', '5', '', '', 0, 0, 0, 1450835353, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', ''),
(7, 0, '（新春预订）【土耳其双飞全景9日】南航直飞', '2016年2月10、12日', '', '', '5', '5', '', '', 0, 0, 0, 1450835357, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', ''),
(8, 0, '（新春预订）【土耳其双飞全景9日】南航直飞', '2016年2月10、12日', '', '', '5', '5', '', '', 0, 0, 0, 1450835360, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', ''),
(9, 0, '（新春预订）【土耳其双飞全景9日】南航直飞', '2016年2月10、12日', '', '', '5', '5', '', '', 0, 0, 0, 1449827667, 1, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', ''),
(10, 0, '（新春预订）【土耳其双飞全景9日】南航直飞', '2016年2月10、12日', '', '', '5', '5', '', '', 0, 0, 0, 1450835250, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', ''),
(11, 0, '（新春预订）【土耳其双飞全景9日】南航直飞', '2016年2月10、12日', '', '', '5', '5', '', '', 0, 0, 0, 1449827667, 1, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', ''),
(12, 0, '（新春预订）【土耳其双飞全景9日】南航直飞', '2016年2月10、12日', '', '', '5', '5', '', '', 0, 0, 0, 1449827667, 1, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', ''),
(13, 0, '（新春预订）【土耳其双飞全景9日】南航直飞', '2016年2月10、12日', '', '', '5', '5', '', '', 0, 0, 0, 1449827667, 1, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', ''),
(14, 1, '（新春预订）【土耳其双飞全景9日】南航直飞1', '2016年2月10、12日', '9,10,11', '飞机去飞机回', '5', '5', 'a:4:{i:0;s:12:"费用说明";i:1;s:513:" [font377cc33] [b] 预订须知： [/b] [/font] [p]1、国际往返机票（含机场税），团队经济舱； [/p] [p]2、团队旅游签证费； [br] [/p] [p]3、日本当地四-五星标准酒店双人间住宿； [br] [/p] [p]4、日程所列餐食（午餐1200日元/人次晚餐1350日元/人次）； [br] [/p] [p]5、专用观光车； [br] [/p] [p]6、全程中文导游/领队服务； [br] [/p] [p]7、旅行社责任险。人身意外险； [br] [/p] [p]8、全程小费已含； [br] [/p] [p] [/p]";i:2;s:12:"预定指南";i:3;s:875:" [b] [fontdd0000]预订须知： [/font] [/b] [p]1、旅游产品时限性比较强，所以如您预订此产品，请与客服联系！以上团期仅限于持中国护照/证件旅游者！ 2、理智面对降价：由于旅游尾单的特性，价格可以还会随着时间的临近而下降，您购买到心仪的度假产品后，还请冷静面对随后的降价，该出手时就出手，买到总比错过强呀！！ [/p] [p] [b] [fontdd0000]预订须知： [/font] [/b] [/p] [p]1、旅游产品时限性比较强，所以如您预订此产品，请与客服联系！以上团期仅限于持中国护照/证件旅游者！ 2、理智面对降价：由于旅游尾单的特性，价格可以还会随着时间的临近而下降，您购买到心仪的度假产品后，还请冷静面对随后的降价，该出手时就出手，买到总比错过强呀！！ [/p]";}', '', 0, 0, 0, 1451484367, 255, 1, 1, 120, 15, 0, 0, 10, 0, '1、酒店专享：全程入住四-五星酒店，保证入住1晚北海道五星温泉乐园酒店； [p]2、独家体验：洞爷湖畔足汤，边赏爷湖美丽景色，边漫步热气飘浮； [br] [/p] [p]3、独享购物：综合电器店；综合免税店；奥特莱斯，全方位购物，极致体验； [br] [/p] [p]4、尽享美食：拉面街和室兰海鲜市场，挑战您的味觉极限； [br] [/p] [p]5、精华景点：白色恋人巧克力工厂；熊牧场；旭川动物园； [br] [/p] [p]6、品味经典：小樽运河；SAIRO展望台；洞爷湖雕刻公园；大通公园； [br] [/p] [p]7、特别赠送：【游尾会】免费赠送人身意外险！ [br] [/p]', 'a:5:{i:0;a:6:{i:0;s:18:"北京 一 旭川1";i:1;s:266:" [p]北京首都机场集合，乘坐国际航班飞往日本北海道，抵达后乘机场巴士前往当晚入住酒店休息。办理完入住手续后，后前往酒店休息。 [br] [/p] [p] [b] [font30099cc]参考航班：MU749 1305 1730 [/font] [/b] [br] [/p]";i:2;s:15:"晚餐特色餐";i:3;s:6:"飞机";i:4;s:12:"当地民宿";i:5;a:1:{i:0;s:2:"12";}}i:1;a:6:{i:0;s:18:"北京 一 旭川2";i:1;s:236:" 北京首都机场集合，乘坐国际航班飞往日本北海道，抵达后乘机场巴士前往当晚入住酒店休息。办理完入住手续后，后前往酒店休息。 [p] [br] [/p] [p]参考航班：MU749 1305 1730 [br] [/p]";i:2;s:15:"晚餐特色餐";i:3;s:6:"飞机";i:4;s:12:"当地民宿";i:5;a:2:{i:0;s:2:"12";i:1;s:2:"13";}}i:2;a:5:{i:0;s:18:"北京 一 旭川3";i:1;s:236:" 北京首都机场集合，乘坐国际航班飞往日本北海道，抵达后乘机场巴士前往当晚入住酒店休息。办理完入住手续后，后前往酒店休息。 [p] [br] [/p] [p]参考航班：MU749 1305 1730 [br] [/p]";i:2;s:15:"晚餐特色餐";i:3;s:6:"飞机";i:4;s:12:"当地民宿";}i:3;a:5:{i:0;s:18:"北京 一 旭川4";i:1;s:236:" 北京首都机场集合，乘坐国际航班飞往日本北海道，抵达后乘机场巴士前往当晚入住酒店休息。办理完入住手续后，后前往酒店休息。 [p] [br] [/p] [p]参考航班：MU749 1305 1730 [br] [/p]";i:2;s:15:"晚餐特色餐";i:3;s:6:"飞机";i:4;s:12:"当地民宿";}i:4;a:5:{i:0;s:18:"北京 一 旭川5";i:1;s:236:" 北京首都机场集合，乘坐国际航班飞往日本北海道，抵达后乘机场巴士前往当晚入住酒店休息。办理完入住手续后，后前往酒店休息。 [p] [br] [/p] [p]参考航班：MU749 1305 1730 [br] [/p]";i:2;s:15:"晚餐特色餐";i:3;s:6:"飞机";i:4;s:12:"当地民宿";}}', '目的地', '出发地'),
(15, 0, '（新春预订）【土耳其双飞全景9日】南航直飞', '2016年2月10、12日', '', '', '5', '5', '', '', 0, 0, 0, 1450835135, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', ''),
(16, 0, '（新春预订）【土耳其双飞全景9日】南航直飞', '2016年2月10、12日', '', '', '5', '5', '', '', 0, 0, 0, 1450835125, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', ''),
(17, 2, '（新春预订）【土耳其双飞全景9日】南航直飞', '2016年2月10、12日', '3', '阿凡俗的', '5', '5', 'a:4:{i:0;s:24:"预订须知预订须知";i:1;s:145:" 预订须知预订须知预订须知预订须知预订须知预订须知预订须知预订须知预订须知预订须知预订须知预订须知";i:2;s:36:"温馨提示温馨提示温馨提示";i:3;s:133:" 温馨提示温馨提示温馨提示温馨提示温馨提示温馨提示温馨提示温馨提示温馨提示温馨提示温馨提示";}', '', 0, 0, 0, 1450835071, 0, 2, 2, 10, 5, 0, 1, 7, 1, ' 线路特色线路特色线路特色线路特色线路特色线路特色线路特色线路特色线路特色线路特色线路特色线路特色线路特色线路特色线路特色线路特色线路特色线路特色', 'a:5:{i:0;a:5:{i:0;s:21:"第1天第1天第1天";i:1;s:22:" 第1天第1天第1天";i:2;a:2:{i:0;s:1:"2";i:1;s:1:"3";}i:3;s:21:"第1天第1天第1天";i:4;a:1:{i:0;s:1:"2";}}i:1;a:5:{i:0;s:14:"第2天第2天";i:1;s:50:" 第2天第2天第2天第2天第2天第2天第2天";i:2;a:2:{i:0;s:1:"1";i:1;s:1:"3";}i:3;s:21:"第2天第2天第2天";i:4;a:2:{i:0;s:1:"2";i:1;s:1:"2";}}i:2;a:3:{i:0;s:0:"";i:1;s:0:"";i:3;s:0:"";}i:3;a:3:{i:0;s:0:"";i:1;s:0:"";i:3;s:0:"";}i:4;a:3:{i:0;s:0:"";i:1;s:1:" ";i:3;s:0:"";}}', '', ''),
(18, 1, '线路主标题线路主标题线路主标题线路主标题', '线路主标题', '', '火车', '3', '', '', '', 0, 0, 1450841111, 1450842171, 0, 1, 1, 0, 0, 0, 0, 3, 0, '', '', '', ''),
(19, 2, '阿加莎两地分居快乐$result', '$result', '', '飞机去飞机回', '3', '', 'a:4:{i:0;s:6:"asfasf";i:1;s:9:" asdfasdf";i:2;s:11:"asdfadfadsf";i:3;s:9:" asdfasdf";}', '', 0, 0, 1450841919, 1450844798, 0, 1, 1, 0, 0, 0, 1, 3, 0, ' ', 'a:3:{i:0;a:4:{i:0;s:12:"sadfsaddfadf";i:1;s:11:" asdffadsff";i:2;a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}i:3;s:12:"asdfadsfasdf";}i:1;a:4:{i:0;s:8:"asdfadsf";i:1;s:16:" adsfadffadfadsf";i:2;a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}i:3;s:8:"adsfadsf";}i:2;a:3:{i:0;s:8:"adsffadf";i:1;s:5:" adsf";i:3;s:7:"adfadff";}}', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_line_cate`
--

CREATE TABLE IF NOT EXISTS `jfsd_line_cate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `meta_title` varchar(50) NOT NULL DEFAULT '' COMMENT 'SEO的网页标题',
  `keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `display` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '可见性',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '数据状态',
  `icon` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分类图标',
  `groups` varchar(255) NOT NULL DEFAULT '' COMMENT '分组定义',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='产品分类表' AUTO_INCREMENT=30 ;

--
-- 转存表中的数据 `jfsd_line_cate`
--

INSERT INTO `jfsd_line_cate` (`id`, `title`, `pid`, `sort`, `meta_title`, `keywords`, `description`, `display`, `create_time`, `update_time`, `status`, `icon`, `groups`) VALUES
(1, '全部尾单', 0, 0, '', '', '', 1, 1449719788, 1449733970, 0, 1, ''),
(2, '亚洲', 1, 0, '', '', '', 1, 1449728159, 1449734089, 1, 0, ''),
(5, '出境特卖', 0, 3, '', '', '', 1, 1449728316, 1449734453, 1, 0, ''),
(6, '国内特卖', 0, 1, '', '', '', 1, 1449728936, 1449734453, 1, 0, ''),
(7, '港澳台', 1, 1, '', '', '', 1, 1449734099, 1449734477, 1, 0, ''),
(8, '邮轮', 1, 2, '', '', '', 1, 1449734107, 1449734477, 1, 0, ''),
(9, '海岛', 1, 3, '', '', '', 1, 1449734116, 1449734478, 1, 0, ''),
(10, '欧洲', 1, 4, '', '', '', 1, 1449734129, 1449734479, 1, 0, ''),
(11, '美洲', 1, 5, '', '', '', 1, 1449734140, 1449734480, 1, 0, ''),
(12, '澳洲', 1, 6, '', '', '', 1, 1449734148, 1449734482, 1, 0, ''),
(13, '中东非', 1, 7, '', '', '', 1, 1449734154, 1449734483, 1, 0, ''),
(14, '美洲', 6, 5, '', '', '', 1, 1449734161, 1449734518, 1, 0, ''),
(15, '澳洲', 6, 6, '', '', '', 1, 1449734166, 1449734517, 1, 0, ''),
(16, '亚洲', 6, 0, '', '', '', 1, 1449734171, 1449734202, 1, 0, ''),
(17, '欧洲', 6, 4, '', '', '', 1, 1449734175, 1449734531, 1, 0, ''),
(18, '港澳台', 6, 1, '', '', '', 1, 1449734220, 1449734496, 1, 0, ''),
(19, '邮轮', 6, 2, '', '', '', 1, 1449734225, 1449734503, 1, 0, ''),
(20, '海岛', 6, 3, '', '', '', 1, 1449734239, 1449734506, 1, 0, ''),
(21, '中东非', 6, 7, '', '', '', 1, 1449734244, 1449734514, 1, 0, ''),
(22, '华北', 5, 0, '', '', '', 1, 1449734355, 1449734405, 1, 0, ''),
(23, '东北', 5, 0, '', '', '', 1, 1449734355, 1449734411, 1, 0, ''),
(24, '西北', 5, 0, '', '', '', 1, 1449734355, 1449734416, 1, 0, ''),
(25, '华东', 5, 0, '', '', '', 1, 1449734355, 1449734422, 1, 0, ''),
(26, '华南', 5, 0, '', '', '', 1, 1449734355, 1449734427, 1, 0, ''),
(27, '西南', 5, 0, '', '', '', 1, 1449734355, 1449734433, 1, 0, ''),
(28, '北京', 2, 0, '', '', '', 1, 1450148104, 1450944867, 1, 0, ''),
(29, '上海', 2, 0, '', '', '', 1, 1450148109, 1450944877, 1, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_line_price`
--

CREATE TABLE IF NOT EXISTS `jfsd_line_price` (
  `tc_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '套餐id',
  `cr_price` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '成人价',
  `xh_price` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '小孩价',
  `date` date NOT NULL COMMENT '日期',
  KEY `tc_id` (`tc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='线路价格';

--
-- 转存表中的数据 `jfsd_line_price`
--

INSERT INTO `jfsd_line_price` (`tc_id`, `cr_price`, `xh_price`, `date`) VALUES
(1, 1111, 111, '2015-12-09');

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_line_tc`
--

CREATE TABLE IF NOT EXISTS `jfsd_line_tc` (
  `tc_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `line_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '线路id',
  `typename` varchar(150) NOT NULL DEFAULT '' COMMENT '价格类型名称',
  `price` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '门市价',
  `best_price` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '优惠价格',
  `date_price_data` varchar(9999) NOT NULL DEFAULT '' COMMENT '价格方案',
  `update_price_explan` varchar(9999) NOT NULL DEFAULT '' COMMENT '套餐描述',
  `is_default` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否默认',
  `end_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '套餐过期时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '套餐状态',
  PRIMARY KEY (`tc_id`),
  KEY `line_id` (`line_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='线路套餐' AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `jfsd_line_tc`
--

INSERT INTO `jfsd_line_tc` (`tc_id`, `line_id`, `typename`, `price`, `best_price`, `date_price_data`, `update_price_explan`, `is_default`, `end_time`, `update_time`, `status`) VALUES
(1, 17, '优惠套餐', 1999, 777, '2015-12-28|999-888-max,2015-12-29|999-888-max,2015-12-30|988-0-max,2015-12-31|777-0-max,2016-1-4|999-888-max,2016-1-5|999-888-max,2016-1-11|999-888-max,2016-1-12|999-888-max,2016-1-18|999-888-max,2016-1-19|999-888-max,2016-1-25|999-888-max,2016-1-26|999-888-max,2016-2-1|999-888-max,2016-2-2|999-888-max,2016-2-8|999-888-max,2016-2-9|999-888-max,2016-2-15|999-888-max,2016-2-16|999-888-max,2016-2-22|999-888-max,2016-2-23|999-888-max,2016-2-29|999-888-max,2016-3-1|999-888-max,2016-3-7|999-888-max,2016-3-8|999-888-max,2016-3-14|999-888-max,2016-3-15|999-888-max,2016-3-21|999-888-max,2016-3-22|999-888-max,2016-3-28|999-888-max,2016-3-29|999-888-max,2016-4-4|999-888-max,2016-4-5|999-888-max,2016-4-11|999-888-max,2016-4-12|999-888-max,2016-4-18|999-888-max,2016-4-19|999-888-max,2016-4-25|999-888-max,2016-4-26|999-888-max,2016-5-2|999-888-max,2016-5-3|999-888-max,2016-5-9|999-888-max,2016-5-10|999-888-max,2016-5-16|999-888-max,2016-5-17|999-888-max,2016-5-23|999-888-max,2016-5-24|999-888-max,2016-5-30|999-888-max,2016-5-31|999-888-max,2016-6-6|999-888-max,2016-6-7|999-888-max,2016-6-13|999-888-max,2016-6-14|999-888-max', '[b] [fontdd0000]费用包含： [/font] [/b] [p]1、阿斯蒂芬姐啊来得及方法论 [/p] [p] [b] [fontdd0000]费用不包含： [/font] [/b] [/p] [p]1、阿斯蒂芬姐啊来得及方法论 [/p] [p] [b] [fontdd0000]自费项目说明： [/font] [/b] [/p] [p]1、阿斯蒂芬姐啊来得及方法论 [/p]', 1, 0, 1450427725, 1),
(15, 17, '啊的发生的', 11111, 1111, '2015-12-25|1111-0-max,2015-12-26|1111-0-max,2015-12-27|1111-0-max,2015-12-28|1111-0-max,2015-12-29|1111-0-max,2015-12-30|1111-0-max,2015-12-31|1111-0-max,2016-1-1|1111-0-max,2016-1-2|1111-0-max,2016-1-3|1111-0-max,2016-1-4|1111-0-max,2016-1-5|1111-0-max,2016-1-6|1111-0-max,2016-1-7|1111-0-max,2016-1-8|1111-0-max,2016-1-9|1111-0-max,2016-1-10|1111-0-max,2016-1-11|1111-0-max,2016-1-12|1111-0-max,2016-1-13|1111-0-max,2016-1-14|1111-0-max,2016-1-15|1111-0-max,2016-1-16|1111-0-max,2016-1-17|1111-0-max,2016-1-18|1111-0-max,2016-1-19|1111-0-max,2016-1-20|1111-0-max,2016-1-21|1111-0-max,2016-1-22|1111-0-max,2016-1-23|1111-0-max,2016-1-24|1111-0-max,2016-1-25|1111-0-max,2016-1-26|1111-0-max,2016-1-27|1111-0-max,2016-1-28|1111-0-max,2016-1-29|1111-0-max,2016-1-30|1111-0-max,2016-1-31|1111-0-max,2016-2-1|1111-0-max,2016-2-2|1111-0-max,2016-2-3|1111-0-max,2016-2-4|1111-0-max,2016-2-5|1111-0-max,2016-2-6|1111-0-max,2016-2-7|1111-0-max,2016-2-8|1111-0-max,2016-2-9|1111-0-max,2016-2-10|1111-0-max,2016-2-11|1111-0-max,2016-2-12|1111-0-max,2016-2-13|1111-0-max,2016-2-14|1111-0-max,2016-2-15|1111-0-max,2016-2-16|1111-0-max,2016-2-17|1111-0-max,2016-2-18|1111-0-max,2016-2-19|1111-0-max,2016-2-20|1111-0-max,2016-2-21|1111-0-max,2016-2-22|1111-0-max,2016-2-23|1111-0-max,2016-2-24|1111-0-max,2016-2-25|1111-0-max,2016-2-26|1111-0-max,2016-2-27|1111-0-max,2016-2-28|1111-0-max,2016-2-29|1111-0-max,2016-3-1|1111-0-max,2016-3-2|1111-0-max,2016-3-3|1111-0-max,2016-3-4|1111-0-max,2016-3-5|1111-0-max,2016-3-6|1111-0-max,2016-3-7|1111-0-max,2016-3-8|1111-0-max,2016-3-9|1111-0-max,2016-3-10|1111-0-max,2016-3-11|1111-0-max,2016-3-12|1111-0-max,2016-3-13|1111-0-max,2016-3-14|1111-0-max,2016-3-15|1111-0-max,2016-3-16|1111-0-max,2016-3-17|1111-0-max,2016-3-18|1111-0-max,2016-3-19|1111-0-max,2016-3-20|1111-0-max,2016-3-21|1111-0-max,2016-3-22|1111-0-max,2016-3-23|1111-0-max,2016-3-24|1111-0-max,2016-3-25|1111-0-max,2016-3-26|1111-0-max,2016-3-27|1111-0-max,2016-3-28|1111-0-max,2016-3-29|1111-0-max,2016-3-30|1111-0-max,2016-3-31|1111-0-max,2016-4-1|1111-0-max,2016-4-2|1111-0-max,2016-4-3|1111-0-max,2016-4-4|1111-0-max,2016-4-5|1111-0-max,2016-4-6|1111-0-max,2016-4-7|1111-0-max,2016-4-8|1111-0-max,2016-4-9|1111-0-max,2016-4-10|1111-0-max,2016-4-11|1111-0-max,2016-4-12|1111-0-max,2016-4-13|1111-0-max,2016-4-14|1111-0-max,2016-4-15|1111-0-max,2016-4-16|1111-0-max,2016-4-17|1111-0-max,2016-4-18|1111-0-max,2016-4-19|1111-0-max,2016-4-20|1111-0-max,2016-4-21|1111-0-max,2016-4-22|1111-0-max,2016-4-23|1111-0-max,2016-4-24|1111-0-max,2016-4-25|1111-0-max,2016-4-26|1111-0-max,2016-4-27|1111-0-max,2016-4-28|1111-0-max,2016-4-29|1111-0-max,2016-4-30|1111-0-max,2016-5-1|1111-0-max,2016-5-2|1111-0-max,2016-5-3|1111-0-max,2016-5-4|1111-0-max,2016-5-5|1111-0-max,2016-5-6|1111-0-max,2016-5-7|1111-0-max,2016-5-8|1111-0-max,2016-5-9|1111-0-max,2016-5-10|1111-0-max,2016-5-11|1111-0-max,2016-5-12|1111-0-max,2016-5-13|1111-0-max,2016-5-14|1111-0-max,2016-5-15|1111-0-max,2016-5-16|1111-0-max,2016-5-17|1111-0-max,2016-5-18|1111-0-max,2016-5-19|1111-0-max,2016-5-20|1111-0-max,2016-5-21|1111-0-max,2016-5-22|1111-0-max,2016-5-23|1111-0-max,2016-5-24|1111-0-max,2016-5-25|1111-0-max,2016-5-26|1111-0-max,2016-5-27|1111-0-max,2016-5-28|1111-0-max,2016-5-29|1111-0-max,2016-5-30|1111-0-max,2016-5-31|1111-0-max,2016-6-1|1111-0-max,2016-6-2|1111-0-max,2016-6-3|1111-0-max,2016-6-4|1111-0-max,2016-6-5|1111-0-max,2016-6-6|1111-0-max,2016-6-7|1111-0-max,2016-6-8|1111-0-max,2016-6-9|1111-0-max,2016-6-10|1111-0-max,2016-6-11|1111-0-max,2016-6-12|1111-0-max,2016-6-13|1111-0-max,2016-6-14|1111-0-max,2016-6-15|1111-0-max,2016-6-16|1111-0-max,2016-6-17|1111-0-max,2016-6-18|1111-0-max', '费用包含：11111111111 [br]费用不包含：11111111111111111 [br]自费项目说明：1111111111111111', 0, 0, 1450427725, 1),
(16, 18, '套餐一', 9999, 9999, '2015-12-25|9999-8888-max,2015-12-28|9999-8888-max,2015-12-30|9999-8888-max,2016-1-1|9999-8888-max,2016-1-4|9999-8888-max,2016-1-6|9999-8888-max,2016-1-8|9999-8888-max,2016-1-11|9999-8888-max,2016-1-13|9999-8888-max,2016-1-15|9999-8888-max,2016-1-18|9999-8888-max,2016-1-20|9999-8888-max,2016-1-22|9999-8888-max,2016-1-25|9999-8888-max,2016-1-27|9999-8888-max,2016-1-29|9999-8888-max,2016-2-1|9999-8888-max,2016-2-3|9999-8888-max,2016-2-5|9999-8888-max,2016-2-8|9999-8888-max,2016-2-10|9999-8888-max,2016-2-12|9999-8888-max,2016-2-15|9999-8888-max,2016-2-17|9999-8888-max,2016-2-19|9999-8888-max,2016-2-22|9999-8888-max,2016-2-24|9999-8888-max,2016-2-26|9999-8888-max,2016-2-29|9999-8888-max,2016-3-2|9999-8888-max,2016-3-4|9999-8888-max,2016-3-7|9999-8888-max,2016-3-9|9999-8888-max,2016-3-11|9999-8888-max,2016-3-14|9999-8888-max,2016-3-16|9999-8888-max,2016-3-18|9999-8888-max,2016-3-21|9999-8888-max,2016-3-23|9999-8888-max,2016-3-25|9999-8888-max,2016-3-28|9999-8888-max,2016-3-30|9999-8888-max,2016-4-1|9999-8888-max,2016-4-4|9999-8888-max,2016-4-6|9999-8888-max,2016-4-8|9999-8888-max,2016-4-11|9999-8888-max,2016-4-13|9999-8888-max,2016-4-15|9999-8888-max,2016-4-18|9999-8888-max,2016-4-20|9999-8888-max,2016-4-22|9999-8888-max,2016-4-25|9999-8888-max,2016-4-27|9999-8888-max,2016-4-29|9999-8888-max,2016-5-2|9999-8888-max,2016-5-4|9999-8888-max,2016-5-6|9999-8888-max,2016-5-9|9999-8888-max,2016-5-11|9999-8888-max,2016-5-13|9999-8888-max,2016-5-16|9999-8888-max,2016-5-18|9999-8888-max,2016-5-20|9999-8888-max,2016-5-23|9999-8888-max,2016-5-25|9999-8888-max,2016-5-27|9999-8888-max,2016-5-30|9999-8888-max,2016-6-1|9999-8888-max,2016-6-3|9999-8888-max,2016-6-6|9999-8888-max,2016-6-8|9999-8888-max,2016-6-10|9999-8888-max,2016-6-13|9999-8888-max,2016-6-15|9999-8888-max,2016-6-17|9999-8888-max,2016-6-20|9999-8888-max,2016-6-22|9999-8888-max', '费用包含：111111111 [br]费用不包含：1111111111111111 [br]自费项目说明：11111111111', 0, 0, 1450841635, 1),
(17, 14, '撒旦法撒', 9999, 1111, '2016-1-4|1111-0-max', '费用包含：11111111111111 [br]费用不包含：1111111111 [br]自费项目说明：11111111111111111', 0, 0, 1451442121, 1),
(18, 14, '优惠价', 999, 999, '2016-1-9|999-0-max,2016-1-10|999-0-max,2016-1-11|999-0-max,2016-1-12|999-0-max,2016-1-13|999-0-max,2016-1-14|999-0-max,2016-1-15|999-0-max,2016-1-16|999-0-max,2016-1-17|999-0-max,2016-1-18|999-0-max,2016-1-19|999-0-max,2016-1-20|999-0-max,2016-1-21|999-0-max,2016-1-22|999-0-max,2016-1-23|999-0-max,2016-1-24|999-0-max,2016-1-25|999-0-max,2016-1-26|999-0-max,2016-1-27|999-0-max,2016-1-28|999-0-max,2016-1-29|999-0-max,2016-1-30|999-0-max,2016-1-31|999-0-max,2016-2-1|999-0-max,2016-2-2|999-0-max,2016-2-3|999-0-max,2016-2-4|999-0-max,2016-2-5|999-0-max,2016-2-6|999-0-max,2016-2-7|999-0-max,2016-2-8|999-0-max,2016-2-9|999-0-max,2016-2-10|999-0-max,2016-2-11|999-0-max,2016-2-12|999-0-max,2016-2-13|999-0-max,2016-2-14|999-0-max,2016-2-15|999-0-max,2016-2-16|999-0-max,2016-2-17|999-0-max,2016-2-18|999-0-max,2016-2-19|999-0-max,2016-2-20|999-0-max,2016-2-21|999-0-max,2016-2-22|999-0-max,2016-2-23|999-0-max,2016-2-24|999-0-max,2016-2-25|999-0-max,2016-2-26|999-0-max,2016-2-27|999-0-max,2016-2-28|999-0-max,2016-2-29|999-0-max,2016-3-1|999-0-max,2016-3-2|999-0-max,2016-3-3|999-0-max,2016-3-4|999-0-max,2016-3-5|999-0-max,2016-3-6|999-0-max,2016-3-7|999-0-max,2016-3-8|999-0-max,2016-3-9|999-0-max,2016-3-10|999-0-max,2016-3-11|999-0-max,2016-3-12|999-0-max,2016-3-13|999-0-max,2016-3-14|999-0-max,2016-3-15|999-0-max,2016-3-16|999-0-max,2016-3-17|999-0-max,2016-3-18|999-0-max,2016-3-19|999-0-max,2016-3-20|999-0-max,2016-3-21|999-0-max,2016-3-22|999-0-max,2016-3-23|999-0-max,2016-3-24|999-0-max,2016-3-25|999-0-max,2016-3-26|999-0-max,2016-3-27|999-0-max,2016-3-28|999-0-max,2016-3-29|999-0-max,2016-3-30|999-0-max,2016-3-31|999-0-max,2016-4-1|999-0-max,2016-4-2|999-0-max,2016-4-3|999-0-max,2016-4-4|999-0-max,2016-4-5|999-0-max,2016-4-6|999-0-max,2016-4-7|999-0-max,2016-4-8|999-0-max,2016-4-9|999-0-max,2016-4-10|999-0-max,2016-4-11|999-0-max,2016-4-12|999-0-max,2016-4-13|999-0-max,2016-4-14|999-0-max,2016-4-15|999-0-max,2016-4-16|999-0-max,2016-4-17|999-0-max,2016-4-18|999-0-max,2016-4-19|999-0-max,2016-4-20|999-0-max,2016-4-21|999-0-max,2016-4-22|999-0-max,2016-4-23|999-0-max,2016-4-24|999-0-max,2016-4-25|999-0-max,2016-4-26|999-0-max,2016-4-27|999-0-max,2016-4-28|999-0-max,2016-4-29|999-0-max,2016-4-30|999-0-max,2016-5-1|999-0-max,2016-5-2|999-0-max,2016-5-3|999-0-max,2016-5-4|999-0-max,2016-5-5|999-0-max,2016-5-6|999-0-max,2016-5-7|999-0-max,2016-5-8|999-0-max,2016-5-9|999-0-max,2016-5-10|999-0-max,2016-5-11|999-0-max,2016-5-12|999-0-max,2016-5-13|999-0-max,2016-5-14|999-0-max,2016-5-15|999-0-max,2016-5-16|999-0-max,2016-5-17|999-0-max,2016-5-18|999-0-max,2016-5-19|999-0-max,2016-5-20|999-0-max,2016-5-21|999-0-max,2016-5-22|999-0-max,2016-5-23|999-0-max,2016-5-24|999-0-max,2016-5-25|999-0-max,2016-5-26|999-0-max,2016-5-27|999-0-max,2016-5-28|999-0-max,2016-5-29|999-0-max,2016-5-30|999-0-max,2016-5-31|999-0-max,2016-6-1|999-0-max,2016-6-2|999-0-max,2016-6-3|999-0-max,2016-6-4|999-0-max,2016-6-5|999-0-max,2016-6-6|999-0-max,2016-6-7|999-0-max,2016-6-8|999-0-max,2016-6-9|999-0-max,2016-6-10|999-0-max,2016-6-11|999-0-max,2016-6-12|999-0-max,2016-6-13|999-0-max,2016-6-14|999-0-max,2016-6-15|999-0-max,2016-6-16|999-0-max,2016-6-17|999-0-max,2016-6-18|999-0-max,2016-6-19|999-0-max,2016-6-20|999-0-max,2016-6-21|999-0-max,2016-6-22|999-0-max,2016-6-23|999-0-max,2016-6-24|999-0-max,2016-6-25|999-0-max,2016-6-26|999-0-max,2016-6-27|999-0-max,2016-6-28|999-0-max,2016-6-29|999-0-max,2016-6-30|999-0-max', '费用包含：111111111 [br]费用不包含：1111111111111111111111111111111111 [br]自费项目说明：11111111111111111111111111111111111111', 1, 1467216000, 1451485430, 1),
(19, 14, '优惠价2', 888, 99, '2016-1-11|99-0-max,2016-1-12|99-0-max,2016-1-18|99-0-max,2016-1-19|99-0-max,2016-1-25|99-0-max,2016-1-26|99-0-max,2016-2-1|99-0-max,2016-2-2|99-0-max,2016-2-8|99-0-max,2016-2-9|99-0-max,2016-2-15|99-0-max,2016-2-16|99-0-max,2016-2-22|99-0-max,2016-2-23|99-0-max,2016-2-29|99-0-max,2016-3-1|99-0-max,2016-3-7|99-0-max,2016-3-8|99-0-max,2016-3-14|99-0-max,2016-3-15|99-0-max,2016-3-21|99-0-max,2016-3-22|99-0-max,2016-3-28|99-0-max,2016-3-29|99-0-max,2016-4-4|99-0-max,2016-4-5|99-0-max,2016-4-11|99-0-max,2016-4-12|99-0-max,2016-4-18|99-0-max,2016-4-19|99-0-max,2016-4-25|99-0-max,2016-4-26|99-0-max,2016-5-2|99-0-max,2016-5-3|99-0-max,2016-5-9|99-0-max,2016-5-10|99-0-max,2016-5-16|99-0-max,2016-5-17|99-0-max,2016-5-23|99-0-max,2016-5-24|99-0-max,2016-5-30|99-0-max,2016-5-31|99-0-max,2016-6-6|99-0-max,2016-6-7|99-0-max,2016-6-13|99-0-max,2016-6-14|99-0-max,2016-6-20|99-0-max,2016-6-21|99-0-max,2016-6-27|99-0-max,2016-6-28|99-0-max', '费用包含：11111 [br]费用不包含：111111111111 [br]自费项目说明：1111111', 0, 1467043200, 1451485442, 1);

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_line_type`
--

CREATE TABLE IF NOT EXISTS `jfsd_line_type` (
  `line_id` int(10) unsigned NOT NULL DEFAULT '0',
  `type_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`line_id`,`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='线路分类';

--
-- 转存表中的数据 `jfsd_line_type`
--

INSERT INTO `jfsd_line_type` (`line_id`, `type_id`) VALUES
(0, 1),
(0, 2),
(0, 28),
(14, 1),
(14, 2),
(14, 29),
(17, 1),
(17, 2),
(17, 5),
(17, 7),
(17, 8),
(17, 9),
(17, 10),
(17, 11),
(17, 12),
(17, 13),
(17, 22),
(17, 28),
(17, 29),
(18, 1),
(18, 2),
(18, 28),
(19, 1),
(19, 2),
(19, 29);

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_member`
--

CREATE TABLE IF NOT EXISTS `jfsd_member` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `nickname` char(16) NOT NULL DEFAULT '' COMMENT '昵称',
  `sex` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '性别',
  `birthday` date NOT NULL DEFAULT '0000-00-00' COMMENT '生日',
  `qq` char(10) NOT NULL DEFAULT '' COMMENT 'qq号',
  `score` mediumint(8) NOT NULL DEFAULT '0' COMMENT '用户积分',
  `papers` varchar(150) NOT NULL DEFAULT '' COMMENT '证件',
  `tel` varchar(50) NOT NULL DEFAULT '' COMMENT '电话',
  `address` varchar(150) NOT NULL DEFAULT '' COMMENT '地址',
  `login` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录次数',
  `reg_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '注册IP',
  `reg_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `last_login_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '最后登录IP',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '会员状态',
  PRIMARY KEY (`uid`),
  KEY `status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='会员表' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `jfsd_member`
--

INSERT INTO `jfsd_member` (`uid`, `nickname`, `sex`, `birthday`, `qq`, `score`, `papers`, `tel`, `address`, `login`, `reg_ip`, `reg_time`, `last_login_ip`, `last_login_time`, `status`) VALUES
(1, 'admin', 0, '0000-00-00', '', 100, '', '', '', 31, 0, 1449644004, 2130706433, 1452069252, 1),
(2, '吴文豹', 0, '0000-00-00', '', 30, '', '', '', 7, 0, 0, 2130706433, 1452068766, 1),
(3, '吴文豹', 1, '2015-06-06', '572300808', 10, 'a:2:{i:0;s:1:"1";i:1;s:18:"152822199106063315";}', '15044858848', 'a:4:{i:0;s:9:"天津市";i:1;s:9:"天津市";i:2;s:9:"南开区";i:3;s:27:"角门西时代风帆大厦";}', 0, 2130706433, 1452129473, 0, 0, 1),
(4, '', 0, '0000-00-00', '', 10, '', '', '', 1, 2130706433, 1452059493, 2130706433, 1452059493, 1);

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_menu`
--

CREATE TABLE IF NOT EXISTS `jfsd_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `url` char(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `hide` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否隐藏',
  `tip` varchar(255) NOT NULL DEFAULT '' COMMENT '提示',
  `group` varchar(50) DEFAULT '' COMMENT '分组',
  `is_dev` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否仅开发者模式可见',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=146 ;

--
-- 转存表中的数据 `jfsd_menu`
--

INSERT INTO `jfsd_menu` (`id`, `title`, `pid`, `sort`, `url`, `hide`, `tip`, `group`, `is_dev`, `status`) VALUES
(1, '首页', 0, 0, 'Index/index', 0, '', '', 0, 1),
(2, '内容', 0, 2, 'Article/index', 0, '', '', 0, 1),
(3, '文档列表', 2, 0, 'article/index', 1, '', '内容', 0, 1),
(4, '新增', 3, 0, 'article/add', 0, '', '', 0, 1),
(5, '编辑', 3, 0, 'article/edit', 0, '', '', 0, 1),
(6, '改变状态', 3, 0, 'article/setStatus', 0, '', '', 0, 1),
(7, '保存', 3, 0, 'article/update', 0, '', '', 0, 1),
(8, '保存草稿', 3, 0, 'article/autoSave', 0, '', '', 0, 1),
(9, '移动', 3, 0, 'article/move', 0, '', '', 0, 1),
(10, '复制', 3, 0, 'article/copy', 0, '', '', 0, 1),
(11, '粘贴', 3, 0, 'article/paste', 0, '', '', 0, 1),
(12, '导入', 3, 0, 'article/batchOperate', 0, '', '', 0, 1),
(13, '回收站', 2, 0, 'article/recycle', 1, '', '内容', 0, 1),
(14, '还原', 13, 0, 'article/permit', 0, '', '', 0, 1),
(15, '清空', 13, 0, 'article/clear', 0, '', '', 0, 1),
(16, '用户', 0, 3, 'User/index', 0, '', '', 0, 1),
(17, '用户信息', 16, 0, 'User/index', 0, '', '用户管理', 0, 1),
(18, '新增用户', 17, 0, 'User/add', 0, '添加新用户', '', 0, 1),
(19, '用户行为', 16, 0, 'User/action', 0, '', '行为管理', 0, 1),
(20, '新增用户行为', 19, 0, 'User/addaction', 0, '', '', 0, 1),
(21, '编辑用户行为', 19, 0, 'User/editaction', 0, '', '', 0, 1),
(22, '保存用户行为', 19, 0, 'User/saveAction', 0, '"用户->用户行为"保存编辑和新增的用户行为', '', 0, 1),
(23, '变更行为状态', 19, 0, 'User/setStatus', 0, '"用户->用户行为"中的启用,禁用和删除权限', '', 0, 1),
(24, '禁用会员', 19, 0, 'User/changeStatus?method=forbidUser', 0, '"用户->用户信息"中的禁用', '', 0, 1),
(25, '启用会员', 19, 0, 'User/changeStatus?method=resumeUser', 0, '"用户->用户信息"中的启用', '', 0, 1),
(26, '删除会员', 19, 0, 'User/changeStatus?method=deleteUser', 0, '"用户->用户信息"中的删除', '', 0, 1),
(27, '权限管理', 16, 0, 'AuthManager/index', 0, '', '用户管理', 0, 1),
(28, '删除', 27, 0, 'AuthManager/changeStatus?method=deleteGroup', 0, '删除用户组', '', 0, 1),
(29, '禁用', 27, 0, 'AuthManager/changeStatus?method=forbidGroup', 0, '禁用用户组', '', 0, 1),
(30, '恢复', 27, 0, 'AuthManager/changeStatus?method=resumeGroup', 0, '恢复已禁用的用户组', '', 0, 1),
(31, '新增', 27, 0, 'AuthManager/createGroup', 0, '创建新的用户组', '', 0, 1),
(32, '编辑', 27, 0, 'AuthManager/editGroup', 0, '编辑用户组名称和描述', '', 0, 1),
(33, '保存用户组', 27, 0, 'AuthManager/writeGroup', 0, '新增和编辑用户组的"保存"按钮', '', 0, 1),
(34, '授权', 27, 0, 'AuthManager/group', 0, '"后台 \\ 用户 \\ 用户信息"列表页的"授权"操作按钮,用于设置用户所属用户组', '', 0, 1),
(35, '访问授权', 27, 0, 'AuthManager/access', 0, '"后台 \\ 用户 \\ 权限管理"列表页的"访问授权"操作按钮', '', 0, 1),
(36, '成员授权', 27, 0, 'AuthManager/user', 0, '"后台 \\ 用户 \\ 权限管理"列表页的"成员授权"操作按钮', '', 0, 1),
(37, '解除授权', 27, 0, 'AuthManager/removeFromGroup', 0, '"成员授权"列表页内的解除授权操作按钮', '', 0, 1),
(38, '保存成员授权', 27, 0, 'AuthManager/addToGroup', 0, '"用户信息"列表页"授权"时的"保存"按钮和"成员授权"里右上角的"添加"按钮)', '', 0, 1),
(39, '分类授权', 27, 0, 'AuthManager/category', 0, '"后台 \\ 用户 \\ 权限管理"列表页的"分类授权"操作按钮', '', 0, 1),
(40, '保存分类授权', 27, 0, 'AuthManager/addToCategory', 0, '"分类授权"页面的"保存"按钮', '', 0, 1),
(41, '模型授权', 27, 0, 'AuthManager/modelauth', 0, '"后台 \\ 用户 \\ 权限管理"列表页的"模型授权"操作按钮', '', 0, 1),
(42, '保存模型授权', 27, 0, 'AuthManager/addToModel', 0, '"分类授权"页面的"保存"按钮', '', 0, 1),
(43, '扩展', 0, 7, 'Addons/index', 0, '', '', 0, 1),
(44, '插件管理', 43, 1, 'Addons/index', 0, '', '扩展', 0, 1),
(45, '创建', 44, 0, 'Addons/create', 0, '服务器上创建插件结构向导', '', 0, 1),
(46, '检测创建', 44, 0, 'Addons/checkForm', 0, '检测插件是否可以创建', '', 0, 1),
(47, '预览', 44, 0, 'Addons/preview', 0, '预览插件定义类文件', '', 0, 1),
(48, '快速生成插件', 44, 0, 'Addons/build', 0, '开始生成插件结构', '', 0, 1),
(49, '设置', 44, 0, 'Addons/config', 0, '设置插件配置', '', 0, 1),
(50, '禁用', 44, 0, 'Addons/disable', 0, '禁用插件', '', 0, 1),
(51, '启用', 44, 0, 'Addons/enable', 0, '启用插件', '', 0, 1),
(52, '安装', 44, 0, 'Addons/install', 0, '安装插件', '', 0, 1),
(53, '卸载', 44, 0, 'Addons/uninstall', 0, '卸载插件', '', 0, 1),
(54, '更新配置', 44, 0, 'Addons/saveconfig', 0, '更新插件配置处理', '', 0, 1),
(55, '插件后台列表', 44, 0, 'Addons/adminList', 0, '', '', 0, 1),
(56, 'URL方式访问插件', 44, 0, 'Addons/execute', 0, '控制是否有权限通过url访问插件控制器方法', '', 0, 1),
(57, '钩子管理', 43, 2, 'Addons/hooks', 0, '', '扩展', 0, 1),
(58, '模型管理', 68, 3, 'Model/index', 0, '', '系统设置', 0, 1),
(59, '新增', 58, 0, 'model/add', 0, '', '', 0, 1),
(60, '编辑', 58, 0, 'model/edit', 0, '', '', 0, 1),
(61, '改变状态', 58, 0, 'model/setStatus', 0, '', '', 0, 1),
(62, '保存数据', 58, 0, 'model/update', 0, '', '', 0, 1),
(63, '属性管理', 68, 0, 'Attribute/index', 1, '网站属性配置。', '', 0, 1),
(64, '新增', 63, 0, 'Attribute/add', 0, '', '', 0, 1),
(65, '编辑', 63, 0, 'Attribute/edit', 0, '', '', 0, 1),
(66, '改变状态', 63, 0, 'Attribute/setStatus', 0, '', '', 0, 1),
(67, '保存数据', 63, 0, 'Attribute/update', 0, '', '', 0, 1),
(68, '系统', 0, 4, 'Config/group', 0, '', '', 0, 1),
(69, '网站设置', 68, 1, 'Config/group', 0, '', '系统设置', 0, 1),
(70, '配置管理', 68, 4, 'Config/index', 0, '', '系统设置', 0, 1),
(71, '编辑', 70, 0, 'Config/edit', 0, '新增编辑和保存配置', '', 0, 1),
(72, '删除', 70, 0, 'Config/del', 0, '删除配置', '', 0, 1),
(73, '新增', 70, 0, 'Config/add', 0, '新增配置', '', 0, 1),
(74, '保存', 70, 0, 'Config/save', 0, '保存配置', '', 0, 1),
(75, '菜单管理', 68, 5, 'Menu/index', 0, '', '系统设置', 0, 1),
(76, '导航管理', 68, 6, 'Channel/index', 0, '', '系统设置', 0, 1),
(77, '新增', 76, 0, 'Channel/add', 0, '', '', 0, 1),
(78, '编辑', 76, 0, 'Channel/edit', 0, '', '', 0, 1),
(79, '删除', 76, 0, 'Channel/del', 0, '', '', 0, 1),
(80, '分类管理', 68, 2, 'Category/index', 0, '', '系统设置', 0, 1),
(81, '编辑', 80, 0, 'Category/edit', 0, '编辑和保存栏目分类', '', 0, 1),
(82, '新增', 80, 0, 'Category/add', 0, '新增栏目分类', '', 0, 1),
(83, '删除', 80, 0, 'Category/remove', 0, '删除栏目分类', '', 0, 1),
(84, '移动', 80, 0, 'Category/operate/type/move', 0, '移动栏目分类', '', 0, 1),
(85, '合并', 80, 0, 'Category/operate/type/merge', 0, '合并栏目分类', '', 0, 1),
(86, '备份数据库', 68, 0, 'Database/index?type=export', 0, '', '数据备份', 0, 1),
(87, '备份', 86, 0, 'Database/export', 0, '备份数据库', '', 0, 1),
(88, '优化表', 86, 0, 'Database/optimize', 0, '优化数据表', '', 0, 1),
(89, '修复表', 86, 0, 'Database/repair', 0, '修复数据表', '', 0, 1),
(90, '还原数据库', 68, 0, 'Database/index?type=import', 0, '', '数据备份', 0, 1),
(91, '恢复', 90, 0, 'Database/import', 0, '数据库恢复', '', 0, 1),
(92, '删除', 90, 0, 'Database/del', 0, '删除备份文件', '', 0, 1),
(93, '产品', 0, 0, 'Line/index', 0, '', '', 0, 1),
(96, '新增', 75, 0, 'Menu/add', 0, '', '系统设置', 0, 1),
(98, '编辑', 75, 0, 'Menu/edit', 0, '', '', 0, 1),
(106, '行为日志', 16, 0, 'Action/actionlog', 0, '', '行为管理', 0, 1),
(108, '修改密码', 16, 0, 'User/updatePassword', 1, '', '', 0, 1),
(109, '修改昵称', 16, 0, 'User/updateNickname', 1, '', '', 0, 1),
(110, '查看行为日志', 106, 0, 'action/edit', 1, '', '', 0, 1),
(112, '新增数据', 58, 0, 'think/add', 1, '', '', 0, 1),
(113, '编辑数据', 58, 0, 'think/edit', 1, '', '', 0, 1),
(114, '导入', 75, 0, 'Menu/import', 0, '', '', 0, 1),
(115, '生成', 58, 0, 'Model/generate', 0, '', '', 0, 1),
(116, '新增钩子', 57, 0, 'Addons/addHook', 0, '', '', 0, 1),
(117, '编辑钩子', 57, 0, 'Addons/edithook', 0, '', '', 0, 1),
(118, '文档排序', 3, 0, 'Article/sort', 1, '', '', 0, 1),
(119, '排序', 70, 0, 'Config/sort', 1, '', '', 0, 1),
(120, '排序', 75, 0, 'Menu/sort', 1, '', '', 0, 1),
(121, '排序', 76, 0, 'Channel/sort', 1, '', '', 0, 1),
(122, '数据列表', 58, 0, 'think/lists', 1, '', '', 0, 1),
(123, '审核列表', 3, 0, 'Article/examine', 1, '', '', 0, 1),
(124, '交易', 0, 0, 'Order/index', 0, '', '', 0, 1),
(125, '旅游线路', 93, 0, 'Line/index', 0, '', '旅游线路', 0, 1),
(126, '签证线路', 93, 0, 'Visa/index', 0, '', '签证线路', 0, 1),
(127, '线路分类', 93, 0, 'LineCate/index', 0, '', '分类管理', 0, 1),
(128, '新增', 127, 0, 'LineCate/add', 0, '新增', '', 0, 1),
(129, '更新', 127, 0, 'LineCate/edit', 0, '', '', 0, 1),
(130, '订单管理', 124, 0, 'Order/index', 0, '', '订单管理', 0, 1),
(131, '删除', 127, 0, 'LineCate/remove', 0, '', '', 0, 1),
(132, '签证分类', 93, 0, 'VisaCate/index', 0, '', '分类管理', 0, 1),
(134, '移动', 127, 0, 'LineCate/operate/type/move', 0, '', '', 0, 1),
(135, '新增', 132, 0, 'VisaCate/add', 0, '', '', 0, 1),
(136, '更新', 132, 0, 'VisaCate/edit', 0, '', '', 0, 1),
(137, '删除', 132, 0, 'VisaCate/remove', 0, '', '', 0, 1),
(139, '移动', 132, 0, 'VisaCate/operate/type/move', 0, '', '', 0, 1),
(140, '站点授权', 27, 0, 'AuthManager/site', 0, '', '', 0, 1),
(141, '第一步', 125, 0, 'Line/edit', 0, '', '', 0, 1),
(142, '添加', 125, 0, 'Line/add', 0, '', '', 0, 1),
(143, '第二步', 125, 0, 'Line/edit2', 0, '', '', 0, 1),
(144, '第三步', 125, 0, 'Line/edit3', 0, '', '', 0, 1),
(145, '套餐处理', 125, 0, 'Line/tcEdit', 0, '', '', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_model`
--

CREATE TABLE IF NOT EXISTS `jfsd_model` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '模型ID',
  `name` char(30) NOT NULL DEFAULT '' COMMENT '模型标识',
  `title` char(30) NOT NULL DEFAULT '' COMMENT '模型名称',
  `extend` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '继承的模型',
  `relation` varchar(30) NOT NULL DEFAULT '' COMMENT '继承与被继承模型的关联字段',
  `need_pk` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '新建表时是否需要主键字段',
  `field_sort` text COMMENT '表单字段排序',
  `field_group` varchar(255) NOT NULL DEFAULT '1:基础' COMMENT '字段分组',
  `attribute_list` text COMMENT '属性列表（表的字段）',
  `attribute_alias` varchar(255) NOT NULL DEFAULT '' COMMENT '属性别名定义',
  `template_list` varchar(100) NOT NULL DEFAULT '' COMMENT '列表模板',
  `template_add` varchar(100) NOT NULL DEFAULT '' COMMENT '新增模板',
  `template_edit` varchar(100) NOT NULL DEFAULT '' COMMENT '编辑模板',
  `list_grid` text COMMENT '列表定义',
  `list_row` smallint(2) unsigned NOT NULL DEFAULT '10' COMMENT '列表数据长度',
  `search_key` varchar(50) NOT NULL DEFAULT '' COMMENT '默认搜索字段',
  `search_list` varchar(255) NOT NULL DEFAULT '' COMMENT '高级搜索的字段',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `engine_type` varchar(25) NOT NULL DEFAULT 'MyISAM' COMMENT '数据库引擎',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='文档模型表' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `jfsd_model`
--

INSERT INTO `jfsd_model` (`id`, `name`, `title`, `extend`, `relation`, `need_pk`, `field_sort`, `field_group`, `attribute_list`, `attribute_alias`, `template_list`, `template_add`, `template_edit`, `list_grid`, `list_row`, `search_key`, `search_list`, `create_time`, `update_time`, `status`, `engine_type`) VALUES
(1, 'document', '基础文档', 0, '', 1, '{"1":["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22"]}', '1:基础', '', '', '', '', '', 'id:编号\r\ntitle:标题:[EDIT]\r\ntype:类型\r\nupdate_time:最后更新\r\nstatus:状态\r\nview:浏览\r\nid:操作:[EDIT]|编辑,[DELETE]|删除', 0, '', '', 1383891233, 1384507827, 1, 'MyISAM'),
(2, 'article', '文章', 1, '', 1, '{"1":["3","24","2","5"],"2":["9","13","19","10","12","16","17","26","20","14","11","25"]}', '1:基础,2:扩展', '', '', '', '', '', '', 0, '', '', 1383891243, 1387260622, 1, 'MyISAM'),
(3, 'download', '下载', 1, '', 1, '{"1":["3","28","30","32","2","5","31"],"2":["13","10","27","9","12","16","17","19","11","20","14","29"]}', '1:基础,2:扩展', '', '', '', '', '', '', 0, '', '', 1383891252, 1387260449, 1, 'MyISAM');

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_order`
--

CREATE TABLE IF NOT EXISTS `jfsd_order` (
  `order_id` char(20) NOT NULL DEFAULT '' COMMENT '订单id',
  `site_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '站点id',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `order_type` char(10) NOT NULL DEFAULT '' COMMENT '订单类型line,visa',
  `product_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '产品id',
  `product_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '产品购买数量',
  `reserve_info` varchar(999) NOT NULL DEFAULT '' COMMENT '预定信息',
  `truename` varchar(20) NOT NULL DEFAULT '' COMMENT '用户名',
  `mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '手机号',
  `user_intro` varchar(255) NOT NULL DEFAULT '' COMMENT '用户备注',
  `kefu_intro` varchar(255) NOT NULL DEFAULT '' COMMENT '客服备注',
  `product_price` double(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '产品总价格',
  `order_price` double(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '订单价格',
  `order_status` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单状态',
  `pay_status` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单状态',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `is_read` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否阅读',
  PRIMARY KEY (`order_id`),
  KEY `site_id` (`site_id`),
  KEY `user_id` (`user_id`),
  KEY `order_type` (`order_type`),
  KEY `product_id` (`product_id`),
  KEY `order_status` (`order_status`),
  KEY `pay_status` (`pay_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单记录表';

--
-- 转存表中的数据 `jfsd_order`
--

INSERT INTO `jfsd_order` (`order_id`, `site_id`, `user_id`, `order_type`, `product_id`, `product_num`, `reserve_info`, `truename`, `mobile`, `user_intro`, `kefu_intro`, `product_price`, `order_price`, `order_status`, `pay_status`, `create_time`, `update_time`, `is_read`) VALUES
('NS201601051057014846', 1, 1, 'line', 14, 5, 'a:15:{s:10:"product_id";s:2:"14";s:9:"adult_num";s:1:"3";s:9:"child_num";s:1:"2";s:11:"adult_price";s:3:"999";s:11:"child_price";s:1:"0";s:10:"start_time";s:10:"2016-01-18";s:8:"truename";s:9:"吴文豹";s:3:"sex";s:6:"先生";s:6:"mobile";s:11:"15044858848";s:10:"user_email";s:16:"572300808@qq.com";s:3:"tel";s:8:"57654321";s:12:"shenfen_type";s:1:"1";s:13:"shenfen_value";s:17:"15282219910606333";s:2:"qq";s:9:"572300808";s:10:"user_intro";s:184:"1、全程单间差：￥3200元/间（如入住单间则另付单间差费用）\r\n2、全程境外司机导游小费USD100/人/全程； \r\n3、行李物品的保管费及超重费； ";}', '吴文豹', '15044858848', '1、全程单间差：￥3200元/间（如入住单间则另付单间差费用）\r\n2、全程境外司机导游小费USD100/人/全程； \r\n3、行李物品的保管费及超重费； ', '', 2997.00, 2997.00, 1, 1, 1451962621, 1451962621, 0),
('NS201601051103261665', 1, 1, 'line', 14, 5, 'a:15:{s:10:"product_id";s:2:"14";s:9:"adult_num";s:1:"3";s:9:"child_num";s:1:"2";s:11:"adult_price";s:3:"999";s:11:"child_price";s:1:"0";s:10:"start_time";s:10:"2016-01-18";s:8:"truename";s:9:"吴文豹";s:3:"sex";s:6:"先生";s:6:"mobile";s:11:"15044858848";s:10:"user_email";s:16:"572300808@qq.com";s:3:"tel";s:8:"57654321";s:12:"shenfen_type";s:1:"1";s:13:"shenfen_value";s:17:"15282219910606333";s:2:"qq";s:9:"572300808";s:10:"user_intro";s:184:"1、全程单间差：￥3200元/间（如入住单间则另付单间差费用）\r\n2、全程境外司机导游小费USD100/人/全程； \r\n3、行李物品的保管费及超重费； ";}', '吴文豹', '15044858848', '1、全程单间差：￥3200元/间（如入住单间则另付单间差费用）\r\n2、全程境外司机导游小费USD100/人/全程； \r\n3、行李物品的保管费及超重费； ', '', 2997.00, 2997.00, 1, 1, 1451963006, 1451963006, 0),
('NS201601051103281899', 1, 1, 'line', 14, 5, 'a:15:{s:10:"product_id";s:2:"14";s:9:"adult_num";s:1:"3";s:9:"child_num";s:1:"2";s:11:"adult_price";s:3:"999";s:11:"child_price";s:1:"0";s:10:"start_time";s:10:"2016-01-18";s:8:"truename";s:9:"吴文豹";s:3:"sex";s:6:"先生";s:6:"mobile";s:11:"15044858848";s:10:"user_email";s:16:"572300808@qq.com";s:3:"tel";s:8:"57654321";s:12:"shenfen_type";s:1:"1";s:13:"shenfen_value";s:17:"15282219910606333";s:2:"qq";s:9:"572300808";s:10:"user_intro";s:184:"1、全程单间差：￥3200元/间（如入住单间则另付单间差费用）\r\n2、全程境外司机导游小费USD100/人/全程； \r\n3、行李物品的保管费及超重费； ";}', '吴文豹', '15044858848', '1、全程单间差：￥3200元/间（如入住单间则另付单间差费用）\r\n2、全程境外司机导游小费USD100/人/全程； \r\n3、行李物品的保管费及超重费； ', '', 2997.00, 2997.00, 1, 1, 1451963008, 1451963008, 0),
('NS201601051109057937', 1, 1, 'line', 14, 5, 'a:15:{s:10:"product_id";s:2:"14";s:9:"adult_num";s:1:"3";s:9:"child_num";s:1:"2";s:11:"adult_price";s:3:"999";s:11:"child_price";s:1:"0";s:10:"start_time";s:10:"2016-01-18";s:8:"truename";s:9:"吴文豹";s:3:"sex";s:6:"先生";s:6:"mobile";s:11:"15044858848";s:10:"user_email";s:16:"572300808@qq.com";s:3:"tel";s:8:"57654321";s:12:"shenfen_type";s:1:"1";s:13:"shenfen_value";s:17:"15282219910606333";s:2:"qq";s:9:"572300808";s:10:"user_intro";s:184:"1、全程单间差：￥3200元/间（如入住单间则另付单间差费用）\r\n2、全程境外司机导游小费USD100/人/全程； \r\n3、行李物品的保管费及超重费； ";}', '吴文豹', '15044858848', '1、全程单间差：￥3200元/间（如入住单间则另付单间差费用）\r\n2、全程境外司机导游小费USD100/人/全程； \r\n3、行李物品的保管费及超重费； ', '', 2997.00, 2997.00, 1, 1, 1451963345, 1451963345, 0),
('NS201601061346482784', 1, 3, 'line', 14, 1, 'a:15:{s:10:"product_id";s:2:"14";s:9:"adult_num";s:1:"1";s:9:"child_num";s:1:"0";s:11:"adult_price";s:2:"99";s:11:"child_price";s:1:"0";s:10:"start_time";s:10:"2016-01-18";s:8:"truename";s:6:"拥抱";s:3:"sex";s:6:"女士";s:6:"mobile";s:11:"15044858847";s:10:"user_email";s:0:"";s:3:"tel";s:0:"";s:12:"shenfen_type";s:1:"1";s:13:"shenfen_value";s:0:"";s:2:"qq";s:0:"";s:10:"user_intro";s:6:"asdfa ";}', '拥抱', '15044858847', 'asdfa ', '', 99.00, 99.00, 1, 1, 1452059208, 1452059208, 0),
('NS201601061349383490', 1, 3, 'line', 14, 1, 'a:15:{s:10:"product_id";s:2:"14";s:9:"adult_num";s:1:"1";s:9:"child_num";s:1:"0";s:11:"adult_price";s:2:"99";s:11:"child_price";s:1:"0";s:10:"start_time";s:10:"2016-01-18";s:8:"truename";s:9:"吴文豹";s:3:"sex";s:6:"女士";s:6:"mobile";s:11:"15044858848";s:10:"user_email";s:0:"";s:3:"tel";s:0:"";s:12:"shenfen_type";s:1:"1";s:13:"shenfen_value";s:0:"";s:2:"qq";s:0:"";s:10:"user_intro";s:0:"";}', '吴文豹', '15044858848', '', '', 99.00, 99.00, 1, 1, 1452059378, 1452059378, 0),
('NS201601061350378523', 1, 4, 'line', 14, 4, 'a:15:{s:10:"product_id";s:2:"14";s:9:"adult_num";s:1:"2";s:9:"child_num";s:1:"2";s:11:"adult_price";s:2:"99";s:11:"child_price";s:1:"0";s:10:"start_time";s:10:"2016-01-18";s:8:"truename";s:9:"邵晓雪";s:3:"sex";s:6:"女士";s:6:"mobile";s:11:"15044898900";s:10:"user_email";s:0:"";s:3:"tel";s:0:"";s:12:"shenfen_type";s:1:"1";s:13:"shenfen_value";s:0:"";s:2:"qq";s:0:"";s:10:"user_intro";s:6:"测试";}', '邵晓雪', '15044898900', '测试', '', 198.00, 198.00, 1, 1, 1452059437, 1452059437, 0),
('NS201601062129186804', 1, 3, 'line', 14, 7, 'a:15:{s:10:"product_id";s:2:"14";s:9:"adult_num";s:1:"5";s:9:"child_num";s:1:"2";s:11:"adult_price";s:2:"99";s:11:"child_price";s:1:"0";s:10:"start_time";s:10:"2016-01-19";s:8:"truename";s:6:"拥抱";s:3:"sex";s:6:"女士";s:6:"mobile";s:11:"15044858848";s:10:"user_email";s:0:"";s:3:"tel";s:0:"";s:12:"shenfen_type";s:1:"1";s:13:"shenfen_value";s:0:"";s:2:"qq";s:0:"";s:10:"user_intro";s:6:"sadfaf";}', '拥抱', '15044858848', 'sadfaf', '', 495.00, 495.00, 1, 1, 1452086958, 1452086958, 0);

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_picture`
--

CREATE TABLE IF NOT EXISTS `jfsd_picture` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id自增',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '路径',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '图片链接',
  `md5` char(32) NOT NULL DEFAULT '' COMMENT '文件md5',
  `sha1` char(40) NOT NULL DEFAULT '' COMMENT '文件 sha1编码',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `jfsd_picture`
--

INSERT INTO `jfsd_picture` (`id`, `path`, `url`, `md5`, `sha1`, `status`, `create_time`) VALUES
(1, '/Uploads/Picture/2015-12-10/5668f40dc1c69.jpg', '', 'd34c7fd00c7ffb0071656b52fdc59dcd', '41dc4f3a3facd450bb6a39af4dd8b2f728b2b000', 1, 1449718797),
(2, '/Uploads/Picture/2015-12-15/566fc53cd53e4.png', '', 'cb4ecf8c7019d53c411093a97db1dfbc', '622e8fa232d6eca85d701b51c6b406784c4eaea3', 1, 1450165564),
(3, '/Uploads/Picture/2015-12-17/567215bb6a09d.gif', '', 'fb0a450a156659c11892cc70eaf22189', 'fb6afa76b15e1092fc22b2adf6fa429f4cacaf55', 1, 1450317243),
(4, '/Uploads/Picture/2015-12-17/567215bb9fd78.gif', '', '10541c0d67b8697fbf8ac46f498831aa', '3c931abafaaf2f135f776018fc1ec0425ba315c1', 1, 1450317243),
(5, '/Uploads/Picture/2015-12-17/567215bbd3df5.png', '', '75754faae03204e6624f27486bbb78fa', '04a7f0a9a950edef1ced036861b3e1cb6d61625a', 1, 1450317243),
(6, '/Uploads/Picture/2015-12-17/5672168d3bf1a.png', '', '037d0ac56df9e2760eacf2498ab4ae01', '2c9592980be8de5e210f8e9952882cf340360ad7', 1, 1450317453),
(7, '/Uploads/Picture/2015-12-17/56721694cc7ee.gif', '', '7dbabe9466d8e84245421fe745473be9', 'df3a00d909872d5254cf5f6e00f3542fe98c9773', 1, 1450317460),
(8, '/Uploads/Picture/2015-12-17/56722bce1d2ab.png', '', 'd0c7daf3330ba6633420da04f32ae1a4', '22c58f9aa7565c95b973a40f9feea2411f1b09e1', 1, 1450322894),
(9, '/Uploads/Picture/2015-12-24/567bafd19644c.png', '', '4c0831bb90b65e36ca4a3f62b04af180', '69c88c231c8cdb1566ca8fa9a714ba571ec2141f', 1, 1450946513),
(10, '/Uploads/Picture/2015-12-24/567bafd1b284c.png', '', '9599679cb491f3deed16a7b1bd062835', '1f9e473bb3e8170c6b1c68e8db2c710fdd52d516', 1, 1450946513),
(11, '/Uploads/Picture/2015-12-24/567bafd1c2dea.png', '', '130a52af04267b18489cc14780b4d77e', '611bb8c7c671c673ca04d1152cffe2b97b7c6c8b', 1, 1450946513),
(12, '/Uploads/Picture/2015-12-25/567cf0708a568.jpg', '', '5010d49ae28e3671cf73cbeb5fcee0eb', 'b017fc47dc15fd50810212f6624e212df08530d3', 1, 1451028592),
(13, '/Uploads/Picture/2015-12-25/567cfacd52d66.jpg', '', 'c6546160ff7b199650be3ab6777cb9eb', 'dd40cad848545919aa44f8278bd79faa2b142362', 1, 1451031245);

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_sms_log`
--

CREATE TABLE IF NOT EXISTS `jfsd_sms_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` char(20) NOT NULL DEFAULT '' COMMENT '类型',
  `mobile` char(11) NOT NULL DEFAULT '' COMMENT '手机号',
  `code` char(4) NOT NULL DEFAULT '' COMMENT '验证码',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `utime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `mobile` (`mobile`),
  KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `jfsd_sms_log`
--

INSERT INTO `jfsd_sms_log` (`id`, `type`, `mobile`, `code`, `ctime`, `utime`, `status`) VALUES
(1, '注册', '15044858848', '7411', 1451995951, 1451997235, 0),
(2, '注册', '15044858848', '8993', 1452074284, 1452074284, 1);

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_ucenter_admin`
--

CREATE TABLE IF NOT EXISTS `jfsd_ucenter_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `member_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '管理员用户ID',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '管理员状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理员表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_ucenter_app`
--

CREATE TABLE IF NOT EXISTS `jfsd_ucenter_app` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '应用ID',
  `title` varchar(30) NOT NULL COMMENT '应用名称',
  `url` varchar(100) NOT NULL COMMENT '应用URL',
  `ip` char(15) NOT NULL DEFAULT '' COMMENT '应用IP',
  `auth_key` varchar(100) NOT NULL DEFAULT '' COMMENT '加密KEY',
  `sys_login` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '同步登陆',
  `allow_ip` varchar(255) NOT NULL DEFAULT '' COMMENT '允许访问的IP',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '应用状态',
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='应用表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_ucenter_member`
--

CREATE TABLE IF NOT EXISTS `jfsd_ucenter_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` char(16) NOT NULL COMMENT '用户名',
  `password` char(32) NOT NULL COMMENT '密码',
  `email` char(32) NOT NULL COMMENT '用户邮箱',
  `mobile` char(15) NOT NULL DEFAULT '' COMMENT '用户手机',
  `reg_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `reg_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '注册IP',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `last_login_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '最后登录IP',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) DEFAULT '0' COMMENT '用户状态',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `username` (`username`),
  KEY `email` (`email`),
  KEY `mobile` (`mobile`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `jfsd_ucenter_member`
--

INSERT INTO `jfsd_ucenter_member` (`id`, `username`, `password`, `email`, `mobile`, `reg_time`, `reg_ip`, `last_login_time`, `last_login_ip`, `update_time`, `status`) VALUES
(1, 'admin', '38afda6998bd207ed8641671897c7276', '572300808@qq.com', '', 1449644004, 2130706433, 1452069252, 2130706433, 1449644004, 1),
(2, '吴文豹', '38afda6998bd207ed8641671897c7276', '5723008080@qq.com', '', 1449651640, 2130706433, 1452068766, 2130706433, 1449651640, 1),
(3, '拥抱', '38afda6998bd207ed8641671897c7276', '', '15044858848', 1452066736, 2130706433, 1452129458, 2130706433, 1452066736, 1),
(4, '', '38afda6998bd207ed8641671897c7276', '', '15044898900', 1452059437, 2130706433, 1452059493, 2130706433, 1452059437, 1);

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_ucenter_setting`
--

CREATE TABLE IF NOT EXISTS `jfsd_ucenter_setting` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '设置ID',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置类型（1-用户配置）',
  `value` text NOT NULL COMMENT '配置数据',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='设置表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_url`
--

CREATE TABLE IF NOT EXISTS `jfsd_url` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '链接唯一标识',
  `url` char(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `short` char(100) NOT NULL DEFAULT '' COMMENT '短网址',
  `status` tinyint(2) NOT NULL DEFAULT '2' COMMENT '状态',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_url` (`url`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='链接表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_userdata`
--

CREATE TABLE IF NOT EXISTS `jfsd_userdata` (
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `type` tinyint(3) unsigned NOT NULL COMMENT '类型标识',
  `target_id` int(10) unsigned NOT NULL COMMENT '目标id',
  UNIQUE KEY `uid` (`uid`,`type`,`target_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `jfsd_visa_cate`
--

CREATE TABLE IF NOT EXISTS `jfsd_visa_cate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `meta_title` varchar(50) NOT NULL DEFAULT '' COMMENT 'SEO的网页标题',
  `keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `display` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '可见性',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '数据状态',
  `icon` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分类图标',
  `groups` varchar(255) NOT NULL DEFAULT '' COMMENT '分组定义',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='产品分类表' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `jfsd_visa_cate`
--

INSERT INTO `jfsd_visa_cate` (`id`, `title`, `pid`, `sort`, `meta_title`, `keywords`, `description`, `display`, `create_time`, `update_time`, `status`, `icon`, `groups`) VALUES
(1, '亚洲', 0, 0, '', '', '', 1, 1449737971, 1449737971, 1, 0, ''),
(2, '欧洲', 0, 0, '', '', '', 1, 1449737977, 1449737997, 1, 0, ''),
(3, '美洲', 0, 0, '', '', '', 1, 1449737982, 1449738004, 1, 0, ''),
(4, '澳洲', 0, 0, '', '', '', 1, 1449737987, 1449738019, 1, 0, ''),
(5, '中东非', 0, 0, '', '', '', 1, 1449737991, 1449738029, 1, 0, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
