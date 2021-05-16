<?php


namespace app\admin\model;


use think\Model;

class Config extends Model
{
    public function getStatusAttr($value): string
    {
        $status = [0=>'隐藏',1=>'显示'];
        return $status[$value];
    }

}