<?php
namespace app\apii\controller;

//use app\apii\controller\Cashin;
use app\admin\model\Apiconfig;
use app\admin\model\Cashout;
use app\admin\model\HeHuoRen;
use app\admin\model\user\base\Alipay;
use app\admin\model\user\base\Gjj;
use app\admin\model\user\base\Lianxiren;
use app\admin\model\user\base\Rl;
use app\admin\model\user\base\Sb;
use app\admin\model\user\base\Sjk;
use app\admin\model\user\base\Wechat;
use app\admin\model\user\base\Xinyongka;
use app\admin\model\UserLoanModel;
use app\admin\model\UserMoney;
use app\apii\model\CaseInModel;
use app\apii\model\GlobConfigModel;
use app\apii\model\PreRegistrationModel;
use app\apii\model\UserBaseInfo;
use app\apii\model\UserGjjModel;
use app\apii\model\UserLianXiRen;
use app\apii\model\UserlModel;
use app\apii\model\UserMoneyModel;
use app\apii\model\UsersAlipy;
use app\apii\model\UserSbModel;
use app\apii\model\UserSjkModel;
use app\apii\model\UserModel;
use app\apii\model\UsersWeChat;
use app\apii\model\UsersXykModel;
use app\common\controller\Base;
use app\common\model\CashOutModel;
use app\admin\model\user\base\Info;

class Setindex extends Common
{
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
    /*
     *
     * 基本信息设置
     *
     * */
    public function set_user_base()
    {
        $validate = $this->validate(input("get."), [
            'real_name' => 'require',
            'sfznumber' => 'require',
            'home_addr' => 'require',
            'sex' => 'require',
            'minzu' => 'require',
            'job' => 'require',
            'wages' => 'require',
//            'yinghangka' => 'require',
//            'yinghangname' => 'require',
//            'yinhangkatype' => 'require',
//            'yinghang_phone' => 'require',
        ], [
            'real_name.require' => '请输入真实姓名',
            'sfznumber.require' => '请输入身份证',
            'home_addr.require' => '请输入家庭地址',
            'sex.require' => '请输入性别',
            'minzu.require' => '请输入民族',
            'job.require' => '请输入工作',
            'wages.require' => '请输入工资',
//            'yinghangka.require' => '请输入手机号',
//            'yinghangname.require' => '请输入手机号',
//            'yinhangkatype.require' => '请输入手机号',
//            'yinghang_phone.require' => '请输入手机号',
        ]);
        if ($validate !== true) return $this->ajaxRuturn(4001, $validate);
        $input_data = array();
        $input_data['real_name'] = input("get.real_name");
        $input_data['sfznumber'] = input("get.sfznumber");
        $input_data['home_addr'] = input("get.home_addr");
        $input_data['sex'] = input("get.sex");
        $input_data['minzu'] = input("get.minzu");
        $input_data['job'] = input("get.job");
        $input_data['wages'] = input("get.wages");
        $input_data['yinghangka'] = input("get.yinghangka");
        $input_data['yinghangname'] = input("get.yinghangname");
        $input_data['yinhangkatype'] = input("get.yinhangkatype");
        $input_data['yinghang_phone'] = input("get.yinghang_phone");

        $user_base_info = new Info();
        $user_base_info_result = $user_base_info->where('uid', $this->user_result->id)->find();
        if (!empty($user_base_info_result)){
            $user_base_info->update($input_data, ['uid'=>$this->user_result->id]);
        }else {
            $input_data['uid'] = $this->user_result->id;
            $user_base_info->save($input_data);
        }
        $user_table = new UserModel();
        $user_data = [
            'username'=> $input_data['real_name'],
        ];
        $user_table_result =$user_table->update($user_data, ["id"=>$this->user_result->id]);

        return $this->ajaxRuturn(1000, "基本信息添加成功");
    }
    /*
     *
     * 银行卡设置
     *
     * */
    public function set_user_yinghangka(){
        $validate = $this->validate(input("get."), [
            'yinghangka' => 'require',
            'yinghangname' => 'require',
            'yinhangkatype' => 'require',
            'yinghang_phone' => 'require',
        ], [
            'yinghangka.require' => '请输入银行卡',
            'yinghangname.require' => '请输入银行卡名',
            'yinhangkatype.require' => '请输入银行类型',
            'yinghang_phone.require' => '请输入银行手机号',
        ]);
        if ($validate !== true) return $this->ajaxRuturn(4001, $validate);
        $data = [
            'yinghangka'=>input('get.yinghangka'),
            'yinghangname'=>input('get.yinghangname'),
            'yinhangkatype'=>input('get.yinhangkatype'),
            'yinghang_phone'=>input('get.yinghang_phone'),
        ];
        $user_base = new Info();
        $user_base_result = $user_base->where('uid', $this->user_result->id)->find();
        if (!empty($user_base_result)){
            $user_base->update($data, ['uid'=>$this->user_result->id]);
        }else{
            $data['uid'] = $this->user_result->id;
            $user_base->save($data);
        }
        return $this->ajaxRuturn(1000, "银行卡保存/更新成功");
    }

