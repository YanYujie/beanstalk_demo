<?php
/**
 * Created by PhpStorm.
 * User: Yujie
 * Date: 2018/5/11
 * Time: 16:03
 */
class logx{
    const LOG_DIR = APP_PATH."/logx/";
    public static function log($content,$path='',$fileName=''){
        if($path == ''){
            $path = self::LOG_DIR;
        }

        if(!is_dir($path)){
            mkdir($path, 0755, true);
        }

        if($fileName == ''){
            $fileName = date('Y-m-d').'.log';
        }

        $dayTime = date('H:i:s');

        $contents = $dayTime."\t".$content.PHP_EOL;
        $ret = @file_put_contents($path.'/'.$fileName,$contents,FILE_APPEND);
        return $ret;
    }
}