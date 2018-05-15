<?php
include_once __DIR__.'/changeDefine.php';
include_once APP_PATH.'/vendor/PheanstalkClient.php';

$pheanstalk = PheanstalkClient::getInstance();
$ret = $pheanstalk->listTubes();
print_r($ret);echo "\n";