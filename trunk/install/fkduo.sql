-- phpMyAdmin SQL Dump
-- version 2.11.9.4
-- http://www.phpmyadmin.net
--
-- ����: localhost:3306
-- ��������: 2009 �� 11 �� 25 �� 08:21
-- �������汾: 5.1.37
-- PHP �汾: 5.2.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- ���ݿ�: `baidu`
--

-- --------------------------------------------------------

--
-- ��Ľṹ `{table_prefix}bk`
--

DROP TABLE IF EXISTS `{table_prefix}bk`;
CREATE TABLE `{table_prefix}bk` (
  `bkid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `bkname` char(50) NOT NULL,
  `bkjj` char(100) NOT NULL,
  `px` smallint(3) unsigned NOT NULL DEFAULT '0',
  KEY `bkid` (`bkid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- �������е����� `{table_prefix}bk`
--

INSERT INTO `{table_prefix}bk` (`bkid`, `bkname`, `bkjj`, `px`) VALUES
(1, '��һ���', '����һ���������Եİ���..', 0);

-- --------------------------------------------------------

--
-- ��Ľṹ `{table_prefix}bkmaster`
--

DROP TABLE IF EXISTS `{table_prefix}bkmaster`;
CREATE TABLE `{table_prefix}bkmaster` (
  `uid` varchar(15) NOT NULL,
  `bkid` smallint(6) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- �������е����� `{table_prefix}bkmaster`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `{table_prefix}card`
--

DROP TABLE IF EXISTS `{table_prefix}card`;
CREATE TABLE `{table_prefix}card` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cid` mediumint(8) unsigned NOT NULL DEFAULT '2',
  `bk` smallint(6) unsigned NOT NULL DEFAULT '0',
  `content` mediumtext,
  `lastlogname` varchar(15) NOT NULL DEFAULT 'logname',
  `lastnkname` varchar(12) DEFAULT '0',
  `lasttime` int(10) unsigned DEFAULT '0',
  `pic` varchar(100) DEFAULT '0',
  `lc` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ip` varchar(15) NOT NULL DEFAULT '0',
  `regtime` int(10) unsigned NOT NULL DEFAULT '0',
  `hp` mediumint(8) unsigned NOT NULL,
  `pp` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `area` char(4) NOT NULL DEFAULT 'no',
  `sign` varchar(140) NOT NULL,
  `hs` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `pb` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `edit` int(10) unsigned NOT NULL DEFAULT '0',
  `through` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `prizepp` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `zts` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `hfs` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `face` char(3) NOT NULL DEFAULT '1',
  `edits` smallint(4) unsigned NOT NULL DEFAULT '0',
  KEY `id` (`id`),
  KEY `lasttime` (`lasttime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- �������е����� `{table_prefix}card`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `{table_prefix}emailact`
--

DROP TABLE IF EXISTS `{table_prefix}emailact`;
CREATE TABLE `{table_prefix}emailact` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` char(6) NOT NULL,
  `doo` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `email` varchar(32) NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- �������е����� `{table_prefix}emailact`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `{table_prefix}fav`
--

DROP TABLE IF EXISTS `{table_prefix}fav`;
CREATE TABLE `{table_prefix}fav` (
  `cid` mediumint(8) unsigned NOT NULL,
  `title` varchar(80) NOT NULL,
  `bk` smallint(6) unsigned NOT NULL,
  `favuser` varchar(15) NOT NULL,
  `favtime` int(10) unsigned NOT NULL,
  KEY `favtime` (`favtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- �������е����� `{table_prefix}fav`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `{table_prefix}fkduo`
--

DROP TABLE IF EXISTS `{table_prefix}fkduo`;
CREATE TABLE `{table_prefix}fkduo` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `logname` varchar(15) NOT NULL,
  `password` char(32) NOT NULL,
  `salt` char(6) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- �������е����� `{table_prefix}fkduo`
--

INSERT INTO `{table_prefix}fkduo` (`id`, `logname`, `password`, `salt`) VALUES
(1, 'fkduo', '913e74c5c4d5c868edd925bccbbf4557', '674bff');

-- --------------------------------------------------------

--
-- ��Ľṹ `{table_prefix}link`
--

DROP TABLE IF EXISTS `{table_prefix}link`;
CREATE TABLE `{table_prefix}link` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `url` varchar(100) NOT NULL,
  `px` smallint(6) unsigned NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- �������е����� `{table_prefix}link`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `{table_prefix}prizeinfo`
--

DROP TABLE IF EXISTS `{table_prefix}prizeinfo`;
CREATE TABLE `{table_prefix}prizeinfo` (
  `bk` smallint(6) unsigned NOT NULL,
  `cid` mediumint(8) unsigned NOT NULL,
  `lc` mediumint(8) NOT NULL DEFAULT '0',
  `logname` varchar(15) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `why` varchar(40) NOT NULL,
  `how` smallint(6) unsigned NOT NULL,
  `time` int(10) unsigned NOT NULL,
  KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- �������е����� `{table_prefix}prizeinfo`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `{table_prefix}replace`
--

DROP TABLE IF EXISTS `{table_prefix}replace`;
CREATE TABLE `{table_prefix}replace` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `oldw` varchar(20) NOT NULL,
  `neww` varchar(20) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- �������е����� `{table_prefix}replace`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `{table_prefix}report`
--

DROP TABLE IF EXISTS `{table_prefix}report`;
CREATE TABLE `{table_prefix}report` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(100) NOT NULL,
  `why` tinyint(2) unsigned NOT NULL,
  `why2` varchar(100) NOT NULL,
  `from` varchar(20) NOT NULL,
  `time` int(10) unsigned NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- �������е����� `{table_prefix}report`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `{table_prefix}sms`
--

DROP TABLE IF EXISTS `{table_prefix}sms`;
CREATE TABLE `{table_prefix}sms` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(80) NOT NULL,
  `content` varchar(140) NOT NULL,
  `from` varchar(15) NOT NULL,
  `fromnkname` varchar(20) NOT NULL,
  `to` varchar(15) NOT NULL,
  `time` int(10) unsigned NOT NULL,
  `read` tinyint(1) unsigned NOT NULL DEFAULT '0',
  KEY `id` (`id`),
  KEY `time` (`time`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- �������е����� `{table_prefix}sms`
--

INSERT INTO `{table_prefix}sms` (`id`, `title`, `content`, `from`, `fromnkname`, `to`, `time`, `read`) VALUES
(1, '��ϲ�����Ѿ��ɹ�ע�᱾��̳!', '���������ص��ط��ɷ��棬лл��', '�ÿͶ���̳', '', 'fkduo', 1259053045, 1);

-- --------------------------------------------------------

--
-- ��Ľṹ `{table_prefix}sort`
--

DROP TABLE IF EXISTS `{table_prefix}sort`;
CREATE TABLE `{table_prefix}sort` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `bk` smallint(6) unsigned NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- �������е����� `{table_prefix}sort`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `{table_prefix}user`
--

DROP TABLE IF EXISTS `{table_prefix}user`;
CREATE TABLE `{table_prefix}user` (
  `uid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `logname` char(15) NOT NULL DEFAULT '0',
  `pass` char(32) NOT NULL DEFAULT '0',
  `power` tinyint(2) unsigned NOT NULL DEFAULT '9',
  `email` char(32) NOT NULL DEFAULT '0',
  `nickname` varchar(12) NOT NULL DEFAULT '0',
  `hp` mediumint(8) unsigned NOT NULL DEFAULT '1',
  `pp` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `area` char(4) NOT NULL DEFAULT '����',
  `ppallow` smallint(6) unsigned NOT NULL DEFAULT '0',
  `picallow` smallint(6) unsigned NOT NULL DEFAULT '0',
  `favcount` smallint(6) unsigned NOT NULL DEFAULT '0',
  `regtime` int(10) unsigned NOT NULL DEFAULT '0',
  `lasttime` int(10) unsigned NOT NULL DEFAULT '0',
  `salt` char(6) NOT NULL,
  `sign` varchar(140) NOT NULL DEFAULT '��һ������û��дǩ����',
  `face` char(3) NOT NULL DEFAULT '1',
  `zts` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `hfs` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lock` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `locktime` int(10) unsigned NOT NULL DEFAULT '0',
  `lastft` int(10) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `logname` (`logname`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- �������е����� `{table_prefix}user`
--

INSERT INTO `{table_prefix}user` (`uid`, `logname`, `pass`, `power`, `email`, `nickname`, `hp`, `pp`, `area`, `ppallow`, `picallow`, `favcount`, `regtime`, `lasttime`, `salt`, `sign`, `face`, `zts`, `hfs`, `lock`, `locktime`, `lastft`) VALUES
(1, 'fkduo', 'e2af7d50bb5c00451231fd233e622932', 3, 'test@fkduo.cn', 'fkduo', 1, 0, 'no', 0, 0, 0, 1259053045, 1259053547, '5b442c', 'no sign', '1', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- ��Ľṹ `{table_prefix}userlog`
--

DROP TABLE IF EXISTS `{table_prefix}userlog`;
CREATE TABLE `{table_prefix}userlog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `logip` varchar(15) NOT NULL,
  `errortime` int(10) unsigned NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- �������е����� `{table_prefix}userlog`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `{table_prefix}zhuti`
--

DROP TABLE IF EXISTS `{table_prefix}zhuti`;
CREATE TABLE `{table_prefix}zhuti` (
  `cid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `bk` smallint(6) unsigned NOT NULL,
  `title` varchar(80) NOT NULL,
  `content` mediumtext NOT NULL,
  `click` int(10) unsigned NOT NULL DEFAULT '0',
  `huifu` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `huifuall` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `firstnkname` varchar(12) NOT NULL,
  `firstlogname` char(15) NOT NULL,
  `firsttime` int(10) unsigned NOT NULL,
  `lastnkname` varchar(12) NOT NULL DEFAULT '0',
  `lastlogname` char(15) NOT NULL,
  `lasttime` int(10) unsigned NOT NULL,
  `hp` mediumint(8) unsigned NOT NULL,
  `pp` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `area` char(4) NOT NULL DEFAULT 'no',
  `regtime` int(10) NOT NULL,
  `favcount` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ip` varchar(15) NOT NULL,
  `sign` varchar(140) NOT NULL,
  `pic` varchar(100) NOT NULL DEFAULT '0',
  `img` varchar(100) NOT NULL DEFAULT '0',
  `zd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hs` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `pb` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `jh` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `tj` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `lock` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `through` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `edit` int(10) unsigned NOT NULL DEFAULT '0',
  `prizepp` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `zts` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `hfs` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `face` char(3) NOT NULL DEFAULT '1',
  `sort` varchar(20) NOT NULL,
  `edits` smallint(4) unsigned NOT NULL DEFAULT '0',
  `replyview` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `highlight` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`cid`),
  KEY `lasttime` (`lasttime`),
  FULLTEXT KEY `title` (`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- �������е����� `{table_prefix}zhuti`
--

INSERT INTO `{table_prefix}zhuti` (`cid`, `bk`, `title`, `content`, `click`, `huifu`, `huifuall`, `firstnkname`, `firstlogname`, `firsttime`, `lastnkname`, `lastlogname`, `lasttime`, `hp`, `pp`, `area`, `regtime`, `favcount`, `ip`, `sign`, `pic`, `img`, `zd`, `hs`, `pb`, `jh`, `tj`, `lock`, `through`, `edit`, `prizepp`, `zts`, `hfs`, `face`, `sort`, `edits`, `replyview`, `highlight`) VALUES
(1, 1, '��ϲ������װ�ɹ�����', '<br />�ÿͶ���̳ <br />��ǰ�汾:fkduo 1.1��<br /><br />ʹ�÷��������κ����⣬�뵽�ٷ���վ��ѯ:<br /><a href="http://www.fkduo.cn/" target="_blank">http://www.fkduo.cn/</a><br /><br />ף��ʹ����죡', 0, 0, 0, 'fkduo', 'fkduo', 1259053206, 'fkduo', 'fkduo', 1259053206, 0, 0, 'no', 0, 0, '', '', '0', '0', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '1', '', 0, 0, 0);
