<?php


namespace app\api\controller;


use Firebase\JWT\JWT;
use think\Exception;
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
            "exp"=> time()+1440, //token 过期时间1440  1440/60=24
            "data"=>[           //记录的userid的信息，这里是自已添加上去的，如果有其它信息，可以再添加数组的键值对
                'id'=>$id,
                'username'=>$username,
            ]
        );
        return JWT::encode($token,$key,'HS256');
    }


    //验证token

    /**
     * @param $token
     * @return array|int[]
     */
    protected function check_token($token): array
    {
        $key='!@#$%*&xiaobai';
        $status=array("code"=>2);
        try {
            JWT::$leeway = 60;//当前时间减去60，把时间留点余地
            $decoded = JWT::decode($token, $key, array('HS256')); //HS256方式，这里要和签发的时候对应
            $arr = (array)$decoded;
            $res['code']=1;
            $res['data']=$arr['data'];
            return $res;

        } catch(\Firebase\JWT\SignatureInvalidException $e) { //签名不正确
            $status['msg']="签名不正确";
            return $status;
        }catch(\Firebase\JWT\BeforeValidException $e) { // 签名在某个时间点之后才能用
            $status['msg']="token失效";
            return $status;
        }catch(\Firebase\JWT\ExpiredException $e) { // token过期
            $status['msg']="token失效";
            return $status;
        }catch(Exception $e) { //其他错误
            $status['msg']="未知错误,请联系管理员";
            return $status;
        }
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