<?php
/**
 * Created by PhpStorm.
 * User: zhq
 * Date: 2018/9/27
 * Time: 10:45
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\LikeDistance;
use think\facade\Cache;
use think\Controller;
use think\facade\Request;

class Distance extends BaseController
{
    protected $pmodel;
    public function __construct()
    {
        parent::__construct();
        $this->pmodel = model('distance');
    }

    public function lastdistance(){
        $res = $this->pmodel->getLastDistance();
        return $res;
    }

    public function previous(){
        $res = $this->pmodel->previousDistance();
        return $res;
    }

    public function next(){
        $res = $this->pmodel->nextDistance();
        return $res;
    }

    public function like()
    {
        $did = Request::post('did');
        $res = LikeDistance::create([
            'did'=>$did,
            'uid'=>$this->uid
        ]);
        if($res){
            return json(['status'=>0,'msg'=>'点赞成功']);
        }else{
            return json(['status'=>-1,'msg'=>'点赞失败']);
        }
    }

    public function cancelLike()
    {
        $did = Request::post('did');
        $res = LikeDistance::destroy(['did'=>$did,'uid'=>$this->uid]);
        if($res){
            return json(['status'=>0,'msg'=>'删除成功']);
        }else{
            return json(['status'=>-1,'msg'=>'删除失败']);
        }
    }

    public function getLike($did)
    {
        $likeModel = new LikeDistance();
        $num = $likeModel->getDistanceLike($did);
        $res = $likeModel->where(['uid'=>$this->uid,'did'=>$did])->find();
        $isLike = $res ? true : false;
        return json(['num'=>$num,'isLike'=>$isLike]);
    }
}