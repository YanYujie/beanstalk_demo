<?php
include_once __DIR__.'/changeDefine.php';
include_once APP_PATH.'/vendor/autoload.php';

use Pheanstalk\Pheanstalk;
/**
 * Created by PhpStorm.
 * User: Yujie
 * Date: 2018/5/12
 * Time: 02:58
 */
$beanstalk = new Pheanstalk('127.0.0.1');
//$connect = new \Pheanstalk\Connection('127.0.0.1',11300);

echo "--------1--------\n";
//$beanstalk->setConnection();
//
echo "---------2-------\n";
//$beanstalk->useTube('foo');
$beanstalk->putInTube('foo','say hello');
//echo "--------3--------\n";
//$ret = $beanstalk->put(0,0, 120, 'say hello world');
//echo "{$ret}\n";
echo "---------4-------\n";
$ret = $beanstalk->statsTube('foo');
echo (json_encode($ret)."\n");
//$job = $beanstalk->watch('foo')->reserve(0);
//echo (json_encode($job)."\n");

//$ret = $beanstalk->peekReady('foo');
$job = $beanstalk->reserveFromTube('foo');

//$job = $beanstalk->reserve();
//$job = $beanstalk->reserveFromTube('foo');
//exit(json_encode($job)."\n");

//while($job = $beanstalk->reserveFromTube('foo')){
//    exit(json_encode($job)."\n");
//}

echo "---------5-------\n";
$aa = $job->getData();
echo "---------6-------\n";
print_r($aa);

echo "\n";

$beanstalk->delete($job);
