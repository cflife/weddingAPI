<?php
/**
 * Created by PhpStorm.
 * User: liqiaowei
 * Date: 2018/11/21
 * Time: 下午4:03
 */

namespace app\api\model;


use think\Model;

class LikeDistance extends Model
{
    public function getDistanceLike($did)
    {
        $num = $this->where(['did'=>$did])->count();
        return $num;
    }

//    public function like($did)
//    {
//    }
//
//    public function cancelLike($did)
//    {
//
//    }
}