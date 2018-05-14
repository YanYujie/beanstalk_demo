<?php
/**
 * Created by PhpStorm.
 * User: Yujie
 * Date: 2018/5/12
 * Time: 02:58
 */
set_time_limit(0);
include_once __DIR__.'/changeDefine.php';
include_once APP_PATH.'/vendor/autoload.php';

use Pheanstalk\Pheanstalk;
$pheanstalk = new Pheanstalk('127.0.0.1');
$pheanstalk->watch('foo');
while(true){
    $job = $pheanstalk->reserve();
    $ret = $job->getData();
    $pheanstalk->delete($job);
    print_r($ret);
    echo "\n";
    sleep(1);
}
