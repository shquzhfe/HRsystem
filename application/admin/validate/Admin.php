<?php
namespace app\admin\validate;

use think\Validate;

class Admin extends Validate
{
    protected $rule = [
        'uname'  =>  'require|min:3|max:20|unique:admin',
        'password' =>  'require|min:6|max:16',

    ];
    protected $message=[
        'uname.require'=>'登录账户不能为空！',
        'uname.min'=>'登录账户不能少于3位！',
        'uname.max'=>'登录账户不能超过20位！',
        'uname.unique'=>'登录账户已经存在！',

        'password.require'=>'密码不能为空！',
        'password.min'=>'密码不能少于6位！',
        'password.max'=>'密码不能超过16位！',

    ];
    //验证场景
    protected $scene=[
        //'add'=>[],
        'add'=>['uname','password'],
        'edit'=>['uname','password'=>'min:6|max:16'],
    ];
}
