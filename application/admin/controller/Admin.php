<?php
namespace app\admin\controller;
use think\Db;
use think\Loader;

class Admin extends Common
{
    //列表页
    public function lists(){
        $adminRes=db('admin')->alias('a')->field('a.*,b.title')->join("authGroup b","a.groupid=b.id")->paginate(8);
        $this->assign([
            'adminRes'=>$adminRes,
        ]);
        return view();
    }

    //开启与关闭管理员状态
    public function status()
    {
        if(request()->isAjax()) {
            $id = input('id');
            $data = db('admin')->where('id', $id)->field('status')->find($id);
            $status = $data['status'];
            if ($status == 0) {
                db('admin')->where('id', $id)->update(['status' => 1]);
                echo 1;
            } else {
                db('admin')->where('id', $id)->update(['status' => 0]);
                echo 0;
            }
        }else{
            $this->error("警告：非法访问！",url('lists'));
        }
    }

    //添加操作
    public function add(){
        if(request()->isPost())
        {
            $data=input('post.');
            $validate=Loader::validate('admin');
            if(!$validate->scene('add')->check($data))
               $this->error($validate->getError());
            $data['password']=model('admin')->pwdMd5($data['password']);
            $data['create_time']=time();
            $resultId=db('admin')->insertGetId($data);
            $_data=[];
            $_data['uid']=$resultId;
            $_data['group_id']=$data['groupid'];
            $authGroupAccess=db('authGroupAccess')->insert($_data);
            if($resultId && $authGroupAccess)
                $this->success("添加管理员成功",url('lists'));
            else
                $this->error("添加管理员失败");
            return;
        }
        //获取用户组
        $group=db('authGroup')->field('id,title')->select();
        $this->assign([
            'group'=>$group,
        ]);
        return view();
    }

    //编辑操作
    public function edit(){
        if(request()->isPost())
        {
            $data=input('post.');
            $validate=validate('admin');
            if(!$validate->scene('edit')->check($data))
                $this->error($validate->getError());
            if($data['password'])
                $data['password']=Loader::model('admin')->pwdMd5($data['password']);
            else
                unset($data['password']);
            $save=db('admin')->update($data);
            $authGroupAccess=db('authGroupAccess')->where(['uid'=>$data['id']])->update(['group_id'=>$data['groupid']]);
            if($save || $authGroupAccess)
                $this->success("修改成功！",url('lists'));
            else
                $this->error("修改失败！");
            return;
        }

        $admin=db('admin')->find(input('id'));
        //获取用户组
        $group=db('authGroup')->field('id,title')->select();
        $this->assign([
            'group'=>$group,
            'admin'=>$admin,
        ]);
        return view();
    }

    //删除操作，采用AJAX执行
    public function del()
    {
        if(request()->isAjax()){
            $groupAccess=db('authGroupAccess')->where(['uid'=>input('id')])->delete();
            $admin=db('admin')->delete(input('id'));
            if($groupAccess && $admin){
                echo 1;
                return;
            }
            echo 0;
        }
        else
            $this->error("非法访问！！！");
    }

    //退出登录
    public function logout()
    {
        session('id',null);
        session('uname',null);
        cookie('id',null);
        $this->success("退出成功",url('Login/index'));
    }
}