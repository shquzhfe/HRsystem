<?php
namespace app\admin\validate;

use think\Validate;

class Column extends Validate
{
    protected $rule = [
        'typename'  =>  'require|max:30',


    ];
    protected $message=[
        'typename.require'=>'部门名称不能为空！',
        'typename.max'=>'部门名称不能超过30位！',
    ];
    //验证场景
    protected $scene=[
        //'add'=>[],
        'add'=>['typename','index_template','list_template','content_template'],
        'edit'=>['typename','index_template','list_template','content_template'],
    ];
}
