<?php
namespace app\admin\controller;
use think\Db;
use think\Loader;

class AuthRule extends Common
{
    public function lists(){
        $ruleRes=db('authRule')->order('sort asc')->select();
        $ruleTree=model('authRule')->ruletree($ruleRes);
        $this->assign(array(
            'ruleRes'=>$ruleTree,
        ));
        return view();
    }

    //开启与关闭规则状态
    public function status()
    {
        if(request()->isAjax()) {
            $id = input('id');
            $data = db('authRule')->where('id', $id)->field('status')->find($id);
            $status = $data['status'];
            if ($status == 0) {
                db('authRule')->where('id', $id)->update(['status' => 1]);
                echo 1;
            } else {
                db('authRule')->where('id', $id)->update(['status' => 0]);
                echo 0;
            }
        }else{
            $this->error("警告：非法访问！",url('lists'));
        }
    }

    //显示与隐藏菜单状态
    public function show()
    {
        if(request()->isAjax()) {
            $id = input('id');
            $data = db('authRule')->where('id', $id)->field('show,isshow')->find($id);
            $show = $data['show'];
            $isShow=$data['isshow'];
            if($isShow==1){
                if ($show == 0) {
                    db('authRule')->where('id', $id)->update(['show' => 1]);
                    echo 1;
                } else {
                    db('authRule')->where('id', $id)->update(['show' => 0]);
                    echo 0;
                }
            }else{
                echo -1;
            }
        }else{
            $this->error("警告：非法访问！",url('lists'));
        }
    }

    //展开与收缩
    public function isShowHidden()
    {
        $id=input('id');
        $sonIds=model('authRule')->childrenids($id);
        echo json_encode($sonIds);
    }
    //添加规则
    public function add(){
        if(request()->isPost())
        {
            $data=input('post.');
            $validate=Loader::validate('authRule');
            if(!$validate->scene('add')->check($data))
                $this->error($validate->getError());
            if($data['isshow']==0){
                $data['show']=1;
            }
            $add=db('authRule')->insert($data);
            $add>0 ? $this->success("添加规则成功！",url('lists')) : $this->error("添加规则失败！");
            return;
        }
        //调用所有的规则作为选择上级规则
        $ruleRes=db('authRule')->order('sort asc')->select();
        $ruleTree=model('authRule')->ruletree($ruleRes);
        $this->assign([
            'ruleRes'=>$ruleTree,
        ]);
        return view();
    }
    //编辑规则
    public function edit($id){
        if(request()->isPost())
        {
            $data=input('post.');
            $data['id']=$id;//此处需要把ID加入进去，否则编辑验证的时候会判断自身值是否存在
            $validate=validate('authRule');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
            if($data['isshow']==0){
                $data['show']=1;
            }
            $save=db('authRule')->where(array('id'=>$id))->update($data);
            $save>0 ? $this->success("修改规则成功！",url('lists')) : $this->error("修改规则失败！");
            return;
        }
        //调用所有的规则作为选择上级规则
        $rule=db('authRule')->find($id);
        $ruleRes=db('authRule')->select();
        $ruleTree=model('authRule')->ruletree($ruleRes);
        $this->assign([
            'ruleRes'=>$ruleTree,
            'rule'=>$rule,
        ]);
        return view();
    }

    //删除规则，采用AJAX执行
    public function del($id)
    {
        if(request()->isAjax())
        {
            //获取子级ID
            $allId=model('authRule')->childrenids($id);
            //把父级ID也加入子级ID，得到所有id
            $allId[]=(integer)$id;
            echo db('authRule')->delete($allId)> 0 ? 1 : 0;
        }
        else
            $this->error("非法访问！！！");
    }
}