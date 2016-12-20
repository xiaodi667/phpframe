<?php
global $config_log;

$config_log=array(
'log_level'=>'debug',
'log_path'=>'/tmp'
);
$config_log['log_path']=dirname(dirname(__FILE__)).'/tmp';