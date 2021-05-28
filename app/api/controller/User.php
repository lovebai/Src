<?php
declare (strict_types = 1);

namespace app\api\controller;


use app\api\model\User as Users;
use app\api\validate\User as Ver;
use think\exception\ValidateException;
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
//        if(!empty($metheda)&&Request::has('username')&&Request::isAjax()){//后期在加回来
        if(!empty($metheda)&&Request::has('username')){
            if($metheda['username']!=''&&$metheda['password']!=''){
                $data=Users::name('user')->where(array(
                    'username'=>$metheda['username'],
                    'password'=>$this->passUser($metheda['password']),
                    ))->find();
                if(!empty($data)){
                    if($data['status']==0){
                        return $this->create_return(false,204,0,'登录失败用户已被禁用');
                    }
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

//        }else if (!empty($methedb)&&Request::has('phone')&&Request::isAjax()){//后期在加回来
        }else if (!empty($methedb)&&Request::has('phone')){
            if($methedb['phone']!=''&&$methedb['password']!=''){
                $data=Users::name('user')->where(array(
                    'phone'=>$methedb['phone'],
                    'password'=>$this->passUser($methedb['password']),
                ))->find();
                if(!empty($data)){
                    if($data['status']==0){
                        return $this->create_return(false,204,0,'登录失败用户已被禁用');
                    }
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
//        }elseif(!empty($methedc)&&Request::has('email')&&Request::isAjax()){//后期在加回来
        }elseif(!empty($methedc)&&Request::has('email')){
            if($methedc['email']!=''&&$methedc['password']!=''){
                $data=Users::name('user')->where(array(
                    'email'=>$methedc['email'],
                    'password'=>$this->passUser($methedc['password']),
                ))->find();
                if(!empty($data)){
                    if($data['status']==0){
                        return $this->create_return(false,204,0,'登录失败用户已被禁用');
                    }
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

    //用户注册
    /**
     * @return \think\Response
     */
    public function register(): \think\Response
    {
        if(Request::has('username')&&Request::has('password')&&Request::has('email')&&Request::has('phone')) {
            $list = Request::param(['username', 'password', 'email', 'phone']);
//            if (!empty($list) && $list != null&&Request::isAjax()) {//后面改回来
            if (!empty($list) && $list != null) {
                try {
                    validate(Ver::class)->check([
                        'username' => $list['username'],
                        'password' => $list['password'],
                        'phone' => $list['phone'],
                        'email' => $list['email'],
                    ]);

                    $list['create_date']=date("Y-m-d G:i:s",time());
                    $list['password']=$this->passUser($list['password']);
                    if (Users::name('user')->insert($list)){
                        return $this->create_return(true,200,1,'注册成功');
                    }else{
                        return $this->create_return(false,202,0,'注册失败');
                    }


                } catch (ValidateException $e) {
                    return $this->create_return(false,201,0,$e->getError());
                }
            } else {
                return $this->create_return(false, 403, 0, 'Error');
            }
        }else{
            return $this->create_return(false, 403, 0, '请求参数有误');
        }
    }


    //用户信息
    /**
     * @return \think\Response
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function index(): \think\Response
    {
//        if(Request::has('token')&&Request::post('token')!=''&&Request::isAjax()){//后面在加回来
        if(Request::has('token')&&Request::post('token')!=''){
            $token=$this->check_token(Request::post('token'));
            if($token['code']!=1){
                $msg=$token['msg'];
                return $this->create_return(false,400,0, (string)$msg);
            }
            $id=(array)$token['data'];
            $user=Users::name('user')->where('id',$id['id'])->find();
            if($user){
                if($user['status']==1){
                    $user['status']='正常';
                }else{
                    $user['status']='禁用';
                }
//                if($user['gender']==0){
//                    $user['gender']='女';
//                }elseif ($user['gender']==1){
//                    $user['gender']='男';
//                }else{
//                    $user['gender']='保密';
//                }
                if($user['avatar']==''){
                    if($user['qq']==''){
                        $user['avatar'] = '/static/images/avatar_user.png';
                    }else{
                        $user['avatar']='https://api.xiaobaibk.com/api/qq.php?qq='.$user['qq'];
                    }
                }
                unset($user['password']);
                return $this->create_return($user,200,1);
            }else{
                return $this->create_return(false,204,1,'查询失败');
            }

        }else{
            return $this->create_return(false,400,0,'error');
        }

    }


    public function update(){
        //        if(Request::has('token')&&Request::post('token')!=''&&Request::isAjax()){//后面在加回来
        if(Request::has('token')&&Request::post('token')!=''){
            $token=$this->check_token(Request::post('token'));
            if($token['code']!=1){
                $msg=$token['msg'];
                return $this->create_return(false,400,0, (string)$msg);
            }
            $id=(array)$token['data'];
            $data=Request::param(['password','phone','email','gender','birthday','about','wechat','qq']);
            if ($data['password']==''){
                unset($data['password']);
            }else{
                $data['password']=$this->passUser($data['password']);
            }
            if(!empty($data)&&$data!=''){
                if(Users::name('user')->where('id',$id['id'])->update($data)){
                    return $this->create_return(true,200,1);
                }else{
                    return $this->create_return(false,203,0,'error');
                }
            }else{
                return $this->create_return(false,201,0,'error:参数有误');
            }

        }else{
            return $this->create_return(false,400,0,'error');
        }
    }

}
