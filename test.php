<?php
include_once __DIR__.'/changeDefine.php';
include_once APP_PATH.'/vendor/PheanstalkClient.php';


$pheanstalk = new \Pheanstalk\Pheanstalk('127.0.0.1');
try{
    $ret = $pheanstalk->statsTube('/usr/bin/php');
}catch(\Pheanstalk\Exception $e){
    echo "-----------------------------\n";
    print_r($e->getMessage());
}
echo "----------------before---------------\n";
print_r($ret);echo "\n";
$job = $pheanstalk->watch('/usr/bin/php')->reserve();
echo "------------------later------------------\n";
$ret = $pheanstalk->statsTube('/usr/local/php/bin/php');
print_r($ret);echo "\n";

