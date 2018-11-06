<?php
namespace app\apii\controller;
use app\admin\model\CashIn;
use app\admin\model\Goods;
use app\admin\model\user\base\LaonShangjin;
use app\admin\model\UserLoanModel;
use app\admin\model\UserMoney;
use app\common\controller\Base;

class Wxnotify extends Base{
    public function initialize()
    {

    }

    public function paynotify(){
        $platform_trade_no = $_GET["platform_trade_no"];
        $orderid = $_GET["orderid"];
        $price = $_GET["price"];
        $realprice = $_GET["realprice"];
        $orderuid = $_GET["orderuid"];
        $key = $_GET["key"];
        $token = "fa70150088cb3722d4e7a7cdd92053d6";

        $temps = md5($orderid . $orderuid . $platform_trade_no . $price . $realprice . $token);

        if ($temps == $key){
            return $this->jsonError("key值不匹配");
        }else{
            $cashin = new Cashin();
            $cashin_result = $cashin->where(['pay_code'=>$orderid, 'cashin_staut'=>1])->select();
            if (!empty($cashin_result)){
                foreach ($cashin_result as $key => $value){
                    $user_money = new UserMoney();
                    $user_money_result = $user_money->where(['uid'=>$value->uid])->find();
                    $cashin = new Cashin();
                    switch ($value->cashin_type){
                        case 1:
                            $data = [
                                'baozheng_money' => $user_money_result->baozheng_money + $value->cashin
                            ];
                            $user_money->update($data, ['id'=>$user_money_result->id]);
                            $data1 = [
                                'cashin_staut' => "0"
                            ];
                            $cashin->update($data1, ['id'=> $value->id]);
                            break;
                        case 100:
                            $data = [
                                'after_money' => $user_money_result->after_money + $value->cashin
                            ];
                            $user_money->update($data, ['id'=>$user_money_result->id]);
                            $data1 = [
                                'cashin_staut' => "0"
                            ];
                            $cashin->update($data1, ['id'=> $value->id]);
                            break;
                        case 200:
                            $shang = new LaonShangjin();
                            $shang_result = $shang->where(['code'=>$orderuid])->find();
                            if (empty($shang_result)){
                                break;
                            }
                            $loan = new UserLoanModel();
                            $loan_result = $loan->where(['id'=>$shang_result->loanid])->find();
                            $data = [
                                'shangjin' => $loan_result->shangjin + $value->cashin
                            ];
                            $loan->update($data, ['id'=>$shang_result->loanid]);
                            $data1 = [
                                'cashin_staut' => "0"
                            ];
                            $cashin->update($data1, ['id'=> $value->id]);
                            break;
                        case 300:
                            $data = [
                                'cashout_money' => $user_money_result->cashout_money + $value->cashin
                            ];
                            $user_money->update($data, ['id'=>$user_money_result->id]);
                            $data1 = [
                                'cashin_staut' => "0"
                            ];
                            $cashin->update($data1, ['id'=> $value->id]);
                            break;
                    }
                }
            }
        }
    }
    //返回错误
    function jsonError($message = '',$url=null)
    {
        $return['msg'] = $message;
        $return['data'] = '';
        $return['code'] = -1;
        $return['url'] = $url;
        return json_encode($return);
    }

    //返回正确
    function jsonSuccess($message = '',$data = '',$url=null)
    {
        $return['msg']  = $message;
        $return['data'] = $data;
        $return['code'] = 1;
        $return['url'] = $url;
        return json_encode($return);
    }
}