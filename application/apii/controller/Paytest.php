<?php
namespace app\apii\controller;


use app\admin\model\CashIn;
use app\admin\model\Cashout;
use app\admin\model\Goods;
use app\admin\model\user\base\LaonShangjin;
use app\admin\model\UserLoanModel;
use app\admin\model\UserMoney;
use app\apii\model\UserModel;
class Paytest extends Common
{
    var $phone="";
    private $user_table;
    private $user_result;
    private $code = '';
    private $das_money = "";

    public function _initialize()
    {
        $this->phone = input("post.phone");
        if (empty($this->phone)){
            $this->phone = input("get.phone");
        }
        if ($this->phone==""){
            return $this->ajaxRuturn(4040, "请求数据错误", input("post."));
        }
        $this->user_table = new UserModel();
        $this->user_result = $this->user_table->where('phone', $this->phone)->find();
        if (empty($this->user_result)){
            return $this->ajaxRuturn(4004, "用户不存在");
        }
    }

    public function errorview(){
        return $this->view->fetch();
    }

    public function index(){
        $title = input("post.title");
        if (empty($title)){
            $title = input("get.title");
        }

        $loanid = input("post.loanid");
        if (empty($loanid)){
            $loanid = input("get.loanid");
        }

        $type_cashout = input("post.cashout_type");
        if (empty($type_cashout)){
            $type_cashout = input("get.cashout_type");
        }


        $this->view->assign('title', "账户提现");
        $this->view->assign('menulist', ["提现账户","提现类型"]);

        $this->view->assign('menulist_count', 2);

        $this->view->assign('account', json_encode([
            "微信",
            "支付宝",
            "银行卡"
        ]));
        $loan = new UserLoanModel();
        $loan_result = $loan->where(['id'=>$loanid])->find();
        if (empty($loan_result)){
            cookie('loanid', "-", array('expire'=>3600,'prefix'=>'cashout_'));
            $cashout_type = [
                "余额"
            ];
        }else{
            cookie('loanid', $loanid, array('expire'=>3600,'prefix'=>'cashout_'));
            $cashout_type = [
                "悬赏","招标保证金", "先息后本"
            ];
        }
        $this->view->assign('jsonmenulist', json_encode($cashout_type));
        $this->view->assign('phone', $this->phone);
        $user_money = new UserMoney();
        $user_money_result = $user_money->where(['uid'=>$this->user_result->id])->find();
        $this->view->assign('usermoney', $user_money_result);
        return $this->view->fetch();
    }

    public function cashin_view(){
        $config_pay = Array();
        $this->view->assign('title', "账户充值");
        $data = input("post.data");
        if (empty($data)){
            $data = input("get.data");
        }
        $view_data = [
            [
                "title"=>"提现账户",
                "account"=>[
                    "微信",
                    "支付宝",
                    "账户余额"
                ]
            ],
            [
                "title"=>"提现类型",
                "account"=>[
                    "余额","招标保证金", "先息后本"
                ]
            ]
        ];
        $this->view->assign('type', "0");
        $this->view->assign('money', "0");
        $this->view->assign('menulist', $view_data);
        $this->view->assign('money_list', json_encode($config_pay));
        $this->view->assign('menulist1', json_encode($view_data));
        $this->view->assign('phone', $this->phone);
        $user_money = new UserMoney();
        $user_money_result = $user_money->where(['uid'=>$this->user_result->id])->find();
        $this->view->assign('usermoney', $user_money_result);

        return $this->view->fetch();
    }
    public function cashout_btn()
    {

//        return $this->ajaxRuturn("-1000", "错误,请稍后再试", input("get."));
        $price = input("get.price");
        $istype = input("get.istype");
        $type = input("get.type");
        $sql_price = $price + 1;
        $type_input = 0;
        $user_money = new UserMoney();
        $user_money_result = $user_money->where(['uid'=>$this->user_result->id])->find();

        $loanid = $_COOKIE['cashout_loanid'];

        switch ($type){
            case "余额":
                $type_input = 300;
                $sql_price = $user_money_result->cashout_money;
                if ($price  >  $sql_price){
                    return $this->ajaxRuturn("-1000", "金额不足,请提现正确的金额");
                }else{
                    $data = [
                        'cashout_money' => $sql_price - $price,
                    ];
                    $user_money->update($data, ['id'=>$user_money_result->id]);
                }
                break;
            case "悬赏":
//                $type_input = 200;
                $loan = new UserLoanModel();
                $loan_result = $loan->where(['id'=>$loanid])->find();
                if (empty($loan_result)){
                    return $this->ajaxRuturn("-1000", "错误,请稍后再试");
                }else{
                    $sql_price = $loan_result->shangjin;
                }
                $type_input = $loan_result->create_at . "|" . "悬赏提现";
                if ($price  >  $sql_price){
                    return $this->ajaxRuturn("-1000", "金额不足,请提现正确的金额");
                }else{
                    $data = [
                        'shangjin' => $sql_price - $price,
                    ];
                    $loan->update($data, ['id'=>$loan_result->id]);
                }
                break;
            case "招标保证金":
                $type_input = 1;
                $sql_price = $user_money_result->baozheng_money;
                if ($price  >  $sql_price){
                    return $this->ajaxRuturn("-1000", "金额不足,请提现正确的金额");
                }else{
                    $data = [
                        'baozheng_money' => $sql_price - $price,
                    ];
                    $user_money->update($data, ['id'=>$user_money_result->id]);
                }
                break;
            case "先息后本":
                $type_input = 100;
                $sql_price = $user_money_result->after_money;
                if ($price  >  $sql_price){
                    return $this->ajaxRuturn("-1000", "金额不足,请提现正确的金额");
                }else{
                    $data = [
                        'after_money' => $sql_price - $price,
                    ];
                    $user_money->update($data, ['id'=>$user_money_result->id]);
                }
                break;
        }

        $free = $price * 0.3;
        $cashout_data = [
            'uid' => $this->user_result->id,
            'caseout'=> $price,
            'free' => $free,
            'real_value' => $price - $free,
            'cashout_account_type' => $istype,
            'cashout_account' => "",
            'caseout_status' => "1",
            'create_time' => date("Y-m-d h:i:s"),
            'verify_time' => '',
            'transfer_time' => "",
            'cashout_type' => $type_input,
        ];
        $cashout = new Cashout();
        $cashout_result = $cashout->save($cashout_data);
        return $this->ajaxRuturn("1000", "提现成功,等待审核", $cashout_data);

    }


