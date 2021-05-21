<?php

namespace app\admin\controller;



use app\admin\model\Option;
use think\facade\Request;
use think\facade\View;

class Conf extends Base
{

    //短信
    public function sms(){
        $data=Request::param(['name','uid','key','v3','status']);
        if(!empty($data)&&$data!=''&&Request::isAjax()){
            if($data['key']!=''){
                $data['key']=md5($data['key']);
            }else{
                $info=Option::name('option')->where('id',1)->find();
                $data['key']=$info['key'];
            }
            if(Option::name('option')->where('id',1)->update($data)){
               return $this->create_return($data,200,'设置成功',1,'json');
            }else{
                return $this->create_return($data,201,'设置失败!可能是您未做修改',0,'json');
            }

        }else{
            $info=Option::name('option')->where('id',1)->find();
            $info['key']='';
            return View::fetch('sms',[
                'info'=>$info
            ]);
        }
    }


    //邮件
    public function mail(){
        $data=Request::param(['name','uid','key','v3','status']);
        if(!empty($data)&&$data!=''&&Request::isAjax()){
            if(Option::name('option')->where('id',2)->update($data)){
                return $this->create_return($data,200,'设置成功',1,'json');
            }else{
                return $this->create_return($data,201,'设置失败！可能是您未做修改',0,'json');
            }
        }else{
            $info=Option::name('option')->where('id',2)->find();
            return View::fetch('mail',[
                'info'=>$info
            ]);
        }
    }

    //测试短信
    public function testsms(){
        $post=Request::param(['to','content']);
        if(!empty($post)&&Request::has('to')&&Request::isAjax()){
            $info=Option::name('option')->where('id',1)->find();
            $api=$info['name'].'sms?u='.$info['uid'].'&p='.$info['key'].'&m='.$post['to'].'&c='.urlencode($post['content']);
            if($info['status']=='y') {
            if($this->http_request($api)==0){
                return $this->create_return(true,200,'恭喜您发送成功',1,'json');
            }else{
                return $this->create_return(false,201,'发送失败',0,'json');
            }
            }else{
                return $this->create_return(false, 203, '邮件发送功能未开启', 0, 'json');
            }
        }
        $this->create_return(false,403,'error',0,'json');
    }

    //测试发件
    public function testmail(){
        $post=Request::param(['to','content']);
        if(!empty($post)&&Request::has('to')&&Request::isAjax()){
            $info=Option::name('option')->where('id',2)->find();
            if($info['status']=='y') {
                if ($this->sendMail($info['name'], $info['v3'], $info['uid'], $info['key'], $info['uid'], $post['to'], '测试标题', $post['content'])) {
                    return $this->create_return(true, 200, '恭喜您发送成功', 1, 'json');
                } else {
                    return $this->create_return(false, 201, '发送失败', 0, 'json');
                }
            }else{
                return $this->create_return(false, 203, '邮件发送功能未开启', 0, 'json');
            }
        }
        $this->create_return(false,403,'error',0,'json');
    }


}