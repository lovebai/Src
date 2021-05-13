<?php


namespace app\admin\controller;


use think\facade\View;

class Admin
{
    //添加后台用户
    public function add(){
        return View::fetch('/adminadd');
    }

    //后台管理员列表
    public function list(){
        return View::fetch('/adminlist');
    }

}