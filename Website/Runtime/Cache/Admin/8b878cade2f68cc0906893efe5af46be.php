<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>编辑权限</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <link href="/Public/website/Admin/ment/css/mine.css" type="text/css" rel="stylesheet">
    <script src="/Public/public/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/Public/public/js/jquery.form.js"></script>
    <script type="text/javascript" src="/Public/public/js/jquery.validate.js"></script>
    <script src="/Public/public/js/layer/layer.js"></script>
    <style>
        input{margin-bottom: 6px;}
        lable.error{font-size: 14px;font-weight: bold;color: #FF0000;}
        lable.ok{font-size: 14px;font-weight: bold;color: #38D63B;}
        label{padding: 10px 20px 10px 0}
        li{margin-top: 30px;list-style: none}
        .dfinput{margin-left: 10px;border:solid 2px rgba(39, 183, 243, 0.87);border-radius: 3px;width: 340px;padding: 10px 0 10px 15px}
        .vocation{display: inline-block}
        b{color: red}
    </style>
    <script>
        $(function(){
            //添加三级联动;
            var getRule=function(pid,name){
                $.post('<?php echo U("Admin/AuthRule/getRuleByPid");?>',{pid:pid},function(res){
                    if(res.status){
                        var str='<option value="0" selected>请选择</option>';
                        for(var i in res.info){
                            str+='<option value="'+res.info[i].id +'">' + res.info[i].title+ '</option>';
                        }
                        $('select[name="'+name+'"]').html(str);
                        $('select[name="'+name+'"]').parent().find(".uew-select-text").text($('select[name="'+name+'"]').find(':selected').text());
                    }
                })
            };
            getRule(0,'firstRule');

            $('select[name="firstRule"]').change(function(){
                getRule($(this).find(':selected').val(),'secondRule');
                $(this).parents('.vocation').next('.vocation').show();
                $('select[name="thirdRule"]').empty().parents('.vocation').hide();
            });

            $('select[name="secondRule"]').change(function(){
                getRule($(this).val(),'thirdRule');
                $(this).parents('.vocation').next('.vocation').show();
            });
        });
    </script>
</head>
<body>
<div class="div_head" style="background-color: rgb(129, 191, 249);">
    <span>
        <span style="float:left;font-weight: bolder;color: #ffffff;">编辑权限</span>
        <span style="margin-right: 8px;font-weight: bold">
            <a style="text-decoration: none;color: #ffffff" href="<?php echo U('AuthRule/index');?>">【返回】</a>
        </span>
    </span>
</div>
<div></div>
<div style="font-size: 13px;margin: 10px 5px">
    <form action="<?php echo U('Admin/AuthRule/edit');?>" id="form1" method="post">
        <ul>
            <li><label>权限名称<b>*</b></label>
                <input type="text" name="title" class="dfinput" value="<?php echo ($title); ?>"/>
            </li>
            <li><label>权限规则<b>*</b></label>
                <input name="name"  class="dfinput" value="<?php echo ($name); ?>" />
            </li>
            <li> <label style="padding: 10px 20px 10px 0">上级权限<b>*</b></label>
                <input type="hidden" name="id" value="<?php echo ($id); ?>"/>
                <div class="vocation">
                    <select style="width: 170px" class="select2 dfinput" name="firstRule"></select>
                </div>
                <div class="vocation" style="display:none" >
                    <select style="width: 170px" class="select2 dfinput" name="secondRule" ></select>
                </div>
                <div class="vocation" style="display:none">
                    <select style="width: 170px" class="select2 dfinput" name="thirdRule" ></select>
                </div>
            </li>
            <li>
                <label style="padding: 10px 90px 10px 0"></label>
                <input style="width: 137px;height: 35px;line-height: 35px;background-color: rgb(60,149,200);border: none;border-radius: 4px;color: #ffffff " type="submit" class="btn" value="确定编辑"/>
            </li>
        </ul>
    </form>
</div>
</body>
</html>
<script>
    $(function(){
        var validate=$('#form1').validate({
            rules:{
                title:{
                    required:true
                },
                name:{
                    required:true
                }
            },
            messages:{
                title:{required:' * 权限名称不能为空！'},
                name:{required:' * 权限链接不能为空！'}
            },
            success:function(lable){
                lable.addClass('ok').text(' * 通过验证');
            },
            validClass:'ok',
            errorElement:'lable'
        });

        //向分类表中添加分类
        $("#form1").submit(function(){
            $(this).attr('disabled',true);
            if(validate.form()){
                $.post('<?php echo U("AuthRule/edit");?>',$("#form1").serialize(),function(res){
                    if(res.info=='编辑成功'){
                        layer.msg('编辑成功',{icon:6,time:2000},function(){
                            location='<?php echo U("Admin/AuthRule/index");?>'
                        });
                    }if(res.info=='编辑失败'){
                        layer.msg('编辑失败',{icon:5,time:2000},function(){
                            location=''
                        });
                    }
                },'json');
                return false;
            }
        });
    })
</script>