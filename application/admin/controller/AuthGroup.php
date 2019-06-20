<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Loader;

class AuthGroup extends Common
{
    public function lists(){
        $groupRes=db('authGroup')->paginate(10);
        $this->assign([
            'groupRes'=>$groupRes,
        ]);
        return view();
    }

    //开启与关闭用户组状态
    public function status()
    {
        if(request()->isAjax()) {
            $id = input('id');
            $data = db('authGroup')->where('id', $id)->field('status')->find($id);
            $status = $data['status'];
            if ($status == 0) {
                db('authGroup')->where('id', $id)->update(['status' => 1]);
                echo 1;
            } else {
                db('authGroup')->where('id', $id)->update(['status' => 0]);
                echo 0;
            }
        }
        else
            $this->error("警告：非法访问！",url('lists'));
    }
    //权限分配
    public function power($id)
    {
        if(request()->isPost())
        {
            $data=input('post.');
            if(isset($data['rules']))
            {
                $rules=implode(",",$data['rules']);
                db('authGroup')->where(['id'=>$id])->update(['rules'=>$rules])> 0 ?
                    $this->success("分配权限成功！",url('lists')) :
                    $this->error("分配权限失败！");
            }else
                $this->error("请选择权限后在提交！");
            return;
        }
        $data=db('authRule')->where(['pid'=>0])->order('sort asc')->select();
        foreach ($data as $k=>$v)
        {
            $data[$k]['children']=db('authRule')->where(['pid'=>$v['id']])->order('sort asc')->select();
            foreach ($data[$k]['children'] as $k1=>$v1)
            {
                $data[$k]['children'][$k1]['children']=db('authRule')->where(['pid'=>$v1['id']])->order('sort asc')->select();
            }
        }
        $groupRes=db('authGroup')->find($id);
        $rules=explode(",",$groupRes['rules']);
        $this->assign([
            'groupRes'=>$groupRes,
            'data'=>$data,
            'rules'=>$rules,
        ]);
        return view();
    }

    public function add()
    {
        if(request()->isPost())
        {
            $data=input('post.');
            $validate=validate('authGroup');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            db('authGroup')->insert($data) > 0 ? $this->success("添加用户组成功！",url('lists')) : $this->error("添加用户组失败！");
            return;
        }
        return view();
    }

    public function edit($id){
        if(request()->isPost())
        {
            $data=input('post.');
            $data['id']=$id;//此处需要把ID加入进去，否则编辑验证的时候会判断自身值是否存在
            $validate=validate('authGroup');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
            db('authGroup')->where(['id'=>$id])->update(input('post.')) > 0 ? $this->success("编辑用户组成功！",url('lists')) : $this->error("编辑用户组失败！");
            return;
        }
        $groupRes=db('authGroup')->find($id);
        $this->assign([
            'groupRes'=>$groupRes,
        ]);
        return view();
    }
    //删除规则，采用AJAX执行
    public function del($id)
    {
        if(request()->isAjax()){
            //同时删除该组的管理员以及auth_group_access表中的对应关系
            $admin=db('admin')->where(['groupid'=>$id])->delete();
            $authGroupAccess=db('auth_group_access')->where(['group_id'=>$id])->delete();
            $authGroup=db('authGroup')->delete($id);
            if($authGroup && $admin && $authGroup)
                echo 1;
            else
                echo 0;
        }
        else
            $this->error("非法访问！！！");
    }
}