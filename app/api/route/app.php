<?php
use \think\facade\Route;

//文章
Route::group('thread',function (){
    Route::rule('','post/articleList');
    Route::rule('id','post/article');
});

//用户
Route::group('user',function (){
    Route::rule('','user/index');
});


//漏洞提交
Route::group('submit',function (){
    Route::rule('','bug/index');
});