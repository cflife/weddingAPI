<?php
/**
 * Created by PhpStorm.
 * User: liqiaowei
 * Date: 2018/11/22
 * Time: 下午2:50
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\model\User as UserModel;
use think\facade\Request;

class User extends BaseController
{
    public function postUserInfo()
    {
        $UserInfo = Request::post('userInfo');
//        dump($UserInfo);die;
        UserModel::where(['id'=>$this->uid])->update(['name'=>$UserInfo['nickName'],'headerimg'=>$UserInfo['avatarUrl']]);
        return json(['status'=>0,'msg'=>'提交成功']);
    }
}