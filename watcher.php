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

while(true){
    $job = $pheanstalk->watch('foo')->reserve();
    echo ">>>>>>>>>>>>>>>>>>>Start>>>>>>>>>>>>>>>>>>>>>>>";
    print_r($job);echo "\n";
    if($job){
        $ret = $job->getData();
        $pheanstalk->delete($job);
        print_r($ret);
        echo "^^^^^^^^^^^^^^^^^^^^^End^^^^^^^^^^^^^^^^^^^^^^^^^^";
        echo "\n";
    }
    sleep(1);
}