    /*
     *
     * 信息设置
     *
     * */
    public function set_identification_info(){
        $phone = input("get.phone");
        $type = input("get.type");
        $area = input("get.area");
        $account = input("get.account");
        $area = $account;
        $user = new UserModel();
        $user_result = $user->where("phone", $phone)->find();
        if (empty($user_result)){
            return $this->ajaxRuturn("4004", "用户不存在");
        }
        if ($type=="base"){

        }
        else if ($type=="xinyongka"){
            $user_xinyongka = new Xinyongka();
            $user_xinyongka_result = $user_xinyongka->where("uid", $user_result->id)->find();
            $data = [
                "xyk_account"=>$area,
                "create_at"=>date("Y-m-d H:i:s")
            ];
            if (!empty($user_xinyongka_result)){

                $user_xinyongka->update($data, ['id'=>$user_xinyongka_result->id]);
            }else{
                $data['uid'] = $user_result->id;
                $user_xinyongka->save($data);
            }
        }
        else if ($type=="sb"){
            $user_sb = new Sb();
            $user_sb_result = $user_sb->where("uid", $user_result->id)->find();
            $data = [
                "sb_account"=>$area,
                "create_at"=>date("Y-m-d H:i:s")
            ];
            if (!empty($user_sb_result)){

                $user_sb->update($data, ['id'=>$user_sb_result->id]);
            }else{
                $data['uid'] = $user_result->id;
                $user_sb->save($data);
            }
        }
        else if ($type=="gjj"){
            $user_gjj = new Gjj();
            $user_gjj_result = $user_gjj->where("uid", $user_result->id)->find();
            $data = [
                "gjj_account"=>$area,
                "create_at"=>date("Y-m-d H:i:s")
            ];
            if (!empty($user_gjj_result)){

                $user_gjj->update($data, ['id'=>$user_gjj_result->id]);
            }else{
                $data['uid'] = $user_result->id;
                $user_gjj->save($data);
            }
        }
        else if ($type=="sjk"){
            $user_sjk = new Sjk();
            $user_sjk_result = $user_sjk->where("uid", $user_result->id)->find();
            $data = [
                "xsz_account"=>$area,
                "create_at"=>date("Y-m-d H:i:s")
            ];
            if (!empty($user_sjk_result)){

                $user_sjk->update($data, ['id'=>$user_sjk_result->id]);
            }else{
                $data['uid'] = $user_result->id;
                $user_sjk->save($data);
            }
        }
//        else if ($type=="jsz"){
//            $user_jsz = new ();
//            $user_jsz_result = $user_jsz->where("uid", $user_result->id)->find();
//            $data = [
//                "jsz_account"=>$area,
//                "create_at"=>date("Y-m-d H:i:s")
//            ];
//            if (!empty($user_jsz_result)){
//
//                $user_jsz->update($data, ['id'=>$user_jsz_result->id]);
//            }else{
//                $data['uid'] = $user_result->id;
//                $user_jsz->save($data);
//            }
//        }
        else if ($type=="wechat"){
            $user_wechat = new Wechat();
            $user_wechat_result = $user_wechat->where("uid", $user_result->id)->find();
            $data = [
                "account"=>$account,
                "create_at"=>date("Y-m-d H:i:s")
            ];
            if (!empty($user_wechat_result)){

                $user_wechat->update($data, ['id'=>$user_wechat_result->id]);
            }else{
                $data['uid'] = $user_result->id;
                $user_wechat->save($data);
            }
        }
        else if ($type=="alipy"){
            $user_alipy = new Alipay();
            $user_alipy_result = $user_alipy->where("uid", $user_result->id)->find();
            $data = [
                "account"=>$area,
                "create_at"=>date("Y-m-d H:i:s")
            ];
            if (!empty($user_alipy_result)){

                $user_alipy->update($data, ['id'=>$user_alipy_result->id]);
            }else{
                $data['uid'] = $user_result->id;
                $user_alipy->save($data);
            }
        }
        return $this->ajaxRuturn("1000", "完成");
    }

