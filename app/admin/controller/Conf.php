<?php


namespace app\admin\controller;



use app\admin\model\Option;
use think\facade\View;

class Conf extends Base
{

    //通知页
    public function set(){

        $info=Option::name('config')->where('id',1)->find();
        return View::fetch('set',[
            'info'=>$info
        ]);
    }


    public function set0(){

    }
    //通知页
    public function set1(){

    }

}