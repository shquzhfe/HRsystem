<?php
namespace app\admin\validate;

use think\Validate;

class AuthRule extends Validate
{
    protected $rule = [
        'title'  =>  'require|unique:auth_rule',
        'name' =>  'require',
        'status' =>  'require|number',

    ];
    protected $message=[
        'title.require'=>'规则名称不能为空！',
        'title.unique'=>'规则名称已经存在！',

        'name.require'=>'规则不能为空！',

        'status.require'=>'状态不能为空！',
        'status.number'=>'状态必须为数字！',

    ];
    //验证场景
    protected $scene=[
        'add'=>['title','name','status'],
        'edit'=>['title','name','status'],
    ];
}
