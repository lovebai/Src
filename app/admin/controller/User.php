<?php


namespace app\admin\controller;



use think\facade\View;

class User
{
    //添加用户
    public function add(){
        return View::fetch('/useradd');
    }
    //用户列表
    public function list(){
        return View::fetch('/userlist');

    }
}