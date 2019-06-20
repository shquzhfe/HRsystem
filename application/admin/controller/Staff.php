<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Image;
use think\Loader;

class Staff extends Common
{
    //列表
    public function lists()
    {
        $rs=db('staff')->alias("a")->field("a.*,b.name as province,c.name as city,d.name as county")->
        join("common_district b","b.id=a.native_province","left")->
        join("common_district c","c.id=a.native_city","left")->
        join("common_district d","d.id=a.native_county","left")->
        select();

        $this->assign([
            'rs'=>$rs,
        ]);
        return view();
    }
    //上传图片的方法
    public function upload($picName)
    {
        $file=request()->file($picName);
        $info=$file->move(ROOT_PATH.'public/uploads/photos');
        if($info){
            return $info->getSaveName();
        }else{
            return $file->getError();
        }
    }

    //添加操作
    public function add()
    {
        //初始化获得省份信息
        $provinceRes=$this->getCityInfo($pid=0,$level=1);
        if(request()->isPost()){
            $data=input('post.');
            $validate=validate('staff');
            if(!$validate->check($data)){
                $this->error($validate->getError());
            }
            $data['birthday']=strtotime($data['birthday']);
            $data['create_time']=time();
            $data['update_time']=time();
            if($_FILES['photo']['tmp_name']){
                $data['photo']=$this->upload('photo');
            }
            // 添加操作 strict(false) 过滤该表不存在的字段
            $newSId=db('staff')->strict(false)->insertGetId($data);

            if($newSId){
                //培训记录操作
                if($data['training_info']){
                    $tra['sid']=$newSId;
                    $tra['training_info']=$data['training_info'];
                    db('staff_training_record')->insert($tra);
                }
                if(count($data['content'])){
                    foreach($data['content'] as $k1 => $v1){
                        $service_evaluation['sid']=$newSId;
                        $service_evaluation['content']=$v1;
                        $service_evaluation['sanctions']=$data['sanctions'][$k1];
                        $service_evaluation['score']=$data['score'][$k1];
                        if($service_evaluation['content']!="" || $service_evaluation['sanctions']!="" || $service_evaluation['score']!=""){
                            db('staff_service_evaluation')->insert($service_evaluation);
                        }
                    }
                }
                $this->success("添加员工成功！",'lists');
            }else{
                $this->error("添加员工失败！");
            }
            return;
        }
        $this->assign([
            'provinceRes'=>$provinceRes,
        ]);
        return view();
    }

