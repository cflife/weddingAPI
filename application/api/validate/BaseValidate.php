<?php

namespace app\api\validate;

use app\lib\exception\ParameterException;
use think\Validate;
use think\Request;

class BaseValidate extends Validate
{
    public function goCheck()
    {
        $request = new Request();
        //dump($request->param());
        $params = $request->param();
        $params['token'] = $request->header('token');
        if (!$this->Check($params)) {
            $exception = new ParameterException([
                // $this->error有一个问题，并不是一定返回数组，需要判断
                'msg' => is_array($this->error) ? implode(
                    ';', $this->error) : $this->error,
            ]);
            throw $exception;
        }
        return true;
    }
}