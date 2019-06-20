<?php
namespace app\admin\Model;
use think\Model;
class Admin extends Model
{
    //模型读取器
    /*protected function getPasswordAttr($password,$data){
        return md5($password);
    }*/

    //密码加密
    public function pwdMd5($data)
    {
       return md5($data);
    }

    //登录
    public function login($data)
    {
        $uname=$data['uname'];
        $password=$this->pwdMd5($data['password']);
        $admins=Admin::get(['uname'=>$uname]);
        if($admins && $admins['status']!=1)
            return 0;//账户被禁用
        if($admins && $admins['status']==1)
            if($admins['password']==$password)
            {
                session('id',$admins['id']);
                cookie('id',$admins['id'],confs()['system_logout_time']*60);//900秒后不操作就退出
                session('uname',$uname);
                db('admin')->where(['uname'=>$uname])->update(['last_time'=>time()]);
                return 1;// 登录成功
            }else
                return 2;//密码错误
        if(!$admins && $admins['status']!=1)
            return -1;//账户不存在
    }

}


























