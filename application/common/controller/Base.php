<?php
namespace app\common\controller;

use think\App;
use  think\Controller;

class  Base extends Controller
{
    protected $userInfo;
    public $app1;
    public function _initialize()
    {

    }

    /**
     * @name 分页函数
     * @version 1.0.0
     * @funName paging
     * @param $pageSize
     * @param $pageNumber
     * @param $data
     * @return  Obj
     */
    function paging($pageSize, $pageNumber, $data)
    {
        $start = ($pageSize - 1) * $pageNumber;
        $list = array_slice($data, $start, $pageNumber);
        return $list;
    }
    public function layAjax($code, $msg, $count, $data)
    {
        // 返回JSON数据格式到客户端 包含状态信息
        header('Content-Type:application/json; charset=utf-8');
        $array['code'] = $code;
        $array['msg'] = $msg;
        $array['count'] = $count;
        $array['data'] = $data;
        exit(json_encode($array));
    }

    /**
     * @name 定义ajax请求返回的数据类型
     * @version 1.0.0
     * @funName ajaxRuturn
     * @param $code 状态码 200成功 400失败
     * @param $msg 返回的提示消息
     * @param $data 需要返回的数据
     * @return  Obj
     */
    public function ajaxRuturn($code, $msg, $data = [])
    {
        header('Content-Type:application/json; charset=utf-8');
        header('Access-Control-Allow-Origin:*');//允许所有来源访问
        header('Access-Control-Allow-Method:POST,GET');//允许访问的方式
        $array['status'] = $code;
        $array['msg'] = $msg;
        $array['data'] = $data;
        exit(json_encode($array));
    }

    static function static_ajaxRuturn($code, $msg, $data = [])
    {
        header('Content-Type:application/json; charset=utf-8');
        $array['status'] = $code;
        $array['msg'] = $msg;
        $array['data'] = $data;
        exit(json_encode($array));
    }
    /**
     * @name 获取 /采集图标、并返回
     * @version 1.0.0
     * @funName get_icons
     * @return  Obj
     */
    function get_icons()
    {
        $icons = $this->read_cache("icons");
        if (empty($icons)) {
            //如果缓存为空、则写入文件
            $url = "http://fontawesome.dashgame.com/";
            $content = file_get_contents($url);
            preg_match_all('/<i\s+class="fa\s+([^"]+)"\s+aria-hidden="true">/is', $content, $icons);
            $icon_content = $icons[1] ? $icons[1] : [];
            $file = $this->write_cache("icons", $icon_content);
            if ($file) {
                return $icon_content;
            } else {
                return false;
            }
        } else {
            return $icons;
        }
    }
    /**
     * 读取缓存
     * @access public
     * @param string $oldFile 原文件名
     * @param string $key 键
     * @return boolean
     */
    function read_cache($oldFile, $get_key = "")
    {
        //检测文件是否存在
        $exists = file_exists(APP_CACHE_DIR . $oldFile . '.php');
        if ($exists && $get_key) {
            $config = include(APP_CACHE_DIR . $oldFile . '.php');
            if (!$config) {
                return false;
            }
            $newConfig = [];
            foreach ($config as $key => $val) {
                $newConfig[$key] = $val;
            }
            if (!$get_key || $get_key == '') {
                return $newConfig;
            }
            foreach ($newConfig as $key => $val) {
                if ($get_key == $key) {
                    return $val;
                }
            }
        } else if ($exists) {
            $config = include(APP_CACHE_DIR . $oldFile . '.php');
            return $config;
        }else{
            return false;
        }
    }

    /**
     * 写入缓存
     * @access public
     * @param string $oldFile 原文件名
     * @param array $params 键值
     * @return boolean
     */
    function write_cache($oldFile, $params)
    {
        //检测文件是否存在
        $exists = file_exists(APP_CACHE_DIR . $oldFile . '.php');
        if ($exists) {
            $config = file_get_contents(APP_CACHE_DIR . $oldFile . '.php');
            $config = include(APP_CACHE_DIR . $oldFile . '.php');
            $newVal = $data = array_merge($config,$params);;
            //如果存在配置文件、则直接写入
            $file = file_put_contents(APP_CACHE_DIR . $oldFile . '.php', "<?php\nreturn \n" . var_export($newVal, true) . "\n;");
            if ($file) {
                return true;
            } else {
                return "文件写入失败！";
            }
        } else {
            //创建新的文件、并写入
            if (($TxtRes = fopen(APP_CACHE_DIR . $oldFile . '.php', "w+")) === FALSE) {
                return "文件创建失败！";
            } else {
                //创建新的文件、并写入
                $file = file_put_contents(APP_CACHE_DIR . $oldFile . '.php', "<?php\nreturn " . var_export($val, true) . "\n;");
                if ($file === false) {
                    return "文件写入失败！";
                } else {
                    return true;
                }
            }
        }
    }

