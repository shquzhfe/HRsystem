<?php
namespace app\admin\controller;
use nowday\Calendars;
use think\Loader;
use think\Cache;

class Index extends Common
{
    public function index()
    {
        //获取日历详细信息
        $calendars=new Calendars();
        $nowDayInfo=$calendars->nowDay();
        $this->assign([
            'nowDayInfo'=>$nowDayInfo,
        ]);
        return view();
    }
    public function welcome(){
        $url=request()->domain();
        $ip=request()->ip();
        $browser=$_SERVER['HTTP_USER_AGENT'];
        $server_software=$_SERVER['SERVER_SOFTWARE'];
        $cgi=$_SERVER['GATEWAY_INTERFACE'];
        $php_version=PHP_VERSION;
        $php_os=PHP_OS;
        $php_mysql=mysqli_get_client_info();
        $server_protocol=$_SERVER['SERVER_PROTOCOL'];
        $rs=db('about')->find(1);

        $this->assign([
            'url'=>$url,
            'ip'=>$ip,
            'browser'=>$browser,
            'server_software'=>$server_software,
            'cgi'=>$cgi,
            'php_version'=>$php_version,
            'php_os'=>$php_os,
            'php_mysql'=>$php_mysql,
            'server_protocol'=>$server_protocol,
            'rs'=>$rs
        ]);

        return $this->fetch();
    }

    public function clearCache()
    {
        Cache::clear();
        $this->success("清空缓存成功！",url('index'));
    }
}
