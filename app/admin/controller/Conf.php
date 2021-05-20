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
        if(!empty($data)&&$data!=''){
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
        if(!empty($data)&&$data!=''){
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


}