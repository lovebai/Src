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
        //        if(Request::has('token')&&Request::post('token')!=''&&Request::isAjax()){//后面在加回来
        if(Request::has('token')&&Request::post('token')!='') {
            $token = $this->check_token(Request::post('token'));
            if ($token['code'] != 1) {
                $msg = $token['msg'];
                return $this->create_return(false, 400, 0, (string)$msg);
            }
            $text = (array)$token['data'];//用户id
            if(Request::has('type')&&Request::has('grade')&&Request::has('content')&&Request::has('attach')){
                $post=Request::param(['type','grade','content','attach','title']);
                $post['author']=$text['username'];
                $post['subdate']=date("Y-m-d G:i:s",time());
                if(Request::post('file')==''){
                    $post['attach']=0;
                }else{
                    $post['attach']=1;
                }
                if(B::name('bug')->insert($post)){
                    return $this->create_return(true,200,1);
                }else{
                    return $this->create_return(false,203,0);
                }
            }else{
                return $this->create_return(false,203,0,'参数错误');
            }


        }else{
            return $this->create_return(false,400,0,'error');
        }
    }
}