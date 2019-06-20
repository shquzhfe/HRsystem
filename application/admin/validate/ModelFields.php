<?php
namespace app\admin\validate;

use think\Validate;

class ModelFields extends Validate
{
    protected $rule = [
        'field_cname'  =>  'require|min:2|max:60|unique:model_fields',
        'field_ename' =>  'require|min:2|max:60|unique:model_fields',
    ];
    protected $message=[
        'field_cname.require'=>'字段中文名称不能为空！',
        'field_cname.min'=>'字段中文名称不能少于2位！',
        'field_cname.max'=>'字段中文名称不能超过60位！',
        'field_cname.unique'=>'字段中文名称已经存在！',
        'field_ename.require'=>'字段英文名称不能为空！',
        'field_ename.min'=>'字段英文名称不能少于2位！',
        'field_ename.max'=>'字段英文名称不能超过60位！',
        'field_ename.unique'=>'字段英文名称已经存在！',
    ];
    //验证场景
    protected $scene=[
        'add'=>['field_cname','field_ename'],
        'edit'=>['field_cname','field_ename'],
    ];
}
