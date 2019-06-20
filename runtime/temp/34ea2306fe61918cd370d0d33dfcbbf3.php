<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:76:"D:\xampp\htdocs\HRsystem\public/../application/admin\view\structure\add.html";i:1528103593;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>添加组织</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="/HRsystem/public/static/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/HRsystem/public/static/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">

    <link href="/HRsystem/public/static/admin/css/animate.css" rel="stylesheet">
    <link href="/HRsystem/public/static/admin/css/style.css?v=4.1.0" rel="stylesheet">
    <link href="/HRsystem/public/static/admin/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <!--uploadify文件引入CSS-->
   <!-- <link rel="stylesheet" type="text/css" href="/static/plus/uploadify/uploadify.css" />-->
</head>

<body class="gray-bg">
<div class="row">
    <div class="col-sm-12">
        <div class="wrapper wrapper-content animated fadeInUp">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="row m-t-sm">
                        <div class="col-sm-12">
                            <div class="panel blank-panel">
                                <div class="panel-heading">
                                    <div class="panel-options">

                                    </div>
                                </div>

                                <div class="panel-body">
                                    <form class="form-horizontal m-t" id="commentForm" method="post" action="" enctype="multipart/form-data">

                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab-1">

                                                <div class="form-group">
                                                    <label class="col-sm-1 control-label">上级组织</label>
                                                    <div class="col-sm-11">
                                                        <select class="form-control m-b" required="" name="pid">
                                                            <option value="0">顶级组织</option>

                                                            <?php if(is_array($structure) || $structure instanceof \think\Collection || $structure instanceof \think\Paginator): $i = 0; $__LIST__ = $structure;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                                                            <option <?php if($id == $val['id']): ?> selected="selected" <?php endif; ?> value="<?php echo $val['id']; ?>"><?php echo str_repeat(' ∷ ',$val['level']*1);  ?><?php echo $val['typename']; ?></option>
                                                            <?php endforeach; endif; else: echo "" ;endif; ?>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-1 control-label">组织名称</label>
                                                    <div class="col-sm-11">
                                                        <input  name="typename" minlength="1" maxlength="20" type="text" class="form-control " required="" aria-required="true">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <div class="col-sm-3 col-sm-offset-1">
                                                <button class="btn btn-primary" type="submit" >提交</button>
                                                <button style="margin-left: 15px;" class="btn btn-default" type="reset" >重置</button>
                                                <a style="margin-left: 15px;" class="btn btn-info" href="<?php echo url('add'); ?>">刷新</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 全局js -->
<script src="/HRsystem/public/static/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/HRsystem/public/static/admin/js/bootstrap.min.js?v=3.3.6"></script>
<!-- 自定义js -->
<script src="/HRsystem/public/static/admin/js/content.js?v=1.0.0"></script>

<!-- jQuery Validation plugin javascript-->
<script src="/HRsystem/public/static/admin/js/plugins/validate/jquery.validate.min.js"></script>
<script src="/HRsystem/public/static/admin/js/plugins/validate/messages_zh.min.js"></script>

<script src="/HRsystem/public/static/admin/js/demo/form-validate-demo.js"></script>


<!--百度编辑器-->
<!-- 配置文件 -->
<script type="text/javascript" src="/static/plus/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="/static/plus/ueditor/ueditor.all.js"></script>
<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('container',{initialFrameHeight:400});
    toolbars: [
        ['fullscreen', 'source', 'undo', 'redo'],
        ['bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc']
    ]
</script>
<!--uploadify文件引入js-->
<script type="text/javascript" src="/static/plus/uploadify/jquery.uploadify.min.js"></script>
<!-- layer -->
<script src="/static/plus/layer/layer.js"></script>
<script type="text/javascript">
    if($("select[name=pid]").find("option:selected").val() !=0){
        changeTemplate();
    }
    $("select[name=pid]").change(function(){
        changeTemplate();
    });



</script>


</body>

</html>
