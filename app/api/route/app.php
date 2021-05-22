<?php
use \think\facade\Route;

//文章
Route::group('thread',function (){
    Route::rule('','post/articleList');
    Route::rule('id','post/article');
});

//用户
Route::group('user',function (){
    //登录
    Route::post('login','user/isLogin');
    //注册
    Route::post('reg','user/register');
    //查询信息
    Route::rule('','user/index');
});


//漏洞提交
Route::group('submit',function (){
    Route::rule('','bug/index');
});