<?php
/**
 * 日志类 记录各种错误
 *
 */
class app_logic_log{
    static $type=array('log','timer','data','orerate');

    
    public static function log($do,$type='log',$data=array())
    {
    	
        $time = date('Y-m-d H:i:s',time());
        $userInfo = '';
        
        $username = isset($userInfo['username']) ? $userInfo['username']:0;
        $dataStr  = str_replace("\n"," ",print_r($data,1));
        $ip  = $_SERVER['REMOTE_ADDR'];
        $msg = "[$time]  [$ip]	[{$username}]  [$do]    [$dataStr]\n";
        $file = $type.'_'.date('Y-m-d').'.log';
        $logConfig = app_config::load('log');
        $files = $logConfig['log_path'].'/'.$file;
        @file_put_contents($files,$msg,FILE_APPEND);
        return true;
    }

  

    public static function debug($msg,$line,$file,$type='debug')
    {
        $file = $type.'_'.date('Y-m-d').'.log';
        $logConfig = app_config::load('log');
        $files = $logConfig['log_path'].'/'.$file;
        $msgs = $file.":Line ".$line.": $msg\n";
        @file_put_contents($files,$msgs,FILE_APPEND);
    }
    
   
    
}
?>