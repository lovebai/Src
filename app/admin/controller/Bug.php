<?php


namespace app\admin\controller;


use think\facade\View;

class Bug
{
    public function index(){
        return View::fetch('/buglist');
    }
}