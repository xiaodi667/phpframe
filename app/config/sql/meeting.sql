CREATE DATABASE  `meeting` ;

CREATE TABLE  `meeting`.`meeting` (
`id` BIGINT( 20 ) NOT NULL AUTO_INCREMENT ,
`title` VARCHAR( 200 ) NOT NULL ,
`subhead` VARCHAR( 200 ) NOT NULL ,
`start_time` BIGINT( 20 ) NOT NULL ,
`end_time` BIGINT( 20 ) NOT NULL ,
`type` TINYINT( 1 ) NOT NULL COMMENT  '类型1-宏观，2-行业，3-上市公司',
`pdf_url` VARCHAR( 200 ) NOT NULL ,
`description` TEXT NOT NULL ,
`create_at` BIGINT( 20 ) NOT NULL ,
`update_at` BIGINT( 20 ) NOT NULL ,
PRIMARY KEY (  `id` )
) ENGINE = INNODB;

CREATE TABLE  `meeting`.`meeting_detail` (
`id` BIGINT( 20 ) NOT NULL AUTO_INCREMENT ,
`mid` BIGINT( 20 ) NOT NULL ,
`content` TEXT NOT NULL ,
`img_url` VARCHAR( 200 ) NOT NULL ,
`uid` INT( 10 ) NOT NULL ,
`status` TINYINT( 1 ) NOT NULL ,
`create_at` BIGINT( 20 ) NOT NULL ,
`update_at` BIGINT( 20 ) NOT NULL ,
PRIMARY KEY (  `id` )
) ENGINE = INNODB;
