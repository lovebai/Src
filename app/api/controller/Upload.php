<?php


namespace app\api\controller;

use think\facade\Filesystem;
use think\facade\Request;
use think\facade\Validate;

class Upload extends Base
{
    public function index(){
        if(Request::has('file')) {
            $file = Request::file("file");
            if ($file) {

                //上传规则
                $validate = Validate::rule([
                    'file' => 'file|fileExt:jpg,png,doc,docx,pdf,zip'
                ]);

                //规则匹配
                $result = $validate->check([
                    'file' => $file
                ]);

                //通过输出地址，否则输出错误
                if ($result) {
                    $info = Filesystem::putFile('bfile', $file);
//            dump($info);
                    return $this->create_return(['src' => $info], 200, 'success', 1, 'json');
                } else {
//            dump($validate->getError());
                    return $this->create_return(false, 201, 'error', 0, 'json');
                }

            } else {
                return $this->create_return(false, 201, 'error', 0, 'json');
            }
        }else{
            return $this->create_return(false, 201, '参数有误', 0, 'json');
        }
    }




    }