<?php


namespace app\admin\controller;



use app\admin\model\Posts;
use think\facade\Db;
use think\facade\Request;
use think\facade\View;
use app\admin\model\Bug as Bugb;

class Bug extends Base
{
    public function index(){

        return View::fetch('buglist');
    }

    //提供数据
    public function list(){
        $limit=Request::post("limit");
        if($limit!=''){
            $bugList=Bugb::name('bug')->order('gid','desc')->paginate($limit)->each(function ($item){
                $date=Bugb::name('bugcg')->where('id',$item['type'])->find();
                $item['type']=$date['category'];
                return $item;
            });
        }else{
            return $this->create_return(false,201,'error',0,'json');
        }
        $count=Bugb::name('bug')->select()->count();

        return $this->create_return($bugList,200,'success',$count,'json');
    }

    public function see(){
        if(Request::has('id')){
            $info=Bugb::name('bug')->where('gid',Request::get('id'))->find();
            $type=Bugb::name('bugcg')->where('id',$info['type'])->find();
            $file=Db::name('attachment')->where('gid',$info['gid'])->find();
            return View::fetch('bugsee',[
                'data'=>$info,
                'type'=>$type['category'],
                'file'=>$file
            ]);
        }else{
            return 'error';
        }

    }

    public function edit(){
        $post=Request::param(['gid','title','author','type','grade','status','content']);
        if($post!=''&&!empty($post)&&Request::isAjax()){
            $file = Posts::name('attachment')->where('gid', $post['gid'])->find();
            $files = array(
                'gid' => $post['gid'],
                'filename' => $post['title'],
                'filepath' => Request::post('file'),
                'uptime' => date("Y-m-d G:i:s", time())
            );
            if ($file) {
                if (Request::post('file')!= $file['filepath']) {
                    if(Request::post('file')!=''){
                        Posts::name('attachment')->where('gid', $post['gid'])->save($files);
                    }
                }
            }else{
                if(Request::post('file')!='') {
                    Posts::name('attachment')->where('gid', $post['gid'])->insert($files);
                }
            }

            if(Request::post('file')==''){
                $post['attach']=0;
            }else{
                $post['attach']=1;
            }
            if(Posts::name('bug')->where('gid',$post['gid'])->save($post)){
                return $this->create_return(true,200,'编辑成功',1,'json');
            }else{
                return $this->create_return(false,201,'编辑失败,可能未做修改',0,'json');
            }
        }else {
            if (Request::has('id')) {
                $info = Bugb::name('bug')->where('gid', Request::get('id'))->find();
                $type = Bugb::name('bugcg')->paginate();
                $file = Db::name('attachment')->where('gid', $info['gid'])->find();
                return View::fetch('bugedit', [
                    'data' => $info,
                    'file' => $file,
                    'type' => $type,
                    'status' => $info->getData('status'),
                    'grade' => $info->getData('grade')
                ]);
            } else {
                return redirect(url('bug/index'));
            }
        }
    }

    public function del(){
        $id=Request::post('id');
        if($id!=''&&!empty($id)&&Request::isAjax()&&Request::has('id')){
            if(Bugb::name('bug')->where('gid',$id)->delete()){
                return $this->create_return([],200,'恭喜您删除成功！',1,'json');
            }else{
                return $this->create_return([],203,'删除失败！',0,'json');
            }
        }else{
            return $this->create_return([],201,'提交参数有误！',0,'json');
        }
    }

    public function category(){
        if(!empty(Request::param())&&Request::isAjax()&&Request::has('limit')){
            $limit=Request::post("limit");
            if($limit!=''){
                $list=Bugb::name('bugcg')->paginate($limit)->each(function ($item,$key){
                    if($item['is']=='y'){
                        $item['category']="<span id='wy' style=\"color:#FF5722;font-weight: 700;letter-spacing: 5px;\">".$item['category']."</span>";
                    }else{
                        $item['categorys']=$item['category'];
                    }
                    return $item;
                });
            }else{
                return $this->create_return(false,201,'error',0,'json');
            }
            $count=Bugb::name('bugcg')->select()->count();

            return $this->create_return($list,200,'success',$count,'json');
        }else{
            return View::fetch('category');
        }
    }

    //添加分类
    public function addcategory(){
        if(Request::isAjax()&&Request::has('category')){
            $data=Request::param();
            $data['is']= $data['u_id']==0?'y':'n';
            if(Bugb::name('bugcg')->insert($data)){
                return $this->create_return(true,200,'恭喜您分类添加成功了',1,'json');
            }else{
                return $this->create_return(false,201,'error',0,'json');
            }
        }else{
            $list=Bugb::name('bugcg')->where('is','y')->select();
            return View::fetch('category_add',[
                'sort'=>$list
            ]);
        }
    }

    //编辑分类
    public function editcategory(){
        if(Request::get('edit_id')&&Request::has('edit_id')){
            $data=Bugb::name('bugcg')->where('id',Request::get('edit_id'))->find();
            if($data){
                return View::fetch('category_edit',[
                    'data'=>$data
                ]);
            }else{
                return "error";
            }
        }else if(!empty(Request::param())&&Request::isAjax()&&Request::has('category')){
            $data=Request::param();
            if(Request::has('is')){
                $data['is']='y';
            }else{
                $data['is']='n';
            }
            if(Bugb::name('bugcg')->where('id',$data['id'])->save($data)){
                return $this->create_return(true,200,'已编辑成功',1,'json');
            }else{
                return $this->create_return(false,201,'编辑失败，可能是您未做过修改',0,'json');
            }
        }else{
            return $this->create_return(false,400,'error',0,'json');
        }
    }

    //删除分类
    public function delcategory(){
        $id=Request::post('id');
        if($id!=''&&!empty($id)&&Request::isAjax()&&Request::has('id')){
            if(Bugb::name('bugcg')->where('id',$id)->delete()){
                return $this->create_return([],200,'恭喜您删除成功！',1,'json');
            }else{
                return $this->create_return([],203,'删除失败！',0,'json');
            }
        }else{
            return $this->create_return([],201,'提交参数有误！',0,'json');
        }
    }

    //删除附件
    public function delfile(){

        if(Request::has('id')&&Request::post('id')!=''){
            if(Posts::name('attachment')->where('gid', Request::post('id'))->delete()){
                return $this->create_return(true,200,'删除成功',0,'json');
            }else{
                return $this->create_return(true,201,'删除失败',0,'json');
            }
        }
    }


}