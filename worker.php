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


//
//echo "--------------argc---------------\n";
//print_r($argc);
//echo"\n";
//echo "------------argv-----------------\n";
//print_r($argv);
//echo "\n";
//
//$beanstalk = new Pheanstalk('127.0.0.1');
//
//$beanstalk->putInTube($argv[1],$argv[2]);
//echo "---------4-------\n";
////$ret = $beanstalk->listTubes();
////try {
////    $ret = $beanstalk->statsTube('foo');
////}catch(Exception $e){
////    print_r($e);
////    echo "\n";
////}
//echo (json_encode($ret)."\n");
//
//
////$ret = $beanstalk->peekReady('foo');
////$job = $beanstalk->reserveFromTube('foo');
////echo "---------5-------\n";
////print_r($job);echo "\n";
////
////$aa = $job->getData();
////echo "---------6-------\n";
////print_r($aa);
////
////echo "\n";
////
////$beanstalk->delete($job);
