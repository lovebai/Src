<?php


namespace app\admin\model;


use think\Model;

class Posts extends Model
{
    public function getHideAttr($value): string
    {
        $status = ['n'=>'显示','y'=>'隐藏'];
        return $status[$value];
    }

}