<?php
namespace app\apii\controller;


use app\admin\model\Apiconfig;
use app\admin\model\user\base\Alipay;
use app\admin\model\user\base\Gjj;
use app\admin\model\user\base\Lianxiren;
use app\admin\model\user\base\Rl;
use app\admin\model\user\base\Sb;
use app\admin\model\user\base\Sjk;
use app\admin\model\user\base\Wechat;
use app\admin\model\user\base\Xinyongka;
use app\admin\model\user\base\Xsz;
use app\admin\model\UserLoanModel;
use app\admin\model\UserMoney;
use app\apii\model\UserModel;
use app\admin\model\user\base\Info;

class Getindex extends Common
{
    var $phone="";
    private $user_table;
    private $user_result;
    public function _initialize()
    {
        parent::_initialize();
        $this->phone = input("get.phone");
        if ($this->phone==""){
            return $this->ajaxRuturn(4040, "请求数据错误");
        }
        $this->user_table = new UserModel();
        $this->user_result = $this->user_table->where('phone', $this->phone)->find();
        if (empty($this->user_result)){
            return $this->ajaxRuturn(4004, "用户不存在");
        }
    }
    /*
     *
     * 获取基本信息
     *
     * */
    public function get_user_base()
    {
        $user_base = new Info();
        $user_base_result = $user_base->where('uid', $this->user_result->id)->find();
        if (!empty($user_base_result)){
            return $this->ajaxRuturn(1000, "获取成功", array($user_base_result));
        }else{
            return $this->ajaxRuturn(1001, "未认证基本信息");
        }
    }

    /*
     *
     * 获取账户资金
     *
     * */
    public function get_user_money()
    {
        $user_money = new UserMoney();
        $user_money_result = $user_money->where('uid', $this->user_result->id)->find();
        if (!empty($user_money_result)){
            return $this->ajaxRuturn(1000, "获取用户金额成功", Array($user_money_result));
        }else{
            $data = [
                'uid' => $this->user_result->id,
                'baozheng_money'=>'0',
                'after_money'=>'0',
                'cashout_money'=>'0',
                'all_loan'=>'0',
                'already_loan'=>'0',
                'create_at'=>date("Y-m-d H:i:s"),
            ];
            $user_money->save($data);
            $user_money = new UserMoney();
            $user_money_result = $user_money->where('uid', $this->user_result->id)->find();
            return $this->ajaxRuturn(1000, "获取用户金额成功", Array($user_money_result));
        }
    }


