<?php
namespace app\api\service;

use app\api\model\User;
use app\lib\exception\WeChatException;
use think\Exception;
use think\facade\Cache;


class UserToken extends Token
{
    protected $code;
    protected $wxLoginUrl;
    protected $wxAppID;
    protected $wxAppSecret;

    function __construct($code)
    {
        $this->code = $code;
        $this->wxAppID = config('wx.app_id');
        $this->wxAppSecret = config('wx.app_secret');
        $this->wxLoginUrl = sprintf(config('wx.login_url'), $this->wxAppID, $this->wxAppSecret, $this->code);
    }

    public function get(){
        $result = curl_get($this->wxLoginUrl);
        $wxResult = json_decode($result,true);
        if(empty($wxResult)){
            throw new Exception('获取session_key及openID时异常，微信内部错误');
        }
        else{
            $logiFail = array_key_exists('errcode',$wxResult);
            if($logiFail){
                $this->processLoginError($wxResult);
            }
            else{
                return $this->grantToken($wxResult);
            }
        }
    }

    private function processLoginError($wxResult){
        throw new WeChatException([
            'msg'=>$wxResult['errmsg'],
            'errcode'=>$wxResult['errcode']
        ]);
    }

    private function grantToken($wxResult)
    {
        $openid = $wxResult['openid'];
        $user = User::getByOpenID($openid);
        if(!$user){
            $uid = $this->newUser($openid);
        }else{
            $uid = $user->id;
        }
        $cachedValue = $this->prepareCachedValue($uid,$wxResult);

        $token = $this->saveToCache($cachedValue);
        return $token;
    }

    //写入缓存
    private function saveToCache($wxResult)
    {
        $key = self::generateToken();
        $value = json_encode($wxResult);
//        Cache::set($key, $value,7200);
        $result = cache($key,$value,7200);
        return $key;
    }

    private function prepareCachedValue($uid,$wxresult)
    {
        $cachedValue = $wxresult;
        $cachedValue['uid'] = $uid;
        return $cachedValue;
    }

    //创建新用户
    private function newUser($openid){
        $user = User::create(
            [
                'openid'=>$openid
            ]
        );
        return $user->id;
    }
}