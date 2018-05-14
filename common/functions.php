<?php


/**
 * Created by PhpStorm.
 * User: Yujie
 * Date: 2018/5/5
 * Time: 22:54
 */
class functions{

    /*
     * @function 发送短信验证码
     * @param $mobile 手机号
     * @param $templateid 模板ID 在网易云后台设置
     * @param $deviceId 目标设备号(不知道什么东东)
     * @param $codeLen 验证码长度
     * @author Yujie
     * @time 2018/5/6
     */
    public static function sendSmsCode($mobile,$templateid='',$deviceId='',$codeLen = 0){
        if(!$mobile){
            return false;
        }
        $db = new ServerApi();
        $ret = $db->sendSmsCode($mobile,$templateid='',$deviceId='',$codeLen = 0);
        if($ret['code'] = 200){
            $redis_key = 'sms_check_code_'.$mobile;
            $sms_code = md5($ret['obj']);
            $redis = Yii::$app->redis;
            $redis->set($redis_key,$sms_code);
            $redis->expire($redis_key,5*60);
            return true;
        }else{
            return $ret;
        }
    }

    /**
     * [changeTwoDimensionalArray 改变二位数据结构]
     * @param  $arr 需改变的数据
     * @param  $key arr的某个key
     * @return $target_arr
     */
    public static function changeTwoDimensionalArray($arr,$key='id'){
        if(empty($arr))
            return false;
        $target_arr = [];
        foreach ($arr as $k => $v) {
            if(!array_key_exists($v[$key],$arr)){
                $target_arr[$v[$key]] = $v;
            }
        }
        return $target_arr;
    }
    public static function pwd($pwd) {
        $pwd = md5(md5($pwd) . 'fbs1808');
        return $pwd;
    }

    /*
     * @function 获取随机码
     * @param length
     */
    public static function getRandStr($length){
        $chars = "a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,0,1,2,3,4,5,6,7,8,9";
        $chars_array = explode(',', $chars);
        $charsLen = count($chars_array) - 1;
        shuffle($chars_array);
        $output = '';
        mt_srand(mktime());
        for ($i = 0; $i < $length; $i ++)
        {
            $output .= $chars_array[mt_rand(0, $charsLen)];
        }
        return $output;
    }

}