<?php
declare (strict_types = 1);

namespace app\api\controller;

use \app\api\model\Posts;
use think\facade\Request;

class Post extends Base
{

    public function articleList(){
        $post=Posts::name('posts')->select();
        return $this->create_return($post,200,'','json');

    }
    public function article(){
        if(Request::has('id')){
            $posts=Posts::name('posts')->where('gid',Request::param('id'))->find();
            if(!$posts){
                return $this->create_return(false,201,'error','json');
            }else{
                return $this->create_return($posts,200);
            }
        }
    }

}
