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
        if(Request::has('id')&&!empty(Request::param())&&Request::param('id')!=''){
            $id=Request::param('id');
            $posts=Posts::name('posts')->where('gid',$id)->find();
            if($posts){
                return View::fetch('postsee',[
                    'post'=>$posts
                ]);
            }else{
                return $this->create_return([],203,'获取失败！',0,'json');
            }
        }else{
            return 'error';
        }
    }

    public function edit(){
        $post=Request::param(['gid','title','author','date','sort_id','type','top','tags','views','hide','password','content']);
        if($post!=''&&!empty($post)&&Request::isAjax()){
            if(Posts::name('posts')->where('gid',$post['gid'])->save($post)){

                return $this->create_return([],200,'文章编辑成功了',1,'json');

            }else{
                return $this->create_return([],201,'编辑失败了',0,'json');

            }
        }else {
            if (Request::get('id') && Request::has('id')) {
                $post = Posts::name('posts')->where('gid', Request::get('id'))->find();
                return View::fetch('edit', [
                    'post' => $post,
                    'hide' => $post->getData('hide')
                ]);
            } else {
                return redirect(url('post/index'));
            }

        }

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

    public function category(){

        return View::fetch('category');
    }



}