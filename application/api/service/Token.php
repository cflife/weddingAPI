<?php
/**
 * Created by PhpStorm.
 * User: zhq
 * Date: 2018/9/27
 * Time: 10:06
 */

namespace app\api\service;


use think\facade\Cache;
use think\Request;

class Token
{
    public static function generateToken()
    {
        $randChar = getRandChar(32);
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        return md5($randChar.$timestamp);
    }

    public static function getCurrentTokenVar($key)
    {
        $request = new Request();
        $token = $request
            ->header('token');
        $vars = Cache::get($token);
        if (!$vars)
        {
            throw new TokenException();
        }
        else {
            if(!is_array($vars))
            {
                $vars = json_decode($vars, true);
            }
            if (array_key_exists($key, $vars)) {
                return $vars[$key];
            }
            else{
                throw new Exception('尝试获取的Token变量并不存在');
            }
        }
    }
}