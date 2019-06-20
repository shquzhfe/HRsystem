<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"D:\xampp\htdocs\HRsystem\public/../application/admin\view\conf\lists.html";i:1525268873;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>配置列表</title>
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
                        <div class="example-wrap">
                            <h4 class="example-title">配置管理 <a  href="<?php echo url('lists'); ?>"><button class="btn btn-outline btn-rounded btn-sm btn-info">刷新</button></a></h4>
                            <div class="example">

                                <div class="btn-group hidden-xs" id="exampleTableEventsToolbar" role="group">
                                    <a class="btn btn-primary" href="<?php echo url('Conf/add'); ?>" style="color:#fff;"><i class="glyphicon glyphicon-plus" aria-hidden="true"></i> 添加配置</a>

                                </div>
                                <table id="exampleTableEvents" data-height="600" data-mobile-responsive="true">
                                    <thead>
                                        <tr>
                                            <!--<th data-field="state" data-checkbox="true"></th>-->
                                            <th data-field="id" data-visible="false">ID</th>
                                            <th data-field="zh_name" data-switchable="false">中文名称</th>
                                            <th data-field="en_name" data-switchable="false">英文名称</th>
                                            <th data-field="set_lists" data-visible="false">配置分类</th>
                                            <th data-field="set_type" data-visible="false">表单类型</th>
                                            <th data-field="value">默认值</th>
                                            <th data-field="optional">可选项</th>
                                            <th data-field="edit">操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(is_array($conf) || $conf instanceof \think\Collection || $conf instanceof \think\Paginator): $i = 0; $__LIST__ = $conf;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
                                    <tr>
                                        <!--<td></td>-->
                                        <td><?php echo $value['id']; ?></td>
                                        <td><?php echo $value['zh_name']; ?></td>
                                        <td><?php echo $value['en_name']; ?></td>
                                        <td><?php if($value['set_lists'] == 1): ?>
                                            基本配置
                                            <?php elseif($value['set_lists'] == 2): ?>
                                            联系方式
                                            <?php elseif($value['set_lists'] == 3): ?>
                                            SEO配置
                                            <?php elseif($value['set_lists'] == 4): ?>
                                            扩展配置
                                            <?php elseif($value['set_lists'] == 5): ?>
                                            核心配置
                                            <?php elseif($value['set_lists'] == 6): ?>
                                            插件配置
                                            <?php endif; ?>
                                        </td>
                                        <td><?php switch($value['set_type']): case "1": ?> 单行文本 <?php break; case "2": ?> 单选按钮 <?php break; case "3": ?> 复选框 <?php break; case "4": ?> 下拉菜单 <?php break; case "5": ?> 文本域 <?php break; case "6": ?> 附件 <?php break; endswitch; ?>
                                        </td>
                                        <td><?php if($value['value'] == ""): ?>未配置<?php else: ?><?php echo subtext($value['value'] ,60); endif; ?></td>
                                        <td><?php if($value['optional'] == ""): ?>未配置<?php else: ?><?php echo $value['optional']; endif; ?></td>
                                        <td><!--<a  confid="<?php echo $value['id']; ?>" onclick="edits(this);">编辑</a> --> <a  href="<?php echo url('edit',array('id'=>$value['id'])); ?>"><button class="btn btn-outline btn-rounded btn-primary">编辑</button></a>   <a  style="margin-left: 3%" confid="<?php echo $value['id']; ?>" onclick="dele(this);"> <button class="btn btn-outline btn-rounded btn-danger">删除</button></a> </td>
                                    </tr>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>



                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End Example Events -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Panel Other -->
    </div>

    <!-- 全局js -->
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

        function dele(object){
            var confid=$(object).attr("confid");
            layer.confirm('您确定要删除该条记录吗？', {
                title: false,
                closeBtn: false,
                icon: 3,
                btn: ['确定','取消']
            }, function(){
                $.ajax({
                    type:"post",
                    dataType:"json",
                    data:{confid:confid},
                    url:"<?php echo url('Conf/del'); ?>",
                    success:function(data){
                        if(data){
                            layer.msg('删除记录成功', {
                                icon: 6,
                                time: 2000, //2s后自动关闭
                            },function(){
                                /*window.location.href="<?php echo url('Conf/lists'); ?>";*/
                                window.location.reload();
                            });
                        }else{
                            layer.msg('删除记录失败，刷新再试', {icon: 2});
                        }
                    }
                });
            }, function(){
            });
        }
    </script>
</body>

</html>
