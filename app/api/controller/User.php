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
            if($metheda['username']!=''&&$metheda['password']!=''){
                $data=Users::name('user')->where(array(
                    'username'=>$metheda['username'],
                    'password'=>$this->passUser($metheda['password']),
                    ))->find();
                if(!empty($data)){

                    $info=array(
                        'uid'=>$data['id'],
                        'token'=>$this->sign_token($data['id'],$data['username'])
                    );
                    return $this->create_return($info,200,'恭喜您登录成功','json');
                }else{
                    return $this->create_return(false,202,'登录失败','json');
                }

            }else{
                return $this->create_return(false,201,'账号或者密码不能为空','json');
            }

            return 1;

        }else if (!empty($methedb)&&Request::has('phone')){
            return 1;
        }elseif(!empty($methedc)&&Request::has('email')){
            return 1;
        }else{
            return $this->create_return(false,203,'提交参数有误！','json');
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