    /*
     *
     * 借贷信息设置
     *
     * */
    public function set_loan_info()
    {
        $validate = $this->validate(input("get."), [
            'loan_id' => 'require',
//            'huankuan' => 'require',
//            'shangjin' => 'require',
//            'alllixi' => 'require',
//            'is_xi' => 'require',
        ], [
            'loan_id.require' => '参数错误,请重试',
        ]);
        if ($validate !== true) return $this->ajaxRuturn(4001, $validate);


        $user_Loan = new UserLoanModel();
        $user_Loan_result = $user_Loan
            ->where('uid', $this->user_result->id)
            ->where("id", input("get.loan_id"))
            ->find();
        $shang = input("get.shangjin");
        if(empty($shang) || $shang=="null"){
            $shang = 0;
        }
        if (!empty($user_Loan_result)){
            switch ($user_Loan_result->status){
                case -1:
                    $data = [
                        'status' => 0,
                        'shangjin' =>$shang
                    ];
                    $user_Loan->update($data, ["id"=>$user_Loan_result->id]);
                    return $this->ajaxRuturn(-2000, "招标成功");
                    break;
                case 0:
                    return $this->ajaxRuturn(-2000, "正在招标");
                    break;
                case 1:
                    return $this->ajaxRuturn(-2000, "已有招标");
                    break;
                case 2:
                    return $this->ajaxRuturn(-2000, "招标失败,请30-45天后再次申请");
                    break;
            }
        }else{
            return $this->ajaxRuturn(-2000, "错误,请返回重试");
        }
    }
    /*
     *
     * 联系人设置
     *
     * */
    public function set_loan_info_ok(){
        $user_Loan = new UserLoanModel();
        $user_Loan_result = $user_Loan->where('uid', $this->user_result->id)->where("status", "-1")->order('create_at',"desc")->find();
        if (!empty($user_Loan_result)){
            $data = [
                'status'=>"0"
            ];
            $user_Loan->update($data, ['id'=>$user_Loan_result->id]);
            return $this->ajaxRuturn(1000, "");
        }else{
            return $this->ajaxRuturn(1001, "暂无招标");
        }
    }
    /*
     *
     * 联系人设置
     *
     * */
    public function set_user_lianxiren(){
        $validate = $this->validate(input("get."), [
            'guanxi1' => 'require',
            'name1' => 'require',
            'phone1' => 'require',
            'guanxi2' => 'require',
            'name2' => 'require',
            'phone2' => 'require',
        ], [
            'guanxi1.require' => '请输入联系人1的关系',
            'name1.require' => '请输入联系人1的姓名',
            'phone1.require' => '请输入联系人1的手机号',
            'guanxi2.require' => '请输入联系人2的关系',
            'name2.require' => '请输入联系人2的姓名',
            'phone2.require' => '请输入联系人2的手机号',
        ]);

        if ($validate !== true) return $this->ajaxRuturn(4001, $validate);

        if(!preg_match("/^1[345678]{1}\d{9}$/",input("get.phone1"))){
            return $this->ajaxRuturn(4001, "联系人1手机号错误");
        }

        if(!preg_match("/^1[345678]{1}\d{9}$/",input("get.phone2"))){
            return $this->ajaxRuturn(4001, "联系人2手机号错误");
        }

        $guanxi1 = input("get.guanxi1");
        $name1 = input("get.name1");
        $phone1 = input("get.phone1");
        $guanxi2 = input("get.guanxi2");
        $name2 = input("get.name2");
        $phone2 = input("get.phone2");

        $user_lianxiren = new Lianxiren();
        $user_lianxiren_result = $user_lianxiren->where("uid", $this->user_result->id)->find();

        $data = [
            'guanxi1'=>$guanxi1,
            'name1'=>$name1,
            'phone1'=>$phone1,
            'guanxi2'=>$guanxi2,
            'name2'=>$name2,
            'phone2'=>$phone2,
            'create_at'=>date("Y-m-d H:i:s")
        ];
        if (!empty($user_lianxiren_result))
        {
            $user_lianxiren->update($data, ['uid'=>$user_lianxiren_result->uid]);
            return $this->ajaxRuturn("1000", "认证完成");
        }
        else
        {
            $data['uid'] = $this->user_result->id;
            $user_lianxiren->save($data);
            return $this->ajaxRuturn("1000", "认证完成");
        }
    }

