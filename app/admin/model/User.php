<?php


namespace app\admin\model;


use think\Model;

class User extends Model
{

    //获取
    public function getStatusAttr($value): string
    {
        $status = [0=>'禁用',1=>'正常'];
        return $status[$value];
    }
    //set
    public function setStatusAttr($value): string
    {
        $status = [1=>'on'];
        return $status[$value];
    }

    //修改
//    public function setGenderAttr($value): string
//    {
//        $status = [-1=>'保密',0=>'女',1=>'男'];
//        return $status[$value];
//    }

    public function getGenderAttr($value): string
    {
        $status = [-1=>'保密',0=>'女',1=>'男'];
        return $status[$value];
    }


}