    public function check_login()
    {
        if (session(Config::get("auth.DEFAULT_LOGIN_SESSION"))) {
            return true;
        }
        if ($this->request->controller() == 'index') {
            return true;
        }
        return false;
    }
    //获取文件目录列表,该方法返回数组
    function getDirList($dir)
    {
        $dirArray[] = NULL;
        if (false != ($handle = opendir($dir))) {
            $i = 0;
            while (false !== ($file = readdir($handle))) {
                //去掉"“.”、“..”以及带“.xxx”后缀的文件
                if ($file != "." && $file != ".." && !strpos($file, ".")) {
                    $dirArray[$i] = $file;
                    $i++;
                }
            }
            //关闭句柄
            closedir($handle);
        }
        return $dirArray;
    }
    /**
     * 把返回的数据集转换成Tree
     * @param array $list 要转换的数据集
     * @param string $pid parent标记字段
     * @param string $level level标记字段
     * @return array
     */
    function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = 'children', $root = 0)
    {
        // 创建Tree
        $tree = array();
        if (is_array($list)) {
            // 创建基于主键的数组引用
            $refer = array();
            foreach ($list as $key => $data) {
                $refer[$data[$pk]] =& $list[$key];
            }
            foreach ($list as $key => $data) {
                // 判断是否存在parent
                $parentId = $data[$pid];
                if ($root == $parentId) {
                    $tree[] =& $list[$key];
                } else {
                    if (isset($refer[$parentId])) {
                        $parent =& $refer[$parentId];
                        $parent[$child][] =& $list[$key];
                    }
                }
            }
        }
        return $tree;
    }

    /**
     * 将list_to_tree的树还原成列表
     * @param  array $tree 原来的树
     * @param  string $child 孩子节点的键
     * @param  string $order 排序显示的键，一般是主键 升序排列
     * @param  array $list 过渡用的中间数组，
     * @return array        返回排过序的列表数组
     */
    function tree_to_list($tree, $child = 'children', $order = 'id', &$list = array())
    {
        if (is_array($tree)) {
            foreach ($tree as $key => $value) {
                $reffer = $value;
                if (isset($reffer[$child])) {
                    unset($reffer[$child]);
                    $this->tree_to_list($value[$child], $child, $order, $list);
                }
                $list[] = $reffer;
            }
            $list = list_sort_by($list, $order, $sortby = 'asc');
        }
        return $list;
    }
    /**
     * 对查询结果集进行排序
     * @access public
     * @param array $list 查询结果
     * @param string $field 排序的字段名
     * @param array $sortby 排序类型
     * asc正向排序 desc逆向排序 nat自然排序
     * @return array
     */
    function list_sort_by($list, $field, $sortby = 'asc')
    {
        if (is_array($list)) {
            $refer = $resultSet = array();
            foreach ($list as $i => $data)
                $refer[$i] = &$data[$field];
            switch ($sortby) {
                case 'asc': // 正向排序
                    asort($refer);
                    break;
                case 'desc':// 逆向排序
                    arsort($refer);
                    break;
                case 'nat': // 自然排序
                    natcasesort($refer);
                    break;
            }
            foreach ($refer as $key => $val)
                $resultSet[] = &$list[$key];
            return $resultSet;
        }
        return false;
    }
    /**
     * 获取Token
     * @return array
     */
    public function makeToken()
    {
        $str = md5(uniqid(md5(microtime(true)), true)); //生成一个不会重复的字符串
        $str = sha1($str); //加密
        return $str;
    }
    function wx_log($basename=null,$num=null,$msg=null)
    {
        //$msg = [2018-04-11 09:22:56]文件名：wxpay，第29行，[info]：日志信息
        $msg = '['.date("Y-m-d H:i:s").']'.'文件名：'.$basename.'，第'.$num.'行，'.'[info]：'.$msg;

        // 日志文件名：日期.txt
        $path = ROOT_PATH.DS.'public'. DS .'logs'. DS .date("Ymd").'.txt';
        $path1 = ROOT_PATH.DS.'public'. DS .'logs';
        if (!file_exists($path1)){
            mkdir($path1,0777,true);
        }
        file_put_contents($path, $msg.PHP_EOL,FILE_APPEND);
    }
}
