<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"D:\xampp\htdocs\HRsystem\public/../application/admin\view\model\lists.html";i:1522226877;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>栏目列表</title>
    <link rel="shortcut icon" href="favicon.ico"> <link href="/HRsystem/public/static/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/HRsystem/public/static/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/HRsystem/public/static/admin/css/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
    <link href="/HRsystem/public/static/admin/css/animate.css" rel="stylesheet">
    <link href="/HRsystem/public/static/admin/css/style.css?v=4.1.0" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <!-- Panel Other -->
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row row-lg">
                    <div class="col-sm-12">
                        <!-- Example Events -->
                        <form action="<?php echo url('Model/delall'); ?>" method="post">
                            <div class="example-wrap">
                                <h4 class="example-title">模型管理 <a class="btn btn-outline btn-rounded btn-sm btn-info"  href="<?php echo url('lists'); ?>">刷新</a></h4>
                                <div class="example">
                                    <div class="btn-group hidden-xs" id="exampleTableEventsToolbar" role="group">
                                        <a class="btn btn-primary" href="<?php echo url('Model/add'); ?>" style="color:#fff;"><i class="glyphicon glyphicon-plus" aria-hidden="true"></i> 添加模型</a>

                                    </div>
                                    <table class="table table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>模型名称</th>
                                                <th>附加表名</th>
                                                <th>状态</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(is_array($model) || $model instanceof \think\Collection || $model instanceof \think\Paginator): $i = 0; $__LIST__ = $model;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
                                            <tr >
                                                <td><?php echo $value['id']; ?></td>
                                                <td><a href="<?php echo url('ModelFields/lists',array('model_id'=>$value['id'])); ?>"><?php echo $value['model_name']; ?></a></td>
                                                <td><?php echo $prefix; ?><?php echo $value['table_name']; ?></td>
                                                <td><a valid="<?php echo $value['id']; ?>" onclick="status(this);" <?php if($value['status'] == 1): ?> class="btn btn-primary" <?php else: ?> class="btn btn-default" <?php endif; ?>><?php if($value['status'] == 1): ?>开启<?php else: ?>关闭<?php endif; ?></a></td>
                                                <td>
                                                    <a class="btn btn-outline btn-rounded btn-primary" href="<?php echo url('edit',array('id'=>$value['id'])); ?>">编辑</a>
                                                    <a class="btn btn-outline btn-rounded btn-danger" style="margin-left: 3%" modelid="<?php echo $value['id']; ?>" tableName="<?php echo $prefix; ?><?php echo $value['table_name']; ?>" onclick="dele(this);">删除</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                        </tbody>
                                    </table>
                                    <div align="right"><?php echo $model->render(); ?></div>
                                </div>

                            </div>
                        </form>
                        <!-- End Example Events -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Panel Other -->
    </div>

    <!-- 全局js -->
   <!-- <script type="text/javascript" src="http://demo.jb51.net/jslib/jquery/jquery1.3.2.js"></script>-->
    <script src="/HRsystem/public/static/admin/js/jquery.min.js?v=2.1.4"></script>

    <script src="/HRsystem/public/static/admin/js/bootstrap.min.js?v=3.3.6"></script>
    <!-- 自定义js -->
    <script src="/HRsystem/public/static/admin/js/content.js?v=1.0.0"></script>
    <!-- Bootstrap table -->
    <script src="/HRsystem/public/static/admin/js/plugins/bootstrap-table/bootstrap-table.min.js"></script>
    <script src="/HRsystem/public/static/admin/js/plugins/bootstrap-table/bootstrap-table-mobile.min.js"></script>
    <script src="/HRsystem/public/static/admin/js/plugins/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>

    <!-- Peity -->
    <script src="/HRsystem/public/static/admin/js/demo/bootstrap-table-demo.js"></script>

    <!-- layer -->
    <script src="/static/plus/layer/layer.js"></script>

    <script type="text/javascript">
        //全选
        function checkAll(val) {
            $("input[name='itm[]']").each(function() {
                this.checked = val;
            });
        }
        //关闭与开启
        function status(obj){
            var valid=$(obj).attr("valid");
            $.ajax({
                type:"post",
                dataType:"json",
                data:{valid:valid},
                url:"<?php echo url('Model/status'); ?>",
                success:function(data){
                    if(data==0){
                        $(obj).attr("class","btn btn-default");
                        $(obj).text("关闭");
                    }else if(data==1){
                        $(obj).attr("class","btn btn-primary");
                        $(obj).text("开启");
                    }else{
                        layer.msg(' 非法访问！', {icon: 2});
                    }
                }
            });

        }

        //删除
        function dele(object){
            var modelid=$(object).attr("modelid");
            var tableName=$(object).attr("tableName");
            layer.confirm('您确定要删除该模型吗？', {
                title: false,
                closeBtn: false,
                icon: 3,
                btn: ['确定','取消']
            }, function(){
                $.ajax({
                    type:"post",
                    dataType:"json",
                    data:{modelid:modelid,tableName:tableName},
                    url:"<?php echo url('Model/del'); ?>",
                    success:function(data){
                        if(data){
                            layer.msg('删除模型成功', {
                                icon: 6,
                                time: 2000, //2s后自动关闭
                            },function(){
                                window.location.reload();
                            });
                        }else{
                            layer.msg('删除模型失败，刷新再试', {icon: 2});
                        }
                    }
                });
            });
        }
    </script>
</body>

</html>
