<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"D:\xampp\htdocs\HRsystem\public/../application/admin\view\staff\add.html";i:1546964264;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>添加员工</title>

    <link rel="shortcut icon" href="favicon.ico">

    <link href="/HRsystem/public/static/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/HRsystem/public/static/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">

    <link href="/HRsystem/public/static/admin/css/animate.css" rel="stylesheet">
    <link href="/HRsystem/public/static/admin/css/style.css?v=4.1.0" rel="stylesheet">
    <link href="/HRsystem/public/static/admin/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <!-- 全局js -->
    <script src="/HRsystem/public/static/admin/js/jquery.min.js?v=2.1.4"></script>
    <script src="/HRsystem/public/static/admin/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/static/plus/bootstrap-prettyfile/bootstrap-prettyfile.js"></script>
    <!-- 配置文件 -->
    <script type="text/javascript" src="/static/plus/ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="/static/plus/ueditor/ueditor.all.js"></script>
    <!-- 实例化编辑器 -->

</head>
<style>
    .gh{
        display: inline-block;
        background-color: #015eff;
        height: 30px;
        width: 90px;
        line-height: 30px;
        text-align: center;
        color: floralwhite;
        border-radius: 5px;
        cursor: pointer;
    }
</style>

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
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a  href="#tab-1" data-toggle="tab">基本信息</a></li>
                                            <li class=""><a href="#tab-2" data-toggle="tab">培训记录</a></li>
                                            <li class=""><a href="#tab-3" data-toggle="tab">服务评价</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <form class="form-horizontal m-t" id="commentForm" method="post" action="" enctype="multipart/form-data">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab-1">
                                                <div class="form-group">
                                                    <label class="col-sm-1 control-label">员工姓名：</label>
                                                    <div class="col-sm-3">
                                                        <input  name="name" type="text" minlength="2" maxlength="15" class="form-control " required="" aria-required="true">
                                                    </div>
                                                    <label class="col-sm-1 control-label">员工性别：</label>
                                                    <div class="col-sm-3">
                                                        <div class="col-sm-3 radio radio-danger" style="float: left; ">
                                                            <input id="positionl" name="gender"  value="1" type="radio" checked="checked" required="">
                                                            <label>
                                                                先生
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-3 radio radio-success" style="float: left; ">
                                                            <input id="positionr" name="gender" value="2" type="radio" required="" >
                                                            <label>
                                                                女士
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-1 control-label">出生日期：</label>
                                                    <div class="col-sm-3">
                                                        <input id="time" name="birthday" class="laydate-icon form-control layer-date" required="" aria-required="true" autocomplete="off">
                                                    </div>
                                                    <label class="col-sm-1 control-label">身份证号：</label>
                                                    <div class="col-sm-3">
                                                        <input  name="id_card" type="text" minlength="15" maxlength="18" class="form-control " required="" aria-required="true">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-1 control-label">联系电话：</label>
                                                    <div class="col-sm-3">
                                                        <input  name="tel" type="text" minlength="8" maxlength="15" class="form-control " required="" aria-required="true">
                                                    </div>
                                                    <label class="col-sm-1 control-label">政治面貌：</label>
                                                    <div class="col-sm-3">
                                                        <input  name="political" type="text" minlength="2" maxlength="15" class="form-control " required="" aria-required="true">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-1 control-label">学历信息：</label>
                                                    <div class="col-sm-3">
                                                        <input  name="education" type="text" minlength="2" maxlength="15" class="form-control " required="" aria-required="true">
                                                    </div>
                                                    <label class="col-sm-1 control-label">所在机构：</label>
                                                    <div class="col-sm-3">
                                                        <input  name="institution" type="text" minlength="2" maxlength="35" class="form-control " required="" aria-required="true">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-1 control-label">职务：</label>
                                                    <div class="col-sm-3">
                                                        <input  name="business" type="text" minlength="2" maxlength="15" class="form-control " required="" aria-required="true">
                                                    </div>
                                                    <label class="col-sm-1 control-label">健康状况：</label>
                                                    <div class="col-sm-3">
                                                        <input  name="health" type="text" minlength="2" maxlength="30" class="form-control " required="" aria-required="true">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-1 control-label">形象照片：</label>
                                                    <div class="col-sm-3">
                                                        <input  name="photo" type="file" class="form-control " aria-required="true">
                                                    </div>
                                                    <label class="col-sm-1 control-label">社会关系：</label>
                                                    <div class="col-sm-3">
                                                        <input  name="gam" type="text" minlength="2" maxlength="50" class="form-control " required="" aria-required="true">
                                                    </div>

                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-1 control-label">籍贯：</label>
                                                    <div class="col-sm-2">
                                                        <select id="province" name="native_province" class="form-control m-b help-block m-b-none" required="" aria-required="true">
                                                            <option value="">请选择省份</option>
                                                            <?php if(is_array($provinceRes) || $provinceRes instanceof \think\Collection || $provinceRes instanceof \think\Paginator): $i = 0; $__LIST__ = $provinceRes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$provinces): $mod = ($i % 2 );++$i;?>
                                                            <option value="<?php echo $provinces['id']; ?>"><?php echo $provinces['name']; ?></option>
                                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <select id="city" name="native_city"  style="display: none;" class="form-control m-b help-block m-b-none" aria-required="true" required=""></select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <select id="county" name="native_county" style="display: none;" class="form-control m-b help-block m-b-none" aria-required="true">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="tab-2">
                                                <div class="form-group">
                                                    <label class="col-sm-1 control-label">培训记录证书：</label>
                                                    <div class="col-sm-11">
                                                        <script id="training_info" name="training_info" type="text/plain"></script>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="tab-3">
                                                <div class="form-group">
                                                    <label class="col-sm-1 control-label">
                                                        <a onclick="addrow(this);" href="#" style="margin-right: 10px"> [ + ] </a>
                                                        评价内容
                                                    </label>
                                                    <div class="col-sm-11">
                                                        <input  name="content[]" type="text" class="form-control" aria-required="true">
                                                    </div>
                                                    <div style="padding-top: 45px">
                                                        <label class="col-sm-1 control-label">奖惩记录</label>
                                                        <div class="col-sm-11">
                                                            <input  name="sanctions[]" type="text" class="form-control" aria-required="true">
                                                        </div>
                                                    </div>
                                                    <div style="padding-top: 45px">
                                                        <label class="col-sm-1 control-label">所得分数</label>
                                                        <div class="col-sm-11">
                                                            <input  name="score[]" type="text" class="form-control" aria-required="true">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <div class="col-sm-3 col-sm-offset-1">
                                                <button class="btn btn-primary" type="submit" >提交</button>
                                                <button style="margin-left: 15px;" class="btn btn-default" type="reset" >重置</button>
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

