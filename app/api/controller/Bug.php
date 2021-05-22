<?php


namespace app\api\controller;


use think\facade\Request;
use app\api\model\Bug as B;

class Bug extends Base
{
    //前端获取分类
    public function getType(): \think\Response
    {
        //        if(Request::has('token')&&Request::post('token')!=''&&Request::isAjax()){//后面在加回来
        if(Request::has('token')&&Request::post('token')!='') {
            $token = $this->check_token(Request::post('token'));
            if ($token['code'] != 1) {
                $msg = $token['msg'];
                return $this->create_return(false, 400, 0, (string)$msg);
            }
//            $id = (array)$token['data'];
            if(Request::has('id')&&Request::post('id')!=''){
                $type=B::name('bugcg')->where('u_id',Request::post('id'))->column('category', 'id');
                $count=B::name('bugcg')->where('u_id',Request::post('id'))->select()->count();
                return $this->create_return($type,200,$count);
            }else{
                $type=B::name('bugcg')->where('is','y')->column('category', 'id');
                $count=B::name('bugcg')->where('is','y')->select()->count();
                return $this->create_return($type,200,$count);
            }

        }else{
            return $this->create_return(false,400,0,'error');
        }

    }


    public function index(){

    }
}