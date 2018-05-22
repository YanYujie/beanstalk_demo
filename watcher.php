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
            $tube_status = $this->_queue->statsTube($this->_tube);
            echo '---------------------------'."\n";
            print_r($tube_status);echo "\n";
            if($tube_status == 'Server reported NOT_FOUND'){
                echo time()." $this->_tube empty queue\n";
                sleep(1);
                continue;
            }
            echo '------------1---------------'."\n";
            $job = $this->_queue->reserve($this->_tube);
            echo '-------------2--------------'."\n";
            $data = $this->_queue->getJobData($job);
            $this->_queue->de($job);
            echo '---------------3------------'."\n";
//            $this->_queue->delete($job);
            echo '--------------4-------------'."\n";
            if($data){
                echo '--------------5-------------'."\n";
                $cmd = $this->_tube.' '.$data;
                echo '--------------6-------------'."\n";
                logx::log($cmd);
                $cmd_ret = $this->execInBg($cmd);
                echo '--------------7-------------'."\n";
                print_r($cmd_ret);echo "\n";
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