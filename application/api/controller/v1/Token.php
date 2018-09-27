<?php
/**
 * Created by PhpStorm.
 * User: zhq
 * Date: 2018/9/27
 * Time: 9:49
 */

namespace app\api\controller\v1;


use app\api\validate\TokenGet;

class Token
{
    /**
     * 获取令牌
    */
    public function getToken($code=''){
        (new TokenGet())->goCheck();

    }
}