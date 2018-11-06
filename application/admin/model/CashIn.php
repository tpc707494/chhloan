<?php

namespace app\admin\model;

use think\Model;
use think\Session;

class CashIn extends Model
{
    // 表名
    protected $name = 'cashin';
//    // 开启自动写入时间戳字段
//    protected $autoWriteTimestamp = 'int';
//    // 定义时间戳字段名
//    protected $createTime = 'createtime';
//    protected $updateTime = 'updatetime';

//    /**
//     * 重置用户密码
//     * @author baiyouwen
//     */
//    public function resetPassword($uid, $NewPassword)
//    {
//        $passwd = $this->encryptPassword($NewPassword);
//        $ret = $this->where(['id' => $uid])->update(['password' => $passwd]);
//        return $ret;
//    }
//
//    // 密码加密
//    protected function encryptPassword($password, $salt = '', $encrypt = 'md5')
//    {
//        return $encrypt($password . $salt);
//    }
    public function user()
    {
        return $this->belongsTo('app\apii\model\UserModel', 'uid', 'id', [], 'LEFT')->setEagerlyType(0);
    }
    public function goods()
    {
        return $this->belongsTo('Goods', 'cashin_type', 'id', [], 'LEFT')->setEagerlyType(0);
    }
}
