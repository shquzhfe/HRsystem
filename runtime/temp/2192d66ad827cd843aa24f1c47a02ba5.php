<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"D:\xampp\htdocs\HRsystem\public/../application/admin\view\conf\configs.html";i:1506226336;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>配置列表</title>
    <link rel="shortcut icon" href="favicon.ico"> <link href="/HRsystem/public/static/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/HRsystem/public/static/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">

    <link href="/HRsystem/public/static/admin/css/animate.css" rel="stylesheet">
    <link href="/HRsystem/public/static/admin/css/style.css?v=4.1.0" rel="stylesheet">
    <link href="/HRsystem/public/static/admin/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="row">
        <div class="col-sm-12">
            <div class="wrapper wrapper-content animated fadeInUp">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row m-t-sm">
                            <div class="col-sm-12">
                                <div class="panel blank-panel">
                                    <div class="panel-heading">
                                        <div class="panel-options">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a  href="#tab-1" data-toggle="tab">基本信息</a></li>
                                                <li class=""><a href="#tab-2" data-toggle="tab">联系方式</a></li>
                                                <li class=""><a href="#tab-3" data-toggle="tab">SEO配置</a></li>
                                                <li class=""><a href="#tab-4" data-toggle="tab">扩展配置</a></li>
                                                <li class=""><a href="#tab-5" data-toggle="tab">核心配置</a></li>
                                                <li class=""><a href="#tab-6" data-toggle="tab">插件配置</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body">
                                        <form method="post" class="form-horizontal" action="" enctype="multipart/form-data">

                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab-1">
                                                    <?php if(is_array($configs) || $configs instanceof \think\Collection || $configs instanceof \think\Paginator): $i = 0; $__LIST__ = $configs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;if($val['set_lists'] == 1): ?>
                                                            <div class="form-group">
                                                                <label class="col-sm-2 control-label"><?php echo $val['zh_name']; ?></label>
                                                                <div class="col-sm-10">
                                                                    <?php if($val['set_type'] == 1): ?>
                                                                    <input type="text" name="<?php echo $val['en_name']; ?>" value="<?php echo $val['value']; ?>" class="form-control">
                                                                    <?php elseif($val['set_type'] == 2): $opt=explode(',',$val['optional']);
                                                                foreach($opt as $op):
                                                                ?>
                                                                    <div class="col-sm-1 radio radio-danger" style="float: left; ">
                                                                        <input type="radio" name="<?php echo $val['en_name']; ?>"  value="<?php echo $op; ?>" <?php if($val['value']==$op): ?> checked="checked" <?php endif ?>>
                                                                        <label  >
                                                                            <?php echo $op; ?>
                                                                        </label>
                                                                    </div>
                                                                    <?php endforeach; elseif($val['set_type'] == 3):                                                                     $opt=explode(',',$val['optional']);
                                                                    $values=explode(',',$val['value']);
                                                                    foreach($opt as $op):
                                                                    ?>
                                                                        <div class="checkbox checkbox-success checkbox-inline">
                                                                            <input  type="checkbox" name="<?php echo $val['en_name']; ?>[]"  value="<?php echo $op; ?>" <?php if(in_array($op,$values)){ echo "checked='chenked'"; } ?>>
                                                                            <label > <?php echo $op; ?> </label>
                                                                        </div>
                                                                    <?php endforeach; elseif($val['set_type'] == 4): ?>
                                                                    <select class="form-control m-b" required=""  name="<?php echo $val['en_name']; ?>">
                                                                        <?php $opt=explode(',',$val['optional']);
                                                                    foreach($opt as $op):
                                                                    ?>
                                                                        <option value="<?php echo $op; ?>" <?php if($val['value']==$op): ?> selected="selected" <?php endif ?> ><?php echo $op; ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                    <?php elseif($val['set_type'] == 5): ?>
                                                                    <textarea  name="<?php echo $val['en_name']; ?>"  class="form-control" aria-required="true"><?php echo $val['value']; ?></textarea>
                                                                    <?php elseif($val['set_type'] == 6): if($val['value'] != ''): ?>
                                                                    <div class="form-group">
                                                                        <img src="/uploads/conf/<?php echo $val['value']; ?>" width="120" height="70" alt="<?php echo $val['zh_name']; ?>">
                                                                    </div>
                                                                    <?php endif; ?>
                                                                    <div class="form-group">
                                                                        <input type="file" name="<?php echo $val['en_name']; ?>" class="form-control">
                                                                    </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endif; endforeach; endif; else: echo "" ;endif; ?>

                                                </div>
                                                <div class="tab-pane" id="tab-2">

                                                    <?php if(is_array($configs) || $configs instanceof \think\Collection || $configs instanceof \think\Paginator): $i = 0; $__LIST__ = $configs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;if($val['set_lists'] == 2): ?>
                                                            <div class="form-group">
                                                                <label class="col-sm-2 control-label"><?php echo $val['zh_name']; ?></label>
                                                                <div class="col-sm-10">
                                                                    <?php if($val['set_type'] == 1): ?>
                                                                    <input type="text" name="<?php echo $val['en_name']; ?>" value="<?php echo $val['value']; ?>" class="form-control">
                                                                    <?php elseif($val['set_type'] == 2): $opt=explode(',',$val['optional']);
                                                                foreach($opt as $op):
                                                                ?>
                                                                    <div class="col-sm-1 radio radio-danger" style="float: left; ">
                                                                        <input type="radio" name="<?php echo $val['en_name']; ?>"  value="<?php echo $op; ?>" <?php if($val['value']==$op): ?> checked="checked" <?php endif ?>>
                                                                        <label  >
                                                                            <?php echo $op; ?>
                                                                        </label>
                                                                    </div>
                                                                    <?php endforeach; elseif($val['set_type'] == 3):                                                                     $opt=explode(',',$val['optional']);
                                                                    $values=explode(',',$val['value']);
                                                                    foreach($opt as $op):
                                                                    ?>
                                                                    <div class="checkbox checkbox-success checkbox-inline">
                                                                        <input  type="checkbox" name="<?php echo $val['en_name']; ?>[]"  value="<?php echo $op; ?>" <?php if(in_array($op,$values)){ echo "checked='chenked'"; } ?>>
                                                                        <label > <?php echo $op; ?> </label>
                                                                    </div>
                                                                    <?php endforeach; elseif($val['set_type'] == 4): ?>
                                                                    <select class="form-control m-b" required=""  name="<?php echo $val['en_name']; ?>">
                                                                        <?php $opt=explode(',',$val['optional']);
                                                                    foreach($opt as $op):
                                                                    ?>
                                                                        <option value="<?php echo $op; ?>" <?php if($val['value']==$op): ?> selected="selected" <?php endif ?> ><?php echo $op; ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                    <?php elseif($val['set_type'] == 5): ?>
                                                                    <textarea  name="<?php echo $val['en_name']; ?>"  class="form-control" aria-required="true"><?php echo $val['value']; ?></textarea>
                                                                    <?php elseif($val['set_type'] == 6): if($val['value'] != ''): ?>
                                                                    <div class="form-group">
                                                                        <img src="/uploads/conf/<?php echo $val['value']; ?>" width="120" height="70" alt="<?php echo $val['zh_name']; ?>">
                                                                    </div>
                                                                    <?php endif; ?>
                                                                    <div class="form-group">
                                                                        <input type="file" name="<?php echo $val['en_name']; ?>" class="form-control">
                                                                    </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endif; endforeach; endif; else: echo "" ;endif; ?>

                                                </div>

                                                <div class="tab-pane" id="tab-3">

                                                    <?php if(is_array($configs) || $configs instanceof \think\Collection || $configs instanceof \think\Paginator): $i = 0; $__LIST__ = $configs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;if($val['set_lists'] == 3): ?>
                                                            <div class="form-group">
                                                                <label class="col-sm-2 control-label"><?php echo $val['zh_name']; ?></label>
                                                                <div class="col-sm-10">
                                                                    <?php if($val['set_type'] == 1): ?>
                                                                    <input type="text" name="<?php echo $val['en_name']; ?>" value="<?php echo $val['value']; ?>" class="form-control">
                                                                    <?php elseif($val['set_type'] == 2): $opt=explode(',',$val['optional']);
                                                                foreach($opt as $op):
                                                                ?>
                                                                    <div class="col-sm-1 radio radio-danger" style="float: left; ">
                                                                        <input type="radio" name="<?php echo $val['en_name']; ?>"  value="<?php echo $op; ?>" <?php if($val['value']==$op): ?> checked="checked" <?php endif ?>>
                                                                        <label  >
                                                                            <?php echo $op; ?>
                                                                        </label>
                                                                    </div>
                                                                    <?php endforeach; elseif($val['set_type'] == 3):                                                                     $opt=explode(',',$val['optional']);
                                                                    $values=explode(',',$val['value']);
                                                                    foreach($opt as $op):
                                                                    ?>
                                                                    <div class="checkbox checkbox-success checkbox-inline">
                                                                        <input  type="checkbox" name="<?php echo $val['en_name']; ?>[]"  value="<?php echo $op; ?>" <?php if(in_array($op,$values)){ echo "checked='chenked'"; } ?>>
                                                                        <label > <?php echo $op; ?> </label>
                                                                    </div>
                                                                    <?php endforeach; elseif($val['set_type'] == 4): ?>
                                                                    <select class="form-control m-b" required=""  name="<?php echo $val['en_name']; ?>">
                                                                        <?php $opt=explode(',',$val['optional']);
                                                                    foreach($opt as $op):
                                                                    ?>
                                                                        <option value="<?php echo $op; ?>" <?php if($val['value']==$op): ?> selected="selected" <?php endif ?> ><?php echo $op; ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                    <?php elseif($val['set_type'] == 5): ?>
                                                                    <textarea  name="<?php echo $val['en_name']; ?>"  class="form-control" aria-required="true"><?php echo $val['value']; ?></textarea>
                                                                    <?php elseif($val['set_type'] == 6): if($val['value'] != ''): ?>
                                                                    <div class="form-group">
                                                                        <img src="/uploads/conf/<?php echo $val['value']; ?>" width="120" height="70" alt="<?php echo $val['zh_name']; ?>">
                                                                    </div>
                                                                    <?php endif; ?>
                                                                    <div class="form-group">
                                                                        <input type="file" name="<?php echo $val['en_name']; ?>" class="form-control">
                                                                    </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endif; endforeach; endif; else: echo "" ;endif; ?>

                                                </div>

                                                <div class="tab-pane" id="tab-4">

                                                    <?php if(is_array($configs) || $configs instanceof \think\Collection || $configs instanceof \think\Paginator): $i = 0; $__LIST__ = $configs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;if($val['set_lists'] == 4): ?>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label"><?php echo $val['zh_name']; ?></label>
                                                        <div class="col-sm-10">
                                                            <?php if($val['set_type'] == 1): ?>
                                                            <input type="text" name="<?php echo $val['en_name']; ?>" value="<?php echo $val['value']; ?>" class="form-control">
                                                            <?php elseif($val['set_type'] == 2): $opt=explode(',',$val['optional']);
                                                                foreach($opt as $op):
                                                                ?>
                                                            <div class="col-sm-1 radio radio-danger" style="float: left; ">
                                                                <input type="radio" name="<?php echo $val['en_name']; ?>"  value="<?php echo $op; ?>" <?php if($val['value']==$op): ?> checked="checked" <?php endif ?>>
                                                                <label  >
                                                                    <?php echo $op; ?>
                                                                </label>
                                                            </div>
                                                            <?php endforeach; elseif($val['set_type'] == 3):                                                                     $opt=explode(',',$val['optional']);
                                                                    $values=explode(',',$val['value']);
                                                                    foreach($opt as $op):
                                                                    ?>
                                                            <div class="checkbox checkbox-success checkbox-inline">
                                                                <input  type="checkbox" name="<?php echo $val['en_name']; ?>[]"  value="<?php echo $op; ?>" <?php if(in_array($op,$values)){ echo "checked='chenked'"; } ?>>
                                                                <label > <?php echo $op; ?> </label>
                                                            </div>
                                                            <?php endforeach; elseif($val['set_type'] == 4): ?>
                                                            <select class="form-control m-b" required=""  name="<?php echo $val['en_name']; ?>">
                                                                <?php $opt=explode(',',$val['optional']);
                                                                    foreach($opt as $op):
                                                                    ?>
                                                                <option value="<?php echo $op; ?>" <?php if($val['value']==$op): ?> selected="selected" <?php endif ?> ><?php echo $op; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <?php elseif($val['set_type'] == 5): ?>
                                                            <textarea  name="<?php echo $val['en_name']; ?>"  class="form-control" aria-required="true"><?php echo $val['value']; ?></textarea>
                                                            <?php elseif($val['set_type'] == 6): if($val['value'] != ''): ?>
                                                            <div class="form-group">
                                                                <img src="/uploads/conf/<?php echo $val['value']; ?>" width="120" height="70" alt="<?php echo $val['zh_name']; ?>">
                                                            </div>
                                                            <?php endif; ?>
                                                            <div class="form-group">
                                                                <input type="file" name="<?php echo $val['en_name']; ?>" class="form-control">
                                                            </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>

                                                </div>

                                                <div class="tab-pane" id="tab-5">

                                                    <?php if(is_array($configs) || $configs instanceof \think\Collection || $configs instanceof \think\Paginator): $i = 0; $__LIST__ = $configs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;if($val['set_lists'] == 5): ?>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label"><?php echo $val['zh_name']; ?></label>
                                                        <div class="col-sm-10">
                                                            <?php if($val['set_type'] == 1): ?>
                                                            <input type="text" name="<?php echo $val['en_name']; ?>" value="<?php echo $val['value']; ?>" class="form-control">
                                                            <?php elseif($val['set_type'] == 2): $opt=explode(',',$val['optional']);
                                                                foreach($opt as $op):
                                                                ?>
                                                            <div class="col-sm-1 radio radio-danger" style="float: left; ">
                                                                <input type="radio" name="<?php echo $val['en_name']; ?>"  value="<?php echo $op; ?>" <?php if($val['value']==$op): ?> checked="checked" <?php endif ?>>
                                                                <label  >
                                                                    <?php echo $op; ?>
                                                                </label>
                                                            </div>
                                                            <?php endforeach; elseif($val['set_type'] == 3):                                                                     $opt=explode(',',$val['optional']);
                                                                    $values=explode(',',$val['value']);
                                                                    foreach($opt as $op):
                                                                    ?>
                                                            <div class="checkbox checkbox-success checkbox-inline">
                                                                <input  type="checkbox" name="<?php echo $val['en_name']; ?>[]"  value="<?php echo $op; ?>" <?php if(in_array($op,$values)){ echo "checked='chenked'"; } ?>>
                                                                <label > <?php echo $op; ?> </label>
                                                            </div>
                                                            <?php endforeach; elseif($val['set_type'] == 4): ?>
                                                            <select class="form-control m-b" required=""  name="<?php echo $val['en_name']; ?>">
                                                                <?php $opt=explode(',',$val['optional']);
                                                                    foreach($opt as $op):
                                                                    ?>
                                                                <option value="<?php echo $op; ?>" <?php if($val['value']==$op): ?> selected="selected" <?php endif ?> ><?php echo $op; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <?php elseif($val['set_type'] == 5): ?>
                                                            <textarea  name="<?php echo $val['en_name']; ?>"  class="form-control" aria-required="true"><?php echo $val['value']; ?></textarea>
                                                            <?php elseif($val['set_type'] == 6): if($val['value'] != ''): ?>
                                                            <div class="form-group">
                                                                <img src="/uploads/conf/<?php echo $val['value']; ?>" width="120" height="70" alt="<?php echo $val['zh_name']; ?>">
                                                            </div>
                                                            <?php endif; ?>
                                                            <div class="form-group">
                                                                <input type="file" name="<?php echo $val['en_name']; ?>" class="form-control">
                                                            </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>

                                                </div>

                                                <div class="tab-pane" id="tab-6">

                                                    <?php if(is_array($configs) || $configs instanceof \think\Collection || $configs instanceof \think\Paginator): $i = 0; $__LIST__ = $configs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;if($val['set_lists'] == 6): ?>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label"><?php echo $val['zh_name']; ?></label>
                                                        <div class="col-sm-10">
                                                            <?php if($val['set_type'] == 1): ?>
                                                            <input type="text" name="<?php echo $val['en_name']; ?>" value="<?php echo $val['value']; ?>" class="form-control">
                                                            <?php elseif($val['set_type'] == 2): $opt=explode(',',$val['optional']);
                                                                foreach($opt as $op):
                                                                ?>
                                                            <div class="col-sm-1 radio radio-danger" style="float: left; ">
                                                                <input type="radio" name="<?php echo $val['en_name']; ?>"  value="<?php echo $op; ?>" <?php if($val['value']==$op): ?> checked="checked" <?php endif ?>>
                                                                <label  >
                                                                    <?php echo $op; ?>
                                                                </label>
                                                            </div>
                                                            <?php endforeach; elseif($val['set_type'] == 3):                                                                     $opt=explode(',',$val['optional']);
                                                                    $values=explode(',',$val['value']);
                                                                    foreach($opt as $op):
                                                                    ?>
                                                            <div class="checkbox checkbox-success checkbox-inline">
                                                                <input  type="checkbox" name="<?php echo $val['en_name']; ?>[]"  value="<?php echo $op; ?>" <?php if(in_array($op,$values)){ echo "checked='chenked'"; } ?>>
                                                                <label > <?php echo $op; ?> </label>
                                                            </div>
                                                            <?php endforeach; elseif($val['set_type'] == 4): ?>
                                                            <select class="form-control m-b" required=""  name="<?php echo $val['en_name']; ?>">
                                                                <?php $opt=explode(',',$val['optional']);
                                                                    foreach($opt as $op):
                                                                    ?>
                                                                <option value="<?php echo $op; ?>" <?php if($val['value']==$op): ?> selected="selected" <?php endif ?> ><?php echo $op; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <?php elseif($val['set_type'] == 5): ?>
                                                            <textarea  name="<?php echo $val['en_name']; ?>"  class="form-control" aria-required="true"><?php echo $val['value']; ?></textarea>
                                                            <?php elseif($val['set_type'] == 6): if($val['value'] != ''): ?>
                                                            <div class="form-group">
                                                                <img src="/uploads/conf/<?php echo $val['value']; ?>" width="120" height="70" alt="<?php echo $val['zh_name']; ?>">
                                                            </div>
                                                            <?php endif; ?>
                                                            <div class="form-group">
                                                                <input type="file" name="<?php echo $val['en_name']; ?>" class="form-control">
                                                            </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>

                                                </div>
                                            </div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <div class="col-sm-3 col-sm-offset-2">
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
                </div>
            </div>
        </div>
    </div>
    <!-- 全局js -->
    <script src="/HRsystem/public/static/admin/js/jquery.min.js?v=2.1.4"></script>
    <script src="/HRsystem/public/static/admin/js/bootstrap.min.js?v=3.3.6"></script>
    <!-- 自定义js -->
    <script src="/HRsystem/public/static/admin/js/content.js?v=1.0.0"></script>
</body>

</html>
