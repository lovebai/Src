<?php


namespace app\admin\controller;


use app\admin\model\Config;
use think\exception\ErrorException;
use think\facade\Request;
use think\facade\View;

class Setting extends Base
{
    //显示
    public function index(){
        $info=Config::name('config')->where('id',1)->find();
        return View::fetch('/setting',[
            'info'=>$info
        ]);
    }


    //
    public function set(){
        $info=Request::param();
        if($info!=''&&!empty($info)){
            try {
                if (!empty(Request::post('status'))) {
                    $status = 1;
                } else {
                    $status = 0;
                }
                $data = array(
                    'title' => $info['name'],
                    'description' => $info['description'],
                    'keywords' => $info['keywords'],
                    'domain' => $info['domain'],
                    'logo' => $info['logo'],
                    'icp' => $info['icp'],
                    'copyright' => $info['copyright'],
                    'footer_info' => $info['footer_info'],
                    'status' => $status,
                );
            }catch (ErrorException $e){
                return $this->create_return([],400,'Error！',1,'json');
            }

            if(Config::name('config')->where('id',1)->save($data)){

                return $this->create_return($info,200,'恭喜您修改成功！',1,'json');

            }else{
                return $this->create_return($info,201,'修改失败,可能未修改内容或者其他原因！',0,'json');

            }
        }else{
            return $this->create_return($info,204,'未传参数',0,'json');
        }
    }

}