<?php
declare (strict_types = 1);

namespace app\api\controller;


use app\api\model\User as Users;
use think\facade\Request;

class User extends Base
{

    public function isLogin(){
        $metheda=Request::param(['username','password']);
        $methedb=Request::param(['phone','password']);
        $methedc=Request::param(['email','password']);
        if(!empty($metheda)&&Request::has('username')){
            return '';
        }else if (!empty($methedb)&&Request::has('phone')){
            return '';
        }elseif(!empty($methedc)&&Request::has('email')){
            return '';
        }else{
            return $this->create_return(false,203,'error','json');
        }
    }
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        if(!empty(Request::param())&&Request::post('id')!=''){
            $user=Users::name('user')->where('id',Request::post('id'))->find();
        if($user){
            return $this->create_return($user,200,'查询成功','json');
        }else{
            return $this->create_return(false,201,'查询失败','json');
        }
        }else{
            return $this->create_return(false,400,'error','json');
        }
    }

}