    //编辑栏目操作
    public function edit()
    {
        $id=input('id');
        $rs=db('staff')->find($id);
        $training=db('staff_training_record')->where(['sid'=>$id])->order('id desc')->find();
        $service_evaluation=db('staff_service_evaluation')->where(['sid'=>$id])->order('id desc')->select();
        if(request()->isPost()) {
            $data = input('post.');
            $validate=validate('staff');
            if(!$validate->check($data)){
                $this->error($validate->getError());
            }
            $data['birthday'] = strtotime($data['birthday']);
            $data['update_time'] = time();
            if ($_FILES['photo']['tmp_name']) {
                //如果上传了新的照片，则删除原来的照片
                if($rs['photo']){
                    $imgPath=UPLOADS."/photos/".$rs['photo'];
                    if(is_file($imgPath)){
                        @unlink($imgPath);
                    }
                }
                //上传新的照片
                $data['photo'] = $this->upload('photo');
            }
            // 更新操作 strict(false) 过滤该表不存在的字段
            $response= db('staff')->where(['id'=>$id])->strict(false)->update($data);

            if($response){
                //新增表单提交过来的培训记录
                if(isset($data['training_info'])){
                    if ($data['training_info']) {
                        $tra['training_info']=$data['training_info'];
                        $tra['sid']=$id;
                        db('staff_training_record')->where(['id'=>$training['id']])->update($tra);
                    }
                }

                //删除原来的服务评价记录
                db('staff_service_evaluation')->where(['sid'=>$id])->delete();
                //新增表单提交过来的服务评价记录
                if (count($data['content'])>=1) {
                    foreach ($data['content'] as $k1 => $v1) {
                        $service_evaluation['sid'] = $id;
                        $service_evaluation['content'] = $v1;
                        $service_evaluation['sanctions'] = $data['sanctions'][$k1];
                        $service_evaluation['score'] = $data['score'][$k1];
                        if ($service_evaluation['content'] != "" || $service_evaluation['sanctions'] != "" || $service_evaluation['score'] != "") {
                            db('staff_service_evaluation')->strict(false)->insert($service_evaluation);
                        }
                    }
                }
                $this->success("更新员工信息成功！",'lists');
            }else{
                $this->error("更新员工信息失败！");
            }
            return;
        }

        //初始化获得省份信息
        $provinceRes=$this->getCityInfo($pid=0,$level=1);

        //如果有省份信息，则调取城市
        if($rs['native_province']){
            $cityRes=model('common_district')->getLevelCity($rs['native_province'],2);
        }else{
            $cityRes=[];
        }

        //如果有城市信息，则调取区县
        if($rs['native_city']){
            $countyRes=model('common_district')->getLevelCity($rs['native_city'],3);
        }else{
            $countyRes=[];
        }
        $this->assign([
            'rs'=>$rs,
            'training'=>$training,
            'service_evaluation'=>$service_evaluation,
            'provinceRes'=>$provinceRes,
            'cityRes'=>$cityRes,
            'countyRes'=>$countyRes,
        ]);
        return view();
    }

    public function vitae()
    {
        $id=input('id');
        $rs=db('staff')->alias("a")->field("a.*,b.name as province,c.name as city,d.name as county")->
        join("common_district b","b.id=a.native_province","left")->
        join("common_district c","c.id=a.native_city","left")->
        join("common_district d","d.id=a.native_county","left")->
        where(['a.id'=>$id])->find();
        $age=ceil((time()-$rs['birthday'])/(86400*365));
        $training_record=db('staff_training_record')->where(['sid'=>$id])->select();
        $service_evaluation=db('staff_service_evaluation')->where(['sid'=>$id])->select();
        $encryptionUserName=encryption($rs['id_card']);
        $url=request()->domain()."/admin/search/staffInfo/key/".$encryptionUserName.".jsp";
        //生成二维码
        $code=getQrcode($url);
        $this->assign([
            'rs'=>$rs,
            'training_record'=>$training_record,
            'service_evaluation'=>$service_evaluation,
            'age'=>$age,
            'code'=>$code,
        ]);
        return view();
    }

    /**
     * AJAX删除培训记录
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function ajaxDelTraining()
    {
        if(request()->isAjax()){
            $id=input('id');
            $rs=db('staff_training_record')->delete($id);
            if($rs){
                echo 1;
            }else{
                echo 0;
            }
        }
    }

    /**
     * AJAX删除培训记录
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function ajaxDelServices()
    {
        if(request()->isAjax()){
            $id=input('id');
            $rs=db('staff_service_evaluation')->delete($id);
            if($rs){
                echo 1;
            }else{
                echo 0;
            }
        }
    }

    /**
     * 删除员工所有信息，采用AJAX操作
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function del()
    {
        if(request()->isAjax()){
            $id= input('id');
            $imgUrl=input('imgUrl');
            if($imgUrl){
                $imgPath=UPLOADS."/photos/".$imgUrl;
                if(is_file($imgPath)){
                    //删除图片
                    @unlink($imgPath);
                }
            }

            //删除培训记录
            db('staff_training_record')->where(['sid'=>$id])->delete();

            //删除服务评价记录
            db('staff_service_evaluation')->where(['sid'=>$id])->delete();

            //删除主表数据，员工基本信息表
            $del=db('staff')->where(array('id'=>$id))->delete();
            if($del){
                echo 1; //删除成功
            }else{
                echo 0; //删除失败
            }
        }
    }
}
