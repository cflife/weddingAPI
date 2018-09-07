<?php
/**
 * Created by PhpStorm.
 * User: zhq
 * Date: 2018/9/4
 * Time: 10:14
 */

namespace app\api\model;

use think\Model;

class Distance extends Model
{
    public function sentence()
    {
        return $this->hasOne('sentence', 'tid', 'id');
    }

    public function music()
    {
        return $this->hasOne('music', 'tid', 'id');
    }

    public function lastDistance()
    {
        $last_distance = $this->limit(1)->order('id', 'desc')->select();
        $last_distance = $last_distance->toArray();
        if ($last_distance[0]['type'] == 1) {
            $t_res = model('sentence')->where('id', $last_distance[0]['tid'])->field('content')->find()->toArray();
        } else if ($last_distance[0]['type'] == 2) {
            $t_res = model('music')->where('id', $last_distance[0]['tid'])->field('musicSrc')->find()->toArray();
        }
        $res = array_merge($last_distance[0], $t_res);
        return $res;
    }

    public function previousDistance($id)
    {
        $pid = $id - 1;
        if ($pid <= 0) {
            return ['status'=>-1,'msg'=>'已经是最后一期'];
        }
        $distance = $this::get($pid);
        dump($distance);die;
        $res = $this->where('id',$pid)->find();


    }

    public function nextDistance($id)
    {

    }
}