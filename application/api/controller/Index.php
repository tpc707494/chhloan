<?php

namespace app\api\controller;

use app\common\controller\Api;

/**
 * 首页接口
 */
class Index extends Api
{

    protected $noNeedLogin = ['index'];
    protected $noNeedRight = ['*'];

    public function _initialize()
    {
        parent::_initialize();
    }
    /**
     * 首页
     * 
     */
    public function index()
    {
        $this->success('请求成功');
    }
    public function test()
    {
        $this->success('请求成功');
    }
}
