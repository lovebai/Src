<?php


namespace app\api\controller;


use think\facade\Request;
use app\api\model\Bug as B;

/**
 * Class Bug
 * @package app\api\controller
 */
class Bug extends Base
{
    //前端获取分类
    /**
     * @return \think\Response
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
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
            if(Request::has('id')&&Request::post('id')!=''){//有参数
                $type=B::name('bugcg')->where('u_id',Request::post('id'))->column(['id','category']);
                $count=B::name('bugcg')->where('u_id',Request::post('id'))->select()->count();
                return $this->create_return($type,200,$count);
            }else{
                $type=B::name('bugcg')->where('is','y')->column(['id','category']);
                $count=B::name('bugcg')->where('is','y')->select()->count();
                return $this->create_return($type,200,$count);
            }

        }else{
            return $this->create_return(false,201,0,'未提交用户token');
        }

    }


    /**
     * @return \think\Response
     */
    public function index(): \think\Response
    {
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
                if($post['title']==''&&$post['type']==''&&$post['grade']==''){
                    return $this->create_return(false,204,0,'标题、类型、危害等级不能为空');
                }
                if(Request::post('file')==''){
                    $post['attach']=0;
                }else{
                    $post['attach']=1;
                }
                if(B::name('bug')->insert($post)){
                    return $this->create_return(true,200,1);
                }else{
                    return $this->create_return(false,203,0,'提交失败');
                }
            }else{
                return $this->create_return(false,203,0,'参数错误');
            }


        }else{
            return $this->create_return(false,400,0,'error');
        }
    }

    public function getList(): \think\Response
    {
        //        if(Request::has('token')&&Request::post('token')!=''&&Request::isAjax()){//后面在加回来
        if(Request::has('token')&&Request::post('token')!='') {
            $token = $this->check_token(Request::post('token'));
            if ($token['code'] != 1) {
                $msg = $token['msg'];
                return $this->create_return(false, 400, 0, (string)$msg);
            }
            $text = (array)$token['data'];//用户id
            $data=B::name('bug')->where('author',$text['username'])->column(['title','subdate','gid']);
            $count=B::name('bug')->where('author',$text['username'])->select()->count();
//            $data['type']=B::name('bugcg')->where('id',$data['type']);
            if($data){
                return $this->create_return($data,200,$count);
            }else{
                return $this->create_return(false,201,0,'error');
            }


        }else{
            return $this->create_return(false,400,0,'error');
        }

    }


    public function getBug(){
        //        if(Request::has('token')&&Request::post('token')!=''&&Request::isAjax()){//后面在加回来
        if(Request::has('token')&&Request::post('token')!='') {
            $token = $this->check_token(Request::post('token'));
            if ($token['code'] != 1) {
                $msg = $token['msg'];
                return $this->create_return(false, 400, 0, (string)$msg);
            }
            if(Request::has('id')&&Request::post('id')!=''){
//                $data=B::name('bug')->where('gid',Request::post('id'))->column(['title','subdate','gid']);
                //可再次开发
                $data=B::name('bug')->where('gid',Request::post('id'))->find();
//                $type=B::name('bugcg')->where('is','n')->column(['id','category']);
//                $data['cate']=$type;
                if($data){
                    return  $this->create_return($data,200,1);
                }else{
                    return $this->create_return(false,201,0,'查询失败');
                }

            }else{
                return $this->create_return(false,203,0,'请求参数有误');
            }

        }else{
            return $this->create_return(false,400,0,'error');
        }

    }

    public function update(){
        if(Request::has('token')&&Request::post('token')!='') {
            $token = $this->check_token(Request::post('token'));
            if ($token['code'] != 1) {
                $msg = $token['msg'];
                return $this->create_return(false, 400, 0, (string)$msg);
            }
            $text = (array)$token['data'];//用户id
            if(Request::has('type')&&Request::has('grade')&&Request::has('content')&&Request::has('attach')){
                $post=Request::param(['type','grade','content','attach','title','id']);
                $post['author']=$text['username'];
                $post['subdate']=date("Y-m-d G:i:s",time());
                if($post['title']==''&&$post['type']==''&&$post['grade']==''){
                    return $this->create_return(false,204,0,'标题、类型、危害等级不能为空');
                }
                if(Request::post('file')==''){
                    $post['attach']=0;
                }else{
                    $post['attach']=1;
                }
                if(B::name('bug')->where('gid',Request::post('id'))->save($post)){
                    return $this->create_return(true,200,1);
                }else{
                    return $this->create_return(false,203,0,'修改失败');
                }
            }else{
                return $this->create_return(false,203,0,'参数错误');
            }


        }else{
            return $this->create_return(false,400,0,'error');
        }
    }

    public function ge(){
        if(Request::has('token')&&Request::post('token')!='') {
            $token = $this->check_token(Request::post('token'));
            if ($token['code'] != 1) {
                $msg = $token['msg'];
                return $this->create_return(false, 400, 0, (string)$msg);
            }
            if(Request::has('id')&&Request::post('id')!=''){
//                $data=B::name('bug')->where('gid',Request::post('id'))->column(['title','subdate','gid']);
                //可再次开发
//                $data=B::name('bug')->where('gid',Request::post('id'))->find();

                $data=B::name('bugcg')->where('is','n')->column(['id','category']);
//                $data['cate']=$type;
                if($data){
                    return  $this->create_return($data,200,1);
                }else{
                    return $this->create_return(false,201,0,'查询失败');
                }

            }else{
                return $this->create_return(false,203,0,'请求参数有误');
            }

        }else{
            return $this->create_return(false,400,0,'error');
        }
    }
}