    /*
     *
     * 获取账户认证
     *
     * */
    public function get_identification_info(){
        $result_data = array();
        $user_base = new Info();
        $user_xinyongka = new Xinyongka();
        $user_sb = new Sb();
        $user_xsz = new Xsz();
        $user_gjj = new Gjj();
        $user_lianxiren = new Lianxiren();
        $user_wechat = new Wechat();
        $user_alipy = new Alipay();
        $user_sjk = new Sjk();
        $user_rl = new Rl();

        $user_base_result = $user_base->where('uid', $this->user_result->id)->find();
        $user_xinyongka_result = $user_xinyongka->where('uid', $this->user_result->id)->find();
        $user_sb_result = $user_sb->where('uid', $this->user_result->id)->find();
        $user_xsz_result = $user_xsz->where('uid', $this->user_result->id)->find();
        $user_gjj_result = $user_gjj->where('uid', $this->user_result->id)->find();
        $user_sjkresult = $user_sjk->where('uid', $this->user_result->id)->find();

        $user_lianxiren_result = $user_lianxiren->where('uid', $this->user_result->id)->find();
        $user_wechat_result = $user_wechat->where('uid', $this->user_result->id)->find();
        $user_alipy_result = $user_alipy->where('uid', $this->user_result->id)->find();
        $user_rl_resulr = $user_rl->where("uid", $this->user_result->id)->find();

        //1可更新，0不可更新,2等待认证
        //基本信息
        if (!empty($user_base_result)){
            $result_data['base'] = "0";
        }else{
            $result_data['base'] = "1";
        }
        //信用卡
        if (!empty($user_xinyongka_result)){
            $zero1=strtotime (date("Y-m-d H:i:s"));
            $zero2=strtotime($user_xinyongka_result->create_at);
            $guonian=ceil(($zero1-$zero2)/86400);
            if ($guonian >= 2){
                $result_data['xinyongka'] = "1";
            }else{
                $guonian1=ceil(($zero1-$zero2)/120);
                if ($guonian1<2) {
                    $result_data['xinyongka'] = "0";
                }else{
                    $result_data['xinyongka'] = "2";
                }
                $result_data['xinyongka'] = "0";
            }
        }else{
            $result_data['xinyongka'] = "1";
        }
        //社保信息
        if (!empty($user_sb_result)){
            $zero1=strtotime (date("Y-m-d H:i:s"));
            $zero2=strtotime($user_sb_result->create_at);
            $guonian=ceil(($zero1-$zero2)/86400);
            if ($guonian >= 2){
                $result_data['sb'] = "1";
            }else{
                $guonian1=ceil(($zero1-$zero2)/120);
                if ($guonian1<2) {
                    $result_data['sb'] = "0";
                }else{
                    $result_data['sb'] = "2";
                }
                $result_data['sb'] = "0";
            }
        }else{
            $result_data['sb'] = "1";
        }
        //人脸认证
        if (!empty($user_rl_resulr)){
            $zero1=strtotime (date("Y-m-d H:i:s"));
            $zero2=strtotime($user_rl_resulr->create_at);
            $guonian=ceil(($zero1-$zero2)/86400);
            if ($guonian >= 2){
                $result_data['rl'] = "1";
            }else{
                $guonian1=ceil(($zero1-$zero2)/120);
                if ($guonian1<2) {
                    $result_data['rl'] = "0";
                }else{
                    $result_data['rl'] = "2";
                }
                $result_data['rl'] = "0";
            }
        }else{
            $result_data['rl'] = "1";
        }
        //行驶证信息
        if (!empty($user_xsz_result)){
            $zero1=strtotime (date("Y-m-d H:i:s"));
            $zero2=strtotime($user_xsz_result->create_at);
            $guonian=ceil(($zero1-$zero2)/86400);
            if ($guonian >= 2){
                $result_data['xsz'] = "1";
            }else{
                $guonian1=ceil(($zero1-$zero2)/120);
                if ($guonian1<2) {
                    $result_data['xsz'] = "0";
                }else{
                    $result_data['xsz'] = "2";
                }
                $result_data['xsz'] = "0";
            }
        }else{
            $result_data['xsz'] = "1";
        }
        //运行商信息
        if (!empty($user_sjkresult)){
            $zero1=strtotime (date("Y-m-d H:i:s"));
            $zero2=strtotime($user_sjkresult->create_at);
            $guonian=ceil(($zero1-$zero2)/86400);
            if ($guonian >= 2){
                $result_data['sjk'] = "1";
            }else{
                $guonian1=ceil(($zero1-$zero2)/120);
                if ($guonian1<2) {
                    $result_data['sjk'] = "0";
                }else{
                    $result_data['sjk'] = "2";
                }
                $result_data['sjk'] = "0";
            }
        }else{
            $result_data['sjk'] = "1";
        }
        //公积金信息
        if (!empty($user_gjj_result)){
            $zero1=strtotime (date("Y-m-d H:i:s"));
            $zero2=strtotime($user_gjj_result->create_at);
            $guonian=ceil(($zero1-$zero2)/86400);
            if ($guonian >= 2){
                $result_data['gjj'] = "1";
            }else{
                $guonian1=ceil(($zero1-$zero2)/120);
                if ($guonian1<2) {
                    $result_data['gjj'] = "0";
                }else{
                    $result_data['gjj'] = "2";
                }
                $result_data['gjj'] = "0";
            }
        }else{
            $result_data['gjj'] = "1";
        }
        //联系人
        if (!empty($user_lianxiren_result)){
            $zero1=strtotime (date("Y-m-d H:i:s"));
            $zero2=strtotime($user_lianxiren_result->create_at);
            $guonian=ceil(($zero1-$zero2)/86400);
            if ($guonian >= 2){
                $result_data['lxr'] = "1";
            }else{
                $guonian1=ceil(($zero1-$zero2)/120);
                if ($guonian1>=2) {
                    $result_data['lxr'] = "0";
                }else{
                    $result_data['lxr'] = "2";
                }
                $result_data['lxr'] = "0";
            }
        }else{
            $result_data['lxr'] = "1";
        }
        //微信
        if (!empty($user_wechat_result)){
            $zero1=strtotime (date("Y-m-d H:i:s"));
            $zero2=strtotime($user_wechat_result->create_at);
            $guonian=ceil(($zero1-$zero2)/86400);
            if ($guonian >= 2){
                $result_data['wechat'] = "1";
            }else{
                $guonian1=ceil(($zero1-$zero2)/120);
                if ($guonian1>=2) {
                    $result_data['wechat'] = "0";
                }else{
                    $result_data['wechat'] = "2";
                }
                $result_data['wechat'] = "0";
            }
        }else{
            $result_data['wechat'] = "1";
        }
        //支付宝
        if (!empty($user_alipy_result)){
            $zero1=strtotime (date("Y-m-d H:i:s"));
            $zero2=strtotime($user_alipy_result->create_at);
            $guonian=ceil(($zero1-$zero2)/86400);
            if ($guonian >= 2){
                $result_data['alipy'] = "1";
            }else{
                $guonian1=ceil(($zero1-$zero2)/120);
                if ($guonian1>=2) {
                    $result_data['alipy'] = "0";
                }else{
                    $result_data['alipy'] = "2";
                }
                $result_data['alipy'] = "0";
            }
        }else{
            $result_data['alipy'] = "1";
        }
        return $this->ajaxRuturn("1000", "success", array($result_data));

    }

