<?php
namespace app\admin\middleware;
use think\facade\Db;
use think\facade\Session;

class Check
{
    public function handle($request, \Closure $next){
        //后台登录判断
        $test=Db::name('admin')->where('id',Session::get('USER_ID'))->find();
        if($test['status']==0){
            Session::delete('USER_ID');
            Session::delete('USER_NAME');
        }

        if(!Session::has("USER_ID")&&!Session::has('USER_NAME')){
            return redirect(url("./login"));
        }
        return $next($request);
    }
}