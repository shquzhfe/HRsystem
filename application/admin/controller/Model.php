<?php
namespace app\admin\controller;
use think\Db;
class Model extends Common
{
    //列表
    public function lists()
    {
        $model=db('model')->paginate(10);
        $prefix=config('database.prefix');
        $this->assign(array(
            'model'=>$model,
            'prefix'=>$prefix,
        ));
        return view();
    }

    //开启与关闭
    public function status()
    {
        if(request()->isAjax()) {
            $id = input('valid');
            $datass = db('model')->where('id', $id)->field('status')->find($id);
            $status = $datass['status'];
            if ($status == 0) {
                db('model')->where('id', $id)->update(['status' => 1]);
                echo 1;
            } else {
                db('model')->where('id', $id)->update(['status' => 0]);
                echo 0;
            }
        }else{
            $this->error("警告：非法访问！",url('lists'));
        }
    }
    //添加操作
    public function add()
    {
        if(request()->isPost()){
            $data=input("post.");
            $validate=validate('model');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            $add=db('model')->insert($data);
            if($add){
                $tableName=$data['table_name'];
                $tableName=config('database.prefix').$tableName;
                $sql="create table {$tableName} (aid int unsigned not null) engine=MYISAM default charset=utf8";
                Db::execute($sql);
                $this->success("添加模型成功",url('lists'));
            }else{
                $this->error("添加模型失败");
            }
        }
        return view();
    }

    //编辑栏目操作
    public function edit()
    {
        if(request()->isPost()){
            $data=input('post.');
            $validate=validate('model');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
            $oldTableName=db('model')->field('table_name')->find($data['id']);
            $oldTableName=$oldTableName['table_name'];
            if($oldTableName!=$data['table_name']){
                $prefix=config('database.prefix');
                $oldTableName=$prefix.$oldTableName;
                $tableName=$prefix.$data['table_name'];
                $sql=" alter table {$oldTableName} rename {$tableName} ";
                Db::execute($sql);
            }
            $edit=db('model')->update($data);
            if($edit){
                $this->success("修改模型成功",url('lists'));
            }else{
                $this->error("修改模型失败");
            }
        }
        //获取栏目
        $id=input('id');
        $rs=db('model')->find($id);
        $this->assign("rs",$rs);
        return view();
    }
    //删除栏目操作，采用AJAX执行
    public function del()
    {
        $modelid= input('modelid');
        $tableName=input('tableName');
        $sql="drop table {$tableName}";
        Db::execute($sql);
        $del=db('model')->delete($modelid);
        if($del){
            //这里删除数据库模型附加表
            echo $del;
        }else{
            echo $del;
        }
    }
}
