<?php
namespace app\admin\controller;
use think\Db;
use think\Loader;
class ModelFields extends Common
{
    //字段列表
    public function lists()
    {
        $tableModel=config('database.prefix')."model";
        $model_id=input('model_id');
        if($model_id){
            $map['a.model_id']=$model_id;
        }else{
            $map=1;
        }
        $modelfields=db('model_fields')->alias('a')->where($map)->field('a.*,b.model_name')->join("$tableModel b","a.model_id=b.id")->paginate(10);
        $this->assign(array(
            'modelfields'=>$modelfields,
        ));
        return view();
    }


    //添加操作
    public function add()
    {
        if(request()->isPost()){
            $data=input("post.");
            $validate=validate('model_fields');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            $tableName=db('model')->where(['id'=>$data['model_id']])->column('table_name');
            $tableName=config('database.prefix').$tableName[0];
            //过滤可选值中文的，
            $data['field_values']=str_replace('，',',',$data['field_values']);
            $add=db('model_fields')->insert($data);
            if($add){
                switch ($data['field_type']){
                    case 1:
                    case 2:
                    case 3:
                    case 4:
                    case 6:
                        $fileType='varchar(150) not null default ""';
                        break;
                    case 5:
                        $fileType='varchar(600) not null default ""';
                        break;
                    case 7:
                        $fileType='float not null default "0.0"';
                        break;
                    case 8:
                        $fileType='int not null default "0"';
                        break;
                    case 9:
                        $fileType='longtext';
                        break;
                    default:
                        $fileType='varchar(150) not null default ""';
                        break;
                }
                $sql="alter table {$tableName} add {$data['field_ename']} {$fileType}";
                Db::execute($sql);
                $this->success("添加字段成功",url('lists'));
            }else{
                $this->error("添加字段失败");
            }
        }
        $model=db('model')->field("id,model_name")->select();
        $this->assign("model",$model);
        return view();
    }

    //编辑操作
    public function edit()
    {
        if(request()->isPost()){
            $data=input('post.');
            $validate=validate('model_fields');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
            $id=$data['id'];
            $prefix=config('database.prefix');
            $modelTableName=$prefix."model";
            //链表查询
            $fieldsInfo=db('model_fields')->alias('a')->field('a.field_ename,b.table_name')->join("$modelTableName b", 'a.model_id =b.id')->find($id);
            //需要修改的表名
            $tableName=$prefix.$fieldsInfo['table_name'];
            //需要修改字段的名称
            $oldfiledName=$fieldsInfo['field_ename'];
            //过滤可选值中文的，
            $data['field_values']=str_replace('，',',',$data['field_values']);
            $edit=db('model_fields')->update($data);
            if($edit){
                switch ($data['field_type']){
                    case 1:
                    case 2:
                    case 3:
                    case 4:
                    case 6:
                        $fileType='varchar(150) not null default ""';
                        break;
                    case 5:
                        $fileType='varchar(600) not null default ""';
                        break;
                    case 7:
                        $fileType='float not null default "0.0"';
                        break;
                    case 8:
                        $fileType='int not null default "0"';
                        break;
                    case 9:
                        $fileType='longtext';
                        break;
                    default:
                        $fileType='varchar(150) not null default ""';
                        break;
                }
                $sql="alter table {$tableName} change {$oldfiledName} {$data['field_ename']} {$fileType}";
                Db::execute($sql);
                $this->success("修改字段成功",url('lists'));
            }else{
                $this->error("修改字段失败");
            }
        }
        $model=db('model')->field("id,model_name")->select();
        $id=input('id');
        $rs=db('model_fields')->find($id);
        $this->assign(array(
            'model'=>$model,
            'rs'=>$rs,
        ));
        return view();
    }
    //删除栏目操作，采用AJAX执行
    public function del()
    {
        $id= input('modelFiledsid');
        $prefix=config('database.prefix');
        $modelTableName=$prefix."model";
        //链表查询
        $fieldsInfo=db('model_fields')->alias('a')->field('a.field_ename,b.table_name')->join("$modelTableName b", 'a.model_id =b.id')->find($id);
        //需要删除的表名
        $tableName=$prefix.$fieldsInfo['table_name'];
        //删除字段的名称
        $filedName=$fieldsInfo['field_ename'];
        $sql="alter table {$tableName} drop column {$filedName}";
        Db::execute($sql);
        $del=db('model_fields')->delete($id);
        if($del){
            //这里删除数据库模型附加表
            echo $del;
        }else{
            echo $del;
        }
    }
}
