<?php
/**
 * Created by PhpStorm.
 * User: Yujie
 * Date: 2018/5/12
 * Time: 02:58
 */
include_once __DIR__.'/changeDefine.php';
include_once APP_PATH.'/vendor/autoload.php';

use Pheanstalk\Pheanstalk;
echo "--------------argc---------------\n";
print_r($argc);
echo"\n";
echo "------------argv-----------------\n";
print_r($argv);
echo "\n";

$beanstalk = new Pheanstalk('127.0.0.1');

$beanstalk->putInTube('foo','say hello worker');
echo "---------4-------\n";
//try {
//    $ret = $beanstalk->statsTube('foo');
//}catch(PharException $e){
//    print_r($e);
//    echo "\n";
//}
//echo (json_encode($ret)."\n");


//$ret = $beanstalk->peekReady('foo');
//$job = $beanstalk->reserveFromTube('foo');
//echo "---------5-------\n";
//print_r($job);echo "\n";
//
//$aa = $job->getData();
//echo "---------6-------\n";
//print_r($aa);
//
//echo "\n";
//
//$beanstalk->delete($job);
