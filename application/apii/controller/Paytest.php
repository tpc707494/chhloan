<?php
namespace app\apii\controller;


use app\admin\model\CashIn;
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
            $title = input("post.title");
        }

        $loanid = input("post.loanid");
        if (empty($loanid)){
            $title = input("post.loanid");
        }



        $this->view->assign('title', "账户提现");
        $this->view->assign('menulist', ["提现账户","提现类型"]);

        $this->view->assign('menulist_count', 2);

        $this->view->assign('account', json_encode([
            "微信",
            "支付宝",
            "银行卡"
        ]));
        if (empty($loanid)){
            $cashout_type = [
                "余额","招标保证金", "先息后本"
            ];
        }else{

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
        if (!empty($data)){
            $money_array = Array();
            $data_list = explode(",", $data);
            $goods = new Goods();
            $goods_result = $goods->whereIn('id', $data_list)->select();
            $menulist = "";
            $money = 0;
            $y_money = input("post.shangjin");
            if (empty($y_money)){
                $y_money = input("get.shangjin");
            }
//            return $this->ajaxRuturn(200, "", $goods_result);
            foreach ($goods_result as $item=>$value){
                if ($value->id!=200){
                    $config_pay[$item] = ['id'=>$value->id, "money"=>$value->money];
                }else{
                    $config_pay[$item] = ['id'=>$value->id, "money"=>$y_money];
                }

                $menulist = $menulist.$value->alias.'->';
                if (!empty($value->money)){
                    $money = $money + $value->money;
                }
            }
            if (empty($y_money)){
                $y_money = input("get.shangjin");
            }
            if (empty($y_money) || $y_money == "不悬赏" || !in_array(200, $data_list)){

            }else{
                $money = $money + $y_money;
            }
            $this->das_money = $money;
            $menulist = rtrim($menulist, "->");
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
                        $menulist
                    ]
                ],
            ];
                $this->view->assign('type', "1");
            $this->view->assign('money', $money);
            $this->view->assign('menulist', $view_data);
            $this->view->assign('money_list', json_encode($config_pay));
            $this->view->assign('menulist1', json_encode($view_data));


        }else{
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
                        "余额","招标保证金", "先息后本","悬赏"
                    ]
                ]
            ];
            $this->view->assign('type', "0");
            $this->view->assign('money', "0");
            $this->view->assign('menulist', $view_data);
            $this->view->assign('money_list', json_encode($config_pay));
            $this->view->assign('menulist1', json_encode($view_data));
        }
        $this->view->assign('phone', $this->phone);
        $user_money = new UserMoney();
        $user_money_result = $user_money->where(['uid'=>$this->user_result->id])->find();
        $this->view->assign('usermoney', $user_money_result);

        return $this->view->fetch();
    }

    public function getmoney(){
        $type = input("get.type");

        $user_money = new UserMoney();
        $user_money_result = $user_money->where(['uid'=>$this->user_result->id])->find();

        $goods = new Goods();
        $goods_result = $goods->where(['alias'=>$type])->select();
        return ([$user_money_result, $goods_result]);
    }

    public function pay(){
        $price = $_POST["price"];
        $istype = $_POST["istype"];
        $loanid = input("post.loanid");
        $cashin_type = $_POST["cashin_type"];
        $type = input("post.type");
        $sad = "";
        if ($istype == 0){
            return $this->ajaxRuturn("-1000", "参数错误,请重新进入");
        }



        $orderuid = $this->user_result->username;       //此处传入您网站用户的用户名，方便在平台后台查看是谁付的款，强烈建议加上。可忽略。

        //校验传入的表单，确保价格为正常价格（整数，1位小数，2位小数都可以），支付渠道只能是1或者2，orderuid长度不要超过33个中英文字。

        //此处就在您服务器生成新订单，并把创建的订单号传入到下面的orderid中。
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
        $data["cashin_type"] = $cashin_type;
        //return $this->ajaxRuturn("1000", $loanid."", $data);

        if ($istype == 3){
            $user_money = new UserMoney();
            $user_money_result = $user_money->where(['uid'=>$this->user_result->id])->find();
            if ($price > $user_money_result->cashout_money){
                return $this->ajaxRuturn("-1000", "账户余额不足");
            }
        }


        if ($type == 1){
            if ($istype == 3){
                $this->account_yue($_POST["money_list"], $data["cashin_account_type"]);
            }else{
                $this->setloaninfo($_POST["money_list"], $data["cashin_account_type"]);
            }
        }else{
            $this->set_money($data);
        }
        return $this->ajaxRuturn("1000", "", $returndata);
    }


    public function setloaninfo($list, $account){

        foreach ($list as $key=>$value){
            $cashin = new CashIn();
            $data = [
                'uid' => $this->user_result->id,
                'cashin_account_type'=>$account,
                'cashin'=>$value['money'],
                'pay_code'=>$this->code ,
                'created_at'=>date("Y-m-d H:i:s"),
                'cashin_staut'=>'0',
                'cashin_type'=>$value['id'],
            ];
            $cashin->save($data);
        }
    }

    public function account_yue($list, $account){

        $price = 0;
        foreach ($list as $key=>$value){
            $price = $price + $value['money'];
        }
        $user_money = new UserMoney();
        $user_money_result = $user_money->where(['uid'=>$this->user_result->id])->find();
        if ($price > $user_money_result->cashout_money){
            return $this->ajaxRuturn("-1000", "账户余额不足");
        }else{
            $user_money_result->cashout_money = $user_money_result->cashout_money - $price;
            $user_money->update($user_money_result);
        }
        $user_money = new UserMoney();
        $user_money_result = $user_money->where(['uid'=>$this->user_result->id])->find();

        $uaer_money_data = Array();
        foreach ($list as $key=>$value){
            switch ($value['id']){
                case 1:
                    $uaer_money_data['baozheng_money'] = $user_money_result->baozheng_money + $value['money'];
                    break;
                case 100:
                    $uaer_money_data['after_money'] = $user_money_result->after_money + $value['money'];
                    break;
                case 200:
//                    $uaer_money_data['shangjin'] = $user_money_result->baozheng_money + $value['money'];
                    break;
            }
        }

        foreach ($list as $key=>$value){
            $cashin = new CashIn();
            $data = [
                'uid' => $this->user_result->id,
                'cashin_account_type'=>$account,
                'cashin'=>$value['money'],
                'pay_code'=>$this->code ,
                'created_at'=>date("Y-m-d H:i:s"),
                'cashin_staut'=>'1',
                'cashin_type'=>$value['id'],
            ];
            $cashin->save($data);
        }
    }



    public function set_money($data1,$loanid){
        if ($data1['cashin_account_type'] == 3){
            $this->neiaccount($data1,$loanid);
        }else{
            $goods = new Goods();
            $goods_result = $goods->where(['alias'=>$data1['cashin_type']])->find();

            $cashin = new CashIn();
            $data = [
                'uid' => $this->user_result->id,
                'cashin_account_type'=>$data1['cashin_account_type'],
                'cashin'=>$data1['cashin'],
                'pay_code'=>$this->code ,
                'created_at'=>date("Y-m-d H:i:s"),
                'cashin_staut'=>'0',
                'cashin_type'=>$goods_result->id,
            ];
            $cashin->save($data);
        }
    }

    public function neiaccount($data1, $loanid){
        $goods = new Goods();
        $goods_result = $goods->where(['alias'=>$data1['cashin_type']])->find();
        $user_money = new UserMoney();
        $user_money_result = $user_money->where(['uid'=>$this->user_result->id])->find();

        switch ($goods_result->type){
            case 1:
                if ($user_money_result->cashout_money >= $goods_result->money){
                    $data = [
                        'baozheng_money' => $user_money_result->baozheng_money + $goods_result->money,
                        'cashout_money' => $user_money_result->cashout_money - $goods_result->money,
                    ];
                    $user_money->update($data, ['uid'=>$this->user_result->id]);
                }else{
                    return $this->ajaxRuturn("4004","余额不足");
                }
                break;
            case 100:
                if ($user_money_result->cashout_money >= $data1['cashin']){

                    $loan_table = new UserLoanModel();
                    $loan_table_result = $loan_table->where(['id'=>$loanid])->find();
                    $loan_table->update([
                        'shangjin'=>($loan_table_result->shangjin+ $data1['cashin'])
                    ]);
                }else{
                    return $this->ajaxRuturn("4004","余额不足");
                }

                break;
            case 200:

                if ($user_money_result->cashout_money >= $goods_result->money){
                    $data = [
                        'baozheng_money' => $user_money_result->baozheng_money + $goods_result->money,
                        'cashout_money' => $user_money_result->cashout_money - $goods_result->money,
                    ];
                    $user_money->update($data, ['uid'=>$this->user_result->id]);
                }else{
                    return $this->ajaxRuturn("4004","余额不足");
                }
                break;
            case 300:
                break;
            default:
                break;
        }
    }
}
