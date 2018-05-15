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
//include_once APP_PATH.'/vendor/autoload.php';

class Watcher{
    private $_queue;
    private $_tube;
    const LOG_ROOT_PATH = CRONTAB_LOG_PATH.'/beanstalk_sys_log/';
    public function __construct($tube){
        $this->_queue = PheanstalkClient::getInstance();
        $this->_tube = $tube;
    }

    public function run(){
        while(true){
            $job = $this->_queue->reserve($this->_tube);
            $data = $this->_queue->getJobData($job);
            $this->_queue->delete($job);
            if($data){
                $cmd = $this->_tube.' '.$data;
                logx::log($cmd);
                $this->execInBg($cmd);
            }
            sleep(1);
        }
    }



    private function  execInBg($cmd)
    {
        exec("$cmd >/dev/null &");
    }

}
$watcher = new Watcher('/usr/bin/php');
$watcher->run();


echo '-------end------------';
echo "\n";


//use Pheanstalk\Pheanstalk;
//$pheanstalk = new Pheanstalk('127.0.0.1');
//
//while(true){
//    $job = $pheanstalk->watch('foo')->reserve();
//    echo ">>>>>>>>>>>>>>>>>>>Start>>>>>>>>>>>>>>>>>>>>>>>\n";
//    print_r($job);echo "\n";
//    if($job){
//        $ret = $job->getData();
//        $pheanstalk->delete($job);
//        print_r($ret);
//        echo "^^^^^^^^^^^^^^^^^^^^^End^^^^^^^^^^^^^^^^^^^^^^^^^^\n";
//        echo "\n";
//    }
//    sleep(1);
//}
