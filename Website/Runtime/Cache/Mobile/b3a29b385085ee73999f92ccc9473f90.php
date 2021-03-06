<?php if (!defined('THINK_PATH')) exit();?>﻿<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="telephone=no" name="format-detection">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <title>支付订单</title>
    <link href="/Public/website/Mobile/order/css/main.css" rel="stylesheet" type="text/css">
    <link href="/Public/website/Mobile/order/css/media-queries.css" rel="stylesheet" type="text/css">
    <link href="/Public/website/Mobile/order/css/initialize.css" rel="stylesheet" type="text/css">
    <link href="/Public/website/Mobile/order/css/pay.css" rel="stylesheet" type="text/css">
    <script src="/Public/public/js/jquery.min.1.8.2.js"></script>
    <script src="/Public/public/js/layer_mobile/layer.js"></script>
</head>

<body>

<div id="pagewrap">


    <div class="header_box">
        <div class="header">
            <ul>
                <li class="back">
                    <a href="<?php echo ($url); ?>">
                    <img src="/Public/public/images/back.png"></a></li>
                <li class="header_text">支付订单</li>
                <div class="clearfix"></div>
            </ul>
        </div>
    </div>
    <form action="<?php echo U('Mobile/Order/pay_money');?>" method="post" id="form1" onsubmit ="getElementById('btn2').disabled=true;return true;">
        <input type="hidden" name="ordcode" value="<?php echo ($ordcode); ?>"/>
        <input type="hidden" name="price" value="<?php echo ($price); ?>"/>
        <div class="main_box">
            <div class="main">
                <div class="pay_box">
                    <div class="pay">
                        <div class="pay_img">
                            <img src="/Public/website/Mobile/order/images/pay.png">
                        </div>
                        <div class="pay_text">
                            <ul>
                                <li class="pay_money">￥<?php echo ($price); ?></li>
                                <li class="pay_name"><?php echo ($nickname); ?></li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="pay">
                        <div class="pay_list">
                            <div class="list_img">
                                <img src="/Public/website/Mobile/order/images/zfb.png" alt=""/>
                            </div>
                            <div class="list_text">
                                <ul>
                                    <li>
                                        <span class="zfb_text">支付宝支付</span>
                                        <div class="zfb_img"><img src="/Public/website/Mobile/order/images/tj.png"></div>
                                        <div class="clearfix"></div>
                                    </li>
                                    <li class="note">推荐有支付宝账号的用户使用</li>
                                </ul>
                            </div>
                            <div class="list_radio">
                                <input type="radio" checked value="alipay" name="pay_way">
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="pay_list">
                            <div class="list_img">
                                <img src="/Public/website/Mobile/order/images/wx.png" alt=""/>
                            </div>
                            <div class="list_text">
                                <ul>
                                    <li>
                                        <span class="zfb_text">微信支付</span>
                                        <div class="clearfix"></div>
                                    </li>
                                    <li class="note">推荐安装微信5.0及以上版本的用户使用</li>
                                </ul>
                            </div>
                            <div class="list_radio">
                                <input type="radio" value="weixin" name="pay_way">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer id="footer">
            <div class="apply_submit">
                <input  style="line-height: 1%;border: 0;" type="submit" id="btn2" value="立即支付">
            </div>
        </footer>
    </form>
</div>
</body>
</html>