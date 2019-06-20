<?php
namespace app\admin\controller;
use think\Db;
use think\Loader;

class Bak extends Common
{
    public function bak()
    {
        $type=input("tp");
        $name=input("name");
        $sql=new \org\Baksql(\think\Config::get("database"));
        switch ($type)
        {
            case "backup": //备份
                $this->success($sql->backup());
                break;
            case "dowonload": //下载
                $this->success($sql->downloadFile($name));
                break;
            case "restore": //还原
                $this->success($sql->restore($name));
                break;
            case "del": //删除
                $this->success($sql->delfilename($name));
                break;
            default: //获取备份文件列表
                return $this->fetch("bak",["list"=>$sql->get_filelist()]);
        }

    }
}