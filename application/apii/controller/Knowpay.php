<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/1
 * Time: 14:02
 */

namespace app\apii\controller;


use app\admin\model\CashIn;
use app\admin\model\Goods;
use app\admin\model\user\base\LaonShangjin;
use app\admin\model\UserLoanModel;
use app\admin\model\UserMoney;
use app\apii\model\UserModel;

//cookie('parm',json_encode($config_pay),array('expire'=>300,'prefix'=>'pay_'));

class Knowpay extends Common
{
    public $page_title;
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
    public function cashout(){
        $this->view->assign('type', "1");
    }
    public function cashin(){
//        [
//            'id' =>
//            'type' =>
//            'money'=>
//        ]
//        cookie('name',json_encode($dda),array('expire'=>300,'prefix'=>'think_'));
//        $json_data = $_COOKIE['think_name'];
//        $json_d = json_decode($json_data);
//        echo $json_d[1]->id;
//        if (!array_key_exists("pay_parm", $_COOKIE)){
//            echo json_encode($_COOKIE["pay_parm"]);
//        }


        $data = input("post.data");
        if (empty($data)){
            $data = input("get.data");
        }

        $y_money = input("post.shangjin");
        if (empty($y_money)){
            $y_money = input("get.shangjin");
        }

        $loan_id = input("post.loan_id");
        if (empty($loan_id)){
            $loan_id = input("get.loan_id");
        }
        $user_loan = new UserLoanModel();
        $user_loan_result = $user_loan->where(['id'=>$loan_id])->find();
        if (!empty($user_loan_result)){
            cookie('loan_id',$loan_id,array('expire'=>300,'prefix'=>'pay_'));
        }
        $menulist = ""; //显示的所有文字
        $money = 0;     //总金额
        $config_pay = Array();
        if (!empty($data)){
            $data_list = explode(",", $data);
            $goods = new Goods();
            $goods_result = $goods->whereIn('id', $data_list)->select();
            foreach ($goods_result as $item=>$value){
                if ($value->id!=200){
                    $config_pay[$item] = ['id'=>$value->id, "account"=>[$value->money], 'title'=> $value->goods];
                }else{
                    $config_pay[$item] = ['id'=>$value->id, "account"=>[$y_money], 'title'=> $value->goods];
                    $money = $money + $y_money;
                }

                $menulist = $menulist.$value->alias.'->';
                if (!empty($value->money)){
                    $money = $money + $value->money;
                }
            }
            cookie('parm',json_encode($config_pay),array('expire'=>300,'prefix'=>'pay_'));

            $this->page_title = "账户充值";


            $view_data = [
                [
                    "title"=>"充值账户",
                    "account"=>[
                        "微信",
                        "支付宝",
                        "账户余额"
                    ]
                ],
                [
                    "title"=>"充值类型",
                    "account"=>[
                        rtrim($menulist, "->")
                    ]
                ],
                [
                    "title"=>"总金额",
                    "account"=>[
                        $money
                    ]
                ],
            ];



    //        exit(json_encode($c));

            $this->view->assign('menulist', ($view_data));
            $this->view->assign('jinetype', ($config_pay));
            $this->view->assign('menulist1', json_encode($view_data));
            $this->view->assign('title', $this->page_title);
            $this->view->assign('phone', $this->phone);
            $user_money = new UserMoney();
            $user_money_result = $user_money->where(['uid'=>$this->user_result->id])->find();
            $this->view->assign('usermoney', ($user_money_result));
            return $this->view->fetch();
        }else{

        }
    }
    public function pay(){
        $this->code = date("YmdHis");
        $istype = input('post.istype');//$_POST["istype"];

        if (!array_key_exists("pay_parm", $_COOKIE)){
            return $this->ajaxRuturn(-100, "请返回重新提交");
        }
        if (!array_key_exists("pay_loan_id", $_COOKIE)){
            return $this->ajaxRuturn(-200, "请返回重新提交");
        }
        $pay_loan_id = $_COOKIE['pay_loan_id'];
        $user_loan = new UserLoanModel();
        $user_loan_result = $user_loan->where(['id'=>$pay_loan_id])->find();
        if (empty($user_loan_result)){
            return $this->ajaxRuturn(-200, "请返回重新提交");
        }
        $pay_parm = $_COOKIE['pay_parm'];
        $json_d = json_decode($pay_parm);
        $price = 0;
        $goodsname = "";
        foreach ($json_d as $key=>$value){
            $price = $price+$value->account[0];
            $goodsname = $goodsname . $value->title;
        }
        $user_money = new UserMoney();
        $user_money_result = $user_money->where(['uid'=>$this->user_result->id])->find();
        switch ($istype){
            case 1:
            case 2:
                foreach($json_d as $key=>$value){
                    $cashin = new CashIn();
                    $data = [
                        'uid' => $this->user_result->id,
                        'cashin_account_type'=>$istype,
                        'cashin'=>$value->account[0],
                        'pay_code'=>$this->code ,
                        'created_at'=>date("Y-m-d H:i:s"),
                        'cashin_staut'=>'1',
                        'cashin_type'=>$value->id,
                    ];
                    $cashin->save($data);
                    $shang = new LaonShangjin();
                    $data1 = [
                        'uid' => $this->user_result->id,
                        'code' => $this->code ,
                        'loanid' => $pay_loan_id,
                        'create_at' => date("Y-m-d H:i:s"),
                    ];
                    $shang->save($data1);
                }
                break;
            case 3:
                if ($price > $user_money_result->cashout_money){
                    return $this->ajaxRuturn(-100, "账户余额不足");
                }
                foreach($json_d as $key=>$value){
                    $user_money = new UserMoney();
                    $user_money_result = $user_money->where(['uid'=>$this->user_result->id])->find();
                    $goods = new Goods();
                    $goods_result = $goods->where(['id'=>$value->id])->find();
                    switch ($goods_result->alias){
                        case "招标保证金":
                            $data = [
                                'baozheng_money' => $user_money_result->baozheng_money + $value->account[0],
                                'cashout_money' => $user_money_result->cashout_money - $value->account[0]
                            ];
                            $user_money->update($data, ['uid'=>$this->user_result->id]);
                            break;
                        case "先息后本":
                            $data = [
                                'after_money' => $user_money_result->after_money + $value->account[0],
                                'cashout_money' => $user_money_result->cashout_money - $value->account[0]
                            ];
                            $user_money->update($data, ['uid'=>$this->user_result->id]);
                            break;
                        case "悬赏":
                            $user_loan = new UserLoanModel();
                            $user_loan_result = $user_loan->where(['id'=>$pay_loan_id])->find();
                            if (!empty($user_loan_result)){
                                $data1 = [
                                    'shangjin' => $user_loan_result->shangjin + $value->account[0]
                                ];
                                $user_loan->update($data1, ['id'=>$pay_loan_id]);
                                $data = [
                                    'cashout_money' => $user_money_result->cashout_money - $value->account[0]
                                ];
                                $user_money->update($data, ['uid'=>$this->user_result->id]);
                            }
                            break;
                        default:
                            return $this->ajaxRuturn(-100, "请返回重试");
                            break;
                    }
                }
                foreach($json_d as $key=>$value){
                    $cashin = new CashIn();
                    $data = [
                        'uid' => $this->user_result->id,
                        'cashin_account_type'=>$istype,
                        'cashin'=>$value->account[0],
                        'pay_code'=>$this->code ,
                        'created_at'=>date("Y-m-d H:i:s"),
                        'cashin_staut'=>'1',
                        'cashin_type'=>$value->id,
                    ];
                    $cashin->save($data);
                }
                break;
        }
        $result = $this->result_a($goodsname, $istype, $price);
        return $this->ajaxRuturn("1000", "", $result);
    }

    public function result_a($goodsname1,$istype,$price ){
        $goodsname = $goodsname1;
        $orderuid = $this->user_result->username;
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
        return $returndata;
    }

}