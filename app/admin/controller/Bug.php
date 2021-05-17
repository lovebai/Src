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
            $bugList=Bugb::name('bug')->order('gid','desc')->paginate($limit);
        }else{
            return $this->create_return(false,201,'error',0,'json');
        }
        $count=Bugb::name('bug')->select()->count();

        return $this->create_return($bugList,200,'success',$count,'json');
    }

    public function see(){

        return View::fetch('bugsee');
    }

    public function edit(){

    }

    public function del(){
        $id=Request::post('id');
        if($id!=''&&!empty($id)&&Request::isAjax()&&Request::has('id')){
            if(Bugb::name('bug')->where('gid',$id)->delete()){
                return $this->create_return([],200,'恭喜您删除成功！',1,'json');
            }else{
                return $this->create_return([],203,'删除失败！',0,'json');
            }
        }else{
            return $this->create_return([],201,'提交参数有误！',0,'json');
        }
    }

    public function category(){
        if(!empty(Request::param())&&Request::isAjax()&&Request::has('limit')){
            $limit=Request::post("limit");
            if($limit!=''){
                $list=Bugb::name('bugcg')->paginate($limit);
            }else{
                return $this->create_return(false,201,'error',0,'json');
            }
            $count=Bugb::name('bugcg')->select()->count();

            return $this->create_return($list,200,'success',$count,'json');
        }else{
            return View::fetch('category');
        }
    }

}