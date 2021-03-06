<?php
declare (strict_types = 1);

namespace app\api\controller;

use \app\api\model\Posts;
use think\facade\Request;

class Post extends Base
{

    //文章列表
    public function articleList(): \think\Response
    {

        $list_rows=Request::param('limit');
        $post= Posts::name('posts')->order('gid','desc')->column(['title','author','date','gid']);

        return $this->create_return($post,200,1);

    }

    //具体文章
    public function article(): \think\Response
    {
        if(Request::has('id')){
            $posts=Posts::name('posts')->where('gid',Request::param('id'))->find();
            $aa=Posts::name('postcg')->where('id',$posts['type'])->find();
            $posts['type'] = $aa['category'];
            if(!$posts){
                return $this->create_return(false,201,0,'error','json');
            }else{
                return $this->create_return($posts,200,1);
            }
        }
    }

}
