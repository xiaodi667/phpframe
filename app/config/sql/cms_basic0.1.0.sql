cms_basic 库 wp_admins表
ALTER TABLE  `wp_admins` ADD  `logintimes` INT( 10 ) NOT NULL COMMENT  '登录次数';

stat_logs库download表
ALTER TABLE  `download` ADD  `modules` INT( 4 ) NOT NULL COMMENT  '1:事件;2:政策;3:专题;4:研报;5:新股'







analyse_event库news表
ALTER TABLE  `news` ADD  `img_type` TINYINT( 2 ) NULL COMMENT  '0正常1超宽2高窄',
ADD  `normal_img_url` VARCHAR( 255 ) NULL COMMENT  '原图地址'


ALTER TABLE  `topics` ADD  `macro_ref_keywords` VARCHAR( 200 ) NULL COMMENT  '专题宏观关键词',
ADD  `macro_ref_keywords_type` TINYINT( 2 ) NULL COMMENT  '专题宏观搜索类型'


ALTER TABLE  `news` CHANGE  `recommend`  `recommend` TINYINT( 4 ) NULL DEFAULT  '0' COMMENT  '是否推荐到资讯选股1推荐0不推荐'

ALTER TABLE  `stat_logs` ADD  `report_indicator` VARCHAR( 500 ) NOT NULL
ALTER TABLE  `stat_logs` CHANGE  `report_title`  `report_title` VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL