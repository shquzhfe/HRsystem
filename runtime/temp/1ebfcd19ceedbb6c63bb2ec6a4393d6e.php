<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:81:"D:\xampp\htdocs\HRsystem\public/../application/admin\view\model_fields\lists.html";i:1522226893;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>字段列表</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="/HRsystem/public/static/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
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
                                <h4 class="example-title">字段列表 <a class="btn btn-outline btn-rounded btn-sm btn-info"  href="<?php echo url('lists'); ?>">刷新</a></h4>
                                <div class="example">
                                    <div class="btn-group hidden-xs" id="exampleTableEventsToolbar" role="group">
                                        <a class="btn btn-primary" href="<?php echo url('ModelFields/add'); ?>" style="color:#fff;"><i class="glyphicon glyphicon-plus" aria-hidden="true"></i> 添加字段</a>

                                    </div>
                                    <table class="table table-bordered" >
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">ID</th>
                                                <th style="width: 15%">字段中文名称</th>
                                                <th style="width: 15%">字段英文名称</th>
                                                <th style="width: 10%">字段类型</th>
                                                <th style="width: 30%">字段默认值</th>
                                                <th style="width: 10%">所属模型</th>
                                                <th style="width: 15%">操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(is_array($modelfields) || $modelfields instanceof \think\Collection || $modelfields instanceof \think\Paginator): $i = 0; $__LIST__ = $modelfields;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
                                            <tr >
                                                <td><?php echo $value['id']; ?></td>
                                                <td><?php echo $value['field_cname']; ?></td>
                                                <td><?php echo $value['field_ename']; ?></td>

                                                <td>
                                                    <?php switch($value['field_type']): case "1": ?> 文本框 <?php break; case "2": ?> 单选按钮 <?php break; case "3": ?> 复选框 <?php break; case "4": ?> 下拉菜单 <?php break; case "5": ?> 文本域 <?php break; case "6": ?> 附件 <?php break; case "7": ?> 浮点 <?php break; case "8": ?> 整型 <?php break; case "9": ?> 长文本 <?php break; endswitch; ?>
                                                </td>
                                                <td><?php if($value['field_values'] == ''): ?>未设置<?php else: ?><?php echo $value['field_values']; endif; ?></td>
                                                <td><?php echo $value['model_name']; ?></td>
                                                <td>
                                                    <a class="btn btn-outline btn-rounded btn-primary" href="<?php echo url('edit',array('id'=>$value['id'])); ?>">编辑</a>
                                                    <a class="btn btn-outline btn-rounded btn-danger" style="margin-left: 3%" modelFiledsid="<?php echo $value['id']; ?>"  onclick="dele(this);">删除</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                        </tbody>
                                    </table>
                                    <div align="right"><?php echo $modelfields->render(); ?></div>
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
        //删除
        function dele(object){
            var modelFiledsid=$(object).attr("modelFiledsid");
            layer.confirm('您确定要删除该字段吗？', {
                title: false,
                closeBtn: false,
                icon: 3,
                btn: ['确定','取消']
            }, function(){
                $.ajax({
                    type:"post",
                    dataType:"json",
                    data:{modelFiledsid:modelFiledsid},
                    url:"<?php echo url('Model_fields/del'); ?>",
                    success:function(data){
                        if(data){
                            layer.msg('删除字段成功', {
                                icon: 6,
                                time: 2000, //2s后自动关闭
                            },function(){
                                window.location.reload();
                            });
                        }else{
                            layer.msg('删除字段失败，刷新再试', {icon: 2});
                        }
                    }
                });
            });
        }
    </script>
</body>

</html>
