<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=content-type content="text/html; charset=utf-8" />
        <link href="/Public/website/Admin/ment/css/admin.css" type="text/css" rel="stylesheet" />
        <script src="/Public/public/js/jquery-3.2.1.min.js"></script>
        <script src="/Public/public/js/layer/layer.js"></script>
        <style>
            .dfinput{margin: 25px 0;
                border:solid 2px rgba(39, 183, 243, 0.87);border-radius: 3px;
                width: 200px;padding: 10px;}
            .btn{text-align:center;width: 75px;height: 30px;line-height: 30px;background-color: rgba(39, 183, 243, 0.87);border: none;border-radius: 4px;color: #ffffff }
        </style>
    </head>
    <body>
        <table cellspacing=0 cellpadding=0 width="100%" align=center border=0>
            <tr height=28>
                <td background=/Public/website/Admin/ment/img/title_bg1.jpg>当前位置:欢迎页 </td></tr>
            <tr>
                <td bgcolor=#b1ceef height=1></td></tr>
            <tr height=20>
                <td background=/Public/website/Admin/ment/img/shadow_bg.jpg></td></tr></table>
        <table cellspacing=0 cellpadding=0 width="90%" align=center border=0>
            <tr height=100>
                <td align=middle width=100>
                    <img height=100 src="/Public/website/Admin/ment/img/admin_p.gif" width=90></td>
                <td width=60>&nbsp;</td>
                <td>
                    <table height=100 cellspacing=0 cellpadding=0 width="100%" border=0>
                        <tr><td id="time"></td></tr>
                        <tr>
                            <td style="font-weight: bold; font-size: 16px">
                                <?php echo (session('admin_name')); ?>
                                <span style="color: #ff2217;cursor: pointer" onclick="edit_pass()" href="javascript:void(0);">【修改口令】</span>
                            </td>
                        </tr>
                        <tr><td>欢迎进入网站管理中心！</td></tr>
                    </table>
                </td>
            </tr>
            <tr><td colspan=3 height=10></td></tr>
        </table>
        <table cellspacing=0 cellpadding=0 width="95%" align=center border=0>
            <tr height=20>
                <td></td>
            </tr>
            <tr height=22>
                <td style="padding-left: 20px; font-weight: bold; color: #ffffff" align=middle background=/Public/website/Admin/ment/img/title_bg2.jpg>
                    您的相关信息
                </td>
            </tr>
            <tr bgcolor=#ecf4fc height=12>
                <td></td>
            </tr>
            <tr height=20>
                <td></td>
            </tr>
        </table>
        <table cellspacing=0 cellpadding=2 width="95%" align=center border=0>
            <tr>
                <td align=right>ip地址：</td>
                <td style="color: #880000"><?php echo ($admin["lastip"]); ?></td></tr>
                <td align=right width=100>登陆帐号：</td>
                <td style="color: #880000"><?php echo (session('admin_name')); ?></td></tr>
                <td align=right>注册时间：</td>
                <td style="color: #880000"><?php echo date('Y-m-d H:i:s',$admin['addtime']);?></td></tr>
            <tr>
                <td align=right>登陆次数：</td>
                <td style="color: #880000"><?php echo ($admin['login_num']); ?></td></tr>
            <tr>
                <td align=right>身份过期：</td>
                <td style="color: #880000">30 分钟</td>
			</tr>
            <tr>
                <td align=right>上次登录时间：</td>
                <td style="color: #880000"><?php echo date('Y-m-d H:i:s',$admin['lastlogin']);?></td></tr>
            <tr>
        </table>		
    </body>
</html>
<script>
    function edit_pass(){
        layer.open({
            type: 1,
            title:'修改口令',
            skin: 'border:1px solid #27B7F3', //加上边框
            area: ['260px', '200px'], //宽高
            content:"<div style='text-align: center'><form id='form1'>" +
            "<input type='password' class='dfinput' value='' name='password' placeholder='请输入新的口令'/>" +
            "<input type='button' class='btn' value='提交'/>" +
            "</form></div>"
        });
        $('.btn').on('click',function(){
            $.post('<?php echo U("Admin/Login/edit_Pass");?>',$("#form1").serialize(),function(res){
                if(res.status == 1){
                    layer.msg(res.info, function(){
                        //关闭后的操作
                        location.href = res.url;
                    });
                }else{layer.msg(res.info)}
            },'json')
        });
    }
    //时间设置;
    function currentTime(){
        var dt=new Date(),
                str='';
        str+=dt.getFullYear()+'-';
        str+=dt.getMonth() + 1+'-';
        str+=dt.getDate()+'  ';
        if(dt.getHours()<10){
            str+="0"+dt.getHours()+':';
        }else{
            str+=dt.getHours()+':';
        }
        if(dt.getMinutes()<10){
            str+="0"+dt.getMinutes()+':';
        }else{
            str+=dt.getMinutes()+':';
        }
        if(dt.getSeconds()<10){
            str+="0"+dt.getSeconds()+':';
        }else{
            str+=dt.getSeconds()+'';
        }
        return str;
    }
    setInterval(function(){
        document.getElementById('time').innerHTML = currentTime();
//        $('#time').html(currentTime)
    },1000);

</script>