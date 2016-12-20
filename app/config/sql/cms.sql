CREATE TABLE  `cms_basic_dzg`.`wp_category` (
`id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
`fid` INT( 11 ) NOT NULL ,
`name` VARCHAR( 30 ) NOT NULL ,
`create_at` INT( 11 ) NOT NULL ,
`update_at` INT( 11 ) NOT NULL ,
PRIMARY KEY (  `id` )
) ENGINE = INNODB;

CREATE TABLE  `cms_basic_dzg`.`wp_news_tags_relation` (
`id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
`nid` INT( 11 ) NOT NULL ,
`tid` INT( 11 ) NOT NULL ,
`create_at` INT( 11 ) NOT NULL ,
`update_at` INT( 11 ) NOT NULL ,
PRIMARY KEY (  `id` )
) ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS `wp_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `sub_title` varchar(200) NOT NULL,
  `keywords` varchar(300) NOT NULL,
  `descriptions` varchar(500) NOT NULL,
  `html_url` varchar(200) NOT NULL,
  `img_url` varchar(100) NOT NULL,
  `author` varchar(50) NOT NULL,
  `publish_at` int(11) NOT NULL,
  `create_at` int(11) NOT NULL,
  `update_at` int(11) NOT NULL,
  `create_uid` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0正常1删除',
  `sequines` int(4) NOT NULL,
  `cat_id` int(4) NOT NULL,
  `source` varchar(100) NOT NULL COMMENT '来源',
  `is_show` tinyint(1) NOT NULL COMMENT '0正常1显示',
  `hits` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


CREATE TABLE  `cms_basic_dzg`.`wp_news_contents` (
`id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
`content` TEXT NOT NULL ,
`nid` INT NOT NULL ,
`create_at` INT( 11 ) NOT NULL ,
`update_at` INT( 11 ) NOT NULL ,
PRIMARY KEY (  `id` )
) ENGINE = INNODB;
