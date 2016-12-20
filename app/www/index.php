<?php
header('Content-type: text/html; charset=utf-8');
$TIME_START = microtime(true);

ini_set('memory_limit', '-1');

//session_start();

    if (!defined('DS'))
    {
        define('DS', DIRECTORY_SEPARATOR);
    }

/**
 * The full path to the directory which holds "app", WITHOUT a trailing DS.
 *
 */
    if (!defined('ROOT')) {
            define('ROOT', dirname(dirname(dirname(__FILE__))));
    }
/**
 * The actual directory name for the "app".
 *
 */
    if (!defined('APP_DIR')) {
            define('APP_DIR', basename(dirname(dirname(__FILE__))));
    }

    if (!defined('CORE_INCLUDE_PATH'))
    {
        define('CORE_INCLUDE_PATH', ROOT);
    }

    if (!defined('CORE_PATH'))
    {
        define('CORE_PATH', CORE_INCLUDE_PATH . DS);
    }

    if (!defined('WWW_ROOT'))
    {
        define('WWW_ROOT', dirname(__FILE__));
    }
    if (!defined('PHPEXCEL_ROOT'))
    {
        define('PHPEXCEL_ROOT',ROOT.'/app/models/');
    }

    if (!defined('COMMENTS'))
    {
        define('COMMENTS',ROOT.'/app/controllers/comments');
    }
    if (!defined('THRIFT_ROOT'))
    {
        define('THRIFT_ROOT','/lib/php/src');
    }
    if (!defined('ABSPATH'))
    {
        define('ABSPATH', '/opt/cms/webtmp/');
    }







if (!include(CORE_PATH . 'core' . DS . 'bootstrap.php')) {
    //trigger_error("core could not be found.  Check the value of CORE_INCLUDE_PATH in APP/www/index.php.  It should point to the directory containing your " . DS . "cake core directory and your " . DS . "vendors root directory.", E_USER_ERROR);
    echo "check config！";
}
/* 数据过滤 */
if (!get_magic_quotes_gpc())
{
	$_GET     = htmlchars($_GET);
	$_POST    = htmlchars($_POST);
	//$_REQUEST = htmlchars($_REQUEST);
}

/**
 *
 * 引导文件
 */

if(!isset($_GET['page']))
{
    $_GET['page'] = 'index';
}

//前缀
$page = 'news_'.trim($_GET['page']);

//$page = trim($_GET['page']);
//测试文件类是否存在
//文件1
$is_ok = 0;

$page_file = array(
    _page_path.'/'.$page.'_controller.php', // cake 风格
    //_page_path.'/'.$page.'.php' ,//经典风格
);
foreach($page_file as $f)
{
    if(file_exists($f))
    {
        include($f);
        $is_ok=1;
        break;
    }
    else
    {
        header('location:/404.php');
        die();
    }
}
//404 错误
if(!$is_ok)
{
    header('location:/404.php');
    die;
}
$page_class_list = array('page_'.$page);
$is_load = 0;
foreach ($page_class_list as $page_class )
{
    if(!class_exists($page_class))
    {
        continue;
    }
    $is_load = 1;
    $obj = new $page_class();
    $obj->run();
}
$TIME_END = microtime(true);
 app_logic_log::log('页面加载时间','timer',array('pageload'=>$TIME_END-$TIME_START));

if(!$is_load)
{
    header('location:/404.php');
    die();
}
