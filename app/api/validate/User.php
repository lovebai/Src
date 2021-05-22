<?php
declare (strict_types = 1);

namespace app\api\validate;

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
        'username|用户名'  => 'require|max:20|min:2',
        'password|密码'=>'require|min:32|max:32',
        'phone|手机号'   => 'mobile',
        'email|邮箱' => 'email',
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [
        'username.require' => '用户名不能为空',
        'username.max'     => '用户名最多不能超过20个字符',
        'username.min'     => '用户名不能少于2个字符',
        'password.min'     => '用户密码格式',
        'password.max'     => '用户密码格式有误',
        'phone'  => '手机号格式不正确',
        'email'        => '邮箱格式不正确',
    ];
}
