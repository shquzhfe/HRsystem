<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"D:\xampp\htdocs\HRsystem\public/../application/admin\view\admin\add.html";i:1510564034;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>添加管理员</title>
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
                        <h5>添加管理员 <a  href="<?php echo url('lists'); ?>"><button class="btn btn-outline btn-rounded btn-sm btn-info">返回列表</button></a></h5>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal m-t" id="commentForm" method="post" action="">
                            <div class="form-group has-success">
                                <label class="col-sm-1 control-label">所属用户组</label>
                                <div class="col-sm-11">
                                    <select class="form-control m-b help-block m-b-none" required="" name="groupid" aria-required="true" aria-invalid="false" aria-describedby="set_lists-error">
                                        <?php if(is_array($group) || $group instanceof \think\Collection || $group instanceof \think\Paginator): $i = 0; $__LIST__ = $group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                            <option value="<?php echo $v['id']; ?>"><?php echo $v['title']; ?></option>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                    <span id="set_lists-error" class="help-block m-b-none"></span></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">账号：</label>
                                <div class="col-sm-11">
                                    <input id="zh_name" name="uname" minlength="2" type="text" class="form-control" required="" aria-required="true">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label">密码：</label>
                                <div class="col-sm-11">
                                    <input id="password" name="password" minlength="2" type="password" class="form-control" required="" aria-required="true">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label">手机：</label>
                                <div class="col-sm-11">
                                    <input  name="admin_tel" minlength="11" maxlength="11" type="text" class="form-control" aria-required="true">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-3 col-sm-offset-1">
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
