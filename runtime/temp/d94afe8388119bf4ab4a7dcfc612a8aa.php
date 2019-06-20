<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"D:\xampp\htdocs\HRsystem\public/../application/admin\view\auth_rule\lists.html";i:1522226573;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>规则列表</title>
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
                            <h4 class="example-title">规则列表 <a  href="<?php echo url('lists'); ?>"><button class="btn btn-outline btn-rounded btn-sm btn-info">刷新</button></a></h4>
                            <div class="example">

                                <div class="btn-group hidden-xs" id="exampleTableEventsToolbar" role="group">
                                    <a class="btn btn-primary" href="<?php echo url('add'); ?>" style="color:#fff;"><i class="glyphicon glyphicon-plus" aria-hidden="true"></i> 添加规则</a>

                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr pid="0">

                                            <th>伸缩</th>
                                            <th >编号</th>
                                            <th  >规则名</th>
                                            <th >规则</th>
                                            <th  >是否开启</th>
                                            <th >菜单显示</th>

                                            <th >操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(is_array($ruleRes) || $ruleRes instanceof \think\Collection || $ruleRes instanceof \think\Paginator): $i = 0; $__LIST__ = $ruleRes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                                    <tr id="<?php echo $val['id']; ?>" pid="<?php echo $val['pid']; ?>" >
                                        <td width="5%"><a  class="showHide btn btn-xs btn-outline btn-warning" style="font-size: 14px; font-weight: bold" >+</a></td>
                                        <td><?php echo $val['sort']; ?></td>
                                        <?php if($val['level'] == 0): ?>
                                        <td ><span style="font-weight: bold; color: #19A566"><?php echo $val['title']; ?></span></td>
                                        <?php else: ?>
                                        <td><?php echo str_repeat('-',$val['level']*6); ?><?php echo $val['title']; ?></td>
                                        <?php endif; ?>

                                        <td><?php echo $val['name']; ?></td>

                                        <td><a  val_id="<?php echo $val['id']; ?>"  onclick="status(this);"  <?php if($val['status'] == 1): ?> class="btn btn-primary" <?php else: ?> class="btn btn-default" <?php endif; ?>><?php if($val['status'] == 1): ?>开启<?php else: ?>关闭<?php endif; ?></a></td>
                                        <td><a  show_id="<?php echo $val['id']; ?>"  onclick="show(this);"  <?php if($val['show'] == 1): ?> class="btn btn-info" <?php else: ?> class="btn btn-default" <?php endif; ?>><?php if($val['show'] == 1): ?>显示<?php else: ?>隐藏<?php endif; ?></a></td>
                                        <td>
                                            <a  href="<?php echo url('edit',array('id'=>$val['id'])); ?> " >
                                                <button class="btn btn-outline btn-rounded btn-primary">编辑</button>
                                            </a>
                                            <a  style="margin-left: 3%" val_id="<?php echo $val['id']; ?>"  onclick="dele(this);" >
                                                <button class="btn btn-outline btn-rounded btn-danger">删除</button>
                                            </a>
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
        //伸缩
        $('tr[pid!=0]').hide();
        $(".showHide").click(function(){
            var id=$(this).parents('tr').attr('id');
            if($(this).text()=='+'){
                $(this).text('-');
                $("tr[pid="+id+"]").show();
            }else{
                $(this).text('+');
                /* $("tr[pid="+id+"]").hide();*/
                $.ajax({
                    type:"post",
                    dataType:"json",
                    data:{id:id},
                    url:"<?php echo url('AuthRule/isShowHidden'); ?>",
                    success:function(data){
                        var sonids=[];
                        var idsobj=$('tr[pid!=0]');
                        //数组遍历
                        idsobj.each(function(){
                            sonids.push($(this).attr('id'));
                        });
                        //json的遍历
                        $.each(data,function(k,v){
                            if($.inArray(v,sonids)){
                                $('tr[id='+v+']').hide();
                                $('tr[id='+v+']').find('a:first').text('+');
                            }
                        });
                    }
                });
            }
        });

        //关闭与开启
        function status(obj){
            var id=$(obj).attr("val_id");
            $.ajax({
                type:"post",
                dataType:"json",
                data:{id:id},
                url:"<?php echo url('AuthRule/status'); ?>",
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

        //显示与隐藏
        function show(obj){
            var id=$(obj).attr("show_id");
            $.ajax({
                type:"post",
                dataType:"json",
                data:{id:id},
                url:"<?php echo url('AuthRule/show'); ?>",
                success:function(data){
                    if(data==0){
                        $(obj).attr("class","btn btn-default");
                        $(obj).text("隐藏");
                    }else if(data==1){
                        $(obj).attr("class","btn btn-info");
                        $(obj).text("显示");
                    }else if(data==-1){
                        layer.msg(' 当前状态禁止隐藏', {icon: 2});
                    }else{
                        layer.msg(' 非法访问！', {icon: 2});
                    }
                }
            });

        }

        function dele(object){
            var id=$(object).attr("val_id");
            layer.confirm('您确定要删除该条记录吗？', {
                title: false,
                closeBtn: false,
                icon: 3,
                btn: ['确定','取消']
            }, function(){
                $.ajax({
                    type:"post",
                    dataType:"json",
                    data:{id:id},
                    url:"<?php echo url('AuthRule/del'); ?>",
                    success:function(data){
                        if(data==1){
                            layer.msg('删除记录成功', {
                                icon: 6,
                                time: 2000, //2s后自动关闭
                            },function(){
                                /*window.location.href="<?php echo url('Conf/lists'); ?>";*/
                                window.location.reload();
                            });
                        }else if(data==0){
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
