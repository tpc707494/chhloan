<?php

namespace app\admin\controller\user;

use app\common\controller\Backend;

/**
 * 会员管理
 *
 * @icon fa fa-user
 */
class Cashin extends Backend
{

    protected $relationSearch = true;


    /**
     * @var \app\admin\model\UserModel
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('CashIn');
    }

    /**
     * 查看
     */
    public function index()
    {
//        list($where, $sort, $order, $offset, $limit) = $this->buildparams();
//        $total = $this->model
//                ->with(['user', 'goods'])
//                ->where($where)
//            ->order($sort, $order)
//            ->limit($offset, $limit)
//            ->select();
//        return json($total);

        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax())
        {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField'))
            {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $total = $this->model
                ->with(['user', 'goods'])
                ->where($where)
                ->order($sort, $order)
                ->count();
            $list = $this->model
                ->with(['user', 'goods'])
                ->where($where)
                ->limit($offset, $limit)
                ->order($sort, $order)
                ->select();

            foreach ($list as $k => &$v)
            {
                $v['cashin_staut'] = $v['cashin_staut']=='1'?"充值完成":"充值中";
                if ($v['cashin_account_type'] == 2){
                    $v['cashin_account_type'] = "微信";
                }else if ($v['cashin_account_type'] == 1){
                    $v['cashin_account_type'] = "支付宝";
                }else if ($v['cashin_account_type'] == 3){
                    $v['cashin_account_type'] = "账户余额";
                }

            }
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }

    /**
     * 编辑
     */
    public function edit($ids = NULL)
    {
        $row = $this->model->get($ids);
        if (!$row)
            $this->error(__('No Results were found'));
        $this->view->assign('groupList', build_select('row[group_id]', \app\admin\model\UserGroup::column('id,name'), $row['group_id'], ['class' => 'form-control selectpicker']));
        return parent::edit($ids);
    }
}
