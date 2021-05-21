<?php

namespace app\admin\controller;



use app\admin\model\Option;
use think\facade\Request;
use think\facade\View;

class Conf extends Base
{

    //通知页
    public function sms(){
        $data=Request::param(['name','uid','key','v3','status']);
        if(!empty($data)&&$data!=''&&Request::isAjax()){
            if(Option::name('option')->where('id',1)->update($data)){
               return $this->create_return($data,200,'设置成功',1,'json');
            }else{
                return $this->create_return($data,201,'设置失败!可能是您未做修改',0,'json');
            }

        }else{
            $info=Option::name('option')->where('id',1)->find();
            return View::fetch('sms',[
                'info'=>$info
            ]);
        }
    }


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


//测试发件
    public function testmail(){
        $post=Request::param(['to','content']);
        if(!empty($post)&&Request::has('to')){
            $info=Option::name('option')->where('id',2)->find();
            if($this->sendMail($info['name'],$info['v3'],$info['uid'],$info['key'],$info['uid'],$post['to'],'测试标题',$post['content'])){
                return $this->create_return(true,200,'恭喜您发送成功',1,'json');
            }else{
               return $this->create_return(false,201,'发送失败',0,'json');
            }
        }
        $this->create_return(false,403,'error',0,'json');
    }


}