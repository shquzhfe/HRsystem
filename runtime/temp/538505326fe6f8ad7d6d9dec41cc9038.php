<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"D:\xampp\htdocs\HRsystem\public/../application/admin\view\auth_rule\edit.html";i:1504275876;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>编辑规则</title>
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
                        <h5>编辑规则 <a  href="<?php echo url('lists'); ?>"><button class="btn btn-outline btn-rounded btn-sm btn-info">返回列表</button></a></h5>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal m-t" id="commentForm" method="post" action="">
                            <div class="form-group has-success">
                                <label class="col-sm-1 control-label">上级规则</label>
                                <div class="col-sm-11">
                                    <select class="form-control m-b help-block m-b-none" required="" name="pid" aria-required="true" aria-invalid="false" aria-describedby="set_lists-error">
                                        <option value="0">顶级规则</option>
                                        <?php if(is_array($ruleRes) || $ruleRes instanceof \think\Collection || $ruleRes instanceof \think\Paginator): $i = 0; $__LIST__ = $ruleRes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                                        <option <?php if($rule['pid'] == $val['id']): ?> selected="selected" <?php endif; ?> value="<?php echo $val['id']; ?>"><?php echo str_repeat('-',$val['level']*4); ?><?php echo $val['title']; ?></option>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                    <span id="set_lists-error" class="help-block m-b-none"></span></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">规则名：</label>
                                <div class="col-sm-11">
                                    <input  type="text" name="title" value="<?php echo $rule['title']; ?>" class="form-control" required="" aria-required="true">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label">规则：</label>
                                <div class="col-sm-11">
                                    <input  type="text" name="name" value="<?php echo $rule['name']; ?>" class="form-control" required="" aria-required="true">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label">排序：</label>
                                <div class="col-sm-11">
                                    <input  type="number" name="sort" value="<?php echo $rule['sort']; ?>" class="form-control" required="" aria-required="true">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label">图标：</label>
                                <div class="col-sm-11">
                                    <input  type="text" name="icon" value="<?php echo $rule['icon']; ?>" class="form-control"  aria-required="true">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label">是否启用</label>
                                <div class="col-sm-11">
                                    <div class="col-sm-1 radio radio-info" style="float: left; ">
                                        <input name="status" value="1" <?php if($rule['status'] == 1): ?> checked="checked" <?php endif; ?> type="radio">
                                        <label>
                                            开启
                                        </label>
                                    </div>
                                    <div class="col-sm-1 radio radio-warning" style="float: left; ">
                                        <input name="status" value="0" <?php if($rule['status'] == 0): ?> checked="checked" <?php endif; ?> type="radio">
                                        <label>
                                            关闭
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label">控制隐藏</label>
                                <div class="col-sm-11">
                                    <div class="col-sm-1 radio radio-success" style="float: left; ">
                                        <input name="isshow" id="stop" value="0" <?php if($rule['isshow'] == 0): ?> checked="checked" <?php endif; ?> type="radio">
                                        <label>
                                            停用
                                        </label>
                                    </div>
                                    <div class="col-sm-1 radio radio-danger" style="float: left; ">
                                        <input name="isshow" id="start" value="1" <?php if($rule['isshow'] == 1): ?> checked="checked" <?php endif; ?> type="radio">
                                        <label>
                                            启用
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" id="shows" <?php if($rule['isshow'] == 0): ?> style="display: none;" <?php endif; ?>>
                                <label class="col-sm-1 control-label">菜单显示</label>
                                <div class="col-sm-11">
                                    <div class="col-sm-1 radio radio-primary" style="float: left; ">
                                        <input name="show" value="1" <?php if($rule['show'] == 1): ?> checked="checked" <?php endif; ?> type="radio">
                                        <label>
                                            显示
                                        </label>
                                    </div>
                                    <div class="col-sm-1 radio radio-danger" style="float: left; ">
                                        <input name="show" value="0" <?php if($rule['show'] == 0): ?> checked="checked" <?php endif; ?> type="radio">
                                        <label>
                                            隐藏
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-3 col-sm-offset-1">
                                    <button class="btn btn-primary" type="submit" >保存</button>
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
        //控制显示与隐藏表单
        $(function(){
            $("#stop").change(function(){
                var val=$('input:radio[name="isshow"]:checked').val();
                if(val==0){
                    $("#shows").hide();
                    return false;
                }
            });
            $("#start").change(function(){
                var val=$('input:radio[name="isshow"]:checked').val();
                if(val==1){
                    $("#shows").show();
                    return false;
                }
            });
        });
    </script>

</body>

</html>
