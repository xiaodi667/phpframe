<?php
global $config_remote;
$config_remote=array(
//index
'SEARCH_API_URI'=>'http://192.168.10.108:9999/gemantic/search.do',
'FACET_SEARCH_API_URI'=>'http://192.168.10.108:9999/gemantic/facetsearch.do',
'SEARCH_CMS_API'=>'http://192.168.10.80:9999/gemantic/cmssearch.do', //行业关键字索引接口
'SEARCH_SIMILER_API_URI'=>'http://192.168.10.108:9999/gemantic/dup.do',//相似新闻索引接口
'JSP_CACHE_URI'=>'http://219.143.244.246:8080/workflow/cache.jsp?',   //缓存网页
'COMPANY_SEARCH_URL'=>'http://192.168.10.53:8080/service/CompanySearchInfoService', //上市公司基本信息接口

'IMG_SERVER_URL'=>'http://img.gemantic.com/?page=image', //图片服务器的地址

'LOG_SERVER_URL'=>'http://192.168.10.63/api/postlog',  //日志接口

//股票代码接口
'ANALYSE_NLP_SERVICE'=>'http://analyse.nlp.home:9979/nlp/htmltext.do',
    
//热门关键词
'HOT_KW_NEWS_URL'=>'http://192.168.10.55:9084/hot/query.do',


//documentserver
'GET_CONTENT_URL'=>'http://10.0.0.139:9999/docserver-staging/single_search.do',//获得doc里数据的详细信息

'SEARCH_TIAOZHUAN_URL'=>'http://192.168.10.126:8999/docserver-staging/single_search.do',
'RELATE_SEARCH_URL'=>'http://192.168.10.233:8999/docserver-production/relevance.do',
'SEARCH_HIGHLIGHT_URL'=>'http://192.168.10.233:8999/docserver-production/search.do',
'SEARCH_CACHE_URL'=>'http://192.168.10.233:8999/doc_c/cache.do',  //documentsever_cache url


//webbasicinfo
'SMARTY_CACHE'=>false,
'COMPILE_CHECK'=>true,
'SITE_URL'=>'http://searchfe/',
'CACHE_ENABLE'=>true,
'SEARCH_URL'=>'http://searchfe.gemantic.com/',
'CMS_URL'=>'/',



//db
'DB_MASTER_NAME'=>array(
'driver' => 'mysql',
'host' => 'db.gemantic.cms.web',
'login' => 'cms',
'password' => 'cms123456',
'database' => 'cms',
'prefix' => 'wp_',
),
'DB_CLIENT_REPORT'=>array(
'driver' => 'mysql',
'host' => 'db.gemantic.analyse.event',
'login' => 'analyse',
'password' => 'GemanticYes!',
'database' => 'research_report',
'prefix' => '',
),
'DB_SLAVE_NAME'=>array(
'driver' => 'mysql',
'host' => 'db.gemantic.cms.web',
'login' => 'cms',
'password' => 'cms123456',
'database' => 'cms',
'prefix' => 'wp_',
),
'BASIC_MASTER_NAME'=>array(
'driver' => 'mysql',
'host' => 'db.gemantic.cms.admin',
'login' => 'cms',
'password' => 'cms123456',
'database' => 'cms_basic',
'prefix' => 'wp_',
),

    
'DB_CLIENT_EVENT'=>array(
'driver' => 'mysql',
'host' => 'db.gemantic.analyse.event',
'login' => 'analyse',
'password' => 'GemanticYes!',
'database' => 'analyse_event',
'prefix' => '',
),
'DB_CLIENT_PERSON'=>array(
'driver' => 'mysql',
'host' => 'db.gemantic.analyse.person',
'login' => 'analyse',
'password' => 'GemanticYes!',
'database' => 'analyse_person',
'prefix' => '',
),
    
'DB_CLIENT_INDICTOR'=>array(
'driver' => 'mysql',
'host' => 'db.gemantic.analyse.indictor',
'login' => 'analyse',
'password' => 'GemanticYes!',
'database' => 'analyse_indicator',
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
'DB_USER_MASTER'=>array(
'driver' => 'mysql',
'host' => 'db.gemantic.analyse.user',
'login' => 'analyse',
'password' => 'GemanticYes!',
'database' => 'analyse_user',
'prefix' => '',
),
'CONVERT'=>array(
'driver' => 'mysql',
'host' => 'db.gemantic.analyse.event',
'login' => 'analyse',
'password' => 'GemanticYes!',
'database' => 'convert',
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
);
?>