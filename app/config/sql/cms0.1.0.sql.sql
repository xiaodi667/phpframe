-- phpMyAdmin SQL Dump
-- version 2.11.3deb1ubuntu1.3
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2009 年 12 月 08 日 13:51
-- 服务器版本: 5.0.51
-- PHP 版本: 5.2.4-2ubuntu5.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 数据库: `cctv_web`
--

-- --------------------------------------------------------

--
-- 表的结构 `wp_admins`
--

DROP TABLE IF EXISTS `wp_admins`;
CREATE TABLE IF NOT EXISTS `wp_admins` (
  `id` int(4) NOT NULL auto_increment,
  `username` varchar(100) collate utf8_unicode_ci NOT NULL,
  `password` varchar(100) collate utf8_unicode_ci NOT NULL,
  `gid` tinyint(3) NOT NULL,
  `group_name` varchar(20) collate utf8_unicode_ci NOT NULL,
  `uid` int(11) NOT NULL,
  `power` text collate utf8_unicode_ci NOT NULL,
  `remark` text collate utf8_unicode_ci NOT NULL,
  `addtime` int(11) NOT NULL,
  `nickname` varchar(30) collate utf8_unicode_ci NOT NULL,
  `displayname` varchar(30) collate utf8_unicode_ci NOT NULL,
  `user_status` tinyint(4) NOT NULL COMMENT '0正常1删除',
  `user_email` varchar(100) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=50 ;

--
-- 导出表中的数据 `wp_admins`
--

INSERT INTO `wp_admins` (`id`, `username`, `password`, `gid`, `group_name`, `uid`, `power`, `remark`, `addtime`, `nickname`, `displayname`, `user_status`, `user_email`) VALUES
(1, 'admin', '8d6ae58fb304f32fd1205381be8e4e28', 1, '超级管理员', 0, 'news_edit,admin_news,news_add,news_pub,comment_tuijian,user_report,admin_group_edit,admin_group,admin_group_add,admin_group_del,admin_edit,login,admin_user_edit,admin_user,admin_user_add,admin_user_del,tuijian_hide,tuijian_edit,tuijian_admin,tuijian_add,tuijian_editmod,tuijian_createmod,tuijian_del,tuijian_list,area_admin,articles_comment,articles_edit,articles_admin,articles_add,articles_shenhe,articles_del,articles_class,member_admin,member_head', '', 0, '', '', 0, ''),
(2, 'autopost', 'e10adc3949ba59abbe56e057f20f883e', 3, '编辑', 0, 'tuijian,tuijian_add,tuijian_list,zixun,new_zixun,section,zixun_del,zixun_edit,zixun_list,zixun_add', '', 1244599055, 'autopost', 'autopost', 0, 'autopost@gemantic.com'),
(3, 'wangxi', 'e10adc3949ba59abbe56e057f20f883e', 1, '超级管理员', 0, 'news_edit,admin_news,news_add,news_pub,comment_tuijian,user_report,admin_group_edit,admin_group,admin_group_add,admin_group_del,admin_edit,login,admin_user_edit,admin_user,admin_user_add,admin_user_del,tuijian_hide,tuijian_edit,tuijian_admin,tuijian_add,tuijian_editmod,tuijian_createmod,tuijian_del,tuijian_list,area_admin,articles_comment,articles_edit,articles_admin,articles_add,articles_shenhe,articles_del,articles_class,member_admin,member_head', 'wangxi', 1244622594, 'wangxi', 'wangxi', 0, 'tzhang@gemantic.com'),
(4, 'zhongqing', 'e10adc3949ba59abbe56e057f20f883e', 1, '超级管理员', 0, 'news_edit,admin_news,news_add,news_pub,comment_tuijian,user_report,admin_group_edit,admin_group,admin_group_add,admin_group_del,admin_edit,login,admin_user_edit,admin_user,admin_user_add,admin_user_del,tuijian_hide,tuijian_edit,tuijian_admin,tuijian_add,tuijian_editmod,tuijian_createmod,tuijian_del,tuijian_list,area_admin,articles_comment,articles_edit,articles_admin,articles_add,articles_shenhe,articles_del,articles_class,member_admin,member_head', 'zhongqing', 1245290442, 'zhongqing', 'zhongqing', 0, 'lwang@gemantic.com'),
(5, 'penghuan', '5a105e8b9d40e1329780d62ea2265d8a', 4, '兼职编辑', 0, 'user_report,goal_edit,goal_add,goal_shenhe,goal_admin,goal_del,articles_edit,articles_admin,articles_add,place_caiji,place_jiesuan,place_admin,place_myedit', 'penghuan', 1245826095, 'penghuan', 'penghuan', 0, 'hpeng@gemantic.com'),
(6, 'kongmingjie', 'e10adc3949ba59abbe56e057f20f883e', 2, '管理员', 0, 'place,place_jq_liebiao,place_add_jq,place_region,place_mine,place_shenhe,place_caiji,place_liebiao,place_index,place_add,tuijian,tuijian_add,tuijian_list,user,user_report,user_list,user_group,user_groups,user_member', 'kongmingjie', 1258820886, 'kongmingjie', 'kongmingjie', 0, 'mkong@gemantic.com'),
(49, 'xiaodi667', 'e10adc3949ba59abbe56e057f20f883e', 8, '系统管理员', 0, 'luntan,db,db_dict,db_restore,db_backup,friendlink,friendlink_liebiao,friendlink_add,book,book_reg,book_index,tuijian,tuijian_add,tuijian_list,user,user_report,user_list,user_group,user_groups,user_member,fenlei,fenlei_shanghu,fenlei_area,system,system_cache,mokuai,mokuai_list,mokuai_add,zixun,zixun_html,section,zixun_del,zixun_edit,zixun_list,zixun_add', '', 1257682922, '', '', 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `wp_admins_group`
--

DROP TABLE IF EXISTS `wp_admins_group`;
CREATE TABLE IF NOT EXISTS `wp_admins_group` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `power` text NOT NULL,
  `is_super` tinyint(1) NOT NULL,
  `is_limit` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 导出表中的数据 `wp_admins_group`
--

INSERT INTO `wp_admins_group` (`id`, `name`, `power`, `is_super`, `is_limit`) VALUES
(1, '超级管理员', 'news_edit,admin_news,news_add,news_pub,comment_tuijian,user_report,admin_group_edit,admin_group,admin_group_add,admin_group_del,admin_edit,login,admin_user_edit,admin_user,admin_user_add,admin_user_del,tuijian_hide,tuijian_edit,tuijian_admin,tuijian_add,tuijian_editmod,tuijian_createmod,tuijian_del,tuijian_list,area_admin,articles_comment,articles_edit,articles_admin,articles_add,articles_shenhe,articles_del,articles_class,member_admin,member_head', 1, 0),
(2, '管理员', 'place,place_jq_liebiao,place_add_jq,place_region,place_mine,place_shenhe,place_caiji,place_liebiao,place_index,place_add,tuijian,tuijian_add,tuijian_list,user,user_report,user_list,user_group,user_groups,user_member', 0, 0),
(3, '编辑', 'tuijian,tuijian_add,tuijian_list,zixun,new_zixun,section,zixun_del,zixun_edit,zixun_list,zixun_add', 0, 1),
(4, '兼职编辑', 'user_report,goal_edit,goal_add,goal_shenhe,goal_admin,goal_del,articles_edit,articles_admin,articles_add,place_caiji,place_jiesuan,place_admin,place_myedit', 0, 1),
(5, '离职', '', 0, 0),
(6, '', '', 0, 0),
(8, '系统管理员', 'luntan,db,db_dict,db_restore,db_backup,friendlink,friendlink_liebiao,friendlink_add,book,book_reg,book_index,tuijian,tuijian_add,tuijian_list,user,user_report,user_list,user_group,user_groups,user_member,fenlei,fenlei_shanghu,fenlei_area,system,system_cache,mokuai,mokuai_list,mokuai_add,zixun,zixun_html,section,zixun_del,zixun_edit,zixun_list,zixun_add', 1, 0),
(9, 'tt', 'place,place_jq_liebiao,place_add_jq,place_region,place_mine,place_shenhe,place_caiji,place_liebiao,place_index,place_add,tool,tool_link,order,order_cangku,order_orders,order_attr_list,order_fenlei,order_add,order_vlist,order_list,db,db_dict,db_restore,db_backup,friendlink,friendlink_liebiao,friendlink_add,book,book_reg,book_index,julebu,julebu_fenlei,julebu_add,julebu_liebiao,quanzi,quanzi_liebiao,quanzi_create,quanzi_fenlei,map,map_search,map_articles,map_list,tuijian,tuijian_add,tuijian_list,user,user_report,user_list,user_group,user_groups,user_member,fenlei,fenlei_shanghu,fenlei_area,shanghu,shanghu_caiji,shanghu_pinglun,shanghu_liebiao,shanghu_add,img,img_list,system,system_cache,event,event_fenlei,event_add,event_list,mokuai,mokuai_list,mokuai_add,zixun,zixun_html,section,zixun_del,zixun_edit,zixun_list,zixun_add', 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `wp_friendlinks`
--

DROP TABLE IF EXISTS `wp_friendlinks`;
CREATE TABLE IF NOT EXISTS `wp_friendlinks` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `url` varchar(100) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `shenhe` tinyint(1) NOT NULL,
  `link_order` int(11) NOT NULL COMMENT '友情链接排序',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- 导出表中的数据 `wp_friendlinks`
--

INSERT INTO `wp_friendlinks` (`id`, `name`, `url`, `description`, `logo`, `shenhe`, `link_order`) VALUES
(9, '22', '22', '22', 'http://test.img.huixiaofei.com/up/c3/28dfa0c5c825bd5f3deb5d33bbf0ab/0-f8b6-1-0-2-176x188z1.jpg', 1, 9),
(8, '11', '11', '11', 'http://test.img.huixiaofei.com/up/1f/6a152c1f2bfcfe76aa65360917b602/0-c9b0-1-0-2-460x294z1.jpg', 1, 8),
(10, '33', '33', '33', 'http://test.img.huixiaofei.com/up/2e/c92c73c5f0a4cb8e8e5edf7c29bca1/0-c45f-1-0-2-1127x689z1.jpg', 1, 10),
(11, '44', '44', '44', 'http://test.img.huixiaofei.com/up/b6/643ca632d55f026278de33ff11d779/0-fff4-1-0-2-140x105z1.jpg', 1, 11),
(12, '55', '55', '55', 'http://test.img.huixiaofei.com/up/a9/678adafc943e7f867c44ce415a9ed7/0-8237-1-0-2-800x600z1.jpg', 1, 12),
(13, 'rtey的根深蒂固', '', '', '', 1, 13),
(14, '的是感到反感', '', '', '', 1, 14),
(15, 'sssss', 'http://www.huiyoula.com/admins/main', 'http://www.huiyoula.com/admins/mainsss', 'http://img.myself.com/up/0b/90bd6d0b8421f0de69ad7c849df891/0-2be1-1-0-2-147x138z1.jpg', 1, 15);

-- --------------------------------------------------------

--
-- 表的结构 `wp_modules`
--

DROP TABLE IF EXISTS `wp_modules`;
CREATE TABLE IF NOT EXISTS `wp_modules` (
  `id` int(8) NOT NULL auto_increment,
  `cid` int(4) NOT NULL,
  `name` varchar(200) NOT NULL,
  `introduce` text NOT NULL,
  `addtime` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `wp_modules`
--

INSERT INTO `wp_modules` (`id`, `cid`, `name`, `introduce`, `addtime`, `status`) VALUES
(1, 0, '终端幻灯片', '终端幻灯片', 1259829700, 0);

-- --------------------------------------------------------

--
-- 表的结构 `wp_module_list`
--

DROP TABLE IF EXISTS `wp_module_list`;
CREATE TABLE IF NOT EXISTS `wp_module_list` (
  `id` int(11) NOT NULL auto_increment,
  `mid` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `realdate` date NOT NULL,
  `title_style` varchar(255) NOT NULL,
  `pic` varchar(200) NOT NULL,
  `link` varchar(200) NOT NULL,
  `orders` tinyint(2) NOT NULL default '0',
  `pos` int(11) NOT NULL default '0',
  `addtime` int(11) NOT NULL,
  `content` text NOT NULL,
  `hide` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `pos` (`pos`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 导出表中的数据 `wp_module_list`
--

INSERT INTO `wp_module_list` (`id`, `mid`, `title`, `realdate`, `title_style`, `pic`, `link`, `orders`, `pos`, `addtime`, `content`, `hide`) VALUES
(1, 1, '古井贡酒异动', '0000-00-00', '', '/php/uploads/IMG_0118.JPG', 'http://newcms.gemantic.com/news/tindex', 0, 0, 1259829761, '淡淡的', 0),
(2, 1, '2800元/3居 - 精装大三居改成2居室求合租中介勿扰', '0000-00-00', 'werqwer', '/php/uploads/IMG_0119.JPG', 'http://newcms.gemantic.com/news/tindex', 0, 0, 1259829970, '得到', 0),
(3, 1, '阿搜多发送地方', '0000-00-00', 'werqwer', '/php/uploads/IMG_0120.JPG', '/admin_news/cindex', 0, 0, 1259829981, '搜多发送地方', 0);

-- --------------------------------------------------------

--
-- 表的结构 `wp_mokuai`
--

DROP TABLE IF EXISTS `wp_mokuai`;
CREATE TABLE IF NOT EXISTS `wp_mokuai` (
  `id` int(11) NOT NULL auto_increment,
  `fid` int(11) NOT NULL,
  `name` varchar(50) collate utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `tag` varchar(50) collate utf8_unicode_ci NOT NULL,
  `link` varchar(100) collate utf8_unicode_ci NOT NULL,
  `is_del` int(11) NOT NULL,
  `addtime` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=83 ;

--
-- 导出表中的数据 `wp_mokuai`
--

INSERT INTO `wp_mokuai` (`id`, `fid`, `name`, `order`, `tag`, `link`, `is_del`, `addtime`) VALUES
(1, 0, '资讯管理', 1, 'zixun', '＃', 0, 1256810492),
(2, 1, '添加资讯', 2, 'zixun_add', '/admin_news/add', 0, 1256810715),
(3, 1, '资讯列表', 3, 'zixun_list', '/admin_news/newslist', 0, 1256810773),
(4, 1, '修改资讯', 0, 'zixun_edit', '', 0, 1256810841),
(5, 1, '删除资讯', 0, 'zixun_del', '', 0, 1256810872),
(6, 0, '网站栏目管理', 0, 'mokuai', '#', 0, 1256988900),
(7, 6, '添加模块', 0, 'mokuai_add', '/admin_mokuai/add', 0, 1256988948),
(8, 6, '模块列表', 0, 'mokuai_list', '/admin_mokuai/index', 0, 1256989001),
(13, 0, '系统管理', 0, 'system', '#', 0, 1257602080),
(14, 13, '缓存管理', 0, 'system_cache', '/admin_cache/index', 0, 1257602138),
(25, 0, '用户管理', 0, 'user', '＃', 0, 1257670139),
(28, 25, '用户组类', 0, 'user_group', '/admins_users/group', 0, 1257670332),
(29, 25, '用户列表', 0, 'user_list', '/admins_users/users_list', 0, 1257670389),
(31, 0, '推荐功能', 0, 'tuijian', '#', 0, 1257670500),
(32, 31, '推荐列表', 0, 'tuijian_list', '/admin_tuijian/index', 0, 1257670587),
(33, 31, '添加推荐', 0, 'tuijian_add', '/admin_tuijian/add', 0, 1257670624),
(49, 0, '有情链接', 0, 'friendlink', '#', 0, 1257672139),
(50, 49, '添加链接', 0, 'friendlink_add', '/friendlink/add', 0, 1257672187),
(51, 49, '链接列表', 0, 'friendlink_liebiao', '/friendlink/liebiao', 0, 1257672244),
(82, 1, '资讯分类', 0, 'new_zixun', '/admin_news/catlist', 0, 1259636829),
(76, 1, '碎片管理', 0, 'section', '/admin_section', 0, 1258794097),
(77, 1, '静态页面管理', 0, 'zixun_html', '/admin_news/html', 0, 1258809337);

-- --------------------------------------------------------

--
-- 表的结构 `wp_section_main`
--

DROP TABLE IF EXISTS `wp_section_main`;
CREATE TABLE IF NOT EXISTS `wp_section_main` (
  `name` varchar(20) NOT NULL,
  `code` text NOT NULL,
  `last_time` int(11) NOT NULL,
  PRIMARY KEY  (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 导出表中的数据 `wp_section_main`
--

INSERT INTO `wp_section_main` (`name`, `code`, `last_time`) VALUES
('4444', '44444444444444444444444444444444444444\r\n<table border=1>\r\n<tr><td>DDDDD</td></tr></table>', 1258809196),
('terminal_top', '<h2><a href=\\\\\\"http://cms.gemantic.com/08957042-65ba-4006-a974-959c07560eb6/200912011012794.html\\\\\\">A股逼近3200点整数关口 仍然保持向上格局</a></h2>\r\n<div class=\\\\\\"headlines\\\\\\"><a href=\\\\\\"http://cms.gemantic.com/a7b6f33a-d089-446f-9566-38b9cd92d07f/20091116967258.html\\\\\\">[大盘分析]</a><a href=\\\\\\"http://cms.gemantic.com/138ae5ba-f30e-43b8-a2a1-1876217bd463/200912011012831.html\\\\\\">医改概念股早盘涨幅居首</a>|<a href=\\\\\\"http://cms.gemantic.com/08957042-65ba-4006-a974-959c07560eb6/200912011012527.html\\\\\\">A股市场：渐入风格转换关键期</a></div>\r\n<div class=\\\\\\"headlines\\\\\\"><a href=\\\\\\"http://cms.gemantic.com/c/09246305-2578-43f9-9e48-b5af2937dc70\\\\\\">[公司要闻]</a><a href=\\\\\\"http://cms.gemantic.com/138ae5ba-f30e-43b8-a2a1-1876217bd463/200912011012489.html\\\\\\">天坛生物再获348万剂甲流疫苗订单</a>|<a href=\\\\\\"http://cms.gemantic.com/138ae5ba-f30e-43b8-a2a1-1876217bd463/200912011012437.html\\\\\\">龙元建设签署30亿工程</a></div>\r\n<h2><a href=\\\\\\"http://cms.gemantic.com/bd946cfd-6717-42c1-b13f-b9ccbebfecb6/200912011012787.html\\\\\\">工信部发布新车目录 车市将添新生力量</a><a href=\\\\\\"http://cms.gemantic.com/bd946cfd-6717-42c1-b13f-b9ccbebfecb6/200911301011946.html\\\\\\"></a></h2>\r\n<div class=\\\\\\"headlines\\\\\\"><a href=\\\\\\"http://cms-staging.gemantic.com/c/f53c2901-1500-41d6-9f99-3a2ede0ac394\\\\\\">[行业观察]</a> <a href=\\\\\\"http://cms.gemantic.com/24a91f97-a6fb-427c-837e-be99c929c7ac/200912011012354.html\\\\\\">《医保目录》出炉 治疗性基本药物全额报销</a>|</div>\r\n<div class=\\\\\\"headlines\\\\\\"><a href=\\\\\\"http://cms.gemantic.com/cbc0b046-e25c-4296-8fd7-dc81b04768ff/20091116967128.html\\\\\\">[环球播报]</a><a href=\\\\\\"http://cms.gemantic.com/64e0ff80-67ce-4ed0-97a9-be97166f0450/200912011012507.html\\\\\\">金融股尾盘转强 推动美股走高</a>|<a href=\\\\\\"http://cms.gemantic.com/64e0ff80-67ce-4ed0-97a9-be97166f0450/200912011012522.html\\\\\\">日本处于通货紧缩状态</a></div>\r\n<hr class=\\\\\\"dotted\\\\\\" style=\\\\\\"margin-top:5px\\\\\\" />\r\n	<li><a href=\\\\\\"http://cms.gemantic.com/bd946cfd-6717-42c1-b13f-b9ccbebfecb6/200912011012538.html\\\\\\">国内油价下一调价窗口临近</a> <a href=\\\\\\"http://cms.gemantic.com/24a91f97-a6fb-427c-837e-be99c929c7ac/200911301012066.html\\\\\\">味精价格每吨再涨700元</a><a href=\\\\\\"http://cms.gemantic.com/09246305-2578-43f9-9e48-b5af2937dc70/20091123981052.html\\\\\\"></a></li>\r\n	<li><a href=\\\\\\"http://cms.gemantic.com/138ae5ba-f30e-43b8-a2a1-1876217bd463/200912011012789.html\\\\\\">钢铁行业数据周报：钢价小幅上涨</a> <a href=\\\\\\"http://cms.gemantic.com/08957042-65ba-4006-a974-959c07560eb6/200912011012227.html\\\\\\">FMG中国价格已失效</a><a href=\\\\\\"http://cms.gemantic.com/08957042-65ba-4006-a974-959c07560eb6/200911301011508.html\\\\\\"></a></li>\r\n	<li><a href=\\\\\\"http://cms.gemantic.com/138ae5ba-f30e-43b8-a2a1-1876217bd463/200912011012809.html\\\\\\">海信电器领涨电器股 大幅拉升</a> <a href=\\\\\\"http://cms.gemantic.com/08957042-65ba-4006-a974-959c07560eb6/200912011012484.html\\\\\\">多项新能源鼓励政策呼之欲出</a><a href=\\\\\\"http://cms.gemantic.com/08957042-65ba-4006-a974-959c07560eb6/200911301011508.html\\\\\\"></a><a href=\\\\\\"http://cms.gemantic.com/09246305-2578-43f9-9e48-b5af2937dc70/20091120975434.html\\\\\\"></a></li>\r\n	<li><a href=\\\\\\"http://cms.gemantic.com/138ae5ba-f30e-43b8-a2a1-1876217bd463/200912011012681.html\\\\\\">星马汽车发布重组方案：收购华菱汽车100%股权</a><a href=\\\\\\"http://cms.gemantic.com/08957042-65ba-4006-a974-959c07560eb6/200911301011508.html\\\\\\"></a><a href=\\\\\\"http://cms.gemantic.com/09246305-2578-43f9-9e48-b5af2937dc70/20091120975434.html\\\\\\"></a></li>', 1259821015),
('test', '<h2><a href=\\"http://cms.gemantic.com/08957042-65ba-4006-a974-959c07560eb6/200912011012794.html\\">A股逼近3200点整数关口 仍然保持向上格局</a></h2>\r\n<div class=\\"headlines\\"><a href=\\"http://cms.gemantic.com/a7b6f33a-d089-446f-9566-38b9cd92d07f/20091116967258.html\\">[大盘分析]</a><a href=\\"http://cms.gemantic.com/138ae5ba-f30e-43b8-a2a1-1876217bd463/200912011012831.html\\">医改概念股早盘涨幅居首</a>|<a href=\\"http://cms.gemantic.com/08957042-65ba-4006-a974-959c07560eb6/200912011012527.html\\">A股市场：渐入风格转换关键期</a></div>\r\n<div class=\\"headlines\\"><a href=\\"http://cms.gemantic.com/c/09246305-2578-43f9-9e48-b5af2937dc70\\">[公司要闻]</a><a href=\\"http://cms.gemantic.com/138ae5ba-f30e-43b8-a2a1-1876217bd463/200912011012489.html\\">天坛生物再获348万剂甲流疫苗订单</a>|<a href=\\"http://cms.gemantic.com/138ae5ba-f30e-43b8-a2a1-1876217bd463/200912011012437.html\\">龙元建设签署30亿工程</a></div>\r\n<h2><a href=\\"http://cms.gemantic.com/bd946cfd-6717-42c1-b13f-b9ccbebfecb6/200912011012787.html\\">工信部发布新车目录 车市将添新生力量</a><a href=\\"http://cms.gemantic.com/bd946cfd-6717-42c1-b13f-b9ccbebfecb6/200911301011946.html\\"></a></h2>\r\n<div class=\\"headlines\\"><a href=\\"http://cms-staging.gemantic.com/c/f53c2901-1500-41d6-9f99-3a2ede0ac394\\">[行业观察]</a> <a href=\\"http://cms.gemantic.com/24a91f97-a6fb-427c-837e-be99c929c7ac/200912011012354.html\\">《医保目录》出炉 治疗性基本药物全额报销</a>|</div>\r\n<div class=\\"headlines\\"><a href=\\"http://cms.gemantic.com/cbc0b046-e25c-4296-8fd7-dc81b04768ff/20091116967128.html\\">[环球播报]</a><a href=\\"http://cms.gemantic.com/64e0ff80-67ce-4ed0-97a9-be97166f0450/200912011012507.html\\">金融股尾盘转强 推动美股走高</a>|<a href=\\"http://cms.gemantic.com/64e0ff80-67ce-4ed0-97a9-be97166f0450/200912011012522.html\\">日本处于通货紧缩状态</a></div>\r\n<hr class=\\"dotted\\" style=\\"margin-top:5px\\" />\r\n	<li><a href=\\"http://cms.gemantic.com/bd946cfd-6717-42c1-b13f-b9ccbebfecb6/200912011012538.html\\">国内油价下一调价窗口临近</a> <a href=\\"http://cms.gemantic.com/24a91f97-a6fb-427c-837e-be99c929c7ac/200911301012066.html\\">味精价格每吨再涨700元</a><a href=\\"http://cms.gemantic.com/09246305-2578-43f9-9e48-b5af2937dc70/20091123981052.html\\"></a></li>\r\n	<li><a href=\\"http://cms.gemantic.com/138ae5ba-f30e-43b8-a2a1-1876217bd463/200912011012789.html\\">钢铁行业数据周报：钢价小幅上涨</a> <a href=\\"http://cms.gemantic.com/08957042-65ba-4006-a974-959c07560eb6/200912011012227.html\\">FMG中国价格已失效</a><a href=\\"http://cms.gemantic.com/08957042-65ba-4006-a974-959c07560eb6/200911301011508.html\\"></a></li>\r\n	<li><a href=\\"http://cms.gemantic.com/138ae5ba-f30e-43b8-a2a1-1876217bd463/200912011012809.html\\">海信电器领涨电器股 大幅拉升</a> <a href=\\"http://cms.gemantic.com/08957042-65ba-4006-a974-959c07560eb6/200912011012484.html\\">多项新能源鼓励政策呼之欲出</a><a href=\\"http://cms.gemantic.com/08957042-65ba-4006-a974-959c07560eb6/200911301011508.html\\"></a><a href=\\"http://cms.gemantic.com/09246305-2578-43f9-9e48-b5af2937dc70/20091120975434.html\\"></a></li>\r\n	<li><a href=\\"http://cms.gemantic.com/138ae5ba-f30e-43b8-a2a1-1876217bd463/200912011012681.html\\">星马汽车发布重组方案：收购华菱汽车100%股权</a><a href=\\"http://cms.gemantic.com/08957042-65ba-4006-a974-959c07560eb6/200911301011508.html\\"></a><a href=\\"http://cms.gemantic.com/09246305-2578-43f9-9e48-b5af2937dc70/20091120975434.html\\"></a></li>', 1259820996),
('目的地首页-热门搜索', '<a href="?page=search&kw=北京">北京</a> \r\n<a href="?page=search&kw=北京">北京</a> \r\n<a href="?page=search&kw=北京">北京</a> \r\n<a href="?page=search&kw=北京">北京</a> \r\n<a href="?page=search&kw=北京">北京</a> \r\n<a href="?page=search&kw=北京">北京</a> \r\n<a href="?page=search&kw=北京">北京</a> \r\n<a href="?page=search&kw=北京">北京</a> \r\n<a href="?page=search&kw=北京">北京</a>', 1242721641);


ALTER TABLE `wp_posts` ADD `tags` VARCHAR( 100 ) NULL AFTER `post_important_score` ,
ADD `term_ids` VARCHAR( 100 ) NULL AFTER `tags` ,
ADD `term_names` VARCHAR( 200 ) NULL AFTER `term_ids` ;

ALTER TABLE `wp_posts` ADD INDEX ( `term_ids` ),
ALTER TABLE `wp_posts` ADD INDEX ( `term_names` )

ALTER TABLE `wp_term_taxonomy` ADD `level` INT( 4 )  NULL ,
ADD `orders` INT( 4 )  NULL DEFAULT '0' ,
ADD `pathint` VARCHAR( 100 )  NULL ,
ADD `pathchar` VARCHAR( 100 )  NULL ;

ALTER TABLE `wp_term_taxonomy` ADD `name` VARCHAR( 100 ) NULL AFTER `count` ,
ADD `slug` VARCHAR( 200 ) NULL AFTER `name` ;