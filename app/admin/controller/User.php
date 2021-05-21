<?php


namespace app\admin\controller;


use think\exception\ErrorException;
use think\facade\Request;
use think\facade\View;
use app\admin\model\User as Users;

class User extends Base
{
    //添加用户
    public function add(){
        return View::fetch('useradd');
    }
    //用户列表
    //页面
    public function list(){
        return View::fetch('userlist');
    }
    //数据
    public function datalist(){
        $limit=Request::post("limit");
        if($limit!=''){
            $bugList=Users::name('user')->order('id','desc')->paginate($limit);
        }else{
            return $this->create_return([],201,'error',0,'json');
        }
        $count=Users::name('user')->select()->count();

        return $this->create_return($bugList,200,'success',$count,'json');
    }
    //查看用户信息
    public function see(){
        $id=Request::get('id');
        if($id!=''){
            $info=Users::name('user')->where('id',$id)->find();
            $info['password']='';
            return View::fetch('usersee',[
                'info'=>$info
            ]);

        }else{
            return "error";
        }
    }

    //编辑页面
    public function edit(){
        $id=Request::get('id');
        if($id!=''){
            $info=Users::name('user')->where('id',$id)->find();
            $info['password']='';

            return View::fetch('useredit',[
                'info'=>$info,
                'status'=>$info->getData('status')
            ]);

        }else{
            return "error";
        }
    }

    public function save(){
        $info=Request::param();
        if($info!=''&&!empty($info)&&Request::isAjax()){
            try {
                if (!empty(Request::post('status'))) {
                    $info['status']=1;
                } else {
                    $info['status']=0;
                }
                if (!empty(Request::post('gender'))) {
                    if($info['gender']=="男"){
                        $info['gender']=1;
                    }else if($info['gender']=='女'){
                        $info['gender']=0;
                    }else{
                        $info['gender']=-1;
                    }
                } else {
                    return $this->create_return([],401,'Error！',1,'json');
                }
            }catch (ErrorException $e){
                return $this->create_return([],400,'Error！',1,'json');
            }
            if($info['password']!=''){
                $info['password']=$this->passUser($info['password']);
            }else{
                $data=Users::name('user')->where('id',$info['id'])->find();
                $info['password']=$data['password'];
            }
            if(Users::name('user')->where('id',$info['id'])->strict(false)->save($info)){

                return $this->create_return([],200,'恭喜您修改成功！',1,'json');

            }else{
                return $this->create_return([],201,'修改失败,可能未修改内容或者其他原因！',0,'json');

            }
        }else{
            return $this->create_return([],204,'未传参数',0,'json');
        }
    }

    //del
    public function del(){
        $id=Request::post('id');
        if($id!=''&&!empty($id)&&Request::isAjax()){
            if(Users::name('user')->where('id',$id)->delete()){
                return $this->create_return([],200,'恭喜您删除成功！',1,'json');
            }else{
                return $this->create_return([],203,'删除失败！',0,'json');
            }
        }else{
            return $this->create_return([],201,'提交参数有误！',0,'json');
        }
    }

    //添加用户
    public function insert(){
        $info=Request::param(['username','password','phone','email','status','gender','birthday','team','wechat','qq','avatar','about']);
        if($info!=''&&!empty($info)&&Request::isAjax()){
            try {
                if (!empty(Request::post('status'))) {
                    $info['status']=1;
                } else {
                    $info['status']=0;
                }

            }catch (ErrorException $e){
                return $this->create_return([],400,'Error！',1,'json');
            }
            $info['create_date']=date("Y-m-d G:i:s",time());
            $info['password']=$this->passUser($info['password']);
            if(Users::name('user')->insert($info)){

                return $this->create_return([],200,'恭喜您用户添加成功！',1,'json');

            }else{
                return $this->create_return([],201,'用户添加失败,！',0,'json');

            }
        }else{
            return $this->create_return([],204,'未传参数',0,'json');
        }
    }



}