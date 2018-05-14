<?php
/**
 * Created by PhpStorm.
 * User: Yujie
 * Date: 2018/2/9
 * Time: 10:33
 */
include_once 'DbBase.php';
class Db{
    protected $_db;
    public function __construct()
    {
        $this->_db = DbBase::getDb()->getCon();
    }

    public function findAll($sql){
        try{
            $ret = $this->_db->query($sql);
            $ret = $ret->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "--------------find exit------------\n";
            exit(json_encode($e));
        }
        return $ret;
    }

    public function update($sql){
        try{
            $ret = $this->_db->exec($sql);
        }catch(PDOException $e){
            echo "--------------update exit------------\n";
            exit(json_encode($e));
        }
        return $ret;
    }

    public function lastInsertId(){
        return $this->_db->lastInsertId();
    }
}