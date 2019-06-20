<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Image;
use think\Loader;

class Content extends Common
{
    //列表
    public function lists()
    {
        $auserid=session("aid");
        $thName=db("model_fields")->field("field_cname,field_ename")->where(array('model_id'=>1))->select();

        if(session("apowers")==2){
            $artRes=db("renshi")->where("inauserid",$auserid)->select();
        }else{
            $artRes=db("renshi")->select();
        }
        $this->assign(array(
            'thName'=>$thName,
            'artRes'=>$artRes,
        ));
        return view();
    }
    //上传图片的方法
    public function upload($picName)
    {
        $file=request()->file($picName);
        $info=$file->move(ROOT_PATH.'public/uploads/content/att');
        if($info){
            return $info->getSaveName();
        }else{
            return $file->getError();
        }
    }
    //添加操作
    public function add()
    {
        $modelId=1;
        $columnId=1;
        if(request()->isPost()){
            $data=input("post.");
            $columns=array();
            $tableName=config('database.prefix')."archives";
            $_columns=Db::query("SHOW COLUMNS FROM {$tableName}");
            foreach ($_columns as $v) {
                $columns[]=$v['Field'];
            }
            $archives=array();//主表
            $addtable=array();//附加表
            foreach ($data as $k=>$v) {
                if(in_array($k,$columns)){
                    if(is_array($v)){
                        $v=implode(',',$v);
                    }
                    $archives[$k]=$v;
                }else{
                    if(is_array($v)){
                        $v=implode(',',$v);
                    }
                    $addtable[$k]=$v;
                }
            }
            //自定义图片的处理,附加表单图或者多图上传
            if($_FILES){
                foreach ($_FILES as $k=>$v) {
                    if($v['name']!=""){
                        $addtable[$k]=$this->upload($k);
                    }
                }
            }

            //通过模型ID获取附加表的名称
            $_table=db('model')->field('table_name')->find($modelId);
            $table=$_table['table_name'];
            //附表数据添加
            $addtable["ruzhidate"]=input("ruzhidate");
            $addtable["inauserid"]=session("aid");
            $_addTable=db($table)->insert($addtable);

            if($_addTable){
                $this->success('添加员工信息成功',url('lists'));
            }else{
                $this->error('添加员工信息失败');
            }
        }
        $column=Loader::model('column')->catetreeadd();
        //获取当前模型自定义字段
        $diyFields=db('model_fields')->where(['model_id'=>$modelId])->select();
        //获取当前模型长文本类型
        $longTextFields=db('model_fields')->where(['model_id'=>$modelId,'field_type'=>9])->select();
        $this->assign(array(
            'column'=>$column,
            'modelId'=>$modelId,
            'columnId'=>$columnId,
            'diyFields'=>$diyFields,
            'longTextFields'=>$longTextFields,
        ));
        return view();
    }

    //编辑栏目操作
    public function edit()
    {
        //获取栏目
        $modelId=1;
        $artId=input('aid');
        if(!$modelId){
            $modelId=0;
        }
        //通过模型ID获取附加表
        $modes=db('model')->field('table_name')->find($modelId);
        $tableName=$modes['table_name'];
        if(request()->isPost()){
            $data=input('post.');
            $columns=array();
            $mainTableName=config('database.prefix')."archives";
            $_columns=Db::query("SHOW COLUMNS FROM {$mainTableName}");
            foreach ($_columns as $v) {
                $columns[]=$v['Field'];
            }
            $archives=array();//主表
            $addtable=array();//附加表
            foreach ($data as $k=>$v) {
                if(in_array($k,$columns)){
                    if(is_array($v)){
                        $v=implode(',',$v);
                    }
                    $archives[$k]=$v;
                }else{
                    if(is_array($v)){
                        $v=implode(',',$v);
                    }
                    $addtable[$k]=$v;
                }
            }
            //自定义图片的处理,附加表单图或者多图上传
            if($_FILES){
                foreach ($_FILES as $k=>$v) {
                    if($v['name']!=""){
                        $addtable[$k]=$this->upload($k);
                    }
                }
            }
            $addtable["ruzhidate"]=input("ruzhidate");
            $saveAddtable=db($tableName)->where(array('aid'=>$artId))->update($addtable);
            if($saveAddtable){
                $this->success("修改员工信息成功",url('lists'));
            }else{
                $this->error("修改员工信息失败");
            }
        }
        //附加表数据
        $diyvals=db($tableName)->where(array('aid'=>$artId))->find();
        //主表数据
        $arts=db('archives')->find($artId);
        $column=Loader::model('column')->catetreeadd();
        //获取当前模型自定义字段
        $diyFields=db('model_fields')->where(['model_id'=>$modelId])->select();
        //获取当前模型长文本类型
        $longTextFields=db('model_fields')->where(['model_id'=>$modelId,'field_type'=>9])->select();
        $this->assign(array(
            'column'=>$column,
            'modelId'=>$modelId,
            'columnId'=>$arts['column_id'],
            'diyFields'=>$diyFields,
            'longTextFields'=>$longTextFields,
            'arts'=>$arts,
            'aid'=>$artId,
            'diyvals'=>$diyvals,
        ));

        return view();
    }

