<?php
include_once __DIR__.'/autoload.php';
use Pheanstalk\Pheanstalk;
/**
 * Created by PhpStorm.
 * User: Yujie
 * Date: 2018/5/15
 * Time: 12:07
 */
class PheanstalkClient{
    private  $_db;
    private static $_instance;
    public function __construct()
    {
        try{
            $pheanstalk = new Pheanstalk(BEANSTALKD_HOST,BEANSTALKD_PORT,BEANSTALKD_TIME_OUT);
        }catch(\Pheanstalk\Exception $e){
            exit(json_encode($e));
        }
        $this->_db = $pheanstalk;
    }

    /*
     * @function 获取Pheanstalkd对像 单例模式
     */
    public static function getInstance(){
        if(!self::$_instance instanceof self){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function listTubes(){
        $ret = $this->_db->listTubes();
        return $ret;
    }
}