<?php
/**
 * Created by PhpStorm.
 * User: zhq
 * Date: 2018/9/26
 * Time: 18:08
 */

namespace app\api\validate;

class TokenGet extends BaseValidate
{
    protected $rule = [
        'code' => 'require|isNotEmpty'
    ];

    protected $message = [
        'code' => '你的code不对哦'
    ];
}