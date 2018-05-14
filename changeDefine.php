<?php
define('APP_PATH',__DIR__.'/');
define('HOST_URL','http://api2.fbssql.com/');
define('H5_DB_DSN','mysql:dbname=fbx;host=127.0.0.1;port=3306;charset=utf8');
define('H5_DB_USER','root');
define('H5_DB_PWD','');
define('REDIS_HOST','127.0.0.1');
define('REDIS_PORT',6379);
define('REDIS_DATA_BASE',1);
define('CRONTAB_LOG_PATH',APP_PATH.'/logx/');


include_once APP_PATH.'/common/logx.php';
include_once APP_PATH.'/dbbase/Db.php';
include_once APP_PATH.'/vendor/autoload.php';