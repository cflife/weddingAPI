<?php
/**
 * Created by PhpStorm.
 * User: liqiaowei
 * Date: 2018/11/15
 * Time: 下午1:14
 */

namespace app\api\model;


use think\Model;

class User extends Model
{
    public function albums()
    {
        return $this->belongsToMany('Albums','LikeAlbums','aid','uid');
    }

    public static function getByOpenID($openId){
        $user = User::where('openid','=',$openId)
            ->find();
        return $user;
    }

}