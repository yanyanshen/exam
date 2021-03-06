<?php if (!defined('THINK_PATH')) exit();?>﻿<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="telephone=no" name="format-detection">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <title>预约报名</title>
    <link href="/Public/website/Mobile/user/apply/css/main.css" rel="stylesheet" type="text/css">
    <link href="/Public/website/Mobile/user/apply/css/media-queries.css" rel="stylesheet" type="text/css">
    <link href="/Public/website/Mobile/user/apply/css/initialize.css" rel="stylesheet" type="text/css">
    <link href="/Public/website/Mobile/user/apply/css/apply.css" rel="stylesheet" type="text/css">
    <link href="/Public/website/Mobile/user/apply/css/loginRegister/login.css" rel="stylesheet" type="text/css">
    <link href="/Public/website/Mobile/user/apply/css/loginRegister/media-queries-login.css" rel="stylesheet" type="text/css">
    <script src="/Public/public/js/jquery-3.2.1.min.js"></script>
    <script src="/Public/public/js/jquery.form.js"></script>
    <script src="/Public/public/js/jquery.validate.js"></script>
    <script src="/Public/public/js/layer_mobile/layer.js"></script>
    <style>
        input.error { border: 1px solid #EA5200;background: #ffdbb3;margin-left: 20px}
        span.error{position: absolute;color:#ff0300;display: block;font-weight: bold;font-size: 12px;}
        span.ok {color: #289628;margin-left: 20px}
    </style>

</head>

<body>

<div id="pagewrap">


    <div class="header_box">
        <div class="header">
            <ul>
                <li class="back"><a href="<?php echo U('Mobile/User/user_center');?>"><img src="/Public/public/images/back.png"></a></li>
                <li class="header_text">预约报名</li>
                <div class="clearfix"></div>
            </ul>
        </div>
    </div>
    <div class="main_box">
        <div class="main">
            <form class="apply_form" id="form1">
                <div class="apply">
                    <label class="label" for="ap_name">姓名</label>
                    <input class="user" type="text" name="ap_name" id="ap_name" placeholder="请输入真实姓名" required>
                </div>
                <div class="apply">
                    <label class="label" for="ap_tel">电话</label>
                    <input class="tel" type="text" name="ap_tel" id="ap_tel" placeholder="请输入电话号码" required>
                </div>
                <div class="apply">
                    <label class="apply_sex">性别</label>
                    <ul class="apply_list">
                        <li>
                            <input type="radio" name="ap_button" value="0" id="ap_radio1"  checked>
                            <label for="ap_radio1">男</label>
                        </li>
                        <li style="margin-left: 20px;">
                            <input type="radio" name="ap_button" value="1" id="ap_radio2" required>
                            <label for="ap_radio2">女</label>
                        </li>
                        <div class="clearfix"></div>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="apply">
                    <label class="label" for="ap_position">地址</label>
                    <input class="city_position" type="text" name="ap_position" id="ap_position" placeholder="请输入所在地址" required>
                </div>
                <div class="apply">
                    <label class="ap_note" for="ap_textarea">备注</label>
                    <input class="message" type="text" name="ap_message" id="ap_textarea" placeholder="更多">
                </div>
            </form>
        </div>
    </div>

    <footer id="footer">
        <div class="apply_submit">
            <input type="submit"  name="btn2" id="btn2" value="预约报名">
        </div>
    </footer>



</div>


</body>
</html>

<script>
    $(function(){
        //validate表单验证
        var validate=$('#form1').validate({
            //设置验证规则
            rules:{
                ap_name:{required:true},
                ap_tel:{required:true},
                ap_position:{required:true},
                ap_button:{required:true}
            },


            messages: {
                ap_name: {required: '用户名不能为空'},
                ap_tel: {required: '手机号不能为空'},
                ap_position: {required: '地址不能为空'},
                ap_button: {required: '请选择性别'}
            },
            success: function(span) {
                span.addClass("ok").text('OK');
            },
            validClass:'ok',
            errorElement:'span'
        });
        // 手机号码验证
        jQuery.validator.addMethod("ap_tel", function(value, element) {
            var mobileReg = /^1[34578]{1}[0-9]{9}$/;
            return this.optional(element) || (mobileReg.test(value));
        }, "请正确填写您的手机号码");

        $('#btn2').click(function(){
            //表单提交之前判断前端验证是否通过，只有通过时才提交表单
            if(validate.form()){
                $.post("<?php echo U('Mobile/Order/apply');?>",$('#form1').serialize(),function(res){
                    if(res.status==1){
                        layer.open({
                            content: res.info
                            ,skin: 'msg'
                            ,icon:2
                            ,style: 'background-color:#DAEAD3; font-color:#49EE18; border:none;' //自定风格
                            ,time: 2 //2秒后自动关闭
                            ,end:function(){
                                location.href='';
                            }
                        });
                    }else{
                        layer.open({
                            content: res.info
                            ,skin: 'msg'
                            ,icon:2
                            ,style: 'background-color:white; color:red; border:none;' //自定风格
                            ,time: 2 //2秒后自动关闭
                        });
                    }
                },'json');
                return false;
            }
        })
    })

</script>