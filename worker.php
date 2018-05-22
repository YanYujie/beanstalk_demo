<?php
/**
 * Created by PhpStorm.
 * User: Yujie
 * Date: 2018/5/12
 * Time: 02:58
 */
set_time_limit(0);
include_once __DIR__.'/changeDefine.php';
include_once APP_PATH.'/vendor/PheanstalkClient.php';

$log_root_path = CRONTAB_LOG_PATH.'/beanstalk_sys_log/';

if(count($argv)<3){
    exit('Params Error'."\n");
}
$beanstalk = PheanstalkClient::getInstance();
logx::log(json_encode($argv));
$beanstalk->put($argv[1],$argv[2]);
