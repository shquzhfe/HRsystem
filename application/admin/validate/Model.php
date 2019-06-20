<?php
namespace app\admin\validate;

use think\Validate;

class Model extends Validate
{
    protected $rule = [
        'model_name'  =>  'require|min:2|max:50|unique:model',
        'table_name' =>  'require|min:2|max:50|unique:model',
    ];
    protected $message=[
        'model_name.require'=>'模型名称不能为空！',
        'model_name.min'=>'模型名称不能少于2位！',
        'model_name.max'=>'模型名称不能超过50位！',
        'model_name.unique'=>'模型名称已经存在！',
        'table_name.require'=>'模型附加表名称不能为空！',
        'table_name.min'=>'模型附加表名称不能少于2位！',
        'table_name.max'=>'模型附加表名称不能超过50位！',
        'table_name.unique'=>'模型附加表名称已经存在！',
    ];
    //验证场景
    protected $scene=[
        'add'=>['model_name','table_name'],
        'edit'=>['model_name','table_name'],
    ];
}
