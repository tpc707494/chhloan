<?php
namespace app\apii\controller;

use app\apii\model\UserModel;
use app\common\controller\Base;
use think\Controller;

class Common extends Base
{

    public function checkToken($token, $hone)
    {
        $user = new UserModel();
        $res = $user->where('token', $token)->where('phone', $hone)->find();
        if (!empty($res)) {
            //dump(time() - $res[0]['time_out']);
            if (date("Y:m:d H:m:s") < $res->token_time_out) {
                //return $this->ajaxRuturn(9000, "token超时");
                return "9000";
            }
            $res = $user->isUpdate(true)
                ->where('token', $token)
                ->update(['token_time_out' => date("Y-m-d H:i:s", time() + 7*24*60*60)]);
            if ($res) {
                return "9001"; //token验证成功，time_out刷新成功，可以获取接口信息
            }
        }
        return $res; //token错误验证失败
    }

    public function _initialize()
    {
        if (0){
            return $this->ajaxRuturn(4000, "后台暂停使用中");
        }
        $phone = input("get.phone");
        if (!empty($phone)){
            if(!preg_match("/^1[345678]{1}\d{9}$/",$phone)){
                return $this->ajaxRuturn(4010, "手机号错误");
            }
        }

//        if (!$this->request->isPost()){
//            return $this->ajaxRuturn(4004, "请使用post访问");
//        }
        $token = input("get.token");

        $user = new UserModel();
        $res = $user->field('token_time_out')->where('token', $token)->where('phone', $phone)->find();
        if (!empty($res)){
            if (date("Y:m:d H:m:s") < $res->token_time_out) {

            }else{
                $res = $user->isUpdate(true)
                    ->where('token', $token)
                    ->update(['token_time_out' => date("Y-m-d H:i:s", time() + 7*24*60*60)]);
            }
        }else{
            return $this->ajaxRuturn(9002, "token错误验证失败", array($res));
        }
    }
}
