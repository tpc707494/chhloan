<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:93:"E:\install\server\xmapp721\htdocs\fask\public/../application/apii\view\paytest\errorview.html";i:1541138016;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>System Error</title>
    <meta name="robots" content="noindex,nofollow" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <style>
        /* Base */
        body {
            color: #333;
            font: 14px Verdana, "Helvetica Neue", helvetica, Arial, 'Microsoft YaHei', sans-serif;
            margin: 0;
            padding: 0 20px 20px;
            word-break: break-word;
        }
        h1{
            margin: 10px 0 0;
            font-size: 28px;
            font-weight: 500;
            line-height: 32px;
        }
        h2{
            color: #4288ce;
            font-weight: 400;
            padding: 6px 0;
            margin: 6px 0 0;
            font-size: 18px;
            border-bottom: 1px solid #eee;
        }
        h3.subheading {
            color: #4288ce;
            margin: 6px 0 0;
            font-weight: 400;
        }
        h3{
            margin: 12px;
            font-size: 16px;
            font-weight: bold;
        }
        abbr{
            cursor: help;
            text-decoration: underline;
            text-decoration-style: dotted;
        }
        a{
            color: #868686;
            cursor: pointer;
        }
        a:hover{
            text-decoration: underline;
        }
        .line-error{
            background: #f8cbcb;
        }

        .echo table {
            width: 100%;
        }

        .echo pre {
            padding: 16px;
            overflow: auto;
            font-size: 85%;
            line-height: 1.45;
            background-color: #f7f7f7;
            border: 0;
            border-radius: 3px;
            font-family: Consolas, "Liberation Mono", Menlo, Courier, monospace;
        }

        .echo pre > pre {
            padding: 0;
            margin: 0;
        }
        /* Layout */
        .col-md-3 {
            width: 25%;
        }
        .col-md-9 {
            width: 75%;
        }
        [class^="col-md-"] {
            float: left;
        }
        .clearfix {
            clear:both;
        }
        @media only screen
        and (min-device-width : 375px)
        and (max-device-width : 667px) {
            .col-md-3,
            .col-md-9 {
                width: 100%;
            }
        }
        /* Exception Info */
        .exception {
            margin-top: 20px;
        }
        .exception .message{
            padding: 12px;
            border: 1px solid #ddd;
            border-bottom: 0 none;
            line-height: 18px;
            font-size:16px;
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
            font-family: Consolas,"Liberation Mono",Courier,Verdana,"微软雅黑";
        }

        .exception .code{
            float: left;
            text-align: center;
            color: #fff;
            margin-right: 12px;
            padding: 16px;
            border-radius: 4px;
            background: #999;
        }
        .exception .source-code{
            padding: 6px;
            border: 1px solid #ddd;

            background: #f9f9f9;
            overflow-x: auto;

        }
        .exception .source-code pre{
            margin: 0;
        }
        .exception .source-code pre ol{
            margin: 0;
            color: #4288ce;
            display: inline-block;
            min-width: 100%;
            box-sizing: border-box;
            font-size:14px;
            font-family: "Century Gothic",Consolas,"Liberation Mono",Courier,Verdana;
            padding-left: 56px;
        }
        .exception .source-code pre li{
            border-left: 1px solid #ddd;
            height: 18px;
            line-height: 18px;
        }
        .exception .source-code pre code{
            color: #333;
            height: 100%;
            display: inline-block;
            border-left: 1px solid #fff;
            font-size:14px;
            font-family: Consolas,"Liberation Mono",Courier,Verdana,"微软雅黑";
        }
        .exception .trace{
            padding: 6px;
            border: 1px solid #ddd;
            border-top: 0 none;
            line-height: 16px;
            font-size:14px;
            font-family: Consolas,"Liberation Mono",Courier,Verdana,"微软雅黑";
        }
        .exception .trace ol{
            margin: 12px;
        }
        .exception .trace ol li{
            padding: 2px 4px;
        }
        .exception div:last-child{
            border-bottom-left-radius: 4px;
            border-bottom-right-radius: 4px;
        }

        /* Exception Variables */
        .exception-var table{
            width: 100%;
            margin: 12px 0;
            box-sizing: border-box;
            table-layout:fixed;
            word-wrap:break-word;
        }
        .exception-var table caption{
            text-align: left;
            font-size: 16px;
            font-weight: bold;
            padding: 6px 0;
        }
        .exception-var table caption small{
            font-weight: 300;
            display: inline-block;
            margin-left: 10px;
            color: #ccc;
        }
        .exception-var table tbody{
            font-size: 13px;
            font-family: Consolas,"Liberation Mono",Courier,"微软雅黑";
        }
        .exception-var table td{
            padding: 0 6px;
            vertical-align: top;
            word-break: break-all;
        }
        .exception-var table td:first-child{
            width: 28%;
            font-weight: bold;
            white-space: nowrap;
        }
        .exception-var table td pre{
            margin: 0;
        }

        /* Copyright Info */
        .copyright{
            margin-top: 24px;
            padding: 12px 0;
            border-top: 1px solid #eee;
        }

        /* SPAN elements with the classes below are added by prettyprint. */
        pre.prettyprint .pln { color: #000 }  /* plain text */
        pre.prettyprint .str { color: #080 }  /* string content */
        pre.prettyprint .kwd { color: #008 }  /* a keyword */
        pre.prettyprint .com { color: #800 }  /* a comment */
        pre.prettyprint .typ { color: #606 }  /* a type name */
        pre.prettyprint .lit { color: #066 }  /* a literal value */
        /* punctuation, lisp open bracket, lisp close bracket */
        pre.prettyprint .pun, pre.prettyprint .opn, pre.prettyprint .clo { color: #660 }
        pre.prettyprint .tag { color: #008 }  /* a markup tag name */
        pre.prettyprint .atn { color: #606 }  /* a markup attribute name */
        pre.prettyprint .atv { color: #080 }  /* a markup attribute value */
        pre.prettyprint .dec, pre.prettyprint .var { color: #606 }  /* a declaration; a variable name */
        pre.prettyprint .fun { color: red }  /* a function name */
    </style>
</head>
<body>
<div class="echo">
</div>
<div class="exception">
    <div class="message">

        <div class="info">
            <div>
                <h2>[8]&nbsp;<abbr title="think\exception\ErrorException">ErrorException</abbr> in <a class="toggle" title="E:\install\server\xmapp721\htdocs\fask\application\apii\controller\Knowpay.php line 195">Knowpay.php line 195</a></h2>
            </div>
            <div><h1>Trying to get property 'id' of non-object</h1></div>
        </div>

    </div>
    <div class="source-code">
            <pre class="prettyprint lang-php"><ol start="186"><li class="line-186"><code>                }
</code></li><li class="line-187"><code>                break;
</code></li><li class="line-188"><code>            case 3:
</code></li><li class="line-189"><code>                if ($price &gt; $user_money_result-&gt;cashout_money){
</code></li><li class="line-190"><code>                    return $this-&gt;ajaxRuturn(-100, &quot;账户余额不足&quot;);
</code></li><li class="line-191"><code>                }
</code></li><li class="line-192"><code>                foreach($json_d as $key=&gt;$value){
</code></li><li class="line-193"><code>                    $user_money = new UserMoney();
</code></li><li class="line-194"><code>                    $goods = new Goods();
</code></li><li class="line-195"><code>                    $goods_result = $goods-&gt;where(['id'=&gt;$value-&gt;title-&gt;id])-&gt;find();
</code></li><li class="line-196"><code>                    switch ($goods_result-&gt;alias){
</code></li><li class="line-197"><code>                        case &quot;招标保证金&quot;:
</code></li><li class="line-198"><code>                            $data = [
</code></li><li class="line-199"><code>                                'baozheng_money' =&gt; $user_money_result-&gt;baozheng_money + $value-&gt;account[0],
</code></li><li class="line-200"><code>                                'cashout_money' =&gt; $user_money_result-&gt;cashout_money - $value-&gt;account[0]
</code></li><li class="line-201"><code>                            ];
</code></li><li class="line-202"><code>                            $user_money-&gt;update($data, ['uid'=&gt;$this-&gt;user_result-&gt;id]);
</code></li><li class="line-203"><code>                            break;
</code></li><li class="line-204"><code>                        case &quot;先息后本&quot;:
</code></li></ol></pre>
    </div>
    <div class="trace">
        <h2>Call Stack</h2>
        <ol>
            <li>in <a class="toggle" title="E:\install\server\xmapp721\htdocs\fask\application\apii\controller\Knowpay.php line 195">Knowpay.php line 195</a></li>
            <li>
                at <abbr title="think\Error">Error</abbr>::appError(8, '<a class="toggle" title="Trying to get property 'id' of non-object">Trying to get proper...</a>', '<a class="toggle" title="E:\install\server\xmapp721\htdocs\fask\application\apii\controller\Knowpay.php">E:\install\server\xm...</a>', 195, ['istype' => '3', 'pay_loan_id' => '45', 'user_loan' => <em>object</em>(<abbr title="app\admin\model\UserLoanModel">UserLoanModel</abbr>), ...]) in <a class="toggle" title="E:\install\server\xmapp721\htdocs\fask\application\apii\controller\Knowpay.php line 195">Knowpay.php line 195</a>                </li>
            <li>
                at <abbr title="app\apii\controller\Knowpay">Knowpay</abbr>->pay()                </li>
            <li>
                at <abbr title="ReflectionMethod">ReflectionMethod</abbr>->invokeArgs(<em>object</em>(<abbr title="app\apii\controller\Knowpay">Knowpay</abbr>), []) in <a class="toggle" title="E:\install\server\xmapp721\htdocs\fask\thinkphp\library\think\App.php line 343">App.php line 343</a>                </li>
            <li>
                at <abbr title="think\App">App</abbr>::invokeMethod([<em>object</em>(<abbr title="app\apii\controller\Knowpay">Knowpay</abbr>), 'pay'], []) in <a class="toggle" title="E:\install\server\xmapp721\htdocs\fask\thinkphp\library\think\App.php line 606">App.php line 606</a>                </li>
            <li>
                at <abbr title="think\App">App</abbr>::module(['apii', 'Knowpay', 'pay'], ['app_host' => '', 'app_debug' => <em>true</em>, 'app_trace' => <em>false</em>, ...], <em>true</em>) in <a class="toggle" title="E:\install\server\xmapp721\htdocs\fask\thinkphp\library\think\App.php line 456">App.php line 456</a>                </li>
            <li>
                at <abbr title="think\App">App</abbr>::exec(['type' => 'module', 'module' => ['apii', 'Knowpay', 'pay']], ['app_host' => '', 'app_debug' => <em>true</em>, 'app_trace' => <em>false</em>, ...]) in <a class="toggle" title="E:\install\server\xmapp721\htdocs\fask\thinkphp\library\think\App.php line 139">App.php line 139</a>                </li>
            <li>
                at <abbr title="think\App">App</abbr>::run() in <a class="toggle" title="E:\install\server\xmapp721\htdocs\fask\thinkphp\start.php line 19">start.php line 19</a>                </li>
            <li>
                at require('<a class="toggle" title="E:\install\server\xmapp721\htdocs\fask\thinkphp\start.php">E:\install\server\xm...</a>') in <a class="toggle" title="E:\install\server\xmapp721\htdocs\fask\public\index.php line 24">index.php line 24</a>                </li>
        </ol>
    </div>
</div>


<div class="exception-var">
    <h2>Environment Variables</h2>
    <div>
        <div class="clearfix">
            <div class="col-md-3"><strong>GET Data</strong></div>
            <div class="col-md-9"><small>empty</small></div>
        </div>
    </div>
    <div>
        <h3 class="subheading">POST Data</h3>
        <div>
            <div class="clearfix">
                <div class="col-md-3"><strong>istype</strong></div>
                <div class="col-md-9"><small>
                    3                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>phone</strong></div>
                <div class="col-md-9"><small>
                    18398608857                    </small></div>
            </div>
        </div>
    </div>
    <div>
        <div class="clearfix">
            <div class="col-md-3"><strong>Files</strong></div>
            <div class="col-md-9"><small>empty</small></div>
        </div>
    </div>
    <div>
        <h3 class="subheading">Cookies</h3>
        <div>
            <div class="clearfix">
                <div class="col-md-3"><strong>__guid</strong></div>
                <div class="col-md-9"><small>
                    111872281.1111390201129146600.1540370156582.2195                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>_ga</strong></div>
                <div class="col-md-9"><small>
                    GA1.1.1315841170.1540630862                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>__51cke__</strong></div>
                <div class="col-md-9"><small>
                </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>__tins__18759442</strong></div>
                <div class="col-md-9"><small>
                    {&quot;sid&quot;: 1541133071536, &quot;vd&quot;: 2, &quot;expires&quot;: 1541134878363}                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>__51laig__</strong></div>
                <div class="col-md-9"><small>
                    2                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>pay_loan_id</strong></div>
                <div class="col-md-9"><small>
                    45                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>pay_parm</strong></div>
                <div class="col-md-9"><small>
                    [{&quot;id&quot;:1,&quot;account&quot;:[&quot;59&quot;],&quot;title&quot;:&quot;\u4fdd\u8bc1\u91d159\u6807&quot;},{&quot;id&quot;:100,&quot;account&quot;:[&quot;50&quot;],&quot;title&quot;:&quot;\u5148\u606f\u540e\u672c50\u4fdd\u8bc1\u91d1(3000\u4ee5\u4e0b)&quot;},{&quot;id&quot;:200,&quot;account&quot;:[&quot;1&quot;],&quot;title&quot;:&quot;\u60ac\u8d4f&quot;}]                    </small></div>
            </div>
        </div>
    </div>
    <div>
        <div class="clearfix">
            <div class="col-md-3"><strong>Session</strong></div>
            <div class="col-md-9"><small>empty</small></div>
        </div>
    </div>
    <div>
        <h3 class="subheading">Server/Request Data</h3>
        <div>
            <div class="clearfix">
                <div class="col-md-3"><strong>REDIRECT_PATH_INFO</strong></div>
                <div class="col-md-9"><small>
                    apii/Knowpay/pay.html                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>REDIRECT_MIBDIRS</strong></div>
                <div class="col-md-9"><small>
                    E:/install/server/xmapp721/php/extras/mibs                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>REDIRECT_MYSQL_HOME</strong></div>
                <div class="col-md-9"><small>
                    \xampp\mysql\bin                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>REDIRECT_OPENSSL_CONF</strong></div>
                <div class="col-md-9"><small>
                    E:/install/server/xmapp721/apache/bin/openssl.cnf                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>REDIRECT_PHP_PEAR_SYSCONF_DIR</strong></div>
                <div class="col-md-9"><small>
                    \xampp\php                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>REDIRECT_PHPRC</strong></div>
                <div class="col-md-9"><small>
                    \xampp\php                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>REDIRECT_TMP</strong></div>
                <div class="col-md-9"><small>
                    \xampp\tmp                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>REDIRECT_STATUS</strong></div>
                <div class="col-md-9"><small>
                    200                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>MIBDIRS</strong></div>
                <div class="col-md-9"><small>
                    E:/install/server/xmapp721/php/extras/mibs                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>MYSQL_HOME</strong></div>
                <div class="col-md-9"><small>
                    \xampp\mysql\bin                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>OPENSSL_CONF</strong></div>
                <div class="col-md-9"><small>
                    E:/install/server/xmapp721/apache/bin/openssl.cnf                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>PHP_PEAR_SYSCONF_DIR</strong></div>
                <div class="col-md-9"><small>
                    \xampp\php                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>PHPRC</strong></div>
                <div class="col-md-9"><small>
                    \xampp\php                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>TMP</strong></div>
                <div class="col-md-9"><small>
                    \xampp\tmp                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>HTTP_HOST</strong></div>
                <div class="col-md-9"><small>
                    localhost                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>HTTP_CONNECTION</strong></div>
                <div class="col-md-9"><small>
                    keep-alive                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>CONTENT_LENGTH</strong></div>
                <div class="col-md-9"><small>
                    26                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>HTTP_ACCEPT</strong></div>
                <div class="col-md-9"><small>
                    application/json                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>HTTP_ORIGIN</strong></div>
                <div class="col-md-9"><small>
                    http://localhost                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>HTTP_X_REQUESTED_WITH</strong></div>
                <div class="col-md-9"><small>
                    XMLHttpRequest                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>HTTP_USER_AGENT</strong></div>
                <div class="col-md-9"><small>
                    Mozilla/5.0 (Linux; Android 5.0; SM-G900P Build/LRX21T) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.26 Mobile Safari/537.36                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>CONTENT_TYPE</strong></div>
                <div class="col-md-9"><small>
                    application/x-www-form-urlencoded                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>HTTP_REFERER</strong></div>
                <div class="col-md-9"><small>
                    http://localhost/apii/Knowpay/cashin?phone=18398608857&amp;token=fb10a07adf42d104068e11e14e6faaa187ea4d1f&amp;qixian=15%E5%A4%A9&amp;huankuan=%E5%85%88%E6%81%AF%E5%90%8E%E6%9C%AC&amp;allloan=100&amp;shangjin=1&amp;data=1,100,200&amp;loan_id=45                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>HTTP_ACCEPT_ENCODING</strong></div>
                <div class="col-md-9"><small>
                    gzip, deflate, br                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>HTTP_ACCEPT_LANGUAGE</strong></div>
                <div class="col-md-9"><small>
                    zh-CN,zh;q=0.9                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>HTTP_COOKIE</strong></div>
                <div class="col-md-9"><small>
                    __guid=111872281.1111390201129146600.1540370156582.2195; _ga=GA1.1.1315841170.1540630862; __51cke__=; __tins__18759442=%7B%22sid%22%3A%201541133071536%2C%20%22vd%22%3A%202%2C%20%22expires%22%3A%201541134878363%7D; __51laig__=2; pay_loan_id=45; pay_parm=%5B%7B%22id%22%3A1%2C%22account%22%3A%5B%2259%22%5D%2C%22title%22%3A%22%5Cu4fdd%5Cu8bc1%5Cu91d159%5Cu6807%22%7D%2C%7B%22id%22%3A100%2C%22account%22%3A%5B%2250%22%5D%2C%22title%22%3A%22%5Cu5148%5Cu606f%5Cu540e%5Cu672c50%5Cu4fdd%5Cu8bc1%5Cu91d1%283000%5Cu4ee5%5Cu4e0b%29%22%7D%2C%7B%22id%22%3A200%2C%22account%22%3A%5B%221%22%5D%2C%22title%22%3A%22%5Cu60ac%5Cu8d4f%22%7D%5D                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>PATH</strong></div>
                <div class="col-md-9"><small>
                    C:\Windows\system32;C:\Windows;C:\Windows\System32\Wbem;C:\Windows\System32\WindowsPowerShell\v1.0\;C:\Windows\System32\OpenSSH\;E:\install\node\;C:\Program Files\dotnet\;C:\Program Files\Microsoft SQL Server\130\Tools\Binn\;C:\Users\Administrator\AppData\Local\Microsoft\WindowsApps;C:\Users\Administrator\AppData\Roaming\npm;E:\install\Microsoft VS Code\bin                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>SystemRoot</strong></div>
                <div class="col-md-9"><small>
                    C:\Windows                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>COMSPEC</strong></div>
                <div class="col-md-9"><small>
                    C:\Windows\system32\cmd.exe                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>PATHEXT</strong></div>
                <div class="col-md-9"><small>
                    .COM;.EXE;.BAT;.CMD;.VBS;.VBE;.JS;.JSE;.WSF;.WSH;.MSC                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>WINDIR</strong></div>
                <div class="col-md-9"><small>
                    C:\Windows                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>SERVER_SIGNATURE</strong></div>
                <div class="col-md-9"><small>
                    &lt;address&gt;Apache/2.4.33 (Win32) OpenSSL/1.1.0h PHP/7.2.6 Server at localhost Port 80&lt;/address&gt;
                </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>SERVER_SOFTWARE</strong></div>
                <div class="col-md-9"><small>
                    Apache/2.4.33 (Win32) OpenSSL/1.1.0h PHP/7.2.6                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>SERVER_NAME</strong></div>
                <div class="col-md-9"><small>
                    localhost                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>SERVER_ADDR</strong></div>
                <div class="col-md-9"><small>
                    ::1                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>SERVER_PORT</strong></div>
                <div class="col-md-9"><small>
                    80                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>REMOTE_ADDR</strong></div>
                <div class="col-md-9"><small>
                    ::1                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>DOCUMENT_ROOT</strong></div>
                <div class="col-md-9"><small>
                    E:/install/server/xmapp721/htdocs/fask/public                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>REQUEST_SCHEME</strong></div>
                <div class="col-md-9"><small>
                    http                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>CONTEXT_PREFIX</strong></div>
                <div class="col-md-9"><small>
                </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>CONTEXT_DOCUMENT_ROOT</strong></div>
                <div class="col-md-9"><small>
                    E:/install/server/xmapp721/htdocs/fask/public                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>SERVER_ADMIN</strong></div>
                <div class="col-md-9"><small>
                    postmaster@localhost                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>SCRIPT_FILENAME</strong></div>
                <div class="col-md-9"><small>
                    E:/install/server/xmapp721/htdocs/fask/public/index.php                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>REMOTE_PORT</strong></div>
                <div class="col-md-9"><small>
                    64403                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>REDIRECT_URL</strong></div>
                <div class="col-md-9"><small>
                    /apii/Knowpay/pay.html                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>GATEWAY_INTERFACE</strong></div>
                <div class="col-md-9"><small>
                    CGI/1.1                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>SERVER_PROTOCOL</strong></div>
                <div class="col-md-9"><small>
                    HTTP/1.1                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>REQUEST_METHOD</strong></div>
                <div class="col-md-9"><small>
                    POST                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>QUERY_STRING</strong></div>
                <div class="col-md-9"><small>
                </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>REQUEST_URI</strong></div>
                <div class="col-md-9"><small>
                    /apii/Knowpay/pay.html                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>SCRIPT_NAME</strong></div>
                <div class="col-md-9"><small>
                    /index.php                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>PHP_SELF</strong></div>
                <div class="col-md-9"><small>
                    /index.php                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>REQUEST_TIME_FLOAT</strong></div>
                <div class="col-md-9"><small>
                    1541138002.991                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>REQUEST_TIME</strong></div>
                <div class="col-md-9"><small>
                    1541138002                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>PATH_INFO</strong></div>
                <div class="col-md-9"><small>
                    apii/Knowpay/pay.html                    </small></div>
            </div>
        </div>
    </div>
    <div>
        <div class="clearfix">
            <div class="col-md-3"><strong>Environment Variables</strong></div>
            <div class="col-md-9"><small>empty</small></div>
        </div>
    </div>
    <div>
        <h3 class="subheading">ThinkPHP Constants</h3>
        <div>
            <div class="clearfix">
                <div class="col-md-3"><strong>APP_PATH</strong></div>
                <div class="col-md-9"><small>
                    E:\install\server\xmapp721\htdocs\fask\public/../application/                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>THINK_VERSION</strong></div>
                <div class="col-md-9"><small>
                    5.0.21                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>THINK_START_TIME</strong></div>
                <div class="col-md-9"><small>
                    1541138002.9967                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>THINK_START_MEM</strong></div>
                <div class="col-md-9"><small>
                    396176                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>EXT</strong></div>
                <div class="col-md-9"><small>
                    .php                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>DS</strong></div>
                <div class="col-md-9"><small>
                    \                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>THINK_PATH</strong></div>
                <div class="col-md-9"><small>
                    E:\install\server\xmapp721\htdocs\fask\thinkphp\                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>LIB_PATH</strong></div>
                <div class="col-md-9"><small>
                    E:\install\server\xmapp721\htdocs\fask\thinkphp\library\                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>CORE_PATH</strong></div>
                <div class="col-md-9"><small>
                    E:\install\server\xmapp721\htdocs\fask\thinkphp\library\think\                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>TRAIT_PATH</strong></div>
                <div class="col-md-9"><small>
                    E:\install\server\xmapp721\htdocs\fask\thinkphp\library\traits\                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>ROOT_PATH</strong></div>
                <div class="col-md-9"><small>
                    E:\install\server\xmapp721\htdocs\fask\                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>EXTEND_PATH</strong></div>
                <div class="col-md-9"><small>
                    E:\install\server\xmapp721\htdocs\fask\extend\                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>VENDOR_PATH</strong></div>
                <div class="col-md-9"><small>
                    E:\install\server\xmapp721\htdocs\fask\vendor\                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>RUNTIME_PATH</strong></div>
                <div class="col-md-9"><small>
                    E:\install\server\xmapp721\htdocs\fask\runtime\                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>LOG_PATH</strong></div>
                <div class="col-md-9"><small>
                    E:\install\server\xmapp721\htdocs\fask\runtime\log\                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>CACHE_PATH</strong></div>
                <div class="col-md-9"><small>
                    E:\install\server\xmapp721\htdocs\fask\runtime\cache\                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>TEMP_PATH</strong></div>
                <div class="col-md-9"><small>
                    E:\install\server\xmapp721\htdocs\fask\runtime\temp\                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>CONF_PATH</strong></div>
                <div class="col-md-9"><small>
                    E:\install\server\xmapp721\htdocs\fask\public/../application/                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>CONF_EXT</strong></div>
                <div class="col-md-9"><small>
                    .php                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>ENV_PREFIX</strong></div>
                <div class="col-md-9"><small>
                    PHP_                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>IS_CLI</strong></div>
                <div class="col-md-9"><small>
                    false                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>IS_WIN</strong></div>
                <div class="col-md-9"><small>
                    true                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>ADDON_PATH</strong></div>
                <div class="col-md-9"><small>
                    E:\install\server\xmapp721\htdocs\fask\addons\                    </small></div>
            </div>
        </div>
    </div>
</div>

<div class="copyright">
    <a title="官方网站" href="http://www.thinkphp.cn">ThinkPHP</a>
    <span>V5.0.21</span>
    <span>{ 十年磨一剑-为API开发设计的高性能框架 }</span>
</div>
<script>
    var LINE = 195;

    function $(selector, node){
        var elements;

        node = node || document;
        if(document.querySelectorAll){
            elements = node.querySelectorAll(selector);
        } else {
            switch(selector.substr(0, 1)){
                case '#':
                    elements = [node.getElementById(selector.substr(1))];
                    break;
                case '.':
                    if(document.getElementsByClassName){
                        elements = node.getElementsByClassName(selector.substr(1));
                    } else {
                        elements = get_elements_by_class(selector.substr(1), node);
                    }
                    break;
                default:
                    elements = node.getElementsByTagName();
            }
        }
        return elements;

        function get_elements_by_class(search_class, node, tag) {
            var elements = [], eles,
                pattern  = new RegExp('(^|\\s)' + search_class + '(\\s|$)');

            node = node || document;
            tag  = tag  || '*';

            eles = node.getElementsByTagName(tag);
            for(var i = 0; i < eles.length; i++) {
                if(pattern.test(eles[i].className)) {
                    elements.push(eles[i])
                }
            }

            return elements;
        }
    }

    $.getScript = function(src, func){
        var script = document.createElement('script');

        script.async  = 'async';
        script.src    = src;
        script.onload = func || function(){};

        $('head')[0].appendChild(script);
    }

    ;(function(){
        var files = $('.toggle');
        var ol    = $('ol', $('.prettyprint')[0]);
        var li    = $('li', ol[0]);

        // 短路径和长路径变换
        for(var i = 0; i < files.length; i++){
            files[i].ondblclick = function(){
                var title = this.title;

                this.title = this.innerHTML;
                this.innerHTML = title;
            }
        }

        // 设置出错行
        var err_line = $('.line-' + LINE, ol[0])[0];
        err_line.className = err_line.className + ' line-error';

        $.getScript('//cdn.bootcss.com/prettify/r298/prettify.min.js', function(){
            prettyPrint();

            // 解决Firefox浏览器一个很诡异的问题
            // 当代码高亮后，ol的行号莫名其妙的错位
            // 但是只要刷新li里面的html重新渲染就没有问题了
            if(window.navigator.userAgent.indexOf('Firefox') >= 0){
                ol[0].innerHTML = ol[0].innerHTML;
            }
        });

    })();
</script>
</body>
</html>
