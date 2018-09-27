<?php
/**
 * Created by PhpStorm.
 * User: zhq
 * Date: 2018/9/27
 * Time: 10:49
 */

namespace app\api\model;

use think\facade\Cache;
use think\Model;

class Distance extends Model
{
    public function sentence()
    {
        return $this->hasOne('sentence','id','tid');
    }

    public function music(){
        return $this->hasOne('music','id','tid');
    }

    public function getLastDistance()
    {
        $res = self::with('sentence')->order('id','desc')->limit(1)->find();
//        $res = $this->order('id', 'desc')->limit(1)->find();
        Cache::set('distanceId', $res['id']);
        return $res;
    }

    public function previousDistance()
    {
        $did = Cache::dec('distanceId');
        $res = self::with('sentence')->where(['id' => $did])->find();
        return $res;
    }

    public function nextDistance()
    {
        $did = Cache::inc('distanceId');
        $res = self::with('sentence')->where(['id' => $did])->find();
        return $res;
    }
}