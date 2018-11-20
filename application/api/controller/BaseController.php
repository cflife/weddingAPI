<?php
/**
 * Created by PhpStorm.
 * User: liqiaowei
 * Date: 2018/11/20
 * Time: 上午11:14
 */
namespace app\api\controller;

use app\api\service\Token;
use think\Controller;

class BaseController extends Controller
{
    protected $uid;
    public function __construct()
    {
        $this->uid = Token::getCurrentTokenVar('uid');
    }

    protected function checkToken()
    {
        dump('执行');die;
        $this->uid = Token::getCurrentTokenVar('uid');
    }
}