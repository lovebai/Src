<?php


namespace app\admin\controller;



use think\facade\Request;
use think\facade\View;
use app\admin\model\Bug as Bugb;

class Bug extends Base
{
    public function index(){

        return View::fetch('/buglist');
    }

    public function list(){
        $limit=Request::post("limit");
        if($limit!=''){
            $bugList=Bugb::name('bug')->paginate($limit);
        }else{
            return $this->create_return([],201,'error',0,'json');
        }
        $count=Bugb::name('bug')->select()->count();

        return $this->create_return($bugList,200,'success',$count,'json');
    }
}