<?php
declare (strict_types = 1);

namespace app\admin\controller;

use think\facade\Db;
use think\facade\Session;
use think\facade\View;

class Index extends Base
{

    public function index()
    {
        //漏洞数
        $bs=Db::name('bug')->select()->count();
        $bn=Db::name('bug')->where('status',0)->select()->count();

        //用户数
        $ps=Db::name('posts')->select()->count();
        $us=Db::name('user')->select()->count();
        return View::fetch("/index",[
            'bs'=>$bs,
            'bn'=>$bn,
            'ps'=>$ps,
            'us'=>$us
        ]);
    }

    public function avatar(){
        if(Session::has('USER_ID')){
            $id=Session::get('USER_ID');
            $info=Db::name('admin')->where('id',$id)->find();
            if($info){
                if ($info['avatar']!=''){
                    $avatar=$info['avatar'];
                }else{
                    if ($info['qq']!='') {
                        $avatar = '//api.xiaobaibk.com/api/qq.php?qq=' . $info['qq'];
                    }else{
                        $avatar='//tva1.sinaimg.cn/crop.0.0.118.118.180/5db11ff4gw1e77d3nqrv8j203b03cweg.jpg';
                    }
                }
            }

        }
        return json(array('avatar'=>$avatar,'user'=>$info['username']));


    }

    public function preference(){
        if(Session::has('USER_ID')){
            $id=Session::get('USER_ID');
            $info=Db::name('admin')->where('id',$id)->find();
            if($info){
                $info['password']='';
                return View::fetch('/preference',[
                    'info'=>$info
                ]);
            }

        }
    }

}
