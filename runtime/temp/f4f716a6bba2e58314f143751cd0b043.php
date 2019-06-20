<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"D:\xampp\htdocs\HRsystem\public/../application/admin\view\enterprise\lists.html";i:1546666670;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>企业档案列表</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="/HRsystem/public/static/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/HRsystem/public/static/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">

    <!-- Data Tables -->
    <link href="/HRsystem/public/static/admin/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <link href="/HRsystem/public/static/admin/css/animate.css" rel="stylesheet">
    <link href="/HRsystem/public/static/admin/css/style.css?v=4.1.0" rel="stylesheet">



</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>企业档案列表
                        <small><a style="margin-left: 15px;color: #19A566"  href="<?php echo url('lists'); ?>">刷新</a></small>
                    </h5>
                    <div class="ibox-tools">
                    </div>
                </div>
                <div class="ibox-content">

                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>企业名称</th>
                            <th>信用代码</th>
                            <th>法定代表人</th>
                            <th>成立日期</th>
                            <th>营业期限</th>
                            <th>企业类型</th>
                            <th>海关代码</th>
                            <th>注册资本</th>
                            <th>企业状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($rs) || $rs instanceof \think\Collection || $rs instanceof \think\Paginator): $i = 0; $__LIST__ = $rs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                        <tr>
                            <td><?php echo $val['id']; ?></td>
                            <td><a href="<?php echo url('info',array('id'=>$val['id'])); ?>" title="点此进入<?php echo $val['name']; ?>的详细信息"><?php echo $val['name']; ?></a></td>
                            <td><?php echo $val['credit_num']; ?></td>
                            <td><?php echo $val['legal_name']; ?></td>
                            <td><?php echo date("Y-m-d",$val['found_time']); ?></td>
                            <td><?php echo date("Y-m-d",$val['start_time']); ?>~<?php echo date("Y-m-d",$val['end_time']); ?></td>
                            <td><?php echo $val['type']; ?></td>
                            <td><?php echo $val['customs_code']; ?></td>
                            <td><?php echo format_number($val['reg_capital']/10000,2); ?> 万元<?php echo $val['currency']; ?></td>
                            <td><?php echo $val['status']; ?></td>
                            <td>
                                <a style="margin-left: 3%"  href="<?php echo url('edit',array('id'=>$val['id'])); ?> " >
                                    <button class="btn btn-outline btn-rounded btn-primary">编辑</button>
                                </a>
                                <a onclick="del(this)" style="margin-left: 3%" href="javascript:;"><button class="btn btn-outline btn-rounded btn-danger">删除</button></a>
                            </td>

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

<script src="/HRsystem/public/static/admin/js/plugins/jeditable/jquery.jeditable.js"></script>

<!-- Data Tables -->
<script src="/HRsystem/public/static/admin/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="/HRsystem/public/static/admin/js/plugins/dataTables/dataTables.bootstrap.js"></script>

<!-- 自定义js -->
<script src="/HRsystem/public/static/admin/js/content.js?v=1.0.0"></script>

<!-- Bootstrap table -->
<script src="/HRsystem/public/static/admin/js/plugins/bootstrap-table/bootstrap-table.min.js"></script>
<script src="/HRsystem/public/static/admin/js/plugins/bootstrap-table/bootstrap-table-mobile.min.js"></script>
<script src="/HRsystem/public/static/admin/js/plugins/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>

<!-- Peity -->
<script src="/HRsystem/public/static/admin/js/demo/bootstrap-table-demo.js"></script>
<!-- layer -->
<script src="/HRsystem/public/static//plus/layer/layer.js"></script>
<script type="text/javascript">

    $(document).ready(function () {
        $('.dataTables-example').dataTable();

        /* Init DataTables */
        var oTable = $('#editable').dataTable();

        /* Apply the jEditable handlers to the table */
        oTable.$('td').editable('../example_ajax.php', {
            "callback": function (sValue, y) {
                var aPos = oTable.fnGetPosition(this);
                oTable.fnUpdate(sValue, aPos[0], aPos[1]);
            },
            "submitdata": function (value, settings) {
                return {
                    "row_id": this.parentNode.getAttribute('id'),
                    "column": oTable.fnGetPosition(this)[2]
                };
            },

            "width": "90%",
            "height": "100%"
        });


    });

    function fnClickAddRow() {
        $('#editable').dataTable().fnAddData([
            "Custom row",
            "New row",
            "New row",
            "New row",
            "New row"]);
    }

    function del(obj) {
        layer.confirm('您确定要删除该企业档案信息吗？', {
            title: false,
            closeBtn: false,
            icon: 3,
            btn: ['确定','取消']
        }, function(index){
            var id=$(obj).attr('sid');
            var imgUrl=$(obj).attr('imgUrl');
            $.ajax({
                type:"post",
                dataType:"json",
                data:{id:id,imgUrl:imgUrl},
                url:"<?php echo url('Staff/del'); ?>",
                success:function(data){
                    if(data==1){
                        layer.msg(' 删除企业档案信息成功！', {icon: 6},function(){
                            window.location.reload();
                        });
                    }else{
                        layer.msg(' 删除企业档案信息失败！', {icon: 2});
                    }
                }
            });
            layer.close(index);
        });
    }

</script>
</body>

</html>
