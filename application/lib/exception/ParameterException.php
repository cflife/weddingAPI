<?php
/**
 * Created by PhpStorm.
 * User: zhq
 * Date: 2018/9/26
 * Time: 18:02
 */

namespace app\lib\exception;


class ParameterException extends BaseException
{
    public $code = 400;
    public $errorCode = 10000;
    public $msg = "invalid parameters";
}
