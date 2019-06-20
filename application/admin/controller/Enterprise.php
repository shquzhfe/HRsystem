<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Image;
use think\Loader;

class Enterprise extends Common
{
    //列表
    public function lists()
    {
        $rs=db('enterprise')->alias("a")->field("a.*,b.name as province,c.name as city,d.name as county")->
        join("common_district b","b.id=a.enterprise_province","left")->
        join("common_district c","c.id=a.enterprise_city","left")->
        join("common_district d","d.id=a.enterprise_county","left")->
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
            $validate=validate('enterprise');
            if(!$validate->check($data)){
                $this->error($validate->getError());
            }
            $data['found_time']=strtotime($data['found_time']);
            $data['start_time']=strtotime($data['start_time']);
            $data['end_time']=strtotime($data['end_time']);
            $data['create_time']=time();
            $data['update_time']=time();

            // 添加操作 strict(false) 过滤该表不存在的字段
            $newEId=db('enterprise')->strict(false)->insertGetId($data);
            if($newEId){
                //良好信息操作
                if(count($data['credit_info'])){
                    foreach($data['credit_info'] as $k => $v){
                        $good_info['eid']=$newEId;
                        $good_info['credit_info']=$v;
                        $good_info['honor_info']=$data['honor_info'][$k];
                        $good_info['social_info']=$data['social_info'][$k];
                        $good_info['social_org_info']=$data['social_org_info'][$k];
                        if($good_info['credit_info']!="" || $good_info['honor_info']!="" || $good_info['social_info']!="" || $good_info['social_org_info']!=""){
                            db('enterprise_good_info')->insert($good_info);
                        }
                    }
                }
                $this->success("添加企业档案成功！",'lists');
            }else{
                $this->error("添加企业档案失败！");
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
        $rs=db('enterprise')->find($id);
        $enterprise_good_info=db('enterprise_good_info')->where(['eid'=>$id])->order('id desc')->select();

        if(request()->isPost()) {
            $data = input('post.');
            $validate=validate('enterprise');
            if(!$validate->check($data)){
                $this->error($validate->getError());
            }
            $data['found_time']=strtotime($data['found_time']);
            $data['start_time']=strtotime($data['start_time']);
            $data['end_time']=strtotime($data['end_time']);
            $data['create_time']=time();
            $data['update_time']=time();

            // 更新操作 strict(false) 过滤该表不存在的字段
            $response= db('enterprise')->where(['id'=>$id])->strict(false)->update($data);

            if($response){
                //删除原来的良好信息记录
                db('enterprise_good_info')->where(['eid'=>$id])->delete();
                //新增表单提交过来的良好信息记录

                //良好信息操作
                if(count($data['credit_info'])){
                    foreach($data['credit_info'] as $k => $v){
                        $good_info['eid']=$id;
                        $good_info['credit_info']=$v;
                        $good_info['honor_info']=$data['honor_info'][$k];
                        $good_info['social_info']=$data['social_info'][$k];
                        $good_info['social_org_info']=$data['social_org_info'][$k];
                        if($good_info['credit_info']!="" || $good_info['honor_info']!="" || $good_info['social_info']!="" || $good_info['social_org_info']!=""){
                            db('enterprise_good_info')->strict(false)->insert($good_info);
                        }
                    }
                }
                $this->success("更新企业档案成功！",'lists');
            }else{
                $this->error("更新企业档案失败！");
            }
            return;
        }

        //初始化获得省份信息
        $provinceRes=$this->getCityInfo($pid=0,$level=1);

        //如果有省份信息，则调取城市
        if($rs['enterprise_province']){
            $cityRes=model('common_district')->getLevelCity($rs['enterprise_province'],2);
        }else{
            $cityRes=[];
        }

        //如果有城市信息，则调取区县
        if($rs['enterprise_city']){
            $countyRes=model('common_district')->getLevelCity($rs['enterprise_city'],3);
        }else{
            $countyRes=[];
        }
        $this->assign([
            'rs'=>$rs,
            'enterprise_good_info'=>$enterprise_good_info,
            'provinceRes'=>$provinceRes,
            'cityRes'=>$cityRes,
            'countyRes'=>$countyRes,
        ]);
        return view();
    }

    public function info()
    {
        $id=input('id');
        $encryptionUserName=encryption($id);
        $url=request()->domain()."/key/".$encryptionUserName.".jsp";
        //生成二维码
        $code=getQrcode($url);
        $rs=db('enterprise')->alias("a")->field("a.*,b.name as province,c.name as city,d.name as county")->
        join("common_district b","b.id=a.enterprise_province","left")->
        join("common_district c","c.id=a.enterprise_city","left")->
        join("common_district d","d.id=a.enterprise_county","left")->
        where(['a.id'=>$id])->find();

        $enterprise_good_info=db('enterprise_good_info')->where(['eid'=>$id])->select();

        $this->assign([
            'rs'=>$rs,
            'goodInfo'=>$enterprise_good_info,
            'code'=>$code,
        ]);
        return view();
    }

    /**
     * AJAX删除良好信息记录
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function ajaxDelGoodsInfo ()
    {
        if(request()->isAjax()){
            $id=input('id');
            $rs=db('enterprise_good_info')->delete($id);
            if($rs){
                echo 1;
            }else{
                echo 0;
            }
        }
    }



    /**
     * 删除企业档案所有信息，采用AJAX操作
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function del()
    {
        if(request()->isAjax()){
            $id= input('id');
            //删除培训记录
            db('enterprise_good_info')->where(['eid'=>$id])->delete();

            //删除主表数据，员工基本信息表
            $del=db('enterprise')->where(array('id'=>$id))->delete();
            if($del){
                echo 1; //删除成功
            }else{
                echo 0; //删除失败
            }
        }
    }
}
