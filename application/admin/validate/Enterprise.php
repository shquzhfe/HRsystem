<?php
namespace app\admin\validate;

use think\Validate;

class Enterprise extends Validate
{
    protected $rule = [
        'name'  =>  'require|unique:enterprise',
        'credit_num'=>'require|min:18|max:18',
        'legal_name'=>'require',
        'reg_capital'=>'require',
        'enter_organ'=>'require',

    ];
    protected $message=[
        'name.require'=>'企业名称不能为空！',
        'name.unique'=>'企业名称已经存在！',

        'credit_num.require'=>'信用代码不能为空！',
        'credit_num.min'=>'信用代码只能是18字符！',
        'credit_num.max'=>'信用代码不能超过18字符！',

        'legal_name.require'=>'企业法人不能为空！',

        'reg_capital.require'=>'注册资本不能为空！',

        'enter_organ.require'=>'登记机关不能为空！',
    ];

}
