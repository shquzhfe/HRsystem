<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"D:\xampp\htdocs\HRsystem\public/../application/admin\view\model_fields\add.html";i:1494927136;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>添加字段</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="/HRsystem/public/static/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/HRsystem/public/static/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/HRsystem/public/static/admin/css/animate.css" rel="stylesheet">
    <link href="/HRsystem/public/static/admin/css/style.css?v=4.1.0" rel="stylesheet">

    <link href="/HRsystem/public/static/admin/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

</head>
<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <h5>添加字段 <a  href="<?php echo url('lists'); ?>"><button class="btn btn-outline btn-rounded btn-sm btn-info">返回列表</button></a></h5>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal m-t" id="commentForm" method="post" action="">
                            <div class="form-group">
                                <label class="col-sm-1 control-label">所属模型</label>
                                <div class="col-sm-11">
                                    <select class="form-control m-b" required=""  name="model_id" aria-required="true">
                                        <?php if(is_array($model) || $model instanceof \think\Collection || $model instanceof \think\Paginator): $i = 0; $__LIST__ = $model;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                                        <option value="<?php echo $val['id']; ?>"><?php echo $val['model_name']; ?></option>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">字段中文名称</label>
                                <div class="col-sm-11">
                                    <input  name="field_cname" minlength="2" maxlength="60" type="text" class="form-control" required="" aria-required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">字段英文名称</label>
                                <div class="col-sm-11">
                                    <input  name="field_ename" minlength="2" maxlength="60" type="text" class="form-control" required="" aria-required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">字段类型</label>
                                <div class="col-sm-11">
                                    <!--字段类型(1输入框,2单选,3复选,4下拉菜单,5文本域,6附件,7浮点,8整形,9,长文本)-->
                                    <select class="form-control m-b" required=""  name="field_type" required="" aria-required="true">
                                        <option value="1">文本框</option>
                                        <option value="2">单选框</option>
                                        <option value="3">复选框</option>
                                        <option value="4">下拉菜单</option>
                                        <option value="5">文本域</option>
                                        <option value="6">附件</option>
                                        <option value="7">浮点</option>
                                        <option value="8">整形</option>
                                        <option value="9">长文本</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">字段默认值：</label>
                                <div class="col-sm-11">
                                    <textarea  name="field_values" class="form-control" aria-required="true"></textarea>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-1">
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
