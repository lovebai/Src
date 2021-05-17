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
        $info=Request::param(['title','description','keywords','domain','logo','icp','copyright','footer_info']);
        if($info!=''&&!empty($info)&&Request::isAjax()){
            try {
                if (!empty(Request::post('status'))) {
                    $info['status'] = 1;
                } else {
                    $info['status'] = 0;
                }
            }catch (ErrorException $e){
                return $this->create_return([],400,'Error！',1,'json');
            }

            if(Config::name('config')->where('id',1)->save($info)){

                return $this->create_return($info,200,'恭喜您修改成功！',1,'json');

            }else{
                return $this->create_return($info,201,'修改失败,可能未修改内容或者其他原因！',0,'json');

            }
        }else{
//            return $this->create_return($info,204,'未传参数',0,'json');
            $info=Config::name('config')->where('id',1)->find();
            return View::fetch('setting',[
                'info'=>$info->getData()
            ]);

        }


    }

    //友情链接
    public function link()
    {
        if (Request::has('limit')) {
            $limit = Request::post("limit");
            if ($limit != '') {
                $info = Config::name('link')->order('id','desc')->paginate($limit);
            } else {
                return $this->create_return([], 201, 'error', 0, 'json');
            }
            $count = Config::name('link')->select()->count();

            return $this->create_return($info, 200, 'success', $count , 'json');
        }else{
            return View::fetch('link');
        }
    }

    public function addlink(){
        $info=Request::param(['title','description','url','sort_id']);
        if ($info!=''&&!empty($info)&&Request::has('url')&&Request::isAjax()){
            try {
                if (!empty(Request::post('status'))) {
                    $info['status'] = 1;
                } else {
                    $info['status'] = 0;
                }
            }catch (ErrorException $e){
                return $this->create_return([],400,'Error！',1,'json');
            }

            if(Config::name('link')->insert($info)){

                return $this->create_return($info,200,'恭喜您添加成功！',1,'json');

            }else{
                return $this->create_return($info,201,'添加失败！',0,'json');

            }

        }else{
            return View::fetch('addlink');
        }
    }

    public function editlink(){
        $info=Request::param(['id','title','description','url','sort_id']);
        if ($info!=''&&!empty($info)&&Request::has('url')&&Request::isAjax()){
            try {
                if (!empty(Request::post('status'))) {
                    $info['status'] = 1;
                } else {
                    $info['status'] = 0;
                }
            }catch (ErrorException $e){
                return $this->create_return([],400,'Error！',1,'json');
            }

            if(Config::name('link')->where('id',$info['id'])->save($info)){

                return $this->create_return($info,200,'恭喜您修改成功！',1,'json');

            }else{
                return $this->create_return($info,201,'修改失败,可能未修改内容或者其他原因！',0,'json');

            }

        }else{
            if(Request::has('id_edit')&&Request::param('id_edit')!=''){
                $info=Config::name('link')->where('id',Request::param('id_edit'))->find();
                return View::fetch('editlink',[
                    'info'=>$info,
                    'status'=>$info->getData('status')
                ]);
            }else{
                return 'error';
            }

        }
    }

    public function dellink(){
        $id=Request::post('id');
        if($id!=''&&!empty($id)&&Request::isAjax()&&Request::has('id')){
            if(Config::name('link')->where('id',$id)->delete()){
                return $this->create_return([],200,'恭喜您删除成功！',1,'json');
            }else{
                return $this->create_return([],203,'删除失败！',0,'json');
            }
        }else{
            return $this->create_return([],201,'提交参数有误！',0,'json');
        }
    }

    //导航
    public function nav(){
        if (Request::has('limit')) {
            $limit = Request::post("limit");
            if ($limit != '') {
                $info = Config::name('nav')->order('id','desc')->paginate($limit);
            } else {
                return $this->create_return([], 201, 'error', 0, 'json');
            }
            $count = Config::name('nav')->select()->count();

            return $this->create_return($info, 200, 'success', $count , 'json');
        }else{
            return View::fetch('nav');
        }
    }

    public function addnav(){
        $info=Request::param(['name','url','sort_id']);
        if ($info!=''&&!empty($info)&&Request::has('url')&&Request::isAjax()){
            try {
                if (!empty(Request::post('status'))) {
                    $info['status'] = 1;
                } else {
                    $info['status'] = 0;
                }
            }catch (ErrorException $e){
                return $this->create_return([],400,'Error！',1,'json');
            }

            if(Config::name('nav')->insert($info)){

                return $this->create_return($info,200,'恭喜您添加成功！',1,'json');

            }else{
                return $this->create_return($info,201,'添加失败！',0,'json');

            }

        }else{
            return View::fetch('addnav');
        }
    }

    public function editnav(){
        $info=Request::param(['id','name','url','sort_id']);
        if ($info!=''&&!empty($info)&&Request::has('url')&&Request::isAjax()){
            try {
                if (!empty(Request::post('status'))) {
                    $info['status'] = 1;
                } else {
                    $info['status'] = 0;
                }
            }catch (ErrorException $e){
                return $this->create_return([],400,'Error！',1,'json');
            }

            if(Config::name('nav')->where('id',$info['id'])->save($info)){

                return $this->create_return($info,200,'恭喜您修改成功！',1,'json');

            }else{
                return $this->create_return($info,201,'修改失败,可能未修改内容或者其他原因！',0,'json');

            }

        }else{
            if(Request::has('id_edit')&&Request::param('id_edit')!=''){
                $info=Config::name('nav')->where('id',Request::param('id_edit'))->find();
                return View::fetch('editnav',[
                    'info'=>$info,
                    'status'=>$info->getData('status')
                ]);
            }else{
                return 'error';
            }

        }
    }

    public function delnav(){
        $id=Request::post('id');
        if($id!=''&&!empty($id)&&Request::isAjax()&&Request::has('id')){
            if(Config::name('nav')->where('id',$id)->delete()){
                return $this->create_return([],200,'恭喜您删除成功！',1,'json');
            }else{
                return $this->create_return([],203,'删除失败！',0,'json');
            }
        }else{
            return $this->create_return([],201,'提交参数有误！',0,'json');
        }
    }

}