<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Image;
use think\Loader;

class Search extends Controller
{
    //列表
    public function __construct()
    {
        parent::__construct();//先调用父类的构造方法
        $web_title=confs('title')['title'];
        $logo=confs('logo')['logo'];
        $copyright=confs('copyright')['copyright'];
        $web_tel=confs('tel')['tel'];
        $this->assign([
            'web_title'=>$web_title,
            'logo'=>$logo,
            'copyright'=>$copyright,
            'web_tel'=>$web_tel,
        ]);
    }
    public function index()
    {
        $keywords="";
        $rs=array();
        $count=0;
        if(request()->isPost()){
            $keywords=input('keywords');
            $key=[
                '公司',
                '限公司',
                '有限公司',
                '无限公司',
                '任公司',
                '责任公司',
                '份公司',
                '股份公司',
            ];
            if(in_array($keywords,$key)){
                $words=$keywords;
                $keywords="";
                $this->error($words."范围太大,查找结果已被屏蔽",'index');
            }
            if(is_numeric($keywords)){
                $num=mb_strlen($keywords,'UTF8');
                if($num<5){
                    $this->error($keywords."范围太大,信用代码查询不得少于5位",'index');
                }
                if($num>18){
                    $this->error($keywords."错误,信用代码查询不得超过18位",'index');
                }
            }

            $rs=db('enterprise')->where('name|credit_num|legal_name','like',"%".$keywords."%")->field('id,name')->select();
            $count=count($rs);
        }
        $this->assign([
            'keywords'=>$keywords,
            'rs'=>$rs,
            'count'=>$count,
        ]);
        return view();
    }

    public function enterpriseInfo()
    {
        $id=input('id');
        $keywords=input('keywords');
        $rs=db('enterprise')->alias("a")->field("a.*,b.name as province,c.name as city,d.name as county")->
        join("common_district b","b.id=a.enterprise_province","left")->
        join("common_district c","c.id=a.enterprise_city","left")->
        join("common_district d","d.id=a.enterprise_county","left")->
        where(['a.id'=>$id])->find();
        $good_info=db('enterprise_good_info')->where(['eid'=>$id])->select();
        $this->assign([
            'rs'=>$rs,
            'good_info'=>$good_info,
            'keywords'=>$keywords,
        ]);
        return view();
    }

    //列表
    public function staff()
    {
        $keywords="";
        $rs=array();
        $count=0;
        if(request()->isPost()){
            $keywords=input('keywords');
            if(is_numeric($keywords)){
                $num=mb_strlen($keywords,'UTF8');
                if($num<5){
                    $this->error($keywords."范围太大,联系电话或身份证号查询不得少于5位",'staff');
                }
                if($num>18){
                    $this->error($keywords."查询错误，关键字不得超过18位",'staff');
                }
            }

            $rs=db('staff')->where('name|tel|id_card','like',"%".$keywords."%")->field('id,name,id_card,tel,photo,gender')->select();
            foreach($rs as $key => $val){
                $rs[$key]['id_card']=$val['id_card'][0].$val['id_card'][1].$val['id_card'][2].$val['id_card'][3].$val['id_card'][4].$val['id_card'][5]."********".$val['id_card'][14].$val['id_card'][15].$val['id_card'][16].$val['id_card'][17];
                $rs[$key]['tel']=$val['tel'][0].$val['tel'][1].$val['tel'][2]."****".$val['tel'][7].$val['tel'][8].$val['tel'][9].$val['tel'][10];
            }
            $count=count($rs);
        }
        $this->assign([
            'keywords'=>$keywords,
            'rs'=>$rs,
            'count'=>$count,
        ]);
        return view();
    }

    public function staffInfo($key="")
    {
        if($key){
            $promotions=explode('/',request()->pathinfo());
            $promotions=explode('.',$promotions[count($promotions)-1]);
            //进行账号解密
            $key=$promotions[0];
            $promotion=encryption($key,1);
            $id=db('staff')->where(['id_card'=>$promotion])->value('id');
            $keywords="";
        }else{
            $id=input('id');
            $keywords=input('keywords');
        }
        if($id<1){
            $this->error("请勿非法访问！",'index');
        }
        $rs=db('staff')->alias("a")->field("a.*,b.name as province,c.name as city,d.name as county")->
        join("common_district b","b.id=a.native_province","left")->
        join("common_district c","c.id=a.native_city","left")->
        join("common_district d","d.id=a.native_county","left")->
        where(['a.id'=>$id])->find();
        $rs['tel']=$rs['tel'][0].$rs['tel'][1].$rs['tel'][2]."****".$rs['tel'][7].$rs['tel'][8].$rs['tel'][9].$rs['tel'][10];
        $rs['id_card']=$rs['id_card'][0].$rs['id_card'][1].$rs['id_card'][2].$rs['id_card'][3].$rs['id_card'][4].$rs['id_card'][5]."********".$rs['id_card'][14].$rs['id_card'][15].$rs['id_card'][16].$rs['id_card'][17];

        $service_evaluation=db('staff_service_evaluation')->where(['sid'=>$id])->select();
        $training_record=db('staff_training_record')->where(['sid'=>$id])->select();
        $this->assign([
            'rs'=>$rs,
            'service_evaluation'=>$service_evaluation,
            'training_record'=>$training_record,
            'keywords'=>$keywords,
            'key'=>$key,
        ]);
        return view();
    }

}
