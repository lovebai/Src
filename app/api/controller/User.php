<?php
declare (strict_types = 1);

namespace app\api\controller;


use app\api\model\User as Users;
use think\facade\Request;

/**
 * Class User
 * @package app\api\controller
 */
class User extends Base
{

    //前端登录
    /**
     * @return \think\Response
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function isLogin(): \think\Response
    {
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
                    return $this->create_return($info,200,1,'恭喜您登录成功','json');
                }else{
                    return $this->create_return(false,202,0,'登录失败','json');
                }

            }else{
                return $this->create_return(false,201,0,'账号或者密码不能为空','json');
            }

        }else if (!empty($methedb)&&Request::has('phone')){
            if($methedb['phone']!=''&&$methedb['password']!=''){
                $data=Users::name('user')->where(array(
                    'phone'=>$methedb['phone'],
                    'password'=>$this->passUser($methedb['password']),
                ))->find();
                if(!empty($data)){
                    $info=array(
                        'uid'=>$data['id'],
                        'token'=>$this->sign_token($data['id'],$data['username'])
                    );
                    return $this->create_return($info,200,1,'恭喜您登录成功','json');
                }else{
                    return $this->create_return(false,202,0,'登录失败','json');
                }

            }else{
                return $this->create_return(false,201,0,'账号或者密码不能为空','json');
            }
        }elseif(!empty($methedc)&&Request::has('email')){
            if($methedc['email']!=''&&$methedc['password']!=''){
                $data=Users::name('user')->where(array(
                    'email'=>$methedc['email'],
                    'password'=>$this->passUser($methedc['password']),
                ))->find();
                if(!empty($data)){
                    $info=array(
                        'uid'=>$data['id'],
                        'token'=>$this->sign_token($data['id'],$data['username'])
                    );
                    return $this->create_return($info,200,1,'恭喜您登录成功','json');
                }else{
                    return $this->create_return(false,202,0,'登录失败','json');
                }

            }else{
                return $this->create_return(false,201,0,'账号或者密码不能为空','json');
            }
        }else{
            return $this->create_return(false,203,0,'提交参数有误！','json');
        }
    }


    /**
     * @return \think\Response
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function index(): \think\Response
    {
        if(!empty(Request::param())&&Request::post('id')!=''){
            $user=Users::name('user')->where('id',Request::post('id'))->find();
        if($user){
            return $this->create_return($user,200,1,'查询成功','json');
        }else{
            return $this->create_return(false,201,0,'查询失败','json');
        }
        }else{
            return $this->create_return(false,400,0,'error','json');
        }
    }

}
