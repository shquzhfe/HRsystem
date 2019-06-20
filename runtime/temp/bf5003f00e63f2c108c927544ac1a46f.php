<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"D:\xampp\htdocs\HRsystem\public/../application/admin\view\auth_group\power.html";i:1504616420;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>分配权限</title>
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
                        <h5>分配权限 <a  href="<?php echo url('lists'); ?>"><button class="btn btn-outline btn-rounded btn-sm btn-info">返回列表</button></a></h5>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal m-t" id="commentForm" method="post" action="">

                            <div class="form-group">
                                <label class="col-sm-1 control-label">用户组名：</label>
                                <div class="col-sm-11">
                                    <input    type="text" name="title" value="<?php echo $groupRes['title']; ?>" class="form-control" required="" aria-required="true">
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="col-sm-1 control-label">分配权限</label>
                                <div class="col-sm-11">
                                    <!--权限分配start-->
                                        <div class="panel panel-info" >
                                            <div class="panel-heading " >

                                                   <input  id="chkAll" onclick="CheckAll(this.form)" value="全选" type="checkbox">
                                                   <span style="font-weight: bold">【全 选】</span>

                                            </div>
                                            <div class="panel-body">
                                            <table>
                                                <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): ?>
                                                <tr>
                                                    <td style="padding-left: 20px;font-weight: bold;">
                                                        <label>
                                                        <div  class="checkbox checkbox-primary checkbox-inline">
                                                        <input class="checkbox-parent" name="rules[]" id="<?php echo $vo['id']; ?>" value="<?php echo $vo['id']; ?>" dataid="id-<?php echo $vo['id']; ?>" type="checkbox" <?php if(in_array($vo['id'],$rules)){ echo 'checked="checked"'; } ?>>
                                                        <label style="padding-left: 5px;"><?php echo $vo['title']; ?></label>
                                                        </div>
                                                        </label>
                                                    </td>
                                                </tr>
                                                    <?php if(is_array($vo['children']) || $vo['children'] instanceof \think\Collection || $vo['children'] instanceof \think\Paginator): if( count($vo['children'])==0 ) : echo "" ;else: foreach($vo['children'] as $key=>$vo2): ?>
                                                    <tr>
                                                        <td style="padding-left: 60px;">
                                                            <label>
                                                                <div  class="checkbox checkbox-info checkbox-inline">
                                                                <input class="checkbox-parent checkbox-child" name="rules[]" id="<?php echo $vo2['id']; ?>" value="<?php echo $vo2['id']; ?>" dataid="id-<?php echo $vo['id']; ?>-<?php echo $vo2['id']; ?>"  type="checkbox" <?php if(in_array($vo2['id'],$rules)){ echo 'checked="checked"'; } ?>>
                                                                <label style="padding-left: 5px;"><?php echo $vo2['title']; ?></label>
                                                                </div>
                                                            </label>

                                                        </td>
                                                    </tr>
                                                <!--如果有三级才展示tr-->
                                                        <?php if($vo2['children']): ?>
                                                        <tr>
                                                            <td  style="padding-left: 100px;">
                                                                <?php if(is_array($vo2['children']) || $vo2['children'] instanceof \think\Collection || $vo2['children'] instanceof \think\Paginator): if( count($vo2['children'])==0 ) : echo "" ;else: foreach($vo2['children'] as $key=>$vo3): ?>
                                                                <label>
                                                                    <div  class="checkbox checkbox-success checkbox-inline">
                                                                    <input  class="checkbox-child " name="rules[]" id="<?php echo $vo3['id']; ?>" value="<?php echo $vo3['id']; ?>" dataid="id-<?php echo $vo['id']; ?>-<?php echo $vo2['id']; ?>-<?php echo $vo3['id']; ?>" type="checkbox" <?php if(in_array($vo3['id'],$rules)){ echo 'checked="checked"'; } ?>>
                                                                    <label style="padding-right: 25px; padding-left: 5px;"> <?php echo $vo3['title']; ?> </label>
                                                                    </div>
                                                                </label>
                                                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                                            </td>
                                                        </tr>
                                                        <?php endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
                                            </table>
                                            </div>
                                        </div>
                                    <!--权限分配end-->
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

    <script type="text/javascript">
        /* 权限配置 */
        $(function () {
            //动态选择框，上下级选中状态变化
            $('input.checkbox-parent').on('change', function () {
                var dataid = $(this).attr("dataid");
                $('input[dataid^=' + dataid + ']').prop('checked', $(this).is(':checked'));
            });
            $('input.checkbox-child').on('change', function () {
                var dataid = $(this).attr("dataid");
                dataid = dataid.substring(0, dataid.lastIndexOf("-"));
                var parent = $('input[dataid=' + dataid + ']');
                if ($(this).is(':checked')) {
                    parent.prop('checked', true);
                    //循环到顶级
                    while (dataid.lastIndexOf("-") != 2) {
                        dataid = dataid.substring(0, dataid.lastIndexOf("-"));
                        parent = $('input[dataid=' + dataid + ']');
                        parent.prop('checked', true);
                    }
                } else {
                    //父级
                    if ($('input[dataid^=' + dataid + '-]:checked').length == 0) {
                        parent.prop('checked', false);
                        //循环到顶级
                        while (dataid.lastIndexOf("-") != 2) {
                            dataid = dataid.substring(0, dataid.lastIndexOf("-"));
                            parent = $('input[dataid=' + dataid + ']');
                            if ($('input[dataid^=' + dataid + '-]:checked').length == 0) {
                                parent.prop('checked', false);
                            }
                        }
                    }
                }
            });
        });
        //全选
        function CheckAll(form){
            for(var i=0;i<form.elements.length;i++){
                var e=form.elements[i];
                if(e.Name!='chkAll' && e.disabled==false){
                    e.checked=form.chkAll.checked;
                }
            }
        }



    </script>

</body>

</html>
