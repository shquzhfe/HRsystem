<?php
namespace app\admin\controller;
use think\Db;
use think\Loader;
class Structure extends Common
{
    //组织列表
    public function lists()
    {
        $prefix=config('database.prefix');
        $tableModel=$prefix."model";
        //链表查询
        $_structure=db('structure')->alias('a')->order('sort asc')->select();
        $structure=Loader::model('structure')->catetree($_structure);

        $this->assign(array(
            'structure'=>$structure,
        ));
        return view();
    }
    //展开与收缩
    public function isShowHidden()
    {
        $id=input('id');
        $sonIds=Loader::model('structure')->childrenids($id);
        echo json_encode($sonIds);
    }
    //排序
    public function sort()
    {
        if(request()->isAjax()){
            $id= input('valid');
            $datass['sort']=input('datass');
            $sort=db('structure')->where('id',$id)->update($datass);
            if($sort){
                echo 1;
            }else{
                echo 0;
            }
        }else{
            $this->error("警告：非法访问！",url('lists'));
        }
    }

    //添加组织操作
    public function add()
    {
        if(request()->isPost()){
            $data=input("post.");
            $validate=validate('structure');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            $add=db('structure')->insert($data);
            if($add){
                $this->success("添加组织成功",url('lists'));
            }else{
                $this->error("添加组织失败");
            }
        }
        //获取组织
        $id=input('id');
        $structure=Loader::model('structure')->catetreeadd();
        //获取模型ID
        $model=db('model')->field('id,model_name')->select();
        $this->assign(array(
            'id'=>$id,
            'structure'=>$structure,
            'model'=>$model,
        ));
        return view();
    }
    //当点击添加子组织时候获取组织的相关信息
    public function structureInfo(){
        $id=input("structurePid");
        $rs=db('structure')->field('modelid,index_template,list_template,content_template')->find($id);
        echo json_encode($rs);
    }

    //编辑组织操作
    public function edit($id)
    {
        if(request()->isPost()){
            $data=input('post.');
            $_data=array();
            foreach($data as $k=>$v){
                $_data[]=$k;
            }

            $validate=validate('structure');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
            if($data['id']==$data['pid']){
                $this->error("选择错误，当前与上级组织相同！");
            }
            $edit=db('structure')->where('id',$id)->update($data);
            if($edit){
                $this->success("修改组织成功",url('lists'));
            }else{
                $this->error("修改组织失败");
            }
        }
        //获取组织
        $id=input('id');
        $structure=Loader::model('structure')->catetreeadd();
        $rs=db('structure')->find($id);
        //获取模型ID
        $model=db('model')->field('id,model_name')->select();
        $this->assign(array(
            'structure'=>$structure,
            'model'=>$model,
            'rs'=>$rs,
        ));
        return view();
    }

    //删除组织操作，采用AJAX执行，如果为批量删除，则调用本方法
    public function del($structure_all_id="")
    {
        if($structure_all_id){//如果存在值，则说明是批量删除
            $structureid= $structure_all_id;
        }else{
            $structureid= input('structureid');//否则是AJAX单条删除
        }
        $childrenids=Loader::model('structure')->childrenids($structureid);
        $childrenids[]=$structureid;
        //删除组织及文章相关资源
        foreach ($childrenids as $k=>$v){

            $structure=db('structure')->find($v);

            //获取当前组织对应的模型的附加表名称
            $modelId=$structure['modelid'];
            $tabName=db('model')->field('table_name')->find($modelId);
            $tableName=$tabName['table_name'];
            //删除当前组织下的文章及文章缩略图
            $artRes=db('archives')->where(['structure_id'=>$v])->select();
            foreach ($artRes as $k1=>$v1){
                //删除附加表的数据
                db($tableName)->where(array('aid'=>$v1['id']))->delete();
                //删除主表中的数据，先删除主表中的缩略图片

                //删除主表中的数据
                db('archives')->delete($v1['id']);
            }
        }
        $del=db('structure')->delete($childrenids);
        if(!$structure_all_id){ //如果是批量删除，则无需返回AJAX值,否则需要返回AJAX值
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