    /*
     *
     * 设置银行卡
     *
     * */
    function set_yinhangka(){
        $type = input("get.type");
        $user_base_info = new Info();
        if ($type==0) {
            $yinghangka = input("get.yinghangka");
            $yinghangname = input("get.yinghangname");
            $yinhangkatype = input("get.yinhangkatype");
            $yinghang_phone = input("get.yinghang_phone");
                $user_base_info_result = $user_base_info->where('uid', $this->user_result->id)->find();
                if (!empty($user_base_info_result)) {
                    $data = [
                        'yinghangka' => $yinghangka,
                        'yinghangname' => $yinghangname,
                        'yinhangkatype' => $yinhangkatype,
                        'yinghang_phone' => $yinghang_phone,
                    ];
//                        var_dump($data);
                    $dasda = $user_base_info->update($data, ['id' => $user_base_info_result -> id]);
                } else {
                    $data = [
                        'uid'=>$this->user_result->id,
                        'yinghangka' => $yinghangka,
                        'yinghangname' => $yinghangname,
                        'yinhangkatype' => $yinhangkatype,
                        'yinghang_phone' => $yinghang_phone,
                    ];
                    $user_base_info->save($data);
                }

                $user_base_info_result = $user_base_info->where('uid', $this->user_result->id)->find();
                return $this->ajaxRuturn("1000", "获取成功", array($user_base_info_result));
        }else{
            $user_base_info_result = $user_base_info->where('uid', $this->user_result->id)->find();
            if (!empty($user_base_info_result)){
                return $this->ajaxRuturn("1000", "获取成功", array($user_base_info_result));
            }else{
                return $this->ajaxRuturn("4000", "银行卡不存在");
            }
        }
    }
    /*
     *
     * 设置借贷额度
     *
     * */
    public function set_loan(){

            $loan_value = 0;
            $user = new UserModel();
            $user_base = new Info();
            $lianxiren = new Lianxiren();
            $wechat = new Wechat();
            $alipy = new Alipay();
            $xinyongka = new Xinyongka();
            $gjj = new Gjj();
            $sb = new Sb();
            $user_base_result = $user_base->where('uid', $this->user_result->id)->find();
            if (!empty($user_base_result)){
                $loan_value = 3000+ (mt_rand(0,10)*100);
            }else{
                $loan_value = 0;
            }

            $lianxiren_result = $lianxiren->where('uid', $this->user_result->id)->find();
            if (!empty($lianxiren_result)){
                $loan_value = $loan_value;
            }else{
                $loan_value = $loan_value;
            }

            $wechat_result = $wechat->where('uid', $this->user_result->id)->find();
            if (!empty($wechat_result)){
                $loan_value = 6500 + (mt_rand(0,10)*100);
            }else{
                $loan_value = $loan_value;
            }

            $alipy_result = $alipy->where('uid', $this->user_result->id)->find();
            if (!empty($alipy_result)){
                $loan_value = 6500 + (mt_rand(0,10)*100);
            }else{
                $loan_value = $loan_value;
            }

            $xinyongka_result = $xinyongka->where('uid', $this->user_result->id)->find();
            if (!empty($xinyongka_result)){
                $loan_value = 11500 + (mt_rand(0,60)*100);
            }else{
                $loan_value = $loan_value;
            }
            $gjj_result = $gjj->where('uid', $this->user_result->id)->find();
            if (!empty($gjj_result)){
                $loan_value = 22000 + (mt_rand(0,50)*100);
            }else{
                $loan_value = $loan_value;
            }
            $sb_result = $sb->where('uid', $this->user_result->id)->find();
            if (!empty($sb_result)){
                $loan_value = 22000 + (mt_rand(0,50)*100);
            }else{
                $loan_value = $loan_value;
            }

            $user_money = new UserMoney();

            $user_money_result = $user_money->where('uid', $this->user_result->id)->find();
            if (!empty($user_money_result)){
                $data_detail = [
                    'all_loan'=>$loan_value,
                    'create_at'=>date("Y:m:d H:m:s", time())
                ];
                $user_money_result->update($data_detail, ['uid'=>$this->user_result->id]);
            }else{
                $data_detail = [
                    'uid'=>$this->user_result->id,
                    'baozheng_money'=>'0',
                    'after_money'=>'0',
                    'cashout_money'=>'0',
                    'all_loan'=>'0',
                    'already_loan'=>'0',
                    'create_at'=>date("Y:m:d H:m:s", time())
                ];
                $user_money_result->save($data_detail);
            }
            return $this->ajaxRuturn(1000, "ok");
        }


