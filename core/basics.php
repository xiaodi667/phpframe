<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if(DEBUG){
    error_reporting(E_ALL);
    ini_set('display_errors',1);
}else{
    error_reporting(0);
    ini_set('display_errors',0);
}
if(isset($_SERVER['argv']))
{
    $argv = $_SERVER['argv'];
    unset($argv[0]);
    //合并命令行参数
    foreach($argv as $v)
    {
        $r = explode('=', $v,2);
        $_GET[$r[0]] = isset($r[1]) ? urldecode(trim($r[1])) : '';
    }

}

$GLOBALS['url_info'] = array();
if(isset($_GET['url']))
{
    $info = explode('/',$_GET['url']);
    $GLOBALS['url_info'] = $info;
    if(isset($info[0])){
        $_GET['page'] = $info[0];
    }
    if(isset($info[1])){
        $_GET['action'] = $info[1];
    }
}
?>