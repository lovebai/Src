<?php


namespace app\admin\controller;


use app\admin\model\Config;
use think\facade\View;

class Setting
{
    public function index(){


        $info=Config::name('config')->where('id',1)->find();
        return View::fetch('/setting',[
            'info'=>$info
        ]);
    }

}