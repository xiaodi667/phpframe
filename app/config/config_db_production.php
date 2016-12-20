<?php
global $config_db_production;
$config_db_production=array(

'web'=>array(
'driver' => 'mysql',
'host' => '192.168.10.241',
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
'host' => '192.168.10.81',
'login' => 'cms',
'password' => 'cms123456',
'database' => 'cms',
'prefix' => 'wp_',
),


);
