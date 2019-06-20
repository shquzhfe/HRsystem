<?php
namespace app\admin\controller;
use think\Db;
use think\Loader;
class Conf extends Common
{
    public function configs()
    {
        if(request()->isPost()){
            $data=input('post.');
            //查找数据库中的所有字段
            $en_names=db('conf')->column('en_name');
            //这里查找附件英文字段
            $img_fields=db('conf')->where('set_type',6)->column('en_name');
            $conf_ennames=array();
            foreach ($data as $k=>$v){
                $conf_ennames[]=$k;
                if(is_array($v)){
                    $v=implode(',',$v);
                }
                db('conf')->where('en_name',$k)->update(['value'=>$v]);
            }
            //处理复选框并且排除附件
            foreach ($en_names as $k=>$v) {
                if(!in_array($v,$conf_ennames) && !in_array($v,$img_fields)){
                    db('conf')->where('en_name',$v)->update(['value'=>'']);
                }
            }
            //附件类型的处理Strat:
            foreach ($img_fields as $k=>$v) {
                if($_FILES[$v]['tmp_name']){
                    $file=request()->file($v); //执行上传图片
                    $info=$file->move(ROOT_PATH.'public/uploads/conf'); //移动图片
                    $imgSrc=$info->getSaveName(); //获取图片路径
                    db('conf')->where('en_name',$v)->update(['value'=>$imgSrc]);
                }
            }
            //附件类型的处理End!
            $this->success("更新成功",url('configs'));
        }

        $configs=db('conf')->order('id asc')->select();
        $this->assign("configs",$configs);
        return view();
    }
    public function lists()
    {
        $conf=db('conf')->order('id','asc')->select();
        $this->assign('conf',$conf);
        return view();
    }
    //添加操作
    public function add()
    {
        if(request()->isPost())
        {
            $data=input('post.');
            $validate=validate('conf');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            //替换中文,
            $data['optional']=str_replace("，",",",$data['optional']);
            $add=db('conf')->insert($data);
            if($add) {
                $this->success('添加配置项成功！',url('lists'));
            }else {
                $this->error('添加配置项失败！');
            }
        }
        return view();
    }
    //编辑操作
    public function edit($id)
    {
        if(request()->isPost()){
            $data=input('post.');
            $validate=Loader::validate('conf');
            //$validate=validate('conf');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
            //替换中文,
            $data['optional']=str_replace("，",",",$data['optional']);
            $edits=db('conf')->update($data);
            if($edits){
                $this->success('编辑成功',url('lists'));
            }else{
                $this->error('编辑失败');
            }
        }

        $confs=db('conf')->find($id);
        $this->assign("confs",$confs);
        return view();
    }
    //删除操作，采用AJAX执行
    public function del()
    {
        $id= input('confid');
        $del=db('conf')->delete($id);
        if($del){
            echo $del;
        }else{
            echo $del;
        }
    }

    public function clearCache()
    {
       $dir=$_SERVER['DOCUMENT_ROOT']."/runtime";
       $result=$this->rrmdir($dir);
       if($result){
           $this->success("缓存清理成功！",url('Index/welcome'));
       }else{
           $this->success("缓存清理失败！",url('Index/welcome'));
       }

    }

    /*
    public function delDir($dir) {
        //打开文件目录
        $dh = opendir($dir);
        //循环读取文件
        while ($file = readdir($dh)) {
            if($file != '.' && $file != '..') {
                $fullpath = $dir . '/' . $file;

                //判断是否为目录
                if(!is_dir($fullpath)) {
                    echo $fullpath."已被删除<br>";
                    //如果不是,删除该文件
                    if(!unlink($fullpath)) {
                    }
                } else {
                    //如果是目录,递归本身删除下级目录
                    $this->delDir($fullpath);
                }
            }
        }
        //关闭目录
        closedir($dh);
    }
    */

  public function rrmdir ($dir) {
        if (is_dir($dir)) {
            $fs = array_slice(scandir($dir), 2);
            foreach ($fs as $key=> $f) {
              $path = $dir . '/' . $f;
              $save=$path;
              echo "<span style='font-size: 12px;color: #ff667d;margin-left: 20px'>" .$save."删除成功！<br /></span>";
                is_dir($path) ? $this->rrmdir($path) : unlink($path);
            }
            reset($fs);
            return rmdir($dir);
        }
    }
}
