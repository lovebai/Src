<?php
declare (strict_types = 1);

namespace app\validate;

use think\Validate;

class User extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'username'=>'require|min:5|max:20|email',//用户名不能未空且不大于20
        'password'=>'require|min:8'//密码不能空并且不能小于8
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [];
}
