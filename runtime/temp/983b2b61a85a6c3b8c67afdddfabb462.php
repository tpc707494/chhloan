<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:95:"E:\install\server\xmapp721\htdocs\fask\public/../application/apii\view\paytest\cashin_view.html";i:1541472512;}*/ ?>
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

        .hide_block{
            display: none;
        }
    </style>
    <link rel="stylesheet" href="/assets/aui/css/aui.css"/>
    <script type="text/javascript" src="/assets/aui/script/aui-toast.js" ></script>
    <script type="text/javascript" src="/assets/aui/script/aui-dialog.js" ></script>
</head>
<body>


<script type="text/javascript">
    function search(){
        window.Position.startPhone("10086");
    }
</script>

<button class="ui-btn-lg1">确认充值</button>

<div class="page__category js_categoryInner" style="margin-top: 10px">
    <div class="weui-cells page__category-content" style="margin-top: 0px;">
        <?php foreach($menulist as $key=>$vo): ?>
        <a class="weui-cell weui-cell_access js_item lists_<?php echo $key; ?>" id="showIOSActionSheet" href="javascript:;" style="height: 3rem">
            <div class="weui-cell__bd">
                <p><?php echo $vo['title']; ?></p>
            </div>
            <div class="weui-cell__ft"><?php echo $vo['account'][0]; ?></div>
        </a>
        <?php endforeach; ?>
        <div class="weui-cell weui-cell_select-after hide_block" style="height: 3rem;" id="p_value">
            <div class="weui-cell__hd"><label class="weui-label">充值金额</label></div>
            <div class="weui-cell__bd">
                <p style="font-size: 1.5rem;text-align: right;" class="" id="p_text"></p>
            </div>
        </div>
        <div class="weui-cell weui-cell_select-after hide_block" style="height: 3rem;" id="input_value">
            <div class="weui-cell__hd"><label class="weui-label">充值金额</label></div>
            <div class="weui-cell__bd">
                <input class="hide_block weui-input" type="number" pattern="[0-9]*"
                       style="text-align: right;font-size: 1rem"
                       placeholder="请输入充值金额"/>
            </div>
        </div>
        <div class="weui-cell weui-cell_select weui-cell_select-after hide_block" style="height: 3rem;" id="select_value">
            <div class="weui-cell__hd">
                <label class="weui-label">充值金额</label>
            </div>
            <div class="weui-cell__bd">
                <select class="weui-select" name="select2" style="direction: rtl;">
                    <!--<option value="1">59</option>-->
                    <!--<option value="2">99</option>-->
                    <!--<option value="3">199</option>-->
                </select>
            </div>
        </div>
    </div>
</div>
<div class="weui-panel">

    <div class="weui-panel__hd">账户余额</div>
    <div class="weui-panel__bd">
        <div class="weui-media-box weui-media-box_text">
        <div style="height: 2rem;">
            <span style="float: left;line-height: 2rem;margin-right: 0.5rem">账户可以余额</span>
            <span style="float: left;line-height: 2rem;color: #ffa000;font-size: 1.5rem" class="all_value"><?php echo $usermoney['cashout_money']; ?></span>
        </div>
        </div>
    </div>
</div>

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
<form style='display:none;' id='formpay' name='formpay' method='post' action='https://www.xinjie1688.com/pay'>
    <input name='goodsname' id='goodsname' type='text' value='' />
    <input name='istype' id='istype' type='text' value='' />
    <input name='key' id='key' type='text' value=''/>
    <input name='notify_url' id='notify_url' type='text' value=''/>
    <input name='orderid' id='orderid' type='text' value=''/>
    <input name='orderuid' id='orderuid' type='text' value=''/>
    <input name='price' id='price' type='text' value=''/>
    <input name='return_url' id='return_url' type='text' value=''/>
    <input name='uid' id='uid' type='text' value=''/>
    <input type='submit' id='submitdemo1'>
