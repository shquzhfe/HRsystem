<?php
namespace app\admin\controller;
use think\Db;
use think\Loader;
class Column extends Common
{
    //部门列表
    public function lists()
    {
        $prefix=config('database.prefix');
        $tableModel=$prefix."model";
        //链表查询
        $_column=db('column')->alias('a')->field('a.*,b.model_name')->join("$tableModel b","a.modelid=b.id")->order('sort asc')->select();
        $column=Loader::model('column')->catetree($_column);
        //获取模型ID
        $model=db('model')->field('id,model_name')->select();
        $this->assign(array(
            'column'=>$column,
            'model'=>$model,
        ));
        return view();
    }
    //展开与收缩
    public function isShowHidden()
    {
        $id=input('id');
        $sonIds=Loader::model('column')->childrenids($id);
        echo json_encode($sonIds);
    }
    //排序
    public function sort()
    {
        if(request()->isAjax()){
            $id= input('valid');
            $datass['sort']=input('datass');
            $sort=db('column')->where('id',$id)->update($datass);
            if($sort){
                echo 1;
            }else{
                echo 0;
            }
        }else{
            $this->error("警告：非法访问！",url('lists'));
        }
    }

    //添加部门操作
    public function add()
    {
        if(request()->isPost()){
            $data=input("post.");
            $validate=validate('column');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            $add=db('column')->insert($data);
            if($add){
                $this->success("添加部门成功",url('lists'));
            }else{
                $this->error("添加部门失败");
            }
        }
        //获取部门
        $id=input('id');
        $column=Loader::model('column')->catetreeadd();
        //获取模型ID
        $model=db('model')->field('id,model_name')->select();
        $this->assign(array(
            'id'=>$id,
            'column'=>$column,
            'model'=>$model,
        ));
        return view();
    }
    //当点击添加子部门时候获取部门的相关信息
    public function columnInfo(){
        $id=input("columnPid");
        $rs=db('column')->field('modelid,index_template,list_template,content_template')->find($id);
        echo json_encode($rs);
    }

    //编辑部门操作
    public function edit($id)
    {
        if(request()->isPost()){
            $data=input('post.');
            $_data=array();
            foreach($data as $k=>$v){
                $_data[]=$k;
            }

            $validate=validate('column');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
            if($data['id']==$data['pid']){
                $this->error("选择错误，当前与上级部门相同！");
            }
            $edit=db('column')->where('id',$id)->update($data);
            if($edit){
                $this->success("修改部门成功",url('lists'));
            }else{
                $this->error("修改部门失败");
            }
        }
        //获取部门
        $id=input('id');
        $column=Loader::model('column')->catetreeadd();
        $rs=db('column')->find($id);
        //获取模型ID
        $model=db('model')->field('id,model_name')->select();
        $this->assign(array(
            'column'=>$column,
            'model'=>$model,
            'rs'=>$rs,
        ));
        return view();
    }

    //删除部门操作，采用AJAX执行，如果为批量删除，则调用本方法
    public function del($column_all_id="")
    {
        if($column_all_id){//如果存在值，则说明是批量删除
            $columnid= $column_all_id;
        }else{
            $columnid= input('columnid');//否则是AJAX单条删除
        }
        $childrenids=Loader::model('column')->childrenids($columnid);
        $childrenids[]=$columnid;
        //删除部门及文章相关资源
        foreach ($childrenids as $k=>$v){

            $column=db('column')->find($v);

            //获取当前部门对应的模型的附加表名称
            $modelId=$column['modelid'];
            $tabName=db('model')->field('table_name')->find($modelId);
            $tableName=$tabName['table_name'];
            //删除当前部门下的文章及文章缩略图
            $artRes=db('archives')->where(['column_id'=>$v])->select();
            foreach ($artRes as $k1=>$v1){
                //删除附加表的数据
                db($tableName)->where(array('aid'=>$v1['id']))->delete();
                //删除主表中的数据，先删除主表中的缩略图片

                //删除主表中的数据
                db('archives')->delete($v1['id']);
            }
        }
        $del=db('column')->delete($childrenids);
        if(!$column_all_id){ //如果是批量删除，则无需返回AJAX值,否则需要返回AJAX值
            if($del){
                echo $del;
            }else{
                echo $del;
            }
        }
    }
    public function delall(){
        $data=input('post.');
        if(@$data['itm']){
            foreach ($data['itm'] as $k=>$v){
               $this->del($v); //调用单条删除的方法
            }
            $this->success("批量删除成功！");
        }else{
            $this->error("非法操作！");
        }
    }

}
