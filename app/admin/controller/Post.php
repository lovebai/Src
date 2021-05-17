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
                $list=Posts::name('posts')->order('gid','desc')->paginate($limit);
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
        if(!empty(Request::param())&&Request::isAjax()&&Request::has('limit')){
            $limit=Request::post("limit");
            if($limit!=''){
                $list=Posts::name('postcg')->paginate($limit);
            }else{
                return $this->create_return(false,201,'error',0,'json');
            }
            $count=Posts::name('postcg')->select()->count();

            return $this->create_return($list,200,'success',$count,'json');
        }else{
            return View::fetch('category');
        }
    }

    public function addcategory(){
        if(Request::isAjax()&&Request::has('category')){
            $data=Request::param();

            if(Posts::name('postcg')->insert($data)){
                return $this->create_return(true,200,'恭喜您分类添加成功了',1,'json');
            }else{
                return $this->create_return(false,201,'error',0,'json');
            }
        }else{
            return View::fetch('category_add');
        }
    }

    public function editcategory(){
        if(Request::get('edit_id')&&Request::has('edit_id')){
            $data=Posts::name('postcg')->where('id',Request::get('edit_id'))->find();
            if($data){
                return View::fetch('category_edit',[
                    'data'=>$data
                ]);
            }else{
                return "error";
            }
        }else if(!empty(Request::param())&&Request::isAjax()&&Request::has('category')){
            if(Posts::name('postcg')->where('id',Request::post('id'))->save(Request::param())){
                return $this->create_return(true,200,'已编辑成功',1,'json');
            }else{
                return $this->create_return(false,201,'编辑失败，可能是您未做过修改',0,'json');
            }
        }else{
            return $this->create_return(false,400,'error',0,'json');
        }
    }

    //删除分类
    public function delcategory(){
        $id=Request::post('id');
        if($id!=''&&!empty($id)&&Request::isAjax()&&Request::has('id')){
            if(Posts::name('postcg')->where('id',$id)->delete()){
                return $this->create_return([],200,'恭喜您删除成功！',1,'json');
            }else{
                return $this->create_return([],203,'删除失败！',0,'json');
            }
        }else{
            return $this->create_return([],201,'提交参数有误！',0,'json');
        }
    }



}