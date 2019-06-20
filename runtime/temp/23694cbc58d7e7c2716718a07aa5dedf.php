<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"D:\xampp\htdocs\HRsystem\public/../application/admin\view\conf\add.html";i:1506226330;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>添加配置项</title>
    <link rel="shortcut icon" href="favicon.ico"> <link href="/HRsystem/public/static/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/HRsystem/public/static/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/HRsystem/public/static/admin/css/animate.css" rel="stylesheet">
    <link href="/HRsystem/public/static/admin/css/style.css?v=4.1.0" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <h5>添加配置项 <a  href="<?php echo url('lists'); ?>"><button class="btn btn-outline btn-rounded btn-sm btn-info">返回列表</button></a></h5>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal m-t" id="commentForm" method="post" action="">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">中文名称：</label>
                                <div class="col-sm-10">
                                    <input id="zh_name" name="zh_name" minlength="2" type="text" class="form-control" required="" aria-required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">英文名称：</label>
                                <div class="col-sm-10">
                                    <input id="en_name" name="en_name" minlength="2" type="text" class="form-control" required="" aria-required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">配置分类</label>
                                <div class="col-sm-10">
                                    <select class="form-control m-b" required="" name="set_lists">
                                        <option value="1">基本配置</option>
                                        <option value="2">联系方式</option>
                                        <option value="3">SEO配置</option>
                                        <option value="4">扩展配置</option>
                                        <option value="5">核心配置</option>
                                        <option value="6">插件配置</option>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">表单类型</label>
                                <div class="col-sm-10">
                                    <select class="form-control m-b" required=""  name="set_type">
                                        <option value="1">文本框</option>
                                        <option value="2">单选框</option>
                                        <option value="3">复选框</option>
                                        <option value="4">下拉菜单</option>
                                        <option value="5">文本域</option>
                                        <option value="6">附件</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">默认值：</label>
                                <div class="col-sm-10">
                                    <textarea  name="value" class="form-control" aria-required="true"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">可选值：</label>
                                <div class="col-sm-10">
                                    <input  type="text" class="form-control" name="optional">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-3 col-sm-offset-2">
                                    <button class="btn btn-primary" type="submit" >提交</button>
                                    <button style="margin-left: 15px;" class="btn btn-default" type="reset" >重置</button>
                                    <a style="margin-left: 15px;" class="btn btn-info" href="<?php echo url('lists'); ?>">返回</a>
                                </div>
                            </div>
                        </form>
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


</body>

</html>
