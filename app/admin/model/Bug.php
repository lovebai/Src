<?php
namespace app\admin\model;

use think\Model;

class Bug extends Model
{
    public function getStatusAttr($value): string
    {
        $status = [-1=>'未通过',1=>'已审核',0=>'待审核'];
        return $status[$value];
    }

    public function getGradeAttr($value): string
    {
        $status = [0=>'低危',1=>'中危',2=>'高危',3=>'严重'];
        return $status[$value];
    }

}