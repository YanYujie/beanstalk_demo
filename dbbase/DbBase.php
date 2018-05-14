<?php
/**
 * Created by PhpStorm.
 * User: Yujie
 * Date: 2018/2/8
 * Time: 17:14
 */
class DbBase{
    const DNS = H5_DB_DSN;
    const DB_USER = H5_DB_USER;
    const DB_PWD = H5_DB_PWD;
    protected $_con;
    private function __construct(){
        try{
            $this->_con = new PDO(self::DNS,self::DB_USER,self::DB_PWD);
        }catch(PDOException $e){
            echo "--------------Db connect info--------------\n";
            exit(json_encode($e));
        }
    }

    static public $_db;

    static public function getDb(){
        if(!self::$_db){
            self::$_db = new self();
        }
        return self::$_db;
    }
    public function getCon(){
        return $this->_con;
    }
}