<?php
namespace app\admin\validate;

use think\Validate;

class AuthGroup extends Validate
{
    protected $rule = [
        'title'  =>  'require|unique:auth_group',
        'status' =>  'require|number',

    ];
    protected $message=[
        'title.require'=>'用户组名不能为空！',
        'title.unique'=>'用户组名已经存在！',

        'status.require'=>'状态不能为空！',
        'status.number'=>'状态必须是数字！',

    ];
    //验证场景
    protected $scene=[
        //'add'=>[],
        'add'=>['title','status'],
        'add'=>['title','status'],
    ];
}
