<?php
include_once __DIR__.'/changeDefine.php';
include_once APP_PATH.'/vendor/PheanstalkClient.php';


//$pheanstalk = new \Pheanstalk\Pheanstalk('127.0.0.1');
//try{
//    $ret = $pheanstalk->statsTube('/usr/bin/php');
//    echo "----------------before---------------\n";
//    print_r($ret);echo "\n";
//}catch(\Pheanstalk\Exception $e){
//    echo "-----------------------------\n";
//    print_r($e->getMessage());
//    echo "\n";
//}


$pheanstalk = PheanstalkClient::getInstance();
$ret = $pheanstalk->statsTube('/usr/bin/php');
if($ret=='Server reported NOT_FOUND'){
    echo "empty queue\n";
    exit();
}else{
    print_r($ret->getResponseName());echo "\n";
}