    /*
     *
     * 设置借贷额度、提现金额、提现到哪儿、提现说明（）
     *
     * */
    public function set_cashout_info(){

        $free = 0;

        $cashout = new Cashout();
        $validate = $this->validate(input("get."), [
            'caseout' => 'require',
            'cashout_account_type' => 'require',
            'cashout_type' => 'require',
        ], [
            'caseout.require' => '请输入提现金额',
            'cashout_account_type.require' => '请输入去处',
            'cashout_type.require' => '请输入提现类型',
        ]);
        if ($validate !== true) return $this->ajaxRuturn(4001, $validate);

        if (!$this->rangeTime("00:00:00", "24:00:00") && !$this->rangeTime("14:00:00", "17:00:00")){
            return $this->ajaxRuturn(4002, "请于工作日9-12时，14-17时申请提现");
        }

        $loan_id = input('get.loan_id');
        $caseout = input("get.caseout");
        $cashout_account_type = input("get.cashout_account_type");
        $cashout_type = input("get.cashout_type");


        $hehuoren = new HeHuoRen();
        $hehuoren_result = $hehuoren->where(['uid'=>$this->user_result->id])->find();
        if (!empty($hehuoren_result) && $cashout_type==2){
            return $this->ajaxRuturn(4001, "合伙人保证金暂不支持提现");
        }

        switch ($cashout_account_type){
            case 0://支付宝
//                $alipy = new
                $account = '';
                break;
            case 1://微信
                $wechat = new Wechat();
                $wechat_result = $wechat->where(['uid'=>$this->user_result->id])->find();
                if (empty($wechat_result)){
                    return $this->ajaxRuturn(4001, "请完善微信认证");
                }
                $account = $wechat_result->account;
                break;
            case 2://银行卡
                $info = new Info();
                $wechat_result = $info->where(['uid'=>$this->user_result->id])->find();
                if (empty($wechat_result->yinghangka)){
                    return $this->ajaxRuturn(4001, "请绑定银行卡");
                }
                $account = $wechat_result->yinghangka;
                break;
        }

        $user_money = new UserMoney();
        $user_money_result = $user_money->where(['uid'=>$this->user_result->id])->find();
        switch ($cashout_type){
            case 1://余额
                if ($caseout > $user_money_result->cashout_money){
                    return $this->ajaxRuturn(4003, "请输入正确可提现金额");
                }
                $user_money->update(['cashout_money'=>$user_money_result->cashout_money-$caseout],['uid'=>$this->user_result->id]);
                break;
            case 2://保证金
                if ($caseout > $user_money_result->baozheng_money){
                    return $this->ajaxRuturn(4003, "请输入正确可提现金额");
                }
                $free = $caseout * 0.3;
                $user_money->update(['baozheng_money'=>$user_money_result->baozheng_money-$caseout],['uid'=>$this->user_result->id]);
                break;
            case 3://先息后本
                if ($caseout > $user_money_result->after_money){
                    return $this->ajaxRuturn(4003, "请输入正确可提现金额");
                }
                $free = $caseout * 0.3;
                $user_money->update(['after_money'=>$user_money_result->after_money-$caseout],['uid'=>$this->user_result->id]);
                break;
            case 4://赏金
                if (empty($loan_id)){
                    return $this->ajaxRuturn(4003, "参数不正确");
                }
                $loan_table = new UserLoanModel();
                $loan_table_result = $loan_table->where(['uid'=>$this->user_result->id, 'id'=>$loan_id])->find();
                if (empty($loan_table_result)){
                    return $this->ajaxRuturn(4003, "错误");
                }
                if ($loan_table_result->status==1){
                    return $this->ajaxRuturn(4003, "申请中不可提现");
                }else if ($loan_table_result->status==1){
                    return $this->ajaxRuturn(4003, "申请成功赏金不可提现");
                }
                if ($caseout > $user_money_result->shangjin){
                    return $this->ajaxRuturn(4003, "请输入正确可提现金额");
                }
                $free = $caseout * 0.3;

                $loan_table->update(['cashout_money'=>$user_money_result->shangjin-$caseout],['id'=>$loan_id]);

//                if ($caseout > $user_money_result->after_money){
//                    return $this->ajaxRuturn(4003, "请输入正确可提现金额");
//                }
                break;
        }
        if (!empty($hehuoren_result) ){
            $free=0;
        }
        $data = [
            'uid' => $this->user_result->id,
            'caseout' => $caseout,
            'free' => $free,
            'real_value' => $caseout-$free,
            'cashout_account_type'=>$cashout_account_type,
            'cashout_account' =>$account,
            'caseout_status' => '1',
            'create_time' => date('Y-m-d H:i:s', time()),
            'cashout_type' => $cashout_type
        ];
        $cashout->save($data);
        return $this->ajaxRuturn(4003, "申请提现成功");
    }

