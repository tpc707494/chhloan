<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:93:"E:\install\server\xmapp721\htdocs\fask\public/../application/apii\view\paytest\errorview.html";i:1542165976;}*/ ?>
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
                <h2>[0]&nbsp;<abbr title="InvalidArgumentException">InvalidArgumentException</abbr> in <a class="toggle" title="E:\install\server\xmapp721\htdocs\fask\thinkphp\library\think\Model.php line 624">Model.php line 624</a></h2>
            </div>
            <div><h1>类的属性不存在:app\admin\model\Cashout-&gt;cashin_type</h1></div>
        </div>

    </div>
    <div class="source-code">
            <pre class="prettyprint lang-php"><ol start="615"><li class="line-615"><code>        } elseif ($notFound) {
</code></li><li class="line-616"><code>            $relation = Loader::parseName($name, 1, false);
</code></li><li class="line-617"><code>            if (method_exists($this, $relation)) {
</code></li><li class="line-618"><code>                $modelRelation = $this-&gt;$relation();
</code></li><li class="line-619"><code>                // 不存在该字段 获取关联数据
</code></li><li class="line-620"><code>                $value = $this-&gt;getRelationData($modelRelation);
</code></li><li class="line-621"><code>                // 保存关联对象值
</code></li><li class="line-622"><code>                $this-&gt;relation[$name] = $value;
</code></li><li class="line-623"><code>            } else {
</code></li><li class="line-624"><code>                throw new InvalidArgumentException('property not exists:' . $this-&gt;class . '-&gt;' . $name);
</code></li><li class="line-625"><code>            }
</code></li><li class="line-626"><code>        }
</code></li><li class="line-627"><code>        return $value;
</code></li><li class="line-628"><code>    }
</code></li><li class="line-629"><code>
</code></li><li class="line-630"><code>    /**
</code></li><li class="line-631"><code>     * 获取关联模型数据
</code></li><li class="line-632"><code>     * @access public
</code></li><li class="line-633"><code>     * @param Relation        $modelRelation 模型关联对象
</code></li></ol></pre>
    </div>
    <div class="trace">
        <h2>Call Stack</h2>
        <ol>
            <li>in <a class="toggle" title="E:\install\server\xmapp721\htdocs\fask\thinkphp\library\think\Model.php line 624">Model.php line 624</a></li>
            <li>
                at <abbr title="think\Model">Model</abbr>->getAttr('cashin_type') in <a class="toggle" title="E:\install\server\xmapp721\htdocs\fask\thinkphp\library\think\Model.php line 2214">Model.php line 2214</a>                </li>
            <li>
                at <abbr title="think\Model">Model</abbr>->__get('cashin_type') in <a class="toggle" title="E:\install\server\xmapp721\htdocs\fask\application\apii\controller\Showcash.php line 88">Showcash.php line 88</a>                </li>
            <li>
                at <abbr title="app\apii\controller\Showcash">Showcash</abbr>->cashin()                </li>
            <li>
                at <abbr title="ReflectionMethod">ReflectionMethod</abbr>->invokeArgs(<em>object</em>(<abbr title="app\apii\controller\Showcash">Showcash</abbr>), []) in <a class="toggle" title="E:\install\server\xmapp721\htdocs\fask\thinkphp\library\think\App.php line 343">App.php line 343</a>                </li>
            <li>
                at <abbr title="think\App">App</abbr>::invokeMethod([<em>object</em>(<abbr title="app\apii\controller\Showcash">Showcash</abbr>), 'cashin'], []) in <a class="toggle" title="E:\install\server\xmapp721\htdocs\fask\thinkphp\library\think\App.php line 606">App.php line 606</a>                </li>
            <li>
                at <abbr title="think\App">App</abbr>::module(['apii', 'Showcash', 'cashin'], ['app_host' => '', 'app_debug' => <em>true</em>, 'app_trace' => <em>false</em>, ...], <em>true</em>) in <a class="toggle" title="E:\install\server\xmapp721\htdocs\fask\thinkphp\library\think\App.php line 456">App.php line 456</a>                </li>
            <li>
                at <abbr title="think\App">App</abbr>::exec(['type' => 'module', 'module' => ['apii', 'Showcash', 'cashin']], ['app_host' => '', 'app_debug' => <em>true</em>, 'app_trace' => <em>false</em>, ...]) in <a class="toggle" title="E:\install\server\xmapp721\htdocs\fask\thinkphp\library\think\App.php line 139">App.php line 139</a>                </li>
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
        <h3 class="subheading">GET Data</h3>
        <div>
            <div class="clearfix">
                <div class="col-md-3"><strong>phone</strong></div>
                <div class="col-md-9"><small>
                    18398608857                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>token</strong></div>
                <div class="col-md-9"><small>
                    f4afab2d8ab76ee8ec89f736ba768b6605eb2612                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>type</strong></div>
                <div class="col-md-9"><small>
                    2                    </small></div>
            </div>
        </div>
    </div>
    <div>
        <div class="clearfix">
            <div class="col-md-3"><strong>POST Data</strong></div>
            <div class="col-md-9"><small>empty</small></div>
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
                <div class="col-md-3"><strong>device</strong></div>
                <div class="col-md-9"><small>
                    0                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>renderMode</strong></div>
                <div class="col-md-9"><small>
                    0                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>cashout_loanid</strong></div>
                <div class="col-md-9"><small>
                    -                    </small></div>
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
                    apii/Showcash/cashin.html                    </small></div>
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
                <div class="col-md-3"><strong>HTTP_ACCEPT</strong></div>
                <div class="col-md-9"><small>
                    */*                    </small></div>
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
                <div class="col-md-3"><strong>HTTP_REFERER</strong></div>
                <div class="col-md-9"><small>
                    http://localhost/apii/Showcash/cashin?phone=18398608857&amp;token=f4afab2d8ab76ee8ec89f736ba768b6605eb2612                    </small></div>
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
                    __guid=111872281.1111390201129146600.1540370156582.2195; _ga=GA1.1.1315841170.1540630862; device=0; renderMode=0; cashout_loanid=-                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>PATH</strong></div>
                <div class="col-md-9"><small>
                    C:\Windows\system32;C:\Windows;C:\Windows\System32\Wbem;C:\Windows\System32\WindowsPowerShell\v1.0\;C:\Windows\System32\OpenSSH\;E:\install\node\;C:\Program Files\dotnet\;C:\Program Files\Microsoft SQL Server\130\Tools\Binn\;E:\install\android\java\java1.8\jdk\bin;E:\install\android\java\java1.8\jdk\jre\bin;E:\install\Git\cmd;e:\install\python\python3.7\Scripts;C:\Users\Administrator\AppData\Local\Microsoft\WindowsApps;C:\Users\Administrator\AppData\Roaming\npm;E:\install\Microsoft VS Code\bin                    </small></div>
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
                    60129                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>REDIRECT_URL</strong></div>
                <div class="col-md-9"><small>
                    /apii/Showcash/cashin.html                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>REDIRECT_QUERY_STRING</strong></div>
                <div class="col-md-9"><small>
                    phone=18398608857&amp;token=f4afab2d8ab76ee8ec89f736ba768b6605eb2612&amp;type=2                    </small></div>
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
                    GET                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>QUERY_STRING</strong></div>
                <div class="col-md-9"><small>
                    phone=18398608857&amp;token=f4afab2d8ab76ee8ec89f736ba768b6605eb2612&amp;type=2                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>REQUEST_URI</strong></div>
                <div class="col-md-9"><small>
                    /apii/Showcash/cashin.html?phone=18398608857&amp;token=f4afab2d8ab76ee8ec89f736ba768b6605eb2612&amp;type=2                    </small></div>
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
                    1542165969.957                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>REQUEST_TIME</strong></div>
                <div class="col-md-9"><small>
                    1542165969                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>PATH_INFO</strong></div>
                <div class="col-md-9"><small>
                    apii/Showcash/cashin.html                    </small></div>
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
                    1542165969.9616                    </small></div>
            </div>
            <div class="clearfix">
                <div class="col-md-3"><strong>THINK_START_MEM</strong></div>
                <div class="col-md-9"><small>
                    395112                    </small></div>
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
    var LINE = 624;

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
