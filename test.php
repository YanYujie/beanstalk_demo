<?php
include_once __DIR__.'/changeDefine.php';
include_once APP_PATH.'/vendor/PheanstalkClient.php';

//echo "--------------argc---------------\n";
//print_r($argc);
//echo"\n";
//echo "------------argv-----------------\n";
//print_r($argv);
//echo "\n";
//
$pheanstalk = PheanstalkClient::getInstance();
$ret = $pheanstalk->listTubes();
//
//$pheanstalk = new \Pheanstalk\Pheanstalk('127.0.0.1');
//$ret = $pheanstalk->statsTube('/usr/local/php/bin/php');
$job = $pheanstalk->reserve('/usr/local/php/bin/php');


print_r($job);echo "\n";
$ret = $job->getData();
print_r($ret);echo "\n";