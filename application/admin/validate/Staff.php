<?php
namespace app\admin\validate;

use think\Validate;

class Staff extends Validate
{
    protected $rule = [
        'name'  =>  'require|min:2|max:20',
        'birthday'=>'require|min:10|max:10',
        'id_card'=>'require|min:15|max:18|unique:staff',
        'tel'=>'require|min:8|max:15|unique:staff',
        'political'=>'require',
        'education'=>'require',
        'institution'=>'require',
        'business'=>'require',

    ];
    protected $message=[
        'name.require'=>'姓名不能为空！',
        'name.min'=>'姓名不能少于2字符！',
        'name.max'=>'姓名不能超过20字符！',

        'birthday.require'=>'生日不能为空！',
        'birthday.min'=>'生日只能是10字符！',
        'birthday.max'=>'生日只能是10字符！',

        'id_card.require'=>'身份证号码不能为空！',
        'id_card.min'=>'身份证号码介于15到18字符！',
        'id_card.max'=>'身份证号码介于15到18字符！',
        'id_card.unique'=>'身份证号码已经存在！',

        'tel.require'=>'联系电话不能为空！',
        'tel.min'=>'联系电话介于8到15字符！',
        'tel.max'=>'联系电话介于8到15字符！',
        'tel.unique'=>'联系电话已经存在！',

        'political.require'=>'政治面貌不能为空！',

        'education.require'=>'学历不能为空！',

        'institution.require'=>'所在机构不能为空！',

        'business.require'=>'职务不能为空！',
    ];

}
