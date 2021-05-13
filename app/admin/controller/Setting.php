<?php


namespace app\admin\controller;


use think\facade\View;

class Setting
{
    public function index(){
        return View::fetch('/setting');
    }

}