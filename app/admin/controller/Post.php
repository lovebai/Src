<?php


namespace app\admin\controller;


use think\facade\View;

class Post
{
    //添加文章
    public function addPost(){
        return View::fetch('/postadd');

    }
    //文章列表
    public function index(){
        return View::fetch('/postlist');
    }
    public function list(){

    }

}