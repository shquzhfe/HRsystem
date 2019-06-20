<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

class Login extends Controller
{
    public $confs;
    public function index()
    {
        $this->confs=confs();
        $telSwitch=$this->confs['admin_login_switch'];
        if(request()->isPost())
        {
            $data=input('post.');
            if($telSwitch=='开启'){
                if($data['telcode']!=session('admin_mobile_code')){
                    $this->error("手机短信验证码错误！");
                }
            }
            //验证码验证
            if(!captcha_check($data['code']))
                $this->error("验证码错误！");
            //账户信息验证
            $loginStatus=model('admin')->login($data);
            if($loginStatus==-1 || $loginStatus==2)
                $this->error("账户或密码错误！");
            elseif($loginStatus==0)
                $this->error("账户已被禁用！");
            elseif($loginStatus==1)
                //$this->success("登录成功！",url('Index/index'));
                $this->redirect('Index/index');
            return;
        }
        if(session('uname') && session('id'))
            $this->redirect('Index/index');

        $this->assign(
            [
                'configs'=>$this->confs,
                'telSwitch'=>$telSwitch,
                'bgrands'=>"(".mt_rand(1,38).")",
            ]
        );
        return view('default');
    }

    //获取手机验证码的方法
    public function getTelCode()
    {
        $admins=input('uname');
        $telRes=db('admin')->where(['uname'=>$admins])->field('admin_tel')->find();
        if(!$telRes['admin_tel']){
            echo 0;
            return;
        }
        $mobile=$telRes['admin_tel'];
        if(session('admin_mobile')){
            session('admin_mobile',null);
        }
        if(session('admin_mobile_code')){
            session('admin_mobile_code',null);
        }

        //生成的随机数
        $mobile_code =random(5,1);
        //短信配置

        $response=commonSmsNotice(
            $mobile,
            "SMS_130755002",
            array(
                'code'=>$mobile_code
            )
        );
        //发送状态
        if($response['Message']=='OK'){
            //存储手机号
            session('admin_mobile',$mobile);
            //存储验证码
            session('admin_mobile_code',$mobile_code);
        }
        echo json_encode($response['Message']);
    }
}