<?php


namespace app\api\controller;

use think\facade\Db;
use think\facade\Filesystem;
use think\facade\Request;
use think\facade\Validate;

class Upload extends Base
{
    public function index(){
        if(Request::has('is')) {
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
                    $gid= Db::name('bug')->order('gid','desc')->column('gid');
                    $name=explode('\\',$info);
                    $data=array(
                      'gid'=>$gid[0]+1,
                        'filename'=>$name[1],
                        'filepath'=>$info,
                        'uptime'=>date("Y-m-d G:i:s",time())
                    );
                    if(Db::name('attachment')->insert($data)){
                        return $this->create_return(['src' => $info], 200, 1);
                    }else{
                        return $this->create_return(false, 203, 0, 'error');
                    }
                } else {
//            dump($validate->getError());
                    return $this->create_return(false, 201, 0,'error', 'json');
                }

            } else {
                return $this->create_return(false, 201, 0,'error',  'json');
            }
        }else{
            return $this->create_return(false, 201, 0,'参数有误');
        }
    }
}