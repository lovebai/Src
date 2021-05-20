<?php
use \think\facade\Route;

//文章
Route::group('thread',function (){
    Route::rule('','post/articleList');
    Route::rule('id','post/article');
});