<?php


namespace app\admin\controller;


use think\facade\Request;
use think\facade\View;
use app\admin\model\User as Users;

class User extends Base
{
    //添加用户
    public function add(){
        return View::fetch('/useradd');
    }
    //用户列表
    //页面
    public function list(){
        return View::fetch('/userlist');
    }
    //数据
    public function datalist(){
        $limit=Request::post("limit");
        if($limit!=''){
            $bugList=Users::name('user')->paginate($limit);
        }else{
            return $this->create_return([],201,'error',0,'json');
        }
        $count=Users::name('user')->select()->count();

        return $this->create_return($bugList,200,'success',$count+1,'json');
    }



}