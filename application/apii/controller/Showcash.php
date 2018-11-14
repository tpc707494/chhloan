<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/13
 * Time: 20:36
 */

namespace app\apii\controller;



use app\admin\model\CashIn;
use app\admin\model\Cashout;
use app\admin\model\Goods;
use app\apii\model\UserModel;

class Showcash extends Common{

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

    public function cashin()
    {
//        return $this->ajaxRuturn("1000", "", $user_cashin_result);

        $this->view->assign('phone', $this->phone);
        $this->view->assign('token', $this->user_result->token);
        $page_title = input("get.page_title");
        if (empty($page_title)){
            $page_title = "1";
        }
        $this->view->assign('page_title', $page_title);
        if ($this->request->isAjax()){
            $type = input("get.type");
            $result = [];
            if ($type == 1){
                $user_goods = new Goods();
                $user_cashin = new CashIn();
                $user_cashin_result = $user_cashin->where(['uid'=>$this->user_result->id, 'cashin_staut'=>"0"])->select();
                foreach ($user_cashin_result as $key=>$value)
                {
                    switch ($value->cashin_account_type) {
                        case 1:
                            $result[$key]["account"] = "支付宝";
                            break;
                        case 2:
                            $result[$key]["account"] = "微信";
                            break;
                        case 3:
                            $result[$key]["account"] = "账户余额";
                            break;

                    }
                    $result[$key]["money"] = $value->cashin;

                    $result[$key]["title"] = $user_goods->where(['id'=>$value->cashin_type])->find()->goods;

                    $result[$key]["time"] = $value->created_at;
                }
            }else if ($type == 2)
            {
                $user_goods = new Goods();
                $cashout = new Cashout();
                $cashout_result = $cashout->where(['uid'=>$this->user_result->id])->select();
                foreach ($cashout_result as $key=>$value) {
                    switch ($value->cashout_account_type) {
                        case 1:
                            $result[$key]["account"] = "支付宝";
                            break;
                        case 2:
                            $result[$key]["account"] = "微信";
                            break;
                        case 3:
                            $result[$key]["account"] = "账户余额";
                            break;
                        default:
                            $result[$key]["account"] = "未知";
                            break;

                    }
                    $user_good_result = $user_goods->where(['id'=>$value->cashout_type])->find();
                    if (!empty($user_good_result)){
                        $result[$key]["title"]  = $user_good_result->goods;
                    }else{
                        $result[$key]["title"]  = $value->cashout_type;
                    }
                    $result[$key]["time"] = $value->create_time;
                    $result[$key]["money"] = $value->caseout;


                }
            }
            return $this->ajaxRuturn(1000, "", $result);
        }
        return $this->view->fetch();
    }
}