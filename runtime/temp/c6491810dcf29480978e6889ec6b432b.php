<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:55:"D:\xampp\htdocs\HRsystem\thinkphp\tpl\dispatch_jump.tpl";i:1550563075;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>跳转提示</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <script src="/static/plus/js/jquery.min.js?v=2.1.4"></script>
    <!-- layer -->
    <script src="/static/plus/layer/layer.js"></script>
</head>
<body>
    <?php switch ($code) {case 1:?>
            <input type="hidden" id="code" value='6'>
            <input type="hidden" id="msgState" value=" ">
        <?php break;case 0:?>
            <input type="hidden" id="code" value='5'>
            <input type="hidden" id="msgState" value=" ">
        <?php break;} ?>
    <input type="hidden" id="msg" name="msg" value="<?php echo(strip_tags($msg));?>">
    <input type="hidden" id="url" name="url" value="<?php echo($url);?>">
    <input type="hidden" id="wait" name="wait" value="<?php echo($wait);?>">
    <script type="text/javascript">
        (function(){
            var msg=$("#msg").val();
            var msgState=$("#msgState").val();
            var message=msgState+msg;
            var url=$("#url").val();
            var wait=$("#wait").val();
            var code=$("#code").val();
            layer.open({
               /* type:1,*/
                content:message,
                anim:4,
                icon:code,
                closeBtn: 0,
                /*area: ['460px', '230px'], //宽高*/
                title:'网站系统提示：',
                skin: 'layui-layer-molv',
                shadeClose: false, //开启遮罩关闭
                yes:function(index,layero){
                    location.href=url;
                    layer.close(index);
                }
            });
            var interval = setInterval(function(){
                var time = --wait;
                if(time <= 0) {
                    location.href = url;
                    clearInterval(interval);
                };
            }, 3000);
        })();
    </script>
</body>
</html>
