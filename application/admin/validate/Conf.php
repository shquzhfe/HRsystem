<?php
namespace app\admin\validate;

use think\Validate;

class Conf extends Validate
{
    protected $rule = [
        'zh_name'  =>  'require|min:2|max:40|unique:conf',
        'en_name' =>  'require|min:2|max:40|unique:conf',
        'set_type'=> 'require|number',
        'set_lists'=> 'require|number',
    ];
    protected $message=[
        'zh_name.require'=>'中文名称不能为空！',
        'zh_name.min'=>'中文名称不能少于2位！',
        'zh_name.max'=>'中文名称不能超过40位！',
        'zh_name.unique'=>'中文名称已经存在！',

        'en_name.require'=>'英文名称不能为空！',
        'en_name.min'=>'英文名称不能少于2位！',
        'en_name.max'=>'英文名称不能超过40位！',
        'en_name.unique'=>'英文名称已经存在！',

        'set_type.require'=>'表单类型不能为空！',
        'set_type.number'=>'表单类型必须是数字！',

        'set_lists.require'=>'配置分类不能为空！',
        'set_lists.number'=>'配置分类必须是数字！',

    ];
    //验证场景
    protected $scene=[
        //'add'=>[],
        'add'=>['zh_name','en_name','set_type','set_lists'],
        'edit'=>['zh_name','en_name'],
    ];
}
