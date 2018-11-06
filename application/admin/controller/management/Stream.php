<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/9
 * Time: 12:09
 */
namespace app\admin\controller\management;
use app\common\controller\Backend;
use think\Controller;

class Stream extends Backend
{
    protected $relationSearch = true;


    /**
     * Gjj模型对象
     * @var \app\admin\model\user\base\Gjj
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
//        $this->model = new \app\admin\model\user\base\Gjj;

    }
}