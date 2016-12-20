<?php
global $config_db_staging;
$config_db_staging=array(

'web'=>array(
'driver' => 'mysql',
'host' => '192.168.10.242',
'login' => 'cms',
'password' => 'cms123456',
'database' => 'cms',
'prefix' => 'wp_',
),
'master'=>array(
'driver' => 'mysql',
'host' => 'localhost',
'login' => 'root',
'password' => 'root',
'database' => 'cms',
'prefix' => 'wp_',
),
'slave'=>array(
'driver' => 'mysql',
'host' => 'localhost',
'login' => 'root',
'password' => 'root',
'database' => 'cms',
'prefix' => 'wp_',
),



);
