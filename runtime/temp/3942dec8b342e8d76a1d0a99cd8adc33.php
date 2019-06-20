<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"D:\xampp\htdocs\HRsystem\public/../application/admin\view\staff\lists.html";i:1546666494;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>会员列表</title>
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
                    <h5>会员列表
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
                            <th>姓名</th>
                            <th>性别</th>
                            <th>年龄</th>
                            <th>联系电话</th>
                            <th>身份证号</th>
                            <th>籍贯</th>
                            <th>学历</th>
                            <th>政治面貌</th>
                            <th>所在机构</th>
                            <th>职务</th>
                            <th>照片</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($rs) || $rs instanceof \think\Collection || $rs instanceof \think\Paginator): $i = 0; $__LIST__ = $rs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                        <tr>
                            <td><?php echo $val['id']; ?></td>
                            <td><a href="<?php echo url('vitae',array('id'=>$val['id'])); ?>" title="点此进入<?php echo $val['name']; ?>的个人简历"><?php echo $val['name']; ?></a></td>
                            <td>
                                <?php if($val['gender'] == 1): ?>
                                男
                                <?php else: ?>
                                女
                                <?php endif; ?>
                            </td>
                            <?php 
                            $age=ceil((time()-$val['birthday'])/(86400*365));
                             ?>
                            <td><span title="<?php echo date('Y-m-d',$val['birthday']); ?> 出生"><?php echo $age; ?> 岁</span></td>
                            <td><?php echo $val['tel']; ?></td>
                            <td><?php echo $val['id_card']; ?></td>
                            <td><?php echo $val['province']; ?> <?php echo $val['city']; ?> <?php echo $val['county']; ?></td>
                            <td><?php echo $val['education']; ?></td>
                            <td><?php echo $val['political']; ?></td>
                            <td><?php echo subtext($val['institution'],16); ?></td>
                            <td><?php echo $val['business']; ?></td>
                            <td>
                                <?php if($val['photo']): ?>
                                <img name="<?php echo $val['name']; ?>" onclick="bigImg(this)" src="/uploads/photos/<?php echo $val['photo']; ?>" height="50" alt="">
                                <?php else: if($val['gender'] == 1): ?>
                                        <img src="/static/plus/icon/boy.png" height="50" alt="">
                                    <?php else: ?>
                                        <img src="/static/plus/icon/girl.png" height="50" alt="">
                                    <?php endif; endif; ?>
                            </td>
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
<script src="/static/plus/layer/layer.js"></script>
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
        layer.confirm('您确定要删除该员工信息吗？', {
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
                        layer.msg(' 删除员工信息成功！', {icon: 6},function(){
                            window.location.reload();
                        });
                    }else{
                        layer.msg(' 删除员工信息失败！', {icon: 2});
                    }
                }
            });
            layer.close(index);
        });
    }

    function bigImg(obj){
        var src=$(obj).attr("src");
        var name=$(obj).attr("name");
        layer.open({
            type: 1,
            title:name+' 形象照片',
            shadeClose: true,
            skin: 'layui-layer-rim', //加上边框
            area: ['400px', '500px'], //宽高
            content: '<img src="'+src+'" width="100%" alt="">'
        });
    }


</script>
</body>

</html>
