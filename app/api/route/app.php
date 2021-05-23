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
    Route::post('','user/index');
});


//漏洞提交
Route::group('bug',function (){
    Route::rule('submit','bug/index');
    //获取分类
    Route::rule('get','bug/getType');
    //获取列表
    Route::rule('list','bug/getList');
});

//上传
Route::rule('uplaod','upload/index');