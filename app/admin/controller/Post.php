<?php


namespace app\admin\controller;


use app\admin\model\Posts;
use think\facade\Request;
use think\facade\View;

class Post extends Base
{
    //添加文章
    public function addPost(){
        return View::fetch('postadd');

    }
    //文章列表
    public function index(){
        return View::fetch('postlist');
    }

    public function list(){

        $limit=Request::post("limit");
        if($limit!=''){
            $bugList=Posts::name('posts')->paginate($limit);
        }else{
            return $this->create_return([],201,'error',0,'json');
        }
        $count=Posts::name('posts')->select()->count();

        return $this->create_return($bugList,200,'success',$count,'json');
    }

    //详情
    public function see(){
        return View::fetch('postsee');
    }

    public function edit(){

    }

    //删除
    public function del(){
        $id=Request::post('id');
        if($id!=''&&!empty($id)&&Request::isAjax()&&Request::has('id')){
            if(Posts::name('posts')->where('gid',$id)->delete()){
                return $this->create_return([],200,'恭喜您删除成功！',1,'json');
            }else{
                return $this->create_return([],203,'删除失败！',0,'json');
            }
        }else{
            return $this->create_return([],201,'提交参数有误！',0,'json');
        }
    }

}