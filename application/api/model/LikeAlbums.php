<?php
/**
 * Created by PhpStorm.
 * User: liqiaowei
 * Date: 2018/11/21
 * Time: 下午4:04
 */

namespace app\api\model;


use think\model\Pivot;

class LikeAlbums extends Pivot
{
    public function getDistanceLike($aid)
    {
        $num = $this->where(['aid'=>$aid])->count();
        return $num;
    }
}