    public function rangeTime($startTime, $endTime){
        $date = date("Y-m-d",time());
        //开始时间
        $start = strtotime($date.$startTime);
        $end = strtotime($date.$endTime);
        //当前时间
        $now = time();
        if($now >=$start && $now<=$end){
            return true;
        }else{
            return false;
        }
    }

    public function set_rl_infp(){
        $userrl = new Rl();
        $userrl_result = $userrl->where("uid", $this->user_result->id)->find();
        if (!empty($userrl_result)){
            $date = ['create_at'=>date("Y-m-d H:i:s")];
            $userrl->update($date, ['id'=>$userrl_result->id]);
        }else{
            $date = [
                'uid'=>$this->user_result->id,
                'create_at'=>date("Y-m-d H:i:s")
            ];
            $userrl->save($date);
        }
        return $this->ajaxRuturn(1000, "ok");
    }

    public function set_pay(){
        $price = input('get.price');
        $istype = input('get.istype');
        $orderuid = "username";
        $goodsname = "请叫我商品名称，不要超过33个中英文字";
        $orderid = "1234567890";    //每次有任何参数变化，订单号就变一个吧。
        $uid = "11196";//"此处填写平台的uid";
        $token = "fa70150088cb3722d4e7a7cdd92053d6";//"此处填写平台的Token";
        $return_url = 'http://www.demo.com/payreturn.php';
        $notify_url = 'http://www.demo.com/paynotify.php';
        $key = md5($goodsname. $istype . $notify_url . $orderid . $orderuid . $price . $return_url . $token . $uid);
        $returndata['goodsname'] = $goodsname;
        $returndata['istype'] = $istype;
        $returndata['key'] = $key;
        $returndata['notify_url'] = $notify_url;
        $returndata['orderid'] = $orderid;
        $returndata['orderuid'] =$orderuid;
        $returndata['price'] = $price;
        $returndata['return_url'] = $return_url;
        $returndata['uid'] = $uid;
        return $this->ajaxRuturn(1000, "ok", $returndata);
    }
    //总利息、用途、期限、还款方式、总金额
    public function setloanlixi(){
        $local_lixi = "";
        $yongtu = input('get.yongtu');
        $qixian = input('get.qixian');
        $huankuan = input('get.huankuan');
        $allloan = input('get.allloan');

        $apiconfig = new Apiconfig();
        $qianxian_list = $apiconfig->where(["type"=>"loan_set"])->select();
        $localqixian_list = $qianxian_list[$this->find_by_foreach($qianxian_list, "qixian_a")];
        $locallixi_list = $qianxian_list[$this->find_by_foreach($qianxian_list, "lixi")];
        $localhuankuanfangshi_list = $qianxian_list[$this->find_by_foreach($qianxian_list, "huankuanfangshi")];

        $qixian_array = explode(",", $localqixian_list->rule);
        $lixi_array = explode(",", $locallixi_list->rule);
        $huankuanfangshi_array = explode(",", $localhuankuanfangshi_list->rule);

        $qixian_weizhi = array_search($qixian, $qixian_array);
        $local_lixi = $lixi_array[$qixian_weizhi];
        $huankuanfangshi_weizhi = array_search($huankuan, $huankuanfangshi_array);
        if ($huankuanfangshi_weizhi==1){
            $local_lixi = $local_lixi + 0.05;
        }
        if ($qixian_weizhi < 2){
            $local_lixi = $local_lixi+0.05;
            $all_lixi = ($allloan * $local_lixi* $this->findNum($qixian))/30;
        }else{
            $local_lixi = $local_lixi+0.05;
            $all_lixi = ($allloan * $local_lixi* $this->findNum($qixian));
        }
        $result_data = [
            'lixi'=>$local_lixi,
            'alllixi'=>$all_lixi
        ];
        return $this->ajaxRuturn(200, "", array($result_data));


    }
    function findNum($str=''){
        $str=trim($str);
        if(empty($str)){return '';}
        $result='';
        for($i=0;$i<strlen($str);$i++){
            if(is_numeric($str[$i])){
                $result.=$str[$i];
            }
        }
        return $result;
    }

    function find_by_foreach($array,$find)
    {
        foreach ($array as $key => $v)
        {
            if($v->alias==$find)
            {
                return $key;
            }
        }
    }
    function hehuoren()
    {
        $hehuoren = new HeHuoRen();
        $hehuoren_result = $hehuoren->where(["uid"=>$this->user_result->id])->find();
        $money = new UserMoney();
        $money_result = $money->where(["uid"=>$this->user_result->id])->find();
        if (!empty($money_result)){
            if ($money_result->baozheng_money < 199){
                return $this->ajaxRuturn(-1000, "保证金不足");
            }
        }else{
            return $this->ajaxRuturn(-1000, "保证金不足");
        }
        if (!empty($hehuoren_result)){

        }else{
            $date = [
                'uid' => $this->user_result->id,
                "create_at" => date("Y-m-d H:i:s")
            ];
            $hehuoren->save($date);
        }

        return $this->ajaxRuturn(1000, "恭喜你加入合伙人计划");

    }
}
