<?php


namespace app\admin\controller;

use app\admin\model\Admin as Admins;
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

}