    /*
     *
     * 获取借贷信息
     *
     * */
    public function get_loan_info(){
        $user_Loan = new UserLoanModel();
        $user_loan_result = $user_Loan->where('uid', $this->user_result->id)->where("status","neq", "-1")->order('create_at',"desc")->select();
        if (!empty($user_loan_result)){
            return $this->ajaxRuturn(1000, "借贷信息", $user_loan_result);
        }else{
            return $this->ajaxRuturn(1001, "暂无借贷信息");
        }
    }
    /*
     *
     * 获取借贷信息
     *
     * */
    public function get_new_loan_info_id(){
        $user_Loan = new UserLoanModel();
        $user_loan_result = $user_Loan->where("id", input("get.id"))->find();
        if (!empty($user_loan_result)){
            return $this->ajaxRuturn(1000, "借贷信息", array($user_loan_result));
        }else{
            return $this->ajaxRuturn(1001, "暂无借贷信息");
        }
    }
    /*
     *
     * 获取最新借贷信息
     *
     * */
    public function get_new_loan_info(){
        $user_Loan = new UserLoanModel();
        $glob = new Apiconfig();
        $glob_result = $glob->where('alias', 'loan_set')->find();
        $glob_result_json_de = json_decode($glob_result->rule);


        $user_loan_result = $user_Loan->where('uid', $this->user_result->id)->order('create_at',"desc")->find();
        if (!empty($user_loan_result)){


            if ($user_loan_result->status == 0)
            {
                if ($glob_result_json_de->isauto == 1){
                    $user_money = new UserMoney();
                    $user_money_result = $user_money->where('uid', $this->user_result->id)->find();
                    if ($user_loan_result->create_at < (date("Y-m-d H:i:s", time() - $glob_result_json_de->day*24*60*60))){
                        $money_data=[
                            'already_loan'=>$user_money_result->already_loan + $user_loan_result->total_loan
                        ];
                        $user_money->update($money_data, ['id'=>$user_money_result->id]);
                        $loan_data = [
                            'status'=>'2',
                            'update_at' => date("Y-m-d H:i:s")
                        ];
                        $user_Loan->update($loan_data, ['id'=>$user_loan_result->id]);
                        $user_Loan = new UserLoanModel();
                        $user_loan_result = $user_Loan->where('uid', $this->user_result->id)->order('create_at',"desc")->find();
                        return $this->ajaxRuturn(1000, "借贷信息", array($user_loan_result));
                    }else{
                        return $this->ajaxRuturn(1000, "借贷信息", array($user_loan_result));
                    }
                }
                return $this->ajaxRuturn(1000, "正在招标", array($user_loan_result));
            }
            else if ($user_loan_result->status == 1)
            {
                return $this->ajaxRuturn(1001, "上一笔招标完成", array($user_loan_result));
            }
            else if ($user_loan_result->status == 2)
            {
                return $this->ajaxRuturn(1002, "招标失败", array($user_loan_result));
            }
            else if ($user_loan_result->status == -1)
            {
                return $this->ajaxRuturn(1010, "", array($user_loan_result));
            }
        }else{
            return $this->ajaxRuturn(1004, "暂无借贷");
        }
    }
    /*
     *
     * 获取招标过度页面
     *
     * */
    public function get_guodu(){
        $config = new Apiconfig();
        $config_result = $config->where("id", 31)->find();
        return $this->ajaxRuturn(1000, "ok", array($config_result));
    }
    /*
     *
     * 获取招标过度页面
     *
     * */
    function getandroid_update(){

        if ($this->request->isPost()) {
            $config = new Apiconfig();
            $resule = $config->where(['alias'=> 'android_update'])->select();
            if (!empty($resule)){
                return $this->ajaxRuturn(1000, "安卓版本获取成功", $resule);
            }else{
                return $this->ajaxRuturn(4000, "安卓版本获取失败");
            }
        }
    }
    function get_rl_info(){
        $userrl = new Rl();
        $userrl_result = $userrl->where("uid", $this->user_result->id)->find();
        if (!empty($userrl_result)){
            return $this->ajaxRuturn(1000, "人脸识别");
        }else{
            return $this->ajaxRuturn(1001, "需人脸识别");
        }
    }
    function get_api_config(){

        $config = new Apiconfig();
        $resule = $config->where(['alias'=> input("get.alias")])->select();
        if (!empty($resule)){
            return $this->ajaxRuturn(1000, "成功", ($resule));
        }else{
            return $this->ajaxRuturn(4000, "请重新获取");
        }
    }
    function get_cashin(){
        $data_array = array();
        $allloan = input('get.allloan');
        $huankuan = input('get.huankuan');
        $shangjin = input('get.shangjin');
        $alllixi = input('get.alllixi');
        $qixian = input('get.qixian');
        $yongtu = input('get.yongtu');


        $user_money = new UserMoney();
        $user_money_result = $user_money->where('uid', $this->user_result->id)->find();
        if (!empty($user_money_result)){
//            return $this->ajaxRuturn(1000, "获取用户金额成功", Array($user_money_result));
        }else {
            $data = [
                'uid' => $this->user_result->id,
                'baozheng_money' => '0',
                'after_money' => '0',
                'cashout_money' => '0',
                'all_loan' => '0',
                'already_loan' => '0',
                'create_at' => date("Y-m-d H:i:s"),
            ];
            $user_money->save($data);
            $user_money = new UserMoney();
            $user_money_result = $user_money->where('uid', $this->user_result->id)->find();
//            return $this->ajaxRuturn(1000, "获取用户金额成功", Array($user_money_result));
        }
        if ($allloan < 6500){
            if($user_money_result->baozheng_money < (59/3)){
                $data_array["goods_bao_id"] = 1;
//                return $this->ajaxRuturn(1020, "保证金不足");
            }
        }
        else if ($user_money_result->all_loan>6500 && $user_money_result->all_loan<8000){
            if($user_money_result->baozheng_money < (99/3)){
                $data_array["goods_bao_id"] = 2;
//                return $this->ajaxRuturn(1020, "保证金不足");
            }
        }
        else if ($allloan > 8000){
            if($user_money_result->baozheng_money < (199/3)){
                $data_array["goods_bao_id"] = 3;
//                return $this->ajaxRuturn(1020, "保证金不足");
            }
        }
        if ($huankuan == "先息后本"){
            if ($allloan < 3000){
                if($user_money_result->baozheng_money < (50/3)){
                    $data_array["goods_xian_id"] = 100;
                }
            }
            else if ($allloan >= 3000 && $allloan<3800){
                if($user_money_result->baozheng_money < (100/3)){
                    $data_array["goods_xian_id"] = 101;
                }
            }
            else if ($allloan >= 3800 && $allloan<5000){
                if($user_money_result->baozheng_money < (200/3)){
                    $data_array["goods_xian_id"] = 102;
                }
            }
            else if ($allloan > 5000){
                if($user_money_result->baozheng_money < (500/3)){
                    $data_array["goods_xian_id"] = 103;
                }
            }
        }
        if (trim($shangjin) == "null" || empty($shangjin) || $shangjin == "不悬赏"){
            $shangjin = "0";
        }else{
            $user_money = new UserMoney();
            $user_money_result = $user_money->where(['uid'=>$this->user_result->id])->find();

            if ($user_money_result->cashout_money > $shangjin){

            }else{
                $data_array["goods_xuan_id"] = 200;
            }
        }
        $result_id="";
        foreach ($data_array as $key=>$value){
            $result_id = $result_id.$value.",";
        }
        $loan = new UserLoanModel();
        $create_at = date("Y:m:d H:i:s");
        $data = [
            'uid' => $this->user_result->id,
            'shangjin' => $shangjin,
            'total_loan' => $allloan,
            'total_interest' => $alllixi,
            'total_month' => $qixian,
            'yongtu' => $yongtu,
            'status' => "-1",
            'fail_info'=> "",
            'company' => "",
            'create_at' => $create_at,
            'is_xi'=> $huankuan,
        ];
        $loan->save($data);
        $loan = new UserLoanModel();
        $loan_result = $loan->where(['create_at'=>$create_at, 'uid'=>$this->user_result->id])->find();
        $result_data["loan_id"] = $loan_result->id.'';
        $result_data["result_id"] = rtrim($result_id,',');

        return $this->ajaxRuturn(1000, "", [$result_data]);
    }

}
