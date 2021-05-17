<?php
declare (strict_types = 1);

namespace app\api\controller;

class Index extends Base
{
    public function index()
    {
        return $this->create_return(false,400,'提交参数错误','json');
    }
}
