<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * The whole consts debug.
 */
if (!defined('DEBUG')){
    define('DEBUG',((isset($_SERVER["WP_ENV"])&&($_SERVER["WP_ENV"]=='productiona')||(isset($_SERVER["WP_ENV"])&&($_SERVER["WP_ENV"]=='productionb'))) ? 0 : 2));
}
if(!defined('DEFAULT_ENV')){
    define('DEFAULT_ENV', 'local');
}
if(!defined('WP_ENV')){
    define('WP_ENV', isset($_SERVER["WP_ENV"]) ? $_SERVER["WP_ENV"] : DEFAULT_ENV);
}
if(!defined('DEFAULT_WP_TYPE')){
    define('DEFAULT_WP_TYPE', 'admins');
}
if(!defined('WP_TYPE')){
    define('WP_TYPE', isset($_SERVER["WP_TYPE"]) ? $_SERVER["WP_TYPE"] : DEFAULT_WP_TYPE);
}
define('DATE_FORMAT','Y-m-d H:i:s');
define('GRAPH_SIZE',200);
define('MAX_ITEM_DUMP',50);

//临时定义
define('ROOT_TTID','00000000-0000-0000-0000-000000000000');  //父目录的ttid


define('INDUSTRY','行业');  //行业简称

define('STOCK','个股');  //个股简称
define('STOCK_CODE','000000');  //所有个股的代码简称

define('MACRO_NAME','宏观');  //宏观的代码简称(上证指数）
define('MACRO_CODE','sha_000001');  //宏观的代码简称(上证指数）

define('SWF_LIB_PATH',"/usr/local/bin/");  //swf lib类路径



define('WORLD_CODE','world');  //国际宏观的代码简称
define('WORLD_NAME','国际宏观');  //国际宏观的代码简称
define('IMG_SERVER_URL','IMG_SERVER_URL');  //图片服务器地址变量


define('EVENT','事件');  //事件的名字
define('POLICY','政策');  //政策的名字
define('INDICTOR','指标');  //指标的名字
define('OTHER','其它');  //其它的名字

//db
define('DB_CLIENT_EVENT','DB_CLIENT_EVENT');  //事件数据库库名
define('DETAIL','detail');  //详细信息的表名detail_relation
define('DETAIL_RELATION','detail_relation');  //关系表的表名

define('DB_THEME_OTHER','DB_THEME_OTHER');  //分类的其他数据库库名
define('ALL_THEMES','all_themes');  //所有主题的表名
define('DB_CLIENT_POLICY','DB_CLIENT_POLICY');  //政策数据库库名
define('DB_CLIENT_INDICTOR','DB_CLIENT_INDICTOR');  //指标数据库库名
define('AD_WEB_SERVER_URL','AD_WEB_SERVER_URL');  //指标数据库库名

?>
