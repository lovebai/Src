<?php


namespace app\admin\controller;

use think\facade\Filesystem;
use think\facade\Request;
use think\facade\Validate;

class Upload extends Base
{
    public function index(){

        $file = Request::file("file");
        if($file) {

            //上传规则
            $validate = Validate::rule([
                'image' => 'file|fileExt:jpg,png,gif'
            ]);

            //规则匹配
            $result = $validate->check([
                'image' => $file
            ]);

            //通过输出地址，否则输出错误
            if ($result) {
                $info = Filesystem::putFile('topic', $file);
//            dump($info);
                return $this->create_return(['src' => $info], 200, 'success', 1, 'json');
            } else {
//            dump($validate->getError());
                return $this->create_return([], 201, 'error', 0, 'json');
            }

        }else{
            return $this->create_return([], 201, 'error', 0, 'json');
        }


    }

}