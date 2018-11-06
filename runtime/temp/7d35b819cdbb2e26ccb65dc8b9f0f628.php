<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:89:"E:\install\server\xmapp721\htdocs\fask\public/../application/apii\view\paytest\index.html";i:1540569263;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>

    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <meta name="format-detection" content="telephone=no,email=no,date=no,address=no">
    <link rel="stylesheet" href="/assets/weui/dist/style/weui.css"/>
    <link rel="stylesheet" href="/assets/weui/dist/example/example.css"/>

    <link rel="stylesheet" href="http://i.gtimg.cn/vipstyle/frozenui/2.0.0/css/frozen.css">
    <style type="text/css">
        .ui-btn-lg1 {
            background: #ff8f00;
            width: 100%;
            height: 50px;
            position: fixed;
            bottom: 0;
            border-color: #ff8f00;
            overflow: hidden;
            color: white;
        }
        .ui-btn-lg1:after {
            content: "";
            display: block;
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            background-image: radial-gradient(circle, #666 10%, transparent 10.01%);
            background-repeat: no-repeat;
            background-position: 50%;
            transform: scale(10, 10);
            opacity: 0;
            transition: transform .3s, opacity .5s;
        }

        .ui-btn-lg1:active:after {
            transform: scale(0, 0);
            opacity: .3;
            transition: 0s;
        }
    </style>
    <link rel="stylesheet" href="/assets/aui/css/aui.css"/>
    <script type="text/javascript" src="/assets/aui/script/aui-toast.js" ></script>
</head>
<body>
<button class="ui-btn-lg1">确认提现</button>
<?php if($title == '账户提现'): ?>
    <div class="page__category js_categoryInner" style="margin-top: 10px">
        <div class="weui-cells page__category-content" style="margin-top: 0px;">
                <?php foreach($menulist as $key=>$vo): ?>
                <a class="weui-cell weui-cell_access js_item lists_<?php echo $key; ?>" id="showIOSActionSheet" href="javascript:;">
                    <div class="weui-cell__bd">
                        <p><?php echo $vo; ?></p>
                    </div>
                    <div class="weui-cell__ft">请选择</div>
                </a>
                <?php endforeach; ?>

        </div>
    </div>
    <div class="weui-panel">
        <div class="weui-panel__hd">提现金额</div>
        <div class="weui-panel__bd">
            <div class="weui-media-box weui-media-box_text">
                <div style="height: 2rem;width: 100%;border-bottom: #0d0d0d solid 1px;margin-bottom: 1rem;">
                    <div style="float: left;height: 2rem;width: 10%;">
                        <p style="font-size: 2em;text-align: center;line-height: 2rem;display: block;">￥</p>
                    </div>

                    <div style="float: left;height: 100%;width: 90%;display: block;">
                        <input type="number" class="input_value" placeholder="请输入提现金额"
                               id="input_value" style="height: 2rem;font-size: 1.5rem;"
                        />
                    </div>
                </div>
                <div style="height: 2rem;">
                    <span style="float: left;line-height: 2rem;margin-right: 0.5rem">可提现金额</span>
                    <span style="float: left;line-height: 2rem;color: #ffa000;font-size: 1.5rem" class="all_value"><?php echo $usermoney['cashout_money']; ?></span>
                    <span style="float: right;color: #247cdc;line-height: 2rem;" class="all_cashout">全部提现</span>
                </div>
            </div>
        </div>
    </div>

<?php else: ?>
<p>充值</p>
<?php endif; ?>
<div>
    <div class="weui-mask" id="iosMask" style="display: none"></div>
    <div class="weui-actionsheet" id="iosActionsheet">
        <div class="weui-actionsheet__title">
            <p class="weui-actionsheet__title-text"></p>
        </div>
        <div class="weui-actionsheet__menu">
            <!--<div class="weui-actionsheet__cell">示例菜单1</div>-->
        </div>
        <div class="weui-actionsheet__action">
            <div class="weui-actionsheet__cell" id="iosActionsheetCancel">取消</div>
        </div>
    </div>
</div>
</body>
<script src="/assets/weui/dist/example/zepto.min.js"></script>
<script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="https://res.wx.qq.com/open/libs/weuijs/1.0.0/weui.min.js"></script>
<script src="/assets/weui/dist/example/example.js"></script>

<script>

    $(document).ready(function(){
        $(function(){
            var $iosActionsheet = $('#iosActionsheet');
            var $iosMask = $('#iosMask');
            var $das = <?php echo $account; ?>;
            var $das1 = <?php echo $jsonmenulist; ?>;
            console.log($das.length);
            var $weui_cell = $('.weui-cell');
            var index = 0;
            $weui_cell.on("touchend", function () {
                // alert($(this).index());
                index = $(this).index();
                $(".weui-actionsheet__menu").empty();
                index1(index);
            });
            function index1(index) {
                switch (index){
                    case 0:
                        $(".weui-actionsheet__title-text").text("选择提现账户");
                        for ($i=0;$i<$das.length;$i++)
                        {
                            var asd = "<div class=\"weui-actionsheet__cell\" id='popup_list'>"+$das[$i]+"</div>";
                            $(".weui-actionsheet__menu").append(asd)
                        }
                        break;
                    case 1:
                        $(".weui-actionsheet__title-text").text("选择提现类型");
                        for ($i=0;$i<$das1.length;$i++)
                        {
                            var asd = "<div class=\"weui-actionsheet__cell\" id='popup_list'>"+$das1[$i]+"</div>";
                            $(".weui-actionsheet__menu").append(asd)
                        }
                        break;
                    default:
                        return;
                        break;
                }
                $iosActionsheet.addClass('weui-actionsheet_toggle');
                $iosMask.fadeIn(200);
            }

            function hideActionSheet() {
                $iosActionsheet.removeClass('weui-actionsheet_toggle');
                $iosMask.fadeOut(200);
            }
            $(".all_cashout").on("touchend", function () {
                $("#input_value").val($(".all_value").text())
            });
            $("#popup_list").live("touchend", function () {

                $(".lists_"+index).children(".weui-cell__ft").text($(this).text());
                switch (index){
                    case 1:
                        getmoney($(this).text(),$(this).text());
                        break;
                }
                hideActionSheet();
            });
            $iosMask.on('touchend', hideActionSheet);
            $('#iosActionsheetCancel').on('touchend', hideActionSheet);
            var toast = new auiToast();
            $(".ui-btn-lg1").on('touchend',function () {
                // toast.fail({
                //     title:"请选择体现账户或者提现类型",
                //     duration:2000
                // });
                console.log($(".weui-cell").children(".weui-cell__ft").text())
                if ($(".weui-cell").children(".weui-cell__ft").text().indexOf("请选择")!=-1){
                    toast.fail({
                        title:"请选择体现账户或者提现类型",
                        duration:2000
                    });
                }
                if ($(".input_value").text()){

                }
            });
        });

        function getmoney(type,index){
            $.ajax({
                type: "GET",
                url: "getmoney.html",
                data: {
                    type:type,
                    phone:<?php echo $phone; ?>
                },
                // dataType: "json",
                success: function(data){
                    console.log(index);
                    switch (index){
                        case "余额":
                            $(".all_value").text(data.cashout_money);
                            $(".input_value").on("oninput onpropertychange", function () {
                                if($(this).value>30)$(this).value=30
                            });
                            break;
                        case "招标保证金":
                            $(".all_value").text(data.baozheng_money);
                            break;
                        case "先息后本":
                            $(".all_value").text(data.after_money);
                            break;
                    }
                }
            });
        }
        $(".input_value").on("onkeyup", function () {
            obj = $(this);
            obj.value = obj.value.replace(/[^\d.]/g,""); //清除"数字"和"."以外的字符
            obj.value = obj.value.replace(/^\./g,""); //验证第一个字符是数字
            obj.value = obj.value.replace(/\.{2,}/g,"."); //只保留第一个, 清除多余的
            obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$",".");
            obj.value = obj.value.replace(/^(\-)*(\d+)\.(\d\d).*$/,'$1$2.$3'); //只能输入两个小数
        });
    });

</script>
<body>
</body>

</html>