</form>
<script src="/assets/weui/dist/example/zepto.min.js"></script>
<script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="https://res.wx.qq.com/open/libs/weuijs/1.0.0/weui.min.js"></script>
<script src="/assets/weui/dist/example/example.js"></script>
<script>
    $(document).ready(function(){
        var $das = <?php echo $menulist1; ?>;
        var $iosActionsheet = $('#iosActionsheet');
        var $iosMask = $('#iosMask');
        var $weui_cell = $('.weui-cell');
        var index = 0;
        $weui_cell.on("touchend", function () {
            index = $(this).index();
            $(".weui-actionsheet__menu").empty();
            if (index>=2) return;
            index1(index);

        });

        function index1(index) {
            $account = $das[index]["account"];
            for ($i = 0; $i < $account.length; $i++) {
                var asd = "<div class=\"weui-actionsheet__cell\" id='popup_list'>" + $account[$i] + "</div>";
                $(".weui-actionsheet__menu").append(asd)
            }
            switch (index){
                case 0:
                    $(".weui-actionsheet__title-text").text("选择充值账户");
                    break;
            }

            $iosActionsheet.addClass('weui-actionsheet_toggle');
            $iosMask.fadeIn(200);
        };
        $("#popup_list").live("touchend", function () {
            hideActionSheet();
            $(".lists_"+index).children(".weui-cell__ft").text($(this).text());
            if (index==1){
                getmoney($(this).text(),$(this).text());
            }

        });
    //
    //     function getmoney(type){
    //         $.ajax({
    //             type: "GET",
    //             url: "getmoney.html",
    //             data: {
    //                 type:type,
    //                 phone:<?php echo $phone; ?>
    //             },
    //             success: function(data){
    //                 console.log(data);
    //                 $("#input_value").addClass("hide_block");
    //                 $("#select_value").addClass("hide_block");
    //                 $(".weui-input").val("");
    //                 $(".weui-select").empty();
    //                 if ( data[1].length > 1 ){
    //                     $("#select_value").removeClass("hide_block");
    //
    //                     for (i = 0; i < data[1].length;i++){
    //                         var str = data[1][i].goods;
    //                         var sad = str.indexOf("(");
    //                         if (sad!=-1){
    //                             str = str.substring(0, sad);
    //                         }
    //                         var asd = "<option value="+i+" data-value="+data[1][i].money+">"+ str +"</option>";
    //                         $(".weui-select").append(asd);
    //                     }
    //                 }else{
    //                     $("#input_value").removeClass("hide_block");
    //                 }
    //                 $(".all_value").text(data[0].cashout_money);
    //             }
    //         });
    //     }
    //
        function hideActionSheet() {
            $iosActionsheet.removeClass('weui-actionsheet_toggle');
            $iosMask.fadeOut(200);
        }
        $iosMask.on('touchend', hideActionSheet);

        var toast = new auiToast();
        var dialog = new auiDialog({});
        // $(".ui-btn-lg1").on('touchend',function () {
        //     if ($(".weui-cell").children(".weui-cell__ft").text().indexOf("请选择")!=-1){
        //         toast.fail({
        //             title:"请选择体现账户或者提现类型",
        //             duration:2000
        //         });
        //         return;
        //     }
        //     var regPos = /^[0-9]+.?[0-9]*$/;
        //     if ( !$("#select_value").hasClass('hide_block') && $(".weui-select").get(0).selectedIndex<0){
        //         toast.fail({
        //             title:"请输入选择充值金额",
        //             duration:2000
        //         });
        //         return;
        //     }
        //     if (!$("#input_value").hasClass('hide_block') && !regPos.test($(".weui-input").val())){
        //         toast.fail({
        //             title:"请输入正确的充值金额",
        //             duration:2000
        //         });
        //         return;
        //     }
        //     var price = '0';
        //     if (!$("#input_value").hasClass('hide_block')) {
        //         price = $(".weui-input").val();
        //     }else{
        //         price = $("#select_value").find("option:checked").attr("data-value");
        //     }
        //     dialog.alert({
        //         title:"提示",
        //         msg:'为避免风控本次充值会随机上下浮动5个点、请按照浮动后的充值,避免支付失败',
        //         buttons:['取消','确定']
        //     },function(ret){
        //         if(ret.buttonIndex!=2){
        //             return;
        //         }else {
        //             if ($type == 1){
        //                 istype = 0;
        //
        //                 if ($(".lists_0").children(".weui-cell__ft").text() == "微信") {
        //                     istype = 2;
        //                 }else if ( $(".lists_0").children(".weui-cell__ft").text() == "支付宝"){
        //                     istype = 1;
        //                 }else if ( $(".lists_0").children(".weui-cell__ft").text() == "账户余额"){
        //                     istype = 3;
        //                 }
        //
        //                 $.post(
        //                     "pay.html",
        //                     {
        //                         istype :  istype,
        //                         phone:<?php echo $phone; ?>,
        //                         price : price,
        //                         cashin_type:$(".lists_1").children(".weui-cell__ft").text(),
        //                         money_list:money_list
        //                     },
        //                     function(data){
        //                         console.log(data);
        //                         if (data.status > 0){
        //                             $("#goodsname").val(data.data.goodsname);
        //                             $("#istype").val(data.data.istype);
        //                             $('#key').val(data.data.key);
        //                             $('#notify_url').val(data.data.notify_url);
        //                             $('#orderid').val(data.data.orderid);
        //                             $('#orderuid').val(data.data.orderuid);
        //                             $('#price').val(data.data.price);
        //                             $('#return_url').val(data.data.return_url);
        //                             $('#uid').val(data.data.uid);
        //                             // $('#submitdemo1').click();
        //                             // $("#formpay").css("display", "");
        //                             // $(".ui-btn-lg1").hide();
        //                         } else {
        //                             toast.fail({
        //                                 title:data.msg,
        //                                 duration:2000
        //                             });
        //                         }
        //                     }, "json"
        //                 );
        //             }else{
        //
        //                 istype = 0;
        //
        //                 if ($(".lists_0").children(".weui-cell__ft").text() == "微信") {
        //                     istype = 2;
        //                 }else if ( $(".lists_0").children(".weui-cell__ft").text() == "支付宝"){
        //                     istype = 1;
        //                 }else if ( $(".lists_0").children(".weui-cell__ft").text() == "账户余额"){
        //                     istype = 3;
        //                 }
        //
        //                 $.post(
        //                     "pay.html",
        //                     {
        //                         price : price,
        //                         istype :  istype,
        //                         phone:<?php echo $phone; ?>,
        //                         cashin_type:$(".lists_1").children(".weui-cell__ft").text()
        //                     },
        //                     function(data){
        //                         console.log(data);
        //                         if (data.status > 0){
        //                             $("#goodsname").val(data.data.goodsname);
        //                             $("#istype").val(data.data.istype);
        //                             $('#key').val(data.data.key);
        //                             $('#notify_url').val(data.data.notify_url);
        //                             $('#orderid').val(data.data.orderid);
        //                             $('#orderuid').val(data.data.orderuid);
        //                             $('#price').val(data.data.price);
        //                             $('#return_url').val(data.data.return_url);
        //                             $('#uid').val(data.data.uid);
        //                             // $('#submitdemo1').click();
        //                             // $("#formpay").css("display", "");
        //                             // $(".ui-btn-lg1").hide();
        //                         } else {
        //                             toast.fail({
        //                                 title:data.msg,
        //                                 duration:2000
        //                             });
        //                         }
        //                     }, "json"
        //                 );
        //             }
        //
        //         }
        //     })
        //
        // });
    //
    //
    });
</script>
</body>
</html>