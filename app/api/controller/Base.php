<?php


namespace app\api\controller;


use think\Response;

abstract class Base
{

    /**
     * @param $data  数据
     * @param int $code  状态码
     * @param string $msg 提示
     * @param string $type 类型
     * @return Response
     */
    protected function create_return($data, int $code, string $msg='Succee',string $type='json'): Response
    {
        //标准API生成
        $result=[
            'code'=>$code,
            'msg'=>$msg,
            'data'=>$data
        ];
        //返回api
        return Response::create($result,$type);

    }
}