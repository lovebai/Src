<?php


namespace app\admin\controller;



use app\admin\model\Option;
use think\facade\View;

class Conf extends Base
{

    //通知页
    public function sms(){
        $info=Option::name('config')->where('id',1)->find();
        return View::fetch('sms',[
            'info'=>$info
        ]);
    }


    public function mail(){
        return View::fetch('mail',[
        ]);
    }
    //通知页
    public function set1(){

    }

}