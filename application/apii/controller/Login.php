<?php
namespace app\apii\controller;

use app\admin\model\Apiconfig;
use app\admin\model\PreRegistrationModel;
use app\admin\model\SendCodeModel;
use app\admin\model\UserMoney;
use app\apii\model\GlobConfigModel;
use app\apii\model\UserDetailModel;
use app\apii\model\UserModel;
use app\apii\model\UserMoneyModel;
use app\apii\model\UsersModel;
use Qcloud\Sms\SmsSingleSender;

class Login extends Common
{
    var $phone="";
    private $user_table;
    private $user_result;
    public function _initialize()
    {
//        if (!$this->request->isPost()){
//            return $this->ajaxRuturn(4004, "请使用post访问");
//        }
        $this->phone = input("get.phone");

        if ($this->phone=="" || !preg_match("/^1[345678]{1}\d{9}$/",$this->phone)){
            return $this->ajaxRuturn(4040, "请求数据错误");
        }
        $this->user_table = new UserModel();

    }
    public function test(){

        return "sdas";
    }
    /*
     *
     * 判断用户是否存在
     *
     * */
    public function index()
    {
        $preRegistrationModel = new PreRegistrationModel();

        $this->user_result = $this->user_table->where('phone', $this->phone)->find();
        if (!empty($this->user_result))
        {
            return $this->ajaxRuturn(1000, "用户存在");
        }
        else
        {
            $preRegistrationModel_result = $preRegistrationModel->where('phone', $this->phone)->find();
            if (empty($preRegistrationModel_result)){
                $data = [
                    'father_phone'=>'',
                    "name" => "chh_".$this->str_rand(5),
                    "phone" => $this->phone,
                    "create_at" => date("Y-m-d H:i:s"),
                ];
                $preRegistrationModel->save($data);
                return $this->ajaxRuturn(1001, "用户预注册");
            }else{
                return $this->ajaxRuturn(1001, "用户预注册");
            }
        }


    }

    /*
     *
     * 用户注册
     *
     * */
    public function register(){
        $validate = $this->validate(input("get."),[
            'password' => 'require',
            'code' => 'require|max:6|min:6',
        ], [
            'password.require' => '密码不能为空',
            'code.require' => '请输入验证码',
            'code.max' => '请输入正确的验证码',
            'code.min' => '请输入正确的验证码',
        ]);
        if ($validate !== true)return $this->ajaxRuturn(4000, $validate);
        switch ($this->fverifycode(input("get.code"))) {
            case 4001:
                return $this->ajaxRuturn(4001, "验证码超时");
                break;
            case 4002:
                return $this->ajaxRuturn(4001, "验证码错误");
                break;
        }
        $preRegistrationModel = new PreRegistrationModel();
        $user = new UserModel();
        $user_result = $user->where('phone', $this->phone)->find();
        if (!empty($user_result)){
            return $this->ajaxRuturn(1001, "用户存在");
        }
        $password = input("get.password");
        $preRegistrationModel_result = $preRegistrationModel->where("phone", $this->phone)->find();
        if (!empty($preRegistrationModel_result)){

        }else{
            $data = [
                "name" => "chh_".$this->str_rand(5),
                "phone" => $this->phone,
                "create_at" => date("Y-m-d H:i:s"),
            ];
            $preRegistrationModel->save($data);
        }
        $preRegistrationModel_result = $preRegistrationModel->where("phone", $this->phone)->find();

        $data =[
            "username"=>$preRegistrationModel_result->name,
            "password"=>$password,
            'source'=>'2',//手机注册
            'phone'=>$this->phone,
            'grade'=>'1',
            'status'=>'1',
            "created_at"=>date('Y-m-d H:i:s')
        ];
        $user->save($data);
        $user_result = $user->where('phone', $this->phone)->find();


        $data_ = [
            'baozheng_money'=>'0',
            'after_money'=>'0',
            'cashout_money'=>'0',
            'all_loan'=>'0',
            'already_loan'=>'0',
            'create_at'=>date("Y-m-d H:i:s")
        ];
        $data_money = new UserMoney();
        $data_money_result = $data_money->where('uid', $user_result->id)->find();
        if (!empty($data_money_result)){
            $data_money->update($data_, ['uid'=>$user_result->id]);
        }else{
            $data_['uid'] = $user_result->id;
            $data_money->save($data_);
        }
        return $this->ajaxRuturn(1000, "注册成功");
    }
    /*
     *
     * 登录
     *
     * */
    function login(){
//        if ($this->request->isPost()) {
        $validate = $this->validate(input("get."), [
            'phone' => 'require|min:11',
            'password' => 'require',
        ], [
            'phone.require' => '请输入手机号',
            'phone.min' => '请输入正确的手机号',
            'password.min' => '密码不能为空',
        ]);
        if ($validate !== true) return $this->ajaxRuturn(4001, $validate);
        $phone = input("get.phone");
        $password = input("get.password");
        $usermodel = new UserModel();
        $result = $usermodel->where(["phone"=>$phone,"password"=>$password])->find();

        if (!empty($result)){
            $data = [
                'token'=>$this->makeToken(),
                'token_time_out'=>date("Y-m-d H:i:s", time()+7*24*60*60)
            ];
            $usermodel->update($data, ['id'=>$result->id]);
            $usermodel = new UserModel();
            $result = $usermodel->where(["phone"=>$phone,"password"=>$password])->find();
            return $this->ajaxRuturn(1000, "获取用户信息成功", Array($result));
        }else{
            return $this->ajaxRuturn(4002, "密码错误");
        }
//        }
    }


