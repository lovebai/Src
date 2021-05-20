<?php
namespace app\admin\middleware;
use think\facade\Session;

class Check
{
    public function handle($request, \Closure $next){
        //后台登录判断
        if(!Session::has("USER_ID")&&!Session::has('USER_NAME')){
            return redirect(url("./login"));
        }
        return $next($request);
    }
}