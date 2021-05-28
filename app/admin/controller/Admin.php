<?php


namespace app\admin\controller;

use app\admin\model\Admin as Admins;
use think\exception\ErrorException;
use think\facade\View;
use think\facade\Request;

class Admin extends Base
{
    //添加后台用户
    public function add(){
        return View::fetch('adminadd');
    }

    //后台管理员列表
    public function list(){
        return View::fetch('adminlist');
    }

    //列表数据
    public function datalist(){
        $limit=Request::post("limit");
        if($limit!=''){
            $bugList=Admins::name('admin')->order('id','desc')->paginate($limit);
        }else{
            return $this->create_return([],201,'error',0,'json');
        }
        $count=Admins::name('admin')->select()->count();

        return $this->create_return($bugList,200,'success',$count,'json');
    }

    //添加用户数据
    public function in(){
        $info=Request::param(['username','password','status','qq','avatar','name']);
        if($info!=''&&!empty($info)&&Request::isAjax()){
            try {
                if (!empty(Request::post('status'))) {
                    $info['status']=1;
                } else {
                    $info['status']=0;
                }

            }catch (ErrorException $e){
                return $this->create_return([],400,'Error！',0,'json');
            }
            $info['password']=$this->passAdmin($info['password']);
            if(Admins::name('admin')->insert($info)){

                return $this->create_return(true,200,'恭喜您管理员添加成功！',1,'json');

            }else{
                return $this->create_return(false,201,'管理员添加失败,！',0,'json');

            }
        }else{
            return $this->create_return([],204,'未传参数',0,'json');
        }
    }

    //编辑
    public function edit(){
        $id=Request::get('id');
        if($id!=''&&!empty($id)&&Request::has('id')){
            $info=Admins::name('admin')->where('id',$id)->find();
            $info['password']='';

            return View::fetch('adminedit',[
                'info'=>$info,
                'status'=>$info->getData('status')
            ]);

        }else{
            return "error";
        }

    }

    public function update(){
        $info=Request::param(['id','username','password','status','qq','avatar','name']);
        if($info!=''&&!empty($info)&&Request::isAjax()){
            if($info['username']==$info['password']){
                return $this->create_return(false,201,'用户名和密码不能设置相同的',0,'json');
            }
            try {
                if (!empty(Request::post('status'))) {
                    $info['status']=1;
                } else {
                    $info['status']=0;
                }

            }catch (ErrorException $e){
                return $this->create_return(false,400,'Error！',1,'json');
            }
            if($info['password']!=''){
                $info['password']=$this->passAdmin($info['password']);
            }else{
                $data=Admins::name('admin')->where('id',$info['id'])->find();
                $info['password']=$data['password'];
            }
            if(Admins::name('admin')->where('id',$info['id'])->update($info)){

                return $this->create_return(true,200,'恭喜您修改成功了',1,'json');

            }else{
                return $this->create_return(false,201,'修改失败',0,'json');

            }
        }else{
            return $this->create_return(false,204,'未传参数',0,'json');
        }
    }

    //删除

    public function del(){
        $id=Request::post('id');
        if($id!=''&&!empty($id)&&Request::isAjax()&&Request::has('id')){
            if(Admins::name('admin')->where('id',$id)->delete()){
                return $this->create_return([],200,'恭喜您删除成功！',1,'json');
            }else{
                return $this->create_return([],203,'删除失败！',0,'json');
            }
        }else{
            return $this->create_return([],201,'提交参数有误！',0,'json');
        }
    }
}