    function set_modify_pwd(){
        $validate = $this->validate(input("get."), [
            'phone' => 'require|min:11',
            'old_pwd' => 'require',
            'new_pwd' => 'require',
            'no' => '0',
        ], [
            'phone.require' => '手机号有误',
            'old_pwd.require' => '请输入旧密码',
            'new_pwd.require' => '请输入新密码',
        ]);
        if ($validate !== true) return $this->ajaxRuturn(4001, $validate);
        $no = input("get.no");
        $old_pwd = input("get.old_pwd");
        $new_pwd = input("get.new_pwd");

        if($no=="0") {
            switch ($this->fverifycode(input("get.code"))) {
                case 4001:
                    return $this->ajaxRuturn(4001, "验证码超时");
                    break;
                case 4002:
                    return $this->ajaxRuturn(4001, "验证码错误");
                    break;
            }
            $userresult = $this->user_table->where("phone", $this->phone)->find();
        }else{
            $userresult = $this->user_table->where("phone", $this->phone)->where("password", input("get.old_pwd"))->find();
        }
        if (!empty($userresult)){
            $user = new UsersModel();
            $user->update(['password'=>md5($new_pwd)], ['id'=>$userresult->id]);
            return $this->ajaxRuturn(1000,"修改密码成功,请登录");
        }else{
            return $this->ajaxRuturn(4001,"密码错误");
        }
//        $this->user_result = $this->user_table->where('phone', $this->phone)->find();
    }
    /*
     *
     * 发送验证码
     *
     * */
    public function smscode(){
        $smscode = new SendCodeModel();
        $smsresult = $smscode->where("phone", $this->phone)->order("create", "desc")->find();
        if ($smsresult && $smsresult->create > date('Y-m-d H:i:s')){
            return $this->ajaxRuturn(4001, "1分钟内不能再次发送短信");
        }
        $code = mt_rand(100000,999999)."";
        $config = new Apiconfig();
        $configresult = $config->where("title","腾讯云短信")->find();
        $jsonconfig = json_decode($configresult->rule);
        $result = $this->smsSend($jsonconfig, $this->phone, $code);
        if ($result){
            $data =[
                "phone"=>$this->phone,
                "code"=>$code,
                "create"=>date('Y-m-d H:i:s', time())
            ];
            $smscode->save($data);
            return $this->ajaxRuturn(1000, "短信发送成功", Array(["code"=>$code]));
        }else{
            return $this->ajaxRuturn(1000, "获取发送失败", Array(["code"=>$code]));
        }
    }
    /*
     *
     * 发送验证码
     *
     * */
    public function orthersmscode(){
        $phone1 = input("get.phone1");
        $smscode = new SendCodeModel();
        $smsresult = $smscode->where("phone", $phone1)->order("create", "desc")->find();
        if ($smsresult && $smsresult->create > date('Y-m-d H:i:s')){
            return $this->ajaxRuturn(4001, "1分钟内不能再次发送短信");
        }
        $code = mt_rand(100000,999999)."";
        $config = new Apiconfig();
        $configresult = $config->where("title","腾讯云短信")->find();
        $jsonconfig = json_decode($configresult->rule);
        $result = $this->smsSend($jsonconfig, $phone1, $code);
        if ($result){
            $data =[
                "phone"=>$phone1,
                "code"=>$code,
                "create"=>date('Y-m-d H:i:s', time())
            ];
            $smscode->save($data);
            return $this->ajaxRuturn(1000, "短信发送成功", Array(["code"=>$code]));
        }else{
            return $this->ajaxRuturn(1000, "获取发送失败", Array(["code"=>$code]));
        }
    }
    /*
     *
     * 验证验证码
     *
     * */
    public function verifycode(){
        $smscode = new SendCodeModel();
        $validate = $this->validate(input("get."), [
            'code' => 'require|min:6',
        ], [
            'code.require' => '请输入验证码',
            'code.min' => '请输入正确的验证码',
        ]);
        if ($validate !== true)return $this->ajaxRuturn(4000, $validate);
        $code = input("get.code");
        $sendcode = new SendCodeModel();
        $result = $sendcode->where(["phone"=>$this->phone, "code"=>$code])->order("create","desc")->find();
        if (!empty($result)){
            if ($result->create < date("Y-m-d H:i:s", time()-3*60)){
                return $this->ajaxRuturn(4001, "验证码错误超时");
            }
            $usermodel = new UsersModel();
            $result = $usermodel->where("phone", $this->phone)->find();
            if (!empty($result)){
                if(empty($result->token)){
                    $data = [
                        'token'=>$this->makeToken(),
                        'token_time_out'=>date("Y-m-d H:i:s", time()+7*24*60*60)
                    ];
                    $usermodel->update($data, ['id'=>$result->id]);
                }
                return $this->ajaxRuturn(1000, "获取用户信息成功", array($result));
            }else{
                return $this->ajaxRuturn(1001, "获取用户信息失败");
            }
        }else{
            return $this->ajaxRuturn(4001, "验证码错误");
        }
    }
    private function fverifycode($code){
        $sendcode = new SendCodeModel();
        $result = $sendcode->where(["phone"=>$this->phone, "code"=>$code])->order("create","desc")->find();
        if (!empty($result)){
            if ($result->create < date("Y-m-d H:i:s", time()-3*60)){
                return 4001;
            }
            else{
                return 1000;
            }
        }else{
            return 4002;
        }
    }


    public function smsSend($jsonconfig, $phone, $code){
        $appid = $jsonconfig->appid;
        $appkey = $jsonconfig->appkey;
        $phoneNumber = $phone;
        $templateId = $jsonconfig->templateId;
        // 签名
        $smsSign = $jsonconfig->smssign; // NOTE: 这里的签名只是示例，请使用真实的已申请的签名，签名参数使用的是`签名内容`，而不是`签名ID`
        try {
            $tiem = 3;
            $ssender = new SmsSingleSender($appid, $appkey);
            $result = $ssender->send(0, "86", $phoneNumber,
                $code."为你的注册密码,请于".$tiem."分钟内填写，非本人操作，请忽略本短信", "", "");
            $rsp = json_decode($result);
            return $result;
        } catch(\Exception $e) {
            return var_dump($e);
        }
    }

    function str_rand($length = 32, $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
        if(!is_int($length) || $length < 0) {
            return false;
        }

        $string = '';
        for($i = $length; $i > 0; $i--) {
            $string .= $char[mt_rand(0, strlen($char) - 1)];
        }
        return $string;
    }
}
