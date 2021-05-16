<?php


namespace app\admin\controller;


use app\admin\model\Posts;
use think\facade\Request;
use think\facade\View;

class Post extends Base
{
    //添加文章
    public function addPost(){
        $post=Request::param(['title','author','date','sort_id','type','top','tags','views','hide','password','content']);
        if($post!=''&&!empty($post)&&Request::isAjax()){
            if(Posts::name('posts')->insert($post)){

                return $this->create_return([],200,'恭喜发布成功！',1,'json');

            }else{
                return $this->create_return([],201,'发布失败,！',0,'json');

            }
        }else{
            return View::fetch('postadd');
        }

    }
    //文章列表
    public function index(){
        if(!empty(Request::param())&&Request::isAjax()&&Request::has('limit')){
            $limit=Request::post("limit");
            if($limit!=''){
                $list=Posts::name('posts')->paginate($limit);
            }else{
                return $this->create_return([],201,'error',0,'json');
            }
            $count=Posts::name('posts')->select()->count();

            return $this->create_return($list,200,'success',$count,'json');
        }else{
            return View::fetch('postlist');
        }
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