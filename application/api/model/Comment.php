<?php
/**
 * Created by PhpStorm.
 * User: liqiaowei
 * Date: 2018/11/20
 * Time: 下午2:17
 */

namespace app\api\model;


use think\Model;

class Comment extends Model
{
    public function getComment($aid)
    {
        $items = $this->where(['aid'=>$aid])->select();
        return $items;
    }
}