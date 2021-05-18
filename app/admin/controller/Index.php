<?php
declare (strict_types = 1);

namespace app\admin\controller;

use think\facade\View;

class Index
{
    public function index()
    {
        return View::fetch("/index");
    }
    public function abc()
    {
        return View::fetch("/abc");
    }

}
