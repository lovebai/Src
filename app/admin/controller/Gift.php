<?php


namespace app\admin\controller;


use think\facade\View;

class Gift
{
    //活动列表
    public function list(){
//        return '111';
        return View::fetch('/giftlist');
    }

    //添加活动
    public function add(){
        return View::fetch('/giftadd');
    }


}