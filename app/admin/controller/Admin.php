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
        return View::fetch('/adminadd');
    }

    //后台管理员列表
    public function list(){
        return View::fetch('/adminlist');
    }

    //列表数据
    public function datalist(){
        $limit=Request::post("limit");
        if($limit!=''){
            $bugList=Admins::name('admin')->paginate($limit);
        }else{
            return $this->create_return([],201,'error',0,'json');
        }
        $count=Admins::name('admin')->select()->count();

        return $this->create_return($bugList,200,'success',$count+1,'json');
    }

    //添加用户数据
    public function in(){
        $info=Request::param(['username','password','status','qq','avatar']);
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
            if(Admins::name('admin')->insert($info)){

                return $this->create_return([],200,'恭喜您管理员添加成功！',1,'json');

            }else{
                return $this->create_return([],201,'管理员添加失败,！',0,'json');

            }
        }else{
            return $this->create_return([],204,'未传参数',0,'json');
        }
    }

}