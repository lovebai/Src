<?php


namespace app\admin\controller;


use think\Response;

/**
 * Class Base
 * @package app\admin\controller
 */
abstract class Base
{
    protected $middleware = ['Auth'];

    /**
     * @param $data
     * @param int $code  状态码
     * @param string $msg 提示
     * @param int $count 提示
     * @param string $type 类型
     * @return Response
     */
    protected function create_return($data, int $code, string $msg='Succee', int $count,string $type='json'): Response
    {
        //标准API生成
        $result=[
            'code'=>$code,
            'msg'=>$msg,
            'count'=>$count,
            'data'=>$data
        ];
        //返回api
        return Response::create($result,$type);

    }


    /**
     * @param $pass
     * @return string
     */
    protected function passAdmin($pass){
        return sha1(md5($pass).'xiaobai');
    }

    /**
     * @param $pass
     * @return string
     */
    protected function passUser($pass){
        return md5($pass.'bai');
    }



}





