<?php


namespace app\admin\model;


use think\Model;

class Admin extends Model
{
    public function getStatusAttr($value): string
    {
        $status = [0=>'禁用',1=>'正常'];
        return $status[$value];
    }

}