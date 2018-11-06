<?php
namespace app\apii\controller;

use app\apii\model\GlobConfigModel;

class Index extends Common
{
    public function _initialize()
    {

        $this->phone = input("get.phone");
    }
    var $phone="";
    public function index(){
        return $this->phone;
    }
    function getandroid_update(){

        if ($this->request->isPost()) {
            $config = new GlobConfigModel();
            $resule = $config->where(['alias'=> 'android_update'])->select();
            if (!empty($resule)){
                return $this->ajaxRuturn(1000, "安卓版本获取成功", $resule);
            }else{
                return $this->ajaxRuturn(4000, "安卓版本获取失败");
            }
        }else{
            return $this->ajaxRuturn(4000, "安卓版本获取失败");
        }
    }
}
