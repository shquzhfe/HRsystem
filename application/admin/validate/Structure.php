<?php
namespace app\admin\validate;

use think\Validate;

class Structure extends Validate
{
    protected $rule = [
        'typename'  =>  'require|max:30',

    ];
    protected $message=[
        'typename.require'=>'组织名称不能为空！',
        'typename.max'=>'组织名称不能超过30位！',
    ];
    //验证场景
    protected $scene=[
        //'add'=>[],
        'add'=>['typename'],
        'edit'=>['typename'],
    ];
}
