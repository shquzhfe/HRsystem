<?php
namespace app\admin\controller;
use think\Db;

class FactorySettings extends Common
{
    public function restoreFactorySettings()
    {
        //获得表前缀
        $prefix=config('database.prefix');

        //清空员工基本信息表
        Db::execute("TRUNCATE TABLE ".$prefix."staff");

        //清空员工培训记录表
        Db::execute("TRUNCATE TABLE ".$prefix."staff_training_record");

        //清空员工服务评价表
        Db::execute("TRUNCATE TABLE ".$prefix."staff_service_evaluation");


        //清空组织架构表
        Db::execute("TRUNCATE TABLE ".$prefix."structure");

        //清空企业信息基本表
        Db::execute("TRUNCATE TABLE ".$prefix."enterprise");

        //清空企业信息良好记录表
        Db::execute("TRUNCATE TABLE ".$prefix."enterprise_good_info");

        $this->success("初始化成功，请隐藏此操作！",'admin/Index/welcome');
    }
}
