<?php

namespace app\admin\model\user\base;

use think\Model;

class Info extends Model
{
    // 表名
    protected $name = 'user_base_info';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    
    // 追加属性
    protected $append = [

    ];
    

    







}