    public function getmoney(){
        $type = input("get.type");

        $user_money = new UserMoney();
        $user_money_result = $user_money->where(['uid'=>$this->user_result->id])->find();

        $goods = new Goods();
        $goods_result = $goods->where(['alias'=>$type])->select();

        $loanid = $_COOKIE['cashout_loanid'];
        $loan = new UserLoanModel();
        $loan_result = $loan->where(['id'=>$loanid])->find();

        return ([$user_money_result, $goods_result, $loan_result]);
    }

    public function pay(){
        $price = $_POST["price"];
        $istype = $_POST["istype"];
        $cashin_type = $_POST["cashin_type"];

        $type = $_POST["type"];
        if (empty($type)){
            $type = "300";
        }

        if ($istype == 0){
            return $this->ajaxRuturn("-1000", "参数错误,请重新进入");
        }



        $orderuid = $this->user_result->username;
        $goodsname = str_replace("->", "|", $cashin_type);
        $this->code = date("YmdHms");
        $uid = "11196";//"此处填写平台的uid";
        $token = "fa70150088cb3722d4e7a7cdd92053d6";//"此处填写平台的Token";
        $return_url = 'http://www.demo.com/payreturn.php';
        $notify_url = 'http://www.demo.com/paynotify.php';

        $key = md5($goodsname. $istype . $notify_url . $this->code . $orderuid . $price . $return_url . $token . $uid);
        //经常遇到有研发问为啥key值返回错误，大多数原因：1.参数的排列顺序不对；2.上面的参数少传了，但是这里的key值又带进去计算了，导致服务端key算出来和你的不一样。

        $returndata['goodsname'] = $goodsname;
        $returndata['istype'] = $istype;
        $returndata['key'] = $key;
        $returndata['notify_url'] = $notify_url;
        $returndata['orderid'] = $this->code;
        $returndata['orderuid'] =$orderuid;
        $returndata['price'] = $price;
        $returndata['return_url'] = $return_url;
        $returndata['uid'] = $uid;

        $data["cashin_account_type"] = $istype;
        $data["cashin"] = $price;
        $data["cashin_type"] = $type;


        switch ( $this->setloaninfo($istype , $data) ){
            case 1:
                return $this->ajaxRuturn("-1000", "账户余额不足");
                break;
        }
        return $this->ajaxRuturn("1000", "", $returndata);
    }


    public function setloaninfo($istype, $data){
        $user_goods = new Goods();
        $user_goods_return = $user_goods->where(['id'=>$data["cashin_type"]])->find();

        switch ($istype){
            case 1:
            case 2:
                break;
            case 3:
                $user_money = new UserMoney();
                $user_money_result = $user_money->where(['uid'=>$this->user_result->id])->find();
                if ($data["cashin"] > $user_money_result->cashout_money){
                    return 1;
                }
                switch ($user_goods_return->type){
                    case 1:
                        $data1 = [
                            'cashout_money' => $user_money_result->cashout_money - $user_goods_return->money,
                            'baozheng_money' => $user_goods_return->money
                        ];
                        $user_money->update($data1 , ['id'=>$user_money_result->id]);
                        break;
                    case 100:
                        $data1 = [
                            'cashout_money' => $user_money_result->cashout_money - $user_goods_return->money,
                            'after_money' => $user_goods_return->money
                        ];
                        $user_money->update($data1 , ['id'=>$user_money_result->id]);
                        break;
                }
                break;
        }
        $cashin = new CashIn();
        $data1 = [
            'uid' => $this->user_result->id,
            'cashin_account_type'=>$istype,
            'cashin'=>$data["cashin"],
            'pay_code'=>$this->code ,
            'created_at'=>date("Y-m-d H:i:s"),
            'cashin_staut'=>'1',
            'cashin_type'=>$user_goods_return->id,
        ];
        $cashin->save($data1);
    }

}
