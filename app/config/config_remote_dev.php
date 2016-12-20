<?php
global $config_remote_dev;
$config_remote_dev = array(



'IMG_SERVER_URL'=>'http://staging.img.jinhui365.com/', //图片服务器的地址
'PDF_SERVER_URL'=>'http://download.rxhui.com/', //pdf服务器的地址
'LOGIN_SERVER_URL'=>'http://10.0.0.40:9096', //登录服务器的地址



//'MOVE_STATIC_DEPART_URL' => '',
'MOVE_STATIC_DEPART_URL' => '',
'MOVE_STATIC_DEPART_PATH' => '.',

//mogondb
'MOGONDB_NEWS_CONTENTS'=>'mongodb://admin:passw0rd@10.0.0.22',

//db
'BASIC_MASTER_NAME'=>array(
'driver' => 'mysql',
'host' => '10.0.0.20',
'login' => 'cms',
'password' => 'cms123456',
'database' => 'cms_basic_dzg',
 'prefix' => 'wp_',
 ),
'BASIC_MASTERCMS_NAME'=>array(
'driver' => 'mysql',
'host' => '10.0.0.20',
'login' => 'cms',
'password' => 'cms123456',
'database' => 'cms_basic_dzg',
'prefix' => 'wp_',
),

    
'DB_CLIENT_EVENT'=>array(
'driver' => 'mysql',
'host' => 'db.gemantic.analyse.event',
'login' => 'analyse',
'password' => 'GemanticYes!',
'database' => 'wealth_event',
'prefix' => '',
),
'DB_CLIENT_MEET'=>array(
'driver' => 'mysql',
'host' => 'db.gemantic.analyse.event',
'login' => 'analyse',
'password' => 'GemanticYes!',
'database' => 'meeting',
'prefix' => '',
),
'DB_STAT_LOG'=>array(
'driver' => 'mysql',
'host' => 'db.gemantic.analyse.event',
'login' => 'analyse',
'password' => 'GemanticYes!',
'database' => 'stat_logs',
'prefix' => '',
),
'DB_CLIENT_REPORT'=>array(
'driver' => 'mysql',
'host' => '10.0.0.20',
'login' => 'reportnew',
'password' => 'reportnew',
'database' => 'analyse_report',
'prefix' => '',
),
'DB_CLIENT_PERSON'=>array(
'driver' => 'mysql',
'host' => '10.0.0.20',
'login' => 'analyse',
'password' => 'GemanticYes!',
'database' => 'analyse_person',
'prefix' => '',
),
'DB_CLIENT_INDICTOR'=>array(
'driver' => 'mysql',
'host' => '10.0.0.20;port=3307',
'login' => 'analyse',
'password' => 'GemanticYes!',
'database' => 'analyse_indicator',
'port' => '3307',
'prefix' => '',
),
'DB_CLIENT_POLICY'=>array(
'driver' => 'mysql',
'host' => 'db.gemantic.analyse.policy',
'login' => 'analyse',
'password' => 'GemanticYes!',
'database' => 'analyse_policy',
'prefix' => '',
),
'DB_YANLUN_CATEGORY'=>array(
'driver' => 'mysql',
'host' => 'db.gemantic.nlp.category',
'login' => 'category',
'password' => 'GemanticYes!',
'database' => 'category',
'prefix' => '',
),
'CONVERTS'=>array(
'driver' => 'mysql',
'host' => 'db.gemantic.app.dict',
'login' => 'analyse',
'password' => 'GemanticYes!',
'database' => 'analyse_convert',
'prefix' => '',
),
'DB_CONVERT'=>array(
'driver' => 'mysql',
'host' => 'db.gemantic.app.dict',
'login' => 'analyse',
'password' => 'GemanticYes!',
'database' => 'analyse_convert',
'prefix' => '',
),
'DB_DICT'=>array(
'driver' => 'mysql',
'host' => 'db.gemantic.app.dict',
'login' => 'dic',
'password' => 'dicCool',
'database' => 'dict',
'prefix' => '',
),
'DB_THEME_OTHER'=>array(
'driver' => 'mysql',
'host' => 'db.gemantic.workflow.subject',
'login' => 'analyse',
'password' => 'GemanticYes!',
'database' => 'analyse_theme',
'prefix' => '',
),
'DB_USER_MASTER'=>array(
'driver' => 'mysql',
'host' => 'db.gemantic.analyse.user',
'login' => 'analyse',
'password' => 'GemanticYes!',
'database' => 'analyse_user',
'prefix' => '',
),
'DB_CLIENT_CMS'=>array(
'driver' => 'mysql',
'host' => 'db.gemantic.app.cms',
'login' => 'analyse',
'password' => 'GemanticYes!',
'database' => 'analyse_cms',
'prefix' => '',
),
'DB_CLIENT_HOT'=>array(
'driver' => 'mysql',
'host' => 'db.gemantic.hot',
'login' => 'analyse',
'password' => 'GemanticYes!',
'database' => 'hot',
'prefix' => '',
),
'DB_CLIENT_IDSEQENCES'=>array(
'driver' => 'mysql',
'host' => 'db.gemantic.analyse.event',
'login' => 'analyse',
'password' => 'GemanticYes!',
'database' => 'id_generator',
'prefix' => '',
),
'DB_TEST_STAGING'=>array(
'driver' => 'mysql',
'host' => '10.0.0.100',
'login' => 'staging',
'password' => 'n3KtxG',
'database' => 'id_generator',
'prefix' => '',
),
'DB_CLIENT_DOWNLOAD'=>array(
'driver' => 'mysql',
'host' => 'db.gemantic.analyse.event',
'login' => 'analyse',
'password' => 'GemanticYes!',
'database' => 'stat_logs_dzg',
'prefix' => '',
),
//数据中心（除权管理）数据库
'DC_DIVIDEND_DB'=>array(
'host' => '//db_gemantic.oracle.right/DCDEV',
'username' => 'STK_EXACT',
'password' => 'stk_exact',
),
'DZG_DB_YUYUE'=>array(
'driver' => 'mysql',
'host' => 'wealth_user_reserve',
'login' => 'ipad_user',
'password' => 'ipad_db2012!m',
'database' => 'wealth',
'prefix' => '',
),
'DZG_DB_AD'=>array(
'driver' => 'mysql',
'host' => '10.0.0.20;port=3307',
'login' => 'analyse',
'password' => 'GemanticYes!',
'database' => 'wealth-application',
'prefix' => '',
),
'DZG_DB_CHANNELS'=>array(
'driver' => 'mysql',
'host' => '10.0.0.20;port=3307',
'login' => 'analyse',
'password' => 'GemanticYes!',
'database' => 'channels',
'prefix' => '',
),
'DZG_DB_JISUAN'=>array(
'driver' => 'mysql',
'host' => '10.0.0.113;port=3307',
'login' => 'staging',
'password' => 'n3KtxG',
'database' => 'shujufenxi',
'prefix' => '',
),

);
?>
