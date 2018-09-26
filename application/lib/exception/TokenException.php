<?php
/**
 * Created by PhpStorm.
 * User: zhq
 * Date: 2018/9/26
 * Time: 17:49
 */

namespace app\lib\exception;


class TokenException extends BaseException
{
    public $code = 401;
    public $msg = 'Token已过期或无效Token';
    public $errorCode = 10001;
}