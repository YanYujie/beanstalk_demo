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
$connect = new \Pheanstalk\Connection('127.0.0.1',11300);

echo "--------1--------\n";
$beanstalk->setConnection($connect);
//
echo "---------2-------\n";
$beanstalk->useTube('foo');
echo "--------3--------\n";
$ret = $beanstalk->put(0,0, 120, 'say hello world');
echo "{$ret}\n";
echo "---------4-------\n";
$ret = $beanstalk->watch('foo');

//$job = $beanstalk->reserve('foo');
$job = $beanstalk->reserve();
//exit(json_encode($ret)."\n");

//while($job = $beanstalk->reserveFromTube('foo')){
//    exit(json_encode($job)."\n");
//}

echo "---------5-------\n";
$aa = $job->getData();
echo "---------6-------\n";
print_r($aa);

echo "\n";

$beanstalk->delete($obj);
