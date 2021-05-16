<?php


namespace app\admin\controller;



use think\facade\Request;
use think\facade\View;
use app\admin\model\Bug as Bugb;

class Bug extends Base
{
    public function index(){

        return View::fetch('buglist');
    }

    //提供数据
    public function list(){
        $limit=Request::post("limit");
        if($limit!=''){
            $bugList=Bugb::name('bug')->paginate($limit);
        }else{
            return $this->create_return([],201,'error',0,'json');
        }
        $count=Bugb::name('bug')->select()->count();

        return $this->create_return($bugList,200,'success',$count+1,'json');
    }

    public function see(){

        return View::fetch('bugsee');
    }

}