<!-- 自定义js -->
<script src="/HRsystem/public/static/admin/js/content.js?v=1.0.0"></script>

<!-- jQuery Validation plugin javascript-->
<script src="/HRsystem/public/static/admin/js/plugins/validate/jquery.validate.min.js"></script>
<script src="/HRsystem/public/static/admin/js/plugins/validate/messages_zh.min.js"></script>

<script src="/HRsystem/public/static/admin/js/demo/form-validate-demo.js"></script>

<!-- layer -->
<script src="/static/plus/layer/layer.js"></script>
<script src="/static/plus/js/getaddress.js"></script>
<script src="/HRsystem/public/static/admin/js/plugins/layer/laydate/laydate.js"></script>

<script>
    var send_url="<?php echo $url_root; ?>/admin/staff/getCityInfo";
    var ismobile=false;
    $('input[name="photo"]').prettyFile();
    //外部js调用
    laydate({
        elem: '#time', //目标元素。由于laydate.js封装了一个轻量级的选择器引擎，因此elem还允许你传入class、tag但必须按照这种方式 '#id .class'
        event: 'focus' //响应事件。如果没有传入event，则按照默认的click
    });

    function addrow(o){
        var div=$(o).parent().parent();
        if($(o).html()==' [ + ] '){
            var newdiv=div.clone();
            newdiv.find('a').html(' [ - ] ');
            div.after(newdiv);
        }else{
            div.remove();
        }
    }



</script>

<script type="text/javascript">
    var ue = UE.getEditor('training_info',{initialFrameHeight:400});
    toolbars: [
        ['fullscreen', 'source', 'undo', 'redo'],
        ['bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc']
    ]
</script>

</body>

</html>
