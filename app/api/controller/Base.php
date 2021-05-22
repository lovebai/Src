<?php


namespace app\api\controller;


use Firebase\JWT\JWT;
use think\Response;

/**
 * Class Base
 * @package app\api\controller
 */
abstract class Base
{


    /**
     * @param $data
     * @param int $code
     * @param int $count
     * @param string $msg
     * @param string $type
     * @return Response
     */
    protected function create_return($data, int $code, int $count=0, string $msg='Succeed', string $type='json'): Response
    {
        //标准API生成
        $result=[
            'code'=>$code,
            'count'=>$count,
            'msg'=>$msg,
            'data'=>$data
        ];
        //返回api
        return Response::create($result,$type);

    }


    //生成token

    /**
     * @param $id
     * @param $username
     * @return string
     */
    protected function sign_token($id, $username): string
    {
        $key='!@#$%*&xiaobai';
        $token=array(
            "iss"=>$key,        //签发者 可以为空
            "aud"=>$id,          //面象的用户，可以为空
            "iat"=>time(),      //签发时间
            "nbf"=>time()+3,    //在什么时候jwt开始生效  （这里表示生成100秒后才生效）
            "exp"=> time()+200, //token 过期时间
            "data"=>[           //记录的userid的信息，这里是自已添加上去的，如果有其它信息，可以再添加数组的键值对
                'id'=>$id,
                'username'=>$username,
            ]
        );
        return JWT::encode($token,$key,'HS256');
    }

    //用户密码加密

    /**
     * @param $pass
     * @return string
     */
    protected function passUser($pass): string
    {
        return sha1($pass.'bai');
    }
}