    //AJAX上传图片并生成缩略图
    public function upimg(){
        $file=request()->file('img'); //执行上传图片
        $info=$file->move(ROOT_PATH.'public/uploads/content'); //移动图片
        if($info){
            //缩略图是否开启
            if($this->config['thumb']=='开启'){
                //获取图片完整路径
                $imgSrc=UPLOADS.'/content/'.$info->getSaveName();
                //打开图片
                $img=Image::open($imgSrc);
                //缩略图的剪裁方式
                switch ($this->config['thumb_cut']){
                    case "等比例":
                        $thumb_cut_int=1;
                        break;
                    case "缩放后填充":
                        $thumb_cut_int=2;
                        break;
                    case "居中裁剪":
                        $thumb_cut_int=3;
                        break;
                    case "左上角裁剪":
                        $thumb_cut_int=4;
                        break;
                    case "右下角裁剪":
                        $thumb_cut_int=5;
                        break;
                    case "固定尺寸":
                        $thumb_cut_int=6;
                        break;
                    default:
                        $thumb_cut_int=1;
                        break;
                }
                //水印是否开启
                if($this->config['warter']=='开启'){
                    //水印位置
                    switch ($this->config['warter_position']){
                        case "左上角":
                            $position_int=1;
                            break;
                        case "上居中":
                            $position_int=2;
                            break;
                        case "右上角":
                            $position_int=3;
                            break;
                        case "左居中":
                            $position_int=4;
                            break;
                        case "居中":
                            $position_int=5;
                            break;
                        case "右居中":
                            $position_int=6;
                            break;
                        case "左下角":
                            $position_int=7;
                            break;
                        case "下居中":
                            $position_int=8;
                            break;
                        case "右下角":
                            $position_int=9;
                            break;
                        default:
                            $position_int=9;
                            break;
                    }
                    //水印类型是图片还是文字
                    if($this->config['warter_type']=='图片水印'){
                        //生成缩略图并添加图片水印
                        $warter_img=UPLOADS.'/conf/'.$this->config['warter_img'];
                        //透明度
                        $alpha=$this->config['warter_alpha'];

                        $img->thumb($this->config['thumb_width'],$this->config['thumb_height'],$thumb_cut_int)->water($warter_img,$position_int,$alpha)->save($imgSrc);
                    }else{
                        $warter_text=$this->config['warter_text'];
                        $warter_text_fontsize=$this->config['warter_text_fontsize'];
                        $warter_text_color=$this->config['warter_text_color'];
                        $font=ROOT_PATH.'public/fonts/minijianxuefeng.ttf';
                        $img->thumb($this->config['thumb_width'],$this->config['thumb_height'])->text($warter_text,$font,$warter_text_fontsize,$warter_text_color,$position_int)->save($imgSrc);
                    }
                }else{
                    $img->thumb($this->config['thumb_width'],$this->config['thumb_height'],$thumb_cut_int)->save($imgSrc);
                }
            }
            //获取数据库存放的图片路径
            echo $info->getSaveName();
        }else{
            //返回错误信息
            echo $file->getError();
        }
    }
    //AJAX撤销图片,主表缩略图
    public function delimg()
    {
        $id=input('archivesId');
        $imgUrl= input('imgSrc');
        $imgUrlS=UPLOADS.'/content/'.$imgUrl;
        $result=@unlink($imgUrlS);
        if($id){
            db('archives')->where('id',$id)->setField('litpic','');
        }
        if($result){
            echo 1;
        }else{
            echo 2;
        }
    }
    //AJAX删除自定义的图片，附表
    public function delimgs()
    {
        $aid=input('aid');
        $modelId=input('modelId');
        $fieldName=input('field_name');
        $models=db('model')->find($modelId);
        $tableName=$models['table_name'];
        //获取自定义数据表中自定义字段的图片路径
        $imgUrl=db($tableName)->where(array('aid'=>$aid))->find();
        $imgUrl=$imgUrl[$fieldName];
        $save=db($tableName)->where(array('aid'=>$aid))->setField($fieldName,'');
        if($save){
            $imgAllUrl=UPLOADS."/content/att/".$imgUrl;
            @unlink($imgAllUrl);
            echo 1;
        }else{
            echo 2;
        }
    }

    //删除栏目操作，采用AJAX执行
    public function del()
    {
        $id= input('aid');
        $name=db("renshi")->where("aid",$id)->field("name")->find();
        $name=$name['name'];
        $gongzi=db("gongzi")->where("hr_name",$name)->field("aid")->select();
        foreach ($gongzi as $v){
            $del=db("gongzi")->where("aid",$v['aid'])->delete();
        }
        $del_diyTable=db('renshi')->where(array('aid'=>$id))->delete();
        if($del_diyTable || $del){
            echo 1;
        }else{
            echo 0;
        }
    }
}
