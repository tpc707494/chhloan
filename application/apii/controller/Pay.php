<?php
namespace app\apii\controller;
use app\admin\model\CashIn;
use app\admin\model\Goods;
use app\admin\model\user\base\LaonShangjin;
use app\admin\model\UserLoanModel;
use app\admin\model\UserMoney;
use app\apii\model\UserModel;
use app\common\controller\Base;

class Pay extends Base
{
    private $phone="";
    private $user_result;
    private $code = '';
    public function _initialize()
    {
        $validate = $this->validate(input("get."), [
            'phone' => 'require',
            'cashin_account_type' => 'require',
            'cashin' => 'require',
            'cashin_type' => 'require',
        ], [
            'phone.require' => '参数错误',
            'cashin_account_type.require' => '参数错误',
            'cashin.require' => '参数错误',
            'cashin_type.require' => '参数错误',
        ]);

        if ($validate !== true) return $this->ajaxRuturn(4001, $validate);
        $this->code = date("YmdHms");
        $user_table = new UserModel();
        $this->user_result = $user_table->where('phone', $this->phone)->find();

        $loanid = input("get.loanid");

        $data["cashin_account_type"] = input("get.cashin_account_type");
        $data["cashin"] = input("get.cashin");
        $data["cashin_type"] = input("get.cashin_type");

        $this->set_money($data, $loanid);
        if ($data["cashin_account_type"]==2){
            $this->neiaccount($data, $loanid);
        }
    }

//    public function pay_order()
//    {
//        switch ($this->account){
//            case 'wx':
//                $cashin_yong_account = "1";
//                $data['phone'] = $this->phone;
//                $data['money'] =$this->all_money;
//                $data['cashin_yong_account'] ="1";
//                $data['time'] = date("YmdHms");
////                if (!$this->setwx($data)){
////                    return $this->ajaxRuturn("4000", "用户不存在");
////                }
//
//                $orderId = $data['time'];
//                $type['orderId'] = $orderId;
//                if ($cashin_yong_account=='0'){
//                    $name=$type['orderId'].'招标保证金';
//                }
//                else if ($cashin_yong_account=='1'){
//                    $name=$type['orderId'].'先息后本服务';
//                }
//                else  if ($cashin_yong_account=='2'){
//                    $name=$type['orderId'].'充值服务';
//                }else  if ($cashin_yong_account=='3'){
//                    $name=$type['orderId'].'悬赏';
//                }
//                $url = $this->url_translation_address("notice_url");
//                $wx = new Wxpay();
//                //提交地址
//                $time_card=$this->all_money * 100;
//                $order = $wx->getPrePayOrder($name,$type['orderId'],$time_card, $url);
//                return  $this->ajaxRuturn("1000", "", $order);
//                if (($order['prepay_id'])){//判断返回参数中是否有prepay_id
//
//                    $order1 = $wx->getOrder($order['prepay_id']);//执行二次签名返回参数
//                    $result = array('code' => 1,'msg' => '成功', 'data' =>$order1);
//                    return json($result);
//                } else {
//                    return  json($order['err_code_des']);
//                }
//
//
////                $data['phone'] = $this->phone;
////                $data['money'] =$this->all_money;
////                $time_card=$this->all_money * 100;
////                $data['time'] = date("YmdHms");
////                $wx = new Wxpay();
////
////                $orderId = $data['time'];
////                $type['orderId'] = $orderId;
////                $name=$type['orderId'].'招标保证金';
////                //提交地址
////                $url = $this->url_translation_address("notice_url");
//////                $order = $wx->getPrePayOrder($time_card.$this->alias, $data['time'] ,$time_card, $url);
////                $order = $wx->getPrePayOrder($name,$type['orderId'],$time_card, $url);
////                return  $this->ajaxRuturn("4000", "用户不存在", $order);
////
////
////                if (!empty($order['prepay_id'])){//判断返回参数中是否有prepay_id
////
////                    $order1 = $wx->getOrder($order['prepay_id']);//执行二次签名返回参数
////                    $result = array('code' => 1,'msg' => '成功', 'data' =>$order1);
////                    return json($result);
////                } else {
////                    return  json($order['err_code_des']);
////                }
//
//                break;
//        }
//
//
////        return  $this->ajaxRuturn(4004, "",[$this->all_money, $this->cash_id,$this->alias]);
//
//        return;
//        //return "dasdadaddsd";
//        $res = new OrderGoodsModel();
//        //获取订单号
//        //查询订单信息
//        //$order_info = $res->where($where)->find();
//        //获取支付方式
//        $pay_type = input('get.pay_type');//微信支付 或者支付宝支付
//        //获取支付金额
//        $money = input('get.totle_sum');
//        $cashin_yong_account = input('get.cashtype');
//        $phone = input('get.phone');
//
//        //判断支付方式
//        switch ($pay_type) {
//            case 'ali';//如果支付方式为支付宝支付
////                $type['pay_type'] = 'ali';
////                $res->where($where)->update($type);
////
////                //实例化alipay类
////                $ali = new Alipay();
////
////                //异步回调地址
////                $url = 'XXXXXXXXXXXXXXXXXX/Callback/aliPayBack';
////
////                $array = $ali->alipay('商品名称', $money,$reoderSn,  $url);
////
////                if ($array) {
////                    return $array;
////                } else {
////                    echo json_encode(array('status' => 0, 'msg' => '对不起请检查相关参数!@'));
////                }
//                break;
//            case 'wx';
//                $data['phone'] = $phone;
//                $data['money'] =$money;
//                $data['cashin_yong_account'] =$cashin_yong_account;
//                $data['time'] = date("YmdHms");
//                if (!$this->setwx($data)){
//                    return $this->ajaxRuturn("4000", "用户不存在");
//                }
//
//                $orderId = $data['time'];
//                $type['orderId'] = $orderId;
//                if ($cashin_yong_account=='0'){
//                    $name=$type['orderId'].'招标保证金';
//                }
//                else if ($cashin_yong_account=='1'){
//                    $name=$type['orderId'].'先息后本服务';
//                }
//                else  if ($cashin_yong_account=='2'){
//                    $name=$type['orderId'].'充值服务';
//                }else  if ($cashin_yong_account=='3'){
//                    $name=$type['orderId'].'悬赏';
//                }
//                $url = $this->url_translation_address("notice_url");
//                $wx = new Wxpay();
//                //提交地址
//                $time_card=$money * 100;
//                $order = $wx->getPrePayOrder($name,$type['orderId'],$time_card, $url);
//                if (($order['prepay_id'])){//判断返回参数中是否有prepay_id
//
//                    $order1 = $wx->getOrder($order['prepay_id']);//执行二次签名返回参数
//                    $result = array('code' => 1,'msg' => '成功', 'data' =>$order1);
//                    return json($result);
//                } else {
//                    return  json($order['err_code_des']);
//                }
//
//                break;
//            default:
//                return  $this->ajaxRuturn(4004, "error");
//                break;
//        }
//    }
//    //地址
//    protected function url_translation_address($url)
//    {
//        return "http://www.chhloan.com/api/wxnotify/" . $url;
//    }
//    public function setwx($data){
//        $phone = $data['phone'];
//        $user = new UsersModel();
//        $user_result = $user->where('phone', $phone)->find();
//        if (!empty($user_result)){
//            $user_case_in = new CaseInModel();
//            $data_cashin = [
//                'uid'=>$user_result->id,
//                'cashin_type'=>0,
//                'cashin'=>$data['money'],
//                'fees'=>$data['money'],
//                'reel_cashin'=>$data['money'],
//                'cashin_account'=>'',
//                'pay_code'=>$data['time'],
//                'created_at'=>$data['time'],
//                'pay_type'=>'0',//充值但是没有确认
//                'cashin_yong_account'=>$data['cashin_yong_account'],
//            ];
//            $user_case_in->save($data_cashin);
//            return true;
//        }else{
//            return false;
//        }
//    }

    public function set_money($data1,$loanid){
        $cashin = new CashIn();
        $data = [
            'uid' => $this->user_result->id,
            'cashin_account_type'=>$data1['cashin_account_type'],
            'cashin'=>$data1['cashin'],
            'pay_code'=>$this->code ,
            'created_at'=>date("Y-m-d H:i:s"),
            'cashin_staut'=>'0',
            'cashin_type'=>$data1['cashin_type'],
        ];
        $cashin->save($data);

        if ($data1['cashin_type']==200 && !$data1['cashin_account_type']!=2){
            $data2 = [
                'uid' => $this->user_result->id,
                'code' => $this->code,
                'shangjin'=> $data1['cashin'],
                'loanid' => $loanid,
                'create_at'=>date("Y-m-d H:i:s"),
            ];
            $loansahng = new LaonShangjin();
            $loansahng->update($data2);
        }
    }
    public function neiaccount($data1, $loanid){
        $goods = new Goods();
        $goods_result = $goods->where(['id'=>$data1['cashin_type']])->find();
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