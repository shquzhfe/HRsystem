<?php
namespace app\admin\controller;

use think\Controller;

class Error extends Controller
{
    public function _empty($method){
        $siteName=$this->request->siteName;
        $siteUrl=$this->request->getSiteUrl();
        return $siteName."站点提示：您访问的控制器及".$method."方法不存在！".$siteUrl;
    }
}