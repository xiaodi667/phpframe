<?php
global $config_remote;
$config_remote=array(
'SEARCH_API_URI'=>'http://192.168.10.108:8888/gemantic/search.do',
'SEARCH_SIMILER_API_URI'=>'http://192.168.10.108:8888/gemantic/dup.do',
'JSP_CACHE_URI'=>'http://192.168.10.101:8081/workflow/newspage_cache.jsp?', //缓存接口
'JSP_GDOC_URI'=>'http://192.168.10.101:8081/workflow/newspage_gdoc.jsp?',   //gdoc接口
'JSP_CRAWLDB_URI'=>'http://192.168.10.101:8081/workflow/newspage_crawldb.jsp?', //crowdb接口
'SEARCH_INFOS_API_URI'=>'http://192.168.10.101:8081/workflow/newspage_crawldb.jsp?',
'SITE_URL'=>'/',
'LOG_LEVEL'=>'PEAR_LOG_DEBUG',
'DEFAULT_THEME'=>'cctv',
'SEARCH_CMS_API'=>'http://192.168.10.108:8888/gemantic/cmssearch.do',
'SEARCH_HIGHLIGHT_URL'=>'http://192.168.10.233:9999/doc_c/search.do',  //documentsever url
'SEARCH_CACHE_URL'=>'http://192.168.10.233:9999/doc_c/cache.do',  //documentsever_cache url
'SEARCH_URL'=>'http://newcms.gemantic.com/',
'CMS_URL'=>'http://newcms.gemantic.com/',
);
?>